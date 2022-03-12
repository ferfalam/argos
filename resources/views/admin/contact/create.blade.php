@extends('layouts.app')

@section('page-title')
<x-main-header>
    <x-slot name="title">
        @lang($pageTitle) 
    </x-slot>

    {{-- <x-slot name="btns">
        <x-link type="link" url="{{ route('admin.projects.create') }}"  classes="btn btn-cs-blue" icon="fa fa-plus" title="app.createProject"/>
    </x-slot> --}}
</x-main-header>
@endsection


@push('head-script')
<link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css'>
<link rel="stylesheet" href="{{ asset('plugins/cc-picker/jquery.ccpicker.css') }}">

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

    .form-body{
        display: grid !important;
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

    .row-1{
        grid-template-columns: 1fr;
    }
</style>
@endpush

@section('content')
<div class="">
    <div class="col-xs-12">
        <div class="panel-4">
            <div class="panel-heading">
                <h2>@lang('app.contactFile')</h2>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    {!! Form::open(['id' => 'createContect', 'class' => 'ajax-form', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-body form-input" style="margin-top: 40px">
                        <input type="hidden" name="page_type" value="{{ $type }}"  >
                        <div class="row-1">

                            <div class="col-md-12">
                                <fieldset>
                                    <legend>@lang('app.genralinfo')</legend>
                                    <div class="col-md-6">
                                        <table>
                                            <tr>
                                                <td>
                                                    <label for="" class="mb-0">@lang('app.civility')</label>
                                                </td>
                                                <td>
                                                    <div class="d-flex" style="margin-right: 40px; gap:20px">
                                                        <div class="form-group mb-0">
                                                            <input type="radio" name="gender" value="male">
                                                            <label for="civility" style="margin-bottom: 0px">M</label>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <input type="radio" name="gender" value="female">
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
                                                <td>
                                                    <label for="function" class="required">@lang('app.function')</label>
                                                </td>
                                                <td>
                                                    <select name="function" id="function" class="form-control select2">
                                                        @foreach ($designations as $designation)
                                                            <option value=" {{ $designation->name }} ">
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

                                            {{-- <tr>
                                                <td>
                                                    <label for="function" class="required">@lang('app.function')</label>
                                                </td>
                                                <td>
                                                    <input type="text" name="function"  id="function" class="form-control">
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible" >
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr> --}}

                                            <tr>
                                                <td>
                                                    <label for="email" class="required">@lang('app.login_email')</label>
                                                </td>
                                                <td>
                                                    <input type="email" name="email"  id="email" class="form-control">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label for="mobile">@lang('app.mobile')</label>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <input type="text" name="mobile" id="mobile"
                                                            class="form-control phone-input ccpicker" aria-label="...">
                                                    </div><!-- /input-group -->
                                                </td>
                                            </tr>

                                            

                                            
                                        </table>
                                    </div>

                                    {{-- <div class="col-md-1"></div> --}}

                                    <div class="col-md-6">
                                        <table>
                                            
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
                                                        <option value="free" @if($type != 'free' && $type != 'contact' ) disabled @endif >Free</option>
                                                        <option value="client" @if($type != 'client' && $type != 'contact' ) disabled @endif  >Client</option>
                                                        <option value="supplier" @if($type != 'supplier' && $type != 'contact' ) disabled @endif >Supplier</option>
                                                        <option value="spv" @if($type != 'spv' && $type != 'contact' ) disabled @endif >Spv</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="#!" class="invisible">
                                                        <img src="{{ asset('img/plus.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><label for="user_id" class="required">@lang('app.attach_to')
                                                    </label></td>
                                                <td>
                                                    <select name="user_id" id="user_id" class="form-control select2">
                                                            @foreach($clients as $client)
                                                            <option value="{{$client->id}}" >{{$client->company_name}}</option>
                                                            @endforeach
                                                    </select>
                                                   
                                                <td>
                                                    <a href="#!" class="invisible" >
                                                        <img src="{{ asset('img/attach-to.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>

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
                                </fieldset>
                            </div>
                        </div>

                    </div>
                    <div class="form-actions " style="margin-top: 20px; display: block">
                        {{-- <button class="btn btn-reset" type="reset">@lang('app.annuler')</button> --}}
                        <button type="submit" id="save-form" class="btn btn-success">@lang('app.enregistrer') </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
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


    if($('#contect_type').val() == 'free'){
        $('#user_id').html("");
        $('#user_id').prop('disabled',true);
    }

    // getCompany();
    $('#contect_type').change(function (e) {
        var content_type = $(this).val();
        if(content_type == 'free'){
            $('#user_id').prop('disabled',true);
        }
        else{
            $('#user_id').prop('disabled',false);
            getCompany(content_type);
        }
        $('#user_id').html("");
    });

        function getCompany(content_type){
            var url = "{{route('admin.contact.getCompany')}}";
            var token = "{{ csrf_token() }}";
            $.easyAjax({
                url: url,
                type: "POST",
                data: {'_token': token, content_type: content_type},
                success: function (data) {
                    var options = [];
                    var rData = [];
                    rData = data.company;
                    $.each(rData, function( index, value ) {
                        var selectData = '';
                        selectData = '<option value="'+value.id+'">'+value.company_name+'</option>';
                        options.push(selectData);
                    });
                    $('#user_id').html(options);
                }
            })
        }


    $('#save-form').click(function () {
        $.easyAjax({
            url: '{{route('admin.contact.store')}}',
            container: '#createContect',
            type: "POST",
            redirect: true,
            file: (document.getElementById("image").files.length == 0) ? false : true,
            data: $('#createContect').serialize(),
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
                        if(property == 'user_id' ){
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

    $("#mobile").CcPicker("setCountryByPhoneCode", "33");
    $("#tel").CcPicker("setCountryByPhoneCode", "33");
</script>
@endpush