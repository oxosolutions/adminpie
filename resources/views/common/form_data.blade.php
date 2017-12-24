    
    @if($default_model != null)

        {!! Form::model($default_model,['route'=>'save.form.data','method'=>'POST']) !!}
            {!! FormGenerator::GenerateForm($slug,[],$default_model,$form_from) !!}
    @else

        {!! Form::open(['route'=>'save.form.data','method'=>'POST']) !!}
            {!! FormGenerator::GenerateForm($slug,[],null,$form_from) !!}
    @endif
        
        {!! Form::hidden('form_id',$model->id) !!}

        {!! Form::close() !!}