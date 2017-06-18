@extends('layouts.main')
@section('content')


<div class="row">
		<div class="col s12 m6 l5">
			<form>
	            <div class="input-field">
	              <input id="search" type="search" required>
	              <label class="label-icon" for="search">search
	              </label>
	              <i class="material-icons closed">close</i>
	            </div>
          </form>
		</div>
		<div class="col s12 m6 l5 center-align">
			 <ul id="dropdown" class="dropdown-content">
		         <li><a href="#">Inbox<span class="badge">12</span></a></li>
		         <li><a href="#!">Unread<span class="new badge">4</span></a></li>
		         <li><a href="#">Sent</a></li>
				 <li class="divider"></li>
				 <li><a href="#">Outbox</a></li>
		     </ul>
      		<a class="btn dropdown-button white black-text" href="#" data-activates="dropdown">Dropdown<i class="caret"></i></a>
      		<ul id="dropdown" class="dropdown-content">
		         <li><a href="#">Inbox<span class="badge">12</span></a></li>
		         <li><a href="#!">Unread<span class="new badge">4</span></a></li>
		         <li><a href="#">Sent</a></li>
				 <li class="divider"></li>
				 <li><a href="#">Outbox</a></li>
		     </ul>
      		<a class="btn dropdown-button white black-text" href="#" data-activates="dropdown">Dropdown<i class="caret"></i></a>
		</div>
		<!-- <div class="col s12 m6 l2">
			<a class='dropdown-button btn' href='#' data-activates='dropdown1'>Drop Me!</a>
				 Dropdown Structure 
			  <ul id='dropdown1' class='dropdown-content'>
			    <li><a href="#!">one</a></li>
			    <li><a href="#!">two</a></li>
			    <li class="divider"></li>
			    <li><a href="#!">three</a></li>
			  </ul>
		</div> -->
		<div class="col s12 m6 l2">
			<a class="waves-effect waves-light btn pull-right  blue" style="width: 100%;">add new</a>
		</div>
	</div>
	<div class="row">
		<div class="col s12 m6 l12">
		<div class="col s4">
			<h5>Group/Team/Orgnaization Name</h5>
		</div>
		<div class="col s4 center-align">
		    <h6>updated:2/12/2015</h6>
		</div>
		<div class="col s4 center-align">
		    <h6>Next Meeting:</h6>
		</div>
				
			
			</div>
		
	</div>
	<div class="row">
		<div class="col s12 m12 l10">
			 <div class="card-panel white z-depth-1 hoverable">
<!-- 				<i class="material-icons pull-right">view_headline</i><h6 class="no-margin">create homepage</h6>
-->
		<h5 class="no-margin">Report</h5>
				<table class="striped">
			        <thead>
			          <tr>
			              <th>Action item</th>
			              <th>Rank</th>
			              <th>Priority</th>
			              <th>Owner</th>
			              <th>Assign</th>
			              <th>Due</th>
						  <th>Done</th>
						  <th>Status</th>	  
						  <th>Notes</th>
			          </tr>
			        </thead>

			        <tbody>
			          <tr>
			            <td>Task1</td>
			            <td>1</td>
						<td class="green darken-1 text-white center-align">High</td>
           			    <td>Bill</td>
           			   	<td>1/1/2017</td>
           			   	<td>1/1/2017</td>
           			   	<td><i class="material-icons">done</i></td>
           			   	<td>100%</td>
           			   	<td>----</td>

			          </tr>
			          <tr>
			            <td>Task2</td>
			            <td><i class="material-icons blue-text text-darken-2">call_received</i></td>
						<td class="yellow darken-1 text-white center-align">medium</td>
           			    <td>Bill</td>
           			   	<td>1/1/2017</td>
           			   	<td>1/1/2017</td>
           			   	<td><i class="material-icons">done</i></td>
           			   	<td class="progress" style="width: 25%"></td>
           			   	<td>----</td>

			          </tr>
			          <tr>
			            <td>Task3</td>
			            <td><i class="material-icons">call_made</i></td>
						<td class=" red lighten-1 text-white center-align">poor</td>
						<td>Bill</td>
           			   	<td>1/1/2017</td>
           			   	<td>1/1/2017</td>
           			   	<td><i class="material-icons">done</i></td>
           			   	<td class="progress" style="width: 70%"></td>
           			   	<td>----</td>

			          </tr>
			          <tr>
			            <td>Task4</td>
			            <td><i class="material-icons blue-text text-darken-2">call_received</i></td>
						<td class=" green darken-1 text-white center-align">high</td>
						<td>Bill</td>
           			   	<td>1/1/2017</td>
           			   	<td>1/1/2017</td>
           			   	<td><i class="material-icons">done</i></td>
           			   	<td class="progress" style="width: 50%"></td>
           			   	<td>----</td>

			          </tr>
			          <tr>
			            <td>Task4</td>
			             <td><i class="material-icons blue-text text-darken-2	">call_made</i></td>
						<td class=" yellow lighten-1 text-white center-align">low</td>
						<td>Bill</td>
           			   	<td>1/1/2017</td>
           			   	<td>1/1/2017</td>
           			   	<td><i class="material-icons">done</i></td>
           			   	<td>pending</td>
           			   		<td>----</td>

			          </tr>
			       
			          

			        </tbody>
			      </table>

			</div> 
		</div>

		<div class="col s12 m12 l2">

			<div class="card hoverable">	
				<div class="card-content">
			      <span class="card-title activator blue-text text-darken-2">status<i class="material-icons">priority_high</i></span>
			      <div class="divider"></div>
			      <p class="p-20">
			      	
			      	<div class="chip">Design <i class="close material-icons">close</i></div>
			      	<div class="chip">Logo Design <i class="close material-icons">close</i></div>
			      	<div class="chip">Graphics <i class="close material-icons">close</i></div>
			      	<div class="chip">Designer <i class="close material-icons">close</i></div>
			      </p>
			    </div>
			</div>

		</div>
	</div>
	<div class="row">
		<div class="col s12 m6 l12">
			<div class="card hoverable">
				<h5 class="no-margin p-20">Report</h5>
				<div class="row p-20">
					 <a class="waves-effect waves-light btn">delete</a>
				      <a class="waves-effect waves-light btn">move to folder<span class="caret"></span></a>
				      <a class="waves-effect waves-light btn pull-right">create report</a>

				</div>
				  
	<table>
        <thead>
          <tr>
              <th class="p-20">REPORT NAME</th>
              <th>DESCRIPTION</th>
              <th>LAST RUN DATE<span class="caret"></span></th>
          </tr>
        </thead>

        <tbody>
          
          <tr>
            <td class="p-20"><input type="checkbox" id="test5" /><label for="test5" class="blue-text text-darken-2">Stage Vs Deal Type Report</label>  <i class="icon-bubble-dots4 grey-text text-lighten-1"></i></td>
            <td><h6 class="grey-text tex-lighten-1">Summarizes the various stages of New and Existing Business</h6></td>
            <td>now</td>
          </tr>
           <tr>
            <td   class="p-20"><input type="checkbox" id="test5" /> <label for="test5" class="blue-text text-darken-2">Overall Sales Duration Across Lead Sources</label></td>
            <td><h6 class="grey-text tex-lighten-1">Summarizes the various stages of New and Existing Business</h6></td>
            <td>-</td>
          </tr> 
          <tr>
            <td   class="p-20"><input type="checkbox" id="test5" /> <label for="test5" class="blue-text text-darken-2">Purchase Orders by Status</label></td>
            <td><h6 class="grey-text tex-lighten-1">Summarizes the various stages of New and Existing Business</h6></td>
            <td>-</td>
          </tr>
           <tr>
            <td   class="p-20"><input type="checkbox" id="test5" /> <label for="test5" class="blue-text text-darken-2">Purchase Orders by Status</label></td>
            <td><h6 class="grey-text tex-lighten-1">Summarizes the various stages of New and Existing Business</h6></td>
            <td>-</td>
          </tr>

 			<tr>
            <td   class="p-20"><input type="checkbox" id="test5" /> <label for="test5" class="blue-text text-darken-2">Purchase Orders by Status</label></td>
            <td><h6 class="grey-text tex-lighten-1">Summarizes the various stages of New and Existing Business</h6></td>
            <td>-</td>
          </tr>

        </tbody>
      </table>
            
			</div>
		</div>
	</div>
	<!-- <div class="row">
		<div class="col s12 m12 l10">
			 <div class="card-panel white z-depth-1 hoverable">
				<i class="material-icons pull-right">view_headline</i><h5 class="no-margin">demo</h5>
			</div> 
		</div>

		<div class="col s12 m12 l2">

			<div class="card hoverable">	
				<div class="card-content">
			      <span class="card-title activator blue-text text-darken-2">Clients<i class="material-icons">priority_high</i></span>
			      <div class="divider"></div>
			      <p class="p-20">
			      	
			      	<div class="chip">Design <i class="close material-icons">close</i></div>
			      	<div class="chip">Logo Design <i class="close material-icons">close</i></div>
			      	<div class="chip">Graphics <i class="close material-icons">close</i></div>
			      	<div class="chip">Designer <i class="close material-icons">close</i></div>
			      </p>
			    </div>
			</div>

		</div>
	</div> -->
<!-- <div class="row">
	<div class="col s12 m12 l10">
			<div class="card-panel white z-depth-1 hoverable">
				<div class="row valign-wrapper">
					<div class="col s2">
						<img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" alt="" class="circle responsive-img">  notice the "circle" class 
					</div>
					<div class="col s10">
						<span class="black-text flow-text truncate">
						<p class="flow-text truncate">I am Flow Text</p>
						This is a square image. Add the "circle" class to it to make it appear circular.
						</span>
					</div>
				</div>
				<div class="card-action">
					<a href="#" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">This is a link</a>
				</div>
			</div>
		</div>

		<div class="col s12 m12 l2">
			<div class="card hoverable">	
				<div class="card-content">
			      <span class="card-title activator blue-text text-darken-2">Clients<i class="material-icons">priority_high</i></span>
			      <div class="divider"></div>
			      <p class="p-20">
			      	<div class="chip">Design <i class="close material-icons">close</i></div>
			      	<div class="chip">Logo Design <i class="close material-icons">close</i></div>
			      	<div class="chip">Graphics <i class="close material-icons">close</i></div>
			      	<div class="chip">Designer <i class="close material-icons">close</i></div>
			      </p>
			    </div>
			</div>
			</div>
		</div> -->

<!-- 
<div class="row">
	<div class="col s12 m12 l10">
			<div class="card-panel white z-depth-1 hoverable project">
				<div class="row">
					<div class="col-md-18 ">
						
					</div>
			 	</div>

				<div class="card-action projects-tags">
						<span>Tags :</span>						
						<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" class="chip">Php Programmer</a>						
						<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" class="chip">Laravel</a>						
						<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" class="chip">Experianced</a>						
				</div>
				<div class="card-action projects-categories">
						<span>categories :</span>						
						<span class="badge">Management</span>						
						<span class="badge">HR</span>						
						<span class="badge">Hiring</span>				
				</div>
				</div>
		</div>
		<div class="col s12 m12 l2">
			<div class="card hoverable">	
				<div class="card-content">
			      <span class="card-title activator blue-text text-darken-2">Status<i class="material-icons">priority_high</i></span>
			      <div class="divider"></div>
			      <p class="p-20">
						</p><div class="chips chips-initial chips-placeholder chips-autocomplete">
							<div class="chip">Designer <i class="close material-icons">close</i></div>
							<div class="chip">Designer <i class="close material-icons">close</i></div>
							<div class="chip">Designer <i class="close material-icons">close</i></div>
						</div>
			      <p></p>
			    </div>
				</div>
		</div>
</div> -->
@endsection