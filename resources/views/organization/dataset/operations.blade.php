@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset Define <span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add Role'
	); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    @include('organization.dataset._tabs')
   {{--  <button onclick="window.location.href='{{route('export.dataset',['id'=>request()->route()->parameters()['id'],'type'=>'xls'])}}'">Export as XLS</button>
    <button onclick="window.location.href='{{route('export.dataset',['id'=>request()->route()->parameters()['id'],'type'=>'csv'])}}'">Export as CSV</button>
    <button onclick="window.location.href='{{route('clone.dataset',request()->route()->parameters()['id'])}}'">Clone</button>
    <button>Merge Dataset</button>
 --}}
    <nav id="aione_nav" class="aione-nav horizontal light custom-option-menu">
            <div class="aione-nav-background"></div>
            <ul id="aione_menu" class="aione-menu custom-aione-menu">
                
            
                <li class="aione-nav-item level0 bg-light-blue bg-darken-3 " style="margin-right: 15px"> 
                    <a class="white ph-50 export" style="width: 140px;color: white;text-align: center" >Export</a>
                    <ul class="side-bar-submenu">
                        <li class="aione-nav-item level1 "> 
                            <a onclick="window.location.href='{{route('export.dataset',['id'=>request()->route()->parameters()['id'],'type'=>'xls'])}}'">Export as XLS</a>
                        </li>
                        <li class="aione-nav-item level1 "> 
                            <a onclick="window.location.href='{{route('export.dataset',['id'=>request()->route()->parameters()['id'],'type'=>'csv'])}}'">Export as CSV</a>
                        </li>
                    </ul>
                </li>
                <li class="aione-nav-item level0 bg-cyan bg-darken-1 "> 
                    <a class="white clone" style="width: 140px;color: white;text-align: center" onclick="window.location.href='{{route('clone.dataset',request()->route()->parameters()['id'])}}'">Clone</a>
                </li>
            </ul>
            <div class="aione-nav-toggle">
                <a href="#" class="nav-toggle "></a>
            </div>
            <div class="clear"></div>
        </nav>

@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection