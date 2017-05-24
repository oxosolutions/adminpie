@foreach($send_data as $key => $value)

<div class="row">
	<div class="col l2">
		<div class="card shadow p-10">
			<img src="{{asset('assets/images/Employee1.png')}}" style="width:152px">
			<div class="divider" style="margin: 8px"></div>
			<div class="row center-align left-details">
				<div class="col l12 v emp_name">
					{{$value['user_info']['name']}}
				</div>
				
			</div>
			<div class="row center-align">
				<div class="col l12">
					{{$value['user_info']['email']}}
				</div>
			</div>
		</div>
	</div>
	<div class="col l8">
		<div class="card shadow p-10 ">
			<div class="row" style="margin-bottom: 10px">
				<div class="col l6">
					<h6>Basic Information</h6>	
				</div>
				<div class="col l6 right-align">
					<a id="edit" class="btn" href="javascript:;">EDIT</a>
				</div>
			</div>
			<div class="divider"></div>
			<div class="row p-10">
				<div class="row valign-wrapper">
					<div class="col l3">
						Name:
					</div>
					<div class="col l9 left-align view-info">
						{{$value['user_info']['name']}}
					</div>
					<div class="col l9 edit-info">
						{{-- <input type="text" name="name" value="ashish kumar"> --}}
						{!! Form::text('name',$value['user_info']['name'] , ['required']) !!}
					</div>
				</div>
				<div class="row valign-wrapper">
					<div class="col l3 left-align">
						email:
					</div>
					<div class="col l9 left-align view-info" >
						{{$value['user_info']['email']}}
					</div>
					<div class="col l9 left-align edit-info">
						{{-- <input type="text" name="email" value="ashish9436@gmail.com"> --}}
						{!! Form::text('email', $value['user_info']['email'], array('required')) !!}
					</div>
				</div>
				<div class="row valign-wrapper">
					<div class="col l3 left-align">
						Phone:
					</div>
					<div class="col l9 left-align view-info" >
						{{$value['user_meta']['phone']}}

					</div>
					<div class="col l9 left-align edit-info" >
						{{-- <input type="text" name="phone" value="8566820937"> --}}
						{!! Form::text('phone', $value['user_meta']['phone'], array('required')) !!}
					</div>
				</div>
				<div class="row valign-wrapper">
					<div class="col l3 left-align">
						Date of birth:
					</div>
					<div class="col l9 left-align view-info">
						{{$value['user_meta']['dob']}}
					</div>
					<div class="col l9 left-align edit-info" >
						{{-- <input type="text" name="dob" value="23-10-1993"> --}}
						{!! Form::text('dob', $value['user_meta']['dob'], array('required')) !!}
					</div>
				</div>
				<div class="row valign-wrapper">
					<div class="col l3 left-align">
						Gender:
					</div>
					<div class="col l9 left-align view-info">
						{{$value['user_meta']['gender']}}
					</div>

					<div class="col l9 left-align edit-info">
					{{-- 	<input type="text" name="gender" value="Male"> --}}
						{!! Form::text('gender', $value['user_meta']['gender'], array('required')) !!}
					</div>
				</div>
				<div class="row valign-wrapper">
					<div class="col l3 left-align">
						Country
					</div>
					<div class="col l9 left-align view-info">
						{{$value['user_meta']['country']}}
					</div>

					<div class="col l9 left-align edit-info">
					{{-- 	<input type="text" name="gender" value="Male"> --}}
						{!! Form::text('country',$value['user_meta']['country'], array('required')) !!}
					</div>
				</div>
				<div class="row valign-wrapper">
					<div class="col l3 left-align">
						State
					</div>
					<div class="col l9 left-align view-info">
						{{$value['user_meta']['state']}}
					</div>

					<div class="col l9 left-align edit-info">
					{{-- 	<input type="text" name="gender" value="Male"> --}}
						{!! Form::text('state',$value['user_meta']['state'], array('required')) !!}
					</div>
				</div>
				<div class="row valign-wrapper">
					<div class="col l3 left-align">
						zip
					</div>
					<div class="col l9 left-align view-info">
						{{$value['user_meta']['zip']}}
					</div>

					<div class="col l9 left-align edit-info">
					{{-- 	<input type="text" name="gender" value="Male"> --}}
						{!! Form::text('zip',$value['user_meta']['zip'], array('required')) !!}
					</div>
				</div>
				<div class="row valign-wrapper">
					<div class="col l3 left-align">
						Address
					</div>
					<div class="col l9 left-align view-info">
							{{$value['user_meta']['address']}}
					</div>
					<div class="col l9 left-align edit-info">						
						{{-- <input type="text" name="address" value="27 Model town"> --}}
						{!! Form::textarea('address', $value['user_meta']['address'], array('required')) !!}
					</div>
				</div>
				<div class="right-align edit-info">
					<a href="javascript:;" class="btn save-details">Save</a>
				</div>
			</div>
		</div>
		
	</div>
	@foreach($value['type'] as $type)
	<div class="col l2">
		<div class="card shadow p-10">
			<div class="row" style="margin-bottom: 10px">
				<div class="col l12">
					<h6>Settings</h6>
				</div>
			</div>
			<div class="divider"></div><br>
			<div class="left-align">
				<a class="btn btn-xs btn-danger" href="javascript:;" style="padding: 0px 10px">Remove as {{App\Model\Organization\UsersType::find($type)->type}}</a>
			</div>
		</div>
	</div>
	@endforeach
</div>
@endforeach
<style type="text/css">
.emp_name{
	font-weight: 500;
	font-size: 18px;
}
.left-details{
	margin-bottom: 0px
}
</style>
<script type="text/javascript">

</script>