	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title>Admin Panel | Admin Pie | OXO Solutions</title>


		
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <link href="{{ asset('css/ocrm.css') }}" type="text/css" rel="stylesheet"  media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/spectrum.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/simple-iconpicker.min.css') }}">
    
	<script src="{{ asset('assets/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="{{ asset('assets/js/fullcalendar.min.js')}}"></script>
    {{-- <script type="text/javascript" src="{{ asset('assets/js/materialize.min.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/common.js?')}}<?php echo rand(4524,28282); ?>"></script>

	<script type="text/javascript" src="http://www.appelsiini.net/download/jquery.jeditable.js"></script>
	<script type="text/javascript" src="{{ asset('js/spectrum.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/simple-iconpicker.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
	<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/sweetalert/dist/sweetalert.css') }}">

    <script src="{{ asset('bower_components/sweetalert/dist/sweetalert.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('bower_components/jquery-form-validator/form-validator/jquery.form-validator.js')}}"></script>
    <!-- Select 2 -->
	<script type="text/javascript" src="{{ asset('bower_components/select2/dist/js/select2.js')}}"></script>

		<!-- OWL Carausel -->
	<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/owl.carousel/dist/assets/owl.carousel.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
	<script src="{{ asset('bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>

	<!-- load emmet code and snippets compiled for browser -->
	<script type="text/javascript" src="{{ asset('bower_components/ace-builds/src-min/ace.js')}}"></script>
	<!-- load emmet code and snippets compiled for browser -->
	<script type="text/javascript" src="https://cloud9ide.github.io/emmet-core/emmet.js"></script>
	<script type="text/javascript" src="{{ asset('bower_components/ace-builds/src-min/ext-emmet.js')}}"></script>

	
	<!-- Global stylesheets -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/aione.css?ref='.rand(1111,9999)) }}">


	
	<script type="text/javascript">
        function route(){
        	if('{{Request::route()->getPrefix()}}' != ''){
        		return '{{url('/').stripslashes(Request::route()->getPrefix())}}';
        	}else{
        		return '{{url('/')}}';
        	}
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

	
