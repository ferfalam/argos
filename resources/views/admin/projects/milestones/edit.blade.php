
<link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">


<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title"><i class="fa fa-flag"></i> @lang('app.update') @lang('modules.projects.milestones')</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">
        <div class="row">
            <div class="col-xs-12">
                {!! Form::open(['id'=>'updateTime','class'=>'ajax-form','method'=>'PUT']) !!}
                <div class="form-body">
                        <div class="row">
                                <div class="col-xs-12">

                                    {!! Form::hidden('project_id', $milestone->project_id) !!}
                                    <input type="hidden" name="currency_id" id="currency_id" value="{{ $milestone->currency_id }}">

                                    <div class="form-body">
                                        <div class="row">
                                            
                                            <div class="col-md-8 ">
                                                <div class="form-group">
                                                    <label class="required" >@lang('modules.projects.milestoneTitle')</label>
                                                    <input id="milestone_title" name="milestone_title" type="text"
                                                class="form-control" value="{{ $milestone->milestone_title }}">
                                                </div>
                                            </div>
                                            
                                            </div>
                                            <div class="row">
                                            <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label>@lang('app.status')</label>
                                                        <select name="status" id="status" class="form-control">
                                                            <option 
                                                            @if($milestone->status == 'incomplete') selected @endif
                                                            value="incomplete">@lang('app.incomplete')</option>
                                                            <option 
                                                            @if($milestone->status == 'complete') selected @endif
                                                            value="complete">@lang('app.complete')</option>
                                                        </select>
                                                    </div>
                                            </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-check-label required" for="">@lang('app.milestone_type')</label>
                                                            <input class="form-check-input" required style="min-height:0px !important" type="radio" id="none" name="milestone_type" @if ($milestone->type =='None') checked @endif value="None">
                                                            <label class="form-check-label"  for="none">None</label>
                                                            <input class="form-check-input" required style="min-height:0px !important" type="radio" id="research" name="milestone_type" @if ($milestone->type =='Research') checked @endif value="Research">
                                                            <label class="form-check-label" for="research">Research</label>
                                                            <input class="form-check-input" required style="min-height:0px !important" type="radio" id="development" name="milestone_type" @if ($milestone->type =='Development') checked @endif value="Development">
                                                            <label class="form-check-label" for="development">Development</label>
                                                            <input class="form-check-input" required style="min-height:0px !important" type="radio" id="construction" name="milestone_type" @if ($milestone->type =='Construction') checked @endif value="Construction">
                                                            <label class="form-check-label" for="construction">Construction</label>
                                                            <input class="form-check-input" required style="min-height:0px !important" type="radio" id="exploitation" name="milestone_type" @if ($milestone->type =='Exploitation') checked @endif value="Exploitation">
                                                            <label class="form-check-label" for="exploitation">Exploitation</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>@lang('modules.projects.milestoneCost')</label>
                                                    <input id="cost" name="cost" type="number" value="{{ $milestone->cost }}"
                                                           class="form-control" value="0" min="0" step=".01">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>@lang('app.deadline')</label>
                                                    <input type="text" class="form-control" name="due_date" id="due_date_edit"
                                                    value=" @if($milestone->due_date != null) {{$milestone->due_date->format($global->date_format) }}  @endif">


                                                </div>
                                            </div>
                                            
                                        </div>
                                        

                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="required" for="memo">@lang('modules.projects.milestoneSummary')</label>
                                                    <textarea name="summary" id="" rows="4" class="form-control">{{ $milestone->summary }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                

                                    <hr>
                                </div>
                            </div>
                </div>
                <div class="form-actions m-t-30">
                    <button type="button" id="update-form" class="btn btn-success"><i class="fa fa-check"></i> Save
                    </button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>

    </div>
</div>

<script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script>
  jQuery('#due_date_edit').datepicker({
        autoclose: true,
        todayHighlight: true,
        weekStart:'{{ $global->week_start }}',
        format: '{{ $global->date_picker_format }}',
    });

    $('#update-form').click(function () {
        $.easyAjax({
            url: '{{route('admin.milestones.update', $milestone->id)}}',
            container: '#updateTime',
            type: "POST",
            data: $('#updateTime').serialize(),
            success: function (response) {
                $('#editTimeLogModal').modal('hide');
                table._fnDraw();
            }
        })
    });
</script>