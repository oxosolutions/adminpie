@extends('admin.layouts.main')
@section('content')
{{-- page header is not working here  --}}

@php

$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => __('admin.edit_group_page_title').'&nbsp;&nbsp;<span>'.$group_data->name.'</span>',
    'add_new' => '+ Add User'
); 
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
  @include('common.page_content_primary_start')
  @include('admin.group._tabs')
  @php
    $selectedModule = json_decode($group_data->modules);
    $selectedModuleArray = App\Model\Admin\GlobalModule::whereIn('id',$selectedModule)->pluck('id','name');
    $group_data['modules'] = $selectedModuleArray;

    $groupEmail = App\Model\Group\AdminUsers::where('group_id',$group_data->id)->first()->email;
    $group_data['email'] = $groupEmail; 
  @endphp

  {!!Form::model($group_data, ['route' => ['update.group', $group_data->id]])!!}
    {!! FormGenerator::GenerateForm('edit_group_form') !!}
  {!! Form::close() !!} 
  @include('common.page_content_primary_end')
  @include('common.page_content_secondry_start')

  @include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection