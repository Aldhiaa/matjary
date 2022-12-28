<?php
$logo = asset(Storage::url('uploads/logo/'));
// $company_logo = \App\Models\Utility::GetLogo();
// $company_logo=App\Models\Utility::getValByName('company_logo');
 // $company_small_logo=App\Models\Utility::getValByName('company_small_logo');
 // $mode_setting = \App\Models\Utility::mode_layout();
// $logo= $mode_setting['company_logo_dark'];
// if($mode_setting['cust_darklayout'] =='on'){
//     $logo= $mode_setting['company_logo_light'];
// }
// $logo= $mode_setting['company_logo_dark'];
// if($mode_setting['cust_darklayout'] =='on'){
//     $logo= $mode_setting['company_logo_light'];
// }
if(\Auth::user()->type=="Super Admin")
    {
        $company_logo=Utility::get_superadmin_logo();
    }
    else
    {
        $company_logo=Utility::get_company_logo();
    }
    
    $mode_setting = \App\Models\Utility::getLayoutsSetting();

    $emailTemplate     = App\Models\EmailTemplate::first();
?>






<nav class="dash-sidebar light-sidebar <?php echo e((isset($mode_setting['cust_theme_bg']) && $mode_setting['cust_theme_bg'] == 'on')?'transprent-bg':''); ?>">
    <div class="navbar-wrapper">
        <div class="m-header main-logo">
            <a href="#" class="b-brand">
                <img src="<?php echo e($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png')); ?>"
                alt="<?php echo e(config('app.name', 'AccountGo')); ?>" class="logo logo-lg">
            </a>
        </div>

        <div class="navbar-content">
            <ul class="dash-navbar">
                
                <li class="dash-item ">
                    <?php if(\Auth::guard('customer')->check()): ?>
                        <a href="<?php echo e(route('customer.dashboard')); ?>" class="dash-link <?php echo e((Request::route()->getName() == 'customer.dashboard') ? ' active' : ''); ?>">
                            <span class="dash-micon"><i class="ti ti-home"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                        </a>
                    <?php elseif(\Auth::guard('vender')->check()): ?>
                        <a href="<?php echo e(route('vender.dashboard')); ?>" class="dash-link <?php echo e((Request::route()->getName() == 'vender.dashboard') ? ' active' : ''); ?>">
                            <span class="dash-micon"><i class="ti ti-home"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('dashboard')); ?>" class="dash-link <?php echo e((Request::route()->getName() == 'dashboard') ? ' active' : ''); ?>">
                            <span class="dash-micon"><i class="ti ti-home"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                        </a>
                    <?php endif; ?>
                </li>

                <?php if( Gate::check('manage customer proposal') ): ?>
                
                    <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'customer.proposal' || Request::segment(1) == 'customer.retainer')?' active dash-trigger':''); ?>">
                        <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-building-bank"></i></span><span class="dash-mtext"><?php echo e(__('Presale')); ?></span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu <?php echo e((Request::segment(1) == 'customer.proposal' || Request::segment(1) == 'customer.retainer')?'show':''); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage customer proposal')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'customer.proposal' || Request::route()->getName() == 'customer.proposal.show') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('customer.proposal')); ?>"><?php echo e(__('Proposal')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage customer proposal')): ?>
                            
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'customer.retainer' || Request::route()->getName() == 'customer.retainer.show') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('customer.retainer')); ?>"><?php echo e(__('Retainers')); ?></a>
                                    
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                

                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage customer proposal')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'customer.proposal' || Request::route()->getName() == 'customer.proposal.show') ? ' active' : ''); ?> ">
                        <a href="<?php echo e(route('customer.proposal')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-receipt"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Proposal')); ?></span>
                        </a>
                    </li>
                <?php endif; ?> -->

                

                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage customer proposal')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'customer.retainer' || Request::route()->getName() == 'customer.retainer.show') ? ' active' : ''); ?> ">
                        <a href="<?php echo e(route('customer.retainer')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-receipt"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Retainer')); ?></span>
                        </a>
                    </li>
                <?php endif; ?> -->


                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage customer invoice')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'customer.invoice' || Request::route()->getName() == 'customer.invoice.show') ? ' active' : ''); ?> ">
                        <a href="<?php echo e(route('customer.invoice')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-file-invoice"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Invoice')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>


                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage customer payment')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'customer.payment') ? ' active' : ''); ?> ">
                        <a href="<?php echo e(route('customer.payment')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-report-money"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Payment')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage customer transaction')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'customer.transaction') ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('customer.transaction')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-history"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Transaction')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage vender bill')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'vender.bill' || Request::route()->getName() == 'vender.bill.show') ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('vender.bill')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-file-invoice"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Bill')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage vender payment')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'vender.payment') ? ' active' : ''); ?> ">
                        <a href="<?php echo e(route('vender.payment')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-report-money"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Payment')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage vender transaction')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'vender.transaction') ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('vender.transaction')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-history"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Transaction')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>



                
                <?php if(\Auth::user()->type=='super admin'): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage user')): ?>
                        <li class="dash-item">
                            <a href="<?php echo e(route('users.index')); ?>" class="dash-link <?php echo e((Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit') ? ' active' : ''); ?>">
                                <span class="dash-micon"><i class="ti ti-users"></i></span>
                                <span class="dash-mtext"><?php echo e(__('User')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if( Gate::check('manage user') || Gate::check('manage role')): ?>
                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'users' || Request::segment(1) == 'roles' || Request::segment(1) == 'permissions' )?' active dash-trigger':''); ?>">
                            <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-users"></i></span><span class="dash-mtext"><?php echo e(__('Staff')); ?></span>
                                <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="dash-submenu <?php echo e((Request::segment(1) == 'users' || Request::segment(1) == 'roles' || Request::segment(1) == 'permissions')?'show':''); ?>">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage user')): ?>
                                    <li class="dash-item <?php echo e((Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit') ? ' active' : ''); ?>">
                                        <a class="dash-link" href="<?php echo e(route('users.index')); ?>"><?php echo e(__('User')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage role')): ?>
                                    <li class="dash-item <?php echo e((Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'roles.create' || Request::route()->getName() == 'roles.edit') ? ' active' : ''); ?>">
                                        <a class="dash-link" href="<?php echo e(route('roles.index')); ?>"><?php echo e(__('Role')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                
                <?php if(Gate::check('manage product & service')): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'productservice')?'active':''); ?> ">
                        <a href="<?php echo e(route('productservice.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-shopping-cart"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Product & Services')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage product & service')): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'productstock')?'active':''); ?>">
                        <a href="<?php echo e(route('productstock.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-box"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Product Stock')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage customer')): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'customer')?'active':''); ?>">
                        <a href="<?php echo e(route('customer.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-user-plus"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Customer')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage vender')): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'vender')?'active':''); ?>">
                        <a href="<?php echo e(route('vender.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-note"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Vendor')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <!-- <?php if(Gate::check('manage proposal')): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'proposal')?'active':''); ?>">
                        <a href="<?php echo e(route('proposal.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-receipt"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Proposal')); ?></span>
                        </a>
                    </li>
                <?php endif; ?> -->

                
                
               
                <?php if( Gate::check('manage proposal') ||  (Gate::check('manage retainer'))): ?>
                
                    <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'proposal' || Request::segment(1) == 'retainer')?' active dash-trigger':''); ?>">
                        <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-building-bank"></i></span><span class="dash-mtext"><?php echo e(__('Presale')); ?></span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu <?php echo e((Request::segment(1) == 'proposal' || Request::segment(1) == 'retainer')?'show':''); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage proposal')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'proposal.index' || Request::route()->getName() == 'proposal.create' || Request::route()->getName() == 'proposal.edit') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('proposal.index')); ?>"><?php echo e(__('Proposal')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage retainer')): ?>
                            
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'retainer.index' || Request::route()->getName() == 'retainer.create' || Request::route()->getName() == 'retainer.edit') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('retainer.index')); ?>"><?php echo e(__('Retainers')); ?></a>
                                    
                                </li>
                                <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>


                
                <?php if( Gate::check('manage bank account') ||  Gate::check('manage transfer')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'bank-account' || Request::segment(1) == 'transfer')?' active dash-trigger':''); ?>">
                        <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-building-bank"></i></span><span class="dash-mtext"><?php echo e(__('Banking')); ?></span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu <?php echo e((Request::segment(1) == 'bank-account' || Request::segment(1) == 'transfer')?'show':''); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage bank account')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'bank-account.index' || Request::route()->getName() == 'bank-account.create' || Request::route()->getName() == 'bank-account.edit') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('bank-account.index')); ?>"><?php echo e(__('Account')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage transfer')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'transfer.index' || Request::route()->getName() == 'transfer.create' || Request::route()->getName() == 'transfer.edit') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('transfer.index')); ?>"><?php echo e(__('Transfer')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                
                <?php if( Gate::check('manage invoice') ||  Gate::check('manage revenue') ||  Gate::check('manage credit note')): ?>

                    <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'invoice' || Request::segment(1) == 'revenue' || Request::segment(1) == 'credit-note')?' active dash-trigger':''); ?>">
                        <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-file-invoice"></i></span><span class="dash-mtext"><?php echo e(__('Income')); ?></span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu <?php echo e((Request::segment(1) == 'invoice' || Request::segment(1) == 'revenue' || Request::segment(1) == 'credit-note')?'show':''); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage invoice')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'invoice.index' || Request::route()->getName() == 'invoice.create' || Request::route()->getName() == 'invoice.edit' || Request::route()->getName() == 'invoice.show') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('invoice.index')); ?>"><?php echo e(__('Invoice')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage revenue')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'revenue.index' || Request::route()->getName() == 'revenue.create' || Request::route()->getName() == 'revenue.edit') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('revenue.index')); ?>"><?php echo e(__('Revenue')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage credit note')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'credit.note' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('credit.note')); ?>"><?php echo e(__('Credit Note')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>

                <?php endif; ?>

                
                <?php if( Gate::check('manage bill')  ||  Gate::check('manage payment') ||  Gate::check('manage debit note')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'bill' || Request::segment(1) == 'payment' || Request::segment(1) == 'debit-note'  )?' active dash-trigger':''); ?>">
                        <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-report-money"></i></span><span class="dash-mtext"><?php echo e(__('Expense')); ?></span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu  <?php echo e((Request::segment(1) == 'bill' || Request::segment(1) == 'payment' || Request::segment(1) == 'debit-note'  )?'show':''); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage bill')): ?>
                                <li class="dash-item  <?php echo e((Request::route()->getName() == 'bill.index' || Request::route()->getName() == 'bill.create' || Request::route()->getName() == 'bill.edit' || Request::route()->getName() == 'bill.show') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('bill.index')); ?>"><?php echo e(__('Bill')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage payment')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'payment.index' || Request::route()->getName() == 'payment.create' || Request::route()->getName() == 'payment.edit') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('payment.index')); ?>"><?php echo e(__('Payment')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage debit note')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'debit.note' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('debit.note')); ?>"><?php echo e(__('Debit Note')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                
                <?php if( Gate::check('manage chart of account') ||  Gate::check('manage journal entry') ||   Gate::check('balance sheet report') ||  Gate::check('ledger report') ||  Gate::check('trial balance report')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'chart-of-account' || Request::segment(1) == 'journal-entry' || Request::segment(2) == 'ledger' ||  Request::segment(2) == 'balance-sheet' ||  Request::segment(2) == 'trial-balance')?' active dash-trigger':''); ?>">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-scale"></i></span><span class="dash-mtext"><?php echo e(__('Double Entry')); ?></span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu <?php echo e((Request::segment(1) == 'chart-of-account'  || Request::segment(1) == 'journal-entry' || Request::segment(2) == 'ledger' ||  Request::segment(2) == 'balance-sheet' ||  Request::segment(2) == 'trial-balance')?'show':''); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage chart of account')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'chart-of-account.index') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('chart-of-account.index')); ?>"><?php echo e(__('Chart of Accounts')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage journal entry')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'journal-entry.index' || Request::route()->getName() == 'journal-entry.show') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('journal-entry.index')); ?>"><?php echo e(__('Journal Account')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ledger report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.ledger' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.ledger')); ?>"><?php echo e(__('Ledger Summary')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('balance sheet report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.balance.sheet' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.balance.sheet')); ?>"><?php echo e(__('Balance Sheet')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('trial balance report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'trial.balance' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('trial.balance')); ?>"><?php echo e(__('Trial Balance')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                
                <?php if(\Auth::user()->type =='company'): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'budget')?'active':''); ?>">
                        <a href="<?php echo e(route('budget.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-businessplan"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Budget Planner')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                

                <?php if(Gate::check('manage contract')): ?> 
                    <li class="dash-item <?php echo e((Request::segment(1) == 'contract')?'active':''); ?>">
                        <a href="<?php echo e(route('contract.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-businessplan"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Contract')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage customer contract')): ?>
                    <li class="dash-item <?php echo e((Request::segment(2) == 'contract')?'active':''); ?>">
                        <a href="<?php echo e(route('customer.contract.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-businessplan"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Contract')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage goal')): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'goal')?'active':''); ?>">
                        <a href="<?php echo e(route('goal.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-target"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Goal')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage assets')): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'account-assets')?'active':''); ?>">
                        <a href="<?php echo e(route('account-assets.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-calculator"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Assets')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage plan')): ?>
                    <li class="dash-item <?php echo e(Request::segment(1) == 'plans' || Request::segment(1) == 'stripe'   ?'active':''); ?>">
                        <a href="<?php echo e(route('plans.index')); ?>" class="dash-link  ">
                            <span class="dash-micon"><i class="ti ti-trophy"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Plan')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(\Auth::user()->type=='super admin'): ?>
                    <li class="dash-item  <?php echo e(request()->is('plan_request*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('plan_request.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-arrow-up-right-circle"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Plan Request')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage coupon')): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'coupons')?'active':''); ?>">
                        <a href="<?php echo e(route('coupons.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-gift"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Coupon')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage order')): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'order')?'active':''); ?>">
                        <a href="<?php echo e(route('order.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-shopping-cart-plus"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Order')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                    
                <?php if(\Auth::user()->type=='super admin'): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'email_template_lang')?'active':''); ?>">
                        <a href="<?php echo e(route('manage.email.language',[$emailTemplate->id,\Auth::user()->lang])); ?>" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-template"></i></span><span
                                class="dash-mtext"><?php echo e(__('Email Template')); ?></span></a>
                    </li>
                <?php endif; ?>

                <!-- <?php if(\Auth::user()->type == 'company'): ?>
                    <li class="dash-item">
                        <a href="<?php echo e(route('email_template.index')); ?>" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-notification"></i></span><span
                                class="dash-mtext"><?php echo e(__('Email Notification')); ?></span></a>
                    </li>
                <?php endif; ?> -->


                
                <?php if( Gate::check('income report') || Gate::check('expense report') || Gate::check('income vs expense report') || Gate::check('tax report')  || Gate::check('loss & profit report') || Gate::check('invoice report') || Gate::check('bill report') || Gate::check('invoice report') ||  Gate::check('manage transaction')||  Gate::check('statement report')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e(((Request::segment(1) == 'report' || Request::segment(1) == 'transaction') &&  Request::segment(2) != 'ledger' &&  Request::segment(2) != 'balance-sheet' &&  Request::segment(2) != 'trial-balance')?' active dash-trigger':''); ?>">
                        <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-chart-line"></i></span><span class="dash-mtext"><?php echo e(__('Report')); ?></span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu <?php echo e(((Request::segment(1) == 'report' || Request::segment(1) == 'transaction') &&  Request::segment(2) != 'ledger' &&  Request::segment(2) != 'balance-sheet' &&  Request::segment(2) != 'trial-balance')?'show':''); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage transaction')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'transaction.index' || Request::route()->getName() == 'transfer.create' || Request::route()->getName() == 'transaction.edit') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('transaction.index')); ?>"><?php echo e(__('Transaction')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('statement report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.account.statement') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.account.statement')); ?>"><?php echo e(__('Account Statement')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('income report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.income.summary' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.income.summary')); ?>"><?php echo e(__('Income Summary')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.expense.summary' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.expense.summary')); ?>"><?php echo e(__('Expense Summary')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('income vs expense report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.income.vs.expense.summary' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.income.vs.expense.summary')); ?>"><?php echo e(__('Income VS Expense')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tax report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.tax.summary' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.tax.summary')); ?>"><?php echo e(__('Tax Summary')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('loss & profit report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.profit.loss.summary' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.profit.loss.summary')); ?>"><?php echo e(__('Profit & Loss')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('invoice report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.invoice.summary' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.invoice.summary')); ?>"><?php echo e(__('Invoice Summary')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bill report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.bill.summary' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.bill.summary')); ?>"><?php echo e(__('Bill Summary')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('stock report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.product.stock.report' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.product.stock.report')); ?>"><?php echo e(__('Product Stock')); ?></a>
                                </li>
                            <?php endif; ?>


                        </ul>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage constant tax') || Gate::check('manage constant category') ||Gate::check('manage constant unit') ||Gate::check('manage constant payment method') ||Gate::check('manage constant custom field') || Gate::check('manage constant chart of account')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')?' active dash-trigger':''); ?> ">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-chart-arcs"></i></span><span class="dash-mtext"><?php echo e(__('Constant')); ?></span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu <?php echo e((Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')?'show':''); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage constant tax')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'taxes.index' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('taxes.index')); ?>"><?php echo e(__('Taxes')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage constant category')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'product-category.index' ) ? 'active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('product-category.index')); ?>"><?php echo e(__('Category')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage constant unit')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'product-unit.index' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('product-unit.index')); ?>"><?php echo e(__('Unit')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage constant custom field')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'custom-field.index' ) ? 'active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('custom-field.index')); ?>"><?php echo e(__('Custom Field')); ?></a>
                                </li>
                            <?php endif; ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'contractType.index' ) ? 'active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('contractType.index')); ?>"><?php echo e(__('Contract Type')); ?></a>
                                </li>
                        </ul>
                    </li>
                <?php endif; ?>


                
                <?php if(Gate::check('manage system settings')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'systems.index') ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('systems.index')); ?>" class="dash-link  ">
                            <span class="dash-micon"><i class="ti ti-settings"></i></span>
                            <span class="dash-mtext"><?php echo e(__('System Setting')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage company settings')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'systems.index') ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('company.setting')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-settings"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Company Setting')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>


            </ul>
        </div>
    </div>
</nav>
<?php /**PATH J:\matjar\resources\views/partials/admin/menu.blade.php ENDPATH**/ ?>