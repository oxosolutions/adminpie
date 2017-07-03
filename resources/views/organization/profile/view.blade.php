@extends('layouts.main')
@section('content')

	<div class="row">
		@include('organization.profile._tabs')
		<div class="col l9 pr-7">
			<div class="card" style="margin-top: 14px">
				<div class="row">
					<div class="col l3" style="padding:14px;">
						{!! Form::open(['route'=>'profile.picture' , 'class'=> 'form-horizontal','method' => 'post', 'files' => true,'id'=>'form1'])!!}
							<div class="abc" style="position: relative;">
							@if($model->profilePic != null || $model->profilePic != "" || !empty($model->profilePic))
								<img src="{{ asset('ProfilePicture/'.$model->profilePic) }}" style="width: 100%">
							@else
								<img src="{{ asset('ProfilePicture/default-user.jpg') }}" style="width: 100%">
							@endif
								<a href="" class="upload-image">Change Image</a>	
								<input type="file" name="aione-dp"
								onchange="document.getElementById('form1').submit()" class="chooser">
							</div>
						{!!Form::close()!!}
					</div>
					<style type="text/css">
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
							margin-top: -36px
						}
					</style>
					<div class="col l9" style="padding:14px">
						<div class="row" style="padding:0px 0px 5px 0px">
							<div class="col l3"><strong>Name:</strong></div>
							<div class="col l5">{{$model->name}}</div>
							<div class="col l4 right-align">
								<a href="#modal1" class=""><i class="fa fa-pencil"></i></a>
								{!!Form::model($model,['route'=>['update.profile',$model->id],'method'=>'PATCH',])!!}
								@include('common.modal-onclick',['data'=>['modal_id'=>'modal1','heading'=>'Profile','button_title'=>'Save','section'=>'editempsec1']])
								{{-- <div id="modal1" class="modal">
									<div class="modal-header">
										<h5>Add department</h5>
									</div>
									
										<div class="modal-content">
											{!!FormGenerator::GenerateSection('editempsec1',['type' => 'inset'])!!}
										</div>
										<div class="modal-footer">
											<button class="ml-4 btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save Department
												<i class="material-icons right">save</i>
											</button>
										</div>
									
								</div> --}}
								{!!Form::close()!!}
							</div>
						</div>
						{{-- <div class="row" style="padding:5px 0px">
							<div class="col l3"><strong>Designation</strong></div>
							<div class="col l9">{{@App\Model\Organization\Designation::find($model->designation)->name}}</div>
						</div> --}}
						<div class="row" style="padding:5px 0px 0px 0px">
							<div class="col l3"><strong>About Me</strong></div>
							<div class="col l9">{{@$model->about_me}}</div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="card" style="margin-top: 14px">
				{{-- <div class="row">
					<ul class="aione-tabs">
				        <li class="tab col aione-active "><a href="{{route('list.settings')}}">Recent Activities</a></li>
				        <li class="tab col "><a href="javascript:;">Attendence</a></li>
				        <li class="tab col "><a href="javascript:;">Performence</a></li>
				        <li class="tab col "><a href="javascript:;">Salary</a></li>
				        <li class="tab col "><a href="javascript:;">Projects</a></li>
				        
				       
				        <div style="clear: both">
				          
				        </div>
				    </ul>
				</div> --}}
				<div class="row ">
					<div class="row ">
						<div class="activity-header">						
							<h5>Recent Activities</h5>
							<a href="{{route('account.activities')}}" class="btn btn-success">View All</a>
						</div>

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
									<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text">{{$value->type}}</span>
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
			<div class="card"  style="margin-top: 14px">
				<div class="row center-align" style="padding:10px 0px">
					<a href="#modal10" class="btn blue">Change Password</a>	
					
					@include('common.modal-onclick',['data'=>['modal_id'=>'modal10','heading'=>'Change Password','button_title'=>'Update','section'=>'changepasssec1']])
				</div>
				
			</div>
			<div class="card" style="margin-top: 14px">
				<div class="row">
					<div class="col l10" style="font-weight: 600;padding: 10px 5px;display: block;border-bottom: 1px solid #e8e8e8">Contact Detail</div>
					<div class="col l2">
						<a href="#modal2"><span><i class="fa fa-pencil"></i></span></a>
						<div id="modal2" class="modal modal-fixed-footer">
							<div class="modal-header white-text" style="background-color: rgb(2,136,209)">
						    	<div class="row" style="padding:15px 10px">
						    		<div class="col l7">
						    			<h5 style="margin:0px">Contact Details</h5>	
						    		</div>
						    		<div class="col l5 right-align">
						    			<a href="javascript:;" class="closeDialog"><i class="fa fa-close"></i></a>
						    		</div>
						    			
						    	</div>
						    	
						    </div>
						    {!!Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH'])!!}
						    	<input type="hidden" name="meta_table" value="usermeta" />
							    <div class="modal-content" style="background-color: white">
							    	
							    	{!!FormGenerator::GenerateSection('empsec2',['type' => 'inset'])!!}
							    </div>
							    <div class="modal-footer">
							    	{{-- <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Save</a> --}}
							    	<button class="btn blue" type="submit">Save
												<i class="material-icons right">save</i>
											</button>
							    </div>
							{!!Form::close()!!}
						</div>
					</div>
					
				</div>
				<div class="row" style="padding: 0px 5px">
					<div class="row" style="padding: 5px 0px ">
						<div class="col l4">
							Contact no.
						</div>
						<div class="col l8">
							{{$model->contact_no}}
						</div>
					</div>
					<div class="row" style="padding: 5px 0px ">
						<div class="col l4">
							Email.
						</div>
						<div class="col l8">
							<a>{{@$model->email}}</a>
						</div>
					</div>
					<div class="row" style="padding: 5px 0px ">
						<div class="col l4">
							Address
						</div>
						<div class="col l8">
							{{@$model->permanent_address}}
						</div>
					</div>
				</div>
			</div>
			@if(count(array_intersect(json_decode($model->user_type), [2,4])) != 0)
				<div class="card" style="margin-top: 14px">
					<div class="row">
						<div class="col l10" style="font-weight: 600;padding: 10px 5px;display: block;border-bottom: 1px solid #e8e8e8">Employee Detail</div>
						<div class="col l2">
							<a href="#modal3"><span><i class="fa fa-pencil"></i></span></a>
							<div id="modal3" class="modal modal-fixed-footer">
								<div class="modal-header white-text" style="background-color: rgb(2,136,209)">
							    	<div class="row" style="padding:15px 10px">
							    		<div class="col l7">
							    			<h5 style="margin:0px">Employee Details</h5>	
							    		</div>
							    		<div class="col l5 right-align">
							    			<a href="javascript:;" class="closeDialog"><i class="fa fa-close"></i></a>
							    		</div>
							    			
							    	</div>
							    	
							    </div>
							    {!!Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH'])!!}
							    	<input type="hidden" name="meta_table" value="employeemeta" />
								    <div class="modal-content" style="background-color: white">
								    	
								    	{!!FormGenerator::GenerateSection('empsec7',['type' => 'inset'])!!}
								    </div>
								    <div class="modal-footer">
								    	{{-- <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Save</a> --}}
								    	<button class="btn blue" type="submit">Save
													<i class="material-icons right">save</i>
												</button>
								    </div>
								{!!Form::close()!!}
							</div>
						</div>
						
					</div>
					<div class="row" style="padding: 0px 5px">
						@foreach(FormGenerator::GetSectionFieldsName('empsec7') as $key => $field)
							<div class="row" style="padding: 5px 0px ">
								<div class="col l4">
									{{ucfirst(str_replace('_', ' ',$field))}}: &nbsp;
								</div>
								<div class="col l8">
									@if($field == 'designation')
										&nbsp;{{@App\Model\Organization\Designation::find($model[strtolower($field)])->name}}
									@elseif($field == 'department')
										&nbsp;{{@App\Model\Organization\Department::find($model[strtolower($field)])->name}}
									@else
										&nbsp;&nbsp;{{$model[strtolower($field)]}}
									@endif
								</div>
							</div>
						@endforeach
						{{-- <div class="row" style="padding: 5px 0px ">
							<div class="col l4">
								Designation
							</div>
							<div class="col l8">
								<a>{{@App\Model\Organization\Designation::find($model->designation)->name}}</a>
							</div>
						</div>
						<div class="row" style="padding: 5px 0px ">
							<div class="col l4">
								Department
							</div>
							<div class="col l8">
								{{@App\Model\Organization\Department::find($model->department)->name}}
							</div>
						</div>
						<div class="row" style="padding: 5px 0px ">
							<div class="col l4">
								DOJ
							</div>
							<div class="col l8">
								{{@$model->date_of_joining}}
							</div>
						</div> --}}
					</div>
				</div>
				<div class="card" style="margin-top: 14px">
					<div class="row">
						<div class="col l10" style="font-weight: 600;padding: 10px 5px;display: block;border-bottom: 1px solid #e8e8e8">Bank Details</div>
						<div class="col l2">
							<a href="#modal4"><span><i class="fa fa-pencil"></i></span></a>
							<div id="modal4" class="modal modal-fixed-footer">
								<div class="modal-header white-text" style="background-color: rgb(2,136,209)">
							    	<div class="row" style="padding:15px 10px">
							    		<div class="col l7">
							    			<h5 style="margin:0px">Bank Details</h5>	
							    		</div>
							    		<div class="col l5 right-align">
							    			<a href="javascript:;" class="closeDialog"><i class="fa fa-close"></i></a>
							    		</div>
							    			
							    	</div>
							    	
							    </div>
							    {!!Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH'])!!}
							    	<input type="hidden" name="meta_table" value="employeemeta" />
								    <div class="modal-content" style="background-color: white">
								    	
								    	{!!FormGenerator::GenerateSection('empsec6',['type' => 'inset'])!!}
								    </div>
								    <div class="modal-footer">
								    	{{-- <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Save</a> --}}
								    	<button class="btn blue" type="submit">Save
													<i class="material-icons right">save</i>
												</button>
								    </div>
								{!!Form::close()!!}
							</div>
						</div>
						
					</div>
					<div class="row" style="padding: 0px 5px">
						@foreach(FormGenerator::GetSectionFieldsName('empsec6') as $key => $field)
							<div class="row" style="padding: 5px 0px ">
								<div class="col l4">
									{{ucfirst(str_replace('_', ' ',$field))}}: &nbsp;
								</div>
								<div class="col l8">
									{{$model[strtolower($field)]}}
								</div>
							</div>
						@endforeach
						{{-- <div class="row" style="padding: 5px 0px ">
							<div class="col l4">
								Branch.
							</div>
							<div class="col l8">
								<a>{{@$model->branch}}</a>
							</div>
						</div>
						<div class="row" style="padding: 5px 0px ">
							<div class="col l4">
								Account Name.
							</div>
							<div class="col l8">
								{{@$model->account_name}}
							</div>
						</div>
						<div class="row" style="padding: 5px 0px ">
							<div class="col l4">
								Account No.
							</div>
							<div class="col l8">
								<a>{{@$model->account_no}}</a>
							</div>
						</div>
						<div class="row" style="padding: 5px 0px ">
							<div class="col l4">
								IFSC Code.
							</div>
							<div class="col l8">
								<a>{{@$model->ifsc}}</a>
							</div>
						</div>
						<div class="row" style="padding: 5px 0px ">
							<div class="col l4">
								Nominee.
							</div>
							<div class="col l8">
								<a>{{@$model->nominee}}</a>
							</div>
						</div> --}}
					</div>
				</div>
			@endif

			<div class="card" style="margin-top: 14px">
				<div class="row">
					<span style="font-weight: 600;padding: 10px 5px;display: block;border-bottom: 1px solid #e8e8e8">Task Assigned</span>
				</div>
				<div class="row">
					<div class="row" style="padding: 10px 5px;">
						<div class="col l9">
							Design Issue	
						</div>
						<div class="col l3 center-align">
							<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="red white-text ">High</span>
						</div>
						
					</div>
					<div class="divider">
						
					</div>
					<div class="row" style="padding: 10px 5px;">
						<div class="col l9">
							Backend task	
						</div>
						<div class="col l3 center-align">
							<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange white-text ">Medium</span>
						</div>
						
					</div>
					<div class="divider">
						
					</div>
					<div class="row" style="padding: 10px 5px;">
						<div class="col l9">
							Testing in html	
						</div>
						<div class="col l3 center-align">
							<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text ">Low</span>
						</div>
						
					</div>
				</div>
			</div>
			<div class="card">
				<div class="row">
					<span style="font-weight: 600;padding: 10px 5px;display: block;border-bottom: 1px solid #e8e8e8">My Projects</span>
				</div>
				<div class="row">
					<div class="row" style="padding: 10px 5px;">
						<div class="col l12">
							Project 1	
						</div>
						
					</div>
					<div class="divider">
						
					</div>
					<div class="row" style="padding: 10px 5px;">
						<div class="col l12">
							Project 2	
						</div>
						
						
					</div>
					<div class="divider">
						
					</div>
					<div class="row" style="padding: 10px 5px;">
						<div class="col l12">
							Project #
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<style type="text/css">
		 .aione-tabs{
		      border-bottom: 1px solid #e8e8e8;
		      padding-bottom: 4px;
		      padding: 0px;
		      margin: 0px;
		   }
		   .aione-tabs > .tab{
		     

		   }
		   .aione-tabs > .tab:hover{
		      background-color: #e8e8e8;
		          border-bottom: 1px solid #EEE;
		   }
		   .aione-tabs > .tab > a{
		    padding: 0px 20px; 
		    line-height: 40px;
		    display: inline-block; 
		    color: #0073aa;
		   }
		   .aione-active{
		      border: 1px solid #e8e8e8;
		      border-bottom: 1px solid #fff;
		      margin-bottom: -1px;
		   }
		   .aione-active a{
		      color: black !important;
		      font-weight: 500
		   }
	</style>
	<script type="text/javascript">
		  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();

  });
	</script>
@endsection
