@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Attendance List',
	'add_new' => '+ Add Designation'
);
@endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    <div>
       <div class="aione-form-wrapper aione-form-theme-light aione-form-label-position- aione-form-style- aione-form-border aione-form-field-border aione-form-section-border">
            <div  data-conditions="0" data-field-type="select" class="field-wrapper ac field-wrapper-group_id field-wrapper-type-select ">
                <div id="field_label_group_id" class="field-label">
                    <label for="input_group_id">
                        <h4 class="field-title" id="Select Group ID">Select year</h4>
                    </label>
                </div><!-- field label-->
                <div id="field_group_id" class="field field-type-select">
                    <select class="input_group_id browser-default " id="input_group_id" name="group_id">
                        <option value="">2011</option>
                        <option value="">2012</option>
                        <option value="">2013</option>
                        <option value="">2014</option>
                        <option value="">2015</option>
                        <option value="">2016</option>
                        <option value="">2017</option>
                        <option value="">2018</option>
                        <option value="">2019</option>
                        <option value="">2020</option>
                        <option value="">2021</option>
                        <option value="">2022</option>
                        <option value="">2023</option>
                        
                    </select>
                </div><!-- field -->
            </div>
            <!-- field wrapper -->

            <!-- .aione-row -->
        </div>
    </div>
    
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	
@include('common.page_content_secondry_end')
@include('common.pagecontentend')


@endsection