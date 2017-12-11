@php
    $design_settings = get_design_settings();
    if(@$design_settings->theme !== null && $design_settings->theme != ''){
	    $layout = 'layouts.themes.'.$design_settings->theme.'.layout';
    } else {
	    $layout = 'layouts.front';
    }
@endphp
@extends($layout)
@section('content')
<h1>Demoooooo Pages</h1>
	{!! $pageData->content !!}
	
{{-- {{ dump($pageData->coments->toArray()) }} --}}
<div>
	{!! Form::open(['route'=>'save.comment']) !!}
			{!! Form::hidden('page_id',$pageData->id)!!}
			<label for=""> comment</label> <input type="text" name="comment">
			{!! Form::submit() !!}
	{!! Form::close() !!}
</div>
<ul>
@foreach($coment as $key =>$value)
	<div>	 
			@if(!empty($value->user_id))
			@php
				$user_detail = get_user_detail($meta = false ,$array = true, $org_user_id = $value->user_id);
			@endphp
				@if(!empty($user_detail['name']))
	 				[{{$user_detail['name']}}]:
	 				@else
	 				{{$value->user_id}}
	 			@endif
			@endif

		<span class="comment-edit-{{$value->id}}" >{{$value->coment}}  </span> 
		
		<br>
			
		@php
			$user_status = $value->like->where('user_id',current_organization_user_id())->first()->status;
		@endphp
		<a class="like" like="{{$value->id}}" href="{{route('like.comment',['type'=>'like','c_id'=>$value->id])}}"><div class="all-hide" id="expression-{{$value->id}}">
				 <button {{route('like.comment',['type'=>'like', 'c_id'=>$value->id , 'expression'=>1])}}"><img src="{{asset('comment/thumb.jpg')}}"></button> 
				<img src="{{asset('comment/heart.jpg')}}">
			</div> @if($user_status==1)
								<img src="{{asset('comment/thumb.jpg')}}">
							@elseif($user_status==4)
								<img src="{{asset('comment/heart.jpg')}}">
						@endif like 
		</a>

		<span>{{$value->like->where('status',1)->count()}} {{ dump($value->like->where('user_id',current_organization_user_id())->first()->status) }}</span> 
		<a href="{{route('like.comment',['type'=>'dislike','c_id'=>$value->id])}}">dislike</a> <span>{{$value->like->where('status',0)->count()}}
		 <a id="{{$value->id}}" class="reply" >reply </a>
		 <a id="{{$value->id}}" class="edit-comment {{$value->id}}" >edit</a>

		</span>


		@if(current_organization_user_id() == $value->user_id)
		 	<a href="{{route('del.comment',['c_id'=>$value->id])}}">del</a>
		 @endif
		</div>
		<li class="all-hide reply-box-{{$value->id}}">	{!! Form::open(['route'=>'save.comment']) !!}
				{!! Form::hidden('page_id',$pageData->id)!!}
				{!! Form::hidden('reply_id',$value->id)!!}
					
		    		{!! Form::text('comment','reply to comment')!!}
			{!! Form::submit('send message') !!}
			{!! Form::close() !!}
		</li>
	
			
		{{-- {{dump($value->id , $value->coment)}} --}}
		@if(!empty($value->reply->toArray()))
		{{-- {{dump($value->reply->toArray())}} --}}
					 @include('organization.pages.reply',['value'=>$value])
		{{-- <ul style="margin-left: 50px;">
				@foreach($value->reply as $nextk => $nextV )

					<li> {{$nextV->coment}} </li>
				@endforeach
		</ul> --}}
		@endif

@endforeach

</ul>
<input id="token" type="hidden" name="_token" value="{{csrf_token()}}" >

{{-- 

<div>
	

{!! Form::open(['route'=>'save.comment']) !!}

	<input type="text" name="post_id" value="{{ $pageData->id }}">
	<input type="text" name="comment">
	{!! Form::submit() !!}
{!! Form::close() !!}
	<ul>
		@foreach($pageData->comments as $key => $value)
			<li><label for="">{{$value['user_id']}} </label>{{$value['comment']}}</li>
		@endforeach
	</ul>

	<input id="token" type="hidden" name="_token" value="{{csrf_token()}}" >

	
</div> --}}

<script type="text/javascript">
	$(".like").mouseenter(function(e){
			 id = $(this).attr('like');
			$("#expression-"+id).show();
		}).mouseleave(function() {
			id = $(this).attr('like');
			$("#expression-"+id).hide();
		});
	$(document).ready(function(){
		$(".all-hide").hide();

		

		// $(".like").off('mouseover',function(e){
		// 	alert('working');
		// });

		$("a.reply").on('click', function(e){
			e.preventDefault();
			cls = $(this).attr('id');
			$('.reply-box-'+cls).toggle();
		});

		$("a.edit-comment").on('click',  function(e){
			e.preventDefault();
			c_id = $(this).attr('id');
			comment_text  = $(".comment-edit-"+c_id).html();
			$(".comment-edit-"+c_id).html("<input  type='text' id='update-comment-text-"+c_id+"' value="+comment_text+"> <a id='update_"+c_id+"' c_id="+c_id+" class='update_comment'> UpdateComment</a>");
			$(this).hide();
		});
	$(document).on('click','.update_comment', function(e){
			e.preventDefault();
			var data = {};
			data['comment_id'] = c_id = $(this).attr('c_id');
			data['comment_text'] = comment_text = $("#update-comment-text-"+c_id).val();
			data['_token'] = $("#token").val();
			console.log(data);
			$.ajax({
				url:route()+'/comment/update',
				type:'POST',
				data:data,
				success:function(response){
					$("."+c_id).show();
					$(".comment-edit-"+c_id).html(comment_text);
					// console.log(response);
					//location.reload();
				}
			})

		});

		
	});


	

	

</script>

@endsection()


<!-- expression note

Status
1-like,
4-heart
5-angry 


 -->
