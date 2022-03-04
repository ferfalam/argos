
@foreach ($dateWiseData as $key => $dateData)
    @php
        $currentDate = \Carbon\Carbon::parse($key);
    @endphp
    @if($dateData['attendance'])

        <tr>
            <td>
                {{ $currentDate->format($global->date_format) }}
                <br>
                <label class="label label-success">{{ $currentDate->format('l') }}</label>
            </td>
            <td><label class="label label-success">@lang('modules.attendance.present')</label></td>
            {{-- <td colspan="3">
                <table width="100%" > --}}
                    @foreach($dateData['attendance'] as $attendance)
                            <td width="25%" class="al-center bt-border" >
                                {{ $attendance->clock_in_time->timezone($global->timezone)->format($global->time_format) }}<br>
                                <strong>@lang('modules.attendance.clock_in') IP: </strong> {{ $attendance->clock_in_ip }}
                            </td>
                            <td width="25%" class="al-center bt-border" >
                                @if(!is_null($attendance->clock_out_time))
                                    {{ $attendance->clock_out_time->timezone($global->timezone)->format($global->time_format) }} <br>
                                    <strong>@lang('modules.attendance.clock_out') IP: </strong> {{ $attendance->clock_out_ip }}
                                @else - @endif
                            </td>
                            <td class="bt-border" style="padding-bottom: 5px;">
                                <strong>@lang('modules.attendance.working_from'): </strong> {{ $attendance->working_from }}<br>
                                <a href="javascript:;" data-attendance-id="{{ $attendance->aId }}" class="delete-attendance btn btn-outline btn-danger btn-xs m-t-5"><i class="fa fa-times"></i> @lang('app.delete')</a>
                            </td>
                    @endforeach
                {{-- </table>
            </td> --}}

        </tr>
    @else
        <tr>
            <td>
                {{ $currentDate->format($global->date_format) }}
                <br>
                <label class="label label-success">{{ $currentDate->format('l') }}</label>
            </td>
            <td>
                @if(!$dateData['holiday'] && !$dateData['leave'])
                    <label class="label label-info">@lang('modules.attendance.absent')</label>
                @elseif($dateData['leave'])
                    <label class="label label-primary">@lang('modules.attendance.leave')</label>
                @else
                    <label class="label label-megna">@lang('modules.attendance.holiday')</label>
                @endif
            </td>
                @if($dateData['holiday']  && !$dateData['leave'])
                    <td colspan="3" style="padding-bottom: 5px;text-align: center;">
                        @lang('modules.attendance.holidayfor') {{ ucwords($dateData['holiday']->occassion) }}
                    </td>
                @elseif($dateData['leave'])
                    <td colspan="3" style="padding-bottom: 5px;text-align: center;">
                        @lang('modules.attendance.leaveFor') {{ ucwords($dateData['leave']['reason']) }}
                    </td>
                @else
                    <td width="25%" class="al-center">-</td>
                    <td width="25%" class="al-center">-</td>
                    <td width="25%" class="al-center">-</td>
                @endif
        </tr>
    @endif

@endforeach

