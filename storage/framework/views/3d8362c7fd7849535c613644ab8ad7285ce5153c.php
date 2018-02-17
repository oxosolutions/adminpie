<?php 
  if(@request()->route()->parameters()['id'] != ''){
    @$id = @request()->route()->parameters()['id'];
  }
  
 ?>
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
    <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'view.groupOrganizations')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('view.groupOrganizations',$id)); ?>"><span class="nav-item-text">View</span></a>
      </li>
       <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'edit.groupOrganization')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('edit.groupOrganization',$id)); ?>"><span class="nav-item-text">Edit</span></a>
      </li>
       <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'users.groupOrganization')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('users.groupOrganization',$id)); ?>"><span class="nav-item-text">Users</span></a>
      </li>
      <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'share.groupOrganization')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('share.groupOrganization',$id)); ?>"><span class="nav-item-text">Share</span></a>
      </li>
      
      <div class="clear"></div>
  </ul>
</nav>

