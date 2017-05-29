@extends('admin.layouts.main')

@section('content')
@php
   $option ="";
  $data = App\Model\Admin\GlobalModule::getRouteListArray();
  foreach ($data as $key => $value) {
    $option .="<option value='$key'>$value</option>";
}
  
$sel ="<select>$option</select>";

echo $sel;
@endphp
<script type="text/javascript">
  $(document).ready(function(){
      // $('select').material_select();

    $(document).on('click','.remove_row',function(e){
      $(this).parent().remove();
    });
      
  });



  function apnd_row()
  {

   // $("#content").clone().appendTo("#apnd");
   var res="";
    $.ajax({
      url:route()+"/module/add_route_row",
      type:'GET',
      success: function(res){
                //alert(res);
        data  = $("#apnd").html();
        $("#apnd").html('');
        $("#apnd").html(data + res);
        $(".selects").material_select();  
      }
    });
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

           {!!Form::select('route[]',App\Model\Admin\GlobalModule::getRouteListArray(),null, ['class'=>'form-control sel','placeholder'=>'url ']) !!}
          
          </div>
        </div>
        <div class="col l4 pl-7 pr-7">
          <div class="col l12">
            Route For
          </div>
          <div class="col l12">
            <select name='route_for[]' >
              <option value="read">Read </option>
              <option value="write">Write </option>
              <option value="delete">Delete </option>
            </select>
          </div>
        </div>
        
        <div class="col l3">
          <div class="col l12">
            Route Name
          </div>
          <div class="col l12">
           <input type="text" name="route_name[]">
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
<script type="text/javascript">
  $(document).ready(function(){
    });
</script>
@endsection

