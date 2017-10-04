@php
  if(Auth::guard('admin')->check()){
    $edit = 'admin.edit.posts';
    $setting = 'admin.setting.posts';
    $custom = 'admin.custom.setting.posts';
  }else{
    $edit = 'edit.posts';
    $setting = 'setting.posts';
    $custom = 'custom.setting.posts';
  }
@endphp

<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
      <li class="aione-tab {{(Request::route()->action['as'] == $edit)?'nav-item-current':''}}">
        <a href="{{route('edit.posts',request()->route()->parameters())}}"><span class="nav-item-text">Edit</span></a>
      </li>
      
      <li class="aione-tab {{(Request::route()->action['as'] == $setting)?'nav-item-current':''}}">
        <a href="{{route('setting.posts',request()->route()->parameters())}}"><span class="nav-item-text">Settings</span></a>
      </li>
      
      <li class="aione-tab {{(Request::route()->action['as'] == $custom)?'nav-item-current':''}}">
        <a href="{{route('custom.setting.posts',request()->route()->parameters())}}"><span class="nav-item-text">Custom Code</span></a>
      </li>
      
      
      <div class="clear"></div>
  </ul>
</nav>



