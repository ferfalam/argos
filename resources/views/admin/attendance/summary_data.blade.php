<div class="table-responsive tableFixHead">
    <table class="table table-bordered table-hover toggle-circle dataTable default footable-loaded footable table-nowrap mb-0">
        <thead >
            <tr>
                <th>@lang('app.employee')</th>
                @for($i =1; $i <= $daysInMonth; $i++)
                    <th>{{ $i }}</th>
                @endfor
                <th>@lang('app.total')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($employeeAttendence as $key => $attendance)
            @php
                $totalPresent = 0;
            @endphp
            <tr>
                <td> {!! end($attendance) !!} </td>
                @foreach($attendance as $key2=>$day)
                    @if ($key2+1 <= count($attendance))
                        <td class="text-center">
                            @if($day == 'Absent' && !in_array($key2, $closeDays) )
                                <a href="javascript:;" class="edit-attendance" data-attendance-date="{{ $key2 }}"><i class="fa fa-times text-danger"></i></a>
                            @elseif($day == 'Holiday')
                                <a href="javascript:;" title="@lang("app.menu.holiday")" class="" data-attendance-date="{{ $key2 }}"><i class="fa fa-star text-warning"></i></a>
                            @elseif(in_array($key2, $closeDays))
                                <a href="javascript:;" title="@lang('modules.attendances.closeDays')" class="" data-attendance-date="{{ $key2 }}"><i class="fa fa-square text-info"></i></a>
                            @elseif(is_array($day) && $day["type"] == 'Congé')
                                <a href="javascript:;" title=" {{$day["reason"]}} " class="" data-attendance-date="{{ $key2 }}"><i class="fa fa-star text-warning"></i></a>
                            @else
                                @if($day != '-')
                                    @php
                                        $totalPresent = $totalPresent + 1;
                                    @endphp
                                @endif
                                {!! $day !!}
                            @endif
                        </td>
                    @endif
                @endforeach
                <td class="text-success">{{ $totalPresent .' / '.(count($attendance)-1) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
