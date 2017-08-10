<div id="aione_header_left" class="aione-header-left">
    <div class="aione-row">
        <div class="aione-header-item aione-nav-toggle">
            <a href="#" class="nav-toggle "></a>
        </div>
		<div class="aione-header-item aione-site-title">
			 <h1 class="site-title">AdminPie</h1>
		</div> <!-- .aione-header-item -->
		<div class="aione-header-item aione-site-tagline">
			<h2 class="site-tagline">Super Admin Panel</h2>
		</div> <!-- .aione-header-item -->
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
                            <!--
							<li><a href="#" class="">Profile</a></li>
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
                            <a href="{{route('admin.logout')}}" class="button aione-button aione-button-small aione-logout-button">Logout</a>
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