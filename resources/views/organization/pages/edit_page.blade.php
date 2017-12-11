@if(Auth::guard('admin')->check() == true)
  @php
        $from = 'admin';
        $layout = 'admin.layouts.main';
        $route = 'admin.update.page';
  @endphp
@else
  @php
        $from = 'org';
        $layout = 'layouts.main';
        $route = 'update.page';

  @endphp
@endif
@extends($layout)
@section('content')
	<style type="text/css">
		.page-widgets > .boxed{
			border:1px solid #e8e8e8;
			margin-bottom: 15px;
		}
		.hidden{
			display: none;
		}
		#field_1141{
			top:50px;
		}
		.page-widgets > .boxed > .header{
			background-color: #e8e8e8;
			padding:10px;
		}
		.page-widgets > .boxed > .header > i{
			float: right;
			color: #757575
		}
		.page-widgets > .boxed > .content{
			padding: 10px
		} 
		.page-widgets > .boxed > .content > .tags > span{
			background-color: #e8e8e8;
			padding: 5px;
			color:#676767;
			border-radius: 2px;
			display: inline-block;
			margin: 0 5px 5px 0;
		}
		.page-widgets > .boxed > .content > .tags > span > i{
			margin-left: 5px
		}
	</style>
	{{-- <div class="row">
		<div class="col l12">
			<h5>Edit Details</h5>
			<div>
			{!! Form::model($page,['route'=>'update.page' ])!!}
				@include ('organization.pages._form')
			{!! Form::close()!!}
			</div>
		</div>
		
	</div> --}}
	@php
	$page_title_data = array(
	    'show_page_title' => 'yes',
	    'show_add_new_button' => 'no',
	    'show_navigation' => 'yes',
	    'page_title' => 'Edit Page <span>'.$page->title.'</span>',
	    'add_new' => '+ Add Media'
	); 
	@endphp
	<style type="text/css">
		textarea[name=content] , textarea[name=html_viewer]{
			height: 380px;
		}
		textarea[name=html_viewer]{
			position: absolute;
		}
	</style> 
	@include('common.pageheader',$page_title_data) 
	@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		@include('organization.pages._tabs')
		{!! Form::model($page,['route' => $route , 'method' => 'post']) !!}
			<div class="aione-row" style="position: relative;">
				<div style="position: absolute;right: 0;top: -60px">
					{{-- <div style="display: inline-block;width: 172px;">
						{!! FormGenerator::GenerateField('select_status') !!}	
					</div> --}}

					@php
						if(Auth::guard('admin')->check()){
							$route = 'view.pages';
						}else{
							$route = 'view.pages';
						}
					@endphp
					<a href="{{ route($route ,$page->slug ) }}" class="aione-button aione-button-small aione-button-light aione-button-square add-new-button" style="line-height: 40px">Preview</a>
					<button type="submit" style="display: inline-block;line-height: 18px;margin-left: 10px">Update</button>
				</div>
				<div class="l6" style="width: 75%;float: left;padding-right:15px ">
					{{-- <textarea rows="14" class="html_preview"></textarea> --}}
					{!! FormGenerator::GenerateForm('edit_page_form') !!}
					<div class="visual hidden">
						<div class="aione-wrapper">
							<div class="aione-header bg-white aione-border-bottom">
								<div class="ar">
									<div class="ac s80 m80 l80 p-5">
										<img src="http://aioneframework.com/assets/images/aione-framework-logo-small.png" height="30">
									</div>
									<div class="ac s20 m20 l20 aione-align-right p-5">
										<button id="builder_switch" class="ph-20 pv-3">Edit</button>
									</div>
								</div>
							</div>
							<div class="aione-main">
								<div class="ar">
									<div class="ac s100 m100 l100 pv-30 ph-40 ">
										<div class="aione-builder-wrapper mode-preview">
											<div id="aione_builder" class="aione-builder preview aione-border">
												<section class="p-50" id="aione_section">					
												</section>
												
												<!-- <section class="p-50">					
													<div class="ar">
													</div>
												</section>
												<section class="p-50"  id="aione_section">					
													<div class="ar" >
														<div class="ac s100 m50 l50"> </div>
													</div>
												</section>
												<section class="p-50"  id="aione_section">					
													<div class="ar">
														<div class="ac s100 m50 l50"> </div>
														<div class="ac s100 m50 l50"> </div>
													</div>
												</section> -->
												<section class="p-50"  id="aione_section">
													<div class="aione-section-handle"></div>

													<div class="ar bg-red bg-lighten-4">
														<div class="ac s100 m75 l75">
															<div class="aione-col-handle"></div>

															<div class="aione-wrapper aione-border mb-20">
																<div class="aione-title aione-align-center aione-border-bottom">
																	<h4 class="">Web Design</h4>
																</div>
																<div class="description p-10">
																	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, vero? <br><br>Officiis ratione, nesciunt vel corrupti adipisci. Voluptates expedita sequi dolores.
																</div>
															</div>
															<div class="ar aione-border m-10 p-5">

																<div class="ac s100 m50 l25 p-10 bg-red">123</div>
																<div class="ac s100 m50 l25 p-10 bg-green">234</div>
																<div class="ac s100 m50 l25 p-10 bg-blue">345</div>
															</div>

														</div>

														<div class="ac s100 m50 l25">
															<div class="aione-col-handle"></div>

															<div class="aione-wrapper aione-border mb-20">
																<div class="aione-title aione-align-center aione-border-bottom">
																	<h4 class="">Logo Design</h4>
																</div>
																<div class="description p-10">
																	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, vero? <br><br>Officiis ratione, nesciunt vel corrupti adipisci. Voluptates expedita sequi dolores.
																</div>
															</div>
														</div>

														<div class="ac s100 m50 l25">
															<div class="aione-col-handle"></div>

															<div class="aione-wrapper aione-border mb-20">
																<div class="aione-title aione-align-center aione-border-bottom">
																	<h4 class="">Android Application</h4>
																</div>
																<div class="description p-10">
																	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, vero? <br><br>Officiis ratione, nesciunt vel corrupti adipisci. Voluptates expedita sequi dolores.
																</div>
															</div>
														</div>

														<div class="ac s100 m50 l25">
															<div class="aione-col-handle"></div>

															<div class="aione-wrapper aione-border mb-20">
																<div class="aione-title aione-align-center aione-border-bottom">
																	<h4 class="">Web Application</h4>
																</div>
																<div class="description p-10">
																	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, vero? <br><br>Officiis ratione, nesciunt vel corrupti adipisci. Voluptates expedita sequi dolores.
																</div>
															</div>
														</div>

													</div>

													<div class="ar bg-blue-grey bg-lighten-4">

														<div class="ac s100 m50 l25">
															<div class="aione-col-handle"></div>
															<div class="aione-wrapper aione-border mb-20">
																<div class="aione-title aione-align-center aione-border-bottom">
																	<h4 class="">Domain Name</h4>
																</div>
																<div class="description p-10">
																	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, vero? <br><br>Officiis ratione, nesciunt vel corrupti adipisci. Voluptates expedita sequi dolores.
																</div>
															</div>
														</div>

														<div class="ac s100 m50 l25">
															<div class="aione-col-handle"></div>
															<div class="aione-wrapper aione-border mb-20">
																<div class="aione-title aione-align-center aione-border-bottom">
																	<h4 class="">Web Hosting</h4>
																</div>
																<div class="description p-10">
																	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, vero? <br><br>Officiis ratione, nesciunt vel corrupti adipisci. Voluptates expedita sequi dolores.
																</div>
															</div>
														</div>

														<div class="ac s100 m50 l25">
															<div class="aione-col-handle"></div>
															<div class="aione-wrapper aione-border mb-20">
																<div class="aione-title aione-align-center aione-border-bottom">
																	<h4 class="">ERP Solutions</h4>
																</div>
																<div class="description p-10">
																	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, vero? <br><br>Officiis ratione, nesciunt vel corrupti adipisci. Voluptates expedita sequi dolores.
																</div>
															</div>
														</div>

														<div class="ac s100 m50 l25">
															<div class="aione-col-handle"></div>
															<div class="aione-wrapper aione-border mb-20">
																<div class="aione-title aione-align-center aione-border-bottom">
																	<h4 class="">ANALYSIS</h4> 
																</div>
																<div class="description p-10">
																	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, vero? <br><br>Officiis ratione, nesciunt vel corrupti adipisci. Voluptates expedita sequi dolores.
																</div>
															</div>
														</div>
													</div>
												</section>
												<section class="p-50">
													<div class="aione-section-handle"></div>
													<div class="ar bg-red bg-lighten-4">
														<div class="ac s100 m50 l25">
															<div class="aione-col-handle"></div>

															<div class="aione-wrapper aione-border mb-20">
																<div class="aione-title aione-align-center aione-border-bottom">
																	<h4 class="">Web Design</h4>
																</div>
																<div class="description p-10">
																	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, vero? <br><br>Officiis ratione, nesciunt vel corrupti adipisci. Voluptates expedita sequi dolores.
																</div>
															</div>
														</div>

														<div class="ac s100 m50 l25">
															<div class="aione-wrapper aione-border mb-20">
																<div class="aione-title aione-align-center aione-border-bottom">
																	<h4 class="">Logo Design</h4>
																</div>
																<div class="description p-10">
																	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, vero? <br><br>Officiis ratione, nesciunt vel corrupti adipisci. Voluptates expedita sequi dolores.
																</div>
															</div>
														</div>

														<div class="ac s100 m50 l25">
															<div class="aione-wrapper aione-border mb-20">
																<div class="aione-title aione-align-center aione-border-bottom">
																	<h4 class="">Android Application</h4>
																</div>
																<div class="description p-10">
																	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, vero? <br><br>Officiis ratione, nesciunt vel corrupti adipisci. Voluptates expedita sequi dolores.
																</div>
															</div>
														</div>

														<div class="ac s100 m50 l25">
															<div class="aione-wrapper aione-border mb-20">
																<div class="aione-title aione-align-center aione-border-bottom">
																	<h4 class="">Web Application</h4>
																</div>
																<div class="description p-10">
																	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, vero? <br><br>Officiis ratione, nesciunt vel corrupti adipisci. Voluptates expedita sequi dolores.
																</div>
															</div>
														</div>

													</div>

													<div class="ar bg-blue-grey bg-lighten-4" id="aione_columns2">
														<div class="ac s100 m50 l25">
															<div class="aione-wrapper aione-border mb-20">
																<div class="aione-title aione-align-center aione-border-bottom">
																	<h4 class="">Domain Name</h4>
																</div>
																<div class="description p-10">
																	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, vero? <br><br>Officiis ratione, nesciunt vel corrupti adipisci. Voluptates expedita sequi dolores.
																</div>
															</div>
														</div>

														<div class="ac s100 m50 l25">
															<div class="aione-wrapper aione-border mb-20">
																<div class="aione-title aione-align-center aione-border-bottom">
																	<h4 class="">Web Hosting</h4>
																</div>
																<div class="description p-10">
																	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, vero? <br><br>Officiis ratione, nesciunt vel corrupti adipisci. Voluptates expedita sequi dolores.
																</div>
															</div>
														</div>

														<div class="ac s100 m50 l25">
															<div class="aione-wrapper aione-border mb-20">
																<div class="aione-title aione-align-center aione-border-bottom">
																	<h4 class="">ERP Solutions</h4>
																</div>
																<div class="description p-10">
																	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, vero? <br><br>Officiis ratione, nesciunt vel corrupti adipisci. Voluptates expedita sequi dolores.
																</div>
															</div>
														</div>

														<div class="ac s100 m50 l25">
															<div class="aione-wrapper aione-border mb-20">
																<div class="aione-title aione-align-center aione-border-bottom">
																	<h4 class="">ANALYSIS</h4> 
																</div>
																<div class="description p-10">
																	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, vero? <br><br>Officiis ratione, nesciunt vel corrupti adipisci. Voluptates expedita sequi dolores.
																</div>
															</div>
														</div>
													</div>
												</section>
												<!-- <section class="p-50">
													<div class="aione-section-handle"></div>
													<a href="#" class="aione-add-row-button">Add Row</a>

												</section>
												<section class="p-50">
													<div class="aione-section-handle"></div>
													<div class="ar">
														<a href="#" class="aione-add-column-button">Add Column</a>
														
													</div>
													<a href="#" class="aione-add-row-button">Add Row</a>
												</section> -->
													
												<section class="p-50">

													<div class="ar">
														<div class="aione-options">
															<div class="aione-option-bar">
																<div class="aione-option-left-bar">
																	<span>
																		<a href="#" class="aione-section-handle"">
																			<i class="fa fa-bars"></i> 
																		</a>
																	</span>
																</div>
																<div class="aione-option-right-bar">
																	<span>
																		<a href="#" class="incress-width">
																			<i class="fa fa-plus"></i>
																		</a>
																	</span>
																	<span>
																		<a href="#" class="decress-width">
																			<i class="fa fa-minus"></i>
																		</a>
																	</span>
																	<span>
																		<a href="#" class="clone">
																			<i class="fa fa-clone"></i>
																		</a>
																	</span>
																	<span>
																		<a href="#">
																			<i class="fa fa-cogs"></i>
																		</a>
																	</span>
																	<span>
																		<a href="#" class="delete-column">
																			<i class="fa fa-times"></i>
																		</a>
																	</span>
																</div>
															</div>
														</div>
														<div class="ac s100 m50 l100"> ghjghgjhg </div>
														<a href="#" class="aione-add-column-button">Add Column</a>
													</div>
													<a href="#" class="aione-add-row-button">Add Row</a>
												</section>
												
											</div>
											<div class="aione-builder-elements aione-border" id="aione-builder-elements">
												<h3 class="aione_collapse_element">Layout <a href="#"><i class="fa fa-minus fa-plus"></i></a></h3>
												<div>
													<label>Section</label>
													<div id="aione_elements_section">
														<section></section>
														<section id="aione_section_about" class="aione-section-about">	
															<div class="wrapper">
																<div class="ar">
																	<div class="ac s100 m50 s25">
																	
																	</div>
																</div>
															</div>			
														</section>
													</div>
													<label>Row</label>
													<div id="aione_elements_row">
														<div class="ar"></div>
													</div>
													<label>Column</label>
													<div id="aione_elements_columns">
														<div class="ac s100 m100 l100"> </div>
													</div>
													
												</div>
											</div>

											<div class="aione-builder-elements aione-border" id="aione-builder-elements">
												<h3 class="aione_collapse_element">Element <a href="#"><i class="fa fa-minus fa-plus"></i></a></h3>
												
												<div id="aione_elements">
													<div class="aione-title" id="aione_element"><h1> Heading 1 </h1></div>
													<div class="aione-title" id="aione_h2"><h2> Heading 2 </h2></div>
													<div class="aione-title" id="aione_h3"><h3> Heading 3 </h3></div>
													<div class="aione-title" id="aione_h4"><h4> Heading 4 </h4></div>
													<div class="aione-title" id="aione_h5"><h5> Heading 5 </h5></div>
													<div class="aione-title" id="aione_h6"><h6> Heading 6 </h6></div>
												</div>
											</div>
											<div class="clear"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="bg-blue-grey bg-darken-4 p-50">
								<div class="aione-align-center">
									&copy;2017 OXO Solutions. All rights reserved.
								</div>
							</div>
						</div>	
					</div>

				</div>
				@php
					$uri = explode('/',request()->route()->uri);
				@endphp
				<div class="l6 page-widgets" style="width: 25%;float: left">
					<input type="hidden" name="id" value="{{ request()->route()->parameters()['id'] }}">
					{!! FormGenerator::GenerateForm('page_options_form') !!}
				</div>
			</div>
			{{-- <button type="submit">Save</button> --}}
		{!! Form::close() !!}
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
		<script type="text/javascript">
			$(document).on('click','.add',function(){
				var tag = $(this).parents('.field-wrapper').prev().find('.input-tag').val();
				$('#input_tag').val('');
				$(this).parents('.field-wrapper').next().append('<span>'+tag+'<i class="fa fa-close"></i></span>');
			})
		</script>
	@include('common.page_content_secondry_end')
	@include('common.pagecontentend')
	<script type="text/javascript">
		$(document).ready(function(){
			// $('.html_preview').hide();
			$('input[name=mode]').change(function(){
				if($(this).val() == 'visual'){
					$('.field-wrapper-type-code').hide();
					$('.visual').removeClass('hidden');
				}else{
					$('.field-wrapper-type-code').show();
					$('.visual').addClass('hidden');
				}
			});
		});
	</script>
@endsection()