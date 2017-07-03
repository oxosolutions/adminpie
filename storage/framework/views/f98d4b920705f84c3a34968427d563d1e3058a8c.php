<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $__env->make('components._head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</head>
<style type="text/css">
   

</style>
<body>
    <div class="row">
        <div class="col s12 m12 l12 top-bar-color" style="z-index: 9999">
            <?php echo $__env->make('components.new.topHeader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('components.sidebars.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <div class="col s12 content-section background-design valign-wrapper" style="padding-left: 244px;">
            <div class="col s12 m6 l8 valign-center">
              <ul id="breadcrumb">
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
                            $result = $resultModel::get();
                            echo '<li><a href="javascript:void(0)" class="popup_drop"><i class="fa fa-tasks " aria-hidden="true" style="padding-right:8px"></i> '.$modelName.'</a>';
                              echo '<ul class="bread-list">';
                              foreach($result as $ky => $vl){
                                  echo '<li><a href="'.$vl->id.'">'.$vl[$resultModel::$breadCrumbColumn].'</li></a>';
                              }
                              echo '</ul>';
                            echo '</li>';
                        }
                    }
                    // $modelName = substr(ucfirst((request()->segment(2) == '')?request()->segment(1):request()->segment(2)),0,-1);
                    // dd($modelName);
                 ?>
              </ul>
            </div>
            <div class="col s12 m6 l8 valign-center">
                <div class="row valign-wrapper">
                  
                      
                    
                </div>
                
            </div>
            <div class="col s12 m6 l4 right-align " style="padding-right: 10px">
                <ul class="aione-breadcrumb">
                    <?php $__currentLoopData = $string; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $crumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($crumb != "" || $crumb != null): ?>
                            <li><a href="<?php echo e($crumb); ?>"><?php echo e(ucfirst($crumb)); ?></a>  </li>
                        <?php endif; ?>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

            </div>

        </div>
        <div class="page-content">
            <?php echo $__env->yieldContent('content'); ?>    
        </div>
        <?php echo $__env->make('admin.components._footer2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
</body>
	<?php echo $__env->make('components._footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</html>

<script type="text/javascript">
    $(function() {
        $('.bread-list').hide();
        $('body').on('click','.popup_drop',function(e){
          /*  e.preventDefault();*/
            e.stopPropagation();
            $(this).parent().find('.bread-list').toggle();
        });
        // $('body').click(function(e){
        //     e.preventDefault();
        //     e.stopPropogation();
        //     $('.bread-list').hide();
        // });
    });
</script>
<style type="text/css">
.bread-list li{
    padding: 10px 30px;
}
.bread-list li a{
    color: black;
}
.bread-list li:hover{
    background: #0288D1;
    
}
.bread-list li:hover a{
    
    color: white !important;
}
.bread-list{
    position: absolute;
    z-index: 999;
    background-color: white;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14),0 1px 5px 0 rgba(0,0,0,0.12),0 3px 1px -2px rgba(0,0,0,0.2);
}



/*******************************************Start breadCrunb************************************************************/

#breadcrumb {
  list-style: none;
  display: inline-block;
}
#breadcrumb .icon {
  font-size: 14px;
}
#breadcrumb > li {
  float: left;
}
#breadcrumb > li > a {
  color: #333;
  display: block;
  background: #ddd;
  text-decoration: none;
  position: relative;
  height: 28px;
  line-height: 28px;
  padding: 0 10px 0 5px;
  text-align: center;
  margin-right: 23px;
}
#breadcrumb > li:nth-child(even) > a {
  background-color: #ddd;
}
#breadcrumb > li:nth-child(even) > a:before {
  border-color: #ddd;
  border-left-color: transparent;
}
#breadcrumb > li:nth-child(even) > a:after {
  border-left-color: #ddd;
}
#breadcrumb > li:first-child > a {
  padding-left: 15px;
  -moz-border-radius: 4px 0 0 4px;
  -webkit-border-radius: 4px;
  border-radius: 4px 0 0 4px;
}
#breadcrumb > li:first-child > a:before {
  border: none;
}
#breadcrumb > li:last-child > a {
  padding-right: 15px;
  -moz-border-radius: 0 4px 4px 0;
  -webkit-border-radius: 0;
  border-radius: 0 4px 4px 0;
}
#breadcrumb > li:last-child > a:after {
  border: none;
}
#breadcrumb > li > a:before, #breadcrumb > li > a:after {
  content: "";
  position: absolute;
  top: 0;
  border: 0 solid #ddd;
  border-width: 14px 10px;
  width: 0;
  height: 0;
}
#breadcrumb > li > a:before {
  left: -20px;
  border-left-color: transparent;
}
#breadcrumb > li > a:after {
  left: 100%;
  border-color: transparent;
  border-left-color: #ddd;
}
#breadcrumb > li > a:hover {
  background-color: #2196F3;
  color: #fff;
}
#breadcrumb > li > a:hover:before {
  border-color: #2196F3;
  border-left-color: transparent;
}
#breadcrumb > li > a:hover:after {
  border-left-color: #2196F3;
}
#breadcrumb > li > a:active {
  background-color: #16a085;
}
#breadcrumb > li > a:active:before {
  border-color: #16a085;
  border-left-color: transparent;
}
#breadcrumb > li > a:active:after {
  border-left-color: #16a085;
}
/****************************End bread*****************************************/
</style>