<div class="col s12 m12 l12 " >
	<div class="row no-margin-bottom">
		<div class="col l12">
			<form action="" method="GET" name="form1">
				@if(Request::get('page'))
					<input type="hidden" name="page" value="1">
				@endif
				<div class="col s12 m12 l7  pr-7 tab-mt-10" >
					<!-- <input class="search aione-field" placeholder="Search" /> -->
					<nav>
					    <div class="nav-wrapper">
				      		{{-- {{csrf_field()}} --}}
					        <div class="input-field">
					          	<input id="search" type="search" style="background-color: #ffffff; color: #000;" name="search" value="{{Request::get('search') }}">
					          	<label class="label-icon" for="search" style=""><i class="material-icons icon-search" >search</i></label>
					          	<i class="material-icons icon-close">close</i>
					        </div>
					    </div>
					</nav>
				</div>
				<div class="col s6 m6 l3  aione-field-wrapper pl-7 tab-mt-10" style="display: none;">
					<div class="row aione-sort" onchange="document.form1.submit();">
						<select class="col  browser-default aione-field" name="sort_by" >
							<option value="" disabled selected>Sort By</option>
							@if(isset($showColumns))
								@foreach($showColumns as $key => $column)
									<option value="{{$key}}" {{(Request::get('sort_by') && Request::get('sort_by') == $key)?'selected':''}}>{{$column}}</option>
								@endforeach
							@endif
						</select>
						<div class="col alpha-sort" style="width: 25%;padding-left:7px;">
							<input type="hidden" name="desc_asc" value="{{@Request::get('desc_asc')}}" />
							<a href="javascript:;" class="sort"><i class="fa fa-sort-alpha-{{(Request::get('desc_asc')!= '')?Request::get('desc_asc'):'asc'}} arrow_sort white" ></i></a>
						</div>
					</div>
				</div>
			<div class="col s6 m6 l3 pl-7 pr-7 tab-mt-10 tab-pl-10">
				<div class="row aione-switch-view">
					<ul class="right  views m-0" >
						<li class="inline-block" sty><a href="#list-view" class=" view" data-view="list-view"><i class="material-icons" >view_list</i></a></li>
						<li class="inline-block" ><a href="#detail-view" class=" view" data-view="detail-view"><i class="material-icons" >view_stream</i></a></li>
						<li class="inline-block" ><a href="#grid-view" class=" view" data-view="grid-view"><i class="material-icons" >view_module</i></a></li>
					</ul>
				</div>
			</div>
			<div class="col l2 pl-7">
				<select class="browser-default aione-field" name="per_page" onchange="document.form1.submit();">
					<option value="" disabled selected>Records per page</option>
						<option value="5" {{(Request::get('per_page') && Request::get('per_page') == '5')?'selected':''}}>5</option>
						<option value="10" {{(Request::get('per_page') && Request::get('per_page') == '10')?'selected':''}}>10</option>
						<option value="25" {{(Request::get('per_page') && Request::get('per_page') == '25')?'selected':''}}>25</option>
						<option value="50" {{(Request::get('per_page') && Request::get('per_page') == '50')?'selected':''}}>50</option>
						<option value="75" {{(Request::get('per_page') && Request::get('per_page') == '75')?'selected':''}}>75</option>
						<option value="100" {{(Request::get('per_page') && Request::get('per_page') == '100')?'selected':''}}>100</option>
						<option value="all" {{(Request::get('per_page') && Request::get('per_page') == 'all')?'selected':''}}>All</option> 				
				</select>
			</div>
			</form>
		</div>
		
		
	</div>

	<ul class="list" id="list" style="min-height: 400px;margin-top: 14px;border:1px solid #e8e8e8;">
		<li class="row" style="padding:5px 10px;font-size: 13px;font-weight: 500;">
			@foreach($showColumns as $k => $column)
				@if($loop->index == 0)
					<div class="col" style="width: {{100/count($showColumns)}}%"><span class="column-order" column-key="{{$k}}" style="cursor: pointer;">{{$column}}<i class="fa fa-sort{{(Request::get('desc_asc') != '' && Request::get('sort_by') == $k )?'-'.Request::get('desc_asc'):''}}" aria-hidden="true" style="margin-left: 10px"></i></span></div>
				@else
					<div class="col right-align" style="width: {{100/count($showColumns)}}%">
						<span style="cursor: pointer;" class="column-order" column-key="{{$k}}">
							{{$column}}
							@if($k != 'created_at' && $k != 'updated_at')
								<i class="fa fa-sort{{(Request::get('desc_asc') != '' && Request::get('sort_by') == $k)?'-'.Request::get('desc_asc'):''}}" aria-hidden="true" style="margin-left: 10px; cursor: pointer;"></i>
							@endif
						</span>
					</div>
				@endif
			@endforeach
		</li>
		<div class="divider"></div>
		@foreach($datalist as $dataset)
			<li class="row hover-me" style="padding:14px">
				<div class="row valign-wrapper">
					@foreach($showColumns as $k => $column)
						@if($loop->index == 0)
							<div class="col" style="width: {{100/count($showColumns)}}%">
								<div class="row valign-wrapper">
									<div class="col">
										<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
											{{ucfirst(($dataset->{$k} != '')?$dataset->{$k}[0]:'0')}}
										</div>	
									</div>
									<div class="col" style="padding-left: 10px">
										<div> {!! ($dataset->{$k} != '')?$dataset->{$k}:'<i>No data available</i>' !!}</div>
										@if(isset($actions))
											<div class="options">
												@foreach($actions as $action_key => $action_value)
													@if($action_value['title'] == 'Delete')
														<a href="javascript:;" data-value="{{route($action_value['route'],$dataset->id)}}" onclick="deleteAlert()" style="padding-right:10px" id="delete" class="{{@$action_value['class']}}">{{$action_value['title']}}</a>
													@else
														<a href="{{route($action_value['route'],$dataset->id)}}" style="padding-right:10px" class="{{@$action_value['class']}}">{{$action_value['title']}}</a>
													@endif
												@endforeach
											</div>
										@endif
									</div>
								</div>

							</div>
						@else
							<div class="col right-align" style="width: {{100/count($showColumns)}}%">
								{{-- @php
									$relations = explode('.',$k);
								@endphp
								@if(count($relations)>1)
									@php
										$collection = '';
										foreach($relations as $relKey => $relValue):
											if($collection == ''){
												$collection = $dataset->{$relValue};
											}else{
												$collection = $collection->$relValue;
											}
										endforeach										
									@endphp
									{{ dd($collection) }}
									{{ $dataset->{implode('->',$relations)} }}
									{{ $dataset->section->count() }}
								@else
									{{ $dataset->{$k} }}
								@endif --}}
								@if($k == 'created_at' || $k == 'updated_at')
									{{ $dataset->{$k}->diffForHumans() }}
								@else
									{{ $dataset->{$k} }}
								@endif
							</div>	
						@endif
					@endforeach
				</div>
			</li>			
		@endforeach
	</ul>
	{{$datalist->appends(request()->input())->render()}}
