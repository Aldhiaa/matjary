<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Retainers')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php if(\Auth::guard('customer')->check()): ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('customer.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <?php else: ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <?php endif; ?>
    <li class="breadcrumb-item"><?php echo e(__('Retainers')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <!-- <a class="btn btn-sm btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" data-bs-toggle="tooltip" title="<?php echo e(__('Filter')); ?>">
            <i class="ti ti-filter"></i>
        </a> -->
        <a href="<?php echo e(route('retainer.export')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>">
            <i class="ti ti-file-export"></i>
        </a>

        <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create proposal')): ?> -->
            <a href="<?php echo e(route('retainer.create',0)); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>">
                <i class="ti ti-plus"></i>
            </a>
        <!-- <?php endif; ?> -->
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-sm-12">
            <div class=" multi-collapse mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php if(!\Auth::guard('customer')->check()): ?>
                            <?php echo e(Form::open(array('route' => array('retainer.index'),'method' => 'GET','id'=>'frm_submit'))); ?>

                        <?php else: ?>
                            <?php echo e(Form::open(array('route' => array('customer.retainer'),'method' => 'GET','id'=>'frm_submit'))); ?>

                        <?php endif; ?>
                        <div class="d-flex align-items-center justify-content-end">
                            <?php if(!\Auth::guard('customer')->check()): ?>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mr-2">
                                    <div class="btn-box">
                                        <?php echo e(Form::label('customer', __('Customer'),['class'=>'text-type'])); ?>

                                        <?php echo e(Form::select('customer',$customer,isset($_GET['customer'])?$_GET['customer']:'', array('class' => 'form-control select'))); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mr-2">
                                <div class="btn-box">
                                    <?php echo e(Form::label('issue_date', __('Date'),['class'=>'text-type'])); ?>

                                    <?php echo e(Form::text('issue_date', isset($_GET['issue_date'])?$_GET['issue_date']:null, array('class' => 'form-control month-btn','id'=>'pc-daterangepicker-1','placeholder'=>"Select Date"))); ?>

                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="btn-box">
                                    <?php echo e(Form::label('status', __('Status'),['class'=>'text-type'])); ?>

                                    <?php echo e(Form::select('status', [''=>'Select Status']+$status,isset($_GET['status'])?$_GET['status']:'', array('class' => 'form-control select2'))); ?>

                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">

                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('apply')); ?>" onclick="document.getElementById('frm_submit').submit(); return false;" >
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <?php if(\Auth::user()->type == 'company'): ?>
                                <a href="<?php echo e(route('retainer.index')); ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="<?php echo e(__('Reset')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-refresh text-white-off "></i></span>
                                </a>
                                <?php else: ?>
                                <a href="<?php echo e(route('customer.retainer')); ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="<?php echo e(__('Reset')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-refresh text-white-off "></i></span>
                                </a>
                                <?php endif; ?>
                            </div>

                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Retainer')); ?></th>
                                <?php if(!\Auth::guard('customer')->check()): ?>
                                    <th> <?php echo e(__('Customer')); ?></th>
                                <?php endif; ?>
                                <th> <?php echo e(__('Category')); ?></th>
                                <th> <?php echo e(__('Issue Date')); ?></th>
                                <th> <?php echo e(__('Status')); ?></th>
                                <?php if(Gate::check('edit proposal') || Gate::check('delete proposal') || Gate::check('show proposal')): ?>
                                    <th width="10%"> <?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $retainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $retainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <td class="Id">
                                        <?php if(\Auth::guard('customer')->check()): ?>
                                            <a href="<?php echo e(route('customer.retainer.show',\Crypt::encrypt($retainer->id))); ?>" class="btn btn-outline-primary"><?php echo e(AUth::user()->retainerNumberFormat($retainer->retainer_id)); ?>

                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('retainer.show',\Crypt::encrypt($retainer->id))); ?>" class="btn btn-outline-primary"><?php echo e(AUth::user()->retainerNumberFormat($retainer->retainer_id)); ?>

                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(!\Auth::guard('customer')->check()): ?>
                                        <td> <?php echo e(!empty($retainer->customer)? $retainer->customer->name:''); ?> </td>
                                    <?php endif; ?>
                                    <td><?php echo e(!empty($retainer->category)?$retainer->category->name:''); ?></td>
                                    <td><?php echo e(Auth::user()->dateFormat($retainer->issue_date)); ?></td>
                                    <td>
                                        <?php if($retainer->status == 0): ?>
                                            <span class="badge fix_badges bg-primary p-2 px-3 rounded"><?php echo e(__(\App\Models\retainer::$statues[$retainer->status])); ?></span>
                                        <?php elseif($retainer->status == 1): ?>
                                            <span class="badge fix_badges bg-info p-2 px-3 rounded"><?php echo e(__(\App\Models\retainer::$statues[$retainer->status])); ?></span>
                                        <?php elseif($retainer->status == 2): ?>
                                            <span class="badge fix_badges bg-secondary p-2 px-3 rounded"><?php echo e(__(\App\Models\retainer::$statues[$retainer->status])); ?></span>
                                        <?php elseif($retainer->status == 3): ?>
                                            <span class="badge fix_badges bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\retainer::$statues[$retainer->status])); ?></span>
                                        <?php elseif($retainer->status == 4): ?>
                                            <span class="badge fix_badges bg-danger p-2 px-3 rounded"><?php echo e(__(\App\Models\retainer::$statues[$retainer->status])); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(Gate::check('edit proposal') || Gate::check('delete proposal') || Gate::check('show proposal')): ?>
                                        <td class="Action">
                                            <?php if($retainer->is_convert==0): ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('convert invoice')): ?>
                                                    <div class="action-btn bg-success ms-2">
                                                        <?php echo Form::open(['method' => 'get', 'route' => ['retainer.convert', $retainer->id],'id'=>'proposal-form-'.$retainer->id]); ?>


                                                        <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Convert into  Invoice')); ?>" data-original-title="<?php echo e(__('Convert to Invoice')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('You want to confirm convert to invoice. Press Yes to continue or Cancel to go back')); ?>" data-confirm-yes="document.getElementById('proposal-form-<?php echo e($retainer->id); ?>').submit();">
                                                            <i class="ti ti-exchange text-white"></i>
                                                            <?php echo Form::close(); ?>

                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('convert invoice')): ?>
                                                    <div class="action-btn bg-success ms-2">
                                                        <a href="<?php echo e(route('invoice.show',\Crypt::encrypt($retainer->converted_invoice_id))); ?>" class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Already convert to Invoice')); ?>" data-original-title="<?php echo e(__('Already convert to Invoice')); ?>" data-original-title="<?php echo e(__('Delete')); ?>">
                                                            <i class="ti ti-eye text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('duplicate proposal')): ?>
                                                <div class="action-btn bg-secondary ms-2">
                                                    <?php echo Form::open(['method' => 'get', 'route' => ['retainer.duplicate', $retainer->id],'id'=>'duplicate-form-'.$retainer->id]); ?>


                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Duplicate')); ?>" data-original-title="<?php echo e(__('Duplicate')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('You want to confirm duplicate this invoice. Press Yes to continue or Cancel to go back')); ?>" data-confirm-yes="document.getElementById('duplicate-form-<?php echo e($retainer->id); ?>').submit();">
                                                        <i class="ti ti-copy text-white text-white"></i>
                                                        <?php echo Form::close(); ?>

                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show proposal')): ?>
                                                <?php if(\Auth::guard('customer')->check()): ?>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="<?php echo e(route('customer.retainer.show',\Crypt::encrypt($retainer->id))); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Show')); ?>" data-original-title="<?php echo e(__('Detail')); ?>">
                                                            <i class="ti ti-eye text-white text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="<?php echo e(route('retainer.show',\Crypt::encrypt($retainer->id))); ?>" class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Show')); ?>" data-original-title="<?php echo e(__('Detail')); ?>">
                                                            <i class="ti ti-eye text-white text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit proposal')): ?>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="<?php echo e(route('retainer.edit',\Crypt::encrypt($retainer->id))); ?>" class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                        <i class="ti ti-edit text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete proposal')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['retainer.destroy', $retainer->id],'id'=>'delete-form-'.$retainer->id]); ?>


                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($retainer->id); ?>').submit();">
                                                        <i class="ti ti-trash text-white text-white"></i>
                                                    </a>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\matjar\resources\views/retainer/index.blade.php ENDPATH**/ ?>