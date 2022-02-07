
<!-- Left navbar-header -->
@include('sections.left_sidebar')
<!-- Left navbar-header end -->

<!-- Page Content -->
<div id="page-wrapper" class="row">

    <div class="container-fluid ">

        @if (!empty($__env->yieldContent('filter-section')))
            @php
                $filterSection = true;
            @endphp
            <div class="col-md-3 filter-section" style="overflow-x: hidden;">

                <h5 class="pull-right hidden-sm hidden-md hidden-xs">
                    <button class="btn btn-default btn-xs btn-circle btn-outline filter-section-close"><i
                                class="fa fa-chevron-left"></i></button>
                </h5>
                <h5 class="pull-left"><i class="fa fa-sliders"></i> @lang('app.filterResults')</h5>
                @yield('filter-section')
            </div>
        @endif

        @if (!empty($__env->yieldContent('other-section')))
            <div class="col-md-3 filter-section other-section">
                @yield('other-section')
            </div>
        @endif

        {{--       Check if to render 9 columns or 12 columns         --}}
        @php
            $columns = "col-md-12";
        @endphp
        @if (!empty($__env->yieldContent('filter-section')) || !empty($__env->yieldContent('other-section')))
            $columns = "col-md-9";
        @endif

        <div class="bg-light {{$columns}} data-section" id="section-task">
            <button class="btn btn-default btn-xs btn-outline btn-circle m-t-5 filter-section-show hidden-sm hidden-md"
                    style="display:none;margin-top: 60px !important;"><i class="fa fa-chevron-right"></i></button>

            @if (!empty($__env->yieldContent('filter-section')) || !empty($__env->yieldContent('other-section')))
                <div class="row hidden-md hidden-lg">
                    <div class="col-xs-12 p-l-25 m-t-10">
                        <button class="btn btn-inverse btn-outline" id="mobile-filter-toggle"><i
                                    class="fa fa-sliders"></i></button>
                    </div>
                </div>
            @endif


            @yield('page-title')

        <!-- .row -->
            @yield('content')

            @include('sections.right_sidebar')


        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->





