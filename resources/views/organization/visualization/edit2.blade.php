@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Chart Settings',
  'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)

@include('common.pagecontentstart')

    @include('common.page_content_primary_start')
      @include('organization.visualization._tabs')
         {{-- {{dd($charts)}} --}}
        {!!Form::model(@$model,['route'=>['save.charts',request()->route()->parameters()['id']]])!!}
          <div class="row">
              <div class="col l8 pr-7">
                  <div class="card-v2">
                      <div class="card-v2-header">
                          Available Charts
                      </div>
                      <div class="card-v2-content" style="padding: 12px">
                        
                          
                              @if(!$charts->isEmpty())
                                @foreach($charts as $chartKey => $chart)
                                 
                                    {{-- <input type="hidden" value="{{$chart->id}}" name="chart_id[chart_{{$loop->index}}]" />
                                    <div class="collapsible-header"><div style="width: 90%;">{{$chart->chart_title}}</div><i class="fa fa-trash"></i></div>
                                    <div class="collapsible-body"> --}}
                                        {{--   <div class="row mb-0">
                                               <label>Chart Title</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                   {!!Form::text('chart_title[chart_'.$loop->index.']',$chart->chart_title,['class'=>'no-margin-bottom aione-field','placeholder'=>'Chart Title'])!!}
                                              </div>
                                          </div>
                                          <div class="row mb-0">
                                              <label>Chart Type</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  {!! Form::select('chart_type[chart_'.$loop->index.']',App\Model\Organization\Visualization::chartTypes(),$chart->chart_type,["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>'Chart Type','id'=>'chart_type'])!!}
                                              </div>
                                          </div>
                                          <div class="row mb-0 non-custom" style="display: {{($chart->chart_type == 'CustomMap')?'none':'block'}}">
                                              <label>Select Variable for x-axis</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  {!! Form::select('variable_x_axis[chart_'.$loop->index.']',$columns,$chart->primary_column,["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>''])!!}
                                              </div>
                                          </div>
                                          <div class="row mb-0 non-custom" style="display: {{($chart->chart_type == 'CustomMap')?'none':'block'}}">
                                              <label>Select Variable for y-axis</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  {!! Form::select('variable_y_axis[chart_'.$loop->index.'][]',$columns,json_decode($chart->secondary_column),["class"=>"no-margin-bottom aione-field select_2 browser-default   ",'multiple'])!!}
                                              </div>
                                          </div>
                                          <div class="row mb-0 custom" style="display: {{($chart->chart_type == 'CustomMap')?'block':'none'}}">
                                              <label>Select Map</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  {!! Form::select('mapArea[chart_'.$loop->index.']',App\Model\Admin\CustomMaps::getMapsList(),@getMetaValue($chart->meta,'mapArea'),["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>'Select Map'])!!}
                                              </div>
                                          </div>
                                          <div class="row mb-0 custom" style="display: {{($chart->chart_type == 'CustomMap')?'block':'none'}}">
                                              <label>Select area code of map</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  {!! Form::select('area_code[chart_'.$loop->index.']',$columns,@getMetaValue($chart->meta,'area_code'),["class"=>"no-margin-bottom aione-field select_2 browser-default  "])!!}
                                              </div>
                                          </div>
                                          <div class="row mb-0 custom" style="display: {{($chart->chart_type == 'CustomMap')?'block':'none'}}">
                                              <label>Select data to display on map</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  {!! Form::select('viewData[chart_'.$loop->index.']',$columns,@getMetaValue($chart->meta,'viewData'),["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>'Select data to display on map'])!!}
                                              </div>

                                          </div>
                                          <div class="row mb-0 custom" style="display: {{($chart->chart_type == 'CustomMap')?'block':'none'}}">
                                              <label>Value for display on tooltip</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  {!! Form::select('tooltip_data[chart_'.$loop->index.'][]',$columns,json_decode($chart->secondary_column),["class"=>"no-margin-bottom aione-field select_2 browser-default  ",'multiple'])!!}
                                              </div>
                                          </div>
                                          <div class="row mb-0 custom" style="display: {{($chart->chart_type == 'CustomMap')?'block':'none'}}">
                                              <label>Load custom data</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  {!! Form::select('customData[chart_'.$loop->index.'][]',$columns,json_decode(@getMetaValue($chart->meta,'customData')),["class"=>"no-margin-bottom aione-field select_2 browser-default  " ,'multiple'])!!}
                                              </div>
                                          </div>
                                          <div class="row mb-0">
                                              <label>Select formula</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  {!! Form::select('formula[chart_'.$loop->index.']',App\Model\Organization\Visualization::formulas(),@getMetaValue($chart->meta,'formula'),["class"=>"no-margin-bottom aione-field select_2 browser-default  " ])!!}
                                              </div>
                                          </div>
                                          <div class="row mb-0">
                                              <label>Chart width</label>
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  {!! Form::select('chartWidth[chart_'.$loop->index.']',['20'=>'20','25'=>'25','50'=>'50','75'=>'75','100'=>'100'],@getMetaValue($chart->meta,'chartWidth'),["class"=>"no-margin-bottom aione-field select_2 browser-default  "])!!}
                                              </div>
                                          </div>
      --}}                                       {!! FormGenerator::GenerateForm('available_chart_form',[],$columns) !!}
                                   {{--  </div> --}}
                                  
                                @endforeach
                              @else
                                
                                 
                                  		 {!! FormGenerator::GenerateForm('available_chart_form',[],$columns) !!}
                                        {{-- <div class="row mb-0">
                                             <label>Chart Title</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                 {!!Form::text('chart_title[chart_0]',null,['class'=>'no-margin-bottom aione-field','placeholder'=>'Chart Title'])!!}
                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <label>Chart Type</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                {!! Form::select('chart_type[chart_0]',App\Model\Organization\Visualization::chartTypes(),null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>'Chart Type','id'=>'chart_type'])!!}
                                            </div>
                                        </div>
                                        <div class="row mb-0 non-custom">
                                            <label>Select Variable for x-axis</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                {!! Form::select('variable_x_axis[chart_0]',$columns,null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>''])!!}
                                            </div>
                                        </div>
                                        <div class="row mb-0 non-custom">
                                            <label>Select Variable for y-axis</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                {!! Form::select('variable_y_axis[chart_0][]',$columns,null,["class"=>"no-margin-bottom aione-field select_2 browser-default   ",'multiple'])!!}
                                            </div>
                                        </div>
                                        <div class="row mb-0 custom">
                                            <label>Select Map</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                {!! Form::select('custom_map[chart_0]',App\Model\Admin\CustomMaps::getMapsList(),null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>'Select Map'])!!}
                                            </div>
                                        </div>
                                        <div class="row mb-0 custom">
                                            <label>Select area code of map</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                {!! Form::select('area_code[chart_0]',$columns,null,["class"=>"no-margin-bottom aione-field select_2 browser-default  "])!!}
                                            </div>
                                        </div>
                                        <div class="row mb-0 custom">
                                            <label>Select data to display on map</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                {!! Form::select('data_to_display_on_map[chart_0]',$columns,null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>'Select data to display on map'])!!}
                                            </div>

                                        </div>
                                        <div class="row mb-0 custom">
                                            <label>Value for display on tooltip</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                {!! Form::select('tooltip_data[chart_0][]',$columns,null,["class"=>"no-margin-bottom aione-field select_2 browser-default  ",'multiple'])!!}
                                            </div>
                                        </div>
                                        <div class="row mb-0 custom">
                                            <label>Load custom data</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                {!! Form::select('custom_data[chart_0][]',$columns,null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " ,'multiple'])!!}
                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <label>Select formula</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                {!! Form::select('formula[chart_0]',App\Model\Organization\Visualization::formulas(),null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " ])!!}
                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <label>Chart width</label>
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                {!! Form::select('chart_width[chart_0]',['20'=>'20','25'=>'25','50'=>'50','75'=>'75','100'=>'100'],null,["class"=>"no-margin-bottom aione-field select_2 browser-default  "])!!}
                                            </div>
                                        </div> --}}

                                  
                              @endif
                         
                          {{-- <div>
                              <a href="#" class="btn blue add-more-chart">Add more chart</a>
                          </div> --}}
                      </div>
                      <div class="card-v2-footer">
                        <a href="#" class="btn blue add-more-chart">Add more chart</a>
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
                              @if(!empty(@json_decode($filters)))
                                @foreach(json_decode($filters) as $key => $filter)
                                  <li>
                                     {{--  <div class="row">
                                          <div class="col l6 pr-7">
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                  {!! Form::select('filter_columns[]',$columns,$filter->column,["class"=>"no-margin-bottom aione-field " , 'placeholder'=>'Column'])!!}
                                              </div>
                                          </div>
                                          <div class="col l6">
                                                <div class="col s12 m2 l12 aione-field-wrapper">
                                                  {!! Form::select('filter_type[]',App\Model\Organization\Visualization::filterTypes(),$filter->type,["class"=>"no-margin-bottom aione-field " , 'placeholder'=>'Filter Type'])!!}
                                              </div>
                                          </div>        
                                      </div> --}}
                                      {!! FormGenerator::GenerateForm('visualization_and_filter_chart') !!}
                                  </li>
                                @endforeach
                              @else
                                <li>
                                    <div class="row">
                                       {{--  <div class="col l6 pr-7">
                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                {!! Form::select('filter_columns[]',$columns,null,["class"=>"no-margin-bottom aione-field " , 'placeholder'=>'Column'])!!}
                                            </div>
                                        </div>
                                        <div class="col l6">
                                              <div class="col s12 m2 l12 aione-field-wrapper">
                                                {!! Form::select('filter_type[]',App\Model\Organization\Visualization::filterTypes(),null,["class"=>"no-margin-bottom aione-field " , 'placeholder'=>'Filter Type'])!!}
                                            </div>
                                        </div>      --}}
                                        {!! FormGenerator::GenerateForm('visualization_and_filter_chart') !!}   
                                    </div>
                                </li>
                              @endif
                          </ul>
                          {{-- <div>
                              <a href="#" class="btn blue add-filter">Add more filters</a>
                          </div> --}}
                      </div>
                      <div class="card-v2-footer">
                          <a href="#" class="btn blue add-filter">Add more filters</a>
                      </div>
                  </div>
                 
              </div>
          </div>
          <div class="row">
              <button class="btn blue" style="float: right;">Submit</button>
          </div>
        {!!Form::close()!!}

    @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
{{--     	@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Visualization','button_title'=>'Save & Next','section'=>'vissec1']]) --}}
    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
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
</style>
<script type="text/javascript">
    //Appending the another chart div
    $('.add-more-chart').click(function(e) {
        e.preventDefault();
        var repeaterLength = $('.repeater-li').length;
        $.ajax({
                type: 'GET',
                url:  route()+'/visualization/append/{{request()->route()->parameters()['id']}}/'+parseInt(repeaterLength),
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
                url:  route()+'/visualization/filter/{{request()->route()->parameters()['id']}}',
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
@endsection