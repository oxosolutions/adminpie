<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Create Campaign',
	'add_new' => '+ Add Email'
); 
 ?>	
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo Form::model(@$model,['route'=>'save.campaign','id'=>'campaign_form']); ?>

        <div class="row">
        	<div class="col l9 pr-7">
        		
    			<div class="aione-field-wrapper">
    				<div class="label">
        				Campaign Title
        			</div>
    				 <?php echo Form::text('campaign_name',null,['class'=>'no-margin-bottom aione-field','placeholder'=>'Subject']); ?>

                     <?php if($errors->has('campaign_name')): ?>
                        <span style="color: red; font-size: 12px;"><?php echo e($errors->first('campaign_name')); ?></span>
                     <?php endif; ?>
    			</div>
    			<div class="aione-field-wrapper">
    				<div class="label">
        				Campaign Description
        			</div>
    				 <?php echo Form::textarea('campaign_desc',null,['size' => '100x100','class'=>'no-margin-bottom aione-field','placeholder'=>'Message','style'=>'height:300px']); ?>

                     <?php if($errors->has('campaign_desc')): ?>
                        <span style="color: red; font-size: 12px;"><?php echo e($errors->first('campaign_desc')); ?></span>
                     <?php endif; ?>
    			</div>
    			<div>
    				<a href="" class="btn-flat">+ Add an Attachment</a>
    				
    				<button type="submit" class="btn blue" style="float: right;margin-left: 10px">Send Now</button>
    				<a href="#" data-target="schedule_later" class="btn blue" style="float: right;margin-left: 10px">Schedule Later</a>
                    
    			</div>
        	</div>  
        	<div class="col l3 pl-7">
        		<div class="card">
        			<div class="headline">User List</div>
        			<div class="content" >
                        <?php echo Form::select('send_to[]',['all'=>'All','designation'=>'By Designation','department'=>'By Department','shifts'=>'By Shifts','roles'=>'By Roles','users'=>'By Users'],null,['class'=>'filter','multiple']); ?>

    
                        <?php 
                            if(@$model != null){
                                $boxClass = (@in_array('designation',@array_keys(@$model->selected_users)))?'':'box';
                            }else{
                                $boxClass = 'box';
                            }
                         ?>
                        <?php echo Form::select('users[designation][]',$designations,@$model->selected_users['designation'],['class'=>'designation '.$boxClass,'multiple'=>'multiple']); ?>

                        <?php 
                            if(@$model != null){
                                $boxClass = (@in_array('department',@array_keys(@$model->selected_users)))?'':'box';
                            }else{
                                $boxClass = 'box';
                            }
                         ?>
                        <?php echo Form::select('users[department][]',$departments, @$model->selected_users['department'], ['class'=>'department '.$boxClass,'multiple'=>'multiple']); ?>


                        <?php 
                            if(@$model != null){
                                $boxClass = (@in_array('shifts',@array_keys(@$model->selected_users)))?'':'box';
                            }else{
                                $boxClass = 'box';
                            }
                         ?>

                        <?php echo Form::select('users[shifts][]',$departments,@$model->selected_users['shifts'],['class'=>'shifts '.$boxClass,'multiple'=>'multiple']); ?>

                        <?php 
                            if(@$model != null){
                                $boxClass = (@in_array('roles',@array_keys(@$model->selected_users)))?'':'box';
                            }else{
                                $boxClass = 'box';
                            }
                         ?>
                        <?php echo Form::select('users[roles][]',$roles,@$model->selected_users['roles'],['class'=>'roles '.$boxClass,'multiple'=>'multiple']); ?>

                        <?php 
                            if(@$model != null){
                                $boxClass = (@in_array('users',@array_keys(@$model->selected_users)))?'':'box';
                            }else{
                                $boxClass = 'box';
                            }
                         ?>
                        <?php echo Form::select('users[users][]',$users,@$model->selected_users['users'],['class'=>'users '.$boxClass,'multiple'=>'multiple']); ?>

        			</div>
        			<div class="row">
        				<div class="col l8 center-align">
        					Total User Selected
        				</div>
        				<div class="col l4 center-align">
        					<span style="font-weight:600">364</span>
        				</div>
        			</div>
        		</div>
        		<div class="card">
        			<div class="headline">Selected Layout</div>
        			<div class="content">
                        <?php echo Form::select('layout',$layouts,null,['class'=>'browser-default','placeholder'=>'Select Layout']); ?>

        				
                        <?php if($errors->has('layout')): ?>
                            <span style="color: red; font-size: 12px;"><?php echo e($errors->first('layout')); ?></span>
                        <?php endif; ?>
        			</div>
        		</div>
        		<div class="card">
        			<div class="headline">Selected Template</div>
        			<div class="content">
                        <?php echo Form::select('template',$templates,null,['class'=>'browser-default','placeholder'=>'Select Template']); ?>

                        <?php if($errors->has('template')): ?>
                            <span style="color: red; font-size: 12px;"><?php echo e($errors->first('template')); ?></span>
                        <?php endif; ?>
        			</div>
        		</div>
        	</div>  
        </div>
        <?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        	
        	<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'schedule_later','heading'=>'When you want to send this email','button_title'=>'Send','section'=>'emasec4']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        	
        <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo Form::close(); ?>

   
<style type="text/css">
	.label{
		padding: 5px 0px
	}
	
	.card .headline{
		border-bottom: 1px solid #e8e8e8;
		padding: 10px
	}
	.card .content{
		padding: 10px;
		background-color: white
	}
	.attachments{
		margin:10px 0px;
	}
	.attachments .item{
		margin-bottom: 10px;
		background-color: #f2f2f2;
		border: 1px solid #e8e8e8;
		padding: 10px
	}
	.attachments .item > i{
		float: right;
		font-size: 18px;
		color: #676767
	}
	.box{
		display: none;
	}
</style>
<script type="text/javascript">
$(".filter").change(function(){
  $("div.designation").fadeIn("fast")[ $.inArray('designation', $(this).val()) >= 0 ? 'show' : 'hide' ]();
  $("div.department").fadeIn("fast")[ $.inArray('department', $(this).val()) >= 0 ? 'show' : 'hide' ]();
  $("div.shifts").fadeIn("fast")[ $.inArray('shifts', $(this).val()) >= 0 ? 'show' : 'hide' ]();
  $("div.roles").fadeIn("fast")[ $.inArray('roles', $(this).val()) >= 0 ? 'show' : 'hide' ]();
  $("div.users").fadeIn("fast")[ $.inArray('users', $(this).val()) >= 0 ? 'show' : 'hide' ]();
});
console.log($('.filter ').html());
$(".filter").change();
$('input[name=action]').click(function(){
    $('#campaign_form').submit();
});
// selectAll();

// $('select').change(function(){

//   if($("select option[value='all']").is(':selected'))
//   {
//      $(this).selectAll();
//   }

// })

// function selectAll()
// {
//    $('select option').prop('selected', true);
//    $("select option[value='all']").prop('selected', false);
// }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>