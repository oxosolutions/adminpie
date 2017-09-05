@extends('layouts.main')
@section('content')
@php

if(!empty($data)){
$data = json_decode(json_encode($data->all()),true);
$keys = array_keys($data[0]);
}
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Survey Results',
    'add_new' => '+ Add Media'
); 
$id = "";
@endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.survey._tabs')
@if(!empty($data))
<style>
   table  td , th{
            border:1px solid lightgray;
    }

    #table-structure{
    	max-width: 1080px;
    	overflow: scroll;
    	font-weight: 300;

    }
    #table-structure tr {
    transition: background 0.2s ease-in;
}

#table-structure tr:nth-child(odd) {
    background: #CCE5A3;
    /*background: #FF9A00;*/
}

#table-structure tr:hover {
    background: #8bc34a;
    cursor: pointer;
}



 /*tr:nth-child(even) {background: #CCC}
 tr:nth-child(odd) {background: #FFF}*/
</style>

	<div id="table-structure">
		<table>
	        <thead>
				<tr>
				@foreach($keys as $key =>$val)
					<th>{{$val}} <br>
						@if($val!='id')
							@if(strlen($formQuestion[$val])>70)
									({{substr($formQuestion[$val],0,20)}} <a id='{{$val}}' class="see_more" style="color:blue;" >..see more)</a> 
									<span id="more_{{$val}}" class='close'>{{substr($formQuestion[$val],20,100)}})</span>
							@else
									({{$formQuestion[$val]}})
							@endif
						@endif
					</th>
					
				@endforeach
				</tr>
	        </thead>

	        <tbody>
	        @foreach($data as $keys => $vals )
				<tr>
					@foreach($vals as $queKey => $queVal)
					<td>{{$queVal}}</td>
					
					@endforeach
				</tr>
			@endforeach
				
	        </tbody>
	    </table>
            
	</div>

	@else
	<div><h2> No Data Exist</h2></div>
@endif
<script>
	$(".close").hide();
$( "a" ).click(function( event ) {
  event.preventDefault();
  id = $(this).attr('id');
   $(this).hide();
  $("#more_"+id).show();
});
 	
</script>

@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection