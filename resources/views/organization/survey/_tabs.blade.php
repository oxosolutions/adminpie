@php
  if(@request()->route()->parameters()['id'] != ''){
    @$id = @request()->route()->parameters()['id'];
  }else{
    @$id = @request()->route()->parameters()['form_id'];
  }
  // dump(Request::route()->action['as']);
@endphp
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
      <li class="aione-tab survey-edit-tab {{(Request::route()->action['as'] == 'survey.sections.list')?'nav-item-current':''}}">
        <a href="{{route('survey.sections.list',$id)}}"><span class="nav-item-text">Edit</span></a>
      </li>
      <li class="aione-tab  survey-view-tab {{(Request::route()->action['as'] == 'survey.perview')?'nav-item-current':''}}">
        <a href="{{ route('survey.perview',$id) }}"><span class="nav-item-text">View</span></a>
      </li>
      <li class="aione-tab  survey-settings-tab {{(Request::route()->action['as'] == 'survey.settings')?'nav-item-current':''}}">
        <a href="{{route('survey.settings',$id)}}"><span class="nav-item-text">Settings</span></a>
      </li>
      <li class="aione-tab  survey-stats-tab {{(Request::route()->action['as'] == 'stats.survey')?'nav-item-current':''}}">
        <a href="{{route('stats.survey',$id)}}"><span class="nav-item-text">Statistics</span></a>
      </li>
      <li class="aione-tab   survey-structure-tab {{(Request::route()->action['as'] == 'structure.survey')?'nav-item-current':''}}">
        <a href="{{route('structure.survey',$id)}}"><span class="nav-item-text">Structure</span></a>
      </li>
      <li class="aione-tab survey-data-tab  {{(Request::route()->action['as'] == 'results.survey')?'nav-item-current':''}}"> 

        <a href="{{route('results.survey',$id)}}"><span class="nav-item-text">Raw Data</span></a>
      </li>
      <li class="aione-tab survey-report-tab  {{(Request::route()->action['as'] == 'survey.stats.report')?'nav-item-current':''}}">

        <a href="{{route('survey.reports',$id)}}"><span class="nav-item-text">Report</span></a>
      </li>
      
      @if(App\Model\Organization\Collaborator::checkAccess($id,'survey') == null)
        <li class="aione-tab survey-share-tab {{(Request::route()->action['as'] == 'share.survey')?'nav-item-current':''}}">
          <a href="{{route('share.survey',$id)}}"><span class="nav-item-text">Collaborate</span></a>
        </li>
      @endif
       <li class="aione-tab survey-customize-tab  {{(Request::route()->action['as'] == 'custom.survey')?'nav-item-current':''}}">

        <a href="{{route('custom.survey',$id)}}"><span class="nav-item-text">Customize</span></a>
      </li>
      
      <div class="clear"></div>
  </ul>
</nav>



