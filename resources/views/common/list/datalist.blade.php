<div>
	<div >
		<div >
			<form action="" method="GET" name="form1">
				@if(Request::get('page'))
					<input type="hidden" name="page" value="1">
				@endif
				
				<div id="aione_filters" class="aione-filters">
					<div class="aione-filter aione-search-field">
						<input id="search" class="browser-default" type="search" placeholder="Search" name="search" value="{{Request::get('search') }}">
					</div> <!-- .aione-filter -->
					<div class="aione-filter aione-select-view">
						<div class="aione-switch-view">
							<ul class="views" >
								<li class="inline-block" ><a href="#list-view" class=" view" data-view="list-view"><i class="material-icons" >view_list</i></a></li>
								<li class="inline-block" ><a href="#detail-view" class=" view" data-view="detail-view"><i class="material-icons" >view_stream</i></a></li>
								<li class="inline-block" ><a href="#grid-view" class=" view" data-view="grid-view"><i class="material-icons" >view_module</i></a></li>
							</ul>
						</div>
						
					</div> <!-- .aione-filter -->
					<div class="aione-filter aione-page-items">
						<select class="browser-default aione-field" name="per_page" onchange="document.form1.submit();">
							<option value="" disabled selected>Items</option>
							<option value="5" {{(Request::get('per_page') && Request::get('per_page') == '5')?'selected':''}}>5</option>
							<option value="10" {{(Request::get('per_page') && Request::get('per_page') == '10')?'selected':''}}>10</option>
							<option value="25" {{(Request::get('per_page') && Request::get('per_page') == '25')?'selected':''}}>25</option>
							<option value="50" {{(Request::get('per_page') && Request::get('per_page') == '50')?'selected':''}}>50</option>
							<option value="75" {{(Request::get('per_page') && Request::get('per_page') == '75')?'selected':''}}>75</option>
							<option value="100" {{(Request::get('per_page') && Request::get('per_page') == '100')?'selected':''}}>100</option>
							<option value="all" {{(Request::get('per_page') && Request::get('per_page') == 'all')?'selected':''}}>All</option> 				
						</select>
						
					</div> <!-- .aione-filter -->
					<div class="clear"></div> <!-- .clear -->
				</div> <!-- #aione_filters -->

<style>
.aione-filters{
	
}
.aione-filters .aione-filter{
	
}
.aione-filters .aione-filter.aione-search-field{
	
}
.aione-filters .aione-filter.aione-select-view{
	width:200px;
	float:right;
}
.aione-filters .aione-filter.aione-page-items{
	width:200px;
	float:right;
	margin-right: 10px;
}


