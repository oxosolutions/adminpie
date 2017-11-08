@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset Collaborates <span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add '
); 
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    @include('organization.dataset._tabs')
    <div class="share-wrapper">
	
		<div class="share-user">
			
			<div class="title">
				How would you like to Collaborate this Dataset
			</div>
			{!! Form::open(['route'=>'save.collaborate']) !!}
			<div class="body-wrapper">
				<div class="ar share_status" style="margin-bottom: 20px">
					<div class="ac l33">
						<input type="radio" id="only_me" name="group1" {{ (@$model->share_status == 'only_me')?'checked':'' }}>
						<label for="only_me">Private</label>
					</div>
					<div class="ac l33">
						<input type="radio" id="public" name="group1" {{ (@$model->share_status == 'public')?'checked':'' }}>
						<label for="public">Public</label>
					</div>
					<div class="ac l33">
						<input type="radio" id="specific" name="group1" {{ (@$model->share_status == 'specific')?'checked':'' }}>
						<label for="specific">Specific</label>
					</div>
					<input type="hidden" name="dataset_id" value="{{ request()->route()->id }}">
					
				</div>
				
				<div class="specific_user_field" style="display: {{ (@$model->share_status == 'specific')?'block':'none' }}">
					{{-- <div class="user-field">
						{!! FormGenerator::GenerateField('email_user_share') !!}
						
					</div>
					<div class="share-button">
						<div>{!! FormGenerator::GenerateField('user-share-edit-view',['default_value'=>['read_write'=>'Can Read/Write','read_only'=>'Can Read Only']]) !!}</div>
						<div><button>Add User</button></div>
					</div> --}}
					{!! FormGenerator::GenerateForm('dataset_collaborate_form') !!}
				</div>
				<div class="clear"></div>
			</div>
			{!! Form::close() !!}
			<div class="list-users" style="display: {{ (@$model->share_status == 'specific')?'block':'none' }}">
				<table class="striped">
			        <thead>
						<tr>
							<th>Email</th>
							<th>Rights</th>
							<th>Remove</th>
						</tr>
			        </thead>

			        <tbody>
						@foreach($collaborate as $key => $value)
							<tr>
								<td>{{ $value->email }}</td>
								<td>
									@php
										$rights = json_decode($value->access);
									@endphp
									@foreach($rights as $k => $right)
										<span class="bg-cyan white p-5 display-inline-block mb-5" style="cursor: pointer;">{{ ucfirst($right) }}</span>
									@endforeach
								</td>
								<td><a href="{{ route('delete.collaborate',$value->id) }}" style="color: #757575"><i class="material-icons dp48">clear</i></a></td>
							</tr>
						@endforeach
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
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
		.share-wrapper .share-user .body-wrapper .user-field,
		.share-wrapper .share-link .body-wrapper .copy-button,
		.share-wrapper .share-user .body-wrapper .share-button,
		.share-wrapper .share-user .body-wrapper .share-button >div{
			float: left;
		}
		.share-wrapper .share-link .body-wrapper .link-field,
		.share-wrapper .share-user .body-wrapper .user-field{
			width: 75%;

		}
		.share-wrapper .share-link .body-wrapper .copy-button,
		.share-wrapper .share-user .body-wrapper .share-button{
			width: 25%;
		}
		.share-wrapper .share-user .body-wrapper .share-button >div{
			margin-left: 10px;
			width: 45%
		}
		.share-wrapper .share-user .list-users table thead{
			background-color: #454545;
			color: white
		}

	</style>
	<script type="text/javascript">
		$(document).ready(function(){
			// $('.specific_user_field , .list-users').hide();
			// 	if($('.share_status').find('#specific').attr('checked')){
			// 		$('.specific_user_field , .list-users').show();
			// 	}
			$('body').on('change','.share_status input[type= radio]',function(){
				var share_status = $(this).attr('id');
				var dataset_id = $('input[name=dataset_id]').val();

					if(share_status == 'specific'){
						$('.specific_user_field , .list-users').show();
					}else{
						$('.specific_user_field , .list-users').hide();
					}

					$.ajax({
						url : route()+'/change/dataset/status',
						type: 'get',
						data : {share_status : share_status , dataset_id : dataset_id },
						success : function(res){
							if(res.trim() == "Success"){
								Materialize.toast('Saved',4000);
							}else{
								Materialize.toast('Something went wrong',4000);
							}
						}
					});
			});
		});
	</script>
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection