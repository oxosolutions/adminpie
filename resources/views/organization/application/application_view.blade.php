@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Application Detail',
); 
@endphp

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		<div class="aione-table">
            <table class="stripped">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>{{ $application->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $application->email }}</td>
                    </tr>
                    @foreach($application->applications->application_meta as $key => $value)
                        @if($value->key == 'application_attachment')
                            <tr>
                                <td>Resume</td>
                                <td><a href="{{ url('/').'/'.upload_path('application_attachments').'/'.$value->value }}">{{ $value->value }}</a></td>
                            </tr>
                        @else
                            <tr>
                                <td>{{ ucfirst($value->key) }}</td>
                                <td>{{ $value->value }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <br/>
        <a href="{{ route('list.applicantions') }}" class="aione-button">Go Back</a>
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
@endsection