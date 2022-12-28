<?php
    $logo=asset(Storage::url('uploads/logo/'));
    $company_favicon=Utility::getValByName('company_favicon');
    $SITE_RTL = env('SITE_RTL');

    $setting = \App\Models\Utility::getLayoutsSetting();
        $color = 'theme-3';
        if (!empty($setting['color'])) {
            $color = $setting['color'];
        }

        $SITE_RTL = 'theme-3';
        if (!empty($setting['SITE_RTL'])) {
            $SITE_RTL = $setting['SITE_RTL'];
        }

    $mode_setting = \App\Models\Utility::mode_layout();
    
?>


<!DOCTYPE html>

<html lang="en" dir="<?php echo e($SITE_RTL == 'on'?'rtl':''); ?>">
<head>
    <title><?php echo e((Utility::getValByName('title_text')) ? Utility::getValByName('title_text') : config('app.name', 'AccountGo SaaS')); ?> - <?php echo $__env->yieldContent('page-title'); ?></title>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <!-- Meta -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="url" content="<?php echo e(url('').'/'.config('chatify.path')); ?>" data-user="<?php echo e(Auth::user()->id); ?>">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    
    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo e($logo.'/'.(isset($company_favicon) && !empty($company_favicon)?$company_favicon:'favicon.png')); ?>" type="image" sizes="16x16">

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/animate.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/datepicker-bs5.min.css')); ?>">

    <!--bootstrap switch-->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/bootstrap-switch-button.min.css')); ?>">


    <!-- font css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/main.css')); ?>">
    <!-- vendor css -->

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/flatpickr.min.css')); ?>">

        


        <?php if($SITE_RTL == 'on'): ?>
            
            <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>">
        <?php endif; ?>
        <?php if($setting['cust_darklayout'] == 'on'): ?>
            <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-dark.css')); ?>">
        <?php else: ?>
            <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
        <?php endif; ?>


        <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dropzone.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/customizer.css')); ?>">
    

    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>" id="main-style-link">
    <?php echo $__env->yieldPushContent('css-page'); ?>

    <style>
        [dir="rtl"] .dash-sidebar {
            left: auto !important;
        }
        [dir="rtl"] .dash-header {
            left: 0;
            right: 280px;
        }
        [dir="rtl"] .dash-header:not(.transprent-bg) .header-wrapper {
            padding: 0 0 0 30px;
        }
        [dir="rtl"] .dash-header:not(.transprent-bg):not(.dash-mob-header) ~ .dash-container {
            margin-left: 0px !important;
        }
        [dir="rtl"] .me-auto.dash-mob-drp {
            margin-right: 10px !important;
        }
        [dir="rtl"] .me-auto {
            margin-left: 10px !important;
        }

    </style>
</head>
<body class="<?php echo e($color); ?>">
<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>

<?php echo $__env->make('partials.admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- [ navigation menu ] end -->
<!-- [ Header ] start -->
<?php echo $__env->make('partials.admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Modal -->
<div class="modal notification-modal fade"
     id="notification-modal"
     tabindex="-1"
     role="dialog"
     aria-hidden="true">
     
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button
                    type="button"
                    class="btn-close float-end"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
                <h6 class="mt-2">
                    <i data-feather="monitor" class="me-2"></i>Desktop settings
                </h6>
                <hr/>
                <div class="form-check form-switch">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        id="pcsetting1"
                        checked
                    />
                    <label class="form-check-label f-w-600 pl-1" for="pcsetting1"
                    >Allow desktop notification</label
                    >
                </div>
                <p class="text-muted ms-5">
                    you get lettest content at a time when data will updated
                </p>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="pcsetting2"/>
                    <label class="form-check-label f-w-600 pl-1" for="pcsetting2"
                    >Store Cookie</label
                    >
                </div>
                <h6 class="mb-0 mt-5">
                    <i data-feather="save" class="me-2"></i>Application settings
                </h6>
                <hr/>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="pcsetting3"/>
                    <label class="form-check-label f-w-600 pl-1" for="pcsetting3"
                    >Backup Storage</label
                    >
                </div>
                <p class="text-muted mb-4 ms-5">
                    Automaticaly take backup as par schedule
                </p>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="pcsetting4"/>
                    <label class="form-check-label f-w-600 pl-1" for="pcsetting4"
                    >Allow guest to print file</label
                    >
                </div>
                <h6 class="mb-0 mt-5">
                    <i data-feather="cpu" class="me-2"></i>System settings
                </h6>
                <hr/>
                <div class="form-check form-switch">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        id="pcsetting5"
                        checked
                    />
                    <label class="form-check-label f-w-600 pl-1" for="pcsetting5"
                    >View other user chat</label
                    >
                </div>
                <p class="text-muted ms-5">Allow to show public user message</p>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-light-danger btn-sm"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>
                <button type="button" class="btn btn-light-primary btn-sm">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>
<!-- [ Header ] end -->


<!-- [ Main Content ] start -->
<div class="dash-container">
    <div class="dash-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="page-header-title">
                            <h4 class="m-b-10"><?php echo $__env->yieldContent('page-title'); ?></h4>
                        </div>
                        <ul class="breadcrumb">
                            <?php echo $__env->yieldContent('breadcrumb'); ?>
                        </ul>
                    </div>
                    <div class="col">
                        <?php echo $__env->yieldContent('action-btn'); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php echo $__env->yieldContent('content'); ?>
    <!-- [ Main Content ] end -->
    </div>
</div>
<div class="modal fade" id="commonModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body">
            </div>
        </div>
    </div>
</div>


<div class="position-fixed top-0 end-0 p-3" style="z-index: 99999">
    <div id="liveToast" class="toast text-white  fade" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
<?php echo $__env->make('partials.admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>

<?php /**PATH D:\Dhiaa\matjar\resources\views/layouts/admin.blade.php ENDPATH**/ ?>