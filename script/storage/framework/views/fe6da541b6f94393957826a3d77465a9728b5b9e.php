<?php $__env->startSection('other-section'); ?>

<ul class="nav tabs-vertical">
    <li
        class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.settings.index')); ?>"><?php echo app('translator')->get('app.global'); ?> <?php echo app('translator')->get('app.menu.settings'); ?></a></li>
    <li
        class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.email-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.email-settings.index')); ?>"><?php echo app('translator')->get('app.email'); ?> <?php echo app('translator')->get('app.menu.settings'); ?></a></li>
    <li
        class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.security-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.security-settings.index')); ?>"><?php echo app('translator')->get('app.security'); ?></a></li>
    <li
        class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.push-notification-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.push-notification-settings.index')); ?>"><?php echo app('translator')->get('app.menu.pushNotifications'); ?>
            <?php echo app('translator')->get('app.menu.settings'); ?></a>
    </li>
    <li
        class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.language-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.language-settings.index')); ?>"><?php echo app('translator')->get('app.language'); ?>
            <?php echo app('translator')->get('app.menu.settings'); ?></a>
    </li>
    <li
        class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.currency.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.currency.index')); ?>"><?php echo app('translator')->get('app.menu.currencySettings'); ?></a></li>
    <li
        class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.payment-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.payment-settings.index')); ?>"><?php echo app('translator')->get('app.menu.paymentGatewayCredential'); ?></a></li>
    <li
        class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.package-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.package-settings.index')); ?>"><?php echo app('translator')->get('app.freeTrial'); ?>
            <?php echo app('translator')->get('app.menu.settings'); ?>
            
        </a>
        </li>
    <li
        class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.custom-modules.index' || \Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.custom-modules.create'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.custom-modules.index')); ?>"><?php echo app('translator')->get('app.menu.customModule'); ?></a></li>

    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.custom-fields.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.custom-fields.index')); ?>"><?php echo app('translator')->get('app.menu.customFields'); ?></a></li>

    <li
        class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.storage-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.storage-settings.index')); ?>"><?php echo app('translator')->get('app.menu.storageSettings'); ?></a>
    </li>
    <li
        class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.theme-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.theme-settings.index')); ?>"><?php echo app('translator')->get('app.menu.themeSettings'); ?></a>
    </li>
    <li
        class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.profile.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.profile.index')); ?>"><?php echo app('translator')->get('app.menu.profileSettings'); ?></a>
    </li>
    <li
        class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.social-auth-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.social-auth-settings.index')); ?>"><?php echo app('translator')->get('app.menu.socialLogin'); ?></a>
    </li>
    <li
        class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.google-calendar-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.google-calendar-settings.index')); ?>"><?php echo app('translator')->get('app.googleCalendar'); ?></a>
    </li>

    <?php $__currentLoopData = $worksuitePlugins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(View::exists(strtolower($item).'::sections.super_admin_setting_menu')): ?>
            <?php echo $__env->make(strtolower($item).'::sections.super_admin_setting_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php if($global->system_update == 1): ?>
    <li
        class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'super-admin.update-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('super-admin.update-settings.index')); ?>"><?php echo app('translator')->get('app.menu.updates'); ?></a>
    </li>
    <?php endif; ?>
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
<?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/sections/super_admin_setting_menu.blade.php ENDPATH**/ ?>