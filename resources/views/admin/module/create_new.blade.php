@extends('admin.layouts.main')

@section('content')
<script type="text/javascript">
  $(document).ready(function(){
      
  });

  function apnd_row()
  {
    
     row = '<div class="col l4 pr-7">      <div class="col l12">        Route      </div>      <div class="col l12">        <select>                  </select>      </div>    </div>    <div class="col l4 pl-7 pr-7">      <div class="col l12">        Route For      </div>      <div class="col l12">        <select>                  </select>      </div>    </div>    <div class="col l3">      <div class="col l12">        Route Name      </div>      <div class="col l12">       <input type="text" name="">      </div>    </div>    <div class="col l1">      <i class="fa fa-minus"></i>    </div>';

     content = $("#content").html();
     console.log(content);
    $("#apnd").append(content);
  }

</script>
<div class="card" style="margin-top: 0pc;padding: 10px">
    {!! Form::open(['route' => 'save.module']) !!}

  <div class="row">
    <div class="col l12">
      name
    </div>
    <div class="col l12">
      <input type="text" name="name">
    </div>
  </div>
  <div id="apnd" class="row">

      <div id="content">
        <div class="col l4 pr-7">
          <div class="col l12">
            Route
          </div>
          <div class="col l12">

           {!!Form::select('route[]',App\Model\Admin\GlobalModule::getRouteListArray(),null, ['class'=>'form-control','placeholder'=>'url ']) !!}
          
          </div>
        </div>
        <div class="col l4 pl-7 pr-7">
          <div class="col l12">
            Route For
          </div>
          <div class="col l12">
            <select name='route_for' >
              <option value="read">Read </option>
            </select>
          </div>
        </div>
        <div class="col l3">
          <div class="col l12">
            Route Name
          </div>
          <div class="col l12">
           <input type="text" name="route_name">
          </div>
        </div>
        <div class="col l1">
          <i class="fa fa-minus"></i>
        </div>
    </div>

  </div>

  {!! Form::submit('Save Permisson', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}
  <div class="row">
    <button onclick="apnd_row()" class="btn"><i class="fa fa-plus"></i></button>
  </div>
</div>

@endsection

