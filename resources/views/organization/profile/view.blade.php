@extends('layouts.main')
@section('content')
@php
	// $isEmployee = App\Model\Organization\Employee::where('user_id' , $model->id)->first();
	$isEmployee = is_employee(@request()->route()->parameters()['id']);
	$isAdmin = is_admin();

	$user_id = $model->id;
@endphp

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

	<div class="ar">
		<div class="ac l60">
			<div class="aione-border mb-25">
				<div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
					Basic Details
					{{-- <button class="aione-button aione-float-right font-size-14 " data-target="modal1" style="margin-top: -6px">Edit</button> --}}
				</div>
				<div class="p-10">
					<div class="ar basic-details">
						<div class="ac l30 profile-pic p-10">
							<img src="{{ asset(get_profile_picture($user_id,'medium')) }}" >
						</div>
						
						<div class="ac l70 p-10">
							<div class="aione-table">
								<table class="Bordered">
									<tbody>
										<tr>
											<td>Name</td>
											<td>{{@$model->name}}</td>
										</tr>
										<tr>
											<td>Email</td>
											<td>{{@$model->email}}</td>
										</tr>
										{{-- <tr>
											<td>About me</td>
											<td>{{@$mod->about_me}}</td>
										</tr> --}}
										<tr>
											<td>Shift</td>
											<td>
												<div class="">
													{{@App\Model\Organization\Shift::where('id',$shift)->first()->name}}
												</div>
												<div class="">
													{{@App\Model\Organization\Shift::where('id',$shift)->first()->from}} - {{@App\Model\Organization\Shift::where('id',$shift)->first()->to}}
												</div>
				                                
												<div class="">
													@if(json_decode(@App\Model\Organization\Shift::where('id',$shift)->first()->working_days))

														@foreach(json_decode(@App\Model\Organization\Shift::where('id',$shift)->first()->working_days) as $k => $v)
														
														<div class="active" title="{{ucfirst($v)}}">{{ucfirst($v[0])}}</div>
														@endforeach
													@endif
												</div>
											</td>
										</tr>
									</tbody>
								</table>
								<div class=" right-align" id="modal-wrapper">
									
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
							{{-- <div class="ar mb-15" >
								<div class="ac l25 font-weight-600">Name:</div>
								<div class="ac l45">{{@$model->name}}</div>
								<div class=" right-align" id="modal-wrapper">
									
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
							
							<div class="ar" >
								<div class="ac l25 font-weight-600">Email</div>
								<div class="ac l75">{{@$model->email}}</div>
							</div>
							<div class="ar mb-15" >
							
								<div class="ac l75">{{@$mod->about_me}}</div>
							</div>
							<div class="ar">
								<div class="ac l25 font-weight-600">
									Shift		
								</div>

								<div class="">
									{{@App\Model\Organization\Shift::where('id',$shift)->first()->name}}
								</div>
								<div class="">
									{{@App\Model\Organization\Shift::where('id',$shift)->first()->from}} - {{@App\Model\Organization\Shift::where('id',$shift)->first()->to}}
								</div>
                                
								<div class="">
									@if(json_decode(@App\Model\Organization\Shift::where('id',$shift)->first()->working_days))

										@foreach(json_decode(@App\Model\Organization\Shift::where('id',$shift)->first()->working_days) as $k => $v)
										
										<div class="active" title="{{ucfirst($v)}}">{{ucfirst($v[0])}}</div>
										@endforeach
									@endif
								</div>
								
							</div> --}}		
						</div>
					</div>

					{{-- @if($isEmployee || $isAdmin) --}}
					{{-- <div class="ar">
						<div class="ac l25">
							Shift
						</div>
						@if(!empty($shift))
							<div class="ac l25">
								 {{App\Model\Organization\Shift::where('id',$shift)->first()->name}}
							</div>
							<div class="ac l25">
								{{App\Model\Organization\Shift::where('id',$shift)->first()->from}} - {{App\Model\Organization\Shift::where('id',$shift)->first()->to}}
							</div>
							<div class="ac l25 week-days">
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
					</div> --}}
				</div>
			</div>
			<div class="aione-border" >
				<div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
					Recent Activities
					<a href="{{route('account.activities')}}" class=" aione-button aione-float-right font-size-14 " style="margin-top: -6px">View All</a>
				</div>
				<div class="ar ">
					
						
						@foreach($user_log as $key => $value)
							<div class="ar aione-border-bottom p-10" >
								{{-- <div class="ac l10 blue white-text center-align date" >
									<div class=" month ">
										{{date_format($value->created_at , "M")}}
									</div>
									<div class=" day" >
										{{date_format($value->created_at , "d")}}
									</div>
								</div> --}}
								<div class="ac l50 ">
									@foreach(json_decode($value->text) as $k => $val)
										@if($loop->index == 0 )
											{{str_replace('{id?}','id',$val)}}
										@endif
									@endforeach
								</div>
								<div class="ac l20  ">
									@foreach(json_decode($value->text) as $k => $val)
										@if($loop->index == 2 )
											{{$val}}
										@endif
									@endforeach
								</div>
								<div class="ac l10">
									<span class="green white-text box">{{$value->type}}</span>
								</div>
								<!-- <div class="col l2">
									<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text">ACCOMPLISHED</span>
								</div> -->
								<div class="ac l20 aione-align-center" style="font-size: 13px">
									2 hour ago
								</div>	
							</div>
						@endforeach

										
				</div>
			</div>
		</div>
		<div class="ac l40">

			<div class="aione-border mb-25" >
				<div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
					Contact Details
					<a href="#modal2" class="aione-button aione-float-right font-size-14 edit-button" style="margin-top: -6px">Edit</a>
					{!!Form::model(@$model,['route'=>['update.profile.meta',@$model->id],'method'=>'PATCH'])!!}
					<input type="hidden" name="meta_table" value="usermeta" />
					@include('common.modal-onclick',['data'=>['modal_id'=>'modal2','heading'=>'Contact Details','button_title'=>'Save ','section'=>'empsec2']])
					{!!Form::close()!!}
				</div>
				@if(@$model !=null)
					@if(!$model->metas->isEmpty())
						<div class="aione-table p-10">
							<table>
								<tbody>
									@foreach($model->metas as $k => $v)
									@if($v->key == 'contact_no' || $v->key == 'alternative_number' || $v->key == 'permanent_address' || $v->key == 'present_address')
										<tr>
											<td>
												{{ucfirst(str_replace('_',' ',$v->key))}}
											</td>
											<td>
												{{$v->value}}	
											</td>
										</tr>
										@endif
									@endforeach
								</tbody>
							</table>
						</div>
						{{-- <div class="row" >
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
						</div> --}}
					@endif
				@endif
			</div>
				@php
					$roles = array_keys(@$model->user_role_rel->groupBy('role_id')->toArray());
					//if role has permission to this widget
				@endphp
                @if($isEmployee && request()->id != null)
                    @if(check_widget_permission('employee_details'))
                        <div class="aione-border mb-25" >
                            <div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
                                Employee Details
                                @if(@$isAdmin)
                                    <a href="#modal3" class="aione-button font-size-14 aione-float-right edit-button " style="margin-top: -6px">Edit</a>
                                @endif
                                {!!Form::model(@$model->toArray(),['route'=>['update.profile.meta',@$model->id],'method'=>'PATCH'])!!}
                                <input type="hidden" name="meta_table" value="employeemeta" />
                                
                                @include('common.modal-onclick',['data'=>['modal_id'=>'modal3','heading'=>'Employee Details','button_title'=>'Save ','section'=>'empsec7']])
                                {!!Form::close()!!}
                            </div>
                            <div class="aione-table p-10">
                                <table>
                                    <tbody>
                                        @foreach(FormGenerator::GetSectionFieldsName('empsec7') as $key => $field)
                                        <tr>
                                            <td>
                                                {{ucfirst(str_replace('_', ' ',$field))}}: &nbsp;
                                            </td>
                                            <td>                                        
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
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            {{-- <div class="ar" >
                                @foreach(FormGenerator::GetSectionFieldsName('empsec7') as $key => $field)
                                    <div class="ar " >
                                        <div class="ac l100 subhead-wrapper" >
                                            <span class="subhead">{{ucfirst(str_replace('_', ' ',$field))}}: &nbsp;</span>
                                        </div>
                                        <div class="ac l100 details-wrapper" >

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


                                        </div>
                                    </div>
                                @endforeach
                            </div> --}}
                        </div>

                        <div class="aione-border info-card" >
                            <div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
                                Bank Details
                                @if($isAdmin)
                                    <a href="#modal4" class="aione-float-right font-size-14 edit-button aione-button" style="margin-top: -6px">Edit</a>
                                @endif
                                {!!Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH'])!!}
                            
                                <input type="hidden" name="meta_table" value="employeemeta" />
                                @if(count(request()->route()->parameters()) >0 )
                                    <input type="hidden" name="empId" value="{{request()->route()->parameters()['id']}}" />
                                @endif
                                    @include('common.modal-onclick',['data'=>['modal_id'=>'modal4','heading'=>'Bank Details','button_title'=>'Save ','section'=>'empsec6']])
                                {!!Form::close()!!}
                            </div>
                            
                            <div class="aione-table p-10" >
                                @php
                                    $data = [];
                                @endphp
                                @foreach(str_replace(' ','_',FormGenerator::GetSectionFieldsName('empsec6')) as $k => $v)
                                    @php
                                        array_push($data , strtolower($v));
                                    @endphp
                                @endforeach
                                <table>
                                    <tbody> 
                                        @foreach($data as $key => $field)

                                            <tr >
                                                <td  >
                                                    {{ucfirst(str_replace('_', ' ',$field))}}: &nbsp;
                                                </td>
                                                <td  >
                                                    {{$model[strtolower($field)]}}
                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                                            
                        
                            </div>
                        </div>
                    @endif
                @endif

                @if($isEmployee && request()->id == null)
                    @if(check_widget_permission('employee_details'))
                        <div class="aione-border mb-25" >
                            <div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
                                Employee Details
                                @if(@$isAdmin)
                                    <a href="#modal3" class="aione-button font-size-14 aione-float-right edit-button " style="margin-top: -6px">Edit</a>
                                @endif
                                {!!Form::model(@$model->toArray(),['route'=>['update.profile.meta',@$model->id],'method'=>'PATCH'])!!}
                                <input type="hidden" name="meta_table" value="employeemeta" />
                                
                                @include('common.modal-onclick',['data'=>['modal_id'=>'modal3','heading'=>'Employee Details','button_title'=>'Save ','section'=>'empsec7']])
                                {!!Form::close()!!}
                            </div>
                            <div class="aione-table p-10">
                                <table>
                                    <tbody>
                                        @foreach(FormGenerator::GetSectionFieldsName('empsec7') as $key => $field)
                                        <tr>
                                            <td>
                                                {{ucfirst(str_replace('_', ' ',$field))}}: &nbsp;
                                            </td>
                                            <td>                                        
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
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            {{-- <div class="ar" >
                                @foreach(FormGenerator::GetSectionFieldsName('empsec7') as $key => $field)
                                    <div class="ar " >
                                        <div class="ac l100 subhead-wrapper" >
                                            <span class="subhead">{{ucfirst(str_replace('_', ' ',$field))}}: &nbsp;</span>
                                        </div>
                                        <div class="ac l100 details-wrapper" >

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


                                        </div>
                                    </div>
                                @endforeach
                            </div> --}}
                        </div>

                        <div class="aione-border info-card" >
                            <div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
                                Bank Details
                                @if($isAdmin)
                                    <a href="#modal4" class="aione-float-right font-size-14 edit-button aione-button" style="margin-top: -6px">Edit</a>
                                @endif
                                {!!Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH'])!!}
                            
                                <input type="hidden" name="meta_table" value="employeemeta" />
                                @if(count(request()->route()->parameters()) >0 )
                                    <input type="hidden" name="empId" value="{{request()->route()->parameters()['id']}}" />
                                @endif
                                    @include('common.modal-onclick',['data'=>['modal_id'=>'modal4','heading'=>'Bank Details','button_title'=>'Save ','section'=>'empsec6']])
                                {!!Form::close()!!}
                            </div>
                            
                            <div class="aione-table p-10" >
                                @php
                                    $data = [];
                                @endphp
                                @foreach(str_replace(' ','_',FormGenerator::GetSectionFieldsName('empsec6')) as $k => $v)
                                    @php
                                        array_push($data , strtolower($v));
                                    @endphp
                                @endforeach
                                <table>
                                    <tbody> 
                                        @foreach($data as $key => $field)

                                            <tr >
                                                <td  >
                                                    {{ucfirst(str_replace('_', ' ',$field))}}: &nbsp;
                                                </td>
                                                <td  >
                                                    {{$model[strtolower($field)]}}
                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                                            
                        
                            </div>
                        </div>
                    @endif
                @endif

				@if($isAdmin && $isEmployee && request()->id == null)
					<div class="aione-border mb-25" >
						<div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
							Employee Details
							@if(@$isAdmin)
								<a href="#modal3" class="aione-button font-size-14 aione-float-right edit-button " style="margin-top: -6px">Edit</a>
							@endif
							{!!Form::model(@$model->toArray(),['route'=>['update.profile.meta',@$model->id],'method'=>'PATCH'])!!}
							<input type="hidden" name="meta_table" value="employeemeta" />
							
							@include('common.modal-onclick',['data'=>['modal_id'=>'modal3','heading'=>'Employee Details','button_title'=>'Save ','section'=>'empsec7']])
							{!!Form::close()!!}
						</div>
						<div class="aione-table p-10">
							<table>
								<tbody>
									@foreach(FormGenerator::GetSectionFieldsName('empsec7') as $key => $field)
									<tr>
										<td>
											{{ucfirst(str_replace('_', ' ',$field))}}: &nbsp;
										</td>
										<td>										
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
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						
						{{-- <div class="ar" >
							@foreach(FormGenerator::GetSectionFieldsName('empsec7') as $key => $field)
								<div class="ar " >
									<div class="ac l100 subhead-wrapper" >
										<span class="subhead">{{ucfirst(str_replace('_', ' ',$field))}}: &nbsp;</span>
									</div>
									<div class="ac l100 details-wrapper" >

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


									</div>
								</div>
							@endforeach
						</div> --}}
					</div>

					<div class="aione-border info-card" >
						<div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
							Bank Details
							@if($isAdmin)
								<a href="#modal4" class="aione-float-right font-size-14 edit-button aione-button" style="margin-top: -6px">Edit</a>
							@endif
							{!!Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH'])!!}
						
							<input type="hidden" name="meta_table" value="employeemeta" />
							@if(count(request()->route()->parameters()) >0 )
								<input type="hidden" name="empId" value="{{request()->route()->parameters()['id']}}" />
							@endif
								@include('common.modal-onclick',['data'=>['modal_id'=>'modal4','heading'=>'Bank Details','button_title'=>'Save ','section'=>'empsec6']])
							{!!Form::close()!!}
						</div>
						
						<div class="aione-table p-10" >
							@php
								$data = [];
							@endphp
							@foreach(str_replace(' ','_',FormGenerator::GetSectionFieldsName('empsec6')) as $k => $v)
								@php
									array_push($data , strtolower($v));
								@endphp
							@endforeach
							<table>
								<tbody>	
									@foreach($data as $key => $field)

										<tr >
											<td  >
												{{ucfirst(str_replace('_', ' ',$field))}}: &nbsp;
											</td>
											<td  >
												{{$model[strtolower($field)]}}
											</td>
										</tr>

									@endforeach
								</tbody>
							</table>
										
					
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
