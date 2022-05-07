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
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
<style>
    .table-alphabets{
        display: flex;
        align-content: center;
        justify-content: center;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .table-alphabets a{
        padding: 0px 7px;
        border: 1px solid black;
        font-size: 24px;
        color: black;
        font-family: 'Roboto';
        background: #CEC8C8;
    }
</style>
@endpush

@section('filter-section')
<div class="row"  id="ticket-filters">
    <form action="" id="filter-form">
        <div class="col-xs-12">
            <div class="form-group">
                <label class="">@lang('modules.employees.employeeName')</label>
                <input type="text" name="name" id="f-name" class="form-control" value="" autocomplete="nope">
            </div>
        </div>

        <div class="col-xs-12">
            <div class="form-group">
                <label class="control-label">@lang('app.function')</label>
                <select class="form-control select2" name="function" id="f-function_id" data-style="form-control">
                    <option value="all">@lang('modules.client.all')</option>
                    @foreach ($designations as $option)
                        <option value="{{$option->name}}">{{$option->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="form-group">
                <label class="control-label">@lang('app.type')</label>
                <select class="form-control select2" name="type" id="f-type" data-style="form-control">
                    <option value="all">@lang('modules.client.all')</option>
                    <option value="client">Client</option>
                    <option value="spv">SPV</option>
                    <option value="free">Free</option>
                </select>
            </div>
        </div>
	
        <div class="col-xs-12">
            <br>
            <div class="form-group ">
                <button type="button" id="apply-filters" class="btn btn-success col-md-6"><i class="fa fa-check"></i> @lang('app.apply')</button>
                <button type="button" id="reset-filters" class="btn btn-inverse col-md-5 col-md-offset-1" style="padding-left: 25px !important"><i class="fa fa-refresh"></i> @lang('app.reset')</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="panel-4">
            <div class="panel-heading">
                <h2>@lang('app.contactList')</h2>
                <a href="{{route('admin.contact.create',['contact'])}}" class="btn btn-cs-blue">@lang('app.addContact')</a>
            </div>
            <div class="panel-body">

                <div class="d-flex table-alphabets">
                    <a href="Javascript:;" class="search-record">*</a>
                    <a href="Javascript:;" class="search-record">A</a>
                    <a href="Javascript:;" class="search-record" >B</a>
                    <a href="Javascript:;" class="search-record" >C</a>
                    <a href="Javascript:;" class="search-record" >D</a>
                    <a href="Javascript:;" class="search-record" >E</a>
                    <a href="Javascript:;" class="search-record" >F</a>
                    <a href="Javascript:;" class="search-record" >G</a>
                    <a href="Javascript:;" class="search-record" >H</a>
                    <a href="Javascript:;" class="search-record" >I</a>
                    <a href="Javascript:;" class="search-record" >J</a>
                    <a href="Javascript:;" class="search-record" >K</a>
                    <a href="Javascript:;" class="search-record" >L</a>
                    <a href="Javascript:;" class="search-record" >M</a>
                    <a href="Javascript:;" class="search-record" >N</a>
                    <a href="Javascript:;" class="search-record" >O</a>
                    <a href="Javascript:;" class="search-record" >P</a>
                    <a href="Javascript:;" class="search-record" >Q</a>
                    <a href="Javascript:;" class="search-record" >R</a>
                    <a href="Javascript:;" class="search-record" >S</a>
                    <a href="Javascript:;" class="search-record" >T</a>
                    <a href="Javascript:;" class="search-record" >U</a>
                    <a href="Javascript:;" class="search-record" >V</a>
                    <a href="Javascript:;" class="search-record" >W</a>
                    <a href="Javascript:;" class="search-record" >X</a>
                    <a href="Javascript:;" class="search-record" >Y</a>
                    <a href="Javascript:;" class="search-record" >Z</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="table-contact">
                        <thead>
                        <tr>
                            <th>@lang('app.id')</th>
                            <th>@lang('app.contactName')</th>
                            <th>@lang('app.phone')</th>
                            <th>@lang('app.email')</th>
                            <th>@lang('app.civility')</th>
                            <th>@lang('app.function')</th>
                            <th>@lang('app.visibility')</th>
                            <th>@lang('app.type')</th>
                            <th>@lang('app.action')</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer-script')
<script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
<script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script>
    var table = resetTable()

    $('#apply-filters').click(function (e) {
        resetTable($("#f-name").val(),$("#f-function_id").val(),$("#f-type").val())
    })

    $('#reset-filters').click(function (e) {
        resetTable()
    })

    function resetTable(name='', function_id='all', type='all') {
        $("#f-name").val(name);
        $("#f-function_id").val(function_id);
        $("#f-type").val(type)
        $('#table-contact').DataTable().clear().destroy();
        $("#table-contact").dataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax:{
                'type':'get',
                'url': '{{ route("admin.contact.table") }}',
                'data':{ 
                    name : name,
                    function_id : function_id,
                    type : type
                 },
            },
            order:[1, 'asc'],
            deferRender: true,
            language: {
                "url": "<?php echo __("app.datatable") ?>"
            },
            "fnDrawCallback": function( oSettings ) {
                $("body").tooltip({
                    selector: '[data-toggle="tooltip"]'
                });
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'mobile', name: 'phone' },
                { data: 'email', name: 'email' },
                { data: 'gender', name: 'gender' },
                { data: 'function', name: 'function' },
                { data: 'visibility', name: 'visibility' },
                { data: 'contect_type', name: 'contect type' },
                { data: 'action', name: 'action' }
            ]
        });
    }
    $('body').on('click','.search-record',function(e){
        var str_val = $(this).text();
        $('#table-contact').DataTable().clear().destroy();
        $('#table-contact').dataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax:{
                'type':'get',
                'url': '{{ route("admin.contact.getResult") }}',
                'data':{ query : str_val },
            },
            order:[1, 'asc'],
            deferRender: true,
            language: {
                "url": "<?php echo __("app.datatable") ?>"
            },
            "fnDrawCallback": function( oSettings ) {
                $("body").tooltip({
                    selector: '[data-toggle="tooltip"]'
                });
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'mobile', name: 'phone' },
                { data: 'email', name: 'email' },
                { data: 'gender', name: 'gender' },
                { data: 'function', name: 'function' },
                { data: 'visibility', name: 'visibility' },
                { data: 'contect_type', name: 'contect type' },
                { data: 'action', name: 'action' }
            ]
        });
    });

    $('body').on('click', '.sa-params', function(){
        var id = $(this).attr('data-contact-id');

        swal({
            title: "@lang('messages.sweetAlertTitle')",
            text: "@lang('messages.confirmation.recoverContact')",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "@lang('messages.confirmUnsubscribe')",
            cancelButtonText: "@lang('messages.confirmNoArchive')",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm){
            if (isConfirm) {

                var url = "{{ route('admin.contact.delete',':id') }}";
                url = url.replace(':id', id);

                var token = "{{ csrf_token() }}";

                $.easyAjax({
                    type: 'POST',
                            url: url,
                            data: {'_token': token},
                    success: function (response) {
                            console.log(response)
                        if (response.status == "success") {
                            $.unblockUI();
                                   swal("Deleted!", response.message, "success");
                            table._fnDraw();
                        }
                    }
                });
            }
        });
    });

</script>
@endpush