@extends('layouts.main')
@section('content')
	<style type="text/css">
		.widget-v1{
			width: 600px;border:1px solid #e8e8e8;border-radius: 3px;
		}
		.widget-v1 > .todo-section{
			background-color: #2B2B37;
			color: #BDBDC7;
			padding: 15px
		}
		.widget-v1 > .todo-section > .current-day{
			font-size: 72px;
			line-height: 74px;
			font-weight: 400;
			color: white;

		}
		.widget-v1 > .todo-section > .current-day > span{
			font-size: 20px;
		}
		.widget-v1 > .calender-section{
			padding: 15px;
		}
		.widget-v1 > .calender-section > .current-year{
			font-size: 26px;
			font-weight: 300
			}		
		.widget-v1 > .calender-section > .current-year > i{
			font-size: 18px;
			color: #a8a8a8
		}
		.widget-v1 > .calender-section .month{
			font-size: 
		}
		.widget-v1 > .calender-section .week > div{
			display: inline-block;
			width: 13%;
			text-align: center;
			padding: 8px;
		}
		.widget-v1 > .calender-section .day > div{
			display: inline-block;
			width: 13%;
			text-align: center;
			padding: 8px;
		}
		.widget-v1 > .calender-section .info > .item{
			display: inline-block;
			padding: 5px 10px;
		}
		.widget-v1 > .calender-section .info > .item > .tiny-box{
		    width: 20px;
		    display: inherit;
		    height: 20px;
		}
		.widget-v1 > .calender-section .info > .item > .status{
			float: right;
    		padding: 0px 10px;
		}
		.mb-0{
			margin-bottom: 0px
		}
		/****************************************************/
		
		.widget-v2 > .calender-section{
			padding: 15px;
			border:1px solid #e8e8e8;border-radius: 3px;
		}
		.widget-v2 > .calender-section > .current-year{
			font-size: 26px;
			font-weight: 300
			}		
		.widget-v2 > .calender-section > .current-year > i{
			font-size: 18px;
			color: #a8a8a8
		}
		.widget-v2 > .calender-section .month{
			font-size: 
		}
		.widget-v2 > .calender-section .week > div{
			display: inline-block;
			width: 12.8%;
			text-align: center;
			padding: 8px;
			font-weight: 700;
		}
		.widget-v2 > .calender-section .day > div{
			display: inline-block;
			width: 12.8%;
			text-align: center;
			padding: 8px;
		}
		.widget-v2 > .calender-section .info > .item{
			display: inline-block;
			padding: 5px 10px;
		}
		.widget-v2 > .calender-section .info > .item > .tiny-box{
		    width: 20px;
		    display: inherit;
		    height: 20px;
		}
		.widget-v2 > .calender-section .info > .item > .status{
			float: right;
    		padding: 0px 10px;
		}
	</style>
	<div class="row widget-v1" style="margin-top: 100px">
		<div class="col l5 todo-section">
			<div class="row">
				<div class="col l6"><i class="material-icons dp48 waves-effect">chevron_left</i></div>
				<div class="col l6 right-align"><i class="material-icons dp48 waves-effect">chevron_right</i></div>
			</div>
			<div class="row center-align current-day">
				15<br><span>MONDAY</span>
			</div>
			<div class="row">
				<div class="col l12">
					<input type="checkbox" id="test5" />
      				<label for="test5">First to do</label>
				</div>
				<div class="col l12">
					<input type="checkbox" id="test6" />
      				<label for="test6">Second to do</label>
				</div>
				<div class="col l12">
					<input type="checkbox" id="test7" />
      				<label for="test7">Third to do</label>
				</div>
				
				<div class="col l12 right-align">
					<a href="">All todos</a>
				</div>
			</div>
		</div>
		<div class="col l7 calender-section">
			<div class="row right-align current-year">
				<i class="fa fa-calendar-o"></i>
				2017
			</div>
			<div class="row mb-0">
				<div class="center-align month">
					<i class="material-icons dp48 waves-effect" style="float: left">chevron_left</i>
					AUGUST
					<i class="material-icons dp48 waves-effect" style="float: right">chevron_right</i>
					<div style="clear: both">
						
					</div>
				</div>
				<div class="week">
					<div>MO</div>
					<div>TU</div>
					<div>WE</div>
					<div>TH</div>
					<div>FR</div>
					<div>SA</div>
					<div>SU</div>
				</div>
				<div class="day">
					@for( $i = 1 ; $i < 31 ; $i++)
					  <div>{{$i}}</div>
					@endfor
				</div>
				<div class="row info mb-0">
					<div class="item">
						<span class="tiny-box red"></span>
						<span class="status">Absent</span>
					</div>
					<div class="item">
						<span class="tiny-box green"></span>
						<span class="status">Present</span>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<div class="row widget-v2">
		<div class="col l3 calender-section">
			<div class="row mb-0">
				<div class="center-align month">
					<i class="material-icons dp48 waves-effect" style="float: left">chevron_left</i>
					AUGUST
					<i class="material-icons dp48 waves-effect" style="float: right">chevron_right</i>
					<div style="clear: both">
						
					</div>
				</div>
				<div class="week">
					<div>MO</div>
					<div>TU</div>
					<div>WE</div>
					<div>TH</div>
					<div>FR</div>
					<div>SA</div>
					<div>SU</div>
				</div>
				<div class="day">
					@for( $i = 1 ; $i < 31 ; $i++)
					  <div>{{$i}}</div>
					@endfor
				</div>
			</div>
		</div>
	</div>
@endsection
