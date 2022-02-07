<!DOCTYPE html>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="VisioProAct by Walteks">
    <meta name="author" content="Walteks">

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $global->favicon_url }}">
    {{--<link rel="manifest" href="{{ asset('favicon/manifest.json') }}">--}}
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ $global->favicon_url }}">
    <meta name="theme-color" content="#ffffff">

    <title> @lang('app.superAdminPanel') | {{ __($pageTitle) }}</title>
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

    <!-- This is a Animation CSS -->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">

    @stack('head-script')

<!-- This is a Custom CSS -->
    <link href="{{ asset('css/style.css') }}?v=2.5" rel="stylesheet">
    <!-- color CSS you can use different color css from css/colors folder -->
    <!-- We have chosen the skin-blue (default.css) for this starter
       page. However, you can choose any other skin from folder css / colors .
       -->
    <link href="{{ asset('css/colors/default.css') }}" id="theme" rel="stylesheet">
    <link href="{{ asset('plugins/froiden-helper/helper.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link href="{{ asset('css/custom-new.css') }}?v=0.1" rel="stylesheet">

    <link href="{{ asset('css/rounded.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .bg-title-left {
            margin-top: auto;
        }
        .bg-title-right {
            margin-top: auto;
        }
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @if($pushSetting->status == 'active')
        <link rel="manifest" href="{{ asset('manifest.json') }}" />
        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async='async'></script>
        <script>
            var OneSignal = window.OneSignal || [];
            OneSignal.push(function() {
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
                        .then(function(userId) {
                            if (!userId) {
                                OneSignal.registerForPushNotifications();
                            }
                            else{
                                let db_onesignal_id = '{{ $user->onesignal_player_id }}';

                                if((db_onesignal_id == null || db_onesignal_id !== userId) && userId !== null){ //update onesignal ID if it is new
                                    updateOnesignalPlayerId(userId);
                                }
                            }
                        })
                } else {
                    OneSignal.isPushNotificationsEnabled(function(isEnabled) {
                        if (isEnabled){
                            console.log("Push notifications are enabled! - 2    ");
                            // console.log("unsubscribe");
                            // OneSignal.setSubscription(false);
                        }
                        else{
                            console.log("Push notifications are not enabled yet. - 2");
                            // OneSignal.showHttpPrompt();
                            // OneSignal.registerForPushNotifications({
                            //         modalPrompt: true
                            // });
                        }

                        OneSignal.getUserId(function(userId) {
                            console.log("OneSignal User ID:", userId);
                            // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316
                            let db_onesignal_id = '{{ $user->onesignal_player_id }}';
                            console.log('database id : '+db_onesignal_id);

                            if((db_onesignal_id == null || db_onesignal_id !== userId) && userId !== null){ //update onesignal ID if it is new
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
            .navbar-header {
                background: var(--header_color);
            }
            .content-wrapper .sidebar #side-menu>li:hover{
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
            .menu-footer,.menu-copy-right{
                border-top: 1px solid #2f3544;
                background: var(--sidebar_color);
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

            .form-control{
                color: black !important;
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

            .admin-panel-name{
                background: var(--header_color);
            }

            /*fullcalendar css*/
            .fc th.fc-widget-header{
                background: var(--sidebar_color);
            }

            .fc-button{
                background: var(--header_color);
                color: var(--link_color);
                margin-left: 2px !important;
            }

            .fc-unthemed .fc-today{
                color: #757575 !important;
            }

            .user-pro{
                background-color: var(--sidebar_color);
            }


            .top-left-part{
                background: var(--sidebar_color);
            }

            .notify .heartbit{
                border: 5px solid var(--sidebar_color);
            }

            .notify .point{
                background-color: var(--sidebar_color);
            }
            .dropdown-menu.mailbox{
                padding-top: 0;
            }
            #side-menu li:hover{
                background-color: #041731 !important;
            }
            #side-menu li:hover {
                background: #041731 !important;
            }
            .filter-section-show{
                display: none !important;
            }
        </style>

        <style>
            {!! $adminTheme->user_css !!}
        </style>
        {{--Custom theme styles end--}}
    @endif


    <style>
        .sidebar .notify  {
            margin: 0 !important;
        }
        .sidebar .notify .heartbit {
            top: -23px !important;
            right: -15px !important;
        }
        .sidebar .notify .point {
            top: -13px !important;
        }
        .right-sidebar{
            margin-top: 60px;
        }
        h4 {
            line-height: 22px !important;
            font-size: 18px !important;
        }

        .language-switcher:nth-child(3){
            display: none !important;
        }

        #side-menu>li:not(.user-pro)>a {
            font-size: 13px !important;
        }
        .white-box {
            background-color: #ffffff !important;
        }
        .container-fluid>.col-md-12:first-child {
            background-color: #ffffff !important;
        }
        .bg-title {
            background-color: #ffffff !important;
        }
        body{
            font-family: 'Be Vietnam Pro', sans-serif;
        }
        .table th {
            color: #fff !important;
            background-color: #212529 !important;
            border-color: #32383e !important;
        }
        .odd{
            background-color: #f7fafc !important;
        }
        .box-title{
            color: blue;
            font-size: 20px !important;
        }
        .form-control{
            background-color: #f3f3f3 !important;
        }
        .control-label{
            color: #a90202;
        }
        .form-group label{
            color: #a90202;
        }
        .row label{
            color: #a90202;
        }
    </style>


</head>
<body class="fix-sidebar @if($rtl == 1) rtl @endif">
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
    <!-- Left navbar-header -->
@include('sections.super_admin_left_sidebar')
<!-- Left navbar-header end -->
    <!-- Page Content -->
    <div id="page-wrapper" class="row">
        <div class="container-fluid">

            @if (!empty($__env->yieldContent('filter-section')))
                <div class="col-md-3 filter-section">
                    <h5><i class="fa fa-sliders"></i> @lang('app.filterResults')</h5>
                    <h5 class="pull-right hidden-sm hidden-md hidden-xs">
                        <button class="btn btn-default btn-xs btn-circle btn-outline filter-section-close" ><i class="fa fa-chevron-left"></i></button>
                    </h5>
                    @yield('filter-section')
                </div>
            @endif

            @if (!empty($__env->yieldContent('other-section')))
                <div class="col-md-3 filter-section other-section">
                    @yield('other-section')
                </div>
            @endif


            <div class="
            @if (!empty($__env->yieldContent('filter-section')) || !empty($__env->yieldContent('other-section')))
                    col-md-9
@else
                    col-md-12
@endif
                    data-section">
                <button class="btn btn-default btn-xs btn-circle btn-outline m-t-5 filter-section-show hidden-sm hidden-md" style="display:none;margin-top: 60px !important;"><i class="fa fa-chevron-right"></i></button>
                @if (!empty($__env->yieldContent('filter-section')) || !empty($__env->yieldContent('other-section')))
                    <div class="row hidden-md hidden-lg">
                        <div class="col-xs-12 p-l-25 m-t-10">
                            <button class="btn btn-inverse btn-outline" id="mobile-filter-toggle"><i class="fa fa-sliders"></i></button>
                        </div>
                    </div>
                @endif

                <div class="header">
                    <div class="header-left">
                        <a href="/" class="logo">
                            <img src="/img/logo.png">
                        </a>
                    </div>
{{--                    <a class="toggle_btn open-close hidden-xs waves-effect waves-light" href="javascript:void(0);">--}}
{{--                        <span class="bar-icon">--}}
{{--                            <span></span>--}}
{{--                            <span></span>--}}
{{--                            <span></span>--}}
{{--                        </span>--}}
{{--                    </a>--}}
                    <ul class="nav user-menu">
{{--                        <li class="nav-item dropdown show-user-notifications">--}}
{{--                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">--}}
{{--                                <i class="fa fa-bell-o"></i> <span class="badge badge-pill noti-count"></span>--}}
{{--                            </a>--}}
{{--                            <div class="dropdown-menu notifications">--}}
{{--                                <div class="noti-content">--}}
{{--                                    <ul class="notification-list mailbox"></ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item dropdown has-arrow main-drop">--}}
{{--                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">--}}
{{--                                <span>Create</span>--}}
{{--                            </a>--}}
{{--                            <div class="dropdown-menu">--}}
{{--                                @if(in_array('projects',$modules))--}}
{{--                                    <a class="dropdown-item dropdown-custom" href="{{ route('admin.projects.create') }}">@lang('app.add') @lang('app.project')</a>--}}
{{--                                @endif--}}

{{--                                @if(in_array('tasks',$modules))--}}
{{--                                    <a class="dropdown-item dropdown-custom" href="{{ route('admin.all-tasks.create') }}">@lang('app.add') @lang('app.task')</a>--}}
{{--                                @endif--}}

{{--                                @if(in_array('clients',$modules))--}}
{{--                                    <a class="dropdown-item dropdown-custom" href="{{ route('admin.clients.create') }}">@lang('app.add') @lang('app.client')</a>--}}
{{--                                @endif--}}

{{--                                @if(in_array('employees',$modules))--}}
{{--                                    <a class="dropdown-item dropdown-custom" href="{{ route('admin.employees.create') }}">@lang('app.add') @lang('app.employee')</a>--}}
{{--                                @endif--}}

{{--                                @if(in_array('payments',$modules))--}}
{{--                                    <a class="dropdown-item dropdown-custom" href="{{ route('admin.payments.create') }}">@lang('modules.payments.addPayment')</a>--}}
{{--                                @endif--}}

{{--                                @if(in_array('tickets',$modules))--}}
{{--                                    <a class="dropdown-item dropdown-custom" href="{{ route('admin.tickets.create') }}">@lang('app.add') @lang('modules.tickets.ticket')</a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </li>--}}
                        
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
                            <span style="color: inherit;font-size:15px;padding-left:5px">{{ ucwords($global->locale) }}</span></span>
                            </a>
                            <div class="dropdown-menu">
                            <a class="dropdown-item dropdown-custom" href="{{ route('super-admin.language.change', ['lang' => 'en']) }}">English</a>
                            <a class="dropdown-item dropdown-custom" href="{{ route('super-admin.language.change', ['lang' => 'fr']) }}">French</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown has-arrow main-drop">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <span class="user-img"><img src="{{ $user->image_url }}" alt="">
                            <span class="status online"></span></span>
                                <span>{{ ucwords($user->name) }}</span>
                            </a>
                            <div class="dropdown-menu">
                                {{--                                <a class="dropdown-item dropdown-custom" href="{{ route('member.dashboard') }}">@lang('app.loginAsEmployee')</a>--}}
                                {{--                                @if($isClient)--}}
                                {{--                                    <a class="dropdown-item dropdown-custom" href="{{ route('client.dashboard.index') }}">@lang('app.loginAsClient')</a>--}}
                                {{--                                @endif--}}
                                {{--                                @if(in_array('ticket support',$modules))--}}
                                {{--                                    <a class="dropdown-item dropdown-custom" href="{{ route('admin.support-tickets.index') }}">@lang('app.supportTicket')</a>--}}
                                {{--                                @endif--}}
                                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item dropdown-custom" href="{{ route('logout') }}">@lang('app.logout')</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>



                    </ul>
                </div>

                @yield('page-title')

            <!-- .row -->
                @yield('content')

                @include('sections.right_sidebar')

            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

{{--sticky note modal--}}
<div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            Loading ...
        </div>
    </div>
</div>

<div class="modal fade bs-modal-md in" id="projectTimerModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
{{--sticky note modal ends--}}

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
    $('.show-user-notifications').click(function () {
        var token = '{{ csrf_token() }}';
        $.easyAjax({
            type: 'POST',
            url: '{{ route("show-superadmin-user-notifications") }}',
            data: {'_token': token},
            success: function (data) {
                if (data.status == 'success') {
                    $('.mailbox').html(data.html);
                }
            }
        });

    });

    $('.mailbox').on('click', '.mark-notification-read', function () {
        var token = '{{ csrf_token() }}';
        $.easyAjax({
            type: 'POST',
            url: '{{ route("mark-superadmin-notification-read") }}',
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
        var url = '{{ route('show-all-super-admin-notifications')}}';
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

    $('body').on('click', '.right-side-toggle', function () {
        $(".right-sidebar").slideDown(50).removeClass("shw-rside");
    })


    function updateOnesignalPlayerId(userId) {
        $.easyAjax({
            url: '{{ route("super-admin.profile.updateOneSignalId") }}',
            type: 'POST',
            data:{'userId':userId, '_token':'{{ csrf_token() }}'},
            success: function (response) {
            }
        })
    }

    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css( "overflow", "inherit" );
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css( "overflow", "auto" );
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
        setTimeout(function(){
            var getActiveMenu = $('#side-menu  li.active li a.active').length;
            // console.log(getActiveMenu);
            if(getActiveMenu > 0) {
                $('#side-menu  li.active li a.active').parent().parent().parent().find('a:first').addClass('active');
            }

            var token = '{{ csrf_token() }}';
            $.easyAjax({
                type: 'POST',
                url: '{{ route("show-superadmin-user-notifications") }}',
                data: {'_token': token},
                success: function (data) {
                    if (data.status == 'success') {
                        $('.mailbox').html(data.html);
                    }
                }
            });

        }, 200);

    })

    $('body').on('click', '.toggle-password', function() {
        var $selector = $(this).parent().find('input');
        $(this).toggleClass("fa-eye fa-eye-slash");
        var $type = $selector.attr("type") === "password" ? "text" : "password";
        $selector.attr("type", $type);
    });
    var currentUrl = '{{ request()->route()->getName() }}';
    $('body').on('click', '.filter-section-close', function() {
        localStorage.setItem('filter-'+currentUrl, 'hide');

        $('.filter-section').toggle();
        $('.filter-section-show').toggle();
        $('.data-section').toggleClass("col-md-9 col-md-12")
    });

    $('body').on('click', '.filter-section-show', function() {
        localStorage.setItem('filter-'+currentUrl, 'show');

        $('.filter-section-show').toggle();
        $('.data-section').toggleClass("col-md-9 col-md-12")
        $('.filter-section').toggle();
    });

    var currentUrl = '{{ request()->route()->getName() }}';
    var checkCurrentUrl = localStorage.getItem('filter-'+currentUrl);
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
@stack('footer-script')

</body>
</html>
