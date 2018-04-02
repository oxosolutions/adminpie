<?php 
  
        @$id = @request()->route()->parameters()['id'];
    
 ?>
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
    <ul id="sortable_tabs" class="aione-tabs">
        
        <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'slider.edit')?'nav-item-current':''); ?>">
            <a href="<?php echo e(route('slider.edit',$id)); ?>"><span class="nav-item-text">Edit</span></a>
        </li>
        <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'options.slider')?'nav-item-current':''); ?>">
            <a href="<?php echo e(route('options.slider',$id)); ?>"><span class="nav-item-text">Options</span></a>
        </li>
    

        <div class="clear"></div>
    </ul>
</nav>



