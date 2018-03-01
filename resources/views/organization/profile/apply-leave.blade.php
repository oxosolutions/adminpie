@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
'show_page_title' => 'yes',
'show_add_new_button' => 'yes',
'show_navigation' => 'yes',
'page_title' => 'Apply leave',
'add_new' => 'All Leaves',
'route' => 'account.leaves'
); 


@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	{!! Form::open(['route'=>'store.employeeleave' , 'class'=> 'form-horizontal','method' => 'post'])!!}
		<input type="hidden" name="apply_by" value="employee">
		{!! FormGenerator::GenerateForm('account-leave-form') !!}
	{!! Form::close() !!}

@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	<script type="text/javascript">
 
	   $(document).ready(function(){
	      $('#field_3241').hide(); //from
	      $('#field_189').hide(); // to
	      $('#field_3238').hide();//half type
	      $('#field_3240').hide();// single date

	   })
	   $(document).on('change','#field_3232 select',function(){
	      console.log($(this).val());
	      if($(this).val() == 'half'){
	         $('#field_3241').show(); //from
	         $('#field_189').hide(); //189
	         $('#field_3238').show(); //half type
	         $('#field_3240').hide(); // single date
	         $('#field_3241').find('label > h4').text('Date');
	      }
	      if($(this).val() == 'one_day'){
	          $('#field_3241').show();
	         $('#field_189').hide();
	         $('#field_3238').hide();
	         $('#field_3241').find('label > h4').text('Date');
	         // $('#field_3240').show();
	      }
	      if($(this).val() == 'multi'){
	         $('#field_3241').show();
	         $('#field_189').show();
	         $('#field_3238').hide();
	         $('#field_3241').find('label > h4').text('From');
	         // $('#field_3240').hide();
	      }
	   })
	</script>
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection