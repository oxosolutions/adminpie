<head>
	

	@include('components._head')
	{{-- @php
		$sidebar_small = App\Model\Organization\UsersMeta::getUserMeta('layout_sidebar_small');
	@endphp --}}
	<style type="text/css">
	/*css for new components*/

		.aione-topbar{
			background-color: #e8e8e8;
		    position: absolute;
		    top: 0;
		    width: 100%;
		    height: 28px;
		    line-height: 28px;
		    padding: 0px 10px;
		    z-index: 999;
		}

		
		/*********override css**************/
		
		.aione-content{
			width: 100%;
		}
		.aione-sidebar{
			width: 100%;
		}
		.aione-nav.aione-nav-vertical ul li{
			display: inline-block;
		}
		.aione-sidebar:before{
			position: relative;
		}
		.aione-header{
			    top: 28px;
			    height: 80px;
			    position: absolute;
			    background-color: white
		}
		#aione-menu > li:nth-child(2n+3){
			display: none
		}
		.aione-main{
			padding-top: 108px;
		}
		#aione_content .page-content{
			padding-left: 0 !important;
			padding-top: 0 !important
		}
		.aione-row > .left{
			display: inline-block;
		}
		.aione-row > .right{
			display: inline-block;
			float: right;
		}
	
		.aione-header .aione-logo img{
			    max-height: 70px;
		}
		.aione-header .aione-site-title h1{
			color: #676767;
			font-size: 24px;

		}
		.aione-header .aione-site-title h4{
			font-size: 15px;
		    color: #999;
		    margin: 0;
		    padding: 0;
		}
		.aione-footer{
			color: white;
   			background-color: #454545;
   			padding: 30px 0;
		}
		.aione-footer a{
			color: white;
		}




		.grid-example .ac{
			  min-height: 50px;
  background-color: #4DB6AC;
  color: #ffffff;
  text-align: center;
  margin-bottom: 20px;
  line-height: 100px;
  font-family: Arial;
  font-size: 20px;
		}
	</style>
</head>