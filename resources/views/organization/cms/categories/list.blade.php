@if(Auth::guard('admin')->check() == true)
  @php
        $from = 'admin';
        $layout = 'admin.layouts.main';
        $route = 'admin.category.save';
  @endphp
@else
  @php
        $from = 'org';
        $layout = 'layouts.main';
        $route = 'category.save';
  @endphp
@endif
@extends($layout)

@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Categories',
	'add_new' => '+ Add Category'
);
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('common.list.datalist')
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')


	{!!Form::open(['route'=>$route,'method'=>'POST'])!!}
	@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Category','button_title'=>'Save','form'=>'add_category_form']])

	{!!Form::close()!!}	

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection