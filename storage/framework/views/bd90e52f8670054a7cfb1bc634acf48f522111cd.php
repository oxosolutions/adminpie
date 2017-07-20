<div class="row valign-wrapper">
    <div class="col s3 m5 l5" style="padding:0 10px">
        <div class="row valign-wrapper">
            <div class="" style="float: left;padding:0 8px;">
                <a href="#" class="nav-toggle"> 
				<i style="font-size: 18px" class=" white-text  fa fa-bars " aria-hidden="true"></i></a>
            </div>
            <?php if(App\Model\Organization\OrganizationSetting::getSettings('show_logo') == 'yes'): ?>
                <div class="logo" style="width: 20%;">
                    <img src="<?php echo e(asset('images')); ?>/<?php echo e(App\Model\Organization\OrganizationSetting::getSettings('logo')); ?>" style="width: 100%;" />
                </div>
            <?php endif; ?>
            <div>
                 <h5><i style="font-size: 18px; color: #FFF;"><?php echo e(App\Model\Organization\OrganizationSetting::getSettings('title')); ?></i></h5>
            </div>
            <?php if(App\Model\Organization\OrganizationSetting::getSettings('show_tagline') == 'yes'): ?>
                <i style="font-size: 18px; color: #FFF;"><?php echo e(App\Model\Organization\OrganizationSetting::getSettings('tagline')); ?></i>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="col l7 s9 m7 " >
        <div class="col right-align" style="float: right;">           
            <a class="dropdown-button1" href="javascript:;" data-activates="dropdown">
                <img class="circle profile-image responsive-img" src="<?php echo e(asset('assets/images/user.png')); ?>" style="margin:9px 14px 1px 0px ">
            </a>  
            <ul class="dropdown-list" style="position: absolute;">
                
                <li class="divider"></li>
                <li><a href="<?php echo e(route('org.logout')); ?>" class="waves-effect waves-white btn-flat col l12 center-align">Logout</a></li>

            </ul>
        </div>
       
        <div class="col white-text truncate" style="float: right;padding: 0px 10px;line-height: 45px;max-width: 300px">
            <strong>Welcome : </strong>
              <?php if(Auth::guard('admin')->check()): ?>
                <?php echo e(Auth::guard('admin')->user()->name); ?>

              <?php elseif(Auth::guard('org')->check()): ?>
                <?php echo e(Auth::guard('org')->user()->name); ?>

              <?php endif; ?>
        </div>  

        <div class="col left-align white-text" id="clock"  style="float:right;line-height: 45px">
            
        </div>
    </div>
</div>