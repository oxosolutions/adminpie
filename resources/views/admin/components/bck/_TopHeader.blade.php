<div class="navbar navbar-inverse">
	<div class="navbar-header left-align">
		{{-- <a class="navbar-brand" href="index.html"><img src="{{ asset('LTR/default/assets/images/logo_light.png') }}" alt=""></a> --}}
		{{-- <ul class="nav navbar-nav visible-xs-block">
			<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
		</ul> --}}
		<ul class="nav navbar-nav left-align" style="margin-left:7px">
			<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

			<a class="navbar-brand" href="{{route('organization.dashboard')}}">OCRM</a>
		</ul>
		

		
	</div>

	<div class="navbar-collapse collapse " id="navbar-mobile">
		

		

		<ul class="nav navbar-nav navbar-right">
			

			<div id="clock">
  
			</div>
		</ul>
	</div>

</div>
<style type="text/css">
	.navbar-header .navbar-nav{
		float: left;
	}
	#clock {
   text-align: center;
   line-height: 46px;
   font-size: 18px;
   font-family: Baskerville, Georgia;
}
</style>
<script type="text/javascript">
	function clock(){

//Save the times in variables

var today = new Date();

var hours = today.getHours();
var minutes = today.getMinutes();
var seconds = today.getSeconds();


//Set the AM or PM time

if (hours >= 12){
  meridiem = " PM";
}
else {
  meridiem = " AM";
}


//convert hours to 12 hour format and put 0 in front
if (hours>12){
	hours = hours - 12;
}
else if (hours===0){
	hours = 12;	
}

//Put 0 in front of single digit minutes and seconds

if (minutes<10){
	minutes = "0" + minutes;
}
else {
	minutes = minutes;
}

if (seconds<10){
	seconds = "0" + seconds;
}
else {
	seconds = seconds;
}


document.getElementById("clock").innerHTML = (hours + ":" + minutes + ":" + seconds + meridiem);

}


setInterval('clock()', 1000);
</script>