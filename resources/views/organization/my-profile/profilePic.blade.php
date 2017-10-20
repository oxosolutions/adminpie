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
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
		@include('organization.my-profile._profile_tabs')
		<div class="row">
			<div class="aione-table">
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
				{{-- <table class="wide">
		          <thead>
		            <tr>
		                <th>Name</th>
		                <th>Item Name</th>
		                
		            </tr>
		          </thead>

		          <tbody>
		            <tr>
		              <td>Alvin</td>
		              <td>Eclair</td>
		              
		            </tr>
		            <tr>
		              <td>Alan</td>
		              <td>Jellybean</td>
		              
		            </tr>
		            <tr>
		              <td>Jonathan</td>
		              <td>Lollipop</td>
		              
		            </tr>
		          </tbody>
		        </table> --}}
			</div>
		</div>
	@include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
    @include('common.page_content_secondry_end')
	@include('common.pagecontentend')
@endsection
