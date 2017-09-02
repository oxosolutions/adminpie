@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Media',
	'add_new' => '+ Add Media'
); 
	$id = "";
  
	@endphp	
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    <div class="row" style="margin: 0;height: inherit">
        <div class="col l8" style="border-right: 1px solid #a9a9a9;height: 100%;overflow: auto;padding:20px">
            <div class="aione-tile-view" id="files" >
                @include('common.gallery',$model)
            </div>
        </div>
        <div class="col l4 gallery-form" style="height: 100%;overflow: auto">
            <form id="gallery-form">
                {!! FormGenerator::GenerateForm('survey_add_media_popup_form') !!}
                <input type="hidden" name="gallery-id" value="">
            </form>
        </div>
    </div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
    <input type="file" id="upload" name="upload" style="visibility: hidden; width: 1px; height: 1px" multiple />
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<style type="text/css">
    .aione-tile-view > div{
        width: 23%;
        float: left;
        margin-right: 2%;
        margin-bottom: 1%
    }
    .aione-tile-view > div .desc{
        padding:10px 5px;
           
    margin-top: -3px;
    }
    .aione-tile-view > div >img{
        height: 120px;
        width: 100%;
    }
    .aione-tile-view > div .size{
        color: #757575;
    }
    .aione-tile-view .icon-logo{
        font-size: 80px;
        color: #a9a9a9;
    }
    .aione-media-modal{
        max-height: 80% !important;
        width: 92% !important;
    }
    .modal.modal-fixed-footer{
        height: 80%;
    }
    .selected{
        position: relative;
    }
    .selected > img{
        border: 4px solid #2196F3;
    }
    .selected .desc{
         background-color: #2196F3;
         color: white;
    }
    .selected:after{
        content: "\f00c";
        font-family: FontAwesome;
        font-style: normal;
        font-weight: normal;
        text-decoration: inherit;
    
        color: #2196F3;
        font-size: 24px;
        padding-right: 0.5em;
        position: absolute;
        top: 10px;
        right: 0;
    }
    .icon-wrapper{
          height: 120px;
        width: 100%;
        background-color: #e8e8e8;
    }
    .icon-wrapper i{
        padding:10px;
    }
</style>

<script type="text/javascript">

    $('.add-new-button').click(function(){
        $('#upload').click();
    })
    
    $('#add_media').modal();
    $('.options').parents('.repeater-group').parent().hide();   
    $('.field-type').change(function(){
        if($(this).val()=="checkbox" || $(this).val()=="radio" || $(this).val()=="select"){
            $('.options').parents('.repeater-group').parent().show();
        }
        else{
            $('.options').parents('.repeater-group').parent().hide();   
        }
    });
    $('.regex-wrapper').parents('.field-wrapper').hide();
    $('.show-hide-regex').change(function(){
        if($(this).val()=="other"){
            $('.regex-wrapper').parents('.field-wrapper').show();
        }
        else{
            $('.regex-wrapper').parents('.field-wrapper').hide();
        }
    });
    $(document).on('click','.add-another-option',function(e){
        e.preventDefault();
        var html='<div class="option">'+$('.options > .option ').html()+'<a href="#" class="delete-current"><i class="fa fa-close"></i></a></div>';
        $('.options').append(html);
    });
    $('.options').on('click','.delete-current',function(e){
        e.preventDefault();
        $(this).parents('.option').remove();
    });
    $('.aione-tile-view > div').click(function(){
        $(this).toggleClass('selected');
        $(this).siblings().removeClass('selected');
    })
</script>
<script type="text/javascript">
$.ajaxSetup({
   headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});
window.Laravel = <?php echo json_encode([
    'csrfToken' => csrf_token(),
]); ?>

    $(document).ready(function(){
      
        $('#upload').change(function(){
            var file_data = $('#upload').prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('file', file_data);
            form_data.append("_token", Laravel.csrfToken );
            console.log(form_data);                             
            $.ajax({
                    url: route()+'cms/media/create', 
                    dataType: 'text',
                    cache: false,
                     headers: {'X-CSRF-TOKEN': Laravel.csrfToken },
                    contentType: false,
                    processData: false,
                    data: form_data,                         
                    type: 'post',
                    success: function(res){
                        $('#files').html('');
                        $('#files').append(res);
                        if(res != ''){
                            Materialize.toast('File Upload Successfully',2000);
                        }
                    }
             });
        });
        $(document).on('click','#input_add_media',function(){
            
            $.ajax({
                url: route()+'cms/gallery', 
                headers: {'X-CSRF-TOKEN': Laravel.csrfToken },
                type: 'get',
                success: function(res){
                    $('#files').html('');
                    $('#files').append(res);
                }
            });

        });   
        $(document).on('click','.gallery-item',function(){
            var id = $(this).attr('gallery-item-id');
            $(this).addClass('selected');
            $(this).siblings().removeClass('selected');
            $.ajax({
                url : route()+'cms/gallery-item',
                type : 'post',
                data : { id : id , _token : $('input[name=_token]').val()},
                success : function(res){
                    console.log(res);
                    $('.gallery-form').find('input[name=title]').val(res.original_name);
                    $('.gallery-form').find('input[name=gallery-id]').val(res.id);
                }
            });
        });
        $(document).on('click','.save-gallery-details',function(){

            var formData = {};
            $('#gallery-form').find('input , textarea').each(function(){
                var key = $(this).attr('name');
                var value = $(this).val();

                formData[key] = value;
            });
            console.log(formData);
            $.ajax({
                url : route()+'cms/gallery/save',
                type : 'post',
                data : {formData : formData , _token : $('input[name=_token]').val()},
                success : function(res){

                }


            });
        });

    });
</script>
@endsection