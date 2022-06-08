@php
    $is_meeting_active = request()->routeIs("admin.offmeeting.index") ||
    request()->routeIs("admin.room.index") || 
    request()->routeIs('admin.zoom-meeting.table-view') ||
    request()->routeIs('admin.zoom-setting.index');
@endphp
@if(in_array('reunions.title', $modules))
    <li class="">
        <a href="#meetings" data-toggle="collapse" aria-expanded="false"> <ion-icon name="megaphone-outline"></ion-icon> @lang('zoom::app.menu.zoomMeeting') </a>
        <ul class="collapse {{$is_meeting_active ? 'in' : ''}} list-unstyled" id="meetings">
          <!--  <li><a href="{{ route('admin.offmeeting.index') }}" class="{{request()->is("admin/offmeeting") ? 'active' : ''}}" >@lang('zoom::app.menu.meeting')</a></li>
            <li><a href="{{ route('admin.room.index') }}"  class="{{request()->is("admin/room") ? 'active' : ''}}">@lang('zoom::app.menu.room')</a></li>
-->           

            @if (in_array('reunions.visio', $modules))
                <li><a href="{{ route('admin.zoom-meeting.table-view') }}"  class="{{request()->is("admin/zoom-meeting/table") ? 'active' : ''}}">Liste</a></li>
            @endif
            
            @if (in_array('reunions.parameters', $modules))
                <li><a href="{{ route('admin.zoom-setting.store') }}"  class="{{request()->is("admin/zoom-setting") ? 'active' : ''}}">@lang('zoom::app.menu.zoomSetting')</a></li>
            @endif
        </ul>
    </li>
@endif