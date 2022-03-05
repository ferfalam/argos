@extends('layouts.member-app')
@push('head-script')
<style>
    .d-none {
        display: none;
    }

    #filter-form{
        align-items: center;
    }
</style>
@endpush
@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-7 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">  {{ $pageTitle }}</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="main-header-btns">
            @if (user()->zoomSetting()->get()[0]->api_key)
            <a href="#" data-toggle="modal" data-target="#my-meeting" class="btn btn-cs-green">
                <i class="ti-plus"></i> @lang('zoom::modules.zoommeeting.addMeeting')
            </a>
            @endif
            {{-- <a href="{{ route('admin.zoom-meeting.table-view') }}" class="btn btn-cs-green">
                <i class="ti-list"></i> @lang('zoom::modules.zoommeeting.tableView')
            </a> --}}
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection
@push('head-script')
<link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatables/responsive.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatables/buttons.dataTables.min.css') }}">

<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/multiselect/css/multi-select.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-colorselector/bootstrap-colorselector.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/timepicker/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/summernote/dist/summernote.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/dropzone-master/dist/dropzone.css') }}">

@endpush

@section('filter-section')
<div class="row" id="ticket-filters">
    <form action="" id="filter-form">
        <div class="col-md-12">
            <div class="form-group">
                <h5>@lang('app.selectDateRange')</h5>
                <div class="input-daterange input-group" id="date-range">
                    <input type="text" class="form-control" autocomplete="off" id="filter-start-date"
                           placeholder="@lang('app.startDate')"
                           value=""/>
                    <span class="input-group-addon bg-info b-0 text-white">@lang('app.to')</span>
                    <input type="text" class="form-control" autocomplete="off" id="filter-end-date"
                           placeholder="@lang('app.endDate')"
                           value=""/>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <h5>@lang('app.status')</h5>
                <select class="form-control select2" name="status" id="filter-status" data-style="form-control">
                    <option value="all">@lang('app.all')</option>
                    <option 
                        value="not finished">@lang('zoom::modules.zoommeeting.hideFinishedMeetings')
                    </option>
                    <option value="waiting">@lang('zoom::modules.zoommeeting.waiting')</option>
                    <option value="live">@lang('zoom::modules.zoommeeting.live')</option>
                    <option value="canceled">@lang('app.canceled')</option>
                    <option value="finished">@lang('app.finished')</option>
                </select>
            </div>
        </div>  
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">@lang('app.select') @lang('modules.tasks.category')</label>
                <select class="form-control select2" name="category" id="category" data-style="form-control">
                    <option value="all">@lang('modules.client.all')</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{ ucfirst($category->category_name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>  
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">@lang('app.select') @lang('app.project')</label>
                <select class="form-control select2" name="project" id="project" data-style="form-control">
                    <option value="all">@lang('modules.client.all')</option>
                    @foreach($projects as $project)
                        <option value="{{$project->id}}">{{ ucfirst($project->project_name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>   
        <div class="col-md-12">
            <div class="form-group p-t-10">
                <button type="button" id="apply-filters" class="btn btn-success btn-sm col-md-6"><i class="fa fa-check"></i> @lang('app.apply')</button>
                <button type="button" id="reset-filters" class="btn btn-inverse col-md-6 btn-sm">
                    <i class="fa fa-refresh"></i> @lang('app.reset')</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="table-container">
            <div class="table-responsive">
                {!! $dataTable->table(['class' => 'table table-bordered table-hover toggle-circle default footable-loaded footable']) !!}
            </div>
        </div>
    </div>
</div>

{{-- @if ($user->cans('add_zoom_meetings')) --}}
    <!-- BEGIN MODAL -->
    <div class="modal fade bs-modal-md in" id="my-meeting" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-plus"></i> @lang('zoom::modules.zoommeeting.addMeeting')
                    </h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id' => 'createMeeting', 'class' => 'ajax-form', 'method' => 'POST']) !!}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">@lang('zoom::modules.zoommeeting.meetingName')</label>
                                    <input type="text" name="meeting_title" id="meeting_title" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group" style="margin: -5px;">
                                    <label class="control-label">@lang('modules.tasks.category')
                                        <a href="javascript:;" id="addCategory"
                                            class="btn btn-xs btn-success btn-outline"><i class="fa fa-plus"></i></a>
                                    </label>
                                    <select class="select2 form-control" id="category_id" name="category_id">
                                        <option value="">@lang('zoom::modules.message.pleaseSelectCategory')</option>
                                        @forelse($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ ucwords($category->category_name) }}</option>
                                        @empty
                                            <option value="">@lang('zoom::modules.message.noCategoryAdded')</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label>@lang('modules.sticky.colors')</label>
                                    <select id="colorselector" name="label_color">
                                        <option value="bg-info" data-color="#5475ed" selected>Blue</option>
                                        <option value="bg-warning" data-color="#f1c411">Yellow</option>
                                        <option value="bg-purple" data-color="#ab8ce4">Purple</option>
                                        <option value="bg-danger" data-color="#ed4040">Red</option>
                                        <option value="bg-success" data-color="#00c292">Green</option>
                                        <option value="bg-inverse" data-color="#4c5667">Grey</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-xs-12 ">
                                <div class="form-group">
                                    <label>@lang('zoom::modules.zoommeeting.description')</label>
                                    <textarea name="description" id="description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-3 ">
                                <div class="form-group">
                                    <label class="required">@lang('zoom::modules.zoommeeting.startOn')</label>
                                    <input type="text" name="start_date" id="start_date" class="form-control"
                                        autocomplete="none">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <div class="input-group bootstrap-timepicker timepicker">
                                    <label>&nbsp;</label>
                                    <input type="text" name="start_time" id="start_time" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-3">
                                <div class="form-group">
                                    <label class="required">@lang('zoom::modules.zoommeeting.endOn')</label>
                                    <input type="text" name="end_date" id="end_date" class="form-control"
                                        autocomplete="none">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <div class="input-group bootstrap-timepicker timepicker">
                                    <label>&nbsp;</label>
                                    <input type="text" name="end_time" id="end_time" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">@lang('app.project')</label>
                                    <select class="select2 form-control" data-placeholder="@lang(" app.selectProject")"
                                        id="project_id" name="project_id">
                                        <option value=" ">@lang('app.selectProject')</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ ucwords($project->project_name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" id="member-attendees">
                                <div class="form-group">
                                    <label class="col-xs-3 m-t-10">@lang('zoom::modules.meetings.addEmployees')</label>
                                    <div class="col-xs-7">
                                        <div class="checkbox checkbox-info">
                                            <input id="all-employees" name="all_employees" value="true" type="checkbox">
                                            <label for="all-employees">@lang('zoom::modules.meetings.allEmployees')</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="select2 m-b-10 select2-multiple " multiple="multiple"
                                        data-placeholder="@lang('zoom::modules.message.chooseMember')" name="employee_id[]">
                                        @foreach ($employees as $emp)
                                            <option value="{{ $emp->id }}">{{ ucwords($emp->name) }} @if ($emp->id == $user->id)
                                                    (YOU)
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" id="client-attendees">
                                <div class="form-group">
                                    <label class="col-xs-3 m-t-10">@lang('zoom::modules.meetings.addClients')</label>
                                    <div class="col-xs-7">
                                        <div class="checkbox checkbox-info">
                                            <input id="all-clients" name="all_clients" value="true" type="checkbox">
                                            <label for="all-clients">@lang('zoom::modules.meetings.allClients')</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="select2 m-b-10 select2-multiple " multiple="multiple"
                                        data-placeholder="@lang('zoom::modules.message.selectClient')" name="client_id[]">
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ ucwords($client->name) }}
                                                @if ($client->id == $user->id)
                                                    (YOU)
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="m-b-10">
                                        <label
                                            class="control-label">@lang('zoom::modules.zoommeeting.hostVideoStatus')</label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <input type="radio" name="host_video" id="host_video1" value="1">
                                        <label for="host_video1" class=""> @lang('app.enable') </label>
                                    </div>
                                    <div class="radio radio-inline ">
                                        <input type="radio" name="host_video" id="host_video2" value="0" checked>
                                        <label for="host_video2" class=""> @lang('app.disable') </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="m-b-10">
                                        <label
                                            class="control-label">@lang('zoom::modules.zoommeeting.participantVideoStatus')</label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <input type="radio" name="participant_video" id="participant_video1" value="1">
                                        <label for="participant_video1" class=""> @lang('app.enable')
                                        </label>
                                    </div>
                                    <div class="radio radio-inline ">
                                        <input type="radio" name="participant_video" id="participant_video2" value="0"
                                            checked>
                                        <label for="participant_video2" class=""> @lang('app.disable')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">@lang('zoom::modules.zoommeeting.meetingHost')</label>
                                    <select class="select2 form-control" id="created_by" name="created_by">
                                        @foreach ($employees as $emp)
                                            <option @if ($emp->id == $user->id) selected @endif
                                                value="{{ $emp->id }}">{{ ucwords($emp->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <div class="checkbox checkbox-info">
                                        <input id="repeat-meeting" name="repeat" value="1" type="checkbox">
                                        <label for="repeat-meeting">@lang('zoom::modules.zoommeeting.repeat')</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="repeat-fields" style="display: none">
                            <div class="col-xs-6 col-md-3 ">
                                <div class="form-group">
                                    <label>@lang('zoom::modules.zoommeeting.repeatEvery')</label>
                                    <input type="number" min="1" value="1" name="repeat_every" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <select name="repeat_type" id="" class="form-control">
                                        <option value="day">@lang('app.day')</option>
                                        <option value="week">@lang('app.week')</option>
                                        <option value="month">@lang('app.month')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-6 col-md-3">
                                <div class="form-group">
                                    <label>@lang('zoom::modules.zoommeeting.cycles') <a class="mytooltip"
                                            href="javascript:void(0)"> <i class="fa fa-info-circle"></i><span
                                                class="tooltip-content5"><span class="tooltip-text3"><span
                                                        class="tooltip-inner2">@lang('zoom::modules.zoommeeting.cyclesToolTip')</span></span></span></a></label>
                                    <input type="text" name="repeat_cycles" id="repeat_cycles" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <div class="checkbox checkbox-info">
                                        <input id="send_reminder" name="send_reminder" value="1" type="checkbox">
                                        <label for="send_reminder">@lang('zoom::modules.zoommeeting.reminder')</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="reminder-fields" style="display: none;">
                            <div class="col-xs-6 col-md-3">
                                <div class="form-group">
                                    <label>@lang('zoom::modules.zoommeeting.remindBefore')</label>
                                    <input type="number" min="1" value="1" name="remind_time" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <select name="remind_type" id="" class="form-control">
                                        <option value="day">@lang('app.day')</option>
                                        <option value="hour">@lang('app.hour')</option>
                                        <option value="minute">@lang('app.minute')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row m-b-20">
                            <div class="col-xs-12">
                                @if ($upload)
                                    <button type="button"
                                        class="btn btn-block btn-outline-info btn-sm col-md-2 select-image-button"
                                        style="margin-bottom: 10px;display: none "><i class="fa fa-upload"></i>
                                        File Select Or Upload
                                    </button>
                                    <div id="file-upload-box">
                                        <div class="row" id="file-dropzone">
                                            <div class="col-xs-12">
                                                <div class="dropzone" id="file-upload-dropzone">
                                                    {{ csrf_field() }}
                                                    <div class="fallback">
                                                        <input name="file" type="file" multiple />
                                                    </div>
                                                    <input name="image_url" id="image_url" type="hidden" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="taskID" id="taskID" value="">
                                @else
                                    <div class="alert alert-danger">@lang('messages.storageLimitExceed', ['here' => '<a
                                            href='.route(' admin.billing.packages'). '>Here</a>' ])</div>
                                @endif
                            </div>
                        </div>

                    </div>
                    {!! Form::close() !!}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white waves-effect"
                        data-dismiss="modal">@lang('app.close')</button>
                    <button type="button"
                        class="btn btn-success save-meeting waves-effect waves-light">@lang('app.submit')</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End --}}
{{-- @endif --}}

 {{--Ajax Modal--}}
 <div class="modal fade bs-modal-md in" id="meetingDetailModal" role="dialog" aria-labelledby="myModalLabel"
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
<script src="{{ asset('js/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/datatables/responsive.bootstrap.min.js') }}"></script>

<script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/multiselect/js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/datatables/buttons.server-side.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-colorselector/bootstrap-colorselector.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/summernote/dist/summernote.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/dropzone-master/dist/dropzone.js') }}"></script>


{!! $dataTable->scripts() !!}

<script>
            @if ($upload)
            Dropzone.autoDiscover = false;
            //Dropzone class
            myDropzone = new Dropzone("div#file-upload-dropzone", {
                url: "{{ route('admin.zoom-meeting.storeFile') }}",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                paramName: "file",
                maxFilesize: 10,
                maxFiles: 10,
                acceptedFiles:
                "image/*,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/docx,application/pdf,text/plain,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                autoProcessQueue: false,
                uploadMultiple: true,
                addRemoveLinks: true,
                parallelUploads: 10,
                dictDefaultMessage: "@lang('modules.projects.dropFile')",
                init: function () {
                    myDropzone = this;
                    this.on("success", function (file, response) {
                        if(response.status == 'fail') {
                            $.showToastr(response.message, 'error');
                            return;
                        }
                    })
                }
            });
        
            myDropzone.on('sending', function (file, xhr, formData) {
                console.log(myDropzone.getAddedFiles().length, 'sending');
                var ids = $('#taskID').val();
                var task_request_id = $('#task_request_id').val();
                formData.append('meeting_id', ids);
                //formData.append('task_request_id', task_request_id);
            });
        
            myDropzone.on('completemultiple', function () {
                var msgs = "@lang('messages.meetingCreatedSuccessfully')";
                $.showToastr(msgs, 'success');
                $('#my-meeting').modal('hide');
                loadTable();
            });
        @endif

    jQuery('#date-range').datepicker({
        toggleActive: true,
        format: '{{ $global->date_picker_format }}',
        language: '{{ $global->locale }}',
        autoclose: true
    });
    
    $('#start_date, #end_date').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: '{{ $global->date_picker_format }}',
    })

    $('#start_time, #end_time').timepicker({
        @if($global->time_format == 'H:i')
        showMeridian: false,
        @endif
    });

    $('#colorselector').colorselector();

    $(".select2").select2({
        formatNoMatches: function () {
            return "{{ __('messages.noRecordFound') }}";
        }
    });

    $('#repeat-meeting').change(function () {
        if($(this).is(':checked')){
            $('#repeat-fields').show();
        }
        else{
            $('#repeat-fields').hide();
        }
    })

    $('#send_reminder').change(function () {
        if($(this).is(':checked')){
            $('#reminder-fields').show();
        }
        else{
            $('#reminder-fields').hide();
        }
    })

    $('#meeting-table').on('preXhr.dt', function (e, settings, data) {
        var status   = $('#filter-status').val();
        var startDate = $('#filter-start-date').val();
        var category = $('#category').val();
        var project = $('#project').val();

        if (startDate == '') {
            startDate = 0;
        }

        var endDate = $('#filter-end-date').val();

        if (endDate == '') {
            endDate = 0;
        }

        data['startDate'] = startDate;
        data['endDate'] = endDate;
        data['status'] = status;
        data['category'] = category;
        data['project'] = project;
    });

    $('#apply-filters').click(function () {
       window.LaravelDataTables["meeting-table"].draw();
    });

    $('#reset-filters').click(function () {
        $('#filter-form')[0].reset();
        $('.select2').val('not finished');
        $('#filter-form').find('select').select2();
        loadTable();
    })

    $(function() {
        $('body').on('click', '.sa-params', function () {
            var id = $(this).data('meeting-id');
            var occurrence = $(this).data('occurrence');

            var buttons = {
                cancel: "@lang('app.no')",
                confirm: {
                    text: "@lang('app.yes')",
                    value: 'confirm',
                    visible: true,
                    className: "danger",
                }
            };

            if(occurrence == '1')
            {
                buttons.recurring = {
                    text: "{{ trans('zoom::modules.zoommeeting.deleteAllOccurrences') }}",
                    value: 'recurring'
                }
            }

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover the deleted meeting!",
                dangerMode: true,
                icon: 'warning',
                buttons: buttons,
            }).then(function (isConfirm) {
                if (isConfirm == 'confirm' || isConfirm == 'recurring') {

                    var url = "{{ route('member.zoom-meeting.destroy',':id') }}";
                    url = url.replace(':id', id);

                    var token = "{{ csrf_token() }}";
                    var dataObject = {'_token': token, '_method': 'DELETE'};

                    if(isConfirm == 'recurring')
                    {
                        dataObject.recurring = 'yes';
                    }

                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        data: dataObject,
                        success: function (response) {
                            if (response.status == "success") {
                                loadTable();
                            }
                        }
                    });
                }


            });
        });

        $('body').on('click', '.end-meeting', function(){
            var id = $(this).data('meeting-id');
            var buttons = {
                cancel: "@lang('app.no')",
                confirm: {
                    text: "@lang('app.yes')",
                    value: 'confirm',
                    visible: true,
                    className: "danger",
                }
            };

            swal({
                title: "Are you sure?",
                dangerMode: true,
                icon: 'warning',
                buttons: buttons,
            }).then(function (isConfirm) {
                if (isConfirm == 'confirm') {

                    var url = "{{ route('member.zoom-meeting.endMeeting') }}";

                    var token = "{{ csrf_token() }}";
                    var dataObject = {'_token': token, 'id': id};

                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        data: dataObject,
                        success: function (response) {
                            if (response.status == "success") {
                                loadTable();
                            }
                        }
                    });
                }


            });
      
        });

        $('body').on('click', '.cancel-meeting', function(){
            var id = $(this).data('meeting-id');

            var buttons = {
                cancel: "@lang('app.no')",
                confirm: {
                    text: "@lang('app.yes')",
                    value: 'confirm',
                    visible: true,
                    className: "danger",
                }
            };

            swal({
                title: "Are you sure?",
                dangerMode: true,
                icon: 'warning',
                buttons: buttons,
            }).then(function (isConfirm) {
                if (isConfirm == 'confirm') {

                    var url = "{{ route('member.zoom-meeting.cancelMeeting') }}";

                    var token = "{{ csrf_token() }}";
                    var dataObject = {'_token': token, 'id': id};

                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        data: dataObject,
                        success: function (response) {
                            if (response.status == "success") {
                                loadTable();
                            }
                        }
                    });
                }


            });

        });

        $('body').on('click', '.btnedit', function() {
            $('.modal').modal('hide');
            
            var id = $(this).data('id');
            var url = "{{ route('member.zoom-meeting.edit', ':id')}}";
            url = url.replace(':id', id);
            $('#modelHeading').html('');
            $.ajaxModal('#meetingDetailModal', url);   
        });

        $('.save-meeting').click(function () {
            $.easyAjax({
                url: "{{ route('member.zoom-meeting.store') }}",
                container: '#modal-data-application',
                type: "POST",
                data: $('#createMeeting').serialize(),
                success: function (response) {
                    if (response.status == 'success') {
                            var dropzone = 0;
                            @if($upload)
                                dropzone = myDropzone.getQueuedFiles().length;
                            @endif

                            if(dropzone > 0){
                                taskID = response.meetingID;
                                $('#taskID').val(response.meetingID);
                                myDropzone.processQueue();
                            }
                            else{
                                var msgs = "@lang('messages.meetingCreatedSuccessfully')";
                                $('#my-meeting').modal('hide');
                                $.showToastr(msgs, 'success');
                                loadTable();
                            }
                        }
                }
            })
        })

    })
    function loadTable(){
        window.LaravelDataTables["meeting-table"].draw();
    }

    var getEventDetail = function (id) {
        var url = "{{ route('member.zoom-meeting.show', ':id')}}";
        url = url.replace(':id', id);

        $('#modelHeading').html('Meeting');
        $.ajaxModal('#meetingDetailModal', url);
    }

</script>
@endpush