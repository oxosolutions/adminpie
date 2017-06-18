@extends('admin.layouts.main')
@section('content')
<div class="fade-background">

</div>
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col s12 m12 l12 " >
			{{-- <div class="list" id="list">
			@php
				$index = 2;
			@endphp
				@foreach($model as $key => $form)
					<div class="card-panel shadow white z-depth-1 hoverable project"  >

						<div class="row valign-wrapper no-margin-bottom">
							<div class="col l1 s2 center-align project-image-wrapper">
								<a href="javascript:void(0)" data-toggle="popover" title="Click here to view details" data-content="TEST">
								<div class="defualt-logo">
									{{ucfirst($form->form_title[0])}}
								</div>
								</a>
							</div>
							
							<div class="col l11 s10 editable " >
								<div class="row m-0 valign-wrapper">
									<div class="col  l6">
										<input type="hidden" value="1212" class="shift_id" >
										<input type="hidden" name="_token" value="{{csrf_token()}}" class="shift_token" >
										
											<h5 title="click here to edit the section name" class="project-title black-text flow-text truncate line-height-35">
												<span class="project-name shift_name font-size-14">{{$form->form_title}}</span>
											</h5>
									</div>
									
									<div class="col l6 right-align">
										<div class="row valign-wrapper">
											<div class="col l4">
												{{$form->form_slug}}
											</div>
											<div class="col l4">
												<span class="blue white-text" style="padding: 2px 4px">{{count($form->section)}}</span>
											</div>
											<div class="col l4">
											
												 <a class='dropdown-button btn blue' href='#' data-activates='d{{$index}}'>Actions</a>

												 
												  <ul id='d{{$index}}' class='dropdown-content'>
												    <li><a href="{{route('delete.form',[$form->id])}}">Delete</a></li>
												    <li><a href="{{route('list.sections',[$form->id])}}">Sections</a></li>
												    
												  </ul>
											</div>

										</div>
										@php
											$index++;
										@endphp									
									</div>
								</div>
							</div>
						</div>
							
					</div>			
				@endforeach
			</div> --}}
		</div>
	</div>
	<div class="row">
		@include('common.list.datalist')
	</div>
</div>
<script type="text/javascript">

</script>
@endsection