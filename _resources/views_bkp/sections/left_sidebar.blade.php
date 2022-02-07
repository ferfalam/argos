<nav id="sidebar"  onclick='width()' role="navigation">
{{--    <div class="navbar-header">--}}
{{--        <!-- Toggle icon for mobile view -->--}}
{{--        <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse"--}}
{{--            data-target=".navbar-collapse"><i class="ti-menu"></i></a>--}}

{{--        --}}{{-- <div class="top-left-part"> --}}
{{--        --}}{{-- <!-- Logo --> --}}
{{--        --}}{{-- <a class="logo hidden-xs text-center" href="{{ route('admin.dashboard') }}"> --}}
{{--        --}}{{-- <span class="visible-md"><img src="{{ $global->logo_url }}" alt="home" class=" admin-logo"/></span> --}}
{{--        --}}{{-- <span class="visible-sm"><img src="{{ $global->logo_url }}" alt="home" class=" admin-logo"/></span> --}}
{{--        --}}{{-- </a> --}}

{{--        --}}{{-- </div> --}}
{{--        <!-- /Logo -->--}}

{{--        <!-- This is the message dropdown -->--}}
{{--        <ul class="nav navbar-top-links navbar-right pull-right visible-xs">--}}
{{--            @if (isset($activeTimerCount))--}}
{{--                <li class="dropdown hidden-xs">--}}
{{--                    <span id="timer-section">--}}
{{--                        <div class="nav navbar-top-links navbar-right pull-right m-t-10">--}}
{{--                            <a class="btn btn-rounded btn-default timer-modal"--}}
{{--                                href="javascript:;">@lang("modules.projects.activeTimers")--}}
{{--                                <span class="label label-danger"--}}
{{--                                    id="activeCurrentTimerCount">@if ($activeTimerCount > 0) {{ $activeTimerCount }} @else 0 @endif</span>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </span>--}}
{{--                </li>--}}
{{--            @endif--}}


{{--            <li class="dropdown">--}}
{{--                <select class="selectpicker language-switcher" data-width="fit">--}}
{{--                    @if ($global->timezone == 'Europe/London')--}}
{{--                        <option value="en" @if ($global->locale == 'en') selected @endif--}}
{{--                            data-content='<span class="flag-icon flag-icon-gb"></span>'>En</option>--}}
{{--                    @else--}}
{{--                        <option value="en" @if ($global->locale == 'en') selected @endif--}}
{{--                            data-content='<span class="flag-icon flag-icon-us"></span>'>En</option>--}}
{{--                    @endif--}}
{{--                    @foreach ($languageSettings as $language)--}}
{{--                        <option value="{{ $language->language_code }}" @if ($global->locale == $language->language_code) selected @endif--}}
{{--                            data-content='<span class="flag-icon flag-icon-{{ $language->language_code }}"></span> {{ $language->language_code }}'>--}}
{{--                            {{ $language->language_code }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </li>--}}

{{--            <!-- .Task dropdown -->--}}
{{--            <li class="dropdown" id="top-notification-dropdown">--}}
{{--                <a class="dropdown-toggle waves-effect waves-light show-user-notifications" data-toggle="dropdown"--}}
{{--                    href="#">--}}
{{--                    <i class="icon-bell"></i>--}}
{{--                    @if ($unreadNotificationCount > 0)--}}
{{--                        <div class="notify"><span class="heartbit"></span><span--}}
{{--                                class="point"></span></div>--}}
{{--                    @endif--}}
{{--                </a>--}}
{{--                <ul class="dropdown-menu  dropdown-menu-right mailbox animated slideInDown">--}}
{{--                    <li>--}}
{{--                        <a href="javascript:;">...</a>--}}
{{--                    </li>--}}

{{--                </ul>--}}
{{--            </li>--}}
{{--            <!-- /.Task dropdown -->--}}


{{--            <li class="dropdown">--}}
{{--                <a href="{{ route('logout') }}" title="Logout" onclick="event.preventDefault();--}}
{{--                                                    document.getElementById('logout-form').submit();"><i--}}
{{--                        class="fa fa-power-off"></i>--}}
{{--                </a>--}}
{{--            </li>--}}



{{--        </ul>--}}

{{--    </div>--}}
    <!-- /.navbar-header -->


    <!-- .User Profile -->
    <ul class="list-unstyled components" >

{{--            <li class="sidebar-search hidden-sm hidden-md hidden-lg">--}}
{{--                <!-- input-group -->--}}
{{--                <div class="input-group custom-search-form">--}}
{{--                    <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">--}}
{{--                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>--}}
{{--                    </span>--}}
{{--                </div>--}}
{{--                <!-- /input-group -->--}}
{{--            </li>--}}

{{--            <li class="user-pro hidden-sm hidden-md hidden-lg ml_sidebar">--}}
{{--                @if (is_null($user->image))--}}
{{--                    <a href="#" class="waves-effect"><img src="{{ asset('img/default-profile-3.png') }}"--}}
{{--                            alt="user-img" class="img-circle"> <span--}}
{{--                            class="hide-menu">{{ strlen($user->name) > 24 ? substr(ucwords($user->name), 0, 20) . '..' : ucwords($user->name) }}--}}
{{--                            <span class="fa arrow"></span></span>--}}
{{--                    </a>--}}
{{--                @else--}}
{{--                    <a href="#" class="waves-effect"><img src="{{ asset_url('avatar/' . $user->image) }}"--}}
{{--                            alt="user-img" class="img-circle"> <span--}}
{{--                            class="hide-menu">{{ ucwords($user->name) }}--}}
{{--                            <span class="fa arrow"></span></span>--}}
{{--                    </a>--}}
{{--                @endif--}}
{{--                <ul class="nav nav-second-level">--}}
{{--                    <li>--}}
{{--                        <a href="{{ route('member.dashboard') }}">--}}
{{--                            <i class="fa fa-sign-in"></i> @lang('app.loginAsEmployee')--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li role="separator" class="divider"></li>--}}
{{--                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();--}}
{{--                                                        document.getElementById('logout-form').submit();"><i--}}
{{--                                class="fa fa-power-off"></i> @lang('app.logout')</a>--}}

{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}

{{--            <li class="ml_sidebar"><a href="{{ route('admin.dashboard') }}" class="waves-effect">--}}
{{--                <i class="fa fa-tachometer icon_fa" aria-hidden="true"></i> <span class="hide-menu colorsidebar"> @lang('app.menu.dashboard')--}}
{{--                    </span></a>--}}
            {{-- <ul class="nav nav-second-level"> --}}
            {{-- <li > --}}
            {{-- <a href="{{ route('admin.dashboard') }}" class="waves-effect ml_sidebar"> --}}
            {{-- @lang('app.menu.dashboard') --}}
            {{-- </a> --}}
            {{-- </li> --}}
            {{-- @if (in_array('projects', $modules)) --}}
            {{-- <li> --}}
            {{-- <a href="{{ route('admin.projectDashboard') }}" class="waves-effect"> --}}
            {{-- @lang('app.menu.projectDashboard') --}}
            {{-- </a> --}}
            {{-- </li> --}}
            {{-- @endif --}}
            {{-- @if (in_array('clients', $modules) || in_array('leads', $modules)) --}}
            {{-- <li> --}}
            {{-- <a href="{{ route('admin.clientDashboard') }}" class="waves-effect"> --}}
            {{-- @lang('app.menu.clientDashboard') --}}
            {{-- </a> --}}
            {{-- </li> --}}
            {{-- @endif --}}
            {{-- @if (in_array('employees', $modules) || in_array('attendance', $modules) || in_array('holidays', $modules) || in_array('leaves', $modules)) --}}
            {{-- <li> --}}
            {{-- <a href="{{ route('admin.hrDashboard') }}" class="waves-effect"> --}}
            {{-- @lang('app.menu.hrDashboard') --}}
            {{-- </a> --}}
            {{-- </li> --}}
            {{-- @endif --}}
            {{-- @if (in_array('tickets', $modules))                        <li> --}}
            {{-- <a href="{{ route('admin.ticketDashboard') }}" class="waves-effect"> --}}
            {{-- @lang('app.menu.ticketDashboard') --}}
            {{-- </a> --}}
            {{-- </li> --}}
            {{-- @endif --}}
            {{-- @if (in_array('estimates', $modules) || in_array('invoices', $modules) || in_array('payments', $modules) || in_array('expenses', $modules)) --}}
            {{-- <li> --}}
            {{-- <a href="{{ route('admin.financeDashboard') }}" class="waves-effect"> --}}
            {{-- @lang('app.menu.financeDashboard') --}}
            {{-- </a> --}}
            {{-- </li> --}}
            {{-- @endif --}}
            {{-- </ul> --}}
{{--        </li>--}}

        <h4 class="sidebar-heading">Main</h4>

        <li class="{{request()->routeIs("admin.dashboard") ? 'active' : ''}}">
            <a href="{{ route('admin.dashboard') }}">
                <ion-icon name="speedometer-outline"></ion-icon>
                @lang('app.menu.dashboard')
            </a>
        </li>

        @foreach ($worksuitePlugins as $item)
            @if (in_array(strtolower($item), $modules) || in_array($item, $modules))
                @if (View::exists(strtolower($item) . '::sections.left_sidebar'))
                    @include(strtolower($item).'::sections.left_sidebar')
                @endif
            @endif
        @endforeach


        @if (in_array('messages', $modules))
            <li class="{{request()->routeIs('admin.user-chat.index') ? 'active' : ''}}">
                <a href="{{ route('admin.user-chat.index') }}"> <ion-icon name="chatbubble-ellipses-outline"></ion-icon> @lang('app.menu.messages') </a>
            </li>
        @endif

        @if (in_array('projects', $modules) || in_array('tasks', $modules) || in_array('timelogs', $modules) || in_array('contracts', $modules))
            <li>
                <a href="#projects" data-toggle="collapse" aria-expanded="false"> <ion-icon name="rocket-outline"></ion-icon>@lang('app.menu.projects')  </a>
                <ul class="collapse list-unstyled" id="projects">
                    @if (in_array('projects', $modules))
                        <li><a href="{{ route('admin.projects.index') }}" class="{{ request()->routeIs('admin.projects.index') ? 'active' : '' }}">@lang('app.menu.projects') </a></li>
                    @endif

                    @if (in_array('tasks', $modules))
                        <li><a href="{{ route('admin.all-tasks.index') }}" class="{{ request()->routeIs('admin.all-tasks.index') ? 'active' : '' }}">@lang('app.menu.tasks') </a></li>
                        <li><a href="{{ route('admin.taskboard.index') }}" class="{{ request()->routeIs('admin.taskboard.index') ? 'active' : '' }}">@lang('modules.tasks.taskBoard')</a></li>
{{--                        <li><a href="{{ route('admin.task-calendar.index') }}" class="{{ request()->routeIs('admin.task-calendar.index') ? 'active' : '' }}">@lang('app.menu.taskCalendar')</a></li>--}}
                    @endif

                    @if (in_array('timelogs', $modules))
                        <li><a href="{{ route('admin.all-time-logs.index') }}" class="{{ request()->routeIs('admin.all-time-logs.index') ? 'active' : '' }}">@lang('app.menu.timeLogs')</a></li>
                    @endif
                </ul>
            </li>
        @endif

        <h4 class="sidebar-heading">HR</h4>


        {{-- @if (in_array('leads', $modules)) --}}
        {{-- <li class="ml_sidebar" ><a href="{{ route('admin.leads.index') }}" class="waves-effect"><i class="icon-doc fa-fw"></i><span class="hide-menu">@lang('app.menu.lead')</span></a> --}}
        {{-- </li> --}}
        {{-- @endif --}}

        @if (in_array('clients', $modules))
            <li class="{{ request()->routeIs('admin.clients.index') ? 'active' : '' }}">
                <a href="{{ route('admin.clients.index') }}" > <ion-icon name="person-outline"></ion-icon> @lang('app.menu.clients') </a>
            </li>
        @endif

        @if (in_array('employees', $modules) || in_array('attendance', $modules) || in_array('holidays', $modules) || in_array('leaves', $modules))
            <li>
                <a href="#employees" data-toggle="collapse" aria-expanded="false"> <ion-icon name="people-outline"></ion-icon> @lang('app.menu.employees') </a>
                <ul class="collapse list-unstyled" id="employees">
                    @if (in_array('employees', $modules))
                        <li><a href="{{ route('admin.employees.index') }}" class="{{ request()->routeIs('admin.employees.index') ? 'active' : '' }}">@lang('app.menu.employeeList')</a></li>
                        <li><a href="{{ route('admin.teams.index') }}" class="{{ request()->routeIs('admin.teams.index') ? 'active' : '' }}">@lang('app.department')</a></li>
                        <li><a href="{{ route('admin.designations.index') }}" class="{{ request()->routeIs('admin.designations.index') ? 'active' : '' }}">@lang('app.menu.designation')</a></li>
                    @endif

                    @if (in_array('attendance', $modules))
                        <li><a href="{{ route('admin.attendances.summary') }}" class="{{ request()->routeIs('admin.attendances.summary') ? 'active' : '' }}">@lang('app.menu.attendance') </a></li>
                    @endif

                    @if (in_array('holidays', $modules))
                        <li><a href="{{ route('admin.holidays.index') }}" class="{{ request()->routeIs('admin.holidays.index') ? 'active' : '' }}">@lang('app.menu.holiday')</a></li>
                    @endif

                    @if (in_array('leaves', $modules))
                        <li><a href="{{ route('admin.leaves.pending') }}" class="{{ request()->routeIs('admin.leaves.pending') ? 'active' : '' }}">@lang('app.menu.leaves')</a></li>
                    @endif
                </ul>
            </li>
        @endif

        @if (in_array('estimates', $modules) || in_array('invoices', $modules) || in_array('payments', $modules) || in_array('expenses', $modules))
            <li>
                <a href="#sales" data-toggle="collapse" aria-expanded="false"> <ion-icon name="cash-outline"></ion-icon> @lang('app.menu.finance') </a>
                <ul class="collapse list-unstyled" id="sales">
                    @if (in_array('estimates', $modules))
                        <li><a href="{{ route('admin.estimates.index') }}" class="{{ request()->routeIs('admin.estimates.index') ? 'active' : '' }}">@lang('app.menu.estimates')</a></li>
                    @endif

                    @if (in_array('invoices', $modules))
                        <li><a href="{{ route('admin.all-invoices.index') }}" class="{{ request()->routeIs('admin.all-invoices.index') ? 'active' : '' }}">@lang('app.menu.invoices') </a></li>
{{--                        <li><a href="{{ route('admin.invoice-recurring.index') }}" class="{{ request()->routeIs('admin.invoice-recurring.index') ? 'active' : '' }}">@lang('app.invoiceRecurring') </a></li>--}}
                    @endif

                    @if (in_array('payments', $modules))
                        <li><a href="{{ route('admin.payments.index') }}" class="{{ request()->routeIs('admin.payments.index') ? 'active' : '' }}">@lang('app.menu.payments')</a></li>
                    @endif

{{--                    @if (in_array('expenses', $modules))--}}
{{--                        <li><a href="{{ route('admin.expenses.index') }}" class="{{ request()->routeIs('admin.expenses.index') ? 'active' : '' }}">@lang('app.menu.expenses')</a></li>--}}
{{--                        <li><a href="{{ route('admin.expenses-recurring.index') }}" class="{{ request()->routeIs('admin.expenses-recurring.index') ? 'active' : '' }}">@lang('app.menu.expensesRecurring')</a></li>--}}
{{--                    @endif--}}

                    @if (in_array('invoices', $modules))
                        <li><a href="{{ route('admin.all-credit-notes.index') }}" class="{{ request()->routeIs('admin.all-credit-notes.index') ? 'active' : '' }}">@lang('app.menu.credit-note')</a></li>
                    @endif

                </ul>
            </li>
        @endif

        @if (in_array('products', $modules))
            <li class="{{ request()->routeIs('admin.products.index') ? 'active' : '' }}"><a href="{{ route('admin.products.index') }}" ><ion-icon name="cart-outline"></ion-icon> @lang('app.menu.products')</a></li>
        @endif

{{--         @if (in_array('tickets', $modules))--}}
{{--            <li>--}}
{{--                <a href="{{ route('admin.tickets.index') }}" class="{{ request()->routeIs('admin.tickets.index') ? 'active' : '' }}">--}}
{{--                    <ion-icon name="ticket-outline"></ion-icon>--}}
{{--                    @lang('app.menu.tickets')--}}
{{--                </a>--}}
{{--            </li>--}}
{{--         @endif--}}

        @if (in_array('events', $modules))
            <li class="{{ request()->routeIs('admin.events.index') ? 'active' : '' }}">
                <a href="{{ route('admin.events.index') }}" >
                    <ion-icon name="ticket-outline"></ion-icon>
                    @lang('app.menu.Events')
                </a>
            </li>
        @endif

        {{-- @if (in_array('notices', $modules)) --}}
        {{-- <li class="ml_sidebar"><a href="{{ route('admin.notices.index') }}" class="waves-effect"><i class="ti-layout-media-overlay fa-fw"></i> <span class="hide-menu">@lang('app.menu.noticeBoard') </span></a> </li> --}}
        {{-- @endif --}}
        {{-- @if (in_array('reports', $modules)) --}}
        {{-- <li class="ml_sidebar"><a href="{{ route('admin.reports.index') }}" class="waves-effect"><i class="ti-pie-chart fa-fw"></i> <span class="hide-menu"> @lang('app.menu.reports') <span class="fa arrow"></span> </span></a> --}}
        {{-- <ul class="nav nav-second-level"> --}}
        {{-- @if (in_array('tasks', $modules)) --}}
        {{-- <li><a href="{{ route('admin.task-report.index') }}">@lang('app.menu.taskReport')</a></li> --}}
        {{-- @endif --}}

        {{-- @if (in_array('timelogs', $modules)) --}}
        {{-- <li><a href="{{ route('admin.time-log-report.index') }}">@lang('app.menu.timeLogReport')</a></li> --}}
        {{-- @endif --}}

        {{-- @if (in_array('estimates', $modules) || in_array('invoices', $modules) || in_array('payments', $modules) || in_array('expenses', $modules)) --}}
        {{-- <li><a href="{{ route('admin.finance-report.index') }}">@lang('app.menu.financeReport')</a></li> --}}
        {{-- <li><a href="{{ route('admin.income-expense-report.index') }}">@lang('app.menu.incomeVsExpenseReport')</a></li> --}}
        {{-- @endif --}}

        {{-- @if (in_array('leaves', $modules)) --}}
        {{-- <li><a href="{{ route('admin.leave-report.index') }}">@lang('app.menu.leaveReport')</a></li> --}}
        {{-- @endif --}}

        {{-- @if (in_array('attendance', $modules)) --}}
        {{-- <li><a href="{{ route('admin.attendance-report.index') }}">@lang('app.menu.attendanceReport')</a></li> --}}
        {{-- @endif --}}
        {{-- </ul> --}}
        {{-- </li> --}}
        {{-- @endif --}}
        <h4 class="sidebar-heading">Others</h4>

        @role('admin')
            <li class="{{ request()->routeIs('admin.billing') ? 'active' : '' }}">
                <a href="{{ route('admin.billing') }}" >
                    <ion-icon name="card-outline"></ion-icon>
                    @lang('app.menu.billing')
                </a>
            </li>
        @endrole

        {{-- <li class="ml_sidebar"><a href="{{ route('admin.employee-faq.index') }}" class="waves-effect --}}
        {{-- {{ request()->is('admin/employee-faq*') ? 'active' : '' }}"><i class="icon-docs fa-fw"></i> <span class="hide-menu"> @lang('app.faq') <span class="fa arrow"></span> </span></a> --}}
        {{-- <ul class="nav nav-second-level {{ request()->is('admin/employee-faq*') ? 'collapse in' : '' }}"> --}}
        {{-- <li><a href="{{ route('admin.faqs.index') }}" class="waves-effect"><i class="icon-docs fa-fw"></i> <span class="hide-menu"> @lang('app.myFaq')</span></a></li> --}}
        {{-- <li><a href="{{ route('admin.employee-faq.index') }}" class="waves-effect"><i class="icon-docs fa-fw"></i> <span class="hide-menu"> @lang('app.menu.employeeFaq')</span></a></li> --}}

        {{-- </ul> --}}
        {{-- </li> --}}

        <li class="{{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">
            <a href="{{ route('admin.settings.index') }}" >
                <ion-icon name="settings-outline"></ion-icon>
                @lang('app.menu.settings')
            </a>
        </li>

        {{-- <li class="ml_sidebar"><a href="" class="waves-effect"><i class="ti-settings fa-fw"></i> <span class="hide-menu"> @lang('app.menu.settings') <span class="fa arrow"></span> </span></a> --}}
        {{-- <ul class="nav nav-second-level collapse"> --}}
        {{-- <li><a href="{{ route('admin.settings.index') }}" class="waves-effect"><i class="ti-settings fa-fw"></i> <span class="hide-menu"> @lang('app.menu.settings')</span></a> --}}
        {{-- </li> --}}
        {{--  --}}{{-- <li><a href="#" class="waves-effect" id="rtl"><i class="ti-settings fa-fw"></i> <span class="hide-menu"> RTL</span></a></li> --}}

        {{-- </ul> --}}
        {{-- </li> --}}

    </ul>


    {{-- <div class="menu-footer"> --}}
    {{-- <div class="menu-user row"> --}}
    {{-- <div class="col-lg-4 m-b-5"> --}}
    {{-- <div class="btn-group dropup user-dropdown"> --}}

    {{-- <img aria-expanded="false" data-toggle="dropdown" src="{{ $user->image_url }}" alt="user-img" class="img-circle dropdown-toggle h-30 w-30"> --}}
    {{-- <ul role="menu" class="dropdown-menu"> --}}
    {{-- <li><a class="bg-inverse"><strong class="text-info">{{ ucwords($user->name) }}</strong></a></li> --}}
    {{-- <li> --}}
    {{-- <a href="{{ route('member.dashboard') }}"> --}}
    {{-- <i class="fa fa-sign-in"></i> @lang('app.loginAsEmployee') --}}
    {{-- </a> --}}
    {{-- </li> --}}
    {{-- @if ($isClient) --}}
    {{-- <li> --}}
    {{-- <a href="{{ route('client.dashboard.index') }}"> --}}
    {{-- <i class="fa fa-sign-in"></i> @lang('app.loginAsClient') --}}
    {{-- </a> --}}
    {{-- </li> --}}
    {{-- @endif --}}
    {{-- @if (in_array('ticket support', $modules)) --}}
    {{-- <li> --}}
    {{-- <a href="{{ route('admin.support-tickets.index') }}"> --}}
    {{-- <i class="fa fa-ticket"></i> @lang('app.supportTicket') --}}
    {{-- </a> --}}
    {{-- </li> --}}
    {{-- @endif --}}
    {{-- <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); --}}
    {{-- document.getElementById('logout-form').submit();" --}}
    {{-- ><i class="fa fa-power-off"></i> @lang('app.logout')</a> --}}
    {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> --}}
    {{-- {{ csrf_field() }} --}}
    {{-- </form> --}}
    {{-- </li> --}}

    {{-- </ul> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="col-lg-4 text-center  m-b-5"> --}}
    {{-- <div class="btn-group dropup shortcut-dropdown"> --}}
    {{-- <a class="dropdown-toggle waves-effect waves-light text-uppercase" data-toggle="dropdown" href="#"> --}}
    {{-- <i class="fa fa-plus"></i> --}}
    {{-- </a> --}}
    {{-- <ul class="dropdown-menu"> --}}

    {{-- @if (in_array('projects', $modules)) --}}
    {{-- <li > --}}
    {{-- <div class="message-center"> --}}
    {{-- <a href="{{ route('admin.projects.create') }}"> --}}
    {{-- <div class="mail-contnet"> --}}
    {{-- <span class="mail-desc m-0">@lang('app.add') @lang('app.project')</span> --}}
    {{-- </div> --}}
    {{-- </a> --}}
    {{-- </div> --}}
    {{-- </li> --}}
    {{-- @endif --}}

    {{-- @if (in_array('tasks', $modules)) --}}
    {{-- <li > --}}
    {{-- <div class="message-center"> --}}
    {{-- <a href="{{ route('admin.all-tasks.create') }}"> --}}
    {{-- <div class="mail-contnet"> --}}
    {{-- <span class="mail-desc m-0">@lang('app.add') @lang('app.task')</span> --}}
    {{-- </div> --}}
    {{-- </a> --}}
    {{-- </div> --}}
    {{-- </li> --}}
    {{-- @endif --}}

    {{-- @if (in_array('clients', $modules)) --}}
    {{-- <li > --}}
    {{-- <div class="message-center"> --}}
    {{-- <a href="{{ route('admin.clients.create') }}"> --}}
    {{-- <div class="mail-contnet"> --}}
    {{-- <span class="mail-desc m-0">@lang('app.add') @lang('app.client')</span> --}}
    {{-- </div> --}}
    {{-- </a> --}}
    {{-- </div> --}}
    {{-- </li> --}}
    {{-- @endif --}}

    {{-- @if (in_array('employees', $modules)) --}}
    {{-- <li > --}}
    {{-- <div class="message-center"> --}}
    {{-- <a href="{{ route('admin.employees.create') }}"> --}}
    {{-- <div class="mail-contnet"> --}}
    {{-- <span class="mail-desc m-0">@lang('app.add') @lang('app.employee')</span> --}}
    {{-- </div> --}}
    {{-- </a> --}}
    {{-- </div> --}}
    {{-- </li> --}}
    {{-- @endif --}}

    {{-- @if (in_array('payments', $modules)) --}}
    {{-- <li > --}}
    {{-- <div class="message-center"> --}}
    {{-- <a href="{{ route('admin.payments.create') }}"> --}}
    {{-- <div class="mail-contnet"> --}}
    {{-- <span class="mail-desc m-0">@lang('modules.payments.addPayment')</span> --}}
    {{-- </div> --}}
    {{-- </a> --}}
    {{-- </div> --}}
    {{-- </li> --}}
    {{-- @endif --}}

    {{-- @if (in_array('tickets', $modules)) --}}
    {{-- <li > --}}
    {{-- <div class="message-center"> --}}
    {{-- <a href="{{ route('admin.tickets.create') }}"> --}}
    {{-- <div class="mail-contnet"> --}}
    {{-- <span class="mail-desc m-0">@lang('app.add') @lang('modules.tickets.ticket')</span> --}}
    {{-- </div> --}}
    {{-- </a> --}}
    {{-- </div> --}}
    {{-- </li> --}}
    {{-- @endif --}}

    {{-- </ul> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="col-lg-4 text-right m-b-5"> --}}
    {{-- <div class="btn-group dropup notification-dropdown"> --}}
    {{-- <a class="dropdown-toggle show-user-notifications" data-toggle="dropdown" href="#"> --}}
    {{-- <i class="fa fa-bell"></i> --}}
    {{-- @if ($unreadNotificationCount > 0) --}}

    {{-- <div class="notify"><span class="heartbit"></span><span class="point"></span></div> --}}
    {{-- @endif --}}
    {{-- </a> --}}
    {{-- <ul class="dropdown-menu mailbox "> --}}
    {{-- <li> --}}
    {{-- <a href="javascript:;">...</a> --}}
    {{-- </li> --}}
    {{-- </ul> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- </div> --}}

    {{-- <div class="menu-copy-right"> --}}
    {{-- <a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="ti-angle-double-right ti-angle-double-left"></i> <span class="collapse-sidebar-text">@lang('app.collapseSidebar')</span></a> --}}
    {{-- </div> --}}

    {{-- </div> --}}


</nav>

