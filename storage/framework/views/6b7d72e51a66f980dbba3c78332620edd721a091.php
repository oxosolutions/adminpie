<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('LTR/default/assets/css/icons/icomoon/styles.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('LTR/default/assets/css/bootstrap.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('LTR/default/assets/css/core.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('LTR/default/assets/css/components.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('LTR/default/assets/css/colors.css')); ?>" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo e(asset('LTR/default/assets/js/plugins/loaders/pace.min.js ')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('LTR/default/assets/js/core/libraries/jquery.min.js ')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('LTR/default/assets/js/core/libraries/bootstrap.min.js ')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('LTR/default/assets/js/plugins/loaders/blockui.min.js ')); ?>"></script>
</head>
<style type="text/css">

body{
	background-color: #ffffff;
}
.main-container{
	padding:17px;
}
	.form_group{
		margin:30px;
	    font-size: 16px;
	    font-weight: 400;
	    color: #5d5c5c;
	    font-family: 'Open Sans', sans-serif;
		}
	.form-control{
		background: #f8f8f8;
	}
	.btn {
	
	    background: #2196F3;
	    margin-top: 30px;
}
}
.input-group{
	margin-left: 54px;
   
}
.table > thead > tr > th{
	    padding: 7px 7px !important;
}	
.table > tbody > tr > td{
	  padding: 7px 7px;
}
.pager li > a{
	    background-color: #006694;
	    color: #ffffff;
}
.design-style{
	
    text-align: center;
    margin-top: 0px;
}
.design-bg{
	background: #ececec;
    padding: 24px 14px 15px 14px;
    border-radius: 3px;
    border: 1px solid #ddd;
    margin-bottom: 10px;
}
.present-bg-color{
	background: #8BC34A;
    color: #fff;
}
.absent-bg-color{
	background:#e53935;
	color: #fff;
}
.pager li > a:hover{
	background-color: #006694;
}
.table-tr{
	text-align: center;
}
</style>
<body>





<div class="row">
		<h1 class="text-center">Attendance 3-2017</h1>
