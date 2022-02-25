<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 bg-title-left">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 bg-title-right">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('super-admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li class="active"><?php echo e(__($pageTitle)); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/image-picker/image-picker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/switchery/dist/switchery.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/css/asColorPicker.css')); ?>">

    <style>
        .thumbnail{
            color: black;
            font-weight: 600;
            text-align: center;
        }
        .thumbnail.selected{
            background-color: #f8c234 !important;
        }
        a{
            color:yellow;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel">

                <div class="vtabs customvtab p-t-10">
                    <?php if($global->front_design == 1): ?>
                        <?php echo $__env->make('sections.front_setting_new_theme_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php else: ?>
                        <?php echo $__env->make('sections.front_setting_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="white-box">
                                    <?php echo Form::open(['id'=>'editSettings','class'=>'ajax-form','method'=>'POST']); ?>

                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <h3 class="box-title m-b-10"><?php echo app('translator')->get('app.selectTheme'); ?> </h3>
                                            <div class="form-group" >
                                                <select name="theme" id="theme" class="image-picker image-picker-theme show-labels show-html" style="color: white">
                                                    <option
                                                            data-img-src="<?php echo e(asset('img/old-design.jpg')); ?>"
                                                            <?php if($global->front_design == 0): ?> selected <?php endif; ?>
                                                            value="0">
                                                        Theme 1
                                                    </option>

                                                    <option data-img-src="<?php echo e(asset('img/new-design.jpg')); ?>"
                                                            data-toggle="tooltip" data-original-title="Edit"
                                                            <?php if($global->front_design == 1): ?> selected <?php endif; ?>
                                                            value="1">Theme 2
                                                    </option>

                                                </select>

                                            </div>
                                        </div>

                                        <?php if(!module_enabled('Subdomain')): ?>
                                            <div class="col-md-12 col-xs-12" id="login_ui_box">
                                                <h3 class="box-title m-b-10"><?php echo app('translator')->get('app.login'); ?> <?php echo app('translator')->get('app.theme'); ?></h3>
                                                <div class="form-group" >
                                                    <select name="login_ui" id="login_ui" class="image-picker show-labels show-html login-theme" style="color: white">
                                                        <option
                                                                data-img-src="<?php echo e(asset('img/old-login.jpg')); ?>"
                                                                <?php if($global->login_ui == 0): ?> selected <?php endif; ?>
                                                                value="0">
                                                            Theme 1
                                                        </option>

                                                        <option data-img-src="<?php echo e(asset('img/new-login.jpg')); ?>"
                                                                data-toggle="tooltip" data-original-title="Edit"
                                                                <?php if($global->login_ui == 1): ?> selected <?php endif; ?>
                                                                value="1">Theme 2
                                                        </option>

                                                    </select>

                                                </div>

                                            </div>
                                        <?php endif; ?>
                                        <div class="row login-background-box">
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.enableRoundTheme'); ?></p>
                                                    <div class="radio-list">
                                                        <label class="radio-inline p-0">
                                                            <div class="radio radio-info">
                                                                <input type="radio" id="rounded_theme_yes" name="rounded_theme" <?php if($global->rounded_theme): ?> checked <?php endif; ?> value="1">
                                                                <label for="rounded_theme_yes"><?php echo app('translator')->get('app.yes'); ?></label>
                                                            </div>
                                                        </label>
                                                        <label class="radio-inline">
                                                            <div class="radio radio-info">
                                                                <input type="radio" id="rounded_theme_no" name="rounded_theme" <?php if(!$global->rounded_theme): ?> checked <?php endif; ?> value="0">
                                                                <label for="rounded_theme_no"><?php echo app('translator')->get('app.no'); ?></label>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-8">
                                                <div class="form-group">
                                                    <p class="box-title m-t-30"><?php echo app('translator')->get('app.loginLogoBackgroundColor'); ?></p>
                                                    <div class="example m-b-10">
                                                        <input type="text" class="complex-colorpicker form-control" id="logo_background_color" required name="logo_background_color" value="<?php echo e($superadminTheme?$superadminTheme->login_background:''); ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-4">
                                            <label for=""><?php echo app('translator')->get('modules.superadmin.disableFrontendSite'); ?></label>
                                            <div class="form-group">
                                                <div class="switchery-demo">
                                                    <input type="checkbox" id="frontend_disable"
                                                        name="frontend_disable"
                                                           <?php if($global->frontend_disable): ?> checked
                                                           <?php endif; ?> class="js-switch " data-color="#00c292"
                                                           data-secondary-color="#f96262"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="set-homepage-div" <?php if($global->frontend_disable): ?>
                                            style="display:none"
                                            <?php endif; ?>>
                                            <div class="col-md-4 col-xs-12" >
                                                <div class="form-group">
                                                    <label class="control-label"><?php echo app('translator')->get('modules.superadmin.setupHomepage'); ?></label>
                                                    <select name="setup_homepage" id="setup_homepage" class="form-control selectpicker">
                                                        <option 
                                                        <?php if($global->setup_homepage == "default"): ?>
                                                            selected
                                                        <?php endif; ?>
                                                        value="default"><?php echo app('translator')->get('modules.superadmin.defaultLanding'); ?></option>
                                                        <option 
                                                        <?php if($global->setup_homepage == "signup"): ?>
                                                            selected
                                                        <?php endif; ?>
                                                        value="signup"><?php echo app('translator')->get('app.signup'); ?></option>
                                                        <option 
                                                        <?php if($global->setup_homepage == "login"): ?>
                                                            selected
                                                        <?php endif; ?>
                                                        value="login"><?php echo app('translator')->get('app.login'); ?></option>
                                                        <option 
                                                        <?php if($global->setup_homepage == "custom"): ?>
                                                            selected
                                                        <?php endif; ?>
                                                        value="custom"><?php echo app('translator')->get('modules.superadmin.loadCustomUrl'); ?></option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-4" id="home_custom_url"
                                                <?php if($global->frontend_disable || 
                                                (!$global->frontend_disable && $global->setup_homepage != "custom")): ?>
                                                style="display:none"
                                                <?php endif; ?>
                                            >
                                                <label for=""><?php echo app('translator')->get('modules.superadmin.customUrl'); ?></label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="<?php echo e($global->custom_homepage_url); ?>" name="custom_homepage_url" id="custom_homepage_url">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    <div class="col-sm-12">
                                        <button type="submit" id="save-form" class="btn btn-success waves-effect waves-light m-r-10">
                                            <?php echo app('translator')->get('app.update'); ?>
                                        </button>
                                    </div>
                                </div>
                                <?php echo Form::close(); ?>

                                </div>
                            </div>
                        </div>    <!-- .row -->
                </div>

            </div>
        </div>


    </div>

<div class="modal fade bs-modal-md in" id="seoDetailModel" role="dialog" aria-labelledby="myModalLabel"
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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
<script src="<?php echo e(asset('plugins/image-picker/image-picker.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/switchery/dist/switchery.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js')); ?>"></script>

<script>

    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
    $('.header_color').on('asColorPicker::change', function (e) {
        document.documentElement.style.setProperty('--header_color', e.target.value);
    });

    $('.sidebar_color').on('asColorPicker::change', function (e) {
        document.documentElement.style.setProperty('--sidebar_color', e.target.value);
    });

    $('.sidebar_text_color').on('asColorPicker::change', function (e) {
        document.documentElement.style.setProperty('--sidebar_text_color', e.target.value);
    });

    $('.link_color').on('asColorPicker::change', function (e) {
        document.documentElement.style.setProperty('--link_color', e.target.value);
    });

    // Switchery
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function () {
        new Switchery($(this)[0], $(this).data());

    });

    $('#frontend_disable').change(function () {
        $('#set-homepage-div').toggle();
    })

    $('#theme').on('change', function() {
        alert( this.value );
    });

    <?php if($global->login_ui == 0): ?>
        $(".login-background-box").show();
    <?php else: ?>
        $(".login-background-box").hide();
    <?php endif; ?>

    $('.login-theme').change(function () {
        const theme = $(this).val();

        if (theme == '0') {
            $(".login-background-box").show()
        } else {
            $(".login-background-box").hide()
        }
    })

    $('#setup_homepage').change(function () {
        const homepage = $(this).val();

        if (homepage == "custom") {
            $("#home_custom_url").show()
        } else {
            $("#home_custom_url").hide()
        }
    })

    
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]'
    });
    $(".image-picker").imagepicker({
        show_label: true
    });

    $(".image-picker-theme").imagepicker({
        show_label  : true,
        changed:function (vale,newval) {
            if(newval ==1){
                $('#login_ui_box').show();
            }else{
                $('#login_ui_box').hide();
            }
        },
        initialized:function (vale) {
            if($(".image-picker-theme").val() ==1){
                    $('#login_ui_box').show();
                }else{
                    $('#login_ui_box').hide();
            }

        }
    })
    $('#save-form').click(function () {
        $.easyAjax({
            url: '<?php echo e(route('super-admin.theme-update')); ?>',
            container: '#editSettings',
            type: "POST",
            redirect: true,
            data: $('#editSettings').serialize()
        })
    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.super-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/front-theme-settings/index.blade.php ENDPATH**/ ?>