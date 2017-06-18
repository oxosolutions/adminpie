<div class="box-body">
  <div class="form-group <?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
    <?php echo Form::label('name','name'); ?>

    <?php echo Form::text('name',null, ['class'=>'form-control','placeholder'=>'Enter Role Name']); ?>

    <?php if($errors->has('name')): ?>
      <span class="help-block">
            <?php echo e($errors->first('name')); ?>

      </span>
    <?php endif; ?>
  </div>

  <div class="form-group <?php echo e($errors->has('role_description') ? ' has-error' : ''); ?>">
    <?php echo Form::label('role_description','Description'); ?>

    <?php echo Form::textarea('description',null,['class'=>'form-control','placeholder'=>'Optional Description','id'=>'role_description']); ?>

    <?php if($errors->has('role_description')): ?>
      <span class="help-block">
            <?php echo e($errors->first('role_description')); ?>

      </span>
    <?php endif; ?>
  </div>


</div>

<style type="text/css">
  .file-actions{
      float: right;
  }
  .file-upload-indicator{
     display: none;
  }
  .select2-selection__choice{

      background-color: #3c8dbc !important;
  }
  .select2-selection__choice__remove{

      color: #FFF !important;
  }
</style>

<!-- /.box-body -->
