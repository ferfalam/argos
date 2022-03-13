<?php

namespace App\Http\Controllers\Admin;

use App\ClientCategory;
use App\ClientSubCategory;
use App\CompanyTLA;
use App\ContractType;
use App\Country;
use App\DataRoom;
use App\Espace;
use App\Project;
use App\SPV;
use App\User;
use Carbon\Carbon;

class AdminDocumentController extends AdminBaseController
{

  public function __construct()
  {
    parent::__construct();
    $this->pageTitle = 'app.menu.documents';
    $this->pageIcon = 'icon-people';
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->spv = SPV::all();
    $this->totalDatarooms = DataRoom::count();
    $this->totalCanPublish = DataRoom::canPublish()->count();
    $this->totalCanNotPublish = DataRoom::canNotPublish()->count();
    $this->datarooms = DataRoom::all();
    $this->projects = Project::all();
    $this->espaces = Espace::all();
    //$this->spv = $this->spv->first();
    
    return view('admin.document.index', $this->data);
  }
}