<style>

  .fc-event{
    font-size: 10px !important;
  }
  #calendar .fc-view-container .fc-view .fc-more-popover{
    top: 136px !important;
    left: 105px !important;
  }
  @keyframes fa-blink {
    0% { opacity: 1; }
    25% { opacity: 0.25; }
    50% { opacity: 0.5; }
    75% { opacity: 0.75; }
    100% { opacity: 0; }
  }
  .fa-blink {
    -webkit-animation: fa-blink 1.75s linear infinite;
    -moz-animation: fa-blink 1.75s linear infinite;
    -ms-animation: fa-blink 1.75s linear infinite;
    -o-animation: fa-blink 1.75s linear infinite;
    animation: fa-blink 1.75s linear infinite;
  }
  .dashboard-clock {
    font-size: 26px;
    font-weight: 300;
  }
  h4 {
    line-height: 22px !important;
    font-size: 18px !important;
  }
  .bg-blue-gradient {
    background-image: linear-gradient(
      120deg, #00c4fa 0%, #0255cd 100%);
  }
  .color_black {
    color: black!important;
  }

</style>



<style>
  .sidebar .notify {
    margin: 0 !important;
  }

  .sidebar .notify .heartbit {
    top: -23px !important;
    right: -15px !important;
  }

  .sidebar .notify .point {
    top: -13px !important;
  }

  /* .content-wrapper .sidebar #side-menu>li>.active {
      background: transparent;
  }
  .content-wrapper .sidebar #side-menu>li>.active:hover {
      background: #272d36;
  } */
  #section-task {
    padding-bottom: 0px;
  }

  h4 {
    line-height: 22px !important;
    font-size: 18px !important;
  }

  .language-switcher:nth-child(3) {
    display: none !important;
  }

  #side-menu > li:not(.user-pro) > a {
    font-size: 15px !important;
  }

  .white-box {
    background-color: #f6f7f9 !important;
    margin-top: 20px
  }

  .container-fluid > .col-md-12:first-child {
    background-color: #ffffff !important;
  }

  .bg-title {
    background-color: #ffffff !important;
  }

  body {
    /*font-family: 'Be Vietnam Pro', sans-serif;*/
    font-family: 'Asap', sans-serif;
  }

  .white-box {
    padding: 25px !important;
  }

  .table th {
    color: #fff !important;
    background-color: #212529 !important;
    border-color: #32383e !important;
  }

  .odd {
    background-color: #f7fafc !important;
  }

  .box-title {
    color: blue;
    font-size: 20px !important;
    font-weight: 600 !important;
    text-transform: capitalize !important;
  }

  .white-box h2 {
    color: blue;
    font-size: 20px !important;
    font-weight: 600 !important;
    text-transform: capitalize !important;
  }

  .row strong {
    color: #a90202;
  }

  .form-control {
    background-color: #f3f3f3 !important;
  }

  .control-label {
    color: #a90202;
  }

  .form-group label {
    color: #a90202;
  }

  .row label {
    color: #a90202;
  }

  .tab-current {
    background-color: #000E41 !important;
    border-radius: 5px;
  }

  .showClientTabs a {
    padding-left: 5px !important;
    color: white !important;
  }

  .showClientTabs li {
    background-color: grey;
  }

  .form-control {
    color: black !important;
  }

  .tab-current a span {
    color: white !important;
  }


  .text-muted {
    color: black !important;
    font-weight: 700 !important;
  }


  .main_page_responsive {
    padding-top: 12%;
    padding-left: 3%;
  }

  .bg-light {
    background: #f6f7f9 !important;
  }

  body {
    font-family: 'Roboto', sans-serif !important;

  }

  .bg-title {
    padding-top: 5% !important;
  }

  .page-title {
    color: black !important
  }

  .btn-success_header {
    font-size: 14px !important;
    color: white !important;
    background: #00c292 !important;
    border: 1px solid #00c292 !important;
    padding: 12px 28px !important;
    border-radius: 25px !important;
  }

  .btn-info-custome {
    font-size: 14px !important;
    color: white !important;
    background-color: #00c4ffb8 !important;
    padding: 12px 28px !important;
    border-radius: 25px !important;
  }

  .btn-top-row {
    display: flex !important;;
    justify-content: right !important;;
  }

  /* calender new css   */

  .incalender {
    background: white !important;
    margin: 10px !important;
    padding: 10px !important;
    border: 1px solid #EDEDED !important;
    border-radius: 10px !important;
  }

  .ocalander {
    margin-top: 0% !important;
  }

  .fc-day-header {
    background: #c5cad3 !important;
    color: black !important;
  }

  .fc-today-button {
    background: #44d2fd !important;
    color: white !important;
  }

  .fc-next-button {
    background: #c5cad3 !important;
  }

  .fc-prev-button {
    background: #c5cad3 !important;
    margin-right: 5px !important;
  }

  .fc-state-active {
    background: #44d2fd !important;
  }

  .fc-center h2 {
    color: black !important;
  }

  .small-success-btn {
    font-size: 12px !important;
    color: white !important;
    background: #00c292 !important;
    border: 1px solid #00c292 !important;
    padding: 7px 19px !important;
    border-radius: 25px !important;
  }

  .small-danger-btn {
    font-size: 12px !important;
    color: white !important;
    background: #fb9678 !important;
    border: 1px solid #fb9678 !important;
    padding: 7px 19px !important;
    border-radius: 25px !important;
  }

  .small-purple-btn {
    font-size: 12px !important;
    color: white !important;
    background: #ab8ce4 !important;
    border: 1px solid #ab8ce4 !important;
    padding: 7px 19px !important;
    border-radius: 25px !important;
  }

  .small-info-btn {
    font-size: 12px !important;
    color: white !important;
    background-color: #00c4ffb8 !important;
    border: 1px solid #00c4ffb8 !important;
    padding: 7px 19px !important;
    border-radius: 25px !important;
  }

  .small-btn-inverse {
    font-size: 12px !important;
    color: black !important;
    background-color: #fff !important;
    border: 1px solid black !important;
    padding: 7px 19px !important;
    border-radius: 25px !important;
  }

  .mt-z-5 {
    margin-top: 5% !important;
  }

  .bg-title {
    background: #f6f7f9 !important;
  }

  .white-box {
    margin-top: 0% !important;
  }

  .colorsidebar {
    color: #b7c0cd !important;
    font-weight: 100 !important;
  }

  .dashboard-stats {
    background: #f6f7f9 !important;
  }

  .incalender {
    background: white !important;
    margin: 10px !important;
    padding: 10px !important;
    border: 1px solid #EDEDED !important;
    border-radius: 10px !important;
  }

  .ocalander {
    margin-top: 0% !important;
  }

  .fc-day-header {
    background: #c5cad3 !important;
    color: black !important;
  }

  .fc-today-button {
    background: #44d2fd !important;
    color: white !important;
  }

  .fc-next-button {
    background: #c5cad3 !important;
  }

  .fc-prev-button {
    background: #c5cad3 !important;
    margin-right: 5px !important;
  }

  .fc-state-active {
    background: #44d2fd !important;
  }

  .fc-center h2 {
    color: black !important;
  }

  .fc-toolbar-title {
    color: black !important;
  }

  .fc-dayGridMonth-button {
    background: #44d2fd !important;
    color: white !important;
  }

  .fc-timeGridWeek-button {
    background: #44d2fd !important;
    color: white !important;
  }

  .fc-timeGridDay-button {
    background: #44d2fd !important;
    color: white !important;
  }

  .fc-listWeek-button {
    background: #44d2fd !important;
    color: white !important;
  }

  .outerCalender {
    margin: 50px 0px !important;
    background: white !important;
    border: 1px solid #fff !important;
    border-radius: 5px !important;
  }

  .color-black {
    color: black !important;
  }

  .nav-second-level {
    background: #34444c !important;
  }

  .icon_fa {
    color: #b7c0cd !important;
    font-size: 17px !important;

  }

  .ml_sidebar {
    padding-left: 10px !important;
    font-size: 12px !important;
  }

  .buttons-export {
    font-size: 11.4px !important;
    color: white !important;
    background-color: #03a9f3 !important;
    border: 1px solid #03a9f3 !important;
    padding: 7px 19px !important;
    border-radius: 25px !important;
    margin-top: -5px !important;
  }

  .buttons-print {
    font-size: 12px !important;
    color: white !important;
    background-color: #03a9f3 !important;
    border: 1px solid #03a9f3 !important;
    padding: 7px 19px !important;
    border-radius: 25px !important;
  }

  .buttons-reset {
    font-size: 12px !important;
    color: white !important;
    background-color: #03a9f3 !important;
    border: 1px solid #03a9f3 !important;
    padding: 7px 19px !important;
    border-radius: 25px !important;
  }

  .buttons-reload {
    font-size: 12px !important;
    color: white !important;
    background-color: #03a9f3 !important;
    border: 1px solid #03a9f3 !important;
    padding: 7px 19px !important;
    border-radius: 25px !important;
  }


  #side-menu > li {

    margin: 0px 0px 0px 9px !important;
  }

  .logo {
    margin-left: -8px !important;
  }

  .bg_white {
    background: #fff !important;
  }
