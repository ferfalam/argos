<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 bg-title-left">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 text-right bg-title-right">
            <?php if($global->currency_converter_key): ?>
                <a href="<?php echo e(route('super-admin.currency.create')); ?>" class="btn btn-outline btn-success btn-sm"><?php echo app('translator')->get('modules.currencySettings.addNewCurrency'); ?> <i class="fa fa-plus" aria-hidden="true"></i></a>
                <a href="javascript:;" id="update-exchange-rates" class="btn btn-outline btn-info btn-sm"><?php echo app('translator')->get('app.update'); ?> <?php echo app('translator')->get('modules.currencySettings.exchangeRate'); ?> <i class="fa fa-refresh" aria-hidden="true"></i></a>
                <a href="javascript:;" id="addCurrencyExchangeKey" class="btn btn-outline btn-warning btn-sm"><?php echo app('translator')->get('app.update'); ?> <?php echo app('translator')->get('modules.accountSettings.currencyConverterKey'); ?> <i class="fa fa-upload" aria-hidden="true"></i></a>
            <?php endif; ?>

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
                    <?php echo $__env->make('sections.super_admin_setting_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="tab-content">
                        <div id="vhome3" class="tab-pane active">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="white-box">


                                        <div class="row">
                                            <?php if(!$global->currency_converter_key): ?>

                                                <div class="text-center">
                                                    <div class="empty-space" style="height: 200px;">
                                                        <div class="empty-space-inner">
                                                            <div class="icon" style="font-size:30px"><i
                                                                        class="icon-settings"></i>
                                                            </div>
                                                            <div class="title m-b-15">
                                                                <?php echo app('translator')->get('messages.addCurrencyNote'); ?>
                                                            </div>
                                                            <div class="subtitle">
                                                                <a href="javascript:;" id="addCurrencyExchangeKey"
                                                                   class="btn btn-outline btn-warning btn-sm"><?php echo app('translator')->get('app.add'); ?> <?php echo app('translator')->get('modules.accountSettings.currencyConverterKey'); ?>
                                                                    <i class="fa fa-key" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <h3 class="box-title m-b-0"><?php echo app('translator')->get('modules.currencySettings.currencies'); ?></h3>
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info"><i
                                                                class="fa fa-info-circle"></i> <?php echo app('translator')->get('messages.exchangeRateNote'); ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th><?php echo app('translator')->get('modules.currencySettings.currencyName'); ?></th>
                                                    <th><?php echo app('translator')->get('modules.currencySettings.currencySymbol'); ?></th>
                                                    <th><?php echo app('translator')->get('modules.currencySettings.currencyPosition'); ?></th>
                                                    <th><?php echo app('translator')->get('modules.currencySettings.currencyCode'); ?></th>
                                                    <th><?php echo app('translator')->get('modules.currencySettings.exchangeRate'); ?></th>

                                                    <th class="text-nowrap"><?php echo app('translator')->get('app.action'); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e(ucwords($currency->currency_name)); ?> <?php echo ($global->currency_id == $currency->id) ? "<label class='label label-success'>DEFAULT</label>" : ""; ?></td>
                                                        <td><?php echo e($currency->currency_symbol); ?></td>
                                                        <td><?php echo e($currency->currency_position); ?></td>
                                                        <td><?php echo e($currency->currency_code); ?></td>
                                                        <td><?php echo e($currency->exchange_rate); ?></td>

                                                        <td class="text-nowrap">
                                                            <?php if($global->currency_converter_key): ?>
                                                            <a href="<?php echo e(route('super-admin.currency.edit', [$currency->id])); ?>" class="btn btn-info btn-circle"
                                                               data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            <?php endif; ?>
                                                            <a href="javascript:;" class="btn btn-danger btn-circle sa-params"
                                                               data-toggle="tooltip" data-currency-id="<?php echo e($currency->id); ?>" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
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
    <!-- .row -->
    
    <div class="modal fade bs-modal-md in" id="projectCategoryModal" role="dialog" aria-labelledby="myModalLabel"
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
        $('#addCurrencyExchangeKey').click( function () {
            var url = '<?php echo e(route('super-admin.currency.exchange-key')); ?>';
            $('#modelHeading').html('Currency Convert Key');
            $.ajaxModal('#projectCategoryModal', url);
        })

    $('body').on('click', '.sa-params', function(){
        var id = $(this).data('currency-id');
        swal({
            title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
            text: "<?php echo app('translator')->get('messages.confirmation.deleteCurrancy'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?php echo app('translator')->get('messages.deleteConfirmation'); ?>",
            cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm){
            if (isConfirm) {

                var url = "<?php echo e(route('super-admin.currency.destroy',':id')); ?>";
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

    $('#update-exchange-rates').click(function () {
        var url = '<?php echo e(route('super-admin.currency.update-exchange-rates')); ?>';
        $.easyAjax({
            url: url,
            type: "GET",
            success: function (response) {
                if (response.status == "success") {
                    $.unblockUI();
//                                    swal("Deleted!", response.message, "success");
                    window.location.reload();
                }
            }
        })
    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.super-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/currency-settings/index.blade.php ENDPATH**/ ?>