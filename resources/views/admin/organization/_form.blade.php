{{-- <style type="text/css">
  .textarea{
    background-color: transparent;
    border: none;
    border-bottom: 1px solid #9e9e9e;
    border-radius: 0;
    outline: none;
    width: 100%;
    font-size: 1rem;
    margin: 0 0 20px 0;
    padding: 0;
    box-shadow: none;
    box-sizing: content-box;
    transition: all 0.3s;
  }
  .textarea:focus:not([readonly]){
    border-bottom: 1px solid #26a69a;
    box-shadow: 0 1px 0 0 #26a69a;
  }
</style>
<div class="card" style="margin-top: 0px;">
  <div class="card-content">
      <div class="form-group">
        <label class="col-lg-2 control-label">Organization Title</label>
        <div class="col-lg-9">
          {!! Form::text('name',null,['class' => 'form-control' , 'placeholder' => 'Enter Organization Title']) !!}
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-2 control-label">Organization Description</label>
        <div class="col-lg-9">
          {!! Form::textarea('description',null,['rows' => '5' ,'class' => 'form-control textarea', 'placeholder' => 'Some description']) !!}
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-2 control-label">Email</label>
        <div class="col-lg-9">
          {!! Form::email('email',null,['class' => 'form-control' , 'placeholder' => 'Enter Email']) !!}    
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-2 control-label">Password</label>
        <div class="col-lg-9">
          {!! Form::password('password',null,['class' => 'form-control' , 'placeholder' => 'Enter Password']) !!}    
        </div>
      </div>
    </div>
  </div>
 --}}
<div>  
    <div class="row">
        <h5 style="margin-top: 0px">Add new Organization</h5>
        @if(@$errors->has())
           @foreach ($errors->all() as $error)
              <div style="color:red;">{{ $error }}</div>
          @endforeach
        @endif
    </div>
    <div class="row">
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Organization Title
           </div>
           <div class="col l9">
               {{-- <input type="text" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
 --}}               {!! Form::text('name',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']) !!}
           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Slug
           </div>
           <div class="col l9">
              {{--  <textarea id="textarea1" class="materialize-textarea" style="border:1px solid #a8a8a8;margin-bottom: 0px;"></textarea> --}}
               {!! Form::text('slug',null,[ 'class' => 'aione-setting-field', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']) !!}
           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Primary Domain
           </div>
           <div class="col l9">
              {{--  <textarea id="textarea1" class="materialize-textarea" style="border:1px solid #a8a8a8;margin-bottom: 0px;"></textarea> --}}
               {!! Form::text('primary_domain',null,['class' => 'aione-setting-field', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']) !!}
           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Seondary Domains
           </div>
           <div class="col l9">
              {{--  <textarea id="textarea1" class="materialize-textarea" style="border:1px solid #a8a8a8;margin-bottom: 0px;"></textarea> --}}
               {!! Form::text('secondary_domains',null,['class' => 'aione-setting-field', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']) !!}
           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
              Modules
           </div>
           <div class="col l9">
              {{--  <textarea id="textarea1" class="materialize-textarea" style="border:1px solid #a8a8a8;margin-bottom: 0px;"></textarea> --}}

             {{--  @foreach($modules as $moduleKey => $moduleVal)
              {
               {{ Form::label($moduleVal, null, ['class' => 'control-label']) }}
                {!! Form::checkbox('modules[]', 'moduleKey', true) !!}
              }
              @endforeach --}}
                  
               {!! Form::select('modules[]',$modules,null,['multiple'=>'multiple', 'class' => 'browser-default', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']) !!}
             


           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Organization Description
           </div>
           <div class="col l9">
              {{--  <textarea id="textarea1" class="materialize-textarea" style="border:1px solid #a8a8a8;margin-bottom: 0px;"></textarea> --}}
               {!! Form::textarea('description',null,['rows' => '5' ,'class' => 'materialize-textarea', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']) !!}
           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Email
           </div>
           <div class="col l9">
              {{--  <input type="email" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px "> --}}
               {!! Form::email('email',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px; ']) !!} 
           </div>
        </div>

      @if(!str_contains(url()->current(), 'edit'))
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Password
           </div>
           <div class="col l9">
               {{-- <input type="password" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px "> --}}
                {!! Form::password('password',['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px; ']) !!}
           </div>
          
        </div>


         <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
              Confirm Password
           </div>
           <div class="col l9">
               {{-- <input type="password" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px "> --}}
                {!! Form::password('confirm_password',['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px; ']) !!}
           </div>
          
        </div>
      @endif
       
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
