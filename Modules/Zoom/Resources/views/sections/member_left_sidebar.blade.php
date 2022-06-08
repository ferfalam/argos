@if(in_array('reunions.title', $modules))
{{-- <li>
    <a href="{{ route('admin.zoom-setting.store') }}" class="waves-effect">
        <i class="fa fa-video-camera"></i>
        <span class="hide-menu">
            @lang('zoom::app.menu.meeting') <span class="fa arrow"></span>
        </span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('admin.offmeeting.index') }}">
                @lang('zoom::app.menu.meeting')
            </a>
        </li>
        <li>
        <a href="{{ route('member.zoom-meeting.index') }}">
            <i class="fa fa-video-camera"></i> @lang('zoom::app.menu.zoomMeeting')
        </a>
        </li>
    </ul>
</li> --}}
<li>
    <a href="#meeting" data-toggle="collapse" aria-expanded="false"> <ion-icon name="rocket-outline"></ion-icon>@lang('zoom::app.menu.zoomMeeting')</a>
    <ul class="collapse list-unstyled" id="meeting">
        {{-- <li><a href="{{ route('admin.zoom-setting.store') }}" class="{{ request()->routeIs('admin.zoom-setting.store') ? 'active' : '' }}">@lang('zoom::app.menu.meeting') </a></li> --}}
        @if (in_array('reunions.visio', $modules))
        <li><a href="{{ route('member.zoom-meeting.index') }}" class="{{ request()->routeIs('member.zoom-meeting.index') ? 'active' : '' }}">Liste </a></li>
        @endif
        @if (in_array('reunions.parameters', $modules))
        <li><a href="{{ route('member.zoom-setting.index') }}"  class="{{request()->routeIs("member.zoom-setting.index") ? 'active' : ''}}">@lang('zoom::app.menu.zoomSetting')</a></li>
        @endif
            {{-- <li><a href="{{ route('member.task-calendar.index') }}" class="{{ request()->routeIs('member.task-label.index') ? 'active' : '' }}">@lang('app.menu.taskCalendar') </a></li> --}}
    </ul>
</li>
@endif