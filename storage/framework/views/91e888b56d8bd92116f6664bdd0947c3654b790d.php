<div class="col l9">
	
	<div class="input-field col l12">
		<?php echo Form::hidden('id',null); ?>

		<?php echo Form::text('title',null,['class'=>'validate', 'placeholder'=>'Enter the title of the page']); ?>

		<label for="first_name">Page Name</label>
    </div>
    <div class="input-field col l12">
				 <?php echo Form::select('categories', App\Model\Organization\Category::getListByTypePage(),null); ?>

	</div>
	 <div class="input-field col l12">

    <?php echo Form::text('sub_title',null, ['class'=>'form-control','placeholder'=>'Enter Page Sub-title']); ?>

		<label for="first_name">Sub Title</label>
    </div>
     <div class="input-field col l12">

    <?php echo Form::text('slug',null, ['class'=>'form-control','placeholder'=>'Enter Page Sub-title']); ?>

		<label for="first_name">Slug</label>
    </div>
    <div class="input-field col s12">
    <?php echo Form::textarea('content', null , ["class"=>"materialize-textarea"]); ?>

        <label for="textarea1">Description</label>
    </div>
   


 <?php if(!empty(@$model->page_image)): ?>
    <div class="input-group input-group-sm">
      <?php echo Form::label('page_image','Current Image'); ?><br/>
      <img src="<?php echo e(asset('pages_data/').'/'.$model->page_image); ?>" width="160px" />
    </div><br/>
    <?php else: ?>
     
    <br/>
   
  <?php endif; ?>
  

</div>
	
	

<div class=" col l3">
	<div class="card row" style="padding: 10px">
		<div class="input-field col l12">
		<?php echo Form::select('post_status',['pending'=>'Pending', 'draft'=>'Draft' , 'published'=>'published'],null,['placeholder'=>'Choose Status']); ?>

		    
		    <label>Materialize Select</label>
		</div>
		<div class="col l12">
			<a href="#" class="btn col l12">
				Preview
			</a>
			<button class="btn col l12">
				Update
			</button>
		</div>
		<div style="clear: both">
			
		</div>
	</div>
	<div class="card shadow">	
		<div class="card-content">
			<span class="card-title activator blue-text text-darken-2">Categories<i class="material-icons">priority_high</i>
				
			</span>
		    <div class="divider"></div>
		    <p class="p-20">
	      	
	      	<textarea class="chips chips-autocomplete" name="categories"> </textarea><div class="chips chips-autocomplete"></div> 
	      </p>
	    </div>
	</div>
	<div class="card shadow">	
		<div class="card-content">
			<span class="card-title activator blue-text text-darken-2">Tags<i class="material-icons">priority_high</i>
			</span>
	      <div class="divider"></div>
	      <p class="p-20">
	      	
	      	<div class="chips chips-autocomplete projects-chips"></div>
	      </p>
	    </div>
	</div>
</div>
<style type="text/css">
	button{
		position:relative;
		margin-left: 0px;
		margin-bottom: 10px
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){

		 $('.chips').material_chip();
			    $('.chips-autocomplete').material_chip({
    autocompleteOptions: {
      data: {
        'Apple': null,
        'Microsoft': null,
        'Google': null
      },
      limit: Infinity,
      minLength: 1
    }
  });

		// 	     $('.chips').on('chip.add', function(e, chip){
  //   console.log(chip.toSource+' '+e);
  // });
			    });
</script>









