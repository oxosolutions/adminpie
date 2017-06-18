 <div class="row valign-wrapper">
    <div class="col s3 m5 l8" style="padding:0 10px">
        <div class="row valign-wrapper">
            <div class="col " style="float: left;padding:0 8px;">
                <a href="javascript:;" data-activates="slide-out" class=" menu"><i style="font-size: 18px" class=" white-text  fa fa-bars " aria-hidden="true"></i></a>
            </div>
           
            
        </div>
    </div>
    <div class="col l4 s9 m7 right-align valign-wrapper">
        <div class="col s3 m8 l4 left-align white-text" id="clock">
            
        </div>
        <div class="col s6 m8 l6 white-text">
            <strong>Welcome : </strong>
              @if(Auth::guard('admin')->check())
                {{Auth::guard('admin')->user()->name}}
              @elseif(Auth::guard('org')->check())
                {{Auth::guard('org')->user()->name}}
              @endif
        </div>  

        <div class="col s3 m4 l2 right-align">
            <ul id="dropdown" class="dropdown-content">
                <li><a href="#">Profile</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Help</a></li>
                <li class="divider"></li>
                <li><a href="#">Logout</a></li>
            </ul>
           
            <a class="dropdown-button" href="#" data-activates="dropdown">

                <img class="circle profile-image responsive-img" src="{{asset('assets/images/user.png')}}">

            </a>  
        </div>
    </div>
</div>