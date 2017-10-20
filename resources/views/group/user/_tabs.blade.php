@php
  if(@request()->route()->parameters()['id'] != ''){
    @$id = @request()->route()->parameters()['id'];
  }else{
    @$id = @request()->route()->parameters()['form_id'];
  }

@endphp
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
      <li class="aione-tab {{(Request::route()->action['as'] == 'view.group.user')?'nav-item-current':''}}">
        <a href="{{route('view.group.user',$id)}}"><span class="nav-item-text">View</span></a>
      </li>
      <li class="aione-tab {{(Request::route()->action['as'] == 'edit.group.user')?'nav-item-current':''}}">
        <a href="{{route('edit.group.user',$id)}}"><span class="nav-item-text">Edit </span></a>
      </li>
      <li class="aione-tab {{(Request::route()->action['as'] == 'pass.group.user')?'nav-item-current':''}}">
        <a href="{{route('pass.group.user',$id)}}"><span class="nav-item-text">Change Password</span></a>
      </li>
    
    
      
      <div class="clear"></div>
  </ul>
</nav>



