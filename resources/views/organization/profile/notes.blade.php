@extends('layouts.main')
@section('content')
<div class="row">
	@include('organization.profile._tabs')
	@include('common.notes')
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

</style>
@endsection