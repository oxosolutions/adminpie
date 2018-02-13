<?php 
  if(@request()->route()->parameters()['id'] != ''){
    @$id = @request()->route()->parameters()['id'];
  }else{
    @$id = @request()->route()->parameters()['form_id'];
  }
  // dump(Request::route()->action['as']);
 ?>
<nav id="aione_survey_tabs" class="aione-survey-tabs aione-nav-tabs aione-nav aione-nav-horizontal"  >
  <ul class="aione-tabs">
      <li class="aione-tab survey-edit-tab <?php echo e((Request::route()->action['as'] == 'survey.sections.list')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('survey.sections.list',$id)); ?>"><span class="nav-item-text">Edit</span></a>
      </li>
      <li class="aione-tab survey-view-tab <?php echo e((Request::route()->action['as'] == 'survey.perview')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('survey.perview',$id)); ?>"><span class="nav-item-text">Preview</span></a>
      </li>
      <li class="aione-tab survey-settings-tab <?php echo e((Request::route()->action['as'] == 'survey.settings')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('survey.settings',$id)); ?>"><span class="nav-item-text">Settings</span></a>
      </li>
      <li class="aione-tab survey-stats-tab <?php echo e((Request::route()->action['as'] == 'stats.survey')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('stats.survey',$id)); ?>"><span class="nav-item-text">Statistics</span></a>
      </li>
      <li class="aione-tab survey-structure-tab <?php echo e((Request::route()->action['as'] == 'structure.survey')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('structure.survey',$id)); ?>"><span class="nav-item-text">Structure</span></a>
      </li>
      <li class="aione-tab survey-data-tab <?php echo e((Request::route()->action['as'] == 'results.survey')?'nav-item-current':''); ?>"> 
        <a href="<?php echo e(route('results.survey',$id)); ?>"><span class="nav-item-text">Raw Data</span></a>
      </li>
      <li class="aione-tab survey-report-tab <?php echo e((Request::route()->action['as'] == 'survey.reports')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('survey.reports',$id)); ?>"><span class="nav-item-text">Report</span></a>
      </li>
       <?php if(get_organization_id() =='295' && in_array($id , [1,2,5]) ): ?>
            <li class="aione-tab survey-report-tab <?php echo e((Request::route()->action['as'] == 'survey.stats.report')?'nav-item-current':''); ?>">
              <a href="<?php echo e(route('custom.survey.report',$id)); ?>"><span class="nav-item-text">Custom Report</span></a>
            </li>
      <?php endif; ?>
      <?php if(App\Model\Organization\Collaborator::checkAccess($id,'survey') == null): ?>
        <li class="aione-tab survey-share-tab <?php echo e((Request::route()->action['as'] == 'share.survey')?'nav-item-current':''); ?>" style="display: none;">
          <a href="<?php echo e(route('share.survey',$id)); ?>"><span class="nav-item-text">Collaborate</span></a>
        </li>
      <?php endif; ?>
       <li class="aione-tab survey-customize-tab  <?php echo e((Request::route()->action['as'] == 'custom.survey')?'nav-item-current':''); ?>">
        <a href="<?php echo e(route('custom.survey',$id)); ?>"><span class="nav-item-text">Customize</span></a>
      </li>
      
      <div class="clear"></div>
  </ul>
</nav>



