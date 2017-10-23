@extends('layouts.main')
@section('content')
@if(@$history != null)
	
@endif
<style type="text/css">

.handson-table-button{
	margin-bottom: 10px;
	height: 36px
}
	.handson-table-button > li > a{
		    line-height: 28px;
    border: 1px solid #CCCCCC;
    color: #282828;
    display: inline-block;
    padding: 0 16px;
    border-radius: 3px;
    background-color: #f9f9f9;
    font-size: 16px;
	}
	.handson-table-button > li > a > i{
		 vertical-align: bottom;
   		 line-height: 28px;
   		  color: #282828;
   		  font-size: 16px
	}
	
	.handson-table-button > li > a:hover{
		border-color: #999
	}
	.handson-table-button > li{
		float: left;
		    margin-right: 8px;
	}
	.handson-table-button > li > .aione-options{
		display: none;
		    height: 147px;
    width: 160px;
    border: 1px solid #e8e8e8;
    position: absolute;
    z-index: 999999;
    background-color: white;
        box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12),0 3px 1px -2px rgba(0,0,0,.2);
	}
	.handson-table-button > li.active > .aione-options{
		display: block;
	}
	.table-wrapper{
		width: 99%;overflow-x: scroll;overflow-y: scroll;max-height: 500px;margin-bottom: 20px
	}
/*	td{
		    white-space: nowrap;
    text-overflow: ellipsis;
    max-width: 150px;
    overflow: hidden;
	}*/
</style>
@php
//dump($duplicate_data);
//
	if(!empty($data['duplicate_data'])){
		$heads = json_decode(json_encode($data['duplicate_data'][0]),true);
	}
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset <span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add Role'
	); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.dataset._tabs')
	<div id="example2" style="width: 100%; font-size: 14px;">
		
	</div>
	<a href="javascript:;" class="btn blue save_dataset" style="margin-top: 3%; display: none;">Update Dataset</a> 
	@if(!empty($data['error']))
		<div class="aione-message warning">
			<p>{{$data['error']}}</p>
    	</div>
	@elseif(empty($data['duplicate_data']))
		<div class="aione-message warning">
			<p> No Duplicate Data found.</p>
    	</div>
	@else
	<div class="aione-table" style="margin-bottom: 20px">
	 <table class="compact dataset-table" >
	 	<thead>
	 		<tr>
	 			@foreach(array_keys($heads) as $key => $value)
	 				
	 					<th>{{$value}}</th> 
					
					
	 			@endforeach
			</tr>
	 		
	 	</thead>
	 	<tbody>
	 		@foreach($data['duplicate_data'] as $row_key => $row)
	 			<tr>
		 			@foreach($row as $column_key => $column_value)	
						<td>
							{{$column_value}}
						</td>
		 			@endforeach
	 			</tr>
	 		@endforeach
	 	</tbody>
	 </table>
	</div>
@endif



		
	

<style type="text/css">
	.pagination li{
		padding-left: 5px;
		padding-right: 8px;
		padding-bottom: 10px;
	}
	.hidden{
		display: none
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click' , '.addRow' ,function(){
			var headerCount = $('.dataset-table tr th').length;
			$('.dataset-table tbody').prepend('<tr class="appended_row"></tr>');

			for(var i=0; i <=headerCount-1 ; i++){
				$('.appended_row:first').append('<td contenteditable="true"></td>');
			}
			$('.update-dataset').show();
			$('.appended_row td:first').removeAttr('contenteditable');
		});
		$(document).on('click','.update-dataset',function(){
			var index = 0;
			var data = [];
			
				$('.update-dataset').parent().siblings('.dataset-table').find('.appended_row').each(function($i){
					var tableRow = [];
					$(this).find('td').each(function(){
						tableRow.push($(this).html());
					});
					data.push( tableRow);
				});
				
				$.ajax({
					url 	: route()+'/dataset/create/rows',
					type 	: "POST",
					data 	: { data : data , _token : $('input[name=_token]').val() , dataset_id : $('input[name=dataset_id]').val()},
					success : function(res){
						Materialize.toast('Updated Successfully',4000);
					}
				})
		});
	});
</script>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection