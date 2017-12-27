@extends('layouts.main')
@section('content')
@php
	// $isEmployee = App\Model\Organization\Employee::where('user_id' , $model->id)->first();
	$isEmployee = is_employee(@request()->route()->parameters()['id']);
	$isAdmin = is_admin();
@endphp
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
	#card-alert{
		position: absolute;
	    top: 10px;
	    width: 98%;
	}
	#card-alert i{
		float: right;
		cursor: pointer
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
		@if(Session::has('success-password'))
			{{-- <script type='text/javascript'>Materialize.toast('password Change Successfully', 4000)</script> --}}
			<div id="card-alert" class="card green lighten-5"><div class="card-content green-text">Password Change Successfully<i class="material-icons dp48">clear</i></div></div>
		@endif
		<div class="row">
		<div class="col l9 pr-7">
			<div class="card mt-14">
				<div class="row basic-details">
					<div class="col l3 profile-pic">
						@php
							if(count(request()->route()->parameters()) > 0){
								$id = request()->route()->parameters()['id'];
							}else{
								if(Auth::guard('admin')->check()){
									$id = Auth::guard('admin')->user()['id'];
								}else{
									$id = Auth::guard('org')->user()['id'];
								}
							}
						@endphp
						{!! Form::open(['route'=>'profile.picture' , 'class'=> 'form-horizontal','method' => 'post', 'files' => true,'id'=>'form1'])!!}
							<div class="abc" >
								{{-- <img src="{{ asset(@get_profile_picture($id,'medium')) }}" > --}}
								@php
									$profilePicture = App\Model\Group\GroupUserMeta::where(['user_id' => $id,'key' => 'user_profile_picture'])->first();
								@endphp
								<img src="{{ asset('/files/organization_'.get_organization_id().'/user_profile_picture/'.@$profilePicture->value) }}" >
							
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
							@if(@$model->user_profile_picture != null || @$model->user_profile_picture != "" || !empty(@$model->user_profile_picture))
								<a href="{{route('profile.picture.delete',$id)}}">Remove Image</a>	
							@endif
						
						

						<div class="preloader-wrapper image-spinner big active" style="">
							<div class="spinner-layer spinner-blue">
								<div class="circle-clipper left">
									<div class="circle">
										
									</div>
								</div>
								<div class="gap-patch">
									<div class="circle">
									
									</div>
								</div>
								<div class="circle-clipper right">
									<div class="circle">
										
									</div>
								</div>
							</div>

							<div class="spinner-layer spinner-red">
								<div class="circle-clipper left">
									<div class="circle">
										
									</div>
								</div>
								<div class="gap-patch">
									<div class="circle">
									
									</div>
								</div>
								<div class="circle-clipper right">
									<div class="circle">
										
									</div>
								</div>
							</div>

							<div class="spinner-layer spinner-yellow">
								<div class="circle-clipper left">
									<div class="circle">
										
									</div>
								</div>
								<div class="gap-patch">
									<div class="circle">
									
									</div>
								</div>
								<div class="circle-clipper right">
									<div class="circle">
										
									</div>
								</div>
							</div>

							<div class="spinner-layer spinner-green">
								<div class="circle-clipper left">
									<div class="circle">
										
									</div>
								</div>
								<div class="gap-patch">
									<div class="circle">
									
									</div>
								</div>
								<div class="circle-clipper right">
									<div class="circle">
										
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col l9 p-14">
						<div class="row pb-5" >
							<div class="col l3"><strong>Name:</strong></div>
							<div class="col l5">{{@$model->name}}</div>
							<div class="col l4 right-align" id="modal-wrapper">
								<a class="grey-text darken-1 edit-button waves-effect" data-target="modal1"><i class="fa fa-pencil"></i></a>
								
								{{-- @include('common.modal-onclick',['data'=>['modal_id'=>'modal1','heading'=>'Profile','button_title'=>'Save','section'=>'editempsec1']]) --}}
									@php
										$meta_data = array_column(json_decode($model['metas'],true), 'value','key');
										$shift = null;
										if(isset($meta_data['user_shift'])){
											$shift = App\Model\Organization\Shift::where(['id' => $meta_data['user_shift']])->pluck('id','name');
										}
										$userData = [];
										$userData['about_me'] = $model->about_me;
										$userData['shift'] = $shift;
										$userData['email'] = $model->email;
										$userData['name'] = $model->name;
									@endphp
								<div id="modal1" class="modal modal-fixed-footer" style="overflow-y: hidden;">
								{!!Form::model(@$userData,['route'=>'update.profile','method'=>'post'])!!}
									<div class="modal-header white-text  blue darken-1" ">
										<div class="row" style="padding:15px 10px;margin: 0px">
											<div class="col l7 left-align">
												<h5 style="margin:0px">Profile</h5>	
											</div>
											<div class="col l5 right-align">
												<a href="javascript:;" name="closeModel"  id="closemodal" class="closeDialog close-model-button" style="color: white"><i class="fa fa-close"></i></a>
											</div>	
										</div>
									</div>
									<input type="hidden" name="id" value="{{ @$model->id }}">
									<div class="modal-content" style="padding: 20px;padding-bottom: 60px">
										<div class="col s12 m2 l12 aione-field-wrapper">
										{!! FormGenerator::GenerateField('name',['type'=>'inset']) !!}
										</div>
										<div class="col s12 m2 l12 aione-field-wrapper">
										 {!! FormGenerator::GenerateField('email',['type'=>'inset']) !!}
										 </div>
										 <div class="col s12 m2 l12 aione-field-wrapper">
										 {!! FormGenerator::GenerateField('about_me',['type'=>'inset']) !!}
										 </div>
										 <div class="col s12 m2 l12 aione-field-wrapper">
											{{-- {!! Form::select('shift',null,["class"=>"no-margin-bottom aione-field " , 'placeholder'=>'Select Shift'])!!} --}}
											
											@if(@request()->route()->parameters()['id'])
												@if($isEmployee)
													{!! Form::select('shift',App\Model\Organization\Shift::listshifts(),null,["class"=>"no-margin-bottom aione-field " , 'placeholder'=>'Select Shift'])!!}
												@endif

											@endif
										</div>
									</div>
									<div class="modal-footer">
										<button class="btn blue" type="submit" name="action">save
										</button>
									</div>	
									{!!Form::close()!!}
								</div>

								
							</div>
						</div>
						
						<div class="row pt-5" >
							<div class="col l3"><strong>Email</strong></div>
							<div class="col l9">{{@$model->email}}</div>
						</div>
						<div class="row pt-5" >
							{{-- <div class="col l3"><strong>About Me</strong></div> --}}
							<div class="col l9">{{@$mod->about_me}}</div>
						</div>
						{{-- @if($isEmployee != null)
							<div class="row pt-5" >
								<div class="col l3"><strong>Shift</strong></div>
								@foreach(@$model->metas as $k => $Shift)
									@if($Shift->key == 'shift')
										<div class="col l9">{{App\Model\Organization\Shift::where('id',$Shift->value)->first()->name}}</div>
									@endif
								@endforeach
							</div>
						@endif --}}								
					</div>
				</div>
				{{-- @if($isEmployee || $isAdmin) --}}
						<div class="row" style="padding: 0px 12px;">
							<div class="col l3">
								Shift
							</div>
							@if(!empty($shift))
								<div class="col l3">
									 {{App\Model\Organization\Shift::where('id',$shift)->first()->name}}
								</div>
								<div class="col l3">
									{{App\Model\Organization\Shift::where('id',$shift)->first()->from}} - {{App\Model\Organization\Shift::where('id',$shift)->first()->to}}
								</div>
								<div class="col l3 week-days">
									@if(json_decode(App\Model\Organization\Shift::where('id',$shift)->first()->working_days))

										@foreach(json_decode(App\Model\Organization\Shift::where('id',$shift)->first()->working_days) as $k => $v)
										
										<div class="active" title="{{ucfirst($v)}}">{{ucfirst($v[0])}}</div>
										@endforeach
									@endif
								</div>
							@endif
							<style type="text/css">
								.week-days > .active{
									border-color: #2196f3;
								}
								.week-days > .active:hover{
									background-color:#2196f3;
									color: white;

								}
								.week-days > div{
								    display: inline-block;
								    width: 24px;
								    text-align: center;
								    font-size: 13px;
								    line-height: 24px;
								    border: 1px solid #e8e8e8;
								    border-radius: 50%;
								    font-weight: 700;
								    color: #676767;
								    cursor: pointer;
								}
								.week-days > div:last-child{
									color: red
								}
							</style>
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
			{{-- <div class="card mt-14 " >
				<div class="row center-align mb-0 pv-10" >
				@if(@$errors->get('new_password') || @$errors->get('confirm_password'))
					<script type="text/javascript">
						$(window).load(function(){
							document.getElementById('add_new').click();
						});
					</script>
				@endif
					<a href="#modal9" class="btn blue " id="add_new">Change Password1</a>
					@if(!empty($errors->all()))
						@if(@$errors->new_password  || @$errors->confirm_password )	
							<script type="text/javascript">
								window.onload = function(){
									$('#modal9').modal('open');
								}
							</script>
						@endif
					@endif
						{!! Form::open(['route' => 'change.password' , 'method' => 'post']) !!}
						@include('common.modal-onclick',['data'=>['modal_id'=>'modal9','heading'=>'Change Password','button_title'=>'Update','section'=>'changepasssec1']])
					@php
						if(Auth::guard('admin')->check()){
				            $id = Auth::guard('admin')->user()->id;
				        }elseif(request()->route()->parameters()){
				            $id = request()->route()->parameters()['id'];
				        }else{
				            $id = Auth::guard('org')->user()->id;
				        }
					@endphp
					<input type="hidden" name="id" value="{{$id}}">
					{!! Form::close() !!}
				</div>
				
			</div> --}}
			<div class="card info-card" >
				<div class="row valign-wrapper mb-0">
					<div class="col l10 headline-text" >Contact Detail</div>
					<div class="col l2" id="modal-wrapper">
						<a href="#modal2" class="grey-text darken-1 edit-button waves-effect"><i class="fa fa-pencil"></i></a>
						{!!Form::model(@$model,['route'=>['update.profile.meta',@$model->id],'method'=>'PATCH'])!!}
						<input type="hidden" name="meta_table" value="usermeta" />
						@include('common.modal-onclick',['data'=>['modal_id'=>'modal2','heading'=>'Contact Details','button_title'=>'Save ','section'=>'empsec2']])
						{!!Form::close()!!}
					</div>
					
				</div>
				@if(@$model !=null)
					@if(!$model->metas->isEmpty())
						<div class="row" >
							@foreach($model->metas as $k => $v)
								@if($v->key == 'contact_no' || $v->key == 'alternative_number' || $v->key == 'permanent_address' || $v->key == 'present_address')
									<div class="row mb-0" >
										<div class="col l12 subhead-wrapper" >
											<span class="subhead">{{ucfirst(str_replace('_',' ',$v->key))}}</span>
										</div>
										<div class="col l12 details-wrapper" >
											{{$v->value}}
										</div>
									</div>
								@endif
							@endforeach
						</div>
					@endif
				@endif
			</div>
				@php
					$roles = array_keys(@$model->user_role_rel->groupBy('role_id')->toArray());
					//if role has permission to this widget
				@endphp
				@if(@$isEmployee || @$isAdmin)
					<div class="card info-card" >

							<div class="row valign-wrapper mb-0">
								<div class="col l10 headline-text" >Employee Detail</div>
								<div class="col l2 " id="modal-wrapper">
										@if(@$isAdmin)
											<a href="#modal3" class="grey-text darken-1 edit-button waves-effect"> <i class="fa fa-pencil"></i></a>
										@endif
									{!!Form::model(@$model->toArray(),['route'=>['update.profile.meta',@$model->id],'method'=>'PATCH'])!!}
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

											@php
												$fieldData = str_replace(' ', '_', strtolower($field));
											@endphp
											@if($fieldData == 'designation')
												{{@App\Model\Organization\Designation::find($model->designation)->name}}
											@elseif($fieldData == 'department')
												{{@App\Model\Organization\Department::find($model->$fieldData)->name}}
											@elseif($fieldData == 'user_shift')
												{{@App\Model\Organization\Shift::find($model->$fieldData)->name}}
											@elseif($fieldData == 'pay_scale')
												{{@App\Model\Organization\Payscale::find($model->$fieldData)->title}}
											@else
												{{ $model->$fieldData }}
											@endif



										{{-- @if($field == 'designation')
											&nbsp;
												{{@App\Model\Organization\Designation::find($model->designation)->name}}
										@elseif($field == 'department')
											&nbsp;	
												{!! Form::close() !!}{{@App\Model\Organization\Department::find($model->strtolower($field))->name}}
										@elseif($field == 'user_shift')
											&nbsp;	
												{!! Form::close() !!}{{@App\Model\Organization\Shift::find($model[strtolower($field)])->name}}
										@elseif($field == 'Pay_scale')
											&nbsp;	
												{!! Form::close() !!}{{@App\Model\Organization\Payscale::find($model[strtolower($field)])->title}}
										@else
												&nbsp;&nbsp;{{@$model[strtolower($field)]}}
										@endif --}}
										</div>
									</div>
								@endforeach
							</div>
					</div>

					<div class="card info-card" >
						<div class="row valign-wrapper mb-0">
							<div class="col l10 headline-text" >Bank Details</div>
							<div class="col l2" id="modal-wrapper">
								@if($isAdmin)
									<a href="#modal4" class="grey-text darken-1 edit-button waves-effect"><i class="fa fa-pencil"></i></a>
								@endif
								{!!Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH'])!!}
							
								<input type="hidden" name="meta_table" value="employeemeta" />
								@if(count(request()->route()->parameters()) >0 )
									<input type="hidden" name="empId" value="{{request()->route()->parameters()['id']}}" />
								@endif
									@include('common.modal-onclick',['data'=>['modal_id'=>'modal4','heading'=>'Bank Details','button_title'=>'Save ','section'=>'empsec6']])
								{!!Form::close()!!}
							</div>
						</div>
						<div class="row" >
							@php
								$data = [];
							@endphp
							@foreach(str_replace(' ','_',FormGenerator::GetSectionFieldsName('empsec6')) as $k => $v)
								@php
									array_push($data , strtolower($v));
								@endphp
							@endforeach
							@foreach($data as $key => $field)

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
			$('#modal1').modal({
				 dismissible: false
			});
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
		$(document).on('click','#card-alert i',function(){
			$('#card-alert').remove();
		});

	</script>
		@if(@$errors->has())
			<script type="text/javascript">
				$(window).load(function(){
				$('#modal1').modal('open');
					// console.log($('.error-red').parents('#modal-wrapper').find('.edit-button').html());
				});
			</script>
		@endif						
@endsection
