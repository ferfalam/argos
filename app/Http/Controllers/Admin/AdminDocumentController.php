<?php

namespace App\Http\Controllers\Admin;

class AdminDocumentController extends AdminBaseController
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
    $this->pageTitle = 'app.menu.documents';
    return view('admin.document.index', $this->data);
  }
}
