<?php $__env->startSection('content'); ?>


<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="fade-background">

</div>
<div id="search" class="projects list-view">
  <div class="row" id="find-project">
    <div class="col s12 m12 l9 " >
      <div class="row no-margin-bottom">
        <div class="col s12 m12 l6  pr-7 tab-mt-10" >
          <!-- <input class="search aione-field" placeholder="Search" /> -->
          <nav>
              <div class="nav-wrapper">
                  <form>
                    <div class="input-field">
                        <input id="search" class="search" type="search" required style="background-color: #ffffff">
                        <label class="label-icon" for="search" style=""><i class="material-icons icon-search" >search</i></label>
                        <i class="material-icons icon-close">close</i>
                    </div>
                  </form>
              </div>
          </nav>
        </div>
        <div class="col s6 m6 l3  aione-field-wrapper pl-7 tab-mt-10">
          <div class="row aione-sort" style="">
            <select class="col  browser-default aione-field" >
              <option value="" disabled selected>Sort By</option>
              <option value="1">Name</option>
              <option value="2">Date</option>
            </select>
            <div class="col alpha-sort" style="width: 25%;padding-left:7px;">
              <a href="javascript:;" class="sort" ><i class="fa fa-sort-alpha-asc arrow_sort white" ></i></a>
            </div>
          </div>
        </div>

        <div class="col s6 m6 l3 pl-7 right-float tab-mt-10 tab-pl-10">
          <div class="row aione-switch-view">
            <ul class="right  views m-0" >
              <li class="inline-block" sty><a href="#list-view" class=" view" data-view="list-view"><i class="material-icons" >view_list</i></a></li>
              
              

              <li class="inline-block" ><a href="#detail-view" class=" view" data-view="detail-view"><i class="material-icons" >view_stream</i></a></li>


              <li class="inline-block" ><a href="#grid-view" class=" view" data-view="grid-view"><i class="material-icons" >view_module</i></a></li>
            </ul>
          </div>
        </div>
      </div>

      
     
     
     
    </div>

    <div class="col s12 m3 l3 pl-7" >
      <a id="add_new" href="" class="btn add-new display-form-button" >
        Add User
      </a>
      <div id="add_new_wrapper" class="add-new-wrapper add-form ">
        

          <div class="row no-margin-bottom">
           
            <div class="input-field col l12">
              <input placeholder="Enter user name" id="user_name" type="text" class="validate">
              <label for="user_name">Name</label>
            </div>

            <div class="input-field col l12">
              <input placeholder="Enter email" id="emailId" type="email" class="validate">
              <label for="emailId">Email</label>
            </div>

            <div class="input-field col l12">
             
              <label for="roleId">Role ID</label>
              <select>
                <option> Choose Role</option>
                <?php $__currentLoopData = $plugins['roles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($key); ?>"><?php echo e($val); ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>

            <div class="input-field col l12">
              <input placeholder="********" id="Password" type="password" class="validate">
              <label for="Password">Password</label>
            </div>

            <div class="col s12 m12 l12 aione-field-wrapper center-align">
              <a href="javascript:;" class="save_user btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save
                <i class="material-icons right">save</i>
              </a>
            </div>
          </div>
        

      </div>
     
    </div>
  </div>
  <div class="row">
    <div class="col l12">
      <div class="list" id="list">   
        
      
        
      </div> 
    </div>
     
  </div>
</div>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
  $('.add-new').off().click(function(e){
      e.preventDefault();
      $('.add-new-wrapper').toggleClass('active');
      $('.fade-background').fadeToggle(300);
    });
    
    $('.fade-background').click(function(){
      $('.fade-background').fadeToggle(300);
      $('.add-new-wrapper').toggleClass('active');
    });  
</script>
<style type="text/css">
  .input-field.col label{
        left: 0;
  }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>