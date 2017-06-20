<div class="row" style="border:1px dashed #e8e8e8;">
	<div class="row">
		<div class="col l1 offset-l11 right-align">
			<i class="fa fa-pencil"></i>
			<i class="fa fa-close close-delete"></i>

		</div>
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
	</div>
	<div class="row" style="padding:15px 10px; ">
		<div class="col l12">
			@foreach($collection->fields as $secKey => $field)
					{!!FormGenerator::GenerateField($field->field_slug, $options)!!}
			@endforeach
		</div>
	</div>
</div>
<div class="row" style="margin-top: 1%;">
	<div class="col l3 offset-l9 right-align">
		<a href="" class="btn">Add New</a>
	</div>
</div>