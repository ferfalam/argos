<?php

namespace App\Http\Controllers\Admin;

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

  public function create()
  {
    $this->pageTitle = 'app.addContact';
    return view('admin.contact.create', $this->data);
  }
}
