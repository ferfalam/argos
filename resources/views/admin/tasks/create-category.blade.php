<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">@lang('modules.tasks.taskCategory')</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">
        <div class="table-responsive">
            <table class="table category-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('modules.taskCategory.categoryName')</th>
                    <th>@lang('app.action')</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $key=>$category)
                    <tr id="cat-{{ $category->id }}">
                        <td>{{ $key+1 }}</td>
                        <td>{{ ucwords($category->category_name) }}</td>
                        <td>
                            <a href="javascript:;" data-cat-id="{{ $category->id }}" data-cat-name="{{ $category->category_name }}" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a>
                            <a href="javascript:;" data-cat-id="{{ $category->id }}" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">@lang('messages.noTaskCategory')</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div id="create-section">
            {!! Form::open(['id'=>'createTaskCategoryForm','class'=>'ajax-form','method'=>'POST']) !!}
            <div class="form-body">
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="form-group">
                            <label>@lang('modules.taskCategory.categoryName')</label>
                            <input type="text" name="category_name" id="category_name" class="form-control">
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
            {!! Form::open(['id'=>'updateCategory','class'=>'ajax-form','method'=>'PUT']) !!}
            <div class="form-body">
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="form-group">
                            <label>@lang('modules.taskCategory.categoryName')</label>
                            <input type="hidden" name="category_id" id="category_id">
                            <input type="text" name="category_name" id="category_name_update" class="form-control">
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
        $("#category_id").val($(this).data('cat-id'))
        $("#category_name_update").val($(this).data('cat-name'))
        $('#update-section').show()
    })
    
    $('body').on('click', '.delete-category', function(e) {
        var id = $(this).data('cat-id');
        var url = "{{ route('admin.taskCategory.destroy',':id') }}";
        url = url.replace(':id', id);

        var token = "{{ csrf_token() }}";

        $.easyAjax({
            type: 'POST',
            url: url,
            data: {'_token': token, '_method': 'DELETE'},
            success: function (response) {
                if (response.status == "success") {
                    $.unblockUI();
        //swal("Deleted!", response.message, "success");
                    $('#cat-'+id).fadeOut();
                    var options = [];
                    var rData = [];
                    rData = response.data;
                    if(rData.length< 1){
                        selectData = '<option value="">@lang('messages.noTaskCategoryAdded')</option>';
                        options.push(selectData);
                        $('#category_id').html(options);
                        $('#category_id').selectpicker('refresh');
                    }else{
                    $.each(rData, function( index, value ) {
                        var selectData = '';
                        selectData = '<option value="'+value.id+'">'+value.category_name+'</option>';
                        options.push(selectData);
                        $('#category_id').html(options);
                      //  $('#category_id').selectpicker('refresh');
                    });
                    }
                    

                }
            }
        });
        e.preventDefault();
    });

    $('#createTaskCategoryForm').on('submit', (e) => {
        e.preventDefault();
        $.easyAjax({
            url: '{{route('admin.taskCategory.store-cat')}}',
            container: '#createTaskCategoryForm',
            type: "POST",
            data: $('#createTaskCategoryForm').serialize(),
            success: function (response) {
                if(response.status == 'success'){
                    if(response.status == 'success'){
                        var options = [];
                        var rData = [];
                        let listData = "";
                        rData = response.data;
                        $.each(rData, function( index, value ) {
                            var selectData = '';
                            selectData = '<option value="'+value.id+'">'+value.category_name+'</option>';
                            options.push(selectData);
                            listData += '<tr id="cat-' + value.id + '">'+
                                '<td>'+(index+1)+'</td>'+
                                '<td>' + value.category_name + '</td>'+
                                '<td><a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>'+
                                '</tr>';
                        });
                        $('.category-table tbody' ).html(listData);
                        $('#category_id').html(options);
                       // $('#category_id').selectpicker('refresh');
                        $('#category_name').val('');
                    }
                }
            }
        })
    });

    $('#updateCategory').on('submit', (e) => {
        e.preventDefault();
        var id = $("#category_id").val();
        var url = "{{ route('admin.taskCategory.update', ':id')}}";
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
                        selectData = '<option value="' + value.id + '">' + value.category_name + '</option>';
                        options.push(selectData);
                        listData += '<tr id="cat-' + value.id + '">'+
                            '<td>'+(index+1)+'</td>'+
                            '<td>' + value.category_name + '</td>'+
                            '<td><a href="javascript:;" data-cat-id="' + value.id + '" data-cat-name="' + value.category_name + '" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a> <a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>'+
                            '</tr>';
                    });

                    $('.category-table tbody' ).html(listData);
                    $('#category_name').val('');
                    $('#category_id').html(options);
                    $('#update-section').hide()
                    $('#create-section').show()
                }
            }
        })
        e.preventDefault();
    });
</script>