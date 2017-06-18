	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>OCRM | OXO Solutions</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/default/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/default/assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/default/assets/css/core.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/default/assets/css/components.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/default/assets/css/colors.css') }}" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="{{ asset('assets/css/materialize.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" >
	<link href="{{ asset('assets/css/ocrm.css') }}" type="text/css" rel="stylesheet"  media="screen,projection"/>
	<script type="text/javascript" src="{{ asset('LTR/default/assets/js/core/libraries/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('LTR/default/assets/js/plugins/loaders/pace.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/materialize.min.js')}}"></script>
	{{-- <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script> --}}
	{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script> --}}
	{{-- <script type="text/javascript" src="{{asset('LTR/default/assets/js/core/libraries/bootstrap.min.js')}}"></script> --}}
	<script type="text/javascript" src="http://www.appelsiini.net/download/jquery.jeditable.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
				
		});
	</script>
	<script type="text/javascript" src="{{asset('js/script.js?rand(54545,545485)')}}"></script>
	<style type="text/css">
		.page-container{
			  min-height: 600px  !important
			}

	</style>
	<script type="text/javascript">
		$(document).ready(function(){
			
			$('.shift-select').material_select();
		});	
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
				    @if(is_array($file) && $file == 'custom')
						@foreach(@$file as $iKey => $iVal)
							<link href="{{asset('css/pages/'.$iVal.'.js')}}?ref={{rand(8899,9999)}}" rel="stylesheet" type="text/css" >
						@endforeach
				    @else
				        @include('components.plugins.css.'.$file)
				    @endif
				@endforeach
			@endif
	    @endforeach
	@endif
	<script type="text/javascript">
		function route(){
			return '{{url('/').Request::route()->getPrefix()}}';
		}

	</script>


