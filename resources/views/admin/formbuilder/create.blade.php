@if(Auth::guard('admin')->check())
  @php
    $layout = 'admin.layouts.main';
    $route = 'create.forms';
  @endphp
@else
  @php
    $layout = 'layouts.main';
    $route = 'org.create.forms';
  @endphp
@endif
@extends($layout)
@section('content')
@php
$title = (@$type == 'form')?'Add New Form':'Add New Survey';
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => $title,
    'add_new' => 'All Forms',
    'route' => 'list.forms'
    
); 
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
  
    <div class="row">
    {!! Form::open([ 'method' => 'POST', 'route' => $route ,'class' => 'form-horizontal']) !!}
    {!! FormGenerator::GenerateForm('add_survey_form') !!}
       {{--  <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Form name
           </div>
           <div class="col l9">
             
                {!! Form::text('form_title',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ']) !!}
                
           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Slug
           </div>
           <div class="col l9">
              
                {!! Form::text('form_slug',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ']) !!}
           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Form Description
           </div>
           <div class="col l9">
              
                {!! Form::textarea('form_description',null,['rows' => '5' ,'class' => 'materialize-textarea' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']) !!}
           </div>
        </div> --}}
       {{--  <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Form Type
           </div>
           <div class="col l9">
              
                {!! Form::select('type',['form'=>'Form','survey'=>'Survey'],null,["class"=>"no-margin-bottom aione-field browser-default"])!!}
           </div>
        </div> --}}
        <input type="hidden" name="type" value="{{@$type}}">
         @if(@$errors->has())
          @foreach($errors->all() as $kay => $err)
            <div style="color: red">{{$err}}</div>
          @endforeach
        @endif
       {{--  <div class="row pv-10">
           <div class="col l12 right-align">
            <button type="submit" class="btn btn-primary blue">Save</button>
           </div>
        </div> --}}
       
     
    {!! Form::close() !!} 
    </div>
    @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')

    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
<style type="text/css">
    .h-30{
        height: 30px;
    }
    
    .pv-10{
        padding:10px 0px
    }
    .aione-setting-field:focus{
        border-bottom: 1px solid #a8a8a8 !important;
        box-shadow: none !important;
    }
    textarea{
        border-bottom: 1px solid #a8a8a8 !important;
        box-shadow: none !important;
    }
</style>

@endsection
