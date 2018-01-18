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
	 <div class="aione-border bg-white p-20 mh-100">
        <div class="aione-align-center">
            <h4 class="aione-border-bottom pb-20">{{ $model->title }}</h4>
            <div class="aione-border-bottom pv-10">
                Experience Required : {{ getMetaValue($model->opening_meta,'experience_year') }} Years | CTC Offered : {{ getMetaValue($model->opening_meta,'minimum_package') }} - {{ getMetaValue($model->opening_meta,'maximum_package') }} | Job Location : {{ $model->location }} | Openings : {{ $model->number_of_post }}
            </div>
        </div>
        <div class="pv-20">
            <h5 class="aione-align-center">Job Description</h5>
            <p class="line-height-26 pv-20">
               	{{ getMetaValue($model->opening_meta,'description') }}
            </p>
        </div>
       

        <div class="aione-border-top pv-20">
            <div class=" font-size-18 p-10">
                 Apply For this job
            </div>
            <div class="p-10">
                Please provide correct information.
            </div>
            {!! Form::open(['route'=>'submit.application','files'=>true]) !!}
                {!! Form::hidden('opening_id',request()->id) !!}
                {!! FormGenerator::GenerateForm('apply-job-form') !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection