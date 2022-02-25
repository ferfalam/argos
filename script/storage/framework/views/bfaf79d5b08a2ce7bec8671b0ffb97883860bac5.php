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
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/switchery/dist/switchery.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <?php if(!$global->hide_cron_message): ?>
    <div class="col-xs-12">
        <div class="alert alert-info ">
            <h5 class="text-white">Set following cron command on your server (Ignore if already done)</h5>
            <?php
            try {
            echo '<code>* * * * * '.PHP_BINDIR.'/php  '. base_path() .'/artisan schedule:run >> /dev/null 2>&1</code>';
            } catch (\Throwable $th) {
            echo '<code>* * * * * /php'. base_path() .'/artisan schedule:run >> /dev/null 2>&1</code>';
            }
            ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if($global->show_public_message): ?>
    <div class="col-xs-12">
        <div class="alert alert-success">
            <h4>Remove public from URL</h4>
            <h5 class="text-white">Create a file with the name <code>.htaccess</code> at the root of folder
                (where app, bootstrap, config folder resides) and add the following content</h5>

            <pre>
                        <code class="apache hljs">
<span class="hljs-section">&lt;IfModule mod_rewrite.c&gt;</span>

  <span class="hljs-attribute">RewriteEngine </span><span class="hljs-literal"> On</span>
  <span class="hljs-attribute"><span class="hljs-nomarkup">RewriteRule</span></span><span class="hljs-variable"> ^(.*)$ public/$1</span><span
                                    class="hljs-meta"> [L]</span>

