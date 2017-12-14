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
		width: 100%;overflow-x: scroll;overflow-y: scroll;max-height: 500px;margin-bottom: 20px
	}
/*	td{
		    white-space: nowrap;
    text-overflow: ellipsis;
    max-width: 150px;
    overflow: hidden;
	}*/
	.custom-option-menu{
		    width: 300px;
    position: absolute;
    right: 0;
    top: -60px;
    border-bottom: none !important;
	}
	.aione-nav.horizontal > ul > li > .export:hover{
		background-color:#0277bd;

	}
	.aione-nav.horizontal > ul > li > .clone:hover{
		background-color:#00acc1;

	}
</style>
@php

	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset View <span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add Role'
	); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.dataset._tabs')
    @if(!empty($dataset))
        <div style="position: relative;">
        <nav id="aione_nav" class="aione-nav horizontal light custom-option-menu">
            <div class="aione-nav-background"></div>
            <ul id="aione_menu" class="aione-menu custom-aione-menu">
                
            
                <li class="aione-nav-item level0 bg-light-blue bg-darken-3 " style="margin-right: 15px"> 
                    <a class="white ph-50 export" style="width: 140px;color: white;text-align: center" >Export</a>
                    <ul class="side-bar-submenu">
                        <li class="aione-nav-item level1 "> 
                            <a onclick="window.location.href='{{route('export.dataset',['id'=>$dataset['id'],'type'=>'xls'])}}'">Export as XLS</a>
                        </li>
                        <li class="aione-nav-item level1 "> 
                            <a onclick="window.location.href='{{route('export.dataset',['id'=>$dataset['id'],'type'=>'csv'])}}'">Export as CSV</a>
                        </li>
                    </ul>
                </li>
                <li class="aione-nav-item level0 bg-cyan bg-darken-1 "> 
                    <a class="white clone" style="width: 140px;color: white;text-align: center" onclick="window.location.href='{{route('clone.dataset',$dataset['id'])}}'">Clone</a>
                </li>
            </ul>
            <div class="aione-nav-toggle">
                <a href="#" class="nav-toggle "></a>
            </div>
            <div class="clear"></div>
        </nav>
        <div id="example2" style="width: 100%; font-size: 14px;">
            
        </div>
        <a href="javascript:;" class="btn blue save_dataset" style="margin-top: 3%; display: none;">Update Dataset</a> 


        
        <div class="aione-table" {{-- style="width: 99%;overflow-x: scroll;overflow-y: scroll;max-height: 500px;margin-bottom: 20px" --}}>
        <div class="aione-float-right">
            {{-- <button class="aione-button" onclick="window.location.href='{{route('export.dataset',['id'=>$dataset['id'],'type'=>'xls'])}}'">Export XLS</button>
            <button class="aione-button" onclick="window.location.href='{{route('export.dataset',['id'=>$dataset['id'],'type'=>'csv'])}}'">Export CSV</button> --}}
            {{-- <button class="aione-button" onclick="window.location.href='{{route('clone.dataset',$dataset['id'])}}'">Clone</button>
            <button class="aione-button" onclick="window.location.href='{{route('clone.dataset',$dataset['id'])}}'">Export</button> --}}

        </div>
        
        {{-- <button class="aione-button" onclick="window.location.href='{{route('duplicate.dataset',$dataset['id'])}}'">Find duplicate records</button> --}}
        {{-- <div class="add-dataset" style="margin: 20px 0">
            {!!Form::open(['route'=>['create.column',request()->route()->parameters()['id']]])!!}
        
                {!! FormGenerator::GenerateForm('create_column_dataset') !!}
            
            {!!Form::close()!!}
            <div id="example2" style="width: 100%; font-size: 14px;">
                
            </div>  
                
        </div> --}}

        @if(@request()->route()->parameters['action'] == 'rivisions')
            @php

                $headers = (array) $tableheaders;

                $history_data = (array) $history->toArray();

                array_unshift($history_data, $headers);

                $history_records = array();
                foreach ($history_data as $column_key => $columns) {
                    foreach ($columns as $row => $record) {
                        $history_records[$row][$column_key] = $record;
                    }
                    unset($history_records['id']);
                    unset($history_records['status']);
                    unset($history_records['parent']);
                }

            @endphp

            <div class="aione-table" style="margin-bottom: 20px">

                <table class="compact dataset-table" >
                    <thead>
                        <tr>
                            @foreach($history_data as $key => $value)
                                @if($key == 0)
                                    <th> Column </th>
                                @else
                                    <th> Revision_{{$key}} </th>
                                @endif
                            @endforeach
                        </tr>
                        
                    </thead>
                    <tbody>
                        @foreach($history_records as $row_key => $row)
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

        @if(@request()->route()->parameters['action'] == 'view')
            <div class="aione-table" style="margin-bottom: 20px">
                <table class="compact">
                    <thead>
                        <tr>
                            <td>Key</td>
                            <td>Value</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tableheaders as $k => $rows)
                            @if(!in_array($k,['id','status','parent']))
                                <tr>
                                    <td width="400px">{{$rows}}</td>
                                    <td>{{ $viewrecords[0]->{$k} }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if(@request()->route()->parameters['action'] == 'edit')
            <form action="{{route('dataset.update')}}" method="POST" class="aione-table">
                {{csrf_field()}}
                <input type="hidden" name="dataset_id" value="{{ request()->route()->parameters()['id'] }}">
                <table class="compact">
                    <thead>
                        <tr>
                            <td>Key</td>
                            <td>Value</td>
                        </tr>
                    </thead>
                    <tbody>
                            
                        @foreach($tableheaders as $k => $rows)
                            @if(!in_array($k,['id','status','parent']))
                                <tr>
                                    <td width="400px">{{$rows}}</td>
                                    <td>
                                        <div id="field_{{$k}}" class="field-wrapper field-wrapper-{{$k}} field-wrapper-type-text ">
                                            <div id="field_{{$k}}" class="field field-type-text" style="padding: 0">
                                                <input type="text" value="{{ $viewrecords[0]->{$k} }}" name="{{$k}}" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                <input type="hidden" value="{{ $viewrecords[0]->{$k} }}" name="{{$k}}" />
                            @endif
                        @endforeach

                    </tbody>
                </table>
                <input type="submit" name="update_data" value="Update Record" />
            </form>
        @endif
        <div>
            <table class="compact">
                <thead>
                    <tr>
                        <td>Key</td>
                        <td>Value</td>
                    </tr>
                </thead>
                <tbody class="addNewDatasetRow">
                    
                </tbody>

            </table>
                    <button class="AddNewDatasetRowButton hidden " >Update Dataset</button>

        </div>
        <button class="addRow aione-button aione-float-right mv-10" >Add Row</button>
        @if(!empty($tableheaders))
            <div class="mv-10 line-height-32">Showing 1 to 47 of total 47 records</div>
            <div style="" class="table-wrapper">
                <table class="compact dataset-table" >
                    <thead>
                        <tr>
                            <th>
                                Action
                            </th>
                            @foreach($tableheaders as $k => $header)
                                @if(!in_array($k,['id','status','parent']))
                                    <th>
                                        {{$header}}
                                    </th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($records))
                            @foreach($records as $k => $rows)
                                <tr>
                                    <td>
                                        <a href="{{route('view.dataset',['id'=>$dataset->id,'action'=>'view','record_id'=>$rows->id])}}"><i class="fa fa-eye"></i></a>
                                        <a href="{{route('view.dataset',['id'=>$dataset->id,'action'=>'edit','record_id'=>$rows->id])}}"><i class="fa fa-pencil"></i></a>
                                        <a href="{{route('delete.record',['id'=>$dataset->id,'record_id'=>$rows->id])}}" class="delete-row"><i class="fa fa-trash " style="color: red"></i></a>
                                        <a href="{{route('view.dataset',['id'=>$dataset->id,'action'=>'rivisions','record_id'=>$rows->id])}}"><i class="fa fa-history"></i></a>
                                         <script type="text/javascript">
                                                $(document).on('click','.delete-row',function(e){
                                                    e.preventDefault();
                                                    var href = $(this).attr("href");

                                                    swal({   
                                                        title: "Are you sure?",   
                                                        text: "You will not be able to recover this row!",   
                                                        type: "warning",   
                                                        showCancelButton: true,   
                                                        confirmButtonColor: "#DD6B55",   
                                                        confirmButtonText: "Yes, delete it!",   
                                                        closeOnConfirm: false 
                                                    }, 
                                                    function(){
                                                    window.location = href;
                                                       swal("Deleted!", "Your Row has been deleted.", "success"); 
                                                   });
                                                })
                                            </script>
                                    </td>
                                    @foreach($rows as $key => $value)
                                        @if(!in_array($key,['id','status','parent']))
                                            <td class="aione-tooltip" title="{{$value}}">
                                                <span class="truncate">
                                                    {{$value}}  
                                                </span>
                                                
                                            </td>
                                        @endif
                                    @endforeach 
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            
            <div>
                <button class="update-dataset hidden">Update Dataset</button>
            </div>
        @endif

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="dataset_id" value="{{ request()->route()->parameters()['id'] }}">
    </div>
    {{$records->render()}}
    @else
        <div class="aione-message warning">
            <i class="fa fa-info-circle" style="font-size: 20px;"></i> Dataset table not found!
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
	/*.custom-aione-menu{
		    float: right;
    position: absolute;
    right: 0;
    margin-top: -64px !important;
    margin-right: 20px !important;
	}*/
