<?php if(!is_null($global->last_cron_run)): ?>
    <?php if(\Carbon\Carbon::now()->diffInHours($global->last_cron_run) > 48): ?>
        <div class="clearfix"></div>
        <div class="col-md-12">

            <div class="alert alert-danger alert-dismissable">
                <?php echo app('translator')->get('messages.cronIsNotRunning'); ?>
            </div>

        </div>
    <?php endif; ?>
<?php else: ?>
    <div class="clearfix"></div>
    <div class="col-md-12">

        <div class="alert alert-danger alert-dismissable" id="<?php echo e($global->last_cron_run); ?>">
            <?php echo app('translator')->get('messages.cronIsNotRunning'); ?>
        </div>

    </div>
<?php endif; ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/dashboard/cron_job_message.blade.php ENDPATH**/ ?>