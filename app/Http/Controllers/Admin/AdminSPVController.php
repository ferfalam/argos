<?php

namespace App\Http\Controllers\Admin;

use App\ClientCategory;
use App\ClientContact;
use App\ClientDetails;
use App\SpvDetails;
use App\Contect;
use App\ClientDocs;
use App\ClientSubCategory;
use App\CompanyTLA;
use App\ContractType;
use App\Country;
use App\Helper\Files;
use App\Helper\Reply;
use App\Http\Requests\Gdpr\SaveConsentUserDataRequest;
use App\DataTables\Admin\SpvDataTable;
use App\Invoice;
use App\LanguageSetting;
use App\Notes;
use App\SpvUserNotes;
use App\SpvDocs;
use App\Payment;
use App\Project;
use App\PurposeConsent;
use App\PurposeConsentUser;
use App\Role;
use App\Designation;
use App\Scopes\CompanyScope;
use App\UniversalSearch;
use App\User;
use Craftsys\Msg91\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\Spv\StoreSpvRequest;
use App\Http\Requests\Admin\Spv\UpdateSpvRequest;
use App\Http\Requests\ProjectNotes\StoreNotes;
use App\Http\Requests\ProjectNotes\UpdateNotes;
use App\Lead;
use App\SpvCategory;
use App\SpvSubCategory;

class AdminSPVController extends AdminBaseController
{

  public function __construct()
  {
    parent::__construct();
    $this->pageTitle = 'app.menu.spv';
    $this->pageIcon = 'icon-people';
    $this->clients = User::allSpv();
    $this->totalClients = count($this->clients);
    $this->categories = SpvCategory::orderBy('category_name')->get();
    $this->projects = Project::orderBy('project_name')->get();
    $this->contracts = ContractType::orderBy('name')->get();
    $this->countries = Country::orderBy('name')->get();
    $this->subcategories = SpvSubCategory::orderBy('category_name')->get();
    $this->tla = CompanyTLA::orderBy('name')->get();
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(SpvDataTable $dataTable)
  {
    $this->spv = User::allExternesByCompany(company()->id);

    $this->spv = $this->spv->first();
    return $dataTable->render('admin.spv.index', $this->data);
  }

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


    $Spv = new SpvDetails();
    $this->categories = SpvCategory::orderBy('category_name')->get();
    $this->subcategories = SpvSubCategory::orderBy('category_name')->get();
    // $this->fields = $Spv->getCustomFieldGroupsWithFields()->fields;
    $this->countries = Country::orderBy('name')->get();
    $this->contects  = Contect::where('client_detail_id',null)->where('supplier_detail_id',null)->where('spv_detail_id',null)->get();
    $this->designations = Designation::with('members', 'members.user')->get();


    if (request()->ajax()) {
        // return view('admin.spv.ajax-create', $this->data);
    }

    return view('admin.spv.create', $this->data);
    
  }


  public function store(StoreSpvRequest $request){

    $isSuperadmin = User::withoutGlobalScopes(['active', CompanyScope::class])->where('super_admin', '1')->where('email', $request->input('email'))->get()->count();
    if ($isSuperadmin > 0) {
        return Reply::error(__('messages.superAdminExistWithMail'));
    }

    $existing_user = User::withoutGlobalScopes(['active', CompanyScope::class])->select('id', 'email')->where('email', $request->input('email'))->first();
    $new_code = Country::select('phonecode')->where('id', $request->p_mobile_phoneCode)->first();

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

    $existing_client_count = SpvDetails::select('id', 'email', 'company_id')
        ->where(
            [
                'email' => $request->input('email')
            ]
        )->count();

        $city = CompanyTLA::where('id',$request->input('city'))->first();

              
    if ($existing_client_count === 0) {
        $Spv = new SpvDetails();
        $Spv->email = $request->input('company_email');
        $Spv->mobile = $request->mobile_phoneCode .' '.$request->input('mobile');
        $Spv->city =    $city->name;
        $Spv->city_id =    $city->id;
        $Spv->description =    $request->observation;
        $Spv->language =  $request->language;
        $Spv->country_id = $request->country;
        $Spv->category_id = ($request->input('category_id') != 0 && $request->input('category_id') != '') ? $request->input('category_id') : null;
        $Spv->sub_category_id = ($request->input('sub_category_id') != 0 && $request->input('sub_category_id') != '') ? $request->input('sub_category_id') : null;
        $Spv->company_name = $request->company_name;
        $Spv->address = $request->address;
        // $Spv->shipping_address = $request->address;
        $Spv->tel =  $request->input('company_phone_phoneCode').' '.$request->input('company_phone');
        $Spv->fax =  $request->input('fax_phoneCode').' '.$request->input('fax');

        if ($request->has('emailNotification')) {
            $Spv->email_notifications = $request->emailNotification;
        }
        if ($request->has('smsNotification')) {
            $Spv->sms_notifications   = $request->smsNotification;
        }
          
        if($request->contact_principal != 'create' && $request->contact_principal != 'without_user'){
            $contact = Contect::find($request->contact_principal);
        }

        if(isset($contact)){
            $Spv->contacts_id = $contact->id; 
        }
        $Spv->save();
        
        if(isset($contact)){
          $contact->spv_detail_id = $Spv->id;
          $contact->contect_type = 'spv';
          $contact->save();
        }

        
    } else {
        return Reply::error('Provided email is already registered. Try with different email.');
    }

    if (!$existing_user && $request->sendMail == 'yes') {
        //send welcome email notification
        $user->notify(new NewUser($user->password));
    }

    if ($request->has('ajax_create')) {
        $teams = User::allExternesByCompany(company()->id);
        $teamData = '';

        foreach ($teams as $team) {
            $teamData .= '<option value="' . $team->id . '"> ' . ucwords($team->name) . ' </option>';
        }

        return Reply::successWithData(__('messages.clientAdded'), ['teamData' => $teamData]);
    }

    return Reply::redirect(route('admin.spv.index'));
  }


  

