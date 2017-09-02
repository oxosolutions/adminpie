@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Survey Share',
    'add_new' => '+ Add Media'
); 
$id = "";
// dump($sections = $survey_data[0]['section']);
@endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

@include('organization.survey._tabs')

	<div class="share-wrapper">
		<div class="share-link">
			<div class="title">
				Share Link
			</div>
			<div class="body-wrapper">
				<div class="link-field">
					{!! FormGenerator::GenerateField('shareable_link') !!}
				</div>
				<div class="copy-button">
					<button > Copy link</button>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="share-user">
			
			<div class="title">
				share with users
			</div>
			<div class="body-wrapper">
				<div class="user-field">
					{!! FormGenerator::GenerateField('email_user_share') !!}
					
				</div>
				<div class="share-button">
					<div>{!! FormGenerator::GenerateField('user-share-edit-view') !!}</div>
					<div><button>Share</button></div>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="list-users">
				<table class="striped">
			        <thead>
						<tr>
							<th>Email</th>
							<th>Name</th>
							<th>Rights</th>
							<th>Remove</th>
						</tr>
			        </thead>

			        <tbody>
						<tr>
							<td>ashish9436@gmail.com</td>
							<td>Ashish</td>
							<td>Viewing Rights</td>
							<td>x</td>
							
						</tr>
						<tr>
							<td>sandy@gmail.com</td>
							<td>sandeep</td>
							<td>Full Rights</td>
							<td>x</td>
						</tr>
						<tr>
							<td>mandy@gmail.com</td>
							<td>rahul</td>
							<td>Full Rights</td>
							<td>x</td>
						</tr>
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
	<style type="text/css">
		.share-wrapper{
			margin-top: 30px
		}
		.share-wrapper button{
			padding: 8px 12px;
		}
		.share-wrapper .share-link,
		.share-wrapper .share-user{
			border:1px solid #e8e8e8;
			padding:15px;
			position: relative;
			margin-bottom: 30px;
		}
		.share-wrapper .share-link .title,
		.share-wrapper .share-user .title{
			background-color: #e8e8e8;
			display: inline-block;
			padding:10px;
			position: absolute;
			top: -17px
		}
		.share-wrapper .share-link .body-wrapper,
		.share-wrapper .share-user .body-wrapper{
			padding: 20px 0px
		}
		.share-wrapper .share-link .body-wrapper .link-field,
		.share-wrapper .share-user .body-wrapper .user-field{
			float: left;
			width: 75%;

		}
		.share-wrapper .share-link .body-wrapper .copy-button,
		.share-wrapper .share-user .body-wrapper .share-button{
			float: left;
			width: 25%;
		}
		.share-wrapper .share-user .body-wrapper .share-button >div{
			float: left;
			margin-left: 10px;
			width: 45%
		}
		.share-wrapper .share-user .list-users table thead{
			background-color: #454545;
			color: white
		}

	</style>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection