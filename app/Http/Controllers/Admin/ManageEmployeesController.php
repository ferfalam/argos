<?php

namespace App\Http\Controllers\Admin;

use App\CompanyTLA;
use App\Company;
use App\Country;
use App\DataTables\Admin\EmployeesDataTable;
use App\Designation;
use App\EmployeeDetails;
use App\EmployeeDocs;
use App\EmployeeLeaveQuota;
use App\EmployeeSkill;
use App\Helper\Files;
use App\Helper\Reply;
use App\Http\Requests\Admin\Employee\StoreRequest;
use App\Http\Requests\Admin\Employee\UpdateRequest;
use App\Leave;
use App\LeaveType;
use App\Models\Messageuser;
use App\Project;
use App\ProjectMember;
use App\ProjectTimeLog;
use App\Role;
use App\RoleUser;
use App\Skill;
use App\Task;
use App\TaskboardColumn;
use App\Team;
use App\UniversalSearch;
use App\User;
use App\UserActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ManageEmployeesController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'app.menu.employees';
        $this->pageIcon = 'icon-user';
        $this->countries = Country::all();
        $this->tla = CompanyTLA::orderBy('name')->get();
        $this->middleware(function ($request, $next) {
            abort_if(!in_array('users.title', $this->user->modules), 403);
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EmployeesDataTable $dataTable)
    {
        // dd(user()->secondRole);
        $this->employees = User::allUsersByCompany(company()->id);
        $this->skills = Skill::orderBy('name', 'asc')->get();
        $this->departments = Team::orderBy('team_name', 'asc')->get();
        $this->designations = Designation::orderBy('name', 'asc')->get();
        $this->totalEmployees = count(User::allUsersByCompany(company()->id));
        $this->roles = Role::orderBy('name', 'asc')->where('company_id', company()->id)->get();
        $whoseProjectCompleted = ProjectMember::join('projects', 'projects.id', '=', 'project_members.project_id')
            ->join('users', 'users.id', '=', 'project_members.user_id')
            ->select('users.*')
            ->groupBy('project_members.user_id')
            ->havingRaw('min(projects.completion_percent) = 100 and max(projects.completion_percent) = 100')
            ->orderBy('users.name')
            ->get();

        $notAssignedProject = User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.id', 'users.name')->whereNotIn('users.id', function ($query) {
                $query->select('user_id as id')->from('project_members');
            })
            // ->where('roles.name', 'Employee')
            ->where('users.super_admin', '0')
            ->where('users.company_id', company()->id)
            ->orderBy('users.name', 'asc')
            ->get();

        $this->freeEmployees = $whoseProjectCompleted->merge($notAssignedProject)->count();

        // return view('admin.employees.index', $this->data);
        return $dataTable->render('admin.employees.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = new EmployeeDetails();
        $this->fields = $employee->getCustomFieldGroupsWithFields()->fields;
        $this->teams = Team::orderBy('team_name', 'asc')->get();
        $this->designations = Designation::orderBy('name', 'asc')->get();
        $this->lastEmployeeID = EmployeeDetails::count();
        $this->countries = Country::orderBy('name', 'asc')->get();
        // $this->roles = Role::whereIn('name', ['admin', 'employee', 'client'])->orderBy('name', 'asc')->get();
        $this->secondRoles = Role::whereNotIn('name', ['admin', 'employee', 'client'])->orderBy('name', 'asc')->get();
        $this->groups = Team::orderBy('team_name', 'asc')->get();
        $this->skills = Skill::orderBy('name', 'asc')->where('company_id', company()->id)->get();
        $this->designations = Designation::orderBy('name', 'asc')->with('members', 'members.user')->get();
        $this->roles = Role::whereIn('name', ['admin', 'employee', 'client'])->where('company_id', company()->id)->get();

        if (request()->ajax()) {
            return view('admin.employees.ajax-create', $this->data);
        }

        return view('admin.employees.create', $this->data);
    }

    /**
     * @param StoreRequest $request
     * @return array
     */
    public function store(StoreRequest $request)
    {

        $company = company();
        if (!is_null($company->employees) && $company->employees->count() >= $company->package->max_employees) {
            return Reply::error(__('messages.upgradePackageForAddEmployees', ['employeeCount' => company()->employees->count(), 'maxEmployees' => $company->package->max_employees]));
        }

        if (!is_null($company->employees) && $company->package->max_employees < EmployeeDetails::where('company_id', $company->id)->count()) {
            return Reply::error(__('messages.downGradePackageForAddEmployees', ['employeeCount' => company()->employees->count(), 'maxEmployees' => $company->package->max_employees]));
        }
        DB::beginTransaction();
        try {
            $user = new User();
            //        $user->name = $request->input('name');
            //        $user->email = $request->input('email');
            //        $user->password = Hash::make($request->input('password'));
            //        $user->mobile = $request->input('mobile');
            //        $user->login = 'enable';
            //        $user->status = 'active';
            //        $user->super_admin = '1';

            $observation = [
                "departement" => $request->departement_id,
                "skills" => $request->skill_id,
                "start_date" => $request->input("start_date"),
                "end_date" => $request->input("end_date")
            ];

            $user->gender = $request->input("civility");
            $user->name = $request->input("name");
            $user->user_id = user()->id;
            $user->address = $request->input('address') . '|' . $request->input('country') . '|' . $request->input('city');

            $user->qualification = $request->input("qualification");
            $user->birthday = ($request->input("birthday") != '') ? date('Y-m-d', strtotime($request->birthday)) : null;
            $user->native_country = $request->input("native_country");
            $user->nationality = $request->input("nationality");
            $user->language = $request->input("language");
            //$user->country_id = $request->input("phone_code");
            $user->observation = json_encode($observation);

            $user->second_role_id = $request->second_role == "none" ? null : $request->second_role;
            $user->username = $request->input("username");
            //$user->local = company()->locale;
            $user->tel = "";
            $user->mobile = "+" . $request->input('mobile_phoneCode') . " " . $request->input('mobile');
            $user->email = $request->input("email");
            $user->password = Hash::make($request->input('password'));
            $user->login = $request->input("connexion") == "1" ? 'enable' : 'disable';
            $user->status = $request->input("status") == "1" ? 'active' : 'deactive';
            $user->email_notifications = intval($request->input("notification"));
            $user->super_admin = '0';

            if ($request->hasFile('image')) {
                Files::deleteFile($user->image, 'avatar');
                $user->image = Files::upload($request->image, 'avatar', 300);
            }
            $user->save();
            
            $role = Role::where('company_id', company()->id)->where('display_name', $request->profil)->get()[0];
            $UserRole = new RoleUser();
            $UserRole->user_id = $user->id;
            $UserRole->role_id = $role->id;
            $UserRole->save();

            // $empDetail = [
            //     'employee_id' => $user->id,
            //     'address' => $request->address,
            //     'hourly_rate' => $request->hourly_rate?$request->hourly_rate:0,
            //     'slack_username' => $request->slack_username ? $request->slack_username :'',
            //     'joining_date' => $request->start_date,
            //     'last_date' => ($request->end_date != '') ? $request->end_date : null,
            //     'department_id' => $request->department?$request->department:'',
            //     'designation_id' => $request->designation?$request->designation:'',
            // ];
            
            $employee = new EmployeeDetails();
            $employee->user_id = $user->id;
            $employee->company_id = company()->id;
            $employee->department_id = $request->department_id;
            $employee->designation_id = Designation::where('name', $request->input("qualification"))->where('company_id', company()->id)->first()->id;
            $employee->address = $user->address;
            $employee->employee_id = $user->username;
            $employee->hourly_rate =  $request->hourly_rate ? $request->hourly_rate : 0;
            $employee->slack_username = $request->slack_username == "" ? $request->slack_username : '';
            //$employee->joining_date = ($request->start_date != '') ? date('d-m-Y', strtotime($request->start_date)) : null;
            //$employee->last_date =  ($request->end_date != '') ? date('d-m-Y', strtotime($request->end_date)) : null;
            //$employee->department_id = $request->service ? $request->service : '';
            $employee->save();
            
            if ($request->skill_id && count($request->skill_id)>0) {
                foreach ($request->skill_id as $id) {
                    // check or store skills

                    $skillData = EmployeeSkill::firstOrCreate(['user_id' => $user->id, 'skill_id' => $id]);
                }
            }
            // To add custom fields data
            if ($request->get('custom_fields_data')) {
                $user->employeeDetail->updateCustomFieldData($request->get('custom_fields_data'));
            }

            // $role = Role::where('name', 'employee')->first();
            // $user->attachRole($role->id);
            DB::commit();
        } catch (\Swift_TransportException $e) {
            DB::rollback();
            return Reply::error('Please configure SMTP details to add employee. Visit Settings -> Email setting to set SMTP', 'smtp_error');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();

            return Reply::error('Some error occured when inserting the data. Please try again or contact support');
        }
        $this->logSearchEntry($user->id, $user->name, 'admin.employees.show', 'employee');

        if ($request->has('ajax_create')) {
            $teams = User::allUsersByCompany(company()->id);
            $teamData = '';

            foreach ($teams as $team) {
                $teamData .= '<option value="' . $team->id . '"> ' . ucwords($team->name) . ' </option>';
            }

            return Reply::successWithData(__('messages.employeeAdded'), ['teamData' => $teamData]);
        }

        return Reply::redirect(route('admin.employees.index'), __('messages.employeeAdded'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->employee = User::with(['employeeDetail', 'employeeDetail.designation', 'employeeDetail.department', 'leaveTypes', 'country', 'roles'])->withoutGlobalScope('active')->findOrFail($id);
        $this->employeeDetail = EmployeeDetails::where('user_id', '=', $this->employee->id)->first();
        $this->cityName = CompanyTLA::where('id', $this->employee->city_id)->first();
        $this->employeeDocs = EmployeeDocs::where('user_id', '=', $this->employee->id)->get();
        $this->employeeCountry = Company::where('id', $this->employeeDetail->company_id)->first();
        if (!is_null($this->employeeDetail)) {
            $this->employeeDetail = $this->employeeDetail->withCustomFields();
            $this->fields = $this->employeeDetail->getCustomFieldGroupsWithFields()->fields;
        }


        $completedTaskColumn = TaskboardColumn::where('slug', 'completed')->first();

        $this->taskCompleted = Task::join('task_users', 'task_users.task_id', '=', 'tasks.id')
            ->where('task_users.user_id', $id)
            ->where('tasks.board_column_id', $completedTaskColumn->id)
            ->count();

        $hoursLogged = ProjectTimeLog::where('user_id', $id)->sum('total_minutes');

        $timeLog = intdiv($hoursLogged, 60) . ' hrs ';

        if (($hoursLogged % 60) > 0) {
            $timeLog .= ($hoursLogged % 60) . ' mins';
        }

        $this->hoursLogged = $timeLog;

        $this->activities = UserActivity::where('user_id', $id)->orderBy('id', 'desc')->get();
        $this->projects = Project::select('projects.id', 'projects.project_name', 'projects.deadline', 'projects.completion_percent')
            ->join('project_members', 'project_members.project_id', '=', 'projects.id')
            ->where('project_members.user_id', '=', $id)
            ->get();
        $this->leaves = Leave::byUser($id);
        $this->leavesCount = Leave::byUserCount($id);

        $this->leaveTypes = LeaveType::byUser($id);
        $this->allowedLeaves = $this->employee->leaveTypes->sum('no_of_leaves');
        $this->employeeLeavesQuota = $this->employee->leaveTypes;

        return view('admin.employees.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->userDetail = User::withoutGlobalScope('active')->findOrFail($id);
        //dd($this->userDetail);
        $this->employeeDetail = EmployeeDetails::where('user_id', '=', $this->userDetail->id)->first();
        $this->teams = Team::orderBy('team_name', 'asc')->get();
        $this->designations = Designation::orderBy('name', 'asc')->get();
        $this->countries = Country::orderBy('name', 'asc')->get();
        $this->userRole = Role::find($this->userDetail->role()->get()[0]->role_id);
        $this->EmployeeSkill = EmployeeSkill::where('user_id', $id)->pluck('skill_id')->toArray();
        $this->groups = Team::orderBy('team_name', 'asc')->get();
        $this->skills = Skill::orderBy('name', 'asc')->where('company_id', company()->id)->get();
        $this->designations = Designation::orderBy('name', 'asc')->with('members', 'members.user')->get();
        $this->roles = Role::whereIn('name', ['admin', 'employee', 'client'])->where('company_id', company()->id)->get();
        $this->secondRoles = Role::whereNotIn('name', ['admin', 'employee', 'client'])->orderBy('name', 'asc')->get();

        if (!is_null($this->employeeDetail)) {
            $this->employeeDetail = $this->employeeDetail->withCustomFields();
            $this->fields = $this->employeeDetail->getCustomFieldGroupsWithFields()->fields;
        }

        return view('admin.employees.edit', $this->data);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {

        $company = company();
        if (!is_null($company->employees) && $company->employees->count() >= $company->package->max_employees) {
            return Reply::error(__('messages.upgradePackageForAddEmployees', ['employeeCount' => company()->employees->count(), 'maxEmployees' => $company->package->max_employees]));
        }

        if (!is_null($company->employees) && $company->package->max_employees < EmployeeDetails::where('company_id', $company->id)->count()) {
            return Reply::error(__('messages.downGradePackageForAddEmployees', ['employeeCount' => company()->employees->count(), 'maxEmployees' => $company->package->max_employees]));
        }
        DB::beginTransaction();
        $user = User::withoutGlobalScope('active')
        ->findOrFail($id);
        if ($user->email != $request->input("email")) {
            $request->validate([
                'email' => 'unique:users'
            ]);
            $user->email = $request->input("email");
        }
        try {
            //        $user->name = $request->input('name');
            //        $user->email = $request->input('email');
            //        $user->password = Hash::make($request->input('password'));
            //        $user->mobile = $request->input('mobile');
            //        $user->login = 'enable';
            //        $user->status = 'active';
            //        $user->super_admin = '1';

            $observation = [
                "departement" => $request->departement_id,
                "skills" => $request->skill_id,
                "start_date" => $request->input("start_date"),
                "end_date" => $request->input("end_date")
            ];

            $user->gender = $request->input("civility");
            $user->name = $request->input("name");
            $user->user_id = user()->id;
            $user->address = $request->input('address') . '|' . $request->input('country') . '|' . $request->input('city');


            $user->second_role_id = $request->second_role == "none" ? null : $request->second_role;
            $user->qualification = $request->input("qualification");
            $user->birthday = ($request->input("birthday") != '') ? date('Y-m-d', strtotime($request->birthday)) : null;
            $user->native_country = $request->input("native_country");
            $user->nationality = $request->input("nationality");
            $user->language = $request->input("language");
            //$user->country_id = $request->input("phone_code");
            $user->observation = json_encode($observation);

            $user->username = $request->input("username");
            if ($request->password != '') {
                $user->password = Hash::make($request->input('password'));
            }
            //$user->local = company()->locale;
            $user->tel = "";
            $user->mobile = "+" . $request->input('mobile_phoneCode') . " " . $request->input('mobile');
            
            //$user->password = Hash::make($request->input('password'));
            $user->login = $request->input("connexion") == "1" ? 'enable' : 'disable';
            $user->status = $request->input("status") == "1" ? 'active' : 'deactive';
            $user->email_notifications = intval($request->input("notification"));
            
            if ($request->hasFile('image')) {
                Files::deleteFile($user->image, 'avatar');
                $user->image = Files::upload($request->image, 'avatar', 300);
            }
            $user->update();
            $role = Role::where('company_id', company()->id)->where('display_name', $request->profil)->get()[0];

            $userRole = \DB::update('UPDATE role_user set role_id = ? WHERE user_id = ?', [$role->id, $user->id]);

            // $empDetail = [
            //     'employee_id' => $user->id,
            //     'address' => $request->address,
            //     'hourly_rate' => $request->hourly_rate?$request->hourly_rate:0,
            //     'slack_username' => $request->slack_username ? $request->slack_username :'',
            //     'joining_date' => $request->start_date,
            //     'last_date' => ($request->end_date != '') ? $request->end_date : null,
            //     'department_id' => $request->department?$request->department:'',
            //     'designation_id' => $request->designation?$request->designation:'',
            // ];
            $employee = EmployeeDetails::where("user_id", $id)->get()[0];
            $employee->address = $user->address;
            $employee->department_id = $request->department_id;
            $employee->designation_id = Designation::where('name',$request->input("qualification"))->where('company_id', company()->id)->first()->id;
            $employee->employee_id = $user->username;
            $employee->hourly_rate =  $request->hourly_rate ? $request->hourly_rate : 0;
            $employee->slack_username = $request->slack_username == "" ? $request->slack_username : '';
            //$employee->joining_date = ($request->start_date != '') ? date('d-m-Y', strtotime($request->start_date)) : null;
            //$employee->last_date =  ($request->end_date != '') ? date('d-m-Y', strtotime($request->end_date)) : null;
            //$employee->department_id = $request->service ? $request->service : '';
            $employee->save();

            if ($request->skill_id && count($request->skill_id) > 0) {
                foreach ($request->skill_id as $id) {
                    // check or store skills
                    $skillData = EmployeeSkill::firstOrCreate(['user_id' => $user->id, 'skill_id' => $id]);
                }
            }
            // To add custom fields data
            if ($request->get('custom_fields_data')) {
                $user->employeeDetail->updateCustomFieldData($request->get('custom_fields_data'));
            }

            // $role = Role::where('name', 'employee')->first();
            // $user->attachRole($role->id);
            DB::commit();
        } catch (\Swift_TransportException $e) {
            DB::rollback();
            return Reply::error('Please configure SMTP details to add employee. Visit Settings -> Email setting to set SMTP', 'smtp_error');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            // return Reply::error('Some error occured when inserting the data. Please try again or contact support');
        }
        $this->logSearchEntry($user->id, $user->name, 'admin.employees.show', 'employee');

        if ($request->has('ajax_create')) {
            $teams = User::allEmployees();
            $teamData = '';

            foreach ($teams as $team) {
                $teamData .= '<option value="' . $team->id . '"> ' . ucwords($team->name) . ' </option>';
            }

            return Reply::successWithData(__('messages.employeeUpdated'), ['teamData' => $teamData]);
        }

        return Reply::redirect(route('admin.employees.index'), __('messages.employeeUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::withoutGlobalScope('active')->findOrFail($id);

        if ($user->id == 1) {
            return Reply::error(__('messages.adminCannotDelete'));
        }

        $universalSearches = UniversalSearch::where('searchable_id', $id)->where('module_type', 'employee')->get();
        if ($universalSearches) {
            foreach ($universalSearches as $universalSearch) {
                UniversalSearch::destroy($universalSearch->id);
            }
        }
        User::destroy($id);

        session()->forget('company_setting');
        session()->forget('company');
        $this->employees = User::allEmployees();
        $this->totalEmployees = count($this->employees);
        $whoseProjectCompleted = ProjectMember::join('projects', 'projects.id', '=', 'project_members.project_id')
            ->join('users', 'users.id', '=', 'project_members.user_id')
            ->select('users.*')
            ->groupBy('project_members.user_id')
            ->havingRaw('min(projects.completion_percent) = 100 and max(projects.completion_percent) = 100')
            ->orderBy('users.id')
            ->get();

        $notAssignedProject = User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.id', 'users.name')->whereNotIn('users.id', function ($query) {

                $query->select('user_id as id')->from('project_members');
            })
            ->where('roles.name', '<>', 'client')
            ->get();

        $this->freeEmployees = $whoseProjectCompleted->merge($notAssignedProject)->count();
        return Reply::successWithData(__('messages.employeeDeleted'), ['data' => $this->data]);
    }

    public function tasks($userId, $hideCompleted)
    {
        $taskBoardColumn = TaskboardColumn::where('slug', 'incomplete')->first();

        $tasks = Task::join('task_users', 'task_users.task_id', '=', 'tasks.id')
            ->leftJoin('projects', 'projects.id', '=', 'tasks.project_id')
            ->join('taskboard_columns', 'taskboard_columns.id', '=', 'tasks.board_column_id')
            ->select('tasks.id', 'projects.project_name', 'tasks.heading', 'tasks.due_date', 'tasks.status', 'tasks.project_id', 'taskboard_columns.column_name', 'taskboard_columns.label_color')
            ->where('task_users.user_id', $userId);

        if ($hideCompleted == '1') {
            $tasks->where('tasks.board_column_id', $taskBoardColumn->id);
        }

        $tasks->get();

        return DataTables::of($tasks)
            ->editColumn('due_date', function ($row) {
                if (!is_null($row->due_date)) {
                    if ($row->due_date->isPast()) {
                        return '<span class="text-danger">' . $row->due_date->format($this->global->date_format) . '</span>';
                    }
                    return '<span class="text-success">' . $row->due_date->format($this->global->date_format) . '</span>';
                }
            })
            ->editColumn('heading', function ($row) {
                $name = '<a href="javascript:;" data-task-id="' . $row->id . '" class="show-task-detail">' . ucfirst($row->heading) . '</a>';

                if ($row->is_private) {
                    $name .= ' <i data-toggle="tooltip" data-original-title="' . __('app.private') . '" class="fa fa-lock" style="color: #ea4c89"></i>';
                }
                return $name;
            })
            ->editColumn('column_name', function ($row) {
                return '<label class="label" style="background-color: ' . $row->label_color . '">' . $row->column_name . '</label>';
            })
            ->editColumn('project_name', function ($row) {
                if (!is_null($row->project_name)) {
                    return '<a href="' . route('admin.projects.show', $row->project_id) . '">' . ucfirst($row->project_name) . '</a>';
                }
            })
            ->rawColumns(['column_name', 'project_name', 'due_date', 'heading'])
            ->removeColumn('project_id')
            ->make(true);
    }

    public function timeLogs($userId)
    {
        $timeLogs = ProjectTimeLog::join('projects', 'projects.id', '=', 'project_time_logs.project_id')
            ->select('project_time_logs.id', 'projects.project_name', 'project_time_logs.start_time', 'project_time_logs.end_time', 'project_time_logs.total_hours', 'project_time_logs.memo', 'project_time_logs.project_id', 'project_time_logs.total_minutes')
            ->where('project_time_logs.user_id', $userId);
        $timeLogs->get();

        return DataTables::of($timeLogs)
            ->editColumn('start_time', function ($row) {
                return $row->start_time->timezone($this->global->timezone)->format($this->global->date_format . ' ' . $this->global->time_format);
            })
            ->editColumn('end_time', function ($row) {
                if (!is_null($row->end_time)) {
                    return $row->end_time->timezone($this->global->timezone)->format($this->global->date_format . ' ' . $this->global->time_format);
                } else {
                    return "<label class='label label-success'>Active</label>";
                }
            })
            ->editColumn('project_name', function ($row) {
                return '<a href="' . route('admin.projects.show', $row->project_id) . '">' . ucfirst($row->project_name) . '</a>';
            })
            ->editColumn('total_hours', function ($row) {
                $timeLog = intdiv($row->total_minutes, 60) . ' hrs ';

                if (($row->total_minutes % 60) > 0) {
                    $timeLog .= ($row->total_minutes % 60) . ' mins';
                }

                return $timeLog;
            })
            ->rawColumns(['end_time', 'project_name'])
            ->removeColumn('project_id')
            ->make(true);
    }

    public function export($status, $employee, $role)
    {
        if ($role != 'all' && $role != '') {
            $userRoles = Role::findOrFail($role);
        }
        $rows = User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->withoutGlobalScope('active')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('roles.name', '<>', 'client')
            ->leftJoin('employee_details', 'users.id', '=', 'employee_details.user_id')
            ->leftJoin('designations', 'designations.id', '=', 'employee_details.designation_id')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.mobile',
                'designations.name as designation_name',
                'employee_details.address',
                'employee_details.hourly_rate',
                'users.created_at',
                'roles.name as roleName'
            );
        if ($status != 'all' && $status != '') {
            $rows = $rows->where('users.status', $status);
        }

        if ($employee != 'all' && $employee != '') {
            $rows = $rows->where('users.id', $employee);
        }

        if ($role != 'all' && $role != '' && $userRoles) {
            if ($userRoles->name == 'admin') {
                $rows = $rows->where('roles.id', $role);
            } elseif ($userRoles->name == 'employee') {
                $rows = $rows->where(\DB::raw('(select user_roles.role_id from role_user as user_roles where user_roles.user_id = users.id ORDER BY user_roles.role_id DESC limit 1)'), $role)
                    ->having('roleName', '<>', 'admin');
            } else {
                $rows = $rows->where(\DB::raw('(select user_roles.role_id from role_user as user_roles where user_roles.user_id = users.id ORDER BY user_roles.role_id DESC limit 1)'), $role);
            }
        }
        $attributes = ['roleName'];
        $rows = $rows->groupBy('users.id')->get()->makeHidden($attributes);

        // Initialize the array which will be passed into the Excel
        // generator.
        $exportArray = [];

        // Define the Excel spreadsheet headers
        $exportArray[] = ['ID', 'Name', 'Email', 'Mobile', 'Designation', 'Address', 'Hourly Rate', 'Created at', 'Role'];

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {
            $exportArray[] = [
                'id' => $row->id,
                'name' => $row->name,
                'email' => $row->email,
                'mobile' => $row->mobile,
                'Designation' => $row->designation_name,
                'address' => $row->address,
                'hourly_rate' => $row->hourly_rate,
                'created_at' => $row->created_at->format('Y-m-d h:i:s a'),
                'roleName' => $row->roleName
            ];
        }

        // Generate and return the spreadsheet
        Excel::create('Employees', function ($excel) use ($exportArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Employees');
            $excel->setCreator('Worksuite')->setCompany($this->companyName);
            $excel->setDescription('Employees file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function ($sheet) use ($exportArray) {
                $sheet->fromArray($exportArray, null, 'A1', false, false);

                $sheet->row(1, function ($row) {

                    // call row manipulation methods
                    $row->setFont(array(
                        'bold' => true
                    ));
                });
            });
        })->download('xlsx');
    }

    public function assignRole(Request $request)
    {
        $userId = $request->userId;
        $roleId = $request->role;
        $employeeRole = Role::where('name', 'employee')->first();
        $user = User::withoutGlobalScope('active')->findOrFail($userId);

        RoleUser::where('user_id', $user->id)->delete();
        $user->roles()->attach($employeeRole->id);
        if ($employeeRole->id != $roleId) {
            $user->roles()->attach($roleId);
        }

        return Reply::success(__('messages.roleAssigned'));
    }

    public function assignProjectAdmin(Request $request)
    {
        $userId = $request->userId;
        $projectId = $request->projectId;
        $project = Project::findOrFail($projectId);
        $project->project_admin = $userId;
        $project->save();

        return Reply::success(__('messages.roleAssigned'));
    }

    public function docsCreate(Request $request, $id)
    {
        $this->employeeID = $id;
        $this->upload = can_upload();
        return view('admin.employees.docs-create', $this->data);
    }

    public function freeEmployees()
    {
        if (\request()->ajax()) {

            $whoseProjectCompleted = ProjectMember::join('projects', 'projects.id', '=', 'project_members.project_id')
                ->join('users', 'users.id', '=', 'project_members.user_id')
                ->select('users.*')
                ->groupBy('project_members.user_id')
                ->havingRaw('min(projects.completion_percent) = 100 and max(projects.completion_percent) = 100')
                ->orderBy('users.id')
                ->get();

            $notAssignedProject = User::join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('users.*')
                ->whereNotIn('users.id', function ($query) {

                    $query->select('user_id as id')->from('project_members');
                })
                ->where('roles.name', '<>', 'client')
                ->get();

            $freeEmployees = $whoseProjectCompleted->merge($notAssignedProject);

            return DataTables::of($freeEmployees)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.employees.edit', [$row->id]) . '" class="btn btn-info btn-circle"
                      data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                      <a href="' . route('admin.employees.show', [$row->id]) . '" class="btn btn-success btn-circle"
                      data-toggle="tooltip" data-original-title="View Employee Details"><i class="fa fa-search" aria-hidden="true"></i></a>

                      <a href="javascript:;" class="btn btn-danger btn-circle sa-params"
                      data-toggle="tooltip" data-user-id="' . $row->id . '" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>';
                })
                ->editColumn(
                    'created_at',
                    function ($row) {
                        return Carbon::parse($row->created_at)->format($this->global->date_format);
                    }
                )
                ->editColumn(
                    'status',
                    function ($row) {
                        if ($row->status == 'active') {
                            return '<label class="label label-success">' . __('app.active') . '</label>';
                        } else {
                            return '<label class="label label-danger">' . __('app.inactive') . '</label>';
                        }
                    }
                )
                ->editColumn('name', function ($row) {
                    $image = '<img src="' . $row->image_url . '" alt="user" class="img-circle" width="30" height="30"> ';
                    return '<a href="' . route('admin.employees.show', $row->id) . '">' . $image . ' ' . ucwords($row->name) . '</a>';
                })
                ->rawColumns(['name', 'action', 'role', 'status'])
                ->removeColumn('roleId')
                ->removeColumn('roleName')
                ->removeColumn('current_role')
                ->make(true);
        }

        return view('admin.employees.free_employees', $this->data);
    }

    public function leaveTypeEdit($id)
    {
        $this->employeeLeavesQuota = User::with('leaveTypes', 'leaveTypes.leaveType')->withoutGlobalScope('active')->findOrFail($id)->leaveTypes;
        return view('admin.employees.leave_type_edit', $this->data);
    }

    public function leaveTypeUpdate(Request $request, $id)
    {
        if ($request->leaves < 0) {
            return Reply::error('messages.leaveTypeValueError');
        }
        $type = EmployeeLeaveQuota::findOrFail($id);
        $type->no_of_leaves = $request->leaves;
        $type->save();

        session()->forget('user');

        return Reply::success(__('messages.leaveTypeAdded'));
    }
}
