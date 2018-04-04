<?php 
  if(@request()->route()->parameters()['id'] != ''){
    @$id = @request()->route()->parameters()['id'];
  }
 ?>
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
       <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'user.view')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('user.view',@$id)); ?>"><span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-ios-monitor-outline ionic-icon"></i></span><span class="nav-item-text">View</span></a>
      </li>
       <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'user.details')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('user.details',@$id)); ?>"><span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-compose ionic-icon"></i></span><span class="nav-item-text">Edit</span></a>
      </li>
       <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'changepass.user')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('changepass.user',@$id)); ?>"><span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-ios-unlocked ionic-icon"></i></span><span class="nav-item-text">Change Password</span></a>
      </li>
      <div class="clear"></div>
  </ul>
</nav>
<style type="text/css">
  .aione-content{
    overflow-x: hidden;
  }
  nav i.ionic-icon{
        font-size: 18px;
            line-height: 28px;
  }
  nav i.ionic-icon:before{
        vertical-align: middle;
  }
</style>