</div>

		<div class="panel panel-flat">
					<div class="row form_group">
							<div class="col-md-4 form-group">
							  <label for="sel1">Select Week</label>
							  <select class="form-control" id="sel1">
							    <option>Sun</option>
							    <option>Mon</option>
							    <option>Tues</option>
							    <option>Wed</option>
							    <option>Thus</option>
							    <option>Fri</option>
							    <option>Sat</option>
							  </select>
							</div>
							<div class="col-md-4 form-group">
							  <label for="sel1">Select Month</label>
							  <select class="form-control" id="sel1">
							    <option>Jan</option>
							    <option>Feb</option>
							    <option>Mar</option>
							    <option>April</option>
							    <option>May</option>
							    <option>June</option>
							    <option>July</option>
							    <option>Aug</option>
 								<option>Sept</option>
								<option>Oct</option>
								<option>Nov</option>
								<option>Dec</option>

							  </select>
							</div>
							<div class="col-md-3 form-group">
							  <label for="sel1">Year</label>
							  <select class="form-control" id="sel1">
							    <option>2016</option>
							    <option>2017</option>
							   </select>
							</div>
							<div class="col-md-1">
								<div class="input-group-btn">
								    <button type="submit" class="btn btn-primary">Search <i class="glyphicon glyphicon-search"></i></button>
	 							</div>	
							</div>
							
						</div>
						
						</div> 
						<div class="main-container">
							<div class="row design-bg">
						<div class="col-md-4">
							<ul class="pager">
								<li class="previous"><a href="#">Previous Month</a></li>
							</ul>
						</div>
						<div class="col-md-4">
							<h3 class="design-style">January,2017</h3>
						</div>
						<div class="col-md-4">
							<ul class="pager">
								<li class="next"><a href="#">Next Month</a></li>
							</ul>
						</div>	 
					  </div> 
					<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<thead>
									<tr class="table-tr">
										<th>Employee</th>
										<th>Name</th>
										<th>Department</th>
										<th>Attendance Count</th>
										<th>Attendance %</th>
										
										 <th> 01 S</th>
										<th> 02 M</th>
										<th> 03 T</th>
										<th> 04 W</th>
										<th> 05 T</th>
										<th> 06 F</th>
										<th> 07 S</th>
										<th> 08 M</th>
										<th> 09 T</th>
										<th> 10 W</th>
										<th> 11 T</th>
										<th> 12 F</th>
										<th> 13 S</th>
										<th> 14 S</th>
										<th> 15 M</th>
										<th> 16 T</th>
										<th> 17 W</th>
										<th> 18 T</th>
										<th> 19 F</th>
										<th> 20 S</th>
										<th> 21 S</th>
										<th> 22 M</th>
										<th> 23 T</th>
										<th> 24 W</th>
										<th> 25 T</th>
										<th> 26 F</th>
										<th> 27 S</th>
										<th> 28 S</th>
										<th> 29 M</th>
										<th> 30 T</th>
										<th> 31 W</th>  


								</tr>
								</thead>
								<tbody>
									<tr class="table-tr">
										<td>40015001</td>
										<td>Gurjant S</td>
										<td>Management</td>
										<td>20/27</td>
										<td>75</td>
										<td>P</td>
										<td class="present-bg-color">P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">P</td>
									    <td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">P</td> 

									</tr>
									<tr class="table-tr">
										<td>40015002</td>
										<td>Amritdeep</td>
										<td>Management</td>
										<td>26/27</td>
										<td>97</td>
										<td>P</td>
										<td class="present-bg-color">p</td>
										<td>p</td>
										<td>P</td>
										<td class="present-bg-color">P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">P</td>
										<td>P</td>
										<td>P</td>
								        <td>P</td>
										<td>P</td>
										<td class="present-bg-color">P</td>
										<td class="absent-bg-color">A</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">p</td>
										<td>P</td>
										<td class="absent-bg-color">A</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">p</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">P</td>
									
									</tr>
									<tr class="table-tr">
										<td>40015003</td>
										<td>Sakkatar</td>
										<td>Management</td>
										<td>25/27</td>
										<td>93</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">P</td>
										<td>P</td>
										<td class="absent-bg-color">A</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">p</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">p</td>
										<td>P</td>
										<td>P</td>
										<td class="absent-bg-color">A</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">p</td>
										<td>P</td>
										<td>P</td>
										<td class="absent-bg-color">A</td>
										<td>P</td>
									
									
									</tr>
									<tr class="table-tr">
										<td>40015004</td>
										<td>Franklin</td>
										<td>Morrison</td>
										<td>@Frank</td>
										<td>93</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">p</td>
										<td>p</td>
									    <td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>p</td>
										<td>P</td>
										<td class="present-bg-color">P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">P</td>
										<td>P</td>
										<td>P</td> 
										<td>P</td>
										<td>P</td>
										<td>P</td>
										
										
									</tr>
									<tr class="table-tr">
										<td>40015004</td>
										<td>Franklin</td>
										<td>Morrison</td>
										<td>@Frank</td>
										<td>93</td>
										<td>P</td>
										<td class="present-bg-color">P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="absent-bg-color">A</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
									    <td class="present-bg-color">p</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</tdP
										<td>P</td>
										<td class="present-bg-color">P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="absent-bg-color">A</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">P</td>
										<td>P</td> 
										<td>P</td>
										<td>P<Ptd>
										
										

									</tr>
								</tbody>
							</table>
						</div>
						</div>
					
				<div class="main-container">
					<div class="row design-bg">
						<div class="col-md-4">
							<ul class="pager">
								<li class="previous"><a href="#">Previous Week</a></li>
							</ul>
						</div>
						<div class="col-md-4">
							<h3 class="design-style">1-7 Days</h3>
						</div>
						<div class="col-md-4">
							<ul class="pager">
								<li class="next"><a href="#">Next Week</a></li>
							</ul>
						</div>	 
					  </div> 
					<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<thead>
									<tr class="table-tr">
										<th>Employee</th>
										<th>Name</th>
										<th>Department</th>
										<th>Attendance Count</th>
										<th>Attendance %</th>
										<th> 1 S</th>
										<th> 2 M</th>
										<th> 3 T</th>
										<th> 4 W</th>
										<th> 5 T</th>
										<th> 6 F</th>
										<th> 7 S</th>


								</tr>
								</thead>
								<tbody>
									<tr class="table-tr">
										<td>40015001</td>
										<td>Gurjant Singh</td>
										<td>Management</td>
										<td>20/27</td>
										<td>75</td>
										<td class="present-bg-color">p</td>
										<td>P</td>
										<td>P</td>
										<td class="absent-bg-color">A</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>

									</tr>
									
									<tr class="table-tr">
										<td>40015002</td>
										<td>Amritdeep</td>
										<td>Management</td>
										<td>26/27</td>
										<td>97</td>
										<td>P</td>
										<td class="present-bg-color">P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>

									
									</tr>
									<tr class="table-tr">
										<td>40015003</td>
										<td>Sakkatar</td>
										<td>Management</td>
										<td>25/27</td>
										<td>93</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">A</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										
										
									</tr>
									<tr class="table-tr">
										<td>40015004</td>
										<td>Franklin</td>
										<td>Morrison</td>
										<td>@Frank</td>
										<td>93</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td>P</td>
										<td class="present-bg-color">A</td>
										

									</tr>
								</tbody>
							</table>
						</div>
				</div>
				
				<div class="main-container">
					<div class="row design-bg">
						<div class="col-md-4">
							<ul class="pager">
								<li class="previous"><a href="#">Yesterday</a></li>
							</ul>
						</div>
						<div class="col-md-4">
							<h3 class="design-style">Today</h3>
						</div>
						<div class="col-md-4">
							<ul class="pager">
								<li class="next"><a href="#">Tommorrow</a></li>
							</ul>
						</div>	 
					  </div> 
					<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Employee</th>
										<th>Name</th>
										<th>Department</th>
										<th>Attendance Count</th>
										<th>Attendance %</th>
										<th> 1 S</th>
										


								</tr>
								</thead>
								<tbody>
									<tr>
										<td>40015001</td>
										<td>Gurjant Singh</td>
										<td>Management</td>
										<td>20/27</td>
										<td>75</td>
										<td>P</td>
										

									</tr>
									<tr>
										
									
									</tr>
									<tr>
										<td>40015002</td>
										<td>Amritdeep</td>
										<td>Management</td>
										<td>26/27</td>
										<td>97</td>
										<td class="present-bg-color">p</td>
										

									
									</tr>
									<tr>
										<td>40015003</td>
										<td>Sakkatar</td>
										<td>Management</td>
										<td>25/27</td>
										<td>93</td>
										<td>P</td>
										
										
										
									</tr>
									<tr>
										<td>40015004</td>
										<td>Franklin</td>
										<td>Morrison</td>
										<td>@Frank</td>
										<td>93</td>
										<td class="present-bg-color">A</td>
										

									</tr>
								</tbody>
							</table>
						</div>
					
				</div>
				
					
			
						 
			
				
				



</body>
</html>