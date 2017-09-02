@php
	//$userMeta = 'App\\Model\\Organization\\UsersMeta';
	//$queryString = explode('?',request()->fullUrl());
	
	//$userMeta::saveDataListSetting(request()->route()->uri,$queryString);
	
	
	// if($pageSettings != null){
	// 	$sessionSettings = session()->get('pageSettings');
	// 	if($sessionSettings != $pageSettings){
	// 		dump(url(request()->route()->uri));
	// 		header('Location:'.url(request()->route()->uri.'?'.$pageSettings));
	// 		session()->put('pageSettings',$pageSettings);
	// 	}
	// }
	// $newvalue = $userMeta::getDataListSettings(request()->route()->uri);
	// session()->put('pageSettings',$newvalue);

	//
	
/*
$pageSettings = $userMeta::getDataListSettings(request()->route()->uri);

echo "<br>From URL=====";
echo "<pre>";
print_r($queryString);
echo "</pre>";

echo "<br>From Database=====";
echo "<pre>";
print_r($pageSettings);
echo "</pre>";

echo "<br>temp=====";
echo "<pre>";
print_r(request()->fullUrl());
echo "</pre>";


echo "<br>temp=====";
echo "<pre>";
print_r($showColumns);
echo "</pre>";
*/

$columns = $showColumns;

$total_columns = count($columns);
$column_classes = "column aione-column columns-".$total_columns;
$class_list = array();
foreach($columns as $column){
	if(is_array($column)){
		$class_list[] = "aione-column-".strtolower(str_replace(' ', '-', $column['title']));
	} else {
		$class_list[] = "aione-column-".strtolower(str_replace(' ', '-', $column));
	}
	
}

