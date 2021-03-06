<?php

namespace App\Http\Controllers\Admin;

use App\Project;

class ManageProjectPaymentsController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'app.menu.projects';
        $this->pageIcon = 'icon-layers';
        $this->middleware(function ($request, $next) {
            abort_if(!in_array('payments', $this->user->modules), 403);
            return $next($request);
        });
    }

    public function show($id)
    {
        $this->project = Project::with('supplierpayments')->findorFail($id);
        return view('admin.projects.payments.show', $this->data);
    }

    public function showreglement($id)
    {
        $this->project = Project::with('clientpayments')->findorFail($id);
        return view('admin.projects.reglement.show', $this->data);
    }

}
