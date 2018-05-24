<?php $__env->startSection('content'); ?>

<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => __('organization/hrm.employee_import_page_title'),
	'add_new' => '',

	
); 

$body_text="";
 ?>

<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if(Session::has('import_new')): ?>
               	<?php 
                 foreach(Session::get('import_new') as $keys => $vals) {
                	$body_text .="<tr> <td>Employee Added</td> <td>".$keys."</td> <td>".$vals."</td> <td>Record added successfully	</td> </tr>";
 					}
                ?>
<?php endif; ?>
<?php if(Session::has('in_valid_date_format')): ?>
                <?php 
                 foreach(Session::get('in_valid_date_format') as $keys => $vals) {
                  $body_text .="<tr> <td>Error Occurred</td> <td>".$keys."</td> <td>".$vals."</td> <td>Invalid Date format </td></tr>";
          }
                ?>
<?php endif; ?>


<?php if(Session::has('alreadyInGroupNotOrg')): ?>
				<?php 
                 foreach(Session::get('alreadyInGroupNotOrg') as $keys => $vals) {
                	$body_text .="<tr> <td>Employee Updated</td> <td>".$keys."</td> <td>".$vals."</td> <td> User associated with this organization</td> </tr>";
 					}
                ?>
      
<?php endif; ?>

<?php if(Session::has('newInsertAlreadyEmployeeId')): ?>
				<?php 
                 foreach(Session::get('newInsertAlreadyEmployeeId') as $keys => $vals) {
                	$body_text .="<tr> <td>Error Occurred </td> <td>".$keys."</td> <td>".$vals."</td> <td>Duplicate Employee ID </td> </tr>";
 					}
                ?>
       
<?php endif; ?>

<?php if(Session::has('emptyRow')): ?>
				<?php 
                 foreach(Session::get('emptyRow') as $keys => $vals) {
                	$body_text .="<tr> <td>Error Occurred </td><td> </td> <td></td> <td>".$vals."Missing required values </td> </tr>";
 					}
                ?>
       
<?php endif; ?>

<?php if(Session::has('updateRecord')): ?>
				<?php 
                 foreach(Session::get('updateRecord') as $keys => $vals) {
                	$body_text .="<tr> <td>Employee updated</td> <td>".$keys."</td> <td>".$vals."</td> <td>Record updated successfully</td> </tr>";
 					}
                ?>
       
<?php endif; ?>
<?php if(Session::has('import_new') || Session::has('alreadyInGroupNotOrg') || Session::has('emptyRow') || Session::has('updateRecord') || Session::has('in_valid_date_format')): ?>
<div class="aione-table aione-border mt-20 mb-20">
       <h4 class="light-blue darken-4 p-10 bg-grey bg-lighten-4 m-0">Employees Import Report</h4>
<table class="compact">
              <thead>
                <tr>
                    <th>Action</th>
                    <th>Employee Id</th>
                    <th>E-mail</th>
                    <th>Message</th>
                </tr>
              </thead>
               <tbody>
               	<?php echo $body_text; ?>

               </tbody>
           </table>
     </div>
<?php endif; ?>







<?php echo Form::open(['route'=>'import.employee.post' , 'class'=> 'form-horizontal','method' => 'post','files'=>true]); ?>


		<div class="row no-margin-bottom">
			<?php echo FormGenerator::GenerateForm('import_employees_form'); ?>

		</div>
	<?php if(Session::get('errors')): ?>
		<?php echo e(dump(Session::get('errors'))); ?>

	<?php endif; ?>
<?php echo Form::close(); ?>

<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>