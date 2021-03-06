<nav id="aione_nav" class="aione-nav vertical dark">
	<div class="aione-nav-background"></div>
    <ul id="aione_menu" class="aione-menu">
    <?php 
  
    $permisson = drawSidebar::checkPermisson();
    
     ?>
        <?php $__currentLoopData = drawSidebar::drawSidebar(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sidebar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       
			<?php 
			$routes = [];
			 ?>
            <?php $__currentLoopData = $sidebar->subModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ke => $subModule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php 
                // preg_match_all("/{(.*?)}/", $subModule->sub_module_route, $matches);
                // $routes[] = preg_replace("/\/{[a-z?]+?\}/", @request()->route()->parameters()[str_replace('?','',@$matches[1][0])], $subModule->sub_module_route);
                $routes[] = str_replace('/{id?}','',$subModule->sub_module_route);
               ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       
            <?php if(isset($permisson['module'][$sidebar['id']]['permisson']) && $permisson['module'][$sidebar['id']]['permisson']=='on'): ?>
            <li class="aione-nav-item route-<?php echo e(@$sidebar['route']); ?>  level0 <?php echo e((@$sidebar->subModule[0] != null)?'has-children':''); ?>  <?php echo e(in_array(Request::path(),$routes)?'nav-item-current':''); ?>"> 
              <?php if(@$sidebar->subModule[0] != null): ?>
                <a href="javascript:;">
              <?php else: ?>
                <?php if($sidebar['route'] != null): ?>
                    <a href="<?php echo e(@Url($sidebar['route'])); ?>">
                <?php else: ?>
                    <a href="javascript:void(0)">
                <?php endif; ?>
                <?php endif; ?>
					
					<span class="nav-item-icon " style="background:<?php echo e(@$sidebar['color']); ?>"><i class="fa <?php echo e(@$sidebar['icon']); ?>"></i></span>
					<span class="nav-item-text">
						<?php echo e(@$sidebar['name']); ?>

					</span> 
					
					<?php if(@$sidebar->subModule[0] != null): ?> 
						<span class="nav-item-arrow"></span>
					<?php endif; ?>
				  
                </a>
                <ul class="side-bar-submenu">

                    <?php $__currentLoopData = $sidebar->subModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ke => $subModule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php if(isset($permisson['submodule'][$subModule['id']]['permisson']) && $permisson['submodule'][$subModule['id']]['permisson']=='on'): ?>
                     <?php 
                     $submenu_class = $subModule->sub_module_route;
                     $submenu_class = str_replace("/","-",$submenu_class);

                      ?>
                        <li class="aione-nav-item route-<?php echo e(@$submenu_class); ?> level1 <?php echo e(Request::is(str_replace('/{id?}','',$subModule->sub_module_route))?'nav-item-current':''); ?>">
                            <a href="<?php echo e(url(str_replace('/{id?}','',$subModule->sub_module_route))); ?>">
                                <span class="nav-item-icon"><?php echo e(@$subModule['name'][0]); ?></span>
								<span class="nav-item-text"><?php echo e(@$subModule['name']); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
    </ul>
</nav>