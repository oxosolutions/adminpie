

<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable" class="aione-tabs">
  @php
    $index = 1;
  @endphp
  @foreach(@$dashboard_tabs as $key => $tab)
    <li class="aione-tab ui-state-default dashboard-tab" dashboard-index="{{$tab->slug}}" ><a href="{{$key}}"><span class="nav-item-text">{{@$tab->title}}</span></a><span><a href="#" tab-id="{{$tab->slug}}" class="delete-dashboard"><i class="fa fa-close"></i></a></span></li>
    @php
      $index++;
    @endphp
  @endforeach
    <li class="aione-tab unsortable"><a class="waves-effect modal-trigger" href="#" data-target="add_new_dashboard"><span class="nav-item-text bold-text">+</span></a></li>
     <!-- Modal Structure -->
   {{--  <div id="add_new_dashboard" class="modal modal-fixed-footer">
      <div class="modal-content">
        <h4>Add Dashboard</h4>
        <div>
            {{Form::open(['route' => 'dashboard.save' , 'method' => 'post'])}}
              {!!FormGenerator::GenerateSection('dashboard',['type'=>'inset'],'','admin')!!}
              <input type="submit" name="save" value="save">
            {{Form::close()}}
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div> --}}

            
    <div style="clear: both">
    </div>
  </ul>
  <div class="widget_list">
      {{-- {{dump(App\Model\Admin\GlobalWidget::getWidgetsByUser_id())}} --}}
  </div>
  
</nav>
{{Form::open(['route' => 'dashboard.save' , 'method' => 'post'])}}
@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_dashboard','heading'=>'Add Dashboard','button_title'=>'Save','section'=>'dashboard']])

{{Form::close()}}
<style type="text/css">
  .bold-text{
    font-weight: 900;
  }
  .aione-tabs > .aione-tab{
    background-color: white;
  }
 .aione-nav ul li .delete-dashboard{
    display: none;
    position: absolute;
    top: 0;
    color: #676767 !important;
    right: 0;
    
    padding: 0 !important;
    line-height: 0 !important;

 }
 .delete-dashboard i{
      height: 16px;
    width: 16px;
    text-align: center;
 }
 .aione-nav > ul > .ui-state-default{
   
    display: inline-block;
    overflow: hidden;
    white-space: nowrap;
    

 }
 .aione-nav > ul > .ui-state-default >a{
  cursor: move;
 }
 .aione-nav > ul > .ui-state-default:hover  .delete-dashboard{
  display: block
 }
</style>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.modal').modal();
    });
  </script>

