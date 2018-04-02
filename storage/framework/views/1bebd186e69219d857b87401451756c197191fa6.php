<?php
$currentUrl = url()->current();

?>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="<?php echo e(asset('vendor/oxosolutions-menu/style.css?rand=').rand(111,999)); ?>" rel="stylesheet">
<div id="hwpwrap">
	<div class="custom-wp-admin wp-admin wp-core-ui js   menu-max-depth-0 nav-menus-php auto-fold admin-bar">
		<div id="wpwrap">
			<div id="wpcontent">
				<div id="wpbody">
					<div id="wpbody-content">

						<div class="wrap">
							
							
							<div id="nav-menus-frame">
								<?php if(request()->route('id')  && !empty(request()->route('id'))): ?>
								<div id="menu-settings-column" class="metabox-holder">

									<div class="clear"></div>

									<form id="nav-menu-meta" action="" class="nav-menu-meta" method="post" enctype="multipart/form-data">
										<div id="side-sortables" class="accordion-container">
											<ul class="outer-border">
												<li class="control-section accordion-section  open add-page" id="add-page">
													<h3 class="accordion-section-title hndle" tabindex="0"> Custom Link <span class="screen-reader-text">Press return or enter to expand</span></h3>
													<div class="accordion-section-content ">
														<div class="inside">
															<div class="customlinkdiv" id="customlinkdiv">
																<p id="menu-item-url-wrap">
																	<label class="howto" for="custom-menu-item-url"> <span>URL</span>&nbsp;&nbsp;&nbsp;
																		<input id="custom-menu-item-url" name="url" type="text" class="code menu-item-textbox" value="http://">
																	</label>
																</p>

																<p id="menu-item-name-wrap">
																	<label class="howto" for="custom-menu-item-name"> <span>Label</span>&nbsp;
																		<input id="custom-menu-item-name" name="label" type="text" class="regular-text menu-item-textbox input-with-default-title" title="Label menu">
																	</label>
																</p>

																<p class="button-controls">

																	<a  href="#" onclick="addcustommenu('custom')"  class="button-secondary submit-add-to-menu right"  >Add menu item</a>
																	<span class="spinner" id="spincustomu"></span>
																</p>

															</div>
														</div>
													</div>
												</li>

											</ul>
										</div>
									</form>
									
									<form id="nav-menu-meta" action="" class="nav-menu-meta" method="post" enctype="multipart/form-data" style="margin-top: 5%;">
										<div id="side-sortables" class="accordion-container">
											<ul class="outer-border">
												<li class="control-section accordion-section  add-page" id="add-page">
													<h3 class="accordion-section-title hndle" tabindex="0"> Routes <span class="screen-reader-text">Press return or enter to expand</span></h3>
													<div class="accordion-section-content ">
														<div class="inside">
															<div class="customlinkdiv" id="customlinkdiv">
																<p id="menu-item-url-wrap">
																	<label class="howto" for="custom-menu-item-url"> <span>URL</span>&nbsp;&nbsp;&nbsp;
																		<!-- <input id="custom-menu-item-url" name="url" type="text" class="code menu-item-textbox" value="http://"> -->
																		<select class="code menu-item-textbox browser-default" id="route-menu-item-url">
																			<?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																				<?php if($loop->index == 0): ?>
																					<option value="<?php echo e($key); ?>"><?php echo e($route); ?></option>
																				<?php else: ?>
																					<option value="<?php echo e(url('/').'/'.$key); ?>"><?php echo e(url('/').'/'.$route); ?></option>
																				<?php endif; ?>
																			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																		</select>
																	</label>
																</p>

																<p id="menu-item-name-wrap">
																	<label class="howto" for="custom-menu-item-name"> <span>Label</span>&nbsp;
																		<input id="route-menu-item-name" name="label" type="text" class="regular-text menu-item-textbox input-with-default-title" title="Label menu">
																	</label>
																</p>

																<p class="button-controls">

																	<a  href="#" onclick="addcustommenu('route')"  class="button-secondary submit-add-to-menu right"  >Add menu item</a>
																	<span class="spinner" id="spincustomu"></span>
																</p>

															</div>
														</div>
													</div>
												</li>

											</ul>
										</div>
									</form>

									<form id="nav-menu-meta" action="" class="nav-menu-meta" method="post" enctype="multipart/form-data" style="margin-top: 5%;">
										<div id="side-sortables" class="accordion-container">
											<ul class="outer-border">
												<li class="control-section accordion-section  add-page" id="add-page">
													<h3 class="accordion-section-title hndle" tabindex="0"> Pages <span class="screen-reader-text">Press return or enter to expand</span></h3>
													<div class="accordion-section-content ">
														<div class="inside">
															<div class="customlinkdiv" id="customlinkdiv">
																<p id="menu-item-url-wrap">
																	<label class="howto" for="custom-menu-item-url"> <span>URL</span>&nbsp;&nbsp;&nbsp;
																		<!-- <input id="custom-menu-item-url" name="url" type="text" class="code menu-item-textbox" value="http://"> -->
																		<select class="code menu-item-textbox browser-default" id="page-menu-item-url">
																			<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																				<?php if($loop->index == 0): ?>
																					<option value="">Select Page</option>
																				<?php else: ?>
																					<option value="<?php echo e(route('view.pages',$key)); ?>"><?php echo e(route('view.pages',$key)); ?></option>
																				<?php endif; ?>
																			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																		</select>
																	</label>
																</p>

																<p id="menu-item-name-wrap">
																	<label class="howto" for="custom-menu-item-name"> <span>Label</span>&nbsp;
																		<input id="page-menu-item-name" name="label" type="text" class="regular-text menu-item-textbox input-with-default-title" title="Label menu">
																	</label>
																</p>

																<p class="button-controls">

																	<a  href="#" onclick="addcustommenu('page')"  class="button-secondary submit-add-to-menu right"  >Add menu item</a>
																	<span class="spinner" id="spincustomu"></span>
																</p>

															</div>
														</div>
													</div>
												</li>

											</ul>
										</div>
									</form>

								</div>
								<?php endif; ?>
								<div id="menu-management-liquid">
									<div id="menu-management">
										<form id="update-nav-menu" action="" method="post" enctype="multipart/form-data">
											<div class="menu-edit ">
												<div id="nav-menu-header">
													<div class="major-publishing-actions">
														<label class="menu-name-label howto open-label" for="menu-name"> <span>Name</span>
															<input name="menu-name" id="menu-name" type="text" class="menu-name regular-text menu-item-textbox" title="Enter menu name" value="<?php if(isset($indmenu)): ?><?php echo e($indmenu->name); ?><?php endif; ?>">
															<input type="hidden" id="idmenu" value="<?php if(isset($indmenu)): ?><?php echo e($indmenu->id); ?><?php endif; ?>" />
														</label>

														<?php if(request()->has('action')): ?>
														<div class="publishing-action">
															<a onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Create menu</a>
														</div>
														<?php elseif(request()->route("id")): ?>
														<div class="publishing-action">
															<a onclick="getmenus()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Save menu</a>
															<span class="spinner" id="spincustomu2"></span>
														</div>

														<?php else: ?>
														<div class="publishing-action">
															<a onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Create menu</a>
														</div>
														<?php endif; ?>
													</div>
												</div>
												<div id="post-body">
													<div id="post-body-content">

														<?php if(request()->route("id")): ?>
														<h3>Menu Structure</h3>
														<div class="drag-instructions post-body-plain" style="">
															<p>
																Place each item in the order you prefer. Click on the arrow to the right of the item to display more configuration options.
															</p>
														</div>

														<?php else: ?>
														<h3>Menu Creation</h3>
														<div class="drag-instructions post-body-plain" style="">
															<p>
																Please enter the name and select "Create menu" button
															</p>
														</div>
														<?php endif; ?>

														<ul class="menu ui-sortable" id="menu-to-edit">
															<?php if(isset($menus)): ?>
															<?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<li id="menu-item-<?php echo e($m->id); ?>" class="menu-item menu-item-depth-<?php echo e($m->depth); ?> menu-item-page menu-item-edit-inactive pending" style="display: list-item;">
																<dl class="menu-item-bar">
																	<dt class="menu-item-handle">
																		<span class="item-title"> <span class="menu-item-title"> <span id="menutitletemp_<?php echo e($m->id); ?>"><?php echo e($m->label); ?></span> <span style="color: transparent;">|<?php echo e($m->id); ?>|</span> </span> <span class="is-submenu" style="<?php if($m->depth==0): ?>display: none;<?php endif; ?>">Subelement</span> </span>
																		<span class="item-controls"> <span class="item-type">Link</span> <span class="item-order hide-if-js"> <a href="<?php echo e($currentUrl); ?>?action=move-up-menu-item&menu-item=<?php echo e($m->id); ?>&_wpnonce=8b3eb7ac44" class="item-move-up"><abbr title="Move Up">↑</abbr></a> | <a href="<?php echo e($currentUrl); ?>?action=move-down-menu-item&menu-item=<?php echo e($m->id); ?>&_wpnonce=8b3eb7ac44" class="item-move-down"><abbr title="Move Down">↓</abbr></a> </span> <a class="item-edit" id="edit-<?php echo e($m->id); ?>" title=" " href="<?php echo e($currentUrl); ?>?edit-menu-item=<?php echo e($m->id); ?>#menu-item-settings-<?php echo e($m->id); ?>"> </a> </span>
																	</dt>
																</dl>

																<div class="menu-item-settings" id="menu-item-settings-<?php echo e($m->id); ?>">
																	<input type="hidden" class="edit-menu-item-id" name="menuid_<?php echo e($m->id); ?>" value="<?php echo e($m->id); ?>" />
																	<p class="description description-thin">
																		<label for="edit-menu-item-title-<?php echo e($m->id); ?>"> Label
																			<br>
																			<input type="text" id="idlabelmenu_<?php echo e($m->id); ?>" class="widefat edit-menu-item-title" name="idlabelmenu_<?php echo e($m->id); ?>" value="<?php echo e($m->label); ?>">
																		</label>
																	</p>

																	<p class="field-css-classes description description-thin">
																		<label for="edit-menu-item-classes-<?php echo e($m->id); ?>"> Class CSS (optional)
																			<br>
																			<input type="text" id="clases_menu_<?php echo e($m->id); ?>" class="widefat code edit-menu-item-classes" name="clases_menu_<?php echo e($m->id); ?>" value="<?php echo e($m->class); ?>">
																		</label>
																	</p>

																	<p class="field-css-url description description-wide">
																		<label for="edit-menu-item-url-<?php echo e($m->id); ?>"> Url
																			<br>
																			<input type="text" id="url_menu_<?php echo e($m->id); ?>" class="widefat code edit-menu-item-url" id="url_menu_<?php echo e($m->id); ?>" value="<?php echo e($m->link); ?>">
																		</label>
																	</p>

																	<p class="field-css-target description description-wide m-10">
																		<label for="edit-menu-item-url-<?php echo e($m->id); ?>"> Open in new tab
																			
																			<input type="checkbox" id="target_menu_<?php echo e($m->id); ?>" class="edit-menu-item-target" value="_blank" <?php echo e(($m->target == '_blank')?'checked':''); ?>>
																		</label>
																	</p>

																	<p class="field-move hide-if-no-js description description-wide">
																		<label> <span>Move</span> <a href="<?php echo e($currentUrl); ?>" class="menus-move-up" style="display: none;">Move up</a> <a href="<?php echo e($currentUrl); ?>" class="menus-move-down" title="Mover uno abajo" style="display: inline;">Move Down</a> <a href="<?php echo e($currentUrl); ?>" class="menus-move-left" style="display: none;"></a> <a href="<?php echo e($currentUrl); ?>" class="menus-move-right" style="display: none;"></a> <a href="<?php echo e($currentUrl); ?>" class="menus-move-top" style="display: none;">Top</a> </label>
																	</p>

																	<div class="menu-item-actions description-wide submitbox">

																		<a class="item-delete submitdelete deletion" id="delete-<?php echo e($m->id); ?>" href="<?php echo e($currentUrl); ?>?action=delete-menu-item&menu-item=<?php echo e($m->id); ?>&_wpnonce=2844002501">Delete</a>
																		<span class="meta-sep hide-if-no-js"> | </span>
																		<a class="item-cancel submitcancel hide-if-no-js button-secondary" id="cancel-<?php echo e($m->id); ?>" href="<?php echo e($currentUrl); ?>?edit-menu-item=<?php echo e($m->id); ?>&cancel=1424297719#menu-item-settings-<?php echo e($m->id); ?>">Cancel</a>
																		<span class="meta-sep hide-if-no-js"> | </span>
																		<a onclick="updateitem(<?php echo e($m->id); ?>)" class="button button-primary updatemenu" id="update-<?php echo e($m->id); ?>" href="javascript:void(0)">Update item</a>

																	</div>

																</div>
																<ul class="menu-item-transport"></ul>
															</li>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															<?php endif; ?>
														</ul>
														<div class="menu-settings">

														</div>
													</div>
												</div>
												<div id="nav-menu-footer">
													<div class="major-publishing-actions">

														<?php if(request()->has('action')): ?>
														<div class="publishing-action">
															<a onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Create menu</a>
														</div>
														<?php elseif(request()->route("id")): ?>
														
														<div class="publishing-action">

															<a onclick="getmenus()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Save menu</a>
															<span class="spinner" id="spincustomu2"></span>
														</div>

														<?php else: ?>
														<div class="publishing-action">
															<a onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Create menu</a>
														</div>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

						<div class="clear"></div>
					</div>

					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="clear"></div>
		</div>
	</div>
</div>