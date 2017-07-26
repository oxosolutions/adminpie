
<?php $__env->startSection('content'); ?>
<style>
		.line{
		width: 100%;
		display: flex;

		}
		.mo{
		width: 5%;
		height: 18px;
		display: block;
		float: left;
		margin-right: 2px;
		font-size: 13px;
		}

		.square{
		width: 15px;
		height: 15px;
		display: block;
		float: left;
		margin-left: 2px;
		margin-right: 2px;
		margin-bottom: 4px;
		}

		.present{
		background-color: green;
		color: green;
		font-size: 1px;
		}

		.absent{
		background-color: red;
		color: red;
		font-size: 1px;
		}
		.leave{
		background-color: orange;
		color:orange;
		font-size: 1px;
		}

		.holiday{
		background-color: yellow;
		color:yellow;
		font-size: 1px;
		}
		.sunday{
		background-color: pink;
		color:pink;
		font-size: 1px;
		}
		.empty{
		background-color: grey;
		color:grey;
		font-size: 1px;
		}

		.days{
		font-size: 13px;
		}

</style>

	<script type="text/javascript">
		$(document).ready(function(){
			 $('.month-view').hide();
		    $(".week-view").hide();
		    $("#weekly").click(function(){
		        $('.month-view').hide();
		        $('.week-view').show();
		        $(".year-view").hide();

		    });
		    $("#monthly").click(function(){
		       $('.week-view').hide();
		        $('.year-view').hide();
		        $(".month-view").show();
		    });
		    $("#yearly").click(function(){
		        $('.year-view').show();
		        $('.month-view').hide();
		        $(".week-view").hide();
		    });
		});
	</script>
	<?php 
		$now = Carbon\Carbon::now();
		$year= $now->year;
		$now->subMonth();
		$month = $now->month;
		if(strlen($month)==1)
		{
			$month = '0'.$month;
		}
		

		//$dt = Carbon\Carbon::create($now->year, $now->month, 1);
		//$beforeDay = $dt->dayOfWeek;
	 ?>
	<?php 
        $page_title_data = array(
        'show_page_title' => 'yes',
        'show_add_new_button' => 'no',
        'show_navigation' => 'yes',
        'page_title' => 'My Attendance',
        'add_new' => '+ Add Task'
    ); 
     ?>
    <?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
    <?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="row">
		<?php echo $__env->make('organization.profile._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<input id="token" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" >

		<div class="row">
			<div class="col l12 pr-7">
				<div class="card">
					<div class="row mt-14" >
						<div class="col l6">
							<h5>Attendence (Yearly)</h5>
						</div>
						<div class="col l6 right-align">
							<a href="javascript:;" onclick="attendance_weekly_filter('1', <?php echo e($month); ?>, <?php echo e($year); ?>)" class="btn blue" id="weekly">Weekly</a>
							<a href="javascript:;" onclick="attendance_monthly_filter(<?php echo e($month); ?>, <?php echo e($year); ?>)" class="btn blue" id="monthly">monthly</a>
							<a href="javascript:;" class="btn blue" id="yearly">Yearly</a>
						</div>	
					</div>

						
					
		<div class="row year-view">
			<div class="row m-20" >
				<div class=" col l5 right-align">
					<i class="fa fa-arrow-left lh-44" ></i>
				</div>
				<div class="col l2 center-align">
					<h5><a class='dropdown-button' href='#' data-activates='dropdown1'><?php echo e(@$filter['year']); ?></a></h5>
					 

					  <!-- Dropdown Structure -->
					  <ul id='dropdown1' class='dropdown-content'>

					    <li>
							<button onclick="attendance_yearly_filter('2016')"> 2016</button>
						</li> 
					    <li>
							<button onclick="attendance_yearly_filter('2017')"> 2017</button>
						</li> 
					    <li>
							<button onclick="attendance_yearly_filter('2018')"> 2018</button>
					    </li> 
					    <li>
							<button onclick="attendance_yearly_filter('2019')"> 2019</button>
						</li> 
					    <li><button onclick="attendance_yearly_filter('2020')"> 2020</button></li> 
					  </ul>
				</div>
				<div class="col l5">
					<i class="fa fa-arrow-right lh-44" ></i>
				</div>
			</div>	
		
			<div id="attendance-data" class="row center-align mt-30" >
			<div class="line"><div class='mo'>Day</div>
			<?php for($i=1; $i<=31; $i++): ?>
				<div class='square days'><?php echo e($i); ?></div>
			<?php endfor; ?>

			</div>



			<?php for($i=1; $i<=12; $i++ ): ?>
				<?php if(strlen($i) ==1): ?>
						<?php 
						$i ='0'.$i;
						 ?>
				<?php endif; ?>
				
					<?php 
						$postDate=1;
						$month_wise   = Carbon\Carbon::create($filter['year'], $i, $postDate, 0);
						$dayInMonth = $month_wise->daysInMonth;
					 ?> 
					<div class="line">
						<div class='mo'><?php echo e(substr($month_wise->format(' F'),0,4)); ?></div>

						<?php if(!empty($attendance_data[$i])): ?>
							<?php 
								$val = collect($attendance_data[$i]);
								$data = $val->keyBy('date')->toArray();
							 ?>
							 <?php for($j=1; $j<=$dayInMonth; $j++): ?>
								<?php if(!empty($data[$j]['attendance_status'])): ?>

									<?php if($data[$j]['attendance_status']=='present'): ?>
												<div class='square present'>p</div>
											<?php elseif($data[$j]['attendance_status']=='absent'): ?>
												<div class='square absent'>a</div>
											<?php elseif($data[$j]['attendance_status']=='Sunday'): ?>
												<div class='square sunday'>s</div>
											<?php elseif($data[$j]['attendance_status']=='leave'): ?>
												<div class='square leave'>l</div>
											<?php else: ?>
												<div class='square leave'>0</div>
											<?php endif; ?>
										
											
									<?php else: ?>
											<div class='square empty'><?php echo e($j); ?></div>
									<?php endif; ?>
								<?php endfor; ?>
						<?php else: ?>
							 <?php for($j=1; $j<=$dayInMonth; $j++): ?>
								<div class='square empty'><?php echo e($j); ?></div>
							 <?php endfor; ?>
						<?php endif; ?>
					</div>

						
			<?php endfor; ?>
			</div>
		</div>
					

	


					

					<?php 
					$now = Carbon\Carbon::now();
			       echo  $where['year'] = $now->year;
			         $month = $now->month;
			        if(strlen($month)==1)
						{
							$month = '0'.$month;
						}
			       $dayInMonth = $now->daysInMonth;

			        $dt = Carbon\Carbon::create($now->year, $now->month, 1);
			       $beforeDay = $dt->dayOfWeek;
			       		if(!empty($attendance_data)){
       							$val = collect($attendance_data[$month]);
								$data = $val->keyBy('date')->toArray();
							}
					
					 ?>
					<div id="monthly-attendance" class="row month-view ph-40 pv-20" >
						<div class="row">
							
						</div>
						<div class="row " style="border: 1px solid #CCC">
							<div class="month">      
							  <ul>
							    <li class="prev"><i class="fa fa-arrow-left" ></i></li>
							    <li class="next"><i class="fa fa-arrow-right" ></i></li>
							    <li class="center-align">
							      <?php echo e($now->format('F')); ?>,
							      <span  class="fs-18"><?php echo e($now->year); ?></span>
							    </li>
							  </ul>
							</div>

							<ul class="weekdays">
							  <li>Mo</li>
							  <li>Tu</li>
							  <li>We</li>
							  <li>Th</li>
							  <li>Fr</li>
							  <li>Sa</li>
							  <li>Su</li>
							</ul>

							<ul class="days">  
							<?php for($i=1; $i<$beforeDay; $i++): ?>
							<li class="white-text">.</li>
							<?php endfor; ?>
							
							<?php for($j=1; $j<=$dayInMonth; $j++ ): ?>
							<li style="background-color: rgba(0,128,0,0.2);"><?php echo e($j); ?></li>
							<?php endfor; ?>
							  
							</ul>

						</div>
					</div>
					

					
					<div id="attendance-weekly" class="row week-view">
						<div class="row center-align mt-40" >
							<span><i class="fa fa-arrow-left mr-10 lh-36" ></i></span>
							<span>04-Jun-2017 - 10-Jun-2017</span>
							<span><i class="fa fa-arrow-right ml-10" ></i></span>
							<span><a href="" class="btn-flat mr-14" style="position: absolute;right: 0px;border: 1px solid #e8e8e8;">Check In</a></span>
						</div>
						<div class="row" >
							<div class="row center-align p-10">
								<div class="col l2">
									Mon,05
								</div>
								<div class="col l8 present">
									<div class="aione-line-bg">
										<span class="absence-status">Present</span>	
									</div>
								</div>
								<div class="col l2">
									08:12Hrs
								</div>
							</div>
							<div class="row center-align p-10" >
								<div class="col l2 ">
									Tues,06
								</div>
								<div class="col l8 present">
									<div class="aione-line-bg">
										<span class="absence-status">Present</span>	
									</div>
								</div>
								<div class="col l2">
									08:12Hrs
								</div>
							</div>
							<div class="row center-align p-10" >
								<div class="col l2">
									Wed,07
								</div>
								<div class="col l8 present">
									<div class="aione-line-bg">
										<span class="absence-status">Present</span>	
									</div>
								</div>
								<div class="col l2">
									08:12Hrs
								</div>
							</div>
							<div class="row center-align p-10" >
								<div class="col l2">
									Thru,08
								</div>
								<div class="col l8">
									<div class="aione-line-bg">
										<span class="absence-status">Absent</span>	
									</div>
								</div>
								<div class="col l2">
									08:12Hrs
								</div>
							</div>
							<div class="row center-align p-10">
								<div class="col l2">
									Fri,09
								</div>
								<div class="col l8 present">
									<div class="aione-line-bg">
										<span class="absence-status">Present</span>	
									</div>
								</div>
								<div class="col l2">
									08:12Hrs
								</div>
							</div>
							<div class="row center-align p-10" >
								<div class="col l2">
									Sat,10
								</div>
								<div class="col l8 weekend">
									<div class="aione-line-bg">
										<span class="absence-status">Weekend</span>	
									</div>
								</div>
								<div class="col l2">
									08:12Hrs
								</div>
							</div>
							<div class="row center-align p-10" >
								<div class="col l2">
									Sun,11
								</div>
								<div class="col l8 weekend">
									<div class="aione-line-bg">
										<span class="absence-status">Weekend</span>	
									</div>
								</div>
								<div class="col l2">
									08:12Hrs
								</div>
							</div>
						</div>
					</div>
					
					
					
				</div>
			</div>
			
		</div>
	</div>
	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<style type="text/css">
		td, th{
			padding: 0px !important;
			    border: 2px solid #FFF;
			    font-size: 12px;
			    max-width: 0px;
			    text-align: center;
			        line-height: 25px;
			        border-radius: 8px
		}
		.absence-status{
			border: 1px solid #f0989a;padding: 5px 25px;
			font-size: 13px;
			color: #696969;
			border-radius: 4px;
			position: absolute;
			top: 50%;
		    left: 50%;
		    min-width: 120px;
			margin-top: -16.5px;
    		margin-left: -60px;
		    background-color: white;
		}
		.aione-line-bg{
			background-color: #f0989a;height: 1px;overflow: inherit;position: relative;top: 10px;
		}
		.present .absence-status{
			border-color: green
		}
		.present .aione-line-bg{
			background-color: green;
		} 
		.weekend .absence-status{
			border-color: orange
		}
		.weekend .aione-line-bg{
			background-color: orange;
		} 
		/**********************************STARTS Css for month view in attendence  *********************************************/
		 .month-view ul {list-style-type: none;}
		

		.month-view .month {
		   
		    width: 100%;
		    
    		padding: 20px;
		   
		}

		.month-view .month ul {
		    margin: 0;
		    padding: 0;
		}

		.month-view .month ul li {
		   
		    font-size: 20px;
		    text-transform: uppercase;
		    letter-spacing: 3px;
		}

		.month-view .month .prev {
		    float: left;
		   
		}

		.month-view .month .next {
		    float: right;
		   
		}

		.month-view .weekdays {
		    margin: 0;
		    padding: 10px 0;
		    background-color: #eee
		   
		}

		.month-view .weekdays li {
		    display: inline-block;
		    width: 13.6%;
		    color: #666;
		    text-align: center;
		    line-height: 40px;
		}

		.month-view .days {
		   
		   
		    margin: 3px;
		}

		.month-view .days li {
		    list-style-type: none;
		    display: inline-block;
		    width: 13.6%;
		    text-align: center;
		    margin-bottom: 3px;
		    font-size:12px;
		    color: #777;
		    line-height: 40px
		}

		.month-view .days li .active {
		    padding: 5px;
		    background: #1abc9c;
		    color: white !important;
		    padding: 10px;
		}

		/**********************************ENDS Css for month view in attendence  *********************************************/





.p-10{
	padding:10px 
}
.mt-14{
	margin-top: 14px 
}
.m-20{
	margin: 20px
}
.lh-44{
	line-height: 44px
}
.mt-30{
	margin-top: 30px
}
.ph-40{
	padding-left: 40px;
	padding-right: 40px
}
.pv-20{
	padding-top: 20px;
	padding-bottom: 20px
}
.ml-20{
	margin-left: 10px
}
.mr-14{
	margin-right: 14px
}
.mr-10{
	margin-right: 10px
}
.lh-36{

line-height: 36px
}
.mt-40{
	margin-top: 40px
}
.fs-18{
	font-size:18px
}
	</style>

	<script>
		function attendance_yearly_filter(year)
		{
			postData ={};
			//postData['month'] = month;
			postData['year']  = year;
			//postData['month_week_no'] = week;
			postData['_token'] = $("#token").val();
			console.log(postData);
			$.ajax({
					url:route()+'/attandance',
					type:'POST',
					data:postData,
					success:function(res){
						$('#attendance-data').html(res);

					}
			});
		
		}

function attendance_monthly_filter(month, year)
		{
			postData ={};
			postData['month'] = month;
			postData['year']  = year;
			//postData['month_week_no'] = week;
			postData['_token'] = $("#token").val();
			console.log(postData);
			$.ajax({
					url:route()+'/attandance_monthly',
					type:'POST',
					data:postData,
					success:function(res){
						$('#monthly-attendance').html(res);

					}
			});
		
		}

		function attendance_weekly_filter(week_no, month, year)
		{
			postData ={};
			postData['month'] = month;
			postData['year']  = year;
			postData['month_week_no'] = week_no;
			postData['_token'] = $("#token").val();
			console.log(postData);
			$.ajax({
					url:route()+'/attandance_weekly',
					type:'POST',
					data:postData,
					success:function(res){
						$('#attendance-weekly').html(res);

					}
			});
		
		}



	// 	function attendance_filter(date, week, mo, yr)
	// {
	// 	console.log(date, week, mo, yr);
		
	// 	var postData = {};
	// 	postData['date'] = date;
	// 	postData['week'] = week;
	// 	postData['month'] = mo;
	// 	postData['years'] = yr;
	// 	postData['_token'] = $("#token").val();
	// 	$.ajax({
	// 			url:route()+'/attendance/list',
	// 			type:'POST',
	// 			data:postData,
	// 			success: function(res){

	// 				$("#main").html(res);
	// 				$("#month , #week ,#days").hide();

	// 				if(date)
	// 				{
	// 					$("#days").show();
	// 				}else if(week){
	// 					$("#week").show();
	// 				}else{
	// 					$("#month").show();
	// 				}
	// 				$('select').material_select();
				
	// 				console.log('data sent successfull');
	// 			}
	// 		});
	// 	}

	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>