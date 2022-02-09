<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $superadmin->favicon_url }}">
    {{--<link rel="manifest" href="{{ asset('favicon/manifest.json') }}">--}}
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ $superadmin->favicon_url }}">
    <meta name="theme-color" content="#ffffff">

    <title>@lang('app.adminPanel') | {{ __($pageTitle) }}</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <link rel='stylesheet prefetch'
          href='https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css'>
    <link rel='stylesheet prefetch'
          href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css'>

    <!-- This is Sidebar menu CSS -->
    <link href="{{ asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">

    <link href="{{ asset('plugins/bower_components/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- This is a Animation CSS -->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">

    @stack('head-script')

    <!-- This is a Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- color CSS you can use different color css from css/colors folder -->
    <!-- We have chosen the skin-blue (default.css) for this starter
       page. However, you can choose any other skin from folder css / colors .
       -->
    <link href="{{ asset('css/colors/default.css') }}" id="theme" rel="stylesheet">
    <link href="{{ asset('plugins/froiden-helper/helper.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link href="{{ asset('css/custom-new.css') }}?v=1.02" rel="stylesheet">

    @if($global->rounded_theme)
        <link href="{{ asset('css/rounded.css') }}" rel="stylesheet">
    @endif

    @if(file_exists(public_path().'/css/admin-custom.css'))
        <link href="{{ asset('css/admin-custom.css') }}" rel="stylesheet">
    @endif
    <style>
      body {
        top: 0px !important;
      }

      .goog-te-banner-frame {
        display: none;
      }

      /*.filter-section-show{*/
      /*    display: none !important;*/
      /*}*/
      /* .active {
        background-color: #20292e;
      } */

      #side-menu > li > a.active {
        border-color: transparent;
        background: none;
        color: #ffffff;
      }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    @if($pushSetting->status == 'active' && !module_enabled('Subdomain'))
        <link rel="manifest" href="{{ asset('manifest.json') }}"/>
        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async='async'></script>
        <script>
          var OneSignal = window.OneSignal || [];
          OneSignal.push(function () {
            OneSignal.init({
              appId: "{{ $pushSetting->onesignal_app_id }}",
              autoRegister: false,
              notifyButton: {
                enable: false,
              },
              promptOptions: {
                /* actionMessage limited to 90 characters */
                actionMessage: "We'd like to show you notifications for the latest news and updates.",
                /* acceptButtonText limited to 15 characters */
                acceptButtonText: "ALLOW",
                /* cancelButtonText limited to 15 characters */
                cancelButtonText: "NO THANKS"
              }
            });
            OneSignal.on('subscriptionChange', function (isSubscribed) {
              console.log("The user's subscription state is now:", isSubscribed);
            });


            if (Notification.permission === "granted") {
              // Automatically subscribe user if deleted cookies and browser shows "Allow"
              OneSignal.getUserId()
                .then(function (userId) {
                  if (!userId) {
                    OneSignal.registerForPushNotifications();
                  } else {
                    let db_onesignal_id = '{{ $user->onesignal_player_id }}';

                    if (db_onesignal_id == null || db_onesignal_id !== userId) { //update onesignal ID if it is new
                      updateOnesignalPlayerId(userId);
                    }
                  }
                })
            } else {
              OneSignal.isPushNotificationsEnabled(function (isEnabled) {
                if (isEnabled) {
                  console.log("Push notifications are enabled! - 2    ");
                  // console.log("unsubscribe");
                  // OneSignal.setSubscription(false);
                } else {
                  console.log("Push notifications are not enabled yet. - 2");
                  // OneSignal.showHttpPrompt();
                  // OneSignal.registerForPushNotifications({
                  //         modalPrompt: true
                  // });
                }

                OneSignal.getUserId(function (userId) {
                  console.log("OneSignal User ID:", userId);
                  // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316
                  let db_onesignal_id = '{{ $user->onesignal_player_id }}';
                  console.log('database id : ' + db_onesignal_id);

                  if (db_onesignal_id == null || db_onesignal_id !== userId) { //update onesignal ID if it is new
                    updateOnesignalPlayerId(userId);
                  }


                });


                OneSignal.showHttpPrompt();
              });

            }
          });
        </script>
    @endif

    @if($global->active_theme == 'custom')
        {{--Custom theme styles--}}
        <style>
          :root {
            --header_color: {{ $adminTheme->header_color }};
            --sidebar_color: {{ $adminTheme->sidebar_color }};
            --link_color: {{ $adminTheme->link_color }};
            --sidebar_text_color: {{ $adminTheme->sidebar_text_color }};
          }

          .pace .pace-progress {
            background: var(--header_color);
          }

          .menu-footer, .menu-copy-right {
            border-top: 1px solid #2f3544;
            background: var(--sidebar_color);
          }

          .navbar-header {
            background: var(--header_color);
          }

          .content-wrapper .sidebar #side-menu > li:hover {
            background: var(--sidebar_color);
          }

          .sidebar-nav .notify {
            margin: 0 !important;
          }

          .sidebar .notify .heartbit {
            border: 5px solid var(--header_color) !important;
            top: -23px !important;
            right: -15px !important;
          }

          .sidebar .notify .point {
            background-color: var(--header_color) !important;
            top: -13px !important;
          }

          .navbar-top-links > li > a {
            color: var(--link_color);
          }

          /*Right panel*/
          .right-sidebar .rpanel-title {
            background: var(--header_color);
          }

          /*Bread Crumb*/
          .bg-title .breadcrumb .active {
            color: var(--header_color);
          }

          /*Sidebar*/
          .sidebar {
            background: var(--sidebar_color);
            box-shadow: 1px 0px 20px rgba(0, 0, 0, 0.08);
          }

          .sidebar .label-custom {
            background: var(--header_color);
          }

          #side-menu li a, #side-menu > li:not(.user-pro) > a {
            color: var(--sidebar_text_color);
            border-left: 0 solid var(--sidebar_color);
          }

          #side-menu > li > a:hover,
          #side-menu > li > a:focus {
            background: rgba(0, 0, 0, 0.07);
          }

          #side-menu > li > a.active {
            /* border-left: 3px solid var(--header_color); */
            color: var(--link_color);
            background: var(--header_color);
          }

          #side-menu > li > a.active i {
            color: var(--link_color);
          }

          #side-menu ul > li > a:hover {
            color: var(--link_color);
          }

          #side-menu ul > li > a.active, #side-menu ul > li > a:hover {
            color: var(--header_color);
          }

          .sidebar #side-menu .user-pro .nav-second-level a:hover {
            color: var(--header_color);
          }

          .nav-small-cap {
            color: var(--sidebar_text_color);
          }

          /* .content-wrapper .sidebar .nav-second-level li {
              background: #444859;
          }
          @media (min-width: 768px) {
              .content-wrapper #side-menu ul,
              .content-wrapper .sidebar #side-menu > li:hover,
              .content-wrapper .sidebar .nav-second-level > li > a {
                  background: #444859;
              }
          } */

          /*themecolor*/
          .bg-theme {
            background-color: var(--header_color) !important;
          }

          .bg-theme-dark {
            background-color: var(--sidebar_color) !important;
          }

          /*Chat widget*/
          .chat-list .odd .chat-text {
            /* background: var(--header_color); */
          }

          /*Button*/
          .btn-custom {
            background: var(--header_color);
            border: 1px solid var(--header_color);
            color: var(--link_color);
          }

          .btn-custom:hover {
            background: var(--header_color);
            border: 1px solid var(--header_color);
          }

          /*Custom tab*/
          .customtab li.active a,
          .customtab li.active a:hover,
          .customtab li.active a:focus {
            border-bottom: 2px solid var(--header_color);
            color: var(--header_color);
          }

          .tabs-vertical li.active a,
          .tabs-vertical li.active a:hover,
          .tabs-vertical li.active a:focus {
            background: var(--header_color);
            border-right: 2px solid var(--header_color);
          }

          /*Nav-pills*/
          .nav-pills > li.active > a,
          .nav-pills > li.active > a:focus,
          .nav-pills > li.active > a:hover {
            background: var(--header_color);
            color: var(--link_color);
          }

          .admin-panel-name {
            background: var(--header_color);
          }

          /*fullcalendar css*/
          .fc th.fc-widget-header {
            background: var(--sidebar_color);
          }

          .fc-button {
            background: var(--header_color);
            color: var(--link_color);
            margin-left: 2px !important;
          }

          .fc-unthemed .fc-today {
            color: #757575 !important;
          }

          .user-pro {
            background-color: var(--sidebar_color);
          }


          .top-left-part {
            background: var(--sidebar_color);
          }

          .notify .heartbit {
            border: 5px solid var(--sidebar_color);
          }

          .notify .point {
            background-color: var(--sidebar_color);
          }

          .dropdown-menu.mailbox {
            padding-top: 0;
          }

          .form-control {
            color: black !important;
          }
        </style>

        <style>
            {!! $adminTheme->user_css !!}
        </style>
        {{--Custom theme styles end--}}
    @endif
    <link rel="stylesheet" href="{{asset("css/custom.style.css")}}">

    <link rel="stylesheet" href="{{asset("css/overwrites.css")}}">

    @if (request()->is('*/settings*'))
      <style>
        .main-content{
          display: flex;
          gap: 20px;
        }

        .main-content .other-section{
          margin-top: 0px;
          max-width: 220px;
          min-width: 220px;
        }

        .main-content .other-section ~ .row{
          flex-grow: 1;
        }

        
      </style>
    @endif

    <style>
      
      .main-header .page-title {
            font-size: 25px !important;
            color: rgba(255, 0, 0, 1) !important;
        }

        .flag-icon {
            width: 49px;
            height: 33px;
            border-radius: 10000px;
            background-size: cover;
        }


        .main-drop .dropdown-toggle{
            display: flex;
            align-items: center;
            gap: 10px;
        }

        
    </style>

