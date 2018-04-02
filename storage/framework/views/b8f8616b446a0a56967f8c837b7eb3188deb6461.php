<div class="fixed-action-btn horizontal click-to-toggle dashboard-actions">
  <a class="btn-floating red">
    <i class="material-icons">more_vert</i>
  </a>
  <ul>
    <li><a class="btn-floating red delete-dashboard aione-delete-confirmation" href="<?php echo e(route('delete.dashboard',[$current_dashboard])); ?>" tab-slug="<?php echo e($current_dashboard); ?>"><i class="material-icons">clear</i></a></li>
    <li><a class="btn-floating blue" href="javascript:;" data-target="edit-dashboard" tab-id="<?php echo e($current_dashboard); ?>" class="edit-dashboard"><i class="material-icons">edit</i></a></li>
    <li><a class="btn-floating green" href="#" data-target="add_new_dashboard"><i class="material-icons">add</i></a></li>
  </ul>
</div>

 
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal aione-dashboard-tabs"  >
  <ul id="sortable" class="aione-tabs ">
    <?php $__currentLoopData = @$dashboards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <li class="aione-tab aione-tooltip dashboard-tab
        <?php if($tab['slug'] == $current_dashboard): ?>
        nav-item-current
        <?php endif; ?>
        " dashboard-index="<?php echo e($tab['slug']); ?>" title="<?php echo e(@$tab['title']); ?>" >
        <a href="<?php echo e($key); ?>"><span class="nav-item-icon white line-height-20 font-size-13 font-weight-700" style="background: #1c202c"><?php echo e(@$tab['title'][0]); ?></span><span class="nav-item-text"><?php echo e(@$tab['title']); ?></span></a>
      </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
    <div class="clear"></div>
  </ul>
</nav>

<?php echo e(Form::open(['route' => 'dashboard.save' , 'method' => 'post'])); ?>

  <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_dashboard','heading'=>'Add Dashboard','button_title'=>'Save','section'=>'dashboard']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo e(Form::close()); ?>


<style type="text/css">
  .aione-dashboard-tabs .nav-item-current .nav-item-icon{
        background: #1c202c !important;
        color: white !important;

  }
  .aione-dashboard-tabs .nav-item-icon{
        background: #ffffff !important;
        color: #1c202c !important;
        margin-right: 8px !important;
        
  } 
</style>

<script type="text/javascript">
  $(document).ready(function(){
    $('.modal').modal();
  });
</script>

