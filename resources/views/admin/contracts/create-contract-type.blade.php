<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">@lang('modules.contracts.contractType')</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">
        <div class="table-responsive">
            <table class="table category-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('app.name')</th>
                    <th>@lang('app.action')</th>
                </tr>
                </thead>
                <tbody>
                @forelse($contractType as $key=>$type)
                    <tr id="contract-type-{{ $type->id }}">
                        <td>{{ $key+1 }}</td>
                        <td>{{ ucwords($type->name) }}</td>
                        <td>
                            <a href="javascript:;" data-cat-name="{{ $type->name }}" data-cat-id="{{ $type->id }}" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a>
                            <a href="javascript:;" data-cat-id="{{ $type->id }}" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">@lang('messages.noContractType')</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {!! Form::open(['id'=>'createTaskCategoryForm','class'=>'ajax-form','method'=>'POST']) !!}
        <div class="form-body">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label>@lang('app.name')</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" id="save-category" class="btn btn-success"> <i class="fa fa-check"></i> @lang('app.save')</button>
        </div>
        {!! Form::close() !!}

        {!! Form::open(['id'=>'updateTaskCategoryForm','class'=>'ajax-form','method'=>'POST']) !!}
        <div class="form-body">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label>@lang('app.name')</label>
                        <input type="hidden" name="type_id" id="type_id" class="form-control">
                        <input type="text" name="name" id="name_update" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" id="update-category" class="btn btn-success"> <i class="fa fa-check"></i> @lang('app.update')</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<script>
    $('#updateTaskCategoryForm').hide()

    $('body').on('click', '.delete-category', function(e) {
        var id = $(this).data('cat-id');
        var url = "{{ route('admin.contract-type.destroy',':id') }}";
        url = url.replace(':id', id);

        var token = "{{ csrf_token() }}";

        $.easyAjax({
            type: 'POST',
            url: url,
            data: {'_token': token, '_method': 'DELETE'},
            success: function (response) {
                if (response.status == "success") {
                    $.unblockUI();
                    $('#contract-type-'+id).fadeOut();
                    var options = [];
                    var rData = [];
                    rData = response.data;
                    $.each(rData, function( index, value ) {
                        var selectData = '';
                        selectData = '<option value="'+value.id+'">'+value.name+'</option>';
                        options.push(selectData);
                    });

                    $('#contractType').html(options);
                    $('#contractType').find('select').select2();
                }
            }
        });
        e.preventDefault();
    });

    $('.modify-category').on('click', function (e) {
        $('#createTaskCategoryForm').hide()
        $('#updateTaskCategoryForm').show()
        $('#name_update').val($(this).data('cat-name'))
        $('#type_id').val($(this).data('cat-id'))
    })

    $('#update-category').click(function () {
        var id = $("#type_id").val();
        var url = "{{ route('admin.contract-type.store-contract-type',':id') }}";
        url = url.replace(':id', id);
        $.easyAjax({
            url: url,
            container: '#updateTaskCategoryForm',
            type: "POST",
            data: $('#updateTaskCategoryForm').serialize(),
            success: function (response) {
                if(response.status == 'success'){
                        var options = [];
                        var rData = [];
                        let listData = "";
                        rData = response.data;
                        $.each(rData, function( index, value ) {
                            var selectData = '';
                            selectData = '<option value="'+value.id+'">'+value.name+'</option>';
                            options.push(selectData);
                            listData += '<tr id="contract-type-' + value.id + '">'+
                                '<td>'+(index+1)+'</td>'+
                                '<td>' + value.name + '</td>'+
                                '<td><a href="javascript:;" data-cat-name="'+value.name+'" data-cat-id="'+value.id+'" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a> <a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>'+
                                '</tr>';
                        });
                    $('.category-table tbody' ).html(listData);

                        $('#contractType').html(options);
                        $('#name').val(' ');
                        $('#contractType').find('select').select2();


                        $('#createTaskCategoryForm').show()
                        $('#updateTaskCategoryForm').hide()
                        $('#name_update').val('')
                        $('#type_id').val('')
                    }
                }
            })
        });

    $('#save-category').click(function () {
        $.easyAjax({
            url: '{{route('admin.contract-type.store-contract-type')}}',
            container: '#createTaskCategoryForm',
            type: "POST",
            data: $('#createTaskCategoryForm').serialize(),
            success: function (response) {
                if(response.status == 'success'){
                        var options = [];
                        var rData = [];
                        let listData = "";
                        rData = response.data;
                        $.each(rData, function( index, value ) {
                            var selectData = '';
                            selectData = '<option value="'+value.id+'">'+value.name+'</option>';
                            options.push(selectData);
                            listData += '<tr id="contract-type-' + value.id + '">'+
                                '<td>'+(index+1)+'</td>'+
                                '<td>' + value.name + '</td>'+
                                '<td><a href="javascript:;" data-cat-name="'+value.name+'" data-cat-id="'+value.id+'" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a> <a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>'+
                                '</tr>';
                        });
                    $('.category-table tbody' ).html(listData);

                        $('#contractType').html(options);
                        $('#name').val(' ');
                        $('#contractType').find('select').select2();
                    }
                }
            })
        });
</script>