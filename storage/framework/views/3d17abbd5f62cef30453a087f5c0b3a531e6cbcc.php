<?php 
  if(@request()->route()->parameters()['id'] != ''){
    @$id = @request()->route()->parameters()['id'];
  }else{
    @$id = @request()->route()->parameters()['form_id'];
  }
  // dump(Request::route()->action['as']);
 ?>
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
       <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'view.dataset')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('view.dataset',$id)); ?>"><span class="nav-item-text">View</span></a>
      </li>
       <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'edit.dataset')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('edit.dataset',$id)); ?>"><span class="nav-item-text">Edit </span></a>
      </li>
       
        <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'filter.dataset')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('filter.dataset',$id)); ?>"><span class="nav-item-text">Data Filter</span></a>
      </li>
      <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'api.dataset')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('api.dataset', $id)); ?>"><span class="nav-item-text">API</span></a>
      </li>
        <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'validate.dataset')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('validate.dataset',$id)); ?>"><span class="nav-item-text">Validate</span></a>
      </li>
      
      <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'options.dataset')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('options.dataset',$id)); ?>"><span class="nav-item-text">Operations</span></a>
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
          <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'collaborate.dataset')?'nav-item-current':''); ?>">
            <a href="<?php echo e(route('collaborate.dataset',$id)); ?>"><span class="nav-item-text">Collaborate</span></a>
          </li>
      <?php endif; ?>
      <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'customize.dataset')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('customize.dataset',$id)); ?>"><span class="nav-item-text">Customize</span></a>
      </li>

      
      <div class="clear"></div>
  </ul>
</nav>



