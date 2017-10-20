@php
  if(@request()->route()->parameters()['id'] != ''){
    @$id = @request()->route()->parameters()['id'];
  }
  // dump(Request::route()->action['as']);
@endphp
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
       <li class="aione-tab {{(Request::route()->action['as'] == 'account.view')?'nav-item-current':''}}">
        <a href=""><span class="nav-item-text">View</span></a>
      </li>
       <li class="aione-tab {{(Request::route()->action['as'] == 'info.user')?'nav-item-current':''}}">
        <a href="{{route('profile.edit',@$id)}}"><span class="nav-item-text">Edit</span></a>
      </li>
       <li class="aione-tab {{(Request::route()->action['as'] == 'profile.changepassword')?'nav-item-current':''}}">
        <a href="{{route('profile.changepassword',@$id)}}"><span class="nav-item-text">Change Password</span></a>
      </li>
       

      
      <div class="clear"></div>
  </ul>
</nav>

