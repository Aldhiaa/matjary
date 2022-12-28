<?php $__env->startPush('css-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Language')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0">   <?php echo e(__('Language')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Language')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">

        <a href="#" data-url="<?php echo e(route('create.language')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"  data-ajax-popup="true" data-title="<?php echo e(__('Create New Language')); ?>">
            <i class="ti ti-plus text-white"></i>
        </a>

    <?php if($currantLang != (!empty(env('default_language')) ? env('default_language') : 'en')): ?>
        <div class="action-btn bg-danger ms-2">
            <?php echo Form::open(['method' => 'DELETE', 'route' => ['lang.destroy', $currantLang]]); ?>

            <a href="#!" class="btn btn-sm btn-danger btn-icon bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>">
                <i class="ti ti-trash text-white"></i>
            </a>
            <?php echo Form::close(); ?>

        </div>
    <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-3 col-md-3">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills flex-column " id="myTab4" role="tablist">
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('manage.language',[$lang])); ?>" class="nav-link <?php echo e(($currantLang == $lang)?'active':''); ?>"><?php echo e(Str::upper($lang)); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-md-9">
            <div class="p-3 card">
                <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-user-tab-1" data-bs-toggle="pill"
                                data-bs-target="#pills-user-1" type="button"><?php echo e(__('Labels')); ?></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-user-tab-2" data-bs-toggle="pill"
                                data-bs-target="#pills-user-2" type="button"><?php echo e(__('Messages')); ?></button>
                    </li>

                </ul>
            </div>
            <div class="card card-fluid">
                <div class="card-body" style="position: relative;">
                    <div class="tab-content no-padding" id="myTab2Content">
                        <div class="tab-pane fade show active" id="lang1" role="tabpanel" aria-labelledby="home-tab4">

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="pills-user-1" role="tabpanel" aria-labelledby="pills-user-tab-1">
                                    <form method="post" action="<?php echo e(route('store.language.data',[$currantLang])); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <?php $__currentLoopData = $arrLabel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="example3cols1Input"><?php echo e($label); ?> </label>
                                                        <input type="text" class="form-control" name="label[<?php echo e($label); ?>]" value="<?php echo e($value); ?>">
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-lg-12 text-right">
                                                <button class="btn btn-primary btn-create badge-blue" type="submit"><?php echo e(__('Save Changes')); ?></button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="pills-user-2" role="tabpanel" aria-labelledby="pills-user-tab-2">
                                    <form method="post" action="<?php echo e(route('store.language.data',[$currantLang])); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <?php $__currentLoopData = $arrMessage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fileName => $fileValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-lg-12">
                                                    <h5><?php echo e(ucfirst($fileName)); ?></h5>
                                                </div>
                                                <?php $__currentLoopData = $fileValue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(is_array($value)): ?>
                                                        <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label2 => $value2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(is_array($value2)): ?>
                                                                <?php $__currentLoopData = $value2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label3 => $value3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if(is_array($value3)): ?>
                                                                        <?php $__currentLoopData = $value3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label4 => $value4): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php if(is_array($value4)): ?>
                                                                                <?php $__currentLoopData = $value4; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label5 => $value5): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label><?php echo e($fileName); ?>.<?php echo e($label); ?>.<?php echo e($label2); ?>.<?php echo e($label3); ?>.<?php echo e($label4); ?>.<?php echo e($label5); ?></label>
                                                                                            <input type="text" class="form-control" name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>][<?php echo e($label2); ?>][<?php echo e($label3); ?>][<?php echo e($label4); ?>][<?php echo e($label5); ?>]" value="<?php echo e($value5); ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php else: ?>
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label><?php echo e($fileName); ?>.<?php echo e($label); ?>.<?php echo e($label2); ?>.<?php echo e($label3); ?>.<?php echo e($label4); ?></label>
                                                                                        <input type="text" class="form-control" name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>][<?php echo e($label2); ?>][<?php echo e($label3); ?>][<?php echo e($label4); ?>]" value="<?php echo e($value4); ?>">
                                                                                    </div>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php else: ?>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label><?php echo e($fileName); ?>.<?php echo e($label); ?>.<?php echo e($label2); ?>.<?php echo e($label3); ?></label>
                                                                                <input type="text" class="form-control" name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>][<?php echo e($label2); ?>][<?php echo e($label3); ?>]" value="<?php echo e($value3); ?>">
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label><?php echo e($fileName); ?>.<?php echo e($label); ?>.<?php echo e($label2); ?></label>
                                                                        <input type="text" class="form-control" name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>][<?php echo e($label2); ?>]" value="<?php echo e($value2); ?>">
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label><?php echo e($fileName); ?>.<?php echo e($label); ?></label>
                                                                <input type="text" class="form-control" name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>]" value="<?php echo e($value); ?>">
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <div class="col-lg-12 text-right">
                                            <button class="btn btn-primary btn-create badge-blue " type="submit"><?php echo e(__('Save Changes')); ?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\matjar\resources\views/lang/index.blade.php ENDPATH**/ ?>