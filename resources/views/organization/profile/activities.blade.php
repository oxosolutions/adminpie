@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
'show_page_title' => 'yes',
'show_add_new_button' => 'no',
'show_navigation' => 'yes',
'page_title' => 'Recent Activities',
'add_new' => ''
);
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

@include('organization.profile._tabs')

@if(!$user_log->isEmpty())
<ul class="aione-border mb-10">
    @foreach($user_log as $key => $value)
    <li>
        <div class="ar pv-20 ph-10 aione-border-bottom ">
            <div class="ac l80">
                @foreach(json_decode($value->text) as $k => $val)
                @if($loop->index == 0 )
                {{str_replace('{id?}','id',$val)}}
                @endif
                @endforeach
            </div>
            <div class="ac l20 aione-float-right">
                {{Carbon\Carbon::parse($value->created_at)->diffForHumans()}}
            </div>
        </div>
    </li>
    
    {{-- <div class="col l1 blue white-text center-align date">
        <div class="row month mb-0" >
            {{date_format($value->created_at , "M")}}
        </div>
        <div class="row day mb-0" >
            {{date_format($value->created_at , "d")}}
        </div>
    </div> --}}
    
    
    
    
    
    @endforeach
</ul>
@else
<div class="aione-message warning">
    No recent activity found
</div>
@endif
{{$user_log->render()}}

@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection