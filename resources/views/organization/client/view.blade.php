@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Edit Customer',
	'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)
<style type="text/css">
	.view-detail > div >div{
		padding: 10px;
		border-bottom: 1px solid #37474f;
	}
	.tb_head{
		font-weight: 600;
	}
</style>
	{{-- <div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12 ">
					<div class="panel panel-flat ">
						<div class="panel-body view-detail">
							<div class="form-group">
								<div class="col-lg-3 tb_head">
									Name
								</div>
								<div class="col-lg-9">
									{{$detail->name}}
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-3 tb_head">
									Company Name
								</div>
								<div class="col-lg-9">
									{{$detail->company_name}}
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-3 tb_head">
									Address
								</div> 
								<div class="col-lg-9">
									{{$detail->address}}
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-3 tb_head">
									country
								</div>
								<div class="col-lg-9">
									{{$detail->country}}
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-3 tb_head">
									state
								</div>
								<div class="col-lg-9">
									{{$detail->state}}
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-3 tb_head">
									City
								</div>
								<div class="col-lg-9">
									{{$detail->city}}
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-3 tb_head">
									Email
								</div>
								<div class="col-lg-9">
									{{$detail->email}}
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-3 tb_head">
									Phone
								</div>
								<div class="col-lg-9">
									{{$detail->phone}}
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-3 tb_head">
									Additional Info
								</div>		
								<div class="col-lg-9">
									{{$detail->additional_info}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> --}}
	
	<div class="aione-table">
		<table>
			<thead>
				<tr>
					<th>key</th>
					<th>Value</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Name</td>
					<td>{{$detail->name}}</td>
				</tr>
				<tr>
					<td>Company Name</td>
					<td>{{$detail->company_name}}</td>
				</tr>
				<tr>
					<td>Address</td>
					<td>{{$detail->address}}</td>
				</tr>
				<tr>
					<td>country</td>
					<td>{{$detail->country}}</td>
				</tr>
				<tr>
					<td>state</td>
					<td>{{$detail->state}}</td>
				</tr>
				<tr>
					<td>City</td>
					<td>{{$detail->city}}</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>{{$detail->email}}</td>
				</tr>
				<tr>
					<td>Phone</td>
					<td>{{$detail->phone}}</td>
				</tr>
				<tr>
					<td>Additional Info</td>
					<td>{{$detail->additional_info}}</td>
				</tr>
			</tbody>
		</table>
	</div>

	
@endsection()