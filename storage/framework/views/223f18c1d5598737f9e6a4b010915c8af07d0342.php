<?php $__env->startSection('content'); ?>
<?php 
   $option ="";
    $data = App\Model\Admin\GlobalModule::getRouteListArray();
    foreach ($data as $key => $value) {
    $option .="<option value='$key'>$value</option>";
}
 ?>

    <div class="card" style="margin-top: 0px;padding: 10px">
        <?php echo Form::open(['route' => ['save.submodule',request()->route()->parameters()['module_id']]]); ?>


        <div class="row">
            <div class="col l12" style="padding: 10px 0px;">
                name
            </div>
            <div class="col l12">
              <input type="text" name="name" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
            </div>
        </div>
        <div id="apnd" class="row">

            

        </div>
        <div class="row" style="padding: 10px 0px">
            <div class="col l6">
                 <?php echo Form::submit('Save Permission', ['class' => 'btn btn-primary']); ?>

            </div>
            <div class="col l6 right-align">
                <a onclick="apnd_row()" class="btn"><i class="fa fa-plus"></i><a>
            </div>
        </div>

     

        <?php echo Form::close(); ?>

          <div class="row">
            
          </div>
    </div>

<style type="text/css">
    .aione-setting-field:focus{
        border-bottom: 1px solid #a8a8a8 !important;
        box-shadow: none !important;
    }
    .select-dropdown{
        margin-bottom: 0px !important;
        border: 1px solid #a8a8a8 !important;
        
    }
    .select-wrapper input.select-dropdown{
        height: 30px;
        line-height: 30px;
    }
    .display-block{
        display: block !important;
    }
    .select-wrapper{
    	
    }
    .select-dropdown{
    }
</style>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>