<form id="editSettings" class="ajax-form" data-language-id="<?php echo e($registrationMessage ? $registrationMessage->language_setting_id : ''); ?>">
  <?php echo csrf_field(); ?>
  <div class="row">
      <div class="col-sm-12 col-md-12 col-xs-12">
          <div class="form-group">
              <label for="title"><?php echo app('translator')->get('app.menu.message'); ?></label>
              <textarea class="form-control summernote" rows="6" name="message" id="message"><?php echo e($registrationMessage ? $registrationMessage->message : ''); ?></textarea>
          </div>
      </div>
  </div>

  <button type="button" id="save-form"
          class="btn btn-success waves-effect waves-light m-r-10">
      <?php echo app('translator')->get('app.update'); ?>
  </button>
</form><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/sign-up-setting/edit-form.blade.php ENDPATH**/ ?>