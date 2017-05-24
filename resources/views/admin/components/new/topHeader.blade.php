<div class="row valign-wrapper">
    <div class="col s3 m5 l5" style="padding:0 10px">
        <div class="row valign-wrapper">
            <div class="" style="float: left;padding:0 8px;">
                <a href="javascript:;" data-activates="slide-out" class=" menu"><i style="font-size: 18px" class=" white-text  fa fa-bars " aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    <div class="col s3 m8 l1 left-align white-text" id="clock">
            
    </div>
    <div class="col l6 s9 m7 right-align valign-wrapper">
        
        <div class="col s6 m8 l12 white-text">
            <strong>Welcome : </strong>
              @if(Auth::guard('admin')->check())
                {{Auth::guard('admin')->user()->name}}
              @elseif(Auth::guard('org')->check())
                {{Auth::guard('org')->user()->name}}
              @endif
        </div>  

        <div class="col s3 m4 l2 right-align">           
            <a class="dropdown-button" href="#" data-activates="dropdown">
                <img class="circle profile-image responsive-img" src="{{asset('assets/images/user.png')}}" style="margin:9px 14px 1px 0px ">
            </a>  
            <ul id="dropdown" class="dropdown-content">
                <li><a href="#">Profile</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Help</a></li>
                <li class="divider"></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#dropdown').hide();
    $('.dropdown-button').click(function(){
            $('#dropdown').css({'display': 'block'});
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
</style>