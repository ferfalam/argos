@if ($row->cs_user_id == auth()->user()->id)
<div class="row" style="display: -webkit-box">
    <div class="col-xs-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">

                <div class="col-md-1 col-xs-2">
                    <img src="{{ $row->image_url }}" alt="user" class="img-circle" width="40" height="40">

                </div>
                <div class="col-md-8 col-xs-6">
                    {{ ucwords($row->name) }} <br>
                    <span class="font-light">{{ ucfirst($row->designation_name) }}</span>
                </div>
                <div class="col-md-3 col-xs-4">
                    @if(!is_null($row->clock_in_time))
                        <label class="label label-success"><i class="fa fa-check"></i> @lang('modules.attendance.present')</label>
                        {{-- <button type="button" title="Attendance Detail" class="btn btn-info btn-sm btn-rounded" onclick="attendanceDetail('{{ $row->id }}', '{{ \Carbon\Carbon::createFromFormat('Y-m-d', $row->atte_date)->timezone($global->timezone)->format('Y-m-d')   }}')">
                            <i class="fa fa-search"></i> Detail
                        </button> --}}
                    @else
                        <label class="label label-danger"><i class="fa fa-exclamation-circle"></i> @lang('modules.attendance.absent')</label>
                    @endif

                </div>
                <div class="clearfix"></div>

            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <div class="row" style="display: -webkit-box;">
                        @if($row->total_clock_in < $maxAttandenceInDay)
                        {!! Form::open(['id'=>'attendance-container-'.$row->id,'class'=>'ajax-form','method'=>'POST']) !!}
                        <div class="form-body ">
                            <div class="row" style="display: -webkit-box;">

                                <div class="col-md-4">
                                    <div class="input-group bootstrap-timepicker timepicker">
                                        <label>Heure d'arrivée</label>
                                        <input type="text" name="clock_in_time"
                                               class="form-control a-timepicker"   autocomplete="off"   id="clock-in-{{ $row->id }}"
                                               @if(!is_null($row->clock_in_time)) value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->clock_in_time)->timezone($global->timezone)->format($global->time_format) }}" @endif>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Adresse IP</label>
                                        <input type="text" name="clock_in_ip" id="clock-in-ip-{{ $row->id }}"
                                               class="form-control" value="{{ $row->clock_in_ip ?? request()->ip() }}" disabled>
                                    </div>
                                </div>

                                @if($row->total_clock_in == 0)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" >Lieu de travail</label>
                                            <div class="switchery-demo d-flex align-items-center">
                                                <select name="workplace" id="workplace"
                                                    class="form-control select2 mr-2">
                                                    <option value="Lieu de travail" disabled></option>
                                                    @foreach ($tla as $a)
                                                        @if ($a->type == 'workplace')
                                                            <option value="{{ $a->name }}">{{ $a->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <a href="javascript:;" class="text-info plus-form">
                                                    <img src="{{ asset('img/plus.png') }}" alt="" data-type="workplace">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <div class="row m-t-15">

                                <div class="col-md-4">
                                    <div class="input-group bootstrap-timepicker timepicker">
                                        <label>Heure de départ</label>
                                        <input type="text" name="clock_out_time" id="clock-out-{{ $row->id }}"
                                               class="form-control b-timepicker"   autocomplete="off"
                                               @if(!is_null($row->clock_out_time)) value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->clock_out_time)->timezone($global->timezone)->format($global->time_format) }}" @endif>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Adresse IP</label>
                                        <input type="text" name="clock_out_ip" id="clock-out-ip-{{ $row->id }}"
                                               class="form-control" value="{{ $row->clock_out_ip ?? request()->ip() }}" disabled>
                                    </div>
                                </div>

                                {{-- @if($row->total_clock_in == 0)
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label" >@lang('modules.attendance.halfDay')</label>
                                                <div class="switchery-demo">
                                                    <input type="checkbox"  @if($row->half_day == "yes") checked @endif class="js-switch change-module-setting" data-color="#ed4040" id="halfday-{{ $row->id }}"  />
                                                </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">@lang('modules.attendance.working_from')</label>
                                        <input type="text" name="working_from" id="working-from-{{ $row->id }}"
                                               class="form-control" value="{{ $row->working_from ?? 'office' }}">
                                    </div>
                                </div> --}}
                                <div class="clearfix"></div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success text-white save-attendance"
                                                data-user-id="{{ $row->id }}"><i
                                                    class="fa fa-check"></i> @lang('app.save')</button>
                                    </div>
                                </div>


                            </div>

                        </div>
                        {!! Form::close() !!}
                        @else
                            <div class="col-xs-12">
                                <div class="alert alert-info">@lang('modules.attendance.maxColckIn')</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script>
    $(".select2").select2({
        formatNoMatches: function () {
            return "{{ __('messages.noRecordFound') }}";
        }
    });
    $('.plus-form').click(function () {
        let target = $(event.target)[0];
        const field = $('#' + target.dataset.type)
        const url = '{{ route('admin.tla.create') }}/' + target.dataset.type;
        $('#modelHeading').html('...');
        $.ajaxModal('#attendancesDetailsModal', url);
    })
</script>
@endif