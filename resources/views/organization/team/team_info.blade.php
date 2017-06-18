@extends('layouts.main')
@section('content')
<style type="text/css">
	.dragula-handle{
		cursor: move;
	}
</style>
<div class="row">
	<div class="col-md-12">
		
		<div class="row">
			<div class="col-md-7">
									
				{!! Form::open(['route'=>'save.team_info', 'class'=> 'form-horizontal','method' => 'post','id'=>'team-list-form'])!!}
					<input type="hidden" name="team_id" value="{{$team->id}}">
					<div class="card shadow">
						<div class="panel-heading">
							<h6 class="panel-title">Manage  {{$team->title}}  </h6>
							<p> {{$team->description}} </p>
							
						</div>

						<div class="panel-body">
							<ul class="media-list media-list-container left-" id="media-list-target-left">
								@if(!empty($members))
									@foreach($members as $memKey => $memVal)
										
										@foreach($memVal->metas as $keyMeta => $valMeta)
											{{dump($valMeta->type)}}
											{{dump($valMeta->key)}}
											{{dump($valMeta->value)}}													


										@endforeach
										<li class="media">
				                    		<div class="media-left media-middle">
				                    			<i class="icon-dots dragula-handle"></i>
			                    			</div>

											<div class="media-left">
												<a href="#"><img src="{{ asset('LTR/default/assets/images/placeholder.jpg')}}" class="img-circle" alt=""></a>
											</div>

											<div class="media-body">
												<div class="media-heading text-semibold">{{$memVal->name}}</div>
												<input type="hidden" name="id[]" value="{{$memVal->id}}">
												{{$memVal->email}}
											</div>

											<div class="media-right media-middle">
												<span class="label bg-blue">Colleague</span>
											</div>
										</li>
									@endforeach
										<li class="media drag-message" style="border:2px Dashed #e8e8e8;padding: 30px">
											<div class="media-body">
												<center><h4 style="color: #e8e8e8">Please Drag Here </h4></center>
											</div>
										</li> 
								@else
								<li class="media drag-message" style="border:2px Dashed #e8e8e8;padding: 30px">
											<div class="media-body">
												<center><h4 style="color: #e8e8e8">Please Drag Here </h4></center>
											</div>
										</li> 
								@endif
								
							</ul>
						</div>
					</div>
					<!-- <div class="text-right">
						<button type="submit" class="btn btn-primary team-list-form">Submit form <i class="icon-arrow-right14 position-right"></i></button>
					</div> -->
				{!!Form::close()!!}

			</div>

			<div class="col-md-5">
				<div class="card shadow">
					<div class="panel-heading">
						<h6 class="panel-title">Employe List</h6>
						<div class="heading-elements">
							
	                	</div>
					</div>
					<div class="panel-body">
						<ul class="media-list media-list-container" id="media-list-target-right">
						@if(!empty($employee))

							@foreach($employee as $key => $emp)
								<li class="media">
		                    		<div class="media-left media-middle">
		                    			<i class="icon-dots dragula-handle"></i>
		                			</div>

									<div class="media-left">
										<a href="#"><img src="{{ asset('LTR/default/assets/images/placeholder.jpg')}}" class="img-circle" alt=""></a>
									</div>

									<div class="media-body">
										<div class="media-heading text-semibold">{{$emp->name}}</div>
										<input type="hidden" name="id[]" value="{{$emp->id}}">
										{{$emp->email}}
									</div>

									<div class="media-right media-middle">
										<span class="label bg-blue">Colleague</span>
									</div>
								</li>
							@endforeach
							<li class="media drag-message" style="border:2px Dashed #e8e8e8;padding: 30px">
								<div class="media-body">
									<center><h4 style="color: #e8e8e8">Please Drag Here </h4></center>
								</div>
							</li> 
						@else
							<li class="media drag-message" style="border:2px Dashed #e8e8e8;padding: 30px">
								<div class="media-body">
									<center><h4 style="color: #e8e8e8">Please Drag Here </h4></center>
								</div>
							</li> 
						@endif
						</ul>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		// console.log($('#media-list-target-left').find('.media').length);
		if($('#media-list-target-left').find('.media').length == '1'){
			// console.log("empty");
			 $('#media-list-target-left').parents('.shadow').find('.drag-message').show();
		}else{
			// console.log('not empty');
			 $('#media-list-target-left').parents('.shadow').find('.drag-message').hide();
		}

		// console.log($('#media-list-target-right').find('.media').length);
		if($('#media-list-target-right').find('.media').length == '1'){
			// console.log("empty");
			 $('#media-list-target-right').parents('.shadow').find('.drag-message').show();
		}else{
			// console.log('not empty');
			 $('#media-list-target-right').parents('.shadow').find('.drag-message').hide();
		}
	});
</script>
@endsection()