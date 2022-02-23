@extends('layouts.super-admin')

@section('page-title')
    <div class="row bg-title">

        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 bg-title-left">
            @include('sections.ctrl_button')
            <h4 class="page-title" style="min-width: max-content" style="font-weight: bold"> {{ __($pageTitle) }}</h4>
        </div>
        <!-- /.page title -->
    </div>
@endsection

@push('head-script')

    <link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css'>
    <link rel="stylesheet" href="{{ asset('plugins/cc-picker/jquery.ccpicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
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
                        {!! Form::open(['id' => 'createClient', 'class' => 'ajax-form', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
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
                                                            <input type="radio" name="civility" value="male">
                                                            <label for="civility" style="margin-bottom: 0px">M</label>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <input type="radio" name="civility" value="female">
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
                                                <td><label for="name" class="required">@lang('app.user_id')
                                                    </label></td>
                                                <td>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="">
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="name" class="required">@lang('app.lastnamefirstname')
                                                    </label></td>
                                                <td>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="">
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
                                                <td><label for="country" class="required">@lang('app.pays')</label>
                                                </td>
                                                <td>
                                                    <select name="country" id="country" class="form-control select2">
                                                        @foreach ($countries as $country)
                                                            <option value=" {{ $country->name }} ">
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
                                                <td><label for="city" class="required">@lang('app.cp')</label></label>
                                                </td>
                                                <td>
                                                    <select name="city" id="city" class="form-control select2">
                                                        <option value="" disabled>@lang('app.cp')</option>
                                                        @foreach ($tla as $t)
                                                            @if ($t->type == 'city')
                                                                <option value=" {{ $t->name }} ">
                                                                    {{ ucfirst(strtolower($t->name)) }}</option>
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
                                                        <option value="Super Admin">Super Admin</option>
                                                        <option value="Admin" disabled>Admin</option>
                                                        <option value="Collaborateur" disabled>Collaborateur</option>
                                                        <option value="Profil Externe" disabled>Profil Externe</option>
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
                                                    <label for="qualification"
                                                        class="required">@lang('app.qualification')</label>
                                                </td>
                                                <td>
                                                    <select name="qualification" id="qualification"
                                                        class="form-control select2">
                                                        <option value="" disabled>@lang('app.qualification')</option>
                                                        @foreach ($tla as $t)
                                                            @if ($t->type == 'qualification')
                                                                <option value=" {{ $t->name }} ">
                                                                    {{ ucfirst(strtolower($t->name)) }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                <td>
                                                    <a href="javascript:;" class="text-info plus-form">
                                                        <img src="{{ asset('img/plus.png') }}" alt="" data-type="qualification">
                                                    </a>
                                                </td>
                                            </tr> --}}
                                            <tr>
                                                <td>
                                                    <label for="birthday"
                                                        class="required">@lang('app.datenaissance')</label>
                                                </td>
                                                <td>
                                                    <input type="text" name="birthday" class="form-control datepicker">
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
                                                            <option value=" {{ $country->name }} ">
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
                                                    <label for="nationality"
                                                        class="required">@lang('app.nationalite')</label>
                                                </td>
                                                <td>
                                                    <select name="nationality" id="nationality"
                                                        class="form-control select2">
                                                        @foreach ($countries as $country)
                                                            <option value=" {{ $country->name }} ">
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
                                                        class="required">@lang('app.start_date')</label>
                                                </td>
                                                <td>
                                                    <input type="text" name="start_date" class="form-control datepicker">
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
                                                        class="required">@lang('app.end_date')</label>
                                                </td>
                                                <td>
                                                    <input type="text" name="end_date" class="form-control datepicker">
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            {{-- <tr>
                                                <td>
                                                    <label for="observation"
                                                        class="required">@lang('app.observation')</label>
                                                </td>
                                                <td>
                                                    <textarea class="form-control" name="observation" id="observation"
                                                        style="width:100%" rows="2"></textarea>
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr> --}}
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
                                                        <img src="https://via.placeholder.com/200x150.png?text={{ str_replace(' ', '+', __('modules.profile.uploadPicture')) }}"
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
                                                <td>
                                                    <label for="service" class="required">@lang('app.services')</label>
                                                </td>
                                                <td>
                                                    <select name="service" id="service" class="form-control select2">
                                                        <option value="Service A">Service A</option>
                                                        <option value="Service B" disabled>Service B</option>
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
                                                                            {{ ucfirst(strtolower($country->name)) }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div><!-- /btn-group --> --}}
                                                        <input type="text" name="mobile" id="mobile"
                                                            class="form-control phone-input ccpicker" aria-label="...">
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
                                                            <input type="radio" name="notification" value="male">
                                                            <label for="notification" style="margin-bottom: 0px">@lang('app.active')</label>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <input type="radio" name="notification" value="female">
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
                                                    <label for="email" class="required">@lang('app.login_email')</label>
                                                </td>
                                                <td>
                                                    <input type="email" name="email" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="password"
                                                        class="required">@lang('app.motdepasse')</label>
                                                </td>
                                                <td>
                                                    <input type="password" name="password" class="form-control">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label for="connexion" class="required">@lang('app.connexion')</label>
                                                </td>
                                                <td>
                                                    <select name="connexion" id="connexion" class="form-control select2">
                                                        <option value="Service A">Service A</option>
                                                        <option value="Service B" disabled>Service B</option>
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
                                                    <label for="status" class="required">@lang('app.status')</label>
                                                </td>
                                                <td>
                                                    <select name="status" id="status" class="form-control select2">
                                                        <option value="Service A">Service A</option>
                                                        <option value="Service B" disabled>Service B</option>
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

                            </div>

                        </div>
                        <div class="form-actions" style="margin-top: 20px">
                            {{-- <button class="btn btn-reset" type="reset">@lang('app.annuler')</button> --}}
                            <button type="submit" id="save-form" class="btn btn-success">@lang('app.enregistrer') </button>
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
    <script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/cc-picker/jquery.ccpicker.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/summernote/dist/summernote.min.js') }}"></script>
    <script>
        $(".ccpicker").CcPicker({
            dataUrl: "{{ asset('data.json') }}"
        });

        $("#mobile").CcPicker("setCountryByPhoneCode", "33");
        $("#tel").CcPicker("setCountryByPhoneCode", "33");

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
        });

        $('#save-form').click(function() {
            $.easyAjax({
                url: '{{ route('super-admin.super-admin.store') }}',
                container: '#createClient',
                type: "POST",
                redirect: true,
                data: $('#createClient').serialize(),
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

        $(".select2").select2({
            formatNoMatches: function() {
                return "{{ __('messages.noRecordFound') }}";
            }
        });

        // {{--$('.plus-form').click(function(event) {--}}
        // {{--    var target = $(event.target)[0];--}}
        // {{--    const field = $('#' + target.dataset.type)--}}
        // {{--    name: $('#new_' + target.dataset.type).val(),--}}

        // {{--        $.easyAjax({--}}
        // {{--            url: "{{ route('super-admin.tla.store') }}",--}}
        // {{--            type: 'POST',--}}
        // {{--            data: {--}}
        // {{--                _token: '{{ csrf_token() }}',--}}
        // {{--                name: $('#new_' + target.dataset.type).val(),--}}
        // {{--                type: target.dataset.type--}}
        // {{--            },--}}
        // {{--            success: function(response) {--}}
        // {{--                console.log(response)--}}
        // {{--                if (response.status == 'success') {--}}
        // {{--                    field.append(--}}
        // {{--                        `<option value="${response.tla.name}">${response.tla.name}</option>`)--}}
        // {{--                }--}}
        // {{--            }--}}
        // {{--        });--}}
        // {{--})--}}

        $('.plus-form').click(function () {
            let target = $(event.target)[0];
            const field = $('#' + target.dataset.type)
            const url = '{{ route('super-admin.tla.create')}}/' + target.dataset.type;
            $('#modelHeading').html('...');
            $.ajaxModal('#addModal', url);
        })
    </script>

@endpush
