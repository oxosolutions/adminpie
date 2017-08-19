<div id="aione_page_header" class="aione-page-header">
  <div class="aione-row">
  
	<div class="aione-page-title-container">
		<?php if(@$show_page_title != 'no'): ?>
			<?php if(!empty(@$page_title)): ?>
				<h3 class="aione-page-title"><?php echo e(@$page_title); ?></h3>
			<?php endif; ?>
		<?php endif; ?>
		<?php if(@$show_add_new_button  != 'no'): ?>
			<?php if(!empty(@$add_new)): ?>
				<?php if(array_key_exists('route', @$page_title_data)): ?>
					<a class="aione-button aione-button-small aione-button-light aione-button-square add-new-button" href="<?php echo e(route(@$page_title_data['route'])); ?>"><?php echo e(@$add_new); ?>

					</a>
				<?php else: ?>
					<a id="add_designation_button" class="aione-button aione-button-small aione-button-light aione-button-square add-new-button" data-target="add_new_model" href="#"><?php echo e(@$add_new); ?></a>
				<?php endif; ?>
        <?php if(array_key_exists('second_button_route', @$page_title_data)): ?>
          <a class="aione-button aione-button-small aione-button-light aione-button-square add-new-button" href="<?php echo e(route(@$page_title_data['second_button_route'])); ?>"><?php echo e(@$second_button_title); ?>

          </a>
        <?php endif; ?>
        <?php if(array_key_exists('third_button_route', @$page_title_data)): ?>
          <a class="aione-button aione-button-small aione-button-light aione-button-square add-new-button" href="<?php echo e(route(@$page_title_data['third_button_route'])); ?>"><?php echo e(@$third_button_title); ?>

          </a>
        <?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
		<div class="clear"></div>
	</div> <!-- .aione-page-title-container -->
	
	<?php if(@$show_navigation != 'no'): ?>
    <div class="aione-breadcrumbs-container">
       <ul id="aione_breadcrumbs" class="aione-breadcrumbs aione-navigation"> 
              <li><a href="#"><i class="fa fa-home"></i></a></li>
              <?php 
                   $url = $_SERVER['REQUEST_URI'];
                   $string = explode('/',$url);
				   
                   foreach(request()->segments() as $key => $segment){
                      if(substr($segment, -1) == 's'){
                        $modelName = ucfirst(substr($segment, 0, -1));
                      }else{
                        $modelName = ucfirst($segment);
                      }
					  
                      if(class_exists('App\Model\Organization\\'.$modelName)){
                          $resultModel = 'App\\Model\\Organization\\'.$modelName;
                          //$result = $resultModel::groupBy($resultModel::$breadCrumbColumn)->get();
						  
                          echo '<li><a href="#">'.$modelName.'</a>';
                            /*echo '<ul class="aione-subnavigation">';
                            foreach($result as $ky => $vl){
                                echo '<li><a href="javascript:;">'.$vl[$resultModel::$breadCrumbColumn].'</li></a>';
                            }
                            echo '</ul>';*/
                          echo '</li>';
                      }else{
                        $module = drawSidebar::getSubModule($segment);
                        if($module != null){
                          echo '<li><a href="#"> '.$module->name.'</a>';
                          echo '<ul class="aione-subnavigation">';
                          foreach($module->subModule as $ky => $vl){
                              // echo '<li><a href="'.url(str_replace('/{id?}','',$vl->sub_module_route)).'">'.$vl->name.'</li></a>';
                              echo '<li><a href="javscript:;">'.$vl->name.'</li></a>';
                          }
                          echo '</ul>';
                        }   
                      }
                   }
               ?>
		</ul>
	</div> <!-- .aione-breadcrumb-container -->
	<?php endif; ?>
	<div class="clear"></div>
  </div> <!-- .row -->
</div> <!-- #aione_page_header -->