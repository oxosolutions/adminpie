@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Activities',
    'add_new' => '+ Add Activity'
); 
@endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
<div>
    @include('organization.project._tabs')
    <div class="col l12">
    	<div class="card" style="padding:0px 14px;">
    		<div class="col l12 valign-wrapper" style="padding:5px 0px;">
    			<div class="col l1 valign-wrapper">
					<img src="{{asset('assets/images/sgs_sandhu.jpg')}}" class="activity-avatar">  				
    			</div>
    			<div class="col l9">
    				<a href="">Rahul Sharma</a>
    				<span>Creates a new project</span>
    				<a href="">Smaartframework</a>
    			</div>
    			<div class=" col l2 grey-text">
    				<i class="fa fa-clock-o" aria-hidden="true" style="padding:0px 14px;"	></i>2 Seconds ago
    			</div>
    			
    		</div>
    		<div class="col l12 divider">
    			
    		</div>
    		<div class="col l12 valign-wrapper" style="padding:5px 0px;">
    			<div class="col l1 valign-wrapper">
					<img src="{{asset('assets/images/sgs_sandhu.jpg')}}" class="activity-avatar">  				
    			</div>
    			<div class="col l9">
    				<a href="">Paljinder Singh</a>
    				<span>Posted a task on </span>
    				<a href="">Smaartframework</a>
    			</div>
    			<div class=" col l2 grey-text">
    				<i class="fa fa-clock-o" aria-hidden="true" style="padding:0px 14px;"></i>1 Hour ago
    			</div>
    			
    		</div>
    		<div class="col l12 divider">
    			
    		</div>
    		<div class="col l12 valign-wrapper" style="padding:5px 0px;">
    			<div class="col l1 valign-wrapper ">
					<img src="{{asset('assets/images/sgs_sandhu.jpg')}}" class="activity-avatar">  				
    			</div>
    			<div class="col l9">
    				<a href="">Sandeep Singh</a>
    				<span>assign to a task</span>
    				<a href="">Issue in front end</a>
    			</div>
    			<div class=" col l2 grey-text">
    				<i class="fa fa-clock-o" aria-hidden="true" style="padding:0px 14px;"></i>2 Hour ago
    			</div>
    			
    		</div>
                {!! FormGenerator::GenerateSection('testingsection') !!}
    		<div style="clear: both;">
    				
    		</div>
    	</div>
    </div>

</div>
    
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<style type="text/css">
	.activity-avatar{
		border-radius: 50%;
		width: 40px;
	}
	.ph-14{
		padding:0px 14px !important;
	}
	.pv-5{
		padding:5px 0px !important;
	}
</style>
@endsection	