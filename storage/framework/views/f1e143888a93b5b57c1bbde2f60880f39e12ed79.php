<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Contract')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0 "><?php echo e(__('Contract')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>

    <?php if(\Auth::guard('customer')->check()): ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('customer.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <?php else: ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <?php endif; ?>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Contract')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    
    <?php if(\Auth::user()->can('create contract')): ?>
        <div class="float-end">
            <a href="#" data-url="<?php echo e(route('contract.create')); ?>" data-bs-toggle="tooltip" data-size="lg" title="<?php echo e(__('Create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Contract')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    <?php endif; ?>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">

        <div class="col-xl-3 col-6 dashboard-card">
            <div class="card comp-card ">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-b-20"><?php echo e(__('Total Contracts')); ?></h6>
                            <h3 class="text-primary"><?php echo e($cnt_contract['total']); ?></h3>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake bg-success text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-6 dashboard-card">
            <div class="card comp-card ">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-b-20"><?php echo e(__('This Month Total Contracts')); ?></h6>
                            <h3 class="text-info"><?php echo e($cnt_contract['this_month']); ?></h3>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake bg-info text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-6 dashboard-card">
            <div class="card comp-card ">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-b-20"><?php echo e(__('This Week Total Contracts')); ?></h6>
                            <h3 class="text-warning"><?php echo e($cnt_contract['this_week']); ?></h3>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake bg-warning text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-6 dashboard-card">
            <div class="card comp-card ">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-b-20"><?php echo e(__('Last 30 Days Total Contracts')); ?></h6>
                            <h3 class="text-danger"><?php echo e($cnt_contract['last_30days']); ?></h3>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake bg-danger text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                <!-- <h5></h5> -->
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <?php if(\Auth::user()->can('view contract')): ?>
                                    <th scope="col"><?php echo e(__('#')); ?></th>
                                <?php endif; ?>
                                <th scope="col"><?php echo e(__('Subject')); ?></th>
                                <?php if(Gate::check('manage contract')): ?>
                                    <th scope="col"><?php echo e(__('Customer')); ?></th>
                                <?php endif; ?>
                                <th scope="col"><?php echo e(__('Type')); ?></th>
                                <th scope="col"><?php echo e(__('Value')); ?></th>
                                <th scope="col"><?php echo e(__('Start Date')); ?></th>
                                <th scope="col"><?php echo e(__('End Date')); ?></th>
                                <th scope="col"><?php echo e(__('Status')); ?></th>
                                
                                
                                    <th scope="col" class="text-right"><?php echo e(__('Action')); ?></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $contracts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
                            <tr class="font-style">
                            
                                <td>
                                <?php if(\Auth::user()->type =='company'): ?>
                                    <?php if(\Auth::user()->can('view contract')): ?>
                                    <a href="<?php echo e(route('contract.show',$contract->id)); ?>" class="btn btn-outline-primary" ><?php echo e(\Auth::user()->contractNumberFormat($contract->id)); ?></a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if(\Auth::user()->can('view contract')): ?>
                                    <a href="<?php echo e(route('customer.contract.show',$contract->id)); ?>" class="btn btn-outline-primary" ><?php echo e(\Auth::user()->contractNumberFormat($contract->id)); ?></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                                </td>
                            
                                <td><?php echo e($contract->subject); ?></td>
                                <?php if(Gate::check('manage contract')): ?>
                                    <td><?php echo e(!empty($contract->clients)?$contract->clients->name:''); ?></td>
                                <?php endif; ?>
                                <td><?php echo e(!empty($contract->types)?$contract->types->name:''); ?></td>
                                <td><?php echo e(\Auth::user()->priceFormat($contract->value)); ?></td>
                                <td><?php echo e(\Auth::user()->dateFormat($contract->start_date )); ?></td>
                                <td><?php echo e(\Auth::user()->dateFormat($contract->end_date )); ?></td>
                                <td>
                                    <?php if($contract->status == 'start'): ?>
                                    <span class="badge fix_badges bg-primary p-2 px-3 rounded"><?php echo e(__('Started')); ?></span>
                                    <?php else: ?>
                                    <span class="badge fix_badges bg-danger p-2 px-3 rounded"><?php echo e(__('Close')); ?></span>
                                    <?php endif; ?>
                                </td>
                                
                                
                                    <td class="action text-end">
                                    <?php if((\Auth::user()->can('duplicate contract')) && ($contract->status == 'start')): ?>
                                        <div class="action-btn bg-primary ms-2">
                                            <a href="#" class="mx-3 btn btn-sm align-items-center" data-size="lg" data-url="<?php echo e(route('contract.duplicate',$contract->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Duplicate Contract')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Duplicate')); ?>" data-original-title="<?php echo e(__('Duplicate')); ?>">
                                                <i class="ti ti-copy text-white"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                   
                                    <?php if(\Auth::user()->type =='company'): ?>
                                        <?php if(\Auth::user()->can('view contract')): ?>
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="<?php echo e(route('contract.show',$contract->id)); ?>" class="mx-3 btn btn-sm align-items-center"   data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('View')); ?>">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                            <?php if(\Auth::user()->can('view contract')): ?>
                                                <div class="action-btn bg-warning ms-2">
                                                    <a href="<?php echo e(route('customer.contract.show',$contract->id)); ?>" class="mx-3 btn btn-sm align-items-center"   data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('View')); ?>">
                                                        <i class="ti ti-eye text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                    <?php endif; ?>
                                    

                                    <?php if(\Auth::user()->can('edit contract')): ?>
                                        <div class="action-btn bg-info ms-2">
                                            <a href="#" class="mx-3 btn btn-sm align-items-center" data-size="lg" data-url="<?php echo e(route('contract.edit',$contract->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Contract')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                <i class="ti ti-edit text-white"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(\Auth::user()->can('delete contract')): ?>
                                        <div class="action-btn bg-danger ms-2">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['contract.destroy', $contract->id],'id'=>'delete-form-'.$contract->id]); ?>

                                                <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($contract->id); ?>').submit();">
                                                    <i class="ti ti-trash text-white"></i>
                                                </a>
                                            <?php echo Form::close(); ?>

                                        </div>
                                    <?php endif; ?>

                                        <!-- <div class="action-btn bg-info ms-2">
                                            <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" data-size="lg" data-url="<?php echo e(route('contract.edit',$contract->id)); ?>"
                                            data-bs-whatever="<?php echo e(__('Edit Contract')); ?>" > <span class="text-white"> <i
                                                    class="ti ti-edit" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Edit')); ?>"></i></span></a>
                                        </div> -->

                                        <!-- <div class="action-btn bg-danger ms-2">

                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['contract.destroy', $contract->id]]); ?>

                                            <a href="#!" class="mx-3 btn btn-sm d-flex align-items-center show_confirm">
                                                <i class="ti ti-trash text-white" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Delete')); ?>"></i>
                                            </a>
                                            <?php echo Form::close(); ?>

                                        </div> -->
                                    </td>
                                
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Dhiaa\matjar\resources\views/contract/index.blade.php ENDPATH**/ ?>