@php
    $design_settings = get_design_settings();
    if(@$design_settings->theme !== null && $design_settings->theme != ''){
	    $layout = 'layouts.themes.'.$design_settings->theme.'.layout';
    } else {
	    $layout = 'layouts.front';
    }
@endphp
@extends($layout)
@section('content')
	{!! $pageData->content !!}{{-- 
{{ dump($pageData->comments) }}


<div>
	

{!! Form::open(['route'=>'save.comment']) !!}

	<input type="text" name="post_id" value="{{ $pageData->id }}">
	<input type="text" name="comment">
	{!! Form::submit() !!}
{!! Form::close() !!}
	<ul>
		@foreach($pageData->comments as $key => $value)
			<li><label for="">{{$value['user_id']}} </label>{{$value['comment']}}</li>
		@endforeach
	</ul>

	
</div> --}}



@endsection()
