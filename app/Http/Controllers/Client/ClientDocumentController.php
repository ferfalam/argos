<?php

namespace App\Http\Controllers\Client;

use App\DataRoom;
use App\DataTables\Admin\DataRoomsDataTable;
use App\Espace;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;

class ClientDocumentController extends ClientBaseController
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
        $this->datarooms = DataRoom::all();
        $this->projects = Project::all();
        $this->espaces = Espace::all();
        $this->usedEspaces = DataRoom::select('espaces.*')
            ->join('espaces', 'espaces.id', 'data_rooms.espace_id')
            ->groupBy('espace_id')
            ->get();


        return $dataTable->render('client.document.index', $this->data);
    }
}
