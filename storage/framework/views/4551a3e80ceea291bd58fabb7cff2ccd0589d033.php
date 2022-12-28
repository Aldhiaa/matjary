<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php
$logo = asset(Storage::url('uploads/logo/'));
$lang = \App\Models\Utility::getValByName('default_language');
?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            $('#gdpr_cookie').trigger('change');
        });
        $(document).on('change', '#gdpr_cookie', function(e) {
            $('.gdpr_cookie_text').hide();
            if ($("#gdpr_cookie").prop('checked') == true) {
                $('.gdpr_cookie_text').show();
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-page'); ?>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,
        })
        $(".list-group-item").click(function(){
            $('.list-group-item').filter(function(){
                return this.href == id;
            }).parent().removeClass('text-primary');
        });

        function check_theme(color_val) {
            $('#theme_color').prop('checked', false);
            $('input[value="' + color_val + '"]').prop('checked', true);
        }
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Settings')); ?></li>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xl-3">
                <div class="card sticky-top" style="top:30px">
                    <div class="list-group list-group-flush" id="useradd-sidenav">
                        <a href="#useradd-1" class="list-group-item list-group-item-action border-0"><?php echo e(__('Site Setting')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-2" class="list-group-item list-group-item-action border-0"><?php echo e(__('Email Setting')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-3" class="list-group-item list-group-item-action border-0"><?php echo e(__('Payment Setting')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-4" class="list-group-item list-group-item-action border-0"><?php echo e(__('ReCaptcha Setting')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>


                    </div>
                </div>
            </div>

            <div class="col-xl-9">

                <!--Site Setting-->
                <div id="useradd-1" class="card">

                    <div class="card-header">
                        <h5><?php echo e(__('Site Setting')); ?></h5>
                    </div>
                    <?php echo e(Form::model($settings, ['url' => 'systems', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>


                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-md-6 dashboard-card">
                                <div class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Logo dark')); ?></h5>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class=" setting-card">
                                            <div class="logo-content mt-4">
                                            <a href="<?php echo e($logo.'/'.(isset($logo_dark) && !empty($logo_dark)?$logo_dark:'logo-dark.png')); ?>" target="_blank">
                                                    <img id="blah" alt="your image" src="<?php echo e($logo.'/'.(isset($logo_dark) && !empty($logo_dark)?$logo_dark:'logo-dark.png')); ?>" width="150px" class="big-logo">
                                                </a>

                                                <!-- <img src="<?php echo e($logo.'/'.(isset($logo_dark) && !empty($logo_dark)?$logo_dark:'logo-dark.png')); ?>"
                                                     class="big-logo" width="150px"> -->
                                            </div>
                                            <div class="choose-files mt-5">
                                                <label for="full_logo">
                                                    <div class=" bg-primary company_logo_update"> <i
                                                            class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                    </div>
                                                    <input type="file" name="logo_dark" id="full_logo" class="form-control file" data-filename="full_logo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">


                                                    <!-- <input type="file" name="logo_dark" id="full_logo" class="form-control file" data-filename="full_logo"> -->
                                                </label>
                                            </div>
                                            <?php $__errorArgs = ['full_logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="row">
                                                <span class="invalid-logo" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            </div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-6 dashboard-card">
                                <div class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Logo Light')); ?></h5>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class=" setting-card">
                                            <div class="logo-content mt-4">
                                            <a href="<?php echo e($logo.'/'.(isset($logo_light) && !empty($logo_light)?$logo_light:'logo-light.png')); ?>" target="_blank">
                                                    <img id="blah1" alt="your image" src="<?php echo e($logo.'/'.(isset($logo_light) && !empty($logo_light)?$logo_light:'logo-light.png')); ?>" width="150px" class="big-logo img_setting">
                                                </a>

                                                <!-- <img src="<?php echo e($logo.'/'.'logo-light.png'); ?>" class="big-logo img_setting" width="150px"> -->
                                            </div>
                                            <div class="choose-files mt-5">
                                                <label for="logo_light">
                                                    <div class=" bg-primary dark_logo_update"> <i
                                                            class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                    </div>
                                                    <input type="file" name="company_logo_light" id="company_logo_light" class="form-control file" data-filename="dark_logo_update" onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])">


                                                    <!-- <input type="file" class="form-control file" name="logo_light" id="logo_light"
                                                           data-filename="logo_light"> -->
                                                </label>
                                            </div>
                                                <?php $__errorArgs = ['logo_light'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="row">
                                                    <span class="invalid-logo" role="alert">
                                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                                    </span>
                                                </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-6 dashboard-card">
                                <div class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Favicon')); ?></h5>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class=" setting-card">
                                            <div class="logo-content mt-4">
                                            <a href="<?php echo e($logo.'/'.(isset($company_favicon) && !empty($company_favicon)?$company_favicon:'favicon.png')); ?>" target="_blank">
                                                    <img id="blah2" alt="your image" src="<?php echo e($logo.'/'.(isset($company_favicon) && !empty($company_favicon)?$company_favicon:'favicon.png')); ?>" width="100px" class="big-logo img_setting">
                                                </a>

                                                <!-- <img src="<?php echo e($logo.'/'.'favicon.png'); ?>" width="150px" class="big-logo img_setting"> -->
                                            </div>
                                            <div class="choose-files mt-5">
                                                <label for="favicon">
                                                    <div class="bg-primary company_favicon_update"> <i
                                                            class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                    </div>
                                                    <input type="file" name="company_favicon" id="company_favicon" class="form-control file" data-filename="company_favicon_update" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">


                                                    <!-- <input type="file" class="form-control file"  id="favicon" name="favicon"
                                                           data-filename="favicon"> -->
                                                </label>
                                            </div>
                                            <?php $__errorArgs = ['favicon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="row">
                                                    <span class="invalid-logo" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                    </span>
                                            </div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('title_text',__('Title Text'),array('class'=>'form-label'))); ?>

                                        <?php echo e(Form::text('title_text',null,array('class'=>'form-control','placeholder'=>__('Title Text')))); ?>

                                        <?php $__errorArgs = ['title_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-title_text" role="alert">
                                                     <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('footer_text',__('Footer Text'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('footer_text',Utility::getValByName('footer_text'),array('class'=>'form-control','placeholder'=>__('Enter Footer Text')))); ?>

                                        <?php $__errorArgs = ['footer_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-footer_text" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('default_language',__('Default Language'),['class'=>'col-form-label text-dark'])); ?>

                                        <div class="changeLanguage">
                                             <select name="default_language" id="default_language" class="form-control select">
                                                 <?php $__currentLoopData = \App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                     <option <?php if($lang == $language): ?> selected <?php endif; ?> value="<?php echo e($language); ?>">
                                                         <?php echo e(Str::upper($language)); ?></option>
                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        </div>
                                        <?php $__errorArgs = ['default_language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-default_language" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col-3 my-auto">
                                            <div class="form-group">
                                                <label class="text-dark mb-1" for="SITE_RTL"><?php echo e(__('RTL')); ?></label>
                                                <div class="">
                                                    <input type="checkbox" name="SITE_RTL" id="SITE_RTL" data-toggle="switchbutton" <?php echo e($settings['SITE_RTL'] == 'on' ? 'checked="checked"' : ''); ?> data-onstyle="primary">
                                                    <label class="form-check-labe" for="SITE_RTL"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3 my-auto">
                                            <div class="form-group">
                                                <label class="text-dark mb-1 mt-3" for="display_landing_page"><?php echo e(__('Enable Landing Page')); ?></label>
                                                <div class="form-check form-switch d-inline-block" style="padding-left: 0px !important">
                                                    <input type="checkbox" name="display_landing_page" class="form-check-input gdpr_fulltime gdpr_type" id="display_landing_page" data-toggle="switchbutton" <?php echo e((Utility::getValByName('display_landing_page') == 'on') ? 'checked' : ''); ?> data-onstyle="primary">
                                                    <label class="form-check-labe" for="display_landing_page"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3 my-auto">
                                            <div class="form-group">
                                                <label class="text-dark mb-1 mt-3" for="signup_button"><?php echo e(__('Sign Up')); ?></label>
                                                <div class="">
                                                    <input type="checkbox" name="enable_signup" id="enable_signup" data-toggle="switchbutton"  <?php echo e($settings['enable_signup'] == 'on' ? 'checked="checked"' : ''); ?> data-onstyle="primary">
                                                    <label class="form-check-labe" for="enable_signup"></label>
                                                </div>
                                            </div>
        
                                        </div>
                                        <div class="col-3 my-auto">
        
                                            <div class="form-group ">
                                                <label class="text-dark mb-1 mt-3" for="gdpr_cookie"><?php echo e(__('GDPR Cookie')); ?></label>
                                                <div class="">
                                                    <input type="checkbox" class="gdpr_fulltime gdpr_type" name="gdpr_cookie" id="gdpr_cookie" data-toggle="switchbutton" <?php echo e(isset($settings['gdpr_cookie']) && $settings['gdpr_cookie'] == 'on' ? 'checked="checked"' : ''); ?> data-onstyle="primary">
                                                    <label class="form-check-labe" for="gdpr_cookie"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                               
                                <div class="form-group col-12">
                                    <?php echo e(Form::label('cookie_text',__('GDPR Cookie Text'),array('class'=>'fulltime') )); ?>

                                    <?php echo Form::textarea('cookie_text',isset($settings['cookie_text']) && $settings['cookie_text'] ? $settings['cookie_text'] : '' , ['class'=>'form-control fulltime','style'=>'display: hidden;resize: none;','rows'=>'4']); ?>

                                </div>

                            </div>
                            <h4 class="small-title"><?php echo e(__('Theme Customizer')); ?></h4>
                            <div class="setting-card setting-logo-box p-3">
                                <div class="row">
                                    <div class="col-4 my-auto">
                                        <h6 class="mt-2">
                                            <i data-feather="credit-card" class="me-2"></i><?php echo e(__('Primary color settings')); ?>

                                        </h6>
                                        <hr class="my-2" />
                                        <div class="theme-color themes-color">
                                            <a href="#!" class="" data-value="theme-1" onclick="check_theme('theme-1')"></a>
                                            <input type="radio" class="theme_color" name="color" value="theme-1" style="display: none;">
                                            <a href="#!" class="" data-value="theme-2" onclick="check_theme('theme-2')"></a>
                                            <input type="radio" class="theme_color" name="color" value="theme-2" style="display: none;">
                                            <a href="#!" class="" data-value="theme-3" onclick="check_theme('theme-3')"></a>
                                            <input type="radio" class="theme_color" name="color" value="theme-3" style="display: none;">
                                            <a href="#!" class="" data-value="theme-4" onclick="check_theme('theme-4')"></a>
                                            <input type="radio" class="theme_color" name="color" value="theme-4" style="display: none;">
                                        </div>
                                    </div>
                                    <div class="col-4 my-auto">
                                        <h6 class="mt-4">
                                            <i data-feather="layout" class="me-2"></i><?php echo e(__('Sidebar settings')); ?>

                                        </h6>
                                        <hr class="my-2" />
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" id="cust-theme-bg" name="cust_theme_bg" <?php echo e(Utility::getValByName('cust_theme_bg') == 'on' ? 'checked' : ''); ?> />
                                            <label class="form-check-label f-w-600 pl-1" for="cust-theme-bg"
                                            ><?php echo e(__('Transparent layout')); ?></label
                                            >
                                        </div>
                                    </div>
                                    <div class="col-4 my-auto">
                                        <h6 class="mt-4">
                                            <i data-feather="sun" class="me-2"></i><?php echo e(__('Layout settings')); ?>

                                        </h6>
                                        <hr class="my-2" />
                                        <div class="form-check form-switch mt-2">
                                            <input type="checkbox" class="form-check-input" id="cust-darklayout" name="cust_darklayout"<?php echo e(Utility::getValByName('cust_darklayout') == 'on' ? 'checked' : ''); ?> />
                                            <label class="form-check-label f-w-600 pl-1" for="cust-darklayout"><?php echo e(__('Dark Layout')); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card-footer text-end">
                        <div class="form-group">
                            <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
                    </div>
                </div>
                <!--Email Setting-->
                <div id="useradd-2" class="card">
                    <div class="card-header">
                        <h5><?php echo e(__('Email Setting')); ?></h5>
                    </div>
                    <div class="card-body">
                    <?php echo e(Form::open(['route' => 'email.settings', 'method' => 'post'])); ?>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <?php echo e(Form::label('mail_driver', __('Mail Driver'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('mail_driver', env('MAIL_DRIVER'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Driver')])); ?>

                                        <?php $__errorArgs = ['mail_driver'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_driver" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <?php echo e(Form::label('mail_host', __('Mail Host'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('mail_host', env('MAIL_HOST'), ['class' => 'form-control ', 'placeholder' => __('Enter Mail Host')])); ?>

                                        <?php $__errorArgs = ['mail_host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_driver" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <?php echo e(Form::label('mail_port', __('Mail Port'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('mail_port', env('MAIL_PORT'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Port')])); ?>

                                    <?php $__errorArgs = ['mail_port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_port" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('mail_username', __('Mail Username'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('mail_username', env('MAIL_USERNAME'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Username')])); ?>

                                        <?php $__errorArgs = ['mail_username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_username" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <?php echo e(Form::label('mail_password', __('Mail Password'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('mail_password', env('MAIL_PASSWORD'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Password')])); ?>

                                    <?php $__errorArgs = ['mail_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_password" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <?php echo e(Form::label('mail_encryption', __('Mail Encryption'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('mail_encryption', env('MAIL_ENCRYPTION'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Encryption')])); ?>

                                    <?php $__errorArgs = ['mail_encryption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_encryption" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>



                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <?php echo e(Form::label('mail_from_address', __('Mail From Address'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('mail_from_address', env('MAIL_FROM_ADDRESS'), ['class' => 'form-control', 'placeholder' => __('Enter Mail From Address')])); ?>

                                    <?php $__errorArgs = ['mail_from_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_from_address" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <?php echo e(Form::label('mail_from_name', __('Mail From Name'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('mail_from_name', env('MAIL_FROM_NAME'), ['class' => 'form-control', 'placeholder' => __('Enter Mail From Name')])); ?>

                                    <?php $__errorArgs = ['mail_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_from_name" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                            </div>

                            
                                <div class="card-footer ">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <a href="#" data-url="<?php echo e(route('test.mail')); ?>" data-ajax-popup="true"
                                                data-title="<?php echo e(__('Send Test Mail')); ?>" class="btn btn-primary ">
                                                <?php echo e(__('Send Test Mail')); ?>

                                            </a>
                                        </div>
                                        <div class="form-group col-md-6 text-end">
                                            <input class="btn btn-primary" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                                        </div>
                                    </div>
                                </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>


                <!--Payment Setting-->
                <div id="useradd-3" class="card">
                    <div class="card-header">
                        <h5><?php echo e(__('Payment Setting')); ?></h5>
                        <small class="text-muted"><?php echo e(__(' This detail will use for collect payment on plan from company . On plan company will find out pay now button based on your below configuration.')); ?></small>
                    </div>
                    <div class="card-body">
                    <?php echo e(Form::open(['route' => 'payment.settings', 'method' => 'post'])); ?>

                            <?php echo csrf_field(); ?>
                            <div class="faq justify-content-center">
                                <div class="col-sm-12 col-md-10 col-xxl-12">
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('currency', __('Currency *'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('currency', env('CURRENCY'), ['class' => 'form-control font-style', 'required', 'placeholder' => __('Enter Currency')])); ?>

                                            <small> <?php echo e(__('Note: Add currency code as per three-letter ISO code.')); ?><br>
                                                <a href="https://stripe.com/docs/currencies"
                                                    target="_blank"><?php echo e(__('you can find out here..')); ?></a></small> <br>
                                            <?php $__errorArgs = ['currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-currency" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('currency_symbol', __('Currency Symbol *'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('currency_symbol', env('CURRENCY_SYMBOL'), ['class' => 'form-control', 'required', 'placeholder' => __('Enter Currency Symbol')])); ?>

                                            <?php $__errorArgs = ['currency_symbol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-currency_symbol" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>
                                    <div class="accordion accordion-flush" id="accordionExample">

                                        <!-- Strip -->
                                        <div class="accordion-item card">
                                            <h2 class="accordion-header" id="heading-2-2">
                                                <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Stripe')); ?>

                                                        </span>
                                                </button>
                                            </h2>
                                            <div id="collapse1" class="accordion-collapse collapse"aria-labelledby="heading-2-2"data-bs-parent="#accordionExample" >
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-6 py-2">
                                                        </div>
                                                        <div class="col-6 py-2 text-end">

                                                            <div class="form-check form-switch d-inline-block">
                                                                <input type="hidden" name="is_stripe_enabled" value="off">
                                                                <input type="checkbox" class="form-check-input" name="is_stripe_enabled" id="is_stripe_enabled" <?php echo e(isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                <label class="custom-control-label form-label" for="is_stripe_enabled"><?php echo e(__('Enable ')); ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="stripe_key" class="col-form-label"><?php echo e(__('Stripe Key')); ?></label>
                                                                <input class="form-control" placeholder="<?php echo e(__('Stripe Key')); ?>" name="stripe_key" type="text" value="<?php echo e((!isset($admin_payment_setting['stripe_key']) || is_null($admin_payment_setting['stripe_key'])) ? '' : $admin_payment_setting['stripe_key']); ?>" id="stripe_key">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="stripe_secret" class="col-form-label"><?php echo e(__('Stripe Secret')); ?></label>
                                                                <input class="form-control " placeholder="<?php echo e(__('Stripe Secret')); ?>" name="stripe_secret" type="text" value="<?php echo e((!isset($admin_payment_setting['stripe_secret']) || is_null($admin_payment_setting['stripe_secret'])) ? '' : $admin_payment_setting['stripe_secret']); ?>" id="stripe_secret">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Paypal -->
                                        <div class="accordion-item card">
                                            <h2 class="accordion-header" id="heading-2-3">
                                                <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Paypal')); ?>

                                                        </span>
                                                </button>
                                            </h2>
                                            <div id="collapse2" class="accordion-collapse collapse"aria-labelledby="heading-2-3"data-bs-parent="#accordionExample" >
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-6 py-2">
                                                        </div>
                                                        <div class="col-6 py-2 text-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                <input type="hidden" name="is_paypal_enabled" value="off">
                                                                <input type="checkbox" class="form-check-input" name="is_paypal_enabled" id="is_paypal_enabled"  <?php echo e(isset($admin_payment_setting['is_paypal_enabled']) && $admin_payment_setting['is_paypal_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                <label class="custom-control-label form-label" for="is_paypal_enabled"><?php echo e(__('Enable ')); ?></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label class="paypal-label col-form-label" for="paypal_mode"><?php echo e(__('Paypal Mode')); ?></label> <br>
                                                            <div class="d-flex">
                                                                <div class="mr-2" style="margin-right: 15px;">
                                                                    <div class="border card p-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-labe text-dark <?php echo e(isset($admin_payment_setting['paypal_mode']) && $admin_payment_setting['paypal_mode'] == 'sandbox' ? 'active' : ''); ?>">
                                                                                <input type="radio" name="paypal_mode" value="sandbox" <?php echo e(isset($admin_payment_setting['paypal_mode']) && $admin_payment_setting['paypal_mode'] == '' || isset($admin_payment_setting['paypal_mode']) && $admin_payment_setting['paypal_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>"
                                                                                            class="form-check-input" >
                                                                                <?php echo e(__('Sandbox')); ?>

                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mr-2">
                                                                    <div class="border card p-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-labe text-dark">
                                                                                <input type="radio" name="paypal_mode" value="live" class="form-check-input" <?php echo e(isset($admin_payment_setting['paypal_mode']) && $admin_payment_setting['paypal_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                <?php echo e(__('Live')); ?>

                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="paypal_client_id" class="col-form-label"><?php echo e(__('Client ID')); ?></label>
                                                                <input type="text" name="paypal_client_id" id="paypal_client_id" class="form-control" value="<?php echo e((!isset($admin_payment_setting['paypal_client_id']) || is_null($admin_payment_setting['paypal_client_id'])) ? '' : $admin_payment_setting['paypal_client_id']); ?>" placeholder="<?php echo e(__('Client ID')); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="paypal_secret_key" class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                <input type="text" name="paypal_secret_key" id="paypal_secret_key" class="form-control" value="<?php echo e((!isset($admin_payment_setting['paypal_secret_key']) || is_null($admin_payment_setting['paypal_secret_key'])) ? '' : $admin_payment_setting['paypal_secret_key']); ?>" placeholder="<?php echo e(__('Secret Key')); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Paystack -->
                                        <div class="accordion-item card">
                                            <h2 class="accordion-header" id="heading-2-4">
                                                <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Paystack')); ?>

                                                        </span>
                                                </button>
                                            </h2>
                                            <div id="collapse3" class="accordion-collapse collapse"aria-labelledby="heading-2-4"data-bs-parent="#accordionExample" >
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-6 py-2">
                                                        </div>
                                                        <div class="col-6 py-2 text-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                <input type="hidden" name="is_paystack_enabled" value="off">
                                                                <input type="checkbox" class="form-check-input" name="is_paystack_enabled" id="is_paystack_enabled" <?php echo e((isset($admin_payment_setting['is_paystack_enabled']) && $admin_payment_setting['is_paystack_enabled'] == 'on') ? 'checked' : ''); ?>>
                                                                <label class="custom-control-label form-label" for="is_paystack_enabled"><?php echo e(__('Enable ')); ?></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="paypal_client_id" class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                <input type="text" name="paystack_public_key" id="paystack_public_key" class="form-control" value="<?php echo e((!isset($admin_payment_setting['paystack_public_key']) || is_null($admin_payment_setting['paystack_public_key'])) ? '' : $admin_payment_setting['paystack_public_key']); ?>" placeholder="<?php echo e(__('Public Key')); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="paystack_secret_key" class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                <input type="text" name="paystack_secret_key" id="paystack_secret_key" class="form-control" value="<?php echo e((!isset($admin_payment_setting['paystack_secret_key']) || is_null($admin_payment_setting['paystack_secret_key'])) ? '' : $admin_payment_setting['paystack_secret_key']); ?>" placeholder="<?php echo e(__('Secret Key')); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- FLUTTERWAVE -->
                                        <div class="accordion-item card">
                                            <h2 class="accordion-header" id="heading-2-5">
                                                <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Flutterwave')); ?>

                                                        </span>
                                                </button>
                                            </h2>
                                            <div id="collapse4" class="accordion-collapse collapse"aria-labelledby="heading-2-5"data-bs-parent="#accordionExample" >
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-6 py-2">
                                                        </div>
                                                        <div class="col-6 py-2 text-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                <input type="hidden" name="is_flutterwave_enabled" value="off">
                                                                <input type="checkbox" class="form-check-input" name="is_flutterwave_enabled" id="is_flutterwave_enabled" <?php echo e((isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on') ? 'checked' : ''); ?>>
                                                                <label class="custom-control-label form-label" for="is_flutterwave_enabled"><?php echo e(__('Enable ')); ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="paypal_client_id" class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                <input type="text" name="flutterwave_public_key" id="flutterwave_public_key" class="form-control" value="<?php echo e((!isset($admin_payment_setting['flutterwave_public_key']) || is_null($admin_payment_setting['flutterwave_public_key'])) ? '' : $admin_payment_setting['flutterwave_public_key']); ?>" placeholder="Public Key">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="paystack_secret_key" class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                <input type="text" name="flutterwave_secret_key" id="flutterwave_secret_key" class="form-control" value="<?php echo e((!isset($admin_payment_setting['flutterwave_secret_key']) || is_null($admin_payment_setting['flutterwave_secret_key'])) ? '' : $admin_payment_setting['flutterwave_secret_key']); ?>" placeholder="Secret Key">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Razorpay -->
                                        <div class="accordion-item card">
                                            <h2 class="accordion-header" id="heading-2-6">
                                                <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Razorpay')); ?>

                                                        </span>
                                                </button>
                                            </h2>
                                            <div id="collapse5" class="accordion-collapse collapse"aria-labelledby="heading-2-6"data-bs-parent="#accordionExample" >
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-6 py-2">
                                                        </div>
                                                        <div class="col-6 py-2 text-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                <input type="hidden" name="is_razorpay_enabled" value="off">
                                                                <input type="checkbox" class="form-check-input" name="is_razorpay_enabled" id="is_razorpay_enabled" <?php echo e(isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                <label class="custom-control-label form-label" for="is_razorpay_enabled"><?php echo e(__('Enable ')); ?></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="paypal_client_id" class="col-form-label"><?php echo e(__('Public Key')); ?></label>

                                                                <input type="text" name="razorpay_public_key" id="razorpay_public_key" class="form-control" value="<?php echo e((!isset($admin_payment_setting['razorpay_public_key']) || is_null($admin_payment_setting['razorpay_public_key'])) ? '' : $admin_payment_setting['razorpay_public_key']); ?>" placeholder="Public Key">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="paystack_secret_key" class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                <input type="text" name="razorpay_secret_key" id="razorpay_secret_key" class="form-control" value="<?php echo e((!isset($admin_payment_setting['razorpay_secret_key']) || is_null($admin_payment_setting['razorpay_secret_key'])) ? '' : $admin_payment_setting['razorpay_secret_key']); ?>" placeholder="Secret Key">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- Mercado Pago-->
                                        <div class="accordion-item card">
                                            <h2 class="accordion-header" id="heading-2-8">
                                                <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Mercado Pago')); ?>

                                                        </span>
                                                </button>
                                            </h2>
                                            <div id="collapse7" class="accordion-collapse collapse"aria-labelledby="heading-2-8"data-bs-parent="#accordionExample" >
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-6 py-2">
                                                        </div>
                                                        <div class="col-6 py-2 text-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                <input type="hidden" name="is_mercado_enabled" value="off">
                                                                <input type="checkbox" class="form-check-input" name="is_mercado_enabled" id="is_mercado_enabled" <?php echo e((isset($admin_payment_setting['is_mercado_enabled']) && $admin_payment_setting['is_mercado_enabled'] == 'on') ? 'checked' : ''); ?>>
                                                                <label class="custom-control-label form-label" for="is_mercado_enabled"><?php echo e(__('Enable')); ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 ">
                                                            <label class="coingate-label col-form-label" for="mercado_mode"><?php echo e(__('Mercado Mode')); ?></label> <br>
                                                            <div class="d-flex">
                                                                <div class="mr-2" style="margin-right: 15px;">
                                                                    <div class="border card p-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-labe text-dark">
                                                                                <input type="radio" name="mercado_mode" value="sandbox" class="form-check-input" <?php echo e(isset($admin_payment_setting['mercado_mode']) && $admin_payment_setting['mercado_mode'] == '' || isset($admin_payment_setting['mercado_mode']) && $admin_payment_setting['mercado_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                                                                <?php echo e(__('Sandbox')); ?>

                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mr-2">
                                                                    <div class="border card p-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-labe text-dark">
                                                                                <input type="radio" name="mercado_mode" value="live" class="form-check-input" <?php echo e(isset($admin_payment_setting['mercado_mode']) && $admin_payment_setting['mercado_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                <?php echo e(__('Live')); ?>

                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="mercado_access_token" class="col-form-label"><?php echo e(__('Access Token')); ?></label>
                                                                <input type="text" name="mercado_access_token" id="mercado_access_token" class="form-control" value="<?php echo e(isset($admin_payment_setting['mercado_access_token']) ? $admin_payment_setting['mercado_access_token']:''); ?>" placeholder="<?php echo e(__('Access Token')); ?>"/>
                                                                <?php if($errors->has('mercado_secret_key')): ?>
                                                                    <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('mercado_access_token')); ?>

                                                                        </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Paytm -->
                                        <div class="accordion-item card">
                                            <h2 class="accordion-header" id="heading-2-7">
                                                <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Paytm')); ?>

                                                        </span>
                                                </button>
                                            </h2>
                                            <div id="collapse6" class="accordion-collapse collapse"aria-labelledby="heading-2-7"data-bs-parent="#accordionExample" >
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-6 py-2">
                                                        </div>

                                                        <div class="col-6 py-2 text-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                <input type="hidden" name="is_paytm_enabled" value="off">
                                                                <input type="checkbox" class="form-check-input" name="is_paytm_enabled" id="is_paytm_enabled" <?php echo e(isset($admin_payment_setting['is_paytm_enabled']) && $admin_payment_setting['is_paytm_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                <label class="custom-control-label form-label" for="is_paytm_enabled"><?php echo e(__('Enable ')); ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="paypal-label col-form-label" for="paytm_mode"><?php echo e(__('Paytm Environment')); ?></label> <br>
                                                            <div class="d-flex">
                                                                <div class="mr-2" style="margin-right: 15px;">
                                                                    <div class="border card p-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-labe text-dark">

                                                                                <input type="radio" name="paytm_mode" value="local" class="form-check-input" <?php echo e(!isset($admin_payment_setting['paytm_mode']) || $admin_payment_setting['paytm_mode'] == '' || $admin_payment_setting['paytm_mode'] == 'local' ? 'checked="checked"' : ''); ?>>

                                                                                <?php echo e(__('Local')); ?>

                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mr-2">
                                                                    <div class="border card p-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-labe text-dark">
                                                                                <input type="radio" name="paytm_mode" value="production" class="form-check-input" <?php echo e(isset($admin_payment_setting['paytm_mode']) && $admin_payment_setting['paytm_mode'] == 'production' ? 'checked="checked"' : ''); ?>>

                                                                                <?php echo e(__('Production')); ?>

                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="paytm_public_key" class="col-form-label"><?php echo e(__('Industry Type')); ?></label>
                                                                <input type="text" name="paytm_merchant_id" id="paytm_merchant_id" class="form-control" value="<?php echo e((!isset($admin_payment_setting['paytm_merchant_id']) || is_null($admin_payment_setting['paytm_merchant_id'])) ? '' : $admin_payment_setting['paytm_merchant_id']); ?>" placeholder="Merchant ID">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="paytm_secret_key" class="col-form-label"><?php echo e(__('Merchant Key')); ?></label>
                                                                <input type="text" name="paytm_merchant_key" id="paytm_merchant_key" class="form-control" value="<?php echo e((!isset($admin_payment_setting['paytm_merchant_key']) || is_null($admin_payment_setting['paytm_merchant_key'])) ? '' : $admin_payment_setting['paytm_merchant_key']); ?>" placeholder="Merchant Key">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="paytm_industry_type" class="col-form-label"><?php echo e(__('Industry Type')); ?></label>
                                                                <input type="text" name="paytm_industry_type" id="paytm_industry_type" class="form-control" value="<?php echo e((!isset($admin_payment_setting['paytm_industry_type']) || is_null($admin_payment_setting['paytm_industry_type'])) ? '' : $admin_payment_setting['paytm_industry_type']); ?>" placeholder="Industry Type">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Mollie -->
                                        <div class="accordion-item card">
                                            <h2 class="accordion-header" id="heading-2-9">
                                                <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="true" aria-controls="collapse8">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Mollie')); ?>

                                                        </span>
                                                </button>
                                            </h2>
                                            <div id="collapse8" class="accordion-collapse collapse"aria-labelledby="heading-2-9"data-bs-parent="#accordionExample" >
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-6 py-2">
                                                        </div>
                                                        <div class="col-6 py-2 text-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                <input type="hidden" name="is_mollie_enabled" value="off">
                                                                <input type="checkbox" class="form-check-input" name="is_mollie_enabled" id="is_mollie_enabled" <?php echo e((isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on') ? 'checked' : ''); ?>>
                                                                <label class="custom-control-label form-label" for="is_mollie_enabled"><?php echo e(__('Enable ')); ?></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="mollie_api_key" class="col-form-label"><?php echo e(__('Mollie Api Key')); ?></label>
                                                                <input type="text" name="mollie_api_key" id="mollie_api_key" class="form-control" value="<?php echo e((!isset($admin_payment_setting['mollie_api_key']) || is_null($admin_payment_setting['mollie_api_key'])) ? '' : $admin_payment_setting['mollie_api_key']); ?>" placeholder="Mollie Api Key">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="mollie_profile_id" class="col-form-label"><?php echo e(__('Mollie Profile Id')); ?></label>
                                                                <input type="text" name="mollie_profile_id" id="mollie_profile_id" class="form-control" value="<?php echo e((!isset($admin_payment_setting['mollie_profile_id']) || is_null($admin_payment_setting['mollie_profile_id'])) ? '' : $admin_payment_setting['mollie_profile_id']); ?>" placeholder="Mollie Profile Id">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="mollie_partner_id" class="col-form-label"><?php echo e(__('Mollie Partner Id')); ?></label>
                                                                <input type="text" name="mollie_partner_id" id="mollie_partner_id" class="form-control" value="<?php echo e((!isset($admin_payment_setting['mollie_partner_id']) || is_null($admin_payment_setting['mollie_partner_id'])) ? '' : $admin_payment_setting['mollie_partner_id']); ?>" placeholder="Mollie Partner Id">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Skrill -->
                                        <div class="accordion-item card">
                                            <h2 class="accordion-header" id="heading-2-10">
                                                <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="true" aria-controls="collapse9">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Skrill')); ?>

                                                        </span>
                                                </button>
                                            </h2>
                                            <div id="collapse9" class="accordion-collapse collapse"aria-labelledby="heading-2-10"data-bs-parent="#accordionExample" >
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-6 py-2">
                                                        </div>
                                                        <div class="col-6 py-2 text-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                <input type="hidden" name="is_skrill_enabled" value="off">
                                                                <input type="checkbox" class="form-check-input" name="is_skrill_enabled" id="is_skrill_enabled" <?php echo e((isset($admin_payment_setting['is_skrill_enabled']) && $admin_payment_setting['is_skrill_enabled'] == 'on') ? 'checked' : ''); ?>>
                                                                <label class="custom-control-label form-label" for="is_skrill_enabled"><?php echo e(__('Enable')); ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="mollie_api_key" class="col-form-label"><?php echo e(__('Skrill Email')); ?></label>
                                                                <input type="text" name="skrill_email" id="skrill_email" class="form-control" value="<?php echo e((!isset($admin_payment_setting['skrill_email']) || is_null($admin_payment_setting['skrill_email'])) ? '' : $admin_payment_setting['skrill_email']); ?>" placeholder="Enter Skrill Email">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- CoinGate -->
                                        <div class="accordion-item card">
                                            <h2 class="accordion-header" id="heading-2-11">
                                                <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('CoinGate')); ?>

                                                        </span>
                                                </button>
                                            </h2>
                                            <div id="collapse10" class="accordion-collapse collapse"aria-labelledby="heading-2-11"data-bs-parent="#accordionExample" >
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-6 py-2">
                                                        </div>
                                                        <div class="col-6 py-2 text-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                <input type="hidden" name="is_coingate_enabled" value="off">
                                                                <input type="checkbox" class="form-check-input" name="is_coingate_enabled" id="is_coingate_enabled" <?php echo e((isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on') ? 'checked' : ''); ?>>
                                                                <label class="custom-control-label form-label" for="is_coingate_enabled"><?php echo e(__('Enable ')); ?></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label class="col-form-label" for="coingate_mode"><?php echo e(__('CoinGate Mode')); ?></label> <br>
                                                            <div class="d-flex">
                                                                <div class="mr-2" style="margin-right: 15px;">
                                                                    <div class="border card p-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-labe text-dark">

                                                                                <input type="radio" name="coingate_mode" value="sandbox" class="form-check-input" <?php echo e(!isset($admin_payment_setting['coingate_mode']) || $admin_payment_setting['coingate_mode'] == '' || $admin_payment_setting['coingate_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>

                                                                                <?php echo e(__('Sandbox')); ?>

                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mr-2">
                                                                    <div class="border card p-3">
                                                                        <div class="form-check">
                                                                            <label class="form-check-labe text-dark">
                                                                                <input type="radio" name="coingate_mode" value="live" class="form-check-input" <?php echo e(isset($admin_payment_setting['coingate_mode']) && $admin_payment_setting['coingate_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                <?php echo e(__('Live')); ?>

                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="coingate_auth_token" class="col-form-label"><?php echo e(__('CoinGate Auth Token')); ?></label>
                                                                <input type="text" name="coingate_auth_token" id="coingate_auth_token" class="form-control" value="<?php echo e((!isset($admin_payment_setting['coingate_auth_token']) || is_null($admin_payment_setting['coingate_auth_token'])) ? '' : $admin_payment_setting['coingate_auth_token']); ?>" placeholder="CoinGate Auth Token">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- PaymentWall -->
                                        <div class="accordion-item card">
                                            <h2 class="accordion-header" id="heading-2-12">
                                                <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="true" aria-controls="collapse11">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('PaymentWall')); ?>

                                                        </span>
                                                </button>
                                            </h2>
                                            <div id="collapse11" class="accordion-collapse collapse"aria-labelledby="heading-2-12"data-bs-parent="#accordionExample" >
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-6 py-2">
                                                        </div>
                                                        <div class="col-6 py-2 text-end">
                                                            <div class="form-check form-switch d-inline-block">
                                                                <input type="hidden" name="is_paymentwall_enabled" value="off">
                                                                <input type="checkbox" class="form-check-input" name="is_paymentwall_enabled" id="is_paymentwall_enabled" <?php echo e((isset($admin_payment_setting['is_paymentwall_enabled']) && $admin_payment_setting['is_paymentwall_enabled'] == 'on') ? 'checked' : ''); ?>>
                                                                <label class="custom-control-label form-label" for="is_paymentwall_enabled"><?php echo e(__('Enable')); ?></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="paymentwall_public_key" class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                <input type="text" name="paymentwall_public_key" id="paymentwall_public_key" class="form-control" value="<?php echo e((!isset($admin_payment_setting['paymentwall_public_key']) || is_null($admin_payment_setting['paymentwall_public_key'])) ? '' : $admin_payment_setting['paymentwall_public_key']); ?>" placeholder="<?php echo e(__('Public Key')); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="paymentwall_private_key" class="col-form-label"><?php echo e(__('Private Key')); ?></label>
                                                                <input type="text" name="paymentwall_private_key" id="paymentwall_private_key" class="form-control" value="<?php echo e((!isset($admin_payment_setting['paymentwall_private_key']) || is_null($admin_payment_setting['paymentwall_private_key'])) ? '' : $admin_payment_setting['paymentwall_private_key']); ?>" placeholder="<?php echo e(__('Private Key')); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <div class="form-group">
                                    <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

                <!--ReCaptcha Setting-->
                <div id="useradd-4" class="card mb-3">
                    <div class="card-header">
                        <h5><?php echo e(__('ReCaptcha Setting')); ?></h5>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('recaptcha.settings.store')); ?>" accept-charset="UTF-8">
                        <?php echo csrf_field(); ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <div class=" form-switch form-switch-right">
                                    <input type="checkbox" class="form-check-input" name="recaptcha_module" id="recaptcha_module" value="yes" <?php echo e(env('RECAPTCHA_MODULE') == 'yes' ? 'checked="checked"' : ''); ?>>
                                    <label class="form-check-label" for="recaptcha_module">
                                            <?php echo e(__('Google Recaptcha')); ?>

                                        <a href="https://phppot.com/php/how-to-get-google-recaptcha-site-and-secret-key/" target="_blank" class="text-blue">
                                            <small>(<?php echo e(__('How to Get Google reCaptcha Site and Secret key')); ?>)</small>
                                        </a>
                                    </label>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="google_recaptcha_key" class="form-label"><?php echo e(__('Google Recaptcha Key')); ?></label>
                                        <input class="form-control" placeholder="<?php echo e(__('Enter Google Recaptcha Key')); ?>" name="google_recaptcha_key" type="text" value="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>" id="google_recaptcha_key">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="google_recaptcha_secret" class="form-label"><?php echo e(__('Google Recaptcha Secret')); ?></label>
                                        <input class="form-control" placeholder="<?php echo e(__('Enter Google Recaptcha Secret')); ?>" name="google_recaptcha_secret" type="text" value="<?php echo e(env('NOCAPTCHA_SECRET')); ?>" id="google_recaptcha_secret">
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-end">
                                <div class="form-group">
                                    <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                                </div>
                            </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                </div>
                
            </div>

        </div>
        <!-- [ sample-page ] end -->
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\matjar\resources\views/settings/index.blade.php ENDPATH**/ ?>