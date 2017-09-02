 <script type="text/javascript">
    $(document).on('click','.delete-field',function(e){
        e.preventDefault();
        var href = $(this).attr("href");
        swal({   
            title: "Are you sure?",   
            text: "You will not be able to recover!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete it!",   
            closeOnConfirm: false 
        }, 
        function(){
            window.location = href;
           swal("Deleted!", "Your widget has been deleted.", "success"); 
       });
    })
</script>