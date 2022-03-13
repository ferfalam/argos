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
        justify-content: center;
        /* gap: 10px; */
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
        color: black;
        font-size: 20px;
        font-weight: 600;
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
                @foreach ($projects as $project)
                    <option value="{{$project->project_name}}">{{$project->project_name}}</option>
                @endforeach
            </select>
        </x-filter-form-group>

        <x-filter-form-group label="app.publication">
            <select class="form-control select2" name="category_id" id="category_id"
            data-style="form-control">
                <option value="all">@lang('modules.client.all')</option>
                <option value="1">@lang('app.yes')</option>
                <option value="0">@lang('app.no')</option>
            </select>
        </x-filter-form-group>

        <x-filter-btn-group class="p-t-10">
            <x-button id="apply-filters" classes="btn btn-cs-green col-md-6" title="app.apply"></x-button>
            <x-button id="reset-filters" classes="btn btn-inverse col-md-6 rounded-pill" title="app.reset"></x-button>
        </x-filter-btn-group>

    </form>
</div>
@endsection

@section('content')    
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="panel-card">
                <div class="panel-card-count">
                    {{$totalDatarooms}}
                </div>
                <span class="panel-card-text">{{__('app.totalDocuments')}}</span>
            </div>
            <div class="panel-card">
                <div class="panel-card-count panel-card-count-yellow">
                    {{$totalCanPublish}}
                </div>
                <span class="panel-card-text">{{__('app.authorizedPublications')}}</span>
            </div>
            <div class="panel-card">
                <div class="panel-card-count panel-card-count-orange">
                    {{$totalCanNotPublish}}
                </div>
                <span class="panel-card-text">{{__('app.unauthorizedPublications')}}</span>
            </div>
        </div>
    </div>

    <div class="filter-badges">
        @foreach ($espaces as $espace)
            <button class="btn btn-primary" data-tag="{{$espace->id}}">{{$espace->espace_name}}</button>
        @endforeach
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
                                {{__('app.publication')}} ||
                                {{__('app.date')}}
                            </th>
                            <th>
                                {{__('app.action')}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datarooms as $doc)
                            <tr>
                                <td>{{\Carbon\Carbon::parse($doc->created_at)->format($global->date_format)}}</td>
                                
                                <td>{{$doc->doc_name}}</td>
                                
                                <td>{{$doc->project_name}}</td>
            
                                <td>
                                   {{$doc->task_name}}
                                </td>
                                
                                <td>
                                    @if ($doc->canSee() == '')
                                        <span></span>
                                    @elseif ($doc->canSee() == 'all')
                                        <span>@lang('app.all')</span>
                                    @else
                                        @foreach ($doc->canSee() as $cs)
                                            <img src="{{$cs->image_url}}" style="width:30px; height:30px; border-radius: 50%;">
                                        @endforeach
                                    @endif
                                </td>
            
                                <td>@if ($doc->publish)
                                    @lang('app.yes')
                                    @else
                                    @lang('app.no')
                                    @endif
                                    ||
                                    {{$doc->publish_date ? \Carbon\Carbon::parse($doc->publish_date)->format($global->date_format) : ''}}</td>
                                
                                <td>
                                    <a target="_blank" href="{{ $doc->file()->file_url }}"
                                                data-toggle="tooltip" data-original-title="View"
                                                class="btn btn-info btn-circle"><i
                                                        class="fa fa-search"></i></a>
                                    <a href="{{ route('admin.task-files.download', $doc->file()->id) }}"
                                        data-toggle="tooltip" data-original-title="Download"
                                        class="btn btn-inverse btn-circle"><i
                                                class="fa fa-download"></i></a>
                                    <a href="javascript:;"
                                        data-toggle="tooltip" data-original-title="Edit" data-doc-id="{{$doc->id}}"
                                        class="btn btn-warning btn-circle edit-doc"><i
                                                class="fa fa-edit"></i></a>
                                    <a href="javascript:;"
                                        data-toggle="tooltip" data-original-title="Delete" data-doc-id="{{$doc->id}}"
                                        class="btn btn-danger btn-circle delete-doc"><i
                                                class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="dataRoomModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
        <!-- /.modal-dialog -->.
    </div>
    {{--Ajax Modal Ends--}}
    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="espaceModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
        <!-- /.modal-dialog -->.
    </div>
    {{--Ajax Modal Ends--}}
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

        $('body').on('click', '.edit-doc',function(){
            var id = $(this).data('doc-id');
            var url = "{{ route('admin.dataRoom.edit', ':id')}}";
            url = url.replace(':id', id);
            $('#modelHeading').html("@lang('modules.dataRoom.title')");
            $.ajaxModal('#dataRoomModal',url);
        });

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
        $('.delete-doc').on('click', (e) => {
            e.preventDefault();
            var token = "{{ csrf_token() }}";
            var id = $(this).data('doc-id');
            var url = "{{ route('admin.dataRoom.destroy', ':id')}}";
            url = url.replace(':id', id);
            $.easyAjax({
                url: url,
                type: "POST",
                data: {'_token': token, '_method':'DELETE'},
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload()
                    }
                }
            })
        });
    </script>
@endpush