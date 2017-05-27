<style type="text/css">
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
