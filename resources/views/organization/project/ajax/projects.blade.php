
	@foreach($projects as  $projKey => $projVal)
		@php
			$id = ucfirst(str_replace(' ', "_",$projVal->name));
		@endphp
		<div class="card-panel shadow white z-depth-1 hoverable {{$id}}_project project" data-site="{{$projVal->name}}" >
			<div class="row valign-wrapper no-margin-bottom  ">
				<div class="col l1 s1 center-align project-image-wrapper">
					<a href="{{route('add_project_info.project', ['id' => $projVal->id])}}" data-toggle="popover" title="Click here to view details" data-content="TEST">
					{{-- <img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" alt="" class="project-image circle responsive-img">  --}}
					@php
						$array = ['#ABC7C2','#51A6F1','#06C295','#4094F2'];
						$k = array_rand($array);
						$v = $array[$k];
						// for different color of class="images-alternate"
					@endphp
					<div class="image-alternate defualt-logo " >{{ucwords(substr($projVal->name, 0, 1))}}</div>
					</a>
				</div>
				
				<div class="col l8 s8 ">
					<a href="{{route('details.project', ['id' => $projVal->id])}}" data-toggle="popover" title="Click here to edit the project details title" data-content="TEST">
					<h5 class="project-title black-text flow-text truncate project-name" id="name" style="margin-bottom:0px">{{$projVal->name}}</h5>
					</a>
					<p class="project-detail truncate" style="margin-bottom:0px">
					{{$projVal->description}}
					</p>
				</div>
				<div class="col l3 s3 none sortable-data-div">
					<span class="sort_by_name">{{ucfirst($projVal->name)}}</span>
				</div>
			</div>
			<div class="row  project-data">
				<div class="col s12">
					<h3 class="project-title black-text flow-text truncate">DATA </h3>
					<p class="project-detail">
					Research based scientific framework to collect, manage,
					</p>
				</div>
			</div>

			<div class="card-action projects-tags">
					<span>Tags :</span>						
					<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" class="chip">Php Programmer</a>						
					<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" class="chip">Laravel</a>						
					<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" class="chip">Experianced</a>						
			</div>
			<div class="card-action projects-categories">
					<span>categories :</span>						
					<span class="badge">Management</span>					
					<span class="badge">HR</span>						
					<span class="badge">Hiring</span>				
			</div>
		</div>
	@endforeach

<div class="col l9 pt-15 right-align">
	{!! $projects->render() !!}
</div>