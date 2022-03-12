<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ProjectNotes\StoreNotes;
use App\Http\Requests\ProjectNotes\UpdateNotes;
use Illuminate\Http\Request;
use App\Notes;
use App\User;
use App\ClientUserNotes;
use App\SupplierUserNotes;
use App\ClientDetails;
use App\SupplierDetails;
use Illuminate\Support\Facades\DB;

use App\Helper\Reply;

class SupplierNotesController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageIcon = 'icon-people';
        $this->pageTitle = 'app.menu.suppliers';
        $this->middleware(function ($request, $next) {
            abort_if(!in_array('clients', $this->user->modules), 403);
            return $next($request);
        });
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotes $request)
    {
        $note = new Notes();
        $note->notes_title = $request->notes_title;
        $note->supplier_detail_id = $request->supplier_detail_id;
        $note->notes_type = $request->notes_type;
        $note->is_client_show = $request->is_client_show ? $request->is_client_show : '';
        $note->ask_password = $request->ask_password ? $request->ask_password : '';
        $note->note_details = $request->note_details;
        $note->save();
        if($request->notes_type == 1){
            $users = $request->user_id;
            if(!is_null($users)){
                foreach ($users as $user) {
                    $member = SupplierUserNotes::firstOrCreate([
                       'user_id' => $user,
                       'note_id' => $note->id
                    ]);
                }
            }
           
        }
        return Reply::success(__('messages.notesAdded'));
    }
    
    public function data($id)
    {
        $timeLogs = Notes::where('Supplier_detail_id',$id)->get();
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->clients = User::allClients();
        $this->employees = User::allEmployees()->where('id', '!=', $this->user->id);
        $this->notes = Notes::where('supplier_detail_id', $id)->get();

        //  $this->client = User::findClient($id);
        $this->supplierDetail = SupplierDetails::where('id',$id)->first();
        // $this->clientStats = $this->clientStats($id);
        return view('admin.suppliers-notes.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->clients = User::allClients();
        $this->employees = User::allEmployees()->where('id', '!=', $this->user->id);
        $this->notes = Notes::findOrFail($id);
        $this->client_user_notes = SupplierUserNotes::where('note_id', '=', $this->notes->id)->get();
        $this->clientMembers = $this->notes->supplierMember->pluck('user_id')->toArray();

        return view('admin.suppliers-notes.edit', $this->data);
    }

    public function view($id)
    {
        $this->clients = User::allClients();
        $this->employees = User::allEmployees();
        $this->notes = Notes::findOrFail($id);
        $this->clientMembers = $this->notes->supplierMember->pluck('user_id')->toArray();
        $this->client_user_notes = SupplierUserNotes::where('note_id', '=', $this->notes->id)->get();
        return view('admin.suppliers-notes.view', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNotes $request, $id)
    {
        $note = Notes::findOrFail($id);
        $note->notes_title = $request->notes_title;
        $note->notes_type = $request->notes_type;
        $note->is_client_show = $request->is_client_show == 'on' ? 1 : 0;
        $note->ask_password = $request->ask_password == 'on' ? 1 : 0;
        $note->note_details = $request->note_details;
        $note->save();
        SupplierUserNotes::where('note_id', $note->id)->delete();
        if($request->notes_type == 1){
            $users = $request->user_id;
            if(!is_null($users)){
                foreach ($users as $user) {
                    $member = SupplierUserNotes::firstOrCreate([
                    'user_id' => $user,
                    'note_id' => $note->id
                    ]);
                }
            }
        }
        return Reply::success(__('messages.notesUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Notes::destroy($id);

        return Reply::success(__('messages.notesDeleted'));
    }

    public function clientStats($id)
    {
        return DB::table('users')
            ->select(
                DB::raw('(select count(projects.id) from `projects` WHERE projects.client_id = '.$id.') as totalProjects'),
                DB::raw('(select count(invoices.id) from `invoices` left join projects on projects.id=invoices.project_id WHERE invoices.status != "paid" and invoices.status != "canceled" and (projects.client_id = '.$id.' or invoices.client_id = '.$id.')) as totalUnpaidInvoices'),
                DB::raw('(select sum(payments.amount) from `payments` left join projects on projects.id=payments.project_id WHERE payments.status = "complete" and projects.client_id = '.$id.') as projectPayments'),
                DB::raw('(select sum(payments.amount) from `payments` inner join invoices on invoices.id=payments.invoice_id  WHERE payments.status = "complete" and invoices.client_id = '.$id.') as invoicePayments'),
                DB::raw('(select count(contracts.id) from `contracts` WHERE contracts.client_id = '.$id.') as totalContracts')
            )
            ->first();
    }
}
