@extends('layouts.main')
@section('content')
	
<div class="fade-background">
</div>
<div id="charts" class="projects list-view">
	<div class="row">
		<div class="col s12 m9 l9 pr-7" >
			<div class="list">

				<div class="card-panel shadow white z-depth-1 hoverable project">
					<div class="row valign-wrapper no-margin-bottom">
						<div class="col l12">
							<img src="https://plot.ly/~RhettAllain/574.png">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col s12 m3 l3 card-panel shadow z-depth-1 hoverable project">
			<div class="row valign-wrapper no-margin-bottom filters">
				<h5 style="width: 300px;text-align: center;">Filters</h5>
			</div>
		</div>
		
	</div>
</div>


@endsection
