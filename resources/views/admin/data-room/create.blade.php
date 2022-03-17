<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">@lang('modules.dataRoom.title')</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">

        {!! Form::open(['id'=>'createDataRoom','class'=>'ajax-form','method'=>'POST']) !!}
        <div class="form-body">
            <input type="hidden" name="file_id" value="{{$file_id}}">
            <input type="hidden" name="type" value="{{$type}}">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label>@lang('modules.projects.projectName')</label>
                        <input type="text" name="" id="project_name" class="form-control" value="{{$project_name}}" disabled>
                        <input type="hidden" name="project_name" id="project_name" class="form-control" value="{{$project_name}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label>@lang('modules.gantt.task_name')</label>
                        <input type="text" name="" id="task_name" class="form-control" value="{{$task_name}}" disabled>
                        <input type="hidden" name="task_name" id="task_name" class="form-control" value="{{$task_name}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label>@lang('modules.dataRoom.docName')</label>
                        <input type="text" name="doc_name" id="doc_name" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label class="control-label" >@lang('modules.espace.title')</label>
                        <div class="switchery-demo d-flex align-items-center">
                            <select name="espace_id" id="espace_id"
                                class="form-control select2 mr-2">
                                <option value="Espace" disabled></option>
                                @foreach ($espaces as $espace)
                                <option value="{{$espace->id}}">{{strtoupper($espace->espace_name)}}</option>
                                @endforeach
                            </select>
                            <a href="javascript:;" class="text-info" id="add-espace">
                                <img src="{{ asset('img/plus.png') }}" alt="">
                            </a>
                        </div>
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


<script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>

<script>
    $("#espace_id").select2({
        formatNoMatches: function () {
            return "{{ __('messages.noRecordFound') }}";
        }
    });

    
    $('#createDataRoom').on('click', '#add-espace', function () {
        var url = '{{ route('admin.espace.create')}}';
        $('#modelHeading').html('Manage Espace');
        $.ajaxModal('#espaceModal', url);
        //$('#dataRoomModal').modal('hide');
    })

    $('#createDataRoom').on('submit', (e) => {
        e.preventDefault();
        $.easyAjax({
            url: '{{route('admin.dataRoom.store')}}',
            container: '#createDataRoom',
            type: "POST",
            data: $('#createDataRoom').serialize(),
            success: function (response) {
                if (response.status == 'success') {
                    window.location.reload()
                }
            }
        })
    });
</script>