@php
	$index=1;
@endphp
<ul>
	@foreach($modal as $key => $value)
	<li>
	<a href="javascript:;">
		<span><i class="fa fa-times" style="float: right;display: none"></i></span>
		<input type="hidden" name="id" value="{{$value->id}}">
		<h2>#{{$index++}}<span class="notes_title">{{$value->title}}</span> </h2>
		<p class="notes_desc">{{$value->description}}</p>
	</a>
	</li>
	@endforeach
</ul>