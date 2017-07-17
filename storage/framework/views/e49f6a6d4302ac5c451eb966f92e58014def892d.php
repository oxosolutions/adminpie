<div style="width: 100%; border: 1px dotted #CCC; margin-top: 1%; padding-left: 2%; padding-right: 2%; padding-bottom: 2%;" class="row sub-div">
    <a href="javascript:void(0)" style="float: right; margin-top: 0.5%;" class="delete-submodule"><i class="fa fa-close"></i></a>
    <div class="col s12 m2 l12 aione-field-wrapper">
        <div class="row">
            <div class="col l6 pr-7">
                <label>Sub Module name</label>
                <input type="text" name="submodule[<?php echo e($count); ?>][submodule_name]" value="" placeholder="Enter sub-module name" />
            </div>
            <div class="col l6 pl-7">
                <label>Sub Module Route</label>
                <?php echo Form::select('submodule['.$count.'][sub_module_route]',App\Model\Admin\GlobalModule::getRouteListArray(),null, ['class'=>'form-control sel browser-default','placeholder'=>'url ']); ?>

                <input type="hidden" name="submoduleNumber" value="<?php echo e($count); ?>" />
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col l6">
            Routes For Permission
        </div>
        <div class="col l6 right-align">
            <a href="" class="btn green add-route-permission">add</a>
        </div>

    </div>
    <div class="repeat_route_permission">
        <div class="row repeat-sub-row">
            <div class="col s12 m2 l12 aione-field-wrapper" style="border: 1px solid #e8e8e8;padding: 14px; margin-top: 1%;">

                <div class="row valign-wrapper">
                    <div class="col l5 pr-7">
                        <label>Route name</label>
                        <input type="text" name="submodule[<?php echo e($count); ?>][perm_route_name][]" value="" placeholder="Enter route name" />
                    </div>
                    <div class="col l6 pl-7 pr-7">
                        <label>Route</label>
                        <?php echo Form::select('submodule['.$count.'][perm_route][]',App\Model\Admin\GlobalModule::getRouteListArray(),null, ['class'=>'form-control sel browser-default','placeholder'=>'url ']); ?>

                    </div>
                    <div class="col l1 pl-7">
                        <a href="" class="  delete-reoute-permission"><i class="fa fa-close"></i></a>
                    </div>
                </div>

            </div>
           
            <hr class="style2">
        </div>

    </div>
</div>