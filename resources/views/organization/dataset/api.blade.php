@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Add Ticket',
	'add_new' => 'All Ticket',
	'route' => 'add.ticket'
);
@endphp 
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.dataset._tabs')
	<div>
		Select columns to make api
		<div class="ar p-10 wrapper">
			<div class="ac l50 aione-border p-10 pr-10 fbox" id="drop" style="min-height: 200px;max-height: 200px">
				
			</div>
			<div class="ac l50 aione-border p-10 fbox" id="origin" style="min-height: 200px;max-height: 200px">
				<div id="one" class="draggable p-10 ">
					this is dragable item
				</div>
				<div id="two" class="draggable p-10">
					this is dragable item
				</div>
			</div>
		</div>
	</div>
	<div>
		{!! FormGenerator::GenerateForm('api_condition_form') !!}
	</div>
	<div class="pv-20">
		Api Link :- <a href="https://thisisthedemoapi.com/v2/route101">https://thisisthedemoapi.com/v2/route101</a>
	</div>
	<div class="aione-border p-10" style="min-height: 350px;max-height: 350px;overflow: auto">
		this is json data ...
	</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	<script type="text/javascript">
		$(".draggable").draggable({ cursor: "crosshair", revert: "invalid"});
$("#drop").droppable({ accept: ".draggable", 
           drop: function(event, ui) {
                    console.log("drop");
                   $(this).removeClass("border").removeClass("over");
             var dropped = ui.draggable;
            var droppedOn = $(this);
            $(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn);      
             
             
                }, 
          over: function(event, elem) {
                  $(this).addClass("over");
                   console.log("over");
          }
                ,
                  out: function(event, elem) {
                    $(this).removeClass("over");
                  }
                     });
$("#drop").sortable();

$("#origin").droppable({ accept: ".draggable", drop: function(event, ui) {
                    console.log("drop");
                   $(this).removeClass("border").removeClass("over");
             var dropped = ui.draggable;
            var droppedOn = $(this);
            $(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn);      
             
             
                }});
	</script>
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection


