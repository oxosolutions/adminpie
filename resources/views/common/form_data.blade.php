
    {!! Form::open(['route'=>'save.form.data','method'=>'POST']) !!}
        {!! FormGenerator::GenerateForm($slug); !!}
    {!! Form::close() !!}