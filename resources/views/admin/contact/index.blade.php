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
                <label class="required">@lang('modules.employees.employeeName')</label>
                <input type="text" name="name" id="name" class="form-control" value="" autocomplete="nope">
            </div>
        </div>

        <div class="col-xs-12">
            <div class="form-group">
                <label class="control-label">@lang('app.function')</label>
                <select class="form-control select2" name="function" id="function" data-style="form-control">
                </select>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="form-group">
                <label class="control-label">@lang('app.type')</label>
                <select class="form-control select2" name="type" id="type" data-style="form-control">
                    <option value="all">@lang('modules.client.all')</option>
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
                <a href="{{route('admin.contact.create')}}" class="btn btn-cs-blue">@lang('app.addContact')</a>
            </div>
            <div class="panel-body">

                <div class="d-flex table-alphabets">
                    <a href="#!">A</a>
                    <a href="#!">B</a>
                    <a href="#!">C</a>
                    <a href="#!">D</a>
                    <a href="#!">E</a>
                    <a href="#!">F</a>
                    <a href="#!">G</a>
                    <a href="#!">H</a>
                    <a href="#!">I</a>
                    <a href="#!">J</a>
                    <a href="#!">K</a>
                    <a href="#!">L</a>
                    <a href="#!">M</a>
                    <a href="#!">N</a>
                    <a href="#!">O</a>
                    <a href="#!">P</a>
                    <a href="#!">Q</a>
                    <a href="#!">R</a>
                    <a href="#!">S</a>
                    <a href="#!">T</a>
                    <a href="#!">U</a>
                    <a href="#!">V</a>
                    <a href="#!">W</a>
                    <a href="#!">X</a>
                    <a href="#!">Y</a>
                    <a href="#!">Z</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="users-table">
                        <thead>
                        <tr>
                            <th>@lang('app.contactName')</th>
                            <th>@lang('app.function')</th>
                            <th>@lang('app.type')</th>
                            <th>@lang('app.email')</th>
                            <th>@lang('app.mobileNumber')</th>
                            <th>@lang('app.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td >
                                    <img data-toggle="tooltip" data-original-title="John Travolta" src="http://127.0.0.1:8000/img/default-profile-3.png" alt="user" class="img-circle" width="25" height="25"> 
                                    Serge dupont
                                </td>
                                <td>
                                    Directeur commercial
                                </td>
                                <td>
                                    Client
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    +33 6 87 65 88 77                                    
                                </td>
                                <td>
                                    <div class="btn-group dropdown m-r-10">
                                        <span aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle" type="button"><ion-icon name="ellipsis-vertical" role="img" class="md hydrated" aria-label="ellipsis vertical"></ion-icon></span>
                                        <ul role="menu" class="dropdown-menu pull-right">
                                            <li><a href="http://127.0.0.1:8000/admin/employees/teams/23/edit"><i class="icon-settings"></i> Faire en sorte</a></li>
                                            <li><a href="javascript:;" data-group-id="23" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> Supprimer </a></li>
                
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
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
<script>
    $("#users-table").dataTable()
</script>
@endpush