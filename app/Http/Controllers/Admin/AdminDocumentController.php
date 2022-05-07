<?php

namespace App\Http\Controllers\Admin;

use App\ClientCategory;
use App\ClientSubCategory;
use App\CompanyTLA;
use App\ContractType;
use App\Country;
use App\DataRoom;
use App\DataTables\Admin\DataRoomsDataTable;
use App\DataTables\Admin\ProjectsDataTable;
use App\Espace;
use App\Payment;
use App\Project;
use App\ProjectCategory;
use App\ProjectPlace;
use App\SPV;
use App\SpvDetails;
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

  public function index(DataRoomsDataTable $dataTable)
  {

    // $this->spv = SpvDetails::all();
    $this->totalDatarooms = DataRoom::count();
    $this->totalCanPublish = DataRoom::canPublish()->count();
    $this->totalCanNotPublish = DataRoom::canNotPublish()->count();
    $this->datarooms = DataRoom::orderBy('doc_name')->get();
    $this->projects = Project::orderBy('project_name')->get();
    $this->espaces = Espace::orderBy('espace_name')->get();
    $this->usedEspaces = DataRoom::select('espaces.*')
    ->join('espaces', 'espaces.id', 'data_rooms.espace_id')
    ->orderBy('espaces.espace_name')
    ->groupBy('espace_id')
    ->get();


    return $dataTable->render('admin.document.index', $this->data);
  }

}
