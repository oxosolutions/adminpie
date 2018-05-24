<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
      <li class="aione-tab settings-tab-organization <?php echo e((Request::route()->action['as'] == 'setting.org')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('setting.org')); ?>"><span class="nav-item-text">Basic</span></a>
      </li>

      
       <li class="aione-tab settings-tab-emp <?php echo e((Request::route()->action['as'] == 'setting.employee')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('setting.employee')); ?>"><span class="nav-item-text">Employee</span></a>
      </li>
      
      <li class="aione-tab settings-tab-hrm <?php echo e((Request::route()->action['as'] == 'setting.attendance')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('setting.attendance')); ?>"><span class="nav-item-text">HRM</span></a>
      </li>
      
      <li class="aione-tab settings-tab-user  <?php echo e((Request::route()->action['as'] == 'setting.user')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('setting.user')); ?>"><span class="nav-item-text">User</span></a>
      </li>

      <li class="aione-tab settings-tab-support  <?php echo e((Request::route()->action['as'] == 'support.settings')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('support.settings')); ?>"><span class="nav-item-text">Support</span></a>
      </li>

      
     
      
      <div class="clear"></div>
  </ul>
</nav>
  

</style>
