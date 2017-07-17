@extends('layouts.main')
@section('content')
<div>
@php
// dd($model);
	$data = [];
	$index = 0;
	$model2 = [];
@endphp
    @include('organization.project._tabs')
    	@php
    		$model2['website_title'] = $model[0]->website_title;
    		$model2['login_url'] = $model[0]->login_url;
    		$model2['redirect_url'] = $model[0]->redirect_url;
    		$model2['project_id'] = $model[0]->project_id;
    	@endphp

{{-- 		@foreach(json_decode($model->data) as $key => $value)
			@foreach($value as $k => $v)
				@php
					$model2[$k][$key] = $v;
				@endphp
			@endforeach
		@endforeach  --}}   

	<div id="projects" class="projects list-view">
	    <div class="row">

			<div class="col s12 m3 l12 pl-7" >
				{!! Form::model($model2,['route' => 'update.crediental' , 'method' => 'POST']) !!}
						<input type="hidden" name="id" value="{{$model[0]->id}}">
						{!!FormGenerator::GenerateSection('cresec1',['type'=>'inset'])!!}
						{{-- {!!FormGenerator::GenerateSection('cresec2',['type'=>'inset'],$model2)!!} --}}
							@foreach($model as $key => $value)
								@foreach(json_decode($value->data) as $k => $v)
									<div id="repeat">
										<div class="row" style="padding:15px 10px; ">
											<div>
												<i class="fa fa-close delete-row" style="float: right"></i>
											</div>
											<div class="col l12">
												<div class="col s12 m2 l12 aione-field-wrapper">
													<input class="no-margin-bottom aione-field" value="{{$v->title}}" placeholder="Title" name="title[]" type="text">
												</div>
												<div class="error-red"></div>

												<div class="col s12 m2 l12 aione-field-wrapper">
											 		<input class="no-margin-bottom aione-field" value="{{$v->email}}" placeholder="Username or Email" name="email[]" type="text">
												</div>
												<div class="error-red">	</div>
												
												<div class="col s12 m2 l12 aione-field-wrapper">
													<input class="no-margin-bottom aione-field" value="{{$v->password}}" placeholder="Password" name="password[]" type="password" value="">
												</div>
												<div class="error-red"></div>
									
											</div>
											
										</div>	
									</div>
									
									
								@endforeach
								@php
									$index++;
								@endphp
							@endforeach
							<div>
								<a href="javascript:;" class="btn blue add-row">Add Row</a>
							</div>
							@if(request()->route()->parameters()['id'])
								<input type="hidden" name="project_id" value="{{request()->route()->parameters()['id']}}">
							@endif
							<input type="submit" class="btn btn-primary" name="submit" value="submit">
				{!! Form::close() !!}
			
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	   
    .projects-logo{
        
        background-color: #000;margin: 10%;

    }
    .p-15{
        padding: 15px !important;
    }
    .pv-5{
        padding: 5px 0px !important; 
    }
    .project-logo{
        color: white;width: 70px;margin: 0 auto; line-height: 70px;font-size: 24px;border-radius: 50%
    }
</style>
<script type="text/javascript">
		$(document).ready(function(){
			$('#modal2').modal({
				 dismissible: false
			});
			
		})

	  $(".add-row").click(function(){
	  		
	        $("#repeat").append('<div class="row" style="padding:15px 10px; "> <div class="col l12"> <div> <i class="fa fa-close delete-row" style="float: right"></i> </div><div class="col s12 m2 l12 aione-field-wrapper"> <input class="no-margin-bottom aione-field"  placeholder="Title" name="title[]" type="text"> </div> <div class="error-red"></div> <div class="col s12 m2 l12 aione-field-wrapper"> <input class="no-margin-bottom aione-field"  placeholder="Username or Email" name="email[]" type="text"> </div> <div class="error-red"> </div> <div class="col s12 m2 l12 aione-field-wrapper"> <input class="no-margin-bottom aione-field"  placeholder="Password" name="password[]" type="password" value=""> </div> <div class="error-red"></div> </div> </div>');
	        $('.delete-row').show();
	    });
	    $("#repeat").on('click','.delete-row',function(){
	        $(this).parent().parent().remove();
	        countAppendedRows();
	    });
	    function countAppendedRows() {
	    	if($('#repeat').find('.row').length == 1 ){
		    	$('.delete-row').hide();
		    }
	    }
	    countAppendedRows();
					
</script>
@endsection	