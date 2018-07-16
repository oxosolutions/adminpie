<div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom mb-30">
			View attendance
			<div class="aione-float-right font-size-16	">
				<button class="aione-button yearly" year="<?php echo e($filter['year']-1); ?>" style="margin-top: -10px"  >
					<i class="fa fa-chevron-left line-height-24 font-size-13" ></i>
				</button>
				<span id="year_display"  class="aione-align-center display-inline-block" style="width: 200px"><?php echo e($filter['year']); ?> </span>
				<button class="aione-button yearly" year="<?php echo e($filter['year']+1); ?>" style="margin-top: -10px">
					<i class="fa fa-chevron-right line-height-24 font-size-13" ></i>
				</button>
			</div>
		</div>
			<div class="font-size-14 ">
				<div class="font-size-14 display-inline-block line-height-0 aione-align-center" style="width: 50px">Days</div>
				<?php for($i=1; $i<=31; $i++): ?>
				<div class=" display-inline-block box aione-align-center " style="margin-right: -1.7px;"><?php echo e($i); ?></div>
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
				<div class="font-size-0" style="font-size: 0">
					<div class="font-size-14 display-inline-block line-height-30 aione-align-center" style="vertical-align: top;width: 50px"><?php echo e(substr($month_wise->format(' F'),0,4)); ?></div>
					<?php if(!empty($attendance_data[$i])): ?>
						<?php
							$val = collect($attendance_data[$i]);
							$data = $val->keyBy('date')->toArray();
						?>
						<?php for($j=1; $j<=$dayInMonth; $j++): ?>
							<?php if(!empty($data[$j]['attendance_status'])): ?>
								<?php if($data[$j]['attendance_status']=='present'): ?>
									<div class="attendance-status-present display-inline-block box ml-2 mt-2">W</div>
								<?php elseif($data[$j]['attendance_status']=='absent'): ?>
									<div class="attendance-status-absent display-inline-block box ml-2 mt-2">A</div>
								<?php elseif($data[$j]['attendance_status']=='Sunday'): ?>
									<div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2">0</div>
								<?php elseif($data[$j]['attendance_status']=='leave'): ?>
									<div class="attendance-status-leave display-inline-block box ml-2 mt-2">L</div>
								<?php else: ?>
									<div class="light-green display-inline-block box ml-2 mt-2"></div>
								<?php endif; ?>
							<?php else: ?>
								<div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2"></div>
							<?php endif; ?>
						<?php endfor; ?>
					<?php else: ?>
						<?php for($j=1; $j<=$dayInMonth; $j++): ?>
							<div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2"></div>
						<?php endfor; ?>
					<?php endif; ?>
				</div>
			<?php endfor; ?>