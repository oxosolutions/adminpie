@extends('layouts.front')
@section('content')
<section>
	<style>
		button, input[type=button], input[type=reset], input[type=submit]
		 {
            border-radius: 30px;
            margin-top: 10px;
            width: 241px; 
            outline: none;
         }
         .aione-shadow {
             box-shadow: 0 0 20px rgba(0,0,0,0.5);
          }
          
          .icon1
          {
             /*position: absolute;
             left:565px;*/
             font-weight: 100;
             padding-top: -9px;
             margin-bottom: 5px;
             padding-right: 5px;
    
          }
          .icon2
          {
          	/*position: absolute;
             left:284px;*/
             font-weight: 100;
             padding-top: -9px;
             margin-bottom: 5px;
             padding-right:9px; 
          }
          .clearfix::after
           {
              content: "";
              clear: both;
              display: table;
           }
          .clearfix 
          {
           overflow: auto;
          }
        </style>
	<div class="ar pv-20 pt-20">
		<div class="ac l20"></div>
		<div class="ac l60 pt-25 aione-shadow pb-25 bg-grey bg-lighten-5">
			<div class="Wrapper aione-align-center">
				<div class="img-wrap ">
				    <img class="" src="{{ asset('assets/images/check-box.png') }}"/>	
				</div>
				<div class="text-wrap pb-30">
					<h2 class="font-size-23 font-weight-600 pb-10">Survey Is Compeletd</h2>
					<p class="font-size-17 line-height-28 mt-10 pt-6">Would you like to send your survey Now?</p>
				</div>
				<div class="button-wrap pt-10">
					<button class="bg-light-blue bg-darken-2 aione-shadow" onclick="window.location.href='{{ route('embed.survey',['token'=>request()->token]) }}'"><i class="fa fa-rotate-left icon1 font-size-23 mb-16"></i>Start Again</button>
				</div>
				<div class=" clearfix button-wrap1">	
					<button class="bg-light-blue bg-darken-2 aione-shadow " onclick="closeWindow();"><i class="fa fa-close icon2 font-size-23 mb-16"></i><span class="pr-33">Close</span></button>
				</div>
			</div>
		</div>
		<div class="ac l20"></div>
	</div>
</section>
<script type="text/javascript">
    $('.close_window').on('click', function(){
      window.open('','_parent','');
        window.close();
   });
</script>
<script>
    function closeWindow() {
        window.open('','_parent','');
        window.close();
    }
</script> 
@endsection