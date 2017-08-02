
<?php $__env->startSection('content'); ?>

<?php 

	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dashboard',
	'add_new' => '+ Add Widget'
	); 
 ?>

<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div>
		<div class="row">
			
			
			<?php $__currentLoopData = $widgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widgetKey => $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if(View::exists('organization.widgets.'.$widget->widgets->slug)): ?>
					<?php echo $__env->make('organization.widgets.'.$widget->widgets->slug, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php endif; ?>
				
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div> 
	<div class="row">	
		<div class="col l6 pr-7">
			<div class="card center-align chk-n-out" >
				<input id="token" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" >
				<input type="hidden" class="status" value="<?php echo e($check_in_out_status); ?>" >
				<button href="javascript:;" status="check_in" class="checkInOut blue aione-btn" id="check_in" style="">
					<span>
						<span >
							<i class="fa fa-clock-o" style="font-size: 22px;"></i>
						</span>
						<span>
								<span style="font-size: 18px;margin-left: 5px">Check-In</span>
						</span>
					</span>
				</button>
				
				<button  status="check_out" class="checkInOut grey darken-2" id="check_out" style="display: inline-block;color: white;margin: 0 auto;padding: 8px 20px">
					<span>
						<span >
							<i class="fa fa-clock-o" style="font-size: 22px;"></i>
						</span>
						<span>
								<span style="font-size: 18px;margin-left: 5px">Check-Out</span>
						</span>
					</span>
				</button>
			</div>

		</div>
		
		
	</div>
	<div class="row">
		<div class="col l3">
			<div class="card shadow mt-0" style="border:1px solid #e1e1e1">
				<div class="center-align aione-widget-header" ><h5 class="m-0"><a href="#">Working Hours</a></h5></div>
				<div class="count">
					<span ><time id="timer">00:00:00</time> Hrs</span>
				</div>
				<div class="in-out-button">

					<a href="#" id="start">
						<i class="material-icons dp48">access_alarm</i>
						<div>
							<div class="check-in" style="font-size: 26px;color: white">
								Check In
							</div>
							<div class="check-out" style="font-size: 26px;color: white">
								Check Out
							</div>

							<div style="color: white;font-size: 14px;line-height: 7px;">
								
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col l3 pr-14">
			<div id="card_1">
				<div class="front" >
					<div class="card shadow mt-0 fix-height" >
						<div class="row center-align aione-widget-header mb-10" ><h5 class="m-0"><a href="#"><?php echo e(ucfirst('Employees')); ?></a></h5></div>
						<div class="row center-align aione-widget-content mb-10" >19</div>
						<div class="row aione-widget-footer mb-10" >
							<button href="#" class="all blue white-text">All Employees</button>
							<button href="#" class="recent blue white-text flip-btn-1">Recent Employees</button>
						</div>
					</div>
				</div>	
				<div class="back" >
					<div class="card shadow mt-0 fix-height" > 
						<div class="row center-align aione-widget-header m-0" ><h5 class="m-0"><a href="#"><?php echo e(ucfirst('Recent Employees')); ?></a></h5>
							<a href="#" class="btn-unflip-1 btn-unflip"><i class="material-icons dp48">clear</i></a>
						</div>
						<div class="row aione-widget-list m-0" >
							<ul class="recent-five">
								<li class="waves-effect">
									Ashish Kumar
									<a href="#">view</a>
								</li>
								<div class="divider"></div>
								<li class="waves-effect">Sandeep Singh<a href="#">view</a></li>
								<div class="divider"></div>
								<li class="waves-effect">Rahul Sharma<a href="#">view</a></li>
								<div class="divider"></div>
								<li class="waves-effect">Paljinder Singh<a href="#">view</a></li>
								<div class="divider"></div>
								<li class="waves-effect">Nirmal<a href="#">view</a></li>

							</ul>
						</div>
						
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$("#card_1").flip({
					trigger: 'manual'
				});
				$(document).on('click','.flip-btn-1',function(){
					$("#card_1").flip(true);
				});
				$(document).on('click','.btn-unflip-1',function(e){
					e.preventDefault();
					$("#card_1").flip(false);
				});

			</script>
			
		</div>
		<div class="col l3 pr-14">
			<div id="card_2">
				<div class="front" >
					<div class="card shadow mt-0 fix-height" >
						<div class="row center-align aione-widget-header mb-10" ><h5 class="m-0"><a href="#"><?php echo e(ucfirst('Employees')); ?></a></h5></div>
						<div class="row center-align aione-widget-content mb-10" >19</div>
						<div class="row aione-widget-footer mb-10" >
							<button href="#" class="all blue white-text">All Employees</button>
							<button href="#" class="recent blue white-text flip-btn-2">Recent Employees</button>
						</div>
					</div>
				</div>	
				<div class="back" >
					<div class="card shadow mt-0 fix-height" > 
						<div class="row center-align aione-widget-header m-0" ><h5 class="m-0"><a href="#"><?php echo e(ucfirst('Recent Employees')); ?></a></h5>
							<a href="#" class="btn-unflip-2 btn-unflip"><i class="material-icons dp48">clear</i></a>
						</div>
						<div class="row aione-widget-list m-0" >
							<ul class="recent-five">
								<li class="waves-effect">
									Ashish Kumar
									<a href="#">view</a>
								</li>
								<div class="divider"></div>
								<li class="waves-effect">Sandeep Singh<a href="#">view</a></li>
								<div class="divider"></div>
								<li class="waves-effect">Rahul Sharma<a href="#">view</a></li>
								<div class="divider"></div>
								<li class="waves-effect">Paljinder Singh<a href="#">view</a></li>
								<div class="divider"></div>
								<li class="waves-effect">Nirmal<a href="#">view</a></li>

							</ul>
						</div>
						
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$("#card_2").flip({
					trigger: 'manual'
				});
				$(document).on('click','.flip-btn-2',function(){
					$("#card_2").flip(true);
				});
				$(document).on('click','.btn-unflip-2',function(e){
					e.preventDefault();
					$("#card_2").flip(false);
				});

			</script>
			
		</div>
		<div class="col l3 pr-14">
			<div id="card_3">
				<div class="front" >
					<div class="card shadow mt-0 fix-height" >
						<div class="row center-align aione-widget-header mb-10" ><h5 class="m-0"><a href="#"><?php echo e(ucfirst('Employees')); ?></a></h5></div>
						<div class="row center-align aione-widget-content mb-10" >19</div>
						<div class="row aione-widget-footer mb-10" >
							<button href="#" class="all blue white-text">All Employees</button>
							<button href="#" class="recent blue white-text flip-btn-3">Recent Employees</button>
						</div>
					</div>
				</div>	
				<div class="back" >
					<div class="card shadow mt-0 fix-height" > 
						<div class="row center-align aione-widget-header m-0" ><h5 class="m-0"><a href="#"><?php echo e(ucfirst('Recent Employees')); ?></a></h5>
							<a href="#" class="btn-unflip-3 btn-unflip"><i class="material-icons dp48">clear</i></a>
						</div>
						<div class="row aione-widget-list m-0" >
							<ul class="recent-five">
								<li class="waves-effect">
									Ashish Kumar
									<a href="#">view</a>
								</li>
								<div class="divider"></div>
								<li class="waves-effect">Sandeep Singh<a href="#">view</a></li>
								<div class="divider"></div>
								<li class="waves-effect">Rahul Sharma<a href="#">view</a></li>
								<div class="divider"></div>
								<li class="waves-effect">Paljinder Singh<a href="#">view</a></li>
								<div class="divider"></div>
								<li class="waves-effect">Nirmal<a href="#">view</a></li>

							</ul>
						</div>
						
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$("#card_3").flip({
					trigger: 'manual'
				});
				$(document).on('click','.flip-btn-3',function(){
					$("#card_3").flip(true);
				});
				$(document).on('click','.btn-unflip-3',function(e){
					e.preventDefault();
					$("#card_3").flip(false);
				});

			</script>
			
		</div>
		<div class="col l3 pr-14">
			<div id="card_4">
				<div class="front" >
					<div class="card shadow mt-0 fix-height" >
						<div class="row center-align aione-widget-header mb-10" ><h5 class="m-0"><a href="#"><?php echo e(ucfirst('Employees')); ?></a></h5></div>
						<div class="row center-align aione-widget-content mb-10" >19</div>
						<div class="row aione-widget-footer mb-10" >
							<button href="#" class="all blue white-text">All Employees</button>
							<button href="#" class="recent blue white-text flip-btn-4">Recent Employees</button>
						</div>
					</div>
				</div>	
				<div class="back" >
					<div class="card shadow mt-0 fix-height" > 
						<div class="row center-align aione-widget-header m-0" ><h5 class="m-0"><a href="#"><?php echo e(ucfirst('Recent Employees')); ?></a></h5>
							<a href="#" class="btn-unflip-4 btn-unflip"><i class="material-icons dp48">clear</i></a>
						</div>
						<div class="row aione-widget-list m-0" >
							<ul class="recent-five">
								<li class="waves-effect">
									Ashish Kumar
									<a href="#">view</a>
								</li>
								<div class="divider"></div>
								<li class="waves-effect">Sandeep Singh<a href="#">view</a></li>
								<div class="divider"></div>
								<li class="waves-effect">Rahul Sharma<a href="#">view</a></li>
								<div class="divider"></div>
								<li class="waves-effect">Paljinder Singh<a href="#">view</a></li>
								<div class="divider"></div>
								<li class="waves-effect">Nirmal<a href="#">view</a></li>

							</ul>
						</div>
						
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$("#card_4").flip({
					trigger: 'manual'
				});
				$(document).on('click','.flip-btn-4',function(){
					$("#card_4").flip(true);
				});
				$(document).on('click','.btn-unflip-4',function(e){
					e.preventDefault();
					$("#card_4").flip(false);
				});

			</script>
			
		</div>
		<div class="col l3 pr-14">
			<div id="card_5">
				<div class="front" >
					<div class="card shadow mt-0 fix-height" >
						<div class="row center-align aione-widget-header mb-10" ><h5 class="m-0"><a href="#"><?php echo e(ucfirst('Employees')); ?></a></h5></div>
						<div class="row center-align aione-widget-content mb-10" >19</div>
						<div class="row aione-widget-footer mb-10" >
							<button href="#" class="all blue white-text">All Employees</button>
							<button href="#" class="recent blue white-text flip-btn-5">Recent Employees</button>
						</div>
					</div>
				</div>	
				<div class="back" >
					<div class="card shadow mt-0 fix-height" > 
						<div class="row center-align aione-widget-header m-0" ><h5 class="m-0"><a href="#"><?php echo e(ucfirst('Recent Employees')); ?></a></h5>
							<a href="#" class="btn-unflip-5 btn-unflip"><i class="material-icons dp48">clear</i></a>
						</div>
						<div class="row aione-widget-list m-0" >
							<ul class="recent-five">
								<li class="waves-effect">
									Ashish Kumar
									<a href="#">view</a>
								</li>
								<div class="divider"></div>
								<li class="waves-effect">Sandeep Singh<a href="#">view</a></li>
								<div class="divider"></div>
								<li class="waves-effect">Rahul Sharma<a href="#">view</a></li>
								<div class="divider"></div>
								<li class="waves-effect">Paljinder Singh<a href="#">view</a></li>
								<div class="divider"></div>
								<li class="waves-effect">Nirmal<a href="#">view</a></li>

							</ul>
						</div>
						
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$("#card_5").flip({
					trigger: 'manual'
				});
				$(document).on('click','.flip-btn-5',function(){
					$("#card_5").flip(true);
				});
				$(document).on('click','.btn-unflip-5',function(e){
					e.preventDefault();
					$("#card_5").flip(false);
				});

			</script>
			
		</div>
	</div>
	
	
	
<div class="aione-header-item aione-clock"> 
	<div class="" id="clock"></div>
</div> <!-- .aione-header-item -->




<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<style type="text/css">
		.recent-five li{
			padding: 7px 10px;
			width: 100%
		}
		.recent-five li a{
			float: right;
		}
		.mb-10{
			margin-bottom: 10px
		}
		.pr-14{
			padding-right: 14px !important;
		}
		.fix-height{
			min-height: 230px;max-height: 230px
		}
		.back > .card > div{
			margin-bottom: 5px
		}
		.btn-unflip{
			position: absolute;
			top: 0;
			right: 0;
		}
		/*.btn-unflip-2{
			position: absolute;
			top: 0;
			right: 0;
		}
		.btn-unflip-3{
			position: absolute;
			top: 0;
			right: 0;
		}
		.btn-unflip-4{
			position: absolute;
			top: 0;
			right: 0;
		}
		.btn-unflip-5{
			position: absolute;
			top: 0;
			right: 0;
		}*/
		.count span{
			font-size: 32px;
			font-weight: 900;
			color: #8E8E8E;
			padding: 20px 0px;
			display: block;
    		text-align: center;
    		border-bottom: 1px solid #e8e8e8;
		}
		.in-out-button{
			padding: 14px;
			
		}
		.in-out-button a#start{
			display: block;
   			background-color: #00BC9B;
   			padding: 7px 30px;
		}
		.in-out-button a#start .check-out{
			display: none;
		} 
		.in-out-button a#stop .check-in{
			display: none;
		} 
		.in-out-button a#stop{
			display: block;
   			background-color: #d9534f;
   			padding: 7px 30px;
		}
		.in-out-button a i{
			color: white;
			    font-size: 50px;
		}
		.in-out-button a > div{
			display: block;
			float: right;
		}
		.aione-widget-header{
			border-bottom: 1px solid #e8e8e8;cursor: pointer;
		}
		.aione-widget-header a{
			padding: 10px;color: black;display: block
		}
		.aione-widget-content{
			border-bottom: 1px solid #e8e8e8;padding: 10px;font-size: 72px
		}
		.aione-widget-footer{
			padding: 0px 10px
		}
		.aione-widget-footer .all{
			float: left;
			width: 45%;
			font-size: 14px;
			font-weight: 600;
			padding: 10px 5px;
			border: 0px;
			border-radius: 4px;
		}
		.aione-widget-footer .recent{
			float: right;
			width: 54%;
			font-size: 14px;
			font-weight: 600;
			padding: 10px 0px;
			border: 0px;
			border-radius: 4px;
		}
		.mt-0{
			margin-top: 0px;
		}
		.m-0{
			margin: 0px;
		}
		.aione-btn{
			display: inline-block;color: white;margin: 0 auto;padding: 8px 20px;
		}
		
	</style>
	<script type="text/javascript">
		 
	$(document).ready(function() {


		
		status = $(".status").val();
		if(status=='check_in')
		{
			$("#check_out").show();
			$("#check_in").hide();
		}else if(status=='not_employ'){
				$(".chk-n-out").hide();
			$("#check_in").hide();
		}else{
			$("#check_out").hide();
			$("#check_in").show();
		}

		$('#calendar').fullCalendar({
			
		});
		
	});

	$(document).on('click','.checkInOut',function(e){

		status = $(this).attr('status');
		postdata ={}; 
		postdata['_token'] = $("#token").val();
		postdata['status'] = status;
		$.ajax({
			url:route()+'hrm/attendance/check_in_out',
			type:'POST',
			data:postdata,
			success:function(res)
			{	
				$("#check_out , #check_in").show();
				 $("#"+status).hide();
				//$("#"+status).hide();
				// if(status=='check_in'){
					
				//  }else{
				// 	$("#check_in").show();
				//  }

				
			}
		});
	});

	// function checkInOut(e)
	// {	
	// 	e.preventDefault();
	// 	 token = $("#token").val();
	// 	$.ajax({
	// 		url:route()+'attendance/check_in_out',
	// 		type:'POST',
	// 		data:{'checkInOut':'check','token':token},
	// 		success:function(res)
	// 		{
	// 			console('success');
	// 		}
	// 	});
		
		
 //    }
 //**********************stop watch********************************8
var h1 = document.getElementById('timer'),
    start = document.getElementById('start'),
    stop = document.getElementById('stop'),
    clear = document.getElementById('clear'),
    seconds = 0, minutes = 0, hours = 0,
    t;

function add() {
    seconds++;
    if (seconds >= 60) {
        seconds = 0;
        minutes++;
        if (minutes >= 60) {
            minutes = 0;
            hours++;
        }
    }
    
    h1.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);

    timer();
}
function timer() {
    t = setTimeout(add, 1000);
}
// timer();
$(document).on('click','.in-out-button > a' , function(){
	if($(this).attr('id') == 'start'){
		$(this).attr('id','stop');
		timer();
	}else{
		$(this).attr('id','start');
		clearTimeout(t);
	}
});

// /* Start button */
// start.onclick =function(){
// 	timer();
// }

//  Stop button 
// stop.onclick = function() {
//     clearTimeout(t);
// }

/* Clear button */
/*clear.onclick = function() {
    h1.textContent = "00:00:00";
    seconds = 0; minutes = 0; hours = 0;
}*/

 //***********************************************************
	</script>


<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>