</style>
<script type="text/javascript">
	$(document).ready(function(){
		// $(document).on('click' , '.addRow' ,function(){
		// 	var headerCount = $('.dataset-table tr th').length;
		// 	$('.dataset-table tbody').prepend('<tr class="appended_row"></tr>');

		// 	for(var i=0; i <=headerCount-1 ; i++){
		// 		$('.appended_row:first').append('<td contenteditable="true"></td>');
		// 	}
		// 	$('.update-dataset').show();
		// 	$('.appended_row td:first').removeAttr('contenteditable');
		// });
		$(document).on('click' , '.addRow' ,function(){
			var th = [];
			var countTh = $('.dataset-table').find('th').length;
			$.each($('.dataset-table').find('th'),function(value){
			th.push($(this).html());
			});
			th = th.slice(1);
			$(th).each(function(key , value){
				$('.addNewDatasetRow').append('<tr><td width="400px" class="label">'+value+'</td><td><input type="text" class="add-new-value" /></td></tr>');
				$('.addRow').hide();
				$('.AddNewDatasetRowButton').show();
			});
		});

		$(document).on('click','.AddNewDatasetRowButton',function(){
			var data = [];
			$.each($(this).siblings('table').find('tr'),function(){
				if($(this).find('.label').html() != undefined || $(this).find('.add-new-value').val() != undefined){
					// console.log($(this).find('.label').html());
					data.push($(this).find('.add-new-value').val());
				}
			});

			$.ajax({
					url 	: route()+'/dataset/create/rows',
					type 	: "POST",
					data 	: { data : data , _token : $('input[name=_token]').val() , dataset_id : $('input[name=dataset_id]').val()},
					success : function(res){
						Materialize.toast('Updated Successfully',4000);
						window.location.reload();
					}
				});
		// alert('rahul sir is working on dataset controller i will do this later -- sandeep');
		});
		$(document).on('click','.update-dataset',function(){
			var index = 0;
			var data = [];
			
				$('.update-dataset').parent().siblings('.table-wrapper').find('.appended_row').each(function($i){
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
				});
			// alert('rahul sir is working on dataset controller i will do this later -- sandeep');
		});		
	});
</script>
</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection