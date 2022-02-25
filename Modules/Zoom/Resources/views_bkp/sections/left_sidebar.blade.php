@if(in_array('Zoom', $modules))
    <li class="{{ request()->is("admin/zoom*") || request()->is('admin/offmetting') || request()->is("admin/room")  ?  'active' : '' }}">
        <a href="#meetings" data-toggle="collapse" aria-expanded="false"> <ion-icon name="megaphone-outline"></ion-icon> @lang('zoom::app.menu.meeting') </a>
        <ul class="collapse list-unstyled" id="meetings">
            <li><a href="{{ route('admin.offmeeting.index') }}" class="{{request()->is("admin/offmeeting") ? 'active' : ''}}" >@lang('zoom::app.menu.meeting')</a></li>
            <li><a href="{{ route('admin.room.index') }}"  class="{{request()->is("admin/room") ? 'active' : ''}}">@lang('zoom::app.menu.room')</a></li>
            <li><a href="{{ route('admin.zoom-meeting.table-view') }}"  class="{{request()->is("admin/zoom-meeting/table") ? 'active' : ''}}">@lang('zoom::app.menu.zoomMeeting')</a></li>
            <li><a href="{{ route('admin.zoom-setting.store') }}"  class="{{request()->is("admin/zoom-setting") ? 'active' : ''}}">@lang('zoom::app.menu.zoomSetting')</a></li>
        </ul>
    </li>
@endif