{{ dd(21231) }}
@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'no',
	'page_title' => 'Chat',
	'add_new' => '+ Add Dashboard'
	); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	<div class="ar aione-border">
		<div class="ac l25 m25 s25 aione-border-right p-0">
			<div class="bg-grey bg-lighten-5 ">
				<div class="ar">
					<div class="ac l50 pv-6">
						<img src="http://fuse-angular-material.withinpixels.com/assets/images/avatars/Boyle.jpg" class="profile-avatar" style="">
					</div>
					<div class="ac l50 aione-align-right">
						<i class="fa fa-search font-size-20 line-height-60"></i>
					</div>
				</div>				
				<div class="ar aione-align-center p-10">
					<a href="" class="mr-10">Users</a>
					<a href="" class="mr-10">Groups</a>
					<a href="" class="mr-10">Organizations</a>
				</div>
			</div>
			<div class="contact-list">
				<ul>
					<li class="ar aione-border-bottom p-8" style="position: relative;">
						<span><img src="http://fuse-angular-material.withinpixels.com/assets/images/avatars/Velazquez.jpg" class="contact-avatar" style=""></span>
						<div class=" display-inline-block line-height-20 font-weight-600 valign-top">Fabrizio Cedrone<br><span class="line-height-12 font-size-12 font-weight-400">This is the status of the user</span></div>
						<span class="aione-float-right bg-green" style="width: 8px;height: 8px;position: absolute;right: 10px;top: calc(50% - 4px);border-radius: 50%"></span>
					</li>
					<li class="ar aione-border-bottom p-8">
						<span><img src="http://fuse-angular-material.withinpixels.com/assets/images/avatars/Arnold.jpg" class="contact-avatar"></span>
						<div class=" display-inline-block line-height-20 font-weight-600 valign-top">Alessia Caravaggio<br><span class="line-height-12 font-size-12 font-weight-400">This is the status of the user</span></div>
					</li>
					<li class="ar aione-border-bottom p-8">
						<span><img src="http://fuse-angular-material.withinpixels.com/assets/images/avatars/Velazquez.jpg" class="contact-avatar"></span>
						<div class=" display-inline-block line-height-20 font-weight-600 valign-top">Fabrizio Cedrone<br><span class="line-height-12 font-size-12 font-weight-400">This is the status of the user</span></div>
					</li>
					<li class="ar aione-border-bottom p-8">
						<span><img src="http://fuse-angular-material.withinpixels.com/assets/images/avatars/Arnold.jpg" class="contact-avatar"></span>
						<div class=" display-inline-block line-height-20 font-weight-600 valign-top">Alessia Caravaggio<br><span class="line-height-12 font-size-12 font-weight-400">This is the status of the user</span></div>
					</li>
					<li class="ar aione-border-bottom p-8">
						<span><img src="http://fuse-angular-material.withinpixels.com/assets/images/avatars/Velazquez.jpg" class="contact-avatar"></span>
						<div class=" display-inline-block line-height-20 font-weight-600 valign-top">Fabrizio Cedrone<br><span class="line-height-12 font-size-12 font-weight-400">This is the status of the user</span></div>
					</li>
					<li class="ar aione-border-bottom p-8">
						<span><img src="http://fuse-angular-material.withinpixels.com/assets/images/avatars/Arnold.jpg" class="contact-avatar"></span>
						<div class=" display-inline-block line-height-20 font-weight-600 valign-top">Alessia Caravaggio<br><span class="line-height-12 font-size-12 font-weight-400">This is the status of the user</span></div>
					</li>
					<li class="ar aione-border-bottom p-8">
						<span><img src="http://fuse-angular-material.withinpixels.com/assets/images/avatars/Velazquez.jpg" class="contact-avatar"></span>
						<div class=" display-inline-block line-height-20 font-weight-600 valign-top">Fabrizio Cedrone<br><span class="line-height-12 font-size-12 font-weight-400">This is the status of the user</span></div>
					</li>
					<li class="ar aione-border-bottom p-8">
						<span><img src="http://fuse-angular-material.withinpixels.com/assets/images/avatars/Arnold.jpg" class="contact-avatar"></span>
						<div class=" display-inline-block line-height-20 font-weight-600 valign-top">Alessia Caravaggio<br><span class="line-height-12 font-size-12 font-weight-400">This is the status of the user</span></div>
					</li>
					<li class="ar aione-border-bottom p-8">
						<span><img src="http://fuse-angular-material.withinpixels.com/assets/images/avatars/Velazquez.jpg" class="contact-avatar"></span>
						<div class=" display-inline-block line-height-20 font-weight-600 valign-top">Fabrizio Cedrone<br><span class="line-height-12 font-size-12 font-weight-400">This is the status of the user</span></div>
					</li>
					<li class="ar aione-border-bottom p-8">
						<span><img src="http://fuse-angular-material.withinpixels.com/assets/images/avatars/Arnold.jpg" class="contact-avatar"></span>
						<div class=" display-inline-block line-height-20 font-weight-600 valign-top">Alessia Caravaggio<br><span class="line-height-12 font-size-12 font-weight-400">This is the status of the user</span></div>
					</li>
					<li class="ar aione-border-bottom p-8">
						<span><img src="http://fuse-angular-material.withinpixels.com/assets/images/avatars/Velazquez.jpg" class="contact-avatar"></span>
						<div class=" display-inline-block line-height-20 font-weight-600 valign-top">Fabrizio Cedrone<br><span class="line-height-12 font-size-12 font-weight-400">This is the status of the user</span></div>
					</li>
					<li class="ar aione-border-bottom p-8">
						<span><img src="http://fuse-angular-material.withinpixels.com/assets/images/avatars/Arnold.jpg" class="contact-avatar"></span>
						<div class=" display-inline-block line-height-20 font-weight-600 valign-top">Alessia Caravaggio<br><span class="line-height-12 font-size-12 font-weight-400">This is the status of the user</span></div>
					</li>
					
					
				</ul>
			</div>
		</div>
		<div class="ac l75 m75 s75 p-0">
			
			<div class="ar bg-grey bg-lighten-5 aione-border-bottom">
				<div class="ac l50 pv-6">
					<div class="display-inline-block">
						<img src="http://fuse-angular-material.withinpixels.com/assets/images/avatars/Arnold.jpg" class="profile-avatar" >
					</div>
					<div class="display-inline-block line-height-46 font-size-18 font-weight-600 valign-top">
						Alessia Caravaggio
					</div>
					
					
				</div>
				<div class="ac l50 aione-align-right">
					<i class="fa fa-bars font-size-20 line-height-60"></i>
				</div>
			</div>
			<div class="p-10 conversation" style="">
				<div class="ar mb-10">
					<span class="font-weight-300 font-size-11 aione-float-left">10:53 am</span>
					<div class="display-inline-block aione-border p-10 aione-float-left ml-5" style="max-width: 65%;">
						hi
					</div>
				
				</div>
				<div class="ar mb-10">
					<span class="font-weight-300 font-size-11 aione-float-right">10:53 am</span>
					<div class="display-inline-block aione-border p-10 aione-float-right mr-5" style="max-width: 65%;">
						who is this  ??
					</div>
				</div>
				<div class="ar mb-10">
					<span class="font-weight-300 font-size-11 aione-float-left">10:53 am</span>
					<div class="display-inline-block aione-border p-10 aione-float-left ml-5" style="max-width: 65%;">
						my name is Alessia Caravaggio 
					</div>
				
				</div>
				<div class="ar mb-10">
					<span class="font-weight-300 font-size-11 aione-float-right">10:53 am</span>
					<div class="display-inline-block aione-border p-10 aione-float-right mr-5" style="max-width: 65%;">
						okkkk
					</div>
				</div>
				<div class="ar mb-10">
					<span class="font-weight-300 font-size-11 aione-float-left">10:53 am</span>
					<div class="display-inline-block aione-border p-10 aione-float-left ml-5" style="max-width: 65%;">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit.  
					</div>
				
				</div>
				<div class="ar mb-10">
					<span class="font-weight-300 font-size-11 aione-float-right">10:53 am</span>
					<div class="display-inline-block aione-border p-10 aione-float-right mr-5" style="max-width: 65%;">
						Vivamus et rhoncus eros. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam libero lacus, vestibulum sit amet magna ac
					</div>
				</div>
				<div class="ar mb-10">
					<span class="font-weight-300 font-size-11 aione-float-left">10:53 am</span>
					<div class="display-inline-block aione-border p-10 aione-float-left ml-5" style="max-width: 65%;">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit.  
					</div>
				
				</div>
				<div class="ar mb-10">
					<span class="font-weight-300 font-size-11 aione-float-right">10:53 am</span>
					<div class="display-inline-block aione-border p-10 aione-float-right mr-5" style="max-width: 65%;">
						Vivamus et rhoncus eros. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam libero lacus, vestibulum sit amet magna ac
					</div>
				</div>
				<div class="ar mb-10">
					<span class="font-weight-300 font-size-11 aione-float-left">10:53 am</span>
					<div class="display-inline-block aione-border p-10 aione-float-left ml-5" style="max-width: 65%;">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit.  
					</div>
				
				</div>
				<div class="ar mb-10">
					<span class="font-weight-300 font-size-11 aione-float-right">10:53 am</span>
					<div class="display-inline-block aione-border p-10 aione-float-right mr-5" style="max-width: 65%;">
						Vivamus et rhoncus eros. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam libero lacus, vestibulum sit amet magna ac
					</div>
				</div>
				<div class="ar mb-10">
					<span class="font-weight-300 font-size-11 aione-float-left">10:53 am</span>
					<div class="display-inline-block aione-border p-10 aione-float-left ml-5" style="max-width: 65%;">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit.  
					</div>
				
				</div>
				<div class="ar mb-10">
					<span class="font-weight-300 font-size-11 aione-float-right">10:53 am</span>
					<div class="display-inline-block aione-border p-10 aione-float-right mr-5" style="max-width: 65%;">
						Vivamus et rhoncus eros. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam libero lacus, vestibulum sit amet magna ac
					</div>
				</div>
				
			</div>
			<div class="ar p-10 aione-border-top">
				<div class="ac l90 ">
					<input type="" name="message" style="width: 100%">	
				</div>
				<div class="ac l10">
					<button class="aione-button send-message">Send</button>
				</div>
			</div>
		
		</div>
	</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
<style type="text/css">
	.contact-list,
	.conversation{
		min-height: 380px;max-height: 380px;overflow: hidden;
	}
	.conversation:hover{
	overflow: auto;	
	}
	.profile-avatar{
		border-radius: 50%;width: 46px;
	}
	.contact-avatar{
		border-radius: 50%;width: 36px;
	}
	.valign-top{
		vertical-align: top
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
	$('.conversation').animate({scrollTop: $('.conversation').prop("scrollHeight")}, 500);	})
	$(document).on('click','.send-message',function(){
		if($('input[name=message]').val() != '' ){
			$('.conversation').append('<div class="ar mb-10"><span class="font-weight-300 font-size-11 aione-float-right">10:53 am</span><div class="display-inline-block aione-border p-10 aione-float-right mr-5" style="max-width: 65%;">'+$('input[name=message]').val()+'</div></div>');
			$('.conversation').animate({scrollTop: $('.conversation').prop("scrollHeight")}, 500);
			$('input[name=message]').val('');	
		}
		
	});
	$('input[name=message]').keydown(function(e){
		if(e.keyCode == 13){
			$('.send-message').click();
		}
	});
</script>
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection