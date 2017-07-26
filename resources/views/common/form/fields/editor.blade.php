<div class="row waves-effect" data-target="{{str_replace(' ','_',strtolower($collection->field_title))}}" style="margin-bottom: 0px;padding: 14px;width: 100%">
    <div class="col l6">
        {{ucfirst($collection->field_title)}}
    </div>
    <div class="col l6 right-align">
        <i class="fa fa-pencil" style="margin-right: 20px"></i>
    </div>
</div>

<div id="{{str_replace(' ','_',strtolower($collection->field_title))}}" class="modal modal-fixed-footer">
  <div class="modal-header white-text  blue darken-1" ">
    <div class="row" style="padding:15px 10px;margin: 0px">
      <div class="col l7 left-align">
        <h5 style="margin:0px">Code Editor</h5> 
      </div>
      <div class="col l5 right-align">
        <a href="javascript:;" name="closeModel" onclick="close()" id="closemodal" class="closeDialog close-model-button" style="color: white"><i class="fa fa-close"></i></a>
      </div>  
    </div>
  </div>
  <div class="modal-content" style="padding: 0">
<div id="{{str_replace(' ','_',strtolower($collection->field_title))}}_ace" style="width: 100%; height: 339px;">
</div>
  </div>
  <div class="modal-footer">
    {!!Form::textarea(str_replace(' ','_',strtolower($collection->field_title)), null,['id'=>str_replace(' ','_',strtolower($collection->field_title)).'_textarea','style'=>'display:none;'])!!}
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Save</a>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
    	$('.modal').modal();
  	});
</script>
<script>
    var editor = ace.edit("{{str_replace(' ','_',strtolower($collection->field_title))}}_ace");
    editor.setTheme("ace/theme/monokai");
    //editor.getSession().setMode("ace/mode/javascript");
    editor.setShowPrintMargin(false);
    var textarea = $('#{{str_replace(' ','_',strtolower($collection->field_title))}}_textarea');
    editor.getSession().on("change", function () {
        textarea.val(editor.getSession().getValue());
    });
</script>
