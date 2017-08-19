@if($model->status == 0)
	<span class="aione-status pending"></span>
@endif
@if($model->status == 1)
	<span class="aione-status active"></span>
@endif
<style type="text/css">
	.aione-status.active{
		    border-color: #9ccc65;
	}
	.aione-status{
		display: inline-block;
	    box-sizing: border-box;
	    width: 18px;
	    height: 18px;
	    border: 3px solid #ef5350;
	    border-radius: 50%;
	}
	.aione-status.pending{
		border-color: orange;
	}
</style>