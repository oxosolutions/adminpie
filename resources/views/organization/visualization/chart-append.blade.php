<li class="repeater-li">
    <div class="collapsible-header">first chart</div>
    <div class="collapsible-body">
          <div class="row mb-0">
               <label>Chart Title</label>
              <div class="col s12 m2 l12 aione-field-wrapper">
                   {!!Form::text('chart_title[chart_'.$length.']',null,['class'=>'no-margin-bottom aione-field','placeholder'=>'Chart Title'])!!}
              </div>
          </div>
          <div class="row mb-0">
              <label>Chart Type</label>
              <div class="col s12 m2 l12 aione-field-wrapper">
                  {!! Form::select('chart_type[chart_'.$length.']',App\Model\Organization\Visualization::chartTypes(),null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>'Chart Type','id'=>'chart_type'])!!}
              </div>
          </div>
          <div class="row mb-0 non-custom">
              <label>Select Variable for x-axis</label>
              <div class="col s12 m2 l12 aione-field-wrapper">
                  {!! Form::select('variable_x_axis[chart_'.$length.']',$columns,null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>''])!!}
              </div>
          </div>
          <div class="row mb-0 non-custom">
              <label>Select Variable for y-axis</label>
              <div class="col s12 m2 l12 aione-field-wrapper">
                  {!! Form::select('variable_y_axis[chart_'.$length.'][]',$columns,null,["class"=>"no-margin-bottom aione-field select_2 browser-default   ",'multiple'])!!}
              </div>
          </div>
          <div class="row mb-0 custom">
              <label>Select Map</label>
              <div class="col s12 m2 l12 aione-field-wrapper">
                  {!! Form::select('custom_map[chart_'.$length.']',App\Model\Admin\CustomMaps::getMapsList(),null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>'Select Map'])!!}
              </div>
          </div>
          <div class="row mb-0 custom">
              <label>Select area code of map</label>
              <div class="col s12 m2 l12 aione-field-wrapper">
                  {!! Form::select('area_code[chart_'.$length.']',$columns,null,["class"=>"no-margin-bottom aione-field select_2 browser-default  "])!!}
              </div>
          </div>
          <div class="row mb-0 custom">
              <label>Select data to display on map</label>
              <div class="col s12 m2 l12 aione-field-wrapper">
                  {!! Form::select('data_to_display_on_map[chart_'.$length.']',$columns,null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>'Select data to display on map'])!!}
              </div>

          </div>
          <div class="row mb-0 custom">
              <label>Value for display on tooltip</label>
              <div class="col s12 m2 l12 aione-field-wrapper">
                  {!! Form::select('tooltip_data[chart_'.$length.'][]',$columns,null,["class"=>"no-margin-bottom aione-field select_2 browser-default  ",'multiple'])!!}
              </div>
          </div>
          <div class="row mb-0 custom">
              <label>Load custom data</label>
              <div class="col s12 m2 l12 aione-field-wrapper">
                  {!! Form::select('custom_data[chart_'.$length.'][]',$columns,null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " ,'multiple'])!!}
              </div>
          </div>
          <div class="row mb-0">
              <label>Select formula</label>
              <div class="col s12 m2 l12 aione-field-wrapper">
                  {!! Form::select('formula[chart_'.$length.']',App\Model\Organization\Visualization::formulas(),null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " ])!!}
              </div>
          </div>
          <div class="row mb-0">
              <label>Chart width</label>
              <div class="col s12 m2 l12 aione-field-wrapper">
                  {!! Form::select('chart_width[chart_'.$length.']',['20'=>'20','25'=>'25','50'=>'50','75'=>'75','100'=>'100'],null,["class"=>"no-margin-bottom aione-field select_2 browser-default  "])!!}
              </div>
          </div>

    </div>
  </li>
<script type="text/javascript">
     $(document).ready(function() {
      $(".select_2").select2();
    });
</script>