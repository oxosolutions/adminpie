@extends('layouts.main')
@section('content')
<div class="row">
	<div class="col l8">
		<div class="card">
			<div class="row">
				<div class="col l6">
					<h5>Employes Absence statstics</h5>
				</div>
				<div class="col l6 right-align pt-15 pl-15">
					<ul class="icons-list">
                		<li class="dropdown">
                			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#"><i class="icon-sync"></i> Update data</a></li>
								<li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
								<li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
								<li class="divider"></li>
								<li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
							</ul>
                		</li>
                	</ul>
				</div>
			</div>
			
			<div class="col l12">
				<div class="col l4 center-align">
					<div class="row" style="margin: 0">
						<div class="col l12 center-align">
							<span><i class="fa fa-user-times fa-2x" style="padding-right:5px;color:#607d8b;"></i></span> 
							<span class="text-grey darken-3" style="font-size:24px;font-weight:500; ">03</span>
						</div>
						<div class="col l12 center-align text-grey">
							Absent employes
						</div>
					</div>
				</div>
				<div class="col l4 center-align">
					<div class="row" style="margin: 0">
						<div class="col l12 center-align">
							<span><i class="fa fa-user fa-2x" style="padding-right:5px;color:#607d8b;"></i></span> 
							<span class="text-grey darken-3" style="font-size:24px;font-weight:500; ">143</span>
						</div>
						<div class="col l12 center-align text-grey">
							Present employes
						</div>
					</div>
				</div>
				<div class="col l4 center-align">
					<div class="row" style="margin: 0">
						<div class="col l12 center-align">
							<span><i class="fa fa-users fa-2x" style="padding-right:5px;color:#607d8b;"></i></span> 
							<span class="text-grey darken-3" style="font-size:24px;font-weight:500; ">146</span>
						</div>
						<div class="col l12 center-align text-grey">
							Total employes
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<svg width="600.40625" height="255"><g transform="translate(50,5)" width="600.40625"><g class="d3-axis d3-axis-horizontal d3-axis-solid" transform="translate(0,220)"><g class="tick" transform="translate(0,0)" style="opacity: 1;"><line y2="4" x2="0"></line><text dy=".71em" y="12" x="0" style="text-anchor: middle;">Mon</text></g><g class="tick" transform="translate(57.234375,0)" style="opacity: 1;"><line y2="4" x2="0"></line><text dy=".71em" y="12" x="0" style="text-anchor: middle;">Tue</text></g><g class="tick" transform="translate(114.46875,0)" style="opacity: 1;"><line y2="4" x2="0"></line><text dy=".71em" y="12" x="0" style="text-anchor: middle;">Wed</text></g><g class="tick" transform="translate(171.703125,0)" style="opacity: 1;"><line y2="4" x2="0"></line><text dy=".71em" y="12" x="0" style="text-anchor: middle;">Thu</text></g><g class="tick" transform="translate(228.9375,0)" style="opacity: 1;"><line y2="4" x2="0"></line><text dy=".71em" y="12" x="0" style="text-anchor: middle;">Fri</text></g><g class="tick" transform="translate(286.171875,0)" style="opacity: 1;"><line y2="4" x2="0"></line><text dy=".71em" y="12" x="0" style="text-anchor: middle;">Sat</text></g><g class="tick" transform="translate(343.40625,0)" style="opacity: 1;"><line y2="4" x2="0"></line><text dy=".71em" y="12" x="0" style="text-anchor: middle;">Sun</text></g><path class="domain" d="M0,6V0H343.40625V6"></path></g><g class="d3-axis d3-axis-vertical d3-axis-transparent"><g class="tick" transform="translate(0,195.55555555555554)" style="opacity: 1;"><line x2="343.40625" y2="0"></line><text dy=".32em" x="-8" y="0" style="text-anchor: end;">70</text></g><g class="tick" transform="translate(0,146.66666666666669)" style="opacity: 1;"><line x2="343.40625" y2="0"></line><text dy=".32em" x="-8" y="0" style="text-anchor: end;">80</text></g><g class="tick" transform="translate(0,97.77777777777777)" style="opacity: 1;"><line x2="343.40625" y2="0"></line><text dy=".32em" x="-8" y="0" style="text-anchor: end;">90</text></g><g class="tick" transform="translate(0,48.888888888888886)" style="opacity: 1;"><line x2="343.40625" y2="0"></line><text dy=".32em" x="-8" y="0" style="text-anchor: end;">100</text></g><g class="tick" transform="translate(0,0)" style="opacity: 1;"><line x2="343.40625" y2="0"></line><text dy=".32em" x="-8" y="0" style="text-anchor: end;">110</text></g><path class="domain" d="M343.40625,0H0V220H343.40625"></path></g><g class="lines" id="Alpha-line"><path class="d3-line d3-line-medium" d="M0,0Q45.7875,69.42222222222223,57.234375,73.33333333333334C74.4046875,79.20000000000002,97.2984375,35.44444444444446,114.46875,39.11111111111112S154.5328125,99.97777777777777,171.703125,97.77777777777777S211.7671875,28.11111111111112,228.9375,24.444444444444457S269.0015625,75.53333333333335,286.171875,73.33333333333334Q297.61875,71.86666666666667,343.40625,9.777777777777768" style="stroke: rgb(76, 175, 80); opacity: 1;"></path><circle class="d3-line-circle d3-line-circle-medium" cx="0" cy="0" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(76, 175, 80); opacity: 1;"></circle><circle class="d3-line-circle d3-line-circle-medium" cx="57.234375" cy="73.33333333333334" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(76, 175, 80); opacity: 1;"></circle><circle class="d3-line-circle d3-line-circle-medium" cx="114.46875" cy="39.11111111111112" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(76, 175, 80); opacity: 1;"></circle><circle class="d3-line-circle d3-line-circle-medium" cx="171.703125" cy="97.77777777777777" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(76, 175, 80); opacity: 1;"></circle><circle class="d3-line-circle d3-line-circle-medium" cx="228.9375" cy="24.444444444444457" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(76, 175, 80); opacity: 1;"></circle><circle class="d3-line-circle d3-line-circle-medium" cx="286.171875" cy="73.33333333333334" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(76, 175, 80); opacity: 1;"></circle><circle class="d3-line-circle d3-line-circle-medium" cx="343.40625" cy="9.777777777777768" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(76, 175, 80); opacity: 1;"></circle></g><g class="lines" id="Delta-line"><path class="d3-line d3-line-medium" d="M0,195.55555555555554Q45.7875,227.33333333333334,57.234375,220C74.4046875,209,97.2984375,129.55555555555557,114.46875,122.22222222222223S154.5328125,178.44444444444446,171.703125,171.11111111111111S211.7671875,81.4,228.9375,73.33333333333334S269.0015625,115.86666666666666,286.171875,117.33333333333333Q297.61875,118.3111111111111,343.40625,83.11111111111111" style="stroke: rgb(255, 87, 34); opacity: 1;"></path><circle class="d3-line-circle d3-line-circle-medium" cx="0" cy="195.55555555555554" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(255, 87, 34); opacity: 1;"></circle><circle class="d3-line-circle d3-line-circle-medium" cx="57.234375" cy="220" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(255, 87, 34); opacity: 1;"></circle><circle class="d3-line-circle d3-line-circle-medium" cx="114.46875" cy="122.22222222222223" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(255, 87, 34); opacity: 1;"></circle><circle class="d3-line-circle d3-line-circle-medium" cx="171.703125" cy="171.11111111111111" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(255, 87, 34); opacity: 1;"></circle><circle class="d3-line-circle d3-line-circle-medium" cx="228.9375" cy="73.33333333333334" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(255, 87, 34); opacity: 1;"></circle><circle class="d3-line-circle d3-line-circle-medium" cx="286.171875" cy="117.33333333333333" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(255, 87, 34); opacity: 1;"></circle><circle class="d3-line-circle d3-line-circle-medium" cx="343.40625" cy="83.11111111111111" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(255, 87, 34); opacity: 1;"></circle></g><g class="lines" id="Sigma-line"><path class="d3-line d3-line-medium" d="M0,146.66666666666669Q45.7875,95.33333333333333,57.234375,97.77777777777777C74.4046875,101.44444444444444,97.2984375,181.3777777777778,114.46875,171.11111111111111S154.5328125,29.33333333333333,171.703125,29.33333333333333S211.7671875,153.51111111111112,228.9375,171.11111111111111S269.0015625,143.00000000000003,286.171875,146.66666666666669Q297.61875,149.11111111111114,343.40625,195.55555555555554" style="stroke: rgb(92, 107, 192); opacity: 1;"></path><circle class="d3-line-circle d3-line-circle-medium" cx="0" cy="146.66666666666669" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(92, 107, 192); opacity: 1;"></circle><circle class="d3-line-circle d3-line-circle-medium" cx="57.234375" cy="97.77777777777777" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(92, 107, 192); opacity: 1;"></circle><circle class="d3-line-circle d3-line-circle-medium" cx="114.46875" cy="171.11111111111111" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(92, 107, 192); opacity: 1;"></circle><circle class="d3-line-circle d3-line-circle-medium" cx="171.703125" cy="29.33333333333333" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(92, 107, 192); opacity: 1;"></circle><circle class="d3-line-circle d3-line-circle-medium" cx="228.9375" cy="171.11111111111111" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(92, 107, 192); opacity: 1;"></circle><circle class="d3-line-circle d3-line-circle-medium" cx="286.171875" cy="146.66666666666669" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(92, 107, 192); opacity: 1;"></circle><circle class="d3-line-circle d3-line-circle-medium" cx="343.40625" cy="195.55555555555554" r="3" style="fill: rgb(255, 255, 255); stroke: rgb(92, 107, 192); opacity: 1;"></circle></g></g></svg>
			</div>

			<div style="clear: both">
			
			</div>
		</div>
		<div class="card">
			<div class="row">
				<div class="col l12">
					<div class="col l6">
						<h5>Projects</h5>
					</div>
					<div class="col l6  pt-15 pl-15">
						<div class="row">
							<div class="col l3  offset-l6 right-align">TODAY</div>	
							<ul class="icons-list col l3 right-align">

		                		<li class="dropdown">
		                			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="#"><i class="icon-sync"></i> Update data</a></li>
										<li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
										<li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
										<li class="divider"></li>
										<li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
									</ul>
		                		</li>
		                	</ul>
		                </div>
					</div>
				</div>
				<div class="col l12">
					<table class="highlight">			
				        <tbody>
							<tbody>
								
								<tr>
									<td>
										<div class="media-left media-middle">
											<a href="#"><img src="{{ asset('assets/images/spotify.png') }}" class="img-circle img-xs" alt=""></a>
										</div>
										<div class="media-left">
											<div class=""><a href="#" class="text-default text-semibold">OCRM</a></div>
											<div class="text-muted text-size-small">
												<span class="status-mark border-blue position-left"></span>
												4 Members Assigned
											</div>
										</div>
									</td>
									<td><span class="text-muted">Oxo solutions</span></td>
									<td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> 24.3% Completed</span></td>
									<td><h6 class="text-semibold">$5,489</h6></td>
									<td><span class="label bg-blue">Active</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
													<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
													<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
													<li class="divider"></li>
													<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>
										<div class="media-left media-middle">
											<a href="#"><img src="{{ asset('assets/images/spotify.png') }}" class="img-circle img-xs" alt=""></a>
										</div>
										<div class="media-left">
											<div class=""><a href="#" class="text-default text-semibold">smaartframework</a></div>
											<div class="text-muted text-size-small">
												<span class="status-mark border-danger position-left"></span>
												4 members worked
											</div>
										</div>
									</td>
									<td><span class="text-muted">Govt of india</span></td>
									<td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> 91%</span></td>
									<td><h6 class="text-semibold">$2,592</h6></td>
									<td><span class="label bg-danger">Closed</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
													<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
													<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
													<li class="divider"></li>
													<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>
										<div class="media-left media-middle">
											<a href="#"><img src="{{ asset('assets/images/spotify.png') }}" class="img-circle img-xs" alt=""></a>
										</div>
										<div class="media-left">
											<div class=""><a href="#" class="text-default text-semibold">Spotify ads</a></div>
											<div class="text-muted text-size-small">
												<span class="status-mark border-grey-400 position-left"></span>
												6 Members working
											</div>
										</div>
									</td>
									<td><span class="text-muted">Diligence</span></td>
									<td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> 52.78%</span></td>
									<td><h6 class="text-semibold">$1,268</h6></td>
									<td><span class="label bg-grey-400">Hold</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
													<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
													<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
													<li class="divider"></li>
													<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>
										<div class="media-left media-middle">
											<a href="#"><img src="{{ asset('assets/images/spotify.png') }}" class="img-circle img-xs" alt=""></a>
										</div>
										<div class="media-left">
											<div class=""><a href="#" class="text-default text-semibold">Twitter ads</a></div>
											<div class="text-muted text-size-small">
												<span class="status-mark border-grey-400 position-left"></span>
												1 member working
											</div>
										</div>
									</td>
									<td><span class="text-muted">Deluxe</span></td>
									<td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> 12.78%</span></td>
									<td><h6 class="text-semibold">$7,467</h6></td>
									<td><span class="label bg-grey-400">Hold</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-file-stats"></i> View statement</a></li>
													<li><a href="#"><i class="icon-file-text2"></i> Edit campaign</a></li>
													<li><a href="#"><i class="icon-file-locked"></i> Disable campaign</a></li>
													<li class="divider"></li>
													<li><a href="#"><i class="icon-gear"></i> Settings</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
							</tbody>
				        </tbody>
				    </table>
				</div>
			</div>
			
		</div>

		
	</div>
	<div class="col l4">
		<div class="white p-20 center-align card shadow Check-in-out-div">
		<input type="hidden" id="user_id" name="user_id" value="{{Auth::guard('org')->user()->id}}">
		<input type="hidden" id="token" name="token" value="{{csrf_token()}}">
		<input type="hidden" id="check_in_out_status" name="check_in_out_status" value="{{$check_in_out_status}}">

			<a href="#" class="btn green Check-in-out-button">Check in</a>
		</div>
		<div class="white center-align card shadow Check-in-out-div">
			<div class="row mt-10">
				<div class="left-align col l6">
					<span style="font-size: 24px;font-weight: 500">Attendence</span>
				</div>
				<div class="right-align col l6 pt-5">
					<a href="#" class="waves-effect transparent text-grey pr-10" ><i class="fa fa-chevron-left " style="font-size: 16px"></i></a>
					<a href="#" class="waves-effect transparent text-grey"><i class="fa fa-chevron-right " style="font-size: 16px"></i></a>
				</div>
			</div>
			<div class="row text-orange accent-4">
				<span style="font-size:24px;font-weight:500; ">January 2017</span>
			</div>
			<div class="row ">
				<div class="col l6">
					<div style="border:1px solid #E9E9E9">
						<div style="background-color: #E9E9E9" class="p-5">
							Working days
						</div>
						<div class="p-5" style="font-size:24px;font-weight:500; ">
							30
						</div>
					</div>
				</div>
				<div class="col l6">
					<div style="border:1px solid #E9E9E9">
						<div style="background-color: #E9E9E9" class="p-5">
							Present days
						</div>
						<div class="p-5" style="font-size:24px;font-weight:500; ">
							27
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col l12 left-align">
					Late Arrivels
				</div>
				<div class="col l12">
					<div class="progress" style="height:20px">
				  		<div class="progress-bar progress-bar-danger right-align pl-10" role="progressbar" aria-valuenow="70"
				  		aria-valuemin="0" aria-valuemax="100" style="width:33%">
				   	 		
				 		</div>
				 		<div class="row">
				 			<div class="col  left-align">
				 				10/30
				 			</div>
				 			<div class="col  right-align">
				 				33%
				 			</div>
				 		</div>
					</div>
				</div>
					
			</div>
			<div class="row">
				<div class="col l12 left-align">
					Early Departure
				</div>
				<div class="col l12">
					<div class="progress" style="height:20px">
				  		<div class="progress-bar progress-bar-success right-align pl-10" role="progressbar" aria-valuenow="70"
				  		aria-valuemin="0" aria-valuemax="100" style="width:66%">
				   	 		
				 		</div>
				 		<div class="row">
				 			<div class="col left-align">
				 				20/30
				 			</div>
				 			<div class="col right-align">
				 				66%
				 			</div>
				 		</div>
					</div>
				</div>
					
			</div>
			<div class="row">
				<div class="col l12">
				<table>
					
						<tr>
							<td>Absents</td>
							<td>03</td>
						</tr>
						<tr>
							<td>Violations</td>
							<td>00</td>
						</tr>
						<tr>
							<td>Availed PL Leaves</td>
							<td>02</td>
						</tr>
						<tr>
							<td>Availed CL Leaves</td>
							<td>01</td>
						</tr>
					
				</table>
				</div>
			</div>
		</div>
	</div>
	
