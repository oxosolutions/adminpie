<div class="form-group">
<?php echo Form::label('title', 'Enter File Name:', ['class' => 'col-lg-3 control-label']); ?>

	<div class="col-lg-9">
	<?php echo Form::text('name',null,['class' => 'form-control']); ?>

	</div>
</div>
<div class="form-group">
<?php echo Form::label('desc','Enter Description:'); ?>

	<label class="col-lg-3 control-label">Enter Description:</label>
	<div class="col-lg-9">
	<?php echo Form::file('attendance_file',null,['class' => 'form-control']); ?>

	</div>
</div>





<script type="text/javascript">
	 $('.chips').material_chip();
 
  $('.chips-placeholder').material_chip({
    placeholder: 'Enter a tag',
    secondaryPlaceholder: '+Tag',
  });
      
</script>