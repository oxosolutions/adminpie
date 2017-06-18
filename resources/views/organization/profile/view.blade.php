@extends('layouts.main')
@section('content')
	<div class="row">
		@include('organization.profile._tabs')
		<div class="col l9 pr-7">
			<div class="card" style="margin-top: 14px">
				<div class="row">
					<div class="col l3" style="padding:14px">
						<img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" style="width: 100%">
					</div>
					<div class="col l9" style="padding:14px">
						<div class="row" style="padding:0px 0px 5px 0px">
							<div class="col l3"><strong>Name:</strong></div>
							<div class="col l5">Sgs Sandhu</div>
							<div class="col l4 right-align">
								<a href="{{ route('profile.edit') }}" class="btn blue">Edit Profile</a>
							</div>
						</div>
						<div class="row" style="padding:5px 0px">
							<div class="col l3"><strong>Designation</strong></div>
							<div class="col l9">MD</div>
						</div>
						<div class="row" style="padding:5px 0px 0px 0px">
							<div class="col l3"><strong>About Me</strong></div>
							<div class="col l9">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse fermentum at ante ut rhoncus. Vestibulum a ullamcorper risus, at eleifend sem. Sed turpis dui, sollicitudin sit amet lobortis at,</div>
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
					<div class="row valign-wrapper" style="padding:5px 0px">
						<div class="col l1 blue white-text center-align">
							<div class="row " style="font-size: 16px ;font-weight: 700">
								June
							</div>
							<div class="row" style="font-size: 28px;line-height: 30px;font-weight: 700">
								05
							</div>
						</div>
						<div class="col l7 pl-7">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit.
						</div>
						<div class="col l2">
							<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text">ACCOMPLISHED</span>
						</div>
						<div class="col l2 grey-text center-align" style="font-size: 13px">
							2 hour ago
						</div>	
					</div>
					<div class="row valign-wrapper" style="padding:5px 0px">
						<div class="col l1 blue white-text center-align">
							<div class="row " style="font-size: 16px ;font-weight: 700">
								June
							</div>
							<div class="row" style="font-size: 28px;line-height: 30px;font-weight: 700">
								03
							</div>
						</div>
						<div class="col l7 pl-7">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit.
						</div>
						<div class="col l2">
							<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text">ACCOMPLISHED</span>
						</div>
						<div class="col l2 grey-text center-align" style="font-size: 13px">
							2 hour ago
						</div>	
					</div>
					<div class="row valign-wrapper" style="padding:5px 0px">
						<div class="col l1 blue white-text center-align">
							<div class="row " style="font-size: 16px ;font-weight: 700">
								June
							</div>
							<div class="row" style="font-size: 28px;line-height: 30px;font-weight: 700">
								01
							</div>
						</div>
						<div class="col l7 pl-7">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit.
						</div>
						<div class="col l2">
							<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text">ACCOMPLISHED</span>
						</div>
						<div class="col l2 grey-text center-align" style="font-size: 13px">
							2 hour ago
						</div>	
					</div>
					<div class="row valign-wrapper" style="padding:5px 0px">
						<div class="col l1 blue white-text center-align">
							<div class="row " style="font-size: 16px ;font-weight: 700">
								June
							</div>
							<div class="row" style="font-size: 28px;line-height: 30px;font-weight: 700">
								01
							</div>
						</div>
						<div class="col l7 pl-7">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit.
						</div>
						<div class="col l2">
							<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text">ACCOMPLISHED</span>
						</div>
						<div class="col l2 grey-text center-align" style="font-size: 13px">
							2 hour ago
						</div>	
					</div>
					<div class="row valign-wrapper" style="padding:5px 0px">
						<div class="col l1 blue white-text center-align">
							<div class="row " style="font-size: 16px ;font-weight: 700">
								June
							</div>
							<div class="row" style="font-size: 28px;line-height: 30px;font-weight: 700">
								01
							</div>
						</div>
						<div class="col l7 pl-7">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit.
						</div>
						<div class="col l2">
							<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text">ACCOMPLISHED</span>
						</div>
						<div class="col l2 grey-text center-align" style="font-size: 13px">
							2 hour ago
						</div>	
					</div>
					<div class="row valign-wrapper" style="padding:5px 0px">
						<div class="col l1 blue white-text center-align">
							<div class="row " style="font-size: 16px ;font-weight: 700">
								June
							</div>
							<div class="row" style="font-size: 28px;line-height: 30px;font-weight: 700">
								01
							</div>
						</div>
						<div class="col l7 pl-7">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit.
						</div>
						<div class="col l2">
							<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text">ACCOMPLISHED</span>
						</div>
						<div class="col l2 grey-text center-align" style="font-size: 13px">
							2 hour ago
						</div>	
					</div>
					<div class="row valign-wrapper" style="padding:5px 0px">
						<div class="col l1 blue white-text center-align">
							<div class="row " style="font-size: 16px ;font-weight: 700">
								June
							</div>
							<div class="row" style="font-size: 28px;line-height: 30px;font-weight: 700">
								01
							</div>
						</div>
						<div class="col l7 pl-7">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit.
						</div>
						<div class="col l2">
							<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text">ACCOMPLISHED</span>
						</div>
						<div class="col l2 grey-text center-align" style="font-size: 13px">
							2 hour ago
						</div>	
					</div>
					<div class="row valign-wrapper" style="padding:5px 0px">
						<div class="col l1 blue white-text center-align">
							<div class="row " style="font-size: 16px ;font-weight: 700">
								June
							</div>
							<div class="row" style="font-size: 28px;line-height: 30px;font-weight: 700">
								01
							</div>
						</div>
						<div class="col l7 pl-7">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit.
						</div>
						<div class="col l2">
							<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text">ACCOMPLISHED</span>
						</div>
						<div class="col l2 grey-text center-align" style="font-size: 13px">
							2 hour ago
						</div>	
					</div>
					
				</div>
					 
			</div>
		</div>
		<div class="col l3 pl-7">
			<div class="card"  style="margin-top: 14px">
				<div class="row center-align" style="padding:10px 0px">
					<a href="{{ route('profile.changepassword') }}" class="btn blue">Change Password</a>	
				</div>
				
			</div>
			<div class="card" style="margin-top: 14px">
				<div class="row">
					<span style="font-weight: 600;padding: 10px 5px;display: block;border-bottom: 1px solid #e8e8e8">Contact Detail</span>
				</div>
				<div class="row" style="padding: 0px 5px">
					<div class="row" style="padding: 5px 0px ">
						<div class="col l4">
							Contact no.
						</div>
						<div class="col l8">
							1800 287 7787
						</div>
					</div>
					<div class="row" style="padding: 5px 0px ">
						<div class="col l4">
							Email.
						</div>
						<div class="col l8">
							<a>demoemail@domain.com</a>
						</div>
					</div>
					<div class="row" style="padding: 5px 0px ">
						<div class="col l4">
							Address
						</div>
						<div class="col l8">
							14 B<br>college lane<br>Rani ka bagh<br>Amritsar<br>143001
						</div>
					</div>
				</div>
			</div>
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
@endsection