</div>
<div class="row">
	<div class=" col l3">
		<div class="card shadow p-10">
			<h5>Upcoming Holidays</h5>
			<div class="row valign-wrapper" >
				<div class="col l3" style="height: 60px;background-color: #e8e8e8">
					
				</div>
				<div class="col l9">
					<div >
						Independence Day
					</div>
					<div class="text-grey lighten-2">
						Aug 15 2017
					</div>
				</div>
			</div>
			<div class="row valign-wrapper" >
				<div class="col l3" style="height: 60px;background-color: #e8e8e8">
					
				</div>
				<div class="col l9">
					<div >
						Mahatma Gandhi Jayanti
					</div>
					<div class="text-grey lighten-2">
						Oct 2 2017
					</div>
				</div>
			</div>
			<div class="row valign-wrapper" >
				<div class="col l3" style="height: 60px;background-color: #e8e8e8">
					
				</div>
				<div class="col l9">
					<div >
						Diwali/Deepavali
					</div>
					<div class="text-grey lighten-2">
						Oct 19 2017
					</div>
				</div>
			</div>
			
			<div style="clear: both">
				
			</div>
		</div>
	</div>
	<div class=" col l9">
		<div class="card shadow p-10">
			<h5>Track Employes</h5>
			<div>
				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var check_in_out_status = $("#check_in_out_status").val();
		if(check_in_out_status== 'check_in')
		{
				$('.Check-in-out-button').text('Check Out');
				$('.Check-in-out-button').removeClass('green');
				$('.Check-in-out-button').addClass('red');
		}else{
				$('.Check-in-out-button').text('Check in');
				$('.Check-in-out-button').addClass('green');
				$('.Check-in-out-button').removeClass('red');

		}

		$('.Check-in-out-button').click(function(){
			var check_in_out_status = $("#check_in_out_status").val();
			if($(this).html() == 'Check in'){
				var status = 'check_in';

				$(this).text('Check Out');
				$(this).removeClass('green');
				$(this).addClass('red');
			}else{
				var status ='check_out';
				$(this).text('Check in');
				$(this).addClass('green');
				$(this).removeClass('red');
			}

			data = {};
			data['_token'] =	$("#token").val();
			data['status'] =	status;
			data['user_id'] =	$("#user_id").val();

			$.ajax({
					url:route()+'/attendance/check_in_out',
					type:'POST',
					data: data,
					sucess:function(response)
					{
						console.log(response);
					}
				});


		});
	});

	
</script>
<style type="text/css">
	.Check-in-out-button , .Check-in-out-button:hover{
		color: white;
	}
	.progress{
		background-color: #e9e9e9 !important;
	}
	
</style>
@endsection