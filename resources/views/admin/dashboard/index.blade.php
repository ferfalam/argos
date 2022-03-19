@extends('layouts.app')

@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/calendar/dist/fullcalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/morrisjs/morris.css') }}"><!--Owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/owl.carousel/owl.carousel.min.css') }}"><!--Owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/owl.carousel/owl.theme.default.css') }}"><!--Owl carousel CSS -->
    <style>
      .main_page_responsive{
        padding: 0px !important;
        padding-left: 0px !important;
        padding-right: 0px !important;
        padding-top: 0px !important;
        padding-bottom: 0px !important;
      }

      .dashboard-stats{
        background: white !important;
      }

      .row img{
        width: 72px;
        height: 72px;
      }

      .panel-height-max{
          max-height: 600px;
          overflow-y: auto;
      }

      .list-task .list-group-item, .list-task .list-group-item:first-child{
          display: flex;
      }

      .panel-default {
        border: 1px solid #ddd !important;
      }

      .main{
        background-color: #F2F2F2 !important;
      }

      .panel-body-info h2{
        font-family: "Roboto", sans-serif ;
        font-weight: 500;
      }

      .steamline .sl-left .img-circle{
          width: 40px !important;
          height: 40px !important;
      }

      .d-flex{
          display: flex;
          align-items: stretch;
          /* margin-bottom: 24px; */
      }

      .d-flex .panel {
          height: 100%;
      }
    </style>
@endpush

@section('page-title')
<x-main-header>
    <div class="">
        <h1 class="heading-1">@lang('app.welcome'){{\Illuminate\Support\Facades\Auth::user()->name}} !</h1>
        <p class="color-danger">{{__($pageTitle)}}</p>
    </div>

    @if(session('impersonate'))
    <x-slot name="btns">
        <a class="btn b-all waves-effect waves-light pull-right" data-toggle="tooltip" data-original-title="{{__('messages.stopImpersonation')}}" data-placement="left" href="{{route('admin.impersonate.stop')}}" >
            <i class="fa fa-stop fa-blink text-danger"></i>
        </a>
    </x-slot>
    @endif
</x-main-header>
@endsection



