<form id="editSettings" class="ajax-form" data-language-id="<?php echo e($trFrontDetail->language_setting_id); ?>">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="company_name"><?php echo app('translator')->get('modules.frontCms.headerTitle'); ?></label>
                <input type="text" class="form-control" id="header_title" name="header_title"
                    value="<?php echo e($trFrontDetail->header_title); ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="address"><?php echo app('translator')->get('modules.frontCms.headerDescription'); ?></label>
                <textarea class="form-control summernote" id="header_description" rows="5"
                        name="header_description"><?php echo e($trFrontDetail->header_description); ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="exampleInputPassword1"><?php echo app('translator')->get('modules.frontCms.mainImage'); ?></label>
                <div class="col-xs-12">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail"
                            style="width: 200px; height: 150px;">
                            <img src="<?php echo e($trFrontDetail->image_url); ?>" alt=""/>
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"
                            style="max-width: 200px; max-height: 150px;"></div>
                        <div>
                        <span class="btn btn-info btn-file">
                            <span class="fileinput-new"> <?php echo app('translator')->get('app.selectImage'); ?> </span>
                            <span class="fileinput-exists"> <?php echo app('translator')->get('app.change'); ?> </span>
                            <input type="file" name="image" id="image">
                        </span>
                            <a href="javascript:;" class="btn btn-danger fileinput-exists"
                            data-dismiss="fileinput"> <?php echo app('translator')->get('app.remove'); ?> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('messages.headerImageSizeMessage'); ?></div>
        </div>
    </div>

    <button type="button" id="save-form" class="btn btn-success waves-effect waves-light m-r-10">
        <?php echo app('translator')->get('app.update'); ?>
    </button>
</form><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/front-settings/new-theme/edit-form.blade.php ENDPATH**/ ?>