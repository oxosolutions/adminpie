
<?php $__env->startSection('content'); ?>

<style type="text/css">
  .add-field-icon{
    color: #7A9BBE;
      padding: 6px;
      margin-left: 10px;
  }
  .add-field-icon i{
        transform: rotate(272deg);
  }
  .add-field-desc{ 
    font-family: Comic Sans MS, sans-serif !important;
    color: #7A9BBE;
    font-size: 12px;
    height: 13px;
    line-height: 1em;
    text-shadow: 0 1px 0 #FFFFFF;
  }
  .add-field-content button{
    float: right;
      margin-right: 13px;
  }
  .field-title {
    font-weight: 700;
  }
  .field-description {
    font-size: 12px;
    color: #696969;
}
input{
  margin-bottom: 0px !important;

}
</style>
<!-- main-content-->

<?php 
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Fields',
    'add_new' => '+ Add Designation'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="card" style="margin-top: 0px;">
	<div class="content-wrapper">
  <?php if(!empty($model)): ?>
      <?php echo Form::open(['route'=>['update.field','form_id'=>request()->form_id,'section_id'=>request()->section_id]]); ?>

  <?php else: ?>
      <?php echo Form::open(['route'=>['form.store','form_id'=>request()->form_id,'section_id'=>request()->section_id]]); ?>

  <?php endif; ?>
		<section class="section-header">
		
			<div>
            <div class="bordered centered" style="background-color: transparent;">
                <div>
                  <div class="top-header row" style="background-color: #24425C;color: white;padding: 15px 10px">
                    <div class="col l2" >Field Order</div>
                    <div class="left-align col l4 ">Field Label</div>
                    <div class="col l4">Field Slug </div>
                    <div class="col l2">Field Type</div>
                  </div>
                </div>
                <?php  $index = 1; $rowCount=0; $slug = [];  ?>
                <div style="color: red;font-size:20px;padding: 10px"><?php echo e(ucfirst(Session::get('sameSlugmessage'))); ?></div>
                 <?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('admin.formbuilder._row',$value, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php  $index++; $rowCount++;  ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 <div class="form-rows">
                   
                 </div>
            </div>
			</div>
			<div>
				<p>No fields. Click the + Add Field button to create your first field. </p>
			</div>
			<div class="row" style="background-color: #EAF2FA;padding: 9px;">
				<div class="col l10">
					<span class="add-field-icon"><i class="fa fa-share" aria-hidden="true"></i></span>
					<span class="add-field-desc">Drag and drop to reorder</span>
				</div>
				<div class="col l2 add-field-content">
					<button class="btn add-row" type="button">Add Field</button>
				</div>
			</div>
      <div class="row">
        <div class="col l12" style="margin: 15px">
          <button class=" btn" type="submit">Save Field</button>  
        </div>
        
      </div>
      
		</section>
  <?php echo Form::close(); ?>

	</div>
</div>
    <?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style type="text/css">
  .options{
    display: none;
   position: absolute;
   margin: 0 auto;
   margin-top: 20px;
   left: 20%;
  }
  .option-trigger:hover .options{
    display: block;
  }

</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>