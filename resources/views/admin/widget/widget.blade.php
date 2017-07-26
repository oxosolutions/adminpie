@extends('admin.layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Create Widget',
    'add_new' => '+ Add Designation'
); 
@endphp
@include('common.pageheader',$page_title_data) 
<div class="card" style="margin-top: 0pc;padding: 10px">
@php
$url = url()->current();
@endphp

@if(str_contains($url,'edit'))

    {!! Form::model($data,['route' => 'edit.widget']) !!}
    <input type="hidden" name="id" value="{{$id}}">
@else
    {!! Form::open(['route' => 'create.widget']) !!}
@endif

    <div class="row">
        <div class="col l12" style="padding: 10px 0px;">
            title
        </div>
        <div class="col l12">
          {!! Form::text('title',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']) !!}
        </div>
    </div>
     <div class="row">
        <div class="col l12" style="padding: 10px 0px;">
            slug
        </div>
        <div class="col l12">
          {!! Form::text('slug',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']) !!}
        </div>
    </div>
     <div class="row">
        <div class="col l12" style="padding: 10px 0px;">
            Module
        </div>
       {!! Form::select('module_id',array_add($module_data,0,'default module'),@$data->module_id,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']) !!}
    </div>
    <div class="col s12 m2 l12 " style="padding: 10px 0px">
                            Description
                        </div>
                        <div class="col s12 m2 l12 " style="padding: 10px 0px">
                            {!! Form::textarea('description',null,['rows' => '10' ,'class' => 'materialize-textarea', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']) !!}
                        </div>
      
    <div class="row" style="padding: 10px 0px">
        <div class="col l6">
             {!! Form::submit('Save Widget', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
{!! Form::close() !!}
</div>
<style type="text/css">
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

