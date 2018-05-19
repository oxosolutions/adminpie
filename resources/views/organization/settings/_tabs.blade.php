<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
      <li class="aione-tab settings-tab-organization {{(Request::route()->action['as'] == 'setting.org')?'nav-item-current':''}}">
        <a href="{{route('setting.org')}}"><span class="nav-item-text">Basic</span></a>
      </li>

      
       <li class="aione-tab settings-tab-emp {{(Request::route()->action['as'] == 'setting.employee')?'nav-item-current':''}}">
        <a href="{{ route('setting.employee') }}"><span class="nav-item-text">Employee</span></a>
      </li>
      
      <li class="aione-tab settings-tab-hrm {{(Request::route()->action['as'] == 'setting.attendance')?'nav-item-current':''}}">
        <a href="{{route('setting.attendance')}}"><span class="nav-item-text">HRM</span></a>
      </li>
      
      <li class="aione-tab settings-tab-user  {{(Request::route()->action['as'] == 'setting.user')?'nav-item-current':''}}">
        <a href="{{route('setting.user')}}"><span class="nav-item-text">User</span></a>
      </li>

      <li class="aione-tab settings-tab-support  {{(Request::route()->action['as'] == 'support.settings')?'nav-item-current':''}}">
        <a href="{{route('support.settings')}}"><span class="nav-item-text">Support</span></a>
      </li>

      {{-- 
      <li class="aione-tab   {{(Request::route()->action['as'] == 'setting.role')?'nav-item-current':''}}">
        <a href="{{route('setting.role')}}"><span class="nav-item-text">Roles</span></a>
      </li>
      <li class="aione-tab   {{(Request::route()->action['as'] == 'setting.leaves')?'nav-item-current':''}}">

        <a href="{{route('setting.leaves')}}"><span class="nav-item-text">Leave</span></a>
      </li>
      --}}
     
      
      <div class="clear"></div>
  </ul>
</nav>
  

</style>
