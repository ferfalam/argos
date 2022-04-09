@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12 bg-title-left">
            <h4 class="page-title"> {{ __($pageTitle) }} #{{ $project->id }} - <span class="font-bold">{{ ucwords($project->project_name) }}</span> </h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-6 col-sm-8 col-md-8 col-xs-12 bg-title-right">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li><a href="{{ route('admin.projects.index') }}">{{ __($pageTitle) }}</a></li>
                <li class="active">@lang('modules.projects.milestones')</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<style>
    .milestone{
        margin-top: 7px;
    }

    .form-body{
        display: grid;
    }
</style>
@endpush

@section('content')

    <div class="row">
        <div class="col-xs-12 " style="display: grid;">
            @include('admin.projects.show_project_menu')

            <div class="row m-b-10">
                <div class="col-xs-12">
                    <a href="javascript:;" id="show-add-form" class="btn btn-cs-green btn-outline milestone">@lang('modules.projects.createMilestone')</a>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    {!! Form::open(['id'=>'logTime','class'=>'ajax-form hide panel panel-default','method'=>'POST']) !!}

                    {!! Form::hidden('project_id', $project->id) !!}
                    <input type="hidden" name="currency_id" id="currency_id" value="{{ $project->currency_id ?? $global->currency_id }}">

                    <div class="panel-body">
                        <div class="form-body">
                            <div class="row">
    
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="required">@lang('modules.projects.milestoneTitle')</label>
                                            <a href="javascript:;"
                                                id="createMilestoneTitle"
                                                class="btn btn-xs btn-outline btn-success">
                                                    <i class="fa fa-plus"></i> 
                                                </a>
                                            <select name="milestone_title" id="milestone_title" class="select2 form-control">
                                                @foreach ($milestoneTitle as $item)
                                                <option value="{{$item->name}}">{{$item->name}}</option>
                                                    
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label>@lang('app.status')</label>
                                            <select name="status" id="status" class="select2 form-control">
                                                <option value="incomplete">@lang('app.incomplete')</option>
                                                <option value="complete">@lang('app.complete')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    
                                    <div class="form-group">
                                        <label class="required" for="">@lang('app.milestone_type')</label>
                                    </div>
                                    <div class="form-group" style="margin: 0">
                                        <input class="form-check-input" required style="min-height:0px !important" type="radio" id="none" name="milestone_type" value="None">
                                        <label class="form-check-label" style="margin: 0"  for="none">None</label>
                                    </div>
                                    <div class="form-group" style="margin: 0">
                                        <input class="form-check-input" required style="min-height:0px !important" type="radio" id="research" name="milestone_type" value="Research">
                                        <label class="form-check-label" style="margin: 0" for="research">Research</label>
                                    </div>
                                    <div class="form-group" style="margin: 0">
                                        <input class="form-check-input" required style="min-height:0px !important" type="radio" id="development" name="milestone_type" value="Development">
                                        <label class="form-check-label" style="margin: 0" for="development">Development</label>
                                    </div>
                                    <div class="form-group" style="margin: 0">
                                        <input class="form-check-input" required style="min-height:0px !important" type="radio" id="construction" name="milestone_type" value="Construction">
                                        <label class="form-check-label" style="margin: 0" for="construction">Construction</label>
                                    </div>
                                    <div class="form-group" style="margin: 0">
                                        <input class="form-check-input" required style="min-height:0px !important" type="radio" id="exploitation" name="milestone_type" value="Exploitation">
                                        <label class="form-check-label" style="margin: 0" for="exploitation">Exploitation</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('modules.projects.milestoneCost')</label>
                                        <input id="cost" name="cost" type="number"
                                                class="form-control" value="0" min="0" step=".01">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('modules.projects.addCostProjectBudget')</label>
                                        <select name="add_to_budget" id="add_to_budget" class="form-control">
                                            <option value="no">@lang('app.no')</option>
                                            <option value="yes">@lang('app.yes')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('app.deadline')
                                                <span class="tooltip-content5">
                                                    <span class="tooltip-text3">
                                                        <span class="tooltip-inner2">@lang('app.dueDate')</span>
                                                    </span>
                                                </span>
                                        </label>
                                        <input type="text" name="due_date" id="due_date" autocomplete="off" class="form-control">
                                    </div>
                                </div>
                            </div>
    
                            <div class="row m-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="memo" class="required">@lang('modules.projects.milestoneSummary')</label>
                                        <textarea name="summary" id="" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" id="save-form" class="btn btn-success"><i
                                        class="fa fa-check"></i> @lang('app.save')</button>
                            <button type="button" id="close-form" class="btn btn-default"><i
                                        class="fa fa-times"></i> @lang('app.close')</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

            <div class="table-responsive m-t-20">
                <table class="table table-bordered table-hover toggle-circle default footable-loaded footable"
                        id="timelog-table">
                    <thead>
                    <tr>
                        <th>@lang('app.id')</th>
                        <th>@lang('modules.projects.milestoneTitle')</th>
                        <th>@lang('modules.projects.milestoneCost')</th>
                        <th>@lang('app.deadline')</th>
                        <th>@lang('app.status')</th>
                        <th>@lang('app.action')</th>
                    </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>
    <!-- .row -->

    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="editTimeLogModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-data-application">
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


    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="MilestoneTitleModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-data-application">
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

@push('footer-script')

<script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>


<script>
    var table = $('#timelog-table').dataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.milestones.data', $project->id) !!}',
        deferRender: true,
        language: {
            "url": "<?php echo __("app.datatable") ?>"
        },
        "fnDrawCallback": function (oSettings) {
            $("body").tooltip({
                selector: '[data-toggle="tooltip"]'
            });
        },
        // "order": [[0, "desc"]],
        columns: [
            {data: 'id', name: 'id',"searchable":false },
            {data: 'milestone_title', name: 'milestone_title'},
            {data: 'cost', name: 'cost'},
            {data: 'due_date', name: 'due_date'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', searchable: false}
        ]
    });

    jQuery('#due_date').datepicker({
        autoclose: true,
        todayHighlight: true,
        weekStart:'{{ $global->week_start }}',
        format: '{{ $global->date_picker_format }}',
    });
    $('#save-form').click(function () {
        $.easyAjax({
            url: '{{route('admin.milestones.store')}}',
            container: '#logTime',
            type: "POST",
            data: $('#logTime').serialize(),
            success: function (data) {
                if (data.status == 'success') {
                    $('#logTime').trigger("reset");
                    $('#logTime').toggleClass('hide', 'show');
                    table._fnDraw();
                }
            }
        })
    });

    $('#show-add-form, #close-form').click(function () {
        $('#logTime').toggleClass('hide', 'show');
    });


    $('body').on('click', '.sa-params', function () {
        var id = $(this).data('milestone-id');
        swal({
            title: "@lang('messages.sweetAlertTitle')",
            text: "@lang('messages.confirmation.recoverDeleteMilestone')",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "@lang('messages.deleteConfirmation')",
            cancelButtonText: "@lang('messages.confirmNoArchive')",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {

                var url = "{{ route('admin.milestones.destroy',':id') }}";
                url = url.replace(':id', id);

                var token = "{{ csrf_token() }}";

                $.easyAjax({
                    type: 'POST',
                            url: url,
                            data: {'_token': token, '_method': 'DELETE'},
                    success: function (response) {
                        if (response.status == "success") {
                            $.unblockUI();
//                                    swal("Deleted!", response.message, "success");
                            table._fnDraw();
                        }
                    }
                });
            }
        });
    });

    $('body').on('click', '.edit-milestone', function () {
        var id = $(this).data('milestone-id');

        var url = '{{ route('admin.milestones.edit', ':id')}}';
        url = url.replace(':id', id);

        $('#modelHeading').html('{{ __('app.edit') }} {{ __('modules.projects.milestones') }}');
        $.ajaxModal('#editTimeLogModal', url);

    });

    $('body').on('click', '.milestone-detail', function () {
        var id = $(this).data('milestone-id');
        var url = '{{ route('admin.milestones.detail', ":id")}}';
        url = url.replace(':id', id);
        $('#modelHeading').html('@lang('app.update') @lang('modules.projects.milestones')');
        $.ajaxModal('#editTimeLogModal',url);
    })
    $('ul.showProjectTabs .projectMilestones').addClass('tab-current');

    $('#createMilestoneTitle').click(function(){
        var url = '{{ route('admin.milestone-title.create')}}';
        $('#modelHeading').html("@lang('modules.contracts.manageContractType')");
        $.ajaxModal('#MilestoneTitleModal', url);
    })
</script>
@endpush
