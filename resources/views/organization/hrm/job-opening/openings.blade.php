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
	<div class="ph-100">
		<h3 class="mb-20">Job Openings</h3>
        @foreach($model as $key => $job)
    		<div class="aione-border aione-shadow mb-10 p-10">
    			<div class="ar">
    				<div class="ac p-0"> 
                        <div class="" style="max-width: 150px;min-width: 150px">
                        	<img src="https://cdnp-2f3a.kxcdn.com/blog/wp-content/uploads/2016/04/Why-Laravel.jpg" style="height: 150px;" class="">
                        </div>				
    					
    				</div>
    				<div class="ac l85">
    					<h4>{{ $job->title }}<span class="aione-float-right font-size-13 grey ">Last Date : {{ Carbon\Carbon::parse(getMetaValue($job->opening_meta,'opening_close'))->format('Y M d') }} </span></h4>
    					<p class="mv-15">
    						{{ $job->description }}
    					</p>
    					<div class="ar grey darken-1 font-size-13">
    						<div class="ac l25 aione-border-right">
    							Experience Required : {{ getMetaValue($job->opening_meta,'experience_year') }} Years
    						</div>
    						<div class="ac l25 aione-border-right">
    							CTC Offered : {{ getMetaValue($job->opening_meta,'minimum_package') }} - {{ getMetaValue($job->opening_meta,'maximum_package') }}
    						</div>
    						<div class="ac l25 aione-border-right">
    							Job Location : {{ $job->location }}
    						</div>
    						<div class="ac l25 ">
    							Openings : {{ $job->number_of_post }}
    						</div>
    					</div>
    					<div class="mt-10 aione-align-right">
    						<a class="aione-button" href="{{ route('detail.openings',$job->id) }}">View Details</a>
    						<button class="aione-button bg-light-blue bg-darken-2 white">Apply Now</button>
    					</div>
    				</div>
    			</div>
    		</div>
        @endforeach
	</div>
@endsection