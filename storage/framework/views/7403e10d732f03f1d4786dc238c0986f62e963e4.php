<div class="form-group">
<?php echo Form::label('name', 'Enter Client Name:', ['class' => 'col-lg-3 control-label']);; ?>

	
	<div class="col-lg-9">
	<?php echo Form::text('name',null,['class' => 'form-control']); ?>

		
	</div>
</div>

<div class="form-group">
<?php echo Form::label('name', 'Enter Company Name:', ['class' => 'col-lg-3 control-label']);; ?>

	
	<div class="col-lg-9">
	<?php echo Form::text('company_name',null,['class' => 'form-control']); ?>

		
	</div>
</div>

<div class="form-group">
<?php echo Form::label('email','Email' , ['class' => 'col-lg-3 control-label']); ?>

	<div class="col-lg-9">

		<?php echo Form::text('email',null,['class' => 'form-control'  ]); ?>


	</div>
</div>
<div class="form-group">
<?php echo Form::label('password','Password' , ['class' => 'col-lg-3 control-label']); ?>

	<div class="col-lg-9">

		<?php echo Form::password('password',null,['class' => 'form-control'  ]); ?>


	</div>
</div>
<div class="form-group">
<?php echo Form::label('adrs','Country' , ['class' => 'col-lg-3 control-label']); ?>

	<div class="col-lg-9">

	<?php echo Form::select('country', ['IND' => 'India', 'CAN' => 'Canada'], null, [ 'class' => 'form-control' ,'placeholder' => 'select country.']); ?>


	</div>
</div>
<div class="form-group">
<?php echo Form::label('adrs','State' , ['class' => 'col-lg-3 control-label']); ?>

	<div class="col-lg-9">

	<?php echo Form::select('state', ['Pb' => 'punjab', 'HRY' => 'harayana'], null, [ 'class' => 'form-control' ,'placeholder' => 'select State.']); ?>


	</div>
</div>
<div class="form-group">
<?php echo Form::label('adrs','City' , ['class' => 'col-lg-3 control-label']); ?>

	<div class="col-lg-9">

	<?php echo Form::select('city', ['ASR' => 'Amritsar', 'KAR' => 'Karnal'], null, [ 'class' => 'form-control' ,'placeholder' => 'select City']); ?>


	</div>
</div>
<div class="form-group">
<?php echo Form::label('adrs','Address' , ['class' => 'col-lg-3 control-label']); ?>

	<div class="col-lg-9">

		<?php echo Form::text('address',null,['class' => 'form-control'  ]); ?>


	</div>
</div>
<div class="form-group">
<?php echo Form::label('phone','phone' , ['class' => 'col-lg-3 control-label']); ?>

	<div class="col-lg-9">

		<?php echo Form::text('phone',null,['class' => 'form-control'  ]); ?>


	</div>
</div>
<div class="form-group">
<?php echo Form::label('adrs','Additional information' , ['class' => 'col-lg-3 control-label']); ?>

	<div class="col-lg-9">

		<?php echo Form::textarea('additional_info',null,['class' => 'form-control'  ]); ?>


	</div>
</div>





<script type="text/javascript">
	 $('.chips').material_chip();
 
  $('.chips-placeholder').material_chip({
    placeholder: 'Enter a tag',
    secondaryPlaceholder: '+Tag',
  });
      
</script>