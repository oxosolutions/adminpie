<?php if(Auth::guard('admin')->check() == true): ?>
  <?php 
        $from = 'admin';
        $layout = 'admin.layouts.main';
        $route = 'admin.custom.save.pages';
   ?>
<?php else: ?>
  <?php 
        $from = 'org';
        $layout = 'layouts.main';
        $route = 'save.page.settings';
   ?>
<?php endif; ?>


<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Media',
	'add_new' => '+ Add Media'
); 
	$id = "";
  
	 ?>	
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="row" style="margin: 0;height: inherit">
        <div class="col l8 gallery high" style="border-right: 1px solid #a9a9a9;height: 100%;overflow: auto;padding:20px">
            <div class="aione-tile-view" id="files" >
                <?php echo $__env->make('common.gallery',$model, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
        <div class="col l4 gallery-form" style="height: 100%;overflow: auto">
            <form id="gallery-form">
                <img src="<?php echo e(asset('media/')); ?>" width="100%">
                
                <?php echo FormGenerator::GenerateForm('survey_add_media_popup_form'); ?>

                <input type="hidden" name="gallery-id" value="">
            </form>
        </div>
    </div>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <input type="file" id="upload" name="upload" style="visibility: hidden; width: 1px; height: 1px" multiple />
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
    .high{
        width: 100% !important;
    }
    .gallery-item-high{
        width: 14% !important;
    }
    .gallery-item-small{
        width: 23% !important;
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
            if('<?php echo e($from); ?>' == 'admin'){
                url = 'create/media';
            }else{
                url = 'media/create';
            }                 
            $.ajax({
                    url: route()+'/'+url, 
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
                url: route()+'/gallery', 
                headers: {'X-CSRF-TOKEN': Laravel.csrfToken },
                type: 'get',
                success: function(res){
                    $('#files').html('');
                    $('#files').append(res);
                }
            });

        });   
        $(document).on('click','#gallery-form .aione-button',function(e){
            e.preventDefault();
            e.stoppropagation();
            var data = $('#gallery-form').serialize();
             if('<?php echo e($from); ?>' == 'admin'){
                url = 'update/media/infos';
            }else{
                url = 'update/media/info';
            }
            $.ajax({
               
                url : route()+'/'+url,
                type : 'POST',
                data : {request : data , _token : $('input[name=_token]').val()},
                success : function (res) {
                    if(res == 'true'){
                        Materialize.toast('Saved Successfully' ,4000);
                    }
                }
            });
        });

        $('.gallery-form').hide();
         if($('.gallery').hasClass('high')){
            $('.gallery-item').addClass('gallery-item-high')
        }
        $(document).on('click','.gallery-item',function(){
            $('.gallery-form').show();
            $('.gallery').removeClass('high');
            $('.gallery-item').removeClass('gallery-item-high')
            $('.gallery-item').addClass('gallery-item-small')
            $('.gallery').addClass('small');

            var id = $(this).attr('gallery-item-id');
            $(this).addClass('selected');
            $(this).siblings().removeClass('selected');
            var url  = '';
            if('<?php echo e($from); ?>' == 'admin'){
               url = 'gallery-items';
            }else{
               url = 'gallery-item';
            }

            console.log(route()+'/'+url);

            $.ajax({
                type : 'POST',
                url : route()+'/'+url,
                data : { id : id , test : 'test'},
                success : function(res){
                    console.log(res);
                    $('#gallery-form > img').attr('src','');
                    var url = $('#gallery-form > img').attr('src');
                    $('#gallery-form > img').attr('src',url+'/media/'+res.original_name);
                    $('.gallery-form').find('input[name=alt_text]').val(res.alt_text);
                    $('.gallery-form').find('input[name=caption]').val(res.caption);
                    $('.gallery-form').find('input[name=slug]').val(res.slug);
                    $('.gallery-form').find('textarea[name=description]').val(res.description);
                    $('.gallery-form').find('input[name=link_to]').val(res.link_to);
                    $('.gallery-form').find('input[name=title]').val(res.original_name);
                    $('.gallery-form').find('input[name=gallery-id]').val(res.id);
                        if(res.extension == "mp3"){
                            var url = "<?php echo e(asset('/media')); ?>";
                            $('.audio > source').attr('src' , url+'/'+res.original_name);
                        }
                        if(res.extension == "mp4"){
                            var url = "<?php echo e(asset('/media')); ?>";
                            $('.video > source').attr('src' , url+'/'+res.original_name);
                        }
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
                url : route()+'/gallery/save',
                type : 'post',
                data : {formData : formData , _token : $('input[name=_token]').val()},
                success : function(res){

                }
            });

        });

        // e.preventDefault();
        //     var data = [];
        //         $('#gallery-form input , #gallery-form textarea').each(function(value){
        //             data[$(this).attr('name')] = $(this).val();
        //             data['gallery-id'] = $("input[name=gallery-id]").val();
        //         });
        //     $.ajax({
        //         url : '/update/media/info',
        //         type : 'POST',
        //         data : {request : data , _token : $('input[name=_token]').val()},
        //         success : function (res) {
        //             console.log(res);
        //         }
        //     });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>