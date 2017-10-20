<div>
    <div class="row">
        
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
                {!! Form::text('name',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']) !!}
           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Slug
           </div>
           <div class="col l9">
             
               {!! Form::text('slug',null,[ 'class' => 'aione-setting-field', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']) !!}
           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Primary Domain
           </div>
           <div class="col l9">
             
               {!! Form::text('primary_domain',null,['class' => 'aione-setting-field', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']) !!}
           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Seondary Domains
           </div>
           <div class="col l9">
             
               {!! Form::text('secondary_domains',null,['class' => 'aione-setting-field', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']) !!}
           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
              Modules
           </div>
           <div class="col l9">
            @php
              $selectedModule['module'] =null;
              if(!empty($org_data)){
                if(!empty($org_data['modules'])){
                 $selectedModule['module'] = array_map('intval', json_decode($org_data['modules']));
                }
              }
              // else{
              //   $selectedModule['module'] = array_map('intval',Session::get('module_data'));
              // }
            @endphp
               {!! Form::select('modules[]',$modules, $selectedModule['module'],['multiple'=>'multiple', 'class' => '', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']) !!}
             </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Organization Description
           </div>
           <div class="col l9">
             
               {!! Form::textarea('description',null,['rows' => '5' ,'class' => 'materialize-textarea', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']) !!}
           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Email
           </div>
           <div class="col l9">
              
               {!! Form::email('email',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px; ']) !!} 
           </div>
        </div>

      @if(!str_contains(url()->current(), 'edit'))
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Password
           </div>
           <div class="col l9">
             
                {!! Form::password('password',['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px; ']) !!}
           </div>
          
        </div>


         <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
              Confirm Password
           </div>
           <div class="col l9">
             
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
<script type="text/javascript">
  $(document).ready(function(){
    $('select').material_select();
  })
  
</script>
