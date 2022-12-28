<?php
    $logo=asset(Storage::url('uploads/logo/'));
    $company_logo=Utility::getValByName('company_logo');
    $settings = Utility::settings();

?>
<?php $__env->startPush('custom-scripts'); ?>
    <?php if(env('RECAPTCHA_MODULE') == 'yes'): ?>
        <?php echo NoCaptcha::renderJs(); ?>

    <?php endif; ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Login')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('auth-lang'); ?>

    <select name="language" id="language" class="btn btn-primary my-1 me-2" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
        <?php $__currentLoopData = App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option <?php if($lang == $language): ?> selected <?php endif; ?> value="<?php echo e(route('customer.login.lang',$language)); ?>"><?php echo e(Str::upper($language)); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="">
        <h2 class="mb-3 f-w-600"><?php echo e(__('Sign in')); ?></h2>
    </div>
    <?php echo e(Form::open(array('route'=>'customer.login','method'=>'post','id'=>'loginForm'))); ?>

    <?php echo csrf_field(); ?>
    <div class="">
        <div class="form-group mb-3">
            <label for="email" class="form-label"><?php echo e(__('Enter Email address')); ?></label>
            <input class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback" role="alert"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group mb-3">
            <label for="password" class="form-label"><?php echo e(__('Enter Password')); ?></label>
            <input class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password" type="password" name="password" required autocomplete="current-password">
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback" role="alert"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        </div>

        <?php if(env('RECAPTCHA_MODULE') == 'yes'): ?>
            <div class="form-group mb-3">
                <?php echo NoCaptcha::display(); ?>

                <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="small text-danger" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        <?php endif; ?>
        <div class="form-group mb-4">
            <a href="<?php echo e(route('customer.change.langPass')); ?>" class="text-xs"><?php echo e(__('Forgot Your Password?')); ?></a>

        </div>
        <div class="d-grid">
            <button type="submit" class="btn-login btn btn-primary btn-block mt-2" id="login_button"><?php echo e(__('Sign In')); ?></button>

        </div>


        <div class="row">
            <div class="col-sm-6">
                <a href="<?php echo e(route('login')); ?>" class="btn-login btn btn-primary btn-block mt-2 text-white"><?php echo e(__('User Login')); ?></a>

            </div>
            <div class="col-sm-6 text-end">
                <a href="<?php echo e(route('vender.login')); ?>" class="btn-login btn btn-primary btn-block mt-2 text-white"><?php echo e(__('Vendor Login')); ?></a>
            </div>
        </div>

    </div>
    <?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>


<script>
    $(document).ready(function () {
        $("#form_data").submit(function (e) {
            $("#login_button").attr("disabled", true);
            return true;
        });
    });
</script>






<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH J:\matjar\resources\views/auth/customer_login.blade.php ENDPATH**/ ?>