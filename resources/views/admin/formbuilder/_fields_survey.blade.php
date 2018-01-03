@php
	$section = $sections->where('id',request()->input('sections'))->first();
	$field = $section->fields->where('id',request()->input('field'))->first();
	$fieldMeta = $field->fieldMeta;
	$model = $field->toArray();
	foreach($fieldMeta as $key => $value){
        if(in_array($value->key,['field_options','field_conditions','field_validations'])){
            $model[$value->key] = json_decode($value->value,true);
        }else{
            $model[$value->key] = @$value->value;
        }
    }
@endphp

{!!Form::model($model,['route'=>[$route_slug.'update.field',request()->form_id,request()->input('sections'),request()->input('field')]])!!}
    <input type="file" id="upload" name="upload" style="visibility: hidden; width: 1px; height: 1px;padding:0;margin: 0;line-height: 0;" multiple />
	{!! FormGenerator::GenerateForm('survey_generator_fields',[],$model)!!}
{!!Form::close()!!}



<div id="add_media" class="modal modal-fixed-footer aione-media-modal" style="overflow-y: hidden;">
	<div class="modal-header">
		<h5>Add Media</h5>	
		<a href="javascript:;" name="closeModel" onclick="close()" id="closemodal" class="closeDialog close-model-button" style="color: white"><i class="fa fa-close"></i></a>
	</div>
	<div class="modal-content" style="padding:0px;overflow: hidden">
		<div class="row" style="margin: 0;height: inherit">
			<div class="col l8 gallery-files" style="border-right: 1px solid #a9a9a9;height: 104%;overflow-x: hidden;width: 64%">
				<div class="aione-tile-view" id="files" >
					
					{{-- <form action="/file-upload" class="dropzone" id="my-awesome-dropzone"></form> --}}
				</div>
			</div>
			<div class="col l4 gallery-form" style="height: 100%;overflow: auto">
				<form id="gallery-form">
					<div class="gallery-image">
						<img src="" style="width: 100%">
							<audio controls>
								<source src="horse.mp3" type="audio/mpeg">
							</audio>
						<video width="320" height="240" controls>
							  <source src="" type="video/mp4">
						</video>
					</div>
					{!! FormGenerator::GenerateForm('survey_add_media_popup_form') !!}
					<input type="hidden" name="gallery_id" value="">
				</form>
			</div>
		</div>
		
		
		
		
	</div>
	<div class="modal-footer">
		<button class="btn blue save-gallery-details" type="submit" name="action">Save
		</button>
		{!!  Form::open(array('url' => 'foo/bar', 'class' => 'form_media_upload', 'files' => true, 'class')) !!}
			<input type="file" id="upload" name="upload" style="visibility: hidden; width: 1px; height: 1px;padding:0;margin: 0;line-height: 0;" multiple />
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<a class="btn blue " onclick="document.getElementById('upload').click(); return false">Upload media
		</a>
		{!! Form::close() !!}
	</div>	
</div>

<style type="text/css">
	.form_media_upload{
		display: inline-block;	
	}
	.aione-tile-view > div{
		width: 175px;
		float: left;
		margin-right: 15px;
		margin-bottom: 1%
	}
	.aione-tile-view > div .desc{
		padding:10px 5px;
		   
    margin-top: -3px;
	}
	.aione-tile-view > div >img{
		height: 120px;
		width: 100%;
	}
	.aione-tile-view > div .size{
		color: #757575;
	}
	.aione-tile-view .icon-logo{
		font-size: 80px;
		color: #a9a9a9;
	}
	.aione-media-modal{
		    max-height: 80% !important;
    width: 92% !important;
	}
	.modal.modal-fixed-footer{
		height: 80%;
	}
	.selected{
		position: relative;
	}
	.selected > img{
		    border: 4px solid #2196F3;
	}
	.selected .desc{
		 background-color: #2196F3;
		 color: white;
	}
	.selected:after{
		content: "\f00c";
	    font-family: FontAwesome;
	    font-style: normal;
	    font-weight: normal;
	    text-decoration: inherit;
	
	    color: #2196F3;
	    font-size: 24px;
	    padding-right: 0.5em;
	    position: absolute;
	    top: 10px;
	    right: 0;
	}
