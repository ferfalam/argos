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
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/switchery/dist/switchery.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/summernote/dist/summernote.css')); ?>">

<style>
  .m-b-10{
      margin-bottom: 10px;
  }
  .mt-10{
      margin-top: 10px;
  }
  .hide-box{
      display: none;
  }
  .register{
    margin-top:20px;
  }

</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-inverse">
                <div class="vtabs customvtab m-t-10">
                    <?php if($global->front_design == 1): ?>
                        <?php echo $__env->make('sections.front_setting_new_theme_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php else: ?>
                        <?php echo $__env->make('sections.front_setting_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                    <div class="tab-content">
                        <div id="vhome3" class="tab-pane active">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                        <hr>
                                  <div class="form-body">
                                    <h4><?php echo app('translator')->get('app.menu.registrationPage'); ?></h4>
                                    <div class="row register">
                                      <div class="col-md-4">
                                        <div class="switchery-demo">
                                            <input type="checkbox" name="registration_open" id="registration_open" 
                                                    class="js-switch packeges" data-size="medium" data-color="#00c292"
                                                    data-secondary-color="#f96262" value="true" <?php if($registrationStatus->registration_open == 1): ?> checked <?php endif; ?>/>
                                        </div>
                                      </div>
                                      <div class="col-md-4 disable-message <?php if($registrationStatus->registration_open == 1): ?> hide-box <?php endif; ?>" >
                                        <div class="form-group">
                                            <div class="checkbox checkbox-info  col-md-10">
                                                <input id="enable_register" name="enable_register" value="1" 
                                                <?php if($registrationStatus->enable_register == true): ?> checked
                                                <?php endif; ?>
                                                type="checkbox">
                                                <label for="enable_register"><?php echo app('translator')->get('modules.accountSettings.enableRegister'); ?></label>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-12" style="margin-top: 20px;"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span>*</span><span id="registation-text" style='color:rgb(0,128,0);'><?php echo app('translator')->get('messages.registrationOpen'); ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12" style="margin-top: 20px;"></div>
                                    <div class="row disable-message hide-box">
                                        <div class="tab-content">
                                            <div id="vhome3" class="tab-pane active">
                                                <div class="row">
                                                    <input type ="hidden" name = "setting_id" id="setting_id" value=<?php echo e($registrationStatus->id); ?>>
                                                    <div class="col-sm-12">
                                                               
                                                            
                                                        <div class="white-box">
                                                            
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
                                                                <?php echo $__env->make('super-admin.sign-up-setting.edit-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/switchery/dist/switchery.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bower_components/summernote/dist/summernote.min.js')); ?>"></script>
     
<script>
     function changeForm(target) {
            $.easyAjax({
                url: "<?php echo e(route('super-admin.sign-up-setting.changeForm')); ?>",
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
    
        $('.summernote').summernote({
        height: 200,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: false,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['fontsize', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ["view", ["fullscreen","codeview"]]
        ]
    });

 // Switchery
 var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function (elem) {
        new Switchery($(this)[0], $(this).data());

    });

    if(!$('#registration_open').is(':checked')){
      $('.disable-message').show();
      $('#registation-text').text("<?php echo app('translator')->get('messages.registrationClosed'); ?>").css("color", "#ff0000");
    }
    $('#registration_open').change(function(){
        var status = $(this).is(':checked') ? 1 : 0 ;
        var enable_register = (status == 1) ? 1:0;
        if(status == 0){
            $('#enable_register').prop('checked', false); 
        }
        var token = "<?php echo e(csrf_token()); ?>";
        $.easyAjax({
            url: '<?php echo e(route('super-admin.sign-up-setting.update', $registrationStatus->id)); ?>',
            type: "PUT",
            data: {'status': status, 'enable_register':enable_register, '_token': token},
            success: function (response) {
                if(status == 1){
                    $('.disable-message').hide();
                    $('#registation-text').text("<?php echo app('translator')->get('messages.registrationOpen'); ?>").css("color", "#008000");
                } else {
                    $('.disable-message').show();
                    $('#registation-text').text("<?php echo app('translator')->get('messages.registrationClosed'); ?>").css("color", "#ff0000");
                }
            }
        })

     
    })

    $('body').on('click', '#save-form', function () {
        var token = "<?php echo e(csrf_token()); ?>";
        var enable_register = $('#enable_register').is(':checked') ? 1 : 0 ;
        var setting_id = $('#setting_id').val();
            $.easyAjax({
                url: "<?php echo e(route('super-admin.sign-up-setting.store')); ?>",
                container: '#editSettings',
                type: "POST",
                file: true,
                data: {
                    language_settings_id: $('#editSettings').data('language-id')
                    , '_token': token,
                    'enable_register' : enable_register,
                    'id':setting_id,
                }
            })
        });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.super-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/sign-up-setting/index.blade.php ENDPATH**/ ?>