<span class="hljs-section">&lt;/IfModule&gt;</span>
</code></pre>
        </div>

    </div>
    <?php endif; ?>
    <div class="col-xs-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <?php echo app('translator')->get('modules.accountSettings.updateTitle'); ?>
                <?php if(!module_enabled('RestAPI')): ?>
                <?php if($cachedFile): ?>

                <a href="javascript:;" id="clear-cache" class="btn btn-sm btn-danger pull-right m-l-5 text-white"><i
                        class="fa fa-times"></i> <?php echo app('translator')->get('app.disableCache'); ?></a>
                <h6 class="text-black pull-right m-r-5"><?php echo app('translator')->get('messages.cacheEnabled'); ?></h6>
                <?php else: ?>

                <a href="javascript:;" id="refresh-cache" class="btn btn-sm btn-success pull-right text-white">
                    <i class="fa fa-check"></i> <?php echo app('translator')->get('app.enableCache'); ?></a>
                <h6 class="text-black pull-right m-r-5"><?php echo app('translator')->get('messages.cacheDisabled'); ?></h6>
                <?php endif; ?>
                <?php endif; ?>

            </div>

            <div class="vtabs customvtab m-t-10">
                <?php echo $__env->make('sections.super_admin_setting_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="tab-content">
                    <div id="vhome3" class="tab-pane active">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <?php echo Form::open(['id'=>'editSettings','class'=>'ajax-form','method'=>'PUT']); ?>

                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label
                                                for="company_name"><?php echo app('translator')->get('modules.accountSettings.companyName'); ?></label>
                                            <input type="text" class="form-control" id="company_name"
                                                name="company_name" value="<?php echo e($global->company_name); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label
                                                for="company_email"><?php echo app('translator')->get('modules.accountSettings.companyEmail'); ?></label>
                                            <input type="email" class="form-control" id="company_email"
                                                name="company_email" value="<?php echo e($global->company_email); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label
                                                for="company_phone"><?php echo app('translator')->get('modules.accountSettings.companyPhone'); ?></label>
                                            <input type="tel" class="form-control" id="company_phone"
                                                name="company_phone" value="<?php echo e($global->company_phone); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label
                                                for="exampleInputPassword1"><?php echo app('translator')->get('modules.accountSettings.companyWebsite'); ?></label>
                                            <input type="text" class="form-control" id="website" name="website"
                                                value="<?php echo e($global->website); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="company_phone"><?php echo app('translator')->get('modules.invoices.currency'); ?></label>
                                            <select class="form-control" id="currency_id" name="currency_id">
                                                <?php $__empty_1 = true; $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <option <?php if($currency->id == $global->currency_id): ?> selected
                                                    <?php endif; ?> value="<?php echo e($currency->id); ?>">
                                                    <?php echo e($currency->currency_name); ?> -
                                                    (<?php echo e($currency->currency_symbol); ?>)
                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label
                                                for="address"><?php echo app('translator')->get('modules.accountSettings.defaultTimezone'); ?></label>
                                            <select name="timezone" id="timezone" class="form-control select2">
                                                <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if($global->timezone == $tz): ?> selected <?php endif; ?>><?php echo e($tz); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="address"><?php echo app('translator')->get('modules.accountSettings.changeLanguage'); ?></label>
                                            <select name="locale" id="locale" class="form-control select2">
                                                <option <?php if($global->locale == "en"): ?> selected <?php endif; ?> value="en">
                                                    English
                                                </option>
                                                <?php $__currentLoopData = $languageSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($language->language_code); ?>" <?php if($global->locale ==
                                                    $language->language_code): ?> selected <?php endif; ?> >
                                                    <?php echo e($language->language_name); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label
                                                for="exampleInputPassword1"><?php echo app('translator')->get('modules.accountSettings.companyLogo'); ?></label>

                                            <div class="col-xs-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail"
                                                        style="width: 200px; height: 150px;">
                                                        <img src="<?php echo e($global->logo_url); ?>" alt="" />
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                                        style="max-width: 200px; max-height: 150px;"></div>
                                                    <div>
                                                        <span class="btn btn-info btn-file">
                                                            <span class="fileinput-new"> <?php echo app('translator')->get('app.selectImage'); ?>
                                                            </span>
                                                            <span class="fileinput-exists"> <?php echo app('translator')->get('app.change'); ?> </span>
                                                            <input type="file" name="logo" id="logo"> </span>
                                                        <a href="javascript:;" class="btn btn-danger fileinput-exists"
                                                            data-dismiss="fileinput"> <?php echo app('translator')->get('app.remove'); ?> </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="favicon"><?php echo app('translator')->get('modules.accountSettings.faviconImage'); ?></label>

                                            <div class="col-xs-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail"
                                                        style="width: 200px; height: 150px;">
                                                        <img src="<?php echo e($global->favicon_url); ?>" alt="" />
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                                        style="max-width: 200px; max-height: 150px;"></div>
                                                    <div>
                                                        <span class="btn btn-info btn-file">
                                                            <span class="fileinput-new"> <?php echo app('translator')->get('app.selectImage'); ?>
                                                            </span>
                                                            <span class="fileinput-exists"> <?php echo app('translator')->get('app.change'); ?> </span>
                                                            <input type="file" name="favicon" id="favicon"> </span>
                                                        <a href="javascript:;" class="btn btn-danger fileinput-exists"
                                                            data-dismiss="fileinput"> <?php echo app('translator')->get('app.remove'); ?> </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label
                                                for="exampleInputPassword1"><?php echo app('translator')->get('modules.accountSettings.frontLogo'); ?></label>

                                            <div class="col-xs-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail"
                                                        style="width: 200px; height: 150px;">
                                                        <img src="<?php echo e($global->logo_front_url); ?>" alt="" />
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                                        style="max-width: 200px; max-height: 150px;"></div>
                                                    <div>
                                                        <span class="btn btn-info btn-file">
                                                            <span class="fileinput-new"> <?php echo app('translator')->get('app.selectImage'); ?>
                                                            </span>
                                                            <span class="fileinput-exists"> <?php echo app('translator')->get('app.change'); ?> </span>
                                                            <input type="file" name="logo_front" id="logo_front">
                                                        </span>
                                                        <a href="javascript:;" class="btn btn-danger fileinput-exists"
                                                            data-dismiss="fileinput"> <?php echo app('translator')->get('app.remove'); ?> </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-12 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('modules.themeSettings.loginScreenBackground'); ?></label>

                                            <div class="col-md-12 m-b-20">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail"
                                                        style="width: 200px; height: 150px;">
                                                        <img src="<?php echo e($global->login_background_url); ?>" alt="" />
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                                        style="max-width: 200px; max-height: 150px;"></div>
                                                    <div>
                                                        <span class="btn btn-info btn-file">
                                                            <span class="fileinput-new"> <?php echo app('translator')->get('app.selectImage'); ?>
                                                            </span>
                                                            <span class="fileinput-exists"> <?php echo app('translator')->get('app.change'); ?> </span>
                                                            <input type="file" name="login_background"
                                                                id="login_background"> </span>
                                                        <a href="javascript:;" class="btn btn-danger fileinput-exists"
                                                            data-dismiss="fileinput"> <?php echo app('translator')->get('app.remove'); ?> </a>
                                                    </div>
                                                </div>
                                                <div class="note">Recommended size: 1500 X 1056 (Pixels)</div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="address"><?php echo app('translator')->get('modules.accountSettings.companyAddress'); ?></label>
                                            <textarea class="form-control" id="address" rows="5"
                                                name="address"><?php echo e($global->address); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="address"><?php echo app('translator')->get('modules.accountSettings.expiredMessage'); ?></label>
                                            <textarea class="form-control" id="expired_message" rows="5"
                                                name="expired_message"><?php echo e($global->expired_message); ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="address"><?php echo app('translator')->get('modules.accountSettings.weekStartFrom'); ?></label>
                                            <select name="week_start" id="week_start" class="form-control select2">
                                                <option value="0" <?php if($global->week_start == '0'): ?> selected <?php endif; ?> >
                                                    <?php echo app('translator')->get('app.sunday'); ?>
                                                </option>
                                                <option value="1" <?php if($global->week_start == '1'): ?> selected <?php endif; ?>>
                                                    <?php echo app('translator')->get('app.monday'); ?>
                                                </option>
                                                <option value="2" <?php if($global->week_start == '2'): ?> selected <?php endif; ?>>
                                                    <?php echo app('translator')->get('app.tuesday'); ?>
                                                </option>
                                                <option value="3" <?php if($global->week_start == '3'): ?> selected <?php endif; ?>>
                                                    <?php echo app('translator')->get('app.wednesday'); ?>
                                                </option>
                                                <option value="4" <?php if($global->week_start == '4'): ?> selected <?php endif; ?>>
                                                    <?php echo app('translator')->get('app.thursday'); ?>
                                                </option>
                                                <option value="5" <?php if($global->week_start == '5'): ?> selected <?php endif; ?>>
                                                    <?php echo app('translator')->get('app.friday'); ?>
                                                </option>
                                                <option value="6" <?php if($global->week_start == '6'): ?> selected <?php endif; ?>>
                                                    <?php echo app('translator')->get('app.saturday'); ?>
                                                </option>
                                            </select>
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
<script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/switchery/dist/switchery.min.js')); ?>"></script>

<script>
    // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function () {
            new Switchery($(this)[0], $(this).data());

        });

        $(".select2").select2({
            formatNoMatches: function () {
                return "<?php echo e(__('messages.noRecordFound')); ?>";
            }
        });

        $('#refresh-cache').click(function () {
            $.easyAjax({
                url: '<?php echo e(url("refresh-cache")); ?>',
                type: "GET",
                success: function () {
                    window.location.reload();
                }
            })
        });

        $('#clear-cache').click(function () {
            $.easyAjax({
                url: '<?php echo e(url("clear-cache")); ?>',
                type: "GET",
                success: function () {
                    window.location.reload();
                }
            })
        });

        $('#save-form').click(function () {
            $.easyAjax({
                url: '<?php echo e(route('super-admin.settings.update', $global->id)); ?>',
                container: '#editSettings',
                type: "POST",
                redirect: true,
                file: true,
            })
        });

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.super-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/settings/edit.blade.php ENDPATH**/ ?>