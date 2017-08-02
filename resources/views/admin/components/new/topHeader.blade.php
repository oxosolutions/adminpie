{{-- <div class="row valign-wrapper">
    <div class="col s3 m5 l5" style="padding:0 10px">
        <div class="row valign-wrapper">
            <div class="" style="float: left;padding:0 8px;">
                <a href="#" class="nav-toggle"> 
                <i style="font-size: 18px" class=" white-text  fa fa-bars " aria-hidden="true"></i></a>
            </div>
            @if(App\Model\Organization\OrganizationSetting::getSettings('show_logo') == 'yes')
                <div class="logo" style="width: 20%;">
                    <img src="{{asset('images')}}/{{App\Model\Organization\OrganizationSetting::getSettings('logo')}}" style="width: 100%;" />
                </div>
            @endif
            @if(App\Model\Organization\OrganizationSetting::getSettings('show_tagline') == 'yes')
                <i style="font-size: 18px; color: #FFF;">{{App\Model\Organization\OrganizationSetting::getSettings('tagline')}}</i>
            @endif
        </div>
    </div>
    
    <div class="col l7 s9 m7 " >
        <div class="col right-align" style="float: right;">           
            <a class="dropdown-button1" href="javascript:;" data-activates="dropdown">
                <img class="circle profile-image responsive-img" src="{{asset('assets/images/user.png')}}" style="margin:9px 14px 1px 0px ">
            </a>  
            <ul class="dropdown-list" style="position: absolute;">
               
                <li class="divider"></li>
                <li><a href="{{route('org.logout')}}" class="waves-effect waves-white btn-flat col l12 center-align">Logout</a></li>

            </ul>
        </div>
       
        <div class="col white-text truncate" style="float: right;padding: 0px 10px;line-height: 45px;max-width: 300px">
            <strong>Welcome : </strong>
              @if(Auth::guard('admin')->check())
                {{Auth::guard('admin')->user()->name}}
              @elseif(Auth::guard('org')->check())
                {{Auth::guard('org')->user()->name}}
              @endif
        </div>  

        <div class="col left-align white-text" id="clock"  style="float:right;line-height: 45px">
            
        </div>
    </div>
</div>
 --}}



<div id="aione_header_left" class="aione-header-left">
    <div class="aione-row">
        <div class="aione-header-item aione-nav-toggle">
            <a href="#" class="nav-toggle "></a>
        </div>
    </div><!-- .aione-row -->
</div><!-- #aione_header_left -->
<div id="aione_header_right" class="aione-header-right">
    <div class="aione-row">
        <div class="aione-header-item aione-profile">
            <a href="#"><img class="user-avatar" src="{{asset('assets/images/user.png')}}"></a>
            <div class="aione-header-widget aione-profile-widget">
                <div class="aione-row">
                    <div class="aione-widget-header">
                        <h3 class="aione-widget-title">
                            Welcome 
                            @if(Auth::guard('admin')->check())
                                {{Auth::guard('admin')->user()->name}}
                            @elseif(Auth::guard('org')->check())
                                {{Auth::guard('org')->user()->name}}
                            @endif
                        </h3>
                    </div> <!-- .aione-widget-header -->
                    <div class="aione-widget-content">
                        <ul class="profile-menu">
                            <li><a href="#" class="">Profile</a></li>
                            <!--
                            <li><a href="#" class="">Privacy</a></li>
                            <li><a href="#" class="">Notifications</a></li>
                            <li><a href="#" class="">Settings</a></li>
                            -->
                        </ul>

                    </div> <!-- .aione-widget-content -->
                    <div class="aione-widget-footer">
                        <div class="aione-widget-footer-left">

                        </div> <!-- .aione-widget-footer-left -->
                        <div class="aione-widget-footer-right">
                            <a href="{{route('org.logout')}}" class="button aione-button aione-button-small aione-logout-button">Logout</a>
                        </div> <!-- .aione-widget-footer-right -->
                    </div> <!-- .aione-widget-footer -->
                    
                </div> <!-- .aione-row -->
            </div> <!-- .aione-header-widget -->
            
        </div> <!-- .aione-header-item -->
        <div class="aione-header-item aione-clock"> 
            <div class="" id="clock"></div>
        </div> <!-- .aione-header-item -->
    </div><!-- .aione-row -->
    
</div><!-- #aione_header_right -->