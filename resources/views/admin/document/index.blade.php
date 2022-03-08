@extends('layouts.app')

@section('page-title')
<x-main-header>
    <x-slot name="title">
        <span class="text-capitalize">@lang($pageTitle) </span>
    </x-slot>
</x-main-header>

<style type="text/css">
    .action-align{
      text-align: center !important;
    }
</style>

@endsection

@push('head-script')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/daterange-picker/daterangepicker.css') }}" />


<style>
    .filter-section::-webkit-scrollbar {
        display: block !important;
    }

    .filter-badges{
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .filter-badges .btn-primary{
        background: rgba(0, 162, 242, 1) !important;
        border: 1px solid rgba(0, 162, 242, 1) !important;
        font-weight: 500;
        color: white;
        font-size: 15px;
        text-transform: uppercase;
        padding: 9px 14px;
    }

    .panel-primary{        
        background: #FFFFFF;
        border: 1px solid #DDDDDD !important;
        box-sizing: border-box !important;
        box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.2) !important;
        border-radius: 4px !important;
    }

    .panel-primary .panel-body{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .panel-card{
        display: flex;
        gap: 30px;
        align-items: center;
    }

    .panel-card-count{
        width: 55px;
        height: 55px;
        border-radius: 1000px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #8A8888;
    }

    .panel-card-count-yellow{
        background: #E9E244;
    }

    .panel-card-count-orange{
        background: #FF8B59;
    }

    .panel-card-text{
        color: #F43658;
        font-family: "Roboto", sans-serif;
        font-style: normal;
        font-weight: bold;
        font-size: 14px;
        line-height: 21px;
    }
</style>
@endpush

@section('filter-section')
<div class="row"  id="ticket-filters">
    <form action="" id="filter-form">
        <x-filter-form-group label="app.selectDateRange">
            <div id="reportrange" class="form-control reportrange">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down pull-right"></i>
            </div>

            <input type="hidden" class="form-control" id="start-date" placeholder="@lang('app.startDate')"
                   value=""/>
            <input type="hidden" class="form-control" id="end-date" placeholder="@lang('app.endDate')"
                   value=""/>
        </x-filter-form-group>

        <x-filter-form-group label="app.project">
            <select class="form-control select2" name="client" id="client" data-style="form-control">
                <option value="all">@lang('modules.client.all')</option>
            </select>
        </x-filter-form-group>

        <x-filter-form-group label="app.publication">
            <select class="form-control select2" name="category_id" id="category_id"
            data-style="form-control">
                <option value="all">@lang('modules.client.all')</option>
            </select>
        </x-filter-form-group>

        <x-filter-btn-group class="p-t-10">
            <x-button id="apply-filters" classes="btn btn-cs-green col-md-6" title="app.apply"></x-button>
            <x-button id="reset-filters" classes="btn btn-inverse col-md-offset-1 col-md-5 rounded-pill" title="app.reset"></x-button>
        </x-filter-btn-group>

    </form>
</div>
@endsection

@section('content')    
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="panel-card">
                <div class="panel-card-count">
                    0
                </div>
                <span class="panel-card-text">{{__('app.totalDocuments')}}</span>
            </div>
            <div class="panel-card">
                <div class="panel-card-count panel-card-count-yellow">
                    0
                </div>
                <span class="panel-card-text">{{__('app.authorizedPublications')}}</span>
            </div>
            <div class="panel-card">
                <div class="panel-card-count panel-card-count-orange">
                    0
                </div>
                <span class="panel-card-text">{{__('app.unauthorizedPublications')}}</span>
            </div>
        </div>
    </div>

    <div class="filter-badges">
        <button class="btn btn-primary" data-tag="Localisation">Localisation</button>
        <button class="btn btn-primary" data-tag="Localisation">Environnement</button>
        <button class="btn btn-primary" data-tag="Localisation">Planning</button>
        <button class="btn btn-primary" data-tag="Localisation">Données techniques</button>
        <button class="btn btn-primary" data-tag="Informations juridiques">Informations juridiques</button>
        <button class="btn btn-primary" data-tag="données PPA">données PPA</button>
        <button class="btn btn-primary" data-tag="données économiques">données économiques</button>
        <button class="btn btn-primary" data-tag="Avantages du projet">Avantages du projet</button>
        <button class="btn btn-primary" data-tag="extension">extension</button>
    </div>

    <div class="">
        <div class="">
            <div class="table-responsive">
                <table class="table  dataTable table-bordered table-hover toggle-circle default footable-loaded footable">
                    <thead>
                        <tr>
                            <th>
                                {{__('app.created_at')}}
                            </th>
                            <th>
                                {{__('app.documentName')}}
                            </th>
                            <th>
                                {{__('app.projectName')}}
                            </th>
                            <th>
                                {{__('app.taskName')}}
                            </th>
                            <th>
                                {{__('app.visibility')}}
                            </th>
                            <th>
                                {{__('app.publication')}}
                            </th>
                            <th>
                                {{__('app.action')}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>08-02-2021</td>
                            
                            <td>Carte avec positionnement GPS</td>
                            
                            <td>Kerkennah island</td>
        
                            <td>
                                01 Localisation
                            </td>
        
                            <td>
                                <span>Tous (ou)</span>
                                <img src="http://127.0.0.1:8000/img/default-profile-3.png" style="width:30px; height:30px; border-radius: 50%;">
                                <img src="http://127.0.0.1:8000/img/default-profile-3.png" style="width:30px; height:30px; border-radius: 50%;">
                            </td>
        
                            <td>08-12-2021</td>
                            
                            <td>
                                <div class="btn-group dropdown m-r-10">
                                    <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-gears" style="color: #000;"></i></button>
                                    <ul role="menu" class="dropdown-menu pull-right">
                                        <li><a href=""><i class="fa fa-search" aria-hidden="true"></i> {{ trans('app.search')}}</a></li>
                                        <li><a href=""><i class="fa fa-pencil" aria-hidden="true"></i> {{ trans('app.edit')}}</a></li>
                                        <li><a href=""><i class="fa fa-search" aria-hidden="true"></i> {{__('app.view')}}</a></li>
                                        <li><a href=""  data-user-id=""  class="sa-params"><i class="fa fa-times" aria-hidden="true"></i>{{trans('app.delete')}}</a></li>
                                    </ul> 
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
    <script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('js/datatables/buttons.server-side.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/moment/moment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/daterange-picker/daterangepicker.js') }}"></script>

    <script>
        $('.dataTable').dataTable();
    </script>

    <script>
        $(function() {
            var dateformat = '{{ $global->moment_format }}';

            var start = '';
            var end = '';

            function cb(start, end) {
                if(start){
                    $('#start-date').val(start.format(dateformat));
                    $('#end-date').val(end.format(dateformat));
                    $('#reportrange span').html(start.format(dateformat) + ' - ' + end.format(dateformat));
                }

            }
            moment.locale('{{ $global->locale }}');
            $('#reportrange').daterangepicker({
                // startDate: start,
                // endDate: end,
                locale: {
                    language: '{{ $global->locale }}',
                    format: '{{ $global->moment_format }}',
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });

        $(".select2").select2({
            formatNoMatches: function () {
                return "{{ __('messages.noRecordFound') }}";
            }
        });

        $('.toggle-filter').click(function () {
            $('#ticket-filters').toggle('slide');
        })

        // $('#apply-filters').click(function () {

        //     $('#clients-table').on('preXhr.dt', function (e, settings, data) {

        //         var startDate = $('#start-date').val();

        //         if (startDate == '') {
        //             startDate = null;
        //         }

        //         var endDate = $('#end-date').val();

        //         if (endDate == '') {
        //             endDate = null;
        //         }

        //         var category_id = $('#category_id').val();
        //         var sub_category_id = $('#sub_category_id').val();
        //         var project_id = $('#project_id').val();
        //         var contract_type_id = $('#contract_type_id').val();
        //         var country_id = $('#country_id').val();

        //         var client = $('#client').val();
        //         data['startDate'] = startDate;
        //         data['endDate'] = endDate;
        //         data['client'] = client;
        //         data['category_id'] = category_id;
        //         data['sub_category_id'] = sub_category_id;
        //         data['project_id'] = project_id;
        //         data['contract_type_id'] = contract_type_id;
        //         data['country_id'] = country_id;
        //     });

        //     $.easyBlockUI('#clients-table');

        //     window.LaravelDataTables["clients-table"].draw();
            
        //     $.easyUnblockUI('#clients-table');

        // });

        // $('#reset-filters').click(function () {
        //     $('#filter-form')[0].reset();
        //     $('.select2').val('all');
        //     $('#filter-form').find('select').select2();

        //     $.easyBlockUI('#clients-table');
        //     $('#start-date').val('');
        //     $('#end-date').val('');
        //     $('#reportrange span').html('');

        //     window.LaravelDataTables["clients-table"].draw();
        //     $.easyUnblockUI('#clients-table');
        // })

        // function exportData(){
        //     var client = $('#client').val();
        //     var status = $('#status').val();

        //     var url = '{{ route('admin.clients.export', [':status', ':client']) }}';
        //     url = url.replace(':client', client);
        //     url = url.replace(':status', status);

        //     window.location.href = url;
        // }
            
    </script>
@endpush