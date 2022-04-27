<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">@lang('modules.spvSubCategory')</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">
        <div class="table-responsive">
            <table class="table category-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('modules.productCategory.subCategory')</th>
                    <th>@lang('modules.productCategory.category')</th>
                    <th>@lang('app.action')</th>
                </tr>
                </thead>
                <tbody>
                
                @forelse($subcategories as $key=>$subcategory)
                    <tr id="cat-{{ $subcategory->id }}">
                        <td>{{ $key+1 }}</td>
                        <td>{{ ($subcategory->category_name) }}</td>
                        <td>{{ ($subcategory->spv_category->category_name) }}</td>
                        <td><a href="javascript:;" data-client-cat-id="{{$subcategory->spv_category->id }}" data-cat-name="{{$subcategory->category_name}}" data-cat-id="{{ $subcategory->id }}" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a> <a href="javascript:;" data-cat-id="{{ $subcategory->id }}"  class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">@lang('messages.noSubCategoryAdded')</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div id="create-section">
            {!! Form::open(['id'=>'createProjectCategory','class'=>'ajax-form','method'=>'POST']) !!}
            <div class="form-body">
                <div class="row">
                <div class="col-xs-12">
                <div class="form-group">
                  <label for="">@lang('modules.clients.clientCategory')</label>
                   <select class="select2 form-control" data-placeholder="@lang('modules.client.clientCategory')"  id="category" name="category_id">
                    <option value="">@lang('messages.pleaseSelectCategory')</option>
                    @forelse($categories as $category)
                    <option value="{{ $category->id }}">{{ ucwords($category->category_name) }}</option>
                       @empty
                        <option value="">@lang('messages.noCategoryAdded')</option>
                        @endforelse
                    </select>
                </div>
                </div>
                    <div class="col-xs-12 ">
                        <div class="form-group">
                            <label class="required"> @lang('modules.clients.subcategoryName')</label>
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
            {!! Form::open(['id'=>'updateProjectCategory','class'=>'ajax-form','method'=>'PUT']) !!}
            <div class="form-body">
                <div class="row">
                <div class="col-xs-12">
                <div class="form-group">
                  <label for="">@lang('modules.clients.clientCategory')</label>
                   <select class="select2 form-control" data-placeholder="@lang('modules.client.clientCategory')"  id="category_update" name="category_id">
                    <option value="">@lang('messages.pleaseSelectCategory')</option>
                    @forelse($categories as $category)
                    <option value="{{ $category->id }}">{{ ucwords($category->category_name) }}</option>
                       @empty
                        <option value="">@lang('messages.noCategoryAdded')</option>
                        @endforelse
                    </select>
                </div>
                </div>
                    <div class="col-xs-12 ">
                        <div class="form-group">
                            <label class="required"> @lang('modules.clients.subcategoryName')</label>
                            <input type="hidden" name="sub_category_id_update" id="sub_category_id_update">
                            <input type="text" name="category_name" id="category_name_update" class="form-control">
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
        $("#sub_category_id_update").val($(this).data('cat-id'))
        $("#category_name_update").val($(this).data('cat-name'))
        $("#category_update").val($(this).data('client-cat-id')).change()
        $('#update-section').show()
    })

    // $('#updateeProjectCategory').on('submit', (e) => {
    //     e.preventDefault();
    //     var id = $("#sub_category_id_update").val();
    //     var url = "{{route('admin.spvSubCategory.update', ':id')}}";
    //     url = url.replace(':id', id);
    //     console.error(url)
    //     $.easyAjax({
    //         url: url,
    //         container: '#updateeProjectCategory',
    //         type: "POST",
    //         data: $('#updateProjectCategory').serialize(),
    //         success: function (response) {
    //                 if(response.status == 'success'){
    //                     var options = [];
    //                     var rData = [];
    //                     let listData = "";
    //                     rData = response.data;
    //                     $.each(rData, function (index, value) {
    //                         var selectData = '';
    //                         selectData = '<option value="' + value.id + '">' + value.category_name + '</option>';
    //                         options.push(selectData);
    //                         listData += '<tr id="cat-' + value.id + '">'+
    //                             '<td>'+(index+1)+'</td>'+
    //                             '<td>' + value.category_name + '</td>'+
    //                             '<td>' + value.spv_category.category_name + '</td>'+
    //                             '<td><a href="javascript:;" data-client-cat-id="' + value.spv_category.id + '" data-cat-name="' + value.category_name + '" data-cat-id="' + value.id + '" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a> <a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>'+
    //                             '</tr>';
    //                     });

    //                     $('.category-table tbody' ).html(listData);

    //                     //  if(category_id == category ){
    //                     //     getCategory(category);
    //                     //  }
    //                     // $('#sub_category_id').selectpicker('refresh');
    //                     $('#sub_category_id').html(options);
    //                     $('#category_name').val('');
    //                 }
    //         }
    //     })
    // });


    $('body').on('click', '.delete-category', function(e) {
        var id = $(this).data('cat-id');

        var url = "{{ route('admin.spvSubCategory.destroy',':id') }}";
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

                    $('#sub_category_id').html(options);
                    // $('#sub_category_id').selectpicker('refresh');
                }
            }
        });
        e.preventDefault();
    });

    $('#createProjectCategory').on('submit', (e) => {
        e.preventDefault();
         let category_id = $('#category_id').val();    //id of create client category field
         let category = $('#category').val();      // id of modal category drop down

        $.easyAjax({
            url: '{{route('admin.spvSubCategory.store')}}',
            container: '#createProjectCategory',
            type: "POST",
            data: $('#createProjectCategory').serialize(),
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
                                '<td>' + value.spv_category.category_name + '</td>'+
                                '<td><a href="javascript:;" data-client-cat-id="' + value.spv_category.id + '" data-cat-name="' + value.category_name + '" data-cat-id="' + value.id + '" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a> <a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>'+
                                '</tr>';
                        });

                        $('.category-table tbody' ).html(listData);

                         if(category_id == category ){
                            getCategory(category);
                         }
                        // $('#sub_category_id').selectpicker('refresh');
                        $('#sub_category_id').html(options);
                        $('#category_name').val('');
                    }
            }
        })
    });
    $('#updateProjectCategory').on('submit', (e) => {
        e.preventDefault();
         let category_id = $('#category_id').val();    //id of create client category field
         let category = $('#category').val();      // id of modal category drop down
         var id = $("#sub_category_id_update").val();
        var url = "{{route('admin.spvSubCategory.update', ':id')}}";
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
                                '<td>' + value.spv_category.category_name + '</td>'+
                                '<td><a href="javascript:;" data-client-cat-id="' + value.spv_category.id + '" data-cat-name="' + value.category_name + '" data-cat-id="' + value.id + '" class="btn btn-sm btn-warning btn-rounded modify-category">@lang("app.modify")</a> <a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>'+
                                '</tr>';
                        });

                        $('.category-table tbody' ).html(listData);

                         if(category_id == category ){
                            getCategory(category);
                         }
                        // $('#sub_category_id').selectpicker('refresh');
                        $('#sub_category_id').html(options);
                        $('#category_name').val('');
                        $('create-section').show()
                        $('update-section').hide()
                    }
            }
        })
    });

</script>