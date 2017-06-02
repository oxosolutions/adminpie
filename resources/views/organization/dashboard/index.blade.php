@extends('layouts.main')
@section('content')
	<div>
	{{-- {{dump($widget_data)}} --}}

	


		<div class="row">
		@foreach($slug as $slugKey => $slugVal)
			{!!global_draw_widget($slugVal)!!}
		@endforeach
			{{-- @foreach($widget_data as $key => $value)
				@php
				unset($permissons);
					$permissons[$value['widget_id']]['permissons'] =$value['permisson'];
					
				@endphp
				@if($permissons[$value['widget']['id']]['permissons']=='on')
						

				<div class="col l3 pr-7">
					<div class="card shadow" style="margin-top: 0px;">
						<div class="row center-align aione-widget-header" ><h5 style="margin: 0px"><a href="" style="display: block">{{$value['widget']['title']}}</a></h5></div>
						<div class="row center-align aione-widget-content" ></div>
						<div class="row center-align aione-widget-footer" >
							
						</div>
					</div>
				</div>
				@else
				{{-- {{dump($permissons)}} --}}
				{{-- @endif
			@endforeach
 --}}


		{{-- @foreach($model as $key => $value)
			<div class="col l3 pr-7">
				<div class="card shadow" style="margin-top: 0px;">
					<div class="row center-align aione-widget-header" ><h5 style="margin: 0px"><a href="" style="display: block">{{ucfirst($key)}}</a></h5></div>
					<div class="row center-align aione-widget-content" >{{$value['count']}} </div>
				@if(!empty($value['list']))
					@foreach($value['list'] as $keyss => $val)
						<div class="row center-align aione-widget-content" > <h6>{{$loop->iteration }} - {{$val['name']}}</h6></div>
					@endforeach
				@endif 
					<div class="row center-align aione-widget-footer" >
						<a href="{{route('list.'.$key)}}" class="btn" style="background-color: #005A8B">All {{$key}}</a>
					</div>
				</div>
			</div>
		@endforeach --}}
		</div>
	</div>
	<div class="row">
		<div class="col l3 pr-7">
			<div class="card">
				<div class="row">
					<div class="col l6">
						<div class="row center-align">
							<h5 style="font-size: 24px;color: #666666;font-weight: 500;margin-bottom: 0">Clients</h5>
						</div>
						<div class="row center-align" style="font-size: 38px;font-weight: 700;color: #888888">
							164
						</div>
					</div>
					<div class="col l6">
						<img src="{{ asset('assets/images/demo-graph.png') }}">
					</div>
						
				</div>
			</div>
		</div>
		<div class="col l3 pl-7 pr-7">
			<div class="card">
				<div class="row">
					<div class="col l6">
						<div class="row center-align">
							<h5 style="font-size: 24px;color: #666666;font-weight: 500;margin-bottom: 0">Employees</h5>
						</div>
						<div class="row center-align" style="font-size: 38px;font-weight: 700;color: #888888">
							39
						</div>
					</div>
					<div class="col l6">
						<img src="{{ asset('assets/images/demo-graph.png') }}">
					</div>
				</div>
			</div>
		</div>
		<div class="col l3 pl-7 pr-7">
			<div class="card">
				<div class="row">
					<div class="col l6">
						<div class="row center-align">
							<h5 style="font-size: 24px;color: #666666;font-weight: 500;margin-bottom: 0">Projects</h5>
						</div>
						<div class="row center-align" style="font-size: 38px;font-weight: 700;color: #888888">
							23
						</div>
					</div>
					<div class="col l6">
						<img src="{{ asset('assets/images/demo-graph.png') }}">
					</div>
				</div>
			</div>
		</div>
		<div class="col l3 pl-7">
			<div class="card">
				<div class="row">
					<div class="col l6">
						<div class="row center-align">
							<h5 style="font-size: 24px;color: #666666;font-weight: 500;margin-bottom: 0">Users</h5>
						</div>
						<div class="row center-align" style="font-size: 38px;font-weight: 700;color: #888888">
							16
						</div>
					</div>
					<div class="col l6">
						<img src="{{ asset('assets/images/demo-graph.png') }}">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col l6 pr-7">
			<div class="card" >
				<div>
					<div class="row">
						<div class="col l12 title" style="padding: 10px;font-size:20px;border-bottom: 1px solid #e8e8e8">
							Projects
						</div>
					</div>
					<div class="row">
						<ul class="collapsible " data-collapsible="accordion"  style="margin:0px;border:none !important;box-shadow: none !important;">
						    <li class="active">
						      	<div class="collapsible-header active">
									<div class="row valign-wrapper">
										<div class="col" >
											<span class="blue white-text" style="display:block;width: 30px;line-height: 30px;text-align: center;font-size: 22px;border-radius: 50%">S</span>
										</div>
										<div class="col pl-7" >
											Smaartframework.com
										</div>
										<div class="col l2 right-align">
											<div class="row valign-wrapper">
												<div class="col l8">
													<div class="aione-progress-bar"><div class="aione-progress-bg"><div class="aione-progress-inside" ></div></div></div>		
												</div>
												<div class="col l4 pl-7">
													80%
												</div>
											</div>
										</div>
									</div>
								</div>
						      	<div class="collapsible-body" style="padding: 10px">
						      		<div>
						      			<div class="row">
						      				<div class="col l6 pr-7">
						      					<div style="background-color: #7E7E7E;padding: 6px" class="white-text center-align">
						      						Start Date: 00:00:00
						      					</div>
						      				</div>
						      				<div class="col l6 pl-7">
						      					<div style="background-color:#2978A2;padding: 6px" class="white-text center-align">
						      						Due Date: 00:00:00
						      					</div>
						      				</div>
						      			</div>
						      			<div class="row" style="margin: 10px 0px ">
						      				<div class="col l6 pr-7">
						      					<div class="row" style="padding: 10px 0px;">
						      						<div class="col l4">
						      							<img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" style="width:60px;border-radius: 50%">
						      						</div>
						      						<div class="col l8">
						      							<div class="row">
						      								<span class="teal darken-2 white-text" style="padding: 0px 5px">Client</span>
						      							</div>
						      							<div class="row">
						      								Sandeep Singh
						      							</div>
						      							<div class="row" style="font-weight: 300">
						      								tel: 1800 281 2300
						      							</div>
						      						</div>
						      					</div>
						      				</div>
						      				<div class="col l6 pl-7">
						      					<div class="row" style="padding: 10px 0px;">
						      						<div class="col l4">
						      							<img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" style="width:60px;border-radius: 50%">
						      						</div>
						      						<div class="col l8">
						      							<div class="row">
						      								<span class="teal darken-2 white-text" style="padding: 0px 5px">Project Manager</span>
						      							</div>
						      							<div class="row">
						      								Rahul sharma
						      							</div>
						      							<div class="row" style="font-weight: 300">
						      								tel: 1800 281 6301
						      							</div>
						      						</div>
						      					</div>
						      				</div>
						      			</div>
						      			<div class="row">
						      				<div class="col l12">
						      					<h5>Project Details</h5>
						      				</div>
						      				<div class="col l12">
						      					<div class="row" style="margin: 10px 0px">
						      						<div class="col l5">
						      							Website Url
						      						</div>
						      						<div class="col l7">
						      							www.smaartframework.com
						      						</div>
						      					</div>
						      					<div class="row" style="margin: 10px 0px">
						      						<div class="col l5">
						      							Username
						      						</div>
						      						<div class="col l7">
						      							admin@hotmail.com
						      						</div>
						      					</div>
						      					<div class="row" style="margin: 10px 0px">
						      						<div class="col l5">
						      							password
						      						</div>
						      						<div class="col l7">
						      							******
						      						</div>
						      					</div>
						      				</div>
						      			</div>
						      			<div class="row" style=" margin:15px 0px ">
						      				<div class="col l6 pr-7 center-align">
						      					<a href="" class="btn blue">Edit project details</a>
						      				</div>
						      				<div class="col l6 pl-7 center-align">
						      					<a href="" class="btn grey"> close project</a>
						      				</div>
						      			</div>
						      		</div>
						      	</div>
						    </li>
						    <li>
								<div class="collapsible-header">

									<div class="row valign-wrapper">
										<div class="col" >
											<span class="blue white-text" style="display:block;width: 30px;line-height: 30px;text-align: center;font-size: 22px;border-radius: 50%">A</span>
										</div>
										<div class="col pl-7" >
											Admin Pie
										</div>
										<div class="col l2 right-align">
											<div class="row valign-wrapper">
												<div class="col l8">
													<div class="aione-progress-bar"><div class="aione-progress-bg"><div class="aione-progress-inside" style="width: 39%"></div></div></div>		
												</div>
												<div class="col l4 pl-7">
													39%
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
						    </li>
						    <li>
						      <div class="collapsible-header">
						      		<div class="row valign-wrapper">
										<div class="col" >
											<span class="blue white-text" style="display:block;width: 30px;line-height: 30px;text-align: center;font-size: 22px;border-radius: 50%">O</span>
										</div>
										<div class="col pl-7" >
											OCRM
										</div>
										<div class="col l2 right-align">
											<div class="row valign-wrapper">
												<div class="col l8">
													<div class="aione-progress-bar"><div class="aione-progress-bg"><div class="aione-progress-inside" style="width: 15%"></div></div></div>		
												</div>
												<div class="col l4 pl-7">
													15%
												</div>
											</div>
										</div>
									</div>
						      </div>
						      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
						    </li>
						  </ul>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col l6 pl-7">
			<div class="card">
				<div class="row valign-wrapper">
					<div class="col l6">
						<div class="col l12 title" style="padding: 10px;font-size:20px;border-bottom: 1px solid #e8e8e8">
							My Tasks
						</div>
					</div>
					<div class="col l6 right-align pr-7">
						Status
					</div>
				</div>
				<div class="row">
					<div class="col l12">
						  <ul class="collection" style="margin:0 ">
						      <li class="collection-item">
						      		<div class="row">
						      			<div class="col l6">
						      				Dashboard Design
						      			</div>
						      			<div class="col l6 right-align">
						      				<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
						      			</div>
						      		</div>
						      </li>
						      <li class="collection-item">
						      		<div class="row">
						      			<div class="col l6">
						      				Correction in front end
						      			</div>
						      			<div class="col l6 right-align">
						      				<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text">ACCOMPLISHED</span>
						      			</div>
						      		</div>
						      </li>
						      <li class="collection-item">
						      		<div class="row">
						      			<div class="col l6">
						      				Smaart back end design
						      			</div>
						      			<div class="col l6 right-align">
						      				<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="red white-text">FAILED</span>
						      			</div>
						      		</div>
						      </li>
						      <li class="collection-item">
						      		<div class="row">
						      			<div class="col l6">
						      				OCRM front design
						      			</div>
						      			<div class="col l6 right-align">
						      				<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="red white-text">FAILED</span>
						      			</div>
						      		</div>
						      </li>
						   </ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col l3 pr-7">
			<div class="card">
				<div class="row my-stats">
					<div class="col l12 title" style="padding: 10px;font-size:20px;border-bottom: 1px solid #e8e8e8">
						My Stats
					</div>
					<div class=" col l12">
						<ul>
							<li>
								<div class="row">
									<div class="col l2">
										<i class="fa fa-folder-open-o"></i>
									</div>
									<div class="col l8">Active Projects</div>
									<div class="col l2 right-align ">
										<span class="light-blue white-text" style="padding: 4px 8px;">5</span>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col l2">
										<i class="fa fa-tasks"></i>
									</div>
									<div class="col l8">Open Tasks</div>
									<div class="col l2 right-align ">
										<span class="light-green lighten-1 white-text" style="padding: 4px 8px;">5</span>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col l2">
										<i class="fa fa-life-ring"></i>
									</div>
									<div class="col l8">Support Ticket</div>
									<div class="col l2 right-align ">
										<span class="deep-orange lighten-1 white-text" style="padding: 4px 8px;">5</span>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col l2">
										<i class="fa fa-clock-o"></i>
									</div>
									<div class="col l8">Active Timer</div>
									<div class="col l2 right-align ">
										<span class=" blue-grey darken-1 white-text" style="padding: 4px 8px;">5</span>
									</div>
								</div>
							</li>
						</ul>
					</div>	
				</div>
				
			</div>
		</div>
		<div class="col l3 pl-7 pr-7">
			<div class="card">
				<div class="row my-stats">
					<div class="col l12 title" style="padding: 10px;font-size:20px;border-bottom: 1px solid #e8e8e8">
						Attendence
					</div>
					<div class=" col l12">
						<ul>
							<li>
								<div class="row">
									<div class="col l2">
										<i class="fa fa-folder-open-o"></i>
									</div>
									<div class="col l8">Total Employes</div>
									<div class="col l2 right-align ">
										<span class="light-blue white-text" style="padding: 4px 8px;">5</span>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col l2">
										<i class="fa fa-tasks"></i>
									</div>
									<div class="col l8">Open Tasks</div>
									<div class="col l2 right-align ">
										<span class="light-green lighten-1 white-text" style="padding: 4px 8px;">5</span>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col l2">
										<i class="fa fa-life-ring"></i>
									</div>
									<div class="col l8">Support Ticket</div>
									<div class="col l2 right-align ">
										<span class="deep-orange lighten-1 white-text" style="padding: 4px 8px;">5</span>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col l2">
										<i class="fa fa-clock-o"></i>
									</div>
									<div class="col l8">Active Timer</div>
									<div class="col l2 right-align ">
										<span class=" blue-grey darken-1 white-text" style="padding: 4px 8px;">5</span>
									</div>
								</div>
							</li>
						</ul>
					</div>	
				</div>
				
			</div>
		</div>
		<div class="col l3 pl-7 pr-7">
			<div class="card">
				<div class="row my-stats">
					<div class="col l12 title" style="padding: 10px;font-size:20px;border-bottom: 1px solid #e8e8e8">
						My Stats
					</div>
					<div class=" col l12">
						<ul>
							<li>
								<div class="row">
									<div class="col l2">
										<i class="fa fa-folder-open-o"></i>
									</div>
									<div class="col l8">Active Projects</div>
									<div class="col l2 right-align ">
										<span class="light-blue white-text" style="padding: 4px 8px;">5</span>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col l2">
										<i class="fa fa-tasks"></i>
									</div>
									<div class="col l8">Open Tasks</div>
									<div class="col l2 right-align ">
										<span class="light-green lighten-1 white-text" style="padding: 4px 8px;">5</span>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col l2">
										<i class="fa fa-life-ring"></i>
									</div>
									<div class="col l8">Support Ticket</div>
									<div class="col l2 right-align ">
										<span class="deep-orange lighten-1 white-text" style="padding: 4px 8px;">5</span>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col l2">
										<i class="fa fa-clock-o"></i>
									</div>
									<div class="col l8">Active Timer</div>
									<div class="col l2 right-align ">
										<span class=" blue-grey darken-1 white-text" style="padding: 4px 8px;">5</span>
									</div>
								</div>
							</li>
						</ul>
					</div>	
				</div>
				
			</div>
		</div>
		<div class="col l3 pl-7">
			<div class="card">
				<div class="row my-stats">
					<div class="col l12 title" style="padding: 10px;font-size:20px;border-bottom: 1px solid #e8e8e8">
						My Stats
					</div>
					<div class=" col l12">
						<ul>
							<li>
								<div class="row">
									<div class="col l2">
										<i class="fa fa-folder-open-o"></i>
									</div>
									<div class="col l8">Active Projects</div>
									<div class="col l2 right-align ">
										<span class="light-blue white-text" style="padding: 4px 8px;">5</span>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col l2">
										<i class="fa fa-tasks"></i>
									</div>
									<div class="col l8">Open Tasks</div>
									<div class="col l2 right-align ">
										<span class="light-green lighten-1 white-text" style="padding: 4px 8px;">5</span>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col l2">
										<i class="fa fa-life-ring"></i>
									</div>
									<div class="col l8">Support Ticket</div>
									<div class="col l2 right-align ">
										<span class="deep-orange lighten-1 white-text" style="padding: 4px 8px;">5</span>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col l2">
										<i class="fa fa-clock-o"></i>
									</div>
									<div class="col l8">Active Timer</div>
									<div class="col l2 right-align ">
										<span class=" blue-grey darken-1 white-text" style="padding: 4px 8px;">5</span>
									</div>
								</div>
							</li>
						</ul>
					</div>	
				</div>
				
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col l3 pl-7 pr-7">
			<div class="card">
				<div class="row my-stats">
					<div class="col l12 title" style="padding: 10px;font-size:20px;border-bottom: 1px solid #e8e8e8">
						My Attendence
					</div>
					<div class=" col l12">
						<div id='calendar'></div>	
					</div>	
				</div>
				
			</div>
		</div>
	</div>

	<style type="text/css">
		.aione-widget-header{
			border-bottom: 1px solid #e8e8e8;cursor: pointer;
		}
		.aione-widget-header a{
			padding: 10px;color: black
		}
		.aione-widget-content{
			border-bottom: 1px solid #e8e8e8;padding: 10px;font-size: 72px
		}
		.aione-widget-footer{
			padding: 10px
		}
		.my-stats li{
			padding: 10px
		}
		.my-stats ul{
			margin-top: 0px !important
		}
		.collapsible{
			
		}
		.aione-progress-bg {
		    background: #f2f2f2;
		    min-height: 10px;
		    border:1px solid #a8a8a8;
		}


		.aione-progress-inside {
		    width: 80%;
		    height: 10px;
		    background: #22adba;
		    background-color: #2978A2;
		    background-size: 10% 100%, 100% 100%;
		}
		li.active{
			box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14),0 1px 5px 0 rgba(0,0,0,0.12),0 3px 1px -2px rgba(0,0,0,0.2)
		}
		.fc-toolbar{
			display: none;
		}
		table{
			border-collapse: separate !important;
		}
		.fc-basic-view .fc-body .fc-row{
			min-height: 1px;
		}
		.fc-scroller{
			height:174px !important;
		}
		td{
			text-align: center
		}
	</style>
	<script type="text/javascript">
		 
	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			/*header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},*/
			
			/*navLinks: true, */// can click day/week names to navigate views
			 // allow "more" link when too many events
			
		});
		
	});
        
	</script>
@endsection