</head>
<body class="">
@php
    $filterSection = false;
    $banner = false;
@endphp




<div class="wrapper">

    <!-- Left navbar-header -->
    @include('sections.left_sidebar')
    <!-- Left navbar-header end -->

    {{-- Just A Section for the Chat Content --}}
    @yield("chat-content")
    
    <main class="main" style="padding: 0">     
        {{-- Navbar Start --}}
        <div class="header navbar-header" style="display: flex; align-items: center; justify-content: space-between;">
          <div class="text-center" style="color: white">{{$user->company->company_name}} </div>
          @if ((company()->package_id == 8||company()->package_id == 2) && round((strtotime(date('Y-m-d', strtotime(company()->created_at. ' + 15 days'))) - time())/ (60 * 60 * 24))>0)
            @php
                $banner = true;
            @endphp
          @endif

          <div style="display: flex; align-items: center; gap:20px; margin-left : 100px">
            <div class="bg-white rounded-pill" style="padding: 0px 10px">
                {{\Carbon\Carbon::now()->format('d/m/Y')}}
            </div>

            <div class="bg-white rounded-pill" style="padding: 0px 10px">
                {{\Carbon\Carbon::now()->format('H:i A')}}
            </div>

            <div>
              <a href="{{route('admin.attendances.summary')}}">
                <img src="{{asset("img/clock.png")}}" alt="" style="width: 40px; height:  40px">
              </a>
            </div>

          </div>

          <ul class="nav user-menu">
            <li class="nav-item dropdown ">
              <a href="{{ route('admin.user-chat.index') }}" >
                <i class="fa">
                  <ion-icon name="chatbubbles"></ion-icon>
                </i>
              </a>
            </li>

            <li class="nav-item dropdown ">
              <a href="{{ route('admin.events.index') }}" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <i class="fa fa-calendar"></i> 
              </a>
            </li>
            <li class="nav-item dropdown show-user-notifications">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i> 
                  <span class="badge badge-pill noti-count">{{count($user->unreadNotifications)}}</span> 
                </a>
                <div class="dropdown-menu notifications">
                    <div class="noti-content">
                        <ul class="notification-list mailbox"></ul>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown main-drop">
              <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              @php
                  if ($global->locale == 'en') {
                  $flagIcon = "gb";
                  }else if ($global->locale == 'fr') {
                  $flagIcon = "fr";
                  }
              @endphp
              <span class="flag-icon flag-icon-{{$flagIcon}}"></span>
              {{-- <span style="color: inherit;font-size:15px;padding-left:5px">{{ ucwords($global->locale) }}</span></span> --}}
              </a>
              <div class="dropdown-menu">
              <a class="dropdown-item dropdown-custom" href="{{ route('admin.language.change-language', ['lang' => 'en']) }}">English</a>
              <a class="dropdown-item dropdown-custom" href="{{ route('admin.language.change-language', ['lang' => 'fr']) }}">French</a>
              </div>
            </li>

            <li class="nav-item dropdown has-arrow main-drop">
              <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img">
                  <img src="{{ $user->image_url }}" alt="">
					 <span class="status online"></span></span>
                        <span>{{ ucwords($user->name) }}</span>
                    </a>
                  
                </span>
              </a>
              <div class="dropdown-menu">
                  @if($isClient)
                      <a class="dropdown-item dropdown-custom" href="{{ route('client.dashboard.index') }}">@lang('app.loginAsClient')</a>
                  @endif

                  <a class="dropdown-item dropdown-custom" href="{{ route('admin.email-settings.index') }}">@lang('app.menu.emailSettings')</a>
                  <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item dropdown-custom" href="{{ route('logout') }}">@lang('app.logout')</a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
              </div>
            </li>
          </ul>
        </div>
        {{-- Navbar Ends --}}

        <main class="main">
          <div class="main-header" style="display: grid; grid-template-columns: 100px 1fr">
            <div>
              @include('sections.ctrl_button')
            </div>
            @yield('page-title')
            <button class="btn btn-inverse filter-section-close">
              <ion-icon name="filter-outline"></ion-icon>
            </button>
          </div>
  
          <div class="main-content">
            @if (!empty($__env->yieldContent('filter-section')))
              @php
                $filterSection = true;
              @endphp
  
              <div class="panel panel-default filter-section" style="margin-top: 24px">
                <div class="panel-body">
                  <h4 class="text-primary"> @lang('app.filterResults') </h4>
  
                  @yield('filter-section')
                  {{-- <div class="" style="overflow-x: hidden; display:block;"> --}}
                    {{-- <button class="btn btn-default btn-xs btn-circle btn-outline filter-section-close"><i class="fa fa-chevron-left"></i></button> --}}
  
                  {{-- </div> --}}
                </div>
              </div>
            @endif
  
            @if (!empty($__env->yieldContent('other-section')))
              <div class="col-md-3 filter-section other-section">
                @yield('other-section')
              </div>
            @endif
  
            @yield("content")
          </div>
  
          @include('sections.right_sidebar')
        </main>
    </main>

