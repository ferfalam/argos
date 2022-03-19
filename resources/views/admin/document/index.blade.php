@extends('layouts.app')


@push('head-script')
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/daterange-picker/daterangepicker.css') }}" />

<style>
    .filter-section::-webkit-scrollbar {
        display: block !important;
    }

    .filter-badges{
        display: flex;
        align-items: center;
        justify-content: start;
        /* gap: 10px; */
        flex-wrap: wrap;
        margin-bottom: 0px;
    }

    .filter-badges .active{
        background: rgba(1, 28, 75) !important;
        border: 1px solid rgba(1, 28, 75)  !important;
        font-weight: 500;
        color: white;
        font-size: 15px;
        text-transform: uppercase;
        padding: 9px 14px;
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

@section('page-title')
<x-main-header>
    <x-slot name="title">
        @lang($pageTitle) 
    </x-slot>
</x-main-header>
@endsection


@section('filter-section')
<div class="row ">
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
        <select class="form-control select2" name="project" id="project" data-style="form-control">
            <option value="all">@lang('modules.client.all')</option>
            @foreach ($projects as $project)
                <option value="{{$project->project_name}}">{{$project->project_name}}</option>
            @endforeach
        </select>
    </x-filter-form-group>

    <x-filter-form-group label="app.publication">
        <select class="form-control select2" name="publish" id="publish"
        data-style="form-control">
            <option value="all">@lang('modules.client.all')</option>
            <option value="1">@lang('app.yes')</option>
            <option value="0">@lang('app.no')</option>
        </select>
    </x-filter-form-group>
    {{-- <div class="col-xs-12">
        <div class="form-group">
            <label class="control-label">@lang('app.menu.projects') @lang('app.status')</label>
            <select class="select2 form-control" data-placeholder="@lang('app.menu.projects') @lang('app.status')" id="status">
                <option 
                    value="not finished">@lang('modules.projects.hideFinishedProjects')
                </option>
                <option value="all">@lang('app.all')</option>
                <option
                        value="not started">@lang('app.notStarted')
                </option>
                <option
                        value="in progress">@lang('app.inProgress')
                </option>
                <option
                        value="on hold">@lang('app.onHold')
                </option>
                <option
                        value="canceled">@lang('app.canceled')
                </option>
                <option
                        value="finished">@lang('app.finished')
                </option>
                <option
                        value="under review">@lang('app.underReview')
                </option>
            </select>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <label class="control-label">@lang('app.place')</label>
            <select class="select2 form-control" data-placeholder="@lang('app.place')" id="client_id">
                <option selected value="all">@lang('app.all')</option>
                @foreach($places as $place)
                    <option value="{{ $place->id }}">{{ $place->place_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="form-group">
            <label class="control-label">@lang('modules.projects.technology')</label>
            <select class="select2 form-control" data-placeholder="@lang('modules.projects.technology')" id="category_id">
                <option selected value="all">@lang('app.all')</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="form-group">
            <label class="control-label">@lang('app.projectMember')</label>
            <select class="select2 form-control" data-placeholder="@lang('app.projectMember')" id="employee_id">
                <option selected value="all">@lang('app.all')</option>
                @foreach($allEmployees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="form-group">
            <label class="control-label">@lang('modules.invoices.project')</label>
            <select class="select2 form-control"  id="project_id">
                <option selected value="all">@lang('app.all')</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                @endforeach
            </select>
        </div>
    </div> --}}
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
        @foreach ($usedEspaces as $esc)
            <button class="btn @if ($usedEspaces[0]->id == $esc->id) active @else btn-primary @endif filter-btn" data-tag="{{$esc->id}}">{{$esc->espace_name}}</button>
        @endforeach
    </div>


    <div class="table-responsive">
        {!! $dataTable->table(['class' => 'table table-bordered table-hover toggle-circle default footable-loaded footable']) !!}
    </div>
    <!-- .row -->

 
        {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="historyModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>

<script src="{{ asset('plugins/bower_components/waypoints/lib/jquery.waypoints.js') }}"></script>
<script src="{{ asset('plugins/bower_components/counterup/jquery.counterup.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('js/datatables/buttons.server-side.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/daterange-picker/daterangepicker.js') }}"></script>

{!! $dataTable->scripts() !!}
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

                showData();
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

    $('body').on('click', '.edit-doc',function(){
        var id = $(this).data('doc-id');
        var url = "{{ route('admin.dataRoom.edit', ':id')}}";
        url = url.replace(':id', id);
        $('#modelHeading').html("@lang('modules.dataRoom.title')");
        $.ajaxModal('#dataRoomModal',url);
    });
    $('body').on('click', '.delete-doc',function(e){
        //console.log(e.target)
        swal({
            title: "@lang('messages.sweetAlertTitle')",
            text: "@lang('messages.confirmation.recoverDeleteDataRoom')",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "@lang('messages.deleteConfirmation')",
            cancelButtonText: "@lang('messages.confirmNoArchive')",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm){
            if (isConfirm) {

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
            }
        });
    });
    var table;
    $(".select2").select2({
        formatNoMatches: function () {
            return "{{ __('messages.noRecordFound') }}";
        }
    });

    var espace = "{{$usedEspaces[0]->id}}"
    $('#projects-table').on('preXhr.dt', function (e, settings, data) {
        var project = $('#project').val();
        var publish = $('#publish').val();
        var start_date = $('#start-date').val();
        var end_date = $('#end-date').val();

        data['project'] = project;
        data['espace_id'] = espace;
        data['publish'] = publish;
        data['start_date'] = start_date;
        data['end_date'] = end_date;

    });
    // window.LaravelDataTables["projects-table"].draw();
    function showData() {
        $('#projects-table').on('preXhr.dt', function (e, settings, data) {
            var project = $('#project').val();
            var publish = $('#publish').val();
            
            data['project'] = project;
            data['espace_id'] = espace;
            data['publish'] = publish;
        });
        window.LaravelDataTables["projects-table"].draw();
    }

    $('#project').on('change', function(event) {
        event.preventDefault();
        showData();
    });

    $('#publish').on('change', function(event) {
        event.preventDefault();
        showData();
    });

    $('.filter-btn').on('click', function(event) {
        $('.filter-btn.active').addClass('btn-primary')
        $('.filter-btn.active').removeClass("active")
        $(this).removeClass("btn-primary")
        $(this).addClass("active")
        event.preventDefault();
        espace = $(this).data('tag')
        showData();
    });


    $('body').on('click', '.history-doc',function(e){
        var id = $(this).data('doc-id');
        var url = "{{ route('admin.dataRoom.history', ':id')}}";
        url = url.replace(':id', id);
        $('#modelHeading').html("@lang('modules.tasks.history')");
        $.ajaxModal('#historyModal',url);
    });

    $('body').on('click', '.view-doc',function(e){
        var token = "{{ csrf_token() }}";
        var id = $(this).data('doc-id');
        var url = "{{ route('admin.dataRoom.save-history', ':id')}}";
        url = url.replace(':id', id);
        //console.log("VIEW")
        $.easyAjax({
            url: url,
            type: "POST",
            data: {
                '_token': token,
                'details' : 'seeDoc'
                },
            success: function(response) {
                if (response.status == 'success') {
                    window.location.reload()
                }
            }
        })
    });

    $('body').on('click', '.download-doc',function(e){
        var token = "{{ csrf_token() }}";
        var id = $(this).data('doc-id');
        var url = "{{ route('admin.dataRoom.save-history', ':id')}}";
        url = url.replace(':id', id);
        //console.log("DOWNLOAD")
        $.easyAjax({
            url: url,
            type: "POST",
            data: {
                '_token': token,
                'details' : 'downloadDoc'
                },
            success: function(response) {
                if (response.status == 'success') {
                    window.location.reload()
                }
            }
        })
    });


</script>
@endpush