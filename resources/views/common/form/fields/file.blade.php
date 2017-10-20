
@php
	if(isset($settings['field_variable']) && $settings['field_variable'] == 'slug'){
		$name = $collection->field_slug;
	}else{
		$name = str_replace(' ','_',strtolower($collection->field_slug));
	}
	if(@$options['from'] == 'repeater'){
		$name = strtolower($collection->section->section_slug).'['.$options['loop_index'].']['.$name.']';
	}
@endphp

{!!Form::file($name,null,['class'=>$collection->field_slug,'id'=>'input_'.$collection->field_slug])!!}
				
	
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('click','.submit-logo',function(e){
		e.preventDefault();
		$('button[name='+$(this).attr('data-value')+']').click();
	})
})
	
</script>