@section('content')

    <div class="panel-container">
        @if(in_array('projects',$modules)  && in_array('total_projects',$activeWidgets))
        <div class="panel panel-default">
            <div class="panel-body">
                <img src="{{asset('img/card-1.png')}}" alt="" />
                <div class="panel-body-info">
                    <h2>{{ $counts->totalProjects }}</h2>
                    <a href="{{ route('admin.projects.index') }}">
                        <p class="color-dark">@lang('modules.dashboard.totalProjects')</p>
                    </a>
                </div>
            </div>
        </div>
        @endif

        @if(in_array('clients',$modules)  && in_array('total_clients',$activeWidgets))
        <div class="panel panel-default">
            <div class="panel-body">
                <img src="{{asset('img/card-2.png')}}" alt="" />
                <div class="panel-body-info">
                    <h2>{{ $counts->totalClients }}</h2>
                    <a href="{{ route('admin.clients.index') }}">
                        <p class="color-dark">@lang('modules.dashboard.totalClients')</p>
                    </a>
                </div>
            </div>
        </div>
        @endif

        @if(in_array('tasks',$modules)  && in_array('total_pending_tasks',$activeWidgets))
        <div class="panel panel-default">
            <div class="panel-body">
                <img src="{{asset('img/card-3.png')}}" alt="" />
                <div class="panel-body-info">
                    <h2>{{ $counts->totalPendingTasks }}</h2>
                    <a href="{{ route('admin.all-tasks.index') }}">
                        <p class="color-dark">@lang('modules.dashboard.totalPendingTasks')</p>
                    </a>
                </div>
            </div>
        </div>
        @endif

        @if(in_array('employees',$modules)  && in_array('total_employees',$activeWidgets))
        <div class="panel panel-default">
            <div class="panel-body">
                <img src="{{asset('img/card-4.png')}}" alt="" />
                <div class="panel-body-info">
                    <h2>{{ $counts->totalEmployees }}</h2>
                    <a href="{{ route('admin.employees.index') }}">
                        <p class="color-dark">@lang('modules.dashboard.totalEmployees')</p>
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="row bg-light">
        @if(session('impersonate'))
        <div class="col-md-12">
            <div class="alert alert-danger">
                {{__('messages.impersonate')}} {{$company->company_name}}
            </div>
        </div>
         @endif
            @if($global->status == 'license_expired')

            <div class="col-md-12 alert alert-danger ">
                    <div class="col-md-6">
                        <h5 class="text-white">{{ $superadmin->expired_message }}</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{route('admin.billing')}}" class="btn btn-success">{{ __('app.menu.billing') }}
                            <i class="fa fa-shopping-cart"></i></a>
                    </div>
                </div>
            @endif
            
            @if($company->package->default == 'yes' || $company->package->default == 'trial')
                @if($packageSetting && !$packageSetting->all_packages)
                    <div class="col-md-12 alert alert-danger ">
                        <div class="col-md-6">
                            <h5 class="text-white">@lang('messages.purchasePackageMessage')</h5>
                        </div>
                        <div class="col-md-12 text-right">
                            <a href="{{route('admin.billing')}}"
                                class="btn btn-success">{{ __('app.menu.billing') }}
                                <i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                @endif
            @endif
    </div>
    <!-- .row -->

    <div class="row d-flex">
        @if(in_array('leaves',$modules)  && in_array('settings_leaves',$activeWidgets))
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">@lang('app.menu.leaves')</div>
                <div class="panel-wrapper collapse in" style="overflow: auto">
                    <div class="panel-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
        @endif

            {{--            @if(in_array('tickets',$modules)  && in_array('new_tickets',$activeWidgets))--}}
            {{--            <div class="col-md-6">--}}
            {{--                <div class="panel panel-inverse">--}}
            {{--                    <div class="panel-heading">@lang('modules.dashboard.newTickets')</div>--}}
            {{--                    <div class="panel-wrapper collapse in">--}}
            {{--                        <div class="panel-body">--}}
            {{--                            <ul class="list-task list-group" data-role="tasklist">--}}
            {{--                                @forelse($newTickets as $key=>$newTicket)--}}
            {{--                                    <li class="list-group-item" data-role="task">--}}
            {{--                                        {{ ($key+1) }}. <a href="{{ route('admin.tickets.edit', $newTicket->id) }}" class="text-danger"> {{  ucfirst($newTicket->subject) }}</a> <i>{{ ucwords($newTicket->created_at->diffForHumans()) }}</i>--}}
            {{--                                    </li>--}}
            {{--                                @empty--}}
            {{--                                    <li class="list-group-item" data-role="task">--}}
            {{--                                        <div class="text-center">--}}
            {{--                                            <div class="empty-space" style="height: 200px;">--}}
            {{--                                                <div class="empty-space-inner">--}}
            {{--                                                    <div class="icon" style="font-size:20px"><i--}}
            {{--                                                                class="ti-ticket"></i>--}}
            {{--                                                    </div>--}}
            {{--                                                    <div class="title m-b-15">@lang("messages.noTicketFound")--}}
            {{--                                                    </div>--}}

            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </li>--}}
            {{--                                @endforelse--}}
            {{--                            </ul>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            @endif--}}

        @if(in_array('tasks',$modules)  && in_array('overdue_tasks',$activeWidgets))
                <div class="col-md-6">
                    <div class="panel panel-inverse panel-height-max">
                        <div class="panel-heading">@lang('modules.dashboard.overdueTasks')</div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <ul class="list-task list-group" data-role="tasklist">
                                    <li class="list-group-item" data-role="task">
                                        <strong>@lang('app.title')</strong> <span
                                                class="pull-right"><strong>@lang('modules.dashboard.dueDate')</strong></span>
                                    </li>
                                    @forelse($pendingTasks as $key=>$task)
                                        @if((!is_null($task->project_id) && !is_null($task->project) ) || is_null($task->project_id))
                                            <li class="list-group-item row" data-role="task">
                                                <div class="col-xs-9">
                                                    {!! ($key+1).'. <a href="javascript:;" data-task-id="'.$task->id.'" class="show-task-detail">'.ucfirst($task->heading).'</a>' !!}
                                                    @if(!is_null($task->project_id) && !is_null($task->project))
                                                        <a href="{{ route('admin.projects.show', $task->project_id) }}" class="font-12">{{ ucwords($task->project->project_name) }}</a>
                                                    @endif
                                                </div>
                                                <label class="label label-danger pull-right col-xs-3">{{ $task->due_date->format($global->date_format) }}</label>
                                            </li>
                                        @endif
                                    @empty
                                        <li class="list-group-item" data-role="task">
                                            @lang("messages.noOpenTasks")
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        @endif
    </div>

    <div class="row d-flex" >
        @if(in_array('projects',$modules)  && in_array('project_activity_timeline',$activeWidgets))
        <div class="col-md-6" id="project-timeline">
            <div class="panel panel-inverse">
                <div class="panel-heading">@lang('modules.dashboard.projectActivityTimeline')</div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="steamline">
                            @forelse($projectActivities as $activ)
                                <div class="sl-item">
                                    <div class="sl-left"><i class="fa fa-circle text-info"></i>
                                    </div>
                                    <div class="sl-right">
                                        <div><h6><a href="{{ route('admin.projects.show', $activ->project_id) }}" class="font-bold">{{ ucwords($activ->project->project_name) }}:</a> {{ $activ->activity }}</h6> <span class="sl-date">{{ $activ->created_at->diffForHumans() }}</span></div>
                                    </div>
                                </div>
                                @empty
                                <div>@lang("messages.noTimeline")</div>
                                @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(in_array('employees',$modules)  && in_array('user_activity_timeline',$activeWidgets))
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">@lang('modules.dashboard.userActivityTimeline')</div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="steamline">
                            @forelse($userActivities as $key=>$activity)
                                <div class="sl-item">
                                    <div class="sl-left">
                                        <img src="{{ $activity->user->image_url }}" alt="user" width="40" height="40" class="img-circle">'
                                    </div>
                                    <div class="sl-right">
                                        <div class="m-l-10"><a href="{{ route('admin.employees.show', $activity->user_id) }}" class="text-success">{{ ucwords($activity->user->name) }}</a> <span  class="sl-date">{{ $activity->created_at->diffForHumans() }}</span>
                                            <p>{!! ucfirst($activity->activity) !!}</p>
                                        </div>
                                    </div>
                                </div>
                                @if(count($userActivities) > ($key+1))
                                    <hr>
                                @endif
                            @empty
                                <div>@lang("messages.noActivityByThisUser")</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    </div>

    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="eventDetailModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{--Ajax Modal Ends--}}

    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in"  id="subTaskModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="subTaskModelHeading">Sub Task e</span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{--Ajax Modal Ends--}}

