@extends('layouts.main')
@section('content')
<style type="text/css">
		.activities .month{
		 font-size: 16px ;font-weight: 700
	}
	.activities .date{
		padding:4px 18px;
	}
	.activites .day{
		font-size: 28px;line-height: 30px;font-weight: 700
	}
	.activites .box{
		padding: 4px 8px; font-size: 10px;border-radius: 3px
	}
	.mb-0{
		margin-bottom: 0px
	}
	.pv-5{
		padding:5px 0px
	}
</style>
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Recent Activities',
	'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	<div class="row mb-0">
		@include('organization.profile._tabs')
		<div class="row activities mb-0">
            @if(!$user_log->isEmpty())
    			@foreach($user_log as $key => $value)
    				<div class="row valign-wrapper  mb-0 pv-5" >
    					<div class="col l1 blue white-text center-align date">
    						<div class="row month mb-0" >
    							{{date_format($value->created_at , "M")}}
    						</div>
    						<div class="row day mb-0" >
    							{{date_format($value->created_at , "d")}}
    						</div>
    					</div>
    					<div class="col l6 pl-7 truncate">
    						<div class="row month mb-0" >
    						{{ activity_log($value['slug'],'EN')}}
    						</div>

    					</div>
    					<div class="col l3 pl-7 truncate">
    						
    					</div>
    					<div class="col l2">
    						<span class="box green white-text"></span>
    					</div>
    					
    					<div class="col l2 grey-text center-align" style="font-size: 13px">
    					{{Carbon\Carbon::parse($value->created_at)->diffForHumans()}}
    					</div>	
    				</div>
    			@endforeach
            @else
                <div class="aione-message warning">
                    No recent activity found
                </div>
            @endif
			{{$user_log->render()}}
		</div>
	</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection