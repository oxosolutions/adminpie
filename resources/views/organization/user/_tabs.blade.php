@php
  if(@request()->route()->parameters()['id'] != ''){
    @$id = @request()->route()->parameters()['id'];
  }
@endphp
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
       <li class="aione-tab {{(Request::route()->action['as'] == 'user.view')?'nav-item-current':''}}">
        <a href="{{route('user.view',@$id)}}"><span class="nav-item-text">View</span></a>
      </li>
       <li class="aione-tab {{(Request::route()->action['as'] == 'user.details')?'nav-item-current':''}}">
        <a href="{{route('user.details',@$id)}}"><span class="nav-item-text">Edit</span></a>
      </li>
       <li class="aione-tab {{(Request::route()->action['as'] == 'changepass.user')?'nav-item-current':''}}">
        <a href="{{route('changepass.user',@$id)}}"><span class="nav-item-text">Change Password</span></a>
      </li>
      <div class="clear"></div>
  </ul>
</nav>