@endsection


@push('footer-script')
<script>
    var taskEvents = [
        @foreach($leaves as $leave)
        @if($leave->status == 'approved')
        {
            id: '{{ ucfirst($leave->id) }}',
            title: '{{ ucfirst($leave->user->name) }}',
            start: '{{ $leave->leave_date }}',
            end: '{{ $leave->leave_date }}',
            className: 'bg-{{ $leave->type->color }}'
        },
        @else
        {
            id: '{{ ucfirst($leave->id) }}',
            title: '<i class="fa fa-warning"></i> {{ ucfirst($leave->user->name) }}',
            start: '{{ $leave->leave_date }}',
            end: '{{ $leave->leave_date }}',
            className: 'bg-{{ $leave->type->color }}'
        },
        @endif
        @endforeach
    ];

    var getEventDetail = function (id) {
        var url = '{{ route('admin.leaves.show', ':id')}}';
        url = url.replace(':id', id);

        $('#modelHeading').html('Event');
        $.ajaxModal('#eventDetailModal', url);
    }

    var calendarLocale = '{{ $global->locale }}';
    var firstDay = '{{ $global->week_start }}';

    $('.leave-action').click(function () {
        var action = $(this).data('leave-action');
        var leaveId = $(this).data('leave-id');
        var url = '{{ route("admin.leaves.leaveAction") }}';

        $.easyAjax({
            type: 'POST',
            url: url,
            data: { 'action': action, 'leaveId': leaveId, '_token': '{{ csrf_token() }}' },
            success: function (response) {
                if(response.status == 'success'){
                    window.location.reload();
                }
            }
        });
    })

    $(".filter-section-close").hide();
</script>


<script src="{{ asset('plugins/bower_components/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/morrisjs/morris.js') }}"></script>

<script src="{{ asset('plugins/bower_components/waypoints/lib/jquery.waypoints.js') }}"></script>
<script src="{{ asset('plugins/bower_components/counterup/jquery.counterup.min.js') }}"></script>

<!-- jQuery for carousel -->
<script src="{{ asset('plugins/bower_components/owl.carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/owl.carousel/owl.custom.js') }}"></script>

