{{-- {{dd($data)}} --}}

@if(!empty($data))
	@foreach($data as $key => $val)
	<div class="row hover-me" style="padding:14px;">
		<div class="row valign-wrapper">
			<div class="col s7">
				<div class="row valign-wrapper">
					<div class="col">
						<div class="id" style="display: none">
							{{$val->id}}
						</div>
						<a href="{{-- {{route('add_project_info.project', ['id' => $projVal->id])}} --}}" data-toggle="popover" title="{{$val->employ_info->name}}" data-content="TEST">
						<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
							{{ucwords(substr($val->employ_info->name, 0, 1))}}
						</div>
						</a>
					</div>
					<div class="col" style="padding-left: 10px">
						<div style="" class=""><span class="project-name name edit" id="{{$val->employ_info->id}}"> {{$val->employ_info->name}}</span></div>
						<div class="options">
							<a href="{{route('account.profile',$val->employ_info->id)}}" style="padding-right:10px">Edit</a>
							
							<a href="javascript:;" class="delete-employee" data-route="{{ route('delete.employee',['id'=>$val->employ_info->id]) }}" onclick="deleteAlert()" style="padding-right:10px;color: red">Delete</a>
						</div>
					</div>
				</div>

			</div>
			<div class="col s3 extra-option">
				<span>{{$val->employee_id}}</span>
			</div>
			<div class="col s2 right-align">
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
	<style type="text/css">
		.options{
			position: absolute;
			font-size: 14px;
			display: none;
			margin-top:-3px;
		}
		.hover-me:hover .options{
			display: block
		}
	</style>
	<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.delete-employee',function () {		
		var deletedRoute = $(this).attr('data-route');	
			swal({   
				title: "Are you sure?",   
				text: "You will not be able to recover this imaginary file!",   
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false }, 
				function(){   
					// swal("Deleted!", "Your imaginary file has been deleted.", "success");
					$(location).attr('href', deletedRoute);
			}); 
		});
	});
				

	</script>
	@endforeach
@endif