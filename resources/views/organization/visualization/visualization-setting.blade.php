@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => __('organization/visualization.visualization_settings_page_title_text').'<span>' .get_visualization_title(request()->route()->parameters()['id']). '</span>' ,
  'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)

@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
    @include('organization.visualization._tabs')
      {!! Form::model($model,['route'=>['visualization.settings.save',request()->route()->parameters()['id']] , 'method' => 'post']) !!}
    	 {{-- <div class="card-v2">
            <div class="card-v2-header">
                Visualization Settings
            </div>
            <div class="card-v2-content">
                <div class="row" style="margin-bottom: 0px">
                    <div class="col l6 aione-setting-list" style="border-right:2px solid #f2f2f2">
                        
                        {!!FormGenerator::GenerateSection('vizsec1',['type'=>'inline'])!!}
                    </div>
                    <div class="col l6 aione-setting-list">
                      
                        {!!FormGenerator::GenerateSection('vizsec2',['type'=>'inline'])!!}
                    </div>
                </div>
                
               
            </div>
        </div> --}}
         {!!FormGenerator::GenerateForm('vizz')!!}
        {{-- <button class="btn blue">Save Settings</button> --}}
      {!!Form::close()!!}          

                                 
                
             
      @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
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
@endsection