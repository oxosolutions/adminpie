<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable" class="aione-tabs">
  
	@foreach(@$dashboards as $key => $tab)
		<li class="aione-tab dashboard-tab
			@if($tab['slug'] == $dashboard)
				 nav-item-current
			@endif
			" dashboard-index="{{$tab['slug']}}" >
			<a href="{{$key}}"><span class="nav-item-text">{{@$tab['title']}}</span></a>
		</li>
	@endforeach	
    <div style="clear: both">
    </div>
  </ul>

  </nav>
   <a data-activates='dropdown1' class="dropdown-button waves-effect" href="#" ><i class="fa fa-ellipsis-v"></i></a>
  <ul id='dropdown1' class='dropdown-content' style="right: 0px">
    <li><a class="waves-effect modal-trigger" href="#" data-target="add_new_dashboard">Add New Dashboard</a></li>
    <li><a href="javascript:;" tab-id="{{$dashboard}}" class="edit-dashboard">Edit this Dashboard</a></li>
    <li><a href="{{route('delete.dashboard',[$dashboard])}}" tab-slug="{{$dashboard}}" class="delete-dashboard">Delete Dashboard</a></li>

    <li><a href="#" data-target="add-widget" class="delete-dashboard">Add new Widget</a></li>
  </ul>
{{Form::open(['route' => 'dashboard.save' , 'method' => 'post'])}}
  @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_dashboard','heading'=>'Add Dashboard','button_title'=>'Save','section'=>'dashboard']])
{{Form::close()}}

<style type="text/css">
.dropdown-content{
  width: 400px
}
  .bold-text{
    font-weight: 900;
  }
  .aione-tabs > .aione-tab{
    background-color: white;
  }
 .aione-nav ul li .delete-dashboard{
    display: none;
    position: absolute;
    top: 12px;
    color: #676767 !important;
    right: 5px;
    
    padding: 0 !important;
    line-height: 0 !important;

 }
 .aione-nav ul li .move-dashboard{
    display: none;
    position: absolute;
    top: 12px;
    color: #676767 !important;
    left: 5px;
    
    padding: 0 !important;
    line-height: 0 !important;

 }
 .delete-dashboard i{
      height: 16px;
    width: 16px;
    text-align: center;
 }
 .move-dashboard i{
      height: 18px;
    width: 18px;
    font-size: 18px;
    text-align: center;
 }
 .aione-nav > ul > .ui-state-default{
   
    display: inline-block;
    overflow: hidden;
    white-space: nowrap;
    

 }
 .aione-nav > ul > .ui-state-default >a{
 
 }
 .aione-nav > ul > .ui-state-default:hover  .delete-dashboard{
  display: block
 }
 .aione-nav > ul > .ui-state-default:hover  .move-dashboard{
  display: block
 }
 nav .option{
 
  float: right

 }
 nav .option i{
   height: 26px;
 }
 .dropdown-button{
  position: absolute;
      top: 0;
    right: 0;
    text-align: center;
    width: 40px;
    line-height: 40px;
    background-color: #e8e8e8;
    border-radius: 50%;

 }
 .dropdown-button i{
  color: #676767 
 }
</style>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.modal').modal();
    });
  </script>

