<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12 bg-title-left">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e(__($pageTitle)); ?></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 bg-title-right">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('super-admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li class="active"><?php echo e(__($pageTitle)); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/switchery/dist/switchery.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-inverse">
                <div class="panel-heading"><?php echo e(__($pageTitle)); ?></div>

                <div class="vtabs customvtab m-t-10">

                    <?php echo $__env->make('sections.super_admin_payment_setting_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="tab-content">
                        <div id="vhome3" class="tab-pane active">
                            <div class="row">
                                <div class="col-xs-12">

                                    <h3 class="box-title m-b-0"><?php echo app('translator')->get('app.menu.onlinePayment'); ?></h3>

                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12 ">
                                            <?php echo Form::open(['id'=>'updateSettings','class'=>'ajax-form','method'=>'PUT']); ?>

                                            <div class="form-body">
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="nav-item active">
                                                        <a class="nav-link active" data-toggle="tab" href="#Paypal" role="tab" aria-selected="true">
                                                        <span class="hidden-sm-up">
                                                            <i class="fa fa-paypal"></i>
                                                        </span>
                                                            <span class="hidden-xs-down">Paypal <?php if($credentials->paypal_status == 'active'): ?> <i class="fa fa-check-circle activated-gateway"></i> <?php endif; ?></span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#Stripe" role="tab" aria-selected="true">
                                                        <span class="hidden-sm-up">
                                                            <i class="fa fa-cc-stripe"></i>
                                                        </span>
                                                            <span class="hidden-xs-down">Stripe <?php if($credentials->stripe_status == 'active'): ?> <i class="fa fa-check-circle activated-gateway"></i> <?php endif; ?></span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#Razorpay" role="tab" aria-selected="true">
                                                        <span class="hidden-sm-up">
                                                            
                                                            <img src="<?php echo e(asset('img/razorpay.svg')); ?>" width="45px" class="display-small">
                                                        </span>
                                                            <span class="hidden-xs-down">Razorpay <?php if($credentials->razorpay_status == 'active'): ?> <i class="fa fa-check-circle activated-gateway"></i> <?php endif; ?></span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#Paystack" role="tab" aria-selected="true">
                                                        <span class="hidden-sm-up">
                                                             <img src="<?php echo e(asset('img/paystack.png')); ?>" width="45px" class="display-small">
                                                        </span>
                                                            <span class="hidden-xs-down">Paystack <?php if($credentials->paystack_status == 'active'): ?> <i class="fa fa-check-circle activated-gateway"></i> <?php endif; ?></span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#Mollie" role="tab" aria-selected="true">
                                                        <span class="hidden-sm-up">
                                                             <img src="<?php echo e(asset('img/mollie.svg')); ?>" width="35px" class="display-small">
                                                        </span>
                                                            <span class="hidden-xs-down">Mollie <?php if($credentials->mollie_status == 'active'): ?> <i class="fa fa-check-circle activated-gateway"></i> <?php endif; ?></span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#authorize" role="tab" aria-selected="true">
                                                        <span class="hidden-sm-up">
                                                             <img src="<?php echo e(asset('img/authorize.jpg')); ?>" width="25px" class="display-small">
                                                        </span>
                                                            <span class="hidden-xs-down">Authorize.net <?php if($credentials->authorize_status == 'active'): ?> <i class="fa fa-check-circle activated-gateway"></i> <?php endif; ?></span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#mon_commerce" role="tab" aria-selected="true">
                                                        <span class="hidden-sm-up">
                                                             <img src="<?php echo e(asset('img/moncommerce.png')); ?>" width="25px" class="display-small">
                                                        </span>
                                                            <span class="hidden-xs-down">Mon Commerce <?php if($credentials->mon_commerce_status == 'active'): ?> <i class="fa fa-check-circle activated-gateway"></i> <?php endif; ?></span>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content tabcontent-border">
                                                    <div class="tab-pane active" id="Paypal" role="tabpanel">
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo app('translator')->get('modules.paymentSetting.paypalClientId'); ?></label>
                                                                <input type="text" name="paypal_client_id" id="paypal_client_id"
                                                                       class="form-control" value="<?php echo e($credentials->paypal_client_id); ?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo app('translator')->get('modules.paymentSetting.paypalSecret'); ?></label>
                                                                <input type="password" name="paypal_secret"
                                                                       id="paypal_secret"
                                                                       class="form-control"
                                                                       value="<?php echo e($credentials->paypal_secret); ?>">
                                                                <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                            </div>
                                                        </div>


                                                        <!--/span-->
                                                        <div class="col-md-6">

                                                            <div class="form-group">
                                                                <label><?php echo app('translator')->get('modules.paymentSetting.selectEnvironment'); ?></label>
                                                                <select class="form-control" name="paypal_mode" id="paypal_mode" data-style="form-control">
                                                                    <option value="sandbox" <?php if($credentials->paypal_mode == 'sandbox'): ?> selected <?php endif; ?>>Sandbox</option>
                                                                    <option value="live" <?php if($credentials->paypal_mode == 'live'): ?> selected <?php endif; ?>>Live</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="mail_from_name"><?php echo app('translator')->get('app.webhook'); ?></label>
                                                                <p class="text-bold"><?php echo e(route('verify-billing-ipn')); ?></p>
                                                                <p class="text-info">(<?php echo app('translator')->get('messages.addPaypalWebhookUrl'); ?>
                                                                    )</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="form-group">
                                                                <label class="control-label" ><?php echo app('translator')->get('modules.payments.paypalStatus'); ?></label>
                                                                <div class="switchery-demo">
                                                                    <input
                                                                            type="checkbox"
                                                                            data-type-name="paypal"
                                                                            name="paypal_status"
                                                                            <?php if($credentials->paypal_status == 'active'): ?> checked <?php endif; ?>
                                                                            class="js-switch special" id="paypalButton"
                                                                            data-color="#00c292"
                                                                            data-secondary-color="#f96262"
                                                                    />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="tab-pane" id="Stripe" role="tabpanel">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo app('translator')->get('modules.paymentSetting.stripeClientId'); ?></label>
                                                                <input type="text" name="api_key" id="stripe_client_id"
                                                                       class="form-control" value="<?php echo e($credentials->api_key); ?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo app('translator')->get('modules.paymentSetting.stripeSecret'); ?></label>
                                                                <input type="password" name="api_secret" id="stripe_secret"
                                                                       class="form-control" value="<?php echo e($credentials->api_secret); ?>">
                                                                <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12">
                                                            <div class="form-group">
                                                                <label><?php echo app('translator')->get('modules.paymentSetting.stripeWebhookSecret'); ?></label>
                                                                <input type="password" name="webhook_key" id="stripe_webhook_secret"
                                                                       class="form-control" value="<?php echo e($credentials->webhook_key); ?>">


                                                                <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                            </div>
                                                            <input type="hidden" name="bothUncheck" id="bothUncheck" >
                                                            <input type="hidden" name="type" id="type" >
                                                            <input type="hidden" name="_method" id="method" >

                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="form-group">
                                                                <label for="mail_from_name"><?php echo app('translator')->get('app.webhook'); ?></label>
                                                                <p class="text-bold"><?php echo e(route('save_webhook')); ?></p>
                                                                <p class="text-info">(<?php echo app('translator')->get('messages.addStripeWebhookUrl'); ?>)</p>
                                                                <p class="text-info">(<?php echo app('translator')->get('messages.addStripeWebhookUrlMethod'); ?>)</p>
                                                            </div>
                                                        </div>
                                                        <!--/span-->

                                                        <div class="col-xs-12">
                                                            <div class="form-group">
                                                                <label class="control-label" ><?php echo app('translator')->get('modules.payments.stripeStatus'); ?></label>
                                                                <div class="switchery-demo">
                                                                    <input
                                                                            type="checkbox"
                                                                            data-type-name="stripe"
                                                                            name="stripe_status"
                                                                            <?php if($credentials->stripe_status == 'active'): ?> checked <?php endif; ?>
                                                                            class="js-switch"
                                                                            data-color="#00c292" id="stripeButton"
                                                                            data-secondary-color="#f96262"
                                                                    />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="Razorpay" role="tabpanel">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class=""><?php echo app('translator')->get('modules.paymentSetting.RazorpayKey'); ?></label>
                                                                <input type="text" name="razorpay_key" id="razorpay_key"
                                                                       class="form-control" value="<?php echo e($credentials->razorpay_key); ?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo app('translator')->get('modules.paymentSetting.razorpaySecretKey'); ?></label>
                                                                <input type="password" name="razorpay_secret" id="razorpay_secret"
                                                                       class="form-control" value="<?php echo e($credentials->razorpay_secret); ?>">
                                                                <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo app('translator')->get('modules.paymentSetting.razorpayWebhookSecretKey'); ?></label>
                                                                <input type="password" name="razorpay_webhook_secret" id="razorpay_webhook_secret"
                                                                       class="form-control" value="<?php echo e($credentials->razorpay_webhook_secret); ?>">
                                                                <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="mail_from_name"><?php echo app('translator')->get('app.webhook'); ?></label>
                                                                <p class="text-bold"><?php echo e(route('save_razorpay-webhook')); ?></p>
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12">
                                                            <div class="form-group">
                                                                <label class="control-label" ><?php echo app('translator')->get('modules.payments.razorpayStatus'); ?></label>
                                                                <div class="switchery-demo">
                                                                    <input type="checkbox" name="razorpay_status" <?php if($credentials->razorpay_status == 'active'): ?> checked <?php endif; ?> class="js-switch " data-color="#00c292" data-secondary-color="#f96262"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="Paystack" role="tabpanel">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class=""><?php echo app('translator')->get('modules.paymentSetting.paystackKey'); ?></label>
                                                                <input type="text" name="paystack_client_id" id="paystack_client_id"
                                                                       class="form-control" value="<?php echo e($credentials->paystack_client_id); ?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo app('translator')->get('modules.paymentSetting.PaystackSecretKey'); ?></label>
                                                                <input type="password" name="paystack_secret" id="paystack_secret"
                                                                       class="form-control" value="<?php echo e($credentials->paystack_secret); ?>">
                                                                <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo app('translator')->get('modules.paymentSetting.paystackMerchantEmail'); ?></label>
                                                                <input type="text" name="paystack_merchant_email" id="paystack_merchant_email"
                                                                       class="form-control" value="<?php echo e($credentials->paystack_merchant_email); ?>">
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label" ><?php echo app('translator')->get('modules.paymentSetting.paystackStatus'); ?></label>
                                                                <div class="switchery-demo">
                                                                    <input type="checkbox" name="paystack_status" <?php if($credentials->paystack_status == 'active'): ?> checked <?php endif; ?> class="js-switch " data-color="#00c292" data-secondary-color="#f96262"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="mail_from_name"><?php echo app('translator')->get('app.webhook'); ?></label>
                                                                <p class="text-bold"><?php echo e(route('save_paystack-webhook')); ?></p>
                                                                <p class="text-info">(<?php echo app('translator')->get('messages.addPaystackWebhookUrl'); ?>
                                                                    )</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="mail_from_name"><?php echo app('translator')->get('app.callback'); ?></label>
                                                                <p class="text-bold"><?php echo e(route('admin.payments.paystack.callback')); ?></p>
                                                                <p class="text-info">(<?php echo app('translator')->get('messages.addPaystackCallbackUrl'); ?>
                                                                    )</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="Mollie" role="tabpanel">
                                                        <div class="col-xs-12">
                                                            <div class="form-group">
                                                                <label class=""><?php echo app('translator')->get('modules.paymentSetting.mollieApiKey'); ?></label>
                                                                <input type="text" name="mollie_api_key" id="paystack_client_id"
                                                                       class="form-control" value="<?php echo e($credentials->mollie_api_key); ?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12">
                                                            <div class="form-group">
                                                                <label class="control-label" ><?php echo app('translator')->get('modules.paymentSetting.mollieStatus'); ?></label>
                                                                <div class="switchery-demo">
                                                                    <input type="checkbox" name="mollie_status" <?php if($credentials->mollie_status == 'active'): ?> checked <?php endif; ?> class="js-switch " data-color="#00c292" data-secondary-color="#f96262"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="authorize" role="tabpanel">
                                                        <div class="col-xs-12">
                                                            <div class="form-group">
                                                                <label><?php echo app('translator')->get('modules.paymentSetting.authorizeApiLoginId'); ?></label>
                                                                <input type="password" name="authorize_api_login_id" id="authorize_api_login_id"
                                                                       class="form-control" value="<?php echo e($credentials->authorize_api_login_id); ?>">
                                                                <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12">
                                                            <div class="form-group">
                                                                <label> <?php echo app('translator')->get('modules.paymentSetting.authorizeTransactionKey'); ?></label>
                                                                <input type="password" name="authorize_transaction_key" id="authorize_transaction_key"
                                                                       class="form-control" value="<?php echo e($credentials->authorize_transaction_key); ?>">
                                                                <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label><?php echo app('translator')->get('modules.paymentSetting.authorizeSignatureKey'); ?></label>
                                                                <input type="password" name="authorize_signature_key" id="authorize_signature_key"
                                                                       class="form-control" value="<?php echo e($credentials->authorize_signature_key); ?>">
                                                                <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                            </div>



                                                            
                                                            
                                                            
                                                            
                                                            
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="form-group">
                                                                <h5>Select environment</h5>
                                                                <select class="form-control" name="authorize_environment" id="authorize_environment" data-style="form-control">
                                                                    <option value="sandbox" <?php if($credentials->authorize_environment == 'sandbox'): ?> selected <?php endif; ?>>Sandbox</option>
                                                                    <option value="live" <?php if($credentials->authorize_environment == 'live'): ?> selected <?php endif; ?>>Live</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label" ><?php echo app('translator')->get('modules.paymentSetting.authorizeStatus'); ?></label>
                                                                <div class="switchery-demo">
                                                                    <input type="checkbox" name="authorize_status" <?php if($credentials->authorize_status == 'active'): ?> checked <?php endif; ?> class="js-switch " data-color="#00c292" data-secondary-color="#f96262"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="mail_from_name"><?php echo app('translator')->get('app.webhook'); ?></label>
                                                                    <p class="text-bold"><?php echo e(route('save_authorize_webhook')); ?></p>
                                                                    <p class="text-info">(<?php echo app('translator')->get('messages.addAuthorizeWebhookUrl'); ?>
                                                                        )</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <div class="tab-pane" id="mon_commerce" role="tabpanel">
                                                        <div class="col-xs-12">
                                                            <div class="form-group">
                                                                <label><?php echo app('translator')->get('modules.paymentSetting.moncommercesitenumber'); ?></label>
                                                                <input type="password" name="moncommercesitenumber" id="moncommercesitenumber"
                                                                       class="form-control" value="<?php echo e($credentials->moncommercesitenumber); ?>">
                                                                <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12">
                                                            <div class="form-group">
                                                                <label> <?php echo app('translator')->get('modules.paymentSetting.moncommercerownumber'); ?></label>
                                                                <input type="password" name="moncommercerownumber" id="moncommercerownumber"
                                                                       class="form-control" value="<?php echo e($credentials->moncommercerownumber); ?>">
                                                                <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label><?php echo app('translator')->get('modules.paymentSetting.moncommercehmackey'); ?></label>
                                                                <input type="password" name="moncommercehmackey" id="moncommercehmackey"
                                                                       class="form-control" value="<?php echo e($credentials->moncommercehmackey); ?>">
                                                                <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label><?php echo app('translator')->get('modules.paymentSetting.moncommercesiteidentifier'); ?></label>
                                                                <input type="password" name="moncommercesiteidentifier" id="moncommercesiteidentifier"
                                                                       class="form-control" value="<?php echo e($credentials->moncommercesiteidentifier); ?>">
                                                                <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                            </div>



                                                            
                                                            
                                                            
                                                            
                                                            
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="form-group">
                                                                <h5>Select environment</h5>
                                                                <select class="form-control" name="moncommerce_environment" id="moncommerce_environment" data-style="form-control">
                                                                    <option value="sandbox" <?php if($credentials->moncommerce_environment == 'sandbox'): ?> selected <?php endif; ?>>Sandbox</option>
                                                                    <option value="live" <?php if($credentials->moncommerce_environment == 'live'): ?> selected <?php endif; ?>>Live</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label" ><?php echo app('translator')->get('modules.paymentSetting.moncommerceStatus'); ?></label>
                                                                <div class="switchery-demo">
                                                                    <input type="checkbox" name="mon_commerce_status" <?php if($credentials->mon_commerce_status == 'active'): ?> checked <?php endif; ?> class="js-switch " data-color="#00c292" data-secondary-color="#f96262"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                </div>

                                                <!--/row-->

                                            </div>
                                            <div class="form-actions m-t-20">
                                                <button type="submit" id="save-form" class="btn btn-success"><i class="fa fa-check"></i>
                                                    <?php echo app('translator')->get('app.save'); ?>
                                                </button>

                                            </div>
                                            <?php echo Form::close(); ?>

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
            <script src="<?php echo e(asset('plugins/bower_components/switchery/dist/switchery.min.js')); ?>"></script>
            <script>

                $('.js-switch').each(function() {
                    new Switchery($(this)[0], $(this).data());
                });

                $('#save-form').click(function () {
                    var url = '<?php echo e(route('super-admin.payment-settings.update', $credentials->id)); ?>';
                    $('#method').val('PUT');
                    $.easyAjax({
                        url: url,
                        type: "POST",
                        container: '#updateSettings',
                        data: $('#updateSettings').serialize(),
                        success: function(res) {
                            if(res.status == 'success') {
                                window.location.reload();
                            }
                        }
                    })
                });

            </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.super-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\resources\views/super-admin/payment-settings/index.blade.php ENDPATH**/ ?>