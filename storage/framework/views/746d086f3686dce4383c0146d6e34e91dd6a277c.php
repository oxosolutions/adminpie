

  <?php
    $edit = 'admin.edit.pages';
    $setting = 'admin.setting.pages';
  ?>


<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
      <li class="aione-tab <?php echo e((Request::route()->action['as'] == $edit)?'nav-item-current':''); ?>">
        <a href="<?php echo e(route($edit,request()->route()->parameters())); ?>"><span class="nav-item-text">Edit</span></a>
      </li>
      
      <li class="aione-tab <?php echo e((Request::route()->action['as'] == $setting)?'nav-item-current':''); ?>">
        <a href="<?php echo e(route($setting,request()->route()->parameters())); ?>"><span class="nav-item-text">Settings</span></a>
      </li>
      
      <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'admin.custom.setting')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('admin.custom.setting',request()->route()->parameters())); ?>"><span class="nav-item-text">Custom Code</span></a>
      </li>
      
      
      <div class="clear"></div>
  </ul>
</nav>



