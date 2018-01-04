@extends('admin.layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'no',
	'page_title' => 'Control Panel',
	'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		@include('admin.control-panel._tabs')
		<div class="aione-border mb-15">
			<div class="bg-grey p-10 bg-lighten-3	">
				File Consistency
			</div>
			<div class=" p-10">
                {!! Form::open(['route'=>'consistency.control']) !!}
				    <button type="submit" name="conistancy" value="cons">Check File Consistancy</button>
                {!! Form::close() !!}
				<div class="pv-20">Result:-</div>
				<div class="aione-border" style="min-height: 300px;max-height: 300px;overflow: auto">
					<div class="aione-table">
						<table>
							<thead>
								<tr>
									<th>
										<input type="checkbox" name="" id="checkbox_all">
										<label for="checkbox_all" class="ph-10">Select All</label>
									</th>
									<th>Directories List</th>
									<th>Actions <a href=""><i class="fa fa-trash ph-5"></i>Delete Selected</a></th>
									
									
								</tr>
							</thead>
							<tbody>
                                @php
                                    if(session()->has('dir_list')){
                                        $dir_list = session('dir_list');
                                    }
                                @endphp
                                @foreach($dir_list as $key => $dir)
    								<tr>
    									<td>
    										
    										<input type="checkbox" name="" id="checkbox_1">
    										<label for="checkbox_1" class="ph-10"></label>
    									</td>
    									<td class="font-weight-700" title="{{ url('/') }}/public/{{ $dir }}"> <i class="fa fa-folder grey"></i> {{ $dir }}</td>
    									<td><a href="{{ route('remove.specific.directory',['dir'=>$dir]) }}" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash ph-5"></i>Delete</a></td>
    									
    								</tr>
                                @endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="aione-border">
			<div class="bg-grey p-10 bg-lighten-3	">
				Database Consistency
			</div>
			<div class=" p-10">
				<button>Check Database Consistancy</button>
				<div class="pv-20">Result:-</div>
				<div class="aione-border" style="min-height: 300px;max-height: 300px;overflow: auto">
					<div class="aione-table">
						<table>
							<thead>
								<tr>
									<th>
										<input type="checkbox" name="" id="checkbox_all">
										<label for="checkbox_all" class="ph-10">Select All</label>
									</th>
									<th>Database List</th>
									<th>Actions <a href=""><i class="fa fa-trash ph-5"></i>Delete Selected</a></th>
									
									
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										
										<input type="checkbox" name="" id="checkbox_1">
										<label for="checkbox_1" class="ph-10">Select</label>
									</td>
									<td class="font-weight-700"> <i class="fa fa-folder grey"></i> scolm_175_formsscolm_175_formsscolm_175_formsscolm_175_forms</td>
									<td><a href=""><i class="fa fa-trash ph-5"></i>Delete</a></td>
									
								</tr>
								<tr>
									<td>
										<input type="checkbox" name="" id="checkbox_2"> 
										<label for="checkbox_2" class="ph-10">Select</label>
									</td>
									<td class="font-weight-700"> <i class="fa fa-folder grey"></i> scolm_175_forms</td>
									<td><a href=""><i class="fa fa-trash ph-5"></i>Delete</a></td>
									
								</tr>
								<tr>
									<td>
										<input type="checkbox" name="" id="checkbox_3">
										<label for="checkbox_3" class="ph-10">Select</label>
									</td>
									<td class="font-weight-700"> <i class="fa fa-folder grey"></i> scolm_175_forms</td>
									<td><a href=""><i class="fa fa-trash ph-5"></i>Delete</a></td>
									
								</tr>
								<tr>
									<td>
										<input type="checkbox" name="" id="checkbox_4">
										<label for="checkbox_4" class="ph-10">Select</label>
									</td>
									<td class="font-weight-700"> <i class="fa fa-folder grey"></i> scolm_175_forms</td>
									<td><a href=""><i class="fa fa-trash ph-5"></i>Delete</a></td>
									
								</tr>
								
								<tr>
									<td>
										<input type="checkbox" name="" id="checkbox_2"> 
										<label for="checkbox_2" class="ph-10">Select</label>
									</td>
									<td class="font-weight-700"> <i class="fa fa-folder grey"></i> scolm_175_forms</td>
									<td><a href=""><i class="fa fa-trash ph-5"></i>Delete</a></td>
									
								</tr>
								<tr>
									<td>
										<input type="checkbox" name="" id="checkbox_3">
										<label for="checkbox_3" class="ph-10">Select</label>
									</td>
									<td class="font-weight-700"> <i class="fa fa-folder grey"></i> scolm_175_forms</td>
									<td><a href=""><i class="fa fa-trash ph-5"></i>Delete</a></td>
									
								</tr>
								<tr>
									<td>
										<input type="checkbox" name="" id="checkbox_4">
										<label for="checkbox_4" class="ph-10">Select</label>
									</td>
									<td class="font-weight-700"> <i class="fa fa-folder grey"></i> scolm_175_forms</td>
									<td><a href=""><i class="fa fa-trash ph-5"></i>Delete</a></td>
									
								</tr>
							</tbody>
						</table>
					</div>
				</div>	
			</div>
		</div>
		<div class="ar aione-align-center
		">
			<div class="ac l50 aione-border-right p-20">
				
			</div>
			<div class="ac l50 p-20	">
				
			</div>
		</div>
		
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')

	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<script type="text/javascript">
    $(document).ready(function(){
         
    });
</script>
@endsection