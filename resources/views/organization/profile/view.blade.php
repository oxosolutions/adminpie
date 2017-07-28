@extends('layouts.main')
@section('content')
<style type="text/css">
	.edit-button{
		display: block;width: 30px;line-height: 30px;text-align: center;float: right;
	}
	.mb-0{
		margin-bottom: 0px
	}
	.mt-14{
		margin-top: 14px;
	}
	.subhead{
		position: relative;
	}
	.subhead:after{
		 content: '';position: absolute;left: 0;display: inline-block;height: 1em;width: 100%;border-bottom: 2px solid #BDBDBD;margin-top: 6px;
	}
	.activity-header{
		padding: 10px;
	}
	.activity-header > h5,a{
		display: inline-block;

	}
	.activity-header > a{
		float:right;

	}
	.chooser { position: absolute; z-index: 1; opacity: 0; cursor: pointer;margin-top: -36px}
	.upload-image{
		position: absolute;
	 	display: block;
	    background-color: rgba(33, 150, 243, 0.8);
	    color: white;
	    width: 100%;
	    text-align: center;
	    
	    padding: 4px;-webkit-transition: all 0.3s ease-in-out 0.5s;
	}
	.abc{
		overflow: hidden
	}
	.abc:hover .upload-image{
		margin-top: -32px
	}
	.basic-details .profile-pic{
		padding:14px;position: relative;
	}
	.basic-details .abc{
		position: relative;
	}
	.basic-details img{
		width:100%;
	}
	.basic-details .preloader-wrapper{
		position: absolute;top: 50%;left: 50%;margin-top: -17px;margin-left: -17px;width: 34px;height: 34px;display: none
	}
	.p-14{
		padding: 14px !important;
	}
	.pb-5{
		padding:0px 0px 5px 0px;
	}
	.pt-5{
		padding:5px 0px 0px 0px
	}
	.mt{
		margin-top: 14px
	}
	.pv-5{
		padding:5px 0px
	}
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
	.pv-10{
		padding:10px 0px
	}
	.info-card{
		margin-top: 14px
	}
	.info-card .subhead-wrapper,.details-wrapper{
		padding: 5px !important;
	}
	.info-card .headline-text{
		font-weight: 600;padding: 10px 5px;display: block;border-bottom: 1px solid #e8e8e8;
	}
