
<?php $__env->startSection('content'); ?>
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
	<div class="row">
		<?php echo $__env->make('organization.profile._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="row">
			<div class="col l9 pr-7">
				<div class="card">
					<div class="row" style="margin-top: 14px ">
						<div class="col l6">
							<h5>Attendence (Yearly)</h5>
						</div>
						<div class="col l6">
							<a href="javascript:;" class="btn blue" id="weekly">Weekly</a>
							<a href="javascript:;" class="btn blue" id="monthly">Monthly</a>
							<a href="javascript:;" class="btn blue" id="yearly">Yearly</a>
						</div>	
					</div>



					
					<div class="row year-view">
						<div class="row" style="margin: 20px">
							<div class=" col l5 right-align">
								<i class="fa fa-arrow-left" style="line-height: 44px"></i>
							</div>
							<div class="col l2 center-align">
								<h5><a class='dropdown-button' href='#' data-activates='dropdown1'>2017</a></h5>
								 

								  <!-- Dropdown Structure -->
								  <ul id='dropdown1' class='dropdown-content'>

								    <li><a href="#!">2016</a></li> 
								    <li><a href="#!">2017</a></li> 
								    <li><a href="#!">2018</a></li> 
								    <li><a href="#!">2019</a></li> 
								    <li><a href="#!">2020</a></li> 
								  </ul>
							</div>
							<div class="col l5">
								<i class="fa fa-arrow-right" style="line-height: 44px"></i>
							</div>
						</div>	
					
						<div class="row center-align" style="margin-top: 30px">
							<svg width="720" height="260" class="js-calendar-graph-svg">
							  <g transform="translate(16, 20)" style="font-size: 13px">
							      <g transform="translate(0, 0)">
							      	  <rect class="day" width="18" height="18" x="20" y="0" fill="#ebedf0" ></rect>
							          <rect class="day" width="18" height="18" x="40" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="60" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="80" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="100" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="120" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="140" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="160" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="180" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="200" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="220" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="240" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="260" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="280" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="300" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="320" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="340" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="360" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="380" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="400" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="420" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="440" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="460" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="480" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="500" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="520" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="540" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="560" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="580" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="600" y="0" fill="#ebedf0" data-count="0" ></rect>
							        
							         
							      
							      </g>
							      <g transform="translate(0, 20)">
							      	 <rect class="day" width="18" height="18" x="20" y="0" fill="#ebedf0" ></rect>
							          <rect class="day" width="18" height="18" x="40" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="60" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="80" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="100" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="120" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="140" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="160" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="180" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="200" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="220" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="240" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="260" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="280" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="300" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="320" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="340" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="360" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="380" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="400" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="420" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="440" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="460" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="480" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="500" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="520" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="540" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="560" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="580" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="600" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="620" y="0" fill="#ebedf0" data-count="0" ></rect>
							      </g>
							      <g transform="translate(0, 40)">
							      	 <rect class="day" width="18" height="18" x="20" y="0" fill="#ebedf0" ></rect>
							          <rect class="day" width="18" height="18" x="40" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="60" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="80" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="100" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="120" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="140" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="160" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="180" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="200" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="220" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="240" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="260" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="280" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="300" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="320" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="340" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="360" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="380" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="400" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="420" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="440" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="460" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="480" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="500" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="520" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="540" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="560" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="580" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="600" y="0" fill="#ebedf0" data-count="0" ></rect>
							          
							      </g>
							       <g transform="translate(0, 60)">
							      	 <rect class="day" width="18" height="18" x="20" y="0" fill="#ebedf0" ></rect>
							          <rect class="day" width="18" height="18" x="40" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="60" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="80" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="100" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="120" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="140" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="160" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="180" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="200" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="220" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="240" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="260" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="280" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="300" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="320" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="340" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="360" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="380" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="400" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="420" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="440" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="460" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="480" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="500" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="520" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="540" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="560" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="580" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="600" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="620" y="0" fill="#ebedf0" data-count="0" ></rect>
							      </g>
							       <g transform="translate(0, 80)">
							      	 <rect class="day" width="18" height="18" x="20" y="0" fill="#ebedf0" ></rect>
							          <rect class="day" width="18" height="18" x="40" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="60" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="80" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="100" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="120" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="140" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="160" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="180" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="200" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="220" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="240" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="260" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="280" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="300" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="320" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="340" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="360" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="380" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="400" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="420" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="440" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="460" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="480" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="500" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="520" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="540" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="560" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="580" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="600" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="620" y="0" fill="#ebedf0" data-count="0" ></rect>
							      </g>
							       <g transform="translate(0, 100)">
							      	 <rect class="day" width="18" height="18" x="20" y="0" fill="#ebedf0" ></rect>
							          <rect class="day" width="18" height="18" x="40" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="60" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="80" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="100" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="120" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="140" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="160" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="180" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="200" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="220" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="240" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="260" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="280" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="300" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="320" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="340" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="360" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="380" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="400" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="420" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="440" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="460" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="480" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="500" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="520" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="540" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="560" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="580" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="600" y="0" fill="#ebedf0" data-count="0" ></rect>
							          
							      </g>
							       <g transform="translate(0, 120)">
							      	 <rect class="day" width="18" height="18" x="20" y="0" fill="#ebedf0" ></rect>
							          <rect class="day" width="18" height="18" x="40" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="60" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="80" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="100" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="120" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="140" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="160" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="180" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="200" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="220" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="240" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="260" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="280" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="300" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="320" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="340" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="360" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="380" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="400" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="420" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="440" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="460" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="480" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="500" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="520" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="540" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="560" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="580" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="600" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="620" y="0" fill="#ebedf0" data-count="0" ></rect>
							      </g>
							       <g transform="translate(0, 140)">
							      	 <rect class="day" width="18" height="18" x="20" y="0" fill="#ebedf0" ></rect>
							          <rect class="day" width="18" height="18" x="40" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="60" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="80" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="100" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="120" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="140" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="160" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="180" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="200" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="220" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="240" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="260" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="280" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="300" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="320" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="340" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="360" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="380" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="400" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="420" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="440" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="460" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="480" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="500" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="520" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="540" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="560" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="580" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="600" y="0" fill="#ebedf0" data-count="0" ></rect>
							         
							      </g>
							       <g transform="translate(0, 160)">
							      	 <rect class="day" width="18" height="18" x="20" y="0" fill="#ebedf0" ></rect>
							          <rect class="day" width="18" height="18" x="40" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="60" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="80" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="100" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="120" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="140" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="160" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="180" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="200" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="220" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="240" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="260" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="280" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="300" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="320" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="340" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="360" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="380" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="400" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="420" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="440" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="460" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="480" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="500" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="520" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="540" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="560" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="580" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="600" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="620" y="0" fill="#ebedf0" data-count="0" ></rect>
							      </g>
							       <g transform="translate(0, 180)">
							      	 <rect class="day" width="18" height="18" x="20" y="0" fill="#ebedf0" ></rect>
							          <rect class="day" width="18" height="18" x="40" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="60" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="80" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="100" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="120" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="140" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="160" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="180" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="200" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="220" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="240" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="260" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="280" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="300" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="320" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="340" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="360" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="380" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="400" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="420" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="440" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="460" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="480" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="500" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="520" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="540" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="560" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="580" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="600" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="620" y="0" fill="#ebedf0" data-count="0" ></rect>
							      </g>
							       <g transform="translate(0, 200)">
							      	 <rect class="day" width="18" height="18" x="20" y="0" fill="#ebedf0" ></rect>
							          <rect class="day" width="18" height="18" x="40" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="60" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="80" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="100" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="120" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="140" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="160" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="180" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="200" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="220" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="240" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="260" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="280" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="300" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="320" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="340" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="360" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="380" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="400" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="420" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="440" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="460" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="480" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="500" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="520" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="540" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="560" y="0" fill="#ebedf0" data-count="0" ></rect>
							         
							          
							      </g>
							       <g transform="translate(0, 220)">
							      	 <rect class="day" width="18" height="18" x="20" y="0" fill="#ebedf0" ></rect>
							          <rect class="day" width="18" height="18" x="40" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="60" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="80" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="100" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="120" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="140" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="160" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="180" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="200" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="220" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="240" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="260" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="280" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="300" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="320" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="340" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="360" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="380" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="400" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="420" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="440" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="460" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="480" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="500" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="520" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="540" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="560" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="580" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="600" y="0" fill="#ebedf0" data-count="0" ></rect>
							          <rect class="day" width="18" height="18" x="620" y="0" fill="#ebedf0" data-count="0" ></rect>
							      </g>
							      <text x="22" y="-10" class="month" style="padding-left: 1px">1</text>
							      <text x="42" y="-10" class="month">2</text>
							      <text x="62" y="-10" class="month">3</text>
							      <text x="82" y="-10" class="month">4</text>
							      <text x="102" y="-10" class="month">5</text>
							      <text x="122" y="-10" class="month">6</text>
							      <text x="142" y="-10" class="month">7</text>
							      <text x="162" y="-10" class="month">8</text>
							      <text x="182" y="-10" class="month">9</text>
							      <text x="202" y="-10" class="month">10</text>
							      <text x="222" y="-10" class="month">11</text>
							      <text x="242" y="-10" class="month">12</text>
							      <text x="262" y="-10" class="month">13</text>
							      <text x="282" y="-10" class="month">14</text>
							      <text x="302" y="-10" class="month">15</text>
							      <text x="322" y="-10" class="month">16</text>
							      <text x="342" y="-10" class="month">17</text>
							      <text x="362" y="-10" class="month">18</text>
							      <text x="382" y="-10" class="month">19</text>
							      <text x="402" y="-10" class="month">20</text>
							      <text x="422" y="-10" class="month">21</text>
							      <text x="442" y="-10" class="month">22</text>
							      <text x="462" y="-10" class="month">23</text>
							      <text x="482" y="-10" class="month">24</text>
							      <text x="502" y="-10" class="month">25</text>
							      <text x="522" y="-10" class="month">26</text>
							      <text x="542" y="-10" class="month">27</text>
							      <text x="562" y="-10" class="month">28</text>
							      <text x="582" y="-10" class="month">29</text>
							      <text x="602" y="-10" class="month">30</text>
							      <text x="622" y="-10" class="month">31</text>
							     
							    
							      
							    <text text-anchor="start" class="wday" dx="-14" dy="10">Apr</text>
							    <text text-anchor="start" class="wday" dx="-14" dy="30">May</text>
							    <text text-anchor="start" class="wday" dx="-14" dy="50">Jun</text>
							    <text text-anchor="start" class="wday" dx="-14" dy="70">Jul</text>
							    <text text-anchor="start" class="wday" dx="-14" dy="90">Aug</text>
							    <text text-anchor="start" class="wday" dx="-14" dy="110">Sep</text>
							    <text text-anchor="start" class="wday" dx="-14" dy="130">Oct</text>
							    <text text-anchor="start" class="wday" dx="-14" dy="150">Nov</text>
							    <text text-anchor="start" class="wday" dx="-14" dy="170">Dec</text>
							    <text text-anchor="start" class="wday" dx="-14" dy="190">Jan</text>
							    <text text-anchor="start" class="wday" dx="-14" dy="210">Feb</text>
							    <text text-anchor="start" class="wday" dx="-14" dy="230">Mar</text>
							  </g>
							</svg>
						</div>
					</div>
					

					
					<div class="row month-view" style="padding: 20px 40px">
						<div class="row">
							
						</div>
						<div class="row" style="border: 1px solid #CCC">
							<div class="month">      
							  <ul>
							    <li class="prev"><i class="fa fa-arrow-left" ></i></li>
							    <li class="next"><i class="fa fa-arrow-right" ></i></li>
							    <li style="text-align:center">
							      August,
							      <span style="font-size:18px">2017</span>
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
							  <li style="background-color: rgba(0,128,0,0.2);">1</li>
							  <li style="background-color: rgba(255,0,0,0.1);">2</li>
							  <li style="background-color: rgba(0,128,0,0.2);"">3</li>
							  <li style="background-color: rgba(0,128,0,0.2);"">4</li>
							  <li style="background-color: rgba(0,128,0,0.2);"">5</li>
							  <li style="background-color: rgba(0,128,0,0.2);"">6</li>
							  <li style="background-color: rgba(0,128,0,0.2);"">7</li>
							  <li style="background-color: rgba(0,128,0,0.2);"">8</li>
							  <li style="background-color: rgba(0,128,0,0.2);"">9</li>
							  <li style="background-color: rgba(255,0,0,0.1);"">10</li>
							  <li style="background-color: rgba(0,128,0,0.2);"">11</li>
							  <li style="background-color: rgba(0,128,0,0.2);"">12</li>
							  <li style="background-color: rgba(0,128,0,0.2);"">13</li>
							  <li style="background-color: rgba(0,128,0,0.2);"">14</li>
							  <li style="background-color: rgba(0,128,0,0.2);"">15</li>
							  <li style="background-color: rgba(0,128,0,0.2);"">16</li>
							  <li style="background-color: rgba(0,128,0,0.2);"">17</li>
							  <li style="background-color: rgba(0,128,0,0.2);"">18</li>
							  <li style="background-color: rgba(0,128,0,0.2);"">19</li>
							  <li style="background-color: rgba(0,128,0,0.2);"">20</li>
							  <li>21</li>
							  <li>22</li>
							  <li>23</li>
							  <li>24</li>
							  <li>25</li>
							  <li>26</li>
							  <li>27</li>
							  <li>28</li>
							  <li>29</li>
							  <li>30</li>
							  <li>31</li>
							</ul>

						</div>
					</div>
					

					
					<div class="row week-view">
						<div class="row center-align" style="margin-top: 40px">
							<span><i class="fa fa-arrow-left" style="margin-right: 10px;line-height: 36px"></i></span>
							<span>04-Jun-2017 - 10-Jun-2017</span>
							<span><i class="fa fa-arrow-right" style="margin-left: 10px"></i></span>
							<span><a href="" class="btn-flat" style="position: absolute;right: 0px;border: 1px solid #e8e8e8;margin-right: 14px;">Check In</a></span>
						</div>
						<div class="row" >
							<div class="row center-align" style="padding:10px ">
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
							<div class="row center-align" style="padding:10px ">
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
							<div class="row center-align" style="padding:10px ">
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
							<div class="row center-align" style="padding:10px ">
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
							<div class="row center-align" style="padding:10px ">
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
							<div class="row center-align" style="padding:10px ">
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
							<div class="row center-align" style="padding:10px ">
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
			<div class="col l3 pl-7">
				<div class="card" style="margin-top: 14px">
					<div class="row">
						<span style="font-weight: 600;padding: 10px 5px;display: block;border-bottom: 1px solid #e8e8e8">Attendence Stats</span>
					</div>
					<div class="row">
						<div class="row" style="padding: 10px 5px;">
							<div class="col l9">
								Leaves	
							</div>
							<div class="col l3 center-align">
								<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="red white-text ">32</span>
							</div>
							
						</div>
						<div class="divider">
							
						</div>
						<div class="row" style="padding: 10px 5px;">
							<div class="col l9">
								Extra Time	
							</div>
							<div class="col l3 center-align">
								<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange white-text ">187 Hours</span>
							</div>
							
						</div>
						<div class="divider">
							
						</div>
						<div class="row" style="padding: 10px 5px;">
							<div class="col l9">
								Working Days
							</div>
							<div class="col l3 center-align">
								<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text ">189</span>
							</div>
							
						</div>
					</div>
				</div>
					
			</div>
		</div>
	</div>
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
	</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>