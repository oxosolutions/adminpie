@extends('layouts.main')
@section('content')
<style type="text/css">

	
</style>
<script type="text/javascript">
	
</script>

<?php 

// $fruits = array("d" => 1, "a" => "orange", "b" => "banana", "c" => "apple");
// dump(sort($fruits));
// foreach ($fruits as $key => $val) {
//     echo "$key = $val\n";
// }
//dump($attendance_count);
//dump(asort([11,121,12,45]));
		$holidays =[];
		if(!empty($holiday_data))
		{
			foreach ($holiday_data as $key => $value) {
			$holidays[$value->day] = $value->title;
			}
		}
		$postDate = 01;
		 if(!empty(Session::get('date')))
		 {
		 	$postDate = Session::get('date');
		 }
		 $dat  = Carbon\Carbon::create($year, $month, $postDate, 0);
		 $mo =	$dat->month;
		 $pre_date = $dat->subDay()->day;
		 $nxt_date = $dat->addDays(2)->day;
		 $total_days = $daysInMonth  =$dat->daysInMonth;
		 $previous = $dat->subMonth();
		 $previousMonth = $previous->month;
		 $previousYear  =  $previous->year;
		 $next = $dat->addMonth(2);
		 $nextMonth = $next->month;
		 $nextYear = $next->year;
	
		$week =4;
		if($total_days >28)
		{
			$week =5;
		} 
		for($j=1; $j<=$week; $j++ )
		{
			$week_option[$j] = "$j Week"; 
		}
		$sunday_count =0;

	?>

	<div class="card" style="margin-top: 0px;padding:10px">
		<div id="add_new_wrapper" class="add-new-wrapper light-blue darken-2 create-fields" >
		{!! Form::open(['route'=>'upload.attendance', "files"=>true , 'class'=> 'form-horizontal','method' => 'post'])!!}

				<div class="row no-margin-bottom ">
					<div class="col s12 m2 l3  input-field">
						{!!Form::text('title',null,['class' => 'validate','placeholder'=>'Enter Title','id'=>'attendence-title','style'=>'color:#fff'])!!}
						<label for="attendence-title">Enter title</label>

					</div>
					<div class="col s12 m2 l5 aione-field-wrapper file-field input-field">
						<div class="btn" style="margin-top: 0px">
					        <span>Choose File</span>
					        <input type="file">
					    </div>
					    <div class="file-path-wrapper">
							{!!Form::text('attendance_file',null,['class' => 'file-path validate'])!!}
						</div>

						{{-- <input name="date" class="no-margin-bottom aione-field datepicker" type="date" placeholder="Holiday Date" /> --}}
						{{-- <div class="file-field input-field" style="margin: 0">
							<div class="btn" style="margin: 0">
							<span>File</span>
							{!!Form::file('attendance_file',null,['class' => 'form-control'])!!} 						</div>
							<div class="file-path-wrapper">
							<input disabled class="file-path validate " type="text" placeholder="Upload one or more files" style="background-color: #fff">
						</div>
				    </div> --}}
					</div>
					{{-- <div class="col s12 m2 l3 aione-field-wrapper">
						<textarea name="name" class="no-margin-bottom aione-field" placeholder="Holiday Description" /></textarea>
					</div>
	 --}}
					<div class="col s12 m3 l4 aione-field-wrapper right-align">
						
							<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit" name="action" style="margin-top: 10px;">Upload Attendance
							<i class="material-icons right">save</i>
							</button>
						
						
					</div>
				</div>
			{!!Form::close()!!}
		</div>
		<div id="projects" class="projects list-view">
			<div class="row ">
				<div class="col s12 m12 l6 " >
					<ul class="" style="margin: 0px;margin-top: 4px">
						<li style="display: inline-block;"><a style="margin-top: 0px"  class="btn monthly">Monthly</a></li>
						
						<li style="display: inline-block;"><a style="margin-top: 0px"  class="btn weekly">Weekly</a></li>

						<li style="display: inline-block;"><a style="margin-top: 0px" class="btn daily" >Daily</a></li>
					</ul>
				</div>

				<div class="col s12 m12 l6 right-align">
					{{-- <div class="" style="width: 400px">
						<a id="add_new" class="add-new" href="#" >
							<div class="card shadow hoverable light-blue darken-2 no-margin-top">	
								<div class="card-content center-align p-10">
							      <span class="card-title activator white-text text-darken-2 no-margin-bottom"><i class="material-icons">add_circle_outline</i> Import Attendence</span>
							    </div>
							</div>
						</a>
					</div> --}}
					<a id="add_new" href="#" class="btn add-new" style="width: 50%;margin-top: 4px;background-color: #0288D1">
						Import Attendence
					</a>
				</div>
			</div>
		</div>
		<div class="row">

			<h5 class="text-center">Attendance {{$month}}-{{$year}}</h5>
		</div>

		{{-- <div class="panel panel-flat">
			<div class="row form_group">
				{!! Form::open(['route' => 'filter']); !!}

				<div class="col l3 form-group">
					
						<label for="sel1">Date</label>
						{!! Form::selectRange('date', 1, $daysInMonth, @$fdate, ['class'=>'' , 'placeholder' => 'Select Date']); !!} 
			
				</div>
				<div class="col l3 form-group">
				  <label for="sel1">Select Wee0k</label>
				  {!! Form::select('week',$week_option , @$fweek_no, ['class'=>'' , 'id'=>'sel1' , 'placeholder' => 'Select Week']); !!}

			
				</div>
				<div class="col l3 form-group">
				  <label for="sel1">Select Month</label>
				  {!! Form::selectMonth('month',$month,['class'=>'']); !!}

				  
				</div>
				<div class="col l3 form-group">
					<label for="sel1">Year</label>
					{!! Form::selectRange('years', 2016, 2017, $year, ['class'=>'']); !!} 
				</div>
				<div class="col l12 right-align">
					<div class="input-group-btn">
					    <button type="submit" class="btn btn-primary">Search <i class="glyphicon glyphicon-search"></i></button>
					</div>	
				</div>
			{!! Form::close(); !!}
			</div>
		</div>  --}}
		<div class="main-container">
		<div id="month">
			<div class="row design-bg valign-wrapper">
				<div class="col l4 center-align">
					<ul class="pager">
					<?php  
					 $dt = '1-'.$month.'-'.$year;
					// 		$ym = date('Y-m', strtotime($dt));
					 ?>
								{!! Form::open(['route' => 'filter']); !!}

								{!! Form::hidden('years',$previousYear,['class'=>'form-control']); !!}
								{!! Form::hidden('month',$previousMonth ,['class'=>'form-control']); !!}

									<button type="submit" class="btn btn-floating" style="margin: 14px;margin-top: -4px;"><i class="fa fa-arrow-left"></i> </button>
									<div>Previous Month</div>
									{!! Form::close(); !!}

					</ul>
				</div>
				<div class="col l4">
					
					<h3 class="design-style">{{date('F, Y', strtotime($dt))}}</h3>
				</div>
				<div class="col l4 center-align ">
					
					{!! Form::open(['route' => 'filter']); !!}
								{!! Form::hidden('month',$nextMonth,['class'=>'form-control']); !!}
								{!! Form::hidden('years',$nextYear,['class'=>'form-control']); !!}


						<button type="submit" class="btn btn-floating" style="margin: 14px;margin-top: -4px;"><i class="fa fa-arrow-right"></i></button>
						<div>Next Month</div>
					{!! Form::close(); !!}
					
				</div>	 
		  	</div>
		</div> 

		<div id="week">
			<div class="row design-bg valign-wrapper">
				<div class="col l4 center-align">
					<ul class="pager">
					@php  
					 $dt = '1-'.$month.'-'.$year;
					// 		$ym = date('Y-m', strtotime($dt));
					 @endphp
								{!! Form::open(['route' => 'filter']); !!}

								{!! Form::hidden('years',$previousYear,['class'=>'form-control']); !!}
								{!! Form::hidden('month',$mo ,['class'=>'form-control']); !!}
								@for($w=1; $w <=$week; $w++)
									<input type="submit" name="week" value="{{$w}}" >
								@endfor
									<button type="submit" class="btn btn-floating" style="margin: 14px;margin-top: -4px;"><i class="fa fa-arrow-left"></i> </button>
									<div>Previous Week</div>
									{!! Form::close(); !!}

					</ul>
				</div>
				<div class="col l4">
					
					<h3 class="design-style">{{date('W ,F, Y', strtotime($dt))}}</h3>
				</div>
				<div class="col l4 center-align ">
					{{$week}}
					{!! Form::open(['route' => 'filter']); !!}
								{!! Form::hidden('month',$mo,['class'=>'form-control']); !!}
								{!! Form::hidden('years',$nextYear,['class'=>'form-control']); !!}


						<button type="submit" class="btn btn-floating" style="margin: 14px;margin-top: -4px;"><i class="fa fa-arrow-right"></i></button>
						<div>Next Week</div>
					{!! Form::close(); !!}
					
				</div>	 
		  	</div>
		</div> 


		<div id="days">
			<div class="row design-bg valign-wrapper">
				<div class="col l4 center-align">
					<ul class="pager">
					<?php  
					 $dt = '1-'.$month.'-'.$year;
					// 		$ym = date('Y-m', strtotime($dt));
					 ?>
								{!! Form::open(['route' => 'filter']); !!}

								{!! Form::hidden('years',$previousYear,['class'=>'form-control']); !!}
								{!! Form::hidden('month',$mo ,['class'=>'form-control']); !!}
								@for($i=1; $i<=$total_days; $i++)
									<input type="submit" name="date" value="{{$i}}" >
								@endfor

									<button type="submit" name="date" value="{{$pre_date}}" class="btn btn-floating" style="margin: 14px;margin-top: -4px;"><i class="fa fa-arrow-left"></i> </button>
									<div>Previous Day</div>
									{!! Form::close(); !!}

					</ul>
				</div>
				<div class="col l4">
					
					<h3 class="design-style">{{date('F, Y', strtotime($dt))}}</h3>
				</div>
				<div class="col l4 center-align ">
					
					{!! Form::open(['route' => 'filter']); !!}
								{!! Form::hidden('month',$mo,['class'=>'form-control']); !!}
								{!! Form::hidden('years',$nextYear,['class'=>'form-control']); !!}


						<button type="submit" name="date" value="{{$nxt_date}}" class="btn btn-floating" style="margin: 14px;margin-top: -4px;"><i class="fa fa-arrow-right"></i></button>
						<div>Next Day</div>
					{!! Form::close(); !!}
					
				</div>	 
		  	</div>
		</div> 
			<div class="table-responsive" style="overflow: scroll">
			@if(!empty($error))
			
			<h4> {{$error}}</h4>
			@else
				<table class="bordered">
					<thead>
						<tr class="table-tr">
							<th>Employee</th>
							<th>Name</th>
							{{-- <th>Department</th> --}}
							{{-- <th>Attendance Count</th> --}}
							{{-- <th>Attendance %</th>
							<th>Total Hours</th>
							<th>Over Time Hours</th> --}}					

							@if(isset($attendance_data[0]))
								@foreach($attendance_data[0] as $dateKey =>$dateVal)
									@if($dateVal['day']=='Sunday')
										<?php $sunday_count++; ?>
									@endif
									<th>{{$dateVal['date']}}<br>{{substr($dateVal['day'], 0,1)}}</th>

									
								@endforeach
							@endif
						</tr>
					</thead>
					<tbody>
					@if(!empty($attendance_data))
						@foreach($attendance_data as $groupkey => $groupVal) 
								<?php 
								//dump($groupVal[0]['day']);
									$day_count = $chunk - $sunday_count;
									$employ_info = EmployeeHelper::employ_info($groupVal[0]['employee_id']); 
									if(empty($attendance_count[$groupVal[0]['employee_id']]))
									{
										$attendance_count[$groupVal[0]['employee_id']] = 0;
									}
									if($day_count==0)
									{
												$day_count =1;
									}
									

									$percent = ceil(($attendance_count[$groupVal[0]['employee_id']] / $day_count * 100));
									//$over_time_sum = $sum = 0;
								?>
							<tr class="table-tr" > 
									
								<td class="emp_id">
									<div class="popup hidden">
										<div class="name">
											<span>Department</span>
											<span>{{$employ_info['department']}}</span>
										</div>
										<div class="Departments">
											<span>Count</span>

											<span>{{@$attendance_count[$groupVal[0]['employee_id']]}} /{{$day_count}} </span>
										</div>
									</div>
									{{$groupVal[0]['employee_id']}} 
								</td>
								<td class="emp_name">
									{{$employ_info['name']}}
								</td>
								{{-- <td > {{$percent}} </td>
								<td> {{$total_hour[$groupVal[0]['employee_id']]}}</td>
								<td> {{$total_over_time[$groupVal[0]['employee_id']]}}</td> --}}
									@foreach($groupVal as $employeeKey =>$employeeVal)
										
										@if(array_key_exists($employeeVal['date'], $holidays))
												<td class="absent-bg-color">{{$holidays[$employeeVal['date']]}}</td>
											@else
												@if($employeeVal['attendance_status']=='present')
														<td class="present-bg-color">P</td>
												@elseif($employeeVal['attendance_status']=='absent')
													<td class="absent-bg-color">A</td>
												@elseif($employeeVal['attendance_status']=='Sunday')
													<td class="absent-bg-color">Sun</td>
													
												@endif
										@endif
									@endforeach
							</tr>
						@endforeach
					@endif
					</tbody>
				</table>
			@endif
			</div>
		</div>
	</div>
	
@endsection()