<?php
  if(@request()->route()->parameters()['id'] != ''){
    @$id = @request()->route()->parameters()['id'];
  }else{
    @$id = @request()->route()->parameters()['form_id'];
  }

?>
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
      
      <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'view.group.user')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('view.group.user',$id)); ?>"><span class="nav-item-text">View Profile</span></a>
      </li>
      <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'user.group.details')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('user.group.details',$id)); ?>"><span class="nav-item-text">Edit Profile </span></a>
      </li>
      <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'pass.group.user')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('pass.group.user',$id)); ?>"><span class="nav-item-text">Change Password</span></a>
      </li>
    
    
      
      <div class="clear"></div>
  </ul>
</nav>



