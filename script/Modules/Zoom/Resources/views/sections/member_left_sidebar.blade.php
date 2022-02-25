@if(in_array('Zoom', $modules))
<li>
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
</li>
@endif