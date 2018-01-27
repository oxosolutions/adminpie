
@foreach($model as $key => $value)
		
				<tr>
					<td style="width: 10%">
						@if($value->status == 0)
							<input type="checkbox" class="filled-in todo-check" id="filled-in-box{{$value->id}}" checked="checked" />
						<label for="filled-in-box{{$value->id}}" style="vertical-align: middle"></label>
						@else
							<input type="checkbox" class="filled-in todo-check" id="filled-in-box{{$value->id}}"/>
							<label for="filled-in-box{{$value->id}}" style="vertical-align: middle"></label>
						@endif
							<input type="hidden" name="_token" value="{{csrf_token()}}" class="shift_token" >
						<input type="hidden" name="_todo_id" value="{{$value->id}}" class="todo_id" >
					</td>
					<td style="width: 50%">
						@if($value->status == 0)
							<span class=""  style="text-decoration: line-through;color:#d9d9d9" >{{$value->title}}</span>
						@else
							<span class="project-name todo-name font-size-14 view-mode" >{{$value->title}}</span>
							<div class="field-wrapper-text edit-mode">
								
								<div class="field field-type-text">
									<input class="text todo-name" id="input_password" name="password" type="text"  value="{{$value->title}}">
								</div><!-- field -->
							</div>
							
						@endif
					</td>
					<td style="width: 20%">
						<div class="view-mode">
							<div class="priority">
								{{$value->priority}}
							</div>	
						</div>
						<div class="field-wrapper-text edit-mode">
								
							<div class="field field-type-text">
								<select class="browser-default priority">
									<option value="low">Low</option>
									<option value="high">High</option>
									<option value="medium">Medium</option>
								</select>
							</div>
						</div>
						

					</td>
					<td style="width: 20%">
						<a href="javascript:;" class="edit-single"><i class="fa fa-pencil mr-5"></i>Edit</a>
						<a href="javascript:;" class="edit-mode green save-todo"><i class="fa fa-save mr-5 green"></i>Save</a>  |

						<a href="javascript:;" class="delete-todo"><i class="fa fa-trash mr-5 red" ></i><span class="red">Delete</span></a>
						{{-- @if($value->status == 0) |
							<i class="fa fa-check mr-5 green"></i><span class="green">Completed</span>
						@else |
							<i class="fa fa-bars mr-5 light-blue"></i><span class="light-blue">Un-Completed</span>
						@endif --}}

					</td>	
				</tr>
	
	{{-- <div class="card-panel shadow white z-depth-1 hoverable project todo_list add-details">
		<div class="row valign-wrapper mb-0 ">
			<div class="col l1 s2 center-align project-image-wrapper">
				<a href="" data-toggle="popover" title=" " data-content="TEST">
					<div class="defualt-logo">{{ucfirst(mb_substr($value->title, 0, 1))}}</div>
				</a>
			</div>
			<div class="col l11 s10 editable">
				<div class="row m-0 valign-wrapper">
					<div class="col s7 m7 l7">
						<input type="hidden" name="_token" value="{{csrf_token()}}" class="shift_token" >
						<input type="hidden" name="_todo_id" value="{{$value->id}}" class="todo_id" >
						<a href="javascript:;" data-toggle="popover" title="Popover title" data-content="TEST" >
							<h5 class="project-title black-text flow-text truncate line-height-35">
								@if($value->status == 0)
									<span class="project-name todo-name font-size-14"  style="text-decoration: line-through;color:#d9d9d9" >{{$value->title}}</span>
								@else
									<span class="project-name todo-name font-size-14" >{{$value->title}}</span>
								@endif
							</h5>
						</a>
					</div>

					<div class="col s3 m3 l3">
						<span class="blue white-text ph-10 priority-badge">{{$value->priority}}</span>
						<span id="select-priority " class="edit-priority" style="display: none">
						@php $list_values = ['Low' => 'Low' ,'Medium' => 'Medium' ,'High' => 'High' ]; @endphp
							<select >
								
								@foreach($list_values as $key => $list)
									<option {{($list == $value->priority)?"selected":""}} value="{{$key}}">{{$list}}</option>
								@endforeach
						    </select>

						</span>
					</div>
					<div class="col s2 m2 l2 right-align">
						<p style="margin: 0px;">

							<span>
								<a href="javascript:;" class="delete-todo">
									<i class="fa fa-close" style="width: 18px;cursor:pointer;text-align: center;color: #888;font-size: 18px;margin-right: 8px;"></i>
								</a>
									
							</span>
							<span>
								<a href="javascript:;" class="edit-todo"><i class="fa fa-pencil" style="color: grey;margin-right: 10px"></i></a> 
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
			<div class="row" >
				<div class="col l1">
				</div>
				<div class="col l8 todo-desc" style="padding: 10px 0px 0px 0px">
					{{$value->description}}
				</div>
				<div class="col l3 right-align" style="margin-top: 10px">	
					<button class="waves-effect waves-teal btn-flat white-text blue save-todo" style="display: none" onclick="editTodo()">save</button>
				</div>
			</div>
		</div>
	</div> --}}
	<script type="text/javascript">
		 $(document).ready(function() {
		    $('select').material_select();
		  });
	</script>
@endforeach