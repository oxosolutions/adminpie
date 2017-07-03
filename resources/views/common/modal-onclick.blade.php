<div id="{{$data['modal_id']}}" class="modal modal-fixed-footer">
	<div class="modal-header white-text  blue darken-1" ">
		<div class="row" style="padding:15px 10px">
			<div class="col l7 left-align">
				<h5 style="margin:0px">{{@$data['heading']}}</h5>	
			</div>
			<div class="col l5 right-align">
				<a href="javascript:;" class="closeDialog white-text" ><i class="fa fa-close"></i></a>
			</div>
				
		</div>
		
	</div>
	<div class="modal-content" style="padding: 30px;">
		@if(isset($data['section']))
			{!!FormGenerator::GenerateSection($data['section'],['type'=>'inset'])!!}
		@endif
		@if(isset($data['group']))
			{!!FormGenerator::GenerateGroup($data['group'],['type'=>'inset'])!!}
		@endif
	</div>
	<div class="modal-footer">
		<button class="btn blue" type="submit" name="action">{{@$data['button_title']}}
		</button>
	</div>	
</div>
<script type="text/javascript">

	$(document).ready(function(){
 			$('#{{$data['modal_id']}}').modal(); 
	 })
</script>