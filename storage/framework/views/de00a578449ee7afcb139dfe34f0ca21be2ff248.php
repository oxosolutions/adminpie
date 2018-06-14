
<?php if(Auth::guard('admin')->check() == true): ?>
  <?php
    $edit = 'admin.edit.pages';
    $setting = 'admin.setting.pages';
  ?>
<?php else: ?>
  <?php
    $edit = 'edit.pages';
    $setting = 'setting.pages';
  ?>
<?php endif; ?>

<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
    <ul id="sortable_tabs" class="aione-tabs">
        <li class="aione-tab <?php echo e((Request::route()->action['as'] == $edit)?'nav-item-current':''); ?>">
            <a href="<?php echo e(route('edit.pages',request()->route()->parameters())); ?>"><span class="nav-item-text">Edit</span></a>
        </li>
        <li class="aione-tab <?php echo e((Request::route()->action['as'] == $setting)?'nav-item-current':''); ?>">
            <a href="<?php echo e(route('setting.pages',request()->route()->parameters())); ?>"><span class="nav-item-text">Settings</span></a>
        </li>
        <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'custom.setting.pages')?'nav-item-current':''); ?>">
            <a href="<?php echo e(route('custom.setting.pages',request()->route()->parameters())); ?>"><span class="nav-item-text">Custom Code</span></a>
        </li>
        <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'page.revisions')?'nav-item-current':''); ?>">
            <a href="<?php echo e(route('page.revisions',request()->route()->parameters())); ?>"><span class="nav-item-text">Revisions</span></a>
        </li>
        <div class="clear"></div>
    </ul>
</nav>



