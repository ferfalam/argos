<?php
$allModules = Module::all();
$activeModules = [];
foreach ($allModules as $module) {
$activeModules[] = config(strtolower($module) . '.envato_item_id');
}
?>

<?php if(!empty($plugins = \Froiden\Envato\Functions\EnvatoUpdate::plugins()) && count($activeModules) !== count($plugins )): ?>


<div class="col-md-12 m-t-20">
    <h4><?php echo e(ucwords(config('froiden_envato.envato_product_name'))); ?> Official Modules</h4>
    <div class="row">

        <?php $__currentLoopData = $plugins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php if(!in_array($item['envato_id'],$activeModules)): ?>
        <div class="col-md-12 b-all p-10 m-t-10">
            <div class="row">
                <div class="col-xs-2 col-lg-1">
                    <a href="<?php echo e($item['product_link']); ?>" target="_blank">
                        <img src="<?php echo e($item['product_thumbnail']); ?>" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-xs-8 col-lg-5">
                    <a href="<?php echo e($item['product_link']); ?>" target="_blank" class="font-bold"><?php echo e($item['product_name']); ?>

                    </a>

                    <p class="font-12">
                        <?php echo e($item['summary']); ?>

                    </p>
                </div>
                <div class="col-xs-2 col-lg-6 text-right">
                    <a href="<?php echo e($item['product_link']); ?>" target="_blank" class="btn btn-md btn-success"><i
                            class="fa fa-arrow-right text-white"></i></a>
                </div>
            </div>
        </div>
        <?php endif; ?>


        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

</div>
<?php endif; ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/vendor/froiden-envato/update/plugins.blade.php ENDPATH**/ ?>