@extends('layouts.main')
@section('content')
		<div>
		<h1>Opening list</h1>
	<div>
		@foreach($jobs as $key => $value)
					<h3>{{$value['title']}}</h3><a href="{{route('apply',['id'=>$value['id'] ])}}"> Apply</a>

			 <ul>
			@foreach($value as $title => $val)
			{{-- {{dump($title)}} --}}
			@if(!is_array($val) && !empty($val))
				<li><label style="width:250px;display: inline-block;">{{str_replace('_',' ', $title)}}</label><span >{{$val}}</span></li>
			@endif
			@endforeach
			</ul>
				@if(!empty($value['opening_meta']))
					<ul>			
						@foreach($value['opening_meta'] as $metaKey => $metaValue)
						<li><label style="width:250px;display: inline-block;">{{$metaValue['key']}}</label><span >{{$metaValue['value']}}</span></li>
						@endforeach
					</ul>
				@endif 
		@endforeach
		
	</div>


		</div>

@endsection()