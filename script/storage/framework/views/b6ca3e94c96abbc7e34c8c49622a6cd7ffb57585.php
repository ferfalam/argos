<form id="editSettings" class="ajax-form" data-language-id="<?php echo e($frontDetail->language_setting_id); ?>">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="title"><?php echo app('translator')->get('modules.footer.footerCopyrightText'); ?></label>
                <input type="text" class="form-control" id="footer_copyright_text" name="footer_copyright_text" value="<?php echo e($frontDetail->footer_copyright_text); ?>">
            </div>
        </div>
    </div>

    <button type="button" id="save-form"
            class="btn btn-success waves-effect waves-light m-r-10">
        <?php echo app('translator')->get('app.update'); ?>
    </button>
</form><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/footer-settings/edit-footer-text-form.blade.php ENDPATH**/ ?>