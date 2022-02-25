<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12 bg-title-left">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-6 col-sm-6 col-md-8 col-xs-12 bg-title-right">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('super-admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li><a href="<?php echo e(route('super-admin.settings.index')); ?>"><?php echo app('translator')->get('app.menu.settings'); ?></a></li>
                <li class="active"><?php echo e(__($pageTitle)); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/summernote/dist/summernote.css')); ?>">
    <style>
        .panel-black .panel-heading a, .panel-inverse .panel-heading a {
            color: unset!important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-inverse">
                    <div class="panel-heading"><?php echo app('translator')->get('app.menu.offlinePaymentMethod'); ?></div>

                <div class="vtabs customvtab m-t-10">

                    <?php echo $__env->make('sections.super_admin_payment_setting_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="tab-content">
                        <div id="vhome3" class="tab-pane active">

                            <div class="row">

                                <div class="col-xs-12">
                                    <div class="white-box">
                                        <h3 class="box-title m-b-0"><?php echo app('translator')->get('modules.offlinePayment.title'); ?></h3>
                                        <?php if(!$offlineMethods->isEmpty()): ?>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <a href="javascript:;" id="addMethod" class="btn btn-outline btn-success btn-sm addMethod"><?php echo app('translator')->get('modules.offlinePayment.addMethod'); ?> <i class="fa fa-plus" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                        <?php endif; ?>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th><?php echo app('translator')->get('app.menu.method'); ?></th>
                                                    <th><?php echo app('translator')->get('app.description'); ?></th>
                                                    <th><?php echo app('translator')->get('app.status'); ?></th>
                                                    <th width="20%"><?php echo app('translator')->get('app.action'); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $offlineMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td><?php echo e(($key+1)); ?></td>
                                                        <td><?php echo e(ucwords($method->name)); ?></td>
                                                        <td><?php echo ucwords($method->description); ?> </td>
                                                        <td><?php if($method->status == 'yes'): ?> <label class="label label-success"><?php echo app('translator')->get('modules.offlinePayment.active'); ?></label> <?php else: ?> <label class="label label-danger"><?php echo app('translator')->get('modules.offlinePayment.inActive'); ?></label> <?php endif; ?> </td>
                                                        <td>
                                                            <a href="javascript:;" data-type-id="<?php echo e($method->id); ?>"
                                                               class="btn btn-sm btn-info btn-rounded btn-outline edit-type m-t-5"><i
                                                                        class="fa fa-edit"></i> <?php echo app('translator')->get('app.edit'); ?></a>
                                                            <a href="javascript:;" data-type-id="<?php echo e($method->id); ?>"
                                                               class="btn btn-sm btn-danger btn-rounded btn-outline delete-type m-t-5"><i
                                                                        class="fa fa-times"></i> <?php echo app('translator')->get('app.remove'); ?></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">
                                                            <div class="empty-space" style="height: 200px;">
                                                                <div class="empty-space-inner">
                                                                    <div class="icon" style="font-size:30px"><i
                                                                                class="fa fa-key"></i>
                                                                    </div>
                                                                    <div class="title m-b-15"><?php echo app('translator')->get('messages.noMethodsAdded'); ?>
                                                                    </div>
                                                                    <div class="subtitle">
                                                                        <a href="javascript:;" class="btn btn-outline btn-success btn-sm addMethod"><?php echo app('translator')->get('modules.offlinePayment.addMethod'); ?> <i class="fa fa-plus" aria-hidden="true"></i></a>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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


    
    <div class="modal fade bs-modal-md in" id="leadStatusModal" role="dialog" aria-labelledby="myModalLabel"
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

    //    save project members
    $('#save-type').click(function () {
        $.easyAjax({
            url: '<?php echo e(route('super-admin.offline-payment-setting.store')); ?>',
            container: '#createMethods',
            type: "POST",
            data: $('#createMethods').serialize(),
            success: function (response) {
                if (response.status == "success") {
                    $.unblockUI();
                    window.location.reload();
                }
            }
        })
    });


    $('body').on('click', '.delete-type', function () {
        var id = $(this).data('type-id');
        swal({
            title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
            text: "<?php echo app('translator')->get('messages.confirmation.removeMethod'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?php echo app('translator')->get('app.yes'); ?>",
            cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {

                var url = "<?php echo e(route('super-admin.offline-payment-setting.destroy',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'POST',
                            url: url,
                            data: {'_token': token, '_method': 'DELETE'},
                    success: function (response) {
                        if (response.status == "success") {
                            $.unblockUI();
//                                    swal("Deleted!", response.message, "success");
                            window.location.reload();
                        }
                    }
                });
            }
        });
    });


    $('.edit-type').click(function () {
        var typeId = $(this).data('type-id');
        var url = '<?php echo e(route("super-admin.offline-payment-setting.edit", ":id")); ?>';
        url = url.replace(':id', typeId);

        $('#modelHeading').html("<?php echo e(__('app.edit')." ".__('modules.offlinePayment.title')); ?>");
        $.ajaxModal('#leadStatusModal', url);
    })
    $('.addMethod').click(function () {
        var url = '<?php echo e(route("super-admin.offline-payment-setting.create")); ?>';
        $('#modelHeading').html("<?php echo e(__('app.edit')." ".__('modules.offlinePayment.title')); ?>");
        $.ajaxModal('#leadStatusModal', url);
    })


</script>


<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.super-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/payment-settings/offline-method/index.blade.php ENDPATH**/ ?>