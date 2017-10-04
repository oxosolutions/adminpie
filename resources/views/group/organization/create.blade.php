@extends('group.layouts.main')
@section('content')
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Create Group',
  'add_new' => '+ Add Module'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
            
        {!! Form::open([ 'method' => 'POST', 'route' => 'save.groupOrganization' ,'class' => 'form-horizontal']) !!}

            {{-- @include('admin.organization._form')                 --}}
            <input type="hidden" name="group_id" value="{{Auth::guard('group')->user()->group_id}}">
            {!! FormGenerator::GenerateForm('create_organization_form') !!}

            <div class="row right-align pv-10">
               {{--  <button type="submit" class="btn btn-primary blue"> create Organization <i class="icon-arrow-right14 position-right"></i></button>  --}} 
            </div>                      
            
                                
                            
        {!! Form::close() !!}      
      
        @php
            $option="";
            foreach ($modules as $key =>$value){
                 $option .="<option value=".$key.">".$value."</option>";
            }
           
        @endphp
        <script>
            $(document).ready(function(){
                $("#field_modules select").html("<?php echo $option; ?>");
            });
        </script>  
      @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')

    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection

