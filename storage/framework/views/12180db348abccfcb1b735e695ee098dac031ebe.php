<?php 
	$model = new App\Http\Controllers\Organization\visualization\VisualisationController(new \Illuminate\Http\Request);
    $request = new \Illuminate\Http\Request();
    $widget_settings = json_decode(get_organization_meta('widget_settings'),true);
    // $request->replace(['id'=>'21']);
 ?>
<div class="aione-widget-content">
    <div class="aione-widget-background aione-shadow"></div>
    <div class="aione-flip">
        <div class="aione-card"> 
            <div class="aione-card-face front">  
    
        
		

        

        


		
    

        
                    <?php if(@$widget_settings[@$widget_id]['selected_chart'] != null): ?>

                        <?php echo $model->embedVisualization($request,@$widget_settings[@$widget_id]['selected_chart']['visualization'],false,@$widget_settings[@$widget_id]['selected_chart']['chart']); ?> <!-- Real Code -->

                    <?php else: ?>
                        <?php echo Form::open(['route'=>'save.chart']); ?>

                        <?php echo Form::hidden('widget_id',@$widget_id); ?>

                        <div class="ph-50">
                            <?php echo Form::select('visualization',App\Model\Organization\Visualization::pluck('name','id'),null,['class'=>'browser-default visualization-widget','placeholder'=>'Select visualization']); ?>

                        </div>
                        <div class="ph-50 select_chart" style="display: none;">
                            <?php echo Form::select('chart',App\Model\Organization\Visualization::pluck('name','id'),null,['class'=>'browser-default selected-chart','placeholder'=>'Select chart']); ?>

                        </div>
                        <p class="font-size-18 mt-10 red no_chart_found display-none">No charts found!</p>
                        <button class="aione-button bg-light-blue bg-darken-2 white save_button display-none mb-20">Save Chart</button>
                        <?php echo Form::close(); ?>

                    <?php endif; ?>
   
            </div> 
            <div class="aione-card-face back"> 
                
                  <?php echo Form::open(['route'=>'save.chart']); ?>

                        <?php echo Form::hidden('widget_id',@$widget_id); ?>

                        <div class="ph-50">
                            <?php echo Form::select('visualization',App\Model\Organization\Visualization::pluck('name','id'),null,['class'=>'browser-default visualization-widget','placeholder'=>'Select visualization']); ?>

                        </div>
                        <div class="ph-50 select_chart" style="display: none;">
                            <?php echo Form::select('chart',[],null,['class'=>'browser-default selected-chart','placeholder'=>'Select chart']); ?>

                        </div>
                        <p class="font-size-18 mt-10 red no_chart_found display-none">No charts found!</p>
                        <button class="aione-button bg-light-blue bg-darken-2 white save_button display-none mb-20">Save Chart</button>
                    <?php echo Form::close(); ?>

            </div> 
        </div> 
    </div>
</div>
<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'select-chart','heading'=>'Select a chart','button_title'=>'Save','form'=>'widget-chart-select-form']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('body').on('change','.visualization-widget select', function(){
            var visual_id = $(this).val();
            $.ajax({
                type:'GET',
                url:route()+'/charts-list',
                data: {visualization: visual_id },
                success: function(result){
                    if(Object.keys(result).length > 0){
                        $('.select_chart').slideDown(300);
                        $('.no_chart_found').slideUp();
                        var chart_options = '<option value="">Select Charts</option>';
                        $.each(result,function(key, value){
                            chart_options += '<option value="'+key+'">'+value+'</option>';
                        });
                        $('.select_chart select').html(chart_options);
                    }else{
                        $('.no_chart_found').slideDown();
                        $('.select_chart').slideUp(300);
                    }
                }
            });
        });

        $('.selected-chart').change(function(){
            if($(this).val().trim() != '' && $(this).val().trim() != null){
                $('.save_button').slideDown(300);
            }else{
                $('.save_button').slideUp(300);
            }
        });
    });
</script>