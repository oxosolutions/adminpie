@if(Auth::guard('admin')->check() == true)
  @php
        $from = 'admin';
        $layout = 'admin.layouts.main';
  @endphp
@else
  @php
        $from = 'org';
        $layout = 'layouts.main';
  @endphp
@endif
@extends($layout)
@section('content')
@php
    
    $title = $form->form_title;


@endphp
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Form <span>'.$title.'</span>',
  'add_new' => '+ Add Module'
); 
@endphp

@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('admin.formbuilder._tabs')
    {!! FormGenerator::GenerateForm($slug,[],'',$from) !!}
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<style type="text/css">
   .subtitle{
                
   
    font-weight: 500;
    display: inline-block;

         }
</style>
@endsection