@extends('layouts.client-app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">  {{ __($pageTitle) }} #{{ $project->id }} - <span class="font-bold">{{ ucwords($project->project_name) }}</span></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-6 col-sm-8 col-md-8 col-xs-12 text-right">
            @php
            if ($project->status == 'in progress') {
                $statusText = __('app.inProgress');
                $statusTextColor = 'text-info';
                $btnTextColor = 'label-info';
            } else if ($project->status == 'on hold') {
                $statusText = __('app.onHold');
                $statusTextColor = 'text-warning';
                $btnTextColor = 'label-warning';
            } else if ($project->status == 'not started') {
                $statusText = __('app.notStarted');
                $statusTextColor = 'text-warning';
                $btnTextColor = 'label-warning';
            } else if ($project->status == 'canceled') {
                $statusText = __('app.canceled');
                $statusTextColor = 'text-danger';
                $btnTextColor = 'label-danger';
            } else if ($project->status == 'finished') {
                $statusText = __('app.finished');
                $statusTextColor = 'text-success';
                $btnTextColor = 'label-success';
            }else if($project->status == 'under review'){
                $statusText = __('app.underReview');
                $statusTextColor = 'text-warning';
                $btnTextColor = 'label-warning';
            }
            @endphp

            <label class="label {{ $btnTextColor }}">{{ $statusText }}</label>

            <ol class="breadcrumb">
                <li><a href="{{ route('client.dashboard.index') }}">@lang('app.menu.home')</a></li>
                <li><a href="{{ route('client.projects.index') }}">{{ __($pageTitle) }}</a></li>
                <li class="active">@lang('app.project')</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
<link rel="stylesheet" href="{{ asset('plugins/bower_components/icheck/skins/all.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/multiselect/css/multi-select.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<style>
    #section-line-1 .col-in{
        padding:0 10px;
    }

    #section-line-1 .col-in h3{
        font-size: 15px;
    }

    .d-flex{
        display: flex;
        align-items: stretch;
    }

    .d-flex .panel{
        /* height: 100%; */
    }

