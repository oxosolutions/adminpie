<?php $__env->startSection('content'); ?>
<style type="text/css">
.active
{
	background-color: #005A8B;
	-webkit-background-color: #005A8B;
}
li
{
	border-radius:0px;
	margin-left:-4px;
}
li:first-child
{
	margin:0;
}
.fa-calendar
{
	font-size: 25px;

}
.main-container
{
	border-top:1px solid #e8e8e8;
	margin-top:15px;
}
.design-style
{
	font-size: 18px;
	line-height:50px;
}
.fa
{
	font-size:18px;
}
.btn
{
	border-radius: 0px;
	box-shadow: none;
}
a{
	color:black;
}
.nav:hover
{
	color:#2196F3;

}
/*Div table*/

.row
{
	width:100%;
	border: none;
}
.content
{
	width:10%;
	float:left;
	background-color: white;
} 
.column
{
	width: 2.66%;
    float: left;
    border-top:0.1px solid #e8e8e8;
    border-left:0.1px solid #e8e8e8;
    text-align: center;
    
}
.present-bg-color
{
	background-color:#79BEDB;
	
}
.sunday
{
	background-color:#f2f2f2;
	color: #686868;
}
.absent-bg-color
{
	background-color:#F08B8A;
}

</style>
<script type="text/javascript">
	
</script>
	<div id="att_data" class="card" style="margin-top: 0px;padding:10px">
	<input id="token" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" >
		
		<div id="projects" class="projects list-view">
			<div class="row ">
				 			<div class="col l6">
 						
				</div>
				<div class="col s12 m12 l6 right-align">
					
					<a  href="<?php echo e(route('import.form.attendance')); ?>" class="btn" style="width: 50%;margin-top: 4px;background-color: #0288D1">
						Import Attendence
					</a>
				</div>
			</div>
		</div>
	
		<div id="main" class="main-container">
		
		</div>
		
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		attendance_list();

		$(".monthly").click(function(){
			$(this).addClass("active");
			$(".weekly").removeClass("active");
			$(".daily").removeClass("active");
		});
			$(".weekly").click(function(){
			$(this).addClass("active");
			$(".monthly").removeClass("active");
			$(".daily").removeClass("active");
		});
			$(".daily").click(function(){
			$(this).addClass("active");
			$(".monthly").removeClass("active");
			$(".weekly").removeClass("active");
		});

	});
	function showHide(show)
	{
		$("#"+show).show();
	}

	function attendance_list()
	{
		$.ajax({
				url:route()+'/attendance/list',
				type:'Get',
				success: function(res){
					
					$("#main").html(res);
					console.log('data sent successfull');
					$("#week ,#days").hide();
					$('select').material_select();
				}
			});
	}

	function attendance_filter(date, week, mo, yr)
	{
		console.log(date, week, mo, yr);
		
		var postData = {};
		postData['date'] = date;
		postData['week'] = week;
		postData['month'] = mo;
		postData['years'] = yr;
		postData['_token'] = $("#token").val();
		$.ajax({
				url:route()+'/attendance/list',
				type:'POST',
				data:postData,
				success: function(res){

					$("#main").html(res);
					$("#month , #week ,#days").hide();

					if(date)
					{
						$("#days").show();
					}else if(week){
						$("#week").show();
					}else{
						$("#month").show();
					}
					$('select').material_select();
				
					console.log('data sent successfull');
				}
			});
		}


	</script>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>