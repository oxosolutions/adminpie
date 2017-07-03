@extends('layouts.main')
@section('content')
<div>
    @include('organization.project._tabs')
    <div class="col l12">
    	<div class="fade-background">
		</div>
		@include('common.notes')
    </div>
</div>
<script type="text/javascript">
	$('.add-new').off().click(function(e){
			e.preventDefault();
			$('.add-new-wrapper').toggleClass('active');
			$('.fade-background').fadeToggle(300);
		});
		
		$('.fade-background').click(function(){
			$('.fade-background').fadeToggle(300);
			$('.add-new-wrapper').toggleClass('active');
		});
</script>
<style type="text/css">
	.materialize-textarea:focus{
		border-bottom: 1px solid #a1a1a1 !important;
	}
	 #notes ul,li{
	  list-style:none;
	}
	 #notes  ul{
	  overflow:hidden;
	 
	}
	 #notes  ul li a{
	  text-decoration:none;
	  color:#000;
	  background:#ffc;
	  display:block;
	  height:10em;
	  width:15.97em;
	  padding:1em;
	  -moz-box-shadow:5px 5px 7px rgba(33,33,33,1);
	  -webkit-box-shadow: 5px 5px 7px rgba(33,33,33,.7);
	  box-shadow: 5px 5px 7px rgba(33,33,33,.7);
	  -moz-transition:-moz-transform .15s linear;
	  -o-transition:-o-transform .15s linear;
	  -webkit-transition:-webkit-transform .15s linear;
	}
	 #notes  ul li{
	  margin:10px;
	  float:left;
	}
	 #notes  ul li h2{
	  font-size:140%;
	  font-weight:bold;
	  padding-bottom:10px;
	}
	h2{
		margin: 0px !important
	}
	
/*	 #notes  ul li p{
	  font-family:"Reenie Beanie",arial,sans-serif;
	  font-size:180%;
	}
	 #notes  ul li a{
	  -webkit-transform: rotate(-6deg);
	  -o-transform: rotate(-6deg);
	  -moz-transform:rotate(-6deg);
	}
	 #notes  ul li:nth-child(even) a{
	  -o-transform:rotate(4deg);
	  -webkit-transform:rotate(4deg);
	  -moz-transform:rotate(4deg);
	  position:relative;
	  top:5px;
	  background:#cfc;
	}
	 #notes  ul li:nth-child(3n) a{
	  -o-transform:rotate(-3deg);
	  -webkit-transform:rotate(-3deg);
	  -moz-transform:rotate(-3deg);
	  position:relative;
	  top:-5px;
	  background:#ccf;
	}
	 #notes  ul li:nth-child(5n) a{
	  -o-transform:rotate(5deg);
	  -webkit-transform:rotate(5deg);
	  -moz-transform:rotate(5deg);
	  position:relative;
	  top:-10px;
	}
	 #notes  ul li a:hover,ul li a:focus{
	  box-shadow:10px 10px 7px rgba(0,0,0,.7);
	  -moz-box-shadow:10px 10px 7px rgba(0,0,0,.7);
	  -webkit-box-shadow: 10px 10px 7px rgba(0,0,0,.7);
	  -webkit-transform: scale(1.25);
	  -moz-transform: scale(1.25);
	  -o-transform: scale(1.25);
	  position:relative;
	  z-index:5;
	}
	 #notes  ol{text-align:center;}
	 #notes  ol li{display:inline;padding-right:1em;}
	 #notes  ol li a{color:#fff;}*/
</style>

@endsection	