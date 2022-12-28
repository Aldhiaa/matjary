<?php echo e(Form::open(array('url'=>'roles','method'=>'post'))); ?>

<div class="modal-body">

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Role Name')))); ?>

                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <small class="invalid-name" role="alert">
                    <strong class="text-danger"><?php echo e($message); ?></strong>
                </small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php if(!empty($permissions)): ?>
                    <h6 class="my-3"><?php echo e(__('Assign Permission to Roles')); ?></h6>
                    <table class="table  mb-0" id="dataTable-1">
                        <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="form-check-input align-middle" name="checkall"  id="checkall" >
                            </th>
                            <th><?php echo e(__('Module')); ?> </th>
                            <th><?php echo e(__('Permissions')); ?> </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $modules=['dashboard','user','role','proposal','invoice','bill','revenue','payment','proposal product','invoice product','bill product','goal','credit note','debit note','bank account','transfer','transaction','product & service','customer','vender','plan','constant tax','constant category','constant unit','constant custom field','company settings','assets','chart of account','journal entry','report'];
                           if(\Auth::user()->type == 'super admin'){
                               $modules[] = 'language';
                               $modules[] = 'permission';
                           }
                        ?>
                        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><input type="checkbox" class="form-check-input align-middle ischeck"  data-id="<?php echo e(str_replace(' ', '', $module)); ?>" ></td>
                                <td><label class="ischeck" data-id="<?php echo e(str_replace(' ', '', $module)); ?>"><?php echo e(ucfirst($module)); ?></label></td>

                                <td>
                                    <div class="row ">
                                        <?php if(in_array('manage '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('manage '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Manage',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('create '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('create '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Create',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('edit '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('edit '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Edit',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('delete '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('delete '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Delete',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('show '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('show '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Show',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>


                                        <?php if(in_array('buy '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('buy '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Buy',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('send '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('send '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Send',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if(in_array('create payment '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('create payment '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Create Payment',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('delete payment '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('delete payment '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Delete Payment',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('income '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('income '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Income',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('expense '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('expense '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Expense',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('income vs expense '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('income vs expense '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Income VS Expense',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('loss & profit '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('loss & profit '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Loss & Profit',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('tax '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('tax '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Tax',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>


                                        <?php if(in_array('invoice '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('invoice '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Invoice',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('bill '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('bill '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Bill',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('duplicate '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('duplicate '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Duplicate',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('balance sheet '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('balance sheet '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Balance Sheet',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('ledger '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('ledger '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Ledger',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(in_array('trial balance '.$module,(array) $permissions)): ?>
                                            <?php if($key = array_search('trial balance '.$module,$permissions)): ?>
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])); ?>

                                                    <?php echo e(Form::label('permission'.$key,'Trial Balance',['class'=>'form-check-label'])); ?><br>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>


<script>
    $(document).ready(function () {
        $("#checkall").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $(".ischeck").click(function(){
            var ischeck = $(this).data('id');
            $('.isscheck_'+ ischeck).prop('checked', this.checked);
        });
    });
</script>

<?php /**PATH D:\Dhiaa\matjar\resources\views/role/create.blade.php ENDPATH**/ ?>