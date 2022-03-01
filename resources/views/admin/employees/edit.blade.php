@extends('layouts.app')

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
            <li><a href="{{ route('admin.employees.index') }}">{{ __($pageTitle) }}</a></li>
            <li class="active">@lang('app.edit')</li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
@endsection

@push('head-script')
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/tagify-master/dist/tagify.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/cc-picker/jquery.ccpicker.css') }}">


<style>
    .form-body{
        display: grid;
    }
</style>

<style>
    .cc-picker {
        padding: 6px 8px !important;
        background-color: white;
        border: 1px solid #CCCCD1;
        display: flex;
        width: 100px;
        align-items: center;
        border-radius: 3px
    }

    .m-b-10 {
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

    fieldset {
        border: 1px solid #DBD2D2;
        padding: 10px;
        height: 100%;
    }

    .phonecode-select {
        max-height: 300px;
        overflow: auto;
    }

    .btn-reset {
        background: #C0CDD3 !important;
        margin-right: 10px;
    }

    .row {
        display: grid !important;
        grid-template-columns: 1fr 1fr 200px;
        row-gap: 20px;
        align-items: stretch !important;
    }

    .fileinput-new {
        margin: 0 auto;
    }

    #image,
    .btn-file {
        background-color: #4CACC1 !important;
    }

    .text-secondary {
        font-size: 11px;
        line-height: 14px;
        text-align: center;
        color: #111111;
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
        height: 100% !important;
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
        min-width: max-content;
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

    .datepicker td:nth-child(1),.category-table td:nth-child(1) {
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
    ::-webkit-scrollbar {
        width: 0px;
    }


    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }


    ::-webkit-scrollbar-thumb {
        background: #888;
    }


    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

@endpush

@section('content')
<div class="">
    <div class="col-xs-12">

        <div class="panel-4">
            <div class="panel-heading">
                <h2 style=" ">@lang('app.ficheutilisateur')</h2>
            </div>

            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    {!! Form::open(['id' => 'updateEmployee', 'class' => 'ajax-form', 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-body form-input" style="margin-top: 40px">

                            <div class="row">

                                <div class="col-md-4">
                                    <fieldset>
                                        <legend>@lang('app.genralinfo')</legend>
                                        <table>
                                            <tr>
                                                <td>
                                                    <label for="" class="mb-0">@lang('app.civility')</label>
                                                </td>
                                                <td>
                                                    <div class="d-flex" style="margin-right: 40px; gap:20px">
                                                        <div class="form-group mb-0">
                                                            <input type="radio" name="civility" value="male"
                                                                @if ($userDetail->gender == 'male')checked @endif>
                                                            <label for="civility" style="margin-bottom: 0px">M</label>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <input type="radio" name="civility" value="female"
                                                                @if ($userDetail->gender == 'female')checked @endif>
                                                            <label for="civility" style="margin-bottom: 0px">Mme</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><label for="username" class="required">@lang('app.user_id')
                                                    </label></td>
                                                <td>
                                                    <input type="text" class="form-control" id="username" name="username"
                                                        value="{{ $userDetail->username }}">
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><label for="name"
                                                        class="required">@lang('app.lastnamefirstname') </label></td>
                                                <td>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="{{ $userDetail->name }}" autocomplete="nope">
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="address" class="required">@lang('app.address')</label>
                                                </td>
                                                <td><textarea class="form-control" name="address" id="address" value="  "
                                                        style="width:100%"
                                                        rows="2">{{ explode('|', $userDetail->address)[0] }}</textarea>
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="country" class="required">@lang('app.pays')</label>
                                                </td>
                                                <td>
                                                    <select name="country" id="country" class="form-control select2">
                                                        @foreach ($countries as $country)
                                                            @if (explode('|', $userDetail->address)[1] == $country->name)
                                                                <option value=" {{ $country->name }} " selected>
                                                                    {{ ucfirst(strtolower($country->name)) }}</option>
                                                            @else
                                                                <option value=" {{ $country->name }} ">
                                                                    {{ ucfirst(strtolower($country->name)) }}</option>
                                                            @endif
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
                                                <td><label for="city" class="required">@lang('app.cp')</label></label>
                                                </td>
                                                <td>
                                                    <select name="city" id="city" class="form-control select2">
                                                        <option value="" disabled>@lang('app.cp')</option>
                                                        @foreach ($tla as $t)
                                                            @if ($t->type == 'city')
                                                                @if ($t->name == explode('|', $userDetail->address)[2])
                                                                    <option value=" {{ $t->name }} " selected>
                                                                        {{ $t->name }}</option>
                                                                @else
                                                                    <option value=" {{ $t->name }} ">
                                                                        {{ $t->name }}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="javascript:;" class="text-info plus-form">
                                                        <img src="{{ asset('img/plus.png') }}" alt="" data-type="city"> </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="qualification" class="">@lang('app.qualification')</label>
                                                </td>
                                                <td>
                                                    <select name="qualification" id="qualification" class="form-control select2">
                                                        @foreach ($designations as $designation)
                                                            @if ($userDetail->qualification == $designation->name )
                                                                <option value=" {{ $designation->name }} " selected>
                                                                {{$designation->name }}</option>
                                                            @else
                                                                <option value=" {{ $designation->name }} ">
                                                                {{$designation->name }}</option>
                                                            @endif
                                                            
                                                        @endforeach
                                                        
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </div>

                                <div class="col-md-4">
                                    <fieldset>
                                        <legend>@lang('app.otherinfo')</legend>

                                        <table>
                                            <tr>
                                                <td>
                                                    <label for="profil" class="required">@lang('app.profil')</label>
                                                </td>
                                                <td>
                                                    <select name="profil" id="profil" class="form-control select2">
                                                        <option value="App Administrator" @if($userRole == "App Administrator") selected @endif >Admin</option>
                                                        <option value="Collaborateur" @if($userRole == "Collaborateur") selected @endif>Collaborateur</option>
                                                        <option value="Externe" @if($userRole == "Externe") selected @endif>Externe</option>
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            {{-- <tr>
                                                <td>
                                                    <label for="qualification"
                                                        class="required">@lang('app.qualification')</label>
                                                </td>
                                                <td>
                                                    <select name="qualification" id="qualification"
                                                        class="form-control select2">
                                                        <option value="" disabled>@lang('app.qualification')</option>
                                                        @foreach ($tla as $t)
                                                            @if ($t->type == 'qualification')
                                                                <option value="{{ $t->name }}">
                                                                    {{ ucfirst($t->name) }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                <td>
                                                    <a href="javascript:;" class="text-info plus-form">
                                                        <img src="{{ asset('img/plus.png') }}" alt="" data-type="qualification"> </a>
                                                </td>
                                            </tr> --}}
                                            <tr>
                                                <td>
                                                    <label for="birthday"
                                                        class="">@lang('app.datenaissance')</label>
                                                </td>
                                                <td>
                                                    <input type="text" name="birthday" id="birthday"
                                                        value="{{date('d-m-Y', strtotime($userDetail->birthday))}}"
                                                        class="form-control datepicker">
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="native_country"
                                                        class="required">@lang('app.paysnaissance')</label>
                                                </td>
                                                <td>
                                                    <select name="native_country" id="native_country"
                                                        class="form-control select2">
                                                        @foreach ($countries as $country)
                                                            @if (explode('|', $userDetail->address)[1] == $country->name)
                                                                <option value=" {{ $country->name }} " selected>
                                                                    {{ ucfirst($country->name) }}</option>
                                                            @else
                                                                <option value=" {{ $country->name }} ">
                                                                    {{ ucfirst($country->name) }}</option>
                                                            @endif
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
                                                    <label for="nationality"
                                                        class="required">@lang('app.nationalite')</label>
                                                </td>
                                                <td>
                                                    <select name="nationality" id="nationality"
                                                        class="form-control select2">
                                                        @foreach ($countries as $country)
                                                            @if (explode('|', $userDetail->address)[1] == $country->name)
                                                                <option value=" {{ $country->name }} " selected>
                                                                    {{ ucfirst($country->name) }}</option>
                                                            @else
                                                                <option value=" {{ $country->name }} ">
                                                                    {{ ucfirst($country->name) }}</option>
                                                            @endif
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
                                                    <label for="language" class="required">@lang('app.langue')</label>
                                                </td>
                                                <td>
                                                    <select name="language" id="language" class="form-control select2">
                                                        <option @if ($global->locale == 'en') selected @endif value="en">
                                                            English
                                                        </option>
                                                        @foreach ($languageSettings as $language)
                                                            <option value="{{ $language->language_name }}"
                                                                @if ($global->locale == $language->language_code) selected @endif>
                                                                {{ $language->language_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href=" {{ route('super-admin.language-settings.create') }} " style="background: none">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="start_date"
                                                        class="">@lang('app.start_date')</label>
                                                </td>
                                                <td>
                                                    <input type="text" name="start_date" class="form-control datepicker" value="{{json_decode($userDetail->observation)->start_date}}">
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="end_date"
                                                        class="">@lang('app.end_date')</label>
                                                </td>
                                                <td>
                                                    <input type="text" name="end_date" class="form-control datepicker" value="{{json_decode($userDetail->observation)->end_date}}">
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </div>

                                <div class="col-md-4">

                                    <table>
                                        <tr>
                                            <td class="text-center">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail"
                                                        style="width: 123px; height: 137px;">
                                                        <img src=" {{$userDetail->getImageUrlAttribute()}} "
                                                            alt="" />
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
                                                        <p class="text-secondary">@lang('app.fomatimage')</p>
                                                        <p class="text-secondary">(JPG,JPEG,PNG,GIF | 15Mo max.)</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-md-4">
                                    <fieldset>
                                        <legend>@lang('app.cordonnees')</legend>

                                        <table>
                                            <tr>
                                                <td><label for="skill_id" class="">@lang('app.compentancy')</label></label>
                                                </td>
                                                <td>
                                                    <select class="select2 m-b-10 select2-multiple " multiple="multiple" id="skill_id"
                                                            data-placeholder="Sélectionner Compétences" name="skill_id[]" required>
                                                        @foreach($skills as $skill)
                                                            @if (json_decode($userDetail->observation)->skills)
                                                                @foreach (json_decode($userDetail->observation)->skills as $key => $skill_id)
                                                                    @if ($skill_id == $skill->id)
                                                                        <option value="{{ $skill->id }}" selected> {{ $skill->name }} </option>
                                                                    @else
                                                                        @if (count(json_decode($userDetail->observation)->skills)-1 == $key)
                                                                            <option value="{{ $skill->id }}">{{ $skill->name }} </option>
                                                                        @endif
                                                                        
                                                                    @endif
                                                                @endforeach
                                                            @else   
                                                                <option value="{{ $skill->id }}">{{ $skill->name }} </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="javascript:;" class="text-info plus-form">
                                                        <img src="{{ asset('img/plus.png') }}" alt="" data-type="skill_id">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="service" class="">@lang('app.services')</label>
                                                </td>
                                                <td>
                                                    <select class="select2 m-b-10 select2-multiple " multiple="multiple" id="departement_id"
                                                            data-placeholder="Sélectionner Départements" name="departement_id[]" required>
                                                        @foreach($groups as $group)
                                                            @if (json_decode($userDetail->observation)->departement)
                                                                @foreach (json_decode($userDetail->observation)->departement as $key => $departement)
                                                                    @if ($departement == $group->id)
                                                                        <option value="{{ $group->id }}" selected> {{ $group->team_name }} </option>
                                                                    @else
                                                                        @if (count(json_decode($userDetail->observation)->departement)-1 == $key)
                                                                            <option value="{{ $group->id }}">{{ $group->team_name }} </option>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <option value="{{ $group->id }}">{{ $group->team_name }} </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>

                                           
                                            {{-- <tr>
                                                <td>
                                                    <label for="compentancy"
                                                        class="required">@lang('app.compentancy')</label>
                                                </td>
                                                <td>
                                                    <input type="text" name="compentancy" class="form-control">
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>

                                           
                                            {{-- <tr>
                                                <td>
                                                    <label for="tel">@lang('app.tel')</label>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><span class="flag-icon flag-icon-fr"
                                                                    id="bind-flag-tel"></span> <span
                                                                    class="caret"></span></button>
                                                            <ul class="dropdown-menu phonecode-select">
                                                                @foreach ($countries as $country)
                                                                    <li>
                                                                        <a class="phonecode-item"
                                                                            data-phonecode="{{ $country->phonecode }}"
                                                                            data-input="tel" data-bind-flag="bind-flag-tel"
                                                                            data-flag="flag-icon-{{ strtolower($country->iso) }}">
                                                                            <span
                                                                                class="flag-icon flag-icon-{{ strtolower($country->iso) }}"></span>
                                                                            {{ ucfirst($country->name) }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div><!-- /btn-group -->
                                                        <input type="text" name="tel" id="tel"
                                                            class="form-control phone-input ccpicker" aria-label="..."
                                                            value=" {{ explode(' ', $userDetail->tel)[1] }} ">
                                                    </div><!-- /input-group -->
                                                </td>
                                            </tr> --}}
                                            
                                            <tr>
                                                <td>
                                                    <label for="mobile">@lang('app.mobile')</label>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        {{-- <div class="input-group-btn">
                                                            <button type="button" class="btn dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"><span class="flag-icon flag-icon-fr"
                                                                    id="bind-flag-mobile"></span> <span
                                                                    class="caret"></span></button>
                                                            <ul class="dropdown-menu phonecode-select">
                                                                @foreach ($countries as $country)
                                                                    <li>
                                                                        <a class="phonecode-item"
                                                                            data-phonecode="{{ $country->phonecode }}"
                                                                            data-input="mobile"
                                                                            data-bind-flag="bind-flag-mobile"
                                                                            data-flag="flag-icon-{{ strtolower($country->iso) }}">
                                                                            <span
                                                                                class="flag-icon flag-icon-{{ strtolower($country->iso) }}"></span>
                                                                            {{ ucfirst(($country->name) }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div><!-- /btn-group --> --}}
                                                        <input type="text" name="mobile" id="mobile"
                                                            class="form-control phone-input ccpicker" aria-label="..."
                                                            value="{{ explode(' ', $userDetail->mobile)[1] }}">
                                                    </div><!-- /input-group -->
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label for="" class="mb-0">@lang('app.notification')</label>
                                                </td>
                                                <td>
                                                    <div class="d-flex" style="margin-right: 40px; gap:20px">
                                                        <div class="form-group mb-0">
                                                            <input type="radio" name="notification" value="1" checked>
                                                            <label for="notification" style="margin-bottom: 0px" checked>@lang('app.active')</label>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <input type="radio" name="notification" value="0">
                                                            <label for="notification" style="margin-bottom: 0px">@lang('app.deactive')</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>

                                        </table>
                                    </fieldset>
                                </div>

                                <div class="col-md-4">
                                    <fieldset>
                                        <legend>Connexion</legend>
                                        <table>
                                            <tr>
                                                <td>
                                                    <label for="email" class="required">Login</label>
                                                </td>
                                                <td>
                                                    <input value=" {{ $userDetail->email }} " id="email" type="email" name="email"
                                                        class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="password"
                                                        class="">@lang('app.motdepasse')</label>
                                                </td>
                                                <td>
                                                    <input type="password" id="password" name="password" class="form-control">
                                                </td>
                                            </tr>

                                            
                                            <tr>
                                                <td>
                                                    <label for="connexion" class="required">@lang('app.connexion')</label>
                                                </td>
                                                <td>
                                                    <div class="d-flex" style="margin-right: 40px; gap:20px">
                                                        <div class="form-group mb-0">
                                                            <input type="radio" name="connexion" value="1" @if ($userDetail->login == 'enable')checked @endif>
                                                            <label for="connexion" style="margin-bottom: 0px">@lang('app.active')</label>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <input type="radio" name="connexion" value="0" @if ($userDetail->login != 'enable')checked @endif>
                                                            <label for="connexion" style="margin-bottom: 0px">@lang('app.deactive')</label>
                                                        </div>
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
                                                    <label for="status" class="required">@lang('app.status')</label>
                                                </td>
                                                <td>
                                                    <div class="d-flex" style="margin-right: 40px; gap:20px">
                                                        <div class="form-group mb-0">
                                                            <input type="radio" name="status" value="1"  @if ($userDetail->status == 'active')checked @endif>
                                                            <label for="status" style="margin-bottom: 0px">@lang('app.active')</label>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <input type="radio" name="status" value="0" @if ($userDetail->status != 'active')checked @endif>
                                                            <label for="status" style="margin-bottom: 0px">@lang('app.deactive')</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>

                                        </table>
                                    </fieldset>
                                </div>

                            </div>

                        </div>

                        <div class="form-actions" style="margin-top: 20px">
                            {{-- <button class="btn btn-reset" type="reset">@lang('app.annuler')</button> --}}
                            <button type="submit" id="save-form" class="btn btn-success">@lang('app.update') </button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div> <!-- .row -->

{{--Ajax Modal--}}
<div class="modal fade bs-modal-md in" id="departmentModel" role="dialog" aria-labelledby="myModalLabel"
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

@section('content2389')

<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-inverse">
            <div class="panel-heading"> @lang('modules.employees.updateTitle')
                [ {{ $userDetail->name }} ]
                @php($class = ($userDetail->status == 'active') ? 'label-custom' : 'label-danger')
                <span class="label {{$class}}">{{ucfirst($userDetail->status)}}</span>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    {!! Form::open(['id'=>'updateEmployee','class'=>'ajax-form','method'=>'PUT']) !!}

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="required">@lang('modules.employees.employeeId')</label>
                                    <a class="mytooltip" href="javascript:void(0)">
                                        <i class="fa fa-info-circle"></i><span class="tooltip-content5"><span class="tooltip-text3"><span
                                                        class="tooltip-inner2">@lang('modules.employees.employeeIdInfo')</span></span></span></a>
                                        <input type="text" name="employee_id" id="employee_id" class="form-control"
                                           value="{{ $employeeDetail->employee_id }}" autocomplete="nope">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="required">@lang('modules.employees.employeeName')</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $userDetail->name }}" autocomplete="nope">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="required">@lang('modules.employees.employeeEmail')</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ $userDetail->email }}" autocomplete="nope">
                                    <span class="help-block">Employee will login using this email.</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="required">@lang('modules.employees.employeePassword')</label>
                                    <input type="password" style="display: none">
                                    <input type="password" name="password" id="password" class="form-control" autocomplete="nope">
                                    <span class="help-block"> @lang('modules.employees.updatePasswordNote')</span>
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"><i
                                                    class="fa fa-slack"></i> @lang('modules.employees.slackUsername')
                                        </label>
                                    <div class="input-group"><span class="input-group-addon">@</span>
                                        <input type="text" id="slack_username" name="slack_username" class="form-control" autocomplete="nope" value="{{ $employeeDetail->slack_username ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="required">@lang('modules.employees.joiningDate')</label>
                                    <input type="text" name="joining_date" id="joining_date" @if($employeeDetail) value="{{ $employeeDetail->joining_date->format($global->date_format) }}"
                                        @endif class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('modules.employees.lastDate')</label>
                                    <input type="text" autocomplete="off" name="last_date" id="end_date" @if($employeeDetail) value="@if($employeeDetail->last_date) {{ $employeeDetail->last_date->format($global->date_format) }} @endif"
                                        @endif class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('modules.employees.gender')</label>
                                    <select name="gender" id="gender" class="form-control">
                                            <option @if($userDetail->gender == 'male') selected
                                                    @endif value="male">@lang('app.male')</option>
                                            <option @if($userDetail->gender == 'female') selected
                                                    @endif value="female">@lang('app.female')</option>
                                            <option @if($userDetail->gender == 'others') selected
                                                    @endif value="others">@lang('app.others')</option>
                                        </select>
                                </div>
                            </div>

                        </div>
                        <!--/row-->

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">@lang('app.address')</label>
                                    <textarea name="address" id="address" rows="3" class="form-control">{{ $employeeDetail->address ?? '' }}</textarea>
                                </div>
                            </div>

                        </div>
                        <!--/span-->
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label>@lang('app.skills')</label>
                                    <input name='tags' placeholder='@lang('app.skills')' value='{{implode(' , ', $userDetail->skills()) }}'>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label class="required">@lang('app.designation') <a href="javascript:;" id="designation-setting" ><i class="ti-settings text-info"></i></a></label>
                                    <select name="designation" id="designation" class="form-control">
                                        @forelse($designations as $designation)
                                            <option @if(isset($employeeDetail->designation_id) && $employeeDetail->designation_id == $designation->id) selected @endif value="{{ $designation->id }}">{{ $designation->name }}</option>
                                        @empty
                                            <option value="">@lang('messages.noRecordFound')</option>
                                        @endforelse()
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label class="required">@lang('app.department') <a href="javascript:;" id="department-setting" ><i class="ti-settings text-info"></i></a></label>
                                    <select name="department" id="department" class="form-control">
                                        <option value="">--</option>
                                        @foreach($teams as $team)
                                            <option @if(isset($employeeDetail->department_id) && $employeeDetail->department_id == $team->id) selected @endif value="{{ $team->id }}">{{ $team->team_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--/span-->

                            <div class="col-md-4">
                                <label>@lang('app.mobile')</label>
                                <div class="form-group mobile-form-group">
                                    <select class="select2 phone_country_code form-control" name="phone_code">
                                        <option value="">--</option>
                                        @foreach ($countries as $item)
                                            <option
                                            @if ($item->id == $userDetail->country_id)
                                                selected
                                            @endif
                                            value="{{ $item->id }}">+{{ $item->phonecode.' ('.$item->iso.')' }}</option>
                                        @endforeach
                                    </select>
                                    <input type="tel" name="mobile" id="mobile" class="mobile" autocomplete="nope" value="{{ $userDetail->mobile }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('modules.employees.hourlyRate')</label>
                                    <input type="text" name="hourly_rate" id="hourly_rate" class="form-control" value="{{ $employeeDetail->hourly_rate ?? '' }}">
                                </div>
                            </div>
                            <!--/span-->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('app.status')</label>
                                    <select name="status" id="status" class="form-control">
                                            <option @if($userDetail->status == 'active') selected
                                                    @endif value="active">@lang('app.active')</option>
                                            <option @if($userDetail->status == 'deactive') selected
                                                    @endif value="deactive">@lang('app.deactive')</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('app.login')</label>
                                    <select name="login" id="login" class="form-control">
                                        <option @if($userDetail->login == 'enable') selected @endif value="enable">@lang('app.enable')</option>
                                        <option @if($userDetail->login == 'disable') selected @endif value="disable">@lang('app.disable')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="m-b-10">
                                        <label class="control-label">@lang('modules.emailSettings.emailNotifications')</label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <input type="radio" 
                                        @if ($userDetail->email_notifications)
                                            checked
                                        @endif
                                        name="email_notifications" id="email_notifications1" value="1">
                                        <label for="email_notifications1" class="">
                                            @lang('app.enable') </label>

                                    </div>
                                    <div class="radio radio-inline ">
                                        <input type="radio" name="email_notifications"
                                        @if (!$userDetail->email_notifications)
                                            checked
                                        @endif

                                               id="email_notifications2" value="0">
                                        <label for="email_notifications2" class="">
                                            @lang('app.disable') </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">@lang('modules.accountSettings.changeLanguage')</label>
                                            <select name="locale" id="locale" class="form-control select2">
                                            <option @if($global->locale == "en") selected @endif value="en">English
                                                    </option>
                                                @foreach($languageSettings as $language)
                                                    <option value="{{ $language->language_code }}" @if($userDetail->locale == $language->language_code) selected @endif >{{ $language->language_name }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <label>@lang('modules.profile.profilePicture')</label>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="{{ $userDetail->image_url }}" alt="" />
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                            <span class="btn btn-info btn-file">
                                    <span class="fileinput-new"> @lang('app.selectImage') </span>
                                            <span class="fileinput-exists"> @lang('app.change') </span>
                                            <input type="file" name="image" id="image"> </span>
                                            <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> @lang('app.remove') </a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!--/span-->

                        <div class="row">
                            @if(isset($fields)) @foreach($fields as $field)
                            <div class="col-md-6">
                                <label>{{ ucfirst($field->label) }}</label>
                                <div class="form-group">
                                    @if( $field->type == 'text')
                                    <input type="text" name="custom_fields_data[{{$field->name.'_'.$field->id}}]" class="form-control" placeholder="{{$field->label}}"
                                        value="{{$employeeDetail->custom_fields_data['field_'.$field->id] ?? ''}}">                                    @elseif($field->type == 'password')
                                    <input type="password" name="custom_fields_data[{{$field->name.'_'.$field->id}}]" class="form-control" placeholder="{{$field->label}}"
                                        value="{{$employeeDetail->custom_fields_data['field_'.$field->id] ?? ''}}">                                    @elseif($field->type == 'number')
                                    <input type="number" name="custom_fields_data[{{$field->name.'_'.$field->id}}]" class="form-control" placeholder="{{$field->label}}"
                                        value="{{$employeeDetail->custom_fields_data['field_'.$field->id] ?? ''}}">                                    @elseif($field->type == 'textarea')
                                    <textarea name="custom_fields_data[{{$field->name.'_'.$field->id}}]" class="form-control" id="{{$field->name}}" cols="3">{{$employeeDetail->custom_fields_data['field_'.$field->id] ?? ''}}</textarea>                                    @elseif($field->type == 'radio')
                                    <div class="radio-list">
                                        @foreach($field->values as $key=>$value)
                                        <label class="radio-inline @if($key == 0) p-0 @endif">
                                                                <div class="radio radio-info">
                                                                    <input type="radio"
                                                                           name="custom_fields_data[{{$field->name.'_'.$field->id}}]"
                                                                           id="optionsRadios{{$key.$field->id}}"
                                                                           value="{{$value}}"
                                                                           @if(isset($employeeDetail) && $employeeDetail->custom_fields_data['field_'.$field->id] == $value) checked
                                                                           @elseif($key==0) checked @endif>>
                                                                    <label for="optionsRadios{{$key.$field->id}}">{{$value}}</label>
                                    </div>
                                    </label>
                                    @endforeach
                                </div>
                                @elseif($field->type == 'select') {!! Form::select('custom_fields_data['.$field->name.'_'.$field->id.']', $field->values,
                                isset($employeeDetail)?$employeeDetail->custom_fields_data['field_'.$field->id]:'',['class'
                                => 'form-control gender']) !!} 
                                
                                @elseif($field->type == 'checkbox')
                                <div class="mt-checkbox-inline custom-checkbox checkbox-{{$field->id}}">
                                    <input type="hidden" name="custom_fields_data[{{$field->name.'_'.$field->id}}]" 
                                    id="{{$field->name.'_'.$field->id}}" value="{{$employeeDetail->custom_fields_data['field_'.$field->id]}}">
                                    @foreach($field->values as $key => $value)
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input name="{{$field->name.'_'.$field->id}}[]" class="custom_fields_data[{{$field->name.'_'.$field->id}}]"
                                                   type="checkbox" value="{{$value}}" onchange="checkboxChange('checkbox-{{$field->id}}', '{{$field->name.'_'.$field->id}}')"
                                                   @if($employeeDetail->custom_fields_data['field_'.$field->id] != '' && in_array($value ,explode(', ', $employeeDetail->custom_fields_data['field_'.$field->id]))) checked @endif > {{$value}}
                                            <span></span>
                                        </label>
                                    @endforeach
                                </div>
                                @elseif($field->type == 'date')
                                <input type="text" class="form-control date-picker" size="16" name="custom_fields_data[{{$field->name.'_'.$field->id}}]"
                                    value="{{ ($employeeDetail->custom_fields_data['field_'.$field->id] != '') ? \Carbon\Carbon::parse($employeeDetail->custom_fields_data['field_'.$field->id])->format($global->date_format) : \Carbon\Carbon::now()->format($global->date_format)}}">                                @endif
                                <div class="form-control-focus"></div>
                                <span class="help-block"></span>

                            </div>
                        </div>
                        @endforeach @endif

                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" id="save-form" class="btn btn-success"><i
                                        class="fa fa-check"></i> @lang('app.update')</button>
                    <a href="{{ route('admin.employees.index') }}" class="btn btn-default">@lang('app.back')</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- .row -->


@endsection
 @push('footer-script')
<script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugins/tagify-master/dist/tagify.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('plugins/cc-picker/jquery.ccpicker.js') }}"></script>

<script data-name="basic">

        $(".ccpicker").CcPicker({
            dataUrl: "{{ asset('data.json') }}"
        });

        $("#mobile").CcPicker("setCountryByPhoneCode", "{{ substr(explode(' ', $userDetail->mobile)[0], 1) }}");
        $("#tel").CcPicker("setCountryByPhoneCode", "{{ explode(" ",$userDetail->mobile)[0] }}");

        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
        });
        

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

    (function(){
        $("#department").select2({
            formatNoMatches: function () {
                return "{{ __('messages.noRecordFound') }}";
            }
        });
        $("#designation").select2({
            formatNoMatches: function () {
                return "{{ __('messages.noRecordFound') }}";
            }
        });
        $(".select2").select2({
            formatNoMatches: function () {
                return "{{ __('messages.noRecordFound') }}";
            }
        });

//             var input = document.querySelector('input[name=tags]'),
//                 // init Tagify script on the above inputs
//                 tagify = new Tagify(input, {
//                     whitelist : {!! json_encode($EmployeeSkill) !!},
//                     //  blacklist : [".NET", "PHP"] // <-- passed as an attribute in this demo
//                 });

// // Chainable event listeners
//             tagify.on('add', onAddTag)
//                 .on('remove', onRemoveTag)
//                 .on('input', onInput)
//                 .on('invalid', onInvalidTag)
//                 .on('click', onTagClick);

// // tag added callback
//             function onAddTag(e){
//                 tagify.off('add', onAddTag) // exmaple of removing a custom Tagify event
//             }

// // tag remvoed callback
//             function onRemoveTag(e){
//             }

// // on character(s) added/removed (user is typing/deleting)
//             function onInput(e){
//             }

// // invalid tag added callback
//             function onInvalidTag(e){
//             }

// // invalid tag added callback
//             function onTagClick(e){
//             }

        })()
</script>
<script>
    $("#joining_date, .date-picker,  #end_date").datepicker({
            todayHighlight: true,
            autoclose: true,
            weekStart:'{{ $global->week_start }}',
            format: '{{ $global->date_picker_format }}',
        });

        $('#save-form').click(function () {
            $.easyAjax({
                url: '{{route('admin.employees.update', [$userDetail->id])}}',
                container: '#updateEmployee',
                type: "POST",
                redirect: true,
                file: (document.getElementById("image").files.length == 0) ? false : true,
                data: $('#updateEmployee').serialize(),
                error: function (response) {
                    $("input").css("border-color", "#ccc")
                    $("input").attr("title", ``)
                    $("textarea").css("border-color", "#ccc")
                    $("textarea").attr("title", ``)
                    $("select").css("border-color", "#ccc")
                    $("select").attr("title", ``)
                    let obj = response.responseJSON.errors
                    console.log(obj);
                    for (const property in obj) {
                        if(property == 'city' || property == 'tags' ){
                            $("#"+property).prev().css("border-color", "#ef1f1f")
                            $("#"+property).prev().attr("title", `${obj[property]}`)    
                        }else{
                            $("#"+property).css("border-color", "#ef1f1f")
                            $("#"+property).attr("title", `${obj[property]}`)
                        }
                    }
                },
            })
        });

        $('#department-setting').on('click', function (event) {
            event.preventDefault();
            var url = '{{ route('admin.teams.quick-create')}}';
            $('#modelHeading').html("@lang('messages.manageDepartment')");
            $.ajaxModal('#departmentModel', url);
        });

        $('#designation-setting').on('click', function (event) {
            event.preventDefault();
            var url = '{{ route('admin.designations.quick-create')}}';
            $('#modelHeading').html("@lang('messages.manageDepartment')");
            $.ajaxModal('#departmentModel', url);
        });

        $('.plus-form').click(function() {
            let target = $(event.target)[0];
            if(target.dataset.type == 'skill_id'){
                let target = $(event.target)[0];
                const field = $('#' + target.dataset.type)
                const url = '{{ route('admin.skill.create') }}'
                $('#modelHeading').html('...');
                $.ajaxModal('#departmentModel', url);
            }
            if(target.dataset.type ==  'city'){
                console.log(target.dataset.type)
                const field = $('#' + target.dataset.type)
                const url = '{{ route('admin.tla.create') }}/' + target.dataset.type;
                $('#modelHeading').html('...');
                $.ajaxModal('#departmentModel', url);
            }
        })


        $('.language-form').click(function() {
            let target = $(event.target)[0];
            const field = $('#' + target.dataset.type)
            const url = '{{ route('admin.language-settings.create') }}';
            $('#modelHeading').html('...');
            $.ajaxModal('#departmentModel', url);
    })

</script>

@endpush
