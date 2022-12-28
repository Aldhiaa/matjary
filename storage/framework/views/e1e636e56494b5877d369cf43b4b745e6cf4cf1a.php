<?php
    $profile=asset(Storage::url('uploads/avatar/'));
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage User')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('User')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" data-size="lg" data-url="<?php echo e(route('users.create')); ?>" data-ajax-popup="true"  data-bs-toggle="tooltip" title="<?php echo e(__('Create New User')); ?>"  class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xxl-12">
            <div class="row">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-header border-0 pb-0">
                                <div class="d-flex align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Last Login')); ?>">
                                    <?php echo e((!empty($user->last_login_at)) ? $user->last_login_at : ''); ?>

                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">
                                        <div class="badge p-2 px-3 rounded bg-primary"><?php echo e($user->type); ?></div>
                                    </h6>
                                </div>
                                <?php if(Gate::check('edit user') || Gate::check('delete user')): ?>
                                    <div class="card-header-right">
                                        <div class="btn-group card-option">
                                        <?php if($user->is_active==1): ?>
                                            <button type="button" class="btn dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>

                                            <div class="dropdown-menu dropdown-menu-end">

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit user')): ?>
                                                        <a href="#!" data-size="lg" data-url="<?php echo e(route('users.edit',$user->id)); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Edit User')); ?>">
                                                            <i class="ti ti-edit"></i>
                                                            <span><?php echo e(__('Edit')); ?></span>
                                                        </a>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete user')): ?>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user['id']],'id'=>'delete-form-'.$user['id']]); ?>

                                                    <a href="#!"  class="dropdown-item bs-pass-para">
                                                        <i class="ti ti-archive"></i>
                                                        <span> <?php if($user->delete_status!=0): ?><?php echo e(__('Delete')); ?> <?php else: ?> <?php echo e(__('Restore')); ?><?php endif; ?></span>
                                                    </a>

                                                    <?php echo Form::close(); ?>

                                                <?php endif; ?>

                                                <a href="#!" data-url="<?php echo e(route('users.reset',\Crypt::encrypt($user->id))); ?>" data-ajax-popup="true" data-size="md" class="dropdown-item" data-bs-original-title="<?php echo e(__('Reset Password')); ?>">
                                                    <i class="ti ti-adjustments"></i>
                                                    <span>  <?php echo e(__('Reset Password')); ?></span>
                                                </a>
                                            </div>
                                            <?php else: ?>
                                                <a href="#" class="action-item"><i class="ti ti-lock"></i></a>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <div class="avatar me-3">
                                    <img src="<?php echo e((!empty($user->avatar))? asset(Storage::url("uploads/avatar/".$user->avatar)): asset(Storage::url("uploads/avatar/avatar.png"))); ?>" alt="kal" class="img-user wid-80 rounded-circle">
                                </div>
                                <h4 class=" mt-2"><?php echo e($user->name); ?></h4>
                                    <?php if($user->delete_status==0): ?>
                                        <h5 class="office-time mb-0"><?php echo e(__('Soft Deleted')); ?></h5>
                                    <?php endif; ?>
                                <small><?php echo e($user->email); ?></small>

                                <p></p>
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="d-grid">
                                            <?php echo e(ucfirst($user->type)); ?>

                                        </div>
                                    </div>
                                </div>
                                <?php if(\Auth::user()->type == 'super admin'): ?>
                                    <div class="mt-4">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-6 text-center">
                                                <span class="d-block font-bold mb-0"><?php echo e(!empty($user->currentPlan)?$user->currentPlan->name:''); ?></span>
                                            </div>
                                            <div class="col-6 text-center Id mb-2 ">
                                                <a href="#" data-url="<?php echo e(route('plan.upgrade',$user->id)); ?>" data-size="lg" data-ajax-popup="true" class="btn small--btn btn-outline-primary text-sm" data-title="<?php echo e(__('Upgrade Plan')); ?>"><?php echo e(__('Upgrade Plan')); ?></a>
                                            </div>
                                           
                                            <div class="col-12">
                                                <hr class="my-3">
                                            </div>
                                            <div class="col-12 text-center pb-2">
                                                <span class="text-dark text-xs"><?php echo e(__('Plan Expired : ')); ?> <?php echo e(!empty($user->plan_expire_date) ? \Auth::user()->dateFormat($user->plan_expire_date): __('Unlimited')); ?></span>
                                            </div>
                                            <div class="col-4 text-center">
                                                <span class="d-block text-sm font-bold mb-0"><?php echo e($user->totalCompanyUser($user->id)); ?></span>
                                                <span class="d-block text-sm text-muted"><?php echo e(__('Users')); ?></span>
                                            </div>
                                            <div class="col-4 text-center">
                                                <span class="d-block text-sm font-weight-bold mb-0"><?php echo e($user->totalCompanyCustomer($user->id)); ?></span>
                                                <span class="d-block text-sm text-muted"><?php echo e(__('Customers')); ?></span>
                                            </div>
                                            <div class="col-4 text-center">
                                                <span class="d-block text-sm font-weight-bold mb-0"><?php echo e($user->totalCompanyVender($user->id)); ?></span>
                                                <span class="d-block text-sm text-muted"><?php echo e(__('Vendors')); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>



                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <div class="col-md-3">
                    <a href="#" class="btn-addnew-project"  data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create New User')); ?>" data-url="<?php echo e(route('users.create')); ?>">
                        <div class="bg-primary proj-add-icon">
                            <i class="ti ti-plus"></i>
                        </div>
                        <h6 class="mt-4 mb-2"><?php echo e(__('New User')); ?></h6>
                        <p class="text-muted text-center"><?php echo e(__('Click here to add New User')); ?></p>
                    </a>
                </div>
                
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\matjar\resources\views/user/index.blade.php ENDPATH**/ ?>