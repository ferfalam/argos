<?php if(in_array('Zoom', $modules)): ?>
<li>
    <a href="<?php echo e(route('admin.zoom-setting.store')); ?>" class="waves-effect">
        <i class="fa fa-video-camera"></i>
        <span class="hide-menu">
            <?php echo app('translator')->get('zoom::app.menu.meeting'); ?> <span class="fa arrow"></span>
        </span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="<?php echo e(route('admin.offmeeting.index')); ?>">
                <?php echo app('translator')->get('zoom::app.menu.meeting'); ?>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('admin.room.index')); ?>">
                <?php echo app('translator')->get('zoom::app.menu.room'); ?>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('admin.zoom-meeting.table-view')); ?>">
                <?php echo app('translator')->get('zoom::app.menu.zoomMeeting'); ?>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('admin.zoom-setting.store')); ?>">
                <?php echo app('translator')->get('zoom::app.menu.zoomSetting'); ?>
            </a>
        </li>
    </ul>
</li>
<?php endif; ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\Modules/Zoom\Resources/views/sections/left_sidebar.blade.php ENDPATH**/ ?>