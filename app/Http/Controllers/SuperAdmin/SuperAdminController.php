<?php

namespace App\Http\Controllers\SuperAdmin;

use App\CompanyTLA;
use App\Country;
use App\Designation;
use App\Helper\Files;
use App\Helper\Reply;
use App\Http\Requests\SuperAdmin\SuperAdmin\CreateSuperAdmin;
use App\Http\Requests\SuperAdmin\SuperAdmin\UpdateSuperAdmin;
use App\Mail\SuperAdmin;
use App\Mail\UpdateSuperAdmin as MailUpdateSuperAdmin;
use App\Team;
use App\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class SuperAdminController extends SuperAdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'app.superAdmin';
        $this->pageIcon = 'icon-people';
        $this->countries = Country::all();
        $this->tla = CompanyTLA::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $this->superAdmin = User::allSuperAdmin();
        $this->totalSuperAdmin = count($this->superAdmin);

        return view('super-admin.super-admin.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create($leadID = null)
    {
        $generatedBy = new User();
        // $this->countries = Country::all();

        $this->groups = Team::with('member', 'member.user')->get();
        $this->designations = Designation::with('members', 'members.user')->get();
        return view('super-admin.super-admin.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateSuperAdmin $request
     * @return array|string[]
     * @throws Exception
     */
    public function store(CreateSuperAdmin $request)
    {
        //dd($request);
        DB::beginTransaction();
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
            "start_date" => $request->input("start_date"),
            "end_date" => $request->input("end_date")
        ];

        $user->gender = $request->input("civility");
        $user->name = $request->input("name");
        $user->address = $request->input('address') . '|' . $request->input('country') . '|' . $request->input('city');

        $user->qualification = $request->input("qualification");
        $user->birthday = $request->input("birthday");
        $user->native_country = $request->input("native_country");
        $user->nationality = $request->input("nationality");
        $user->language = $request->input("language");
        $user->observation = json_encode($observation);

        $user->username = $request->input("username");
        $user->tel = "";
        $user->mobile = "+" . $request->input('mobile_phoneCode') . " " . $request->input('mobile');
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input('password'));
        $user->login = $request->input("connexion") == "1" ? 'enable' : 'disable';
        $user->status = $request->input("status") == "1" ? 'active' : 'deactive';
        $user->super_admin = '1';

        if ($request->hasFile('image')) {
            Files::deleteFile($user->image, 'avatar');
            $user->image = Files::upload($request->image, 'avatar', 300);
        }
        $user->save();
        if ($user) {
            Mail::to($user->email)
                ->send(new SuperAdmin(["email" => $user->email, "password" => $request->password]));
        }
        DB::commit();
        return Reply::redirect(route('super-admin.super-admin.index'), 'Super Admin added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $this->userDetail = User::withoutGlobalScope('active')->where('super_admin', '1')
            ->findOrFail($id);
        $this->tla = CompanyTLA::all();
        $this->groups = Team::with('member', 'member.user')->get();
        $this->designations = Designation::with('members', 'members.user')->get();
        return view('super-admin.super-admin.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSuperAdmin $request
     * @param int $id
     * @return array|string[]
     * @throws Exception
     */
    public function update(UpdateSuperAdmin $request, $id)
    {
        DB::beginTransaction();
        $mail = false;

        $user = User::withoutGlobalScope('active')
            ->where('super_admin', '1')
            ->findOrFail($id);

        $request->validate([
            'email' => [
                'required',
                Rule::unique('users')->ignore($id)
            ]
            // 'company_email' => [
            //     'required',
            //     Rule::unique('users', 'username')->ignore($id)
            // ],
        ]);

        if ($user->email != $request->input("email") || $request->password != '') {
            $mail = true;
        }

        $user->gender = $request->input("civility");
        $user->name = $request->input("name");
        $user->address = $request->input('address') . '|' . $request->input('country') . '|' . $request->input('city');

        $user->qualification = $request->input("qualification");
        $user->birthday = date('Y-m-d', strtotime($request->input("birthday")));
        $user->native_country = $request->input("native_country");
        $user->nationality = $request->input("nationality");
        $user->language = $request->input("language");
        $observation = [
            "departement" => $request->departement_id,
            "start_date" => $request->input("start_date"),
            "end_date" => $request->input("end_date")
        ];
        $user->observation = json_encode($observation);

        $user->username = $request->input("username");
        //$user->tel = "+" . $request->input('tel_phoneCode') . " " . $request->input('tel');
        $user->mobile = "+" . $request->input('mobile_phoneCode') . " " . $request->input('mobile');
        $user->email = $request->input("email");
        $user->super_admin = 1;
        //$user->super_admin = $request->input("profil") == "Super Admin" ? 1 : 0;

        if ($request->password != '') {
            $user->password = Hash::make($request->input('password'));
        }
        if ($this->user->id != $user->id) {
            $user->status =  $request->input("status") == "1" ? 'active' : 'deactive';
            $user->login =  $request->input("connexion") == "1" ? 'enable' : 'disable';
        }

        if ($request->hasFile('image')) {
            Files::deleteFile($user->image, 'avatar');
            $user->image = Files::upload($request->image, 'avatar', 300);
        }
        $user->update();

        if ($mail) {
            Mail::to($user->email)
                ->send(new MailUpdateSuperAdmin(["email" => $user->email, "password" => $request->password]));
        }

        DB::commit();

        return Reply::redirect(route('super-admin.super-admin.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id)
    {
        User::destroy($id);
        return Reply::success(__('messages.userDeleted'));
    }

    public function data(Request $request)
    {
        $users = User::allSuperAdmin();
        return DataTables::of($users)
            ->addColumn('action', function ($row) {
                $action = '<div class="text-center"><div class="btn-group dropdown m-r-10 ">
                    <span aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                    <ul role="menu" class="dropdown-menu pull-right ">
                        <li>
                            <a href="' . route('super-admin.super-admin.edit', [$row->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i> ' . trans('app.edit') . '</a>
                        </li>';

                if ($this->user->id != $row->id) {
                    $action .= ' <li><a href="javascript:;" data-user-id="' . $row->id . '" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> ' . trans('app.delete') . '</a></li>';
                }
                $action .= '</ul> </div></div>';

                return $action;
            })
            ->editColumn(
                'name',
                function ($row) {
                    return ucfirst($row->name);
                }
            )
            ->editColumn(
                'email',
                function ($row) {
                    return ucfirst($row->email);
                }
            )
            ->editColumn(
                'mobile',
                function ($row) {
                    return ucfirst($row->mobile);
                }
            )
            ->editColumn(
                'profile',
                function ($row) {
                    return "SUPER-ADMIN";
                }
            )
            ->rawColumns(['name', 'action', 'status', 'email', 'mobile', 'profile'])
            ->make(true);
    }
}
