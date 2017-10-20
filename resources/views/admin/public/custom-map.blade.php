<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Visualizations</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="google-signin-scope" 
      content="https://www.googleapis.com/auth/spreadsheets">
    <meta name="google-signin-client_id" content="{YOUR CLIENT ID}">
		<style>
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
}
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
    display: block;
}
body {
    font-size: 16px;
    line-height: 1.3;
    font-weight: 400;
    color: #454545;
    outline: none;
    text-shadow: none;
    box-shadow: none;
    font-family: "Open Sans", Arial, Helvetica, sans-serif;
}
ol, ul {
    list-style: none;
}
blockquote, q {
    quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
    content: '';
    content: none;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
a{
    text-decoration: none;
}
img{
    max-width:100%;
}

/***************************************
CUSTOM MAP THEME GREEN
***************************************/
.aione-wrapper.aione-theme-green{

}
.aione-wrapper.aione-theme-green .aione-map-wrapper .land{
fill: #cdcac5;
stroke: #ffffff;
stroke-width: 0.3;
}
.aione-wrapper.aione-theme-green .aione-map-wrapper .land:hover{
fill: #b9b6b2;
}
.aione-wrapper.aione-theme-green .aione-map-wrapper .active{
fill:#6db77c;
} 
.aione-wrapper.aione-theme-green .aione-map-wrapper .active:hover{
fill:#5ca56a;
} 

/***************************************
AIONE TOOLTIP
***************************************/
.aione-tooltip {
    display: none;
    position: absolute;
    width: 200px;
    padding: 4px;
    margin: 0 0 0 -100px;
    color: #FFFFFF;
    font-size: 15px;
    line-height: 1.333;
	text-align:center;
    background-color: rgba(0,0,0,0.8);
    z-index: 9999;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}
.aione-tooltip .handle {
	display:none;
    position: absolute;
    width: 0;
    height: 0;
    margin: 0 0 0 -10px;
    border-top: 10px solid rgba(0,0,0,0.8);
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    z-index: 9999;
}

.aione-tooltip .title {
    text-align: center;
    padding: 0;
    margin: 0;
    display: block;
}
.aione-tooltip .data {
	border-top: 1px solid rgba(255,255,255,0.4);
    display: block;
    padding: 4px 0 0 0;
    margin: 4px 0 0 0;
	font-size: 14px;
    line-height: 1.333;
	color:#ededed;
}


/***************************************
AIONE LOADER
***************************************/
.aione-loader{
    position: fixed;
    top:0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 80;
    display: block;
    text-align: center;
    background-color: #ffffff;
} 

.loading-animation{
    position: absolute;
    top: 50%;
    left: 50%;
    width: 280px;
    margin: -2px 0 0 -140px;
    -o-transform: scale(1);
    -ms-transform: scale(1);
    -moz-transform: scale(1);
    -webkit-transform: scale(1);
    transform: scale(1);
    transition: -webkit-transform .5s ease;
    transition: transform .5s ease;
    transition: transform .5s ease, -webkit-transform .5s ease;
}
.loading-animation .loading-bar{
    width: 60%;
    height: 4px;
    margin: 0 auto;
    border-radius: 2px;
    background-color: #cfcfcf;
    position: relative;
    overflow: hidden;
    z-index: 1;
    transition: -webkit-transform .3s ease-in;
    transition: transform .3s ease-in;
    transition: transform .3s ease-in, -webkit-transform .3s ease-in;
}
.loading-animation .loading-bar .blue-bar{
    height: 100%;
    width: 50%;
    position: absolute;
    background-color: #3596d8;
    border-radius: 2px;
    -moz-animation: initial-loading 1.5s infinite ease;
    -webkit-animation: initial-loading 1.5s infinite ease;
    animation: initial-loading 1.5s infinite ease;
}

@-webkit-keyframes initial-loading{
    0%,100%{
        -webkit-transform:translate(-50%,0);
        transform:translate(-50%,0);
    }
    50%{
        -webkit-transform:translate(150%,0);
        transform:translate(150%,0);
    }
}
@keyframes initial-loading{
    0%,100%{
        -webkit-transform:translate(-50%,0);
        transform:translate(-50%,0);
    }
    50%{
        -webkit-transform:translate(150%,0);
        transform:translate(150%,0);
    }
}



::-webkit-scrollbar {
	width: 8px;
}
::-webkit-scrollbar-track {
	-webkit-box-shadow: inset 0 0 3px rgba(0,0,0,0.3); 
}
::-webkit-scrollbar-thumb {
	background: #454545; 
	-webkit-box-shadow: inset 0 0 3px rgba(0,0,0,0.5); 
}
::-webkit-scrollbar-thumb:window-inactive {
	background: #888888; 
}
		</style>
	</head>
	<body>
	
		<div id="aione_wrapper" class="aione-wrapper aione-layout-wide aione-visualization aione-theme-{{$theme}}">
			<div class="aione-row">
				<div id="aione_header" class="aione-header">
					<div class="aione-row">
					</div><!-- .aione-row -->
				</div><!-- #aione_header -->
				<div id="aione_main" class="aione-main">
					<div class="aione-row">
						<div id="aione_map_wrapper" class="aione-map-wrapper">
							@php
							if($mapdata !== 'No Data available'){
								$map = $mapdata['map_data'];	
								echo $map;
							} else {
								echo "NO DATA";
							}
							@endphp

						</div><!-- #aione_map_wrapper -->
						<div id="aione_tooltip" class="aione-tooltip"></div><!-- #aione_tooltip -->
						<div id="aione_tooltip_data" class="aione-tooltip-data hide" style="display:none;">{{$data}}</div><!-- #aione_tooltip_data -->
					</div><!-- .aione-row -->
				</div><!-- #aione_main -->
				
				<div id="aione_footer" class="aione-footer">
					<div class="aione-row">
						
					</div><!-- .aione-row -->
				</div><!-- #aione_main -->
			</div><!-- .aione-row -->
		</div><!-- #aione_wrapper -->
		
		<div id="aione_loader" class="aione-loader" style="display:none">
			<div class="loading-animation">
				<div class="loading-bar">
					<div class="blue-bar"></div> 
				</div>
			</div>
		</div> <!-- aione_loader -->
		
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script type="text/javascript">

	$(document).ready(function(){
		
		//console.log( $.browser );
		
		$('body').addClass("ua-"+$.browser.name);
		$('body').addClass("ua-version-"+$.browser.versionNumber);
		
		$('#aione_loader').hide();
		
		var viewport = viewport();
		
		$('.aione-map-wrapper svg').css({
			'width':viewport.width - 5,
			'height':viewport.height - 5,
			'max-width':'100%',
			'max-height':'100%'
		});
		
		$( window ).resize(function() {
			//var viewport = viewport();
			var e = window, a = 'inner';
			if ( !( 'innerWidth' in window ) ){
				a = 'client';
				e = document.documentElement || document.body;
			}
			var viewport_width = e[ a+'Width' ];
			var viewport_height = e[ a+'Height' ];
			
			$('.aione-map-wrapper svg').css({
				'width':viewport_width - 5,
				'height':viewport_height - 5,
				'max-width':'100%',
				'max-height':'100%'
			});
			
			//console.log(viewport_width + 'x' + viewport_height);
		});
																	
		/*
		$(".map_area").load(function(){
			console.log("== Loaded");
			$('#aione_loader').hide();	    
		});
		*/
    var source = "{{@$source}}";

    console.log("source== "+source);

		var map_data = $('.aione-tooltip-data').text();
		map_data = map_data.split('+');
		//console.log(map_data);
		$.each(map_data, function(key, value){
			var path = value.split('=');
			$('.aione-map-wrapper').find('#'+path[0]).addClass('active').attr('data-tooltip',path[1]);
			
		});
		
		$('.aione-map-wrapper .active').mouseover(function (e) {
			var area_id = $(this).attr('id');
			var area_title = $(this).attr('title'); 
			var area_tooltip = $(this).attr('data-tooltip');
			var html = '<span class="title">'+area_title+'</span>';
			if(area_tooltip != undefined){
				html += '<span class="data">'+area_tooltip+'</span>';
			}
			//html += '<span class="handle"></span>';
			$('.aione-tooltip').html(html);
		}).mousemove(function(e){			
			var mouseX = e.pageX; //X coordinates of mouse
			var	mouseY = e.pageY; //Y coordinates of mouse
			
			var tooltip_element = $('.aione-tooltip');
			
			var	tooltip_width = tooltip_element.width(); // Width of tooltip
			var	tooltip_height = tooltip_element.height(); // Height of tooltip
			
			var	tooltip_x = mouseX; // Tooltip X Position
			var	tooltip_y = mouseY - tooltip_height - 30; // Tooltip X Position
			
				
			if( mouseX < (tooltip_width / 2)){
				tooltip_x = tooltip_width / 2;
			}
			if( mouseX > ($('body').width() - (tooltip_width / 2) - 10)){
				tooltip_x = $('body').width() - (tooltip_width / 2) - 10;
			}
			
			if( mouseY < (tooltip_height + 30)){
				tooltip_y = mouseY + 30 ;
			}

			$('.aione-tooltip').css({
				'left': tooltip_x,
				'top': tooltip_y,
				'display': 'block'
			});
		}).mouseleave(function(){
			$('.aione-tooltip').hide();
			//$('.aione-tooltip .handle').hide();
		});
		
		function viewport(){
			var e = window, a = 'inner';
			if ( !( 'innerWidth' in window ) ){
				a = 'client';
				e = document.documentElement || document.body;
			}
			return { width : e[ a+'Width' ] , height : e[ a+'Height' ] }
		}


	});
	
	
	

	

	
	
(function (factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['jquery'], function ($) {
      return factory($);
    });
  } else if (typeof module === 'object' && typeof module.exports === 'object') {
    // Node-like environment
    module.exports = factory(require('jquery'));
  } else {
    // Browser globals
    factory(window.jQuery);
  }
}(function(jQuery) {
  "use strict";

  function uaMatch( ua ) {
    // If an UA is not provided, default to the current browser UA.
    if ( ua === undefined ) {
      ua = window.navigator.userAgent;
    }
    ua = ua.toLowerCase();

    var match = /(edge)\/([\w.]+)/.exec( ua ) ||
        /(opr)[\/]([\w.]+)/.exec( ua ) ||
        /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
        /(version)(applewebkit)[ \/]([\w.]+).*(safari)[ \/]([\w.]+)/.exec( ua ) ||
        /(webkit)[ \/]([\w.]+).*(version)[ \/]([\w.]+).*(safari)[ \/]([\w.]+)/.exec( ua ) ||
        /(webkit)[ \/]([\w.]+)/.exec( ua ) ||
        /(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
        /(msie) ([\w.]+)/.exec( ua ) ||
        ua.indexOf("trident") >= 0 && /(rv)(?::| )([\w.]+)/.exec( ua ) ||
        ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
        [];

    var platform_match = /(ipad)/.exec( ua ) ||
        /(ipod)/.exec( ua ) ||
        /(iphone)/.exec( ua ) ||
        /(kindle)/.exec( ua ) ||
        /(silk)/.exec( ua ) ||
        /(android)/.exec( ua ) ||
        /(windows phone)/.exec( ua ) ||
        /(win)/.exec( ua ) ||
        /(mac)/.exec( ua ) ||
        /(linux)/.exec( ua ) ||
        /(cros)/.exec( ua ) ||
        /(playbook)/.exec( ua ) ||
        /(bb)/.exec( ua ) ||
        /(blackberry)/.exec( ua ) ||
        [];

    var browser = {},
        matched = {
          browser: match[ 5 ] || match[ 3 ] || match[ 1 ] || "",
          version: match[ 2 ] || match[ 4 ] || "0",
          versionNumber: match[ 4 ] || match[ 2 ] || "0",
          platform: platform_match[ 0 ] || ""
        };

    if ( matched.browser ) {
      browser[ matched.browser ] = true;
      browser.version = matched.version;
      browser.versionNumber = parseInt(matched.versionNumber, 10);
    }

    if ( matched.platform ) {
      browser[ matched.platform ] = true;
    }

    // These are all considered mobile platforms, meaning they run a mobile browser
    if ( browser.android || browser.bb || browser.blackberry || browser.ipad || browser.iphone ||
      browser.ipod || browser.kindle || browser.playbook || browser.silk || browser[ "windows phone" ]) {
      browser.mobile = true;
    }

    // These are all considered desktop platforms, meaning they run a desktop browser
    if ( browser.cros || browser.mac || browser.linux || browser.win ) {
      browser.desktop = true;
    }

    // Chrome, Opera 15+ and Safari are webkit based browsers
    if ( browser.chrome || browser.opr || browser.safari ) {
      browser.webkit = true;
    }

    // IE11 has a new token so we will assign it msie to avoid breaking changes
    // IE12 disguises itself as Chrome, but adds a new Edge token.
    if ( browser.rv || browser.edge ) {
      var ie = "msie";

      matched.browser = ie;
      browser[ie] = true;
    }

    // Blackberry browsers are marked as Safari on BlackBerry
    if ( browser.safari && browser.blackberry ) {
      var blackberry = "blackberry";

      matched.browser = blackberry;
      browser[blackberry] = true;
    }

    // Playbook browsers are marked as Safari on Playbook
    if ( browser.safari && browser.playbook ) {
      var playbook = "playbook";

      matched.browser = playbook;
      browser[playbook] = true;
    }

    // BB10 is a newer OS version of BlackBerry
    if ( browser.bb ) {
      var bb = "blackberry";

      matched.browser = bb;
      browser[bb] = true;
    }

    // Opera 15+ are identified as opr
    if ( browser.opr ) {
      var opera = "opera";

      matched.browser = opera;
      browser[opera] = true;
    }

    // Stock Android browsers are marked as Safari on Android.
    if ( browser.safari && browser.android ) {
      var android = "android";

      matched.browser = android;
      browser[android] = true;
    }

    // Kindle browsers are marked as Safari on Kindle
    if ( browser.safari && browser.kindle ) {
      var kindle = "kindle";

      matched.browser = kindle;
      browser[kindle] = true;
    }

     // Kindle Silk browsers are marked as Safari on Kindle
    if ( browser.safari && browser.silk ) {
      var silk = "silk";

      matched.browser = silk;
      browser[silk] = true;
    }

    // Assign the name and platform variable
    browser.name = matched.browser;
    browser.platform = matched.platform;
    return browser;
  }

  // Run the matching process, also assign the function to the returned object
  // for manual, jQuery-free use if desired
  window.jQBrowser = uaMatch( window.navigator.userAgent );
  window.jQBrowser.uaMatch = uaMatch;

  // Only assign to jQuery.browser if jQuery is loaded
  if ( jQuery ) {
    jQuery.browser = window.jQBrowser;
  }

  return window.jQBrowser;
}));
</script>
	</body>
</html>