@endphp
<div id="aione_datalist" class="aione-datalist">
	<div class="aione-row">
	
		<form action="" method="GET" name="form1">
		@if(Request::get('page'))
			<input type="hidden" name="page" value="1">
		@endif
		
		<div id="aione_datalist_header" class="aione-datalist-header">
			<div class="aione-row">
			
				<!---------------- AIONE FILTERS ---------------->
				<div id="aione_filters" class="aione-filters">
					<div class="aione-filter aione-select-view">
						<div class="aione-switch-view">
							<ul class="views" >
								<li class="view"><a href="#list-view" class="view-selector" title="List View" data-view="list-view"><i class="material-icons" >view_list</i></a></li>
								<li class="view"><a href="#detail-view" class="view-selector" title="Detail View" data-view="detail-view"><i class="material-icons" >view_stream</i></a></li>
								<li class="view"><a href="#grid-view" class="view-selector" title="Grid View" data-view="grid-view"><i class="material-icons" >view_module</i></a></li>
							</ul>
						</div>
						
					</div> <!-- .aione-filter -->
					<div class="aione-filter aione-page-items">
						<select class="browser-default aione-field" name="items" onchange="document.form1.submit();">
							<option value="" disabled selected>Items</option>
							<option value="5" {{(Request::get('items') && Request::get('items') == '5')?'selected':''}}>5</option>
							<option value="10" {{(Request::get('items') && Request::get('items') == '10')?'selected':''}}>10</option>
							<option value="25" {{(Request::get('items') && Request::get('items') == '25')?'selected':''}}>25</option>
							<option value="50" {{(Request::get('items') && Request::get('items') == '50')?'selected':''}}>50</option>
							<option value="75" {{(Request::get('items') && Request::get('items') == '75')?'selected':''}}>75</option>
							<option value="100" {{(Request::get('items') && Request::get('items') == '100')?'selected':''}}>100</option>
							<option value="all" {{(Request::get('items') && Request::get('items') == 'all')?'selected':''}}>All</option> 				
						</select>
					</div> <!-- .aione-filter -->
					<div class="aione-filter aione-search-field">
						<input id="search" class="browser-default" type="search" placeholder="Search" name="search" value="{{Request::get('search') }}">
					</div> <!-- .aione-filter -->
					<div class="clear"></div> <!-- .clear -->
				</div> <!-- #aione_filters -->
				<!---------------- END AIONE FILTERS ---------------->
			
			</div> <!-- .aione-row -->
		</div> <!-- #aione_datalist_header -->
		<div id="aione_datalist_content" class="aione-datalist-content">
			<div class="aione-row">
			
			
			<div class="col s6 m6 l3  aione-field-wrapper pl-7 tab-mt-10" style="display: none;">
					<div class="row aione-sort" onchange="document.form1.submit();">
						<select class="col  browser-default aione-field" name="orderby" >
							<option value="" disabled selected>Sort By</option>
							@if(isset($showColumns))

								@foreach($showColumns as $key => $column)
									@php
										$explodedKey = explode('.',$key);
										if(count($explodedKey)>=2){
											$key = $explodedKey[count($explodedKey)-1];
										}
									@endphp
									<option value="{{$key}}" {{(Request::get('orderby') && Request::get('orderby') == $key)?'selected':''}}>
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
							<input type="hidden" name="order" value="{{@Request::get('order')}}" />
							<a href="javascript:;" class="sort"><i class="fa fa-sort-alpha-{{(Request::get('order')!= '')?Request::get('order'):'asc'}} arrow_sort white" ></i></a>
						</div>
					</div>
				</div>
			</form>
	
	
	<ul id="list" class="aione-datalist-items" >
		<li class="aione-datalist-item aione-datalist-header-item" >
			@foreach($showColumns as $k => $column)
				@if($loop->index == 0)
					<div class="{{$column_classes}} {{$class_list[$loop->index]}}">
					<span class="column-order" column-key="{{$k}}" style="cursor: pointer;">
						@if(is_array($column))
							{{$column['title']}}
						@else
							{{$column}}
						@endif
					<i class="fa fa-sort{{(Request::get('order') != '' && Request::get('orderby') == $k )?'-'.Request::get('order'):''}}" aria-hidden="true" style="margin-left: 10px"></i></span></div>
				@else
					@php
						$explodedKey = explode('.',$k);
						if(count($explodedKey)>=2){
							$k = $explodedKey[count($explodedKey)-1];
						}
					@endphp
					<div class="{{$column_classes}} {{$class_list[$loop->index]}}">
						<span class="column-order " column-key="{{$k}}" >
							@if(is_array($column))
								{{$column['title']}}
							@else

								{{$column}}
							@endif
							
								<i class="fa fa-sort{{(Request::get('order') != '' && Request::get('orderby') == $k)?'-'.Request::get('order'):''}}" aria-hidden="true" style="margin-left: 10px; cursor: pointer;"></i>
							
						</span>
					</div>
				@endif
			@endforeach
			<div class="clear"></div> <!-- .clear -->
		</li> 	<!-- .aione-datalist-header-item -->

		@foreach($datalist as $dataset)
			<li class="aione-datalist-item" >
				<div class="aione-datalist-item-wrapper">
					@foreach($showColumns as $k => $column)
						@if($loop->index == 0)
							<div class="{{$column_classes}} {{$class_list[$loop->index]}}">
								<div class="row valign-wrapper">
									<div class="col">
										<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
											{{ucfirst(($dataset->{$k} != '')?$dataset->{$k}[0]:'0')}}
										</div>	
									</div>
									<div class="col" style="padding-left: 10px">
										<div> {!! (@$dataset->{$k} != '')?$dataset->{$k}:'<i>No data available</i>' !!}</div>
										@if(isset($actions))
											<div class="options" style=" display:{!! (@$dataset->{$k} == "Super Admin")?'none':''!!}">
												@foreach($actions as $action_key => $action_value)
													@if($action_key == 'download')
														<a href="{{asset($action_value['destinationPath'].'/'.$dataset->file)}}" style="padding-right:10px" target="_blank" class="{{@$action_value['class']}}">{{$action_value['title']}}</a>
													@elseif($action_key == 'delete')
														@php
															if(is_array($action_value['route'])){
																$explodedRoute = explode('.',$action_value['route']['id']);
																$route = $action_value['route']['route'];
																$routeId = $dataset[$explodedRoute[0]]['id'];

															}else{
																$route = $action_value['route'];
																$routeId = $dataset->id;
															}
														@endphp
														{{-- <a href="{{route($route,$routeId)}}" style="padding-right:10px" class="{{@$action_value['class']}}">{{$action_value['title']}}</a> --}}
														<a href="javascript:;" data-value="{{route($route,$routeId)}}" style="padding-right:10px" id="delete" class="{{@$action_value['class']}} delete-datalist-item red-text">{{$action_value['title']}}</a>
													@elseif($action_key == 'model')
														<a href="#" data-target="{{$action_value['data-target']}}" class="{{$action_value['class']}}" id="{{$dataset->id}}" style="padding-right:10px">{{$action_value['title']}}</a>
													@elseif($action_key == 'status_option')
														@if($dataset->status == 0)
															<a href="{{route($action_value['route'],$dataset->id)}}" class="{{$action_value['class']}}" style="padding-right:10px">Activate</a>
														@else
															<a href="{{route($action_value['route'],$dataset->id)}}" class="{{$action_value['class']}}" style="padding-right:10px">Deactivate</a>
														@endif
													@elseif($action_key == 'check_status')
														@if($dataset->status == 2)
															<a href="{{route($action_value['route'],$dataset->id)}}" class="{{$action_value['class']}}" style="padding-right:10px">Approve</a>
														@elseif($dataset->status == 0)

															<a href="{{route($action_value['route'],$dataset->id)}}" class="{{$action_value['class']}}" style="padding-right:10px">Approve</a>
															<a href="{{route($action_value['route'],$dataset->id)}}" class="{{$action_value['class']}}" style="padding-right:10px">Reject</a>
														@elseif($dataset->status == 1)
															<a href="{{route($action_value['route'],$dataset->id)}}" class="{{$action_value['class']}}" style="padding-right:10px">Reject</a>
														@endif
													@else
														@php

															if(is_array($action_value['route'])){
																if(!isset($action_value['route']['id'])){
																	$route = $action_value['route']['route'];
																	$routeId = $dataset['id'];
																}else{
																	$explodedRoute = explode('.',$action_value['route']['id']);
																	$route = $action_value['route']['route'];
																	$routeId = $dataset[$explodedRoute[0]]['id'];
																}
															}else{
																$route = $action_value['route'];
																$routeId = $dataset->id;
															}
															@endphp
															<a href="{{route($route,$routeId)}}" style="padding-right:10px" class="{{@$action_value['class']}}">{{$action_value['title']}}</a>
													@endif
												@endforeach

											</div>
										@endif

									</div>
								</div>

							</div>

						@else
							<div  class="{{$column_classes}} {{$class_list[$loop->index]}}">
								@php
									$relations = explode('.',$k);
									$getRelations = $dataset;
									$multipleValues = [];
									$multipleValuesForLoop = [];
								@endphp
									@if(count($relations)>1)
										@foreach($relations as $relKey => $relation)
											@php
												try{
													@$getRelations = $getRelations[$relation];
													/*if($getRelations instanceof Illuminate\Database\Eloquent\Collection){
														$multipleValuesForLoop[$relation] = $getRelations;
														continue;
													}else{
														foreach($multipleValuesForLoop as $relation => $multiVal){
															dump($multiVal);
															//$multipleValues[] = $multiVal->{$relation};
														}
													}*/
												}catch(\Exception $e){
													try{
														$getRelations = FormGenerator::GetMetaValue($getRelations, $relation);
													}catch(\Exception $e){
														$getRelations = 'Unable to get value';
													}
												}
											@endphp
										@endforeach
										@if(($getRelations == null || $getRelations == "") && empty($multipleValues))
											<div>&nbsp;</div>
										@elseif($getRelations === FALSE)
											<div>&nbsp;</div>
										{{-- @elseif(!empty($multipleValues))
											<span class="truncate"> {{implode(',',$multipleValues)}}</span> --}}
										@else
											<span class="truncate"> {{$getRelations}}</span>
										@endif

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
												}elseif($columnType == 'switch'){
													echo '<div class="switch"><label>';
													if($dataset->status == '0'){
														echo '<input type="checkbox" class="'.$column['class'].'">';
													}
													else{
														echo '<input type="checkbox" class="'.$column['class'].'" checked="checked">';
													}
													echo '<span class="lever"></span></label><input type="hidden" name="id" value="'.$dataset->id.'"></div>';
												}
												if($columnType == 'json'){
													$days = [];
													foreach (json_decode($dataset->{$k}) as $key => $value) {
														$days[] = ucfirst(substr($value, 0 , 2));
													}
													echo implode(',',$days);
												}
											}elseif($k == 'status'){
												if($dataset->{$k} == 1){
													$sts = 'active';
												}elseif($dataset->{$k} == 2){
													$sts = 'pending';
												}else{
													$sts = '';
												}
												echo '<span class="aione-status '.$sts.'"></span>';
											}elseif($k == 'link'){
												if($dataset->target == 'next_page'){
													$target = 'blank';
												}else{
													$target = '';
												}
												echo '<a href="'.$dataset->{$k}.'" target="'.$target.'">'.$dataset->{$k} .'</a>';												
											}else{
												echo $dataset->{$k};
											}
										@endphp
									@endif

							</div>	
						@endif

					@endforeach
					<div class="clear"></div> <!-- .clear -->
				</div>	<!-- .aione-datalist-item-wrapper -->
			</li>	<!-- .aione-datalist-item -->
		@endforeach

	</ul> 	<!-- .aione-datalist-items -->

			</div> <!-- .aione-row -->
		</div> <!-- #aione_datalist_content -->
		<div id="aione_datalist_footer" class="aione-datalist-footer">
			<div class="aione-row">
				<!----------------  AIONE PAGINATION ---------------->
				@if(!empty($datalist))
					{{$datalist->appends(request()->input())->render()}}
				@endif
				<!---------------- END AIONE PAGINATION ---------------->

			</div> <!-- .aione-row -->
		</div> <!-- #aione_datalist_footer -->
	</div> <!-- .aione-row -->
