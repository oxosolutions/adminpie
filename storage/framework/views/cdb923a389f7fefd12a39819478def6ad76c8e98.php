<?php $__env->startSection('content'); ?>
<?php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => __('organization/visualization.visualization_edit_page_title_text').'<span>' .get_visualization_title(request()->route()->parameters()['id']). '</span>' ,
  'add_new' => ''
); 
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo $__env->make('organization.visualization._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      	<?php echo Form::model($model,['route'=>['update.visualization' , $model['id']]]); ?>

	        <input type="hidden" name="id" value="<?php echo e($model['id']); ?>">
		    	<?php echo FormGenerator::GenerateForm('edit_visualization_form'); ?>	 
	        
	      <?php echo Form::close(); ?>

      <?php
        if(session()->has('chartsModel')){
            $chartsModel = session('chartsModel');
        }
      ?>
        <?php echo Form::model(@$chartsModel,['route'=>['save.charts',request()->route()->parameters()['id']]]); ?>

          <div class="row">
              <div class="col l8 pr-7">
                  <div class="card-v2">
                      <div class="card-v2-header">
                          <?php echo e(__('organization/visualization.available_charts')); ?>

                      </div>
                      <div class="card-v2-content" style="padding: 12px">
                          	<?php if(!empty($chartsModel)): ?>
                               	<?php echo FormGenerator::GenerateForm('available_chart_form',[],$chartsModel); ?>

                          	<?php else: ?>
                              	<?php echo FormGenerator::GenerateForm('available_chart_form',[],$columns); ?>

                          	<?php endif; ?>
                      </div>
                      <!-- <div class="card-v2-footer">
                        <a href="#" class="btn blue add-more-chart">Add more chart</a>
                      </div> -->
                  </div>
              </div>
              <div class="col l4 pl-7">
                  <div class="card-v2">
                      <div class="card-v2-header">
                          <?php echo e(__('organization/visualization.select_filterable_columns')); ?>

                      </div>
                      <div class="card-v2-content p-8">
                          	<ul class="filters">
                              	<?php if(!empty(@json_decode($filters))): ?>
                                  	<li>
                                      	<?php echo FormGenerator::GenerateForm('visualization_and_filter_chart',[],$chartsModel); ?>

                                  	</li>
                              	<?php else: ?>
                                	<li>
                                    	<div class="row">
                                        	<?php echo FormGenerator::GenerateForm('visualization_and_filter_chart'); ?>   
                                    	</div>
                                	</li>
                              	<?php endif; ?>
                          	</ul>
                      </div>
                      <div class="card-v2-footer">
                          
                      </div>
                  </div>
                 
              </div>
          </div>
          <div class="row">
              <button class="btn blue" style="float: right;"><?php echo e(__('organization/visualization.select_filterable_columns')); ?></button>
          </div>
        <?php echo Form::close(); ?>


    <?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style type="text/css">
    .card-v2{
        border: 1px solid #cfcfcf;
            color: #676767;
        margin-bottom: 14px;
    }
    .card-v2 > .card-v2-header{
       border-bottom: 1px solid #cfcfcf;
           padding: 0 15px;
    line-height: 46px;
    }
    .card-v2-footer{
      padding: 8px;
      border-top: 1px solid #cfcfcf;
      background-color: #F5F5F5;
    }
   .collapsible{
    border: none;
    box-shadow: none;
    margin: 0px
   }
   .collapsible-header{
    border-bottom: 1px solid #e8e8e8;
   }
   .collapsible-body{
    border-bottom: none;
   }
   .collapsible > li{
        border: 1px solid #e8e8e8;
        margin-bottom: 8px;
   }
   .filters .select-dropdown{
            margin-bottom: 0px !important;
   }
   .fa-close{
    display: none;
    background-color: red;
    width: 15px;
    line-height: 15px;
    text-align: center;
    color: white;
    border-radius: 3px;
    cursor: pointer;
   }
   .filters li:hover .fa-close{
    display: block
   }
   .collapsible-header > i{
       margin-right: 0px;
    font-size: 16px;
    width: 10%;
    text-align: right;
   }
   .p-8{
    padding: 8px;
   }
   .filters > li > div{
        border: 1px solid #e8e8e8;margin-bottom: 8px;padding: 8px;position: relative;
   }
   .filters > li > div > i{
       position: absolute;top:-10px;right:-5px;
   }
   .mb-0{
    margin-bottom: 0px !important;
   }
   .select2-container{
    width: 100% !important;
    margin-bottom: 10px !important
   }
  .select2-container .select2-selection--single{
        height: 50px !important;
  }
  .select2-container--default .select2-selection--single .select2-selection__rendered{
    line-height:48px !important;
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow{
        height: 48px !important;
  }
  .select2-container--default .select2-selection--single{
        border: 1px solid #E8E8E8 !important;
    border-radius: 0px !important;
  }
  .custom{
    display: none;
  }
  .select2-container--default .select2-search--inline .select2-search__field{
    width: 100% !important;
    border: none !important;
  }
  .select2-container--default .select2-selection--multiple{
        border: 1px solid #e8e8e8 !important;
    border-radius: 0px !important;
    height: 50px !important;
  }
   .aione-form-border > .aione-row{
    padding: 0 ;
  }
  .field{
    padding: 0;
  }
  #field_1696{
    display: none;

  }
</style>
<script type="text/javascript">
    //Appending the another chart div
    $('.add-more-chart').click(function(e) {
        e.preventDefault();
        var repeaterLength = $('.repeater-li').length;
        $.ajax({
                type: 'GET',
                url:  route()+'/visualization/append/<?php echo e(request()->route()->parameters()['id']); ?>/'+parseInt(repeaterLength),
                data: {},
                success: function(result){
                    $(".collapsible").append(result);
                }
            });
        
        });
    $('.collapsible').on('click', '.fa-trash', function(e) {
        e.preventDefault();

        $(this).parent().parent().remove();
    });
    //appending the another filter div 
    $('.add-filter').click(function(e) {
      
        e.preventDefault();
        console.log('2');
        $.ajax({
                type: 'GET',
                url:  route()+'/visualization/filter/<?php echo e(request()->route()->parameters()['id']); ?>',
                data: {},
                success: function(result){
                    $(".filters").append(result);
                }
            });
        });
    $('.filters').on('click', '.fa-close', function(e) {
        e.preventDefault();

        $(this).parent().remove();
    });
    //show hide divs according to the type of chart
   
    $(document).ready(function() {
      $(".select_2").select2();

       $('body').on('change','#chart_type',function () {
            if ($(this).val() == 'CustomMap') {
                $('.custom').show();
                $('.non-custom').hide();
            }
            else{
                $('.non-custom').show(); 
                $('.custom').hide();
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>