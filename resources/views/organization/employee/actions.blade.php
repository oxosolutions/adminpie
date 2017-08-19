<div>
	{{$model->name}}
	<ul style="display: inline;">
		<li><a href="{{route('account.profile',$model->id)}}">Edit</a></li>
		<li><a href="{{route('delete.employee',$model->id)}}">Delete</a></li>
	</ul>
</div>