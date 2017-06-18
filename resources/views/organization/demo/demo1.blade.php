@extends('layouts.main')
@section('content')
<script src="{{ asset('js/todo.js') }}"></script>
<script type="text/javascript">
    $("#datepicker").datepicker();
    $("#datepicker").datepicker("option", "dateFormat", "dd/mm/yy");
    todo.init();
</script>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>       
<div>
    @include('organization.project._tabs')
    <div class="col l12 mb-14 ">
        <div class="card" style="padding: 10px;">
            <div class="task-list col l12">
                <h6>Add a task</h6>
                <form id="todo-form">
                    <div class="row">
                        <div class="col l3 pr-7">
                            <input type="text" placeholder="Title" />    
                        </div>
                        <div class="col l3 pr-7 pl-7">
                            <textarea placeholder="Description"></textarea>    
                        </div>
                        <div class="col l2 pr-7 pl-7">
                            <input type="text" id="datepicker" placeholder="Due Date (dd/mm/yy)" />    
                        </div>
                        <div class="col l4 pl-7">
                            <input type="button" class="btn btn-primary" value="Add task" onclick="todo.add();" /> 
                             
                        </div>
                        
                        
                        
                            
                    </div>
                    
                </form>
                
              {{--   <div id="delete-div">Drag Here to Delete</div> --}}
            </div>
            <div style="clear: both;">
                
            </div>
        </div>
    </div>
    <div class="col l12 ">
        <div class="card">
           
            <div>
                <div class="row">
                   
                    <div id="test1" class="col s12 p-15">
                    	<div class="row">
                            <div class="task-list col l4 center-align" id="pending" style="border-bottom: 1px solid #e8e8e8;border-right: 1px solid #e8e8e8">
                                <h6>Pending</h6> 
                            </div>
                            <div class="task-list col l4 center-align " id="inProgress" style="border-bottom: 1px solid #e8e8e8;border-right: 1px solid #e8e8e8">
                                <h6>In Progress</h6>
                            </div>
                            <div class="task-list col l4 center-align" id="completed" style="border-bottom: 1px solid #e8e8e8;">
                                <h6>Completed</h6>
                            </div>
                            
                        </div>
                        <div class="row task-font" >
                            <div class=" col l4 pr-7" >
                                <div class="card p-10" >
                                    <div class="col l12 pl-5" >
                                        <h6 class="col l8">Title of the issue</h6>
                                        <img class="circle col l4 right-align img-avatar" src="{{ asset('assets/images/sgs_sandhu.jpg') }}">
                                    </div>
                                    <div class="col l12 mt-10">
                                        <div class=" col l6">
                                            <i class="fa fa-circle-o red-text" aria-hidden="true"></i>
                                            High
                                        </div>
                                        <div class="col l6 right-align">
                                            <i class="fa fa-pencil fa-lg mr-5" aria-hidden="true" ></i>
                                            <i class="fa fa-comment fa-lg mr-5" aria-hidden="true"></i>
                                            <i class="fa fa-trash red-text fa-lg" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div style="clear: both">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class=" col l4 pr-7 pl-7">
                                <div class="card p-10">
                                    <div class="col l12 pl-5" >
                                        <h6 class="col l8">Title of the issue</h6>
                                        <img class="circle col l4 img-avatar " src="{{ asset('assets/images/sgs_sandhu.jpg') }}" >
                                    </div>
                                    <div class="col l12 mt-10">
                                        <div class=" col l6">
                                            <i class="fa fa-circle-o red-text" aria-hidden="true"></i>
                                            High
                                        </div>
                                        <div class="col l6 right-align">
                                            <i class="fa fa-pencil fa-lg mr-5" aria-hidden="true" ></i>
                                            <i class="fa fa-comment fa-lg mr-5" aria-hidden="true" ></i>
                                            <i class="fa fa-trash red-text fa-lg" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div style="clear: both">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class=" col l4 pl-7" >
                                <div class="card p-10">
                                    <div class="col l12 pl-5" >
                                        <h6 class="col l8">Title of the issue</h6>
                                        <img class="circle col l4 right-align img-avatar" src="{{ asset('assets/images/sgs_sandhu.jpg') }}"     >
                                    </div>
                                    <div class="col l12 mt-10" >
                                        <div class=" col l6">
                                            <i class="fa fa-circle-o red-text" aria-hidden="true"></i>
                                            High
                                        </div>
                                        <div class="col l6 right-align">
                                            <i class="fa fa-pencil fa-lg mr-5" aria-hidden="true" ></i>
                                            <i class="fa fa-comment fa-lg mr-5" aria-hidden="true" ></i>
                                            <i class="fa fa-trash red-text fa-lg" aria-hidden="true"></i>
                                        </div>
                                    </div>   
                                    <div style="clear: both">
                                        
                                    </div> 
                                </div>
                                
                            </div>
                            <div class=" col l4 pr-7 mt-10" >
                                <a id="add_new" href="#" class="add-new">
                                    <div class="p-10 center-align" style="border:2px dashed #c8c8c8;">
                                        
                                        <div class="empty-box-text">
                                            Drag a Task Here<br>OR
                                        </div>
                                        <a href="" class="btn">Add New</a>
                                        
                                    </div>
                                </a>

                            </div>
                             <div class=" col l4 pr-7 pl-7 mt-10" >
                                <div class="p-10 center-align" style="border:2px dashed #c8c8c8;">
                                    <div class="empty-box-text">
                                        No Task Found
                                    </div>
                                    <div class="empty-box-text">
                                        Drag a Task Here
                                    </div>
                                   
                                </div>
                                
                            </div>
                             <div class=" col l4 pl-7 mt-10" >
                                <div class="p-10" style="border:2px dashed #c8c8c8;">
                                    <div class="empty-box-text">
                                        No Task Found
                                    </div>
                                    <div class="empty-box-text">
                                        Drag a Task Here
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    
</div>



