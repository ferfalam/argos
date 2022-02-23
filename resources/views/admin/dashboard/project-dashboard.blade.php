<link rel="stylesheet" href="{{ asset('plugins/bower_components/morrisjs/morris.css') }}">

<div class="panel-container">
    @if(in_array('projects',$modules) && in_array('total_project',$activeWidgets))
        <div class="panel panel-default">
            <div class="panel-body">
                <img src="{{asset('img/card-1.png')}}" alt="" />
                <div class="panel-body-info">
                    <h2>{{ $totalProject  }}</h2>
                    <a href="{{ route('admin.projects.index') }}">
                        <p class="color-dark">@lang('modules.dashboard.totalProject')</p>
                    </a>
                </div>
            </div>
        </div>
    @endif

    @if(in_array('timelogs',$modules) && in_array('total_hours_logged',$activeWidgets))
        <div class="panel panel-default">
            <div class="panel-body">
                <img src="{{asset('img/card-2.png')}}" alt="" />
                <div class="panel-body-info">
                    <h2>{{ $totalHoursLogged  }}</h2>
                    <a href="{{ route('admin.all-time-logs.index') }}">
                        <p class="color-dark">@lang('modules.dashboard.totalHoursLogged')</p>
                    </a>
                </div>
            </div>
        </div>
    @endif

    @if(in_array('projects',$modules) && in_array('total_overdue_project',$activeWidgets))
        <div class="panel panel-default">
            <div class="panel-body">
                <img src="{{asset('img/card-2.png')}}" alt="" />
                <div class="panel-body-info">
                    <h2>{{ $totalOverdueProject  }}</h2>
                    <a href="{{ route('admin.projects.index') }}">
                        <p class="color-dark">@lang('modules.dashboard.totalOverdueProject')</p>
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
<div class="row">
    @if(in_array('projects',$modules) && in_array('status_wise_project',$activeWidgets))
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">@lang('modules.dashboard.statusWiseProject')
                    <a href="javascript:;" data-chart-id="statusWiseProject" class="btn btn-sm text-dark pull-right download-chart">
                        <i class="fa fa-download"></i> @lang('app.download')
                    </a>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">

                                @if(!empty(json_decode($statusWiseProject)))
                                    <div>
                                        <canvas id="statusWiseProject"></canvas>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <div class="empty-space" style="height: 200px;">
                                            <div class="empty-space-inner">
                                                <div class="icon" style="font-size:30px"><i class="icon-layers"></i></div>
                                                <div class="title m-b-15">@lang('messages.noProjectFound')</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    @endif
    @if(in_array('projects',$modules) && in_array('pending_milestone',$activeWidgets))
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">@lang('modules.dashboard.pendingMilestone')</div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>@lang('app.milestone')</th>
                                    <th>@lang('app.project')</th>
                                    <th>@lang('app.amount')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendingMilestone as $milestone)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.milestones.show', $milestone->project_id) }}" class="font-12">{{ ucwords($milestone->milestone_title) }}</a>                                        
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.projects.show', $milestone->project_id) }}" class="font-12">{{ ucwords($milestone->project_name) }}</a>
                                    </td>
                                    <td>{{ currency_formatter($milestone->cost,$milestone->currency_symbol) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3">
                                        @lang("messages.noRecordFound")
                                    </td>
                                    
                                </tr>
                               
                            @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script src="{{ asset('plugins/bower_components/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/morrisjs/morris.js') }}"></script>
<script src="{{ asset('plugins/bower_components/waypoints/lib/jquery.waypoints.js') }}"></script>
<script src="{{ asset('plugins/bower_components/counterup/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/calendar/jquery-ui.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/moment/moment.js') }}"></script>
<script src="{{ asset('plugins/bower_components/calendar/dist/fullcalendar.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/calendar/dist/jquery.fullcalendar.js') }}"></script>
<script src="{{ asset('plugins/bower_components/calendar/dist/locale-all.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script>
    $(document).ready(function () {
        @if(!empty(json_decode($statusWiseProject)) && in_array('projects',$modules) && in_array('status_wise_project',$activeWidgets))
            function statusWiseProjectPieChart(statusWiseProject) {
                var ctx2 = document.getElementById("statusWiseProject");
                var data = new Array();
                var color = new Array();
                var labels = new Array();
                var total = 0;

                $.each(statusWiseProject, function(key,val){
                    labels.push(val.status.toUpperCase());
                    data.push(parseInt(val.totalProject));
                    total = total+parseInt(val.totalProject);
                    if (val.status == "in progress") {
                        color.push("#03a9f3");
                    } else if (val.status == "on hold") {
                        color.push("#fec107");
                    } else if (val.status == "not started") {
                        color.push("#fec107");
                    } else if (val.status == "canceled") {
                        color.push("#fb9678");
                    } else if (val.status == "finished") {
                        color.push("#00c292");
                    }
                });

                // labels.push('Total '+total);
                var chart = new Chart(ctx2,{
                    "type":"doughnut",
                    "data":{
                        "labels":labels,
                        "datasets":[{
                            "data":data,
                            "backgroundColor":color
                        }]
                    }
                });
                chart.canvas.parentNode.style.height = '470px';
            }
            statusWiseProjectPieChart(jQuery.parseJSON('{!! $statusWiseProject !!}'));

        @endif


        function getRandomColor() {
            var letters = '0123456789ABCDEF'.split('');
            var color = '#';
            for (var i = 0; i < 6; i++ ) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        $('.download-chart').click(function() {
            var id = $(this).data('chart-id');
            this.href = $('#'+id)[0].toDataURL();// Change here
            this.download = id+'.png';
        });

    });

    
    
</script>