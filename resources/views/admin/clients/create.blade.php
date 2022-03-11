@extends('layouts.app')


@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/cc-picker/jquery.ccpicker.css') }}">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css'>
    <style>
        .form-body{
            display: grid;
        }

        #s2id_hyper_text{
            margin-top: 6px !important;
        }

        #s2id_salutation{
            margin-top: 7px !important;
        }
    </style>
@endpush

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 bg-title-left">
            <h4 class="page-title">  {{ __($pageTitle) }}</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 bg-title-right">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li><a href="{{ route('admin.clients.index') }}">{{ __($pageTitle) }}</a></li>
                <li class="active">@lang('app.addNew')</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/summernote/dist/summernote.css') }}">
<style>


    #s2id_category_id{
        width: 210px !important;
    }

    #s2id_function{
        width: 210px !important;
    }

    #s2id_contact_principal{
        width: 210px !important;
    }
    .salutation .form-control {
        padding: 2px 2px;
    }
    .select-category button{
        background-color: white !important;
        font-size: 13px;
        color: #565656;
        border: 1px solid #e4e7ea !important;
    }
   .select-category button:hover{
    color: #565656;
    opacity: 1;
   }
  
   .bootstrap-select .dropdown-toggle:focus{
    outline: none !important;
   }

   .cc-picker {
        padding: 6px 8px !important;
        background-color: white;
        border: 1px solid #CCCCD1;
        display: flex;
        width: 100px;
        align-items: center;
        border-radius: 3px
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

    fieldset {
        border: 1px solid #DBD2D2;
        padding: 10px;
        height: 100%;
        margin-top: 20px;
    }

    .btn-reset {
        background: #C0CDD3 !important;
        margin-right: 10px;
    }

    .row {
        display: grid !important;
        grid-template-columns: repeat(3, minmax(270px, 1fr));
        row-gap: 20px;
        align-items: stretch !important;
    }

    @media only screen and (max-width : 1240px) {
        .row {
            grid-template-columns: repeat(2, minmax(270px, 1fr));
        }
    }

    @media only screen and (max-width : 1040px) {
        .row {
            grid-template-columns: repeat(1, minmax(270px, 1fr));
        }
    }

    .row .col-md-4 {
        width: 100%;
        height: max-content !important;
    }

    fieldset .form-group {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 5px;
        width: 100%;
        flex-grow: 1;
    }

    fieldset .form-group label,
    fieldset tr td {
        min-width: min-content !important;
        margin-right: 5px;
        vertical-align: middle;
    }

    td:nth-child(1) {
        display: flex;
        align-items: center;
        padding: 15px 0px;
    }

    td:nth-child(3) {
        padding-left: 5px;
    }

    fieldset table td label {
        color: #000000 !important;
        font-family: "Roboto", sans-serif !important;
        font-size: 15px !important;
        font-weight: 500;
    }

    fieldset table .required:after {
        content: " *";
        color: red;
    }

    fieldset .form-group input,
    fieldset .form-group textarea {
        margin-left: auto;
    }

    .input-group-btn .flag-icon {
        width: 17px;
        height: 14px;
    }

    .input-group-btn .btn {
        padding: 6px 8px !important;
        background-color: white;
        border: 1px solid #CCCCD1;
    }

    .phonecode-select {
        max-height: 300px;
        overflow: auto;
    }

    .cc-picker {
        padding: 6px 8px !important;
        background-color: white;
        border: 1px solid #CCCCD1;
        display: flex;
        width: 100px;
        align-items: center;
        border-radius: 3px
    }

    .datepicker td:nth-child(1),
    .category-table td:nth-child(1) {
        display: table-cell;
    }

    .my-custom-scrollbar {
        position: relative;
        max-height: 200px;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }

    .category-table {
        max-width: 560px !important;
    }

  
</style>
@endpush

@section('content')
    <div class="row" style="display: flex !important;">
        <div class="col-xs-12">
            <div class="panel panel-inverse">
                <div class="panel-heading"> @lang('modules.client.createTitle')</div>

                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        {!! Form::open(['id' => 'createClient', 'class' => 'ajax-form', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-body" style="margin-top:   0px">

                            <div class="row">

                                <div class="col-md-4">
                                    <fieldset>
                                        <legend>Identifications</legend>
                                        <table>
                                            <tr>
                                                <td><label for="company_name" class="required">@lang('app.name_ucfirst')</label></td>
                                                <td>
                                                    <input type="text" class="form-control" id="company_name" name="company_name" value="">
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="address" class="required">@lang('app.address')</label>
                                                </td>
                                                <td><textarea class="form-control" name="address" id="address"
                                                        style="width:100%" rows="2"></textarea></td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label for="country" class="required">@lang('app.country')</label>
                                                </td>
                                                <td>
                                                    <select name="country" id="country" class="form-control select2">
                                                        @foreach ($countries as $country)
                                                            <option value=" {{ $country->id }} ">
                                                                {{ ucfirst(strtolower($country->name)) }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label for="city" class="required">@lang('app.cp')</label>
                                                </td>
                                                <td>
                                                    <select name="city" id="city" class="form-control select2">
                                                        <option value="" disabled>@lang('app.cp')</option>
                                                        @foreach ($tla as $t)
                                                            @if ($t->type == 'city')
                                                                <option value=" {{ $t->id }} ">
                                                                    {{ ucfirst(strtolower($t->name)) }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="javascript:;" class="text-info plus-form">
                                                        <img src="{{ asset('img/plus.png') }}" alt="" data-type="city"> </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </fieldset>

                                    <fieldset>
                                        <legend>Description </legend>
                                        <table>
                                            <tr>
                                                <td colspan="3" style="padding-top: 0px">
                                                    <textarea name="observation" id="observation"  class="form-control w-100" style="width: 100%;"  rows="5"></textarea>
                                                </td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </div>

                                <div class="col-md-4">
                                    <fieldset>
                                        <legend>Coordonées </legend>
                                        <table>
                                            <tr>
                                                <td>
                                                    <label for="company_phone" class="required">Tel</label>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <input type="text" name="company_phone" id="company_phone"
                                                            class="form-control phone-input ccpicker" aria-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label for="mobile" class="required">Mobile</label>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <input type="text" name="mobile" id="mobile"
                                                            class="form-control phone-input ccpicker" aria-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label for="fax" class="required">Fax</label>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <input type="text" name="fax" id="fax"
                                                            class="form-control phone-input ccpicker" aria-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label for="company_email" class="required">Email</label>
                                                </td>
                                                <td>
                                                    <input type="email" id="company_email" name="company_email" class="form-control">

                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>

                                                </td>
                                            </tr>
                                        </table>
                                    </fieldset>

                                    <fieldset>
                                        <legend>Informations Générales </legend>
                                        <table>
                                            
                                            <tr >        
                                                <td>
                                                    <label for="category_id" class="required">Catégorie Client</label>
                                                </td>
                                                <td >
                                                    <select  name="category_id" id="category_id" class="form-control select2">
                                                        @foreach ($categories as $categorie)
                                                            <option value="{{ $categorie->id }}" >
                                                                {{ $categorie->category_name }}
                                                            </option>
                                                        @endforeach     
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="Javascript:;" class="text-info category-form " >
                                                        <img src="{{ asset('img/plus.png') }}" alt="" data-type="category">
                                                    </a>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td>
                                                    <label for="sub_category_id" class="required">Sous Catégorie</label>
                                                </td>
                                                <td>
                                                    <select  name="sub_category_id" id="sub_category_id" class="form-control select2">
                                                        @foreach ($subcategories as $subcategorie)
                                                            <option value="{{ $subcategorie->id }}" >
                                                                {{ $subcategorie->category_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="Javascript:;" class="text-info subcategory-form ">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td>
                                                    <label for="language" class="required">Langue</label>
                                                </td>
                                                <td>
                                                    <select name="language" id="language" class="form-control select2">
                                                        <option @if ($global->locale == 'en') selected @endif value="en">
                                                            English
                                                        </option>
                                                        @foreach ($languageSettings as $language)
                                                            <option value="{{ $language->language_code }}"
                                                                @if ($global->locale == $language->language_code) selected @endif>
                                                                {{ $language->language_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="Javascript:;" class="text-info language-form "> 
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>

                                        </table>
                                    </fieldset>

                                    
                                    <fieldset>
                                        <legend>Informations Générales </legend>
                                        <table>
                                            
                                            <tr>
                                                <td>
                                                    <label for="emailNotification" class="required">Notification Par Mail</label>
                                                </td>
                                                <td>
                                                    <select name="emailNotification" id="emailNotification" class="form-control select2">
                                                        <option value="1">Oui</option>
                                                        <option value="0">Non</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td>
                                                    <label for="smsNotification" class="required">Notification Par SMS</label>
                                                </td>
                                                <td>
                                                    <select name="smsNotification" id="smsNotification" class="form-control select2">
                                                        <option value="1">Oui</option>
                                                        <option value="0">Non</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible" >
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>

                                        </table>
                                    </fieldset>

                                </div>

                                <div class="col-md-4">
                                    <fieldset>
                                        <legend>Administrateur</legend>
                                        <div class="d-flex align-items-center">
                                            <table>

                                                <tr>
                                                    <td>
                                                        <label for="" class="mb-0">Contact Principal</label>
                                                    </td>
                                                    <td>
                                                        <select name="contact_principal" id="contact_principal" class="form-control select2">
                                                            <option value="without_user">create without contact Principal</option>
                                                            {{-- <option value="select">select from the list </option> --}}
                                                            <option value="create">create a new one</option>
                                                            @foreach($contects as $contect)
                                                                <option data='{!!$contect!!}'  value="{{ $contect->id}}"> {{ $contect->name }}  </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <a href="#!" class="invisible"  >
                                                            <img src="{{ asset('img/attach-to.png') }}" alt="">
                                                        </a>
                                                    </td>
                                                </tr>

                                                {{-- <tr>
                                                    <td>
                                                        <label for="" class="mb-0">Contact</label>
                                                    </td>
                                                    <td>
                                                        <select name="contact" id="contact" class="form-control select2">
                                                           <option value="">Selection</option>
                                                        @foreach($contects as $contect)
                                                            <option value="{{$contect->id }}">{{ $contect->name }}</option>
                                                        @endforeach --}}
                                                            {{-- <option value="select">select from the list </option> --}}
                                                            {{-- <option value="create">create a new one</option> --}}
                                                        {{-- </select>
                                                    </td>
                                                    <td>
                                                        <a href="#!" class="invisible"  >
                                                            <img src="{{ asset('img/attach-to.png') }}" alt="">
                                                        </a>
                                                    </td>
                                                </tr> --}}

                                                

                                                <tr>
                                                    <td>
                                                        <label for="" class="mb-0">@lang('app.civility')</label>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex" style="margin-right: 40px; gap:20px">
                                                            <div class="form-group mb-0">
                                                                <input type="radio" name="gender" value="male">
                                                                <label for="gender" style="margin-bottom: 0px">M</label>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <input type="radio" name="gender" value="female">
                                                                <label for="gender" style="margin-bottom: 0px">Mme</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#!" class="invisible" >
                                                            <img src="{{ asset('img/attach-to.png') }}" alt="">
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label for="name" class="required">Nom/Prénom</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" id="name" name="name" value="">
                                                    </td>
                                                    <td>
                                                        <a href="#!" class="invisible">
                                                            <img src="{{ asset('img/plus.png') }}" alt="">
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label for="function" class="required">Fonction</label>
                                                    </td>
                                                    <td>
                                                        <select name="function" id="function" class="form-control select2">
                                                            @foreach ($designations as $designation)
                                                                <option value="{{ $designation->name }}">
                                                                    {{$designation->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <a href="#!" class="invisible">
                                                            <img src="{{ asset('img/plus.png') }}" alt="">
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="email" class="required">Email</label>
                                                    </td>
                                                    <td>
                                                        <input type="email" class="form-control" id="email" name="email" value="">
                                                    </td>
                                                    <td>
                                                        <a href="#!" class="invisible">
                                                            <img src="{{ asset('img/plus.png') }}" alt="">
                                                        </a>
                                                    </td>
                                                </tr>

                                                {{-- <tr>
                                                    <td>
                                                        <label for="password"
                                                            class="required">@lang('app.motdepasse')</label>
                                                    </td>
                                                    <td>
                                                        <input type="password" name="password" id="password" class="form-control">
                                                    </td>
                                                </tr> --}}


                                                {{-- <tr>
                                                    <td>
                                                        <label for="p_phone" class="required">Tel</label>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <input type="text" name="p_phone" id="p_phone"
                                                                class="form-control phone-input ccpicker" aria-label="...">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#!" class="invisible">
                                                            <img src="{{ asset('img/plus.png') }}" alt="">
                                                        </a>
                                                    </td>
                                                </tr> --}}
    
                                                <tr>
                                                    <td>
                                                        <label for="p_mobile" class="required">Mobile</label>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <input type="text" name="p_mobile" id="p_mobile"
                                                                class="form-control phone-input ccpicker" aria-label="...">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#!" class="invisible">
                                                            <img src="{{ asset('img/plus.png') }}" alt="">
                                                        </a>
                                                    </td>
                                                </tr>
    
                                                {{-- <tr>
                                                    <td>
                                                        <label for="fax" class="required">Fax</label>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <input type="text" name="p_fax" id="p_fax"
                                                                class="form-control phone-input ccpicker" aria-label="...">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#!" class="invisible">
                                                            <img src="{{ asset('img/plus.png') }}" alt="">
                                                        </a>
                                                    </td>
                                                </tr> --}}


                                                <tr>
                                                    <td><label for="visibility" class="required">@lang('app.visibility')
                                                        </label></td>
                                                    <td>
                                                        <input type="text" class="form-control" id="visibility" name="visibility"
                                                            value="">
                                                    <td>
                                                        <a href="#!" class="invisible">
                                                            <img src="{{ asset('img/plus.png') }}" alt="">
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="contact_type" class="required">@lang('app.contact_type')</label>
                                                    </td>
                                                    <td>
                                                        <select name="contect_type" id="contect_type" class="form-control select2" >
                                                            <option value="free" disabled>Free</option>
                                                            <option value="client">Client</option>
                                                            <option value="supplier" disabled>Supplier</option>
                                                            <option value="spv" disabled>Spv</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <a href="#!" class="invisible">
                                                            <img src="{{ asset('img/plus.png') }}" alt="">
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td class="text-center" colspan="2">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail"
                                                                style="width: 123px; height: 137px;">
                                                                <img src="https://via.placeholder.com/200x150.png?text={{ str_replace(' ', '+', __('modules.profile.uploadPicture')) }}"
                                                                    alt="" id="contact_img" />
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail"
                                                                style="max-width: 200px; max-height: 150px;"></div>
                                                            <div class="mt-5">
                                                                <span class="btn btn-info btn-file">
                                                                    <span class="fileinput-new"> @lang('app.selectImage') </span>
                                                                    <span class="fileinput-exists"> @lang('app.change') </span>
                                                                    <input type="file" name="image" id="image"> </span>
                                                                <a href="javascript:;" class="btn btn-danger fileinput-exists"
                                                                    data-dismiss="fileinput"> @lang('app.remove') </a>
                                                            </div>
                                                            <div class="mt-1">
                                                                <p class="text-secondary" style="font-size: 12px;">@lang('app.fomatimage')</p>
                                                                <p class="text-secondary" style="font-size: 12px;">(JPG,JPEG,PNG,GIF | 15Mo max.)</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                            </table>
                                        </div>

                                    </fieldset>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions" style="margin-top: 20px">
                            <button type="submit" id="save-form" class="btn btn-success"> Enregistrer</button>
                        </div>
                        {!! Form::close() !!}

                        {{-- {!! Form::open(['id'=>'createClient','class'=>'ajax-form','method'=>'POST']) !!}
                            @if(isset($leadDetail->id))
                                <input type="hidden" name="lead" value="{{ $leadDetail->id }}">
                            @endif
                            <div class="form-body">
                                <h3 class="box-title ">@lang('modules.client.clientDetails')</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1 ">
                                        <div class="form-group salutation" style="margin-top: 23px">
                                        <select name="salutation" id="salutation" class="form-control">
                                            <option value="">--</option>
                                            <option @if(isset($firstName) && $firstName == 'mr' ) selected @endif  value="mr">@lang('app.mr')</option>
                                            <option @if(isset($firstName) && $firstName == 'mrs' ) selected @endif value="mrs">@lang('app.mrs')</option>
                                            <option @if(isset($firstName) && $firstName == 'miss' ) selected @endif value="miss">@lang('app.miss')</option>
                                            <option @if(isset($firstName) && $firstName == 'dr' ) selected @endif value="dr">@lang('app.dr')</option>
                                            <option @if(isset($firstName) && $firstName == 'sir' ) selected @endif value="sir">@lang('app.sir')</option>
                                            <option @if(isset($firstName) && $firstName == 'madam' ) selected @endif value="madam">@lang('app.madam')</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 ">
                                        <div class="form-group">
                                            <label class="required">@lang('modules.client.clientName')</label>
                                            <input type="text" name="name" id="name"  value="{{ $leadName ?? '' }}"   class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="required">@lang('modules.client.clientEmail')</label>
                                            <input type="email" name="email" id="email" value="{{ $leadDetail->client_email ?? '' }}"  class="form-control">
                                            <span class="help-block">@lang('modules.client.emailNote')</span>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="required">@lang('modules.employees.employeePassword')</label>
                                            <input type="password" style="display: none">
                                            <input type="password" name="password" id="password" class="form-control" autocomplete="nope">
                                            <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            <span class="help-block"> @lang('modules.client.passwordNote') </span>
                                            <div class="checkbox checkbox-info">
                                                <input id="random_password" name="random_password" value="true" type="checkbox">
                                                <label for="random_password">@lang('modules.client.generateRandomPassword')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h3 class="box-title m-t-20">@lang('modules.client.companyDetails')</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">@lang('modules.client.companyName')</label>
                                            <input type="text" id="company_name" name="company_name" value="{{ $leadDetail->company_name ?? '' }}" class="form-control" >
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-1 ">
                                        <div class="form-group salutation" style="margin-top: 23px">
                                        <select name="hyper_text" id="hyper_text" class="form-control">
                                            <option value="">--</option>
                                            <option value="http://">http://</option>
                                            <option value="https://">https://</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="control-label">@lang('modules.client.website')</label>
                                            <input type="text" id="website" name="website" value="{{ $leadDetail->website ?? '' }}" class="form-control" >
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">@lang('app.address')</label>
                                            <textarea name="address"  id="address"  rows="5"  class="form-control">{{ $leadDetail->address ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <!--/span-->

                                </div>
                                <!--/row-->
                                <div class="row">
                                <div class="col-md-6" >      
                                        <label>@lang('app.mobile')</label>
                                        <div class="form-group" style="display: flex; align-items: stretch; width:100%;">
                                            <select class="select2 phone_country_code form-control" name="phone_code">
                                                <option value ="">--</option>
                                                @foreach ($countries as $item)
                                                <option @if (isset($code[0]) && $item->phonecode == $code[0])
                                                    selected
                                                    @endif value="{{ $item->id }}">+{{ $item->phonecode.' ('.$item->iso.')' }}</option>
                                                @endforeach
                                            </select>
                                            <input type="tel" name="mobile" id="mobile" class="form-control mobile" autocomplete="nope" value="{{ $mobileNo ?? '' }}" style="width: 100%">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label>@lang('modules.clients.officePhoneNumber')</label>
                                            <input type="text" name="office_phone" id="office_phone"  value="{{ $leadDetail->office_phone ?? '' }}" class="form-control">
                                        </div>
                                    </div>
                                <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label>@lang('modules.stripeCustomerAddress.city')</label>
                                            <input type="text" name="city" id="city" value="{{ $leadDetail->city ?? '' }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label>@lang('modules.stripeCustomerAddress.state')</label>
                                            <input type="text" name="state" id="state"  value="{{ $leadDetail->state ?? '' }}"   class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">@lang('modules.clients.country')</label>
                                            <select class="select2 form-control"  id="country_id" name="country_id">
                                                @foreach($countries as $country)
                                                    <option @if(isset($leadDetail->country) && $leadDetail->country == $country->nicename) selected @elseif($country->nicename == 'France') selected @endif value="{{ $country->id }}">{{ $country->nicename }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label>@lang('modules.stripeCustomerAddress.postalCode')</label>
                                            <input type="text" name="postal_code" id="postalCode"  value="{{ $leadDetail->postal_code ?? '' }}"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">@lang('modules.clients.clientCategory')
                                                        <a href="javascript:;" id="addClientCategory" class="text-info"><i
                                                                class="ti-settings text-info"></i> </a>
                                                </label>
                                                <select class="select2 form-control client-category" data-placeholder="@lang('modules.clients.clientCategory')"  id="category_id" name="category_id">
                                                <option value="">@lang('messages.pleaseSelectCategory')</option>
                                                @forelse($categories as $category)
                                                <option value="{{ $category->id }}">{{ ucwords($category->category_name) }}</option>
                                                    @empty
                                                <option value="">@lang('messages.noCategoryAdded')</option>
                                                    @endforelse
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">@lang('modules.clients.clientSubCategory')
                                                        <a href="javascript:;" id="addClientSubCategory" class="text-info">
                                                        <i class="ti-settings text-info"></i> </a>
                                                </label>
                                                <select class="selectpicker form-control select-category" data-placeholder="@lang('modules.clients.clientSubCategory')"  id="sub_category_id" name="sub_category_id">                                                 
                                                <option value="">@lang('messages.noSubCategoryAdded')</option> 
                                                @forelse($subcategories as $subCategory)
                                                <option value="{{ $subCategory->id }}">{{ ucwords($subCategory->category_name) }}</option>
                                            @empty
                                                <option value="">@lang('messages.noProductCategory')</option>
                                            @endforelse  
                                                </select>
                                            </div>
                                        </div>
                                    
                                </div>
                                </div>

                                <h3 class="box-title m-t-20">@lang('modules.client.clientOtherDetails')</h3>
                                <hr>
                                <!--/row-->
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Skype</label>
                                            <input type="text" name="skype" id="skype" class="form-control">
                                        </div>
                                    </div>
                                    <!--/span-->

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Linkedin</label>
                                            <input type="text" name="linkedin" id="linkedin" class="form-control">
                                        </div>
                                    </div>
                                    <!--/span-->

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Twitter</label>
                                            <input type="text" name="twitter" id="twitter" class="form-control">
                                        </div>
                                    </div>
                                    <!--/span-->

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Facebook</label>
                                            <input type="text" name="facebook" id="facebook" class="form-control">
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="gst_number">@lang('app.gstNumber')</label>
                                            <input type="text" id="gst_number" name="gst_number" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->

                                <div class="row">
                                    @if(isset($fields))
                                        @foreach($fields as $field)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label @if($field->required == 'yes') class="required" @endif>{{ ucfirst($field->label) }}</label>
                                                    @if( $field->type == 'text')
                                                        <input type="text" name="custom_fields_data[{{$field->name.'_'.$field->id}}]" class="form-control" placeholder="{{$field->label}}" value="{{$editUser->custom_fields_data['field_'.$field->id] ?? ''}}">
                                                    @elseif($field->type == 'password')
                                                        <input type="password" name="custom_fields_data[{{$field->name.'_'.$field->id}}]" class="form-control" placeholder="{{$field->label}}" value="{{$editUser->custom_fields_data['field_'.$field->id] ?? ''}}">
                                                    @elseif($field->type == 'number')
                                                        <input type="number" name="custom_fields_data[{{$field->name.'_'.$field->id}}]" class="form-control" placeholder="{{$field->label}}" value="{{$editUser->custom_fields_data['field_'.$field->id] ?? ''}}">

                                                    @elseif($field->type == 'textarea')
                                                        <textarea name="custom_fields_data[{{$field->name.'_'.$field->id}}]" class="form-control" id="{{$field->name}}" cols="3">{{$editUser->custom_fields_data['field_'.$field->id] ?? ''}}</textarea>

                                                    @elseif($field->type == 'radio')
                                                        <div class="radio-list">
                                                            @foreach($field->values as $key=>$value)
                                                                <label class="radio-inline @if($key == 0) p-0 @endif">
                                                                    <div class="radio radio-info">
                                                                        <input type="radio" name="custom_fields_data[{{$field->name.'_'.$field->id}}]" id="optionsRadios{{$key.$field->id}}" value="{{$value}}" @if(isset($clientDetail) && $clientDetail->custom_fields_data['field_'.$field->id] == $value) checked @elseif($key==0) checked @endif>>
                                                                        <label for="optionsRadios{{$key.$field->id}}">{{$value}}</label>
                                                                    </div>
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    @elseif($field->type == 'select')
                                                        {!! Form::select('custom_fields_data['.$field->name.'_'.$field->id.']',
                                                                $field->values,
                                                                    isset($editUser)?$editUser->custom_fields_data['field_'.$field->id]:'',['class' => 'form-control gender'])
                                                            !!}

                                                    @elseif($field->type == 'checkbox')
                                                    <div class="mt-checkbox-inline custom-checkbox checkbox-{{$field->id}}">
                                                        <input type="hidden" name="custom_fields_data[{{$field->name.'_'.$field->id}}]" 
                                                        id="{{$field->name.'_'.$field->id}}" value=" ">
                                                        @foreach($field->values as $key => $value)
                                                            <label class="mt-checkbox mt-checkbox-outline">
                                                                <input name="{{$field->name.'_'.$field->id}}[]"
                                                                        type="checkbox" onchange="checkboxChange('checkbox-{{$field->id}}', '{{$field->name.'_'.$field->id}}')" value="{{$value}}"> {{$value}}
                                                                <span></span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                    @elseif($field->type == 'date')
                                                        <input type="text" class="form-control form-control-inline date-picker" size="16" name="custom_fields_data[{{$field->name.'_'.$field->id}}]"
                                                                value="{{ isset($editUser->dob)?Carbon\Carbon::parse($editUser->dob)->format('Y-m-d'):Carbon\Carbon::now()->format($global->date_format)}}">
                                                    @endif
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block"></span>

                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <label>@lang('app.shippingAddress')</label>
                                        <div class="form-group">
                                            <textarea name="shipping_address" id="shipping_address" class="form-control" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <label>@lang('app.note')</label>
                                        <div class="form-group">
                                            <textarea name="note" id="note" class="form-control summernote" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 20px;">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div style="margin-bottom: 10px;">
                                                <label class="control-label">@lang('modules.client.sendCredentials')</label>
                                                <a class="mytooltip" href="javascript:void(0)"> <i class="fa fa-info-circle"></i><span class="tooltip-content5"><span class="tooltip-text3"><span class="tooltip-inner2">@lang('modules.client.sendCredentialsMessage')</span></span></span></a>
                                            </div>
                                            <div class="radio radio-inline col-md-4">
                                                <input type="radio" name="sendMail" id="sendMail1"
                                                        value="yes">
                                                <label for="sendMail1" class="">
                                                    @lang('app.yes') </label>
                                            </div>
                                            <div class="radio radio-inline col-md-4">
                                                <input type="radio" name="sendMail"
                                                        id="sendMail2" checked value="no">
                                                <label for="sendMail2" class="">
                                                    @lang('app.no') </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="m-b-10">
                                                <label class="control-label">@lang('modules.emailSettings.emailNotifications')</label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <input type="radio" checked name="email_notifications" id="email_notifications1" value="1">
                                                <label for="email_notifications1" class="">
                                                    @lang('app.enable') </label>

                                            </div>
                                            <div class="radio radio-inline ">
                                                <input type="radio" name="email_notifications"
                                                        id="email_notifications2" value="0">
                                                <label for="email_notifications2" class="">
                                                    @lang('app.disable') </label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="address">@lang('modules.accountSettings.changeLanguage')</label>
                                                <select name="locale" id="locale" class="form-control select2">
                                                <option @if($global->locale == "en") selected @endif value="en">English
                                                    </option>
                                                    @foreach($languageSettings as $language)
                                                        <option value="{{ $language->language_code }}" >{{ $language->language_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> @lang('app.save')</button>

                            </div>
                        {!! Form::close() !!} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- .row -->

    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="clientCategoryModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{--Ajax Modal Ends--}}
@endsection

@push('footer-script')
<script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/summernote/dist/summernote.min.js') }}"></script>
<script src="{{ asset('plugins/cc-picker/jquery.ccpicker.js') }}"></script>

<script>
    function checkboxChange(parentClass, id){
        var checkedData = '';
        $('.'+parentClass).find("input[type= 'checkbox']:checked").each(function () {
            if(checkedData !== ''){
                checkedData = checkedData+', '+$(this).val();
            }
            else{
                checkedData = $(this).val();
            }
        });
        $('#'+id).val(checkedData);
    }

    $('#sub_category_id').html("");
      var categories = @json($categories);
        $('#category_id').change(function (e) {
        var cat_id = $(this).val();
        getCategory(cat_id);
           
        });
        function getCategory(cat_id){
            var url = "{{route('admin.clients.getSubcategory')}}";
            var token = "{{ csrf_token() }}";
            $.easyAjax({
            url: url,
            type: "POST",
            data: {'_token': token, cat_id: cat_id},
            success: function (data) {
                var options = [];
                var rData = [];
                rData = data.subcategory;
                $.each(rData, function( index, value ) {
                    var selectData = '';
                    selectData = '<option value="'+value.id+'">'+value.category_name+'</option>';
                    options.push(selectData);
                });
                $('#sub_category_id').html(options);
                // $('#sub_category_id').selectpicker('refresh');

            }
        })
    }
    
    
    $(".select2").select2({
        formatNoMatches: function () {
            return "{{ __('messages.noRecordFound') }}";
        }
    });

    $(".date-picker").datepicker({
        todayHighlight: true,
        autoclose: true,
        weekStart:'{{ $global->week_start }}',
        format: '{{ $global->date_picker_format }}',
    });

    $('#save-form').click(function () {
        $.easyAjax({
            url: '{{route('admin.clients.store')}}',
            container: '#createClient',
            type: "POST",
            redirect: true,
            file: (document.getElementById("image").files.length == 0) ? false : true,
            data: $('#createClient').serialize(),
            error: function (response) {
                    $("input").css("border-color", "#ccc")
                    $("input").attr("title", ``)
                    $("textarea").css("border-color", "#ccc")
                    $("textarea").attr("title", ``)
                    $("select").prev().css("border-color", "#ccc")
                    $("select").attr("title", ``)
                    let obj = response.responseJSON.errors

                    console.log(obj);
                    for (const property in obj) {
                        if(property == 'country' ){
                            $("#"+property).prev().css("border-color", "#ef1f1f")
                            $("#"+property).prev().attr("title", `${obj[property]}`)
                        }else if(property == 'sub_category_id'){
                            $("#"+property).prev().css("border-color", "#ef1f1f")
                            $("#"+property).prev().attr("title", `${obj[property]}`)
                        }else if(property == 'city'){
                            $("#"+property).prev().css("border-color", "#ef1f1f")
                            $("#"+property).prev().attr("title", `${obj[property]}`)
                        }else if(property == 'category_id'){
                            $("#"+property).prev().css("border-color", "#ef1f1f")
                            $("#"+property).prev().attr("title", `${obj[property]}`)
                        }else if(property == 'contact'){
                            $("#"+property).prev().css("border-color", "#ef1f1f")
                            $("#"+property).prev().attr("title", `${obj[property]}`)
                        }else{
                            $("#"+property).css("border-color", "#ef1f1f")
                            $("#"+property).attr("title", `${obj[property]}`)
                        }
                    }
            }
        })
    });

    $('.summernote').summernote({
        height: 200,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: false,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['fontsize', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ["view", ["fullscreen"]]
        ]
    });

    $('#addClientCategory').click(function () {
        var url = '{{ route('admin.clientCategory.create')}}';
        $('#modelHeading').html('...');
        $.ajaxModal('#clientCategoryModal', url);
    })

    $('#addClientSubCategory').click(function () {
        var url = '{{ route('admin.clientSubCategory.create')}}';
        $('#modelHeading').html('...');
        $.ajaxModal('#clientCategoryModal', url);
    })

    $('#random_password').change(function () {
        var randPassword = $(this).is(":checked");

        if(randPassword){
            $('#password').val('{{ str_random(8) }}');
            $('#password').attr('readonly', 'readonly');
        }
        else{
            $('#password').val('');
            $('#password').removeAttr('readonly');
        }
    });

    
    $(".ccpicker").CcPicker({
        dataUrl: "{{ asset('data.json') }}"
    });

    $('.category-form').click(function() {
            let target = $(event.target)[0];
        
            const field = $('#' + target.dataset.type)
            const url = '{{ route('admin.clientCategory.create') }}';
            $('#modelHeading').html('...');
            $.ajaxModal('#clientCategoryModal', url);
    })

    $('.subcategory-form').click(function() {
            let target = $(event.target)[0];
        
            const field = $('#' + target.dataset.type)
            const url = '{{ route('admin.clientSubCategory.create') }}';
            $('#modelHeading').html('...');
            $.ajaxModal('#clientCategoryModal', url);
    })
    
    $('.language-form').click(function(){
            let target = $(event.target)[0];
            const field = $('#' + target.dataset.type)
            const url = '{{ route('admin.language-settings.create') }}';
            $('#modelHeading').html('...');
            $.ajaxModal('#clientCategoryModal', url);
    })
    

    $('.plus-form').click(function() {
            let target = $(event.target)[0];
        
            const field = $('#' + target.dataset.type)
            const url = '{{ route('admin.tla.create') }}/' + target.dataset.type;
            $('#modelHeading').html('...');
            $.ajaxModal('#clientCategoryModal', url);
    })

    $(".ccpicker").CcPicker("setCountryByCode", "fr");

    var contact_principal =  $('#contact_principal').val();

    if( contact_principal == 'without_user'){

        $('#name').prop('disabled',true);
        $('#function').prop('disabled',true);
        $('#email').prop('disabled',true);
        $('#p_mobile').prop('disabled',true);
        $('#visibility').prop('disabled',true);
        $('#contect_type').prop('disabled',true);      
        $('input[name=gender]').prop('disabled',true);
        // $('#contact').prop('disabled',true);
        $('#image').prop('disabled',true);

    }

    $('#contact_principal').change(function(){
        if($(this).val() == 'create'){
            $('#name').prop('disabled',false);
            $('#function').prop('disabled',false);
            $('#email').prop('disabled',false);
            $('#p_mobile').prop('disabled',false);
            $('#visibility').prop('disabled',false);
            $('#contect_type').prop('disabled',false);      
            $('input[name=gender]').prop('disabled',false);
            $('#image').prop('disabled',false);
            
            $('#name').val('');
            $('#function').val('');
            $('#email').val('');
            $('#p_mobile').val('');
            $('#visibility').val('');
            $('#contect_type').val('');
            $('#contact_img').attr('src', 'https://via.placeholder.com/200x150.png?text= {{ str_replace(' ', '+', __('modules.profile.uploadPicture')) }}')
            $(".ccpicker").CcPicker("setCountryByCode", "fr");
        }
        else if($(this).val() == 'without_user' ){           
            $('#name').prop('disabled',true);
            $('#function').prop('disabled',true);
            $('#email').prop('disabled',true);
            $('#p_mobile').prop('disabled',true);
            $('#visibility').prop('disabled',true);
            $('#contect_type').prop('disabled',true);      
            $('input[name=gender]').prop('disabled',true);
            $('#image').prop('disabled',true);
            
            $('#name').val('');
            $('#function').val('');
            $('#email').val('');
            $('#p_mobile').val('');
            $('#visibility').val('');
            $('#contect_type').val('');
            $('#contact_img').attr('src', 'https://via.placeholder.com/200x150.png?text= {{ str_replace(' ', '+', __('modules.profile.uploadPicture')) }}')
            $(".ccpicker").CcPicker("setCountryByCode", "fr");
        }
        else{
            $('#name').prop('disabled',true);
            $('#function').prop('disabled',true);
            $('#email').prop('disabled',true);
            $('#p_mobile').prop('disabled',true);
            $('#visibility').prop('disabled',true);
            $('#contect_type').prop('disabled',true);      
            $('input[name=gender]').prop('disabled',true);
            $('#image').prop('disabled',true);

            var contact_data = $(this).find(':selected').attr('data');

            var allData  = JSON.parse(contact_data);

            $('#name').val(allData.name);
            $('#function').val(allData.function);
            $('#email').val(allData.email);
            $('#p_mobile').val(allData.mobile.split(" ")[1]);
            $('#visibility').val(allData.visibility);
            $('#contect_type').val('free');
            $("input[name=gender][value='"+allData.gender+"'] ").prop('checked',true);

            $('#contact_img').attr('src', allData.image_url)

            
            $("#p_mobile").CcPicker("setCountryByPhoneCode", allData.mobile.split(" ")[0]);
        }
    });
</script>
@endpush

