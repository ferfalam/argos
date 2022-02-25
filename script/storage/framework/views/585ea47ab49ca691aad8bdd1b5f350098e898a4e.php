<!DOCTYPE html>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e($superadmin->favicon_url); ?>">
    
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo e($superadmin->favicon_url); ?>">
    <meta name="theme-color" content="#ffffff">

    <title><?php echo app('translator')->get('app.adminPanel'); ?> | <?php echo e(__($pageTitle)); ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo e(asset('bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link rel='stylesheet prefetch'
          href='https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css'>
    <link rel='stylesheet prefetch'
          href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css'>

    <!-- This is Sidebar menu CSS -->
    <link href="<?php echo e(asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('plugins/bower_components/toast-master/css/jquery.toast.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('plugins/bower_components/sweetalert/sweetalert.css')); ?>" rel="stylesheet">

    <!-- This is a Animation CSS -->
    <link href="<?php echo e(asset('css/animate.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldPushContent('head-script'); ?>

            <!-- This is a Custom CSS -->
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <!-- color CSS you can use different color css from css/colors folder -->
    <!-- We have chosen the skin-blue (default.css) for this starter
       page. However, you can choose any other skin from folder css / colors .
       -->
    <link href="<?php echo e(asset('css/colors/default.css')); ?>" id="theme" rel="stylesheet">
    <link href="<?php echo e(asset('plugins/froiden-helper/helper.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/magnific-popup.css')); ?>">
    <link href="<?php echo e(asset('css/custom-new.css')); ?>" rel="stylesheet">

    <?php if($global->rounded_theme): ?>
    <link href="<?php echo e(asset('css/rounded.css')); ?>" rel="stylesheet">
    <?php endif; ?>

    <?php if(file_exists(public_path().'/css/admin-custom.css')): ?>
    <link href="<?php echo e(asset('css/admin-custom.css')); ?>" rel="stylesheet">
    <?php endif; ?>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php if($pushSetting->status == 'active' && !module_enabled('Subdomain')): ?>
    <link rel="manifest" href="<?php echo e(asset('manifest.json')); ?>" />
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async='async'></script>
    <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "<?php echo e($pushSetting->onesignal_app_id); ?>",
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
                            let db_onesignal_id = '<?php echo e($user->onesignal_player_id); ?>';

                            if(db_onesignal_id == null || db_onesignal_id !== userId){ //update onesignal ID if it is new
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
                        let db_onesignal_id = '<?php echo e($user->onesignal_player_id); ?>';
                        console.log('database id : '+db_onesignal_id);

                        if(db_onesignal_id == null || db_onesignal_id !== userId){ //update onesignal ID if it is new
                           updateOnesignalPlayerId(userId);
                        }


                    });


                    OneSignal.showHttpPrompt();
                });

            }
        });
    </script>
    <?php endif; ?>

    <?php if($global->active_theme == 'custom'): ?>
    
    <style>
        :root {
            --header_color: <?php echo e($adminTheme->header_color); ?>;
            --sidebar_color: <?php echo e($adminTheme->sidebar_color); ?>;
            --link_color: <?php echo e($adminTheme->link_color); ?>;
            --sidebar_text_color: <?php echo e($adminTheme->sidebar_text_color); ?>;
        }

        .pace .pace-progress {
            background: var(--header_color);
        }

        .menu-footer,.menu-copy-right{
            border-top: 1px solid #2f3544;
            background: var(--sidebar_color);
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
    </style>

    <style>
        <?php echo $adminTheme->user_css; ?>

    </style>
    
    <?php endif; ?>

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
        /* .content-wrapper .sidebar #side-menu>li>.active {
            background: transparent;
        }
        .content-wrapper .sidebar #side-menu>li>.active:hover {
            background: #272d36;
        } */
        #section-task {
        padding-bottom: 0px;
        }
    </style>


</head>
<body class="fix-sidebar <?php if($rtl == 1): ?> rtl <?php endif; ?>">
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
    <?php 
        $filterSection = false;
    ?>
