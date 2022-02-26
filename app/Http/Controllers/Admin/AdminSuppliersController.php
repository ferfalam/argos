<?php

namespace App\Http\Controllers\Admin;

use App\ClientDetails;
use App\Country;
use App\DataTables\Admin\SupplierDataTable;
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




class AdminSuppliersController extends AdminBaseController
{

  public function __construct()
  {
    parent::__construct();
    $this->pageTitle = 'app.menu.suppliers';
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
  public function index(SupplierDataTable $dataTable)
  {

        $this->clients = User::allClients();
        $this->totalClients = count($this->clients);
        $this->categories = ClientCategory::all();
        $this->projects = Project::all();
        $this->contracts = ContractType::all();
        $this->countries = Country::all();
        $this->subcategories = ClientSubCategory::all();
        return $dataTable->render('admin.suppliers.index', $this->data);
  }

  public function create(){
    $this->categories = ClientCategory::all();
    $this->subcategories = ClientSubCategory::all();
    return view('admin.suppliers.create', $this->data);
  }

  public function edit($id){
    $this->categories = ClientCategory::all();
    $this->subcategories = ClientSubCategory::all();
    return view('admin.suppliers.edit', $this->data);
  }
}
