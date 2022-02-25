<?php if($global->system_update == 1): ?>
    <?php ($updateVersionInfo = \Froiden\Envato\Functions\EnvatoUpdate::updateVersionInfo()); ?>
    <?php if(isset($updateVersionInfo['lastVersion'])): ?>
        <div class="alert alert-info col-md-12">
            <div class="col-md-10"><i class="ti-gift"></i> <?php echo app('translator')->get('modules.update.newUpdate'); ?> <label
                        class="label label-success"><?php echo e($updateVersionInfo['lastVersion']); ?></label></div>
            <div class="col-md-2"><a href="<?php echo e(route('super-admin.update-settings.index')); ?>"
                                     class="btn btn-success btn-small"><?php echo app('translator')->get('modules.update.updateNow'); ?> <i
                            class="fa fa-arrow-right"></i></a></div>
        </div>
    <?php endif; ?>
<?php endif; ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/dashboard/update_message.blade.php ENDPATH**/ ?>