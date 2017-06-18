<div class="row valign-wrapper">
    <div class="col s3 m5 l5" style="padding:0 10px">
        <div class="row valign-wrapper">
            <div class="" style="float: left;padding:0 8px;">
                <a href="javascript:;" data-activates="slide-out" class=" menu"><i style="font-size: 18px" class=" white-text  fa fa-bars " aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    
    <div class="col l7 s9 m7 " >
        <div class="col right-align" style="float: right;">           
            <a class="dropdown-button1" href="javascript:;" data-activates="dropdown">
                <img class="circle profile-image responsive-img" src="<?php echo e(asset('assets/images/user.png')); ?>" style="margin:9px 14px 1px 0px ">
            </a>  
            <ul class="dropdown-list" style="position: absolute;">
                
                <li class="divider"></li>
                <li><a href="<?php echo e(route('admin.logout')); ?>" class="waves-effect waves-white btn-flat col l12 center-align">Logout</a></li>

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

<script type="text/javascript">
$(document).ready(function(){
    $('.dropdown-list').hide();
    $('.dropdown-button1').click(function(){
        $('.dropdown-list').toggle();
    });
});
</script>
<style type="text/css">
    #dropdown{
        width: 156px !important;
        top: 58px !important;
        right: 12px !important;
        opacity: 1;
    }
    .dropdown-list{
        margin-top: -0px;
        position: absolute;
        background: #fff;
        display: block;
        width: 130px;
        box-shadow: -1px 5px 13px #e8e8e8;
        margin-left: -100px;
        text-align: left;
    }
   /* .dropdown-list > li > a{
       padding:20px;
    }*/
    .dropdown-list li:hover{
        background-color: #e8e8e8;
    }
    .divider{
        padding: 0px !important;
    }
</style>