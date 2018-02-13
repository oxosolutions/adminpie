<?php 
  if(@request()->route()->parameters()['id'] != ''){
    @$id = @request()->route()->parameters()['id'];
  }

 ?>
<nav id="aione_profile_tabs" class="aione-profile-tabs aione-nav-tabs aione-nav aione-nav-horizontal"  >
  <ul class="aione-tabs">
      <li class="aione-tab profile-view-tab <?php echo e((Request::route()->action['as'] == 'profile.view')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('profile.view')); ?>"><span class="nav-item-text">View Profile</span></a>
      </li>
      <li class="aione-tab profile-edit-tab <?php echo e((Request::route()->action['as'] == 'profile.edit')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('profile.edit')); ?>"><span class="nav-item-text">Edit Profile</span></a>
      </li>
      <li class="aione-tab profile-changepassword-tab <?php echo e((Request::route()->action['as'] == 'profile.changepassword')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('profile.changepassword')); ?>"><span class="nav-item-text">Change Password</span></a>
      </li>
      <li class="aione-tab profile-picture-tab <?php echo e((Request::route()->action['as'] == 'profile-picture.details')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('profile-picture.details')); ?>"><span class="nav-item-text">Profile Picture</span></a>
      </li>
      <div class="clear"></div>
  </ul>
</nav>

