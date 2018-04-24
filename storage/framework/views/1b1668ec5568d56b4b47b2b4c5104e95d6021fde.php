<?php if(!empty($attendance_data) && isset($attendance_data[$user_meta['employee_id']]) && !empty($attendance_data[$user_meta['employee_id']])): ?>
		<?php if(isset($attendanceVal[$d]) && empty($attendanceVal[$d]['shift_hours'])): ?>
			<?php if($attendanceVal[$d]['attendance_status']=='first_half'): ?>
				<div class="attendance-sheet column  attendance-status-leave first-half white">F</div>
			<?php elseif($attendanceVal[$d]['attendance_status']=='second_half'): ?>
				<div class="attendance-sheet column  attendance-status-leave second-half white">S</div>
			<?php elseif($attendanceVal[$d]['attendance_status']=='leave'): ?>
				<div class="attendance-sheet column  attendance-status-leave ">L</div>
			<?php elseif($attendanceVal[$d]['attendance_status']=='lop'): ?>
				<div class="attendance-sheet column attendance-status-leave">U</div>
			<?php elseif(!empty($attendanceVal[$d]['punch_in_out']) || !empty($attendanceVal[$d]['attendance_status']=='present') ): ?>
				<div class="attendance-sheet column attendance-status-off attendance-status-present">O</div>
			<?php else: ?>
				<div class="attendance-sheet column attendance-status-off">O</div>
			<?php endif; ?>

		<?php elseif(!empty($attendanceVal[$d]) && !empty($attendanceVal[$d]['shift_hours'])): ?>

			<?php if(!empty($holiday_data[$d])): ?>
				
 				<?php if(!empty($attendanceVal[$d]) && !empty($attendanceVal[$d]['punch_in_out'])): ?>
					<div class="attendance-sheet column attendance-status-holiday attendance-status-present">H</div>
				<?php elseif(!empty($attendanceVal[$d]) && $attendanceVal[$d]['attendance_status'] == 'present'): ?>
					<div class="attendance-sheet column attendance-status-holiday attendance-status-present">H</div>
				<?php else: ?>
					<div class="attendance-sheet column attendance-status-holiday ">H</div>
				<?php endif; ?>

			<?php elseif($attendanceVal[$d]['attendance_status']=='first_half'): ?>
				<div class="attendance-sheet column  attendance-status-leave">F</div>
			<?php elseif($attendanceVal[$d]['attendance_status']=='second_half'): ?>
				<div class="attendance-sheet column  attendance-status-leave">S</div>
			<?php elseif(!empty($attendanceVal[$d]) && $attendanceVal[$d]['attendance_status']=='leave'): ?>
				<?php if(!empty($attendanceVal[$d]) && !empty($attendanceVal[$d]['punch_in_out'])): ?>
					<div class="attendance-sheet column  attendance-status-leave ">L</div>
				<?php else: ?>
					<div class="attendance-sheet column attendance-status-leave">L</div>
				<?php endif; ?>

			<?php elseif($attendanceVal[$d]['attendance_status']=='lop'): ?>
				<?php if(!empty($attendanceVal[$d]) && !empty($attendanceVal[$d]['punch_in_out'])): ?>
					<div class="attendance-sheet column  attendance-status-leave attendance-status-present ">U</div>
				<?php else: ?>
					<div class="attendance-sheet column attendance-status-leave">U</div>
				<?php endif; ?>

			<?php elseif(@$attendanceVal[$d]['attendance_status']=='present' || !empty($attendanceVal[$d]['punch_in_out']) ): ?>
				<div class="attendance-sheet column attendance-status-null attendance-status-present">w</div>
			<?php elseif(@$attendanceVal[$d]['attendance_status']=='absent'): ?>
				<div class="attendance-sheet column attendance-status-absent">A</div>
			<?php else: ?> 
				<div class="attendance-sheet column attendance-status-absent">A</div>
			<?php endif; ?>
		<?php else: ?>
			<div class="attendance-sheet column" style="background-color:rgba(128, 128, 128, 0.38);height:31px"></div>
		<?php endif; ?>
<?php else: ?>
	<?php if(!empty($holiday_data[$d])): ?>
		<div class="attendance-sheet column attendance-status-holiday">H</div>
	<?php else: ?>
		<div class="attendance-sheet column " style="background-color:rgba(128, 128, 128, 0.38);height:31px"></div>
	<?php endif; ?>
<?php endif; ?>	