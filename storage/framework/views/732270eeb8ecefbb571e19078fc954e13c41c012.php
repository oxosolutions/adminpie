<div class="col s12 m12 l12 " >
	<div class="row no-margin-bottom">
		<div class="col l12">
			<form action="" method="GET" name="form1">
				<?php if(Request::get('page')): ?>
					<input type="hidden" name="page" value="1">
				<?php endif; ?>
				<div class="col s12 m12 l7  pr-7 tab-mt-10" >
					<!-- <input class="search aione-field" placeholder="Search" /> -->
					<nav>
					    <div class="nav-wrapper">
				      		
					        <div class="input-field">
					          	<input id="search" type="search" style="background-color: #ffffff; color: #000;" name="search" value="<?php echo e(Request::get('search')); ?>">
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
							<?php if(isset($showColumns)): ?>
								<?php $__currentLoopData = $showColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($key); ?>" <?php echo e((Request::get('sort_by') && Request::get('sort_by') == $key)?'selected':''); ?>><?php echo e($column); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</select>
						<div class="col alpha-sort" style="width: 25%;padding-left:7px;">
							<input type="hidden" name="desc_asc" value="<?php echo e(@Request::get('desc_asc')); ?>" />
							<a href="javascript:;" class="sort"><i class="fa fa-sort-alpha-<?php echo e((Request::get('desc_asc')!= '')?Request::get('desc_asc'):'asc'); ?> arrow_sort white" ></i></a>
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
						<option value="5" <?php echo e((Request::get('per_page') && Request::get('per_page') == '5')?'selected':''); ?>>5</option>
						<option value="10" <?php echo e((Request::get('per_page') && Request::get('per_page') == '10')?'selected':''); ?>>10</option>
						<option value="25" <?php echo e((Request::get('per_page') && Request::get('per_page') == '25')?'selected':''); ?>>25</option>
						<option value="50" <?php echo e((Request::get('per_page') && Request::get('per_page') == '50')?'selected':''); ?>>50</option>
						<option value="75" <?php echo e((Request::get('per_page') && Request::get('per_page') == '75')?'selected':''); ?>>75</option>
						<option value="100" <?php echo e((Request::get('per_page') && Request::get('per_page') == '100')?'selected':''); ?>>100</option>
						<option value="all" <?php echo e((Request::get('per_page') && Request::get('per_page') == 'all')?'selected':''); ?>>All</option> 				
				</select>
			</div>
			</form>
		</div>
		
		
	</div>

	<ul class="list" id="list" style="min-height: 400px;margin-top: 14px;border:1px solid #e8e8e8;">
		<li class="row" style="padding:5px 10px;font-size: 13px;font-weight: 500;">
			<?php $__currentLoopData = $showColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($loop->index == 0): ?>
					<div class="col" style="width: <?php echo e(100/count($showColumns)); ?>%"><span class="column-order" column-key="<?php echo e($k); ?>" style="cursor: pointer;"><?php echo e($column); ?><i class="fa fa-sort<?php echo e((Request::get('desc_asc') != '' && Request::get('sort_by') == $k )?'-'.Request::get('desc_asc'):''); ?>" aria-hidden="true" style="margin-left: 10px"></i></span></div>
				<?php else: ?>
					<div class="col right-align" style="width: <?php echo e(100/count($showColumns)); ?>%">
						<span style="cursor: pointer;" class="column-order" column-key="<?php echo e($k); ?>">
							<?php echo e($column); ?>

							<?php if($k != 'created_at' && $k != 'updated_at'): ?>
								<i class="fa fa-sort<?php echo e((Request::get('desc_asc') != '' && Request::get('sort_by') == $k)?'-'.Request::get('desc_asc'):''); ?>" aria-hidden="true" style="margin-left: 10px; cursor: pointer;"></i>
							<?php endif; ?>
						</span>
					</div>
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</li>
		<div class="divider"></div>
		<?php $__currentLoopData = $datalist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li class="row hover-me" style="padding:14px">
				<div class="row valign-wrapper">
					<?php $__currentLoopData = $showColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($loop->index == 0): ?>
							<div class="col" style="width: <?php echo e(100/count($showColumns)); ?>%">
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
													<?php if($action_value['title'] == 'Delete'): ?>
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
							<div class="col right-align" style="width: <?php echo e(100/count($showColumns)); ?>%">
								
								<?php if($k == 'created_at' || $k == 'updated_at'): ?>
									<?php echo e($dataset->{$k}->diffForHumans()); ?>

								<?php else: ?>
									<?php 
										$options = explode(':',$k);
										if(@$options[1] != null){
											if($options[1] == 'human_readable'){
												echo Carbon\Carbon::parse($dataset->{$options[0]})->format('d M');
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
			</li>			
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
	<?php echo e($datalist->appends(request()->input())->render()); ?>

</div>

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