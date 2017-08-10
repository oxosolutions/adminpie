<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.components._head')
</head>
<body>
    <div id="aione_wrapper" class="aione-wrapper aione-layout-wide aione-theme-arcane">
        <div class="aione-row">
            <div id="aione_header" class="aione-header">
                <div class="aione-row">
                
                    @include('admin.components.topHeader') 
                 
                </div><!-- .aione-row -->
            </div><!-- #aione_header -->
            <div id="aione_main" class="aione-main">
                <div class="aione-row">
                    <div id="aione_sidebar" class="aione-sidebar">
                        <div class="aione-row">
                        
                            @include('admin.components.sidebars.sidebar')
                        
                        </div><!-- .aione-row -->
                    </div><!-- #aione_sidebar -->
                    <div id="aione_content" class="aione-content">
                        <div class="aione-row">
                        
                            @yield('content')
                            
                            @include('admin.components._footer2')
                            @include('admin.components._footer')
                        </div><!-- .aione-row -->
                    </div><!-- #aione_content -->
                    <div class="clear"></div><!-- .clear -->
                </div><!-- .aione-row -->
            </div><!-- #aione_main -->
            <div class="clear"></div><!-- .clear -->
        </div><!-- .aione-row -->
    </div><!-- #aione_wrapper -->
    
    @include('components._footerscripts')

</body>
</html>