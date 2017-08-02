<?php $__env->startSection('content'); ?>
	<div id="aione_page_header" class="aione-page-header">
		<div class="row">
			<div class="aione-page-title-container"> 
				<h3 class="aione-page-title">Designations</h3>
				<a id="add_designation_button" class="aione-button aione-button-small aione-button-light aione-button-square add-new-button" hraf="#">+ Add Organization</a>
				<div class="clear"></div>
			</div> <!-- .aione-page-title-container -->
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
			<div class="clear"></div>
		</div> <!-- .row -->
	</div> <!-- #aione_page_header -->
	<div class="main-content">
	

		
	</div>
<style type="text/css">
	.aione-page-header{
		padding:10px;
		border-bottom: 1px solid #e8e8e8;
	}
	.aione-page-header .aione-page-title-container{
		display: inline-block;
	}
	.aione-page-header .aione-page-title-container .aione-page-title{
		color: #666666;
		display: inline-block;
		float:left;
		padding: 0;
		margin: 0;
		font-size: 24px;
		line-height: 1.33333333;
		font-weight: 100;
		font-family: "Open Sans", Arial, Helvetica, sans-serif;
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
	}
	.aione-page-header .aione-page-title-container .aione-button{
		color: #757575;
		display: inline-block;
		padding: 0 10px;
		margin: 0 0 0 10px;
		background-color: #f8f8f8;
		border: 1px solid #e8e8e8;
		font-size: 16px;
		line-height: 30px;
		font-weight: 400;
		font-family: "Open Sans", Arial, Helvetica, sans-serif;
		cursor: pointer;
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
		    webkit-transition: all 150ms ease-out;
    -moz-transition: all 150ms ease-out;
    -o-transition: all 150ms ease-out;
    transition: all 150ms ease-out;
	}
	.aione-page-header .aione-page-title-container .aione-button:hover{
		color: #666666;
		background-color: #f2f2f2;
		border: 1px solid #d2d2d2;
	}
	.aione-button{
		
	}
	.aione-button-small{
		
	}
	.aione-button-medium{
		
	}
	.aione-button-large{
		
	}
	.aione-button-light{
		
	}
	
	.aione-button-square{
		-moz-border-radius:0px;
		-webkit-border-radius:0px;
		border-radius:0px;
	}
	
	.aione-breadcrumbs-container{
		display: inline-block;
		float: right;
		padding: 0;
		margin: 0;
	}
	.aione-breadcrumbs{
		list-style:none;
		padding:0;
		margin:0;
	}
	.aione-breadcrumbs li{
		
	}
	.aione-breadcrumbs li a{
		
	}
	
	.page-content{
	    padding-top: 46px;
		padding-right: 0px;
		padding-left: 230px !important;
	}
	.clear{
		clear:both;
	}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>