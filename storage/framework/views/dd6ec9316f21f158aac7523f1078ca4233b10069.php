<?php $__env->startSection('content'); ?>
<?php 
	$page_title_data = array(
		'show_page_title' => 'yes',
		'show_add_new_button' => 'no',
		'show_navigation' => 'yes',
		'page_title' => 'Attendance',
		'add_new' => 'List attendance',
		'route' => 'lists.attendance'
	);

 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('organization.attendance._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div id="hrm_attendance" class="hrm-attendance">
		<input type="hidden" id="token" name="_token" value="<?php echo e(csrf_token()); ?>" >
		<input type="hidden" id="years" value="<?php echo e($data['year']); ?>" >
		<input type="hidden" id="months" value="<?php echo e($data['month']); ?>" >
		
		
		
		<div id="main" class="hrm-attendance-wrapper"></div>
	</div>


<script type="text/javascript">  

$(document).ready(function(){
    $('body').on('click','.hrm-attendance-view-switch li',function(e){
		e.preventDefault();
		$(this).addClass('active').siblings().removeClass('active');
	});
    
    
    

    $(document).on('click','.show-details',function(e){
		e.preventDefault();
		$('.attendance-details').hide();
		$(this).parents('.attendance-sheet').nextAll('.attendance-details:first').toggle();
	})
    
    
		year = $("#years").val();
		month = $("#months").val();
		if(month  && year){
			attendance_filter(null, null, month, year)
		}
		else{
		attendance_list();
		}
	});
	function showHide(show)
	{
		$("#"+show).show();
	}

	function attendance_list()
	{
		$.ajax({
				url:route()+'/attendance/list/ajax',
				type:'Get',
				success: function(res){
					
					$(".hrm-attendance-wrapper").html(res);
					console.log('data sent successfull code 101');
					$(".monthly").addClass("aione-active");
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
		postData['year'] = yr;
		postData['_token'] = $("#token").val();
		$.ajax({
				url:route()+'/attendance/list/ajax',
				type:'POST',
				data:postData,
				success: function(res){

					$(".hrm-attendance-wrapper").html(res);
					$("#month , #week ,#days").hide();

					if(date)
					{
						$("#days").show();
						console.log('day');
						$(".daily").addClass("aione-active");

					}else if(week){
						 $("#week").show();
						console.log('week');
						 $(".weekly").addClass("aione-active");
					}else{
						 $("#month").show();
						console.log('month');
						$(".monthly").addClass("aione-active");
					}
					//$('select').material_select();
				
					console.log('data sent successfull  code 102');
				}
			});
		}
		
		function lock(month, year)
		{
			var datas ={};
			datas['month'] =month;
			datas['year'] =year;
			datas['_token'] = $("#token").val();

			$.ajax({
				url:route()+'/attendance/lock',
				type:'POST',
				data:datas,
				success: function(res){
					console.log(res);
				}
			})
		}

		$(document).on('change', '.switch > label > input',function(e){
			var postedData = {};
			postedData['month']	= $("#current_month").val();
			postedData['year']	= $("#year").val();
			postedData['lock_status'] 			= $(this).prop('checked');
			postedData['_token'] 			= $("#token").val();

			$.ajax({
				url:route()+'/attendance/lock',
				type:'POST',
				data:postedData,
				success: function(res){
					console.log('data sent successfull  code 103');
				}
			});
			$('.editable h5 ,.editable p').removeClass('edit-fields');
		});

	function unlock(month, year)
		{
			var datas ={};
			datas['month'] =month;
			datas['year'] =year;
			datas['_token'] = $("#token").val();

			$.ajax({
				url:route()+'/attendance/lock',
				type:'POST',
				data:datas,
				success: function(res){
					console.log(res);
				}
			})
		}
</script>


<style type="text/css">
.attendance-status-present{ 
    background-color: #9dcb64;
}
.attendance-status-absent{ 
    background-color: #e85d52;
}
.attendance-status-leave{ 
    background-color: #29c8f8;
}
.attendance-status-leave{ 
    background-color: #f88662;
}
.attendance-status-tardy:after{ 
    background-color: #e85d52;
}
/* 
#a5887f
#8fa6b0
 */
/*****************************
HRM Attendance View Switch
/*****************************/
.hrm-attendance-view-switch{
	display: inline-block;
}
.hrm-attendance-view-switch:after{
	content:"";
	display: table;
	clear: both;
}
.hrm-attendance-view-switch li{
	padding: 0;
	margin: 0;
	float: left;
}
.hrm-attendance-view-switch li a{
    padding: 0 20px;
    margin: 0;
    display: block;
    text-align: center;
    background-color: #f2f2f2;
    color: #666666;
    border: 1px solid #e8e8e8;
    border-left: none;
    font-size: 16px;
    line-height: 36px;
    transition: all 200ms ease-in-out;
}
.hrm-attendance-view-switch li a:hover{
	background-color: #666666;
	border-color: #666666;
	color:#ffffff;
}
.hrm-attendance-view-switch li.active a{
	background-color: #168dc5;
	border-color: #168dc5;
	color:#ffffff;
}
.hrm-attendance-view-switch li.active:hover a{
	background-color: #1570a6;
	border-color: #1570a6;
}
.hrm-attendance-view-switch li:first-child a{
	border-left: 1px solid #e8e8e8;
}
.hrm-attendance-view-switch li.active:first-child a{
	border-left: 1px solid #168dc5;
}
.hrm-attendance-view-switch li.active:first-child:hover a{
	border-left: 1px solid #1570a6;
} 
 
 
 
 #hrm_attendance .active
{
	background-color: #005A8B;
	-webkit-background-color: #005A8B;
}
#hrm_attendance li
{
	border-radius:0px;
	
	display: inline-block;
	

}


#hrm_attendance .fa-calendar
{
	font-size: 25px;

}

#hrm_attendance .design-style
{
	font-size: 18px;
	line-height:50px;
}
#hrm_attendance .fa
{
	font-size:18px;
}
#hrm_attendance .btn
{
	border-radius: 0px;
	box-shadow: none;
}
#hrm_attendance .nav{
	color: #757575;
}
#hrm_attendance .nav:hover
{
	color:#505050;

}
/*Div table*/

#hrm_attendance .row
{
	width:100%;
	
}
#hrm_attendance .content
{
	width:12%;
	float:left;
	background-color: white;
} 
#hrm_attendance .column
{
	width: 2.20%;
    float: left;
    border-top:0.1px solid #e8e8e8;
    border-left:0.1px solid #e8e8e8;
    text-align: center;
    
}

#hrm_attendance .sunday
{
	background-color:#f2f2f2;
	color: #686868;
}
#hrm_attendance .absent-bg-color
{
	background-color:#F08B8A;
}

 .aione-tooltip:before{
 	content: attr(data-title);
    width: auto ;
    white-space: pre ;
}
.attendance-tardy:after{
	content: '';
	position: absolute;
	height: 4px;
	width: 4px;
	border-radius:50%;
	background-color: red;
	bottom: 4px;
	right: 4px;
}

/* .aione-active a{
  color: white !important;
  font-weight: 800;
  background-color: #a2a2a2 !important;
} */


.aione-navigation-1 a{
	    display: inline-block;
	    text-align: center;
	    width: 30px;
	    line-height: 30px;
}
.aione-navigation-1 a:hover{
	    background-color: #039BE5;
	    color: white;
}

.nav-past{
	    cursor: pointer;
		display: inline-block;
		position: relative;
}
.nav-past:before{
	    content: "";
	    position: absolute;
	    top: 5px;
	    left: -10px;
	    border-top: 1px solid #d2d2d2;
	    border-right: 1px solid #d2d2d2;
	    width: 10px;
	    height: 10px;
	    -webkit-transform: rotate(225deg);
	    -moz-transform: rotate(225deg);
	    transform: rotate(225deg);
	    -webkit-transition: all 150ms ease-out;
	    -moz-transition: all 150ms ease-out;
	    -o-transition: all 150ms ease-out;
	    transition: all 150ms ease-out;
}

	.select-dropdown{
		margin-bottom: 0px !important;
	    border: 1px solid #a8a8a8 !important;
	    
	}
	.select-wrapper input.select-dropdown{
		height: 30px;
    	line-height: 30px;
    	text-align: center;
		
		
		background-color: white !important;
	}
	
	.select-wrapper span.caret{
		   
		    z-index: 9 !important;
	}
	.dropdown-content{
		background-color: white;
		
	}
	.dropdown-content li>a, .dropdown-content li>span{
		color: #0288D1 !important
	}

	.nav-future{
		    cursor: pointer;
			display: inline-block;
			position: relative;
	}
	.nav-future:after{
		    content: "";
		    position: absolute;
		    top: 5px;
		    right: -10px;
		    border-top: 1px solid #d2d2d2;
		    border-right: 1px solid #d2d2d2;
		    width: 10px;
		    height: 10px;
		    -webkit-transform: rotate(45deg);
		    -moz-transform: rotate(45deg);
		    transform: rotate(45deg);
		    -webkit-transition: all 150ms ease-out;
		    -moz-transition: all 150ms ease-out;
		    -o-transition: all 150ms ease-out;
		    transition: all 150ms ease-out;
	}
	.attendance-details{
		display: none;
		float: left;
		width: 100%
	}
	.present-bg-color{
		background-color: #6aa84f;
	}
	.present-bg-color-holiday{
		background-color: #274e13;
		color: white
	}
	.absent-bg-color{
		background-color: #c53929 !important;
	}
	.leave-bg-color{
		background-color: #f1c232
	}
	.second-half-leave{
		background: #9c9e9f !important; /* Old browsers */
    	background: linear-gradient(to right,  #6aa84f 0%,#6aa84f 50%,#f1c232 50%,#f1c232 100%) !important; 
		color: white !important	
	}
	.first-half-leave{
		background: #9c9e9f !important; /* Old browsers */
    	background: linear-gradient(to right,  #f1c232 0%,#f1c232 50%,#6aa84f 50%,#6aa84f 100%) !important; 
		color: white !important	
	}
</style>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>