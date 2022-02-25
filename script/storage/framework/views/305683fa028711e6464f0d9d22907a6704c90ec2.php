<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e($global->favicon_url); ?>">
    
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo e($global->favicon_url); ?>">
    <meta name="theme-color" content="#ffffff">

    <title><?php echo e($setting->company_name); ?></title>

    <link href="<?php echo e(asset('bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('less/icons/font-awesome/css/font-awesome.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/auth.css')); ?>" rel="stylesheet">

        <?php if(isset($themeSetting->rounded_theme) && $themeSetting->rounded_theme == 1): ?>
            <link href="<?php echo e(asset('css/rounded.css')); ?>" rel="stylesheet">
        <?php endif; ?>

        <?php if( isset($themeSetting->login_background)  && !is_null($themeSetting->login_background)): ?>
            <style>
                 #auth-logo {
                    background: <?php echo e($themeSetting->login_background); ?>;
                }
            </style>
        <?php endif; ?>

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    </script>

    <?php echo $__env->yieldPushContent('head-script'); ?>

    <style>
        #background-section {
            background: url("<?php echo e($setting->login_background_url); ?>") center center/cover no-repeat !important;
        }

        <?php echo $setting->auth_css; ?>

    </style>

</head>
<body>

<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-lg-5" id="form-section">
        <div id="auth-logo">
            <img src="<?php echo e($setting->logo_url); ?>" style="max-height: 50px" alt="Logo"/>
        </div>

        <div id="auth-form">


            <?php echo $__env->yieldContent('content'); ?>

        </div>
    </div>

    <div class="col-lg-7 visible-lg" id="background-section">

    </div>
  </div>
</div>

<script src="<?php echo e(asset('plugins/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<?php echo $__env->yieldPushContent('footer-script'); ?>

</body>
</html>
<?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/layouts/auth.blade.php ENDPATH**/ ?>