<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Contect\StoreContectsRequest;
use App\User;
use App\Contect;
use App\Helper\Reply;
use App\Helper\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;


class AdminContactController extends AdminBaseController
{

  public function __construct()
  {
    parent::__construct();
    $this->pageIcon = 'icon-people';
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->pageTitle = 'app.menu.contacts';
    return view('admin.contact.index', $this->data);
  }

  public function create($type = null)
  { 
    $this->type  =  $type;
    $this->pageTitle = 'app.addContact';

    if($type == 'client')
    {
        $this->clients = User::allClients();
    }
    elseif($type == 'supplier'){
        $this->clients = User::allSuppliers();
    }else{
      $allClients = User::allClients();
      $allsuppliers =  User::allSuppliers();
      $this->clients = $allClients->merge($allsuppliers);
    }
    return view('admin.contact.create', $this->data);
  }
  public function store(StoreContectsRequest $request){
    
    $contect = new Contect;
    
    $contect->gender = $request->gender;
    $contect->name = $request->name;
    $contect->function = $request->function;
    $contect->email = $request->email;
    $contect->mobile = $request->mobile_phoneCode.' '.$request->mobile;
    $contect->visibility = $request->visibility;
    $contect->contect_type = $request->contect_type;
    $contect->user_id = $request->user_id;

    if ($request->hasFile('image')) {
      $contect->image = Files::upload($request->image, 'avatar', 300);
    }
    $contect->save();

    if($request->page_type == 'client')
    {
        return Reply::redirect(route('admin.clients.index'));
    }
    elseif($request->page_type == 'contact' ){
        return Reply::redirect(route('admin.contact.index'));
    }elseif($request->page_type == 'supplier'){
        return Reply::redirect(route('admin.supplier.contacts',[$request->user_id]));
    }

    return Reply::redirect(route('admin.contact.index'));

  }
  public function delete($id){

    $contact = Contect::where('id',$id)->delete();
    return response()->json(["status" => "success"]);

  }
  public function edit($id)
  {
    $this->pageTitle = 'app.addContact';
    $this->contact = Contect::findOrFail($id);
    $this->clients = User::allClients(); 

    return view('admin.contact.editPage',$this->data);
  }

  public function editStore(StoreContectsRequest $request){
    
    $contact = Contect::findOrFail($request->id);

    $contact->gender = $request->gender;
    $contact->name = $request->name;
    $contact->function = $request->function;
    $contact->email = $request->email;
    $contact->mobile = $request->mobile_phoneCode.' '.$request->mobile;
    $contact->visibility = $request->visibility;
    $contact->contect_type = $request->contect_type;
    $contact->user_id = $request->user_id;

    if ($request->hasFile('image')) {
      $contact->image = Files::upload($request->image, 'avatar', 300);
    }

    $contact->save();

    return Reply::redirect(route('admin.contact.index'));    

  }
  public function contactData()
  {
    $timeLogs = Contect::all();

    return DataTables::of($timeLogs)
        ->addColumn('action', function ($row) {
            return '<a href="'.route("admin.contact.edit",$row->id).'" class="btn btn-info btn-circle edit-contact"
                  data-toggle="tooltip" data-contact-id="' . $row->id . '"  data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                <a href="javascript:;" class="btn btn-danger btn-circle sa-params"
                  data-toggle="tooltip" data-contact-id="' . $row->id . '" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>';
        })
        ->editColumn('name', function ($row) {
            return ucwords($row->name);
        })
        ->removeColumn('user_id')
        ->make(true);
  }

  public function contactgetResult(Request $request){
    // print_r($request['query']);
    // exit;

    $timeLogs = Contect::where('name','like',$request['query'].'%')->get();

    return DataTables::of($timeLogs)
        ->addColumn('action', function ($row) {
            return '<a href="'.route("admin.contact.edit",$row->id).'" class="btn btn-info btn-circle edit-contact"
                  data-toggle="tooltip" data-contact-id="' . $row->id . '"  data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                <a href="javascript:;" class="btn btn-danger btn-circle sa-params"
                  data-toggle="tooltip" data-contact-id="' . $row->id . '" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>';
        })
        ->editColumn('name', function ($row) {
            return ucwords($row->name);
        })
        ->removeColumn('user_id')
        ->make(true);
  }


}
