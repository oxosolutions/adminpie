@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
'show_page_title' => 'yes',
'show_add_new_button' => 'no',
'show_navigation' => 'yes',
'page_title' => 'Dataset: name of dataset',
'add_new' => '+ Add Role'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	<div id="example2" style="width: 100%; font-size: 14px;">
		
	</div>
	<a href="javascript:;" class="btn blue save_dataset" style="margin-top: 3%; display: none;">Update Dataset</a> 
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

<div id="modal1" class="modal modal-fixed-footer">
	<div class="modal-header white-text  blue darken-1" ">
		<div class="row" style="padding:15px 10px;margin: 0px">
			<div class="col l7 left-align">
				<h5 style="margin:0px">Column Name</h5>	
			</div>
			<div class="col l5 right-align">
				<a href="javascript:;" name="closeModel" onclick="close()" id="closemodal" class="closeDialog close-model-button" style="color: white"><i class="fa fa-close"></i></a>
			</div>	
		</div>
	</div>
    <div class="modal-content">
    	<div class="col s12 m2 l12 aione-field-wrapper">
			 {!!Form::text('column_name',null,['class'=>'no-margin-bottom aione-field','placeholder'=>'Enter Column Name'])!!}
		</div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Save</a>
    </div>
</div>
@php
	$ArrayData = App\Model\Organization\Dataset::getDatasetTableData(request()->route()->parameters()['id']);
	$records = $ArrayData['records'];
	$headers = $ArrayData['headers'];
@endphp
{!!$ArrayData['tableRecords']->render()!!}
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
	    		//console.log(changes);
	    		changedDataRecords.push(hot2.getData()[changes[0][0]]);
	    		console.log(changedDataRecords);
	    		$('.save_dataset').fadeIn(200);
	    	}
	    }
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
	    			console.log(result);
	    		}
	    	});
	    });
	  });
	  //to open modal
	    //$('#modal1').modal('open');
</script>
<style type="text/css">
	.htMenu {
		font-size: 14px !important;
	}
</style>
@endsection