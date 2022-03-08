<?php

namespace App\Http\Controllers\Admin;

use App\ClientCategory;
use App\ClientContact;
use App\ClientDetails;
use App\ClientDocs;
use App\ClientSubCategory;
use App\CompanyTLA;
use App\ContractType;
use App\Country;
use App\Helper\Files;
use App\Helper\Reply;
use App\Http\Requests\Admin\Client\UpdateClientRequest;
use App\Http\Requests\Gdpr\SaveConsentUserDataRequest;
use App\Invoice;
use App\LanguageSetting;
use App\Notes;
use App\Payment;
use App\Project;
use App\PurposeConsent;
use App\PurposeConsentUser;
use App\Role;
use App\UniversalSearch;
use App\User;
use Craftsys\Msg91\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminSPVController extends AdminBaseController
{

  public function __construct()
  {
    parent::__construct();
    $this->pageTitle = 'app.menu.spv';
    $this->pageIcon = 'icon-people';
    $this->clients = User::allClients();
    $this->totalClients = count($this->clients);
    $this->categories = ClientCategory::all();
    $this->projects = Project::all();
    $this->contracts = ContractType::all();
    $this->countries = Country::all();
    $this->subcategories = ClientSubCategory::all();
    $this->tla = CompanyTLA::all();
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->spv = User::allClients();
    $this->spv = $this->spv->first();
    return view('admin.spv.index', $this->data);
  }

  public function create()
  {
    return view('admin.spv.create', $this->data);
  }

  public function show($id)
  {
    $user = DB::table('users')->where('id', $id)->get();

    $this->client = User::findClient($id);
    $this->categories = ClientCategory::all();
    $this->subcategories = ClientSubCategory::all();
    $this->clientDetail = ClientDetails::where('user_id', '=', $this->client->id)->first();
    $this->clientStats = $this->clientStats($id);
    $this->country = Country::where('id', $this->client->country_id)->first();
    $this->category = ClientCategory::where('id', $this->clientDetail->category_id)->first();
    $this->sub_category = ClientSubCategory::where('id', $this->clientDetail->sub_category_id)->first();
    $this->language = LanguageSetting::where('language_code', $this->client->language)->first();
    $this->email = $user[0]->email;

    if (!is_null($this->clientDetail)) {
      $this->clientDetail = $this->clientDetail->withCustomFields();
      $this->fields = $this->clientDetail->getCustomFieldGroupsWithFields()->fields;
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
    $this->userDetail = ClientDetails::join('users', 'client_details.user_id', '=', 'users.id')
      ->where('client_details.id', $id)
      ->select('client_details.id', 'client_details.address', 'client_details.name', 'client_details.email', 'client_details.user_id', 'client_details.mobile', 'client_details.category_id', 'client_details.sub_category_id', 'client_details.tel', 'client_details.fax', 'users.locale', 'users.function', 'users.status', 'users.login', 'users.country_id', 'users.observation', 'users.email_notifications', 'users.sms_notification', 'users.city_id', 'users.gender', 'users.language', 'users.email as userEmail', 'users.mobile as userMoblie', 'users.id as userId', 'users.tel as userTel', 'users.fax as userFax')
      ->first();

    $this->clientDetail = ClientDetails::where('user_id', '=', $this->userDetail->user_id)->first();

    if (!is_null($this->clientDetail)) {
      $this->clientDetail = $this->clientDetail->withCustomFields();
      $this->fields = $this->clientDetail->getCustomFieldGroupsWithFields()->fields;
    }
    $this->clientWebsite = $this->websiteCheck($this->clientDetail->website);

    $this->countries = Country::all();
    $this->categories = ClientCategory::all();
    $this->subcategories = ClientSubCategory::all();

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
  public function update(UpdateClientRequest $request, $id)
  {
    $new_code = Country::select('phonecode')->where('id', $request->phone_code)->first();
    $client = ClientDetails::find($id);

    $city = CompanyTLA::where('id', $request->input('city'))->first();

    $client->company_name = $request->company_name;
    $client->name = $request->input('name');
    $client->email = $request->input('company_email');
    $client->mobile =   $request->mobile_phoneCode . ' ' . $request->input('mobile');
    $client->tel =  $request->input('company_phone_phoneCode') . ' ' . $request->input('company_phone');
    $client->fax =  $request->input('fax_phoneCode') . ' ' . $request->input('fax');
    $client->country_id = $request->input('country');
    $client->address = $request->address;
    $client->city = $city->name;
    $client->category_id = ($request->input('category_id') != 0 && $request->input('category_id') != '') ? $request->input('category_id') : null;
    $client->sub_category_id = ($request->input('sub_category_id') != 0 && $request->input('sub_category_id') != '') ? $request->input('sub_category_id') : null;
    $client->shipping_address = $request->address;
    $client->email_notifications = $request->emailNotification;
    $client->save();

    $user = User::withoutGlobalScope('active')->findOrFail($client->user_id);
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->observation =  isset($request->observation) ? $request->input('observation') : '';
    $user->mobile =  $request->p_mobile_phoneCode . ' ' . $request->input('p_mobile');
    $user->gender =   isset($request->gender) ? $request->input('gender') : '';
    $user->tel =  $request->input('p_phone_phoneCode') . ' ' . $request->input('p_phone');
    $user->email_notifications =  $request->input('emailNotification');
    $user->sms_notification   =  $request->input('smsNotification');
    $user->language =  $request->input('language');
    $user->city_id =  $request->input('city');
    $user->country_id =  $request->input('country');
    $user->address =  $request->input('address');
    $user->fax =  $request->input('p_fax_phoneCode') . ' ' . $request->input('p_fax');
    $user->function =  $request->input('function');



    if ($request->password != '') {
      $user->password = Hash::make($request->input('password'));
    }
    if ($request->hasFile('image')) {

      $user->image = Files::upload($request->image, 'avatar', 300);
    }

    $user->save();

    // To add custom fields data
    if ($request->get('custom_fields_data')) {
      $client->updateCustomFieldData($request->get('custom_fields_data'));
    }

    $user = User::withoutGlobalScopes(['active', CompanyScope::class])->findOrFail($client->user_id);

    if ($request->password != '') {
      $user->password = Hash::make($request->input('password'));
    }
    $user->locale = $request->locale;
    $user->save();

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
    $clients_count = ClientDetails::withoutGlobalScope(CompanyScope::class)->where('user_id', $id)->count();
    if ($clients_count > 1) {
      $client_builder = ClientDetails::where('user_id', $id);
      $client = $client_builder->first();

      $user_builder = User::where('id', $id);
      $user = $user_builder->first();
      if ($user && !is_null($client)) {
        $other_client = $client_builder->withoutGlobalScope(CompanyScope::class)
          ->where('company_id', '!=', $client->company_id)
          ->first();
        if (!is_null($other_client)) {
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
      // $client = ClientDetails::where('user_id', $id)->first();
      // $client->delete();
      $universalSearches = UniversalSearch::where('searchable_id', $id)->where('module_type', 'client')->get();
      if ($universalSearches) {
        foreach ($universalSearches as $universalSearch) {
          UniversalSearch::destroy($universalSearch->id);
        }
      }
      $userRoles = User::withoutGlobalScopes([CompanyScope::class, 'active'])->where('id', $id)->first()->role->count();
      if ($userRoles > 1) {
        $role = Role::where('name', 'client')->first();
        $client_role = User::withoutGlobalScopes([CompanyScope::class, 'active'])->where('id', $id)->first();
        $client_role->detachRoles([$role->id]);
        ClientDetails::withoutGlobalScope(CompanyScope::class)->where('user_id', $id)->delete();
      } else {
        User::withoutGlobalScopes([CompanyScope::class, 'active'])->where('id', $id)->delete($id);
      }
    }
    DB::commit();
    return Reply::success(__('messages.clientDeleted'));
  }

  public function showProjects($id)
  {
    $this->client = User::findClient($id);

    if (!$this->client) {
      abort(404);
    }

    $this->clientDetail = ClientDetails::where('user_id', '=', $this->client->id)->first();
    $this->clientStats = $this->clientStats($id);

    if (!is_null($this->clientDetail)) {
      $this->clientDetail = $this->clientDetail->withCustomFields();
      $this->fields = $this->clientDetail->getCustomFieldGroupsWithFields()->fields;
    }

    return view('admin.spv.projects', $this->data);
  }

  public function showInvoices($id)
  {
    $this->client = User::findClient($id);

    if (!$this->client) {
      abort(404);
    }

    $this->clientDetail = $this->client ? $this->client->client_details : abort(404);
    $this->clientStats = $this->clientStats($id);

    if (!is_null($this->clientDetail)) {
      $this->clientDetail = $this->clientDetail->withCustomFields();
      $this->fields = $this->clientDetail->getCustomFieldGroupsWithFields()->fields;
    }

    $this->invoices = Invoice::selectRaw('invoices.invoice_number, invoices.total, currencies.currency_symbol, invoices.issue_date, invoices.id,
            ( select payments.amount from payments where invoice_id = invoices.id) as paid_payment')
      ->leftJoin('projects', 'projects.id', '=', 'invoices.project_id')
      ->join('currencies', 'currencies.id', '=', 'invoices.currency_id')
      ->where(function ($query) use ($id) {
        $query->where('projects.client_id', $id)
          ->orWhere('invoices.client_id', $id);
      })
      ->get();


    return view('admin.spv.invoices', $this->data);
  }

  public function showPayments($id)
  {
    $this->client = User::findClient($id);
    $this->clientDetail = ClientDetails::where('user_id', '=', $this->client->id)->first();
    $this->clientStats = $this->clientStats($id);

    if (!is_null($this->clientDetail)) {
      $this->clientDetail = $this->clientDetail->withCustomFields();
      $this->fields = $this->clientDetail->getCustomFieldGroupsWithFields()->fields;
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
  //   $this->clients = User::allClients();
  //   $this->employees = User::allEmployees();

  //   $this->notes = Notes::where('client_id',$id)->get();
  //     $this->client = User::findClient($id);
  //   $this->clientDetail = ClientDetails::where('user_id', '=', $this->client->id)->first();
  //   $this->clientStats = $this->clientStats($id);

  //   return view('admin.spv.notes', $this->data);
  // }

  public function showNotes($id){
    // $this->client = User::findClient($id);
    // $this->clientStats = $this->clientStats($id);

    $this->clients = User::allClients();
    $this->employees = User::allEmployees()->where('id', '!=', $this->user->id);
    $this->notes = Notes::where('client_id', $id)->get();
    $this->client = User::findClient($id);
    $this->clientDetail = ClientDetails::where('user_id', '=', $this->client->id)->first();
    $this->clientStats = $this->clientStats($id);

    return view('admin.spv.notes.show', $this->data);
  }

  public function showContacts($id){
    $this->client = User::findClient($id);
    $this->clientStats = $this->clientStats($id);
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
    $this->client       = User::findClient($id);
    $this->clientDetail = ClientDetails::where('user_id', '=', $this->client->id)->first();
    $this->clientDocs   = ClientDocs::where('user_id', '=', $this->client->id)->get();
    $clientController   = new ManageClientsController();
    $this->clientStats  = $clientController->clientStats($id);
    return view('admin.spv.docs.index', $this->data);
  }

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
    $this->subcategories = ClientSubCategory::where('category_id', $request->cat_id)->get();

    return Reply::dataOnly(['subcategory' => $this->subcategories]);
  }

}
