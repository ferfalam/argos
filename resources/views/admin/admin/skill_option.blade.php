<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">
        @lang("app.compentancy")
    </h4>
</div>
<div class="modal-body">
    <div class="portlet-body">
        <div class="table-wrapper-scroll-y my-custom-scrollbar">
            <div class="table-responsive">
                <table class="table category-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>
                            @lang("app.compentancy")
                        </th>
                        <th>@lang('app.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($skills as $key=>$t)
                        <tr id="cat-{{ $t->id }}">
                            <td>{{ $key+1 }}</td>
                            <td id="catn-{{ $t->id }}">{{ $t->name }}</td>
                            <td><a href="javascript:;" data-cat-id="{{ $t->id }}" class="btn btn-sm btn-danger btn-rounded delete-category" onclick="deleteOption({{ $t->id }})">@lang("app.remove")</a>&nbsp;<a href="javascript:;" data-edit-id="{{ $t->id }}" class="btn btn-sm btn-danger btn-rounded delete-category" onclick="editOption({{ $t->id }},'{{$t->name}}')">@lang("app.edit")</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">@lang('messages.noProjectCategory')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <hr>
        {!! Form::open(['id'=>'createOption','class'=>'ajax-form','method'=>'POST']) !!}
        <div class="form-body">
            <div class="">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label class="required">@lang('app.add')
                            @lang("app.compentancy")
                        </label>
                        <input type="text" name="option_name" id="option_name" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" id="save-category" class="btn btn-success"> <i class="fa fa-check"></i> @lang('app.save')</button>
        </div>
        {!! Form::close() !!}
        {!! Form::open(['id'=>'editOption','class'=>'ajax-form','method'=>'PUT','hidden']) !!}
        <div class="form-body">
            <div class="">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label class="required">@lang('app.add')
                            @lang("app.compentancy")
                        </label>
                        <input type="text" name="option_name" id="edit_option_name" class="form-control">
                        <input type="hidden" name="option_id" id="edit_option_id" value="">
                        <input type="hidden" name="old_option_id" id="old_option_id" value="">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" id="save-category" class="btn btn-success"> <i class="fa fa-check"></i> @lang('app.edit')</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<script>
    function deleteOption(id) {
        let url = "{{ route('admin.skill.destroy',':id') }}";
        url = url.replace(':id', id);
        $.easyAjax({
            type: 'POST',
            url: url,
            data: {'_token': "{{ csrf_token() }}", '_method': 'DELETE'},
            success: function (response) {
                if (response.status == "success") {
                    // $.unblockUI();
                    $('#cat-'+id).fadeOut();
                    $("#{{$type}} option").each(function () {
                        if (response.skill.id==$(this).val()){
                            $(this).remove()
                        }
                    })
                    $('#{{$type}}').trigger('change.select2');
                }
            }
        });
    }

    function editOption(id,name) {
        $('#createOption').hide();
        $('#editOption').show();
        $('#edit_option_name').val(name);
        $('#old_option_id').val(name);
        $('#edit_option_id').val(id);
    }

    $('#editOption').on('submit',(e)=>{
        e.preventDefault();
        let url = "{{ route('admin.skill.update',':id') }}";
        let id = $('#edit_option_id').val();
        url = url.replace(':id', id);
        $.easyAjax({
            url: url,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'PUT',
                name: $('#edit_option_name').val(),
                id: id
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#catn-'+$('#edit_option_id').val()).html($('#edit_option_name').val());
                    $('#createOption').show();
                    $('#editOption').hide();
                    $("#{{$type}} option").each(function()
                    {
                        // Add $(this).val() to your list
                        if (response.skill.id==$(this).val()){
                            $(this).text($('#edit_option_name').val());
                        }
                    });
                    $('#{{$type}}').trigger('change.select2');
                }
            }
        });
    });

    $('#createOption').on('submit', (e) => {
        e.preventDefault();
        $.easyAjax({
            url: "{{ route('admin.skill.store') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                name: $('#option_name').val(),
            },
            success: function(response) {
                if (response.status === 'success') {
                    let pos = $('.category-table tbody').children().length + 1;
                    $('.category-table tbody' ).append(
                        '<tr id="cat-' + response.skill.id + '">'+
                        '<td>'+ pos +'</td>'+
                        '<td>' + response.skill.name + '</td>'+
                        '<td><a href="javascript:;" data-cat-id="' + response.skill.id + '" class="btn btn-sm btn-danger btn-rounded delete-category" onclick="deleteOption(' + response.skill.id + ')">@lang("app.remove")</a></td>'+
                        '</tr>'
                    );
                    $('#{{$type}}').append('<option value="' + response.skill.name + '">' + response.skill.name + '</option>');
                    $('#option_name').val("") ;
                }
            }
        });
    });
</script>