.aione-switch-view{
	border:1px solid #e8e8e8;
	padding: 5.5px
}
.aione-switch-view ul{
	width: 100% !important;
	text-align: center;
}
.aione-switch-view > ul > li{
	border:1px solid #e8e8e8;
	line-height: 0px;
	padding:2px;
	width: 31%;
	text-align: center;
}
.aione-switch-view > ul > li > a{
	display: block;
}
.aione-switch-view i{
	color:#434c47;
}
.aione-switch-view > ul > li:hover{
	background-color: #0288D1;
	color:#fff !important;
}
.aione-switch-view > ul > li:hover i{
	color: #fff;
}
.aione-sort{
	border:1px solid #e8e8e8;
	padding: 7px
}
.aione-sort select{
	height:30px;width: 75%;
}
.aione-sort i{
	line-height: 28px;
	float: right;
	width: 100%;
}
</style>

				
				
				<div class="col s6 m6 l3  aione-field-wrapper pl-7 tab-mt-10" style="display: none;">
					<div class="row aione-sort" onchange="document.form1.submit();">
						<select class="col  browser-default aione-field" name="sort_by" >
							<option value="" disabled selected>Sort By</option>

							@if(isset($showColumns))
								@foreach($showColumns as $key => $column)
									@php
										$explodedKey = explode('.',$key);
										if(count($explodedKey)>=2){
											$key = $explodedKey[count($explodedKey)-1];
										}
									@endphp
									<option value="{{$key}}" {{(Request::get('sort_by') && Request::get('sort_by') == $key)?'selected':''}}>
										@if(is_array($column))
											{{$column['title']}}
										@else
											{{$column}}
										@endif
									</option>
									}
								@endforeach
							@endif
						</select>
						<div class="col alpha-sort" style="width: 25%;padding-left:7px;">
							<input type="hidden" name="desc_asc" value="{{@Request::get('desc_asc')}}" />
							<a href="javascript:;" class="sort"><i class="fa fa-sort-alpha-{{(Request::get('desc_asc')!= '')?Request::get('desc_asc'):'asc'}} arrow_sort white" ></i></a>
						</div>
					</div>
				</div>
				

			</form>
		</div>
	</div>
	<ul class="list" id="list" style="min-height: 400px;margin-top: 14px;border:1px solid #e8e8e8;">
		<li class="row" style="padding:5px 10px;font-size: 13px;font-weight: 500;">
			@foreach($showColumns as $k => $column)
				@if($loop->index == 0)

					<div class="col" style="width: {{100/count($showColumns)}}%"><span class="column-order" column-key="{{$k}}" style="cursor: pointer;">
						@if(is_array($column))
							{{$column['title']}}
						@else
							{{$column}}
						@endif
					<i class="fa fa-sort{{(Request::get('desc_asc') != '' && Request::get('sort_by') == $k )?'-'.Request::get('desc_asc'):''}}" aria-hidden="true" style="margin-left: 10px"></i></span></div>
				@else
					@php
						$explodedKey = explode('.',$k);
						if(count($explodedKey)>=2){
							$k = $explodedKey[count($explodedKey)-1];
						}
					@endphp
					<div class="col" style="width: {{100/count($showColumns)}}%">
						<span style="cursor: pointer;" class="column-order" column-key="{{$k}}">
							@if(is_array($column))
								{{$column['title']}}
							@else
								{{$column}}
							@endif
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
													@if($action_key == 'download')
														<a href="{{asset($action_value['destinationPath'].'/'.$dataset->file)}}" style="padding-right:10px" target="_blank" class="{{@$action_value['class']}}">{{$action_value['title']}}</a>
													@elseif($action_key == 'delete')
														<a href="javascript:;" data-value="{{route($action_value['route'],$dataset->id)}}" style="padding-right:10px" id="delete" class="{{@$action_value['class']}} delete-datalist-item">{{$action_value['title']}}</a>
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
							<div class="col " style="width: {{100/count($showColumns)}}%">
								@php
									$relations = explode('.',$k);
									$getRelations = $dataset;
								@endphp
								@if(count($relations)>1)
									@foreach($relations as $relKey => $relation)
										@php
											try{
												$getRelations = $getRelations[$relation];
											}catch(\Exception $e){
												try{
													$getRelations = FormGenerator::GetMetaValue($getRelations, $relation);
												}catch(\Exception $e){
													$getRelations = 'Unable to get value';
												}
											}
										@endphp
									@endforeach
									{{$getRelations}}
								@elseif($k == 'created_at' || $k == 'updated_at')
									{{ $dataset->{$k}->diffForHumans() }}
								@else
									@php
										$options = explode(':',$k);
										$colType = [];
										if(@$options[1] != null){
											if($options[1] == 'human_readable'){
												echo Carbon\Carbon::parse($dataset->{$options[0]})->format('d M');
											}
										}elseif(is_array($column)){
											$columnType = $column['type'];
											if($columnType == 'image'){
												echo '<img src="'.asset($column['imagePath'].''.$dataset->{$k}).'" style="width:30px" >';
											}
										}else{
											echo $dataset->{$k};
										}
									@endphp
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

<script type="text/javascript">

	$(function(){
		if($('input[name=desc_asc]').val() == ''){
			$('input[name=desc_asc]').val('asc');
		}
		$('.delete-datalist-item').click(function(){
				var elemValue = $(this).attr('data-value');
				swal({  
						title: "Are you sure?",
						text: "You will not be able to recover this imaginary file!",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Yes, delete it!",
						closeOnConfirm: false }, function(){
						// swal("Deleted!", "Your imaginary file has been deleted.", "success");
						window.location.href = elemValue;
				});
		});
		
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