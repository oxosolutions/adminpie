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
	'page_title' =>  __('organization/profile.profile_picture_page_title_text'),
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
			<div class="ac l30 m30 s100">
				<div>
	          		<img class="aione-border border-grey-lighten-4 p-10" src="{{ asset(@get_profile_picture($id,'medium')) }}" >
	        	</div>
	         	<div class="ac s100 m33 l100  bg-red darken-1 aione-align-center p-0">
	            	<a class="white p-14 display-block" href="{{ route('profile.picture.delete',$id) }}">{{ __('organization/profile.remove_image')}}</a>
	         	</div>
			</div>
			<div class="ac l70 m70 s100  ">
				<div class="aione-border  aione-align-center" style="min-height: 350px;max-height: 350px">
					<div class="aione-border-bottom">
						<h5 class="line-height-30">{{ __('organization/profile.change_profile_picture')}}</h5>
					</div>
					{!! Form::open(['route'=>'profile.picture' , 'class'=> 'form-horizontal','method' => 'post', 'files' => true,'id'=>'form1'])!!}
						<div class="abc ph-100 pt-100" >
						   	<input type="hidden" name="user_id" value="{{$id}}">
							<input style="" type="file" name="aione-dp" class="image_file_input">
							<input style="" type="submit" name="submit" value="{{ __('organization/profile.add_profile_picture')}}" class="submit display-none">
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
