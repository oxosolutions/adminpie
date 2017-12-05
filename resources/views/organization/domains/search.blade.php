@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Search Domain'
); 
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    {!! Form::open() !!}
	   {!! FormGenerator::GenerateForm('domain_search') !!}
    {!! Form::close() !!}
    
    @if(!empty($result))
      
        <div class="aione-table">
            <table>
                <thead>
                    <tr>
                        <th width="300">Domain</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($result['response'] as $key => $domain)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>
                                @if($domain->status == 'available')
                                    <span class="bg-cyan white p-5 display-inline-block mb-5" style="cursor: pointer;">Available</span>
                                @else
                                    <span class="bg-red white p-5 display-inline-block mb-5" style="cursor: pointer;">Un-available</span>
                                @endif
                            </td>
                            <td>
                                {!! Form::open(['route'=>'place.order','id'=>'place_order']) !!}
                                    {!! Form::hidden('domain',$key) !!}
                                    @if($domain->status == 'available')
                                        <a href="#" class="aione-tooltip" title="Place Order" onclick="document.getElementById('place_order').submit()">
                                            <i class="fa fa-cart-plus font-size-30" style="color: green; width: 40%;"></i>
                                        </a>
                                    @else
                                        <i class="fa fa-close font-size-30" style="color: red"></i>
                                    @endif
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
    @endif
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection