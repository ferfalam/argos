<?php

namespace App\Http\Controllers\Admin;

use App\ClientContact;
use App\Http\Requests\Admin\Contect\StoreContectsRequest;
use App\User;
use App\Contect;
use App\Designation;
use App\ClientDetails;
use App\SupplierDetails;
use App\SpvDetails;
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
    $this->designations = Designation::all();
    return view('admin.contact.index', $this->data);
  }

  public function create($type = null,$client_id = null)
  {     
    $this->type  =  $type;
    $this->pageTitle = 'app.addContact';

    if($type == 'client')
    {
        $this->clients = ClientDetails::where('id',$client_id)->get();
    }
    elseif($type == 'supplier'){
        $this->clients = SupplierDetails::where('id',$client_id)->get();
    }elseif($type == 'spv'){
      $this->clients = SpvDetails::where('id',$client_id)->get();
    }else{
      $this->clients = ClientDetails::all();
    }

    $this->designations = Designation::with('members', 'members.user')->get();
    $this->employees = User::allEmployeesByCompany(company()->id);
    $this->admins = User::allAdminsByCompany(company()->id);

    return view('admin.contact.create', $this->data);
  }
  public function store(StoreContectsRequest $request){
    
    $contect = new Contect;
    
    $contect->gender = $request->gender;
    $contect->name = $request->name;
    $contect->function = $request->function;
    $contect->email = $request->email;
    $contect->mobile = $request->mobile_phoneCode.' '.$request->mobile;
    // $contect->visibility = $request->visibility;
    $contect->contect_type = $request->contect_type;

    if($request->contect_type == 'client' ){
      $contect->client_detail_id = $request->user_id;
    }

    if($request->contect_type == 'supplier'){
      $contect->supplier_detail_id = $request->user_id;
    }

    if($request->contect_type == 'spv'){
      $contect->spv_detail_id = $request->user_id;
    }

    if ($request->hasFile('image')) {
      $contect->image = Files::upload($request->image, 'avatar', 300);
    }
    $contect->visibility = $request->visible_by == "" ? "" : json_encode($request->visible_by);
    if ($request->all) {
      $contect->visibility = "all";
    }
    $contect->save();

    if($request->page_type == 'client')
    {
      return Reply::redirect(route('admin.contacts.show',$request->user_id));
    }
    elseif($request->page_type == 'contact' ){
      return Reply::redirect(route('admin.contact.index'));
    }
    elseif($request->page_type == 'supplier'){
      return Reply::redirect(route('admin.supplier.contacts',[$request->user_id]));
    }
    elseif($request->page_type == 'spv'){
      return Reply::redirect(route('admin.spv-contacts', $request->user_id));
    }

    return Reply::redirect(route('admin.contact.index'));
  }

  public function getCompany(Request $request){
      if($request->content_type == 'client')
      {
        $company = ClientDetails::all();
      }
      elseif($request->content_type == 'supplier'){
          $company = SupplierDetails::all();
      }
      elseif($request->content_type == 'spv'){
          $company = SpvDetails::all();
      }

      return response()->json(['company' => $company ]);
  }


  public function delete($id){
    
    $contactsInClient = ClientDetails::where('contacts_id',$id)->first();
    $contactsInSupplier = SupplierDetails::where('contacts_id',$id)->first();
    $contactsInSpv = SpvDetails::where('contacts_id',$id)->first();

    if($contactsInClient != null)
    {
      $contactsInClient->contacts_id = null;
      $contactsInClient->save();
    }

    if($contactsInSupplier != null)
    {
      $contactsInSupplier->contacts_id = null;
      $contactsInSupplier->save();
    }

    if($contactsInSpv != null)
    {
      $contactsInSpv->contacts_id = null;
      $contactsInSpv->save();
    }

    $contact = Contect::where('id',$id)->delete();
    return response()->json(["status" => "success"]);

  }
    public function edit($id,$type = null)
  {

    
    $this->type = $type;
    $this->pageTitle = 'app.addContact';
    $this->contact = Contect::findOrFail($id);
    
    $this->clients =[];

    if($this->contact->contect_type == 'client'){
        $this->clients = ClientDetails::all(); 
    }
    if($this->contact->contect_type == 'supplier'){
      $this->clients = SupplierDetails::all();
    }

    if($this->contact->contect_type == 'spv'){
      $this->clients = SpvDetails::all();
    }


    $this->designations = Designation::with('members', 'members.user')->get();
    $this->employees = User::allEmployeesByCompany(company()->id);
    $this->admins = User::allAdminsByCompany(company()->id);


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

    

    if($request->contect_type == 'client' )
    {
      $contact->client_detail_id = $request->user_id;
    }
    elseif($request->contect_type == 'supplier' )
    {
        $contact->supplier_detail_id = $request->user_id;
    }elseif($request->contect_type == 'spv' )
    {
        $contact->spv_detail_id = $request->user_id;
    }else {
      $contact->supplier_detail_id = null;
      $contact->client_detail_id = null;
      $contact->spv_detail_id = null;
    }


    

    if ($request->hasFile('image')) {
      $contact->image = Files::upload($request->image, 'avatar', 300);
    }
    $contact->visibility = $request->visible_by == "" ? "" : json_encode($request->visible_by);
    if ($request->all) {
      $contact->visibility = "all";
    }

    $contact->save();


    if($request->edit_type == 'contect'){
      return Reply::redirect(route('admin.contact.index'));
    }

    if($request->page_type == 'client'){
        return Reply::redirect(route('admin.contacts.show',$contact->client_detail_id));      
    }

    if($request->page_type == 'supplier'){
      return Reply::redirect(route('admin.supplier.contacts',$contact->supplier_detail_id));      
    }

    if($request->page_type == 'spv'){
      return Reply::redirect(route('admin.spv-contacts',$request->user_id));      
    }

    return Reply::redirect(route('admin.contact.index'));    

  }
  public function contactData(Request $request)
  {
    $timeLogs = Contect::where('company_id', company()->id);
    if ($request->type != 'all') {
      # code...
      $timeLogs->where("contect_type", $request->type);
    }
    if ($request->function_id != 'all') {
      # code...
      $timeLogs->where("function", $request->function_id);
    }
    if ($request->name) {
      # code...
      $timeLogs->where("name",'like', '%'.$request->name.'%');
    }
    return DataTables::of($timeLogs->get())
        ->addColumn('action', function ($row) {
            return '<a href="'.route("admin.contact.edit",[ 'id'=> $row->id,'type'=> 'contect' ]).'" class="btn btn-info btn-circle edit-contact"
                  data-toggle="tooltip" data-contact-id="' . $row->id . '"  data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                <a href="javascript:;" class="btn btn-danger btn-circle sa-params"
                  data-toggle="tooltip" data-contact-id="' . $row->id . '" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>';
        })
        ->editColumn('name', function ($row) {
            return ucwords($row->name);
        })
        ->editColumn('id', function ($row) {
          $res = '<img data-toggle="tooltip" data-placement="right" data-original-title="' . $row->name . '" src="' . $row->image_url . '" style="width:30px; height:30px; border-radius: 50%;">';

          return $res;
        })
        ->editColumn('visibility', function ($row) {
          if ($row->canSee() == '') {
            return '<span></span>';
          } elseif ($row->canSee() == 'all')
            return '<span>' . __("app.all") . '</span>';
          else {
            $res = "";
            foreach ($row->canSee() as $cs) {
              $res .= '<img data-toggle="tooltip" data-placement="right" data-original-title="' . $cs->name . '" src="' . $cs->image_url . '" style="width:30px; height:30px; border-radius: 50%;">';
            }
            return $res;
          }
        })
        ->rawColumns(['visibility', 'action', 'id'])
        ->removeColumn('user_id')
        ->make(true);
  }

  public function contactgetResult(Request $request){
    // print_r($request['query']);
    // exit;

    if ($request['query'] != "*") {
      $timeLogs = Contect::where('name','like',$request['query'].'%')->get();
    }else{
      $timeLogs = Contect::all();
    }

    return DataTables::of($timeLogs)
      ->addColumn('action', function ($row) {
        return '<a href="' . route("admin.contact.edit", ['id' => $row->id, 'type' => 'contect']) . '" class="btn btn-info btn-circle edit-contact"
                  data-toggle="tooltip" data-contact-id="' . $row->id . '"  data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                <a href="javascript:;" class="btn btn-danger btn-circle sa-params"
                  data-toggle="tooltip" data-contact-id="' . $row->id . '" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>';
      })
      ->editColumn('name', function ($row) {
        return ucwords($row->name);
      })
      ->editColumn('id', function ($row) {
        $res = '<img data-toggle="tooltip" data-placement="right" data-original-title="' . $row->name . '" src="' . $row->image_url . '" style="width:30px; height:30px; border-radius: 50%;">';

        return $res;
      })
      ->editColumn('visibility', function ($row) {
        if ($row->canSee() == '') {
          return '<span></span>';
        } elseif ($row->canSee() == 'all')
          return '<span>' . __("app.all") . '</span>';
        else {
          $res = "";
          foreach ($row->canSee() as $cs) {
            $res .= '<img data-toggle="tooltip" data-placement="right" data-original-title="' . $cs->name . '" src="' . $cs->image_url . '" style="width:30px; height:30px; border-radius: 50%;">';
          }
          return $res;
        }
      })
      ->rawColumns(['visibility', 'action', 'id'])
      ->removeColumn('user_id')
      ->make(true);
  }


}
