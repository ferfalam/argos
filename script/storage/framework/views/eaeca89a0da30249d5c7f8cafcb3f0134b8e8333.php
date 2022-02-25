<?php $__env->startSection('other-section'); ?>
<ul class="nav tabs-vertical">
    
        
    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.theme-settings'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.theme-settings')); ?>"><?php echo app('translator')->get('app.menu.chooseTheme'); ?></a></li>

    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.front-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.front-settings.index')); ?>"><?php echo app('translator')->get('app.front'); ?> <?php echo app('translator')->get('app.menu.settings'); ?></a></li>

    <li class="tab <?php if(isset($type) && $type == 'image'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.feature-settings.index')); ?>?type=image"><?php echo app('translator')->get('app.feature'); ?> <?php echo app('translator')->get('app.menu.settings'); ?></a></li>

    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.testimonial-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.testimonial-settings.index')); ?>"><?php echo app('translator')->get('app.testimonial'); ?> <?php echo app('translator')->get('app.menu.settings'); ?></a></li>

    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.client-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.client-settings.index')); ?>"><?php echo app('translator')->get('app.frontClient'); ?> <?php echo app('translator')->get('app.menu.settings'); ?></a></li>

    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.faq-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.faq-settings.index')); ?>"><?php echo app('translator')->get('app.faq'); ?> <?php echo app('translator')->get('app.menu.settings'); ?></a></li>

    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.contact-settings'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.contact-settings')); ?>"><?php echo app('translator')->get('app.contact'); ?> <?php echo app('translator')->get('app.menu.settings'); ?></a></li>

    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.price-settings'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.price-settings')); ?>"> <?php echo app('translator')->get('app.price'); ?> <?php echo app('translator')->get('app.menu.settings'); ?></a></li>

    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.front-menu-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.front-menu-settings.index')); ?>"> <?php echo app('translator')->get('app.front'); ?> <?php echo app('translator')->get('app.menu.menu'); ?> <?php echo app('translator')->get('app.menu.settings'); ?></a></li>

    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.footer-settings.footer-text'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.footer-settings.footer-text')); ?>"> <?php echo app('translator')->get('app.footer'); ?> <?php echo app('translator')->get('app.menu.settings'); ?></a></li>

    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.front-widgets.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.front-widgets.index')); ?>"><?php echo app('translator')->get('app.menu.frontWidgets'); ?></a></li>

    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.seo-detail.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.seo-detail.index')); ?>"><?php echo app('translator')->get('app.menu.seoDetails'); ?></a></li>

    <li class="tab  <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.auth-settings'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.auth-settings')); ?>"><?php echo app('translator')->get('app.authSetting'); ?> </a></li>
    
        <li class="tab  <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.sign-up-setting.index'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('super-admin.sign-up-setting.index')); ?>"> <?php echo app('translator')->get('app.signUpSetting'); ?></a></li>
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
<?php $__env->stopSection(); ?>
<?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/sections/front_setting_new_theme_menu.blade.php ENDPATH**/ ?>