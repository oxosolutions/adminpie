<?php 
    @$id = @request()->route()->parameters()['id'];
 ?>
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  	<ul id="sortable_tabs" class="aione-tabs">
        
      	<li class="aione-tab aione-tooltip <?php echo e((Request::route()->action['as'] == 'edit.visualization')?'nav-item-current':''); ?>" title="Edit">
        	<a href="<?php echo e(route('edit.visualization',$id)); ?>">
        <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-compose ionic-icon"></i></span>

            <span class="nav-item-text"><?php echo e(__('organization/visualization.visualization_tab_edit_link')); ?></span></a>
      	</li>
        <li class="aione-tab aione-tooltip <?php echo e((Request::route()->action['as'] == 'visualization.view')?'nav-item-current':''); ?>" title="View">
          <a href="<?php echo e(route('visualization.view',$id)); ?>">
        <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-ios-monitor-outline ionic-icon"></i></span>

            <span class="nav-item-text"><?php echo e(__('organization/visualization.visualization_tab_view_link')); ?></span></a>
        </li>
      	<li class="aione-tab aione-tooltip <?php echo e((Request::route()->action['as'] == 'setting.visualization')?'nav-item-current':''); ?>" title="Settings ">
        	<a href="<?php echo e(route('setting.visualization',$id)); ?>">
        <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-settings ionic-icon"></i></span>

            <span class="nav-item-text"><?php echo e(__('organization/visualization.visualization_tab_settings_link')); ?> </span></a>
      	</li>
      	<li class="aione-tab aione-tooltip <?php echo e((Request::route()->action['as'] == 'collaborate.visualization')?'nav-item-current':''); ?>" title="Collaborate">
        	<a href="<?php echo e(route('collaborate.visualization',$id)); ?>">
        <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-share ionic-icon"></i></span>

            <span class="nav-item-text"><?php echo e(__('organization/visualization.visualization_tab_collaborate_link')); ?></span></a>
      	</li>
      	<li class="aione-tab aione-tooltip <?php echo e((Request::route()->action['as'] == 'customize.visualization')?'nav-item-current':''); ?>" title="Customize">
        	<a href="<?php echo e(route('customize.visualization',$id)); ?>">
        <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-wand ionic-icon"></i></span>

            <span class="nav-item-text"><?php echo e(__('organization/visualization.visualization_tab_customize_link')); ?></span></a>
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