<html>
<head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/test.css') }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/test.js?rand(4524,28282)') }}"></script>

</head>
<style type="text/css">
    button{
        position: absolute;
        top: 6px;
        padding: 10px;
        background: transparent;
        border: 0px;
        margin-left: -40px;
       
        height: 32px;
    }
    input[type=search]{
        margin: 0px;
        border: 1px solid #ecf0f1;
        margin: 2px;
        height: 2rem;
       background-color: #ecf0f1;
       border-radius: 20px;
       margin-top: 3px;
       padding-left: 5px;
       float: left;
    }
    #date
{
    margin-top:70px;
    color:silver;
    font-size:40px;
    border:2px dashed #2E9AFE;
    padding:10px;
    width:500px;
    margin-left:250px;
}
#time
{
    margin-top:20px;
    font-size:130px;
    color:silver;
    border:2px dashed #2E9AFE;
    padding:10px;
    width:700px;
    margin-left:150px;
}
.top-bar-color{
    position: fixed;
}
.content-section{
    margin-top: 50px
}
.side-bar-submenu:after{
   
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent; 

    border-right:10px solid blue; 
}
.management-tabs{
    padding:12px 20px !important;
}
.management-tabs:hover{
        background-color: #242832;
        color: white;
        cursor: pointer;
       /*  border-top-right-radius: 20px;
          border-top-left-radius: 20px;*/

}
.active-tab{
     background-color: #FFF;
        color: grey;
}
.active-tab:hover{
     background-color: #FFF;
        color: grey;
}
</style>
<script type="text/javascript">
      $(".button-collapse").sideNav();
