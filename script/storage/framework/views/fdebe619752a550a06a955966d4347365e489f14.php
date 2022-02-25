<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 bg-title-left">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?>

                <span class="text-info b-l p-l-10 m-l-5"><?php echo e($totalInvoices); ?></span> <span
                class="font-12 text-muted m-l-5"> <?php echo app('translator')->get('app.total'); ?> <?php echo app('translator')->get('app.menu.invoices'); ?></span>
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
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('filter-section'); ?>
<div class="row"  id="ticket-filters">

    <form action="" id="filter-form">
        <div class="col-xs-12 m-t-30">
            <div class="form-group">
                <label class="control-label"><?php echo app('translator')->get('app.company'); ?></label>
                <select class="form-control select2" name="company" id="company" data-style="form-control">
                    <option value="all"><?php echo app('translator')->get('app.all'); ?></option>
                    <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>"><?php echo e(ucwords($item->company_name)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
       
        <div class="col-xs-12">
            <div class="form-group">
                <label class="control-label col-xs-12">&nbsp;</label>
                <button type="button" id="apply-filters" class="btn btn-success col-md-6"><i class="fa fa-check"></i> <?php echo app('translator')->get('app.apply'); ?></button>
                <button type="button" id="reset-filters" class="btn btn-inverse col-md-5 col-md-offset-1"><i class="fa fa-refresh"></i> <?php echo app('translator')->get('app.reset'); ?></button>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">


        <div class="col-xs-12">
            <div class="white-box">
                <div class="table-responsive">
                <table class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="users-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo app('translator')->get('app.company'); ?></th>
                        <th><?php echo app('translator')->get('app.package'); ?></th>
                        <th><?php echo app('translator')->get('modules.payments.transactionId'); ?></th>
                        <th><?php echo app('translator')->get('app.amount'); ?></th>
                        <th><?php echo app('translator')->get('app.date'); ?></th>
                        <th><?php echo app('translator')->get('modules.billing.nextPaymentDate'); ?></th>
                        <th><?php echo app('translator')->get('modules.payments.paymentGateway'); ?></th>
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
    <script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>

    <script>
        $(function() {
            $(".select2").select2({
                formatNoMatches: function () {
                    return "<?php echo e(__('messages.noRecordFound')); ?>";
                }
            });

            var table;
            $('#apply-filters').click(function () {
                loadTable();
            });

            $('#reset-filters').click(function () {
                $('#filter-form')[0].reset();
                $('#company').val('all');
                $('#company').select2();
                loadTable();
            });

            function loadTable(){

                var company = $('#company').val();

                var table = $('#users-table').dataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    destroy: true,
                    ajax: '<?php echo route('super-admin.invoices.data'); ?>?company_id='+company,
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
                        { data: 'company', name: 'companies.company_name'},
                        { data: 'package', name: 'packages.name' },
                        { data: 'transaction_id', name: 'transaction_id'},
                        { data: 'amount', name: 'amount' },
                        { data: 'paid_on', name: 'offline_invoices.pay_date' },
                        { data: 'next_pay_date', name: 'offline_invoices.next_pay_date' },
                        { data: 'method', name: 'offline_method_id' },
                        { data: 'action', name: 'action' }
                    ]
                });

            } 

            loadTable();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.super-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/invoices/index.blade.php ENDPATH**/ ?>