</div>
<!-- /#wrapper -->

{{--Footer sticky notes--}}
<div id="footer-sticky-notes" class="bg-light row hidden-xs hidden-sm">
    <div class="col-xs-12" id="sticky-note-header">
        <div class="col-xs-10" style="line-height: 30px">
            @lang('app.menu.stickyNotes') <a href="javascript:;" onclick="showCreateNoteModal()"
                                             class="btn btn-success btn-outline btn-xs m-l-10"><i
                        class="fa fa-plus"></i> @lang("modules.sticky.addNote")</a>
        </div>
        <div class="col-xs-2">
            <a href="javascript:;" class="btn btn-default btn-circle pull-right" id="open-sticky-bar"><i
                        class="fa fa-chevron-up"></i></a>
            <a style="display: none;" class="btn btn-default btn-circle pull-right" href="javascript:;"
               id="close-sticky-bar"><i class="fa fa-chevron-down"></i></a>
        </div>

    </div>

    <div id="sticky-note-list" style="display: none">

        @foreach($stickyNotes as $note)
            <div class="col-md-12 sticky-note" id="stickyBox_{{$note->id}}">
                <div class="well
                    @if($note->colour == 'red')
                      bg-danger
                    @endif
                    @if($note->colour == 'green')
                      bg-success
                    @endif
                    @if($note->colour == 'yellow')
                      bg-warning
                    @endif
                    @if($note->colour == 'blue')
                      bg-info
                    @endif
                    @if($note->colour == 'purple')
                      bg-purple
                    @endif
                      b-none">
                    <p>{!! nl2br($note->note_text)  !!}</p>
                    <hr>
                    <div class="row font-12">
                        <div class="col-xs-9">
                            @lang("modules.sticky.lastUpdated"): {{ $note->updated_at->diffForHumans() }}
                        </div>
                        <div class="col-xs-3">
                            <a href="javascript:;" onclick="showEditNoteModal({{$note->id}})"><i
                                        class="ti-pencil-alt text-white"></i></a>
                            <a href="javascript:;" class="m-l-5" onclick="deleteSticky({{$note->id}})"><i
                                        class="ti-close text-white"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
{{--sticky note end--}}

