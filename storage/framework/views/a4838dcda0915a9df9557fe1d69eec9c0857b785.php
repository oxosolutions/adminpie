<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Chart Settings',
  'add_new' => ''
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('organization.visualization._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo Form::open(['route'=>['save.charts',request()->route()->parameters()['id']]]); ?>

          <div class="row">
              <div class="col l8 pr-7">
                  <div class="card-v2">
                      <div class="card-v2-header">
                          Available Charts
                      </div>
                      <div class="card-v2-content" style="padding: 8px">
                        
                          <ul class="collapsible" data-collapsible="accordion">
                              <?php if(!$charts->isEmpty()): ?>
                                <?php $__currentLoopData = $charts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chartKey => $chart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <li class="repeater-li">
                                    <input type="hidden" value="<?php echo e($chart->id); ?>" name="chart_id[chart_<?php echo e($loop->index); ?>]" />
                                    <div class="collapsible-header"><?php echo e($chart->chart_title); ?><i class="fa fa-trash"></i></div>
                                    <div class="collapsible-body">
                                          <div class="row mb-0">
                                               <label>Chart Title</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                   <?php echo Form::text('chart_title[chart_'.$loop->index.']',$chart->chart_title,['class'=>'no-margin-bottom aione-field','placeholder'=>'Chart Title']); ?>

                                              </div>
                                          </div>
                                          <div class="row mb-0">
                                              <label>Chart Type</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  <?php echo Form::select('chart_type[chart_'.$loop->index.']',App\Model\Organization\Visualization::chartTypes(),$chart->chart_type,["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>'Chart Type','id'=>'chart_type']); ?>

                                              </div>
                                          </div>
                                          <div class="row mb-0 non-custom" style="display: <?php echo e(($chart->chart_type == 'CustomMap')?'none':'block'); ?>">
                                              <label>Select Variable for x-axis</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  <?php echo Form::select('variable_x_axis[chart_'.$loop->index.']',$columns,$chart->primary_column,["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>'']); ?>

                                              </div>
                                          </div>
                                          <div class="row mb-0 non-custom" style="display: <?php echo e(($chart->chart_type == 'CustomMap')?'none':'block'); ?>">
                                              <label>Select Variable for y-axis</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  <?php echo Form::select('variable_y_axis[chart_'.$loop->index.'][]',$columns,json_decode($chart->secondary_column),["class"=>"no-margin-bottom aione-field select_2 browser-default   ",'multiple']); ?>

                                              </div>
                                          </div>
                                          <div class="row mb-0 custom" style="display: <?php echo e(($chart->chart_type == 'CustomMap')?'block':'none'); ?>">
                                              <label>Select Map</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  <?php echo Form::select('mapArea[chart_'.$loop->index.']',App\Model\Admin\CustomMaps::getMapsList(),@getMetaValue($chart->meta,'mapArea'),["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>'Select Map']); ?>

                                              </div>
                                          </div>
                                          <div class="row mb-0 custom" style="display: <?php echo e(($chart->chart_type == 'CustomMap')?'block':'none'); ?>">
                                              <label>Select area code of map</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  <?php echo Form::select('area_code[chart_'.$loop->index.']',$columns,@getMetaValue($chart->meta,'area_code'),["class"=>"no-margin-bottom aione-field select_2 browser-default  "]); ?>

                                              </div>
                                          </div>
                                          <div class="row mb-0 custom" style="display: <?php echo e(($chart->chart_type == 'CustomMap')?'block':'none'); ?>">
                                              <label>Select data to display on map</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  <?php echo Form::select('viewData[chart_'.$loop->index.']',$columns,@getMetaValue($chart->meta,'viewData'),["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>'Select data to display on map']); ?>

                                              </div>

                                          </div>
                                          <div class="row mb-0 custom" style="display: <?php echo e(($chart->chart_type == 'CustomMap')?'block':'none'); ?>">
                                              <label>Value for display on tooltip</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  <?php echo Form::select('tooltip_data[chart_'.$loop->index.'][]',$columns,json_decode($chart->secondary_column),["class"=>"no-margin-bottom aione-field select_2 browser-default  ",'multiple']); ?>

                                              </div>
                                          </div>
                                          <div class="row mb-0 custom" style="display: <?php echo e(($chart->chart_type == 'CustomMap')?'block':'none'); ?>">
                                              <label>Load custom data</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  <?php echo Form::select('customData[chart_'.$loop->index.'][]',$columns,json_decode(@getMetaValue($chart->meta,'customData')),["class"=>"no-margin-bottom aione-field select_2 browser-default  " ,'multiple']); ?>

                                              </div>
                                          </div>
                                          <div class="row mb-0">
                                              <label>Select formula</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  <?php echo Form::select('formula[chart_'.$loop->index.']',App\Model\Organization\Visualization::formulas(),@getMetaValue($chart->meta,'formula'),["class"=>"no-margin-bottom aione-field select_2 browser-default  " ]); ?>

                                              </div>
                                          </div>
                                          <div class="row mb-0">
                                              <label>Chart width</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  <?php echo Form::select('chartWidth[chart_'.$loop->index.']',['20'=>'20','25'=>'25','50'=>'50','75'=>'75','100'=>'100'],@getMetaValue($chart->meta,'chartWidth'),["class"=>"no-margin-bottom aione-field select_2 browser-default  "]); ?>

                                              </div>
                                          </div>

                                    </div>
                                  </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php else: ?>
                                <li class="repeater-li">
                                  <div class="collapsible-header">first chart</div>
                                  <div class="collapsible-body">
                                        <div class="row mb-0">
                                             <label>Chart Title</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                 <?php echo Form::text('chart_title[chart_0]',null,['class'=>'no-margin-bottom aione-field','placeholder'=>'Chart Title']); ?>

                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <label>Chart Type</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                <?php echo Form::select('chart_type[chart_0]',App\Model\Organization\Visualization::chartTypes(),null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>'Chart Type','id'=>'chart_type']); ?>

                                            </div>
                                        </div>
                                        <div class="row mb-0 non-custom">
                                            <label>Select Variable for x-axis</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                <?php echo Form::select('variable_x_axis[chart_0]',$columns,null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>'']); ?>

                                            </div>
                                        </div>
                                        <div class="row mb-0 non-custom">
                                            <label>Select Variable for y-axis</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                <?php echo Form::select('variable_y_axis[chart_0][]',$columns,null,["class"=>"no-margin-bottom aione-field select_2 browser-default   ",'multiple']); ?>

                                            </div>
                                        </div>
                                        <div class="row mb-0 custom">
                                            <label>Select Map</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                <?php echo Form::select('custom_map[chart_0]',App\Model\Admin\CustomMaps::getMapsList(),null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>'Select Map']); ?>

                                            </div>
                                        </div>
                                        <div class="row mb-0 custom">
                                            <label>Select area code of map</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                <?php echo Form::select('area_code[chart_0]',$columns,null,["class"=>"no-margin-bottom aione-field select_2 browser-default  "]); ?>

                                            </div>
                                        </div>
                                        <div class="row mb-0 custom">
                                            <label>Select data to display on map</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                <?php echo Form::select('data_to_display_on_map[chart_0]',$columns,null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>'Select data to display on map']); ?>

                                            </div>

                                        </div>
                                        <div class="row mb-0 custom">
                                            <label>Value for display on tooltip</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                <?php echo Form::select('tooltip_data[chart_0][]',$columns,null,["class"=>"no-margin-bottom aione-field select_2 browser-default  ",'multiple']); ?>

                                            </div>
                                        </div>
                                        <div class="row mb-0 custom">
                                            <label>Load custom data</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                <?php echo Form::select('custom_data[chart_0][]',$columns,null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " ,'multiple']); ?>

                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <label>Select formula</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                <?php echo Form::select('formula[chart_0]',App\Model\Organization\Visualization::formulas(),null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " ]); ?>

                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <label>Chart width</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                <?php echo Form::select('chart_width[chart_0]',['20'=>'20','25'=>'25','50'=>'50','75'=>'75','100'=>'100'],null,["class"=>"no-margin-bottom aione-field select_2 browser-default  "]); ?>

                                            </div>
                                        </div>

                                  </div>
                                </li>
                              <?php endif; ?>
                          </ul>
                          <div>
                              <a href="#" class="btn blue add-more-chart">Add more chart</a>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col l4 pl-7">
                  <div class="card-v2">
                      <div class="card-v2-header">
                          Select filterable columns
                      </div>
                      <div class="card-v2-content p-8">
                          <ul class="filters">
                              <?php if(!empty(@json_decode($filters))): ?>
                                <?php $__currentLoopData = json_decode($filters); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <li>
                                      <div class="row">
                                          <div class="col l6 pr-7">
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  <?php echo Form::select('filter_columns[]',$columns,$filter->column,["class"=>"no-margin-bottom aione-field " , 'placeholder'=>'Column']); ?>

                                              </div>
                                          </div>
                                          <div class="col l6">
                                                <div class="col s12 m2 l12 aione-field-wrapper">
                                                  <?php echo Form::select('filter_type[]',App\Model\Organization\Visualization::filterTypes(),$filter->type,["class"=>"no-margin-bottom aione-field " , 'placeholder'=>'Filter Type']); ?>

                                              </div>
                                          </div>        
                                      </div>
                                  </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php else: ?>
                                <li>
                                    <div class="row">
                                        <div class="col l6 pr-7">
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                <?php echo Form::select('filter_columns[]',$columns,null,["class"=>"no-margin-bottom aione-field " , 'placeholder'=>'Column']); ?>

                                            </div>
                                        </div>
                                        <div class="col l6">
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                <?php echo Form::select('filter_type[]',App\Model\Organization\Visualization::filterTypes(),null,["class"=>"no-margin-bottom aione-field " , 'placeholder'=>'Filter Type']); ?>

                                            </div>
                                        </div>        
                                    </div>
                                </li>
                              <?php endif; ?>
                          </ul>
                          <div>
                              <a href="#" class="btn blue add-filter">Add more filters</a>
                          </div>
                      </div>
                  </div>
                 
              </div>
          </div>
          <div class="row">
              <button class="btn blue" style="float: right;">Submit</button>
          </div>
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
    float: right;margin-right: 0px;font-size: 16px
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