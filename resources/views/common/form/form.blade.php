<div>
	{{-- @include('admin.settings._tabs') --}}
	<div>
		<div class="row">
			<div class="col l12">
				<h5>{{@$options['title']}}</h5>
			</div>
		</div>
		<div class="row">
			<div class="col l12">
				{{@$options['details']}}
			</div>
		</div>
		<div class="row pv-10" >
			@foreach($collection->section as $key => $section)
				<div class="row">
					<div class="row">
						<h5>{{$section->section_name}}</h5> 
					</div>
					@foreach($section->fields as $secKey => $field)
							{!!FormGenerator::GenerateField($field->field_slug)!!}
					@endforeach
				</div>
			@endforeach
		</div>
		<div class="row right-align pv-10"  >
			<button type="submit" class="btn">save</button>
			<a class="btn grey darken-2">reset to default</a>
		</div>
	</div>
</div>
<style type="text/css">
	.pv-10{
		padding:10px 0px
	}
	.aione-setting-field:focus{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
	textarea{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
	.btn{
		background-color: #0288D1;
	}
	.select-dropdown{
		margin-bottom: 0px !important;
	    border: 1px solid #a8a8a8 !important;
	    
	}
	.select-wrapper input.select-dropdown{
		height: 30px;
    	line-height: 30px;
	}
	.file-path{
		margin-bottom: 0px !important
	}
	.datepicker{
		margin-bottom: 0px !important
	}
	.level{
		margin: 0px !important;
	}
</style>
<script type="text/javascript">
	  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
</script>