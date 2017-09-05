@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Stats',
    'add_new' => '+ Add Media'
); 
$id = "";
if(!empty($survey_data)){
    $sections = $survey_data[0]['section'];

}
@endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.survey._tabs')
<style>
                   table  td , th{
                            border:1px solid grey;
                    }
                </style>

	<h5>Groups</h5>
    @if(!empty($survey_data))
    <style>
    	.chead {
					width:240px;
					display: inline-block;
				}

    		.font-style{		
    				font-size: 16px;
					font-weight: 300;
				}
				.desc{
					width:140px;
					display: inline-block;
				}

				.field-font-style{
					font-size: 14px;
					font-weight: 300;
				}
    </style>
	    <ul class="collapsible" data-collapsible="accordion">
	    @foreach ($sections as $key => $value) 
		    <li>
		      <div class="collapsible-header"><i class="material-icons">filter_drama</i>{{$value['section_name']}}</div>
			    <div class="collapsible-body">
				    <span class="chead font-style">Questions </span> 
				    <span class="chead font-style">Type</span>
				    <span class="desc font-style">Description </span> 
				    <span class="chead font-style">Answer Option</span>
				</div>
		       @foreach($value['fields'] as $fieldKey => $fieldVal)
			      	<div class="collapsible-body">
			      		<span class="chead field-font-style" >{{$fieldVal['field_title']}}</span>
			      		<span class="chead field-font-style" >{{$fieldVal['field_type']}}</span> 
			      		<span class='desc field-font-style'>{{substr($fieldVal['field_description'], 90)}}</span>
						@php
		            		$collection = collect($fieldVal['field_meta'])->mapWithKeys(function($item){
		                		return [$item['key']=>$item['value']];
		            		});
							$meta = $collection->toArray();
	            		@endphp
	            		<span class="chead field-font-style">
		            		@foreach($meta as $metaKey=> $metaVal)
	            				@if($metaKey == 'field_options' && in_array($fieldVal['field_type'], ['radio','select','checkbox'])  )
	                				@foreach(json_decode($metaVal,true) as $optKey => $optVal)
										{{$loop->iteration}} {{$optVal['key']}}-{{$optVal['value']}}<br>
	                				@endforeach
	            				@endif
	            			@endforeach 
            			</span>
            			

		      		</div>
				@endforeach	
		    </li>
	    @endforeach
	  </ul>
	  @else
	      <h3> No Question Available </h3>

 @endif
	
{{-- <table>
	<tr>
		<th>Section</th>
		<th>Question</th>
		<th>Type</th>
		<th>Description</th>
		<th>Required</th>
		<th>Answer Option</th>
		<th>Created at</th>
	</tr>
	<tbody>
		
	

@if(!empty($survey_data))
    @foreach ($sections as $key => $value) 
        @foreach($value['fields'] as $fieldKey => $fieldVal)
        <tr>
      		<td>{{$value['section_name']}}</td>
			<td>{{$fieldVal['field_title']}}</td>
			<td>{{$fieldVal['field_type']}}</td>
			<td>{{$fieldVal['field_description']}}</td>
			@php 

	            $collection = collect($fieldVal['field_meta'])->mapWithKeys(function($item){
	                return [$item['key']=>$item['value']];
	            });
				$meta = $collection->toArray();
            @endphp
            <td>{{@$meta['required']  }}</td>
			
			<td>
            @foreach($meta as $metaKey=> $metaVal)
            @if($metaKey == 'field_options' && in_array($fieldVal['field_type'], ['radio','select','checkbox'])  )
                @foreach(json_decode($metaVal,true) as $optKey => $optVal)
						{{$loop->iteration}} {{$optVal['key']}}-{{$optVal['value']}}<br>
                @endforeach
            @endif
            @endforeach
           </td>
            <td>{{$fieldVal['created_at']}}</td>
		</tr>
        @endforeach

    @endforeach
    @else
    <h3> No Question Available </h3>
@endif

</tbody>
</table> --}}

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection

