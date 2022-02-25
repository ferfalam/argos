<li>
    <div class="drop-title row">
        <span class="font-12 col-xs-6 font-semi-bold"><?php echo app('translator')->get('app.newNotifications'); ?></span>
        <a class="mark-notification-read col-xs-6 text-right font-12 font-semi-bold"
            href="javascript:;"> <?php echo app('translator')->get('app.markRead'); ?></a>
    </div>
</li>
<?php $__empty_1 = true; $__currentLoopData = $user->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php if(view()->exists('notifications.admin.'.\Illuminate\Support\Str::snake(class_basename($notification->type)))): ?>
        <?php echo $__env->make('notifications.admin.'.\Illuminate\Support\Str::snake(class_basename($notification->type)), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <li class="p-10"><?php echo app('translator')->get('messages.noNotification'); ?></li>
<?php endif; ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/notifications/admin_user_notifications.blade.php ENDPATH**/ ?>