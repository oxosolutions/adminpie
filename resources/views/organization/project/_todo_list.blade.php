
@foreach($model as $key => $value)
	<div class="card-panel shadow white z-depth-1 hoverable project todo_list add-details">
		<div class="row valign-wrapper no-margin-bottom ">
			<div class="col l1 s2 center-align project-image-wrapper">
				<a href="" data-toggle="popover" title=" " data-content="TEST">
					<div class="defualt-logo">{{ucfirst(mb_substr($value->title, 0, 1))}}</div>
				</a>
			</div>
			<div class="col l11 s10 editable">
				<div class="row m-0 valign-wrapper">
					<div class="col s7 m7 l7">
						<input type="hidden" name="_token" value="" class="shift_token" >
						<input type="hidden" name="_todo_id" value="{{$value->id}}" class="todo_id" >
						<a href="javascript:;" data-toggle="popover" title="Popover title" data-content="TEST" >
							<h5 class="project-title black-text flow-text truncate line-height-35">
								@if($value->status == 0)
									<span class="project-name todo-name font-size-14" contenteditable="true" style="text-decoration: line-through;color:#d9d9d9" >{{$value->title}}</span>
								@else
									<span class="project-name todo-name font-size-14" contenteditable="true" >{{$value->title}}</span>
								@endif
							</h5>
						</a>
					</div>

					<div class="col s3 m3 l3">
						<span class="blue white-text ph-10 pv-">{{$value->priority}}</span>	
					</div>
					<div class="col s2 m2 l2 right-align">
						<p style="margin: 0px;">
							<span>
								<a href="javascript:;" class="delete-todo">
									<i class="fa fa-close" style="width: 18px;cursor:pointer;text-align: center;color: #888;font-size: 18px;margin-right: 8px;"></i>
								</a>
									
							</span>
							@if($value->status == 0)
								<input type="checkbox" class="filled-in todo-check" id="filled-in-box{{$value->id}}" checked="checked" />
							<label for="filled-in-box{{$value->id}}" style="vertical-align: middle"></label>
							@else
								<input type="checkbox" class="filled-in todo-check" id="filled-in-box{{$value->id}}"/>
								<label for="filled-in-box{{$value->id}}" style="vertical-align: middle"></label>
							@endif
							
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="todo-details" style="display: none;border-top: 1px solid #e8e8e8;margin-top: 12px">
			<div class="row">
				<div class="col l1">
				</div>
				<div class="col l10">
					{{$value->description}}
				</div>
				<div class="col l1">
					{{-- <a href="javascript:;" style="float: right;margin-right: 13px;font-size: 20px;"><i class="fa fa-edit"></i></a> --}}
				</div>
			</div>
		</div>
	</div>
@endforeach