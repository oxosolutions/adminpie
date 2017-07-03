@extends('layouts.main')
@section('content')
	<div>
		@include('organization.project._tabs')
		@include('common.todos')
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
		.defualt-logo-todo{
			    width: 36px;
			    line-height: 36px;
			    border: 1px dashed #0288D1;
			    color: white;
			    font-size: 18px;
			    border-radius: 50%;
		}
		.fa-close{
			display: none
		}
		/*.fa-close:hover{
			color: white !important;
			background-color: red;
			border-color: red;
		}*/
		
		.todo_list:hover .fa-close{
			display: inline-block;
		}
		.select-dropdown{
			margin: 0px 0px 0px 0px !important;
		}
		.ph-20{
			padding: 0px 20px 0px 20px !important
		}
		.active{
			background-color: none !important;
		}
		.ph-10{
			padding-left: 10px;
			padding-right: 10px;
		}
		.pv-2{
			padding-top:2px;
			padding-bottom: 2px;
		}

		.priority-error:before{
			 content: '';
		    position: relative;
		    display: block;
		   top: -22px;
		 
		    width: 0;
		    height: 0;
		    border-left: 10px solid transparent;
		    border-right: 10px solid transparent;
		    border-bottom: 12px solid #e8e8e8;

		}
	</style>
	<script type="text/javascript">
		 $(document).ready(function() {
    $('select').material_select();
  });
	</script>
@endsection