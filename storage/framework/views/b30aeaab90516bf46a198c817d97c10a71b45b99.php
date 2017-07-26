<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Visualization Settings',
  'add_new' => ''
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('organization.visualization._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo Form::model($model,['route'=>['visualization.settings.save',request()->route()->parameters()['id']] , 'method' => 'post']); ?>

    	 <div class="card-v2">
            <div class="card-v2-header">
                Visualization Settings
            </div>
            <div class="card-v2-content">
                <div class="row" style="margin-bottom: 0px">
                    <div class="col l6 aione-setting-list" style="border-right:2px solid #f2f2f2">
                        
                        <?php echo FormGenerator::GenerateSection('vizsec1',['type'=>'inline']); ?>

                    </div>
                    <div class="col l6 aione-setting-list">
                      
                        <?php echo FormGenerator::GenerateSection('vizsec2',['type'=>'inline']); ?>

                    </div>
                </div>
                
            </div>
        </div>
        <button class="btn blue">Save Settings</button>
      <?php echo Form::close(); ?>          

                                 
                
             
      <?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style type="text/css">
    .card-v2{
        border: 2px solid #f2f2f2;
        box-shadow: 0px 0px 1px rgba(128, 128, 128, .2);
        margin-bottom: 14px;
    }
    .card-v2 > .card-v2-header{
        background-color: #f2f2f2;
        padding: 10px;
    }
    .lever{
        margin-top: -4px !important
    }
    .aione-setting-list > div{
      border-bottom: 1px solid #e0e0e0
    }
</style>
<script type="text/javascript">
  $(document).ready(function(){
      $('.checkbox').click(function(){
        $(this).find('input[type=checkbox]').prop('checked', function(){
              return !this.checked;
          });
      });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>