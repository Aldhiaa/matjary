<?php
    $dir = asset(Storage::url('uploads/plan'));
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Plan')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Plan')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create plan')): ?>
            <?php if(isset($admin_payment_setting) && !empty($admin_payment_setting)): ?>
                <?php if($admin_payment_setting['is_stripe_enabled'] == 'on' || $admin_payment_setting['is_paypal_enabled'] == 'on' || $admin_payment_setting['is_paystack_enabled'] == 'on' || $admin_payment_setting['is_flutterwave_enabled'] == 'on'|| $admin_payment_setting['is_razorpay_enabled'] == 'on' || $admin_payment_setting['is_mercado_enabled'] == 'on'|| $admin_payment_setting['is_paytm_enabled'] == 'on'  || $admin_payment_setting['is_mollie_enabled'] == 'on'||
                $admin_payment_setting['is_skrill_enabled'] == 'on' || $admin_payment_setting['is_coingate_enabled'] == 'on' || $admin_payment_setting['is_paymentwall_enabled'] == 'on'): ?>
                        <a href="#" data-url="<?php echo e(route('plans.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"  data-title="<?php echo e(__('Create New Plan')); ?>" class="btn btn-sm btn-primary">
                            <i class="ti ti-plus"></i>
                        </a>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6">
                <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s" style="
                   visibility: visible;
                   animation-delay: 0.2s;
                   animation-name: fadeInUp;
                   ">
                    <div class="card-body">
                        <span class="price-badge bg-primary"><?php echo e($plan->name); ?></span>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit plan')): ?>
                        <div class="d-flex flex-row-reverse m-0 p-0">
                            <div class="action-btn bg-primary ms-2">
                                <a title="<?php echo e(__('Edit Plan')); ?>" href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="<?php echo e(route('plans.edit',$plan->id)); ?>" data-ajax-popup="true" data-bs-title="<?php echo e(__('Edit Plan')); ?>" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                    <i class="ti ti-edit text-white"></i>
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(\Auth::user()->type == 'company' && \Auth::user()->plan == $plan->id): ?>
                                        <div class="d-flex flex-row-reverse m-0 p-0 ">
                                            <span class="d-flex align-items-center ">
                                                <i class="f-10 lh-1 fas fa-circle text-success"></i>
                                                <span class="ms-2"><?php echo e(__('Active')); ?></span>
                                            </span>
                                        </div>
                                    <?php endif; ?>

                        <h1 class="mb-3 f-w-600 "><?php echo e((env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$')); ?><?php echo e(number_format($plan->price)); ?><small class="text-sm">/<?php echo e(__('Month')); ?></small></h1>
                        <p class="mb-0">
                            <?php echo e(__('Duration : ').__($plan->duration)); ?><br />
                        </p>

                        <ul class="list-unstyled my-4">
                            <li> <span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span><?php echo e(($plan->max_users==-1)?__('Unlimited'):$plan->max_users); ?> <?php echo e(__('Users')); ?></li>
                            <li><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span><?php echo e(($plan->max_customers==-1)?__('Unlimited'):$plan->max_customers); ?> <?php echo e(__('Customers')); ?></li>
                            <li><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span><?php echo e(($plan->max_venders==-1)?__('Unlimited'):$plan->max_venders); ?> <?php echo e(__('Vendors')); ?></li>
                        </ul>
                        <br>

                        <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit plan')): ?>
                            <div class="col-4">
                                <a title="<?php echo e(__('Edit Plan')); ?>" href="#" class="btn btn-primary btn-icon m-1" data-url="<?php echo e(route('plans.edit',$plan->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Plan')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                    <i class="ti ti-edit"></i>
                                </a>
                            </div>
                        <?php endif; ?> -->

                        <?php if(isset($admin_payment_setting) && !empty($admin_payment_setting)): ?>
                            <?php if($admin_payment_setting['is_stripe_enabled'] == 'on' || $admin_payment_setting['is_paypal_enabled'] == 'on' || $admin_payment_setting['is_paystack_enabled'] == 'on' || $admin_payment_setting['is_flutterwave_enabled'] == 'on'|| $admin_payment_setting['is_razorpay_enabled'] == 'on' || $admin_payment_setting['is_mercado_enabled'] == 'on'|| $admin_payment_setting['is_paytm_enabled'] == 'on'  || $admin_payment_setting['is_mollie_enabled'] == 'on'||
                            $admin_payment_setting['is_skrill_enabled'] == 'on' || $admin_payment_setting['is_coingate_enabled'] == 'on' ||$admin_payment_setting['is_paymentwall_enabled'] == 'on'): ?>


                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('buy plan')): ?>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-8">
                                            <div class="d-grid text-center">
                                                <?php if($plan->id != \Auth::user()->plan): ?>
                                                    <?php if($plan->price > 0): ?>
                                                        <a href="<?php echo e(route('stripe',\Illuminate\Support\Facades\Crypt::encrypt($plan->id))); ?>" data-bs-toggle="tooltip" class="btn btn-primary btn-icon btn-sm"  data-bs-placement="top" title="" data-bs-original-title="Subscribe"><?php echo e(__('Subscribe')); ?> <i class="fas fa-arrow-right m-1"></i>
                                                        </a>
                                                    <?php else: ?>

                                                    <span class="mb-2"><?php echo e(__('Free Plan')); ?></span>
                                                        
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                        <?php if($plan->id != 1 && $plan->id != \Auth::user()->plan): ?>
                                        <div class="col-3">
                                                <?php if(\Auth::user()->requested_plan != $plan->id): ?>
                                                    <a href="<?php echo e(route('send.request',[\Illuminate\Support\Facades\Crypt::encrypt($plan->id)])); ?>" class="btn btn-primary btn-icon btn-sm" data-title="Cancle Request" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Cancle Request">
                                                        <span class="btn-inner--icon"><i class="fas fa-share"></i></span>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(route('request.cancel',\Auth::user()->id)); ?>" class="btn btn-danger btn-icon btn-sm" data-title="Cancle Request" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Cancle Request">
                                                        <span class="btn-inner--icon"><i class="fas fa-times"></i></span>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                            <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                            <?php endif; ?>
                        <?php endif; ?>


                        
                        <?php
                            $plan_expire_date = \Auth::user()->plan_expire_date;
                        ?>

                        <?php if(\Auth::user()->type == 'company' && \Auth::user()->plan == $plan->id): ?>
                            <p class="mb-0">
                                <?php echo e(__('Plan Expired : ')); ?>

                                <?php echo e(!empty($plan_expire_date) ? \Auth::user()->dateFormat($plan_expire_date) : 'Unlimited'); ?>

                            </p>
                        <?php endif; ?>
                  </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create plan')): ?>
            <div class="col-md-3">
                <a href="#" class="btn-addnew-project"  data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create New Plan')); ?>" data-url="<?php echo e(route('plans.create')); ?>">
                    <div class="bg-primary proj-add-icon">
                        <i class="ti ti-plus"></i>
                    </div>
                    <h6 class="mt-4 mb-2"><?php echo e(__('New Plan')); ?></h6>
                    <p class="text-muted text-center"><?php echo e(__('Click here to add New Plan')); ?></p>
                </a>
            </div>
        <?php endif; ?> -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\matjar\resources\views/plan/index.blade.php ENDPATH**/ ?>