<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">
        @if($type=="city")
            @lang("app.cp")
        @elseif($type=="qualification")
            @lang('app.qualification')
        @elseif($type=="legal_form")
            @lang('app.legalForm')
        @elseif($type=="activity_sector")
            Secteur d'activité
        @elseif($type=="tva_intrat")
            N°TVA intrat
        @endif
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
                            @if($type=="city")
                                @lang("app.cp")
                            @elseif($type=="qualification")
                                @lang('app.qualification')
                            @elseif($type=="legal_form")
                                @lang('app.legalForm')
                            @elseif($type=="activity_sector")
                                Secteur d'activité
                            @elseif($type=="tva_intrat")
                                N°TVA intrat
                            @endif
                        </th>
                        <th>@lang('app.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($tla as $key=>$t)
                        <tr id="cat-{{ $t->id }}">
                            <td>{{ $key+1 }}</td>
                            <td>{{ ucwords($t->name) }}</td>
                            <td><a href="javascript:;" data-cat-id="{{ $t->id }}" class="btn btn-sm btn-danger btn-rounded delete-category" onclick="deleteOption({{ $t->id }})">@lang("app.remove")</a></td>
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
                            @if($type=="city")
                                @lang("app.cp")
                            @elseif($type=="qualification")
                                @lang('app.qualification')
                            @elseif($type=="legal_form")
                                @lang('app.legalForm')
                            @elseif($type=="activity_sector")
                                Secteur d'activité
                            @elseif($type=="tva_intrat")
                                N°TVA intrat
                            @endif
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
    </div>
</div>

<script>
    function deleteOption(id) {
        let url = "{{ route('super-admin.tla.destroy',':id') }}";
        url = url.replace(':id', id);
        $.easyAjax({
            type: 'POST',
            url: url,
            data: {'_token': "{{ csrf_token() }}", '_method': 'DELETE'},
            success: function (response) {
                if (response.status == "success") {
                    // $.unblockUI();
                    $('#cat-'+id).fadeOut();
                    $("#{{$type}} option[value=\"" + response.tla.name + "\"]").remove();
                }
            }
        });
    }

    $('#createOption').on('submit', (e) => {
        e.preventDefault();
        $.easyAjax({
            url: "{{ route('super-admin.tla.store') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                name: $('#option_name').val(),
                type: {{$type}}.id
            },
            success: function(response) {
                if (response.status === 'success') {
                    let pos = $('.category-table tbody').children().length + 1;
                    $('.category-table tbody' ).append(
                        '<tr id="cat-' + response.tla.id + '">'+
                        '<td>'+ pos +'</td>'+
                        '<td>' + response.tla.name + '</td>'+
                        '<td><a href="javascript:;" data-cat-id="' + response.tla.id + '" class="btn btn-sm btn-danger btn-rounded delete-category" onclick="deleteOption(' + response.tla.id + ')">@lang("app.remove")</a></td>'+
                        '</tr>'
                    );
                    $('#{{$type}}').append('<option value="' + response.tla.name + '">' + response.tla.name + '</option>');
                    $('#option_name').val("") ;
                }
            }
        });
    });
</script>