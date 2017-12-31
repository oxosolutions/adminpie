  @extends('layouts.main')
@section('content')
@php
// dump($data);
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset API',
	'add_new' => 'All Ticket',
	'route' => 'add.ticket'
);
@endphp 
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.dataset._tabs')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/nestable.css') }}">
    <style type="text/css">
        /*===============================================
          Nestable
        ================================================= */
        .nestable-lists:before,
        .nestable-lists:after {
          content: " ";
          display: table;
        }
        .nestable-lists:after {
          clear: both;
        }
        .nestable-lists:before,
        .nestable-lists:after {
          content: " ";
          display: table;
        }
        .nestable-lists:after {
          clear: both;
        }
        /*nestable*/
        .dd {
          max-width: 100%;
        }
        /* Item heading */
        .dd-handle {
          display: block;
          height: auto;
          cursor: pointer;
          margin: 7px 0;
          padding: 10px 14px;
          color: #777;
          font-size: 15px;
          font-weight: 600;
          text-decoration: none;
          border-radius: 2px;
          border: 1px solid #ddd;
          background-color: #f2f2f2;
        }
        /* heading hover */
        .dd-handle:hover {
          color: #333;
          background: #ededed;
        }
        .dd-handle:hover + .dd-content {
          border-color: #f9d58b;
        }
        .dd-item > button {
          margin: 7px 0;
        }
        /* item content */
        .dd-content {
          margin-top: -5px;
          padding: 10px;
          border: 1px solid #ddd;
          border-top: 0;
          background: #fafafa;
        }
        .dd-list .dd-list {
          padding-top: 5px;
          padding-bottom: 5px;
        }
        /* heading/content - dragged */
        .dd-empty {
          background: #f8f8f8;
        }
        .dd-item.dd-info > button,
        .dd-item.dd-primary > button {
          color: #FFF;
        }
        .dd-item.dd-primary .dd-handle {
          color: #FFF;
          background-color: #4a89dc !important;
          border-color: #4a89dc !important;
        }
        .dd-item.dd-info .dd-handle {
          color: #FFF;
          background-color: #3bafda !important;
          border-color: #3bafda !important;
        }

    </style>
	<div>
		Select columns to make api
		
		<div class="ar p-10 wrapper">
			
			<div class="ac l50  p-10 pr-10 " >
				{{-- <div class="fbox aione-border p-10 pt-0"  id="drop" style="min-height: 200px;max-height: 200px;overflow: auto;">
					@if(!empty($data['in_columns']))
						@foreach($data['in_columns'] as $key => $val)
							<div id="one" class="draggable p-10 aione-border mb-10 display-inline-block" style="cursor: pointer">
								<input type="hidden" name="column[{{$val['column']}}]" value="{{$val['alias']}}">
								{{$val['column']}}
							</div>
						@endforeach
					@endif	
				</div> --}}
                @include('organization.dataset.api-builder')
				<div>
					{!! Form::submit('Submit',['class'=>'submit-json']) !!}		
				</div>
				
			</div>
				
			
			<div class="ac l50 aione-border p-10 fbox columns-box" id="origin" style="min-height: 200px;max-height: 200px;overflow: auto">
				@foreach($data['columns'] as $key => $val)
					<div class="p-10 aione-border mb-10 display-inline-block column-click" data-column="{{$key}}" data-alias="{{$val}}" style="cursor: pointer">
						<input type="hidden" name="{{ $key }}" value="{{ $val }}">
						{{$val}}
					</div>
				@endforeach
                <div class="p-10 aione-border mb-10 display-inline-block blank-click" style="cursor: pointer">
                    <input type="hidden" name="blank" value="blank">
                    Blank
                </div>
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
    <div class="p-10 tooltip-input" style="position: absolute;display: none">
        <i class="fa fa-close aione-float-right p-5"></i>
        <div id="aione_form_wrapper_70" class="aione-form-wrapper aione-form-theme-light aione-form-label-position- aione-form-style-   ">
            <div id="aione_form_section_97" class="aione-form-section non-repeater">
                <div id="field_email" class="field field-type-email">
                    <input type="text" name="blank_text">
                </div>
            </div>
        </div>
        
        <button type="submit" class="add-blank" style="width: 100%;">Add New</button>
    </div>
    <script src="{{ asset('js/jquery.nestable.js') }}"></script>

	<script type="text/javascript">
        $('#nestable').nestable({
                group: 1
        }).on('change', function(e){
           var list = e.length ? e : $(e.target);
           window.data = list.nestable('serialize');
            // var output = list.data('output');
            // console.log(output);
        });

        $('.submit-json').click(function(){
            console.log(window.data);
            $.ajax({
                type: 'POST',
                url: route()+'/dataset/api/'+{{ request()->id }},
                data: {'data': JSON.stringify(window.data), '_token':'{{ csrf_token() }}' },
                success: function(result){
                    console.log(result);
                }
            });
        });

        /*var updateOutput = function(e) {
            
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };*/

        $('body').on('click','.column-click', function(){
            var html = `
                    <li class="dd-item" data-id="`+$(this).data('column')+`">
                        <a href="javascript:;"><i class="fa fa-trash removeColumn" style="color:#757575;float:right;cursor:pointer;font-size:18px;padding-left:10px;line-height:42px;width:42px;" data-key="`+$(this).data('column')+`" data-value="`+$(this).data('alias')+`"></i></a>
                        <div class="dd-handle">`+$(this).data('alias')+`
                            
                            <span class="text-success pull-right fs11 fw600" style="font-size:10px;">`+$(this).data('column')+`</span>
                        </div>
                        
                    </li>
            `;
            $('#api-columns').append(html); 
            $(this).remove();
        });


        $('body').on('click','.removeColumn',function(e){
            var key = $(this).data('key');
            var value = $(this).data('value');
            
            window.keyValue = {};
            getChildsLi($(this).parent().parent('li'));
            var html = `
                    <div class="p-10 aione-border mb-10 display-inline-block column-click" data-column="`+key+`" data-alias="`+value+`" style="cursor: pointer">
                        <input type="hidden" name="`+key+`" value="`+value+`">
                        `+value+`
                    </div>`;
            $('.columns-box').prepend(html);
            $.each(keyValue, function(key,val){
                 var html = `
                    <div class="p-10 aione-border mb-10 display-inline-block column-click" data-column="`+key+`" data-alias="`+val+`" style="cursor: pointer">
                        <input type="hidden" name="`+key+`" value="`+val+`">
                        `+val+`
                    </div>`;
                $('.columns-box').prepend(html);
            });
            $(this).parent().parent('li').remove();
        });

        function getChildsLi(elem){
            elem.find('li').each(function(){
                if($(this).find('li').length >= 1){
                    window.keyValue[$(this).find('i').data('key')] = $(this).find('i').data('value');
                    getChildsLi($(this));
                }else{
                    window.keyValue[$(this).find('i').data('key')] = $(this).find('i').data('value');
                }
            });
        }

        $('.blank-click').click(function(e){
            e.stopPropagation();
            var left = e.pageX;
            var top = e.pageY;
            $('.tooltip-input').find('input').val('');
            $('.tooltip-input').css({
                'display':'block',
                'left': (left-300)+'px',
                'top': (top)+'px',
                'box-shadow': '0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)',
                'background-color': '#FFF'
            }).show();

             /*var html = `
                    <li class="dd-item" data-id="1">
                        <div class="dd-handle">Click to edit</div>
                    </li>
            `;
            $('#api-columns').append(html); */
        });
        $('.add-blank').click(function(){
            var inputVal = $('input[name=blank_text]').val();
            var replace_space = inputVal.replace(/ /g,"_");
            var html = `
                    <li class="dd-item" data-id="`+replace_space+`" data-blank="blank">
                        <a href="javascript:;"><i class="fa fa-trash removeColumn" style="color:#757575;float:right;cursor:pointer;font-size:18px;padding-left:10px;line-height:42px;width:42px;"></i></a>
                        <div class="dd-handle">`+replace_space+`<span></span></div>
                    </li>
            `;
            $('#api-columns').append(html);
            $('.tooltip-input').hide();
        });
        $('.fa-close').click(function(){
            $('.tooltip-input').hide();
        });



		/*$(".draggable").draggable({ cursor: "crosshair", revert: "invalid"});
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
             
             
                }});*/
	</script>
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection


