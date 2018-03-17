<div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom mb-30">
			View attendance
			<div class="aione-float-right font-size-16	">
				<button class="aione-button yearly" year="{{$filter['year']-1}}" style="margin-top: -10px"  >
					<i class="fa fa-chevron-left line-height-24 font-size-13" ></i>
				</button>
				<span id="year_display"  class="aione-align-center display-inline-block" style="width: 200px">{{$filter['year']}} </span>
				<button class="aione-button yearly" year="{{$filter['year']+1}}" style="margin-top: -10px">
					<i class="fa fa-chevron-right line-height-24 font-size-13" ></i>
				</button>
			</div>
		</div>
			<div class="font-size-14 ">
				<div class="font-size-14 display-inline-block line-height-0 aione-align-center" style="width: 50px">Days</div>
				@for($i=1; $i<=31; $i++)
				<div class=" display-inline-block box aione-align-center " style="margin-right: -1.7px;">{{$i}}</div>
				@endfor
			</div>
			@for($i=1; $i<=12; $i++ )
				@if(strlen($i) ==1)
					@php
					$i ='0'.$i;
					@endphp
				@endif
				@php
					$postDate=1;
					$month_wise   = Carbon\Carbon::create($filter['year'], $i, $postDate, 0);
					$dayInMonth = $month_wise->daysInMonth;
				@endphp
				<div class="font-size-0" style="font-size: 0">
					<div class="font-size-14 display-inline-block line-height-30 aione-align-center" style="vertical-align: top;width: 50px">{{substr($month_wise->format(' F'),0,4)}}</div>
					@if(!empty($attendance_data[$i]))
						@php
							$val = collect($attendance_data[$i]);
							$data = $val->keyBy('date')->toArray();
						@endphp
						@for($j=1; $j<=$dayInMonth; $j++)
							@if(!empty($data[$j]['attendance_status']))
								@if($data[$j]['attendance_status']=='present')
									<div class="attendance-status-present display-inline-block box ml-2 mt-2"></div>
								@elseif($data[$j]['attendance_status']=='absent')
									<div class="attendance-status-absent display-inline-block box ml-2 mt-2"></div>
								@elseif($data[$j]['attendance_status']=='Sunday')
									<div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2"></div>
								@elseif($data[$j]['attendance_status']=='leave')
									<div class="attendance-status-leave display-inline-block box ml-2 mt-2"></div>
								@else
									<div class="light-green display-inline-block box ml-2 mt-2"></div>
								@endif
							@else
								<div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2"></div>
							@endif
						@endfor
					@else
						@for($j=1; $j<=$dayInMonth; $j++)
							<div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2"></div>
						@endfor
					@endif
				</div>
			@endfor