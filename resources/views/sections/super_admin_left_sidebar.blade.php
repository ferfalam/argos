<nav id="sidebar"  onclick='width()' role="navigation">

    <div class="sidebar-logo">
        <a href="/" class="">            
            <img src="{{$global->logo_url}}">
            {{-- <img src="{{asset('img/sidebar-logo.png')}}"> --}}
        </a>
    </div>

    <!-- .User Profile -->
    <ul class="list-unstyled components" >

        <li class="{{request()->routeIs("super-admin.dashboard") ? 'active' : ''}}">
            <a href="{{ route('super-admin.dashboard') }}">
                <i class="icon-grid fa-fw"></i>
                @lang('app.menu.dashboard')
            </a>
        </li>
        
        <li class="{{request()->routeIs("super-admin.companies*") ? 'active' : ''}}">
            <a href="{{ route('super-admin.companies.index') }}">
                <i class="icon-layers fa-fw"></i>
                @lang('app.menu.companies')
            </a>
        </li>

        <li class="{{request()->routeIs("super-admin.super-admin*") ? 'active' : ''}}">
            <a href="{{ route('super-admin.super-admin.index') }}">
                <i class="icon-user fa-fw"></i>
                @lang('app.superAdmin')
            </a>
        </li>

        <li class="{{request()->routeIs("super-admin.settings*") ? 'active' : ''}}">
            <a href="{{ route('super-admin.settings.index') }}">
                <i class="icon-settings fa-fw"></i>
                @lang('app.menu.settings')
            </a>
        </li>

    </ul>
</nav>