</style>
@endpush

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('client.projects.show_project_menu')
        </div>
    </div>

    <div class="row " style="display: -webkit-box">
        <div class="col-xs-12">
            <x-panel-container>
                @php
                    if(!is_null($project->project_budget))
                        $count = !is_null($project->currency_id) ? $project->currency->currency_symbol.$project->project_budget : $project->project_budget;
                    else
                        $count = '--';
                @endphp
                <x-stat-card count="{{$count}}" img="card-1.png" title="modules.projects.projectBudget"></x-stat-card>
                <x-stat-card count="{{$hoursLogged}}" img="card-2.png" title="modules.projects.hoursLogged"></x-stat-card>
                <x-stat-card count="{{ !is_null($project->currency_id) ? currency_formatter($expenses,$project->currency->currency_symbol) : $expenses }}" img="card-3.png" title="modules.projects.expenses_total"></x-stat-card>
            </x-panel-container>
        </div>
    </div>

    <div class="row " style="display: -webkit-box">
        <div class="col-xs-12">
            <x-panel-container>
                <x-stat-card count="{{ count($openTasks) }}" img="card-1.png" title="modules.projects.openTasks"></x-stat-card>
                <x-stat-card count="{{ $daysLeft }}" img="card-2.png" title="modules.projects.daysLeft"></x-stat-card>
                <x-stat-card count="{{ $hoursLogged }}" img="card-3.png" title="modules.projects.hoursLogged"></x-stat-card>
            </x-panel-container>
        </div>
    </div>

    <div class="row d-flex">
        <div class="col-xs-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">@lang('modules.client.clientDetails') </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        @if(!is_null($project->client))
                        <dl>
                            @if(!is_null($project->client->client))
                            <dt>@lang('modules.client.companyName')</dt>
                            <dd class="m-b-10">{{ $project->client->client[0]->company_name }}</dd>
                            @endif

                            <dt>@lang('modules.client.clientName')</dt>
                            <dd class="m-b-10">{{ ucwords($project->client->name) }}</dd>

                            <dt>@lang('modules.client.clientEmail')</dt>
                            <dd class="m-b-10">{{ $project->client->email }}</dd>
                        </dl>
                        @else @lang('messages.noClientAddedToProject') @endif {{--Custom fields data--}} @if(isset($fields))
                        <dl>
                            @foreach($fields as $field)
                            <dt>{{ ucfirst($field->label) }}</dt>
                            <dd class="m-b-10">
                                @if( $field->type == 'text') {{$project->custom_fields_data['field_'.$field->id] ?? '-'}} @elseif($field->type == 'password')
                                {{$project->custom_fields_data['field_'.$field->id] ?? '-'}}
                                @elseif($field->type == 'number') {{$project->custom_fields_data['field_'.$field->id]
                                ?? '-'}} @elseif($field->type == 'textarea') {{$project->custom_fields_data['field_'.$field->id]
                                ?? '-'}} @elseif($field->type == 'radio') {{ !is_null($project->custom_fields_data['field_'.$field->id])
                                ? $project->custom_fields_data['field_'.$field->id] : '-' }}
                                @elseif($field->type == 'select') {{ (!is_null($project->custom_fields_data['field_'.$field->id])
                                && $project->custom_fields_data['field_'.$field->id] != '') ?
                                $field->values[$project->custom_fields_data['field_'.$field->id]]
                                : '-' }} @elseif($field->type == 'checkbox') 
                                <ul>
                                    @foreach($field->values as $key => $value)
                                        @if($project->custom_fields_data['field_'.$field->id] != '' && in_array($value ,explode(', ', $project->custom_fields_data['field_'.$field->id]))) <li>{{$value}}</li> @endif
                                    @endforeach
                                </ul> 
                                @elseif($field->type == 'date')
                                    {{ \Carbon\Carbon::parse($project->custom_fields_data['field_'.$field->id])->format($global->date_format)}}
                                @endif
                            </dd>
                            @endforeach
                        </dl>
                        @endif {{--custom fields data end--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">@lang('modules.projects.members')
                    <span class="label label-rouded label-custom pull-right">{{ count($project->members) }}</span>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        @forelse($project->members as $member)
                            <img src="{{ asset($member->user->image_url) }}"
                            data-toggle="tooltip" data-original-title="{{ ucwords($member->user->name) }}"

                            alt="user" class="img-circle" width="25" height="25" height="25" height="25">
                        @empty
                            @lang('messages.noMemberAddedToProject')
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">@lang('app.project') @lang('app.details')</div>
                <div class="panel-body">
                    {!! $project->project_summary !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex">
        @if(in_array('timelogs',$modules))
        <div class="col-xs-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">@lang('modules.projects.activeTimers')</div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body" id="timer-list">

                        @forelse($activeTimers as $key=>$time)
                        <div class="row m-b-10">
                            <div class="col-xs-12 m-b-5">
                                {{ ucwords($time->user->name) }}
                            </div>
                            <div class="col-xs-12 font-12">
                                {{ $time->duration }}
                            </div>

                        </div>

                        @empty
                            @lang('messages.noActiveTimer')
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        @endif

         <div class="col-xs-12"  id="project-timeline">
            <div class="panel panel-inverse">
                <div class="panel-heading">@lang('modules.projects.activityTimeline')</div>

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="steamline">
                            @foreach($activities as $activ)
                            <div class="sl-item">
                                <div class="sl-left"><i class="fa fa-circle text-info"></i>
                                </div>
                                <div class="sl-right">
                                    <div>
                                        <h6>{{ $activ->activity }}</h6> <span class="sl-date">{{ $activ->created_at->diffForHumans() }}</span></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('footer-script')
<script src="{{ asset('js/cbpFWTabs.js') }}"></script>
<script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/multiselect/js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
//    (function () {
//
//        [].slice.call(document.querySelectorAll('.sttabs')).forEach(function (el) {
//            new CBPFWTabs(el);
//        });
//
//    })();

    // $('#timer-list').on('click', '.stop-timer', function () {
    //    var id = $(this).data('time-id');
    //     var url = '{{route('admin.time-logs.stopTimer', ':id')}}';
    //     url = url.replace(':id', id);
    //     var token = '{{ csrf_token() }}'
    //     $.easyAjax({
    //         url: url,
    //         type: "POST",
    //         data: {timeId: id, _token: token},
    //         success: function (data) {
    //             $('#timer-list').html(data.html);
    //         }
    //     })

    // });
    $('ul.showProjectTabs .projects').addClass('tab-current');

</script>
@endpush
