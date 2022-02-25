<style>
    /* .item-expanded .list-unstyled{
        height: 100% !important;
    } */

</style>
<nav id="sidebar" onclick='width()' role="navigation">
    <!-- .User Profile -->
    <ul class="list-unstyled components" style="padding-top: 0px">

        <div class="sidebar-logo">
            <a href="/" class="">
                <img src="{{ asset('img/sidebar-logo.png') }}">
            </a>
        </div>

        <li class="item-expanded">
            <a href="#dashboard" data-toggle="collapse"
                aria-expanded="{{ request()->routeIs('admin.dashboard') ? 'true' : 'false' }}">
                <ion-icon name="rocket-outline"></ion-icon>@lang('app.menu.dashboard')
            </a>
            <ul class="collapse list-unstyled {{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.projectDashboard') ? 'in' : '' }}"
                id="dashboard">
                <li><a href="{{ route('admin.dashboard') }}"
                        class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Général </a></li>
                <li><a href="{{ route('admin.projectDashboard') }}"
                        class="{{ request()->routeIs('admin.projectDashboard') ? 'active' : '' }}">Projets </a></li>
            </ul>
        </li>

        @php
            $is_employee_active = request()->routeIs('admin.employees.index') || request()->routeIs('admin.teams.index') || request()->routeIs('admin.designations.index') || request()->routeIs('admin.attendances.summary') || request()->routeIs('admin.holidays.index') || request()->routeIs('admin.leaves.pending');
        @endphp
        @if (in_array('employees', $modules) || in_array('attendance', $modules) || in_array('holidays', $modules) || in_array('leaves', $modules))
            <li>
                <a href="#employees" data-toggle="collapse"
                    aria-expanded="{{ $is_employee_active ? 'true' : 'false' }}">
                    <ion-icon name="people-outline"></ion-icon> Utilisateurs
                </a>
                <ul class="collapse list-unstyled {{ $is_employee_active ? 'in' : '' }}" id="employees">
                    @if (in_array('employees', $modules))
                        <li><a href="{{ route('admin.employees.index') }}"
                                class="{{ request()->routeIs('admin.employees.index') ? 'active' : '' }}">@lang('app.menu.employeeList')</a>
                        </li>
                        <li><a href="{{ route('admin.teams.index') }}"
                                class="{{ request()->routeIs('admin.teams.index') ? 'active' : '' }}">@lang('app.department')</a>
                        </li>
                        <li><a href="{{ route('admin.designations.index') }}"
                                class="{{ request()->routeIs('admin.designations.index') ? 'active' : '' }}">@lang('app.menu.designation')</a>
                        </li>
                    @endif
 				
           <li><a href="{{ route('admin.attendances.myAttendance') }}" class="{{ request()->routeIs('admin.attendances.myAttendance') ? '' : '' }}">@lang('app.timer') </a></li>
                   
                    @if (in_array('attendance', $modules))
                        <li><a href="{{ route('admin.attendances.summary') }}"
                                class="{{ request()->routeIs('admin.attendances.summary') ? 'active' : '' }}">@lang('app.menu.attendance')
                            </a></li>
                    @endif

                    @if (in_array('holidays', $modules))
                        <li><a href="{{ route('admin.holidays.index') }}"
                                class="{{ request()->routeIs('admin.holidays.index') ? 'active' : '' }}">@lang('app.menu.holiday')</a>
                        </li>
                    @endif

                    @if (in_array('leaves', $modules))
                        <li><a href="{{ route('admin.leaves.pending') }}"
                                class="{{ request()->routeIs('admin.leaves.pending') ? 'active' : '' }}">@lang('app.menu.leaves')</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif



        <li>
            <a href="#third" data-toggle="collapse"
                aria-expanded="{{ request()->routeIs('admin.clients.index') ? 'true' : 'false' }}">
                <ion-icon name="grid"></ion-icon>Les tiers
            </a>
            <ul class="collapse list-unstyled {{ request()->routeIs('admin.clients.index') || request()->routeIs('admin.suppliers.index') ? 'in' : '' }}"
                id="third">
                <li>
                    <a href="{{ route('admin.clients.index') }}"
                        class="{{ request()->routeIs('admin.clients.index') ? 'active' : '' }}">
                        @lang('app.menu.clients') </a>
                </li>
                <li><a href="{{ route('admin.suppliers.index') }}"
                        class="{{ request()->routeIs('admin.suppliers.index') ? 'active' : '' }}">Fournisseurs </a>
                </li>
            </ul>
        </li>

        <li class="{{ request()->routeIs('admin.contact.index') ? 'active' : '' }}">
            <a href="{{ route('admin.contact.index') }}">
                <ion-icon name="bookmarks"></ion-icon>
                @lang('app.menu.contacts')
            </a>
        </li>

        @if (in_array('events', $modules))
            <li class="{{ request()->routeIs('admin.events.index') ? 'active' : '' }}">
                <a href="{{ route('admin.events.index') }}">
                    <ion-icon name="ticket-outline"></ion-icon>
                    @lang('app.menu.Events')
                </a>
            </li>
        @endif

        <li class="{{ request()->routeIs('admin.mailing.index') ? 'active' : '' }}">
            <a href="{{ route('admin.mailing.index') }}">
                <ion-icon name="mail-open"></ion-icon>
                Mailing (InBox)
            </a>
        </li>


        @if (in_array('messages', $modules))
            <li class="{{ request()->routeIs('admin.user-chat.index') ? 'active' : '' }}">
                <a href="{{ route('admin.user-chat.index') }}">
                    <ion-icon name="chatbubble-ellipses-outline"></ion-icon> @lang('app.menu.messages')
                </a>
            </li>
        @endif


        @foreach ($worksuitePlugins as $item)
            @if (in_array(strtolower($item), $modules) || in_array($item, $modules))
                @if (View::exists(strtolower($item) . '::sections.left_sidebar'))
                    @include(strtolower($item).'::sections.left_sidebar')
                @endif
            @endif
        @endforeach


        <li class="{{ request()->routeIs('admin.spv.index') ? 'active' : '' }}">
            <a href="{{ route('admin.spv.index') }}">
                <ion-icon name="document"></ion-icon>
                SPV
            </a>
        </li>

        <li>
            <a href="{{ route('admin.document.index') }}">
                <ion-icon name="document-text"></ion-icon>
                Documents
            </a>
        </li>

        @php
            $is_project_active = request()->routeIs('admin.projects.index') || request()->routeIs('admin.all-tasks.index') || request()->routeIs('admin.contracts.index');
        @endphp

        @if (in_array('projects', $modules) || in_array('tasks', $modules) || in_array('timelogs', $modules) || in_array('contracts', $modules))
            <li>
                <a href="#projects" data-toggle="collapse" aria-expanded="{{$is_project_active ? 'true' : 'false'}}"> <ion-icon name="rocket-outline"></ion-icon>Projets </a>
                <ul class="collapse list-unstyled {{$is_project_active ? 'in' : ''}}" id="projects">
                    @if (in_array('projects', $modules))
                        <li><a href="{{ route('admin.projects.index') }}" class="{{ request()->routeIs('admin.projects.index') ? 'active' : '' }}">Liste des projets </a></li>
                    @endif

                    @if (in_array('tasks', $modules))
                        <li><a href="{{ route('admin.all-tasks.index') }}"
                                class="{{ request()->routeIs('admin.all-tasks.index') ? 'active' : '' }}">@lang('app.menu.tasks')
                            </a></li>
                        {{-- <li><a href="{{ route('admin.taskboard.index') }}" class="{{ request()->routeIs('admin.taskboard.index') ? 'active' : '' }}">@lang('modules.tasks.taskBoard')</a></li> --}}
                        <li><a href="{{ route('admin.contracts.index') }}" class="{{ request()->routeIs('admin.contracts.index') ? 'active' : '' }}">Liste des Contrats</a></li>
                    @endif
                </ul>
            </li>
        @endif

        <li class="{{ request()->routeIs('admin.coal.index') ? 'active' : '' }}">
            <a href="{{ route('admin.coal.index') }}">
                <i class="icon-pie-chart fa-fw"></i>
                @lang('app.menu.coal_index')
                {{-- Indice Carbonne --}}
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.coal.acceptability') ? 'active' : '' }}">
            <a href="{{ route('admin.coal.acceptability') }}">
                <ion-icon name="pie-chart"></ion-icon>
                @lang('app.menu.coal_acceptability')
                {{-- Indice Acceptabilité --}}
            </a>
        </li>


        {{-- @if (in_array('estimates', $modules) || in_array('invoices', $modules) || in_array('payments', $modules) || in_array('expenses', $modules))
            <li>
                <a href="#sales" data-toggle="collapse" aria-expanded="false"> <ion-icon name="cash-outline"></ion-icon> @lang('app.menu.finance') </a>
                <ul class="collapse list-unstyled" id="sales">
                    @if (in_array('estimates', $modules))
                        <li><a href="{{ route('admin.estimates.index') }}" class="{{ request()->routeIs('admin.estimates.index') ? 'active' : '' }}">@lang('app.menu.estimates')</a></li>
                    @endif

                    @if (in_array('invoices', $modules))
                        <li><a href="{{ route('admin.all-invoices.index') }}" class="{{ request()->routeIs('admin.all-invoices.index') ? 'active' : '' }}">@lang('app.menu.invoices') </a></li>
                    @endif

                    @if (in_array('payments', $modules))
                        <li><a href="{{ route('admin.payments.index') }}" class="{{ request()->routeIs('admin.payments.index') ? 'active' : '' }}">@lang('app.menu.payments')</a></li>
                    @endif

                    @if (in_array('invoices', $modules))
                        <li><a href="{{ route('admin.all-credit-notes.index') }}" class="{{ request()->routeIs('admin.all-credit-notes.index') ? 'active' : '' }}">@lang('app.menu.credit-note')</a></li>
                    @endif

                </ul>
            </li>
        @endif

        @if (in_array('products', $modules))
            <li class="{{ request()->routeIs('admin.products.index') ? 'active' : '' }}"><a href="{{ route('admin.products.index') }}" ><ion-icon name="cart-outline"></ion-icon> @lang('app.menu.products')</a></li>
        @endif


       

        <h4 class="sidebar-heading">Others</h4> --}}
        {{-- @role('admin')
            <li class="{{ request()->routeIs('admin.billing') ? 'active' : '' }}">
                <a href="{{ route('admin.billing') }}" >
                    <ion-icon name="card-outline"></ion-icon>
                    @lang('app.menu.billing')
                </a>
            </li>
        @endrole --}}

        <li class="{{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
            <a href="{{ route('admin.settings.index') }}">
                <ion-icon name="settings-outline"></ion-icon>
                @lang('app.menu.settings')
            </a>
        </li>

        {{-- <li>
            <a class="{{ request()->routeIs('admin.settings.index') ? 'active' : '' }}" href="#settings" data-toggle="collapse" aria-expanded="{{request()->routeIs('admin.settings.index') ? 'true' : 'false'}}">  
                <ion-icon name="settings-outline"></ion-icon>
                @lang('app.menu.settings') 
            </a>
            
            <ul class="collapse list-unstyled {{request()->routeIs('admin.settings.index') ? 'in' : ''}} " id="settings">
                <li >
                    <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.index') ? 'active' : '' }}" >
                        @lang('app.menu.settings')
                    </a>
                </li>
                <li><a href="#!">Société </a></li>
                <li><a href="#!">Profils/Habilitations</a></li>
                <li><a href="#!">Templates Mails</a></li>
                <li><a href="#!">API</a></li>
                <li><a href="#!">Langues</a></li>
            </ul>
        </li> --}}

    </ul>
</nav>
