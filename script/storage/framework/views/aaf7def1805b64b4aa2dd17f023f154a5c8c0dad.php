<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12 bg-title-left">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?>

                <span class="text-info b-l p-l-10 m-l-5"><?php echo e($totalRequest); ?></span> <span
                class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('app.total'); ?> <?php echo app('translator')->get('app.offlineRequest'); ?></span>
            </h4>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">

        <div class="col-xs-12">
            <div class="white-box">
                <div class="table-responsive">
                <table class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="users-table">
                    <thead>
                    <tr>
                        <th><?php echo app('translator')->get('app.id'); ?></th>
                        <th><?php echo app('translator')->get('app.company'); ?></th>
                        <th><?php echo app('translator')->get('app.package'); ?></th>
                        <th>Payment By</th>
                        <th><?php echo app('translator')->get('app.status'); ?></th>
                        <th><?php echo app('translator')->get('app.action'); ?></th>
                    </tr>
                    </thead>
                </table>
                    </div>
            </div>
        </div>
    </div>
    <!-- .row -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
    <script src="<?php echo e(asset('plugins/bower_components/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
    <script>
        var table = $('#users-table').dataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: '<?php echo route('super-admin.offline-plan.data'); ?>',
            language: {
                "url": "<?php echo __("app.datatable") ?>"
            },
            "fnDrawCallback": function( oSettings ) {
                $("body").tooltip({
                    selector: '[data-toggle="tooltip"]'
                });
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'company.company_name', name: 'company.company_name' },
                { data: 'package.name', name: 'package.name' },
                { data: 'offline_method.name', name: 'offline_method.name' },
                { data: 'status', name: 'status'},
                { data: 'action', name: 'action' }
            ]
        });

        $(function() {
            $('body').on('click', '.sa-params', function(){
                var id = $(this).data('user-id');
                swal({
                    title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
                    text: "<?php echo app('translator')->get('messages.confirmation.recoverPackage'); ?>",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "<?php echo app('translator')->get('messages.deleteConfirmation'); ?>",
                    cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function(isConfirm){
                    if (isConfirm) {

                        var url = "<?php echo e(route('super-admin.packages.destroy',':id')); ?>";
                        url = url.replace(':id', id);

                        var token = "<?php echo e(csrf_token()); ?>";

                        $.easyAjax({
                            type: 'POST',
                            url: url,
                            data: {'_token': token, '_method': 'DELETE'},
                            success: function (response) {
                                if (response.status == "success") {
                                    $.unblockUI();
                                    var total = $('#totalPackages').text();
                                    $('#totalPackages').text(parseInt(total) - parseInt(1));
                                    table._fnDraw();
                                }
                            }
                        });
                    }
                });
            });
        });
        function accept(id) {
            swal({
                title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
                text: "<?php echo app('translator')->get('messages.confirmation.recoverVerifiedRequest'); ?>",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "<?php echo app('translator')->get('messages.verify'); ?>",
                cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    $.easyAjax({
                        type: 'POST',
                        url: '<?php echo e(route('super-admin.offline-plan.verify')); ?>',
                        data: {
                            '_token': '<?php echo e(csrf_token()); ?>'
                            , id: id
                        },
                        success: function (response) {
                            if (response.status == "success") {
                                table._fnDraw();
                            }
                        }
                    });
                }
            });
        }

        function reject(id) {
            swal({
                title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
                text: "<?php echo app('translator')->get('messages.confirmation.recoveRejectedRequest'); ?>",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "<?php echo app('translator')->get('messages.reject'); ?>",
                cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    $.easyAjax({
                        type: 'POST',
                        url: '<?php echo e(route('super-admin.offline-plan.reject')); ?>',
                        data: {
                            '_token': '<?php echo e(csrf_token()); ?>'
                            , id: id
                        },
                        success: function (response) {
                            if (response.status == "success") {
                                table._fnDraw();
                            }
                        }
                    });
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.super-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/offline-plan-change/index.blade.php ENDPATH**/ ?>