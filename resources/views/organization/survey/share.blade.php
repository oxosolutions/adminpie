@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Survey Share',
    'add_new' => '+ Add Media'
); 
$id = "";
// dump($sections = $survey_data[0]['section']);
@endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.survey._tabs')

	<div class="share-wrapper">
		<div class="share-link">
			<div class="title">
				Share Link
			</div>
			<div class="body-wrapper">
				<div class="link-field">
					{!! FormGenerator::GenerateField('shareable_link',['default_value'=>route('embed.survey',$token)]) !!}
				</div>
				<div class="copy-button">
					<button id="copy_button" onclick="copyToClipboard('#input_shareable_link')"> Copy link</button>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="share-user">
			
			<div class="title">
				share with users
			</div>
			{!!Form::open(['route'=>['save.shareto',request()->route()->parameters()['id']]])!!}
			<div class="body-wrapper">
				<div class="user-field">
					{!! FormGenerator::GenerateField('email_user_share') !!}
					
				</div>
				<div class="share-button">
					<div>{!! FormGenerator::GenerateField('user-share-edit-view',['default_value'=>['read_write'=>'Can Read/Write','read_only'=>'Can Read Only']]) !!}</div>
					<div><button>Share</button></div>
				</div>
				<div class="clear"></div>
			</div>
			{!!Form::close()!!}
			<div class="list-users">
				<table class="striped">
			        <thead>
						<tr>
							<th>Email</th>
							<th>Rights</th>
							<th>Remove</th>
						</tr>
			        </thead>

			        <tbody>
						@foreach($collab as $key => $value)
							<tr>
								<td>{{$value->email}}</td>
								<td>{{$value->access}}</td>
								<td><a href="{{route('survey.remove.shareto',$value->id)}}" style="color: #757575"><i class="material-icons dp48">clear</i></a></td>
							</tr>
						@endforeach
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
	<style type="text/css">
		.share-wrapper{
			margin-top: 30px
		}
		.share-wrapper button{
			padding: 8px 12px;
		}
		.share-wrapper .share-link,
		.share-wrapper .share-user{
			border:1px solid #e8e8e8;
			padding:15px;
			position: relative;
			margin-bottom: 30px;
		}
		.share-wrapper .share-link .title,
		.share-wrapper .share-user .title{
			background-color: #e8e8e8;
			display: inline-block;
			padding:10px;
			position: absolute;
			top: -17px
		}
		.share-wrapper .share-link .body-wrapper,
		.share-wrapper .share-user .body-wrapper{
			padding: 20px 0px
		}
		.share-wrapper .share-link .body-wrapper .link-field,
		.share-wrapper .share-user .body-wrapper .user-field,
		.share-wrapper .share-link .body-wrapper .copy-button,
		.share-wrapper .share-user .body-wrapper .share-button,
		.share-wrapper .share-user .body-wrapper .share-button >div{
			float: left;
		}
		.share-wrapper .share-link .body-wrapper .link-field,
		.share-wrapper .share-user .body-wrapper .user-field{
			width: 75%;

		}
		.share-wrapper .share-link .body-wrapper .copy-button,
		.share-wrapper .share-user .body-wrapper .share-button{
			width: 25%;
		}
		.share-wrapper .share-user .body-wrapper .share-button >div{
			margin-left: 10px;
			width: 45%
		}
		.share-wrapper .share-user .list-users table thead{
			background-color: #454545;
			color: white
		}

	</style>
	<script type="text/javascript">
		document.getElementById("copy_button").addEventListener("click", function() {
		    copyToClipboard(document.getElementById("input_shareable_link"));
		   
		});
		function copyToClipboard(elem) {
			var targetId = "_hiddenCopyText_";
		    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
		    var origSelectionStart, origSelectionEnd;
		    if (isInput) {
		        // can just use the original source element for the selection and copy
		        target = elem;
		        origSelectionStart = elem.selectionStart;
		        origSelectionEnd = elem.selectionEnd;
		    } else {
		        // must use a temporary form element for the selection and copy
		        target = document.getElementById(targetId);
		        if (!target) {
		            var target = document.createElement("textarea");
		            target.style.position = "absolute";
		            target.style.left = "-9999px";
		            target.style.top = "0";
		            target.id = targetId;
		            document.body.appendChild(target);
		        }
		        target.textContent = elem.textContent;
		    }
		    // select the content
		    var currentFocus = document.activeElement;
		    target.focus();
		    target.setSelectionRange(0, target.value.length);
		    
		    // copy the selection
		    var succeed;
		    try {
		    	  succeed = document.execCommand("copy");
		    } catch(e) {
		        succeed = false;
		    }
		    // restore original focus
		    if (currentFocus && typeof currentFocus.focus === "function") {
		        currentFocus.focus();
		    }
		    
		    if (isInput) {
		        // restore prior selection
		        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
		    } else {
		        // clear temporary content
		        target.textContent = "";
		    }
		    return succeed;
		}

	</script>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection