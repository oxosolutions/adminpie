@extends('admin.layouts.main')
@section('content')
@if(!empty(Session::get('success')))
	<div id="card-alert" class="card green lighten-5"><div class="card-content green-text">{{Session::get('success')}}</div></div>
	{{-- <script type="text/javascript">
		  Materialize.toast('I am a toast!', 4000);
	</script>	 --}}
@endif

@if(!empty(Session::get('error')))
	<div id="card-alert" class="card red lighten-5"><div class="card-content red-text">{{Session::get('error')}}</div></div>
	{{-- <script type="text/javascript">
		  Materialize.toast('I am a toast!', 4000);
	</script>	 --}}
@endif

<div class="fade-background">

</div>
<div id="search" class="projects list-view">
	<div class="row" id="find-project">
		<div class="col s12 m12 l12 " >
			{{-- <div class="row no-margin-bottom">
				<div class="col s12 m12 l6  pr-7 tab-mt-10" >
					<nav>
					    <div class="nav-wrapper">
					      	<form>
						        <div class="input-field">
						          	<input id="search" class="search" type="search" required style="background-color: #ffffff">
						          	<label class="label-icon" for="search" style=""><i class="material-icons icon-search" >search</i></label>
						          	<i class="material-icons icon-close">close</i>
						        </div>
					      	</form>
					    </div>
					</nav>
				</div>
				<div class="col s6 m6 l3  aione-field-wrapper pl-7 tab-mt-10">
					<div class="row aione-sort" style="">
						<select class="col  browser-default aione-field" >
							<option value="" disabled selected>Sort By</option>
							<option value="1">Name</option>
							<option value="2">Date</option>
						</select>
						<div class="col alpha-sort" style="width: 25%;padding-left:7px;">
							<a href="javascript:;" class="sort" ><i class="fa fa-sort-alpha-asc arrow_sort white" ></i></a>
						</div>
					</div>
				</div>

				<div class="col s6 m6 l3 pl-7 right-float tab-mt-10 tab-pl-10">
					<div class="row aione-switch-view">
						<ul class="right  views m-0" >
							<li class="inline-block" sty><a href="#list-view" class=" view" data-view="list-view"><i class="material-icons" >view_list</i></a></li>
							
							

							<li class="inline-block" ><a href="#detail-view" class=" view" data-view="detail-view"><i class="material-icons" >view_stream</i></a></li>


							<li class="inline-block" ><a href="#grid-view" class=" view" data-view="grid-view"><i class="material-icons" >view_module</i></a></li>
						</ul>
					</div>
				</div>
			</div> --}}
			<div class="list" id="list">
				<div class="row">
					@include('common.list.datalist')
				</div>
			
				
			</div>
		</div>

		{{-- <div class="col s12 m3 l3 pl-7" >
			<a id="add_new" href="{{route('create.organization')}}" class="btn add-new display-form-button" >
				Add Organization
			</a>
			<div id="add_new_wrapper" class="add-new-wrapper add-form ">
				{!! Form::open(['route'=>'store.designation' , 'class'=> 'form-horizontal','method' => 'post'])!!}

					<div class="row no-margin-bottom">
						<div class="col s12 m2 l12 aione-field-wrapper">
							<input name="name" class="no-margin-bottom aione-field" type="text" placeholder="Designation Title" />
						</div>
						

						<div class="col s12 m6 l12 aione-field-wrapper">
							<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save Designation
								<i class="material-icons right">save</i>
							</button>
						</div>
					</div>
				{!!Form::close()!!}

			</div>
			<div class="card-panel shadow mt-22" >
				clients
			</div>
		</div> --}}
	</div>
</div>
<script type="text/javascript">
	var options = {valueNames:[name]};
	var userList = new List('user',options);
</script>
@endsection
