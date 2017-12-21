@php
  
  // dump(Request::route()->action['as']);
@endphp
<nav id="aione_survey_tabs" class="aione-survey-tabs aione-nav-tabs aione-nav aione-nav-horizontal"  >
  <ul class="aione-tabs">
      <li class="aione-tab survey-edit-tab {{(Request::route()->action['as'] == 'active.tickets')?'nav-item-current':''}}">
        <a href="{{route('active.tickets')}}"><span class="nav-item-text">Active Tickets</span> <span class="bg-grey ph-3 white ml-10">28</span> </a>
      </li>
      <li class="aione-tab survey-edit-tab {{(Request::route()->action['as'] == 'completed.tickets')?'nav-item-current':''}}">
        <a href="{{route('completed.tickets')}}"><span class="nav-item-text">Completed Tickets</span> <span class="bg-grey ph-3 white ml-10">21</span></a>
      </li>
      <li class="aione-tab survey-edit-tab {{(Request::route()->action['as'] == 'settings.tickets')?'nav-item-current':''}}">
        <a href="{{route('settings.tickets')}}"><span class="nav-item-text">Settings</span></a>
      </li>
      
      <div class="clear"></div>
  </ul>
</nav>



