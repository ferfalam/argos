<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title"><i class="icon-pencil"></i> @lang('zoom::modules.zoommeeting.editMeeting')</h4>
</div>
<div class="modal-body">
    {!! Form::open(['id'=>'editMeeting','class'=>'ajax-form','method'=>'POST']) !!}
    @method('PUT')
    <input type="hidden" name ="id_field" id ="id_field"  value="{{$room->idroom}}" >
    <div class="row">
        <div class="col-md-6 ">
            <div class="form-group">
                <label class="required">@lang('zoom::modules.zoommeeting.roomName')</label>
                <input type="text" name="room_title" id="meeting_title" value="{{$room->name}}" class="form-control">
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="form-group">
                <label class="required">@lang('zoom::modules.zoommeeting.location')</label>
                <input type="text" name="room_location" id="meeting_title" value="{{$room->location}}" class="form-control">
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="form-group">
                <label class="required">@lang('zoom::modules.zoommeeting.capacity')</label>
                <input type="text" name="room_capacity" id="meeting_title" value="{{$room->capacity}}" class="form-control">
            </div>
        </div>

    </div>
    {!! Form::close() !!}
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">@lang('app.close')</button>
    <button type="button" id="sub" class="btn btn-success edit-room waves-effect waves-light">@lang('app.submit')</button>
</div>

<script src="{{ asset('plugins/bower_components/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/cbpFWTabs.js') }}"></script>
<link rel="stylesheet" href="{{ asset('plugins/bower_components/timepicker/bootstrap-timepicker.min.css') }}">
<script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/multiselect/js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-colorselector/bootstrap-colorselector.min.js') }}"></script>
<script>
    $(function() {
        {{--jQuery('#start_date, #end_date').datepicker({--}}
        {{--    autoclose: true,--}}
        {{--    todayHighlight: true,--}}
        {{--    format: '{{ $global->date_picker_format }}',--}}

        {{--})--}}

        {{--$('#start_time, #end_time').timepicker({--}}
        {{--    @if($global->time_format == 'H:i')--}}
        {{--    showMeridian: false,--}}
        {{--    @endif--}}

        {{--});--}}
        $("#employee_ids,#client_ids, #created_by").select2({
            formatNoMatches: function () {
                return "{{ __('messages.noRecordFound') }}";
            }
        });

        $('#color-selector').colorselector();

        $('.edit-room').click(function () {
            var id = $("#id_field").val();
            var url = "{{ route('admin.room.update', ':id') }}";
            url = url.replace(':id', id);
            $.easyAjax({
                url: url,
                container: '#editMeeting',
                type: "POST",
                data: $('#editMeeting').serialize(),
                success: function (response) {
                    if(response.status == 'success'){
                        window.location.reload();
                    }
                }
            })
        });
        $('#edit-repeat-meeting').is(':checked') ? $('#repeat-fields').show() : $('#repeat-fields').hide();
        $('#edit-send_reminder').is(':checked') ? $('#reminder-fields').show() : $('#reminder-fields').hide();

        $('#edit-repeat-meeting').change(function () {
            if($(this).is(':checked')){
                $('#edit-repeat-fields').show();
            }
            else{
                $('#edit-repeat-fields').hide();
            }
        })

        $('#edit-send_reminder').change(function () {
            if($(this).is(':checked')){
                $('#edit-reminder-fields').show();
            }
            else{
                $('#edit-reminder-fields').hide();
            }
        })

        $('#add_category').click(function () {
            var url = '{{ route('admin.category.create')}}';
            $('#modelHeading').html('...');
            $.ajaxModal('#categoryModal', url);

        });
    })

</script>
