@if(in_array('Zoom', $modules))
    <li class="{{request()->routeIs('client.zoom-meeting.index') ? 'active' : ''}}">
        <a href="{{ route('client.zoom-meeting.index') }}">
            <i class="fa-fw icon-camera"></i> @lang('zoom::app.menu.zoomMeeting')
        </a>
    </li>
@endif