</style>



{{-- Navbar Start --}}
<div class="header navbar-header">

  @if ((company()->package_id == 8||company()->package_id == 2) && round((strtotime(date('Y-m-d', strtotime(company()->created_at. ' + 15 days'))) - time())/ (60 * 60 * 24))>0)
      @php
          $banner = true;
      @endphp
      {{--                        <div class=""--}}
      {{--                             style="border-radius: 0px;text-align: center;margin-bottom: -65px;color: white;padding: 15px;"--}}
      {{--                             role="alert">--}}
      {{--                            {{round((strtotime(date('Y-m-d', strtotime(company()->created_at. ' + 15 days'))) - time())/ (60 * 60 * 24))}} {{package_setting()->trial_message}}--}}
      {{--                            <a--}}
      {{--                                    href="{{url('admin/billing/packages')}}" class="btn btn-primary">Souscrire</a>--}}
      {{--                        </div>--}}
  @endif

  <div class="header-left">
      <a href="/" class="logo">
          <img src="/img/logo.png">
      </a>
  </div>

{{--    <a class="toggle_btn open-close waves-effect waves-light" href="javascript:void(0);">--}}
{{--        <span class="bar-icon">--}}
{{--            <span></span>--}}
{{--            <span></span>--}}
{{--            <span></span>--}}
{{--        </span>--}}
{{--    </a>--}}

        <ul class="nav user-menu">
            <li class="nav-item dropdown show-user-notifications">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i> <span
                            class="badge badge-pill noti-count"></span> {{count($user->unreadNotifications)}}
                </a>
                <div class="dropdown-menu notifications">
                    <div class="noti-content">
                        <ul class="notification-list mailbox"></ul>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                {{--                            <div id="google_translate_element" style="display: none;"></div>--}}
                <select class="selectpicker language-switcher  pull-right" id="trans" data-width="fit"
                        onchange="translateLanguage(this.value);">
                    <option value="en" @if($global->locale == "en") selected
                            @endif data-content='<span class="flag-icon flag-icon-gb"></span><span style="color: white;font-size:15px;padding-left:5px">English </span></span>'>
                        En
                    </option>
                    {{--                                @foreach($languageSettings as $language)--}}
                    {{--                                    <option value="{{ $language->language_code }}"--}}
                    {{--                                            @if($global->locale == $language->language_code) selected--}}
                    {{--                                            @endif  data-content='<span class="flag-icon @if($language->language_code == 'zh-CN') flag-icon-cn @elseif($language->language_code == 'zh-TW') flag-icon-tw @else flag-icon-{{ $language->language_code }} @endif"></span>'>{{ $language->language_code }}</option>--}}
                    {{--                                @endforeach--}}
                </select>
            </li>
            <li class="nav-item dropdown main-drop">

                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <i class="fa fa-plus-circle"></i>
                </a>
                <div class="dropdown-menu">
                    @if(in_array('projects',$modules))
                        <a class="dropdown-item dropdown-custom"
                          href="{{ route('admin.projects.create') }}">@lang('app.add') @lang('app.project')</a>
                    @endif

                    @if(in_array('tasks',$modules))
                        <a class="dropdown-item dropdown-custom"
                          href="{{ route('admin.all-tasks.create') }}">@lang('app.add') @lang('app.task')</a>
                    @endif

                    @if(in_array('clients',$modules))
                        <a class="dropdown-item dropdown-custom"
                          href="{{ route('admin.clients.create') }}">@lang('app.add') @lang('app.client')</a>
                    @endif

                    @if(in_array('employees',$modules))
                        <a class="dropdown-item dropdown-custom"
                          href="{{ route('admin.employees.create') }}">@lang('app.add') @lang('app.employee')</a>
                    @endif

                    {{--                                @if(in_array('payments',$modules))--}}
                    {{--                                    <a class="dropdown-item dropdown-custom"--}}
                    {{--                                       href="{{ route('admin.payments.create') }}">@lang('modules.payments.addPayment')</a>--}}
                    {{--                                @endif--}}

                    {{--                                @if(in_array('tickets',$modules))--}}
                    {{--                                    <a class="dropdown-item dropdown-custom"--}}
                    {{--                                       href="{{ route('admin.tickets.create') }}">@lang('app.add') @lang('modules.tickets.ticket')</a>--}}
                    {{--                                @endif--}}
                </div>
            </li>
            <li class="nav-item dropdown has-arrow main-drop">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
        <span class="user-img"><img src="{{ $user->image_url }}" alt="">
        <span class="status online"></span></span>

          </a>
          <div class="dropdown-menu">
              {{--                                <a class="dropdown-item dropdown-custom"--}}
              {{--                                   href="{{ route('member.dashboard') }}">@lang('app.loginAsEmployee')</a>--}}
              @if($isClient)
                  <a class="dropdown-item dropdown-custom"
                     href="{{ route('client.dashboard.index') }}">@lang('app.loginAsClient')</a>
              @endif
              {{--                                @if(in_array('ticket support',$modules))--}}
              {{--                                    <a class="dropdown-item dropdown-custom"--}}
              {{--                                       href="{{ route('admin.support-tickets.index') }}">@lang('app.supportTicket')</a>--}}
              {{--                                @endif--}}
              <a class="dropdown-item dropdown-custom"
                 href="{{ route('admin.email-settings.index') }}">@lang('app.menu.emailSettings')</a>
              <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                 class="dropdown-item dropdown-custom"
                 href="{{ route('logout') }}">@lang('app.logout')</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST"
                    style="display: none;">
                  {{ csrf_field() }}
              </form>
          </div>
      </li>
  </ul>
</div>
{{-- Navbar Ends --}}