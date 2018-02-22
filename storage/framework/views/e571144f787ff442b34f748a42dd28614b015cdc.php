<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
       <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'organization.settings')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('organization.settings')); ?>"><span class="nav-item-text">Organization</span></a>
      </li>
      <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'model.settings')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('model.settings')); ?>"><span class="nav-item-text">Model Associates</span></a>
      </li>
     
      
      <div class="clear"></div>
  </ul>
</nav>

