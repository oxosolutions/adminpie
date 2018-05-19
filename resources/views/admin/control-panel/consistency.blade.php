@extends('admin.layouts.main')
@section('content')
<style type="text/css">
	.delete-all{
		display: none;
	}
</style>
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
				<div class="pv-20 display-inline-block">Result:-</div>
                {!! Form::open(['route'=>'bulk.delete.directories']) !!}
    				<button class="aione-button float-right red delete-all"><i class="fa fa-trash ph-5"></i>Delete Selected</button>
    				<div class="aione-border" style="min-height: 300px;max-height: 300px;overflow: auto">

    					<div class="aione-table">
    						<table>
    							<thead>
    								<tr>
    									<th>
    										<input type="checkbox" name="select_all_dir" id="checkbox_all">
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
        										
        										<input type="checkbox" name="select_dir[]" id="checkbox_1" class="select_dir_check" value="{{ $dir }}">
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
                {!! Form::close() !!}
			</div>
		</div>
		<div class="aione-border">
			<div class="bg-grey p-10 bg-lighten-3	">
				Database Consistency
			</div>
			<div class=" p-10">
                {!! Form::open(['route'=>'consistency.control']) !!}
                    <button type="submit" name="conistancy_database" value="cons">Check Database Consistancy</button>
                {!! Form::close() !!}
				<div class="pv-20">Result:-</div>
				<div class="aione-border" style="min-height: 300px;max-height: 300px;overflow: auto">
					<div class="aione-table">
                        {!! Form::open(['route'=>'bulk.delete.tables','id'=>'bulk_delete_tables_form']) !!}
    						<table>
    							<thead>
    								<tr>
    									<th>
    										<input type="checkbox" name="" id="check_all" class="check_all">
    										<label for="check_all" class="ph-10">Select All</label>
    									</th>
    									<th>Database List</th>
    									<th>Actions <a href="javascript:;" class="delete_selected"><i class="fa fa-trash ph-5"></i>Delete Selected</a></th>
    									
    									
    								</tr>
    							</thead>
    							<tbody>
                                    @php
                                        if(session()->has('list_tables')){
                                            $list_tables = session('list_tables');
                                        }
                                    @endphp
                                    @foreach($list_tables as $key => $table)
        								<tr>
        									<td>
        										<input type="checkbox" name="tables[]" id="checkbox_{{ $loop->index }}" class="table_check" value="{{ $table }}">
        										<label for="checkbox_{{ $loop->index }}" class="ph-10">Select</label>
        									</td>
        									<td class="font-weight-700"> <i class="fa fa-database blue"></i> {{ $table }}</td>
        									<td><a href="{{ route('remove.specific.table',['token'=>session('remove_token'),'table'=>$table]) }}" onclick="return confirm('Are you sure to delete this table?')"><i class="fa fa-trash ph-5"></i>Delete</a></td>
        								</tr>
                                    @endforeach
    							</tbody>
    						</table>
                        {!! Form::close() !!}
					</div>
				</div>	
			</div>
		</div>
		<div class="ar aione-align-center">
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
        $('#checkbox_all').click(function(){
            if($(this).is(':checked')){
                $('.delete-all').fadeIn(300);
                $('.select_dir_check').each(function(){
                    $(this).prop('checked',true);
                });
            }else{
                $('.delete-all').fadeOut(300);
                $('.select_dir_check').each(function(){
                    $(this).prop('checked',false);
                });
            }
        });
        $('.select_dir_check').click(function(){
           if($(this).is(':checked')){
                $('.delete-all').fadeIn(300);
           }
           var status = false;
           $('.select_dir_check').each(function(){
                if($(this).is(':checked')){
                    status = true;
                }
           });
           if(status == true){
                $('.delete-all').fadeIn(300);
           }else{
                $('.delete-all').fadeOut(300);
           }
        });

        $('.check_all').click(function(){
            var elem = $(this);
            $('.table_check').each(function(){
                if(elem.is(':checked')){
                    $(this).prop('checked',true);
                }else{
                    $(this).prop('checked',false);
                }
            });
        });

        $('.delete_selected').click(function(){
            if(confirm('Are you sure?')){
                $('#bulk_delete_tables_form').submit(); 
            }
        });
    });
</script>
@endsection