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

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel">

                <div class="vtabs customvtab p-t-10">
                    <?php if($global->front_design == 1): ?>
                        <?php echo $__env->make('sections.front_setting_new_theme_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php else: ?>
                        <?php echo $__env->make('sections.front_setting_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="white-box">
                                
                                <div class="row">
                                    <div class="table-responsive" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th><?php echo app('translator')->get("app.name"); ?></th>
                                                <th><?php echo app('translator')->get("modules.frontCms.seo_title"); ?></th>
                                                <th><?php echo app('translator')->get("modules.frontCms.seo_author"); ?></th>
                                                <th><?php echo app('translator')->get("modules.frontCms.seo_description"); ?></th>
                                                <th><?php echo app('translator')->get("modules.frontCms.seo_keywords"); ?></th>
                                                <th><?php echo app('translator')->get("app.edit"); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php $__currentLoopData = $seoDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $seoDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                                    <td><?php echo e($seoDetail->page_name); ?></td>
                                                    <td><?php echo e($seoDetail->seo_title); ?></td>
                                                    <td><?php echo e($seoDetail->seo_author); ?></td>
                                                    <td><?php echo e($seoDetail->seo_description); ?></td>
                                                    <td><?php echo e($seoDetail->seo_keywords); ?></td>

                                                    <td><a href="javascript:;"
                                                           onclick="editSeoDetail('<?php echo e($seoDetail->id); ?>')"
                                                           class="btn btn-info btn-circle" data-toggle="tooltip"
                                                           data-original-title="Edit"><i class="fa fa-pencil"
                                                                                         aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    <!-- .row -->
                </div>

            </div>
        </div>


    </div>
    
    <div class="modal fade bs-modal-md in" id="seoDetailModel" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>

    <script>
        $("body").tooltip({
            selector: '[data-toggle="tooltip"]'
        });

        function editSeoDetail(id) {
            var url = "<?php echo e(route('super-admin.seo-detail.edit', ':id')); ?>";
            url = url.replace(':id', id);
            $('#modelHeading').html("<?php echo app('translator')->get('app.seo'); ?> <?php echo app('translator')->get('app.edit'); ?>");
            $.ajaxModal('#seoDetailModel', url);
        }

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.super-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/front-seo-detail/index.blade.php ENDPATH**/ ?>