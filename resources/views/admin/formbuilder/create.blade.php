@extends('admin.layouts.main')
@section('content')

<div>
  <div class="card" style="margin-top: 0px;padding: 14px">  

 
    <div class="row">
        <h5 style="margin-top: 0px">Add new Form</h5>

    </div>
    <div class="row">
    {!! Form::open([ 'method' => 'POST', 'route' => 'create.forms' ,'class' => 'form-horizontal']) !!}
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Form name
           </div>
           <div class="col l9">
              {{--  <input type="text" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px "> --}}
                {!! Form::text('form_title',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ']) !!}
                
           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Slug
           </div>
           <div class="col l9">
              {{--  <input type="text" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px "> --}}
                {!! Form::text('form_slug',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ']) !!}
           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Form Description
           </div>
           <div class="col l9">
              {{--  <textarea id="textarea1" class="materialize-textarea" style="border:1px solid #a8a8a8;margin-bottom: 0px;"></textarea> --}}
                {!! Form::textarea('form_description',null,['rows' => '5' ,'class' => 'materialize-textarea' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']) !!}
           </div>
        </div>
         @if(@$errors->has())
          @foreach($errors->all() as $kay => $err)
            <div style="color: red">{{$err}}</div>
          @endforeach
        @endif
        <div class="row pv-10">
           <div class="col l12 right-align">
            <button type="submit" class="btn btn-primary blue">Save</button>
           </div>
        </div>
       
     
    {!! Form::close() !!} 
    </div>
    
</div>
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
</div>
@endsection
