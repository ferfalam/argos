<?php

namespace App\Http\Controllers\Admin;

class AdminCoalController extends AdminBaseController
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
    $this->pageTitle = 'app.menu.coal_index';
    return view('admin.coal.index', $this->data);
  }

  public function acceptability()
  {
    $this->pageTitle = 'app.menu.coal_acceptability';
    return view('admin.coal.acceptability', $this->data);
  }
}
