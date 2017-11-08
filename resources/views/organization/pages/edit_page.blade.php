@if(Auth::guard('admin')->check() == true)
  @php
        $from = 'admin';
        $layout = 'admin.layouts.main';
        $route = 'admin.update.page';
  @endphp
@else
  @php
        $from = 'org';
        $layout = 'layouts.main';
        $route = 'update.page';

  @endphp
@endif
@extends($layout)
@section('content')
	<style type="text/css">
		.page-widgets > .boxed{
			border:1px solid #e8e8e8;
			margin-bottom: 15px;
		}
		.page-widgets > .boxed > .header{
			background-color: #e8e8e8;
			padding:10px;
		}
		.page-widgets > .boxed > .header > i{
			float: right;
			color: #757575
		}
		.page-widgets > .boxed > .content{
			padding: 10px
		} 
		.page-widgets > .boxed > .content > .tags > span{
			background-color: #e8e8e8;
			padding: 5px;
			color:#676767;
			border-radius: 2px;
			display: inline-block;
			margin: 0 5px 5px 0;
		}
		.page-widgets > .boxed > .content > .tags > span > i{
			margin-left: 5px
		}
	</style>
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
	    'page_title' => 'Edit Page <span>'.$page->title.'</span>',
	    'add_new' => '+ Add Media'
	); 
	@endphp
	<style type="text/css">
		textarea[name=content] , textarea[name=html_viewer]{
			height: 380px;
		}
		textarea[name=html_viewer]{
			position: absolute;
		}
	</style> 
	@include('common.pageheader',$page_title_data) 
	@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		@include('organization.pages._tabs')
		{!! Form::model($page,['route' => $route , 'method' => 'post']) !!}
			<div class="aione-row" style="position: relative;">
				<div style="position: absolute;right: 0;top: -60px">
					{{-- <div style="display: inline-block;width: 172px;">
						{!! FormGenerator::GenerateField('select_status') !!}	
					</div> --}}

					@php
						if(Auth::guard('admin')->check()){
							$route = 'view.pages';
						}else{
							$route = 'view.pages';
						}
					@endphp
					<a href="{{ route($route ,$page->slug ) }}" class="aione-button aione-button-small aione-button-light aione-button-square add-new-button" style="line-height: 40px">Preview</a>
					<button type="submit" style="display: inline-block;line-height: 18px;margin-left: 10px">Update</button>
				</div>
				<div class="l6" style="width: 75%;float: left;padding-right:15px ">
					{{-- <textarea rows="14" class="html_preview"></textarea> --}}
					{!! FormGenerator::GenerateForm('edit_page_form') !!}
				</div>
				@php
					$uri = explode('/',request()->route()->uri);
				@endphp
				<div class="l6 page-widgets" style="width: 25%;float: left">
					<input type="hidden" name="id" value="{{ request()->route()->parameters()['id'] }}">
					{!! FormGenerator::GenerateForm('page_options_form') !!}
				</div>
			</div>
			{{-- <button type="submit">Save</button> --}}
		{!! Form::close() !!}
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
		<script type="text/javascript">
			$(document).on('click','.add',function(){
				var tag = $(this).parents('.field-wrapper').prev().find('.input-tag').val();
				$('#input_tag').val('');
				$(this).parents('.field-wrapper').next().append('<span>'+tag+'<i class="fa fa-close"></i></span>');
			})
		</script>
	@include('common.page_content_secondry_end')
	@include('common.pagecontentend')
	<script type="text/javascript">
		$(document).ready(function(){
			// $('.html_preview').hide();
		});
	</script>
@endsection()