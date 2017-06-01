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
       /* data  = $("#content").html();

        $("#apnd").html('');
        $("#apnd").html(data + res);
        $(".selects").material_select();  */
        data =$("#content").html();

        $("#apnd").append(data);

      }
    });
  }

</script>

{{global_draw_widget("abdd")}}
{{abc("abc working   hjdfjk")}}
<div class="card" style="margin-top: 0pc;padding: 10px">
    {!! Form::open(['route' => 'save.module']) !!}

    <div class="row">
        <div class="col l12" style="padding: 10px 0px;">
            name
        </div>
        <div class="col l12">
          <input type="text" name="name" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
        </div>
    </div>
    <div id="apnd" class="row">

        <div id="content">
            <div class="col l4 pr-7">
                <div class="col l12" style="padding: 10px 0px;">
                    Route
                </div>
                <div class="col l12">

                {!!Form::select('route[]',App\Model\Admin\GlobalModule::getRouteListArray(),null, ['class'=>'form-control sel','placeholder'=>'url ']) !!}

                </div>
            </div>
            <div class="col l4 pl-7 pr-7">
                <div class="col l12" style="padding: 10px 0px;">
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
                <div class="col l12" style="padding: 10px 0px;">
                    Route Name
                </div>
                <div class="col l12">
                    
                    <input type="text" name="route_name[]" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
                </div>
            </div>
            <div class="col l1">
                
            <i class="fa fa-trash red-text" style="line-height: 30px"></i>
            </div>
        </div>

    </div>
    <div class="row" style="padding: 10px 0px">
        <div class="col l6">
             {!! Form::submit('Save Permisson', ['class' => 'btn btn-primary']) !!}
        </div>
        <div class="col l6 right-align">
            <a onclick="apnd_row()" class="btn"><i class="fa fa-plus"></i><a>
        </div>
    </div>

 

{!! Form::close() !!}
  <div class="row">
    
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    });
</script>
<style type="text/css">
    .aione-setting-field:focus{
        border-bottom: 1px solid #a8a8a8 !important;
        box-shadow: none !important;
    }
    .select-dropdown{
        margin-bottom: 0px !important;
        border: 1px solid #a8a8a8 !important;
        
    }
    .select-wrapper input.select-dropdown{
        height: 30px;
        line-height: 30px;
    }
</style>
@endsection

