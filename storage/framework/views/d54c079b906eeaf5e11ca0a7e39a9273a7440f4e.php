<?php 

  if(@$settings != null){
    $login_theme = @$settings->where('key' , 'login_theme')->first();
    $login_style = @$settings->where('key' , 'login_style')->first();
    $Site_title = @$settings->where('key' , 'title')->first();
    $bg_image = @$settings->where('key' , 'bg_image')->first();
    
    $login_footer_content = @$settings->where('key' , 'login_footer_content')->first();
  }
 ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title><?php echo e(@$Site_title->value); ?></title>
      <!-- Aione framework website, 3D websites, Grid system -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="identifier-url" content="https://aioneframework.com/" />
      <meta name="title" content="Aione Design Elements" />
      <meta name="description" content="Wesite design elements to make responsive websites and web application" />
      <meta name="abstract" content="all in one Responsive CSS Framework" />
      <meta name="author" content="OXO IT SOLUTIONS PRIVATE LIMITED" />
      <meta name="revisit-after" content="10" />
      <meta name="language" content="EN" />
      <meta name="copyright" content="©2018 OXO IT SOLUTIONS PRIVATE LIMITED" />
      <meta name="robots" content="All" />
      <meta name="theme-color" content="#1570a6"/>
      <meta name="application-name" content="Aione Framework">
      <link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

      <link rel="stylesheet" type="text/css" href="https://cdn.aioneframework.com/assets/css/aione.min.css" >
      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:100,300,400">
      <script type="text/javascript" src="https://cdn.aioneframework.com/assets/js/vendor.min.js"></script>
      <script type="text/javascript" src="https://cdn.aioneframework.com/assets/js/aione.min.js"></script>
      <style type="text/css">
      .text-input{
          background-color: #f7f7f7;
          border-color: #C0C0C0 #D9D9D9 #D9D9D9;
      }
      .box-shadow{
      	   box-shadow: 0px 0px 5px #cacaca;
      }
      .bg-color{
      	   background-color: #F9F9F9;
      }
    
      .aione-page-content{
        min-height: auto;
      }
      .height-wrap > .box-shadow{
        min-height: 500px;
      }
      
     </style>
 </head>
  
   <body>
      <div id="aione_wrapper" class="aione-wrapper page-home layout-header-top aione-layout-wide aione-theme-arcane">
         <div class="wrapper">
            <div id="aione_main" class="aione-main fullwidth p-0">
               <div class="wrapper">
                  <div id="aione_content" class="aione-content">
                     <div class="wrapper">
                        <div id="aione_page_content" class="aione-page-content m-0">
                           <div class="wrapper">
                              <section class="bg-color">
                                 <div class="ar ph-14p pv-100 height-wrap">
                                   <div class="ac l50 m100 s100 pv-10 box-shadow">
                                     <div>
                                      
                                     </div>
                                   </div>
                                   <div class="ac l50 m100 s100 bg-white box-shadow">
                                     <div class="pv-20 ph-30">
                                     
                                       <div class="center-align mb-20">
                                          <?php echo $__env->make('common.auth-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                       </div>
                                       <?php echo $__env->yieldContent('content'); ?>
                                       
                                     </div>
                                   </div>
                                 </div>
                              </section>
                           </div>
                        </div>
                     </div>
                     <!-- .wrapper -->
                  </div>
                  <!-- .aione-content -->
               </div>
               <!-- .wrapper -->
            </div>		
         </div>
      </div>
   </body>
</html>