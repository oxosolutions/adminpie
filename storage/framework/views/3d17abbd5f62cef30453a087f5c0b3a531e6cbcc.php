<?php 
  if(@request()->route()->parameters()['id'] != ''){
    @$id = @request()->route()->parameters()['id'];
  }else{
    @$id = @request()->route()->parameters()['form_id'];
  }
 
 ?>
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
       <li class="aione-tab aione-tooltip dataset-view-tab <?php echo e((Request::route()->action['as'] == 'view.dataset')?'nav-item-current':''); ?>" title="View Dataset Records">
        <a href="<?php echo e(route('view.dataset',$id)); ?>"> <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-ios-monitor-outline ionic-icon"></i></span><span class="nav-item-text"><?php echo e(__('organization/datasets.dataset_tab_view_link')); ?></span></a>
      </li>
       <li class="aione-tab aione-tooltip dataset-edit-tab  <?php echo e((Request::route()->action['as'] == 'edit.dataset')?'nav-item-current':''); ?>" title="Edit Dataset Records">
        <a href="<?php echo e(route('edit.dataset',$id)); ?>"> <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-compose ionic-icon">
                    </i></span><span class="nav-item-text"><?php echo e(__('organization/datasets.dataset_tab_edit_link')); ?></span></a>
      </li>
       <li class="aione-tab aione-tooltip dataset-structure-tab  <?php echo e((Request::route()->action['as'] == 'structure.dataset')?'nav-item-current':''); ?>" title="Define Dataset Structure">
        <a href="<?php echo e(route('structure.dataset',$id)); ?>"> <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-ios-list-outline ionic-icon">
                    </i></span><span class="nav-item-text"><?php echo e(__('organization/datasets.dataset_tab_structure_link')); ?></span></a>
      </li>
     
     
        <li class="aione-tab aione-tooltip dataset-filter-tab  <?php echo e((Request::route()->action['as'] == 'filter.dataset')?'nav-item-current':''); ?>" title="Filter Dataset and Create Subset">
        <a href="<?php echo e(route('filter.dataset',$id)); ?>"> <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-funnel ionic-icon">
                    </i></span><span class="nav-item-text"><?php echo e(__('organization/datasets.dataset_tab_data_filter_link')); ?></span></a>
      </li>
      <li class="aione-tab aione-tooltip dataset-api-tab  <?php echo e((Request::route()->action['as'] == 'api.dataset')?'nav-item-current':''); ?>" title="API" style="display: none;">
        <a href="<?php echo e(route('api.dataset', $id)); ?>"> <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-cloud">
                    </i></span><span class="nav-item-text"><?php echo e(__('organization/datasets.dataset_tab_api_link')); ?></span></a>
      </li>
        <li class="aione-tab aione-tooltip dataset-validate-tab  <?php echo e((Request::route()->action['as'] == 'validate.dataset')?'nav-item-current':''); ?>" title="Validate Dataset">
        <a href="<?php echo e(route('validate.dataset',$id)); ?>"> <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class=" ion-ios-checkmark-outline ionic-icon">
                    </i></span><span class="nav-item-text"><?php echo e(__('organization/datasets.dataset_tab_validate_link')); ?></span></a>
      </li>
    
      <li class="aione-tab aione-tooltip dataset-operation-tab  <?php echo e((Request::route()->action['as'] == 'options.dataset')?'nav-item-current':''); ?>" title="Datsaet Operations">
        <a href="<?php echo e(route('options.dataset',$id)); ?>"> <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-ios-browsers-outline ionic-icon">
                    </i></span><span class="nav-item-text"><?php echo e(__('organization/datasets.dataset_tab_operations_link')); ?></span></a>
      </li>
      <?php 
            $dataset_user_id = '';
            $auth_user_id = '';
            $datasetModel = App\Model\Organization\Dataset::find(request()->id);
            if($datasetModel != null){
                $dataset_user_id = $datasetModel->user_id;
                $auth_user_id = Auth::guard('org')->user()->id;
            }
       ?>

      <?php if($dataset_user_id == $auth_user_id): ?>
          <li class="aione-tab aione-tooltip dataset-collaborate-tab  <?php echo e((Request::route()->action['as'] == 'collaborate.dataset')?'nav-item-current':''); ?>" title="Share Dataset & Define Access">
            <a href="<?php echo e(route('collaborate.dataset',$id)); ?>"> <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-android-share-alt ionic-icon">
                    </i></span><span class="nav-item-text"><?php echo e(__('organization/datasets.dataset_tab_collaborate_link')); ?></span></a>
          </li>
      <?php endif; ?>
      <li class="aione-tab aione-tooltip dataset-customize-tab  <?php echo e((Request::route()->action['as'] == 'customize.dataset')?'nav-item-current':''); ?>" title="Customize">
        <a href="<?php echo e(route('customize.dataset',$id)); ?>"> <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-wand ionic-icon">
                    </i></span><span class="nav-item-text"><?php echo e(__('organization/datasets.dataset_tab_customize_link')); ?></span></a>
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




