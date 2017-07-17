<div class="row repeat-sub-row">
    <div class="col s12 m2 l12 aione-field-wrapper" style="border: 1px solid #e8e8e8;padding: 14px; margin-top: 1%;">

        <div class="row valign-wrapper">
            <div class="col l5 pr-7">
                <label>Route name</label>
                <input type="text" name="submodule[{{$count}}][perm_route_name][]" value="" placeholder="Enter route name" />
            </div>
            <div class="col l6 pl-7 pr-7">
                <label>Route</label>
                {!!Form::select('submodule['.$count.'][perm_route][]',App\Model\Admin\GlobalModule::getRouteListArray(),null, ['class'=>'form-control sel browser-default','placeholder'=>'url ']) !!}
            </div>
            <div class="col l1 pl-7">
                <a href="" class="  delete-reoute-permission"><i class="fa fa-close"></i></a>
            </div>
        </div>

    </div>
   
    <hr class="style2">
</div>