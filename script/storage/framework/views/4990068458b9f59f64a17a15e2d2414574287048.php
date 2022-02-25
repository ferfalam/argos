<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/summernote/dist/summernote.css')); ?>">
<style>
    .panel-black .panel-heading a,
    .panel-inverse .panel-heading a {
        color: unset !important;
    }
</style>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title"><?php echo app('translator')->get('app.addNew'); ?> <?php echo app('translator')->get('app.menu.offlinePaymentMethod'); ?></h4>
</div>
<div class="modal-body">
    <div class="portlet-body">

        <?php echo Form::open(['id'=>'createMethods','class'=>'ajax-form','method'=>'POST']); ?>


        <div class="form-body">

            <div class="form-group">
                <label><?php echo app('translator')->get('modules.offlinePayment.method'); ?></label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label><?php echo app('translator')->get('modules.offlinePayment.description'); ?></label>
                <textarea id="description" name="description" class="form-control summernote"></textarea>
            </div>

        </div>

        <?php echo Form::close(); ?>

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
    <button type="button" id="save-method" class="btn btn-info save-event waves-effect waves-light"><i
            class="fa fa-check"></i> <?php echo app('translator')->get('app.save'); ?>
    </button>
</div>

<script src="<?php echo e(asset('plugins/bower_components/summernote/dist/summernote.min.js')); ?>"></script>

<script>
    $('#description').summernote({
        height: 120,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: false,                 // set focus to editable area after initializing summernote
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['fontsize', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ["view", ["fullscreen"]]
        ]
    });

    //    save project members
    $('#save-method').click(function () {
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
</script><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/payment-settings/offline-method/create-modal.blade.php ENDPATH**/ ?>