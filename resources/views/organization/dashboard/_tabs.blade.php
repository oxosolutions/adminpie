<div class="fixed-action-btn horizontal click-to-toggle dashboard-actions">
  <a class="btn-floating red">
    <i class="material-icons">more_vert</i>
  </a>
  <ul>
    <li><a class="btn-floating red delete-dashboard aione-delete-confirmation" href="{{route('delete.dashboard',[$current_dashboard])}}" tab-slug="{{$current_dashboard}}"><i class="material-icons">clear</i></a></li>
    <li><a class="btn-floating blue" href="javascript:;" data-target="edit-dashboard" tab-id="{{$current_dashboard}}" class="edit-dashboard"><i class="material-icons">edit</i></a></li>
    <li><a class="btn-floating green" href="#" data-target="add_new_dashboard"><i class="material-icons">add</i></a></li>
  </ul>
</div>

 
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable" class="aione-tabs">
    @foreach(@$dashboards as $key => $tab)
      <li class="aione-tab dashboard-tab
        @if($tab['slug'] == $current_dashboard)
        nav-item-current
        @endif
        " dashboard-index="{{$tab['slug']}}" >
        <a href="{{$key}}"><span class="nav-item-text">{{@$tab['title']}}</span></a>
      </li>
    @endforeach	
    <div class="clear"></div>
  </ul>
</nav>

{{Form::open(['route' => 'dashboard.save' , 'method' => 'post'])}}
  @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_dashboard','heading'=>'Add Dashboard','button_title'=>'Save','section'=>'dashboard']])
{{Form::close()}}

<script type="text/javascript">
  $(document).ready(function(){
    $('.modal').modal();
  });
</script>

