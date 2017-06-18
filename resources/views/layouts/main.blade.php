<!DOCTYPE html>
<html lang="en">
<head>
	@include('components._head')

</head>
<style type="text/css">
   

</style>
<body>
    <div class="row">
        <div class="col s12 m12 l12 top-bar-color" style="z-index: 9999">
            @include('components.new.topHeader')
            @include('components.sidebars.sidebar')
        </div>
        <div class="col s12 content-section background-design valign-wrapper" style="padding-left: 244px;">
            @php
                $url = $_SERVER['REQUEST_URI'];
                $string = explode('/',$url);
            @endphp
            <div class="col s12 m6 l6 valign-center">
                <div class="row valign-wrapper">
                  
                        @if(isset($string[2]))
                            <h5 style="margin: 0px;">{{ucfirst($string[2])}}</h5>
                        @else
                            <h5 style="margin: 0px;">{{ucfirst($string[1])}}</h5>
                        @endif
                    
                   
                </div>
                   

                        
              
            </div>
            <div class="col s12 m6 l6 right-align " style="padding-right: 10px">
                <ul class="aione-breadcrumb">
                    @foreach($string as $key => $crumb)
                        @if($crumb != "" || $crumb != null)
                            <li><a href="{{$crumb}}">{{ucfirst($crumb)}}</a>  </li>
                        @endif
                     @endforeach
                </ul>
            </div>
        </div>
        <div class="page-content">
            @yield('content')    
        </div>
        @include('admin.components._footer2')
    </div>
</body>
	@include('components._footer')
</html>

<script type="text/javascript">
    
</script>