{{--Timer Modal--}}
<div class="modal fade bs-modal-md in" id="projectTimerModal" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" id="modal-data-application">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
            </div>
            <div class="modal-body">
                Loading...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                <button type="button" class="btn blue">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{--Timer Modal Ends--}}

{{--sticky note modal--}}
<div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            Loading ...
        </div>
    </div>
</div>
{{--sticky note modal ends--}}

{{--Timer Modal--}}
<div class="modal fade bs-modal-md in" id="projectTimerModal" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md" id="modal-data-application">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
            </div>
            <div class="modal-body">
                Loading...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                <button type="button" class="btn blue">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{--Timer Modal Ends--}}

{{--Ajax Modal--}}
<div class="modal fade bs-modal-md in" id="subTaskModal" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md" id="modal-data-application">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <span class="caption-subject font-red-sunglo bold uppercase" id="subTaskModelHeading">Sub Task e</span>
            </div>
            <div class="modal-body">
                Loading...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                <button type="button" class="btn blue">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{--Ajax Modal Ends--}}

<!-- jQuery -->
<script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js'></script>

<!-- Sidebar menu plugin JavaScript -->
<script src="{{ asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
<!--Slimscroll JavaScript For custom scroll-->
<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('js/waves.js') }}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ asset('plugins/bower_components/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/jasny-bootstrap.js') }}"></script>
<script src="{{ asset('plugins/froiden-helper/helper.js') }}"></script>
<script src="{{ asset('plugins/bower_components/toast-master/js/jquery.toast.js') }}"></script>

