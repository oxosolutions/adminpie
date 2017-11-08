@if(Auth::guard('admin')->check() == true)
  @php
        $from = 'admin';
        $layout = 'admin.layouts.main';
        $route = 'admin.category.update';
  @endphp
@else
  @php
        $from = 'org';
        $layout = 'layouts.main';
        $route = 'category.update';
  @endphp
@endif
@extends($layout)

@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Edit Categories <span>'.$modelData->name.'</span>',
);
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

	{!!Form::model($modelData,['route'=>[$route,$modelData['id']],'method'=>'POST'])!!}
		{!! FormGenerator::GenerateForm('edit_category_form') !!}
		<input type="hidden" name="id" value="{{$modelData['id']}}">
		<input type="submit" value="submit">
	{!!Form::close()!!}	

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection