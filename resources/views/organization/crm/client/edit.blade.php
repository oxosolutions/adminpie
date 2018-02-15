@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Edit Customer',
	'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	 <?php echo Form::model($model, ['route'=>['update.client',$model->id ], 'class'=> 'form-horizontal','method' => 'post']); ?>
		{!!FormGenerator::GenerateForm('create_client_form')!!}
	{!!Form::close()!!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<script type="text/javascript">
    $(document).ready(function(){
        $('input[name=email').prop('disabled',true); 
    });
</script>
@endsection()