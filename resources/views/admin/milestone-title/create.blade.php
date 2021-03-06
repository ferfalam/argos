<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">@lang('modules.projects.milestoneTitle')</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">
        <div class="table-responsive">
            <table class="table category-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('modules.projects.milestoneTitle')</th>
                    <th>@lang('app.action')</th>
                </tr>
                </thead>
                <tbody>
                @forelse($titles as $key=>$type)
                    <tr id="contract-type-{{ $type->id }}">
                        <td>{{ $key+1 }}</td>
                        <td>{{ ucwords($type->name) }}</td>
                        <td><a href="javascript:;" data-cat-name="{{ $type->name }}"  data-cat-id="{{ $type->id }}" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a> 
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

        <hr>
        <div id="create-section">
            {!! Form::open(['id'=>'createTaskCategoryForm','class'=>'ajax-form','method'=>'POST']) !!}
            <div class="form-body">
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="form-group">
                            <label>@lang('modules.projects.milestoneTitle')</label>
                            <input type="text" name="name" id="name" class="form-control">
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
            {!! Form::open(['id'=>'updateTaskCategoryForm','class'=>'ajax-form','method'=>'PUT']) !!}
            <div class="form-body">
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="form-group">
                            <label>@lang('modules.projects.milestoneTitle')</label>
                            <input type="hidden" name="" id="type_id_update" class="form-control">
                            <input type="text" name="name" id="name_update" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" id="save-category" class="btn btn-success"> <i class="fa fa-check"></i> @lang('app.modify')</button>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
</div>

<script>

    $('body').on('click', '.modify-category', function (event) {
        $('#create-section').hide()
        $("#type_id_update").val($(this).data('cat-id'))
        $("#name_update").val($(this).data('cat-name'))
        $('#update-section').show()
    })
    $('body').on('click', '.delete-category', function(e) {
        var id = $(this).data('cat-id');
        var url = "{{ route('admin.milestone-title.destroy',':id') }}";
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

                    $('#milestone_title').html(options);
                    // $('#event_type_id2').html(options);
                    // $('#contractType').find('select').select2();
                    // $('#projectCategoryModal').modal('hide');
                }
            }
        });
        e.preventDefault();
    });

    $('#createTaskCategoryForm').on('submit', (e) => {
        e.preventDefault();
        $.easyAjax({
            url: '{{route('admin.milestone-title.store')}}',
            container: '#createTaskCategoryForm',
            type: "POST",
            data: $('#createTaskCategoryForm').serialize(),
            success: function (response) {
                if(response.status == 'success'){
                    if(response.status == 'success'){
                        console.log(response.data);
                        var options = [];
                        var rData = [];
                        let listData = "";
                        rData = response.data;
                        $.each(rData, function( index, value ) {
                            var selectData = '';
                            selectData = '<option value="'+value.id+'">'+value.name+'</option>';
                            options.push(selectData);
                            listData += '<tr id="cat-' + value.id + '">'+
                                '<td>'+(index+1)+'</td>'+
                                '<td>' + value.name + '</td>'+
                                '<td><a href="javascript:;" data-cat-name="' + value.name + '" data-cat-id="' + value.id + '" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a> <a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>'+
                                '</tr>';
                        });

                        $('.category-table tbody' ).html(listData);
                        $('#name').val(' ');

                        $('#milestone_title').html(options);
                        // $('#event_type_id2').html(options);
                        // $('#contractType').find('select').select2();
                    }
                }
            }
        })
    });

        $('#updateTaskCategoryForm').on('submit', (e) => {
        e.preventDefault();
        var id = $("#type_id_update").val();
        var url = "{{ route('admin.milestone-title.update', ':id')}}";
        url = url.replace(':id', id);
        $.easyAjax({
            url: url,
            container: '#updateTaskCategoryForm',
            type: "POST",
            data: $('#updateTaskCategoryForm').serialize(),
            success: function (response) {
                if(response.status == 'success'){
                    if(response.status == 'success'){
                        console.log(response.data);
                        var options = [];
                        var rData = [];
                        let listData = "";
                        rData = response.data;
                        $.each(rData, function( index, value ) {
                            var selectData = '';
                            selectData = '<option value="'+value.id+'">'+value.name+'</option>';
                            options.push(selectData);
                            listData += '<tr id="cat-' + value.id + '">'+
                                '<td>'+(index+1)+'</td>'+
                                '<td>' + value.name + '</td>'+
                                '<td><a href="javascript:;" data-cat-name="' + value.name + '" data-cat-id="' + value.id + '" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a> <a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>'+
                                '</tr>';
                        });

                        $('.category-table tbody' ).html(listData);
                        $('#name').val(' ');

                        $('#milestone_title').html(options);
                        // $('#event_type_id2').html(options);
                        // $('#contractType').find('select').select2();

                        $('#create-section').show()
                        $("#type_id_update").val()
                        $("#name_update").val()
                        $('#update-section').hide()
                    }
                }
            }
        })
    });


</script>