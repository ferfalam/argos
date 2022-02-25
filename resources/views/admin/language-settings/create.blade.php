<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">@lang('modules.clients.clientSubCategory')</h4>
</div>
  

<div class="modal-body">
    <div class="portlet-body">
        <div class="table-responsive">
            <table class="table language-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('app.language') @lang('app.name')</th>
                    <th>@lang('app.language_code')</th>
                    <th>@lang('app.status')</th>
                    <th class="text-nowrap">@lang('app.action')</th>
                </thead>
                <tbody>
                
                @forelse($languages as  $key=>$language)
                    <tr id="languageRow{{ $language->id }}">
                        <td>{{ $key+1 }}</td>
                        <td>{{ ucwords($language->language_name) }}</td>
                        <td>{{ strtoupper($language->language_code) }}</td>
                        <td>
                            <div class="switchery-demo">
                               @if($language->status == 'enabled')
                                    <label class="label label-success">{{ __('app.enable') }}</label> 
                                @else
                                    <label class="label label-success"> {{__('app.disable') }}</label> 
                               @endif
                                {{-- <input type="checkbox" @if ($language->status == 'enabled') checked
                                @endif class="js-switch change-language-setting"
                                data-color="#99d683"
                                data-setting-id="{{ $language->id }}"/> --}}
                            </div>
                        </td>
                        <td class="text-nowrap ">
                            <a href="javascript:;" class="btn btn-danger delete-language btn-circle sa-params"
                                data-toggle="tooltip" data-language-id="{{ $language->id }}"
                                data-original-title="Delete"><i class="fa fa-times"
                                    aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">@lang('messages.noSubCategoryAdded')</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {!! Form::open(['id' => 'createCurrency', 'route'=>'admin.language-settings.store' , 'class' => 'ajax-form', 'method' => 'POST' ]) !!}
        <div class="form-group">
            <label for="language_name">@lang('app.language') @lang('app.name')</label>
            <input type="text" class="form-control" id="language_name" name="language_name"
                placeholder="Enter Language Name">
        </div>
        <div class="form-group">
            <label for="language_code">@lang('app.language_code')</label>
            <input type="text" class="form-control" id="language_code" name="language_code"
                placeholder="Enter Language Code">
        </div>
        <div class="form-group ">
            <label for="usd_price">@lang('app.status') </label>
            <select class="form-control" name="status">
                <option value="enabled">@lang('app.enable')</option>
                <option value="disabled">@lang('app.disable')</option>
            </select>
        </div>

        <button type="submit" id="save-form" class="btn btn-success waves-effect waves-light m-r-10">
            @lang('app.save')
        </button>
        <button type="reset" class="btn btn-inverse waves-effect waves-light">@lang('app.reset')</button>
        {!! Form::close() !!}
    </div>
</div>

    <script>
    
    //delete language
    $(document).on('click', '.delete-language', function(e) {
        var id = $(this).attr('data-language-id');
        var url = "{{ route('admin.language-settings.destroy',':id') }}";
        url = url.replace(':id', id);

        var token = "{{ csrf_token() }}";

        $.easyAjax({
            type: 'POST',
            url: url,
            data: {'_token': token, '_method': 'DELETE'},
            success: function (response){
                if (response.status == "success") {
                    $.unblockUI();
                    $('#languageRow'+id).fadeOut();
                    var options = [];
                    var rData = [];
                    rData = response.data;
                    $.each(rData, function( index, value ) {
                        var selectData = '';
                        if(value.status == 'enabled')
                        {
                            selectData = '<option value="' + value.language_code + '">' + value.language_name+ '</option>';
                            options.push(selectData);
                        }
                    });

                    $('#language').html(options);
                }
            }
        });
        e.preventDefault();
    });


        // store language
        $('#createCurrency').on('submit', (e) => {
            e.preventDefault();
            $.easyAjax({
                url: '{{ route('admin.language-settings.store') }}',
                container: '#createCurrency',
                type: "POST",
                data: $('#createCurrency').serialize(),
                success: function (response) {
                    if(response.status == 'success'){
                        var options = [];
                        var rData = [];
                        let listData = "";
                        rData = response.data;
                        $.each(rData, function (index, value) {
                            var selectData = '';
                            if(value.status == 'enabled')
                            {
                                selectData = '<option value="' + value.language_code + '">' + value.language_name+ '</option>';
                                options.push(selectData);
                            }

                            if(value.status == 'enabled')
                            {
                                chkselect = ' <label class="label label-success">{{ __('app.enable') }}</label> '; 
                            }else{
                                chkselect =' <label class="label label-success"> {{__('app.disable') }}</label>';
                            }

                            listData += '<tr id="languageRow' + value.id + '">'+
                                '<td>'+(index+1)+'</td>'+
                                '<td>' + value.language_name + '</td>'+
                                '<td>' + value.language_code + '</td>'+
                                '<td> <div class="switchery-demo"> '+chkselect+'  </div> </td>'+
                                '<td><a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">@lang("app.remove")</a></td>'+
                                '</tr>';
                        });

                        $('.language-table tbody' ).html(listData);

                        // $('#language').selectpicker('refresh');
                        $('#language').html(options);
                        // $('#category_name').val('');
                    }
            }
            })
        });
    </script>

