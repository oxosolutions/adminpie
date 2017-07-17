<div class="aione-breadcrumbs-container">
	 <ul id="breadcrumb" class="aione-breadcrumbs">
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
                        $result = $resultModel::groupBy($resultModel::$breadCrumbColumn)->get();
                        echo '<li><a href="javascript:void(0)" class="popup_drop"><i class="fa fa-tasks " aria-hidden="true" style="padding-right:8px"></i> '.$modelName.'</a>';
                          echo '<ul class="bread-list">';
                          foreach($result as $ky => $vl){
                              echo '<li><a href="'.$vl->id.'">'.$vl[$resultModel::$breadCrumbColumn].'</li></a>';
                          }
                          echo '</ul>';
                        echo '</li>';
                    }else{
                      $module = drawSidebar::getSubModule($segment);
                      if($module != null){
                        echo '<li><a href="javascript:void(0)" class="popup_drop"><i class="fa fa-tasks " aria-hidden="true" style="padding-right:8px"></i> '.$module->name.'</a>';
                        echo '<ul class="bread-list">';
                        foreach($module->subModule as $ky => $vl){
                            echo '<li><a href="'.url(str_replace('/{id?}','',$vl->sub_module_route)).'">'.$vl->name.'</li></a>';
                        }
                        echo '</ul>';
                      }   
                    }
                 }
             ?>
          </ul>
</div> <!-- .aione-breadcrumb-container -->