<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">@lang('modules.espace.title')</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">
        <div class="table-responsive">
            <table class="table category-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('modules.espace.espaceName')</th>
                    <th>@lang('app.action')</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $key=>$category)
                    <tr id="cat-{{ $category->id }}">
                        <td>{{ $key+1 }}</td>
                        <td>{{ ucwords($category->espace_name) }}</td>
                        <td>
                            <a href="javascript:;" data-cat-id="{{ $category->id }}" data-cat-name="{{ $category->espace_name }}" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a>
                            <a href="javascript:;" data-cat-id="{{ $category->id }}" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">@lang('messages.noEspaceAdded')</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <hr>
        <div id="create-section">
            {!! Form::open(['id'=>'createEspace','class'=>'ajax-form','method'=>'POST']) !!}
            <div class="form-body">
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="form-group">
                            <label>@lang('modules.espace.espaceName')</label>
                            <input type="text" name="espace_name" id="espace_name" class="form-control">
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
            {!! Form::open(['id'=>'updateEspace','class'=>'ajax-form','method'=>'PUT']) !!}
            <div class="form-body">
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="form-group">
                            <label>@lang('modules.espace.espaceName')</label>
                            <input type="hidden" name="espace_id" id="espace_id">
                            <input type="text" name="espace_name" id="espace_name_update" class="form-control">
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

    $('body').on('click', '.delete-category', function() {
        var id = $(this).data('cat-id');
        var url = "{{ route('admin.espace.destroy',':id') }}";
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
                }
            }
        });
    });

    $('body').on('click', '.modify-category', function (event) {
        $('#create-section').hide()
        $("#espace_id").val($(this).data('cat-id'))
        $("#espace_name_update").val($(this).data('cat-name'))
        $('#update-section').show()
    })

    $('#createEspace').on('submit', (e) => {
        e.preventDefault();
        $.easyAjax({
            url: '{{route('admin.espace.store')}}',
            container: '#createEspace',
            type: "POST",
            data: $('#createEspace').serialize(),
            success: function (response) {
                if (response.status == 'success') {
                    let options = [];
                    let rData = [];
                    let listData = "";
                    rData = response.data;
                    $.each(rData, function (index, value) {
                        var selectData = '';
                        selectData = '<option value="' + value.id + '">' + value.espace_name + '</option>';
                        options.push(selectData);
                        listData += '<tr id="cat-' + value.id + '">'+
                            '<td>'+(index+1)+'</td>'+
                            '<td>' + value.espace_name + '</td>'+
                            '<td><a href="javascript:;" data-cat-id="' + value.id + '" data-cat-name="' + value.espace_name + '" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a><a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>'+
                            '</tr>';
                    });

                    $('.category-table tbody' ).html(listData);
                    $('#espace_name').val('');
                }
            }
        })
        e.preventDefault();
    });

    $('#updateEspace').on('submit', (e) => {
        e.preventDefault();
        var id = $("#espace_id").val();
        var url = "{{ route('admin.espace.update', ':id')}}";
        url = url.replace(':id', id);
        $.easyAjax({
            url: url,
            container: '#updateEspace',
            type: "POST",
            data: $('#updateEspace').serialize(),
            success: function (response) {
                if (response.status == 'success') {
                    let options = [];
                    let rData = [];
                    let listData = "";
                    rData = response.data;
                    $.each(rData, function (index, value) {
                        var selectData = '';
                        selectData = '<option value="' + value.id + '">' + value.espace_name + '</option>';
                        options.push(selectData);
                        listData += '<tr id="cat-' + value.id + '">'+
                            '<td>'+(index+1)+'</td>'+
                            '<td>' + value.espace_name + '</td>'+
                            '<td><a href="javascript:;" data-cat-id="' + value.id + '" data-cat-name="' + value.espace_name + '" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a> <a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>'+
                            '</tr>';
                    });

                    $('.category-table tbody' ).html(listData);
                    $('#espace_name').val('');
                    //$('#espace_id').html(options);
                    $('#update-section').hide()
                    $('#create-section').show()
                }
            }
        })
        e.preventDefault();
    });

</script>