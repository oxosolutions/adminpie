@extends('layouts.main')
@section('content')
@php
	// $isEmployee = App\Model\Organization\Employee::where('user_id' , $model->id)->first();
	$id = get_user_id();

@endphp
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Profile Picture',
	'add_new' => ''
); 
@endphp
<style type="text/css">
	button.my-btn:hover{
		background-color: #757575;
		color: white
	}
</style>
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
		@include('organization.my-profile._profile_tabs')
		<div class="ar">
		{{-- 	<div class="aione-table">
				<table class="wide">
					 <thead>
			            <tr>
			                <th>File</th>
			                <th>Current Pic</th> 
			                <th>Action</th> 
			            </tr>
			          </thead>
					<tbody>

						<tr>
							<td>
								{!! Form::open(['route'=>'profile.picture' , 'class'=> 'form-horizontal','method' => 'post', 'files' => true,'id'=>'form1'])!!}
									<div class="abc" >
									   	<input type="hidden" name="user_id" value="{{$id}}">
										<input type="file" name="aione-dp">
										<input type="submit" name="submit" value="submit">
									</div>
								{!!Form::close()!!}
							</td>
							<td>
								<img src="{{ asset(@get_profile_picture($id,'medium')) }}">
							</td>
							<td>
								<a href="{{ route('profile.picture.delete',$id) }}" style="color: red">Remove Image</a>
							</td>
						</tr>
					</tbody>
				</table>
				
			</div> --}}
		
			{{-- <div class="ac l30 m30 s100">
				<div>
	          		<img class="aione-border border-grey-lighten-4 p-10" src="{{ asset(@get_profile_picture($id,'medium')) }}" >
	        	</div>
	         	<div class="ac s100 m33 l100 p-14 bg-red darken-1 aione-align-center">
	            	<a class="white" href="{{ route('profile.picture.delete',$id) }}">Remove Image</a>
	         	</div>
			</div>
			<div class="ac l70 m70 s100  ">
				<div class="aione-border pv-65 aione-align-center" style="min-height: 350px;max-height: 350px">
					<h3 style="font-weight: 200;color: #676767;">SGS Sandhu</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					<button class=" mv-20 p-10 grey darken-1 aione-border bg-white font-size-14 my-btn" ><i class="fa fa-camera mb-4 font-size-20 display-block" style="display: block;"></i> Change Profile Picture</button>
				</div> --}}
					
				{{-- <button class=" mv-20 p-10 grey darken-1 border-grey border-lighten-1 bg-white font-size-14 my-btn" style="border:1px solid #e8e8e8"><i class="fa fa-camera mb-4 font-size-20" style="display: block;"></i> Add Profile Picture</button> --}}
				
			{{-- </div> --}}
			
			<div class="ac l30 m30 s100">
				<div>
	          		<img class="aione-border border-grey-lighten-4 p-10" src="{{ asset(@get_profile_picture($id,'medium')) }}" >
	        	</div>
	         	<div class="ac s100 m33 l100  bg-red darken-1 aione-align-center p-0">
	            	<a class="white p-14 display-block" href="{{ route('profile.picture.delete',$id) }}">Remove Image</a>
	         	</div>
			</div>
			<div class="ac l70 m70 s100  ">
				<div class="aione-border  aione-align-center" style="min-height: 350px;max-height: 350px">
					<div class="aione-border-bottom">
						<h5 class="line-height-30">Change profile picture</h5>
					</div>
					{!! Form::open(['route'=>'profile.picture' , 'class'=> 'form-horizontal','method' => 'post', 'files' => true,'id'=>'form1'])!!}
						<div class="abc ph-100 pt-100" >
						   	<input type="hidden" name="user_id" value="{{$id}}">
							<input style="" type="file" name="aione-dp" class="image_file_input">
							<input style="" type="submit" name="submit" value="Add Profile Picture" class="submit display-none">
						</div>
					{!!Form::close()!!}
				</div>
			</div>
			


				
		</div>
	@include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
    @include('common.page_content_secondry_end')
	@include('common.pagecontentend')
	<script type="text/javascript">
		$(document).on('click','.my-btn',function() {
			$('input[name=aione-dp]').click();
		})
		$(".image_file_input").change(function() {
			$('.submit').click();
		})	
	</script>
@endsection
