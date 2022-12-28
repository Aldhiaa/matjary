<!DOCTYPE html>
<?php
    $logo=asset(Storage::url('uploads/logo/'));
    $company_logo = \App\Models\Utility::get_superadmin_logo();

    $company_favicon=Utility::getValByName('company_favicon');
    $setting = \App\Models\Utility::colorset();
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
<html lang="en" dir="<?php echo e($SITE_RTL == 'on'?'rtl':''); ?>">
<head>
    <title><?php echo e((Utility::getValByName('title_text')) ? Utility::getValByName('title_text') : config('app.name', 'Accountgo')); ?> - <?php echo $__env->yieldContent('page-title'); ?></title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description" content="Dashboard Template Description"/>
    <meta name="keywords" content="Dashboard Template"/>
    <meta name="author" content="Rajodiya Infotech"/>

    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" type="image/x-icon"/>

    <!-- font css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>">

    <!-- vendor css -->
    
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/customizer.css')); ?>">

    <?php if($SITE_RTL == 'on'): ?>
    
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>">
<?php endif; ?>
<?php if($setting['cust_darklayout'] == 'on'): ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-dark.css')); ?>">
<?php else: ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
<?php endif; ?>

</head>

<body class=<?php echo e($color); ?>>
<div class="auth-wrapper auth-v3">
    <div class="bg-auth-side bg-primary"></div>
    <div class="auth-content">
        <nav class="navbar navbar-expand-md navbar-light default">
            <div class="container-fluid pe-2">
                <a class="navbar-brand" href="#">
                    <img src="<?php echo e($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png')); ?>"
                    alt="" class="img-fluid" />
                </a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo01"
                    aria-controls="navbarTogglerDemo01"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01" style="flex-grow: 0;">
                    
                    <ul class="navbar-nav align-items-center ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="#"><?php echo e(__('Support')); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><?php echo e(__('Terms')); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><?php echo e(__('Privacy')); ?></a>
                        </li>

                        <li class="nav-item ">
                           <?php echo $__env->yieldContent('auth-lang'); ?>
                        </li>
                    </ul>


                </div>
            </div>
        </nav>
        <div class="card">
            <div class="row align-items-center text-start">
                <div class="col-xl-6">
                    <div class="card-body">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
                <div class="col-xl-6 img-card-side">
                    <div class="auth-img-content">
                        <img
                            src="<?php echo e(asset('assets/images/auth/img-auth-3.svg')); ?>"
                            alt=""
                            class="img-fluid"
                        />
                        <h3 class="text-white mb-4 mt-5">
                            "Attention is the new currency"
                        </h3>
                        <p class="text-white">
                            The more effortless the writing looks, the more effort the
                            writer actually put into the process.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="auth-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 ">
                        <p class="">
                            <?php echo e((Utility::getValByName('footer_text')) ? Utility::getValByName('footer_text') :  __('Copyright ERPGO')); ?> <?php echo e(date('Y')); ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ auth-signup ] end -->

<!-- Required Js -->
<script src="<?php echo e(asset('assets/js/vendor-all.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/feather.min.js')); ?>"></script>
<script>
    feather.replace();
</script>
<div class="pct-customizer">
    <div class="pct-c-btn">
        <button class="btn btn-primary" id="pct-toggler">
            <i data-feather="settings"></i>
        </button>
    </div>
    <div class="pct-c-content">
        <div class="pct-header bg-primary">
            <h5 class="mb-0 text-white f-w-500">Theme Customizer</h5>
        </div>
        <div class="pct-body">
            <h6 class="mt-2">
                <i data-feather="credit-card" class="me-2"></i>Primary color settings
            </h6>
            <hr class="my-2"/>
            <div class="theme-color themes-color">
                <a href="#!" class="" data-value="theme-1"></a>
                <a href="#!" class="" data-value="theme-2"></a>
                <a href="#!" class="" data-value="theme-3"></a>
                <a href="#!" class="" data-value="theme-4"></a>
            </div>

            <h6 class="mt-4">
                <i data-feather="layout" class="me-2"></i>Sidebar settings
            </h6>
            <hr class="my-2"/>
            <div class="form-check form-switch">
                <input
                    type="checkbox"
                    class="form-check-input"
                    id="cust-theme-bg"
                    checked
                />
                <label class="form-check-label f-w-600 pl-1" for="cust-theme-bg"
                >Transparent layout</label
                >
            </div>

            <h6 class="mt-4">
                <i data-feather="sun" class="me-2"></i>Layout settings
            </h6>
            <hr class="my-2"/>
            <div class="form-check form-switch mt-2">
                <input type="checkbox" class="form-check-input" id="cust-darklayout"/>
                <label class="form-check-label f-w-600 pl-1" for="cust-darklayout"
                >Dark Layout</label
                >
            </div>
        </div>
    </div>
</div>

<script>
    feather.replace();
    var pctoggle = document.querySelector("#pct-toggler");
    if (pctoggle) {
        pctoggle.addEventListener("click", function () {
            if (
                !document.querySelector(".pct-customizer").classList.contains("active")
            ) {
                document.querySelector(".pct-customizer").classList.add("active");
            } else {
                document.querySelector(".pct-customizer").classList.remove("active");
            }
        });
    }

    var themescolors = document.querySelectorAll(".themes-color > a");
    for (var h = 0; h < themescolors.length; h++) {
        var c = themescolors[h];

        c.addEventListener("click", function (event) {
            var targetElement = event.target;
            if (targetElement.tagName == "SPAN") {
                targetElement = targetElement.parentNode;
            }
            var temp = targetElement.getAttribute("data-value");
            removeClassByPrefix(document.querySelector("body"), "theme-");
            document.querySelector("body").classList.add(temp);
        });
    }



    var custthemebg = document.querySelector("#cust-theme-bg");
    custthemebg.addEventListener("click", function () {
        if (custthemebg.checked) {
            document.querySelector(".dash-sidebar").classList.add("transprent-bg");
            document
                .querySelector(".dash-header:not(.dash-mob-header)")
                .classList.add("transprent-bg");
        } else {
            document.querySelector(".dash-sidebar").classList.remove("transprent-bg");
            document
                .querySelector(".dash-header:not(.dash-mob-header)")
                .classList.remove("transprent-bg");
        }
    });

    var custdarklayout = document.querySelector("#cust-darklayout");
    custdarklayout.addEventListener("click", function () {
        if (custdarklayout.checked) {
            document
                .querySelector(".m-header > .b-brand > .logo-lg")
                .setAttribute("src", "<?php echo e(asset('assets/images/logo.svg')); ?>");
            document
                .querySelector("#main-style-link")
                .setAttribute("href", "<?php echo e(asset('assets/css/style-dark.css')); ?>");
        } else {
            document
                .querySelector(".m-header > .b-brand > .logo-lg")
                .setAttribute("src", "<?php echo e(asset('assets/images/logo-dark.svg')); ?>");
            document
                .querySelector("#main-style-link")
                .setAttribute("href", "<?php echo e(asset('assets/css/style.css')); ?>");
        }
    });

    function removeClassByPrefix(node, prefix) {
        for (let i = 0; i < node.classList.length; i++) {
            let value = node.classList[i];
            if (value.startsWith(prefix)) {
                node.classList.remove(value);
            }
        }
    }
</script>
<?php echo $__env->yieldPushContent('custom-scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\matjar\resources\views/layouts/auth.blade.php ENDPATH**/ ?>