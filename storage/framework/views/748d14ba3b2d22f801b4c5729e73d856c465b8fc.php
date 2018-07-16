
<?php $__env->startSection('content'); ?>
	<?php if(@!empty($errors)): ?>
		<script type="text/javascript">
			window.onload = function(){
                $('#add_new_model').modal('open');
            }
		</script>
	<?php endif; ?>
<?php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => __('organization/hrm.employee_list_page_title'),
	'add_new' => __('organization/hrm.employee_list_page_add_employee_button'),
  'route' => 'add.employee',
	'second_button_title' =>  __('organization/hrm.employee_list_page_export_employee_button'),
	'second_button_route' => 'export.employee',
	'third_button_title' => __('organization/hrm.employee_list_page_import_employee_button'),
	'third_button_route' => 'import.employee'
);
	 if(check_route_permisson('hrm/employee/save')==false){
	 	$page_title_data['show_add_new_button'] ='no';
	 }
?>

<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if(Session::has('import_new')): ?>
    <div class="aione-table aione-border mt-20 mb-20">
       <h4 class="light-blue darken-4 p-10 bg-grey bg-lighten-4 m-0">Employees Import Report</h4>
           <table class="">
              <thead>
                <tr>
                    <th>Action</th>
                    <th>Employee Id</th>
                    <th>E-mail</th>
                    <th>Massage</th>
                </tr>
              </thead>
               <tbody>
                 <?php $__currentLoopData = Session::get('import_new'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $vals): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <tr>
                  <td>New Employee</td>
                  <td><?php echo e($keys); ?></td>
                  <td><?php echo e($vals); ?></td>
                  <td>Upload Successfully</td>
                </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
              </tbody>
            </table>  
</div>
       
<?php endif; ?>

<?php if(Session::has('alreadyInGroupNotOrg')): ?>
       <ul>
            <li>Following User already working with other Organization Now they also associate with us.</li>
               <?php $__currentLoopData = Session::get('alreadyInGroupNotOrg'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $vals): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <li> Employee : id <?php echo e($keys); ?> ,  email <?php echo e($vals); ?> </li>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
<?php endif; ?>

<?php if(Session::has('newInsertAlreadyEmployeeId')): ?>
       <ul>
            <li>Following Record Employee Id already Assign to other employee.</li>
               <?php $__currentLoopData = Session::get('newInsertAlreadyEmployeeId'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $vals): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <li> Employee : id <?php echo e($keys); ?> ,  email <?php echo e($vals); ?> </li>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
<?php endif; ?>

<?php if(Session::has('emptyRow')): ?>
       <ul>
            <li>Following .</li>
               <?php $__currentLoopData = Session::get('emptyRow'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $vals): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <li style="color: Red; ">  <?php echo e($vals); ?> </li>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
<?php endif; ?>

<?php if(Session::has('updateRecord')): ?>
       <ul>
            <li>Following .</li>
               <?php $__currentLoopData = Session::get('updateRecord'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $vals): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <li style="color: yellow; ">  <?php echo e($vals); ?> update successfully.</li>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
<?php endif; ?>




<div class="">
    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><?php echo e(__('organization/hrm.employee_list_datatable_header_title_user')); ?></th>
                <th><?php echo e(__('organization/hrm.employee_list_datatable_header_title_employe_id')); ?></th>
                <th><?php echo e(__('organization/hrm.employee_list_datatable_header_title_name')); ?></th>
                <th><?php echo e(__('organization/hrm.employee_list_datatable_header_title_departments')); ?></th>
                <th><?php echo e(__('organization/hrm.employee_list_datatable_header_title_designation')); ?></th>
                <th><?php echo e(__('organization/hrm.employee_list_datatable_header_title_email_id')); ?></th>
                <th><?php echo e(__('organization/hrm.employee_list_datatable_header_title_created')); ?></th>
                <th><?php echo e(__('organization/hrm.employee_list_datatable_header_title_status')); ?></th>
            </tr>
        </thead>
        <!-- <tfoot>
            <tr>
                <th>User</th>
                <th>Employe ID</th>
                <th>Name</th>
                <th>Departments</th>
                <th>Designation</th>
                <th>Email ID</th>
                <th>Created</th>
                <th>Status</th>
            </tr>
        </tfoot> -->
        <tbody>
            
        </tbody>
    </table>
</div>
	
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style type="text/css">

.dataTables_filter,
.dataTables_length{
  display: inline-block;
  vertical-align: top;
}
.dataTables_filter{
  width: 70%;
}
.dataTables_length{
  width: 30%;
}
.dataTables_filter input{
  width: 97%;
  height: 36px;
  border: 1px solid #ccc;
}
.dataTable td > div > ul{
  display: none !important;
  position: absolute;
  left: 70px;
}
.dataTable td > div > ul > li{
  display: inline-block;
  margin-top: 6px;
}
.dataTable tr{
  position: relative;
}
.dataTable tr:hover td > div > ul{
  display: block !important
}
table{
    width: 100%;
    word-wrap: break-word;
    table-layout: fixed;
}
.dataTables_processing{
  padding:20px;
  background-color: white;
  position: fixed;
  top: calc(50% - 10px);
  left: calc(50% - 100px);
}
.dataTables_paginate{
  margin-top: 30px;
}
.current{
    background: #2e73aa !important;
    color: white !important;
    border: 1px solid #2e73aa !important;
}
.dataTables_paginate .previous, .dataTables_paginate .next {
    border: 1px solid #e8e8e8;
    padding: 8px 15px;
}
.dataTables_paginate .paginate_button{
    border: 1px solid #e8e8e8;
    padding: 8px 15px;
    margin: 2px;
    color: #6e6e6e;
}
.odd, .even{
    border-bottom: 1px solid #e8e8e8;
}
.sorting{                                         
  color:#2e73aa;
}
.sorting_asc, .actions{
  color:#2e73aa;
}
.actions .aione-status.active{
  
}
.actions{
  text-align: center;
}
#example{
    margin-top: 34px;
    border-top: 1px solid #e8e8e8;
}
.aione-page-content{
  margin: 34px 10px 20px 0;
}
  .aione-status.active{
        border-color: #9ccc65;
}
.aione-status{
  display: inline-block;
    box-sizing: border-box;
    width: 18px;
    height: 18px;
    border: 3px solid #ef5350;
    border-radius: 50%;
}
.aione-status.pending{
  border-color: orange;
}
</style>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>