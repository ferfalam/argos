<style>
    .modal {
        overflow-x: hidden;
        overflow-y: auto;
    }
</style>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">@lang('zoom::modules.zoommeeting.addRoom')</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>ROOM</th>
                    <th>CAPACITY</th>
                    <th>LOCATION</th>
                    <th>@lang('app.action')</th>
                </tr>
                </thead>
                <tbody>
                @forelse($rooms as $room)
                    <tr id="cat-{{ $room->id }}">
                        <td>{{ $room->id }}</td>
                        <td>{{ ucwords($room->name) }}</td>
                        <td>{{ ucwords($room->capacity) }}</td>
                        <td>{{ ucwords($room->location) }}</td>
                        <td><a href="javascript:;" data-cat-id="{{ $room->id }}" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No Room Added</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <hr>
        {!! Form::open(['id'=>'createClientCategory','class'=>'ajax-form','method'=>'POST']) !!}
        <div class="form-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="required">@lang('zoom::modules.zoommeeting.roomName')</label>
                        <input type="text" name="room_title" id="room_title" class="form-control">
                    </div>
                </div>

            </div>
        </div>
        <div class="form-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="required">@lang('zoom::modules.zoommeeting.location')</label>
                        <input type="text" name="room_location" id="room_location" class="form-control">
                    </div>
                </div>

            </div>
        </div>
        <div class="form-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="required">@lang('zoom::modules.zoommeeting.capacity')</label>
                        <input type="text" name="room_capacity" id="room_capacity" class="form-control">
                    </div>
                </div>

            </div>
        </div>
        <div class="form-actions">
            <button type="button" id="save-category" class="btn btn-success"> <i class="fa fa-check"></i> @lang('app.save')</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<script>

    $('.delete-category').click(function () {
        var id = $(this).data('cat-id');
        var url = "{{ route('admin.category.destroy',':id') }}";
        url = url.replace(':id', id);

        var token = "{{ csrf_token() }}";

        $.easyAjax({
            type: 'POST',
            url: url,
            data: {'_token': token, '_method': 'DELETE'},
            success: function (response) {
                if (response.status == "success") {
                    $.unblockUI();
                    $('#cat-'+id).fadeOut();
                    var options = [];
                    var rData = [];
                    rData = response.data;

                    $.each(rData, function( index, value ) {
                        var selectData = '';
                        selectData = '<option value="'+value.id+'">'+value.category_name+'</option>';

                        options.push(selectData);
                    });
                    $('#category_id_edit').html(options);
                    $('#category_id').html(options);
                    $('#categoryModal').modal('hide');
                }
            }
        });
    });

    $('#save-category').click(function () {
        $.easyAjax({
            url: '{{route('admin.room.store')}}',
            container: '#createClientCategory',
            type: "POST",
            data: $('#createClientCategory').serialize(),
            success: function (response) {
                if(response.status == 'success'){
                    var options = [];
                    var rData = [];
                    rData = response.data;
                    console.log(rData);
                    $.each(rData, function( index, value ) {
                        var selectData = '';
                        selectData = '<option value="'+value.id+'">'+value.name+'</option>';
                        options.push(selectData);
                    });
                    $('#category_id_edit').html(options);
                    $('#room_id').html(options);
                    $('#categoryModal').modal('hide');
                }
            }
        })
    });
</script>