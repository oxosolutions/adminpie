  

<div id="content" >
        <div class="col l4 pr-7">
          <div class="col l12">
            Route
          </div>
          <div class="col l12">

           {!!Form::select('route[]',App\Model\Admin\GlobalModule::getRouteListArray(),null, ['id'=>'start',  'class'=>'form-control selects','placeholder'=>'url ']) !!}
          
          </div>
        </div>
        <div class="col l4 pl-7 pr-7">
          <div class="col l12">
            Route For
          </div>
          <div class="col l12">
            <select name='route_for[]' class="selects" >
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
        <div class="col l1 remove_row">
          <i class="fa fa-minus"></i>
        </div>
    </div>