  public function show($id)
  {
    $this->categories = Spvcategory::orderBy('category_name')->get();
    $this->subcategories = SpvSubCategory::orderBy('category_name')->get();
    $this->spvDetails = SpvDetails::where('id', '=', $id)->first();
    $this->clientStats = $this->clientStats($id);
    $this->country = Country::where('id', $this->spvDetails->country_id)->first();
    $this->category = SpvCategory::where('id', $this->spvDetails->category_id)->first();
    $this->sub_category = SpvSubCategory::where('id', $this->spvDetails->sub_category_id)->first();
    $this->language = LanguageSetting::where('language_code', $this->spvDetails->language)->first();
    $this->email = $this->spvDetails->email;

    if (!is_null($this->spvDetails)) {
      $this->spvDetails = $this->spvDetails->withCustomFields();
      // $this->fields = $this->spvDetails->getCustomFieldGroupsWithFields()->fields;
    }
    
    return view('admin.spv.show', $this->data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

    $this->spvDetails = SpvDetails::where('id', '=', $id)->first();

    if (!is_null($this->spvDetails)) {
      $this->spvDetails = $this->spvDetails->withCustomFields();
      // $this->fields = $this->spvDetails->getCustomFieldGroupsWithFields()->fields;
    }
    $this->clientWebsite = $this->websiteCheck($this->spvDetails->website);

    $this->countries = Country::orderBy('name')->get();
    $this->categories = SpvCategory::orderBy('category_name')->get();
    $this->subcategories = SpvSubCategory::orderBy('category_name')->get();
    $this->contects  = Contect::where('spv_detail_id',$id)->get();

    $this->freeContacts = Contect::where('client_detail_id',null)->where('supplier_detail_id',null)->where('spv_detail_id',null)->get();

    $this->designations = Designation::with('members', 'members.user')->get();

    return view('admin.spv.edit', $this->data);
  }

  public function websiteCheck($email)
  {
    $clientWebsite = $email;

    if (strpos($email, 'http://') !== false) {
      $clientWebsite = str_replace('http://', '', $email);
      if (strpos($clientWebsite, 'http://') !== false) {
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
  public function update(UpdateSpvRequest $request, $id)
  {
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

    $new_code = Country::select('phonecode')->where('id', $request->phone_code)->first();
    $Spv = SpvDetails::find($id);

    $city = CompanyTLA::where('id',$request->input('city'))->first();

    $Spv->company_name = $request->company_name;
    // $Spv->name = $request->name;
    $Spv->email = $request->company_email;
    $Spv->mobile =   $request->mobile_phoneCode .' '.$request->mobile;
    $Spv->tel =  $request->company_phone_phoneCode.' '.$request->company_phone;
    $Spv->fax =  $request->fax_phoneCode.' '.$request->fax;
    $Spv->country_id = $request->country;
    $Spv->address = $request->address;
    $Spv->city = $city->name;
    $Spv->city_id =    $city->id;
    $Spv->description =    $request->observation;
    $Spv->language =  $request->language;
    $Spv->category_id = ($request->input('category_id') != 0 && $request->input('category_id') != '') ? $request->input('category_id') : null;
    $Spv->sub_category_id = ($request->input('sub_category_id') != 0 && $request->input('sub_category_id') != '') ? $request->input('sub_category_id') : null;
    // $Spv->shipping_address = $request->address;
    // if($request->contact_principal == 'select'){
    //     $Spv->contacts_id = $request->contact;
    // }

    if($request->contact_principal == 'without_user'){
        $Spv->contacts_id = null;
    }else{
       $contact = Contect::find($request->contact_principal);
       $contact->spv_detail_id = $Spv->id;
       $contact->contect_type = 'spv';
       $contact->save();
    }

    
     if(isset($contact)){
        $Spv->contacts_id = $contact->id; 
    }        

    if ($request->has('emailNotification')) {
        $Spv->email_notifications = $request->emailNotification;
    }
    if ($request->has('smsNotification')) {
        $Spv->sms_notifications   = $request->smsNotification;
    }
    $Spv->save();
    return Reply::redirect(route('admin.spv.index'));
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
    $spv_count = SpvDetails::withoutGlobalScope(CompanyScope::class)->where('id', $id)->count();
    if ($spv_count > 1) {
      echo $spv_count;
      exit;
      $spv_builder = SpvDetails::where('id', $id);
      $spv = $spv_builder->first();

      $user_builder = User::where('id', $id);
      $user = $user_builder->first();
      if ($user && !is_null($spv)) {
        $other_spv = $spv_builder->withoutGlobalScope(CompanyScope::class)
          ->where('company_id', '!=', $spv->company_id)
          ->first();
        if (!is_null($other_spv)) {
          request()->request->add(['company_id' => $other_spv->company_id]);

          $user->save();
        }
      }
     
      $spv->delete();
    } else {
      $spv = SpvDetails::where('id', $id)->first();
      $spv->delete();
      $universalSearches = UniversalSearch::where('searchable_id', $id)->where('module_type', 'spv')->get();
      if ($universalSearches) {
        foreach ($universalSearches as $universalSearch) {
          UniversalSearch::destroy($universalSearch->id);
        }
      }
    }
    DB::commit();
    return Reply::success(__('messages.clientDeleted'));
  }

  public function showProjects($id)
  {
    // $this->client = User::findClient($id);

    // if (!$this->client) {
    //   abort(404);
    // }

    $this->spvDetails = SpvDetails::where('id', '=', $id)->with('SpvProjects')->first();
    $this->clientStats = $this->clientStats($id);

    if (!is_null($this->spvDetails)) {
      $this->spvDetails = $this->spvDetails->withCustomFields();
      // $this->fields = $this->clientDetail->getCustomFieldGroupsWithFields()->fields;
    }

    return view('admin.spv.projects', $this->data);
  }

  public function showInvoices($id)
  {
    // $this->client = User::findClient($id);

    // if (!$this->client) {
    //   abort(404);
    // }

    $this->spvDetails = SpvDetails::where('id', '=', $id)->firstOrFail();
    $this->clientStats = $this->clientStats($id);

    if (!is_null($this->spvDetails)) {
      $this->spvDetails = $this->spvDetails->withCustomFields();
      // $this->fields = $this->clientDetail->getCustomFieldGroupsWithFields()->fields;
    }

    $this->invoices = Invoice::selectRaw('invoices.invoice_number, invoices.total, currencies.currency_symbol, invoices.issue_date, invoices.id,
            ( select payments.amount from payments where invoice_id = invoices.id) as paid_payment')
      ->leftJoin('projects', 'projects.id', '=', 'invoices.project_id')
      ->join('currencies', 'currencies.id', '=', 'invoices.currency_id')
      ->where(function ($query) use ($id) {
        $query->where('projects.spv_detail_id', $id)
          ->orWhere('invoices.client_id', $id);
      })
      ->get();


    return view('admin.spv.invoices', $this->data);
  }

  public function showPayments($id)
  {
    $this->spvDetails = SpvDetails::where('id', '=', $id)->first();
    $this->clientStats = $this->clientStats($id);

    if (!is_null($this->spvDetails)) {
      $this->spvDetails = $this->spvDetails->withCustomFields();
      // $this->fields = $this->spvDetails->getCustomFieldGroupsWithFields()->fields;
    }

    $this->payments = Payment::with(['project:id,project_name', 'currency:id,currency_symbol,currency_code', 'invoice'])
      ->leftJoin('invoices', 'invoices.id', '=', 'payments.invoice_id')
      ->leftJoin('projects', 'projects.id', '=', 'payments.project_id')
      ->select('payments.id', 'payments.project_id', 'payments.currency_id', 'payments.invoice_id', 'payments.amount', 'payments.status', 'payments.paid_on', 'payments.remarks')
      ->where('payments.status', '=', 'complete')
      ->where(function ($query) use ($id) {
        $query->where('projects.client_id', $id)
          ->orWhere('invoices.client_id', $id);
      })
      ->orderBy('payments.id', 'desc')
      ->get();
    return view('admin.spv.payments', $this->data);
  }

  // public function showNotes($id){
  //   $this->clients = User::allExt allExternesByCompany(company()->id);
  //   $this->employees = User::allEmployees();

  //   $this->notes = Notes::where('client_id',$id)->get();
  //     $this->client = User::findClient($id);
  //   $this->clientDetail = ClientDetails::where('user_id', '=', $this->client->id)->first();
  //   $this->clientStats = $this->clientStats($id);

  //   return view('admin.spv.notes', $this->data);
  // }

  public function showNotes($id){
    //  $this->client = User::findClient($id);
    // $this->clientStats = $this->clientStats($id);

    $this->clients = User::allExternesByCompany(company()->id);
    $this->employees = User::allEmployees()->where('id', '!=', $this->user->id);
    $this->notes = Notes::where('spv_detail_id', $id)->get();
    // $this->client = User::findClient($id);
    $this->spvDetails = SpvDetails::where('id', '=', $id)->first();
    $this->clientStats = $this->clientStats($id);

    return view('admin.spv.notes.show', $this->data);
  }

  public function showContacts($id){
    // $this->client = User::findClient($id);
    // $this->clientStats = $this->clientStats($id);

    $this->spvDetails = SpvDetails::where('id', '=', $id)->first();
    $this->clientStats = $this->clientStats($id);

    if (!is_null($this->spvDetails)) {
        $this->spvDetails = $this->spvDetails->withCustomFields();
    }

    return view('admin.spv.show-contacts', $this->data);
  }

  public function editContact($id)
  {
    // $this->contact = ClientContact::findOrFail($id);
    $this->contact = new ClientContact();
    $this->contact->contact_name = "demo";
    $this->contact->phone = "+2392809823";
    $this->contact->email = "demo@gmail.com";

    return view('admin.spv.edit-contact', $this->data);
  }

  
  public function showDocs($id){    
    // $this->client       = User::findClient($id);
    $this->spvDetails = SpvDetails::where('id', '=', $id)->first();
    $this->spvDocs   = SpvDocs::where('spv_detail_id', '=', $id)->get();
    $spvController   = new AdminSpvController();
    $this->clientStats  = $spvController->clientStats($id);
    return view('admin.spv.docs.index', $this->data);
  }

  public function gdpr($id)
  {
    $this->client = User::findClient($id);
    $this->categories = ClientCategory::orderBy('category_name')->get();
    $this->subcategories = ClientSubCategory::orderBy('category_name')->get();
    $this->clientDetail = ClientDetails::where('user_id', '=', $this->client->id)->first();
    $this->clientStats = $this->clientStats($id);
    $this->allConsents = PurposeConsent::with(['user' => function ($query) use ($id) {
      $query->where('client_id', $id)
        ->orderBy('created_at', 'desc');
    }])->get();

    return view('admin.spv.gdpr', $this->data);
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

    $url = route('admin.spv.gdpr', $user->id);

    return Reply::redirect($url);
  }

  public function clientStats($id)
  {
    return DB::table('users')
      ->select(
        DB::raw('(select count(projects.id) from `projects` WHERE projects.client_id = ' . $id . ' and projects.company_id = ' . company()->id . ') as totalProjects'),
        DB::raw('(select count(invoices.id) from `invoices` left join projects on projects.id=invoices.project_id WHERE invoices.status != "paid" and invoices.status != "canceled" and (projects.client_id = ' . $id . ' or invoices.client_id = ' . $id . ') and invoices.company_id = ' . company()->id . ') as totalUnpaidInvoices'),
        DB::raw('(select sum(payments.amount) from `payments` left join projects on projects.id=payments.project_id left join invoices on invoices.id= payments.invoice_id
                WHERE payments.status = "complete" and (projects.client_id = ' . $id . ' or  invoices.client_id = ' . $id . ' )and payments.company_id = ' . company()->id . ') as projectPayments'),


        // DB::raw('(select sum(payments.amount) from `payments` inner join invoices on invoices.id=payments.invoice_id  WHERE payments.status = "complete" and invoices.client_id = ' . $id . ' and payments.company_id = ' . company()->id . ') as invoicePayments'),


        DB::raw('(select count(contracts.id) from `contracts` WHERE contracts.client_id = ' . $id . ' and contracts.company_id = ' . company()->id . ') as totalContracts')
      )
      ->first();
  }

  public function getSubcategory(Request $request)
  {
    $this->subcategories = SpvSubCategory::where('category_id', $request->cat_id)->get();

    return Reply::dataOnly(['subcategory' => $this->subcategories]);
  }


  public function data($id)
  {

    $timeLogs = Notes::where('spv_detail_id', $id)->get();
    return DataTables::of($timeLogs)
        ->addColumn('action', function ($row) {
            return '<a href="javascript:;" class="btn btn-info btn-circle edit-contact"
                  data-toggle="tooltip" data-contact-id="' . $row->id . '"  data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                 
                  <a href="javascript:;" class="btn btn-success btn-circle view-contact"
                  data-toggle="tooltip" data-contact-id="' . $row->id . '"  data-original-title="View"><i class="fa fa-search" aria-hidden="true"></i></a>

                <a href="javascript:;" class="btn btn-danger btn-circle sa-params"
                  data-toggle="tooltip" data-contact-id="' . $row->id . '" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>';
        })
        ->editColumn('notes_title', function ($row) {
            
            return ucwords($row->notes_title);
        })
        ->editColumn('notes_type', function ($row) {
            if ( $row->notes_type == '0') {
                return 'Public';
            } else{
                return 'Private';
            }
                
            
        })
        
       // ->removeColumn('user_id')
        ->make(true);
  }


  public function addNotes(StoreNotes $request){
    $note = new Notes();
    $note->notes_title = $request->notes_title;
    $note->spv_detail_id = $request->spv_detail_id;
    $note->notes_type = $request->notes_type;
    $note->is_client_show = $request->is_client_show ? $request->is_client_show : '';
    $note->ask_password = $request->ask_password ? $request->ask_password : '';
    $note->note_details = $request->note_details;
    $note->save();
    if($request->notes_type == 1){
        $users = $request->user_id;
        if(!is_null($users)){
            foreach ($users as $user) {
                $member = SpvUserNotes::firstOrCreate([
                   'user_id' => $user,
                   'note_id' => $note->id
                ]);
            }
        }
       
    }
    return Reply::success(__('messages.notesAdded'));
  }



  public function editNotes($id)
  {
    $this->clients = User::allExternesByCompany(company()->id);
    $this->employees = User::allEmployees()->where('id', '!=', $this->user->id);
    $this->notes = Notes::findOrFail($id);
    $this->spv_user_notes = SpvUserNotes::where('note_id', '=', $this->notes->id)->get();
    $this->spvMembers = $this->notes->spvMember->pluck('user_id')->toArray();

    return view('admin.spv.notes.edit', $this->data);
  }

  public function updateNotes(UpdateNotes $request, $id)
  {
      $note = Notes::findOrFail($id);
      $note->notes_title = $request->notes_title;
      $note->notes_type = $request->notes_type;
      $note->is_client_show = $request->is_client_show == 'on' ? 1 : 0;
      $note->ask_password = $request->ask_password == 'on' ? 1 : 0;
      $note->note_details = $request->note_details;
      $note->save();
      SpvUserNotes::where('note_id', $note->id)->delete();
      if($request->notes_type == 1){
          $users = $request->user_id;
          if(!is_null($users)){
              foreach ($users as $user) {
                  $member = SpvUserNotes::firstOrCreate([
                  'user_id' => $user,
                  'note_id' => $note->id
                  ]);
              }
          }
      }
      return Reply::success(__('messages.notesUpdated'));
  }
  public function viewNotes($id)
  {
      $this->clients = User::allExternesByCompany(company()->id);
      $this->employees = User::allEmployees();
      $this->notes = Notes::findOrFail($id);
      $this->spvMembers = $this->notes->spvMember->pluck('user_id')->toArray();
      $this->spv_user_notes = SpvUserNotes::where('note_id', '=', $this->notes->id)->get();
      return view('admin.spv.notes.view', $this->data);
  }

  public function deleteNotes($id)
  {
      Notes::destroy($id);

      return Reply::success(__('messages.notesDeleted'));
  }



}
