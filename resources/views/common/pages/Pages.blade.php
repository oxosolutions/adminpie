@extends('layouts.main')
@section('content')

<div class="content">
	<div class="row">
	<div class="col-md-12">
	{!! Form::open(['route' => 'store.pages' ,'method' => 'POST','class' => 'form-horizontal']) !!}

			<div class="row">
				<div class="col-md-12 ">
					<div class="panel panel-flat">

						<div class="panel-body">
							<div class="form-group">
								<label class="col-lg-2 control-label">Enter Page Title</label>
								<div class="col-lg-9">
								{!! Form::text('page_title',null,['class' => 'form-control' , 'placeholder' => 'Enter Page Title']) !!}
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Enter Description</label>
								<div class="col-lg-9">
								{!! Form::textarea('content',null,['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Slug</label>
								<div class="col-lg-9">
								{!! Form::text('page_slug',null,['class' => 'form-control' , 'placeholder' => 'Page Slug']) !!}		 
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Image</label>
								<div class="col-lg-9">
									<div class="uploader">
										 <input class="file-styled" name="page_image" type="file">
										{{-- {!! Form::file('page_image') !!}	 --}}
										<span class="filename" style="-moz-user-select: none;">No file selected</span>
										<span class="action btn bg-pink-400" style="-moz-user-select: none;">Choose File</span>
									</div>
								</div>
							</div>					
							<div class="text-right">
								<button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>
</div>



@endsection