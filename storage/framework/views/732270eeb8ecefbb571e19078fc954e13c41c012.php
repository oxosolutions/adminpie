<?php 
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
*/
 ?>

<div id="aione_datalist" class="aione-datalist">
	<div class="aione-row">
	
		<form action="" method="GET" name="form1">
		<?php if(Request::get('page')): ?>
			<input type="hidden" name="page" value="1">
		<?php endif; ?>
		
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
						<select class="browser-default aione-field" name="per_page" onchange="document.form1.submit();">
							<option value="" disabled selected>Items</option>
							<option value="5" <?php echo e((Request::get('per_page') && Request::get('per_page') == '5')?'selected':''); ?>>5</option>
							<option value="10" <?php echo e((Request::get('per_page') && Request::get('per_page') == '10')?'selected':''); ?>>10</option>
							<option value="25" <?php echo e((Request::get('per_page') && Request::get('per_page') == '25')?'selected':''); ?>>25</option>
							<option value="50" <?php echo e((Request::get('per_page') && Request::get('per_page') == '50')?'selected':''); ?>>50</option>
							<option value="75" <?php echo e((Request::get('per_page') && Request::get('per_page') == '75')?'selected':''); ?>>75</option>
							<option value="100" <?php echo e((Request::get('per_page') && Request::get('per_page') == '100')?'selected':''); ?>>100</option>
							<option value="all" <?php echo e((Request::get('per_page') && Request::get('per_page') == 'all')?'selected':''); ?>>All</option> 				
						</select>
						
					</div> <!-- .aione-filter -->
					<div class="aione-filter aione-search-field">
						<input id="search" class="browser-default" type="search" placeholder="Search" name="search" value="<?php echo e(Request::get('search')); ?>">
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
						<select class="col  browser-default aione-field" name="sort_by" >
							<option value="" disabled selected>Sort By</option>
							<?php if(isset($showColumns)): ?>
								<?php $__currentLoopData = $showColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php 
										$explodedKey = explode('.',$key);
										if(count($explodedKey)>=2){
											$key = $explodedKey[count($explodedKey)-1];
										}
									 ?>
									<option value="<?php echo e($key); ?>" <?php echo e((Request::get('sort_by') && Request::get('sort_by') == $key)?'selected':''); ?>>
										<?php if(is_array($column)): ?>
											<?php echo e($column['title']); ?>

										<?php else: ?>
											<?php echo e($column); ?>

										<?php endif; ?>
									</option>
									}
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</select>
						<div class="col alpha-sort" style="width: 25%;padding-left:7px;">
							<input type="hidden" name="desc_asc" value="<?php echo e(@Request::get('desc_asc')); ?>" />
							<a href="javascript:;" class="sort"><i class="fa fa-sort-alpha-<?php echo e((Request::get('desc_asc')!= '')?Request::get('desc_asc'):'asc'); ?> arrow_sort white" ></i></a>
						</div>
					</div>
				</div>
				

			</form>
			
			
			
			
			
			
			
	<ul id="list" class="aione-datalist-items" >
		<li class="aione-datalist-item aione-datalist-header-item" >
			<?php $__currentLoopData = $showColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($loop->index == 0): ?>

					<div class="column" style="width: <?php echo e(100/count($showColumns)); ?>%"><span class="column-order" column-key="<?php echo e($k); ?>" style="cursor: pointer;">
						<?php if(is_array($column)): ?>
							<?php echo e($column['title']); ?>

						<?php else: ?>
							<?php echo e($column); ?>

						<?php endif; ?>
					<i class="fa fa-sort<?php echo e((Request::get('desc_asc') != '' && Request::get('sort_by') == $k )?'-'.Request::get('desc_asc'):''); ?>" aria-hidden="true" style="margin-left: 10px"></i></span></div>
				<?php else: ?>
					<?php 
						$explodedKey = explode('.',$k);
						if(count($explodedKey)>=2){
							$k = $explodedKey[count($explodedKey)-1];
						}
					 ?>
					<div class="column" style="width: <?php echo e(100/count($showColumns)); ?>%">
						<span style="cursor: pointer;" class="column-order" column-key="<?php echo e($k); ?>">
							<?php if(is_array($column)): ?>
								<?php echo e($column['title']); ?>

							<?php else: ?>
								<?php echo e($column); ?>

							<?php endif; ?>
							<?php if($k != 'created_at' && $k != 'updated_at'): ?>
								<i class="fa fa-sort<?php echo e((Request::get('desc_asc') != '' && Request::get('sort_by') == $k)?'-'.Request::get('desc_asc'):''); ?>" aria-hidden="true" style="margin-left: 10px; cursor: pointer;"></i>
							<?php endif; ?>
						</span>
					</div>
					
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<div class="clear"></div> <!-- .clear -->
		</li>
		
		<?php $__currentLoopData = $datalist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li class="aione-datalist-item" >
				<div class="">
					<?php $__currentLoopData = $showColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($loop->index == 0): ?>
							<div class="column" style="width: <?php echo e(100/count($showColumns)); ?>%">
								<div class="row valign-wrapper">
									<div class="col">
										<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
											<?php echo e(ucfirst(($dataset->{$k} != '')?$dataset->{$k}[0]:'0')); ?>

										</div>	
									</div>
									<div class="col" style="padding-left: 10px">
										<div> <?php echo ($dataset->{$k} != '')?$dataset->{$k}:'<i>No data available</i>'; ?></div>
										<?php if(isset($actions)): ?>
											<div class="options">
												<?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action_key => $action_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php if($action_key == 'download'): ?>
														<a href="<?php echo e(asset($action_value['destinationPath'].'/'.$dataset->file)); ?>" style="padding-right:10px" target="_blank" class="<?php echo e(@$action_value['class']); ?>"><?php echo e($action_value['title']); ?></a>
													<?php elseif($action_key == 'delete'): ?>
														<a href="javascript:;" data-value="<?php echo e(route($action_value['route'],$dataset->id)); ?>" style="padding-right:10px" id="delete" class="<?php echo e(@$action_value['class']); ?> delete-datalist-item"><?php echo e($action_value['title']); ?></a>
													<?php else: ?>
														<a href="<?php echo e(route($action_value['route'],$dataset->id)); ?>" style="padding-right:10px" class="<?php echo e(@$action_value['class']); ?>"><?php echo e($action_value['title']); ?></a>
													<?php endif; ?>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

											</div>
										<?php endif; ?>

									</div>
								</div>

							</div>

						<?php else: ?>
							<div class="column " style="width: <?php echo e(100/count($showColumns)); ?>%">
								<?php 
									$relations = explode('.',$k);
									$getRelations = $dataset;
								 ?>
								<?php if(count($relations)>1): ?>
									<?php $__currentLoopData = $relations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relKey => $relation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php 
											try{
												$getRelations = $getRelations[$relation];
											}catch(\Exception $e){
												try{
													$getRelations = FormGenerator::GetMetaValue($getRelations, $relation);
												}catch(\Exception $e){
													$getRelations = 'Unable to get value';
												}
											}
										 ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php echo e($getRelations); ?>

								<?php elseif($k == 'created_at' || $k == 'updated_at'): ?>
									<?php echo e($dataset->{$k}->diffForHumans()); ?>

								<?php else: ?>
									<?php 
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
										}else{
											echo $dataset->{$k};
										}
									 ?>
								<?php endif; ?>
							</div>	
						<?php endif; ?>

					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
				<div class="clear"></div> <!-- .clear -->
			</li>			
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	</ul>
	
	
	
	
			
			
			

			</div> <!-- .aione-row -->
		</div> <!-- #aione_datalist_content -->
		<div id="aione_datalist_footer" class="aione-datalist-footer">
			<div class="aione-row">
				<!----------------  AIONE PAGINATION ---------------->
				<?php echo e($datalist->appends(request()->input())->render()); ?>

				<!---------------- END AIONE PAGINATION ---------------->

			</div> <!-- .aione-row -->
		</div> <!-- #aione_datalist_footer -->
	</div> <!-- .aione-row -->
</div> <!-- #aione_datalist -->

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