<?php

namespace App\Http\Controllers\Admin;

use App\ClientCategory;
use App\ClientSubCategory;
use App\CompanyTLA;
use App\Country;

class AdminSuppliersController extends AdminBaseController
{

  public function __construct()
  {
    parent::__construct();
    $this->pageTitle = 'app.menu.suppliers';
    $this->pageIcon = 'icon-people';
    $this->countries = Country::all();
    $this->tla = CompanyTLA::all();
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->categories = ClientCategory::all();
    $this->subcategories = ClientSubCategory::all();
    return view('admin.suppliers.index', $this->data);
  }

  public function create(){
    $this->categories = ClientCategory::all();
    $this->subcategories = ClientSubCategory::all();
    return view('admin.suppliers.create', $this->data);
  }

  public function edit($id){
    $this->categories = ClientCategory::all();
    $this->subcategories = ClientSubCategory::all();
    return view('admin.suppliers.edit', $this->data);
  }
}
