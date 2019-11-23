
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
      <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'download.android')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('download.android')); ?>"><span class="nav-item-text">Download</span></a>
      </li>
      <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'settings.android')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('settings.android')); ?>"><span class="nav-item-text">Settings</span></a>
      </li>
      <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'FAQs.android')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('FAQs.android')); ?>"><span class="nav-item-text">FAQs</span></a>
      </li>
      <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'changelog.android')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('changelog.android')); ?>"><span class="nav-item-text">Changelog</span></a>
      </li>
      <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'documentation.android')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('documentation.android')); ?>"><span class="nav-item-text">Documentation</span></a>
      </li>
    
      
      <div class="clear"></div>
  </ul>
</nav>



