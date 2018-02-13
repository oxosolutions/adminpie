<?php if($model->status == 0): ?>
	<span class="aione-status pending"></span>
<?php endif; ?>
<?php if($model->status == 1): ?>
	<span class="aione-status active"></span>
<?php endif; ?>
