@if(Auth::guard('admin')->check() == true)
  @php
        $from = 'admin';
        $layout = 'admin.layouts.main';
        $route = 'admin.save.page.settings';
  @endphp
@else
  @php
        $from = 'org';
        $layout = 'layouts.main';
        $route = 'save.page.settings';
  @endphp
@endif
@extends($layout)

@section('content')
	
	{{-- <div class="row">
		<div class="col l12">
			<h5>Edit Details</h5>
			<div>
			{!! Form::model($page,['route'=>'update.page' ])!!}
				@include ('organization.pages._form')
			{!! Form::close()!!}
			</div>
		</div>
		
	</div> --}}

	@php
	$page_title_data = array(
	    'show_page_title' => 'yes',
	    'show_add_new_button' => 'no',
	    'show_navigation' => 'yes',
	    'page_title' => 'Edit Page Setting <span>'.$page->title.'</span>',
	    'add_new' => '+ Add Media'
	); 
	@endphp 
	@include('common.pageheader',$page_title_data) 
	@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		@include('organization.pages._tabs')
			@if($model != null)
				{!! Form::model($model,['method' => 'POST' , 'route' => $route])!!}
			@else
				{!! Form::open(['method' => 'POST' , 'route' => $route])!!}
			@endif
				{!! FormGenerator::GenerateForm('page_design_settings') !!}
				<input type="hidden" name="page_id" value="{{request()->route()->parameters()['id']}}">
			{!! Form::close()!!}
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
		
	@include('common.page_content_secondry_end')
	@include('common.pagecontentend')
@endsection()