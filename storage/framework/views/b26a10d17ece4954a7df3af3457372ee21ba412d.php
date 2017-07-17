
					
		
			

			



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
			
					