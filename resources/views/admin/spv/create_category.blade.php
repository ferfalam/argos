<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">@lang('modules.spvCategory')</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">
        <div class="table-responsive">
            <table class="table category-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('modules.projectCategory.categoryName')</th>
                    <th>@lang('app.action')</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $key=>$category)
                    <tr id="cat-{{ $category->id }}">
                        <td>{{ $key+1 }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td><a href="javascript:;" data-cat-name="{{$category->category_name}}" data-cat-id="{{ $category->id }}" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a> <a href="javascript:;" data-cat-id="{{ $category->id }}" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">@lang('messages.noProjectCategory')</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <hr>
        <div id="create-section">
            {!! Form::open(['id'=>'createProjectCategory','class'=>'ajax-form','method'=>'POST']) !!}
            <div class="form-body">
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="form-group">
                            <label class="required">@lang('app.add') @lang('modules.projectCategory.categoryName')</label>
                            <input type="text" name="category_name" id="category_name" class="form-control" width="100%">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" id="save-category" class="btn btn-success"> <i class="fa fa-check"></i> @lang('app.save')</button>
            </div>
            {!! Form::close() !!}
        </div>
        <div id="update-section" style="display: none">
            {!! Form::open(['id'=>'updateProjectCategory','class'=>'ajax-form','method'=>'PUT']) !!}
            <div class="form-body">
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="form-group">
                            <label class="required">@lang('app.modify') @lang('modules.projectCategory.categoryName')</label>
                            <input type="hidden" name="category_id_update" id="category_id_update">
                            <input type="text" name="category_name" id="category_name_update" class="form-control" width="100%">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" id="save-category" class="btn btn-success"> <i class="fa fa-check"></i> @lang('app.update')</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script>
    $('body').on('click', '.modify-category', function (event) {
        $('#create-section').hide()
        $("#category_id_update").val($(this).data('cat-id'))
        $("#category_name_update").val($(this).data('cat-name'))
        $('#update-section').show()
    })

    $('#updateProjectCategory').on('submit', (e) => {
        e.preventDefault();
        var id = $("#category_id_update").val();
        var url = "{{route('admin.spvCategory.update', ':id')}}";
        url = url.replace(':id', id);
        $.easyAjax({
            url: url,
            container: '#updateProjectCategory',
            type: "POST",
            data: $('#updateProjectCategory').serialize(),
            success: function (response) {
                if(response.status == 'success'){
                    var options = [];
                    var rData = [];
                    let listData = "";
                    rData = response.data;
                    $.each(rData, function (index, value) {
                        var selectData = '';
                        selectData = '<option value="' + value.id + '">' + value.category_name + '</option>';
                        options.push(selectData);
                        listData += '<tr id="cat-' + value.id + '">'+
                            '<td>'+(index+1)+'</td>'+
                            '<td>' + value.category_name + '</td>'+
                            '<td><a href="javascript:;" data-cat-name="' + value.category_name + '" data-cat-id="' + value.id + '" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a> <a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>'+
                            '</tr>';
                    });

                    $('.category-table tbody' ).html(listData);

                    $('#category_id').html(options);
                    $('#category_name').val(' ');
                    $('#create-section').show()

                    $('#update-section').hide()
                }
            }
        })
    });

    $('body').on('click', '.delete-category', function(e) {
        var id = $(this).data('cat-id');
        var url = "{{ route('admin.spvCategory.destroy',':id') }}";
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

                    $('#category_id').html(options);
                }
            }
        });
        e.preventDefault();
    });

    $('#createProjectCategory').on('submit', (e) => {
        e.preventDefault();
        $.easyAjax({
            url: '{{route('admin.spvCategory.store')}}',
            container: '#createProjectCategory',
            type: "POST",
            data: $('#createProjectCategory').serialize(),
            success: function (response) {
                if(response.status == 'success'){
                    if(response.status == 'success'){
                        var options = [];
                        var rData = [];
                        let listData = "";
                        rData = response.data;
                        $.each(rData, function (index, value) {
                            var selectData = '';
                            selectData = '<option value="' + value.id + '">' + value.category_name + '</option>';
                            options.push(selectData);
                            listData += '<tr id="cat-' + value.id + '">'+
                                '<td>'+(index+1)+'</td>'+
                                '<td>' + value.category_name + '</td>'+
                                '<td><a href="javascript:;" data-cat-name="' + value.category_name + '" data-cat-id="' + value.id + '" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a> <a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>'+
                                '</tr>';
                        });

                        $('.category-table tbody' ).html(listData);

                        $('#category_id').html(options);
                        $('#category_name').val(' ');
                    }
                }
            }
        })
    });
</script>