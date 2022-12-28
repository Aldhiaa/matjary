<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Balance Sheet')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Balance Sheet')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script>
        var filename = $('#filename').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {type: 'jpeg', quality: 1},
                html2canvas: {scale: 4, dpi: 72, letterRendering: true},
                jsPDF: {unit: 'in', format: 'A2'}
            };
            html2pdf().set(opt).from(element).save();
        }

    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <!-- <a class="btn btn-sm btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" data-bs-toggle="tooltip" title="<?php echo e(__('Filter')); ?>">
            <i class="ti ti-filter"></i>
        </a> -->

        <a href="#" class="btn btn-sm btn-primary" onclick="saveAsPDF()"data-bs-toggle="tooltip" title="<?php echo e(__('Download')); ?>" data-original-title="<?php echo e(__('Download')); ?>">
            <span class="btn-inner--icon"><i class="ti ti-download"></i></span>
        </a>

    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class=" multi-collapse mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(array('route' => array('report.balance.sheet'),'method' => 'GET','id'=>'report_bill_summary'))); ?>

                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">

                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                        </div>
                                    </div>



                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('start_date', __('Start Date'),['class'=>'text-type'])); ?>

                                            <?php echo e(Form::date('start_date',$filter['startDateRange'], array('class' => 'month-btn form-control'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('end_date', __('End Date'),['class'=>'text-type'])); ?>

                                            <?php echo e(Form::date('end_date',$filter['endDateRange'], array('class' => 'month-btn form-control'))); ?>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-auto mt-3">

                                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('report_bill_summary').submit(); return false;" data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>" data-original-title="<?php echo e(__('apply')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>

                                        <a href="<?php echo e(route('report.balance.sheet')); ?>" class="btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="<?php echo e(__('Reset')); ?>" data-original-title="<?php echo e(__('Reset')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-refresh text-white-off "></i></span>
                                        </a>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>

    <div id="printableArea">
        <div class="row mt-4">
            <div class="col">
                <input type="hidden" value="<?php echo e(__('Balance Sheet').' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange']); ?>" id="filename">
                <div class="card p-4 mb-4">
                    <h7 class="report-text gray-text mb-0"><?php echo e(__('Report')); ?> :</h7>
                    <h6 class="report-text mb-0"><?php echo e(__('Balance Sheet')); ?></h6>
                </div>
            </div>

            <div class="col">
                <div class="card p-4 mb-4">
                    <h7 class="report-text gray-text mb-0"><?php echo e(__('Duration')); ?> :</h7>
                    <h6 class="report-text mb-0"><?php echo e($filter['startDateRange'].' to '.$filter['endDateRange']); ?></h6>
                </div>
            </div>
        </div>

        <div class="row">
            <?php $__currentLoopData = $chartAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $accounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $totalNetAmount=0; ?>

                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accountData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $accountData['account']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $totalNetAmount+=$account['netAmount']; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h7 class="report-text gray-text mb-0"><?php echo e(__('Total'.' '.$type)); ?></h7>
                        <h6 class="report-text mb-0">
                            <?php if($totalNetAmount<0): ?>
                                <?php echo e(__('Dr').'. '.\Auth::user()->priceFormat(abs($totalNetAmount))); ?>

                            <?php elseif($totalNetAmount>0): ?>
                                <?php echo e(__('Cr').'. '.\Auth::user()->priceFormat($totalNetAmount)); ?>

                            <?php else: ?>
                                <?php echo e(\Auth::user()->priceFormat(0)); ?>

                            <?php endif; ?>
                        </h6>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="row mb-4">
            <?php $__currentLoopData = $chartAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $accounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-12 mb-4">
                    <h5 class="text-muted"><?php echo e($type); ?></h5>
                    <div class="row">
                        <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="col-lg-4 col-md-4 mb-4">
                                <div class="card">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th colspan="2" width="80%"><h6> <?php echo e($account['subType']); ?></h6></th>
                                        </tr>
                                        <tr>
                                            <th width="80%"> <?php echo e(__('Account')); ?></th>
                                            <th> <?php echo e(__('Amount')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody class="balance-sheet-body">
                                        <?php $totalCredit=0;$totalDebit=0;?>
                                        <?php $__currentLoopData = $account['account']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $totalCredit+=$record['totalCredit'];
                                                $totalDebit+=$record['totalDebit'];
                                            ?>
                                            <tr>
                                                <td><?php echo e($record['account_name']); ?></td>
                                                <td>
                                                    <?php if($record['netAmount']<0): ?>
                                                        <?php echo e(__('Dr').'. '.\Auth::user()->priceFormat(abs($record['netAmount']))); ?>

                                                    <?php elseif($record['netAmount']>0): ?>
                                                        <?php echo e(__('Cr').'. '.\Auth::user()->priceFormat($record['netAmount'])); ?>

                                                    <?php else: ?>
                                                        <?php echo e(\Auth::user()->priceFormat(0)); ?>

                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </tbody>
                                        <thead>
                                        <tr>
                                            <th><?php echo e(__('Total').' '.$account['subType']); ?></th>
                                            <th>
                                                <?php $total= $totalCredit-$totalDebit; ?>
                                                <?php if($total<0): ?>
                                                    <?php echo e(__('Dr').'. '.\Auth::user()->priceFormat(abs($total))); ?>

                                                <?php elseif($total>0): ?>
                                                    <?php echo e(__('Cr').'. '.\Auth::user()->priceFormat($total)); ?>

                                                <?php else: ?>
                                                    <?php echo e(\Auth::user()->priceFormat(0)); ?>

                                                <?php endif; ?>
                                            </th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Dhiaa\matjar\resources\views/report/balance_sheet.blade.php ENDPATH**/ ?>