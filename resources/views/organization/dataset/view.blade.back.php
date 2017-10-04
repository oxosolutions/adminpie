@php
	$ArrayData = App\Model\Organization\Dataset::getDatasetTableData(request()->route()->parameters()['id']);
	$records = $ArrayData['records'];
	$headers = $ArrayData['headers'];
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
</style>
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset: '.$ArrayData['dataset_name'],
	'add_new' => '+ Add Role'
	); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.dataset._tabs')
	{{dd($dataset)}}
	{{-- <div>
		<ul class="handson-table-button">
			<li>
				<a href="">Add<i class="material-icons dp48">expand_more</i></a>
				<div class="aione-options">
					
				</div>
			</li>
			<li><a href="">Edit<i class="material-icons dp48">expand_more</i></a><div class="aione-options"></div></li>
			<li><a href="">Sort<i class="material-icons dp48">expand_more</i></a><div class="aione-options"></div></li>
			<li><a href="">Delete<i class="material-icons dp48">expand_more</i></a><div class="aione-options"></div></li>
			<li><a href="">Add Formula<i class="material-icons dp48">expand_more</i></a><div class="aione-options"></div></li>
			<li><a href="">Edit Structure<i class="material-icons dp48">expand_more</i></a><div class="aione-options"></div></li>
			<li><a href="">Create Subset<i class="material-icons dp48">expand_more</i></a><div class="aione-options"></div></li>
			
		</ul>
	</div> --}}
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
	    readOnly: true,
	    minSpareRows: 1,
	    contextMenu: ['row_above','row_below','---------','col_right','---------','remove_row','remove_row','---------','undo','redo','---------','make_read_only','alignment'],
	    afterChange: function(changes, source){
	    	if(source == 'edit'){
	    		changedDataRecords.push(hot2.getData()[changes[0][0]]);
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





<style type="text/css">
	.htMenu {
		font-size: 14px !important;
	}
</style>
@endsection