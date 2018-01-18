@extends('admin.layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'no',
	'page_title' => 'Control Panel',
	'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
        @include('admin.control-panel._tabs')
        {!! Form::select('method',get_all_defined_functions(),[],['class'=>'browser-default','placeholder'=>'Select Method']) !!}
        {!! FormGenerator::GenerateForm('method_test_params') !!}
	@include('common.page_content_primary_end')

	@include('common.page_content_secondry_start')
		
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<script type="text/javascript">
    $(document).ready(function(){
        $('input[type=submit]').click(function(){
            var method = $('select[name=method]').val();
            var params = [];
            $('input[name=param]').each(function(){
                params.push($(this).val());
            })

            console.log(params);
            console.log(method);
        });
    });
</script>
@endsection

