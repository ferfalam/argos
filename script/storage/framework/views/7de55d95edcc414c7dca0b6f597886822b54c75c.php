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
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/iconpicker/css/fontawesome-iconpicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/summernote/dist/summernote.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel">

                <div class="vtabs customvtab p-t-10">
                    <?php echo $__env->make('sections.saas.footer_page_setting_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="tab-content">
                        <div id="vhome3" class="tab-pane active">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="white-box">
                                        <h3><?php echo app('translator')->get('app.footer'); ?> <?php echo app('translator')->get('app.menu.settings'); ?></h3>
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
                                            <?php echo $__env->make('super-admin.footer-settings.edit-footer-text-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>    <!-- .row -->

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
    <script>
        function changeForm(target) {
            $.easyAjax({
                url: "<?php echo e(route('super-admin.footer-settings.changeFooterTextForm')); ?>",
                container: '#editSettings',
                data: {
                    language_settings_id: $(target).data('language-id')
                },
                type: 'GET',
                success: function (response) {
                    if (response.status === 'success') {
                        $('#edit-form').html(response.view);
                    }
                }
            })
        }

        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
            changeForm(e.target);
        })

        $('body').on('click', '#save-form', function () {
            $.easyAjax({
                url: '<?php echo e(route('super-admin.footer-settings.copyright-text')); ?>',
                container: '#editSettings',
                type: "POST",
                file: true,
                data: {
                    language_settings_id: $('#editSettings').data('language-id')
                }
            })
        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.super-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/footer-settings/footer-text.blade.php ENDPATH**/ ?>