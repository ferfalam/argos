<?php

namespace App\Http\Controllers\Admin;

use App\ClientDetails;
use App\Country;
use App\Contect;
use App\Designation;
use App\DataTables\Admin\ClientsDataTable;
use App\Helper\Reply;
use App\Http\Requests\Admin\Client\StoreClientRequest;
use App\Http\Requests\Admin\Client\UpdateClientRequest;
use App\Http\Requests\Gdpr\SaveConsentUserDataRequest;
use App\Invoice;
use App\Lead;
use App\LanguageSetting;
use App\Helper\Files;
use App\Notifications\NewUser;
use App\Payment;
use App\PurposeConsent;
use App\PurposeConsentUser;
use App\Role;
use App\Scopes\CompanyScope;
use App\UniversalSearch;
use App\User;
use App\Project;
use App\Contract;
use App\Notes;
use App\ContractType;
use App\ClientCategory;
use App\ClientSubCategory;
use App\CompanyTLA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;


class ManageClientsController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'app.menu.clients';
        $this->pageIcon = 'icon-people';
        $this->countries = Country::all();
        $this->tla = CompanyTLA::all();
        $this->middleware(function ($request, $next) {
            abort_if(!in_array('clients', $this->user->modules), 403);
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClientsDataTable $dataTable)
    {
        $this->clients = User::allClients();
        $this->totalClients = count($this->clients);
        $this->categories = ClientCategory::all();
        $this->projects = Project::all();
        $this->contracts = ContractType::all();
        $this->countries = Country::all();
        $this->subcategories = ClientSubCategory::all();
        return $dataTable->render('admin.clients.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($leadID = null)
    {
        if($leadID){
            $this->leadDetail = Lead::findOrFail($leadID);
            $this->leadName = $this->leadDetail->client_name;
            $this->firstName = '';
            $firstNameArray = ['mr','mrs','miss','dr','sir','madam'];
            $firstName = explode(' ', $this->leadDetail->client_name);
            if(isset($firstName[0]) && (array_search($firstName[0], $firstNameArray) !== false))
            {

                $this->firstName = $firstName[0];
                $this->leadName = str_replace($this->firstName, '', $this->leadDetail->client_name);
            }
            if($this->leadDetail->mobile){
                $this->code = explode(' ', $this->leadDetail->mobile);
                $this->mobileNo = str_replace($this->code[0], '', $this->leadDetail->mobile);
            }
        }


        $client = new ClientDetails();
        $this->categories = ClientCategory::all();
        $this->subcategories = ClientSubCategory::all();
        $this->fields = $client->getCustomFieldGroupsWithFields()->fields;
        $this->countries = Country::all();
        $this->contects  = Contect::where('client_detail_id',null)->where('supplier_detail_id',null)->where('spv_detail_id',null)->get();
        $this->designations = Designation::with('members', 'members.user')->get();


        if (request()->ajax()) {
            return view('admin.clients.ajax-create', $this->data);
        }
        
        return view('admin.clients.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        $isSuperadmin = User::withoutGlobalScopes(['active', CompanyScope::class])->where('super_admin', '1')->where('email', $request->input('email'))->get()->count();
        if ($isSuperadmin > 0) {
            return Reply::error(__('messages.superAdminExistWithMail'));
        }

        $existing_user = User::withoutGlobalScopes(['active', CompanyScope::class])->select('id', 'email')->where('email', $request->input('email'))->first();
        $new_code = Country::select('phonecode')->where('id', $request->p_mobile_phoneCode)->first();
        // if no user found create new user with random password
        // if (!$existing_user) {
            // $password = str_random(8);
            // create new user
                        // $user = new User();
                        // $user->name = $request->input('name');
                        // $user->email = $request->input('email');
                        // $user->password = Hash::make($request->input('password'));
                        // $user->mobile =  $request->p_mobile_phoneCode .' '.$request->input('p_mobile') ;
                        // $user->gender =   isset($request->gender) ? $request->input('gender'):'' ;
            // $user->tel =  $request->input('p_phone_phoneCode').' '.$request->input('p_phone');
                        // $user->email_notifications =  $request->input('emailNotification');
                        // $user->sms_notification	 =  $request->input('smsNotification');
                        // $user->language =  $request->input('language');
                        // $user->observation =  isset($request->observation)?$request->input('observation'):'';
                        // $user->city_id =  $request->input('city');
                        // $user->country_id =  $request->input('country');
                        // $user->address =  $request->input('address');
            // $user->fax =  $request->input('p_fax_phoneCode').' '.$request->input('p_fax');
                        // $user->function =  $request->input('function');
    
            
                        // if($request->input('locale') != ''){
                        //     $user->locale = $request->input('locale');
                        // }else{
                        //     $user->locale = company()->locale;
                        // }
                        
                        // if ($request->hasFile('image')) {
                        //     $user->image = Files::upload($request->image, 'avatar', 300);
                        // }

                        
                        // $user->save();
                        
            // attach role
                    // $role = Role::where('name', 'client')->first();
                    // $user->attachRole($role->id);
                    
                    
                    
                    // if ($request->has('lead')) {
                    //     $lead = Lead::findOrFail($request->lead);
                    //     $lead->client_id = $user->id;
                    //     $lead->save();
                    // }
        // }
       

        if($request->contact_principal == 'create'){
            $contact = new Contect();
            $contact->gender =  isset($request->gender) ? $request->input('gender'):'' ;
            $contact->name = $request->name;
            $contact->function = $request->function;
            $contact->email = $request->email;
            $contact->mobile =  $request->p_mobile_phoneCode .' '.$request->input('p_mobile') ;
            $contact->visibility = $request->visibility;
            $contact->contect_type = $request->contect_type;
            if ($request->hasFile('image')) {
              $contact->image = Files::upload($request->image, 'avatar', 300);
            }
            $contact->save();
        }

        $existing_client_count = ClientDetails::select('id', 'email', 'company_id')
            ->where(
                [
                    'email' => $request->input('email')
                ]
            )->count();

            $city = CompanyTLA::where('id',$request->input('city'))->first();

                  
        if ($existing_client_count === 0) {
            $client = new ClientDetails();
            $client->email = $request->input('company_email');
            $client->mobile = $request->mobile_phoneCode .' '.$request->input('mobile');
            $client->city =    $city->name;
            $client->city_id =    $city->id;
            $client->description =    $request->observation;
            $client->language =  $request->language;
            $client->country_id = $request->country;
            $client->category_id = ($request->input('category_id') != 0 && $request->input('category_id') != '') ? $request->input('category_id') : null;
            $client->sub_category_id = ($request->input('sub_category_id') != 0 && $request->input('sub_category_id') != '') ? $request->input('sub_category_id') : null;
            $client->company_name = $request->company_name;
            $client->address = $request->address;
            $client->shipping_address = $request->address;
            $client->tel =  $request->input('company_phone_phoneCode').' '.$request->input('company_phone');
            $client->fax =  $request->input('fax_phoneCode').' '.$request->input('fax');

            if ($request->has('emailNotification')) {
                $client->email_notifications = $request->emailNotification;
            }
            if ($request->has('smsNotification')) {
                $client->sms_notifications	 = $request->smsNotification;
            }

            if($request->contact_principal != 'create' && $request->contact_principal != 'without_user'){
                $contact = Contect::find($request->contact_principal);
            }
            
            if(isset($contact)){
                $client->contacts_id = $contact->id; 
            }
            $client->save();
            
            if(isset($contact)){
                $contact->client_detail_id = $client->id;
                $contact->contect_type = 'client';
                $contact->save();
            }

            

            // exit;
            
                // // attach role
                // if ($existing_user) {
                //     $role = Role::where('name', 'client')->where('company_id', $client->company_id)->first();
                //     $existing_user->attachRole($role->id);
                // }

                // // To add custom fields data
                // if ($request->get('custom_fields_data')) {
                //     $client->updateCustomFieldData($request->get('custom_fields_data'));
                // }

                // log search
                // if (!is_null($client->company_name)) {
                //     $user_id = $existing_user ? $existing_user->id : $user->id;
                //     $this->logSearchEntry($user_id, $client->company_name, 'admin.clients.edit', 'client');
                // }
            //log search
            // $this->logSearchEntry($client->id, $request->name, 'admin.clients.edit', 'client');
            // $this->logSearchEntry($client->id, $request->email, 'admin.clients.edit', 'client');
        } else {
            return Reply::error('Provided email is already registered. Try with different email.');
        }

        if (!$existing_user && $request->sendMail == 'yes') {
            //send welcome email notification
            $user->notify(new NewUser($user->password));
        }

        if ($request->has('ajax_create')) {
            $teams = User::allClients();
            $teamData = '';

            foreach ($teams as $team) {
                $teamData .= '<option value="' . $team->id . '"> ' . ucwords($team->name) . ' </option>';
            }

            return Reply::successWithData(__('messages.clientAdded'), ['teamData' => $teamData]);
        }

        return Reply::redirect(route('admin.clients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $user = DB::table('users')->where('id',$id)->get(); 

        // $this->client = User::findClient($id);
        $this->categories = ClientCategory::all();
        $this->subcategories = ClientSubCategory::all();
        $this->clientDetail = ClientDetails::where('id', '=', $id)->first();

        if($this->clientDetail->contacts_id != null){
            $this->contect = Contect::find($this->clientDetail->contacts_id);
        }

        $this->clientStats = $this->clientStats($id);
        $this->country = Country::where('id',$this->clientDetail->country_id)->first();
        $this->category = ClientCategory::where('id',$this->clientDetail->category_id)->first();
        $this->sub_category = ClientSubCategory::where('id',$this->clientDetail->sub_category_id)->first();
        $this->language = LanguageSetting::where('language_code',$this->clientDetail->language)->first();
        $this->email =  $this->clientDetail->email; 
        
        if (!is_null($this->clientDetail)) {
            $this->clientDetail = $this->clientDetail->withCustomFields();
            $this->fields = $this->clientDetail->getCustomFieldGroupsWithFields()->fields;
        }
        return view('admin.clients.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $this->userDetail = ClientDetails::join('contects', 'client_details.contects_id', '=', 'contects.id')
        //     ->where('client_details.id', $id)
        //     ->select('client_details.id','client_details.address', 'client_details.name', 'client_details.email', 'client_details.user_id', 'client_details.mobile', 'client_details.category_id', 'client_details.sub_category_id', 'client_details.tel','client_details.fax','contects.function', 'client_details.country_id','client_details.description','client_details.email_notifications' ,'client_details.sms_notifications', 'client_details.city_id','contects.gender','client_details.language', 'client_details.contects_id' )
        //     ->first();
        
        
        $this->clientDetail = ClientDetails::where('id', '=', $id)->first();

        if (!is_null($this->clientDetail)) {
            $this->clientDetail = $this->clientDetail->withCustomFields();
            $this->fields = $this->clientDetail->getCustomFieldGroupsWithFields()->fields;
        }
        $this->clientWebsite = $this->websiteCheck($this->clientDetail->website);

        $this->countries = Country::all();
        $this->categories = ClientCategory::all();
        $this->subcategories = ClientSubCategory::all();
        $this->contects  = Contect::where('client_detail_id',$id)->get();

        $this->freeContacts = Contect::where('client_detail_id',null)->where('supplier_detail_id',null)->where('spv_detail_id',null)->get();

        $this->designations = Designation::with('members', 'members.user')->get();


        return view('admin.clients.edit', $this->data);
    }

    public function websiteCheck($email)
    {
        $clientWebsite = $email;

        if (strpos($email, 'http://') !== false)
        {
            $clientWebsite = str_replace('http://', '', $email);
            if(strpos($clientWebsite, 'http://') !== false){
                $clientWebsite = str_replace('http://', '', $clientWebsite);
            }
        }
        if (strpos($email, 'https://') !== false) {
            $clientWebsite = str_replace('https://', '', $email);
            if (strpos($clientWebsite, 'https://') !== false) {
                $clientWebsite = str_replace('https://', '', $clientWebsite);
            }
        }

        return $clientWebsite;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, $id)
    {
        // echo "<pre>";
        // print_r($request->all());
        // exit;

        // if($request->contact_principal == 'create'){
        //     $contact = new Contect();
        //     $contact->gender =  isset($request->gender) ? $request->input('gender'):'' ;
        //     $contact->name = $request->name;
        //     $contact->function = $request->function;
        //     $contact->email = $request->email;
        //     $contact->mobile =  $request->p_mobile_phoneCode .' '.$request->input('p_mobile') ;
        //     $contact->visibility = $request->visibility;
        //     $contact->contect_type = $request->contect_type;
        //     if ($request->hasFile('image')) {
        //       $contact->image = Files::upload($request->image, 'avatar', 300);
        //     }
        //     $contact->save();
        // }

        $new_code = Country::select('phonecode')->where('id', $request->phone_code)->first();
        $client = ClientDetails::find($id);

        $city = CompanyTLA::where('id',$request->input('city'))->first();

        $client->company_name = $request->company_name;
        // $client->name = $request->name;
        $client->email = $request->company_email;
        $client->mobile =   $request->mobile_phoneCode .' '.$request->mobile;
        $client->tel =  $request->company_phone_phoneCode.' '.$request->company_phone;
        $client->fax =  $request->fax_phoneCode.' '.$request->fax;
        $client->country_id = $request->country;
        $client->address = $request->address;
        $client->city = $city->name;
        $client->city_id =    $city->id;
        $client->description =    $request->observation;
        $client->language =  $request->language;
        $client->category_id = ($request->input('category_id') != 0 && $request->input('category_id') != '') ? $request->input('category_id') : null;
        $client->sub_category_id = ($request->input('sub_category_id') != 0 && $request->input('sub_category_id') != '') ? $request->input('sub_category_id') : null;
        $client->shipping_address = $request->address;
        // if($request->contact_principal == 'select'){
        //     $client->contacts_id = $request->contact;
        // }

            if(!$request->contact_principal){
                $client->contacts_id = null;
            }else{
                 $contact = Contect::find($request->contact_principal);
                 $contact->client_detail_id = $client->id;
                 $contact->contect_type = 'client';
                 $contact->save();
            }

        if(isset($contact)){
            $client->contacts_id = $contact->id; 
        }        

        if ($request->has('emailNotification')) {
            $client->email_notifications = $request->emailNotification;
        }
        if ($request->has('smsNotification')) {
            $client->sms_notifications   = $request->smsNotification;
        }
        $client->save();

        // $user = User::withoutGlobalScope('active')->findOrFail($client->user_id);
        // $user->name = $request->input('name');
        // $user->email = $request->input('email');
        // $user->observation =  isset($request->observation)?$request->input('observation'):'';
        // $user->mobile =  $request->p_mobile_phoneCode .' '.$request->input('p_mobile') ;
        // $user->gender =   isset($request->gender) ? $request->input('gender'):'' ;
        // $user->tel =  $request->input('p_phone_phoneCode').' '.$request->input('p_phone');
        // $user->email_notifications =  $request->input('emailNotification');
        // $user->sms_notification	 =  $request->input('smsNotification');
        // $user->language =  $request->input('language');
        // $user->city_id =  $request->input('city');
        // $user->country_id =  $request->input('country');
        // $user->address =  $request->input('address');
        // $user->fax =  $request->input('p_fax_phoneCode').' '.$request->input('p_fax');
        // $user->function =  $request->input('function');
    


        // if ($request->password != '') {
        //     $user->password = Hash::make($request->input('password'));
        // }
        // if ($request->hasFile('image')) {
          
        //     $user->image = Files::upload($request->image, 'avatar', 300);
        // }

        // $user->save();
        
        // // To add custom fields data
        // if ($request->get('custom_fields_data')) {
        //     $client->updateCustomFieldData($request->get('custom_fields_data'));
        // }

        // $user = User::withoutGlobalScopes(['active', CompanyScope::class])->findOrFail($client->user_id);

        // if ($request->password != '') {
        //     $user->password = Hash::make($request->input('password'));
        // }
        // $user->locale = $request->locale;
        // $user->save();

        return Reply::redirect(route('admin.clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $clients_count = ClientDetails::withoutGlobalScope(CompanyScope::class)->where('id', $id)->count();
        if ($clients_count > 1) {
            $client_builder = ClientDetails::where('id', $id);
            $client = $client_builder->first();

            $user_builder = User::where('id', $id);
            $user = $user_builder->first();
            if ($user && !is_null($client)) {
                    $other_client = $client_builder->withoutGlobalScope(CompanyScope::class)
                        ->where('company_id', '!=', $client->company_id)
                        ->first();
                if(!is_null($other_client)){
                    request()->request->add(['company_id' => $other_client->company_id]);

                    $user->save();
                }

            }
            $role = Role::where('name', 'client')->first();
            $user_role = $user_builder->withoutGlobalScope(CompanyScope::class)->first();
            $user_role->detachRoles([$role->id]);
            $universalSearches = UniversalSearch::where('searchable_id', $id)->where('module_type', 'client')->get();
            if ($universalSearches) {
                foreach ($universalSearches as $universalSearch) {
                    UniversalSearch::destroy($universalSearch->id);
                }
            }
            $client->delete();
        } else {
            $client = ClientDetails::where('id', $id)->first();
            $client->delete();
            $universalSearches = UniversalSearch::where('searchable_id', $id)->where('module_type', 'client')->get();
            if ($universalSearches) {
                foreach ($universalSearches as $universalSearch) {
                    UniversalSearch::destroy($universalSearch->id);
                }
            }
            // $userRoles = User::withoutGlobalScopes([CompanyScope::class, 'active'])->where('id', $id)->first()->role->count();
            // if($userRoles > 1){
            //     $role = Role::where('name', 'client')->first();
            //     $client_role = User::withoutGlobalScopes([CompanyScope::class, 'active'])->where('id', $id)->first();
            //     $client_role->detachRoles([$role->id]);
            //     ClientDetails::withoutGlobalScope(CompanyScope::class)->where('id', $id)->delete();
            // }
            // else{
            //     User::withoutGlobalScopes([CompanyScope::class, 'active'])->where('id', $id)->delete($id);
            // }
        }
        DB::commit();
        return Reply::success(__('messages.clientDeleted'));
    }

    public function showProjects($id)
    {
        // $this->client = User::findClient($id);

        // if (!$this->client) {
        //     abort(404);
        // }
            
        $this->clientDetail = ClientDetails::where('id', '=', $id)->with('projects')->first();
        // dd($this->clientDetail);

       
        $this->clientStats = $this->clientStats($id);

        if (!is_null($this->clientDetail)) {
            $this->clientDetail = $this->clientDetail->withCustomFields();
            $this->fields = $this->clientDetail->getCustomFieldGroupsWithFields()->fields;
        }

        return view('admin.clients.projects', $this->data);
    }

    public function showInvoices($id)
    {
        // $this->client = User::findClient($id);

        // if (!$this->client) {
        //     abort(404);
        // }

        $this->clientDetail = ClientDetails::where('id', '=', $id)->firstOrFail();
        $this->clientStats = $this->clientStats($id);

        if (!is_null($this->clientDetail)) {
            $this->clientDetail = $this->clientDetail->withCustomFields();
            $this->fields = $this->clientDetail->getCustomFieldGroupsWithFields()->fields;
        }

        $this->invoices = Invoice::selectRaw('invoices.invoice_number, invoices.total, invoices.sub_total, invoices.sell_type, invoices.status, invoices.issue_date, invoices.id, projects.project_name ')
            ->leftJoin('projects', 'projects.id', '=', 'invoices.project_id')
            ->where(function ($query) use ($id) {
                $query->where('projects.client_id', $id)
                    ->orWhere('invoices.client_detail_id', $id);
            })
            ->get();

            // dd($this->invoices);
        return view('admin.clients.invoices', $this->data);
    }

    public function showPayments($id)
    {
        // $this->client = User::findClient($id);
        $this->clientDetail = ClientDetails::where('id', '=', $id)->first();
        $this->clientStats = $this->clientStats($id);

        if (!is_null($this->clientDetail)) {
            $this->clientDetail = $this->clientDetail->withCustomFields();
            $this->fields = $this->clientDetail->getCustomFieldGroupsWithFields()->fields;
        }

        $this->payments = Payment::
            // with(['project:id,project_name', 'currency:id,currency_symbol,currency_code', 'invoice'])
            // ->leftJoin('invoices', 'invoices.id', '=', 'payments.invoice_id')
            // ->leftJoin('projects', 'projects.id', '=', 'payments.project_id')
            select('payments.id', 'payments.project_id', 'payments.currency_id', 'payments.invoice_id', 'payments.amount', 'payments.gateway', 'payments.due_date')
            // ->where('payments.status', '=', 'complete')
            ->where(function ($query) use ($id) {
                $query
                    // ->where('projects.client_id', $id)
                    ->where('payments.customer_id', $id);
            })
            ->orderBy('payments.id', 'desc')
            ->get();
        return view('admin.clients.payments', $this->data);
    }

    // public function showNotes($id){
    //     $this->clients = User::allClients();
    //     $this->employees = User::allEmployees();

    //     $this->notes = Notes::where('client_id',$id)->get();
    //      $this->client = User::findClient($id);
    //     $this->clientDetail = ClientDetails::where('user_id', '=', $this->client->id)->first();
    //     $this->clientStats = $this->clientStats($id);

    //     return view('admin.clients.notes', $this->data);
    // }

    public function gdpr($id)
    {
        $this->client = User::findClient($id);
        $this->categories = ClientCategory::all();
        $this->subcategories = ClientSubCategory::all();
        $this->clientDetail = ClientDetails::where('user_id', '=', $this->client->id)->first();
        $this->clientStats = $this->clientStats($id);
        $this->allConsents = PurposeConsent::with(['user' => function ($query) use ($id) {
            $query->where('client_id', $id)
                ->orderBy('created_at', 'desc');
        }])->get();

        return view('admin.clients.gdpr', $this->data);
    }

    public function consentPurposeData($id)
    {
        $purpose = PurposeConsentUser::select('purpose_consent.name', 'purpose_consent_users.created_at', 'purpose_consent_users.status', 'purpose_consent_users.ip', 'users.name as username', 'purpose_consent_users.additional_description')
            ->join('purpose_consent', 'purpose_consent.id', '=', 'purpose_consent_users.purpose_consent_id')
            ->leftJoin('users', 'purpose_consent_users.updated_by_id', '=', 'users.id')
            ->where('purpose_consent_users.client_id', $id);

        return DataTables::of($purpose)
            ->editColumn('status', function ($row) {
                if ($row->status == 'agree') {
                    $status = __('modules.gdpr.optIn');
                } else if ($row->status == 'disagree') {
                    $status = __('modules.gdpr.optOut');
                } else {
                    $status = '';
                }

                return $status;
            })
            ->editColumn('created_at', function ($row) {
            
                return $row->created_at->format($this->global->date_format);
            })
            ->make(true);
    }

    public function saveConsentLeadData(SaveConsentUserDataRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $consent = PurposeConsent::findOrFail($request->consent_id);

        if ($request->consent_description && $request->consent_description != '') {
            $consent->description = $request->consent_description;
            $consent->save();
        }

        // Saving Consent Data
        $newConsentLead = new PurposeConsentUser();
        $newConsentLead->client_id = $user->id;
        $newConsentLead->purpose_consent_id = $consent->id;
        $newConsentLead->status = trim($request->status);
        $newConsentLead->ip = $request->ip();
        $newConsentLead->updated_by_id = $this->user->id;
        $newConsentLead->additional_description = $request->additional_description;
        $newConsentLead->save();

        $url = route('admin.clients.gdpr', $user->id);

        return Reply::redirect($url);
    }

    public function clientStats($id)
    {
        return DB::table('users')
            ->select(
                DB::raw('(select count(projects.id) from `projects` WHERE projects.client_id = ' . $id . ' and projects.company_id = ' . company()->id . ') as totalProjects'),
                DB::raw('(select sum(invoices.total) from `invoices` left join projects on projects.id=invoices.project_id WHERE invoices.status != "paid" and invoices.status != "canceled" and (projects.client_id = ' . $id . ' or invoices.client_id = ' . $id . ') and invoices.company_id = ' . company()->id . ') as totalUnpaidInvoices'),
                DB::raw('(select sum(payments.amount) from `payments` left join projects on projects.id=payments.project_id left join invoices on invoices.id= payments.invoice_id
                WHERE payments.status = "complete" and (projects.client_id = ' . $id . ' or  invoices.client_id = ' . $id. ' )and payments.company_id = ' . company()->id . ') as projectPayments'),


                // DB::raw('(select sum(payments.amount) from `payments` inner join invoices on invoices.id=payments.invoice_id  WHERE payments.status = "complete" and invoices.client_id = ' . $id . ' and payments.company_id = ' . company()->id . ') as invoicePayments'),


                DB::raw('(select count(contracts.id) from `contracts` WHERE contracts.client_id = ' . $id . ' and contracts.company_id = ' . company()->id . ') as totalContracts')
            )
            ->first();
    }

    public function getSubcategory(Request $request)
    {
        $this->subcategories = ClientSubCategory::where('category_id', $request->cat_id)->get();

        return Reply::dataOnly(['subcategory' => $this->subcategories]);
    }

}
