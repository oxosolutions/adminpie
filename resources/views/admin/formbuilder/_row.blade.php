<div>
  <div class="row form-row option-trigger" style="background-color: #fff;padding: 15px 10px">

    <div class="col l2">
      <div style="float: left;background-color: grey;text-align: center;width: 42px;margin-top: -11px;margin-bottom: -11px;line-height: 67px;" class="handle">
        <a href="">
          <i class="fa fa-arrows" style="color: white"></i>
        </a>
      </div>
      <span style="border:1px solid #e8e8e8;line-height: 46px;width: 34px;margin: 0 auto;margin-left:10px;border-radius: 50%;padding:10px 15px;" class="row-count">1</span>
      <div style="clear: both">
          
      </div>
    </div>
    <div class="col l4">
      <div class="row">
        <div class="col l12 field-label">
          Field Label
        </div>
        <div class="" style="font-size: 12px;height: 0px">
          <span class="options">
            <a href="javascript:void(0)" class="edit-fields" style="border:0px !important;padding: 0px">Edit </a>|
            <a href="javascript:void(0)" class="delete-row">Delete </a>
          </span>
        </div>
      </div>
    </div>
    <div class="col l4 field-name-text">Test</div>
    <div class="col l2 field-type">Test</div>
  </div>
  <div class="fields-list" style="display: none;border-top:1px;border-color: #e8e8e8;border-style: solid">
    <div colspan=100% style="padding: 0px;">
       <div>
        <div class="fields_list active-field">
            <div class="row field_row">
                <div class="col l4 left-align grey lighten-5 " style="padding:20px">
                    <span class="field-title">Field Label*</span><br>
                    <span class="field-description">This is the name which will appear on the EDIT page</span>
                </div>
                <div class="col l8 form-group"  style="padding: 10px">
                     <input type="text" required="required" name="field_title" class="form-control field-label-input">
                </div>
            </div>
            <div class="row field_row">
                <div class="col l4 left-align grey lighten-5" style="padding:44px 20px">
                    <span class="field-title">Field Description</span><br>
                    <span class="field-description">Field Description</span> 
                </div>
                <div class="col l8 form-group" style="padding:10px">
                    {{-- <textarea class="form-control" rows="3" name="question_desc"></textarea> --}}
                    <input type="text" id="textarea2" class="materialize-textarea" required="required" name="field_description">
                </div>  
            </div>
            <div class="row field_row">
                <div class="col l4 left-align grey lighten-5" style="padding: 30px 20px">
                    <span class="field-title" style="line-height: 36px">Field Type*</span>         
                </div>
                <div class="col l8 input-field" style="padding:10px">
                    <select name="field_type" required="required" class="field_type">
                     <optgroup label="Basic">
                            <option value="" selected="selected">Select Type</option>
                            <option value="text" selected="selected">Text</option>
                            <option value="textarea">Text Area</option>
                            <option value="number">Number</option>
                            <option value="email">Email</option>
                            <option value="password">Password</option>
                        </optgroup>
                        <optgroup label="Content">
                            <option value="image">Image</option>
                            <option value="file">File</option>
                        </optgroup>
                        <optgroup label="Choice">
                            <option value="select">Select</option>
                            <option value="multi_select">Multi Select</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="radio">Radio Button</option>
                        </optgroup>
                    </select>
                      
                </div>  
            </div>
            <div class="row field_row">
                <div class="col l4 left-align grey lighten-5" style="padding:20px">
                <span class="field-title">Field Order</span><br>
                    <span class="field-description">Question Order be in number [0-9]</span>
                </div>
                <div class="col l8 form-group" style="padding:10px">
                     <input type="text" name="field_order" required="required" class="form-control field-label-input">
                </div>
            </div>
            <div class="row field_row">
                <div class="col l4 left-align grey lighten-5 " style="padding:20px">
                    <span class="field-title">Field Slug*</span><br>
                    <span class="field-description"></span>
                </div>
                <div class="col l8 form-group"  style="padding: 10px">
                     <input type="text" name="field_slug" required="" class="form-control field-label-input">
                </div>
            </div>
            <div class="row field_row">
                <div class="col l4 left-align grey lighten-5" style="padding:44px 20px">
                    <span class="field-title">Field Required?</span><br>
                </div>
                <div class="col l8 form-group" style="padding:10px">
                    <p>
                      <input type="radio" id="test1" name="field_required" />
                      <label for="test1">Yes</label>
                    </p>
                    <p>
                      <input type="radio" id="test2" name="field_required" />
                      <label for="test2">No</label>
                    </p>
                </div>  
            </div>
            <div class="row field_row">
                <div class="col l4 left-align grey lighten-5" style="padding:20px">
                    <span class="field-title">Field Error Messages</span><br>
                    <span class="field-description">eg. Show extra content</span> 
                </div>
                <div class="col l6 form-group messages" style="padding:5px">
                    <input type="text" class="form-control" name="field_error_message">
                </div>  
                <div class="col l1 form-group" style="padding:5px">
                    <a href="javascript:;" class="add_message">Add</a>
                </div>  
            </div>
            <div class="row field_row">
                <div class="col l4 left-align grey lighten-5" style="padding:20px">
                <span class="field-title">Field Validation</span><br>
                    <span class="field-description">validations</span>
                </div>
                <div class="col l6 form-group validations" style="padding:10px">
                     <input type="text" name="field_validation" class="form-control field-label-input">
                </div>
                <a href="javascript:;" class="add_validation">Add</a>
            </div>
            <div class="row field_row">
                <div class="col l4 left-align grey lighten-5" style="padding:44px 20px">
                    <span class="field-title">Field Condition</span><br>
                </div>
                <div class="col l8 form-group" style="padding:5px">
                    <p>
                      <input type="radio" id="test4" name="field_condition" />
                      <label for="test4">Yes</label>
                    </p>
                    <p>
                      <input type="radio" id="test5" name="field_condition" />
                      <label for="test5">No</label>
                    </p>
                </div>  
            </div>
            <div class="row field_row">
                <div class="col l4 left-align grey lighten-5" style="padding:20px">
                    <span class="field-title">Field Formatting</span><br>
                    <span class="field-description">Affects value on front end</span> 
                </div>
                <div class="col l8 form-group" style="padding:10px">
                    <select name="field_format">
                        <option value="" disabled selected>Choose your option</option>
                        <option value="No Formatting">Plain</option>
                        <option value="text">HTML</option>
                    </select>
                </div>  
            </div>        
            <div class="row field_row">
                <div class="col l4 left-align grey lighten-5" style="padding:20px">
                    <span class="field-title">Field Placeholder</span><br>
                    <span class="field-description">Appears within the input</span> 
                </div>
                <div class="col l8 form-group" style="padding:10px">
                    <input type="text" name="field_placeholder" class="form-control">
                </div>  
            </div>
            <div class="row field_row">
                <div class="col l4 left-align grey lighten-5" style="padding:20px">
                    <span class="field-title">Field Tooltip</span><br>
                    <span class="field-description">Appears on hover</span> 
                </div>
                <div class="col l8 form-group" style="padding:10px">
                    <input type="text" name="field_tooltip" class="form-control">
                </div>  
            </div>
            <div class="row field_row">
                <div class="col l4 left-align grey lighten-5" style="padding:20px">
                    <span class="field-title">Field value</span><br>
                    <span class="field-description">Appears</span> 
                </div>
                <div class="col l8 form-group" style="padding:10px">
                    <input type="text" name="field_value" class="form-control">
                </div>  
            </div>
            <div class="row field_row">
                <div class="col l4 left-align grey lighten-5" style="padding:20px">
                    <span class="field-title">Field class</span><br>
                    <span class="field-description">Appears</span> 
                </div>
                <div class="col l8 form-group" style="padding:10px">
                    <input type="text" name="field_class" class="form-control">
                </div>  
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
   $(document).ready(function() {
    $('select').material_select();
  });
   $('.add_message').click(function(){
    var appended_row = '<input type="text" class="form-control" name="field_error_message"><a href="javascript:;" style="float:right;" class="delete_message"><span class=" fa fa-trash"></span></a>';
    $('.messages').append(appended_row);
   });
   $('.delete_message').click(function(){
    alert('clicked');
   });

   $('.add_validation').click(function(){
    var appended_row = '<input type="text" name="field_validation" class="form-control field-label-input"><a href="javascript:;" style="float:right;" class="delete_validation"><span class=" fa fa-trash"></span></a>';
    $('.validations').append(appended_row);
   });
</script>