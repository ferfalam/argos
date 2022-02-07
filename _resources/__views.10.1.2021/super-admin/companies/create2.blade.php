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
<link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css'>
<style>
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
    grid-template-columns: repeat(3, minmax(270px, 1fr));
    row-gap: 20px;
    align-items: stretch !important;
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
        <h2>@lang('app.add') @lang('app.company')</h2>
      </div>

      <div class="panel-wrapper collapse in" aria-expanded="true">
        <div class="panel-body">
          {!! Form::open(['id'=>'createCompany','class'=>'ajax-form','method'=>'POST', 'enctype' =>
          'multipart/form-data']) !!}
          <div class="form-body" style="margin-top: 40px">

            <div class="row">

              <div class="col-md-4">
                <fieldset>
                  <legend>Identifications</legend>
                  <div class="form-group">
                    <label for="company_name" class="required">Raison sociale</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="">
                    <a href="#!" class="invisible">
                      <img src="{{asset("img/plus.png")}}" alt="">
                    </a>
                  </div>

                  <div class="form-group">
                    <label for="company_name" class="required">Forme juridique</label>
                    <select name="timezone" id="timezone" class="form-control select2">
                      @foreach($timezones as $tz)
                      <option>{{ $tz }}</option>
                      @endforeach
                    </select>
                    <a href="#!">
                      <img src="{{asset("img/plus.png")}}" alt="">
                    </a>
                  </div>

                  <div class="form-group">
                    <label for="company_name" class="required">Forme juridique</label>
                    <textarea class="form-control" name="" id="" style="width:100%" rows="2"></textarea>
                    <a href="#!" class="invisible">
                      <img src="{{asset("img/plus.png")}}" alt="">
                    </a>
                  </div>

                  <div class="form-group">
                    <label for="company_name" class="required">Pays</label>
                    <select name="timezone" id="timezone" class="form-control select2">
                      @foreach($timezones as $tz)
                      <option>{{ $tz }}</option>
                      @endforeach
                    </select>
                    <a href="#!">
                      <img src="{{asset("img/plus.png")}}" alt="">
                    </a>
                  </div>                  

                  <div class="form-group">
                    <label for="company_name" class="required">CP/Ville</label>
                    <select name="timezone" id="timezone" class="form-control select2">
                      @foreach($timezones as $tz)
                      <option>{{ $tz }}</option>
                      @endforeach
                    </select>
                    <a href="#!">
                      <img src="{{asset("img/plus.png")}}" alt="">
                    </a>
                  </div>
                  

                </fieldset>
              </div>

              <div class="col-md-4">
                <fieldset>
                  <legend>Coordonées </legend>
                  
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

                  <div class="form-group">
                    <label for="company_name">Fax &nbsp; &nbsp;</label>
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
                    <label for="company_name" class="required">Email</label>
                    <input type="email" name="email" class="form-control" >
                    <a href="#!" class="invisible">
                      <img src="{{asset("img/plus.png")}}" alt="">
                    </a>
                  </div>

                  <div class="form-group">
                    <label for="company_name" class="required">Description</label>
                    <textarea class="form-control" name="" id="" style="width:100%" rows="2"></textarea>
                    <a href="#!" class="invisible">
                      <img src="{{asset("img/plus.png")}}" alt="">
                    </a>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">@lang('modules.accountSettings.companyLogo')
                    </label>
  
                    <div class="col-xs-12">
                      <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 250px; height: 80px;">
  
                          <img src="{{ $global->logo_url }}" alt="" />
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="width: 250px; height: 80px;">
                        </div>
                        <div>
                          <span class="btn btn-info btn-file btn-sm">
                            <span class="fileinput-new "> @lang('app.selectImage') </span>
                            <span class="fileinput-exists"> @lang('app.change') </span>
                            <input type="file" name="logo" id="logo"> 
                          </span>
                          <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> @lang('app.remove') </a>
                        </div>
                      </div>
  
                    </div>
                  </div>
                </fieldset>
              </div>

              <div class="col-md-4">
                <fieldset>
                  <legend>Contact principal</legend>
                  <div class="form-group">
                    <label for="" class="mb-0">Civilité</label>
                    <div class="d-flex">
                      <div class="form-group mb-0">
                        <input type="radio" name="demo1" >
                        <label for="demo1" style="margin-bottom: 0px">M</label>
                      </div>
                      <div class="form-group mb-0">
                        <input type="radio" name="demo1" >
                        <label for="demo1" style="margin-bottom: 0px">Mme</label>
                      </div>
                      <div class="form-group mb-0">
                        <button class="btn btn-sm btn-primary rounded-pill " style="display: inline-block !important; padding: 0px 12px !important">Lier contact</button>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="company_name" class="required">Prénom</label>
                    <input type="email" name="email" class="form-control" >
                    <a href="#!" class="invisible">
                      <img src="{{asset("img/plus.png")}}" alt="">
                    </a>
                  </div>

                  <div class="form-group">
                    <label for="company_name" class="required">Nom</label>
                    <input type="email" name="email" class="form-control" >
                    <a href="#!" class="invisible">
                      <img src="{{asset("img/plus.png")}}" alt="">
                    </a>
                  </div>

                  <div class="form-group">
                    <label for="company_name" class="required">Fonction</label>
                    <input type="email" name="email" class="form-control" >
                    <a href="#!" class="invisible">
                      <img src="{{asset("img/plus.png")}}" alt="">
                    </a>
                  </div>

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

                  <div class="form-group">
                    <label for="company_name">Fax &nbsp; &nbsp;</label>
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
            </div>


            <div class="row" style="margin-top: 20px">
              
              <div class="col-md-4">
                <fieldset>
                  <legend>Informations</legend>
                  <div class="form-group">
                    <label for="company_name" class="required">N°Siret</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="">
                    <a href="#!" class="invisible">
                      <img src="{{asset("img/plus.png")}}" alt="">
                    </a>
                  </div>

                  <div class="form-group">
                    <label for="company_name" class="required">Taux de TVA *</label>
                    <select name="timezone" id="timezone" class="form-control select2">
                      @foreach($timezones as $tz)
                      <option>{{ $tz }}</option>
                      @endforeach
                    </select>
                    <a href="#!">
                      <img src="{{asset("img/plus.png")}}" alt="">
                    </a>
                  </div>

                  <div class="form-group">
                    <label for="company_name" class="required">Devise</label>
                    <select name="timezone" id="timezone" class="form-control select2">
                      @foreach($timezones as $tz)
                      <option>{{ $tz }}</option>
                      @endforeach
                    </select>
                    <a href="#!">
                      <img src="{{asset("img/plus.png")}}" alt="">
                    </a>
                  </div> 

                  <div class="form-group">
                    <label for="company_name">N°TVA intrat</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="">
                    <a href="#!" class="invisible">
                      <img src="{{asset("img/plus.png")}}" alt="">
                    </a>
                  </div>

                                   

                  <div class="form-group">
                    <label for="company_name" >Secteur d’activité</label>
                    <select name="timezone" id="timezone" class="form-control select2">
                      @foreach($timezones as $tz)
                      <option>{{ $tz }}</option>
                      @endforeach
                    </select>
                    <a href="#!">
                      <img src="{{asset("img/plus.png")}}" alt="">
                    </a>
                  </div>

                  <div class="form-group">
                    <label for="company_name" class="required">Langue</label>
                    <select name="timezone" id="timezone" class="form-control select2">
                      @foreach($timezones as $tz)
                      <option>{{ $tz }}</option>
                      @endforeach
                    </select>
                    <a href="#!">
                      <img src="{{asset("img/plus.png")}}" alt="">
                    </a>
                  </div>
                  

                </fieldset>
              </div>

              <div class="col-md-4" style="grid-column: span 2">
                <fieldset class="d-flex">
                  <legend>Administrateur</legend>
                  <div class="d-flex align-items-center">
                    <div>
                      <div class="form-group">
                        <label for="company_name" class="required">Nom de l’administrateur</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" value="">
                        <a href="#!" class="invisible">
                          <img src="{{asset("img/plus.png")}}" alt="">
                        </a>
                      </div>
    
                      <div class="form-group">
                        <label for="company_name" class="required">Login/Email</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" value="">
                        <a href="#!" class="invisible">
                          <img src="{{asset("img/plus.png")}}" alt="">
                        </a>
                      </div>
    
                      <div class="form-group">
                        <label for="company_name" class="required">Mot de passe</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" value="">
                        <a href="#!" class="invisible">
                          <img src="{{asset("img/plus.png")}}" alt="">
                        </a>
                      </div>
                    </div>

                    <div>
                      <img src="{{asset('img/logo-placeholder.png')}}" alt="">
                    </div>

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

<script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script>
  $(".select2").select2({
            formatNoMatches: function () {
                return "{{ __('messages.noRecordFound') }}";
            }
        });

        $('#save-formd').click(function () {

            $.easyAjax({
                url: '{{route('super-admin.companies.store')}}',
                container: '#createCompany',
                type: "POST",
                redirect: true,
                file: true,
            });
        });
</script>

@endpush