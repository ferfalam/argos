<form id="editSettings" class="ajax-form" data-language-id="<?php echo e($frontDetail->language_setting_id); ?>">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="title"><?php echo app('translator')->get('app.title'); ?></label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo e($frontDetail->client_title); ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="address"><?php echo app('translator')->get('app.description'); ?></label>
                <textarea class="form-control" id="detail" rows="5" name="detail"><?php echo e($frontDetail->client_detail); ?></textarea>
            </div>
        </div>
    </div>

    <button type="button" id="save-form"
            class="btn btn-success waves-effect waves-light m-r-10">
        <?php echo app('translator')->get('app.update'); ?>
    </button>
</form><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/front-client-settings/edit-form.blade.php ENDPATH**/ ?>