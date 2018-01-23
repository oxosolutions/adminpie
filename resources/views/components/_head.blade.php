	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    
    @if(Auth::guard('group')->check())
        @php
            $groupData = App\Model\Admin\GlobalGroup::where('id',Auth::guard('group')->user()->group_id)->first();
        @endphp
        <title>{{ $groupData->name }}</title>
    @elseif(Auth::guard('org')->check())
        @php
            $site_title = App\Model\Organization\OrganizationSetting::getSettings('title');
        @endphp
        <title>{{ $site_title }}</title>
    @endif

	
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	
	{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"> --}}

    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.material.min.css"> --}}
	

	
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="{{ asset('assets/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/jquery-form-validator/form-validator/jquery.form-validator.js')}}"></script>

    <!-- Select 2 -->
	<script type="text/javascript" src="{{ asset('bower_components/select2/dist/js/select2.js')}}"></script>

	
    <script src="{{ asset('assets/js/fullcalendar.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
    
    <script src="{{ asset('bower_components/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/common.js?')}}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-ui.min.js?')}}"></script>
    
 
	<script type="text/javascript" src="http://www.appelsiini.net/download/jquery.jeditable.js"></script>

	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/handsontable/0.31.2/handsontable.full.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/handsontable/0.31.2/plugins/removeRow/handsontable.removeRow.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/handsontable/0.31.2/plugins/bootstrap/handsontable.bootstrap.css" />
	
	<script src="https://cdn.jsdelivr.net/handsontable/0.31.2/handsontable.full.min.js"></script>
	<script src="https://cdn.jsdelivr.net/handsontable/0.31.2/plugins/jqueryHandsontable.js"></script>
	<script src="https://cdn.jsdelivr.net/handsontable/0.31.2/plugins/removeRow/handsontable.removeRow.js"></script>

	<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="{{asset('js/dropzone.js')}}"></script>



	<script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css">

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
        		return '{{url('/')."/".Request::route()->getPrefix()}}';
        	}else{
        		return '{{url('/')}}';
        	}
        }
        function csrf(){
            return '{{csrf_token()}}';
        }
    </script>
    <script type="text/javascript">
    	$(function(){
    		try{
    			$('#example').DataTable({
	    			processing: true,
                    dom: "flrtBp",
			      	serverSide: true,
			      	ajax: '{{url('/')}}/hrm/employee/list',
			      	buttons: [
			                    {
			                        extend: 'excel',
			                        filename: 'Export',
			                        exportOptions: {
			                            columns: ':not(.actions)'
			                        }
			                    }
			                ],
				    columns: [
			            { data: 'user', name: 'user' },
			            { data: 'employee_id', name: 'employee_id' },
			            { data: 'name', name: 'name'},
			            { data: 'department', name: 'department' },
			            { data: 'designation', name: 'designation', searchable: true },
			            { data: 'email', name: 'email', searchable: true },
			            { data: 'created_at', name: 'created_at', searchable: true },
			            { data: 'status', name: 'status', orderable: false, searchable: false, "className": 'actions' },
				    ],
					"oLanguage": {
			            "sLengthMenu": "_MENU_ Rows",
			            "sSearch": ""
			        },
			        "aLengthMenu": [
			            [5, 10, 15, 20, 50, -1],
			            [5, 10, 15, 20, 50, "All"] // change per page values here
			        ],
			        search: {
					    "caseInsensitive": false
					},
					responsive: true,
					searchHighlight: true,

			        "iDisplayLength": 10    // set the initial value
	    		});
    		}catch(e){

    		}
    		
    		$('select[name=example_length]').addClass('browser-default');
    		$('input[type=search]').addClass('browser-default');
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
