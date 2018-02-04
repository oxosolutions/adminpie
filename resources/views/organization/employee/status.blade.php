@if($model->status == 0)
	<span class="aione-status pending"></span>
@endif
@if($model->status == 1)
	<span class="aione-status active"></span>
@endif
