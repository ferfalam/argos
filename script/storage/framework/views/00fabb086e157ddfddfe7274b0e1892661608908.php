<?php $__env->startSection('page-title'); ?>
<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 bg-title-left">
        <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?></h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 text-right bg-title-right">
        <?php if($allModules): ?>
        <a href="<?php echo e(route('super-admin.custom-modules.create')); ?>" class="btn btn-success btn-sm btn-outline"><i
                class="fa fa-refresh"></i> <?php echo app('translator')->get('app.install'); ?>/<?php echo app('translator')->get('app.update'); ?> <?php echo app('translator')->get('app.module'); ?></a>
        <?php endif; ?>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('super-admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
            <li class="active"><?php echo e(__($pageTitle)); ?></li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/switchery/dist/switchery.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-inverse">

            <div class="vtabs customvtab">
                <?php echo $__env->make('sections.super_admin_setting_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="tab-content">
                    <div id="vhome3" class="tab-pane active">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title m-b-0"><?php echo app('translator')->get("app.menu.customModule"); ?></h3>

                                    <div class="row">

                                        <div class="col-xs-12">

                                            <ul class="list-group m-t-20" id="files-list">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <strong><?php echo app('translator')->get('app.name'); ?></strong>
                                                        </div>
                                                        <div class="col-md-4 text-right">
                                                            <strong>Envato Purchase code</strong>
                                                        </div>
                                                        <div class="col-md-2 text-right">
                                                            <strong><?php echo app('translator')->get('app.currentVersion'); ?></strong>
                                                        </div>
                                                        <div class="col-md-2 text-right">
                                                            <strong><?php echo app('translator')->get('app.latestVersion'); ?></strong>
                                                        </div>
                                                        <div class="col-md-2 text-right">
                                                            <strong><?php echo app('translator')->get('app.status'); ?></strong>
                                                        </div>
                                                        
                                                        
                                                        
                                                    </div>
                                                </li>
                                                <?php
                                                $count = 0;
                                                ?>
                                                <?php $__empty_1 = true; $__currentLoopData = $allModules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                                <li class="list-group-item" id="file-<?php echo e($count++); ?>">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <?php echo e($key); ?>

                                                        </div>
                                                        <div class="col-md-4 text-right">
                                                            <?php if(in_array($module, $worksuitePlugins)): ?>

                                                            <?php if(config(strtolower($module).'.setting')): ?>
                                                            <?php
                                                            $settingInstance = config(strtolower($module).'.setting');

                                                            $fetchSetting = $settingInstance::first();
                                                            ?>

                                                            <?php if(config(strtolower($module).'.verification_required')): ?>
                                                            <?php echo $fetchSetting->purchase_code ?? '<a href="javascript:;"
                                                                class="btn btn-success btn-sm btn-outline verify-module"
                                                                data-module="'. strtolower($module).'">'.__('app.verifyEnvato').'</a>'; ?>

                                                            <?php endif; ?>
                                                            <?php endif; ?>


                                                            <?php endif; ?>


                                                        </div>
                                                        <div class="col-md-2 text-right">
                                                            <?php if(config(strtolower($module).'.setting')): ?>
                                                            <label
                                                                class="label label-info"><?php echo e(File::get($module->getPath() . '/version.txt')); ?></label>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-md-2 text-right">
                                                            <?php if(config(strtolower($module).'.setting')): ?>
                                                            <label
                                                                class="label label-info"><?php echo e($version[config(strtolower($module).'.envato_item_id')]??'-'); ?></label>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-md-2 text-right">
                                                            <div class="switchery-demo">
                                                                <input type="checkbox" <?php if(in_array($module,
                                                                    $worksuitePlugins)): ?> checked <?php endif; ?>
                                                                    class="js-switch change-module-setting"
                                                                    data-size="small"
                                                                    data-module-name="<?php echo e($module); ?>" />
                                                            </div>

                                                        </div>
                                                        
                                                        
                                                        
                                                    </div>
                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <div class="text-center">
                                                    <div class="empty-space" style="height: 200px;">
                                                        <div class="empty-space-inner">
                                                            <div class="icon" style="font-size:30px"><i
                                                                    class="icon-layers"></i>
                                                            </div>
                                                            <div class="title m-b-15"><?php echo app('translator')->get('messages.noModules'); ?>
                                                            </div>
                                                            <div class="subtitle">
                                                                <a href="<?php echo e(route('super-admin.custom-modules.create')); ?>"
                                                                    class="btn btn-success btn-sm btn-outline"><i
                                                                        class="fa fa-refresh"></i> <?php echo app('translator')->get('app.install'); ?>
                                                                    /
                                                                    <?php echo app('translator')->get('app.update'); ?> <?php echo app('translator')->get('app.module'); ?></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endif; ?>

                                            </ul>
                                        </div>


                                        <?php echo $__env->make('vendor.froiden-envato.update.plugins', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                    <!--/row-->
                                </div>
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


<div class="modal fade bs-modal-md in" id="projectCategoryModal" role="dialog" aria-labelledby="myModalLabel"
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


<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
<script src="<?php echo e(asset('plugins/bower_components/switchery/dist/switchery.min.js')); ?>"></script>
<script>
    // Switchery
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function() {
        new Switchery($(this)[0], $(this).data());

    });

    $('.change-module-setting').change(function () {
        var module = $(this).data('module-name');

        if($(this).is(':checked'))
            var moduleStatus = 'active';
        else
            var moduleStatus = 'inactive';

        var url = '<?php echo e(route('super-admin.custom-modules.update', ':module')); ?>';
        url = url.replace(':module', module);
        $.easyAjax({
            url: url,
            type: "POST",
            data: { 'id': module, 'status': moduleStatus, '_method': 'PUT', '_token': '<?php echo e(csrf_token()); ?>' }
        })
    });

    $('.verify-module').click(function () {
        var module = $(this).data('module');
        var url = '<?php echo e(route('super-admin.custom-modules.show', ':module')); ?>';
        url = url.replace(':module', module);
        $('#modelHeading').html('Verify your purchase');
        $.ajaxModal('#projectCategoryModal', url);
    })
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.super-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/custom-modules/index.blade.php ENDPATH**/ ?>