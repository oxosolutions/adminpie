@extends('layouts.main')
@section('content')
<style type="text/css">
	.tab:hover{
		    border-bottom: 2px solid #ee6e73;
		    color:#ee6e73 !important;
		    cursor: pointer;
	}

	.tab{
		 border-bottom: 2px solid #fff;
		 color:rgba(238,110,115,0.7)
	}
</style>
<div class="row">
	<div class="row l12 " style="margin-bottom: 0px;margin: 0px 10px;">
		<div class="card shadow" style="padding: 0% 20%">
			<div class="col l3 tab">
				<div class=" center-align p-5">
					<h5>Tasks</h5>
				</div>
			</div>
			<div class="col l3 tab">
				<div class=" center-align p-5">
					<h5>Bugs</h5>
				</div>
			</div>
			<div class="col l3 tab">
				<div class=" center-align p-5">
					<h5>Issue</h5>
				</div>
			</div>
			<div class="col l3 tab">
				<div class=" center-align p-5">
					<h5>Client Info</h5>
				</div>
			</div>
			<div style="clear: both">
				
			</div>
		</div>
	</div>
    <div class="col s12 m6 l2">
        <div class="card shadow">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator circle responsive-img" src="{{ asset('assets/images/sgs_sandhu.jpg') }}">
            </div>
            <div class="card-content center-align grey lighten-4">
                <span class=" grey-text text-darken-4">Project Name</span>
                <p><a href="#">This is a link</a></p>
            </div>
            <div class="card-reveal ">
                <span class="card-title grey-text text-darken-4">SMAART™ Framework<i class="material-icons right">close</i></span>
                <p>Here is some more information about this product that is only revealed once clicked on.</p>
            </div>
        </div>
    </div>

	<!-- Left Sidebar -->
	<!-- Center Content --> 
	<div class="col s12 m6 l8">
	    <div class="card shadow">
			<!-- Highlighted tabs -->
			{{-- <div class="row">
				<div class="col s12">
					<ul class="tabs">
						<li class="tab col s3"><a href="#test1">Tasks</a></li>
						<li class="tab col s3"><a class="active" href="#test2">Bugs</a></li>
						<li class="tab col s3"><a href="#test3">Issue</a></li>
						<li class="tab col s3"><a href="#test4">Client Info</a></li>
					</ul>
				</div>
				<div id="test1" class="col s12">Test 1</div>
				<div id="test2" class="col s12">Test 2</div>
				<div id="test3" class="col s12">Test 3</div>
				<div id="test4" class="col s12">Test 4</div>
			</div> --}}
			        a<br>
			        a<br>
			        a<br>
			        a<br>
			        a<br>
			        a<br>
			<!-- /highlighted tabs -->
	    </div>
	</div>
	<!-- Center Content -->
	<!-- Right Sidebar -->
	<div class="col s12 m6 l2">
	    <div class="card shadow">
	        <div class="card-content">
	            <span class="card-title activator blue-text text-darken-2">Clients<i class="material-icons">priority_high</i></span>
	            <div class="divider"></div>
	            <p class="p-20">
	            <div class="chip">Design <i class="close material-icons">close</i></div>
	            <div class="chip">Logo Design <i class="close material-icons">close</i></div>
	            <div class="chip">Graphics <i class="close material-icons">close</i></div>
	            <div class="chip">Designer <i class="close material-icons">close</i></div>
	            </p>
	        </div>
	    </div>
	    <div class="card shadow">
	        <div class="card-content">
	            <span class="card-title activator blue-text text-darken-2">Tags<i class="material-icons">priority_high</i></span>
	            <div class="divider"></div>
	            <p class="p-20">
	            <div class="chip">Custom Design <i class="close material-icons">close</i></div>
	            <div class="chip">Logo <i class="close material-icons">close</i></div>
	            <div class="chip">Amritsar <i class="close material-icons">close</i></div>
	            <div class="chip">Restaurant<i class="close material-icons">close</i></div>
	            <div class="chip">India<i class="close material-icons">close</i></div>
	            <div class="chip">Custom<i class="close material-icons">close</i></div>
	            </p>
	        </div>
	    </div>
	</div>
</div>

<style type="text/css">
    .attendance{
    }
    .input-group .form-control{
    margin-bottom: 8px;
    }
</style>
@endsection