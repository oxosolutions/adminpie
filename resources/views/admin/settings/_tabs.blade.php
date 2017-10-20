<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
       <li class="aione-tab {{(Request::route()->action['as'] == 'organization.settings')?'nav-item-current':''}}">
        <a href="{{route('organization.settings')}}"><span class="nav-item-text">Organization</span></a>
      </li>
     
      
      <div class="clear"></div>
  </ul>
</nav>

