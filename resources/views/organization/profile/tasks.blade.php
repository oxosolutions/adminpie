@extends('layouts.main')
@section('content')
    @php
        $page_title_data = array(
        'show_page_title' => 'yes',
        'show_add_new_button' => 'yes',
        'show_navigation' => 'yes',
        'page_title' => 'Tasks',
        'add_new' => '+ Add Task'
    ); 
    @endphp
    @if(@$errors->has())
        <script type="text/javascript">
            $(window).load(function(){
                $('.add-new-button').click();
            });
        </script>
    @endif
@include('common.pageheader',$page_title_data) 
	<div class="row">

        @php
         
          $link=$_SERVER['REQUEST_URI'];
          $route = explode('/',$link);

          
        @endphp
            @if(in_array('account', $route))
            	@include('organization.profile._tabs')
            @elseif(in_array('project', $route))

            @endif
    @include('common.pagecontentstart')
    @include('common.page_content_primary_start')
        <div class="row">
            <!-- <a href="#modal11" class="btn-flat">Add task</a> -->
            
            @include('common.tasks')
            <div class="append-data">

            </div>
        </div>
        @php

        @endphp
    @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
        {!!Form::open(['route'=>'create.tasks','method'=>'POST','files'=>true])!!}
            <input type="hidden" name="project_id" value="">
            @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Task','button_title'=>'Save','form'=>'task']])
        {!!Form::close()!!} 
    @include('common.page_content_secondry_end')
    @include('common.pagecontentend')
    </div>
@endsection