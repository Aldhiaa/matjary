<div class="modal-body">
    <div class="card">
        <div class="card-body table-border-style">
            <div class="table-responsive">
                <table class="table datatable">
                    <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><h6><?php echo e($plan->name); ?> (<?php echo e((env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$'); ?><?php echo e($plan->price); ?>) <?php echo e(' / '. $plan->duration); ?></h6></td>
                            <td><?php echo e(__('Users')); ?> : <?php echo e($plan->max_users); ?></td>
                            <td><?php echo e(__('Customers')); ?> : <?php echo e($plan->max_customers); ?></td>
                            <td><?php echo e(__('Vendors')); ?> : <?php echo e($plan->max_venders); ?></td>
                            <td>
                                <?php if($user->plan==$plan->id): ?>
                                    <span class="btn btn-primary btn-sm rounded-pill my-auto w-100"><i class="fas fa-check text-white"></i></span>
                                <?php else: ?>
                                    <a href="<?php echo e(route('plan.active',[$user->id,$plan->id])); ?>" class="btn btn-primary btn-sm rounded-pill my-auto w-100" title="<?php echo e(__('Click to Upgrade Plan')); ?>"><i class="fas fa-cart-plus"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\matjar\resources\views/user/plan.blade.php ENDPATH**/ ?>