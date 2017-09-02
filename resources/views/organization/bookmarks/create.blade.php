@extends('layouts.main')
@section('content')
@if(@$model)
    {!! Form::model($model,['route'=>['update.bookmark',$model->id],'method' => 'POST']) !!}
@else
    {!! Form::open(['route'=>'save.bookmark','method' => 'POST']) !!}
@endif
		{{-- {!! FormGenerator::GenerateForm('create_bookmark_form') !!} --}}
		<div id="aione_modules_settings" class="aione-tab-content active">
           
               <div class="row">
                    <div class="col l12" style="padding: 10px 0px;">
                        title
                    </div>
                    <div class="col l12">
                      {!! Form::text('title',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col l12" style="padding: 10px 0px;">
                        Link
                    </div>
                    <div class="col l12">
                      {!! Form::text('link',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col l12" style="padding: 10px 0px;">
                        Users
                    </div>
                 {!! Form::select('user_id[]',App\Model\Organization\User::getEmployee(),App\Model\Organization\User::getEmployee(),['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;','multiple']) !!}
                </div>
                <div class="row">
                    <div class="col l12" style="padding: 10px 0px;">
                        Categories
                    </div>
                 {!! Form::select('categories',App\Model\Organization\Category::getCategories(),App\Model\Organization\Category::getCategories(),['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']) !!}
                </div>
	            <div class="row">
	                <div class="col s12 m2 l12 " style="padding: 10px 0px">
	                    Target
	                </div>
	                <div class="col s12 m2 l12 " style="padding: 10px 0px">
	                	{{ Form::label('target', 'Same Page') }}
	                    {{ Form::radio('target', '_self') }}
	                    {{ Form::label('target', 'Next Page') }}
						{{ Form::radio('target', '_blank') }}
	                </div>
	            </div>
	            <input type="submit" name="submit" value="submit">
        </div>
	{!! Form::close() !!}
	@if(Session::has('saved'))
		<script type="text/javascript"> $(document).ready(function(){ Materialize.toast("Saved Successfully" , 4000); }); </script>
	@endif
     <a href="" data-target="create-bookmark">test</a>
    @include('common.modal-onclick',['data'=>['modal_id'=>'create-bookmark','heading'=>'This is Heading','button_title'=>'Save Data','section'=>'save_bookmarks']])
@endsection
