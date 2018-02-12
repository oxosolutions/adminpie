<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
      <li class="aione-tab {{(Request::route()->action['as'] == 'lists.attendance')?'nav-item-current':''}}">
        <a href="{{route('lists.attendance')}}"><span class="nav-item-text">Attendance</span></a>
      </li>
      
      <li class="aione-tab {{(Request::route()->action['as'] == 'list.attendance')?'nav-item-current':''}}">
        <a href="{{route('list.attendance')}}"><span class="nav-item-text">View Attendance</span></a>
      </li>
      {{-- 
      <li class="aione-tab {{(Request::route()->action['as'] == 'import.form.attendance')?'nav-item-current':''}}">
        <a href="{{route('import.form.attendance',['2018','01'])}}"><span class="nav-item-text">Import attendance</span></a>
      </li> --}}
      <li class="aione-tab {{(Request::route()->action['as'] == 'hr.attendance')?'nav-item-current':''}}">
        <a href="{{route('hr.attendance')}}"><span class="nav-item-text">Mark Attendance</span></a>
      </li>
      
      
      <div class="clear"></div>
  </ul>
</nav>
