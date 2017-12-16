<div>
	{{$model->name}}
	<ul style="display: inline;">
		<li><a href="{{route('account.profile',$model->id)}}">Edit</a></li>
		{{-- <li><a href="{{route('delete.employee',$model->id)}}">Delete</a></li> --}}
		<a href="javascript:;" data-value="{{route('delete.employee',$model->id)}}" style="padding-right:10px" id="delete" class="delete-datalist-item red action-delete">Delete</a>
	</ul>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('.action-delete').click(function(){	
			var href = $(this).attr("data-value");
	        swal({   
	            title: "Are you sure?",   
	            text: "Are you sure you want to delete",   
	            type: "warning",   
	            showCancelButton: true,   
	            confirmButtonColor: "#DD6B55",   
	            confirmButtonText: "Delete",   
	            closeOnConfirm: false 
	        }, 
	        function(){
	           window.location = href;
	           swal("Deleted!", "Your widget has been deleted.", "success"); 
	       });
		})
	})
</script>