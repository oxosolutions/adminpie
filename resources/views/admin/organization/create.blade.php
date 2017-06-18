@extends('admin.layouts.main')
@section('content')
    <div class="card" style="margin-top:0px;padding: 10px ">
        
    {!! Form::open([ 'method' => 'POST', 'route' => 'save.organization' ,'class' => 'form-horizontal']) !!}

        @include('admin.organization._form')                
        <div class="row right-align pv-10">
            <button type="submit" class="btn btn-primary blue"> create Organization <i class="icon-arrow-right14 position-right"></i></button>  
        </div>                      
        
                            
                        
    {!! Form::close() !!}        
    </div>

	

<style type="text/css">
	button{
		position: inherit !important;
	}
</style>
@endsection
