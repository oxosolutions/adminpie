@php
  if(@request()->route()->parameters()['id'] != ''){
    $id = request()->route()->parameters()['id'];
  }
  // dump(Request::route()->action['as']);
@endphp
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
      
      <li class="aione-tab {{(Request::route()->action['as'] == 'view.group')?'nav-item-current':''}}">
        <a href="{{ route('view.group',$id) }}"><span class="nav-item-text">View</span></a>
      </li>
     <li class="aione-tab {{(Request::route()->action['as'] == 'edit.group')?'nav-item-current':''}}">
        <a href="{{ route('edit.group',$id) }}"><span class="nav-item-text">Edit</span></a>
      </li>

      <div class="clear"></div>
  </ul>
</nav>