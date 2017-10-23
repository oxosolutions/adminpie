@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'yes',
  'show_navigation' => 'yes',
  'page_title' => 'Roles',
  'add_new' => '+ Add Role'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
        @include('common.list.datalist')
    @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
    
     
         {!! Form::open(['route' => 'role.store', 'files'=>true]) !!}
            {{-- @include('organization.role._form')
            <div class="box-footer">
              {!! Form::submit('Save Role', ['class' => 'btn btn-primary']) !!}
            </div> --}}
            @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Role','button_title'=>'Save','form'=>'organization_add_role_form']])
          {!! Form::close() !!}
     
    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
     
      
   
<script type="text/javascript">
 
  // $(document).on('click','#delete_role',function(){
  //   var role_id = $(this).attr('role-id');
  //   $(this).parents('.options').find('input[name=role_id]').val(role_id);
  //   if(role_id == 1 || role_id == 2 || role_id == 3){
  //     $('#change_role').modal('open');
  //   }

  // });
  $(document).on('click','#delete_role',function(){
    var role_id = $(this).attr('role-id');
    $.ajax({
      url : route()+'/role/delete',
      type : 'POST',
      data : {role_id : role_id , _token : $('.shift_token').val()},
      success : function(res){
        console.log(res);
      }
    });
  });
 
</script>
@endsection