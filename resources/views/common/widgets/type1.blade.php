<div class="col l3 pr-14">
	<div id="card_1">
		<div class="front" >
			<div class="card shadow mt-0 fix-height" >
				<div class="row center-align aione-widget-header mb-10" ><h5 class="m-0"><a href="#">{{ucfirst('Employees')}}</a></h5></div>
				<div class="row center-align aione-widget-content mb-10" >19</div>
				<div class="row aione-widget-footer mb-10" >
					<button href="#" class="all blue white-text">All Employees</button>
					<button href="#" class="recent blue white-text flip-btn-1">Recent Employees</button>
				</div>
			</div>
		</div>
		<div class="back">
			<div class="card shadow mt-0 fix-height" > 
				<div class="row center-align aione-widget-header m-0" ><h5 class="m-0"><a href="#">{{ucfirst('Recent Employees')}}</a></h5>
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