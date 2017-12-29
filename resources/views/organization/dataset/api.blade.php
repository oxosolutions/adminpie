@extends('layouts.main')
@section('content')
@php
// dump($data);
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'API Builder',
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
			{!! Form::open(['route'=>['api.dataset',$data['id']]]) !!}
			<div class="ac l50  p-10 pr-10 " >
				<div class="fbox aione-border p-10 pt-0"  id="drop" style="min-height: 200px;max-height: 200px;overflow: auto;">
					@if(!empty($data['in_columns']))
						@foreach($data['in_columns'] as $key => $val)
							<div id="one" class="draggable p-10 aione-border mb-10 display-inline-block" style="cursor: pointer">
								<input type="hidden" name="column[{{$val['column']}}]" value="{{$val['alias']}}">
								{{$val['column']}}
							</div>
						@endforeach
					@endif	
				</div>
				<div>
					{!! Form::submit() !!}		
				</div>
				
			</div>
				
			{!! Form::close() !!}
			
			<div class="ac l50 aione-border p-10 fbox" id="origin" style="min-height: 200px;max-height: 200px;overflow: auto">
				@foreach($data['columns'] as $key => $val)
					<div id="one" class="draggable p-10 aione-border mb-10 display-inline-block" style="cursor: pointer">
						<input type="hidden" name="column[{{$val['column']}}]" value="{{$val['alias']}}">
						{{$val['column']}}
					</div>
				@endforeach
				
			</div>
		</div>
	
		
	</div>
	{{-- <div>
		{!! FormGenerator::GenerateForm('api_condition_form') !!}
	</div> --}}
	<div class="pv-20">
		@if(!empty($data['link']))
			Api Link :- <a href="{{$data['link']}}">{{$data['link']}}</a>
		@endif
	</div>
	<div class="aione-border p-10" style="min-height: 350px;max-height: 350px;overflow: auto">
		@if(isset($data['response']))
		<code>
			<pre>
				@php
					$newArray = [];
						foreach(json_decode($data['response']) as $k => $v){
							$appendedData = [];
							foreach ($v as $key => $value) {
								$appendedData[$key] = $value; 
							}
								$newArray[] = $appendedData;
						}
						
					$json = json_encode($newArray , JSON_PRETTY_PRINT);
					print_r($json);
				@endphp
				{{-- {{json_encode($data['response'],JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)}} --}}
			</pre>
		</code>
		@endif	
		
			

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
 			$("#drop draggable ")

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


