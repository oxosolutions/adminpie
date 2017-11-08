{{-- {{dd($jsonData)}} --}}
{{-- {{dump($chart_type)}} --}}
{!!Form::model($model,['route'=>'save.chart.settings'])!!}
{!!Form::hidden('chart_id',$request->chartid)!!}
{!!Form::hidden('visual_id',$request->visualid)!!}
<div class="form">
	<div class="aione-accordion">
		<div class="aione-item">
			<div class="aione-item-header">
				General
				{{-- <div class="arrow arrow-down"></div> --}}
			</div>
			<div class="aione-item-content aione-form-field-border">
				@foreach($jsonData as $key => $value)
					@if(in_array($chart_type,$value->chartType))
						@if($value->isArray == 'false')
							<div class="field-wrapper">
								<div class="label field-label">
									<label><strong>{{$value->label}}</strong></label>
								</div>
								<div class="field">
									@if($value->type != 'select')

										{!!Form::{$value->type}('chart_settings['.$key.']',null)!!}
									@else
										{!!Form::{$value->type}('chart_settings['.$key.']',$value->options,null,['placeholder'=>'Select Value'])!!}
									@endif
								</div>
							</div>
									
										
							
							{{-- <hr /> --}}
						@endif
					@endif
				@endforeach
			</div>
		</div>
			
	</div>
	
	@foreach($jsonData as $key => $value)
		@if(in_array($chart_type,$value->chartType))
			@if($value->isArray == 'true')
				@php
					$fieldName = [];
					unset($value->chartType);
					unset($value->isArray);
					$fieldName[] = $key;
				@endphp
				@include('organization.visualization.recursive-chart-settings',['jsonData'=>$value,'key'=>$key,'fieldName'=>$fieldName])
			@endif
		@endif
	@endforeach
</div>
{{-- <input type="submit" name="submit" value="Save Settings" /> --}}
{!!Form::close()!!}
<style type="text/css">
	.settings-collapsable{
		width: 99%;
		border: 1px solid #CCC;
	}

	.arrow{
		float: right;
		margin-top: -2.3%;
		margin-right: 0.8%;
	}

	.arrow-up {
	  width: 0; 
	  height: 0; 
	  border-left: 8px solid transparent;
	  border-right: 8px solid transparent;
	  
	  border-bottom: 10px solid black;
	}

	.arrow-down {
	  width: 0; 
	  height: 0; 
	  border-left: 8px solid transparent;
	  border-right: 8px solid transparent;
	  
	  border-top: 10px solid #000;
	}

	.arrow-right {
	  width: 0; 
	  height: 0; 
	  border-top: 60px solid transparent;
	  border-bottom: 60px solid transparent;
	  
	  border-left: 60px solid #000;
	}

	.arrow-left {
	  width: 0; 
	  height: 0; 
	  border-top: 10px solid transparent;
	  border-bottom: 10px solid transparent; 
	  
	  border-right:10px solid #000; 
	}
	.collapsable-content{
		padding: 1%;
		height: auto;
		display: none;
	}
	.settings-collapsable-header{
		width: 96.9%;
		border: 1px solid #ccc;
		padding-left: 1%;
		background: #e5e5e5;
		background: -moz-linear-gradient(top, #e5e5e5 6%, #ffffff 100%);
		background: -webkit-linear-gradient(top, #e5e5e5 6%,#ffffff 100%);
		background: linear-gradient(to bottom, #e5e5e5 6%,#ffffff 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e5e5e5', endColorstr='#ffffff',GradientType=0 );
		cursor: pointer;
		height: 35px;
		padding-top: 2%;
		padding-right: 2%;
	}
	.collapse-arrow{
		float: right;
		content: 
	}
	hr {
	    margin: 20px 0;
	    border: 1px solid #CCC;
	    opacity: 0.5;
	}
	.form{
		width:100%;
		margin: 0 auto;
		border: 1px solid 1px;
		font-family: arial;
		font-size: 14px;
	}
	.form input,select{
		width: 100%;
		height: 30px;
	}
	.label{
		width: 100%;
		margin-bottom: 0.5%;
		font-weight: 400;
	}
	.form .fields{
		margin-bottom: 1.5%;
	}
	.row{
		width: 100%;
		height: auto;
		position: relative;
	}

	.col{
		float: left;
	}

	.col-md-6{
		width: 50%;
		height: auto;
	}

	.col-md-12{
		width: 100%;
		height: auto;
	}
</style>
<script type="text/javascript" src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.settings-collapsable-header').click(function(){
			var elem = $(this).parent('.settings-collapsable');
			if(elem.find('.arrow').hasClass('arrow-down')){
				elem.find('.arrow').removeClass('arrow-down');
				elem.find('.arrow').addClass('arrow-up');
				elem.addClass('active');
			}else{
				elem.find('.arrow').removeClass('arrow-up');
				elem.find('.arrow').addClass('arrow-down');
				elem.removeClass('active');
			}
			$('.collapsable-content').each(function(index){
				/*if(!$this.is(':nth-child('+index+')')){
					$('.collapsable-content').slideUp(300);
				}*/
			});
			elem.find('.collapsable-content:first').slideToggle(300);
		});
	});
</script>
{{-- <div id="field_1808" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-name field-wrapper-type-text ">
	<div id="field_label_name" class="field-label">

		<label for="input_name">
			<h4 class="field-title" id="Organization Title">Organization Title</h4>
		</label>

	</div><!-- field label-->
				

	<div id="field_name" class="field field-type-text">
	
		<input class="input-name" id="input_name" placeholder="" data-validation="" name="name" type="text"> 
		
	
	</div><!-- field -->
</div> --}}