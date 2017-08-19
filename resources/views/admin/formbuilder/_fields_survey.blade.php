{{-- <br>
field type
{!! Form::select('select',['text'=>'Text(Select box)','checkbox'=>'Multiple choice(Checkboxes)','radio'=>'Single choice(Radio Button)','select'=>'Dropdown(Select box)','textarea'=>'Paragraph(Textarea)','datepicker'=>'Date(Datepicker)','location'=>'Location(Location Picker','message'=>'Message'],null,["class"=>"no-margin-bottom aione-field browser-default field-type" ])!!}

field title
{!!Form::text('field_title',null,['id'=>'input_', ' data-validation'=>'required'])!!}


Field description
{!!Form::textarea('description',null,['id'=>'input_','rows'=>'3', 'cols'=>'100'])!!}

Add Media
{!!Form::file('add media',null,['id'=>'input_'])!!}


field key
{!!Form::text('field_key',null,['id'=>'input_', ' data-validation'=>'required'])!!}


required
{!! Form::select('select',['yes','no'],null,["class"=>"no-margin-bottom aione-field browser-default" ])!!}


Next Field
{!!Form::text('next_field',null,['id'=>'input_', ' data-validation'=>'required'])!!}

validation
{!! Form::select('select',['a','b'],null,["class"=>"no-margin-bottom aione-field browser-default" ])!!}

<div class="options">
	
	<a href="#" class="add-another-option btn blue"> add another option</a>
	<div class="option">
		Options
		{!!Form::text('option_label',null,['id'=>'input_', ' data-validation'=>'required','placeholder'=>'option label'])!!}
		{!!Form::text('option_value',null,['id'=>'input_', ' data-validation'=>'required','placeholder'=>'option value'])!!}
		{!!Form::text('go_to_question',null,['id'=>'input_', ' data-validation'=>'required','placeholder'=>'Go to question'])!!}	
		
	</div>
	
</div> --}}
{!! FormGenerator::GenerateForm('survey_generator_fields')!!}
<style type="text/css">
	
</style>

<script type="text/javascript">
	$('.options').parents('.repeater-group').parent().hide();	
	$('.field-type').change(function(){
		if($(this).val()=="checkbox" || $(this).val()=="radio" || $(this).val()=="select"){
			$('.options').parents('.repeater-group').parent().show();
		}
		else{
			$('.options').parents('.repeater-group').parent().hide();	
		}
	});
	$(document).on('click','.add-another-option',function(e){
		e.preventDefault();
		var html='<div class="option">'+$('.options > .option ').html()+'<a href="#" class="delete-current"><i class="fa fa-close"></i></a></div>';
		$('.options').append(html);
	});
	$('.options').on('click','.delete-current',function(e){
		e.preventDefault();
		$(this).parents('.option').remove();
	});
</script>


