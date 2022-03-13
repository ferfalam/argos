<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">@lang('modules.projects.projectTech')</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">
        <div class="table-responsive">
            <table class="table category-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('modules.projectPlace.placeName')</th>
                    <th>@lang('app.action')</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $key=>$category)
                    <tr id="cat-{{ $category->id }}">
                        <td>{{ $key+1 }}</td>
                        <td>{{ ucwords($category->place_name) }}</td>
                        <td>
                            <a href="javascript:;" data-cat-id="{{ $category->id }}" data-cat-name="{{ $category->place_name }}" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a>
                            <a href="javascript:;" data-cat-id="{{ $category->id }}" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">@lang('messages.noProjectPlaceAdded')</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div id="create-section">
            {!! Form::open(['id'=>'createProjectCategory','class'=>'ajax-form','method'=>'POST']) !!}
            <div class="form-body">
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="form-group">
                            <label>@lang('modules.projectPlace.placeName')</label>
                            <input type="text" name="place_name" id="place_name" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" id="save-category" class="btn btn-success"><i
                            class="fa fa-check"></i> @lang('app.save')
                </button>
            </div>
            {!! Form::close() !!}
        </div>
        <div id="update-section" style="display: none">
            {!! Form::open(['id'=>'updateCategory','class'=>'ajax-form','method'=>'PUT']) !!}
            <div class="form-body">
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="form-group">
                            <label>@lang('modules.projectPlace.placeName')</label>
                            <input type="hidden" name="place_id" id="place_id_update">
                            <input type="text" name="place_name" id="place_name_update" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" id="update-category" class="btn btn-success"> <i class="fa fa-check"></i> @lang('app.update')</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script>
    $('body').on('click', '.modify-category', function (event) {
        $('#create-section').hide()
        $("#place_id_update").val($(this).data('cat-id'))
        $("#place_name_update").val($(this).data('cat-name'))
        $('#update-section').show()
    })

    $('body').on('click', '.delete-category', function(e) {
        var id = $(this).data('cat-id');
        var url = "{{ route('admin.projectTechnology.destroy',':id') }}";
        url = url.replace(':id', id);

        var token = "{{ csrf_token() }}";

        $.easyAjax({
            type: 'POST',
            url: url,
            data: {'_token': token, '_method': 'DELETE'},
            success: function (response) {
                if (response.status == "success") {
                    $.unblockUI();
                    $('#cat-' + id).fadeOut();
                    let options = [];
                    let rData = [];
                    rData = response.data;
                    $.each(rData, function (index, value) {
                        var selectData = '';
                        selectData = '<option value="' + value.id + '">' + value.place_name + '</option>';
                        options.push(selectData);
                    });

                    $('#technology_id').html(options);
                    $('#technology_id').selectpicker('refresh');
                }
            }
        });
        e.preventDefault();
    });

    $('#createProjectCategory').on('submit', (e) => {
        $.easyAjax({
            url: '{{route('admin.projectTechnology.store-cat')}}',
            container: '#createProjectCategory',
            type: "POST",
            data: $('#createProjectCategory').serialize(),
            success: function (response) {
                if (response.status == 'success') {
                    let options = [];
                    let rData = [];
                    let listData = "";
                    rData = response.data;
                    $.each(rData, function (index, value) {
                        var selectData = '';
                        selectData = '<option value="' + value.id + '">' + value.place_name + '</option>';
                        options.push(selectData);
                        listData += '<tr id="cat-' + value.id + '">'+
                        '<td>'+(index+1)+'</td>'+
                        '<td>' + value.place_name + '</td>'+
                        '<td><a href="javascript:;" data-cat-id="' + value.id + '" data-cat-name="' + value.place_name + '" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a> <a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>'+
                        '</tr>';
                    });

                    $('.category-table tbody' ).html(listData);

                    $('#technology_id').html(options);
                    $('#technology_id').selectpicker('refresh');
                    $('#place_name').val('');
                }
            }
        })
        e.preventDefault();
    });

    $('#updateCategory').on('submit', (e) => {
        e.preventDefault();
        var id = $("#place_id_update").val();
        var url = "{{ route('admin.projectTechnology.update', ':id')}}";
        url = url.replace(':id', id);
        $.easyAjax({
            url: url,
            container: '#updateCategory',
            type: "POST",
            data: $('#updateCategory').serialize(),
            success: function (response) {
                if (response.status == 'success') {
                    let options = [];
                    let rData = [];
                    let listData = "";
                    rData = response.data;
                    $.each(rData, function (index, value) {
                        var selectData = '';
                        selectData = '<option value="' + value.id + '">' + value.place_name + '</option>';
                        options.push(selectData);
                        listData += '<tr id="cat-' + value.id + '">'+
                            '<td>'+(index+1)+'</td>'+
                            '<td>' + value.place_name + '</td>'+
                            '<td><a href="javascript:;" data-cat-id="' + value.id + '" data-cat-name="' + value.place_name + '" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a> <a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>'+
                            '</tr>';
                    });

                    $('.category-table tbody' ).html(listData);
                    $('#place_name').val('');
                    $('#update-section').hide()
                    $('#create-section').show()
                    $('#place_id').html(options);
                    $('#place_id').selectpicker('refresh');
                }
            }
        })
        e.preventDefault();
    });

</script>