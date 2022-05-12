<?php

namespace App\Http\Controllers\Admin;

use App\SupplierDetails;
use App\ClientDetails;
use App\Country;
use App\Contect;
use App\Designation;
use App\Helper\Reply;
use App\Http\Requests\Admin\Supplier\StoreSupplierRequest;
use App\Http\Requests\Admin\Supplier\UpdateSupplierRequest;
use App\Invoice;
use App\Lead;
use App\LanguageSetting;
use App\Helper\Files;
use App\Notifications\NewUser;
use App\Payment;
use App\Role;
use App\Scopes\CompanyScope;
use App\UniversalSearch;
use App\User;
use App\Project;
use App\ContractType;
use App\ClientCategory;
use App\ClientSubCategory;
use App\CompanyTLA;
use App\DataTables\Admin\SupplierDataTable;
use App\SupplierCategory;
use App\SupplierSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSuppliersController extends AdminBaseController
{

  public function __construct()
  {
    parent::__construct();
    $this->pageTitle = 'app.menu.suppliers';
    $this->pageIcon = 'icon-people';
    $this->countries = Country::orderBy('name')->get();
    $this->tla = CompanyTLA::orderBy('name')->get();
    $this->middleware(function ($request, $next) {
        abort_if(!in_array('tiers.fournisseurs', $this->user->modules), 403);
        return $next($request);
    });
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(SupplierDataTable $dataTable)
  {

        $this->clients = User::allSuppliers();
        $this->totalClients = count($this->clients);
        $this->categories = SupplierCategory::orderBy('category_name')->get();;
        $this->projects = Project::orderBy('project_name')->get();
        $this->contracts = ContractType::orderBy('name')->get();;
        $this->countries = Country::orderBy('name')->get();
        $this->subcategories = SupplierSubCategory::orderBy('category_name')->get();;
        return $dataTable->render('admin.suppliers.index', $this->data);
  }

  public function create($leadID = null){
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

      $client = new SupplierDetails();
      $this->categories = SupplierCategory::orderBy('category_name')->get();;
      $this->subcategories = SupplierSubCategory::orderBy('category_name')->get();;
      //$this->fields = $client->getCustomFieldGroupsWithFields()->fields;  
      $this->countries = Country::orderBy('name')->get();
      $this->contects  = Contect::where('client_detail_id',null)->where('supplier_detail_id',null)->where('spv_detail_id',null)->get();
      $this->designations = Designation::with('members', 'members.user')->get();

      if (request()->ajax()) {
          return view('admin.suppliers.ajax-create', $this->data);
      }
      return view('admin.suppliers.create', $this->data);
  }

  public function store(StoreSupplierRequest $request)
    {
        $isSuperadmin = User::withoutGlobalScopes(['active', CompanyScope::class])->where('super_admin', '1')->where('email', $request->input('email'))->get()->count();
        if ($isSuperadmin > 0) {
            return Reply::error(__('messages.superAdminExistWithMail'));
        }

        $existing_user = User::withoutGlobalScopes(['active', CompanyScope::class])->select('id', 'email')->where('email', $request->input('email'))->first();
        $new_code = Country::select('phonecode')->where('id', $request->p_mobile_phoneCode)->first();
        // if no user found create new user with random password
        // if (!$existing_user) {
        //     // $password = str_random(8);
        //     // create new user
        //     $user = new User();
        //     $user->name = $request->input('name');
        //     $user->email = $request->input('email');
        //     $user->password = Hash::make($request->input('password'));
        //     $user->mobile =  $request->p_mobile_phoneCode .' '.$request->input('p_mobile') ;
        //     $user->gender =   isset($request->gender) ? $request->input('gender'):'' ;
        //     $user->tel =  $request->input('p_phone_phoneCode').' '.$request->input('p_phone');
        //     $user->email_notifications =  $request->input('emailNotification');
        //     $user->sms_notification	 =  $request->input('smsNotification');
        //     $user->language =  $request->input('language');
        //     $user->observation =  isset($request->observation)?$request->input('observation'):'';
        //     $user->city_id =  $request->input('city');
        //     $user->country_id =  $request->input('country');
        //     $user->address =  $request->input('address');
        //     $user->fax =  $request->input('p_fax_phoneCode').' '.$request->input('p_fax');
        //     $user->function =  $request->input('function');
    
            
        //     if($request->input('locale') != ''){
        //         $user->locale = $request->input('locale');
        //     }else{
        //         $user->locale = company()->locale;
        //     }
            
        //     if ($request->hasFile('image')) {
        //         $user->image = Files::upload($request->image, 'avatar', 300);
        //     }

            
        //     $user->save();
            
        //     // attach role
        //     $role = Role::where('name', 'supplier')->first();
        //     $user->attachRole($role->id);
            
            
            
        //     if ($request->has('lead')) {
        //         $lead = Lead::findOrFail($request->lead);
        //         $lead->client_id = $user->id;
        //         $lead->save();
        //     }
        // }
       
        if($request->contact_principal == 'create'){
            $contact = new Contect();
            $contact->gender =  isset($request->gender) ? $request->input('gender'):'' ;
            $contact->name = $request->name;
            $contact->function = $request->function;
            $contact->email = $request->email;
            $contact->mobile =  $request->p_mobile_phoneCode .' '.$request->input('p_mobile');
            $contact->visibility = $request->visible_by == "" ? "" : json_encode($request->visible_by);
            if ($request->all) {
                $contact->visibility = "all";
            }
            $contact->contect_type = $request->contect_type;
            if($request->hasFile('image')) {
              $contact->image = Files::upload($request->image, 'avatar', 300);
            }
            $contact->save();
        }

        
        $existing_client_count = SupplierDetails::select('id', 'email', 'company_id')
            ->where(
                [
                    'email' => $request->input('email')
                ]
            )->count();

            $city = CompanyTLA::where('id',$request->input('city'))->first();

            
        if($existing_client_count === 0) {
            $supplier = new SupplierDetails();
            // $supplier->name = $request->salutation.' '.$request->input('name');
            $supplier->email = $request->input('company_email');
            $supplier->mobile = $request->mobile_phoneCode .' '.$request->input('mobile');
            $supplier->city =    $city->name;
            $supplier->city_id =    $city->id;
            $supplier->description =    $request->observation;
            $supplier->language =  $request->language;
            $supplier->country_id = $request->country;
            $supplier->category_id = ($request->input('category_id') != 0 && $request->input('category_id') != '') ? $request->input('category_id') : null;
            $supplier->sub_category_id = ($request->input('sub_category_id') != 0 && $request->input('sub_category_id') != '') ? $request->input('sub_category_id') : null;
            $supplier->company_name = $request->company_name;
            $supplier->address = $request->address;
            $supplier->tel =  $request->input('company_phone_phoneCode').' '.$request->input('company_phone');
            $supplier->fax =  $request->input('fax_phoneCode').' '.$request->input('fax');
            
            if ($request->has('emailNotification')) {
                $supplier->email_notifications = $request->emailNotification;
            }
            if ($request->has('smsNotification')) {
                $supplier->sms_notifications	 = $request->smsNotification;
            }
           
            if($request->contact_principal != 'create' && $request->contact_principal != 'without_user'){
                $contact = Contect::find($request->contact_principal);
            }
            
            if(isset($contact)){
                $supplier->contacts_id = $contact->id; 
            }
            $supplier->save();

            if(isset($contact)){
                $contact->supplier_detail_id = $supplier->id;
                $contact->contect_type = 'supplier';
                $contact->save();
            }
            
            // attach role
            // if ($existing_user) {
            //     $role = Role::where('name', 'client')->where('company_id', $supplier->company_id)->first();
            //     $existing_user->attachRole($role->id);
            // }

              // log search
            //   if (!is_null($supplier->company_name)) {
            //     $user_id = $existing_user ? $existing_user->id : $user->id;
            //     $this->logSearchEntry($user_id, $supplier->company_name, 'admin.suppliers.edit', 'client');
            // }
            //log search
            // $this->logSearchEntry($supplier->id, $request->name, 'admin.suppliers.edit', 'client');
            // $this->logSearchEntry($supplier->id, $request->email, 'admin.suppliers.edit', 'client');

        } else {
            return Reply::error('Provided email is already registered. Try with different email.');
        }

        if (!$existing_user && $request->sendMail == 'yes') {
            //send welcome email notification
            $user->notify(new NewUser($user->password));
        }

        if ($request->has('ajax_create')) {
            $teams = User::allSuppliers();
            $teamData = '';

            foreach ($teams as $team) {
                $teamData .= '<option value="' . $team->id . '"> ' . ucwords($team->name) . ' </option>';
            }

            return Reply::successWithData(__('messages.SupplierAdded'), ['teamData' => $teamData]);
        }

        return Reply::redirect(route('admin.suppliers.index'));
    }


  public function edit($id){
     // $this->userDetail = SupplierDetails::join('users', 'supplier_details.user_id', '=', 'users.id')
    //         ->where('supplier_details.id', $id)
    //         ->select('supplier_details.id','supplier_details.address', 'supplier_details.name', 'supplier_details.email', 'supplier_details.user_id', 'supplier_details.mobile', 'supplier_details.category_id', 'supplier_details.sub_category_id', 'supplier_details.tel','supplier_details.fax', 'users.locale','users.function', 'users.status', 'users.login','users.country_id','users.observation','users.email_notifications' ,'users.sms_notification', 'users.city_id','users.gender','users.language', 'users.email as userEmail','users.mobile as userMoblie','users.id as userId','users.tel as userTel','users.fax as userFax' )
    //         ->first();

    $this->supplierDetail = SupplierDetails::where('id', '=', $id)->first();
    $this->countries = Country::orderBy('name')->get();
    $this->categories = SupplierCategory::orderBy('category_name')->get();;
    $this->subcategories = SupplierSubCategory::orderBy('category_name')->get();;
    $this->contects  = Contect::where('supplier_detail_id',$id)->get();

    $this->freeContacts = Contect::where('client_detail_id',null)->where('supplier_detail_id',null)->where('spv_detail_id',null)->get();

    $this->designations = Designation::with('members', 'members.user')->get();
    
    return view('admin.suppliers.edit', $this->data);    
  }

    public function show($id)
    {
        // $user = DB::table('users')->where('id',$id)->get(); 

        // $this->client = User::findClient($id);
        $this->categories = SupplierCategory::orderBy('category_name')->get();;
        $this->subcategories = SupplierSubCategory::orderBy('category_name')->get();;
        $this->supplierDetail = SupplierDetails::where('id', '=', $id)->first();

        if($this->supplierDetail->contacts_id != null){
            $this->contect = Contect::find($this->supplierDetail->contacts_id);
        }

        
        $this->clientStats = $this->clientStats($id);
        $this->country = Country::where('id',$this->supplierDetail->country_id)->first();
        $this->category = SupplierCategory::where('id',$this->supplierDetail->category_id)->first();
        $this->sub_category = SupplierSubCategory::where('id',$this->supplierDetail->sub_category_id)->first();
        $this->language = LanguageSetting::where('language_code',$this->supplierDetail->language)->first();
        $this->email = $this->supplierDetail->email; 
        // exit;
        
        // if (!is_null($this->clientDetail)) {
        //     $this->clientDetail = $this->clientDetail->withCustomFields();
        //     $this->fields = $this->clientDetail->getCustomFieldGroupsWithFields()->fields;
        // }
        return view('admin.suppliers.show', $this->data);
    }

    public function clientStats($id)
    {
        return DB::table('users')
            ->select(
                DB::raw('(select count(projects.id) from `projects` WHERE projects.client_id = ' . $id . ' and projects.company_id = ' . company()->id . ') as totalProjects'),
                DB::raw('(select sum(invoices.total) from `invoices` WHERE invoices.supplier_detail_id = ' . $id . ' and invoices.company_id = ' . company()->id . ') as totalUnpaidInvoices'),
                DB::raw('(select sum(payments.amount) from `payments` WHERE payments.customer_id = ' . $id. ' and payments.company_id = ' . company()->id . ') as projectPayments'),


                // DB::raw('(select sum(payments.amount) from `payments` inner join invoices on invoices.id=payments.invoice_id  WHERE payments.status = "complete" and invoices.client_id = ' . $id . ' and payments.company_id = ' . company()->id . ') as invoicePayments'),


                DB::raw('(select count(contracts.id) from `contracts` WHERE contracts.supplier_detail_id = ' . $id . ' and contracts.company_id = ' . company()->id . ') as totalContracts')
            )
        ->first();
    }

    public function update(UpdateSupplierRequest $request, $id)
    {
        $new_code = Country::select('phonecode')->where('id', $request->mobile_phoneCode)->first();
        $supplier = SupplierDetails::find($id);

        $city = CompanyTLA::where('id',$request->input('city'))->first();

        $supplier->company_name = $request->company_name;
        $supplier->email = $request->input('company_email');
        $supplier->mobile =   $request->mobile_phoneCode .' '.$request->input('mobile');
        $supplier->tel =  $request->input('company_phone_phoneCode').' '.$request->input('company_phone');
        $supplier->fax =  $request->input('fax_phoneCode').' '.$request->input('fax');
        $supplier->country_id = $request->input('country');
        $supplier->address = $request->address;
        $supplier->city = $city->name;
        $supplier->city_id = $city->id;
        $supplier->description =    $request->observation;
        $supplier->language =  $request->language;
        $supplier->category_id = ($request->input('category_id') != 0 && $request->input('category_id') != '') ? $request->input('category_id') : null;
        $supplier->sub_category_id = ($request->input('sub_category_id') != 0 && $request->input('sub_category_id') != '') ? $request->input('sub_category_id') : null;
       
        // if($request->contact_principal == 'select'){
        //     $supplier->contacts_id = $request->contact;
        // }

        if($request->contact_principal == 'without_user'){
            $supplier->contacts_id = null;
        }else{
            $contact = Contect::find($request->contact_principal);
            $contact->supplier_detail_id = $supplier->id;
            $contact->contect_type = 'supplier';
            $contact->save();
        }

        
        if(isset($contact)){
            $supplier->contacts_id = $contact->id; 
        } 

        if ($request->has('emailNotification')) {
            $supplier->email_notifications = $request->emailNotification;
        }
        if ($request->has('smsNotification')) {
            $supplier->sms_notifications   = $request->smsNotification;
        }
        $supplier->save();

       
        
        // To add custom fields data
       
        // if ($request->get('custom_fields_data')) {
        //     $client->updateCustomFieldData($request->get('custom_fields_data'));
        // }

        // $user = User::withoutGlobalScopes(['active', CompanyScope::class])->findOrFail($client->user_id);

        // if ($request->password != '') {
        //     $user->password = Hash::make($request->input('password'));
        // }
        // $user->locale = $request->locale;
        // $user->save();

        return Reply::redirect(route('admin.suppliers.index'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        $clients_count = SupplierDetails::withoutGlobalScope(CompanyScope::class)->where('user_id', $id)->count();
        if ($clients_count > 1) {
            $client_builder = SupplierDetails::where('user_id', $id);
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
            $role = Role::where('name', 'supplier')->first();
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
            // $client = ClientDetails::where('user_id', $id)->first();
            // $client->delete();
            $universalSearches = UniversalSearch::where('searchable_id', $id)->where('module_type', 'client')->get();
            if ($universalSearches) {
                foreach ($universalSearches as $universalSearch) {
                    UniversalSearch::destroy($universalSearch->id);
                }
            // }
            //  $userRoles = User::withoutGlobalScopes([CompanyScope::class, 'active'])->where('id', $id)->first()->role->count();
            // if($userRoles > 1){
            //     $role = Role::where('name', 'supplier')->first();
            //     $client_role = User::withoutGlobalScopes([CompanyScope::class, 'active'])->where('id', $id)->first();
            //     $client_role->detachRoles([$role->id]);
                SupplierDetails::withoutGlobalScope(CompanyScope::class)->where('id', $id)->delete();
            }
            else{
                User::withoutGlobalScopes([CompanyScope::class, 'active'])->where('id', $id)->delete($id);
            }
        }
        DB::commit();
        return Reply::success(__('messages.supplierDeleted'));
    }


    public function showContacts($id){
        // $this->client = User::findClient($id);
        $this->supplierDetail = SupplierDetails::where('id', '=', $id)->first();
        $this->clientStats = $this->clientStats($id);

        if (!is_null($this->supplierDetail)) {
            $this->supplierDetail = $this->supplierDetail->withCustomFields();
        }

        return view('admin.supplier-contacts.show', $this->data);
    }

    public function showContracts($id)
    {
        // $this->client = User::findClient($id);

        // if (!$this->client) {
        //     abort(404);
        // }
            
        $this->supplierDetail = SupplierDetails::where('id', '=', $id)->with('SupplierProjects')->first();
        // dd($this->clientDetail);

        
        $this->clientStats = $this->clientStats($id);

        if (!is_null($this->supplierDetail)) {
            $this->supplierDetail = $this->supplierDetail->withCustomFields();
            // $this->fields = $this->clientDetail->getCustomFieldGroupsWithFields()->fields;
        }

        return view('admin.suppliers.contracts', $this->data);
    }


    public function showProjects($id)
    {
        // $this->client = User::findClient($id);

        // if (!$this->client) {
        //     abort(404);
        // }

        $this->supplierDetail = SupplierDetails::where('id', '=', $id)->with('SupplierProjects')->first();

       
        $this->clientStats = $this->clientStats($id);

        if (!is_null($this->supplierDetail)) {
            $this->supplierDetail = $this->supplierDetail->withCustomFields();
            // $this->fields = $this->supplierDetail->getCustomFieldGroupsWithFields()->fields;
        }

        return view('admin.suppliers.projects', $this->data);
    }


    public function showInvoices($id)
    {
        // $this->client = User::findClient($id);

        // if (!$this->client){
        //     abort(404);
        // }

        $this->supplierDetail = SupplierDetails::where('id', '=', $id)->first();
        $this->clientStats = $this->clientStats($id);

        if (!is_null($this->supplierDetail)) {
            $this->supplierDetail = $this->supplierDetail->withCustomFields();
            // $this->fields = $this->supplierDetails->getCustomFieldGroupsWithFields()->fields;
        }

        $this->invoices = Invoice::selectRaw('invoices.*')
            ->where(function ($query) use ($id) {
                $query->Where('invoices.supplier_detail_id', $id);
            })
            ->get();


        return view('admin.suppliers.invoices', $this->data);
    }

    public function showPayments($id){
        
        $this->supplierDetail = SupplierDetails::where('id', '=', $id)->first();
        $this->clientStats = $this->clientStats($id);

        if (!is_null($this->supplierDetail)) {
            $this->supplierDetail = $this->supplierDetail->withCustomFields();
            // $this->fields = $this->SupplierDetail->getCustomFieldGroupsWithFields()->fields;
        }

        $this->payments = Payment::select('payments.*')
            ->where('payments.customer_id', '=', $id)
            // ->where(function ($query) use ($id) {
            //     $query->where('projects.client_id', $id)
            //         ->orWhere('invoices.client_id', $id);
            // })
            ->orderBy('payments.id', 'desc')
            ->get();
        return view('admin.suppliers.payments', $this->data);
    }

    public function getSubcategory(Request $request)
    {
        $this->subcategories = SupplierSubCategory::where('category_id', $request->cat_id)->get();

        return Reply::dataOnly(['subcategory' => $this->subcategories]);
    }
}   