{{--sticky note script--}}
<script src="{{ asset('js/cbpFWTabs.js') }}"></script>
<script src="{{ asset('plugins/bower_components/icheck/icheck.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/icheck/icheck.init.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup-init.js') }}"></script>


<script>
  //reload page if landed via back button
  if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
    window.location.reload();
  }


  $('.notificationSlimScroll').slimScroll({
    height: '250',
    position: 'right',
    color: '#dcdcdc'
  });
  $('body').on('click', '.timer-modal', function () {
    var url = '{{ route('admin.all-time-logs.show-active-timer')}}';
    $('#modelHeading').html('Active Timer');
    $.ajaxModal('#projectTimerModal', url);
  });

  $('.datepicker, #start-date, #end-date').on('click', function (e) {
    e.preventDefault();
    $(this).attr("autocomplete", "off");
  });

  var filter = '{{ $filterSection }}';
  document.addEventListener("keydown", function (event) {
    if (event.keyCode === 190 && (event.altKey && event.shiftKey)) {
      $('.ti-angle-double-right').click();
    } else if (event.keyCode === 84 && (event.altKey && event.shiftKey)) {
      window.location.href = "{{ route('admin.all-tasks.create') }}"
    } else if (event.keyCode === 80 && (event.altKey && event.shiftKey)) {
      window.location.href = "{{route('admin.projects.create')}}"
    }
    if ((filter)) {
      if (event.keyCode === 191 && (event.altKey && event.shiftKey)) {
        if (localStorage.getItem('filter-' + currentUrl) == 'hide') {
          $('.filter-section-show').click();
          localStorage.setItem('filter-' + currentUrl, 'show');
        } else {
          $('.filter-section-close').click();
          localStorage.setItem('filter-' + currentUrl, 'hide');
        }

      }
    }
  });

  function addOrEditStickyNote(id) {
    var url = '';
    var method = 'POST';
    if (id === undefined || id == "" || id == null) {
      url = '{{ route('admin.sticky-note.store') }}'
    } else {

      url = "{{ route('admin.sticky-note.update',':id') }}";
      url = url.replace(':id', id);
      var stickyID = $('#stickyID').val();
      method = 'PUT'
    }

    var noteText = $('#notetext').val();
    var stickyColor = $('#stickyColor').val();
    $.easyAjax({
      url: url,
      container: '#responsive-modal',
      type: method,
      data: {'notetext': noteText, 'stickyColor': stickyColor, '_token': '{{ csrf_token() }}'},
      success: function (response) {
        $("#responsive-modal").modal('hide');
        getNoteData();
      }
    })
  }

  // FOR SHOWING FEEDBACK DETAIL IN MODEL
  function showCreateNoteModal() {
    var url = '{{ route('admin.sticky-note.create') }}';

    $("#responsive-modal").removeData('bs.modal').modal({
      remote: url,
      show: true
    });

    $('#responsive-modal').on('hidden.bs.modal', function () {
      $(this).find('.modal-body').html('Loading...');
      $(this).data('bs.modal', null);
    });

    return false;
  }

  // FOR SHOWING FEEDBACK DETAIL IN MODEL
  function showEditNoteModal(id) {
    var url = '{{ route('admin.sticky-note.edit',':id') }}';
    url = url.replace(':id', id);

    $("#responsive-modal").removeData('bs.modal').modal({
      remote: url,
      show: true
    });

    $('#responsive-modal').on('hidden.bs.modal', function () {
      $(this).find('.modal-body').html('Loading...');
      $(this).data('bs.modal', null);
    });

    return false;
  }

  function selectColor(id) {
    $('.icolors li.active ').removeClass('active');
    $('#' + id).addClass('active');
    $('#stickyColor').val(id);

  }


  function deleteSticky(id) {

    swal({
      title: "@lang('messages.sweetAlertTitle')",
      text: "@lang('messages.confirmation.deleteStickyNote')",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "@lang('messages.deleteConfirmation')",
      cancelButtonText: "@lang('messages.confirmNoArchive')",
      closeOnConfirm: true,
      closeOnCancel: true
    }, function (isConfirm) {
      if (isConfirm) {

        var url = "{{ route('admin.sticky-note.destroy',':id') }}";
        url = url.replace(':id', id);

        var token = "{{ csrf_token() }}";

        $.easyAjax({
          type: 'POST',
          url: url,
          data: {'_token': token, '_method': 'DELETE'},
          success: function (response) {
            $('#stickyBox_' + id).hide('slow');
            $("#responsive-modal").modal('hide');
            getNoteData();
          }
        });
      }
    });
  }


  //getting all chat data according to user
  function getNoteData() {

    var url = "{{ route('admin.sticky-note.index') }}";

    $.easyAjax({
      type: 'GET',
      url: url,
      messagePosition: '',
      data: {},
      container: ".noteBox",
      error: function (response) {

//set notes in box
        $('#sticky-note-list').html(response.responseText);
      }
    });
  }
