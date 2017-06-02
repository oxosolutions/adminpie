@extends('admin.layouts.main')
@section('content')
<div class="card" style="margin-top: 0pc;padding: 10px">

{{global_draw_widget("yes its workingggg")}}
    {!! Form::open(['route' => 'create.widget']) !!}

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
        <div class="col l12">
          {!! Form::text('module_id',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']) !!}
        </div>
    </div>
    <div class="row">
        <div class="col l12" style="padding: 10px 0px;">
            Model
        </div>
        <div class="col l12">
          {!! Form::text('title',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']) !!}
        </div>
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

