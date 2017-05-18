<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 

// $data = array( 
//         array('id' => 1, 'name' => 'Bob', 'position' => 'Clerk'), 
//         array('id' => 2, 'name' => 'Alan', 'position' => 'Manager'), 
//         array('id' => 3, 'name' => 'James', 'position' => 'Director') 
// ); 

// $names = array_map( 
//         function($person) { return array( 'id'=> $person['id'] , 'name'=>$person['name']); }, 
//         $data 
// ); 

// dump($names); 

 // protected function getSettings(Array $settingsArray, $keyValue){
 //        $keyArray = array_map(function($array) use ($keyValue){
 //            if($array['key'] == $keyValue){
 //                return $array;
 //            }
 //        }, $settingsArray);

 //        return $keyArray[array_search($keyValue, array_column($settingsArray, 'key'))]['value'];
 //    }

// die;

// $leave_data_array  = json_decode($leave_data,true);
// dump($leave_data_array);
// die;

// dump( array_column($leave_data_array, 'employee_id'));
// foreach ($leave_data_array as $key => $value) {
	
// dump($value);

// 	}

//$data = EmployeeHelper::employ_leave_check(40095065 , 2017-20-03);

$holidays =[];
foreach ($holiday_data as $key => $value) {
	$holidays[$value->day] = $value->title;
}
//array_column($employee_data, '40015001')
//dump(array_search(40015002, array_column($employee_data, 'employee_id')));

	foreach ($attendance_count as $key => $value) {
		
		    $att_count[$value['employee_id']] = $value['attendance_count'];
			}
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


<h1>Attendance {{$month}} - {{$year}}</h1>

{!! Form::open(['url' => 'filter']); !!}

{!! Form::select('week',$week_option , null, ['placeholder' => 'Select Week']); !!}
{!! Form::selectMonth('month',$month); !!}
{!! Form::selectRange('years', 2016, 2017,$year); !!}

{!! Form::submit('Search!') !!}
{!! Form::close(); !!}

<table>
<th>
	<tr>
			<td>Employee </td>
			<td>Name</td>
			<td>Department</td>
			<td> Attendance count </td>
			<td> Attendance % </td>
			@foreach($attendance_data[0] as $dateKey =>$dateVal)
				@if($dateVal['day']=='Sunday')
					<?php $sunday_count++; ?>
				@endif
				<td> {{$dateVal['date']}}<br> {{substr($dateVal['day'], 0,3)}}</td>
			@endforeach
			
	</tr>
</th>
</th>
	<tbody>
	@foreach($attendance_data as $groupkey => $groupVal) 
	<tr> 
		<td>{{$groupVal[0]['employee_id']}} </td>
		<td><?php 
					$day_count = $chunk - $sunday_count;
					$employ_info = EmployeeHelper::employ_info($groupVal[0]['employee_id']); 
						if(empty($att_count[$groupVal[0]['employee_id']]))
						{
							$att_count[$groupVal[0]['employee_id']] =0;
						}
						$percent = ceil(($att_count[$groupVal[0]['employee_id']] / $day_count * 100));

					?>
						{{$employ_info['name']}}
					</td>
		<td> {{$employ_info['department']}}</td>
		<td>{{@$att_count[$groupVal[0]['employee_id']]}} /{{$day_count}} </td>
		<td> {{$percent}}</td>
		@foreach($groupVal as $employeeKey =>$employeeVal)
				@if(array_key_exists($employeeVal['date'], $holidays))
						<td> {{$holidays['13']}}</td>
					@else
					<td> {{$employeeVal['attendance_status']}}</td>
				@endif
			
		@endforeach
	</tr>
	@endforeach
	</tbody>
	

</table>

</body>
</html>