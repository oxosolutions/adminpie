@extends('admin.layouts.main')
@section('content')
{{-- 
<style type="text/css">
  .add-field-icon{
    color: #7A9BBE;
      padding: 6px;
      margin-left: 10px;
  }
  .add-field-icon i{
        transform: rotate(272deg);
  }
  .add-field-desc{ 
    font-family: Comic Sans MS, sans-serif !important;
    color: #7A9BBE;
    font-size: 12px;
    height: 13px;
    line-height: 1em;
    text-shadow: 0 1px 0 #FFFFFF;
  }
  .add-field-content button{
    float: right;
      margin-right: 13px;
  }
  .field-title {
    font-weight: 700;
  }
  .field-description {
    font-size: 12px;
    color: #696969;
  }
  th{
    border-radius: 0px ;
  }
  input{
    margin-bottom: 0px !important;

  }
</style>
{!!Form::open(['route'=>'form.store'])!!}
  <!-- main-content-->
  <div class="card" style="margin-top: 0px">
    <div class="row" style="background-color: #24425C;color: white;padding: 15px 10px;font-weight: bold;">
      Form details
    </div>
    <div class="row  valign-wrapper" style="padding: 10px;">
      <div class="col l3 " style="margin-top: 15px">
        <h6>Form name</h6>
      </div>
      <div class="col l9">
        <input type="text" name="form_name" value="" />
      </div>
    </div>
    <div class="row" style="padding: 10px;">
      <div class="col l3" style="margin-top: 15px">
        <h6>Enter slug name</h6>
      </div>
      <div class="col l9">
        <input type="text" name="form_slug" value="" />
      </div>
    </div>
  </div>
  <div class="card" style="margin-top: 0px;">
  	<div class="content-wrapper">
  		<section class="section-header">
  			<div>
          <div class="bordered centered " style="background-color: transparent;">
              <div>
                <div class="row " style="background-color: #24425C;color: white;padding: 15px 10px;">
                  <div class="col l2" >Field Order</div>
                  <div class=" col l4" >Field Label</div>
                  <div class="col l4">Field Name </div>
                  <div class="col l2">Field Type</div>
                </div>
              </div>
              <div class="form-rows sortable">
                
              </div>
          </div>
  			</div>
  			<div>
  				<p>No fields. Click the + Add Field button to create your first field. </p>
  			</div>
  			<div class="row" style="background-color: #EAF2FA;padding: 9px;">
  				<div class="col l10">
  					<span class="add-field-icon"><i class="fa fa-share" aria-hidden="true"></i></span>
  					<span class="add-field-desc">Drag and drop to reorder</span>
  				</div>
  				<div class="col l2 add-field-content">
  					<button class="btn add-row" type="button">Add Field</button>
  				</div>
  			</div>
        <div class="row">
          <div class="col l12" style="margin: 15px">
            <button class=" btn" type="submit">Save survey</button>  
          </div>
        </div>
  		</section>
  	</div>
  </div>
{!!Form::close()!!}
<style type="text/css">
  .options{
    display: none;
   position: absolute;
   margin: 0 auto;
   margin-top: 20px;
   
  }
  .option-trigger:hover .options{
    display: block;
  }
</style> --}}
<div>
  <div>  
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
                {!! Form::textarea('form_description',null,['rows' => '5' ,'class' => 'materialize-textarea', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']) !!}
           </div>
        </div>
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