<style type="text/css">
    .card{
        margin: 0px !important;
    }
    .projects-logo{
        
        background-color: #000;margin: 10%;

    }
    .tabs{
        height: 32px !important;
    }
    .tabs .tab{
        line-height: 32px !important;
        
    }
    .tabs .tab a{
        font-size: 12px !important;
    }
    .active{
        background-color: #fff !important;
    }
    .p-15{
        padding: 15px !important;
    }
    .mb-14{
    	margin-bottom: 14px !important;
    }
    .optional{

    }
    .p-10{
        padding: 10px !important;
    }
    .task-font{
        font-size: 13px !important;padding-top: 10px !important;
    }
    .mt-10{
        margin-top: 10px !important;
    }
    .mr-5{
        margin-right: 5px !important;
    }
    .pl-5{
        padding-left: 5px !important;
    }
    .img-avatar{
        width: 40px !important;float: right !important;
    }
    .pt-10{
        padding-top: 10px;
    }
    .empty-box-text{
        font-size: 20px;
        font-weight: 700;
        color:#d8d8d8;
        text-align: center;
        
    }
     .card{
        margin: 0px !important;
    }
    .projects-logo{
        
        background-color: #000;margin: 10%;

    }
    .tabs{
        height: 32px !important;
    }
    .tabs .tab{
        line-height: 32px !important;
        
    }
    .tabs .tab a{
        font-size: 10px !important;color: rgb(33, 150, 243) !important;
    }
    .active{
        background-color: #fff !important;
    }
    .p-15{
        padding: 15px !important;
    }
    .pv-5{
        padding: 5px 0px !important; 
    }
    .project-logo{
        color: white;width: 70px;margin: 0 auto; line-height: 70px;font-size: 24px;border-radius: 50%
    }
    .tabs .tab a{
        padding:0 12px;
    }
   
</style>

@endsection