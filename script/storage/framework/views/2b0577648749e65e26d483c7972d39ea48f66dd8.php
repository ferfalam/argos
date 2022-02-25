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
                    <?php echo $__env->make('sections.front_setting_new_theme_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="tab-content">
                        <div id="vhome3" class="tab-pane active">
                            <?php echo Form::open(['id'=>'editSettings','class'=>'ajax-form','method'=>'POST']); ?>


                            <div class="row">
                                <div class="col-sm-12">
                                    <h4><?php echo app('translator')->get('app.add'); ?></h4>
                                    <div class="form-group">
                                        <label class="control-label"><?php echo app('translator')->get('modules.frontCms.widgetName'); ?></label>
                                        <input type="text" name="name" class="form-control" >
                                    </div>
                                
                                    
                                    <div class="form-group">
                                        <label class="control-label"><?php echo app('translator')->get('modules.frontCms.widgetCode'); ?></label>
                                        <textarea name="widget_code" class="form-control" rows="6"></textarea>
                                    </div>
                                </div>
                            
                                <div class="col-sm-12">
                                    <button class="btn btn-success" type="button" id="save-form"><i class="fa fa-check"></i> <?php echo app('translator')->get('app.save'); ?></button>
                                </div>

                                <div class="col-md-12 m-t-30">

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo app('translator')->get('app.name'); ?></th>
                                                <th><?php echo app('translator')->get('app.action'); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $frontWidgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e(($key+1)); ?></td>
                                                    <td><?php echo e(ucwords($widget->name)); ?></td>
                                                    <td>
                                                        <a href="javascript:;" data-type-id="<?php echo e($widget->id); ?>"
                                                            class="btn btn-sm btn-info btn-rounded btn-outline edit-type"><i
                                                                    class="fa fa-edit"></i> <?php echo app('translator')->get('app.edit'); ?></a>
                                                        <a href="javascript:;" data-type-id="<?php echo e($widget->id); ?>"
                                                            class="btn btn-sm btn-danger btn-rounded btn-outline delete-type"><i
                                                                    class="fa fa-times"></i> <?php echo app('translator')->get('app.remove'); ?></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="3">
                                                        <?php echo app('translator')->get('messages.noRecordFound'); ?>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                            <?php echo Form::close(); ?>


                            

                            <div class="clearfix"></div>


                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>

    
    <div class="modal fade bs-modal-lg in" id="ticketTypeModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-data-application">
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
    
    $('#save-form').click(function () {
        $.easyAjax({
            url: "<?php echo e(route('super-admin.front-widgets.store')); ?>",
            container: '#editSettings',
            type: "POST",
            data: $('#editSettings').serialize()
        })
    });


    $('body').on('click', '.delete-type', function () {
        var id = $(this).data('type-id');
        swal({
            title: "<?php echo app('translator')->get('messages.sweetAlertTitle'); ?>",
            text: "<?php echo app('translator')->get('messages.confirmation.removeWidget'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?php echo app('translator')->get('app.yes'); ?>",
            cancelButtonText: "<?php echo app('translator')->get('messages.confirmNoArchive'); ?>",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {

                var url = "<?php echo e(route('super-admin.front-widgets.destroy',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'POST',
                            url: url,
                            data: {'_token': token, '_method': 'DELETE'},
                    success: function (response) {
                        if (response.status == "success") {
                            $.unblockUI();
                            window.location.reload();
                        }
                    }
                });
            }
        });
    });


    $('.edit-type').click(function () {
        var typeId = $(this).data('type-id');
        var url = '<?php echo e(route("super-admin.front-widgets.edit", ":id")); ?>';
        url = url.replace(':id', typeId);

        $('#modelHeading').html("<?php echo e(__('app.edit')." ".__('modules.tickets.ticketType')); ?>");
        $.ajaxModal('#ticketTypeModal', url);
    })

  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.super-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/front-widgets/index.blade.php ENDPATH**/ ?>