@extends('layouts.front')
@section('content')
	{!! $pageData->content !!}
{{ dump($pageData) }}
<div>
	<input type="text" name="comment">
	<ul>
		<li></li>
	</ul>
	
</div>



@endsection()
