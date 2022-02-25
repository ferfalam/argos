<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Company;
use App\CompanySubSettings;
use App\CompanyTLA;
use App\Country;
use App\Currency;
use App\EmployeeDetails;
use App\GlobalCurrency;
use App\Helper\Files;
use App\Helper\Reply;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Requests\SuperAdmin\Companies\DeleteRequest;
use App\Http\Requests\SuperAdmin\Companies\PackageUpdateRequest;
use App\Http\Requests\SuperAdmin\Companies\StoreRequest;
use App\Http\Requests\SuperAdmin\Companies\UpdateRequest;
use App\Invoice;
use App\InvoiceSetting;
use App\LanguageSetting;
use App\Mail\Admin;
use App\Mail\UpdateAdmin;
use App\OfflineInvoice;
use App\OfflinePaymentMethod;
use App\Package;
use App\Role;
use App\Scopes\CompanyScope;
use App\StripeInvoice;
use App\Traits\CurrencyExchange;
use App\User;
use Carbon\Carbon;
use Google\Service\Gmail\LanguageSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SuperAdminCompanyController extends SuperAdminBaseController
{
    use CurrencyExchange;

    /**
     * AdminProductController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Sociétés';
        $this->pageIcon = 'icon-layers';
        $this->colClass = '6';
        $this->countries = Country::all();
        if (module_enabled('Subdomain')) {
            $this->colClass = '4';
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->totalCompanies = Company::count();
        $this->packages = Package::all();
        return view('super-admin.companies.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->timezones = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
        $this->currencies = GlobalCurrency::all();
        $company = new Company();
        $this->fields = $company->getCustomFieldGroupsWithFields()->fields;
        $this->tla = CompanyTLA::all();
        return view('super-admin.companies.create2', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreRequest $request
     * @return array
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();

        $company = new Company();
        $compannySubSetting = new CompanySubSettings();

        $companyDetail = $this->storeAndUpdate($company, $compannySubSetting, $request);
        $globalCurrency = GlobalCurrency::findOrFail($request->devise);

        $currency = Currency::where('currency_code', $globalCurrency->currency_code)
            ->where('company_id', $companyDetail->id)->first();

        if (is_null($currency)) {
            $this->newCurrency($globalCurrency, $companyDetail);
        }
        if ($currency) {
            $company->currency_id = $currency->id;
            $company->save();
        }

        request()->request->add(['company_id' => $company->id]);
        $user = $company->addUser($company, $request);
        $user->status = 'active';
        $user->email_verification_code = null;
        $user->save();
        if ($user) {
            Mail::to($user->email)
                ->send(new Admin($request->company_name, ["email" => $user->email, "password" => $request->password]));
        }

        // To add custom fields data
        if ($request->get('custom_fields_data')) {
            $company->updateCustomFieldData($request->get('custom_fields_data'));
        }

        $company->addEmployeeDetails($user, 'superadmin');
        //        DB::enableQueryLog();
        $adminRole = Role::where('name', 'admin')->where('company_id', $companyDetail->id)->withoutGlobalScopes([CompanyScope::class, 'active'])->first();
        //        dd(DB::getQueryLog());
        if (!$adminRole) {
            $adminRole = new Role();
            $adminRole->company_id = $companyDetail->id;
            $adminRole->name = 'admin';
            $adminRole->display_name = 'App Administrator';
            $adminRole->description = 'Admin is allowed to manage everything of the app.';
            $adminRole->save();
        }
        $user->roles()->attach($adminRole->id);

        $employeeRole = Role::where('name', 'employee')->where('company_id', $user->company_id)->first();

        if (!$employeeRole) {
            $employeeRole = new Role();
            $employeeRole->company_id = $user->company_id;
            $employeeRole->name = 'employee';
            $employeeRole->display_name = 'Employee';
            $employeeRole->description = 'Employee can see tasks and projects assigned to him.';
            $employeeRole->save();
        }
        $user->roles()->attach($employeeRole->id);
        DB::commit();
        return Reply::redirect(route('super-admin.companies.index'), 'Company added successfully.');
    }

    private function newCurrency($globalCurrency, $companyDetail)
    {
        $currency = new Currency();
        $currency->currency_name = $globalCurrency->currency_name;
        $currency->currency_symbol = $globalCurrency->currency_symbol;
        $currency->currency_code = $globalCurrency->currency_code;
        $currency->is_cryptocurrency = $globalCurrency->is_cryptocurrency;
        $currency->usd_price = $globalCurrency->usd_price;
        $currency->company_id = $companyDetail->id;
        $currency->save();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $this->companyDetails = Company::with('package', 'file_storage', 'employees')->findOrFail($id)->withCustomFields();
        $this->fields = $this->companyDetails->getCustomFieldGroupsWithFields()->fields;
        $view = view('super-admin.companies.show', $this->data)->render();
        return Reply::dataOnly(['status' => 'success', 'view' => $view]);
    }

    /**
     * @param $companyId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function editPackage($companyId)
    {
        $packages = Package::all();
        $global = $this->global;
        $company = Company::find($companyId);
        $currentPackage = Package::find($company->package_id);
        $lastInvoice = StripeInvoice::where('company_id', $companyId)->orderBy('created_at', 'desc')->first();
        $packageInfo = [];
        foreach ($packages as $package) {
            $packageInfo[$package->id] = [
                'monthly' => $package->monthly_price,
                'annual' => $package->annual_price
            ];
        }

        //        $companyAdminName = User::find()->where('company_id', $companyId)->value('name');
        $company->logo = "";

        $offlinePaymentMethod = OfflinePaymentMethod::whereNull('company_id')->get();
        $modal = view('super-admin.companies.editPackage', compact('packages', 'company', 'currentPackage', 'lastInvoice', 'packageInfo', 'global', 'offlinePaymentMethod'))->render();

        return response(['status' => 'success', 'data' => $modal], 200);
    }

    public function updatePackage(PackageUpdateRequest $request, $companyId)
    {
        $company = Company::find($companyId);

        try {
            $package = Package::find($request->package);
            $company->package_id = $package->id;
            $company->package_type = $request->packageType;
            $company->status = 'active';

            $payDate = $request->pay_date ? Carbon::parse($request->pay_date) : Carbon::now();

            $company->licence_expire_on = ($company->package_type == 'monthly') ? $payDate->copy()->addMonth()->format('Y-m-d') : $payDate->copy()->addYear()->format('Y-m-d');

            $nextPayDate = $request->next_pay_date ? Carbon::parse($request->next_pay_date) : $company->licence_expire_on;

            if ($company->isDirty('package_id') || $company->isDirty('package_type')) {
                $offlineInvoice = new OfflineInvoice();
            } else {
                $offlineInvoice = OfflineInvoice::where('company_id', $companyId)->orderBy('created_at', 'desc')->first();
                if (!$offlineInvoice) {
                    $offlineInvoice = new OfflineInvoice();
                }
            }
            $offlineInvoice->company_id = $company->id;
            $offlineInvoice->package_id = $company->package_id;
            $offlineInvoice->package_type = $request->packageType;
            $offlineInvoice->amount = $request->amount ?: $package->{$request->packageType . '_price'};
            $offlineInvoice->pay_date = $payDate;
            $offlineInvoice->next_pay_date = $nextPayDate;
            $offlineInvoice->status = 'paid';

            $offlineInvoice->save();
            $company->save();

            return response(['status' => 'success', 'message' => 'Package Updated Successfully.'], 200);
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->company = Company::find($id)->withCustomFields();
        $this->tla = CompanyTLA::all();
        $this->companySubSettings = CompanySubSettings::where('company_id', $id)->get()[0];
        $this->fields = $this->company->getCustomFieldGroupsWithFields()->fields;

        $this->timezones = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
        $this->currencies = Currency::all();
        $this->packages = Package::all();
        $this->companyUser = DB::table('users')->where('company_id', $id)->first();

        return view('super-admin.companies.edit', $this->data);
    }

    public function defaultLanguage()
    {
        $this->languages = LanguageSetting::where('status', 'enabled')->get();
        return view('super-admin.companies.default-language', $this->data);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function defaultLanguageUpdate(Request $request)
    {
        $this->global->new_company_locale = $request->default_language;
        $this->global->save();

        return Reply::success(__('messages.defaultCompanyLanguage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return array
     */
    public function update(UpdateRequest $request, $id)
    {
        $company = Company::find($id);
        $compannySubSetting = $company->companySubSetting;
        $this->storeAndUpdate($company, $compannySubSetting, $request);
        $company->currency_id = $request->currency_id;
        $company->save();

        // To add custom fields data
        if ($request->get('custom_fields_data')) {
            $company->updateCustomFieldData($request->get('custom_fields_data'));
        }

        $savearr = [
            'email' => $request->email,
            'name' => $request->admin_name,
        ];

        if (!is_null($request->password)) {
            $savearr['password'] = bcrypt($request->password);
        }

        $user = DB::table('users')->where('id', $request->userid)->update($savearr);
        if ($user) {
            Mail::to($request->email)
                ->send(new UpdateAdmin($request->company_name, ["email" => $request->email, "password" => $request->password]));
        }

        return Reply::redirect(route('super-admin.companies.index'), __('messages.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteRequest $request
     * @param int $id
     * @return array
     */
    public function destroy(DeleteRequest $request, $id)
    {
        DB::table('users')->where('company_id', $id)->delete();
        Company::destroy($id);
        return Reply::success(__('messages.deleteSuccess'));
    }

    public function create2()
    {
        $this->timezones = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
        $this->currencies = GlobalCurrency::all();
        $company = new Company();
        $this->fields = $company->getCustomFieldGroupsWithFields()->fields;
        return view('super-admin.companies.create2', $this->data);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function data(Request $request)
    {
        $packages = Company::with('currency', 'package');

        if ($request->package != 'all' && $request->package != '') {
            $packages = $packages->where('package_id', $request->package);
        }

        if ($request->type != 'all' && $request->type != '') {
            $packages = $packages->where('package_type', $request->type);
        }

        return Datatables::of($packages)
            ->addColumn('action', function ($row) {
                $companyUser = User::withoutGlobalScope(CompanyScope::class)->withoutGlobalScope('active')->where('company_id', $row->id)->first();

                $action = '<div class="text-center"><div class="btn-group dropdown m-r-10">
                 <span aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-cogs" aria-hidden="true"></i></span>
                <ul role="menu" class="dropdown-menu pull-right">
                  <li><a href="' . route('super-admin.companies.edit', [$row->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i> ' . trans('app.edit') . '</a></li>';

                if ($companyUser && $companyUser->email_verification_code != null) {
                    $action .= '<li><a href="javascript:;" class="verify-user"
                     data-user-id="' . $companyUser->id . '" ><i class="fa fa-check" aria-hidden="true"></i> ' . __('modules.company.verifyNow') . '</a></li>';
                } else if (module_enabled('Subdomain')) {
                    $action .= '<li><a href="javascript:;" class="domain-params"
                    data-company-id="' . $row->id . '" data-company-url="' . request()->getScheme() . '://' . $row->sub_domain . '" ><i class="fa fa-bell" aria-hidden="true"></i> Send Domain Notification</a></li>';
                }

                //$action .= '<li><a href="javascript:;" class="view-company" data-company-id="' . $row->id . '"><i class="fa fa-eye" aria-hidden="true"></i> ' . trans('app.view') . '</a></li>';

                $action .= '<li><a href="javascript:;" data-user-id="' . $row->id . '" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> ' . trans('app.delete') . '</a></li>';

                $action .= '</ul> </div></div>';

                return $action;
            })
            ->editColumn('company_name', function ($row) {
                return '<strong>' . ucfirst($row->company_name) . '</strong>';
                //return '<a href="' . route('super-admin.companies.edit', $row->id) . '"  data-company-id="' . $row->id . '"><strong>' . ucfirst($row->company_name) . '</strong></a>';
            })
            ->editColumn('status', function ($row) {
                $class = ($row->status == 'active') ? 'label-custom' : 'label-danger';
                // return '<span class="label ' . $class . '">' . ucfirst($row->status) . '</span>';
                $flag = Country::where('name', explode('|', $row->address)[1])->get()[0]->iso;
                return '<span class="flag-icon flag-icon-' . strtolower($flag) . '"></span>&nbsp;<span>' . explode('|', $row->address)[1] . '</span>';
            })
            ->editColumn('company_email', function ($row) {
                $admins = $row->admins()->get();
                $res = '<div class="table-admin-images" data-row-id="' . $row->id . '" >';
                foreach ($admins as $admin) {
                    $res .= '<img class="protip" data-pt-title="' . $admin->name . '" data-pt-scheme="black" src="' . asset($admin->getImageUrlAttribute()) . '" alt="">';
                }
                $companyUser = User::withoutGlobalScope(CompanyScope::class)->withoutGlobalScope('active')->where('company_id', $row->id)->first();
                $res .=  $companyUser->name . '</div>';
                return $res;
                //     
                //     <img src="' . asset("img/user-2.png") . '" alt="">
                //     <img src="' . asset("img/user-3.png") . '" alt="">
                //     <img src="' . asset("img/user-4.png") . '" alt=""></div>';
            })
            // ->editColumn('licence_expire_on', function ($row) {
            //     // return date_format(date_create($row->licence_expire_on), 'd-m-Y');
            //     return '<span class="flag-icon flag-icon-fr"></span>';
            // })
            // ->editColumn('sub_domain', function ($row) {
            //     return '<a href="http://' . $row->sub_domain . '" target="_blank">' . $row->sub_domain . '</a>';
            // })
            // ->editColumn('last_login', function ($row) {
            //     if ($row->last_login != null) {
            //         return $row->last_login->diffForHumans();
            //     }
            //     return '--';
            // })
            ->editColumn('package', function ($row) {
                // $package = '<div class="w-100 text-center">';
                // $package .= '<div class="m-b-5">' . ucwords($row->package->name) . ' (' . ucfirst($row->package_type) . ')' . '</div>';

                // $package .= '<a href="javascript:;" class="label label-custom package-update-button btn-outline btn-success"
                //       data-toggle="tooltip" data-company-id="' . $row->id . '" data-original-title="Change"><i class="fa fa-edit" aria-hidden="true"></i> ' . __('app.change') . '</a>';
                // $package .= '</div>';
                $city = explode('|', $row->address)[2];
                return $city;
            })
            ->addColumn('details', function ($row) {
                $companyUser = User::withoutGlobalScope(CompanyScope::class)->withoutGlobalScope('active')->where('company_id', $row->id)->first();

                if ($companyUser && $companyUser->email_verification_code == null) {
                    $verified = '<i class="fa fa-check-circle" style="color: green;"></i>';
                } else if ($companyUser && $companyUser->email_verification_code != null) {
                    $verified = '<i class="fa fa-times" style="color: red;"></i>';
                } else {
                    $verified = '-';
                }

                $registerDate = $row->created_at->format('d-m-Y');
                $totalUsers = User::withoutGlobalScope(CompanyScope::class)->withoutGlobalScope('active')->where('company_id', $row->id)->count();

                $string = "<ul class='p-l-20'>";
                $string .= '<li>' . __('modules.superadmin.verified') . ': ' . $verified . '</li>';
                $string .= '<li>' . __('modules.superadmin.registerDate') . ': ' . $registerDate . '</li>';
                $string .= '<li>' . __('modules.superadmin.totalUsers') . ': ' . $totalUsers . '</li>';
                $string .= '</ul>';

                return $row->company_phone;
            })
            ->rawColumns(['action', 'details', 'company_email', 'city', 'company_name', 'status', 'package', 'sub_domain'])
            ->make(true);
    }

    public function storeAndUpdate($company, $compannySubSetting, $request)
    {
        //TODO ce fichier à été modifier
        $company->company_name = $request->input('company_name');
        $company->company_email = $request->input('company_email');
        $company->company_phone = "+" . $request->input('company_phone_phoneCode') . " " . $request->input('company_phone');
        $company->address = $request->input('address') . '|' . $request->get('country') . '|' . $request->get('city');

        //        $company->timezone = $request->input('timezone');
        //        $company->website = $request->input('website');
        //        $company->locale = $request->input('locale');
        //        $company->status = $request->status;
        $company->status = 'active';
        $company->activity_field = $request->get('activity_sector');
        $company->siret = $request->get('siret');

        //TODO END

        if ($request->hasFile('logo')) {
            $company->logo = Files::upload($request->logo, 'app-logo');
        }

        $company->last_updated_by = $this->user->id;

        if (module_enabled('Subdomain')) {
            $company->sub_domain = $request->sub_domain;
        }

        $company->save();

        $compannySubSetting->mobile = "+" . $request->input('mobile_phoneCode') . " " . $request->input('mobile');
        $compannySubSetting->description = $request->input('description');
        $compannySubSetting->tva_intrat = $request->get('tva_intrat');
        $compannySubSetting->legal_form = $request->get('legal_form');
        $compannySubSetting->language_id = LanguageSetting::where('language_code', $request->get('language'))->get()[0]->id;
        $compannySubSetting->company_id = $company->id;
        $compannySubSetting->save();

        try {
            $this->updateExchangeRatesCompanyWise($company);
        } catch (\Exception $e) {
        }


        return $company;
    }

    public function verifyUser()
    {
        $userId = request('user_id');
        $user = User::withoutGlobalScope(CompanyScope::class)->withoutGlobalScope('active')->find($userId);
        User::emailVerify($user->email_verification_code);

        return Reply::success(__('messages.updateSuccess'));
    }

    public function loginAsCompany($companyId, Request $request)
    {
        //        DB::enableQueryLog();
        $admin = User::frontAllAdmins($companyId)->first();
        //        dd(DB::getQueryLog());
        if (!$admin) {
            return Reply::error(__('No admin found'));
        }
        //        return $admin;
        $user = user();
        //        return $user->role;
        session()->flush();
        session()->forget('user');
        //        $request->request->add(['email' => $admin->email,'password'=>$admin->password]);
        Auth::logout();
        session(['impersonate' => $user]);
        session(['impersonate_object' => $admin]);
        session(['user' => $admin]);

        Auth::login($admin);
        //        Auth::login($admin);
        //return auth()->user()->role;

        return Reply::success(__('messages.successfullyLoginAsCompany'));
    }
}
