@php

  if(@$settings != null){
    $login_theme = @$settings->where('key' , 'login_theme')->first();
    $login_style = @$settings->where('key' , 'login_style')->first();
    $Site_title = @$settings->where('key' , 'title')->first();
    $bg_image = @$settings->where('key' , 'bg_image')->first();
    
    $login_footer_content = @$settings->where('key' , 'login_footer_content')->first();
  }
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            {{@$Site_title->value}}
        </title>
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
            .bg-image{
                background-image: url('assets/images/march.jpg');
                background-size: cover;
                overflow: hidden;
                height: 100%;
            }
            .seprator span:before{
                content: '';
                display: block;
                width: 30px;
                position: absolute;
                top: 10px;
                left: 100px;
                border-top: 1px solid rgba(0, 0, 0, 0.12);
            }
            .seprator span:after{
                content: '';
                display: block;
                width: 30px;
                position: absolute;
                top: 10px;
                right: 100px;
                border-top: 1px solid rgba(0, 0, 0, 0.12);
            }
            .box-shadow-main{
                box-shadow: 0px 5px 5px -3px rgba(0, 0, 0, 0.2), 0px 8px 10px 1px rgba(0, 0, 0, 0.14), 0px 3px 14px 2px rgba(0, 0, 0, 0.12);
                height: 100vh;
                overflow-y: scroll;
            }
            .box-shadow-btn{
                box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
            }
            .outline-none{
                outline: none;
            }
            @media  (min-width: 300px) and (max-width: 959px) {
            .bg-image .hide-sec{
                display: none;
            }
            .center-text{
                text-align: center;
            }
        }
            @media only screen and (min-width: 993px){
                .logo-show{
                    display: none;
                }
            }
        </style>
    </head>
    <body style="overflow: hidden;">
        <div id="aione_wrapper" class="aione-wrapper page-home layout-header-top aione-layout-wide aione-theme-arcane">
            <div class="wrapper">
                <div id="aione_main" class="aione-main fullwidth p-0">
                    <div class="wrapper">
                        <div id="aione_content" class="aione-content">
                            <div class="wrapper">
                                <div id="aione_page_content" class="aione-page-content m-0">
                                    <div class="wrapper">
                                        <section class="bg-image">
                                            <div class="ar">
                                                <div class="ac l70 m100 s100 p-12p hide-sec">
                                                    <div class="mb-32">
                                                        <span class="font-size-86 font-weight-500 line-height-100 white ph-30 bg-light-blue aione-rounded">A</span>
                                                    </div>
                                                    <div>
                                                        <h2 class="font-weight-200 blue-grey darken-4">
                                                            Welcome to the AIONE!
                                                        </h2>
                                                        <p class="font-size-17 line-height-25 blue-grey darken-4">
                                                            Aione framework is responsive css framework to make responsive websites, web applications and mobile applications using 100 coulmn grid system. The only frontend framework to make Progressive Web Applications.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="ac l30 m100 s100 ph-0">
                                                    <div class="bg-white pt-100 pb-48 ph-48 box-shadow-main">
                                                        <!-- <div class="center-align mb-30 logo-show">
                                                            <span class="font-size-86 font-weight-500 line-height-100 white ph-30 center-align bg-light-blue aione-rounded">A</span>
                                                        </div>
                                                        <div class="mb-20 center-text">
                                                            <span class="font-weight-400 blue-grey darken-4 font-size-21">Log in to your account</span>
                                                            <p class="font-size-13 font-weight-400 blue-grey darken-4 mt-10">
                                                                Sed mollis velit facilisis facilisis viverra
                                                            </p>
                                                        </div>
                                                        <div class="aione-border-bottom mt-30 pb-5">
                                                            <input type="email" name="email" placeholder="Email" class=" aione-border-none outline-none">
                                                        </div>
                                                        <div class="aione-border-bottom mt-30 pb-5">
                                                            <input type="password" name="password" placeholder="Password" class=" aione-border-none outline-none">
                                                        </div>
                                                        <div class="mt-30">
                                                            <a href="#" class="aione-float-left">
                                                                <input type="checkbox" name="checkbox">
                                                                <span class="font-size-13 font-weight-400 blue-grey darken-4 pt-8 pl-10">Remember Me</span>
                                                            </a>
                                                            <a href="#" class="aione-float-right">
                                                                Forget password
                                                            </a>
                                                            <div class="clear">
                                                            </div>
                                                        </div>
                                                        <div class="mv-20 center-align">
                                                            <button class="grey darken-2 bg-grey bg-lighten-2 pv-5 ph-42p font-weight-400">Login</button>
                                                        </div>
                                                        <div class="center-align seprator position-relative mb-20">
                                                            <span class="font-size-16 font-weight-600 grey darken-2">OR</span>
                                                        </div>
                                                        <div class="center-align mb-20">
                                                            <button class="font-size-13 box-shadow-btn white pv-7 ph-15p bg-red"><i class="fa fa-google-plus white pr-10 ">
                                                                </i> Log in With Google</button>
                                                        </div>
                                                        <div class="center-align mb-40">
                                                            <button class="font-size-13 box-shadow-btn white pv-7 ph-15p bg-blue bg-darken-4"><i class="fa fa-facebook-f white pr-10 ">
                                                                </i> Log in With Facebook</button>
                                                        </div>
                                                        <div class="center-align mb-50">
                                                            <span class="font-size-13 font-weight-400 blue-grey darken-4">Don't have an account?</span>
                                                            <a href="#" class="font-size-13 font-weight-400">Create an account</a>
                                                        </div> -->
                                                         @include('common.auth-header')
                                                          @yield('content')
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