<!--weather icon -->
<script src="{{ asset('plugins/bower_components/skycons/skycons.js') }}"></script>

<script src="{{ asset('plugins/bower_components/moment/moment.js') }}"></script>
<script src="{{ asset('plugins/bower_components/calendar/dist/fullcalendar.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/calendar/dist/jquery.fullcalendar.js') }}"></script>
<script src="{{ asset('plugins/bower_components/calendar/dist/locale-all.js') }}"></script>
<script src="{{ asset('js/event-calendar.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/moment-timezone.js') }}"></script>
<script>
     @if(in_array('payments',$modules)  && in_array('recent_earnings',$activeWidgets))
        $(document).ready(function () {
            var chartData = {!!  $chartData !!};
            function barChart() {

                Morris.Bar({
                    element: 'morris-area-chart',
                    data: chartData,
                    xkey: 'date',
                    ykeys: ['total'],
                    labels: ['Earning'],
                    pointSize: 3,
                    lOpacity: 0,
                    barColors: ['#6fbdff'],
                    behaveLikeLine: true,
                    gridLineColor: '#e0e0e0',
                    lineWidth: 2,
                    hideHover: 'auto',
                    lineColors: ['#e20b0b'],
                    resize: true

                });

            }

            @if(in_array('payments',$modules))
            barChart();
            @endif

            $(".counter").counterUp({
                delay: 100,
                time: 1200
            });

            $('.vcarousel').carousel({
                interval: 3000
            })


            var icons = new Skycons({"color": "#ffffff"}),
                    list  = [
                        "clear-day", "clear-night", "partly-cloudy-day",
                        "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                        "fog"
                    ],
                    i;
            for(i = list.length; i--; ) {
                var weatherType = list[i],
                        elements = document.getElementsByClassName( weatherType );
                for (e = elements.length; e--;){
                    icons.set( elements[e], weatherType );
                }
            }
            icons.play();
        })
    @endif
    $('.show-task-detail').click(function () {
        $(".right-sidebar").slideDown(50).addClass("shw-rside");

        var id = $(this).data('task-id');
        var url = "{{ route('admin.all-tasks.show',':id') }}";
        url = url.replace(':id', id);

        $.easyAjax({
            type: 'GET',
            url: url,
            success: function (response) {
                if (response.status == "success") {
                    $('#right-sidebar-content').html(response.view);
                }
            }
        });
    })

    {{--$('#save-form').click(function () {--}}
        {{--$.easyAjax({--}}
            {{--url: '{{route('admin.dashboard.widget')}}',--}}
            {{--container: '#createProject',--}}
            {{--type: "POST",--}}
            {{--redirect: true,--}}
            {{--data: $('#createProject').serialize()--}}
        {{--})--}}
    {{--});--}}

     $('.keep-open .dropdown-menu').on({
         "click":function(e){
             e.stopPropagation();
         }
     });
     $('[data-toggle="tooltip"]').tooltip();
     $('#save-form').click(function () {
         $.easyAjax({
             url: '{{route('admin.dashboard.widget', "admin-dashboard")}}',
             container: '#createProject',
             type: "POST",
             redirect: true,
             data: $('#createProject').serialize(),
             success: function(){
                 window.location.reload();
             }
         })
     });

     function hidePopUp () {
         $.easyAjax({
             url: '{{route('admin.dashboard.stripe-pop-up-close')}}',
             type: "GET",
         })
     }
     /** clock timer start here */
     function currentTime() {
         let date = new Date();
         date = moment.tz(date, "{{ $global->timezone }}");

         // console.log(moment.tz(date, "America/New_York"));

         let hour = date.hour();
         let min = date.minutes();
         let sec = date.seconds();
         let midday = "AM";
         midday = (hour >= 12) ? "PM" : "AM";
         @if($global->time_format == 'h:i A')
             hour = (hour == 0) ? 12 : ((hour > 12) ? (hour - 12): hour); /* assigning hour in 12-hour format */
         @endif
             hour = updateTime(hour);
         min = updateTime(min);
         document.getElementById("clock").innerText = `${hour} : ${min} ${midday}`
         const time = setTimeout(function(){ currentTime() }, 1000);
     }

     function updateTime(timer) {
         if (timer < 10) {
             return "0" + timer;
         }
         else {
             return timer;
         }
     }

     currentTime();
</script>
@endpush

