@extends('layouts.app')


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
    <style>
        #meeting-table_wrapper .dt-buttons{
            display: none !important;
        }
    </style>
@endpush


@section('page-title')
    <x-main-header>
        <x-slot name="title">
            @lang($pageTitle) 
        </x-slot>

        <x-slot name="btns">
            <x-link type="modal" modalId="#my-meeting" classes="btn btn-cs-blue" icon="ti-plus" title="zoom::modules.zoommeeting.addRoom"/>
            {{-- <x-link classes="btn btn-cs-green" icon="fa fa-calendar" url="{{route('admin.zoom-meeting.index')}}" title="zoom::modules.zoommeeting.calendarView"/> --}}
        </x-slot>
    </x-main-header>
@endsection

@section('content')
    <x-table :dataTable="$dataTable">
        {{-- {!! $dataTable->table(['class' => 'table table-bordered table-hover toggle-circle default footable-loaded footable']) !!} --}}
    </x-table>

    <!-- BEGIN MODAL -->
    <div class="modal fade bs-modal-md in" id="my-meeting" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-plus"></i> @lang('zoom::modules.zoommeeting.addRoom')</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id'=>'createMeeting','class'=>'ajax-form','method'=>'POST']) !!}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">@lang('zoom::modules.zoommeeting.roomName')</label>
                                    <input type="text" name="room_title" id="room_title" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">@lang('zoom::modules.zoommeeting.location')</label>
                                    <input type="text" name="room_location" id="room_location" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">@lang('zoom::modules.zoommeeting.capacity')</label>
                                    <input type="text" name="room_capacity" id="room_capacity" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">@lang('app.close')</button>
                    <button type="button" class="btn btn-success save-meeting waves-effect waves-light">@lang('app.submit')</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End  --}}

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

    {!! $dataTable->scripts() !!}
    <script>
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

        $('#colorselector').colorselector();

        $('#start_time, #end_time').timepicker({
            @if($global->time_format == 'H:i')
            showMeridian: false,
            @endif
        });

        $(".select2").select2({
            formatNoMatches: function () {
                return "{{ __('messages.noRecordFound') }}";
            }
        });
        var table;

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

                        var url = "{{ route('admin.room.destroy',':id') }}";
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

                        var url = "{{ route('admin.zoom-meeting.endMeeting') }}";

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

                        var url = "{{ route('admin.zoom-meeting.cancelMeeting') }}";

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
                var url = "{{ route('admin.room.edit', ':id')}}";
                url = url.replace(':id', id);
                $('#modelHeading').html('');
                $.ajaxModal('#meetingDetailModal', url);
            });

            $('.save-meeting').click(function () {
                $.easyAjax({
                    url: "{{ route('admin.room.store') }}",
                    container: '#modal-data-application',
                    type: "POST",
                    data: $('#createMeeting').serialize(),
                    success: function (response) {
                        if(response.status == 'success'){
                            $('#my-meeting').modal('hide');
                            loadTable();
                        }
                    }
                })
            })

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
            var employee = $('#employee').val();
            var client = $('#client').val();
            var category = $('#category').val();
            var project = $('#project').val();

            if (startDate == '') {
                startDate = 0;
            }

            var endDate = $('#filter-end-date').val();

            if (endDate == '') {
                endDate = 0;
            }
            data['employee'] = employee;
            data['client'] = client;
            data['startDate'] = startDate;
            data['endDate'] = endDate;
            data['status'] = status;
            data['category'] = category;
            data['project'] = project;
        });
        function loadTable(){
            window.LaravelDataTables["roomdatatable-table"].draw();
        }

        $('.toggle-filter').click(function () {
            $('#ticket-filters').toggle('slide');
        })

        $('#apply-filters').click(function () {
            window.LaravelDataTables["roomdatatable-table"].draw();
        });

        $('#reset-filters').click(function () {
            $('#filter-form')[0].reset();
            $('.select2').val('not finished');
            $('#client').val('all');
            $('#employee').val('all');
            $('#category').val('all');
            $('#project').val('all');
            $('#filter-form').find('select').select2();
            loadTable();
        })

        var getEventDetail = function (id) {
            var url = "{{ route('admin.zoom-meeting.show', ':id')}}";
            url = url.replace(':id', id);

            $('#modelHeading').html('Meeting');
            $.ajaxModal('#meetingDetailModal', url);
        }
        $('#addCategory').click(function () {
            var url = '{{ route('admin.category.create')}}';
            $('#modelHeading').html('...');
            $.ajaxModal('#categoryModal', url);
        })
    </script>
@endpush
