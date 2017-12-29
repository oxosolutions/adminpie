@php
$sidebar_small = 1;
	$orgData = App\Model\Admin\GlobalGroup::where('id',Auth::guard('group')->user()->group_id)->first();

	$sidebar_small = App\Model\Group\GroupUserMeta::where(['user_id'=>Auth::guard('group')->user()->id,'key'=>'layout_sidebar_small'])->first();

	if(!empty($sidebar_small)){
		$sidebar_small = $sidebar_small->value;
	}
@endphp
<style type="text/css">
	.aione-main.sidebar-small .side-bar-text{
		display: none
	}
</style>
<input type="hidden"  name="_token" value="{{ csrf_token() }}">
<div id="aione_header_left" class="aione-header-left">
	<div class="aione-row">
		<div class="aione-header-item aione-nav-toggle">
			<a href="#" class="nav-toggle {{($sidebar_small == 1)?'active':''}}"></a>
		</div>
		@if(@$show_logo)
			@if(!empty($site_logo))
				<div class="aione-header-item aione-logo">
					<img src="{{asset($site_logo)}}" />
				</div> <!-- .aione-header-item -->
			@endif
		@endif
				<div class="aione-header-item aione-site-title">
					 <h1 class="site-title">{{ $orgData->name }}</h1>
				</div> <!-- .aione-header-item -->
		@if(@$show_tagline)
			@if(!empty($site_tagline))
				<div class="aione-header-item aione-site-tagline">
					<h2 class="site-tagline">{{$site_tagline}}</h2>
				</div> <!-- .aione-header-item -->
			@endif
		@endif
	</div><!-- .aione-row -->
</div><!-- #aione_header_left -->
<div id="aione_header_right" class="aione-header-right">
	<div class="aione-row">
	
		<div class="aione-header-item aione-profile">
			<a href="#">
				<img class="user-avatar" src="{{asset('assets/images/user.png')}}" >
			</a>
			<div class="aione-header-widget aione-profile-widget">
				<div class="aione-row">
					<div class="aione-widget-header">
						<h3 class="aione-widget-title">
							Welcome 
							@if(Auth::guard('group')->check())
								{{@Auth::guard('group')->user()->name}}
							@endif
						</h3>
					</div> <!-- .aione-widget-header -->
					<div class="aione-widget-content">
						<ul class="profile-menu">
							<!--
							<li><a href="#" class="">Profile</a></li>
							
							{{-- <li>{{user_info()}}</li> --}}
							<li><a href="#" class="">Privacy</a></li>
							<li><a href="#" class="">Notifications</a></li>
							<li><a href="#" class="">Settings</a></li>
							-->
						</ul>

					</div> <!-- .aione-widget-content -->
					<div class="aione-widget-footer">
						<div class="aione-widget-footer-left">

						</div> <!-- .aione-widget-footer-left -->
						<div class="aione-widget-footer-right">
							<a href="{{route('group.logout')}}" class="button aione-button aione-button-small aione-logout-button">Logout</a>
						</div> <!-- .aione-widget-footer-right -->
					</div> <!-- .aione-widget-footer -->
					
				</div> <!-- .aione-row -->
			</div> <!-- .aione-header-widget -->
			
		</div> <!-- .aione-header-item -->
		
		{{-- <div class="aione-header-item aione-notifications">
			<a href="#"><span class="aione-icon"><i class="fa fa-bell"></i></a>
			<div class="aione-header-widget aione-notifications-widget">
				<div class="aione-row">
					<div class="aione-widget-header">
						<h3 class="aione-widget-title">
							Notifications 
						</h3>
					</div> <!-- .aione-widget-header -->
					<div class="aione-widget-content">


					</div> <!-- .aione-widget-content -->
					<div class="aione-widget-footer">

					</div> <!-- .aione-widget-footer -->
				
				</div> <!-- .aione-row -->
			</div> <!-- .aione-header-widget -->
			
		</div> <!-- .aione-header-item --> --}}
		
		{{-- <div class="aione-header-item aione-activity">
			<a href="#"><span class="aione-icon"><i class="fa fa-circle-o"></i></a>
			<div class="aione-header-widget aione-activity-widget">
				<div class="aione-row">
					<div class="aione-widget-header">
						<h3 class="aione-widget-title">
							Activity 
						</h3>
					</div> <!-- .aione-widget-header -->
					<div class="aione-widget-content">


					</div> <!-- .aione-widget-content -->
					<div class="aione-widget-footer">

					</div> <!-- .aione-widget-footer -->
				</div> <!-- .aione-row -->
			</div> <!-- .aione-header-widget -->
			
		</div> <!-- .aione-header-item --> --}}
		
		{{-- <div class="aione-header-item aione-chat">
			<a href="#"><span class="aione-icon"><i class="fa fa-comments"></i></a>
			<div class="aione-header-widget aione-chat-widget">
				<div class="aione-row">
					<div class="aione-widget-header">
						<h3 class="aione-widget-title">
							Messages 
						</h3>
					</div> <!-- .aione-widget-header -->
					<div class="aione-widget-content">


					</div> <!-- .aione-widget-content -->
					<div class="aione-widget-footer">

					</div> <!-- .aione-widget-footer -->
				</div> <!-- .aione-row -->
			</div> <!-- .aione-header-widget -->
			
		</div> <!-- .aione-header-item --> --}}
		
		{{-- <div class="aione-header-item aione-clock"> 
			<div class="" id="clock"></div>
		</div> <!-- .aione-header-item --> --}}
		
		{{-- <div class="aione-header-item aione-clock"> 
			<div class=""></div>
		</div> <!-- .aione-header-item --> --}}
	
	</div><!-- .aione-row -->
</div><!-- #aione_header_right -->