</style>

<script type="text/javascript">
	
	$('#add_media').modal();
	// $('.options').parents('.repeater-group').parent().hide();	
	// $('.field-type').change(function(){
	// 	if($(this).val()=="checkbox" || $(this).val()=="radio" || $(this).val()=="select"){
	// 		$('.options').parents('.repeater-group').parent().show();
	// 	}
	// 	else{
	// 		$('.options').parents('.repeater-group').parent().hide();	
	// 	}
	// });
	$('.regex-wrapper').parents('.field-wrapper').hide();
	$('.show-hide-regex').change(function(){
		if($(this).val()=="other"){
			$('.regex-wrapper').parents('.field-wrapper').show();
		}
		else{
			$('.regex-wrapper').parents('.field-wrapper').hide();
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
	$('.aione-tile-view > div').click(function(){
		$(this).toggleClass('selected');
		$(this).siblings().removeClass('selected');
	});

    /************************************************************************************/
    $(document).ready(function(){
        var selectedFill = '{{ @$model["prefilled_with"] }}';
        console.log(selectedFill);
        var toHide = '';
        switch(selectedFill){
            case'static':
                toHide = '#field_3168, #field_3165, #field_3169, #field_3170';
            break;

            case'model':
                toHide = '#field_3168, #field_3169, #field_3170, .field_options';
            break;

            case'dataset':
                toHide = '#field_3170, .field_options';
                setTimeout(function(){
                    $('#field_3168 select').trigger('change');
                },1000);
            break;

            case'survey':
                toHide = '#field_3168, .field_options';
                setTimeout(function(){
                    $('#field_3170 select').trigger('change');
                },1000);
            break;
        }
        $(toHide).hide();

        $('#field_3171 input').click(function(){
            if($(this).val() == 'model'){
                $('#field_3165').show();
                $('#field_3168').hide();
                $('#field_3169').hide();
                $('#field_3170').hide();
                $('.field_options').hide();
                // $('#field_3169 select').html('');
            }else if($(this).val() == 'dataset'){
                $('#field_3168').show();
                $('#field_3165').show();
                $('#field_3169').show();
                $('#field_3170').hide();
                $('.field_options').hide();
                {{-- $('select[name=choice_model] option[value="{{ 'App\\Model\\Organization\\Dataset@getDatasetColumnRecords()' }}"]').prop('selected',true);
                $('select[name=choice_model]').attr('disabled','disabled'); --}}
                // $('#field_3169 select').html('');
            }else if($(this).val() == 'survey'){
                $('#field_3170').show();
                $('#field_3169').show();
                $('#field_3165').show();
                $('#field_3168').hide();
                $('.field_options').hide();
                // $('#field_3169 select').html('');
            }else if($(this).val() == 'static'){
                $('.field_options').show();
                $('#field_3170').hide();
                $('#field_3169').hide();
                $('#field_3165').hide();
                $('#field_3168').hide();
                // $('#field_3169 select').html('');
            }
        });

        $('#field_3168 select').change(function(){
            var datasetId = $(this).val();
            $.ajax({
               type:'GET',
               url: route()+'/dataset/columns/',
               data: {dataset: datasetId,status:true},
               success: function(result){
                    $('#field_3169 select').html(result);
                    $('#field_3169 select').val('{{ @$model['select_column'] }}');
               }
            });
        });
        $('#field_3170 select').change(function(){
            var surveyId = $(this).val();
            $.ajax({
               type:'GET',
               url: route()+'/survey/columns' ,
               data: {survey_id: surveyId},
               success: function(result){
                    $('#field_3169 select').html(result);
                    $('#field_3169 select').val('{{ @$model['select_column'] }}');
               }
            });
        });
    });
    
    /*****************************************************************************/
</script>
<script type="text/javascript">




$.ajaxSetup({
   headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});
window.Laravel = <?php echo json_encode([
    'csrfToken' => csrf_token(),
]); ?>

	$(document).ready(function(){
		
		$('.gallery-form').hide();

		if($('.gallery-form').hide()){
			$('.gallery-files').removeClass('l8');
			$('.gallery-files').addClass('l12');
		}

		@if(in_array($field->field_type,['checkbox','radio','select']))
			$('.options').parents('.repeater-group').parent().show();
		@endif
		$('#upload').change(function(){
			var file_data = $('#upload').prop('files')[0];   
		    var form_data = new FormData();                  
		    form_data.append('file', file_data);
		    form_data.append("_token", Laravel.csrfToken );
		    $.ajax({
	                url: route()+'/cms/media/create', 
	                dataType: 'text',
	                cache: false,
	                headers: {'X-CSRF-TOKEN': Laravel.csrfToken },
	                contentType: false,
	                processData: false,
	                data: form_data,                         
	                type: 'post',
	                success: function(res){
	                	$('#files').html('');
	                	$('#files').append(res);
	                	if(res != ''){
	                		Materialize.toast('File Upload Successfully',2000);
	                	}
	                }
		     });
		});
		$(document).on('click','#input_add_media',function(){
			
			$.ajax({
                url: route()+'cms/gallery', 
                headers: {'X-CSRF-TOKEN': Laravel.csrfToken },
                type: 'get',
                success: function(res){
                	$('#files').html('');
                	$('#files').append(res);
                }
	     	});

		});
		$(document).on('click','.gallery-item',function(){
			$('.gallery-form').show();
			$('.gallery-files').addClass('l8');
			$('.gallery-files').removeClass('l12');

			var id = $(this).attr('gallery-item-id');
			$(this).addClass('selected');
			$(this).siblings().removeClass('selected');
			$.ajax({
				url : route()+'cms/gallery-item',
				type : 'post',
				data : { id : id , _token : $('input[name=_token]').val()},
				success : function(res){
					$('.gallery-form').find('input[name=title]').val(res.original_name);
					$('.gallery-form').find('input[name=slug]').val(res.slug);
					$('.gallery-form').find('input[name=alt_text]').val(res.alt_text);
					$('.gallery-form').find('input[name=caption]').val(res.caption);
					$('.gallery-form').find('input[name=link_to]').val(res.link_to);
					$('.gallery-form').find('textarea[name=description]').val(res.description);
					$('.gallery-form').find('input[name=gallery_id]').val(res.id);
					if(res.extension == 'jpg' || res.extension == 'jpeg'){
						$('.gallery-form').find('.gallery-image img').attr('src',"{{ asset('media/') }}/"+res.original_name);
					}else if(res.extension == 'mp3'){
						$('.gallery-form').find('.gallery-image audio > source').attr('src',"{{ asset('media/') }}/"+res.original_name);
					}else if(res.extension == 'mp4'){
						$('.gallery-form').find('.gallery-image video > source').attr('src',"{{ asset('media/') }}/"+res.original_name);
					}

				}
			});
		});
		$(document).on('click','.save-gallery-details',function(){

			// var formData = {};
			var formData = new FormData();
			$('#gallery-form').find('input , textarea').each(function(){
				var key = $(this).attr('name');
				var value = $(this).val();
				formData.append(key,value);
				formData.append("_token", Laravel.csrfToken );
				// formData[key] = value;
			});
			console.log(formData);
			$.ajax({
				url : route()+'cms/gallery/save',
				dataType: 'text',
                cache: false,
                headers: {'X-CSRF-TOKEN': Laravel.csrfToken },
                contentType: false,
                processData: false,
				type : 'post',
				data : formData,
				success : function(res){
					if(res == 'true'){
						Materialize.toast('Details Save Successfully',6000);
					}
				}


			});
		});

	});
</script>


