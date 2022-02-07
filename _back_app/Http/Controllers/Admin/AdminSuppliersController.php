<?php

namespace App\Http\Controllers\Admin;

class AdminSuppliersController extends AdminBaseController
{

  public function __construct()
  {
    parent::__construct();
    $this->pageTitle = 'app.menu.suppliers';
    $this->pageIcon = 'icon-people';
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('admin.suppliers.index', $this->data);
  }
}
