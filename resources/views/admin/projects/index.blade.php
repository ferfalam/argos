@extends('layouts.app')


@push('head-script')
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
@endpush

@section('page-title')
<x-main-header>
    <x-slot name="title">
        @lang($pageTitle) 
    </x-slot>

    <x-slot name="btns">
        <x-link type="link" url="{{ route('admin.projects.create') }}"  classes="btn btn-cs-blue" icon="fa fa-plus" title="app.createProject"/>
        {{-- <x-link type="link" url="javascript:;"  classes="btn btn-cs-blue pinnedItem" icon="icon-pin icon-2" title="app.pinnedItem"/> --}}
        {{-- <x-link type="link" url="{{ route('admin.project-template.index') }}"  classes="btn btn-cs-blue " icon="fa fa-plus" title="app.menu.addProjectTemplate"/> --}}
        {{-- <x-link type="link" url="{{ route('admin.projects.archive') }}"  classes="btn btn-cs-blue" icon="fa fa-trash" title="app.menu.viewArchive"/> --}}
    </x-slot>
</x-main-header>
@endsection


@section('filter-section')
<div class="row ">
    <div class="col-xs-12">
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
    </div>
</div>
@endsection

@section('content')

<div class="panel-container">
    <div class="panel panel-default">
      <div class="panel-body">
        <img src="{{asset('img/card-1.png')}}" alt="">
        <div class="panel-body-info">
          <h2>{{ $totalProjects }}</h2>
          <p>@lang('modules.dashboard.totalProjects')</p>
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-body">
        <img src="{{asset('img/card-2.png')}}" alt="">
        <div class="panel-body-info">
          <h2>{{ $overdueProjects }}</h2>
          <p>@lang('modules.tickets.overDueProjects')</p>
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-body">
        <img src="{{asset('img/card-3.png')}}" alt="">
        <div class="panel-body-info">
          <h2>{{ $inProcessProjects }}</h2>
          <p>@lang('app.inProgress') @lang('app.menu.projects')</p>
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-body">
        <img src="{{asset('img/card-4.png')}}" alt="">
        <div class="panel-body-info">
          <h2>{{ $finishedProjects }}</h2>
          <p>@lang('app.finished') @lang('app.menu.projects')</p>
        </div>
      </div>
    </div>
  </div>


     <div class="table-responsive">
        {!! $dataTable->table(['class' => 'table table-bordered table-hover toggle-circle default footable-loaded footable']) !!}
    </div>
    <!-- .row -->

    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="projectCategoryModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

{!! $dataTable->scripts() !!}
<script>
    var table;
    $(".select2").select2({
        formatNoMatches: function () {
            return "{{ __('messages.noRecordFound') }}";
        }
    });
    $('#status').val('not finished');

    $(function() {

        $('body').on('click', '.archive', function(){
            var id = $(this).data('user-id');
            swal({
                title: "@lang('messages.sweetAlertTitle')",
                text: "@lang('messages.archiveMessage')",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "@lang('messages.confirmArchive')",
                cancelButtonText: "@lang('messages.confirmNoArchive')",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm){
                if (isConfirm) {

                    var url = "{{ route('admin.projects.archive-delete',':id') }}";
                    url = url.replace(':id', id);

                    var token = "{{ csrf_token() }}";

                    $.easyAjax({
                        type: 'GET',
                            url: url,
                            data: {'_token': token, '_method': 'DELETE'},
                        success: function (response) {
                            if (response.status == "success") {
                                $.unblockUI();
                                showData();
                            }
                        }
                    });
                }
            });
        });

        $('body').on('click', '.sa-params', function(){
            var id = $(this).data('user-id');
            swal({
                title: "@lang('messages.sweetAlertTitle')",
                text: "@lang('messages.confirmation.recoverProjectTemplate')",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "@lang('messages.deleteConfirmation')",
                cancelButtonText: "@lang('messages.confirmNoArchive')",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm){
                if (isConfirm) {

                    var url = "{{ route('admin.projects.destroy',':id') }}";
                    url = url.replace(':id', id);

                    var token = "{{ csrf_token() }}";

                    $.easyAjax({
                        type: 'POST',
                            url: url,
                            data: {'_token': token, '_method': 'DELETE'},
                        success: function (response) {
                            if (response.status == "success") {
                                $.unblockUI();
                                showData();
                            }
                        }
                    });
                }
            });
        });

        $('#createProject').click(function(){
            var url = '{{ route('admin.projectCategory.create')}}';
            $('#modelHeading').html('Manage Project Category');
            $.ajaxModal('#projectCategoryModal',url);
        })
        $('.pinnedItem').click(function(){
            var url = '{{ route('admin.projects.pinned-project')}}';
            $('#modelHeading').html('Pinned Project');
            $.ajaxModal('#projectCategoryModal',url);
        })

    });

    function initCounter() {
        $(".counter").counterUp({
            delay: 100,
            time: 1200
        });
    }
    
    $('#projects-table').on('preXhr.dt', function (e, settings, data) {
        var status = $('#status').val();
        var clientID = $('#client_id').val();
        var categoryID = $('#category_id').val();
        var teamID = $('#team_id').val();
        var employee_id = $('#employee_id').val();
        var project_id = $('#project_id').val();


        data['status'] = status;
        data['client_id'] = clientID;
        data['category_id'] = categoryID;
        data['team_id'] = teamID;
        data['employee_id'] = employee_id;
        data['project_id'] = project_id;

    });
    // window.LaravelDataTables["projects-table"].draw();

    function showData() {
        $('#projects-table').on('preXhr.dt', function (e, settings, data) {
            var status = $('#status').val();
            var clientID = $('#client_id').val();
            var categoryID = $('#category_id').val();
            var teamID = $('#team_id').val();
            var employee_id = $('#employee_id').val();
            var project_id = $('#project_id').val();

            data['status'] = status;
            data['client_id'] = clientID;
            data['category_id'] = categoryID;
            data['team_id'] = teamID;
            data['employee_id'] = employee_id;
            data['project_id'] = project_id;

        });
        window.LaravelDataTables["projects-table"].draw();
    }

    $('#status').on('change', function(event) {
        event.preventDefault();
        showData();
    });

    $('#client_id').on('change', function(event) {
        event.preventDefault();
        showData();
    });

    $('#category_id').on('change', function(event) {
        event.preventDefault();
        showData();
    });
    $('#employee_id').on('change', function(event) {
        event.preventDefault();
        showData();
    });
    $('#project_id').on('change', function(event) {
        event.preventDefault();
        showData();
    });

    initCounter();


</script>
@endpush