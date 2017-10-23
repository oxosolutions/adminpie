@php
	$ArrayData = App\Model\Organization\Dataset::getDatasetTableData(request()->route()->parameters()['id']);
	$records = $ArrayData['records'];
	$headers = $ArrayData['headers'];
	$lastCount = count($headers);
	unset($headers[$lastCount-1]);
	unset($headers[$lastCount-2]);
	
	$newArray = [];

	foreach($records as $rKey => $rValue){
		$lastCount = count($rValue);
		unset($rValue[$lastCount-1]);
		unset($rValue[$lastCount-2]);
		$newArray[] = $rValue;
	}
	$records = $newArray;
	if(empty($records)){
		$tempArray = [];
		$index = 0;
		foreach($headers as $header){
			if($index == 0){
				$tempArray[] = $ArrayData['firstRecord']+1;
			}else{
				$tempArray[] = "";
			}
			$index++;
		}
		$records[] = $tempArray;
	}
	@$tableheaders->id = 'id';
@endphp
@extends('layouts.main')
@section('content')

@php
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
	{!!Form::open(['route'=>['create.column',request()->route()->parameters()['id']]])!!}
		
		{!! FormGenerator::GenerateForm('create_column_dataset') !!}
	
	{!!Form::close()!!}
	<div id="example2" style="width: 100%; font-size: 14px;">
		
	</div>	
	{!!$ArrayData['tableRecords']->render()!!}
	<a href="javascript:;" class="btn blue save_dataset" style="margin-top: 3%; display: none;">Update Dataset</a> 
<script type="text/javascript">
	window.changedDataRecords = [];
	var
	    hiddenData = {!!json_encode($records)!!},
	    container = document.getElementById('example2'),
	    hot2;

	  hot2 = new Handsontable(container, {
	    data: hiddenData,
	    colHeaders: true,
	    contextMenu: true,
	    rowHeaders: true,
	    modifyColWidth: 1000,
	    manualColumnResize: true,
    	manualRowResize: true,
	    colHeaders: {!!json_encode($headers)!!},
	    // columns: [{readOnly: true}],
	    minSpareRows: 1,
	    contextMenu: ['row_above','row_below','---------','col_right','---------','remove_row','remove_row','---------','undo','redo','---------','make_read_only','alignment'],
	    afterChange: function(changes, source){
	    	if(source == 'edit'){
	    		//console.log(changes[0]);
	    		var tableData = hot2.getData();
	    		if(tableData[changes[0][0]][0] == null){
	    			var newId = tableData[changes[0][0]-1][0];
	    			hot2.setDataAtCell(changes[0][0], 0, parseInt(newId)+1);
	    		}
	    		var status = false;
	    		var record = $.grep(changedDataRecords,function(value,key){
	    			if(value[0] == hot2.getData()[changes[0][0]][0]){
						status = true; 
						changedDataRecords[key] = hot2.getData()[changes[0][0]]; 				
	    			}
	    		});
	    		if(status == false){
	    			changedDataRecords.push(hot2.getData()[changes[0][0]]);
	    		}
	    		//console.log(changedDataRecords);
	    		$('.save_dataset').fadeIn(200);
	    	}
	    }
	    /*afterCreateRow: function(index,amount){
	    	console.log(index);
	    }*/
	  });

	  hot2.updateSettings({
	  	afterCreateCol: function(index, amount){
	    	// console.log(hot2.getColHeader(index))
	    	$('#modal1').modal('open');
	    	console.log(index);
	    }
	  });

	  hot2.updateSettings({
	  		cells: function(row, col, prop){
	  			var cellProperties = {};
	  			if(col == 0){
	  				cellProperties.readOnly = true;
	  			}
	  			return cellProperties;
	  		}
	  });
	  $(document).ready(function(){
   
	    $('.modal').modal();
	    $('.save_dataset').click(function(){
	    	$.ajax({
	    		type:'POST',
	    		url: '{{url('dataset/update')}}/{{request()->route()->parameters()['id']}}',
	    		data: { '_token': '{{csrf_token()}}','records': changedDataRecords },
	    		success: function(result){
	    			$('.save_dataset').fadeOut(200);
	    		}
	    	});
	    });
	  });
	  $('.handson-table-button > li > a').click(function(e){
	  	e.preventDefault();
	  	$(this).parent().toggleClass('active');
	  	$(this).parent().siblings().removeClass('active');
	  });
	  //to open modal
	    //$('#modal1').modal('open');

</script>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection