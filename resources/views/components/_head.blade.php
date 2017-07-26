	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title> AdminPie</title>

	<!-- Global stylesheets -->
	
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css" media="screen,projection"> --}}
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css">
	{{-- <link href="{{ asset('assets/css/materialize.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/> --}}
	{{-- <link href="{{ asset('assets/css/materialize.clockpicker.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/> --}}
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/ocrm.css?ref='.rand(544,44)) }}" type="text/css" rel="stylesheet"  media="screen,projection"/>
    <link href="{{ asset('assets/css/fullcalendar.min.css') }}" rel='stylesheet' />
	<link href="{{ asset('assets/css/fullcalendar.print.min.css') }}" rel='stylesheet' media='print' />
	<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/sweetalert/dist/sweetalert.css') }}">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css?ref='.rand(544,44)) }}">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    
	<script src="{{ asset('assets/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="{{ asset('assets/js/fullcalendar.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('assets/js/materialize.js')}}"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('assets/js/materialize.clockpicker.js')}}"></script> --}}
    <script src="{{ asset('bower_components/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/common.js?')}}?ref={{rand(8899,9999)}}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-ui.min.js?')}}?ref={{rand(8899,9999)}}"></script>
    
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    
	<script type="text/javascript" src="http://www.appelsiini.net/download/jquery.jeditable.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.8/ace.js"></script>
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/handsontable/0.31.2/handsontable.full.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/handsontable/0.31.2/plugins/removeRow/handsontable.removeRow.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/handsontable/0.31.2/plugins/bootstrap/handsontable.bootstrap.css" />
	<script src="https://cdn.jsdelivr.net/handsontable/0.31.2/handsontable.full.min.js"></script>
	<script src="https://cdn.jsdelivr.net/handsontable/0.31.2/plugins/jqueryHandsontable.js"></script>
	<script src="https://cdn.jsdelivr.net/handsontable/0.31.2/plugins/removeRow/handsontable.removeRow.js"></script>
	{{-- <script src="https://cdn.jsdelivr.net/handsontable/0.31.2/plugins/removeRow/test/jquery.handsontable.removeRow.spec.js"></script> --}}

	<script type="text/javascript">
        function route(){
            return '{{url('/')."/".Request::route()->getPrefix()}}';
        }
        function csrf(){
            return '{{csrf_token()}}';
        }
    </script>
	@if(@$plugins)
	    @foreach(@$plugins as $key => $plugin)
	    	@if($key == 'js')
	    		@foreach(@$plugin as $ikey => $file)
				    @if(is_array($file) && $ikey == 'custom')
						@foreach(@$file as $iKey => $iVal)
				        	<script type="text/javascript" src="{{asset('js/pages/'.$iVal.'.js')}}?ref={{rand(8899,9999)}}"></script>
						@endforeach
				    @else
				        @include('components.plugins.js.'.$file)
				    @endif
				@endforeach
			@elseif($key == 'css')
				@foreach(@$plugin as $key => $file)
				    @if(is_array($file) && $key == 'custom')
						@foreach(@$file as $iKey => $iVal)
							<link href="{{asset('css/pages/'.$iVal.'.css')}}?ref={{rand(8899,9999)}}" rel="stylesheet" type="text/css" >
						@endforeach
				    @else
				        @include('components.plugins.css.'.$file)
				    @endif
				@endforeach
			@endif
	    @endforeach
	@endif

	
