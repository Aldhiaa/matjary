<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Invoices')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <?php if(\Auth::guard('customer')->check()): ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('customer.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <?php else: ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <?php endif; ?>
    <li class="breadcrumb-item"><?php echo e(__('Invoice')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <!-- <a class="btn btn-sm btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" data-bs-toggle="tooltip" title="<?php echo e(__('Filter')); ?>">
            <i class="ti ti-filter"></i>
        </a> -->

        <a href="<?php echo e(route('invoice.export')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>">
            <i class="ti ti-file-export"></i>
        </a>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create invoice')): ?>
            <a href="<?php echo e(route('invoice.create', 0)); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-sm-12">
            <div class=" multi-collapse mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php if(!\Auth::guard('customer')->check()): ?>
                            <?php echo e(Form::open(['route' => ['invoice.index'], 'method' => 'GET', 'id' => 'customer_submit'])); ?>

                        <?php else: ?>
                            <?php echo e(Form::open(['route' => ['customer.invoice'], 'method' => 'GET', 'id' => 'customer_submit'])); ?>

                        <?php endif; ?>
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mr-2">
                                    <div class="btn-box">
                                        <?php echo e(Form::label('issue_date', __('Date'), ['class' => 'text-type'])); ?>


                                        <?php echo e(Form::text('issue_date', isset($_GET['issue_date'])?$_GET['issue_date']:null, array('class' => 'form-control month-btn','id'=>'pc-daterangepicker-1'))); ?>


                                    </div>
                                </div>
                                <?php if(!\Auth::guard('customer')->check()): ?>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mr-2">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('customer', __('Customer'), ['class' => 'text-type'])); ?>


                                            <?php echo e(Form::select('customer', $customer, isset($_GET['customer']) ? $_GET['customer'] : '', ['class' => 'form-control select2'])); ?>

                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                    <div class="btn-box">
                                        <?php echo e(Form::label('status', __('Status'), ['class' => 'text-type'])); ?>


                                        <?php echo e(Form::select('status', ['' => 'Select Status'] + $status, isset($_GET['status']) ? $_GET['status'] : '', ['class' => 'form-control select2'])); ?>

                                    </div>
                                </div>
                                <div class="col-auto float-end ms-2 mt-4">

                                    <a href="#" class="btn btn-sm btn-primary"
                                       onclick="document.getElementById('customer_submit').submit(); return false;"
                                       data-bs-toggle="tooltip" title="<?php echo e(__('Search')); ?>" data-original-title="<?php echo e(__('apply')); ?>">
                                        <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                    </a>

                                    <?php if(!\Auth::guard('customer')->check()): ?>
                                        <a href="<?php echo e(route('invoice.index')); ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="<?php echo e(__('Reset')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-refresh text-white-off"></i></span>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('customer.invoice')); ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="<?php echo e(__('Reset')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-refresh text-white-off"></i></span>
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
                    <h5></h5>
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th> <?php echo e(__('Invoice')); ?></th>
                                    <?php if(!\Auth::guard('customer')->check()): ?>
                                        <th><?php echo e(__('Customer')); ?></th>
                                    <?php endif; ?>
                                    <th><?php echo e(__('Issue Date')); ?></th>
                                    <th><?php echo e(__('Due Date')); ?></th>
                                    <th><?php echo e(__('Due Amount')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <?php if(Gate::check('edit invoice') || Gate::check('delete invoice') || Gate::check('show invoice')): ?>
                                        <th><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                    
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="Id">
                                            <?php if(\Auth::guard('customer')->check()): ?>
                                                <a href="<?php echo e(route('customer.invoice.show', \Crypt::encrypt($invoice->id))); ?>" class="btn btn-outline-primary"><?php echo e(AUth::user()->invoiceNumberFormat($invoice->invoice_id)); ?></a>
                                            <?php else: ?>
                                                <a href="<?php echo e(route('invoice.show', \Crypt::encrypt($invoice->id))); ?>" class="btn btn-outline-primary"><?php echo e(AUth::user()->invoiceNumberFormat($invoice->invoice_id)); ?></a>
                                            <?php endif; ?>
                                        </td>
                                        <?php if(!\Auth::guard('customer')->check()): ?>
                                            <td> <?php echo e(!empty($invoice->customer) ? $invoice->customer->name : ''); ?> </td>
                                        <?php endif; ?>
                                        <td><?php echo e(Auth::user()->dateFormat($invoice->issue_date)); ?></td>
                                        <td>
                                            <?php if($invoice->due_date < date('Y-m-d')): ?>
                                                <p class="text-danger">
                                                    <?php echo e(\Auth::user()->dateFormat($invoice->due_date)); ?></p>
                                            <?php else: ?>
                                                <?php echo e(\Auth::user()->dateFormat($invoice->due_date)); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(\Auth::user()->priceFormat($invoice->getDue())); ?></td>
                                        <td>
                                            <?php if($invoice->status == 0): ?>
                                                <span
                                                    class="badge fix_badges bg-primary p-2 px-3 rounded"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                            <?php elseif($invoice->status == 1): ?>
                                                <span
                                                    class="badge fix_badges bg-info p-2 px-3 rounded"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                            <?php elseif($invoice->status == 2): ?>
                                                <span
                                                    class="badge fix_badges bg-secondary p-2 px-3 rounded"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                            <?php elseif($invoice->status == 3): ?>
                                                <span
                                                    class="badge fix_badges bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                            <?php elseif($invoice->status == 4): ?>
                                                <span
                                                    class="badge fix_badges bg-danger p-2 px-3 rounded"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <?php if(Gate::check('edit invoice') || Gate::check('delete invoice') || Gate::check('show invoice')): ?>
                                            <td class="Action">
                                                <span>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('duplicate invoice')): ?>

                                                        <div class="action-btn bg-secondary ms-2">
                                                                <?php echo Form::open(['method' => 'get', 'route' => ['invoice.duplicate', $invoice->id]]); ?>

                                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para " data-bs-toggle="tooltip" title="<?php echo e(__('Duplicate')); ?>"
                                                                       data-original-title="<?php echo e(__('Duplicate')); ?>" >
                                                                        <i class="ti ti-copy text-white"></i>
                                                                    </a>
                                                                <?php echo Form::close(); ?>

                                                            </div>













                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show invoice')): ?>
                                                        <?php if(\Auth::guard('customer')->check()): ?>
                                                                <div class="action-btn bg-warning ms-2">
                                                                    <a href="<?php echo e(route('customer.invoice.show', \Crypt::encrypt($invoice->id))); ?>"
                                                                        class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="Show "
                                                                        data-original-title="<?php echo e(__('Detail')); ?>">
                                                                        <i class="ti ti-eye text-white"></i>
                                                                    </a>
                                                                </div>
                                                        <?php else: ?>
                                                                <div class="action-btn bg-warning ms-2">
                                                                    <a href="<?php echo e(route('invoice.show', \Crypt::encrypt($invoice->id))); ?>"
                                                                        class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="Show "
                                                                        data-original-title="<?php echo e(__('Detail')); ?>">
                                                                        <i class="ti ti-eye text-white"></i>
                                                                    </a>
                                                                </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit invoice')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="<?php echo e(route('invoice.edit', \Crypt::encrypt($invoice->id))); ?>"
                                                                    class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="Edit "
                                                                    data-original-title="<?php echo e(__('Edit')); ?>">
                                                                    <i class="ti ti-edit text-white"></i>
                                                                </a>
                                                            </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete invoice')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['invoice.destroy', $invoice->id]]); ?>

                                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para " data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"
                                                                    data-original-title="<?php echo e(__('Delete')); ?>" >
                                                                        <i class="ti ti-trash text-white"></i>
                                                                    </a>
                                                                <?php echo Form::close(); ?>

                                                            </div>
                                                    <?php endif; ?>
                                                </span>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\matjar\resources\views/invoice/index.blade.php ENDPATH**/ ?>