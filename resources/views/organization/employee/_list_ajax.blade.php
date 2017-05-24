@if(!empty($data))
	@foreach($data as $key => $val)

	<div class="card-panel shadow white z-depth-1 hoverable project"  >

		<div class="row valign-wrapper no-margin-bottom">
			<div class="col l1 m1 s2 center-align project-image-wrapper">
				<a href="{{-- {{route('add_project_info.project', ['id' => $projVal->id])}} --}}" data-toggle="popover" title="{{$val->employ_info->name}}" data-content="TEST">
				{{-- <img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" alt="" class="project-image circle responsive-img">  --}}
				<div class="defualt-logo">
					{{ucwords(substr($val->employ_info->name, 0, 1))}}
				</div>
				</a>
			</div>

			<div class="col l11 m11 s10 editable" >
				<div class="row valign-wrapper" style="margin: 0">
					<div class="col l4 m4 s8">
						<input type="hidden" value="{{$val->id}}" class="id" >
						<input type="hidden" name="_token" value="{{csrf_token()}}" class="_token" >
						
						<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" >
							<h5 class="project-title black-text flow-text truncate" style="line-height: 35px">
								<span class="project-name name edit" id="{{$val->employ_info->id}}"> {{$val->employ_info->name}}</span>
							</h5>
						</a>
					</div>
					<div class="col l4 m4 hide-on-small-only">
						<p class="project-detail truncate from" style="line-height: 35px;margin-bottom: 0px;margin-top: 0px">
							<span class="edit_designation" id="{{$val->employ_info->id}}">{{$designation[$val->designation]}}</span>
						</p>
					</div>
					
					
					<div class="col l3 m3 s4 right-align">
						<div class="switch">
						    <label>
								
									@if($val->status == '0')
										<input type="checkbox">
									@else
										<input type="checkbox" checked="checked">
									@endif
								
						      <span class="lever"></span>
						      
						    </label>
						  </div>
					</div>
				</div>
			</div>
		</div>
			
	</div>
	@endforeach
@endif