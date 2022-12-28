<?php echo e(Form::open(array('url' => 'coupons','method' =>'post'))); ?>

    <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-12">
                <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('name',null,array('class'=>'form-control font-style','required'=>'required'))); ?>

            </div>

            <div class="form-group col-md-6">
                <?php echo e(Form::label('discount',__('Discount'),['class'=>'form-label'])); ?>

                <?php echo e(Form::number('discount',null,array('class'=>'form-control','required'=>'required','step'=>'0.01'))); ?>

                <span class="small"><?php echo e(__('Note: Discount in Percentage')); ?></span>
            </div>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('limit',__('Limit'),['class'=>'form-label'])); ?>

                <?php echo e(Form::number('limit',null,array('class'=>'form-control','required'=>'required'))); ?>

            </div>


            <div class="form-group col-md-12">
                <?php echo e(Form::label('code',__('Code'),['class'=>'form-label'])); ?>

                <div class="d-flex radio-check">
                    <div class="form-check form-check-inline form-group col-md-6">
                        <input type="radio" id="manual_code" value="manual" name="icon-input" class="form-check-input code" checked="checked">
                        <label class="custom-control-label " for="manual_code"><?php echo e(__('Manual')); ?></label>
                    </div>
                    <div class="form-check form-check-inline form-group col-md-6">
                        <input type="radio" id="auto_code" value="auto" name="icon-input" class="form-check-input code">
                        <label class="custom-control-label" for="auto_code"><?php echo e(__('Auto Generate')); ?></label>
                    </div>
                </div>
            </div>
            
            <div class="form-group col-md-12 d-block" id="manual">
                <input class="form-control font-uppercase" name="manualCode" type="text">
            </div>
            <div class="form-group col-md-12 d-none" id="auto">
                <div class="row">
                    <div class="col-md-10">
                        <input class="form-control" name="autoCode" type="text" id="auto-code">
                    </div>
                    <div class="col-md-2">
                        <a href="#" class="btn btn-primary" id="code-generate"><i class="ti ti-history"></i></a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\matjar\resources\views/coupon/create.blade.php ENDPATH**/ ?>