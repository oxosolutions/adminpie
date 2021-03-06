@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Ticket ID <span>'.'114520110'.'</span>',
	'add_new' => '+ Add Feedback',
	'route' => 'add.feedback'
); 

@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		<div class="ar">
			<div class="ac l70 m70 s100 ">
				<div class="aione-border p-10">
					<h5 class="aione-border-bottom pb-10 light-blue darken-3">{{ $model->subject }}</h5>
					<div class="aione-border-bottom pv-10">
						{!! $model->description !!}
					</div>
					<div class="aione-border-bottom pv-10">
                        @php
                            $attachments = json_decode($model->attachment);
                        @endphp
                        @if($attachments != null)
                            @foreach($attachments as $key => $attachment)
                                @php
                                    $extension = File::extension($attachment);
                                @endphp
        						<div class="aione-border border-orange display-inline-block border-size-4" style="max-height:100px;max-width: 100px ;overflow: hidden">
                                    @if(in_array($extension,['jpg','jpeg','png']))
                                        <img src="{{ asset(upload_path('support_ticket_attachments')) }}/{{ $attachment }}" />
                                    @endif
                                    <a href="{{ asset(upload_path('support_ticket_attachments')) }}/{{ $attachment }}">Download Attachment {{ $loop->index+1 }}</a>
        						</div>
                            @endforeach
                        @endif
					</div>
                    {!! Form::open(['route'=>['post.ticket',request()->id],'files'=>true]) !!}
    					<div class="aione-border-bottom pv-10">
    						Attachments:-
    						<div class="mb-10">Reply to : <span class="font-weight-600">Sample Customer</span></div>
    						{{-- <div class="aione-border" contenteditable="true" style="max-height: 160px;min-height: 160px;overflow-y: auto"></div> --}}
                            {!! Form::textarea('comment',null,['style'=>'max-height: 160px;min-height: 160px;overflow-y: auto']) !!}
                            @if($errors->has('comment'))
                                <span style="color: red;">
                                    {{ $errors->first('comment') }}                                    
                                </span>
                            @endif
    						<div class="aione-border-bottom aione-border-right aione-border-left p-10 mb-10 border-darken-2">
                                <div class="mb-10">Attachments</div>
                                {!! Form::file('attachment[]',['multiple'=>'multiple']) !!}
    						</div>
    						<button class="aione-float-right" type="submit">Post Comment</button>
    						<div class="clear"></div>
    					</div>
                    {!! Form::close() !!}
					<div class="pv-15">
                        {{-- {{ dd($model) }} --}}
                        {{-- {{ dd($comments) }} --}}
                        @foreach($comments as $key => $comment)
                            @if($model->user_id == $comment->user_id)
                                <div class=" ar aione-border mb-20">
                                    <div class="ac l85 p-10 line-height-20 font-weight-400">
                                        {{ $comment->comment }}
                                    </div>
                                    <div  class="ac l15 p-10 aione-align-center aione-border-left line-height-24">
                                        <img src="https://www.atomix.com.au/media/2015/06/atomix_user31.png" class="contact-avatar" style="">
                                        sample customer
                                        <span class="aione-align-center mb-5 grey lighten-1 ">10:35pm</span>
                                    </div>
                                </div>
                            @else
                                <div class=" ar aione-border mb-20">
                                    <div  class="ac l15 p-10 aione-align-center aione-border-right line-height-24">
                                        <img src="http://fuse-angular-material.withinpixels.com/assets/images/avatars/Velazquez.jpg" class="contact-avatar" style="">
                                        Fabrizio Cedrone
                                        <span class="aione-align-center mb-5 grey lighten-1 ">10:35pm</span>
                                    </div>
                                    <div class="ac l85 p-10 line-height-20 font-weight-400">
                                        {{ $comment->comment }}
                                    </div>
                                </div>
                            @endif
    						

                        @endforeach


						
						<div class="aione-align-center">
							<a href="">View older conversation</a>
						</div>
					</div>
				</div>	
			</div>
			<div class="ac l30 m70 s100">                
                {!! Form::model(@$model,['route'=>['assign.ticket',request()->id]]) !!}
                    @if(is_admin())
        				{!! FormGenerator::GenerateForm('edit_support_ticket_form') !!}
        				<button style="width: 100%">Save</button>
                    @endif
                {!! Form::close() !!}
				<div class="aione-border p-10">
					<h5 class="aione-border-bottom pb-10 light-blue darken-3">Details</h5>
					<div class=" pv-10 line-height-24">
						Created By: {{ App\Model\Group\GroupUsers::find($model->user_id)->name }}<br>
						Created date: {{ $model->created_at->diffForHumans() }}<br>
						Due Date: 12-18-2034<br>
						Status: Finished<br>

					</div>
				</div>
                @if(is_admin() || is_employee())
    				<div class="aione-border p-10">
    					<h5 class="aione-border-bottom pb-10 light-blue darken-3">Actions</h5>
    					<div class="pv-10 line-height-24">
    						{!! FormGenerator::GenerateForm('change_status_form') !!}
    					</div>
    				</div>
                @endif
			</div>
		</div>
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
		<style type="text/css">
			.contact-avatar{
		border-radius: 50%;width: 36px;
	}
	.valign-top{
		vertical-align: top
	}
		</style>
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection