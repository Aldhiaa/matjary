<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('theme-script'); ?>
<script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-page'); ?>
    <script>
        (function () {
        var chartBarOptions = {
            series: [
                {
                    name: '<?php echo e(__("Order")); ?>',
                    data:  <?php echo json_encode($chartData['data']); ?>,

                },
            ],

            chart: {
                height: 300,
                type: 'area',
                // type: 'line',
                dropShadow: {
                    enabled: true,
                    color: '#000',
                    top: 18,
                    left: 7,
                    blur: 10,
                    opacity: 0.2
                },
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 2,
                curve: 'smooth'
            },
            title: {
                text: '',
                align: 'left'
            },
            xaxis: {
                categories:  <?php echo json_encode($chartData['label']); ?>,
                title: {
                    text: ''
                }
            },
            colors: ['#6fd944', '#6fd944'],

            grid: {
                strokeDashArray: 4,
            },
            legend: {
                show: false,
            },
            yaxis: {
                title: {
                    text: ''
                },

            }

        };
        var arChart = new ApexCharts(document.querySelector("#chart-sales"), chartBarOptions);
        arChart.render();
        })();
    </script>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xxl-7">
            <div class="row">
                <div class="col-lg-4 col-4 dashboard-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="theme-avtar bg-primary mb-3">
                                <i class="ti ti-users"></i>
                            </div>
                            <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Paid Users')); ?> : <span class="text-dark"><?php echo e($user['total_paid_user']); ?></span></p>
                            <h6 class="mb-3"><?php echo e(__('Total Users')); ?></h6>
                            <h3 class="mb-0"><?php echo e($user->total_user); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-4 dashboard-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="theme-avtar bg-info mb-3">
                                <i class="ti ti-shopping-cart-plus"></i>
                            </div>
                            <p class="text-muted text-sm mt-4 mb-2"> <?php echo e(__('Total Order Amount')); ?> : <span class="text-dark"><?php echo e(\Auth::user()->priceFormat($user['total_orders_price'])); ?></span></p>
                            <h6 class="mb-3"><?php echo e(__('Total Orders')); ?></h6>
                            <h3 class="mb-0"><?php echo e($user->total_orders); ?></h3>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-4 dashboard-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="theme-avtar bg-danger mb-3">
                                <i class="ti ti-trophy"></i>
                            </div>
                            <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Most Purchase Plan')); ?> : <span class="text-dark"><?php echo e($user['most_purchese_plan']); ?></span></p>
                            <h6 class="mb-3"><?php echo e(__('Total Plans')); ?></h6>
                            <h3 class="mb-0"><?php echo e($user->total_plan); ?></h3>
                        </div>
                    </div>   
                </div>
            </div>
        </div>

        <div class="col-xxl-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="h4 font-weight-400"><?php echo e(__('Recent Order')); ?></h4>
                    <h6 class="last-day-text">Last 7 Days</h6>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <div id="chart-sales" data-color="primary" data-height="280" class="p-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\matjar\resources\views/dashboard/super_admin.blade.php ENDPATH**/ ?>