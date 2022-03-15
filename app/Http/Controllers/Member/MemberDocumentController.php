<?php

namespace App\Http\Controllers\Member;

use App\ClientCategory;
use App\ClientSubCategory;
use App\CompanyTLA;
use App\ContractType;
use App\Country;
use App\DataRoom;
use App\DataTables\Admin\DataRoomsDataTable;
use App\DataTables\Admin\ProjectsDataTable;
use App\Espace;
use App\Http\Controllers\Member\MemberBaseController;
use App\Payment;
use App\Project;
use App\ProjectCategory;
use App\ProjectPlace;
use App\SPV;
use App\User;
use Carbon\Carbon;

class MemberDocumentController extends MemberBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'app.menu.documents';
        $this->pageIcon = 'icon-people';
    }

    public function index(DataRoomsDataTable $dataTable)
    {

        $this->spv = SPV::all();
        $this->totalDatarooms = DataRoom::count();
        $this->totalCanPublish = DataRoom::canPublish()->count();
        $this->totalCanNotPublish = DataRoom::canNotPublish()->count();
        $this->datarooms = DataRoom::all();
        $this->projects = Project::all();
        $this->espaces = Espace::all();
        $this->usedEspaces = DataRoom::select('espaces.*')
        ->join('espaces', 'espaces.id', 'data_rooms.espace_id')
        ->groupBy('espace_id')
        ->get();

        return $dataTable->render('member.document.index', $this->data);
    }

}
