@extends('layouts.main')
@section('content')
<div>
    @include('organization.project._tabs')
    <div class="fade-background">
	</div>
	<div id="projects" class="projects list-view">
	    <div class="row">
			<div class="col s12 m9 l9 pr-7" >
				<div class="row no-margin-bottom">
					<div class="col s12 m12 l6  pr-7 tab-mt-10" >
						<!-- <input class="search aione-field" placeholder="Search" /> -->
						<nav>
						    <div class="nav-wrapper">
						      	<form>
							        <div class="input-field">
							          	<input id="search" type="search" required style="background-color: #ffffff">
							          	<label class="label-icon" for="search" style=""><i class="material-icons icon-search" >search</i></label>
							          	<i class="material-icons icon-close">close</i>
							        </div>
						      	</form>
						    </div>
						</nav>
					</div>
					<div class="col s6 m6 l3  aione-field-wrapper pl-7 tab-mt-10">
						<div class="row aione-sort" style="">
							<select class="col  browser-default aione-field" >
								<option value="" disabled selected>Sort By</option>
								<option value="1">Name</option>
								<option value="2">Date</option>
							</select>
							<div class="col alpha-sort" style="width: 25%;padding-left:7px;">
								<a href="javascript:;" class="sort" ><i class="fa fa-sort-alpha-asc arrow_sort white" ></i></a>
							</div>
						</div>
					</div>

					<div class="col s6 m6 l3 pl-7 right-float tab-mt-10 tab-pl-10">
						<div class="row aione-switch-view">
							<ul class="right  views m-0" >
								<li class="inline-block" sty><a href="#list-view" class=" view" data-view="list-view"><i class="material-icons" >view_list</i></a></li>
								
								

								<li class="inline-block" ><a href="#detail-view" class=" view" data-view="detail-view"><i class="material-icons" >view_stream</i></a></li>


								<li class="inline-block" ><a href="#grid-view" class=" view" data-view="grid-view"><i class="material-icons" >view_module</i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="list" id="list">
					<div class="card-panel shadow white z-depth-1 hoverable project"  >
						<div class="row valign-wrapper no-margin-bottom">
							<div class="col l1 s2 center-align project-image-wrapper">
								<a href="{{-- {{route('add_project_info.project', ['id' => $projVal->id])}} --}}" data-toggle="popover" title=" " data-content="TEST">
								{{-- <img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" alt="" class="project-image circle responsive-img">  --}}
								<div class="defualt-logo">
									G
								</div>
								</a>
							</div>					
							<div class="col l11 s10 editable " >
								<div class="row m-0 valign-wrapper">
									<div class="col s8 m8 l8">
										
										<input type="hidden" name="_token" value="" class="shift_token" >
										
										<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" >
											<h5 class="project-title black-text flow-text truncate line-height-35">
												<span class="project-name shift_name font-size-14" contenteditable="true" > Gmail.com</span>
											</h5>
										</a>
									</div>
									
									<div class="col s4 m4 l4 right-align">
										<a href="" >Get Credentials</a>
									</div>
								</div>
							</div>
						</div>
							
					</div>
					<div class="card-panel shadow white z-depth-1 hoverable project"  >
						<div class="row valign-wrapper no-margin-bottom">
							<div class="col l1 s2 center-align project-image-wrapper">
								<a href="{{-- {{route('add_project_info.project', ['id' => $projVal->id])}} --}}" data-toggle="popover" title=" " data-content="TEST">
								{{-- <img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" alt="" class="project-image circle responsive-img">  --}}
								<div class="defualt-logo">
									f
								</div>
								</a>
							</div>					
							<div class="col l11 s10 editable " >
								<div class="row m-0 valign-wrapper">
									<div class="col s8 m8 l8">
										
										<input type="hidden" name="_token" value="" class="shift_token" >
										
										<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" >
											<h5 class="project-title black-text flow-text truncate line-height-35">
												<span class="project-name shift_name font-size-14" contenteditable="true" >facebook.com</span>
											</h5>
										</a>
									</div>
									
									<div class="col s4 m4 l4 right-align">
										<a href="" >Get Credentials</a>
									</div>
								</div>
							</div>
						</div>
							
					</div>
					
				</div>
			</div>

			<div class="col s12 m3 l3 pl-7" >
				<a id="add_new" href="#" class="btn add-new display-form-button" >
					Add Credential
				</a>
				<div id="add_new_wrapper" class="add-new-wrapper add-form ">
					

						<div class="row no-margin-bottom">
							<div class="col s12 m2 l12 aione-field-wrapper">
								<input name="name" class="no-margin-bottom aione-field" type="text" placeholder="Credential For" />
							</div>
							<div class="col s12 m2 l12 aione-field-wrapper">
								<input name="name" class="no-margin-bottom aione-field" type="text" placeholder="Login" />
							</div>
							<div class="col s12 m2 l12 aione-field-wrapper">
								<input name="name" class="no-margin-bottom aione-field" type="password" placeholder="Password" />
							</div>

							<div class="col s12 m6 l12 aione-field-wrapper">
								<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save Credential
									<i class="material-icons right">save</i>
								</button>
							</div>
						</div>
					

				</div>
				<div class="card-panel shadow mt-22" >
					clients
				</div>
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
	$('.add-new').off().click(function(e){
			e.preventDefault();
			$('.add-new-wrapper').toggleClass('active');
			$('.fade-background').fadeToggle(300);
		});
		
		$('.fade-background').click(function(){
			$('.fade-background').fadeToggle(300);
			$('.add-new-wrapper').toggleClass('active');
		});
</script>
@endsection	