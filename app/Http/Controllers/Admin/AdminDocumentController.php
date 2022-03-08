<?php

namespace App\Http\Controllers\Admin;

use App\ClientCategory;
use App\ClientSubCategory;
use App\CompanyTLA;
use App\ContractType;
use App\Country;
use App\Project;
use App\User;

class AdminDocumentController extends AdminBaseController
{

  public function __construct()
  {
    parent::__construct();
    $this->pageIcon = 'icon-people';
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
    $this->pageTitle = 'app.menu.documents';
    $this->spv = User::allClients();
    $this->spv = $this->spv[0];
    return view('admin.document.index', $this->data);
  }
}