</script>
<body>
    <div class="row">
        <div class="col s12 m12 l12 top-bar-color">
            <div class="row valign-wrapper">
                <div class="col s8 m8 l8" style="padding-left: 0px">
                    <div class="row valign-wrapper">
                        <div class="col l1" style="float: left;">
                            <a href="javascript:;" data-activates="slide-out" class=" menu"><i class=" small mdi-navigation-menu" style="font-size: 20px;"></i></a>
                            <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
                        </div>
                        {{-- <div class="col l4 search">
                            <input type="search" name="search" placeholder="Search Here ...">
                            <button type="button" name="submit"><i class="fa fa-search"></i></button>
                        </div> --}}
                        <div class="col l11 white-text" id="my-tabs">
                           <div class="col management-tabs active-tab hrm-tab" >
                               HRM
                           </div>
                           <div class="col management-tabs crm-tab">
                               CRM
                           </div>

                        </div>
                    </div>
                </div>
                <div class="col l4 s4 m4 right-align valign-wrapper">
                    <div class="col s4 m8 l4 left-align white-text" id="clock">
                        
                    </div>
                    <div class="col s4 m8 l6 white-text">

                        <strong>Welcome : </strong>Ashish kumar
                    </div>  

                    <div class="col s4 m4 l2 right-align">
                        <ul id="dropdown" class="dropdown-content">
                            <li><a href="#">Profile</a></li>
                            <li><a href="#">Settings</a></li>
                            <li><a href="#">Help</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Logout</a></li>
                        </ul>
                       
                        <a class="dropdown-button" href="#" data-activates="dropdown">

                            <img class="circle profile-image responsive-img" src="{{asset('assets/images/user.png')}}">

                        </a>  
                    </div>
                </div>
            </div>
            <div class="row">

                <ul id="slide-out" class="side-nav fixed  hrm" >
                    <li class="title-menu">
                        HRM
                    </li>
                    <li>
                        <a href="#!">
                            <span class="side-bar-icon">
                                <i class="fa fa-tachometer deep-orange darken-1 center-align side-bar-icon-bg" style=""></i>
                            </span>
                            <span class="side-bar-text">
                                Dashboard
                            </span>
                            <span class="arrow">
                                <i class="fa fa-chevron-right" ></i>
                            </span>
                        </a>
                        <ul class="side-bar-submenu ">
                           
                            <li class="first">Layout 0</li>
                            <li>Layout 1</li>
                            <li>Layout 2</li>
                            <li>Layout 3</li>
                            <li>Layout 4</li>
                            <li>Layout 5</li>
                        </ul>
                    </li>
                    <li>
                        <a href="#!">
                            <span class="side-bar-icon">
                                <i class="fa fa-black-tie red darken-1 center-align side-bar-icon-bg" style=""></i>
                            </span>
                            <span class="side-bar-text">
                                Employees
                            </span>
                            <span class="arrow">
                                <i class="fa fa-chevron-right" ></i>
                            </span>
                        </a>
                        <ul class="side-bar-submenu ">
                           
                            <li class="first">All Employees</li>
                            <li>Add New Employee</li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="#!">
                            <span class="side-bar-icon">
                                <i class="fa fa-calendar orange darken-1 center-align side-bar-icon-bg" style=""></i>
                            </span>
                            <span class="side-bar-text">
                                Attendence
                            </span>
                            <span class="arrow">
                                <i class="fa fa-chevron-right" ></i>
                            </span>
                        </a>
                        <ul class="side-bar-submenu ">
                           
                            <li class="first">All Attendence</li>
                            <li>Track Employee attendence</li>
                            <li>Import Attendence</li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="#!">
                            <span class="side-bar-icon">
                                <i class="fa fa-bed  light-blue darken-1 center-align side-bar-icon-bg" style=""></i>
                            </span>
                            <span class="side-bar-text">
                                Leaves
                            </span>
                            <span class="arrow">
                                <i class="fa fa-chevron-right" ></i>
                            </span>
                        </a>
                        <ul class="side-bar-submenu">
                           
                            <li class="first">All Leaves</li>
                            <li>Track Employee Leave</li>
                            <li>Import Leaves info</li>
                           
                        </ul>
                    </li>
                    <li>
                        <a href="#!">
                            <span class="side-bar-icon">
                                <i class="fa fa-tasks  teal darken-1 center-align side-bar-icon-bg" style=""></i>
                            </span>
                            <span class="side-bar-text">
                                Holidays
                            </span>
                            <span class="arrow">
                                <i class="fa fa-chevron-right" ></i>
                            </span>
                        </a>
                        <ul class="side-bar-submenu ">
                           
                            <li class="first">All Holidays</li>
                            <li>Calander</li>
                            <li>Add New Holiday</li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="#!">
                            <span class="side-bar-icon">
                                <i class="fa fa-tasks  green darken-1 center-align side-bar-icon-bg" style=""></i>
                            </span>
                            <span class="side-bar-text">
                                Leave Categories
                            </span>
                            <span class="arrow">
                                <i class="fa fa-chevron-right" ></i>
                            </span>
                        </a>
                        <ul class="side-bar-submenu ">
                           
                            <li class="first">All leaves</li>
                            <li>Track Employee Leaves</li>
                            <li>hthturt</li>
                            <li>hthturt</li>
                            <li>hthturt</li>
                            <li>hthturt</li>
                        </ul>
                    </li>
                    <li>
                        <a href="#!">
                            <span class="side-bar-icon">
                                <i class="fa fa-tasks  blue-grey darken-1 center-align side-bar-icon-bg" style=""></i>
                            </span>
                            <span class="side-bar-text">
                                Shifts
                            </span>
                            <span class="arrow">
                                <i class="fa fa-chevron-right" ></i>
                            </span>
                        </a>
                        <ul class="side-bar-submenu ">
                           
                            <li class="first">hthturt</li>
                            <li>hthturt</li>
                            <li>hthturt</li>
                            <li>hthturt</li>
                            <li>hthturt</li>
                            <li>hthturt</li>
                        </ul>
                    </li>
                    <li>
                        <a href="#!">
                            <span class="side-bar-icon">
                                <i class="fa fa-tasks  blue-grey darken-1 center-align side-bar-icon-bg" style=""></i>
                            </span>
                            <span class="side-bar-text">
                                Designations
                            </span>
                            <span class="arrow">
                                <i class="fa fa-chevron-right" ></i>
                            </span>
                        </a>
                        <ul class="side-bar-submenu ">
                           
                            <li class="first">hthturt</li>
                            <li>hthturt</li>
                            <li>hthturt</li>
                            <li>hthturt</li>
                            <li>hthturt</li>
                            <li>hthturt</li>
                        </ul>
                    </li><li>
                        <a href="#!">
                            <span class="side-bar-icon">
                                <i class="fa fa-tasks  blue-grey darken-1 center-align side-bar-icon-bg" style=""></i>
                            </span>
                            <span class="side-bar-text">
                                Departments
                            </span>
                            <span class="arrow">
                                <i class="fa fa-chevron-right" ></i>
                            </span>
                        </a>
                        <ul class="side-bar-submenu ">
                           
                            <li class="first">hthturt</li>
                            <li>hthturt</li>
                            <li>hthturt</li>
                            <li>hthturt</li>
                            <li>hthturt</li>
                            <li>hthturt</li>
                        </ul>
                    </li>
                    
                </ul>

                <ul id="slide-out" class="side-nav full side-bar-half crm" style="overflow: visible; display: none;">
                    <li class="title-menu">
                        CRM
                    </li>
                    <li>
                        <a href="#!">
                            <span class="side-bar-icon">
                                <i class="fa fa-tachometer deep-orange darken-1 center-align side-bar-icon-bg" style=""></i>
                            </span>
                            <span class="side-bar-text">
                                Dashboard
                            </span>
                            <span class="arrow">
                                <i class="fa fa-chevron-right" ></i>
                            </span>
                        </a>
                        <ul class="side-bar-submenu ">
                           
                            <li class="first">Layout 0</li>
                            <li>Layout 1</li>
                            <li>Layout 2</li>
                            <li>Layout 3</li>
                            <li>Layout 4</li>
                            <li>Layout 5</li>
                        </ul>
                    </li>
                   
                    
                </ul>

            </div>
            
        </div>
        <div class="row col s12 m12 l12 content-section background-design" style="background-color: #fff;padding-left: 86px">
            <h5>Dashboard</h5>
            <p>Welcome to OCRM </p>
        </div>
        <div class="row col s12 m12 l12 content">
        </div>
    </div>
</body>
<script type="text/javascript">
  $(".button-collapse").sideNav();
</script>
</html>