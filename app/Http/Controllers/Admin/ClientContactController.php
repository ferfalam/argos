<?php

namespace App\Http\Controllers\Admin;

use App\ClientContact;
use App\ClientDetails;
use App\Contect;
use App\Helper\Reply;
use App\Http\Requests\ClientContacts\StoreContact;
use App\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ClientContactController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageIcon = 'icon-people';
        $this->pageTitle = 'app.menu.clients';
        $this->middleware(function ($request, $next) {
            abort_if(!in_array('clients', $this->user->modules), 403);
            return $next($request);
        });
    }

    public function show($id)
    {

        // $this->client = User::findClient($id);
        $this->clientDetail = ClientDetails::where('id', '=', $id)->first();
        $this->clientStats = $this->clientStats($id);

        if (!is_null($this->clientDetail)) {
            $this->clientDetail = $this->clientDetail->withCustomFields();
            $this->fields = $this->clientDetail->getCustomFieldGroupsWithFields()->fields;
        }

        return view('admin.client-contacts.show', $this->data);
    }

    public function data($id,$type = null)
    {
        if($type == 'supplier'){
            $timeLogs = Contect::where('supplier_detail_id', $id);
         
        }
        if($type == 'client')
        {
            $timeLogs = Contect::where('client_detail_id', $id);
        }

        if($type == 'spv')
        {
            $timeLogs = Contect::where('spv_detail_id', $id);
        }

        if ( !User::isAdmin(user()->id)) {
            $timeLogs->where('visible_by', 'like', '%' . user()->id . '%')
                ->orWhere('visible_by', 'all');
        }

        return DataTables::of($timeLogs->get())
            ->addColumn('action', function ($row) {
                return '<a href="'.route("admin.contact.edit",['id' => $row->id, 'type' => 'spv' ]).'" class="btn btn-info btn-circle edit-contact"
                data-toggle="tooltip" data-contact-id="' . $row->id . '"  data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                    <a href="javascript:;" class="btn btn-danger btn-circle sa-params"
                      data-toggle="tooltip" data-contact-id="' . $row->id . '" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>';
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
            ->editColumn('name', function ($row) {
                return ucwords($row->name);
            })
            ->rawColumns(["visibility", "action","id"])
            ->removeColumn('user_id')
            ->make(true);
    }

    public function store(StoreContact $request)
    {
        $contact = new ClientContact();
        $contact->user_id = $request->user_id;
        $contact->contact_name = $request->contact_name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->save();

        return Reply::success(__('messages.contactAdded'));
    }

    public function edit($id)
    {
        $this->contact = ClientContact::findOrFail($id);
        return view('admin.client-contacts.edit', $this->data);
    }

    public function update(StoreContact $request, $id)
    {
        $contact = ClientContact::findOrFail($id);
        $contact->contact_name = $request->contact_name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->save();

        return Reply::success(__('messages.contactUpdated'));
    }

    public function destroy($id)
    {
        ClientContact::destroy($id);

        return Reply::success(__('messages.contactDeleted'));
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
