<div>

				@php
				
		 			$td="";
					$number= 1;
					if(!empty($fweek_no)){
						if($fweek_no==5){
							$end_week_day = $total_days;
							$number = $start_week_day = 29;
						}else{
							$total_days = $end_week_day = $fweek_no * 7;
							$number = $start_week_day = $end_week_day -6;
						}
						for($d=$start_week_day; $d<=$end_week_day; $d++){
							$getDay = Carbon\Carbon::create($current_year, $current_month, $d, 0);
						}
					}
				@endphp
					@if(!empty($fdate))
						@php
							$number = $total_days = $fdate;
							$getDay = Carbon\Carbon::create($current_year, $current_month, $fdate, 0);
							if($getDay->format('l')=="Sunday")
						{
							$td .="<div class='attendance-sheet column sunday'>S</div>";
						}else
						{
							$td .="<div class='attendance-sheet column bg-grey bg-lighten-3'></div>";
						}
						$fdate;
						@endphp
						<div class="attendance-sheet column">{{$fdate}}<br> 
							{{substr($getDay->format('l'),0,1)}} 
						</div> <div class="attendance-sheet column"> Shift Hours </div><div class="attendance-sheet column">In out Time </div>
					@else
					
						@for($d=$number; $d<=$total_days; $d++)
						@php

						$getDay = Carbon\Carbon::create($current_year, $current_month, $d, 0);
						if($getDay->format('l')=="Sunday")
						{
							$td .="<div class='attendance-sheet column sunday'>S</div>";
						}else
						{
							$td .="<div class='attendance-sheet column bg-grey bg-lighten-3'></div>";
						}
						@endphp
							<div class="attendance-sheet column">{{$d}}<br> 
							{{substr($getDay->format('l'),0,1)}} 
							</div>
						@endfor
					@endif
 			</div>