<nav id="sidebar"  onclick='width()' role="navigation">
    <!-- .User Profile -->
    <ul class="list-unstyled components"  style="padding-top: 0px">

        <div class="sidebar-logo">
            <a href="/" class="">
                <img src="{{asset('img/sidebar-logo.png')}}">
            </a>
        </div>


        <h4 class="sidebar-heading">Main</h4>

        <li class="{{request()->routeIs("member.dashboard") ? 'active' : ''}}">
            <a href="{{ route('member.dashboard') }}">
                <ion-icon name="speedometer-outline"></ion-icon>
                Dashboard
            </a>
        </li>

        {{-- @foreach ($worksuitePlugins as $item)
            @if (in_array(strtolower($item), $modules) || in_array($item, $modules))
                @if (View::exists(strtolower($item) . '::sections.left_sidebar'))
                    @include(strtolower($item).'::sections.left_sidebar')
                @endif
            @endif
        @endforeach
         --}}
        @foreach ($worksuitePlugins as $item)
            {{-- @if(in_array(strtolower($item), $modules) || in_array($item, $modules)) --}}
                @if(View::exists(strtolower($item).'::sections.member_left_sidebar'))
                    @include(strtolower($item).'::sections.member_left_sidebar')
                @endif
            {{-- @endif --}}
        @endforeach


        
        @if(in_array('chat',$modules))
        <li><a href="{{ route('member.user-chat.index') }}" class="waves-effect"><i class="icon-envelope fa-fw"></i> <span class="hide-menu">@lang("app.menu.messages") @if($unreadMessageCount > 0)<span class="label label-rouded label-custom pull-right">{{ $unreadMessageCount }}</span> @endif
                </span>
            </a>
        </li>
        @endif

        
        @if(in_array('tiers.clients',$modules))
        @if($user->cans('view_clients'))
            <li class="{{request()->routeIs('member.clients.index') ? 'active' : ''}}">
                <a href="{{ route('member.clients.index') }}"> <ion-icon name="chatbubble-ellipses-outline"></ion-icon> @lang('app.menu.messages') </a>
            </li>
        @endif
        @endif
            
            
        @if(in_array('projects.title',$modules))
            <li class="{{request()->routeIs('member.projects.index') ? 'active' : ''}}">
                <a href="{{ route('member.projects.index') }}"> <i class="icon-layers fa-fw"></i> @lang('app.menu.projects') </a>
            </li>
        @endif

        
        {{-- @if(in_array('projects.title',$modules))
        <li><a href="{{ route('member.projects.index') }}" class="waves-effect"><i class="icon-layers fa-fw"></i> <span class="hide-menu">@lang("app.menu.projects") </span> @if($unreadProjectCount > 0) <div class="notify notification-color"><span class="heartbit"></span><span class="point"></span></div>@endif</a> </li>
        @endif --}}

        {{-- @if(in_array('contracts',$modules) && $user->cans('view_contract'))
            <li class="{{request()->routeIs('member.contracts.index') ? 'active' : ''}}">
                <a href="{{ route('member.contracts.index') }}"> <ion-icon name="chatbubble-ellipses-outline"></ion-icon> @lang('app.menu.messages') </a>
            </li>
        @endif --}}

        {{-- @if(in_array('products',$modules) && $user->cans('view_product'))
            <li class="{{request()->routeIs('member.products.index') ? 'active' : ''}}">
                <a href="{{ route('member.products.index') }}"> <ion-icon name="chatbubble-ellipses-outline"></ion-icon> @lang('app.menu.messages') </a>
            </li>
        @endif --}}

        @if(in_array('projects.task',$modules) )
            <li class="{{request()->routeIs('member.task.index') ? 'active' : ''}}">
                <a href="{{ route('member.task.index') }}"> <i class="ti-layout-list-thumb fa-fw"></i> @lang('app.menu.tasks') </a>
            </li>
        @endif
        
        @if(in_array('evenements',$modules))
            <li><a href="{{ route('member.events.index') }}" class="waves-effect"><i class="icon-calender fa-fw"></i> <span class="hide-menu">@lang('app.menu.Events')</span></a> </li>
        @endif

        @if (in_array('documents', $modules))
        <li class="{{ request()->routeIs('member.document.*') ? 'active' : '' }}">
            <a href="{{ route('member.document.index') }}">
                <i class="fa fa-file"></i>
                @lang('app.docManagement')
            </a>
        </li>
        @endif

        {{-- @if (in_array('tasks', $modules))
            <li>
                <a href="#projects" data-toggle="collapse" aria-expanded="false"> <ion-icon name="rocket-outline"></ion-icon> @lang('app.menu.tasks') </a>
                <ul class="collapse list-unstyled" id="projects">
                    <li><a href="{{ route('member.task.index') }}" class="{{ request()->routeIs('member.task.index') ? 'active' : '' }}">@lang('app.menu.tasks') </a></li>
                    <li><a href="{{ route('member.all-tasks.index') }}" class="{{ request()->routeIs('member.all-tasks.index') ? 'active' : '' }}">@lang('app.menu.all-tasks') </a></li>
                    <li><a href="{{ route('member.taskboard.index') }}" class="{{ request()->routeIs('member.task-label.index') ? 'active' : '' }}">@lang('modules.tasks.taskBoard') </a></li>
                    <li><a href="{{ route('member.task-calendar.index') }}" class="{{ request()->routeIs('member.task-label.index') ? 'active' : '' }}">@lang('app.menu.taskCalendar') </a></li>
                </ul>
            </li>
        @endif --}}

        <h4 class="sidebar-heading">Others</h4>

        {{-- @if(in_array('leads',$modules))
            <li class="{{request()->routeIs('member.leads.index') ? 'active' : ''}}">
                <a href="{{ route('member.leads.index') }}" class="waves-effect"><i class="icon-doc fa-fw"></i> <span class="hide-menu">@lang('app.menu.lead') </span></a> 
            </li>
        @endif --}}

        @if(in_array('timelogs',$modules))
            <li class="{{request()->routeIs('member.all-time-logs.index') ? 'active' : ''}}">
                <a href="{{ route('member.all-time-logs.index') }}" class="{{ request()->routeIs('member.task-label.index') ? 'active' : '' }}"> <i class="icon-clock fa-fw"></i> @lang('app.menu.timeLogs') </a>
            </li>
        @endif

        @if(in_array('users.presences',$modules))
            @if($user->cans('view_attendance'))
                <li class="{{request()->routeIs('member.attendances.summary') ? 'active' : ''}}">
                    <a href="{{ route('member.attendances.summary') }}" class="waves-effect"><i class="icon-clock fa-fw"></i> <span class="hide-menu">@lang("app.menu.attendance") </span></a> 
                </li>
            @else
                <li class="{{request()->routeIs('member.attendances.index') ? 'active' : ''}}">
                    <a href="{{ route('member.attendances.index') }}" class="waves-effect"><i class="icon-clock fa-fw"></i> <span class="hide-menu">@lang("app.menu.attendance") </span></a> 
                </li>
            @endif
        @endif

        {{-- @if(in_array('holidays',$modules))
            <li class="{{request()->routeIs('member.holidays.index') ? 'active' : ''}}">
                <a href="{{ route('member.holidays.index') }}" class="waves-effect"><i class="icon-calender fa-fw"></i> <span class="hide-menu">@lang("app.menu.holiday") </span></a>
            </li>
        @endif --}}

        @if(in_array('users.absences',$modules))
        <li><a href="{{ route('member.leaves.index') }}" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">@lang('app.menu.leaves')</span></a> </li>
        @endif

    </ul>    
</nav>
    
    