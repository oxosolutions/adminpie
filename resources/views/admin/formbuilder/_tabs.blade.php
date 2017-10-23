@php
  if(@request()->route()->parameters()['id'] != ''){
    $id = request()->route()->parameters()['id'];
  }else{
    $id = request()->route()->parameters()['form_id'];
  }
  // dump(Request::route()->action['as']);
@endphp
@if(Auth::guard('admin')->check() == true)
  @php
    $route_slug = '';
  @endphp
@else
  @php
    $route_slug = 'org.';
  @endphp
@endif
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
      <li class="aione-tab {{(Request::route()->action['as'] == $route_slug.'list.sections')?'nav-item-current':''}}">
        <a href="{{ route($route_slug.'list.sections',$id) }}"><span class="nav-item-text">Edit</span></a>
      </li>
      <li class="aione-tab {{(Request::route()->action['as'] == $route_slug.'form.preview')?'nav-item-current':''}}">
        <a href="{{ route($route_slug.'form.preview',$id) }}"><span class="nav-item-text">View</span></a>
      </li>
      <li class="aione-tab {{(Request::route()->action['as'] == $route_slug.'form.settings')?'nav-item-current':''}}">
        <a href="{{ route($route_slug.'form.settings',$id) }}"><span class="nav-item-text">Settings</span></a>
      </li>
      <li class="aione-tab {{(Request::route()->action['as'] == $route_slug.'form.custom')?'nav-item-current':''}}">
        <a href="{{ route($route_slug.'form.custom',$id) }}"><span class="nav-item-text">Customize</span></a>
      </li>



      @if(Auth::guard('org')->check())
        <li class="aione-tab {{(Request::route()->action['as'] == $route_slug.'form.custom')?'nav-item-current':''}}">
          <a href="{{ route($route_slug.'form.custom',$id) }}"><span class="nav-item-text">new tabs</span></a>
        </li>

      @endif

      <div class="clear"></div>
  </ul>
</nav>
