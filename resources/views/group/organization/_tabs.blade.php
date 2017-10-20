@php
  if(@request()->route()->parameters()['id'] != ''){
    @$id = @request()->route()->parameters()['id'];
  }
  
@endphp
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
       <li class="aione-tab {{(Request::route()->action['as'] == 'edit.groupOrganization')?'nav-item-current':''}}">
        <a href="{{route('edit.groupOrganization',$id)}}"><span class="nav-item-text">Edit</span></a>
      </li>
       <li class="aione-tab {{(Request::route()->action['as'] == 'users.groupOrganization')?'nav-item-current':''}}">
        <a href="{{route('users.groupOrganization',$id)}}"><span class="nav-item-text">Users</span></a>
      </li>
      
      <div class="clear"></div>
  </ul>
</nav>

