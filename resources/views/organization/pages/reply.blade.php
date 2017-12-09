			@if(!empty($value->reply->toArray()))

							<ul style="margin-left: 50px;">

								@foreach($value->reply as $nextkey => $nextValue )
									<li> @if(!empty($value->user_id))
						    				@php
												$user_detail = get_user_detail($meta = false ,$array = true, $org_user_id = $nextValue->user_id);
											@endphp
											@if(!empty($user_detail['name']))
								 				[{{$user_detail['name']}}]:
								 				@else
								 				{{$nextValue->user_id}}
								 			@endif
										@endif {{$nextValue->coment}}<a href="{{route('like.comment',['type'=>'like','c_id'=>$nextValue->id])}}">like </a> <span>{{$nextValue->like->where('status',1)->count()}}</span> <a href="{{route('like.comment',['type'=>'dislike','c_id'=>$nextValue->id])}}">dislike</a> <span>{{$nextValue->like->where('status',0)->count()}}  <a id="{{$nextValue->id}}" class="reply" >reply {{$nextValue->id}} </a>@if(current_organization_user_id() == $nextValue->user_id)
		 									<a href="{{route('del.comment',['c_id'=>$nextValue->id])}}">del</a>
		 								@endif</span>
									<div style="margin-left: 50px;" class="all-hide reply-box-{{$nextValue->id}}">
										{{$nextValue->id}}
										{!! Form::open(['route'=>'save.comment']) !!}
											{!! Form::hidden('page_id',$pageData->id)!!}
											{!! Form::hidden('reply_id',$nextValue->id)!!}
											{!! Form::text('comment','reply to comment')!!}
											{!! Form::submit('send') !!}
										{!! Form::close() !!}
									</div>
									</li>
					  				@include('organization.pages.reply',['value'=>$nextValue]) 
								@endforeach
							</ul>
					@endif