</div>
{{-- <div class="col s3">
						
					</div> --}}
<style type="text/css">
	.pagination li.active{
		background-color:#2196F3;
		color: white;
	}
	.pagination li{
		    padding: 0 10px;
    line-height: 30px;

	}
	.options{
		position: absolute;
		font-size: 14px;
		display: none;
		margin-top:-3px;
	}
	.hover-me:hover .options{
		display: block;
	}
	#list li:nth-child(even) {background: #F9F9F9}
	#list li:nth-child(odd) {background: #FFF}
</style>
<script type="text/javascript">
	function deleteAlert(){
			swal({  title: "Are you sure?",
					text: "You will not be able to recover this imaginary file!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, delete it!",
					closeOnConfirm: false }, function(){
						// swal("Deleted!", "Your imaginary file has been deleted.", "success");
						alert(this.attr('data-value'));
					});
		}
	$(function(){
		if($('input[name=desc_asc]').val() == ''){
			$('input[name=desc_asc]').val('asc');
		}
		
		$('.sort').click(function(){
			if($(this).find('i').hasClass('fa-sort-alpha-asc')){
				$(this).find('i').removeClass('fa-sort-alpha-asc');
				$(this).find('i').addClass('fa-sort-alpha-desc');
				$('input[name=desc_asc]').val('desc');
			}else{
				$('input[name=desc_asc]').val('asc');
				$(this).find('i').removeClass('fa-sort-alpha-desc');
				$(this).find('i').addClass('fa-sort-alpha-asc');
			}
			$('form[name=form1]').submit();
		});
		$('.column-order').click(function(){
			if($(this).find('i').hasClass('fa-sort-asc')){
				$(this).find('i').removeClass('fa-sort-asc');
				$(this).find('i').addClass('fa-sort-desc');
				$('input[name=desc_asc]').val('desc');
				$('.col').val($(this).attr('column-key'));
				$('.col').change();
			}else{
				$(this).find('i').removeClass('fa-sort-desc');
				$(this).find('i').addClass('fa-sort-asc');
				$('input[name=desc_asc]').val('asc');
				$('.col').val($(this).attr('column-key'));
				$('.col').val($(this).attr('column-key'));
				$('.col').change();
			}
		});
	});
</script>