</script>


<script>

  $('.show-user-notifications').click(function () {
    var token = '{{ csrf_token() }}';
    $.easyAjax({
      type: 'POST',
      url: '{{ route("show-admin-notifications") }}',
      data: {'_token': token},
      success: function (data) {
        if (data.status == 'success') {
          $('.mailbox').html(data.html);
          $('.noti-count').html(data.count);
        }
      }
    });

  });

  $('.mailbox').on('click', '.mark-notification-read', function () {
    var token = '{{ csrf_token() }}';
    $.easyAjax({
      type: 'POST',
      url: '{{ route("mark-notification-read") }}',
      data: {'_token': token},
      success: function (data) {
        if (data.status == 'success') {
          $('.top-notifications').remove();
          $('.top-notification-count').html('0');
          $('#top-notification-dropdown .notify').remove();
          $('.notify').remove();
        }
      }
    });

  });

  $('.mailbox').on('click', '.show-all-notifications', function () {
    var url = '{{ route('show-all-member-notifications')}}';
    $('#modelHeading').html('View Unread Notifications');
    $.ajaxModal('#projectTimerModal', url);
  });

  $('.submit-search').click(function () {
    $(this).parent().submit();
  });

  $(function () {
    $('.selectpicker').selectpicker();
  });

  $('.language-switcher').change(function () {
    var lang = $(this).val();
    $.easyAjax({
      url: '{{ route("admin.settings.change-language") }}',
      data: {'lang': lang},
      success: function (data) {
        if (data.status == 'success') {
          window.location.reload();
        }
      }
    });
  });

  //    sticky notes script
  var stickyNoteOpen = $('#open-sticky-bar');
  var stickyNoteClose = $('#close-sticky-bar');
  var stickyNotes = $('#footer-sticky-notes');
  var viewportHeight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
  var stickyNoteHeaderHeight = stickyNotes.height();

  $('#sticky-note-list').css('max-height', viewportHeight - 150);

  stickyNoteOpen.click(function () {
    $('#sticky-note-list').toggle(function () {
      $(this).animate({
        height: (viewportHeight - 150)
      })
    });
    stickyNoteClose.toggle();
    stickyNoteOpen.toggle();
  })

  stickyNoteClose.click(function () {
    $('#sticky-note-list').toggle(function () {
      $(this).animate({
        height: 0
      })
    });
    stickyNoteOpen.toggle();
    stickyNoteClose.toggle();
  })


  $('body').on('click', '.right-side-toggle', function () {
    $(".right-sidebar").slideDown(50).removeClass("shw-rside");
  })


  function updateOnesignalPlayerId(userId) {
    $.easyAjax({
      url: '{{ route("member.profile.updateOneSignalId") }}',
      type: 'POST',
      data: {'userId': userId, '_token': '{{ csrf_token() }}'},
      success: function (response) {
      }
    })
  }

  $('.table-responsive').on('show.bs.dropdown', function () {
    $('.table-responsive').css("overflow", "inherit");
  });

  $('.table-responsive').on('hide.bs.dropdown', function () {
    $('.table-responsive').css("overflow", "auto");
  })

  $('#mobile-filter-toggle').click(function () {
    $('.filter-section').toggle();
  })

  $('#sticky-note-toggle').click(function () {
    $('#footer-sticky-notes').toggle();
    $('#sticky-note-toggle').hide();
  })

  $(document).ready(function () {
//Side menu active hack
    setTimeout(function () {
      var getActiveMenu = $('#side-menu  li.active li a.active').length;
// console.log(getActiveMenu);
      if (getActiveMenu > 0) {
        $('#side-menu  li.active li a.active').parent().parent().parent().find('a:first').addClass('active');
      }

      var token = '{{ csrf_token() }}';
      $.easyAjax({
        type: 'POST',
        url: '{{ route("show-admin-notifications") }}',
        data: {'_token': token},
        success: function (data) {
          if (data.status == 'success') {
            $('.mailbox').html(data.html);
            $('.noti-count').html(data.count);
          }
        }
      });

    }, 200);

  })

  $('body').on('click', '.toggle-password', function () {
    var $selector = $(this).parent().find('input.form-control');
    $(this).toggleClass("fa-eye fa-eye-slash");
    var $type = $selector.attr("type") === "password" ? "text" : "password";
    $selector.attr("type", $type);
  });

  var currentUrl = '{{ request()->route()->getName() }}';
  $('body').on('click', '.filter-section-close', function () {
    localStorage.setItem('filter-' + currentUrl, 'hide');

    $('.filter-section').slideToggle();    
    $('.filter-section-show').toggle();
    $('.data-section').toggleClass("col-md-9 col-md-12")
  });

  $('body').on('click', '.filter-section-show', function () {
    localStorage.setItem('filter-' + currentUrl, 'show');

    $('.filter-section-show').toggle();
    $('.data-section').toggleClass("col-md-9 col-md-12")
    $('.filter-section').toggle();
  });

  var currentUrl = '{{ request()->route()->getName() }}';
  var checkCurrentUrl = localStorage.getItem('filter-' + currentUrl);
  if (checkCurrentUrl == "hide") {
    $('.filter-section-show').show();
    $('.data-section').removeClass("col-md-9")
      $('.data-section').addClass("col-md-12")
    $('.filter-section').hide();
  } else if (checkCurrentUrl == "show") {
    $('.filter-section-show').hide();
    $('.data-section').removeClass("col-md-12")
    $('.data-section').addClass("col-md-9")
    $('.filter-section').show();
  }
</script>

<script src="{{ asset('plugins/bower_components/moment/moment.js') }}"></script>
<script>
  
  // Define Global Varaiable
  var dateRangePickerCustom = {
    'Today': [moment(), moment()],
    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  }

</script>

@stack('footer-script')

<script>
  var checkDatatable = $.fn.DataTable;
  if (checkDatatable != undefined) {
    checkDatatable.ext.errMode = function (settings, tn, msg) {
      console.log(settings, tn, msg);
      if (settings && settings.jqXHR && settings.jqXHR.status == 401) {
// Handling for 401 specifically
        window.location.reload();
      } else {
        alert(msg);
      }
    };
  }

  $('ready', function(){
    const filterSection = document.querySelector(".filter-section");
    if(!filterSection ){
      $(".filter-section-close").hide();  
    }
  })

</script>

{{-- Icons Tags --}}
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
  $("ready", function () {
    $("select").each(function(){
      if(!$(this).hasClass("selectpicker")){
        $(this).select2();
      }
    });

    $('.filter-section select').each(function(){
      if($(this).hasClass("selectpicker")){
        $(this).selectpicker("destroy");
        $(this).select2();
      }
    });
  })


</script>
</body>
</html>
