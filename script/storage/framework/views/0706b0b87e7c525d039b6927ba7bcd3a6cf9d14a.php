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
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/css/asColorPicker.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/switchery/dist/switchery.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/summernote/dist/summernote.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-inverse">
                <div class="panel-heading"><?php echo app('translator')->get('modules.frontCms.updateTitle'); ?></div>

                <div class="vtabs customvtab m-t-10">
                    <?php echo $__env->make('sections.front_setting_new_theme_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="tab-content">
                        <div id="vhome3" class="tab-pane active">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="white-box">
                                        <h3 class="box-title m-b-0"> <?php echo app('translator')->get("modules.frontSettings.title"); ?></h3>

                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12">
                                                <?php echo Form::open(['id'=>'commonSettings','class'=>'ajax-form m-b-30','method'=>'PUT']); ?>

                                                <h4><?php echo app('translator')->get('modules.frontCms.commonSettings'); ?></h4>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="company_name" class="d-block"><?php echo app('translator')->get('modules.frontCms.primaryColor'); ?></label>
                                                            <input type="text" name="primary_color" class="gradient-colorpicker form-control" autocomplete="off" value="<?php echo e($frontDetail->primary_color); ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="address"><?php echo app('translator')->get('modules.frontCms.defaultLanguage'); ?></label>
                                                            <select name="default_language" id="default_language" class="form-control select2">
                                                                <option <?php if($frontDetail->locale == "en"): ?> selected <?php endif; ?> value="en">English
                                                                </option>
                                                                <?php $__currentLoopData = $languageSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($language->language_code); ?>" <?php if($frontDetail->locale == $language->language_code): ?> selected <?php endif; ?> ><?php echo e($language->language_name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="custom_css" class="d-block"><?php echo app('translator')->get('modules.frontCms.customCss'); ?></label>
                                                            <textarea name="custom_css" class="my-code-area" rows="20" style="width: 100%"><?php if(is_null($frontDetail->custom_css_theme_two)): ?>/*Enter your auth css after this line*/ <?php else: ?> <?php echo $frontDetail->custom_css_theme_two; ?>  <?php endif; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group">
                                                            <div class="checkbox checkbox-info  col-md-10">
                                                                <input id="get_started_show" name="get_started_show" value="yes"
                                                                       <?php if($frontDetail->get_started_show == "yes"): ?> checked
                                                                       <?php endif; ?>
                                                                       type="checkbox">
                                                                <label for="get_started_show"><?php echo app('translator')->get('modules.frontCms.getStartedButtonShow'); ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group">
                                                            <div class="checkbox checkbox-info  col-md-10">
                                                                <input id="sign_in_show" name="sign_in_show" value="yes"
                                                                       <?php if($frontDetail->sign_in_show == "yes"): ?> checked
                                                                       <?php endif; ?>
                                                                       type="checkbox">
                                                                <label for="sign_in_show"><?php echo app('translator')->get('modules.frontCms.singInButtonShow'); ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h4 id="social-links"><?php echo app('translator')->get('modules.frontCms.socialLinks'); ?></h4>
                                                <hr>
                                                <span class="text-danger"><?php echo app('translator')->get('modules.frontCms.socialLinksNote'); ?></span><br><br>
                                                <div class="row">
                                                    <?php $__currentLoopData = json_decode($frontDetail->social_links); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <div class="col-sm-12 col-md-3 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="<?php echo e($link->name); ?>">
                                                                    <?php echo app('translator')->get('modules.frontCms.'.$link->name); ?>
                                                                </label>
                                                                <input
                                                                        class="form-control"
                                                                        id="<?php echo e($link->name); ?>"
                                                                        name="social_links[<?php echo e($link->name); ?>]"
                                                                        type="url"
                                                                        value="<?php echo e($link->link); ?>"
                                                                        placeholder="<?php echo app('translator')->get('modules.frontCms.enter'.ucfirst($link->name).'Link'); ?>">
                                                            </div>
                                                        </div>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>

                                                <button type="submit" id="save-common-form"
                                                        class="btn btn-success waves-effect waves-light m-r-10">
                                                    <?php echo app('translator')->get('app.update'); ?>
                                                </button>

                                                <?php echo Form::close(); ?>


                                                <h4 id="social-links"><?php echo app('translator')->get('modules.frontCms.frontDetail'); ?></h4>
                                                <hr>
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item active">
                                                        <a 
                                                            class="nav-link active"
                                                            id="en-tab"
                                                            data-toggle="tab"
                                                            data-language-id="0"
                                                            href="#en"
                                                            role="tab"
                                                            aria-controls="en"
                                                            aria-selected="true"
                                                        >
                                                            <span class="flag-icon flag-icon-us"></span> English
                                                        </a>
                                                    </li>
                                                    <?php $__empty_1 = true; $__currentLoopData = $activeLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <li class="nav-item">
                                                            <a 
                                                                class="nav-link"
                                                                id="<?php echo e($language->language_code); ?>-tab"
                                                                data-toggle="tab"
                                                                data-language-id="<?php echo e($language->id); ?>"
                                                                href="#<?php echo e($language->language_code); ?>"
                                                                role="tab"
                                                                aria-controls="<?php echo e($language->language_code); ?>"
                                                                aria-selected="true"
                                                            >
                                                                <span class="flag-icon flag-icon-<?php echo e($language->language_code); ?>"></span> <?php echo e(ucfirst($language->language_name)); ?>

                                                            </a>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <?php endif; ?>
                                                </ul>
                                                <div class="tab-content" id="edit-form">
                                                    <?php echo $__env->make('super-admin.front-settings.new-theme.edit-form', ['trFrontDetail' => $trFrontDetail], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </div>
                                            </div>
                                        </div>
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



<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
<script src="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/summernote/dist/summernote.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/ace/ace.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/ace/theme-twilight.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/ace/mode-css.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/ace/jquery-ace.min.js')); ?>"></script>
<script>
    $('.my-code-area').ace({ theme: 'twilight', lang: 'css' })
    $('.summernote').summernote({
        height: 200,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: false,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link',  'hr','video']],
            ['view', ['fullscreen']],
            ['help', ['help']]
        ]
    });
    // Colorpicker
    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker();

    function init() {
        $('.summernote').summernote({
            height: 200,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link',  'hr']],
                ['view', ['fullscreen']],
                ['help', ['help']]
            ]
        });
    }

    init();

    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        changeForm(e.target);
    })

    function changeForm(target) {
        $.easyAjax({
            url: "<?php echo e(route('super-admin.front-settings.changeForm')); ?>",
            container: '#editSettings',
            data: {
                language_settings_id: $(target).data('language-id')
            },
            type: 'GET',
            success: function (response) {
                if (response.status === 'success') {
                    $('#edit-form').html(response.view);
                    init();
                }
            }
        })
    }

    $('#save-common-form').click(function () {
        $.easyAjax({
            url: "<?php echo e(route('super-admin.front-settings.update', $frontDetail->id)); ?>",
            container: '#commonSettings',
            type: 'POST',
            data: $('#commonSettings').serialize()
        })
    })

    $('body').on('click', '#save-form', function () {
        $.easyAjax({
            url: "<?php echo e(route('super-admin.front-settings.updateDetail')); ?>",
            container: '#editSettings',
            type: "POST",
            file: true,
            data: {
                language_settings_id: $('#editSettings').data('language-id'),
                header_description: $('#header_description').summernote('code')
            }
        })
    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.super-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/front-settings/new-theme/index.blade.php ENDPATH**/ ?>