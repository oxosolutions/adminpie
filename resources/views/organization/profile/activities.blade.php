@extends('layouts.main')
@section('content')
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
	<div class="row">
		@include('organization.profile._tabs')
		<div class="row ">
			recent activities
			@foreach($user_log as $key => $value)
				<div class="row valign-wrapper" style="padding:5px 0px">
					<div class="col l1 blue white-text center-align">
						<div class="row " style="font-size: 16px ;font-weight: 700">
							{{date_format($value->created_at , "M")}}
						</div>
						<div class="row" style="font-size: 28px;line-height: 30px;font-weight: 700">
							{{date_format($value->created_at , "d")}}
						</div>
					</div>
					<div class="col l6 pl-7 truncate">
						@foreach(json_decode($value->text) as $k => $val)
							@if($loop->index == 0)
								{{$val}}
							@endif
						@endforeach
					</div>
					<div class="col l3 pl-7 truncate">
						@foreach(json_decode($value->text) as $k => $val)
							@if($loop->index == 2)
								{{$val}}
							@endif
						@endforeach
					</div>
					<div class="col l2">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text">{{$value->type}}</span>
					</div>
					
					<div class="col l2 grey-text center-align" style="font-size: 13px">
						2 hour ago
					</div>	
				</div>
			@endforeach
			{{$user_log->render()}}
		</div>
	</div>
@endsection