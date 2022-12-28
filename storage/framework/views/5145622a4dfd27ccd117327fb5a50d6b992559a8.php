<?php
    $users=\Auth::user();
    $profile=asset(Storage::url('uploads/avatar/'));
    $currantLang = $users->currentLanguage();
    $languages=App\Models\Utility::languages();
    $mode_setting = \App\Models\Utility::getLayoutsSetting();

?>

<header class="dash-header  <?php echo e((isset($mode_setting['cust_theme_bg']) && $mode_setting['cust_theme_bg'] == 'on')?'transprent-bg':''); ?>">
    <div class="header-wrapper">
    <div class="me-auto dash-mob-drp">
    <ul class="list-unstyled">
        <li class="dash-h-item mob-hamburger">
            <a href="#!" class="dash-head-link" id="mobile-collapse">
                <div class="hamburger hamburger--arrowturn">
                    <div class="hamburger-box">
                        <div class="hamburger-inner">
                        </div>
                    </div>
                </div>
             </a>
        </li>

        <li class="dropdown dash-h-item drp-company">
            <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-haspopup="false"
                            aria-expanded="false"
            >
            <span class="theme-avtar">
                <img src="<?php echo e((!empty(\Auth::user()->avatar))? asset(Storage::url("uploads/avatar/".\Auth::user()->avatar)): asset(Storage::url("uploads/avatar/avatar.png"))); ?>" class="img-fluid rounded-circle">
            </span>
                <span class="hide-mob ms-2"><?php echo e(\Auth::user()->name); ?></span>
                    <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                </a>
                <div class="dropdown-menu dash-h-dropdown">

                    <?php if(\Auth::guard('customer')->check()): ?>
                        <a href="<?php echo e(route('customer.profile')); ?>" class="dropdown-item">
                            <i class="ti ti-user"></i> <span><?php echo e(__('My Profile')); ?></span>
                        </a>
                    <?php elseif(\Auth::guard('vender')->check()): ?>
                        <a href="<?php echo e(route('vender.profile')); ?>" class="dropdown-item">
                            <i class="ti ti-user"></i> <span><?php echo e(__('My Profile')); ?></span>
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('profile')); ?>" class="dropdown-item">
                            <i class="ti ti-user"></i> <span><?php echo e(__('My Profile')); ?></span>
                        </a>
                    <?php endif; ?>

                    <?php if(\Auth::guard('customer')->check()): ?>
                    <a href="<?php echo e(route('customer.logout')); ?>" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="dropdown-item">
                        <i class="ti ti-power"></i>
                            <span><?php echo e(__('Logout')); ?></span>
                    </a>
                    <form id="frm-logout" action="<?php echo e(route('customer.logout')); ?>" method="POST" class="d-none">
                            <?php echo e(csrf_field()); ?>

                    </form>
                    <?php elseif(\Auth::guard('vender')->check()): ?>
                    <a href="<?php echo e(route('vender.logout')); ?>" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="dropdown-item">
                        <i class="ti ti-power"></i>
                            <span><?php echo e(__('Logout')); ?></span>
                    </a>
                    <form id="frm-logout" action="<?php echo e(route('vender.logout')); ?>" method="POST" class="d-none">
                            <?php echo e(csrf_field()); ?>

                    </form>
                    <?php else: ?>
                    <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="dropdown-item">
                        <i class="ti ti-power"></i>
                            <span><?php echo e(__('Logout')); ?></span>
                    </a>
                    <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo e(csrf_field()); ?>

                    </form>
                    <?php endif; ?>
                    

                </div>
        </li>

        <?php if( Gate::check('create product & service') ||  Gate::check('create customer') ||  Gate::check('create vender')||  Gate::check('create proposal')||  Gate::check('create invoice')||  Gate::check('create bill') ||  Gate::check('create goal') ||  Gate::check('create bank account')): ?>
            <li class="dropdown dash-h-item ml-2">
                    <div class="dropdown notification-icon">
                        <a class="dash-head-link dropdown-toggle arrow-none ms-0" data-bs-toggle="dropdown"
                             href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="ti ti-plus "></i>
                            </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownBookmark">
                                <?php if(Gate::check('create product & service')): ?>
                                    <a class="dropdown-item" href="#" data-url="<?php echo e(route('productservice.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Product')); ?>"><i class="ti ti-shopping-cart"></i><?php echo e(__('Create New Product')); ?></a>
                                <?php endif; ?>
                                <?php if(Gate::check('create customer')): ?>
                                    <a class="dropdown-item" href="#" data-url="<?php echo e(route('customer.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Customer')); ?>"><i class="ti ti-user"></i><?php echo e(__('Create New Customer')); ?></a>
                                <?php endif; ?>
                                <?php if(Gate::check('create vender')): ?>
                                    <a class="dropdown-item" href="#" data-url="<?php echo e(route('vender.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Vendor')); ?>"><i class="ti ti-note"></i><?php echo e(__('Create New Vendor')); ?></a>
                                <?php endif; ?>
                                <?php if(Gate::check('create proposal')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('proposal.create',0)); ?>"><i class="ti ti-file"></i><?php echo e(__('Create New Proposal')); ?></a>
                                <?php endif; ?>
                                <?php if(Gate::check('create invoice')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('invoice.create',0)); ?>"><i class="ti ti-file-invoice"></i><?php echo e(__('Create New Invoice')); ?></a>
                                <?php endif; ?>
                                <?php if(Gate::check('create bill')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('bill.create',0)); ?>"><i class="ti ti-report-money"></i><?php echo e(__('Create New Bill')); ?></a>
                                <?php endif; ?>
                                <?php if(Gate::check('create bank account')): ?>
                                    <a class="dropdown-item" href="#" data-url="<?php echo e(route('bank-account.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Account')); ?>"><i class="ti ti-building-bank"></i><?php echo e(__('Create New Account')); ?></a>
                                <?php endif; ?>
                                <?php if(Gate::check('create goal')): ?>
                                    <a class="dropdown-item " href="#" data-url="<?php echo e(route('goal.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Goal')); ?>"><i class="ti ti-target "></i><?php echo e(__('Create New Goal')); ?></a>
                                <?php endif; ?>
                            </div>
                    </div>
                </li>
        <?php endif; ?>
    </ul>

    </div>
        <div class="ms-auto">
            <ul class="list-unstyled">
                <li class="dropdown dash-h-item drp-language">
                    <a
                        class="dash-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false">
                        <i class="ti ti-world nocolor"></i>
                        <span class="drp-text hide-mob"><?php echo e(Str::upper($currantLang)); ?></span>
                        <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                    </a>

                    <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                 
                        
                        <?php if(\Auth::guard('customer')->check()): ?>
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="dropdown-item <?php if($language ==  $currantLang ): ?> text-danger <?php endif; ?>" href="<?php echo e(route('customer.change.language',$language)); ?>"><?php echo e(Str::upper($language)); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php elseif(\Auth::guard('vender')->check()): ?>
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="dropdown-item <?php if($language ==  $currantLang ): ?> text-danger <?php endif; ?>" href="<?php echo e(route('vender.change.language',$language)); ?>"><?php echo e(Str::upper($language)); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php else: ?>
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="dropdown-item <?php if($language ==  $currantLang ): ?> text-danger <?php endif; ?>" href="<?php echo e(route('change.language',$language)); ?>"><?php echo e(Str::upper($language)); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                      
                        <?php if(\Auth::user()->type=='super admin'): ?>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item text-primary" href="<?php echo e(route('manage.language',[$currantLang])); ?>"><?php echo e(__('Manage Language')); ?></a>
                        <?php endif; ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
<?php /**PATH J:\matjar\resources\views/partials/admin/header.blade.php ENDPATH**/ ?>