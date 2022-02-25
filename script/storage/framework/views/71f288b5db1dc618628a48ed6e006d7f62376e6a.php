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
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li class="active"><?php echo e(__($pageTitle)); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/css/asColorPicker.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/switchery/dist/switchery.min.css')); ?>">

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-inverse">
                <div class="panel-heading"><?php echo e(__($pageTitle)); ?></div>

                <div class="vtabs customvtab m-t-10">
                    <?php echo $__env->make('sections.admin_setting_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="tab-content">
                        <div id="vhome3" class="tab-pane active">
                            <div class="row">
                                <div class="col-sm-12">


                                        <div class="form-group">
                                            <div class="radio-list">
                                                <label class="radio-inline p-0">
                                                    <div class="radio radio-info">
                                                        <input type="radio" name="active_theme" <?php if($global->active_theme == 'default'): ?> checked <?php endif; ?> id="default_theme" value="default">
                                                        <label for="default_theme"><?php echo app('translator')->get('modules.themeSettings.useDefaultTheme'); ?></label>
                                                    </div>
                                                </label>
                                                <label class="radio-inline">
                                                    <div class="radio radio-info">
                                                        <input type="radio" name="active_theme" id="custom_theme" <?php if($global->active_theme == 'custom'): ?> checked <?php endif; ?> value="custom">
                                                        <label for="custom_theme"><?php echo app('translator')->get('modules.themeSettings.useCustomTheme'); ?></label>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
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
                                        <div class="form-group">
                                            <label
                                                class="control-label"><?php echo app('translator')->get('modules.themeSettings.enableRtl'); ?>
                                             </label>
                                            <div class="switchery-demo">
                                                <input type="checkbox" id="rtl" name="rtl"
                                                    <?php if($global->rtl == true): ?> checked
                                                <?php endif; ?> class="js-switch rtl" data-color="#00c292"
                                                data-secondary-color="#f96262"/>
                                            </div>
                                         </div>
                                        <div id="custom-theme-options" >
                                            <?php echo Form::open(['id'=>'editSettings','class'=>'ajax-form','method'=>'POST']); ?>

                                            <?php if(module_enabled('Subdomain') && $global->login_ui == 0): ?>
                                            <h3 class="box-title m-b-0"><b><?php echo app('translator')->get('app.login'); ?> <?php echo app('translator')->get('app.panel'); ?> <?php echo app('translator')->get('app.theme'); ?></b></h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="example">
                                                        <p class="box-title m-t-30"><?php echo app('translator')->get('app.loginLogoBackgroundColor'); ?></p>
                                                        <input type="text" class="complex-colorpicker form-control"  id="logo_background_color" required name="logo_background_color" value="<?php echo e($adminTheme->login_background); ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <?php endif; ?>
                                            <div <?php if($global->active_theme == 'default'): ?> style="display: none" <?php endif; ?>>
                                                <h3 class="box-title m-b-0"><b><?php echo app('translator')->get('modules.themeSettings.adminPanelTheme'); ?></b></h3>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="example">
                                                            <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.headerColor'); ?></p>
                                                            <input type="text" class="colorpicker form-control header_color" required name="theme_settings[1][header_color]" value="<?php echo e($adminTheme->header_color); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="example">
                                                            <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.sidebarColor'); ?></p>
                                                            <input type="text" class="complex-colorpicker sidebar_color form-control" required name="theme_settings[1][sidebar_color]" value="<?php echo e($adminTheme->sidebar_color); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="example">
                                                            <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.sidebarTextColor'); ?></p>
                                                            <input type="text" class="complex-colorpicker sidebar_text_color form-control" required name="theme_settings[1][sidebar_text_color]" value="<?php echo e($adminTheme->sidebar_text_color); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="example">
                                                            <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.linkColor'); ?></p>
                                                            <input type="text" class="complex-colorpicker link_color form-control" required name="theme_settings[1][link_color]" value="<?php echo e($adminTheme->link_color); ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                <h3 class="box-title m-b-0"><b><?php echo app('translator')->get('modules.themeSettings.employeePanelTheme'); ?></b></h3>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="example">
                                                            <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.headerColor'); ?></p>
                                                            <input type="text" class="colorpicker form-control" required name="theme_settings[3][header_color]" value="<?php echo e($employeeTheme->header_color); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="example">
                                                            <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.sidebarColor'); ?></p>
                                                            <input type="text" class="complex-colorpicker form-control" required name="theme_settings[3][sidebar_color]" value="<?php echo e($employeeTheme->sidebar_color); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="example">
                                                            <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.sidebarTextColor'); ?></p>
                                                            <input type="text" class="complex-colorpicker form-control" required name="theme_settings[3][sidebar_text_color]" value="<?php echo e($employeeTheme->sidebar_text_color); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="example">
                                                            <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.linkColor'); ?></p>
                                                            <input type="text" class="complex-colorpicker form-control" required name="theme_settings[3][link_color]" value="<?php echo e($employeeTheme->link_color); ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <h3 class="box-title m-b-0"><b><?php echo app('translator')->get('modules.themeSettings.clientPanelTheme'); ?></b></h3>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="example">
                                                            <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.headerColor'); ?></p>
                                                            <input type="text" class="colorpicker form-control" required name="theme_settings[4][header_color]" value="<?php echo e($clientTheme->header_color); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="example">
                                                            <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.sidebarColor'); ?></p>
                                                            <input type="text" class="complex-colorpicker form-control" required name="theme_settings[4][sidebar_color]" value="<?php echo e($clientTheme->sidebar_color); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="example">
                                                            <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.sidebarTextColor'); ?></p>
                                                            <input type="text" class="complex-colorpicker form-control" required name="theme_settings[4][sidebar_text_color]" value="<?php echo e($clientTheme->sidebar_text_color); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="example">
                                                            <p class="box-title m-t-30"><?php echo app('translator')->get('modules.themeSettings.linkColor'); ?></p>
                                                            <input type="text" class="complex-colorpicker form-control" required name="theme_settings[4][link_color]" value="<?php echo e($clientTheme->link_color); ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>







































                                            <div class="row">
                                                <div class="col-md-12 m-t-30">
                                                    <button class="btn btn-success" id="save-form" type="submit"><i class="fa fa-check"></i> <?php echo app('translator')->get('app.save'); ?></button>
                                                </div>
                                            </div>
                                            <?php echo Form::close(); ?>

                                        </div>

                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
    <!-- .row -->



<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
<script src="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/ace/ace.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/ace/theme-twilight.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/ace/mode-css.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/ace/jquery-ace.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/switchery/dist/switchery.min.js')); ?>"></script>

<script>
    // Colorpicker
 // Switchery
 var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
     $('.js-switch').each(function() {
     new Switchery($(this)[0], $(this).data());

    });
    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });

    // $('#logo_background_color').on('asColorPicker::change', function (e) {
    //     alert('hello');
    // });
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

    $('.my-code-area').ace({ theme: 'twilight', lang: 'css' })

    $('#save-form').click(function () {
        $.easyAjax({
            url: '<?php echo e(route('admin.theme-settings.store')); ?>',
            container: '#editSettings',
            data: $('#editSettings').serialize(),
            type: "POST",
            redirect: true
        })
    });

    $('input[name=active_theme]').click(function () {
        var theme = $('input[name=active_theme]:checked').val();

        $.easyAjax({
            url: '<?php echo e(route('admin.theme-settings.activeTheme')); ?>',
            type: "POST",
            data: {'_token': '<?php echo e(csrf_token()); ?>', 'active_theme': theme}
        })
    });

    $('input[name=rounded_theme]').click(function () {
        var theme = $('input[name=rounded_theme]:checked').val();

        $.easyAjax({
            url: '<?php echo e(route('admin.theme-settings.roundedTheme')); ?>',
            type: "POST",
            data: {'_token': '<?php echo e(csrf_token()); ?>', 'rounded_theme': theme}
        })
    });
    
    $('.rtl').change(function () {
        var rtl  = $('.rtl').is(':checked');
        $.easyAjax({
            url: '<?php echo e(route('admin.theme-settings.rtlTheme')); ?>',
            type: "POST",
            data: {'_token': '<?php echo e(csrf_token()); ?>', 'rtl': rtl}
        })
        return false;
    });
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/admin/theme-settings/edit.blade.php ENDPATH**/ ?>