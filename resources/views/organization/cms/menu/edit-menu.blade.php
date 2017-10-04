@if(Auth::guard('admin')->check() == true)
  @php
        $from = 'admin';
        $layout = 'admin.layouts.main';
        $route = 'admin.category.update';
  @endphp
@else
  @php
        $from = 'org';
        $layout = 'layouts.main';
        $route = 'category.update';
  @endphp
@endif
@extends($layout)

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simple-iconpicker.min.css') }}">
    <script type="text/javascript" src="{{ asset('js/simple-iconpicker.min.js') }}"></script>
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Menus : '.$menu->title,
	'add_new' => '+ Add Designation'
); 
@endphp
<style type="text/css">
    .hidden{
        display: none !important
    }
</style>
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    <link rel='stylesheet' href='http://aione.oxosolutions.com/wp-admin/load-styles.php?c=1&amp;dir=ltr&amp;load%5B%5D=dashicons,admin-bar,wp-color-picker,common,forms,admin-menu,dashboard,list-tables,edit,revisions,media,themes,about,nav-menus,wp&amp;load%5B%5D=-pointer,widgets,site-icon,l10n,buttons,wp-auth-check' type='text/css' media='all' />
<style type="text/css">
    #nav-menus-frame{
        margin-left: 0px;
    }
    #menu-settings-column{
        width: 30%;
        float: left;
    }
    #menu-management-liquid{
        min-width: 65%;
        width: 70%;
        
    }
    #menu-management{
        background-color: #fff
    }
    .menu-settings , #post-body-content ,#nav-menu-header{
        padding: 10px
    }
</style>
<div class="aione-main-menu">
    <div class="wrap">
            {{-- <h1 class="wp-heading-inline">Menus</h1> --}}
                {{-- <hr class="wp-header-end"> --}}
                <input type="hidden" class="menu_id" value="{{ $menu->id }}">
                <input type="hidden" class="token" name="_token" value="{{ csrf_token() }}">
            {{-- <div class="manage-menus">
                <form method="get" action="http://aione.oxosolutions.com/wp-admin/nav-menus.php">
                    <input type="hidden" name="action" value="edit">
                    <label for="select-menu-to-edit" class="selected-menu">Select a menu to edit:</label>
                    <select name="menu" id="select-menu-to-edit">
                        <option value="2">Main Menu</option>
                        <option value="3" selected="selected">test (Main Navigation)</option>
                    </select>
                    <span class="submit-btn"><input type="submit" class="button" value="Select"></span>
                    <span class="add-new-menu-action">or<a href="http://aione.oxosolutions.com/wp-admin/nav-menus.php?action=edit&amp;menu=0">create a new menu</a>.</span>
                </form>
            </div> --}}
            <div id="nav-menus-frame" class="wp-clearfix">
            <div id="menu-settings-column" class="metabox-holder">
                <div class="clear"></div>

        <form id="nav-menu-meta" class="nav-menu-meta" method="post" enctype="multipart/form-data">
            <input type="hidden" name="menu" id="nav-menu-meta-object-id" value="3">
            <input type="hidden" name="action" value="add-menu-item">
            <input type="hidden" id="menu-settings-column-nonce" name="menu-settings-column-nonce" value="77603d1a99"><input type="hidden" name="_wp_http_referer" value="/wp-admin/nav-menus.php">
            <div id="side-sortables" class="accordion-container">
        <ul class="outer-border">
            <li class="control-section accordion-section  add-post-type-page open" id="add-post-type-page">
                <h3 class="accordion-section-title hndle" tabindex="0">Pages
                    <span class="screen-reader-text">Press return or enter to open this section</span>
                </h3>
                <div class="accordion-section-content hidden" >
                    <div class="inside">
                        <div id="posttype-page" class="posttypediv">
                            <ul id="posttype-page-tabs" class="posttype-tabs add-menu-item-tabs">
                                <li class="tabs">
                                    <a class="nav-tab-link" data-type="tabs-panel-posttype-page-most-recent" href="">
                                        Most Recent
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-tab-link" data-type="page-all" href="">
                                        View All                </a>
                                </li>
                            </ul><!-- .posttypediv-tabs -->

                            <div id="tabs-panel-posttype-page-most-recent" class="tabs-panel tabs-panel-active">
                                <ul id="pagechecklist-most-recent" class="categorychecklist form-no-clear">
                                    @foreach($pages as $k => $v)
                                        <li class="listData" dataType="page" data_id="{{ $v->id }}" data_title="{{ $v->title }}" >
                                            <label class="menu-item-title">
                                                {{ $v->title }}
                                                <a href="javascript:;" style="float: right;" class="add_page">Add</a>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div><!-- /.tabs-panel -->


                        </div><!-- /.posttypediv -->
                    </div><!-- .inside -->
                </div><!-- .accordion-section-content -->
            </li><!-- .accordion-section -->
            <li class="control-section accordion-section  add-post-type-page open" id="add-post-type-page">
                <h3 class="accordion-section-title hndle" tabindex="0">Posts
                    <span class="screen-reader-text">Press return or enter to open this section</span>
                </h3>
                <div class="accordion-section-content hidden" >
                    <div class="inside">
                        <div id="posttype-page" class="posttypediv">

                            <div id="tabs-panel-posttype-page-most-recent" class="">
                                <ul id="pagechecklist-most-recent" class="categorychecklist form-no-clear">
                                    @foreach($posts as $k => $v)
                                        <li class="listData" dataType="post" data_id="{{ $v->id }}" data_title="{{ $v->title }}" >
                                            <label class="menu-item-title">
                                                {{ $v->title }}
                                                <a href="" style="float: right;" class="add_page">Add</a>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div><!-- /.tabs-panel -->


                        </div><!-- /.posttypediv -->
                    </div><!-- .inside -->
                </div><!-- .accordion-section-content -->
            </li><!-- .accordion-section -->
            <!-- .accordion-section -->
                <li class="control-section accordion-section   add-custom-links" id="add-custom-links">
                        <h3 class="accordion-section-title hndle" tabindex="0">
                            Custom Links                            <span class="screen-reader-text">Press return or enter to open this section</span>
                        </h3>
                        <div class="accordion-section-content ">
                            <div class="inside">
                                    <div class="customlinkdiv" id="customlinkdiv">
                    <input type="hidden" value="custom" name="menu-item[-6][menu-item-type]">
                    <p id="menu-item-url-wrap" class="wp-clearfix">
                        <label class="howto" for="custom-menu-item-url">URL</label>
                        <input id="custom-menu-item-url" name="menu-item[-6][menu-item-url]" type="text" class="code menu-item-textbox" value="http://">
                    </p>

                    <p id="menu-item-name-wrap" class="wp-clearfix">
                        <label class="howto" for="custom-menu-item-name">Link Text</label>
                        <input id="custom-menu-item-name" name="menu-item[-6][menu-item-title]" type="text" class="regular-text menu-item-textbox">
                    </p>

                    <p class="button-controls wp-clearfix">
                        <span class="add-to-menu">
                            <input type="submit" class="button submit-add-to-menu right" value="Add to Menu" name="add-custom-menu-item" id="submit-customlinkdiv">
                            <span class="spinner"></span>
                        </span>
                    </p>

                        </div><!-- /.customlinkdiv -->
                                </div><!-- .inside -->
                </div><!-- .accordion-section-content -->
            </li><!-- .accordion-section -->
                            </ul><!-- .outer-border -->
    </div><!-- .accordion-container -->
            </form>

    </div><!-- /#menu-settings-column -->
    <div id="menu-management-liquid">
        <div id="menu-management">
            <form id="update-nav-menu" method="post" enctype="multipart/form-data">
                <div class="menu-edit ">
                    {{-- <input type="hidden" name="nav-menu-data"> --}}
                    {{-- <input type="hidden" id="closedpostboxesnonce" name="closedpostboxesnonce" value="40845eb276"><input type="hidden" id="meta-box-order-nonce" name="meta-box-order-nonce" value="bbe1945579"><input type="hidden" id="update-nav-menu-nonce" name="update-nav-menu-nonce" value="59769b9c47"><input type="hidden" name="_wp_http_referer" value="/wp-admin/nav-menus.php">                   <input type="hidden" name="action" value="update"> --}}
                    {{-- <input type="hidden" name="menu" id="menu" value="3"> --}}
                    {{-- <div id="nav-menu-header">
                        <div class="major-publishing-actions wp-clearfix">
                            <label class="menu-name-label" for="menu-name">Menu Name</label>
                            <input name="menu-name" id="menu-name" type="text" class="menu-name regular-text menu-item-textbox" value="test">
                            <div class="publishing-action">
                                <input type="submit" name="save_menu" id="save_menu_header" class="button button-primary button-large menu-save" value="Save Menu">                         </div><!-- END .publishing-action -->
                        </div><!-- END .major-publishing-actions -->
                    </div><!-- END .nav-menu-header --> --}}
                    <div id="post-body">
                        <div id="post-body-content" class="wp-clearfix">
                            <h3>Menu Structure</h3>
                            <div class="drag-instructions post-body-plain" style="display: none;">
                                <p>Drag each item into the order you prefer. Click the arrow on the right of the item to reveal additional configuration options.</p>
                            </div>
                            <div id="menu-instructions" class="post-body-plain">
                                <p>Add menu items from the column on the left.</p>
                            </div>
                            <ul class="menu appended_menu" id="menu-to-edit">
                                
                            </ul>
                            <div class="menu-settings">
                                <h3>Menu Settings</h3>
                                
                                <fieldset class="menu-settings-group auto-add-pages">
                                    <legend class="menu-settings-group-name howto">Auto add pages</legend>
                                    <div class="menu-settings-input checkbox-input">
                                        <input type="checkbox" name="auto-add-pages" id="auto-add-pages" value="1"> <label for="auto-add-pages">Automatically add new top-level pages to this menu</label>
                                    </div>
                                </fieldset>

                                
                                    <fieldset class="menu-settings-group menu-theme-locations">
                                        <legend class="menu-settings-group-name howto">Display location</legend>
                                                                                <div class="menu-settings-input checkbox-input">
                                            <input type="checkbox" checked="checked" name="menu-locations[main_navigation]" id="locations-main_navigation" value="3">
                                            <label for="locations-main_navigation">Main Navigation</label>
                                                                                    </div>
                                                                                <div class="menu-settings-input checkbox-input">
                                            <input type="checkbox" name="menu-locations[top_navigation]" id="locations-top_navigation" value="3">
                                            <label for="locations-top_navigation">Top Navigation</label>
                                                                                    </div>
                                                                                <div class="menu-settings-input checkbox-input">
                                            <input type="checkbox" name="menu-locations[404_pages]" id="locations-404_pages" value="3">
                                            <label for="locations-404_pages">404 Useful Pages</label>
                                                                                    </div>
                                                                                <div class="menu-settings-input checkbox-input">
                                            <input type="checkbox" name="menu-locations[sticky_navigation]" id="locations-sticky_navigation" value="3">
                                            <label for="locations-sticky_navigation">Sticky Header Navigation</label>
                                                                                    </div>
                                                                            </fieldset>

                                
                            </div>
                        </div><!-- /#post-body-content -->
                    </div><!-- /#post-body -->
                    <div id="nav-menu-footer">
                        <div class="major-publishing-actions wp-clearfix">
                                                        <span class="delete-action">
                                <a class="submitdelete deletion menu-delete" href="http://aione.oxosolutions.com/wp-admin/nav-menus.php?action=delete&amp;menu=3&amp;_wpnonce=755cfafdbd">Delete Menu</a>
                            </span><!-- END .delete-action -->
                                                        <div class="publishing-action">
                                <input type="submit" name="save_menu" id="save_menu_footer" class="button button-primary button-large menu-save" value="Save Menu">                         </div><!-- END .publishing-action -->
                        </div><!-- END .major-publishing-actions -->
                    </div><!-- /#nav-menu-footer -->
                </div><!-- /.menu-edit -->
            </form><!-- /#update-nav-menu -->
        </div><!-- /#menu-management -->
    </div><!-- /#menu-management-liquid -->
    </div><!-- /#nav-menus-frame -->
    </div>
</div>
    <script type="text/javascript">
         $(document).ready(function(){
             $('.input1').iconpicker(".input1");
         })
        // $(document).on('click','.menuItemsLabel',function(e){

        //     e.preventDefault();
        //     e.stopPropagation();
        //     var item_id = $(this).attr('id');
        //     $.ajax({
        //         url: route()+'cms/menus/item/get',
        //         type : 'post',
        //         data : {_token : $('input[name=_token]').val(),id : item_id },
        //         success: function(res){
        //             $(this).parents('.Detail-container').remove();
        //             $('#menu_form').html(res);
        //                 $(this).parents('.Detail-container').remove();

        //             console.log(res);
        //         }
        //     })
        // });
    </script>
       <script type="text/javascript">
         $(document).ready(function(){
             $('.input1').iconpicker(".input1");
         })
        $(document).on('click','.menuItemsLabel',function(e){
            e.preventDefault();
            e.stopPropagation();
            var item_id = $(this).attr('id');
            $.ajax({
                url: route()+'cms/menus/item/get',
                type : 'post',
                data : {_token : $('input[name=_token]').val(),id : item_id },
                success: function(res){
                    // $(this).parents('.Detail-container').remove();
                    $('#menu_form').html(res);
                    $(this).parents('.Detail-container').find('#menu_form').html(res);

                    console.log(res);
                }
            })
        });
        
    </script>
    <script type="text/javascript">
        $(document).ready(function(){

            $(document).unbind().on('click','#build_menu_item button',function(e){
                e.preventDefault();
                var unserialize_form_data = $(this).parents('#build_menu_item').serializeArray() ;
                var form_data = {};
                var menu_id = $('.menu_id').val();
                $.map(unserialize_form_data, function(n, i){
                    form_data[n['name']] = n['value'];
                });
                    if('{{ $from }}' == 'admin'){
                        var postUrl = 'admin/menus/item/update';
                    }else{
                        var postUrl = 'menus/item/update';
                    }
                    $.ajax({
                        url : route()+'/'+postUrl,
                        type :'get',
                        data : { form_data : form_data , menu_id : menu_id},
                        success : function(res){
                            $('.menu-sidebar').remove();
                            $('#pages_item').html(res);                            
                        }
                    });
            });

            
            $(document).unbind('click').on('click' , '.delete_page' ,function(e){
                e.preventDefault();
                e.stopPropagation();

                    var data_id = $(this).attr('data_id');
                    var menu_id = $(this).attr('menu_id');
                    if('{{ $from }}' == 'admin'){
                        var postUrl = 'admin/menus/item/update';
                    }else{
                        var postUrl = 'menus/item/update';
                    }
                    $.ajax({
                        url : route()+'menus/item/update',
                        type :'get',
                        data : { _token : $("input[name=_token]").val(), data_id : data_id ,menu_id : menu_id},
                        success : function(res){
                           if(res == 'slug_error'){
                                Materialize.toast('Slug Not Available for this page', 5000);
                                $(this).prop('checked',false);
                           }else{
                                // $('.appended_menu').remove();
                                $('.appended_menu').html(res);
                           }
                            
                        }
                    });
            });
            $(document).unbind('click').on('click' , '.add_page' ,function(e){
                e.preventDefault();
                e.stopPropagation();

                // if($(this).is(':checked')){
                    var data_title = $(this).parents('.listData').attr('data_title').trim();
                    var data_id = $(this).parents('.listData').attr('data_id');
                    var dataType = $(this).parents('.listData').attr('dataType');
                    var menu_id = $('.menu_id').val();
                    if('{{ $from }}' == 'admin'){
                        var postUrl = 'admin/menus/item/update';
                    }else{
                        var postUrl = 'menus/item/update';
                    }
                    $.ajax({
                        url : route()+'/'+postUrl,
                        type :'get',
                        data : { _token : $("input[name=_token]").val(), data_title : data_title ,data_id : data_id ,menu_id : menu_id ,dataType : dataType},
                        success : function(res){
                           if(res == 'slug_error'){
                                Materialize.toast('Slug Not Available for this page', 5000);
                                $(this).prop('checked',false);
                           }else{
                                // $('.appended_menu').remove();
                                $('.appended_menu').html(res);
                           }
                            
                        }
                    });
            });
            function getMenuItem(){
                var menu_id = $('.menu_id').val();
                if('{{ $from }}' == 'admin'){
                    var postUrl = 'admin/menus/item';
                }else{
                    var postUrl = 'cms/menus/item';
                }
                $.ajax({
                        url : route()+'/'+postUrl,
                        type :'get',
                        data : { _token : $("input[name=_token]").val(), menu_id : menu_id},
                        success : function(res){
                            $('.appended_menu').html(res);
                        }
                    });
            }
            getMenuItem();
            $(document).on('click','.accordion-section-title',function(){

                var contentDiv = $(this).siblings('.accordion-section-content');
                if(contentDiv.hasClass('hidden')){
                    contentDiv.removeClass('hidden');
                    contentDiv.show();
                }else{
                    contentDiv.addClass('hidden');
                    contentDiv.hide();
                }

            });
            $( function() {
                
                $( "#menu-to-edit" ).sortable({
                    update : function(){
                        var data = [];
                        $($(this).find('.menu-item-title')).each(function(){
                            data.push($(this).attr('item_id'));
                        });
                        console.log(data);
                        // return false;
                        if('{{ $from }}' == 'admin'){
                            var postUrl = 'admin/change/order';
                        }else{
                            var postUrl = 'cms/change/order';
                        }
                        $.ajax({
                            url : route()+'/'+postUrl,
                            type : 'get',
                            data : {request : data},
                            success : function(res){
                                if(res = 'true'){
                                    Materialize.toast('SOrted',4000);
                                }
                            }
                        });

                    }
                });
                $( "#menu-to-edit" ).disableSelection();
            });

        });
    </script>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection