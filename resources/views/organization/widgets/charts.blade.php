@php
	$model = new App\Http\Controllers\Organization\visualization\VisualisationController(new \Illuminate\Http\Request);
    $request = new \Illuminate\Http\Request();
    $widget_settings = json_decode(get_organization_meta('widget_settings'),true);
    // $request->replace(['id'=>'21']);
@endphp
<div class="aione-widget-content">
    <div class="aione-widget-background aione-shadow"></div>
    <div class="aione-flip">
        <div class="aione-card"> 
            <div class="aione-card-face front">  
    {{-- @include('organization.widgets.includes.widget-front-start') --}}
        {{-- <div class="aione-widget-title" >{{ucfirst($widget_title)}}</div> --}}
		

        {{-- <div class="aione-widget-content-wrapper">
			<select>
				<option>chart1</option>
				<option>chart2</option>
				<option>chart3</option>
			</select>
		</div> --}}

        


		{{-- <div class="aione-widget-footer"></div> --}}
    {{-- @include('organization.widgets.includes.widget-front-end') --}}

        
                    @if(@$widget_settings[@$widget_id]['selected_chart'] != null)

                        {!! $model->embedVisualization($request,@$widget_settings[@$widget_id]['selected_chart']['visualization'],false,@$widget_settings[@$widget_id]['selected_chart']['chart']) !!} <!-- Real Code -->

                    @else
                        {!! Form::open(['route'=>'save.chart']) !!}
                        {!! Form::hidden('widget_id',@$widget_id) !!}
                        <div class="ph-50">
                            {!! Form::select('visualization',App\Model\Organization\Visualization::pluck('name','id'),null,['class'=>'browser-default visualization-widget','placeholder'=>'Select visualization']) !!}
                        </div>
                        <div class="ph-50 select_chart" style="display: none;">
                            {!! Form::select('chart',App\Model\Organization\Visualization::pluck('name','id'),null,['class'=>'browser-default selected-chart','placeholder'=>'Select chart']) !!}
                        </div>
                        <p class="font-size-18 mt-10 red no_chart_found display-none">No charts found!</p>
                        <button class="aione-button bg-light-blue bg-darken-2 white save_button display-none mb-20">Save Chart</button>
                        {!! Form::close() !!}
                    @endif
   {{--  <div>
    	<img src="https://upload.wikimedia.org/wikipedia/commons/5/55/Composition_of_38th_Parliament.png" style="width: 100px;">
    </div>
     --}}
            </div> 
            <div class="aione-card-face back"> 
                {{-- <div class="aione-widget-title">{{$widget_title}}</div> --}}
                  {!! Form::open(['route'=>'save.chart']) !!}
                        {!! Form::hidden('widget_id',@$widget_id) !!}
                        <div class="ph-50">
                            {!! Form::select('visualization',App\Model\Organization\Visualization::pluck('name','id'),null,['class'=>'browser-default visualization-widget','placeholder'=>'Select visualization']) !!}
                        </div>
                        <div class="ph-50 select_chart" style="display: none;">
                            {!! Form::select('chart',[],null,['class'=>'browser-default selected-chart','placeholder'=>'Select chart']) !!}
                        </div>
                        <p class="font-size-18 mt-10 red no_chart_found display-none">No charts found!</p>
                        <button class="aione-button bg-light-blue bg-darken-2 white save_button display-none mb-20">Save Chart</button>
                    {!! Form::close() !!}
            </div>
        </div> 
    </div>
</div>
@include('common.modal-onclick',['data'=>['modal_id'=>'select-chart','heading'=>'Select a chart','button_title'=>'Save','form'=>'widget-chart-select-form']])
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