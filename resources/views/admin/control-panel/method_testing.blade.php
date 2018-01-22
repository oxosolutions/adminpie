@extends('admin.layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'no',
	'page_title' => 'Control Panel',
	'add_new' => ''
);
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
        @include('admin.control-panel._tabs')
        {!! Form::select('method',get_all_defined_functions(),[],['class'=>'browser-default','placeholder'=>'Select Method']) !!}
        {!! FormGenerator::GenerateForm('method_test_params') !!}
	@include('common.page_content_primary_end')
    
    <div class="output_test">
        
    </div>
    <div style="max-height: 400px;overflow-y: auto">
        <ul class="aione-message error aione-align-left p-10 font-size-12" >
            <li class="pl-10">
                <div class="ar">
                    <div class="ac l10">
                        line: 26             
                    </div>
                    <div class="ac l20">
                        file path : home/oxo/scolm/res/,,,,            
                    </div>
                    <div class="ac l20">
                        Message: this msg is warning            
                    </div>
                    <div class="ac l20">
                        Error desc: impossible to solve            
                    </div>
                    <div class="ac l20">
                        Parameters : [abc][def]            
                    </div>
                    <div class="ac l10">
                        status            
                    </div>
                </div>
            </li>
        </ul>
    </div>
        
	@include('common.page_content_secondry_start')
		
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<script type="text/javascript">
    $(document).ready(function(){
        $('input[type=submit]').click(function(){
            var method = $('select[name=method]').val();
            var params = [];
            $('.function-parameters select').each(function(){
                params.push($(this).val());
            });

            $.ajax({
                type:'POST',
                url: route()+'/method/serve',
                data: {method: method,params:JSON.stringify(params),_token:'{{ csrf_token() }}',operations: JSON.stringify($('.operations').val()),
                        organization: $('.input_on_behalf_of_org').val()
                    },
                success: function(result){
                    $('.output_test').html(result);
                } 
            });
        });
    });
</script>
@endsection

