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
<table>
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
</table>

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection

