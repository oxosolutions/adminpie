@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Bookmarks',
	'add_new' => '+ Add Bookmarks'
); 

	$bookmarks = $model;
@endphp

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
	<div class="aione-bookmark-wrapper">
		<div class="aione-bookmark-folder">
			
			<ul class="collection">
					<li id="bookmark_all" class="collection-item selected"><i class="fa fa-list logo-icon"></i><div>All Bookmarks</div></li>
				@foreach($category as $key => $value)
					<li id="bookmark_{{$value->id}}" class="collection-item"><i class="fa fa-folder logo-icon"></i><div>{{ $value->name }}<a href="{{ route('delete.bookmark.category',['id'=>$value->id]) }}" class="delete-bookmark"><i class="delete-icon material-icons dp48">close</i></a></div></li>
					
		    	@endforeach
		    </ul>
		    <div class="aione-add-list">
			{!! Form::open(['method'=>'post','route'=>'create.bookmark.category']) !!}
				<input type="text" name="name">
				<button type="submit" class="add-category">+</button>
			{!! Form::close() !!}
			</div>
		</div>
		<div class="aione-bookmark-content">
			<div id="sortable" class="aione-bookmarks">
				<div class="aione-bookmark-header">
					<div class="bookmark-check-all">
						<input type="checkbox"></input>	
					</div>
					<div class="bookmark-actions">
							<i class="delete material-icons dp48">delete</i>	
						<a href="">
							<i class="material-icons dp48">share</i>	
						</a>
						
					</div>
					<div class="bookmark-create">
						{!! Form::open(['method'=>'post','route'=>'save.bookmark']) !!}
							<input type="text" name="title">
							<input type="text" name="link">
							<input type="hidden" name="categories">
							<button>save</button>
						{!! Form::close() !!}	
					</div>
					<div class="clear"></div>
					
				</div>
			@foreach($bookmarks as $bookmark)
			
				<div  class="aione-bookmark bookmark_{{$bookmark->categories}} ">
					<div class="bookmark-handle"><i class="aione-icon material-icons">menu</i></div>
					<div class="bookmark-check"><input id="{{$bookmark->id}}" type="checkbox" name="deleteBookmarks[]"></div>
					<div class="bookmark-title"><a href="{{$bookmark->link}}" target="{{$bookmark->target}}">{{$bookmark->title}}</a></div>
					<div class="bookmark-link"><input value="{{$bookmark->link}}" /></div>
					<div class="bookmark-link"><input value="{{$bookmark->target}}" /></div>
					<div class="bookmark-status"></div>
					<div class="bookmark-tags">{{$bookmark->tags}}</div>
					<div class="clear"></div>
				</div> <!-- aione-bookmark -->
			@endforeach
			</div> <!-- aione-bookmarks -->
		</div>
		<div class="clear"></div>
	</div>
	

	{{-- @include('common.list.datalist') --}}

	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')


	{!! Form::open(['route'=>'save.bookmark','method' => 'POST']) !!}
	@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'This is Heading','button_title'=>'Save Data','section'=>'save_bookmarks']])
	{!! Form::close() !!}


	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<style type="text/css">
	.aione-bookmarks{

	}
	.aione-bookmarks .aione-bookmark{

	}
	.aione-bookmarks .aione-bookmark .bookmark-handle,
	.aione-bookmarks .aione-bookmark .bookmark-title,
	.aione-bookmarks .aione-bookmark .bookmark-check,
	.aione-bookmarks .aione-bookmark .bookmark-link,
	.aione-bookmarks .aione-bookmark .bookmark-status,
	.aione-bookmarks .aione-bookmark .bookmark-tags,
	.aione-bookmarks  .bookmark-actions,
	.aione-bookmarks  .bookmark-create,
	.aione-bookmarks  .bookmark-check-all	{
		float: left;
		line-height: 50px;
	}


	/****************************************************************/
	.aione-bookmarks  .bookmark-actions{
		width: 20%
	}
	.aione-bookmarks  .bookmark-actions i{
		vertical-align: middle;
		color: #757575;
		padding-left: 10px

	}
	.aione-bookmarks  .bookmark-create{
		width: 70%
	}
	.aione-bookmarks  .bookmark-create input[type=text]{
		padding:7px;
	}
	.aione-bookmarks .aione-bookmark .bookmark-handle{
		width: 34px;
		text-align: center
	}
	.aione-bookmarks  .bookmark-check-all{
		margin-left: 42px;
	}
	.aione-bookmarks .aione-bookmark .bookmark-handle .aione-icon{
		vertical-align: middle;
		cursor: move
	}
	.aione-bookmarks .aione-bookmark .bookmark-title{
		width: 20%
	}
	.aione-bookmarks .aione-bookmark .bookmark-link{
		width: 34%
	}
	.aione-bookmarks .aione-bookmark .bookmark-link input{
		border:none;
	}
	.aione-bookmarks .aione-bookmark .bookmark-check{
		text-align: center;
		width: 48px
	}



	.aione-bookmark-wrapper{

	}
	.aione-bookmark-wrapper .aione-bookmark-folder{
		float:left;
		width: 25%;
		margin-right: 1%;
	}
	.aione-bookmark-wrapper .aione-bookmark-content{
		float:left;
		width: 74%;

	}
	.aione-bookmark-wrapper .aione-bookmark-folder .aione-add-list input[type=text]{
		    line-height: 32px;
    padding: 0 6px;
    width: 78%;
    float: left;
	}
	.aione-bookmark-wrapper .aione-bookmark-folder .aione-add-list .add-category{
		    background-color: #039be5;
    padding: 0;
    width: 20%;
    line-height: 36px;
    float: left;
    border-radius: 0px;
	}
	.aione-bookmark-wrapper .collection .collection-item{
		padding: 10px;
	}
	.aione-bookmark-wrapper .collection .collection-item > .logo-icon{
		font-size: 24px;
		float: left;
		color: #ffb300;
	}
	.aione-bookmark-wrapper .collection .collection-item > .fa-list{
		color: #757575;
	}
	.aione-bookmark-wrapper .collection .collection-item > div{
		display: block;
		line-height: 24px;
    	margin-left: 34px;
	}
	.aione-bookmark-wrapper .collection .collection-item .delete-icon{
	    float: right;
	    font-size: 15px;
    color: #757575;
    line-height: 24px;
	}
	.aione-bookmark-wrapper .collection .collection-item .delete-bookmark{
		display: none;
	}
	.aione-bookmark-wrapper .collection .collection-item:hover .delete-bookmark{
		display: inline;
	}
	.aione-bookmark-wrapper .collection .collection-item.selected{
		background-color: #039be5;

	}
	.aione-bookmark-wrapper .collection .collection-item.selected > div{
		color: white;
		font-size: 500
	}
	.aione-bookmark-wrapper .collection .collection-item.selected .delete-icon{
		color: white
	}
	.aione-bookmark-wrapper .collection .collection-item.selected > .logo-icon{
		color: white;
	}
    
	/****************************************************************/
</style>
<script type="text/javascript">
	$(document).ready(function(){
		// shoe hide according to folder
		$(document).on('click','.collection > .collection-item',function(){
			var id = $(this).attr('id');
			$('input[name=categories]').val(id);
			$('.aione-bookmarks').find('.'+id).show().siblings().hide();
			$(this).addClass('selected');
			$(this).siblings().removeClass('selected');
		});
		$('#bookmark_all').click(function(){
			$('.aione-bookmarks').find('.aione-bookmark').show();
		});
		
		//check all functionality
		$('.bookmark-check-all input[type=checkbox]').on('click',function(){
		    if($(this).is(':checked')){  
		        $('.bookmark-check > input[type=checkbox]').prop('checked','checked');
		        }else{	
		        $('.bookmark-check > input[type=checkbox]').prop('checked','');
		    }
		});

		$(document).on('click','.bookmark-actions .delete',function(){

				var ids = [];
					$('.bookmark-check > input[type=checkbox]:checked').each(function(e){
						ids.push($(this).attr('id'));
						$(this).parents('.aione-bookmark').remove();
					});
				$.ajax({
					url : route()+'/bookmark/delete',
					type : 'POST',
					data : {
							id : ids , _token : $('input[name=_token]').val()
					},
					success:function(res){
						if(res == 'true'){
							Materialize.toast('Deleted Successfully' , 4000);
						}
					}
				});

		});
		


		$( function() {
	        $( "#sortable" ).sortable({
	            axis: "y"
	        });
	        
	    });
	});
</script>
@endsection
