@extends('layouts.super-admin')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 bg-title-left">
            <h4 class="page-title"> {{ __($pageTitle) }}</h4>
        </div>
        <!-- /.page title -->
    </div>
@endsection

@push('head-script')
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<style>
    .m-b-10{
        margin-bottom: 10px;
    }
    legend {
      display: inline-block;
      padding: 0;
      margin-left: 20px;
      margin-bottom: 0px;
      font-size: 15px;
      line-height: inherit;
      font-family: var(--font-primary);
      font-weight: 400;
      border-bottom: none;
      width: max-content;
      padding-right: 20px;
      color: #333;
    }
  
    fieldset{
      border: 1px solid #DBD2D2;
      padding: 10px;
      height: 100%;
    }
  
    .btn-reset{
      background: #C0CDD3 !important;
      margin-right: 10px;
    }
  
    .row{
      display: grid !important;
      grid-template-columns: 1fr 1fr 200px;
      row-gap: 20px;
      align-items: stretch !important;
    }

    .fileinput-new{
        margin: 0 auto; 
    }

    #image,
    .btn-file{
        background-color: #4CACC1 !important;
    }

    .text-secondary{
        font-size: 11px;
        line-height: 14px;
        text-align: center;
        color: #111111;
    }
  
    @media only screen and (max-width : 1240px){
      .row{
        grid-template-columns: repeat(2, minmax(270px, 1fr));
      }
    }
  
    @media only screen and (max-width : 1040px){
      .row{
        grid-template-columns: repeat(1, minmax(270px, 1fr));
      }
    }
  
    .row .col-md-4{
      width: 100%;
      height: 100% !important; 
    }
  
    fieldset .form-group  {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 5px;
      width: 100%;
      flex-grow: 1;
    }
  
    fieldset .form-group  label{
      min-width: max-content;
      margin-right: 5px;
      vertical-align: middle;
    }
  
    fieldset .form-group  input,
    fieldset .form-group  textarea{
      margin-left: auto;
    }
  
    .input-group-btn .flag-icon{
      width: 17px;
      height: 14px;
    }
  
    .input-group-btn .btn{
      padding: 6px 8px !important;
      background-color: white;
      border:1px solid #CCCCD1;
    }
  
  </style>
@endpush

@section('content')

<div class="">
    <div class="col-xs-12">
  
      <div class="panel-4">
        <div class="panel-heading">
          <h2>FICHE UTILISATEUR</h2>
        </div>
  
        <div class="panel-wrapper collapse in" aria-expanded="true">
          <div class="panel-body">
            {!! Form::open(['id'=>'createCompany','class'=>'ajax-form','method'=>'POST', 'enctype' =>
            'multipart/form-data']) !!}
            <div class="form-body" style="margin-top: 40px">
  
              <div class="row">
  
                <div class="col-md-4">
                  <fieldset>
                    <legend>Informations Générales</legend>

                    <div class="form-group">
                        <label for="" class="mb-0">Civilité</label>
                        <div class="d-flex" style="margin-right: 40px; gap:20px">
                          <div class="form-group mb-0">
                            <input type="radio" name="demo1" >
                            <label for="demo1" style="margin-bottom: 0px">M</label>
                          </div>
                          <div class="form-group mb-0">
                            <input type="radio" name="demo1" >
                            <label for="demo1" style="margin-bottom: 0px">Mme</label>
                          </div>
                        </div>
                    </div>

                    <div class="form-group">
                      <label for="company_name" class="required">Nom & Prénom </label>
                      <input type="text" class="form-control" id="company_name" name="company_name" value="">
                      <a href="#!" class="invisible">
                        <img src="{{asset("img/plus.png")}}" alt="">
                      </a>
                    </div>
  
                    <div class="form-group">
                      <label for="company_name" class="required">Adresse</label>
                      <textarea class="form-control" name="" id="" style="width:100%" rows="2"></textarea>
                      <a href="#!" class="invisible">
                        <img src="{{asset("img/plus.png")}}" alt="">
                      </a>
                    </div>
  
                    <div class="form-group">
                      <label for="company_name" class="required">Pays</label>
                      <select name="timezone" id="timezone" class="form-control select2">
                        <option value="">Options</option>
                      </select>
                      <a href="#!">
                        <img src="{{asset("img/plus.png")}}" alt="">
                      </a>
                    </div>                  
  
                    <div class="form-group">
                      <label for="company_name" class="required">CP/Ville</label>
                      <select name="timezone" id="timezone" class="form-control select2">
                        <option value="">Options</option>
                      </select>
                      <a href="#!">
                        <img src="{{asset("img/plus.png")}}" alt="">
                      </a>
                    </div>
                    
  
                  </fieldset>
                </div>
  
                <div class="col-md-4">
                  <fieldset>
                    <legend>Autres informations</legend>

                    <div class="form-group">
                        <label for="company_name" class="required">Profil</label>
                        <select name="timezone" id="timezone" class="form-control select2">
                          <option value="">Options</option>
                        </select>
                        <a href="#!" class="invisible">
                          <img src="{{asset("img/plus.png")}}" alt="">
                        </a>
                    </div>              

                    <div class="form-group">
                        <label for="company_name" class="required">Qualification</label>
                        <select name="timezone" id="timezone" class="form-control select2">
                          <option value="">Options</option>
                        </select>
                        <a href="#!" class="invisible">
                          <img src="{{asset("img/plus.png")}}" alt="">
                        </a>
                    </div>              

                    
                    <div class="form-group">
                        <label for="company_name" class="required">Date de naissance</label>
                        <input type="text" name="text" class="form-control" >
                        <a href="#!" class="invisible">
                          <img src="{{asset("img/plus.png")}}" alt="">
                        </a>
                    </div>

                    <div class="form-group">
                        <label for="company_name" class="required">Pays de naissance</label>
                        <select name="timezone" id="timezone" class="form-control select2">
                          <option value="">Options</option>
                        </select>
                        <a href="#!">
                          <img src="{{asset("img/plus.png")}}" alt="">
                        </a>
                    </div>              

                    <div class="form-group">
                        <label for="company_name" class="required">Nationalité</label>
                        <select name="timezone" id="timezone" class="form-control select2">
                          <option value="">Options</option>
                        </select>
                        <a href="#!">
                          <img src="{{asset("img/plus.png")}}" alt="">
                        </a>
                    </div>              

                    <div class="form-group">
                        <label for="company_name" class="required">Langue</label>
                        <select name="timezone" id="timezone" class="form-control select2">
                          <option value="">Options</option>
                        </select>
                        <a href="#!">
                          <img src="{{asset("img/plus.png")}}" alt="">
                        </a>
                    </div>              

                    <div class="form-group">
                      <label for="company_name" class="required">Observations</label>
                      <textarea class="form-control" name="" id="" style="width:100%" rows="2"></textarea>
                      <a href="#!" class="invisible">
                        <img src="{{asset("img/plus.png")}}" alt="">
                      </a>
                    </div>
                  </fieldset>
                </div>

                <div class="col-md-4">

                    <div class="form-group m-t-10">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 123px; height: 137px;">
                                <img src="https://via.placeholder.com/200x150.png?text={{ str_replace(' ', '+', __('modules.profile.uploadPicture')) }}"
                                    alt="" />
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail"
                                style="max-width: 200px; max-height: 150px;"></div>
                            <div>
                                <span class="btn btn-info btn-file">
                                    <span class="fileinput-new"> @lang('app.selectImage') </span>
                                    <span class="fileinput-exists"> @lang('app.change') </span>
                                    <input type="file" name="image" id="image"> </span>
                                <a href="javascript:;" class="btn btn-danger fileinput-exists"
                                    data-dismiss="fileinput"> @lang('app.remove') </a>
                            </div>
                        </div>
                        <p class="text-secondary">Format et limite de votre image :</p>
                        <p class="text-secondary">(JPG,JPEG,PNG,GIF | 15Mo max.)</p>
                    </div>
                </div>
  
                <div class="col-md-4">
                  <fieldset>
                    <legend>Coordonées</legend>
                    
                    <div class="form-group">
                      <label for="company_name" class="required">Email</label>
                      <input type="email" name="email" class="form-control" >
                      <a href="#!" class="invisible">
                        <img src="{{asset("img/plus.png")}}" alt="">
                      </a>
                    </div>
  
  
                    <div class="form-group">
                      <label for="company_name">Tel</label>
                      <div class="input-group">
                        <div class="input-group-btn">
                          <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-fr"></span> <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li>
                              <a href="">
                                <span class="flag-icon flag-icon-fr"></span>
                                France
                              </a>
                            </li>
                          </ul>
                        </div><!-- /btn-group -->
                        <input type="text" class="form-control" aria-label="...">
                      </div><!-- /input-group -->
                      <a href="#!" class="invisible">
                        <img src="{{asset("img/plus.png")}}" alt="">
                      </a>
                    </div>
  
                    <div class="form-group">
                      <label for="company_name">Mobile</label>
                      <div class="input-group">
                        <div class="input-group-btn">
                          <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-fr"></span> <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li>
                              <a href="">
                                <span class="flag-icon flag-icon-fr"></span>
                                France
                              </a>
                            </li>
                          </ul>
                        </div><!-- /btn-group -->
                        <input type="text" class="form-control" aria-label="...">
                      </div><!-- /input-group -->
                      <a href="#!" class="invisible">
                        <img src="{{asset("img/plus.png")}}" alt="">
                      </a>
                    </div>
  
                  </fieldset>
                </div>

                <div class="col-md-4">
                  <fieldset>
                    <legend>Connexion</legend>
                    
                    <div class="form-group">
                      <label for="company_name" class="required">Login</label>
                      <input type="email" name="email" class="form-control" >
                      <a href="#!" class="invisible">
                        <img src="{{asset("img/plus.png")}}" alt="">
                      </a>
                    </div>

                    <div class="form-group">
                      <label for="company_name" class="required">Mot de passe</label>
                      <input type="email" name="email" class="form-control" >
                      <a href="#!" class="invisible">
                        <img src="{{asset("img/plus.png")}}" alt="">
                      </a>
                    </div>

  
                  </fieldset>
                </div>


              </div>

            </div>
  
            <div class="form-actions" style="margin-top: 20px">
              <button class="btn btn-reset" type="reset">Annuler</button>
              <button type="submit" id="save-form" class="btn btn-success"> Enregistrer</button>
  
  
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div> <!-- .row -->
  

@endsection

@push('footer-script')
<script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

<script>
    $('#save-form').click(function () {
        $.easyAjax({
            url: '{{route('super-admin.super-admin.store')}}',
            container: '#createClient',
            type: "POST",
            redirect: true,
            data: $('#createClient').serialize()
        })
    });
</script>
@endpush

