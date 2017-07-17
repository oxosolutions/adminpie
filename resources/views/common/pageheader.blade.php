<div id="aione_page_header" class="aione-page-header">
  <div class="aione-row">
    <div class="aione-page-title-container">
		
		@if(@$show_page_title != 'no')
			@if(!empty(@$page_title))
				<h3 class="aione-page-title">{{@$page_title}}</h3>
			@endif
		@endif
		@if(@$show_add_new_button  != 'no')
			@if(!empty(@$add_new))
				<a id="add_designation_button" class="aione-button aione-button-small aione-button-light aione-button-square add-new-button" data-target="add_new_model" href="#">{{@$add_new}}</a>
			@endif
		@endif
      <div class="clear"></div>
    </div> <!-- .aione-page-title-container -->
	@if(@$show_navigation != 'no')
    <div class="aione-breadcrumbs-container">
       <ul id="aione_breadcrumbs" class="aione-breadcrumbs aione-navigation"> 
              <li><a href="javascript:void(0)"><i class="fa fa-home"></i></a></li>
              @php
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
						  
                          echo '<li><a href="javascript:void(0)" class="popup_drop"> '.$modelName.'</a>';
                            echo '<ul class="bread-list">';
                            foreach($result as $ky => $vl){
                                echo '<li><a href="'.$vl->id.'">'.$vl[$resultModel::$breadCrumbColumn].'</li></a>';
                            }
                            echo '</ul>';
                          echo '</li>';
                      }else{
                        $module = drawSidebar::getSubModule($segment);
                        if($module != null){
                          echo '<li><a href="javascript:void(0)" class="popup_drop"> '.$module->name.'</a>';
                          echo '<ul class="bread-list">';
                          foreach($module->subModule as $ky => $vl){
                              echo '<li><a href="'.url(str_replace('/{id?}','',$vl->sub_module_route)).'">'.$vl->name.'</li></a>';
                          }
                          echo '</ul>';
                        }   
                      }
                   }
              @endphp
            </ul>
    </div> <!-- .aione-breadcrumb-container -->
	@endif
    <div class="clear"></div>
  </div> <!-- .row -->
</div> <!-- #aione_page_header -->