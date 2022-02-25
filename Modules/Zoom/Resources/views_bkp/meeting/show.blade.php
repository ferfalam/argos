<div id="event-detail">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="ti-eye"></i> @lang('zoom::modules.zoommeeting.meetingDetails')</h4>
    </div>
    <div class="modal-body">
        {!! Form::open(['id'=>'updateEvent','class'=>'ajax-form','method'=>'GET']) !!}
        <div class="form-body">
            <div class="row">
                <div class="col-md-4 ">
                    <div class="form-group">
                        <label> @lang('zoom::modules.zoommeeting.meetingName')</label>
                        <p>
                            <span style="width: 15px; height: 15px;" class="btn {{ $event->label }} btn-small btn-circle">&nbsp;</span>
                            {{ ucfirst($event->title) }}
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="font-12" for="">@lang('zoom::modules.zoommeeting.viewAttendees')</label><br>
                    @foreach ($event->users as $item)
                        <img src="{{ $item->image_url }}" data-toggle="tooltip"
                             data-original-title="{{ ucwords($item->name) }}" data-placement="right"
                             class="img-circle" width="25" height="25" alt="">
                    @endforeach
                    @foreach ($event->client_has_meetings as $item)
                        <img src="{{ $item->client_detail->user->image_url }}" data-toggle="tooltip"
                             data-original-title="{{ ucwords($item->client_detail->user->name) }}" data-placement="right"
                             class="img-circle" width="25" height="25" alt="">
                    @endforeach
                </div>

            </div>

            <div class="row">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label>@lang('app.description')</label>
                        <p>{{ $event->description ?? "--" }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-3 ">
                    <div class="form-group">
                        <label>@lang('zoom::modules.zoommeeting.startOn')</label>
                        <p>{{ $event->start_date_time->format($global->date_format. ' - '.$global->time_format) }}</p>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="form-group">
                        <label>@lang('zoom::modules.zoommeeting.endOn')</label>
                        <p>{{ $event->end_date_time->format($global->date_format. ' - '.$global->time_format) }}</p>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="form-group">
                        <label>@lang('app.status')</label>
                        <p>
                            @if ($event->status == 'waiting')
                                <label class="label label-warning">{{ __('zoom::modules.zoommeeting.waiting') }}</label>
                            @elseif ($event->status == 'live')
                                <i class="fa fa-circle Blink" style="color: red"></i> <span class="font-semi-bold">{{ __('zoom::modules.zoommeeting.live') }}</span>
                            @elseif ($event->status == 'canceled')
                                <label class="label label-danger">{{ __('app.canceled') }}</label>
                            @elseif ($event->status == 'finished')
                                <label class="label label-success">{{ __('app.finished') }}</label>
                            @endif
                        </p>
                    </div>
                </div>

            </div>
        </div>
        {!! Form::close() !!}

    </div>

</div>

<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script>
     $('body').on('click', '.delete-event', function () {
        var occurrence = "{{ $event->occurrence_order }}"

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

                var url = "{{ route('admin.offmeeting.destroy', $event->idmeeting) }}";

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
                            window.location.reload();
                        }
                    }
                });
            }


        });
    });

    $("body").tooltip({
        selector: '[data-toggle="tooltip"]'
    })

    $('body').on('click', '.save-event', function () {
        // $('.modal').modal('hide');
        $('#meetingDetailModal .modal-content').html('');

        var url = "{{ route('admin.zoom-meeting.edit', $event->idmeeting) }}";
        $.ajaxModal('#meetingDetailModal', url);   
    })

</script>