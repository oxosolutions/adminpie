
					{{--- YEARLY STARTS --}}
		
			

			



			<div class="line"><div class='mo'>Day</div>
			@for($i=1; $i<=31; $i++)
				<div class='square days'>{{$i}}</div>
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
					<div class="line">
						<div class='mo'>{{substr($month_wise->format(' F'),0,4)}}</div>

						@if(!empty($attendance_data[$i]))
							@php
								$val = collect($attendance_data[$i]);
								$data = $val->keyBy('date')->toArray();
							@endphp
							 @for($j=1; $j<=$dayInMonth; $j++)
								@if(!empty($data[$j]['attendance_status']))

									@if($data[$j]['attendance_status']=='present')
												<div class='square present'>p</div>
											@elseif($data[$j]['attendance_status']=='absent')
												<div class='square absent'>a</div>
											@elseif($data[$j]['attendance_status']=='Sunday')
												<div class='square sunday'>s</div>
											@elseif($data[$j]['attendance_status']=='leave')
												<div class='square leave'>l</div>
											@else
												<div class='square leave'>0</div>
											@endif
										
											{{-- {{substr($data[$j]['attendance_status'], 0,1)}} --}}
									@else
											<div class='square empty'>{{$j}}</div>
									@endif
								@endfor
						@else
							 @for($j=1; $j<=$dayInMonth; $j++)
								<div class='square empty'>{{$j}}</div>
							 @endfor
						@endif
					</div>

						
			@endfor
			
					{{-- YEARLY ENDS --}}