</div> <!-- #aione_datalist -->

<script type="text/javascript">

	$(function(){
		if($('input[name=order]').val() == ''){
			$('input[name=order]').val('asc');
		}
		$('.delete-datalist-item').click(function(){
				var elemValue = $(this).attr('data-value');
				swal({  
						title: "Are you sure?",
						text: "You will not be able to recover once deleted!", 
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Delete",
						closeOnConfirm: false }, function(){
						// swal("Deleted!", "Your imaginary file has been deleted.", "success");
						window.location.href = elemValue;
				});
		});
		
		$('.sort').click(function(){
			if($(this).find('i').hasClass('fa-sort-alpha-asc')){
				$(this).find('i').removeClass('fa-sort-alpha-asc');
				$(this).find('i').addClass('fa-sort-alpha-desc');
				$('input[name=order]').val('desc');
			}else{
				$('input[name=order]').val('asc');
				$(this).find('i').removeClass('fa-sort-alpha-desc');
				$(this).find('i').addClass('fa-sort-alpha-asc');
			}
			$('form[name=form1]').submit();
		});
		$('.column-order').click(function(){
			if($(this).find('i').hasClass('fa-sort-asc')){
				$(this).find('i').removeClass('fa-sort-asc');
				$(this).find('i').addClass('fa-sort-desc');
				$('input[name=order]').val('desc');
				$('.col').val($(this).attr('column-key'));
				$('.col').change();
			}else{
				$(this).find('i').removeClass('fa-sort-desc');
				$(this).find('i').addClass('fa-sort-asc');
				$('input[name=order]').val('asc');
				$('.col').val($(this).attr('column-key'));
				$('.col').val($(this).attr('column-key'));
				$('.col').change();
			}
		});
	});
</script>