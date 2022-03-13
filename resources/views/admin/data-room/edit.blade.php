<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">@lang('modules.dataRoom.title')</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">

        {!! Form::open(['id' => 'createDataRoom', 'class' => 'ajax-form', 'method' => 'PUT']) !!}
        <div class="form-body">
            <input type="hidden" name="file_id" value="{{ $doc->file_id }}">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label>@lang('modules.projects.projectName')</label>
                        <input type="text" name="" id="project_name" class="form-control"
                            value="{{ $doc->project_name }}" disabled>
                        <input type="hidden" name="project_name" id="project_name" class="form-control"
                            value="{{ $doc->project_name }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label>@lang('modules.gantt.task_name')</label>
                        <input type="text" name="" id="task_name" class="form-control" value="{{ $doc->task_name }}"
                            disabled>
                        <input type="hidden" name="task_name" id="task_name" class="form-control"
                            value="{{ $doc->task_name }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label>@lang('modules.dataRoom.docName')</label>
                        <input type="text" name="doc_name" id="doc_name" class="form-control"
                            value="{{ $doc->doc_name }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label class="control-label">@lang('modules.espace.title')</label>
                        <div class="switchery-demo d-flex align-items-center">
                            <select name="espace_id" id="espace_id" class="form-control select2 mr-2">
                                <option value="Espace" disabled></option>
                                @foreach ($espaces as $espace)
                                    <option value="{{ $espace->id }}"
                                        @if ($doc->espace_id == $espace->id) selected @endif>{{ $espace->espace_name }}
                                    </option>
                                @endforeach
                            </select>
                            <a href="javascript:;" class="text-info" id="add-espace">
                                <img src="{{ asset('img/plus.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label>@lang('app.publication')</label>
                        <div class="d-flex" style="margin-right: 40px; gap:20px">
                            <div class="form-group mb-0">
                                <input type="radio" name="publish" id="publish" value="1"
                                    @if ($doc->publish) checked @endif>@lang('app.yes')
                            </div>
                            <div class="form-group mb-0">
                                <input type="radio" name="publish" id="publish" value="0"
                                    @if (!$doc->publish) checked @endif>@lang('app.no')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row @if ($doc->visible_by != 'all') d-none @endif" id="visibility-section">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label class="control-label">@lang('app.visibility')</label>
                        <div class="switchery-demo d-flex align-items-center">
                            <select name="visible_by[]" id="visible_by" class="select2 mr-2 select2-multiple "
                                data-placeholder="Visible par" multiple="multiple">
                                @foreach ($employees as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                                @foreach ($admins as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <input type="checkbox" name="all" id="all">
                        <label class="" for="all"
                            @if ($doc->visible_by != 'all') checked @endif>@lang('app.allUsers')</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" id="save-category" class="btn btn-success"> <i class="fa fa-check"></i>
                @lang('app.save')</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>


<script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>

<script>
    $("#all").change(function(event) {
        if (event.target.checked) {
            $("#visibility-section").hide()
        } else {
            $("#visibility-section").show()
        }
    })

    $("#espace_id").select2({
        formatNoMatches: function() {
            return "{{ __('messages.noRecordFound') }}";
        }
    });
    $("#visible_by").select2({
        formatNoMatches: function() {
            return "{{ __('messages.noRecordFound') }}";
        }
    });


    $('#createDataRoom').on('click', '#add-espace', function() {
        var url = '{{ route('admin.espace.create') }}';
        $('#modelHeading').html('Manage Espace');
        $.ajaxModal('#espaceModal', url);
        $('#dataRoomModal').modal('toggle');
    })

    $('#createDataRoom').on('submit', (e) => {
        e.preventDefault();
        $.easyAjax({
            url: '{{ route('admin.dataRoom.update', $doc->id) }}',
            container: '#createDataRoom',
            type: "POST",
            data: $('#createDataRoom').serialize(),
            success: function(response) {
                if (response.status == 'success') {
                    window.location.reload()
                }
            }
        })
    });
</script>
