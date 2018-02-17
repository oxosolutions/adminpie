<?php if(@$design_settings['header_select_menu'] > 0): ?>
    <?php 
        $menu = Menu::wlist($design_settings['header_select_menu']);
        $current_page = Request::url();
        $nav_item_current_parent = '';
        $nav_item_current_child = '';
     ?>
    <nav id="aione_nav" class="aione-nav horizontal <?php echo e(@$design_settings['menu_animation']); ?>">
      
        <ul id="aione_menu" class="aione-menu aione-float-right">
            <?php if(@$menu): ?>
                <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $menu_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                    if(substr($menu_item['link'], -1) == '/'){
                        $new_menu_item = substr($menu_item['link'] , 0, -1);

                        if($current_page == $new_menu_item){
                            $nav_item_current = 'nav-item-current';
                        }else{  
                            $nav_item_current = '';
                        }
                    }else{
                        if($current_page == $menu_item['link']){
                            $nav_item_current = 'nav-item-current';
                        }else{
                            $nav_item_current = '';
                        }
                    }

                    foreach($menu_item['child'] as $submenu_key => $submenu_item){

                        if(substr($submenu_item['link'], -1) == '/'){
                            $new_menu_item = substr($submenu_item['link'] , 0, -1);

                            if($current_page == $new_menu_item){
                                $nav_item_current_parent = 'nav-item-current-parent';
                                $nav_item_current_child = 'nav-item-current-child';
                            }else{  
                                $nav_item_current_parent = '';
                                $$nav_item_current_child = '';
                            }
                        }else{
                            if($current_page == $submenu_item['link']){
                                $nav_item_current_parent = 'nav-item-current-parent';
                                $nav_item_current_child = 'nav-item-current-child';
                            }else{
                                $nav_item_current_parent = '';
                                $$nav_item_current_child = '';
                            }
                        }
                    }
                 ?>
                    <li class="aione-nav-item level0 <?php echo e($nav_item_current); ?> <?php echo e($nav_item_current_parent); ?>"> 
                        <a href="<?php echo e($menu_item['link']); ?>"><span class="nav-item-text" data-hover="<?php echo e($menu_item['label']); ?>"><?php echo e($menu_item['label']); ?></span></a>
                        <?php if(!empty($menu_item['child'])): ?>
                            <ul class="side-bar-submenu">
                                <?php $__currentLoopData = $menu_item['child']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu_key => $submenu_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <li class="aione-nav-item level1 <?php echo e($nav_item_current_child); ?>"> 
                                        <a href="<?php echo e($submenu_item['link']); ?>">
                                            
                                            <?php echo e($submenu_item['label']); ?>


                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
            <?php endif; ?>
        </ul>
        <div class="aione-nav-toggle">
            <a href="#" class="nav-toggle "></a>
        </div>
        <div class="clear"></div>
    </nav>
    <script type="text/javascript">
        $(document).ready(function(){
            if($('.level1').hasClass('nav-item-current')){
                $(this).parents('li').addClass('nav-item-current-parent');
            }
        });
    </script>
<?php endif; ?>