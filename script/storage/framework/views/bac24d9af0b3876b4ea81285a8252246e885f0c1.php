<form id="editSettings" class="ajax-form" data-language-id="<?php echo e($frontDetail->language_setting_id); ?>" data-type="<?php echo e($type); ?>">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="type" value="<?php echo e($type); ?>">

    <div class="row">
        <div class="col-sm-12 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="title"><?php echo app('translator')->get('app.title'); ?></label>
                <input type="text" class="form-control" id="title" name="title"
                <?php if($type == 'task'): ?>
                    value="<?php echo e($frontDetail->task_management_title); ?>"
                <?php elseif($type == 'bills'): ?>
                    value="<?php echo e($frontDetail->manage_bills_title); ?>"
                <?php elseif($type == 'image'): ?>
                    value="<?php echo e($frontDetail->feature_title); ?>"
                <?php elseif($type == 'team'): ?>
                    value="<?php echo e($frontDetail->teamates_title); ?>"
                <?php elseif($type == 'apps'): ?>
                    value="<?php echo e($frontDetail->favourite_apps_title); ?>"
                <?php endif; ?>
                >
            </div>
        </div>

        <div class="col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="address"><?php echo app('translator')->get('app.description'); ?></label>

                <?php if($type == 'task'): ?>
                    <textarea class="form-control" id="detail" rows="5" name="detail"><?php echo e($frontDetail->task_management_detail); ?></textarea>
                <?php elseif($type == 'bills'): ?>
                    <textarea class="form-control" id="detail" rows="5" name="detail"><?php echo e($frontDetail->manage_bills_detail); ?></textarea>
                <?php elseif($type == 'image'): ?>
                    <textarea class="form-control" id="detail" rows="5" name="detail"><?php echo e($frontDetail->feature_description); ?></textarea>
                <?php elseif($type == 'team'): ?>
                    <textarea class="form-control" id="detail" rows="5" name="detail"><?php echo e($frontDetail->teamates_detail); ?></textarea>
                <?php elseif($type == 'apps'): ?>
                    <textarea class="form-control" id="detail" rows="5" name="detail"><?php echo e($frontDetail->favourite_apps_detail); ?></textarea>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <button type="button" id="save-form"
            class="btn btn-success waves-effect waves-light m-r-10">
        <?php echo app('translator')->get('app.update'); ?>
    </button>
</form><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/feature-settings/edit-form.blade.php ENDPATH**/ ?>