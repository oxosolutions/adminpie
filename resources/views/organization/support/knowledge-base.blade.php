@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Knowledge Base',
	'add_new' => '+ Add Ticket',
	'route' => 'add.ticket'
);
@endphp 
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')		
	<div class="ar">
		<div class="ac l25 m25 s100">
			<div class="aione-border p-10">
				<nav id="aione_nav" class="aione-nav light vertical">
	                <div class="aione-nav-background"></div>
	                <ul id="sortable" class="aione-menu">
	                    <li class="aione-nav-item level0 unsortable ">
	                        <a href="" >
	                            <span class="nav-item-icon"><i class="fa fa-map-signs"></i></span>
	                            <span class="nav-item-text">
	                                Your Orders
	                            </span>
	                        </a>
	                    </li>
	                    <li class="aione-nav-item level0 unsortable ">
	                        <a href="" >
	                            <span class="nav-item-icon"><i class="fa fa-map-signs"></i></span>
	                            <span class="nav-item-text">
	                                Return & Refunds
	                            </span>
	                        </a>
	                    </li>
	                    <li class="aione-nav-item level0 unsortable ">
	                        <a href="" >
	                            <span class="nav-item-icon"><i class="fa fa-map-signs"></i></span>
	                            <span class="nav-item-text">
	                                Application Support
	                            </span>
	                        </a>
	                    </li>
	                    <li class="aione-nav-item level0 unsortable ">
	                        <a href="" >
	                            <span class="nav-item-icon"><i class="fa fa-map-signs"></i></span>
	                            <span class="nav-item-text">
	                                Payment Options
	                            </span>
	                        </a>
	                    </li>
	                    <li class="aione-nav-item level0 unsortable ">
	                        <a href="" >
	                            <span class="nav-item-icon"><i class="fa fa-map-signs"></i></span>
	                            <span class="nav-item-text">
	                                Account Settings
	                            </span>
	                        </a>
	                    </li>
	                </ul>
	            </nav>
			</div>
				
		</div>
		<div class="ac l75 m75 s100">
			<div class="aione-border p-10  mb-40">
				<div class="aione-border p-10 mb-5">
					When can I register an expired domain name?
				</div>
				<div class="aione-border p-10 mb-5">
					When can I register an expired domain name?
				</div>
				<div class="aione-border p-10 mb-5">
					When can I register an expired domain name?
				</div>
				<div class="aione-border p-10 mb-5">
					When can I register an expired domain name?
				</div>
				<div class="aione-border p-10">
					When can I register an expired domain name?
				</div>
			</div>
			<div class="aione-border p-10">
				<h5 class="aione-border-bottom pb-10 light-blue darken-3">When can I register an expired domain name?</h5>
				<div class="line-height-24">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac lacinia nunc. Sed blandit id orci ut convallis. Nullam laoreet tellus ultricies, ultrices nisl at, pellentesque tortor. Nam elementum mi et lacus aliquam elementum. Pellentesque euismod imperdiet dui ac ultricies. Cras feugiat odio in justo convallis viverra. Donec aliquam, diam eu vestibulum maximus, augue enim sagittis purus, in suscipit eros elit in leo. Praesent bibendum venenatis lectus ut gravida. Fusce posuere lorem ultricies, volutpat diam sed, feugiat nisi. Cras ultrices fringilla turpis. Aliquam ac convallis odio, non pulvinar libero. Curabitur euismod molestie magna a commodo. Pellentesque semper consequat tempus.

					Sed gravida nisl non velit pharetra, vel pulvinar quam gravida. Mauris vitae sem et sapien tincidunt convallis. Integer vel feugiat ante. Nam malesuada diam ac tempus accumsan. Mauris lorem ante, eleifend non hendrerit ut, fringilla vitae tellus. Duis eu sagittis nunc. Quisque in lacinia leo, in rutrum mi. Vestibulum semper maximus est in ultrices. Donec sed mauris blandit, mattis augue ut, viverra elit. Nullam rutrum lacinia diam eget sagittis. Donec euismod nulla et consequat dapibus. Ut non purus nec felis dapibus condimentum vel sit amet arcu. In hac habitasse platea dictumst. Nunc sem lectus, tempor dapibus accumsan nec, fermentum id lorem. Vivamus eget est turpis.
				</div>	
			</div>
		</div>
	</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection