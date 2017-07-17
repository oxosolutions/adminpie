<style type="text/css">
	.close-delete{
		  	margin-right: 3px;
		    background-color: white;
		    color: black;
		    width: 28px;
		    line-height: 18px;
		    text-align: center;
	}
	.close-delete:hover{
		background-color: red !important;
		color: white !important;
	}
</style>
<div class="repeater-group">
	@if($model != null)
		@foreach($model as $key => $value)
			@php
				$defaulValues = [];
			@endphp
			<div class="row repeat-row" style="border:1px dashed #e8e8e8; margin-top: 1%;">
				<div class="row">
					<div class="col l1 offset-l11 right-align">
						<i class="fa fa-close close-delete"></i>
					</div>
				</div>
				<div class="row" style="padding:15px 10px; ">
					<div class="col l12">
						@php
							$defaulValues[] = $key;
							$defaulValues[] = $value;
						@endphp
						@foreach($collection->fields as $secKey => $field)
								@php
									$options['default_value'] = $defaulValues[$secKey];
								@endphp
								{!!FormGenerator::GenerateField($field->field_slug, $options)!!}
						@endforeach
					</div>
				</div>
			</div>
		@endforeach
	@else
		<div class="row repeat-row" style="border:1px dashed #e8e8e8; margin-top: 1%;">
			<div class="row">
				<div class="col l1 offset-l11 right-align">
					<i class="fa fa-close close-delete"></i>
				</div>
			</div>
			<div class="row" style="padding:15px 10px; ">
				<div class="col l12">
					@foreach($collection->fields as $secKey => $field)
							{!!FormGenerator::GenerateField($field->field_slug, $options)!!}
					@endforeach
				</div>
			</div>
		</div>
	@endif
</div>
<div class="row" style="margin-top: 1%;">
	<div class="col l3 offset-l9 right-align">
		<button type="submit" class="btn add-new-repeater">Add New</button>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('.add-new-repeater').click(function(e){
			e.preventDefault();
			var rowCol = $('.repeater-group .row:first').clone();
			$('.repeater-group').append(rowCol);
			var inputs = $('.repeater-group .row:last').find('input,select,textarea');
			inputs.each(function(e){
				$(this).val('');
			});
		});
		$('body').on('click','.close-delete', function(){
			if($('.close-delete').length > 1){
				$(this).parents('.repeat-row').remove();
			}
		});
	});
</script>