<div id="wrapper">





    <?php 
        $filterSection = false;
    ?>
    <!-- Left navbar-header -->
    <?php echo $__env->make('sections.left_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- Left navbar-header end -->
    <!-- Page Content -->
    <div id="page-wrapper" class="row">
        <div class="container-fluid">

            <?php if(!empty($__env->yieldContent('filter-section'))): ?>
            <?php 
                $filterSection = true;
            ?>
                <div class="col-md-3 filter-section" style="overflow-x: hidden;">
                    <h5 class="pull-left"><i class="fa fa-sliders"></i> <?php echo app('translator')->get('app.filterResults'); ?></h5>
                    <h5 class="pull-right hidden-sm hidden-md hidden-xs">
                        <button class="btn btn-default btn-xs btn-circle btn-outline filter-section-close" ><i class="fa fa-chevron-left"></i></button>
                    </h5>

                    <?php echo $__env->yieldContent('filter-section'); ?>
                </div>
             <?php endif; ?>

             <?php if(!empty($__env->yieldContent('other-section'))): ?>
                <div class="col-md-3 filter-section other-section">
                    <?php echo $__env->yieldContent('other-section'); ?>
                </div>
             <?php endif; ?>


            <div class="
            <?php if(!empty($__env->yieldContent('filter-section')) || !empty($__env->yieldContent('other-section'))): ?>
            col-md-9
            <?php else: ?>
            col-md-12
            <?php endif; ?>
            data-section" id ="section-task">
                <button class="btn btn-default btn-xs btn-outline btn-circle m-t-5 filter-section-show hidden-sm hidden-md" style="display:none"><i class="fa fa-chevron-right"></i></button>
                <?php if(!empty($__env->yieldContent('filter-section')) || !empty($__env->yieldContent('other-section'))): ?>
                    <div class="row hidden-md hidden-lg">
                        <div class="col-xs-12 p-l-25 m-t-10">
                            <button class="btn btn-inverse btn-outline" id="mobile-filter-toggle"><i class="fa fa-sliders"></i></button>
                        </div>
                    </div>
                <?php endif; ?>













                <div class="header">
                    <div class="header-left">
                        <a href="/" class="logo">
                            <img src="/img/logo.png">
                        </a>
                    </div>
                    <a class="toggle_btn open-close hidden-xs waves-effect waves-light" href="javascript:void(0);">
                        <span class="bar-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </a>
                    <ul class="nav user-menu">
                        <li class="nav-item dropdown show-user-notifications">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i> <span class="badge badge-pill noti-count"></span>
                            </a>
                            <div class="dropdown-menu notifications">
                                <div class="noti-content">
                                    <ul class="notification-list mailbox"></ul>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <select class="selectpicker language-switcher  pull-right" data-width="fit">
                                <option value="en" <?php if($global->locale == "en"): ?> selected <?php endif; ?> data-content='<span class="flag-icon flag-icon-gb"></span>'>En</option>
                                <?php $__currentLoopData = $languageSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($language->language_code); ?>" <?php if($global->locale == $language->language_code): ?> selected <?php endif; ?>  data-content='<span class="flag-icon <?php if($language->language_code == 'zh-CN'): ?> flag-icon-cn <?php elseif($language->language_code == 'zh-TW'): ?> flag-icon-tw <?php else: ?> flag-icon-<?php echo e($language->language_code); ?> <?php endif; ?>"></span>'><?php echo e($language->language_code); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </li>
                        <li class="nav-item dropdown main-drop">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <i class="fa fa-plus-circle"></i>
                            </a>
                            <div class="dropdown-menu">
                                <?php if(in_array('projects',$modules)): ?>
                                    <a class="dropdown-item dropdown-custom" href="<?php echo e(route('admin.projects.create')); ?>"><?php echo app('translator')->get('app.add'); ?> <?php echo app('translator')->get('app.project'); ?></a>
                                <?php endif; ?>

                                <?php if(in_array('tasks',$modules)): ?>
                                    <a class="dropdown-item dropdown-custom" href="<?php echo e(route('admin.all-tasks.create')); ?>"><?php echo app('translator')->get('app.add'); ?> <?php echo app('translator')->get('app.task'); ?></a>
                                <?php endif; ?>

                                <?php if(in_array('clients',$modules)): ?>
                                    <a class="dropdown-item dropdown-custom" href="<?php echo e(route('admin.clients.create')); ?>"><?php echo app('translator')->get('app.add'); ?> <?php echo app('translator')->get('app.client'); ?></a>
                                <?php endif; ?>

                                <?php if(in_array('employees',$modules)): ?>
                                    <a class="dropdown-item dropdown-custom" href="<?php echo e(route('admin.employees.create')); ?>"><?php echo app('translator')->get('app.add'); ?> <?php echo app('translator')->get('app.employee'); ?></a>
                                <?php endif; ?>

                                <?php if(in_array('payments',$modules)): ?>
                                    <a class="dropdown-item dropdown-custom" href="<?php echo e(route('admin.payments.create')); ?>"><?php echo app('translator')->get('modules.payments.addPayment'); ?></a>
                                <?php endif; ?>

                                <?php if(in_array('tickets',$modules)): ?>
                                    <a class="dropdown-item dropdown-custom" href="<?php echo e(route('admin.tickets.create')); ?>"><?php echo app('translator')->get('app.add'); ?> <?php echo app('translator')->get('modules.tickets.ticket'); ?></a>
                                <?php endif; ?>
                            </div>
                        </li>
                        <li class="nav-item dropdown has-arrow main-drop">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <span class="user-img"><img src="<?php echo e($user->image_url); ?>" alt="">
                            <span class="status online"></span></span>
                            <span><?php echo e(ucwords($user->name)); ?></span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item dropdown-custom" href="<?php echo e(route('member.dashboard')); ?>"><?php echo app('translator')->get('app.loginAsEmployee'); ?></a>
                                <?php if($isClient): ?>
                                <a class="dropdown-item dropdown-custom" href="<?php echo e(route('client.dashboard.index')); ?>"><?php echo app('translator')->get('app.loginAsClient'); ?></a>
                                <?php endif; ?>
                                <?php if(in_array('ticket support',$modules)): ?>
                                <a class="dropdown-item dropdown-custom" href="<?php echo e(route('admin.support-tickets.index')); ?>"><?php echo app('translator')->get('app.supportTicket'); ?></a>
                                <?php endif; ?>
                                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item dropdown-custom" href="<?php echo e(route('logout')); ?>"><?php echo app('translator')->get('app.logout'); ?></a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo e(csrf_field()); ?>

                            </form>
                            </div>
                        </li>
                    </ul>
                </div>

















                <?php echo $__env->yieldContent('page-title'); ?>

                <!-- .row -->
                <?php echo $__env->yieldContent('content'); ?>

                <?php echo $__env->make('sections.right_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                

            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->


<div id="footer-sticky-notes" class="row hidden-xs hidden-sm">
    <div class="col-xs-12" id="sticky-note-header">
        <div class="col-xs-10" style="line-height: 30px">
        <?php echo app('translator')->get('app.menu.stickyNotes'); ?> <a href="javascript:;" onclick="showCreateNoteModal()" class="btn btn-success btn-outline btn-xs m-l-10"><i class="fa fa-plus"></i> <?php echo app('translator')->get("modules.sticky.addNote"); ?></a>
            </div>
        <div class="col-xs-2">
            <a href="javascript:;" class="btn btn-default btn-circle pull-right" id="open-sticky-bar"><i class="fa fa-chevron-up"></i></a>
            <a style="display: none;" class="btn btn-default btn-circle pull-right" href="javascript:;" id="close-sticky-bar"><i class="fa fa-chevron-down"></i></a>
        </div>

    </div>

    <div id="sticky-note-list" style="display: none">

        <?php $__currentLoopData = $stickyNotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-12 sticky-note" id="stickyBox_<?php echo e($note->id); ?>">
            <div class="well
             <?php if($note->colour == 'red'): ?>
                bg-danger
             <?php endif; ?>
             <?php if($note->colour == 'green'): ?>
                bg-success
             <?php endif; ?>
             <?php if($note->colour == 'yellow'): ?>
                bg-warning
             <?php endif; ?>
             <?php if($note->colour == 'blue'): ?>
                bg-info
             <?php endif; ?>
             <?php if($note->colour == 'purple'): ?>
                bg-purple
             <?php endif; ?>
             b-none">
                <p><?php echo nl2br($note->note_text); ?></p>
                <hr>
                <div class="row font-12">
                    <div class="col-xs-9">
                        <?php echo app('translator')->get("modules.sticky.lastUpdated"); ?>: <?php echo e($note->updated_at->diffForHumans()); ?>

                    </div>
                    <div class="col-xs-3">
                        <a href="javascript:;"  onclick="showEditNoteModal(<?php echo e($note->id); ?>)"><i class="ti-pencil-alt text-white"></i></a>
                        <a href="javascript:;" class="m-l-5" onclick="deleteSticky(<?php echo e($note->id); ?>)" ><i class="ti-close text-white"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
</div>

<a href="javascript:;" id="sticky-note-toggle"><i class="icon-note"></i></a>




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



<div class="modal fade bs-modal-md in"  id="subTaskModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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


<!-- jQuery -->
<script src="<?php echo e(asset('plugins/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo e(asset('bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js'></script>

<!-- Sidebar menu plugin JavaScript -->
<script src="<?php echo e(asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')); ?>"></script>
<!--Slimscroll JavaScript For custom scroll-->
<script src="<?php echo e(asset('js/jquery.slimscroll.js')); ?>"></script>
<!--Wave Effects -->
<script src="<?php echo e(asset('js/waves.js')); ?>"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo e(asset('plugins/bower_components/sweetalert/sweetalert.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/custom.js')); ?>"></script>
<script src="<?php echo e(asset('js/jasny-bootstrap.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/froiden-helper/helper.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/toast-master/js/jquery.toast.js')); ?>"></script>


<script src="<?php echo e(asset('js/cbpFWTabs.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/icheck/icheck.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/icheck/icheck.init.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.magnific-popup.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.magnific-popup-init.js')); ?>"></script>


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
    $('body').on('click', '.timer-modal', function(){
        var url = '<?php echo e(route('admin.all-time-logs.show-active-timer')); ?>';
        $('#modelHeading').html('Active Timer');
        $.ajaxModal('#projectTimerModal',url);
    });

    $('.datepicker, #start-date, #end-date').on('click', function(e) {
        e.preventDefault();
        $(this).attr("autocomplete", "off");
    });

    var filter =  '<?php echo e($filterSection); ?>';
    document.addEventListener("keydown", function(event) {
        if (event.keyCode === 190 && (event.altKey && event.shiftKey)) {
            $('.ti-angle-double-right').click();
        }else if (event.keyCode === 84 && (event.altKey && event.shiftKey)) {
            window.location.href = "<?php echo e(route('admin.all-tasks.create')); ?>"
        }else if(event.keyCode === 80 && (event.altKey && event.shiftKey)) {
            window.location.href = "<?php echo e(route('admin.projects.create')); ?>"
        }
        if ((filter)){
             if(event.keyCode === 191 && (event.altKey && event.shiftKey)) {
                if(localStorage.getItem('filter-'+currentUrl) == 'hide'){
                    $('.filter-section-show').click();
                    localStorage.setItem('filter-'+currentUrl, 'show');
                }
                else{
                    $('.filter-section-close').click();
                    localStorage.setItem('filter-'+currentUrl, 'hide');
                }

            }
        }
        
    });

    function addOrEditStickyNote(id)
    {
        var url = '';
        var method = 'POST';
        if(id === undefined || id == "" || id == null) {
            url =  '<?php echo e(route('admin.sticky-note.store')); ?>'
        } else{

            url = "<?php echo e(route('admin.sticky-note.update',':id')); ?>";
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
            data:{'notetext':noteText,'stickyColor':stickyColor,'_token':'<?php echo e(csrf_token()); ?>'},
            success: function (response) {
                $("#responsive-modal").modal('hide');
                getNoteData();
            }
        })
    }

    // FOR SHOWING FEEDBACK DETAIL IN MODEL
    function showCreateNoteModal(){
        var url = '<?php echo e(route('admin.sticky-note.create')); ?>';

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
    function showEditNoteModal(id){
        var url = '<?php echo e(route('admin.sticky-note.edit',':id')); ?>';
        url  = url.replace(':id',id);

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

    function selectColor(id){
        $('.icolors li.active ').removeClass('active');
        $('#'+id).addClass('active');
        $('#stickyColor').val(id);

    }


    function deleteSticky(id){

        swal({
            title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
            text: "<?php echo app('translator')->get('messages.confirmation.deleteStickyNote'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?php echo app('translator')->get('messages.deleteConfirmation'); ?>",
            cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm){
            if (isConfirm) {

                var url = "<?php echo e(route('admin.sticky-note.destroy',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'POST',
                    url: url,
                    data: {'_token': token, '_method': 'DELETE'},
                    success: function (response) {
                        $('#stickyBox_'+id).hide('slow');
                        $("#responsive-modal").modal('hide');
                        getNoteData();
                    }
                });
            }
        });
    }


    //getting all chat data according to user
    function getNoteData(){

        var url = "<?php echo e(route('admin.sticky-note.index')); ?>";

        $.easyAjax({
            type: 'GET',
            url: url,
            messagePosition: '',
            data:  {},
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
        var token = '<?php echo e(csrf_token()); ?>';
        $.easyAjax({
            type: 'POST',
            url: '<?php echo e(route("show-admin-notifications")); ?>',
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
        var token = '<?php echo e(csrf_token()); ?>';
        $.easyAjax({
            type: 'POST',
            url: '<?php echo e(route("mark-notification-read")); ?>',
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
        var url = '<?php echo e(route('show-all-member-notifications')); ?>';
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
            url: '<?php echo e(route("admin.settings.change-language")); ?>',
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

    $('#sticky-note-list').css('max-height', viewportHeight-150);

    stickyNoteOpen.click(function () {
        $('#sticky-note-list').toggle(function () {
            $(this).animate({
                height: (viewportHeight-150)
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
            url: '<?php echo e(route("member.profile.updateOneSignalId")); ?>',
            type: 'POST',
            data:{'userId':userId, '_token':'<?php echo e(csrf_token()); ?>'},
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

            var token = '<?php echo e(csrf_token()); ?>';
            $.easyAjax({
                type: 'POST',
                url: '<?php echo e(route("show-admin-notifications")); ?>',
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

    $('body').on('click', '.toggle-password', function() {
        var $selector = $(this).parent().find('input.form-control');
        $(this).toggleClass("fa-eye fa-eye-slash");
        var $type = $selector.attr("type") === "password" ? "text" : "password";
        $selector.attr("type", $type);
    });

    var currentUrl = '<?php echo e(request()->route()->getName()); ?>';
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

    var currentUrl = '<?php echo e(request()->route()->getName()); ?>';
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
<?php echo $__env->yieldPushContent('footer-script'); ?>
<script>
    var checkDatatable = $.fn.DataTable;
    if(checkDatatable != undefined){
        checkDatatable.ext.errMode = function (settings, tn, msg) {
            console.log(settings, tn, msg);
            if (settings && settings.jqXHR && settings.jqXHR.status == 401) {
                // Handling for 401 specifically
                window.location.reload();
            }
            else{
                alert(msg);
            }
        };
    }
    
</script>
</body>
</html>
<?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/layouts/app.blade.php ENDPATH**/ ?>