<?php $__env->startSection('other-section'); ?>
<ul class="nav tabs-vertical slimscrollright mt-0">
    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('admin.settings.index')); ?>"><?php echo app('translator')->get('app.menu.accountSettings'); ?></a></li>

    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.profile-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('admin.profile-settings.index')); ?>"><?php echo app('translator')->get('app.menu.profileSettings'); ?></a></li>

    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.email-settings.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('admin.email-settings.index')); ?>"><?php echo app('translator')->get('app.menu.notificationSettings'); ?></a></li>

    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.currency.index' || \Illuminate\Support\Facades\Route::currentRouteName() == 'admin.currency.currency-format'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('admin.currency.index')); ?>"><?php echo app('translator')->get('app.menu.currencySettings'); ?></a></li>

    <?php if($company->status != 'license_expired'): ?>
        <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.theme-settings.index'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.theme-settings.index')); ?>"><?php echo app('translator')->get('app.menu.themeSettings'); ?></a></li>
    <?php endif; ?>

    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.payment-gateway-credential.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('admin.payment-gateway-credential.index')); ?>"><?php echo app('translator')->get('app.menu.paymentGatewayCredential'); ?></a>
    </li>

    <?php if(in_array("invoices", $modules)): ?>
        <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.invoice-settings.index'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.invoice-settings.index')); ?>"><?php echo app('translator')->get('app.menu.financeSettings'); ?></a></li>
    <?php endif; ?>

    <?php if(in_array("tickets", $modules)): ?>
        <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.ticket-agents.index'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.ticket-agents.index')); ?>"><?php echo app('translator')->get('app.menu.ticketSettings'); ?></a></li>
    <?php endif; ?>

    <?php if(in_array('projects', $user->modules)): ?>
        <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.project-settings.index'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.project-settings.index')); ?>"><?php echo app('translator')->get('app.menu.projectSettings'); ?></a></li>
    <?php endif; ?>

    <?php if(in_array('attendance',$user->modules)): ?>
        <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.attendance-settings.index'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.attendance-settings.index')); ?>"><?php echo app('translator')->get('app.menu.attendanceSettings'); ?></a></li>
    <?php endif; ?>

    <?php if(in_array('leaves',$user->modules)): ?>
        <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.leaves-settings.index'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.leaves-settings.index')); ?>"><?php echo app('translator')->get('app.menu.leaveSettings'); ?></a></li>
    <?php endif; ?>

    <?php if($company->status != 'license_expired'): ?>
        <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.custom-fields.index'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.custom-fields.index')); ?>"><?php echo app('translator')->get('app.menu.customFields'); ?></a></li>

        <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.module-settings.index'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.module-settings.index')); ?>"><?php echo app('translator')->get('app.menu.moduleSettings'); ?></a></li>

        <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.role-permission.index'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.role-permission.index')); ?>"><?php echo app('translator')->get('app.menu.rolesPermission'); ?></a></li>
    <?php endif; ?>

    <?php if(in_array('messages',$user->modules)): ?>
        <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.message-settings.index'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.message-settings.index')); ?>"><?php echo app('translator')->get('app.menu.messageSettings'); ?></a></li>
    <?php endif; ?>



    <?php if(in_array('leads',$user->modules)): ?>
        <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.lead-source-settings.index'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.lead-source-settings.index')); ?>"><?php echo app('translator')->get('app.lead'); ?> <?php echo app('translator')->get('app.menu.settings'); ?></a></li>
    <?php endif; ?>

    <?php if(in_array('timelogs',$user->modules)): ?>
        <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.log-time-settings.index'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.log-time-settings.index')); ?>"><?php echo app('translator')->get('app.timeLog'); ?> <?php echo app('translator')->get('app.menu.settings'); ?></a></li>
    <?php endif; ?>

    <?php if(in_array("tasks", $modules) ): ?>
        <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.task-settings.index'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.task-settings.index')); ?>"><?php echo app('translator')->get('app.task'); ?> <?php echo app('translator')->get('app.menu.settings'); ?></a></li>
    <?php endif; ?>

    <?php if($superadmin->google_calendar_status == 'active'): ?>
        <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.google-calendar.index'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.google-calendar.index')); ?>"><?php echo app('translator')->get('app.googleCalendar'); ?></a></li>
    <?php endif; ?>

    <?php $__currentLoopData = $worksuitePlugins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(in_array(strtolower($item), $modules)): ?>
            <?php if(View::exists(strtolower($item).'::sections.admin_setting_menu')): ?>
                <?php echo $__env->make(strtolower($item).'::sections.admin_setting_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <li class="tab <?php if(\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.gdpr.index'): ?> active <?php endif; ?>">
        <a href="<?php echo e(route('admin.gdpr.index')); ?>" class="waves-effect"><span class="hide-menu"> <?php echo app('translator')->get('app.menu.gdpr'); ?></span></a>
    </li>

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
<?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/sections/admin_setting_menu.blade.php ENDPATH**/ ?>