</style>
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Profile',
	'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
		@include('organization.profile._tabs')
		
		<div class="row">
		<div class="col l9 pr-7">
			<div class="card mt-14">
				<div class="row basic-details">
					<div class="col l3 profile-pic">
						{!! Form::open(['route'=>'profile.picture' , 'class'=> 'form-horizontal','method' => 'post', 'files' => true,'id'=>'form1'])!!}
							<div class="abc" >
							@if($model->profilePic != null || $model->profilePic != "" || !empty($model->profilePic))
								<img src="{{ asset('ProfilePicture/'.$model->profilePic) }}" >
							@else
								<img src="{{ asset('ProfilePicture/default-user.jpg') }}">
							@endif
							@php
								$parameters = request()->route()->parameters();
							@endphp
							@if(count($parameters) > 0)
								@php
						            $id = request()->route()->parameters()['id'];
							   	@endphp
							   	<input type="hidden" name="user_id" value="{{request()->route()->parameters()['id']}}">
							@endif
								<a href="" class="upload-image">Change Image</a>	
								<input type="file" name="aione-dp"
								onchange="document.getElementById('form1').submit()" class="chooser">


							</div>
							
						{!!Form::close()!!}
						<div class="preloader-wrapper image-spinner big active" style="">
							      <div class="spinner-layer spinner-blue">
							        <div class="circle-clipper left">
							          <div class="circle"></div>
							        </div><div class="gap-patch">
							          <div class="circle"></div>
							        </div><div class="circle-clipper right">
							          <div class="circle"></div>
							        </div>
							      </div>

							      <div class="spinner-layer spinner-red">
							        <div class="circle-clipper left">
							          <div class="circle"></div>
							        </div><div class="gap-patch">
							          <div class="circle"></div>
							        </div><div class="circle-clipper right">
							          <div class="circle"></div>
							        </div>
							      </div>

							      <div class="spinner-layer spinner-yellow">
							        <div class="circle-clipper left">
							          <div class="circle"></div>
							        </div><div class="gap-patch">
							          <div class="circle"></div>
							        </div><div class="circle-clipper right">
							          <div class="circle"></div>
							        </div>
							      </div>

							      <div class="spinner-layer spinner-green">
							        <div class="circle-clipper left">
							          <div class="circle"></div>
							        </div><div class="gap-patch">
							          <div class="circle"></div>
							        </div><div class="circle-clipper right">
							          <div class="circle"></div>
							        </div>
							      </div>
							    </div>
					</div>
					
					<div class="col l9 p-14">
						<div class="row pb-5" >
							<div class="col l3"><strong>Name:</strong></div>
							<div class="col l5">{{@$model->name}}</div>
							<div class="col l4 right-align">
								<a href="#modal1" class="grey-text darken-1 edit-button waves-effect"><i class="fa fa-pencil"></i></a>
								{!!Form::model($model,['route'=>['update.profile',$model->id],'method'=>'PATCH',])!!}
								@include('common.modal-onclick',['data'=>['modal_id'=>'modal1','heading'=>'Profile','button_title'=>'Save','section'=>'editempsec1']])
							
								{!!Form::close()!!}
							</div>
						</div>
						
						<div class="row pt-5" >
							<div class="col l3"><strong>About Me</strong></div>
							<div class="col l9">{{@$model->about_me}}</div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="card mt-14" >
				
				<div class="row ">
					<div class="row activities">
						<div class="activity-header">						
							<h5>Recent Activities</h5>
							<a href="{{route('account.activities')}}" class=" btn-success" style="">View All</a>
						</div>
						
						@foreach($user_log as $key => $value)
							<div class="row valign-wrapper mb-0 pv-5" >
								<div class="col l1 blue white-text center-align date" >
									<div class="row mb-0 month ">
										{{date_format($value->created_at , "M")}}
									</div>
									<div class="row mb-0 day" >
										{{date_format($value->created_at , "d")}}
									</div>
								</div>
								<div class="col l6 pl-7 truncate">
									@foreach(json_decode($value->text) as $k => $val)
										@if($loop->index == 0 )
											{{str_replace('{id?}','id',$val)}}
										@endif
									@endforeach
								</div>
								<div class="col l3 pl-7 truncate">
									@foreach(json_decode($value->text) as $k => $val)
										@if($loop->index == 2 )
											{{$val}}
										@endif
									@endforeach
								</div>
								<div class="col l2">
									<span class="green white-text box">{{$value->type}}</span>
								</div>
								<!-- <div class="col l2">
									<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text">ACCOMPLISHED</span>
								</div> -->
								<div class="col l2 grey-text center-align" style="font-size: 13px">
									2 hour ago
								</div>	
							</div>
						@endforeach
					</div>					
				</div>
					 
			</div>
		</div>
		<div class="col l3 pl-7">
			<div class="card mt-14 " >
				<div class="row center-align mb-0 pv-10" >
					<a href="#modal9" class="btn blue " id="add_new">Change Password</a>	
					{!! Form::open(['route' => 'change.password' , 'method' => 'post']) !!}
					@include('common.modal-onclick',['data'=>['modal_id'=>'modal9','heading'=>'Change Password','button_title'=>'Update','section'=>'changepasssec1']])
					{!! Form::close() !!}
				</div>
				
			</div>
			<div class="card info-card" >
				<div class="row valign-wrapper mb-0">
					<div class="col l10 headline-text" >Contact Detail</div>
					<div class="col l2">
						<a href="#modal2" class="grey-text darken-1 edit-button waves-effect"><i class="fa fa-pencil"></i></a>
						{!!Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH'])!!}
						<input type="hidden" name="meta_table" value="usermeta" />
						@include('common.modal-onclick',['data'=>['modal_id'=>'modal2','heading'=>'Contact Details','button_title'=>'Save ','section'=>'empsec2']])
						{!!Form::close()!!}
					</div>
					
				</div>
				@if(!$model->metas->isEmpty())
					<div class="row" >
						@foreach($model->metas as $k => $v)
							@if($v->key == 'contact_no' || $v->key == 'alternative_number' || $v->key == 'permanent_address')
								<div class="row mb-0" >
									<div class="col l12 subhead-wrapper" >
										<span class="subhead">{{$v->key}}</span>
									</div>
									<div class="col l12 details-wrapper" >
										{{$v->value}}
									</div>
								</div>
							@endif
						@endforeach
					</div>
				@endif
			</div>
				@php
					$roles = array_keys($model->user_role_rel->groupBy('role_id')->toArray());
				@endphp
				@if(in_array(2, $roles))
					<div class="card info-card" >

							<div class="row valign-wrapper mb-0">
								<div class="col l10 headline-text" >Employee Detail</div>
								<div class="col l2">
									<a href="#modal3" class="grey-text darken-1 edit-button waves-effect"><i class="fa fa-pencil"></i></a>
									{!!Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH'])!!}
									<input type="hidden" name="meta_table" value="employeemeta" />
									@include('common.modal-onclick',['data'=>['modal_id'=>'modal3','heading'=>'Employee Details','button_title'=>'Save ','section'=>'empsec7']])
									{!!Form::close()!!}
								</div>
								
							</div>
							<div class="row" >
								@foreach(FormGenerator::GetSectionFieldsName('empsec7') as $key => $field)
									<div class="row mb-0" >
										<div class="col l12 subhead-wrapper" >
											<span class="subhead">{{ucfirst(str_replace('_', ' ',$field))}}: &nbsp;</span>
										</div>
										<div class="col l12 details-wrapper" >
											@if($field == 'designation')
												&nbsp;{{@App\Model\Organization\Designation::find($model[strtolower($field)])->name}}
										@elseif($field == 'department')
												&nbsp;	{!! Form::close() !!}{{@App\Model\Organization\Department::find($model[strtolower($field)])->
													name}}
											@else
												&nbsp;&nbsp;{{$model[strtolower($field)]}}
											@endif
										</div>
									</div>
								@endforeach
							</div>
					</div>
					<div class="card info-card" >
						<div class="row valign-wrapper mb-0">
							<div class="col l10 headline-text" >Bank Details</div>
							<div class="col l2">
								<a href="#modal4" class="grey-text darken-1 edit-button waves-effect"><i class="fa fa-pencil"></i></a>
								{!!Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH'])!!}
							
								<input type="hidden" name="meta_table" value="employeemeta" />
								@include('common.modal-onclick',['data'=>['modal_id'=>'modal4','heading'=>'Bank Details','button_title'=>'Save ','section'=>'empsec6']])
								{!!Form::close()!!}
							</div>
							
						</div>
						<div class="row" >
							@foreach(FormGenerator::GetSectionFieldsName('empsec6') as $key => $field)
								<div class="row mb-0">
									<div class="col l12 subhead-wrapper" >
										<span class="subhead">{{ucfirst(str_replace('_', ' ',$field))}}: &nbsp;</span>
									</div>
									<div class="col l12 details-wrapper" >
										{{$model[strtolower($field)]}}
									</div>
								</div>
							@endforeach
					
						</div>
					</div>
				@endif
	
				@if(@$model['employ_info'])
					@if(count(array_intersect(json_decode($model->employ_info['user_type']), [2,4])) != 0)
						
					@endif
				@endif

			
			
		</div>
	</div>
	@include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')

    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
	<script type="text/javascript">
		
	$(document).ready(function(){
		$('#modal2').modal({
			 dismissible: false
		});
		$('#modal3').modal({
			 dismissible: false
		});
		$('#modal4').modal({
			 dismissible: false
		});

	})
	$(document).on('click','closeDialog',function(){
		$('#modal1').modal('close');
	})
	$(document).on('click','.fa-close',function(){
		$('#modal9').modal('close');
	});
	$(document).on('click','.chooser',function(){
									$('.image-spinner').show();
								});
	</script>
	
								
							

@endsection
