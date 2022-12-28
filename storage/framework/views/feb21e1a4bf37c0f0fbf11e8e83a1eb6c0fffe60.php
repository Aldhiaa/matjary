<?php echo e(Form::open(array('url' => 'plans', 'enctype' => "multipart/form-data"))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control font-style','placeholder'=>__('Enter Plan Name'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('price',__('Price'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('price',null,array('class'=>'form-control','placeholder'=>__('Enter Plan Price')))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('duration', __('Duration'),['class'=>'form-label'])); ?>

            <?php echo Form::select('duration', $arrDuration, null,array('class' => 'form-control select','required'=>'required')); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('max_users',__('Maximum Users'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('max_users',null,array('class'=>'form-control','required'=>'required'))); ?>

            <span class="small"><?php echo e(__('Note: "-1" for Unlimited')); ?></span>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('max_customers',__('Maximum Customers'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('max_customers',null,array('class'=>'form-control','required'=>'required'))); ?>

            <span class="small"><?php echo e(__('Note: "-1" for Unlimited')); ?></span>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('max_venders',__('Maximum Venders'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('max_venders',null,array('class'=>'form-control','required'=>'required'))); ?>

            <span class="small"><?php echo e(__('Note: "-1" for Unlimited')); ?></span>
        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'),['class'=>'form-label'])); ?>

            <?php echo Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']); ?>

        </div>
    
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\matjar\resources\views/plan/create.blade.php ENDPATH**/ ?>