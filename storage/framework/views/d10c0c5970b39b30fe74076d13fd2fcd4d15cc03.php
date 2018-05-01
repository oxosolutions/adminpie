<?php $__env->startSection('content'); ?>
<?php 
  $page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Salary',
  ); 
    $id = "";
   $user_count    = count($data['users']);
   $salary_count  = count(array_filter( array_column($data['users']->toArray(), 'salary')));
   $body_text = "";
   
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php if(Session::has('error_payscale')): ?>
  <?php 
    foreach(Session::get('error_payscale') as $keys => $vals) {
    $body_text .="<tr> <td>Pay-scale Error </td><td>".$vals."</td> <td>Pay-scale is not defined</td> </tr>";
    }
   ?>

<?php endif; ?>
<?php if(Session::has('error_attendance')): ?>
  <?php 
    foreach(Session::get('error_attendance') as $keys => $vals) {
    $body_text .="<tr> <td>Attendance Error</td><td>".$vals."</td> <td>Attendance does not exist.</td> </tr>";
    }
   ?>
<?php endif; ?>
<?php if(Session::has('salary_successfully_generate')): ?>
  <?php 
    foreach(Session::get('salary_successfully_generate') as $keys => $vals) {
    $body_text .="<tr> <td>Success</td><td>".$vals."</td> <td>Salary slip generated successfully.</td> </tr>";
    }
   ?>
<?php endif; ?>
<?php if(Session::has('already_generate')): ?>
  <?php 
    foreach(Session::get('already_generate') as $keys => $vals) {
    $body_text .="<tr> <td>Error</td><td>".$vals."</td> <td>Salary slip already generated .</td> </tr>";
    }
   ?>
<?php endif; ?>
<?php if(Session::has('unlock_error')): ?>
  <?php 
    foreach(Session::get('unlock_error') as $keys => $vals) {
    $body_text .="<tr> <td>Error</td><td>".$vals."</td> <td>You have to verify attendance then lock it & after that generate salary work out.</td> </tr>";
    }
   ?>
<?php endif; ?>


<?php if(Session::has('error_payscale') || Session::has('error_attendance') || Session::has('unlock_error') || Session::has('already_generate')  ): ?>
  <div class="aione-table aione-border mt-20 mb-20">
       <h4 class="light-blue darken-4 p-10 bg-grey bg-lighten-4 m-0">Salary  Error</h4>
    <table class="compact">
      <thead>
        <tr>
            <th>Action</th>
            <th>Employee Id</th>
            <th>Message</th>
        </tr>
      </thead>
       <tbody>
        <?php echo $body_text; ?>

       </tbody>
    </table>
</div>
<?php endif; ?> 
<div>
<?php echo Form::open(['route'=>'hrm.generate.salary_view']); ?>

<section class="aione-border mb-20">
  <div class="ar">
    <div class="ac s100 m100 l100 p-0">
      <div class="">
        <h5 class="pl-20 font-weight-400 m-0 pv-15">
                  Select
            </h5>
      </div>
  </div>
</div>
<div class="ar mt-10">
  <div class="ac s100 m100 l33">
    <div id="aione_form_section_374" class="aione-form-section non-repeater p-5">
              <div id="field_fields" class="field-wrapper field-wrapper-fields field-wrapper-type-select ">
              <div id="field_label_select_status" class="field-label">
               
              </div>
              <div id="field_fields" class="field w100 field-type-select">
                <?php echo Form::selectRange('year' , 2013,date('Y') , $data['year'], ['placeholder'=>'Select year' , 'class'=>'browser-default select']); ?>

              </div>
            </div>
          </div> 
  </div>
  <div class="ac s100 m100 l33">
     <div id="aione_form_section_374" class="aione-form-section non-repeater p-5">
        <div id="field_fields" class="field-wrapper field-wrapper-fields field-wrapper-type-select ">
        <div id="field_label_select_status" class="field-label">
          
        </div>
        <div id="field_fields" class="field field-type-select">
            <?php echo Form::selectMonth('month', $data['month'], ['placeholder'=>'Select year' , 'class'=>'browser-default select']);; ?>               
        </div>
      </div>
    </div> 
  </div>
  <div class="ac s100 m100 l33">
    <div class="aione-row search-options aione-align-left mt-3">
      <button type="submit" class=" p-10 " name="Search" style="width: 100%;">Submit</button>
    </div>
  </div>
</div>
  </section>




</div>
<div class="aione-tables">
<?php if(isset($data['users']) && !empty($data['users'])): ?>
 
   <table>
        <thead>
            <tr>
                <th class="bg-grey bg-lighten-3 white aione-align-center">
                <?php if($user_count != $salary_count): ?>
                  <input type="checkbox"  id="selectAll">
                <?php endif; ?>

                </th>
                <th colspan="2" class="bg-grey bg-lighten-3 aione-align-center"> Name</th>
            </tr>
        </thead>
        <tbody>
       
        <?php $__currentLoopData = $data['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php if(empty($value->metas->where('key','date_of_joining')->first())): ?>
            <?php continue; ?>
          <?php endif; ?>
           

          <?php if(!empty($value->metas->where('key','date_of_joining')->first()) && strtotime($value->metas->where('key','date_of_joining')->first()->value) > strtotime($data['year'].'-'.$data['month'].'-1')): ?>
            <?php continue; ?>
          <?php endif; ?>

           <?php if(!empty($value->metas->where('key','date_of_leaving')->first()) && strtotime($value->metas->where('key','date_of_leaving')->first()->value) < strtotime($data['year'].'-'.$data['month'].'-1')): ?>
            <?php continue; ?>
          <?php endif; ?>
            <tr>
                <td class="light-blue darken-4 aione-align-center">
                  <?php if(empty($value['salary'])): ?>
                      <input type="checkbox" name="user_select[]" value="<?php echo e($value->id); ?>">
                    <?php else: ?>
                    <a href="<?php echo e(route('salary.slip.edit',['id'=>$value['salary']['id']])); ?>"> Edit Salaray</a> |
                    <a href="<?php echo e(route('salary.slip.download',['id'=>$value['salary']['id']])); ?>"> download pdf</a> |
                      <a href="<?php echo e(route('salary.slip.view',['id'=>$value['salary']['id']])); ?>">    View    </a> |
                      <a href="<?php echo e(route('salary.slip.delete',['id'=>$value['salary']['id']])); ?>">  Delete  </a> |
                  <?php endif; ?>
                </td>
                <td ><?php echo e($value['name']); ?></td>
                <td > <?php echo e($value->metas->where('key','date_of_joining')->first()->value); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <?php if($user_count != $salary_count): ?>
         <div class="ar aione-border mb-10">
           <div class="ac s100 m100 l60">
             <h5 class="mt-21">Select the employee to generate salary slips</h5>
           </div>
            <div class="ac s100 m100 l40">
               <div class="aione-row search-options aione-align-right mv-10">
                <button type="submit" class="p-10 " name="generate_salary" value="Generate Salary 1" style="width: 70%;">Generate Salary slips</button>
              </div>
           </div>
         </div>
            
          
          <?php endif; ?>
        </tbody>
    </table>
    <?php echo Form::close(); ?>

<?php endif; ?>
 <script>
	$(document).ready(function(){

		$('#selectAll').click(function(e){
    		var table= $(e.target).closest('table');
    		$('td input:checkbox',table).prop('checked',this.checked);
		});


	});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>