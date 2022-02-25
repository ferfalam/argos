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
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-inverse">
                <div class="panel-heading"><?php echo app('translator')->get('app.authSetting'); ?> <?php echo app('translator')->get('app.forTheme'); ?> <?php if($global->login_ui  && $global->front_design == 1): ?> 2 <?php else: ?> 1 <?php endif; ?></div>

                <div class="vtabs customvtab m-t-10">
                    <?php if($global->front_design == 1): ?>
                        <?php echo $__env->make('sections.front_setting_new_theme_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php else: ?>
                        <?php echo $__env->make('sections.front_setting_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                    <div class="tab-content">
                        <div id="vhome3" class="tab-pane active">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <?php echo Form::open(['id'=>'editSettings','class'=>'ajax-form','method'=>'POST']); ?>

                                        <hr>
                                    <div class="row">

                                        <div class="col-sm-12 col-md-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="company_name"><?php echo app('translator')->get('app.authCss'); ?></label>
                                                <?php if($global->login_ui == 1 && $global->front_design == 1): ?>
                                                    <textarea name="auth_css" class="my-code-area" rows="20" style="width: 100%"><?php if(is_null($global->auth_css_theme_two)): ?>/*Enter your auth css after this line*/<?php else: ?> <?php echo $global->auth_css_theme_two; ?> <?php endif; ?></textarea>
                                                <?php else: ?>
                                                    <textarea name="auth_css" class="my-code-area" rows="20" style="width: 100%"><?php if(is_null($global->auth_css)): ?>/*Enter your auth css after this line*/<?php else: ?> <?php echo $global->auth_css; ?> <?php endif; ?></textarea>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" id="save-form"
                                            class="btn btn-success waves-effect waves-light m-r-10">
                                        <?php echo app('translator')->get('app.update'); ?>
                                    </button>

                                    <?php echo Form::close(); ?>

                                </div>
                            </div>
                            <!-- .row -->
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
<script src="<?php echo e(asset('plugins/ace/ace.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/ace/theme-twilight.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/ace/mode-css.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/ace/jquery-ace.min.js')); ?>"></script>
<script>


    $('.my-code-area').ace({ theme: 'twilight', lang: 'css' })

    $('#save-form').click(function () {
        $.easyAjax({
            url: '<?php echo e(route('super-admin.auth-update')); ?>',
            container: '#editSettings',
            type: "POST",
            redirect: true,
            file: true,
        })
    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.super-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/auth-setting/index.blade.php ENDPATH**/ ?>