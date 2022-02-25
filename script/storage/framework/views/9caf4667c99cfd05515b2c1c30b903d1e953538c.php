<!-- START Header -->
<header class="header position-relative">
    <!-- START Navigation -->
    <div class="navigation-bar" id="affix">
        <div class="container">
            <nav class="navbar navbar-expand-lg p-0">
                <a class="logo" href="<?php echo e(route('front.home')); ?>">
                    <img class="logo-default"  src="<?php echo e($setting->logo_front_url); ?>" alt="home"  style="max-height:35px"/>
                </a>
                <button class="navbar-toggler border-0 p-0" type="button" data-toggle="collapse"
                        data-target="#theme-navbar" aria-controls="theme-navbar" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-lines"></span>
                </button>

                <div class="collapse navbar-collapse" id="theme-navbar">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('front.home')); ?>"><?php echo e($frontMenu->home); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('front.feature')); ?>"><?php echo e($frontMenu->feature); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('front.pricing')); ?>"><?php echo e($frontMenu->price); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('front.contact')); ?>"><?php echo e($frontMenu->contact); ?></a>
                        </li>
                        <?php $__empty_1 = true; $__currentLoopData = $footerSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $footerSetting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if($footerSetting->type != 'footer'): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php if(!is_null($footerSetting->external_link)): ?> <?php echo e($footerSetting->external_link); ?> <?php else: ?> <?php echo e(route('front.page', $footerSetting->slug)); ?> <?php endif; ?>" ><?php echo e($footerSetting->name); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </ul>
                    <div class="my-3 my-lg-0">
                            <a href="<?php echo e(module_enabled('Subdomain')?route('front.workspace'):route('login')); ?>"
                               class="btn btn-border shadow-none"><?php echo e($frontMenu->login); ?></a>
                        <?php if($frontDetail->get_started_show == 'yes' && $global->enable_register == true): ?>
                                <a href="<?php echo e(route('front.signup.index')); ?>" class="btn btn-menu-signup shadow-none ml-2"><?php echo e($frontMenu->get_start); ?></a><?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- END Navigation -->
</header>
<!-- END Header -->
<?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/sections/saas/saas_header.blade.php ENDPATH**/ ?>