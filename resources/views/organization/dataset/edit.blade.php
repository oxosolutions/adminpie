@php
	$ArrayData = App\Model\Organization\Dataset::getDatasetTableData(request()->route()->parameters()['id']);
    if($ArrayData != false){
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
    }
@endphp
@extends('layouts.main')
@section('content')

@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset Edit <span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add Role'
	); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    @include('organization.dataset._tabs')
    <div class="aione-accordion custom-accordion">
        <div class="aione-border mb-20 aione-item">
            <div class="aione-item-header bg-grey bg-lighten-3 aione-border-bottom  font-size-17  ">
                Edit Dataset Details
                <i class="fa fa-chevron-down aione-float-right"></i>
            </div>
            <div class="aione-item-content">
                {!! Form::model($dataset,['route'=>['update.dataset.details',$dataset->id]]) !!}
                    {!! FormGenerator::GenerateForm('edit_dataset_form') !!}
                {!! Form::close() !!}      
            </div>
        </div>
      {{--   <div class="aione-item">
            <div class="aione-item-header">
                Create Column
            </div>
            <div class="aione-item-content">
                {!!Form::open(['route'=>['create.column',request()->route()->parameters()['id']]])!!}
        
                    {!! FormGenerator::GenerateForm('create_column_dataset') !!}
                
                {!!Form::close()!!}      
            </div>
        </div> --}}
            {{-- <div class="aione-item">
                <div class="aione-item-header">
                    Define Dataset
                </div>
                <div class="aione-item-content">
                    <div class="aione-table">
                        <table class="compact">
                            <thead>
                                <tr>
                                    <td>Column name</td>
                                    <td>Edit header</td>
                                    <td>Column type</td>
                                    <td>Action</td>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach($columns->toArray() as $key => $columnName)
                                    <tr>
                                        <td width="300">{{$columnName}}</td>
                                        <td width="300">
                                            <div class="field field-type-text">
                                                <input type="text" name="header[{{$key}}]" value="{{$columnName}}" class="browser-default" />
                                            </div>
                                        </td>
                                        <td>
                                       
                                        {!!Form::select($key,
                                                [   "/^[\s\S]*$/" =>   'Text',
                                                    "/^[a-zA-Z ]*$/" =>   'String(Only Alphabets)',
                                                    '/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26]php)00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/' =>  'Date',
                                                '/^[0-9]*$/'                    =>  'Number',
                                                '/^[0-9]+(\.[0-9]{1,5})?$/'     =>  'Integer',
                                                '/^\d*[02468]$/'                =>  'Even Number',
                                                '/^\d*[13579]$/'                =>  'Odd Number',
                                                '/^\d{10}$/'                    =>  'Mobile Number(10 Digit Only)',
                                                //'area_code'                    =>  'Area Code'
                                                ],null,['class'=>'browser-default'])!!}     
                                        <!--  Code BY : Amrit END-->    

                                        </td>
                                        <td><a href="{{ route('delete.column',[request()->route()->id ,$key]) }}"><i class="fa fa-trash" style="color: red"></i></a></td>
                                    </tr>
                                @endforeach       
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
        <div class="aione-border">
            <div class="bg-grey bg-lighten-3 aione-border-bottom p-15 font-size-17  " style="position: relative;">
            
                Edit Dataset
                <button href="javascript:;" class=" aione-float-right  save_dataset" disabled style="margin-top: -8px; position: absolute;right: 5px;padding:5px ">Update Dataset</button> 

            </div>
            <div class="custom-scroll" style="overflow: hidden;">
                
                @if($ArrayData != false)
                   
                    
                
                <div id="example2" style="width: 100%; font-size: 14px;">
                    
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
                            // $('.save_dataset').fadeIn(200);
                            $( ".save_dataset" ).prop( "disabled", false );
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
                                // $('.save_dataset').fadeOut(200);
                                $('.save_dataset').prop( "disabled", true );
                                  // M.toast({html: 'I am a toast!'})
                                  Materialize.toast("Saved Successfully");

                            }
                        });
                    });
                    // $('#field_3091')
                  });
                  $('.handson-table-button > li > a').click(function(e){
                    e.preventDefault();
                    $(this).parent().toggleClass('active');
                    $(this).parent().siblings().removeClass('active');
                  });
                  $("#aione_form_section_533").addClass('active');
                  $("#aione_form_section_372").addClass('active');
                  //to open modal
                    //$('#modal1').modal('open');

            </script>


            {{-- Code For Create Dataset Column By Rahul --}}
                <style type="text/css">
                    #field_3091,#field_3092, #field_3093, #field_3094, #field_3095,#field_3096{
                        display: none;
                    }
                    .ht_master .wtHolder{
                        overflow: auto !important;
                        min-height: 400px;
                        max-height: 400px;
                    }
                    .custom-scroll ::-webkit-scrollbar-track {
                        background-clip: padding-box;
                        border: solid transparent;
                        border-width: 0 0 0 4px;
                    }
                    .custom-scroll ::-webkit-scrollbar-thumb {
                        background-color: rgba(0,0,0,.2);
                        background-clip: padding-box;
                        border: solid transparent;
                        min-height: 28px;
                        padding: none;
                        box-shadow: none;
                        border-width: 1px 1px 1px 1px;
                        }
                        .custom-scroll ::-webkit-scrollbar-corner {
                        border-width: 1px 0 0 1px;
                    }
                    .custom-scroll ::-webkit-scrollbar-corner {
                        border: 1px solid #d9d9d9;
                    }
                    .custom-scroll ::-webkit-scrollbar-corner {
                        background: transparent;
                    }
                    .custom-accordion .aione-item .aione-item-header{
                        padding: 15px;
                    }
                    .custom-accordion .aione-item.active .aione-item-header .fa{
                        transform: rotate(180deg);
                    }
                    .custom-accordion .aione-item .aione-item-header:before,
                    .custom-accordion .aione-item .aione-item-header:after{
                        content: '';
                        border: none
                    }


                    button:disabled,
                    button[disabled]{
                        border: 1px solid #999999;
                        background-color: #cccccc;
                        color: #999;
                    }
                </style>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#field_3090 input').click(function(){
                            if($(this).val() == 'static_value'){
                                $('#field_3091').show();
                                $('#field_3092, #field_3093, #field_3094, #field_3095, #field_3096').hide();
                            }else if($(this).val() == 'value_with_refrence'){
                                $('#field_3091, #field_3096').hide();
                                $('#field_3092, #field_3093, #field_3094, #field_3095').show();
                            }else if($(this).val() == 'formula'){
                                $('#field_3096').show();
                                $('#field_3092, #field_3093, #field_3094, #field_3095').hide();
                            }
                        });

                        // dataset/columns
                        $('#field_3093 select').change(function(){
                            $.ajax({
                                type:'GET',
                                url: route()+'/dataset/columns',
                                data: {dataset:$(this).val()},
                                success: function(result){
                                    $('#field_3094 select').html(result);
                                    $('#field_3095 select').html(result);
                                }
                            });
                        });
                    });
                </script>

                @else
                    <div class="aione-message warning">
                        <i class="fa fa-info-circle" style="font-size: 20px;"></i> Dataset table not found!
                    </div>
                @endif
            </div>
        </div>
    </div>



	
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection