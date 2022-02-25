@extends('layouts.super-admin')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 bg-title-left">@include('sections.ctrl_button')
            <h4 class="page-title" style="min-width: max-content"> {{ __($pageTitle) }}</h4>
        </div>
        <!-- /.page title -->
    </div>
@endsection

@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/cc-picker/jquery.ccpicker.css') }}">
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

        fieldset {
            border: 1px solid #DBD2D2;
            padding: 10px;
            height: 100%;
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
            /* min-width: max-content; */
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

    <div class="">
        <div class="col-xs-12">

            <div class="panel-4">
                <div class="panel-heading">
                    <h2>@lang('app.update') @lang('app.company')</h2>
                </div>

                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        {!! Form::open(['id' => 'updateCompany', 'class' => 'ajax-form', 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-body" style="margin-top: 40px">
                            <div class="row">
                                <div class="col-md-4">
                                    <fieldset>
                                        <legend>Identifications</legend>
                                        <table>
                                            <tr>
                                                <td><label for="company_name"
                                                        class="required">@lang('app.name_ucfirst')</label></td>
                                                <td>
                                                    <input type="text" class="form-control" id="company_name"
                                                        name="company_name" value=" {{ $company->company_name }} ">
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="legal_form"
                                                        class="required">@lang('app.legalForm')</label></td>
                                                <td><select name="legal_form" id="legal_form" class="form-control select2">
                                                        <option value="" disabled>@lang('app.legalForm')</option>
                                                        @foreach ($tla as $l)
                                                            @if ($l->type == 'legal_form')
                                                                @if ($l->name == $companySubSettings->legal_form)
                                                                    <option value=" {{ $l->name }} " selected>
                                                                        {{ $l->name }}</option>
                                                                @else
                                                                    <option value=" {{ $l->name }} ">
                                                                        {{ $l->name }}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select></td>
                                                <td>
                                                    <a href="javascript:;" class="text-info plus-form">
                                                        <img src="{{ asset('img/plus.png') }}" alt="" data-type="legal_form"> </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="address" class="required">@lang('app.address')</label>
                                                </td>
                                                <td><textarea class="form-control" name="address" id="address" value="  "
                                                        style="width:100%"
                                                        rows="2">{{ explode('|', $company->address)[0] }}</textarea></td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="country" class="required">@lang('app.country')</label>
                                                </td>
                                                <td>
                                                    <select name="country" id="country" class="form-control select2">
                                                        @foreach ($countries as $country)
                                                            @if (explode('|', $company->address)[1] == $country->name)
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
                                                <td><label for="city" class="required">@lang('app.cp')</label>
                                                </td>
                                                <td>
                                                    <select name="city" id="city" class="form-control select2">
                                                        <option value="" disabled>@lang('app.cp')</option>
                                                        @foreach ($tla as $t)
                                                            @if ($t->type == 'city')
                                                                @if ($t->name == explode('|', $company->address)[2])
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
                                                        <img src="{{ asset('img/plus.png') }}" alt="" data-type="city">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="activity_sector" class="">Secteur
                                                        d'activité</label>
                                                </td>
                                                <td>
                                                    <select name="activity_sector" id="activity_sector"
                                                        class="form-control select2">
                                                        <option value="" disabled>Secteur
                                                            d'activité</option>
                                                        @foreach ($tla as $a)
                                                            @if ($a->type == 'activity_sector')
                                                                @if ($a->name == $company->activity_field)
                                                                    <option value=" {{ $a->name }} " selected>
                                                                        {{ $a->name }}</option>
                                                                @else
                                                                    <option value=" {{ $a->name }} ">
                                                                        {{ $a->name }}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="javascript:;" class="text-info plus-form">
                                                        <img src="{{ asset('img/plus.png') }}" alt="" data-type="activity_sector">
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="col-xs-12 text-center">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 250px; height: 80px;">

                                                    <img src="{{ $company->logo_url }}" alt="" />
                                                </div>
                                                <a href="#!" class="invisible">
                                                    <img src="{{ asset('img/plus.png') }}" alt="">
                                                </a>
                                                <div class="fileinput-preview fileinput-exists thumbnail"
                                                    style="width: 250px; height: 80px;">
                                                </div>
                                                <div>
                                                    <span class="btn btn-primary btn-file btn-sm rounded-pill "
                                                        style="padding: 0px 12px !important">
                                                        <span class="fileinput-new "> @lang('app.selectImage') </span>
                                                        <span class="fileinput-exists"> @lang('app.change') </span>
                                                        <input type="file" name="logo" id="logo">
                                                    </span>
                                                    <a href="javascript:;"
                                                        class="btn btn-danger btn-sm fileinput-exists rounded-pill "
                                                        data-dismiss="fileinput" style="padding: 0px 12px !important">
                                                        @lang('app.remove') </a>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-md-4">
                                    <fieldset>
                                        <legend>Coordonées </legend>
                                        <table>
                                            <tr>
                                                <td>
                                                    <label for="tel">Tel</label>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        {{-- <div class="input-group-btn">
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
                                                        </div><!-- /btn-group --> --}}
                                                        <input type="text" name="company_phone" id="tel"
                                                            class="form-control phone-input ccpicker" aria-label="..."
                                                            value=" {{ explode(' ', $company->company_phone)[1] }} ">
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
                                                    <label for="mobile">Mobile</label>
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
                                                                            {{ ucfirst($country->name) }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div><!-- /btn-group --> --}}
                                                        <input type="text" name="mobile" id="mobile"
                                                            class="form-control phone-input ccpicker" aria-label="..."
                                                            value=" {{ explode(' ', $companySubSettings->mobile)[1] }} ">
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            {{-- <tr> --}}
                                            {{-- <td> --}}
                                            {{-- <label for="fax">Fax</label> --}}
                                            {{-- </td> --}}
                                            {{-- <td> --}}
                                            {{-- <div class="d-flex"> --}}
                                            {{-- <div class="input-group-btn"> --}}
                                            {{-- <button type="button" class="btn dropdown-toggle" --}}
                                            {{-- data-toggle="dropdown" aria-haspopup="true" --}}
                                            {{-- aria-expanded="false"><span class="flag-icon flag-icon-fr" --}}
                                            {{-- id="bind-flag-fax"></span> <span --}}
                                            {{-- class="caret"></span></button> --}}
                                            {{-- <ul class="dropdown-menu phonecode-select"> --}}
                                            {{-- @foreach ($countries as $country) --}}
                                            {{-- <li> --}}
                                            {{-- <a class="phonecode-item" --}}
                                            {{-- data-phonecode="{{ $country->phonecode }}" --}}
                                            {{-- data-input="fax" data-bind-flag="bind-flag-fax" --}}
                                            {{-- data-flag="flag-icon-{{ strtolower($country->iso) }}"> --}}
                                            {{-- <span --}}
                                            {{-- class="flag-icon flag-icon-{{ strtolower($country->iso) }}"></span> --}}
                                            {{-- {{ ucfirst($country->name) }} --}}
                                            {{-- </a> --}}
                                            {{-- </li> --}}
                                            {{-- @endforeach --}}
                                            {{-- </ul> --}}
                                            {{-- </div><!-- /btn-group --> --}}
                                            {{-- <input type="text" name="fax" id="fax" --}}
                                            {{-- style="padding-left: 57px !important;" --}}
                                            {{-- class="form-control phone-input" aria-label="..." value="+33"> --}}
                                            {{-- </div> --}}
                                            {{-- </td> --}}
                                            {{-- <td> --}}
                                            {{-- <a href="#!" class="invisible"> --}}
                                            {{-- <img src="{{ asset('img/plus.png') }}" alt=""> --}}
                                            {{-- </a> --}}
                                            {{-- </td> --}}
                                            {{-- </tr> --}}

                                            <tr>
                                                <td>
                                                    <label for="company_email" class="required">Email</label>
                                                </td>
                                                <td>
                                                    <input type="email" value=" {{ $company->company_email }} "
                                                        name="company_email" class="form-control">

                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="devise" class="required">Devise</label>
                                                </td>
                                                <td>
                                                    <select name="devise" id="devise" class="form-control select2">
                                                        @forelse($currencies as $currency)
                                                            <option @if ($currency->id == $global->currency_id) selected
                                                                @endif value="{{ $currency->id }}">
                                                                {{ $currency->currency_name }} -
                                                                ({{ $currency->currency_symbol }})
                                                            </option>
                                                        @empty
                                                        @endforelse
                                                    </select>

                                                </td>
                                                <td>
                                                    <a href=" {{ route('super-admin.currency.create') }} "
                                                        style="background: none">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                    {{-- <div class="dropdown dropup">
                                                        <a class="dropdown-toggle" id="dropdownMenuLink" href="#"
                                                            role="link" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false" style="background: none">
                                                            <img src="{{ asset('img/plus.png') }}" alt="">
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end"
                                                            aria-labelledby="dropdownMenuLink"
                                                            style="padding: 10px!important;">
                                                            <label for="new" class="required dropdown-item"
                                                                style="font-weight: bold!important;">Devise</label>
                                                            <input type="text" name="new" class="form-control"
                                                                style="margin: 5px!important;">
                                                            <div class="dropdown-divider"></div>
                                                            <button class="btn btn-primary dropdown-item btn-sm"
                                                                type="button"
                                                                style="float: right!important;font-weight: bold!important;">@lang('app.add')</button>
                                                        </div>
                                                    </div> --}}
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
                                                    <a href=" {{ route('super-admin.language-settings.create') }} "
                                                        style="background: none">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="siret" class="">N°Siret</label>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="siret" name="siret"
                                                        value=" {{ $company->siret }} ">

                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="tva_intrat" class="">N°TVA intrat</label>
                                                </td>
                                                <td>
                                                    <input name="tva_intrat" id="tva_intrat" value="{{$companySubSettings->tva_intrat}}" class="form-control">
{{--                                                    <select name="tva_intrat" id="tva_intrat" class="form-control select2">--}}
{{--                                                        <option value="" disabled>N°TVA intrat</option>--}}
{{--                                                        @foreach ($tla as $t)--}}
{{--                                                            @if ($t->type == 'tva_intrat')--}}
{{--                                                                @if ($t->name == $companySubSettings->tva_intrat)--}}
{{--                                                                    <option value=" {{ $t->name }} " selected>--}}
{{--                                                                        {{ ucfirst($t->name) }}</option>--}}
{{--                                                                @else--}}
{{--                                                                    <option value=" {{ $t->name }} ">--}}
{{--                                                                        {{ ucfirst($t->name) }}</option>--}}
{{--                                                                @endif--}}
{{--                                                            @endif--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
                                                </td>
{{--                                                <td>--}}
{{--                                                    <a href="javascript:;" class="text-info plus-form">--}}
{{--                                                        <img src="{{ asset('img/plus.png') }}" alt="" data-type="tva_intrat">--}}
{{--                                                    </a>--}}
{{--                                                </td>--}}
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="description" class="">Description</label>
                                                </td>
                                                <td>
                                                    <textarea class="form-control" name="description" id="description"
                                                        value=" " style="width:100%"
                                                        rows="2">{{ $companySubSettings->description }} </textarea>
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
                                        <legend>Administrateur</legend>
                                        <div class="d-flex align-items-center">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <label for="admin_name" class="required">Nom de
                                                            l'Administrateur</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="userid" value="{{ $companyUser->id }}"
                                                            hidden>
                                                        <input type="text" class="form-control" id="admin_name"
                                                            name="admin_name" value=" {{ $companyUser->name }} ">
                                                    </td>
                                                    <td>
                                                        <a href="#!" class="invisible">
                                                            <img src="{{ asset('img/plus.png') }}" alt="">
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label for="email" class="required">Login/Email</label>
                                                    </td>
                                                    <td>
                                                        <input type="email" class="form-control" id="email" name="email"
                                                            value=" {{ $companyUser->email }} ">
                                                    </td>
                                                    <td>
                                                        <a href="#!" class="invisible">
                                                            <img src="{{ asset('img/plus.png') }}" alt="">
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="password" class="required">Mot de passe</label>
                                                    </td>
                                                    <td>
                                                        <input type="password" class="form-control" id="password"
                                                            name="password" value="">

                                                    </td>
                                                    <td>
                                                        <a href="#!" class="invisible">
                                                            <img src="{{ asset('img/plus.png') }}" alt="">
                                                        </a>
                                                    </td>
                                                </tr>
                                                {{-- <tr class="text-center">
                                                    <td></td>
                                                    <td>
                                                        <button type="button" id="send_notification"
                                                            class="btn btn-primary btn-sm"
                                                            style="border-radius: 100px">Envoyer Notification</button>
                                                    </td>
                                                </tr> --}}
                                            </table>

                                            {{-- <div> --}}
                                            {{-- <img src="{{ asset('img/logo-placeholder.png') }}" alt=""> --}}
                                            {{-- </div> --}}

                                        </div>


                                    </fieldset>
                                </div>

                                {{-- <div class="col-md-4"> --}}
                                {{-- <fieldset> --}}
                                {{-- <legend>Contact principal</legend> --}}
                                {{-- <div class="form-group"> --}}
                                {{-- <label for="" class="mb-0">Civilité</label> --}}
                                {{-- <div class="d-flex"> --}}
                                {{-- <div class="form-group mb-0"> --}}
                                {{-- <input type="radio" name="demo1"> --}}
                                {{-- <label for="demo1" style="margin-bottom: 0px">M</label> --}}
                                {{-- </div> --}}
                                {{-- <div class="form-group mb-0"> --}}
                                {{-- <input type="radio" name="demo1"> --}}
                                {{-- <label for="demo1" style="margin-bottom: 0px">Mme</label> --}}
                                {{-- </div> --}}
                                {{-- <div class="form-group mb-0"> --}}
                                {{-- <button class="btn btn-sm btn-primary rounded-pill " --}}
                                {{-- style="display: inline-block !important; padding: 0px 12px !important">Lier --}}
                                {{-- contact</button> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- </div> --}}

                                {{-- <table> --}}
                                {{-- <tr> --}}
                                {{-- <td> --}}
                                {{-- <label for="firstname" class="required">Prénom</label> --}}
                                {{-- </td> --}}
                                {{-- <td> --}}
                                {{-- <input type="text" name="firstname" class="form-control"> --}}

                                {{-- </td> --}}
                                {{-- <td> --}}
                                {{-- <a href="#!" class="invisible"> --}}
                                {{-- <img src="{{ asset('img/plus.png') }}" alt=""> --}}
                                {{-- </a> --}}

                                {{-- </td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td> --}}
                                {{-- <label for="lastname" class="required">Nom</label> --}}
                                {{-- </td> --}}
                                {{-- <td> --}}
                                {{-- <input type="text" name="lastname" class="form-control"> --}}

                                {{-- </td> --}}
                                {{-- <td> --}}
                                {{-- <a href="#!" class="invisible"> --}}
                                {{-- <img src="{{ asset('img/plus.png') }}" alt=""> --}}
                                {{-- </a> --}}

                                {{-- </td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td> --}}
                                {{-- <label for="function" class="required">Fonction</label> --}}
                                {{-- </td> --}}
                                {{-- <td> --}}
                                {{-- <input type="text" name="function" class="form-control"> --}}

                                {{-- </td> --}}
                                {{-- <td> --}}
                                {{-- <a href="#!" class="invisible"> --}}
                                {{-- <img src="{{ asset('img/plus.png') }}" alt=""> --}}
                                {{-- </a> --}}

                                {{-- </td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td> --}}
                                {{-- <label for="email" class="required">Email</label> --}}
                                {{-- </td> --}}
                                {{-- <td> --}}
                                {{-- <input type="email" name="email" class="form-control"> --}}

                                {{-- </td> --}}
                                {{-- <td> --}}
                                {{-- <a href="#!" class="invisible"> --}}
                                {{-- <img src="{{ asset('img/plus.png') }}" alt=""> --}}
                                {{-- </a> --}}

                                {{-- </td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td> --}}
                                {{-- <label for="c-tel">Tel</label> --}}
                                {{-- </td> --}}
                                {{-- <td> --}}
                                {{-- <div class="d-flex"> --}}
                                {{-- <div class="input-group-btn"> --}}
                                {{-- <button type="button" class="btn dropdown-toggle" --}}
                                {{-- data-toggle="dropdown" aria-haspopup="true" --}}
                                {{-- aria-expanded="false"><span class="flag-icon flag-icon-fr" --}}
                                {{-- id="bind-flag-c-tel"></span> <span --}}
                                {{-- class="caret"></span></button> --}}
                                {{-- <ul class="dropdown-menu phonecode-select"> --}}
                                {{-- @foreach ($countries as $country) --}}
                                {{-- <li> --}}
                                {{-- <a class="phonecode-item" --}}
                                {{-- data-phonecode="{{ $country->phonecode }}" --}}
                                {{-- data-input="c-tel" --}}
                                {{-- data-bind-flag="bind-flag-c-tel" --}}
                                {{-- data-flag="flag-icon-{{ strtolower($country->iso) }}"> --}}
                                {{-- <span --}}
                                {{-- class="flag-icon flag-icon-{{ strtolower($country->iso) }}"></span> --}}
                                {{-- {{ ucfirst(strtolower($country->name)) }} --}}
                                {{-- </a> --}}
                                {{-- </li> --}}
                                {{-- @endforeach --}}
                                {{-- </ul> --}}
                                {{-- </div><!-- /btn-group --> --}}
                                {{-- <input type="text" name="c-tel" id="c-tel" --}}
                                {{-- style="padding-left: 57px !important;" --}}
                                {{-- class="form-control phone-input" aria-label="..." value="+33"> --}}
                                {{-- </div> --}}
                                {{-- </td> --}}
                                {{-- <td> --}}
                                {{-- <a href="#!" class="invisible"> --}}
                                {{-- <img src="{{ asset('img/plus.png') }}" alt=""> --}}
                                {{-- </a> --}}
                                {{-- </td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td> --}}
                                {{-- <label for="c-mobile">Mobile</label> --}}
                                {{-- </td> --}}
                                {{-- <td> --}}
                                {{-- <div class="d-flex"> --}}
                                {{-- <div class="input-group-btn"> --}}
                                {{-- <button type="button" class="btn dropdown-toggle" --}}
                                {{-- data-toggle="dropdown" aria-haspopup="true" --}}
                                {{-- aria-expanded="false"><span class="flag-icon flag-icon-fr" --}}
                                {{-- id="bind-flag-c-mobile"></span> <span --}}
                                {{-- class="caret"></span></button> --}}
                                {{-- <ul class="dropdown-menu phonecode-select"> --}}
                                {{-- @foreach ($countries as $country) --}}
                                {{-- <li> --}}
                                {{-- <a class="phonecode-item" --}}
                                {{-- data-phonecode="{{ $country->phonecode }}" --}}
                                {{-- data-input="c-mobile" --}}
                                {{-- data-bind-flag="bind-flag-c-mobile" --}}
                                {{-- data-flag="flag-icon-{{ strtolower($country->iso) }}"> --}}
                                {{-- <span --}}
                                {{-- class="flag-icon flag-icon-{{ strtolower($country->iso) }}"></span> --}}
                                {{-- {{ ucfirst(strtolower($country->name)) }} --}}
                                {{-- </a> --}}
                                {{-- </li> --}}
                                {{-- @endforeach --}}
                                {{-- </ul> --}}
                                {{-- </div><!-- /btn-group --> --}}
                                {{-- <input type="text" name="c-mobile" id="c-mobile" --}}
                                {{-- style="padding-left: 57px !important;" --}}
                                {{-- class="form-control phone-input" aria-label="..." value="+33"> --}}
                                {{-- </div> --}}
                                {{-- </td> --}}
                                {{-- <td> --}}
                                {{-- <a href="#!" class="invisible"> --}}
                                {{-- <img src="{{ asset('img/plus.png') }}" alt=""> --}}
                                {{-- </a> --}}
                                {{-- </td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td> --}}
                                {{-- <label for="c-fax">Fax</label> --}}
                                {{-- </td> --}}
                                {{-- <td> --}}
                                {{-- <div class="d-flex"> --}}
                                {{-- <div class="input-group-btn"> --}}
                                {{-- <button type="button" class="btn dropdown-toggle" --}}
                                {{-- data-toggle="dropdown" aria-haspopup="true" --}}
                                {{-- aria-expanded="false"><span class="flag-icon flag-icon-fr" --}}
                                {{-- id="bind-flag-c-fax"></span> <span --}}
                                {{-- class="caret"></span></button> --}}
                                {{-- <ul class="dropdown-menu phonecode-select"> --}}
                                {{-- @foreach ($countries as $country) --}}
                                {{-- <li> --}}
                                {{-- <a class="phonecode-item" --}}
                                {{-- data-phonecode="{{ $country->phonecode }}" --}}
                                {{-- data-input="c-fax" --}}
                                {{-- data-bind-flag="bind-flag-c-fax" --}}
                                {{-- data-flag="flag-icon-{{ strtolower($country->iso) }}"> --}}
                                {{-- <span --}}
                                {{-- class="flag-icon flag-icon-{{ strtolower($country->iso) }}"></span> --}}
                                {{-- {{ ucfirst(strtolower($country->name)) }} --}}
                                {{-- </a> --}}
                                {{-- </li> --}}
                                {{-- @endforeach --}}
                                {{-- </ul> --}}
                                {{-- </div><!-- /btn-group --> --}}
                                {{-- <input type="text" name="c-fax" id="c-fax" --}}
                                {{-- style="padding-left: 57px !important;" --}}
                                {{-- class="form-control phone-input" aria-label="..." value="+33"> --}}
                                {{-- </div> --}}
                                {{-- </td> --}}
                                {{-- <td> --}}
                                {{-- <a href="#!" class="invisible"> --}}
                                {{-- <img src="{{ asset('img/plus.png') }}" alt=""> --}}
                                {{-- </a> --}}
                                {{-- </td> --}}
                                {{-- </tr> --}}
                                {{-- </table> --}}
                                {{-- </fieldset> --}}
                                {{-- </div> --}}
                            </div>
                        </div>

                        <div class="form-actions" style="margin-top: 20px">
                            {{-- <button class="btn btn-reset" type="reset">@lang('app.annuler')</button> --}}
                            <button type="submit" id="save-form" class="btn btn-success">@lang('app.update')</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- .row -->
    <div class="modal fade bs-modal-md in" id="addModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

@endsection

@push('footer-script')

    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/cc-picker/jquery.ccpicker.js') }}"></script>
    <script>
        $(".ccpicker").CcPicker({
            dataUrl: "{{ asset('data.json') }}"
        });

        $("#mobile").CcPicker("setCountryByPhoneCode", "{{ substr(explode(' ', $companySubSettings->mobile)[0], 1) }}");
        $("#tel").CcPicker("setCountryByPhoneCode", "{{ substr(explode(' ', $company->company_phone)[0], 1) }}");

        $(".select2").select2({
            formatNoMatches: function() {
                return "{{ __('messages.noRecordFound') }}";
            }
        });

        $('#save-form').click(function() {
            $.easyAjax({
                url: '{{ route('super-admin.companies.update', [$company->id]) }}',
                container: '#updateCompany',
                type: "POST",
                redirect: true,
                file: true,
                error: function (response) {
                    $("input").css("border-color", "#ccc")
                    $("input").attr("title", ``)
                    $("textarea").css("border-color", "#ccc")
                    $("textarea").attr("title", ``)
                    $("select").css("border-color", "#ccc")
                    $("select").attr("title", ``)
                    let obj = response.responseJSON.errors
                    for (const property in obj) {
                        $("#"+property).css("border-color", "#ef1f1f")
                        $("#"+property).attr("title", `${obj[property]}`)
                    }
                },
            })
        });


        $('.phonecode-item').click(function(event) {
            event.preventDefault();
            var target = $(event.target)[0];

            $('#' + target.dataset.input).val("+" + target.dataset.phonecode)
            $('#' + target.dataset.bindFlag).attr('class', "flag-icon " + target.dataset.flag)
        })

        $('.plus-form').click(function() {
            let target = $(event.target)[0];
            const field = $('#' + target.dataset.type)
            const url = '{{ route('super-admin.tla.create') }}/' + target.dataset.type;
            $('#modelHeading').html('...');
            $.ajaxModal('#addModal', url);
        })
    </script>

@endpush
