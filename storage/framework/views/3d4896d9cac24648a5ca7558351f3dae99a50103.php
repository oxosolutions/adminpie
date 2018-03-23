<?php $__env->startSection('content'); ?>
<style type="text/css">
    .indicater-wrapper{
        position: absolute;
        right: 0;
        bottom:0;
        left:0;
        font-size: 9px;
        cursor: pointer
    }
    .indicater-wrapper .indicater{
        width: 100%;
        height: 4px;
        position: relative;
    }
    .indicater-wrapper .percentage{
        position: absolute;
        min-height: 4px;
        left: 0;
        width: 30%
    }
    .indicater-wrapper .percentage-text{
        display: none;
        position: absolute;
        width: 100%
    }
    .indicater-wrapper.active .percentage-text{
        display: block;
        color: #676767
    }
    .indicater-wrapper.active .indicater{
        height: 15px;
        margin-top: 10px
    }
    .indicater-wrapper.active .percentage{
        min-height: 15px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('.indicater-wrapper').click(function(){
            $(this).toggleClass('active');
        }
                                     )
    }
                     )
</script>



<div class="m-20 aione-border p-15">
	<div class="mb-30">
		<div class="p-10 font-size-20 light-blue darken-2 aione-border-bottom">
			Name of the section
		</div>
		<div class="p-10">
			<div id="field_1" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-name field-wrapper-type-text ">
                <div id="field_label_name" class="field-label">
                    <label for="input_name">
                        <h4 class="field-title" id="Name">
                            Name
                        </h4>
                    </label>
                </div>
                <!-- field label-->
                <div id="field_name" class="field field-type-text">
                    <input class="input-name" id="input_name" placeholder="" data-validation="" name="name" type="text">
                </div>
                <!-- field -->
            </div>
		</div>
		<div class="p-10">
			<div id="field_1" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-name field-wrapper-type-text ">
                <div id="field_label_name" class="field-label">
                    <label for="input_name">
                        <h4 class="field-title" id="Name">
                            Name
                        </h4>
                    </label>
                </div>
                <!-- field label-->
                <div id="field_name" class="field field-type-text">
                    <input class="input-name" id="input_name" placeholder="" data-validation="" name="name" type="text">
                </div>
                <!-- field -->
            </div>
		</div>
		<div class="p-10">
			<div id="field_1" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-name field-wrapper-type-text ">
                <div id="field_label_name" class="field-label">
                    <label for="input_name">
                        <h4 class="field-title" id="Name">
                            Name
                        </h4>
                    </label>
                </div>
                <!-- field label-->
                <div id="field_name" class="field field-type-text">
                    <input class="input-name" id="input_name" placeholder="" data-validation="" name="name" type="text">
                </div>
                <!-- field -->
            </div>
		</div>
	</div>
	<div class="mb-30">
		<div class="p-10 font-size-20 light-blue darken-2 aione-border-bottom">
			Name of the section
		</div>
		<div class="p-10">
			<div id="field_1" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-name field-wrapper-type-text ">
                <div id="field_label_name" class="field-label">
                    <label for="input_name">
                        <h4 class="field-title" id="Name">
                            Name
                        </h4>
                    </label>
                </div>
                <!-- field label-->
                <div id="field_name" class="field field-type-text">
                    <input class="input-name" id="input_name" placeholder="" data-validation="" name="name" type="text">
                </div>
                <!-- field -->
            </div>
		</div>
		<div class="p-10">
			<div id="field_1" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-name field-wrapper-type-text ">
                <div id="field_label_name" class="field-label">
                    <label for="input_name">
                        <h4 class="field-title" id="Name">
                            Name
                        </h4>
                    </label>
                </div>
                <!-- field label-->
                <div id="field_name" class="field field-type-text">
                    <input class="input-name" id="input_name" placeholder="" data-validation="" name="name" type="text">
                </div>
                <!-- field -->
            </div>
		</div>
		<div class="p-10">
			<div id="field_1" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-name field-wrapper-type-text ">
                <div id="field_label_name" class="field-label">
                    <label for="input_name">
                        <h4 class="field-title" id="Name">
                            Name
                        </h4>
                    </label>
                </div>
                <!-- field label-->
                <div id="field_name" class="field field-type-text">
                    <input class="input-name" id="input_name" placeholder="" data-validation="" name="name" type="text">
                </div>
                <!-- field -->
            </div>
		</div>
	</div>
		
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>