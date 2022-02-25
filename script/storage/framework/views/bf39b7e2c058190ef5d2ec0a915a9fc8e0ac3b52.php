<?php $__env->startSection('other-section'); ?>
<ul class="nav tabs-vertical">
    <li class="tab">
        <a href="<?php echo e(route('super-admin.theme-settings')); ?>" class="text-danger"><i class="ti-arrow-left"></i> <?php echo app('translator')->get('app.front'); ?> <?php echo app('translator')->get('app.menu.settings'); ?></a></li>

    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.footer-settings.footer-text'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.footer-settings.footer-text')); ?>"> <?php echo app('translator')->get('app.footer'); ?> <?php echo app('translator')->get('app.menu.settings'); ?></a></li>

    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.cta-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.cta-settings.index')); ?>">CTA <?php echo app('translator')->get('app.footer'); ?> <?php echo app('translator')->get('app.menu.settings'); ?></a>
    </li>

    <li class="tab  <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.footer-settings.index' ||
    \Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.footer-settings.create' ||
     \Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.footer-settings.edit'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.footer-settings.index')); ?>"><?php echo app('translator')->get('modules.footer.setting'); ?> </a></li>
</ul>

<script src="<?php echo e(asset('plugins/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script>
    var screenWidth = $(window).width();
    if(screenWidth <= 768){

        $('.tabs-vertical').each(function() {
            var list = $(this), select = $(document.createElement('select')).insertBefore($(this).hide()).addClass('settings_dropdown form-control');

            $('>li a', this).each(function() {
                var target = $(this).attr('target'),
                    option = $(document.createElement('option'))
                        .appendTo(select)
                        .val(this.href)
                        .html($(this).html())
                        .click(function(){
                            if(target==='_blank') {
                                window.open($(this).val());
                            }
                            else {
                                window.location.href = $(this).val();
                            }
                        });

                if(window.location.href == option.val()){
                    option.attr('selected', 'selected');
                }
            });
            list.remove();
        });

        $('.settings_dropdown').change(function () {
            window.location.href = $(this).val();
        })

    }
</script>
<?php $__env->stopSection(); ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/sections/saas/footer_page_setting_menu.blade.php ENDPATH**/ ?>