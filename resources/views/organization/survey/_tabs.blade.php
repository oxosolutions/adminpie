@php
if(@request()->route()->parameters()['id'] != ''){
@$id = @request()->route()->parameters()['id'];
}else{
@$id = @request()->route()->parameters()['form_id'];
}
// dump(Request::route()->action['as']);
@endphp
<nav id="aione_survey_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >

    <ul class="aione-tabs">
        <li class="aione-tab survey-edit-tab aione-tooltip {{(Request::route()->action['as'] == 'survey.sections.list')?'nav-item-current':''}}" title="Edit">

            <a href="{{route('survey.sections.list',$id)}}">

                <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-compose ionic-icon">
                    </i></span>
                <span class="nav-item-text">
                    {{ __('survey.survey_tab_edit_link') }}
                </span>
            </a>
            {{-- 
            <a href="{{route('survey.sections.list',$id)}}"><span class="nav-item-text">Edit</span></a>
            --}}
        </li>
        <li class="aione-tab survey-view-tab aione-tooltip {{(Request::route()->action['as'] == 'survey.perview')?'nav-item-current':''}}" title="Preview">
            <a href="{{ route('survey.perview',$id) }}">
                <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-ios-monitor-outline ionic-icon"></i></span>
                <span class="nav-item-text">
                    {{ __('survey.survey_tab_preview_link') }}
                    </span></a>
        </li>
        <li class="aione-tab survey-settings-tab aione-tooltip {{(Request::route()->action['as'] == 'survey.settings')?'nav-item-current':''}}" title="Settings">
            <a href="{{route('survey.settings',$id)}}"><span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-settings ionic-icon">
                </i></span><span class="nav-item-text">{{ __('survey.survey_tab_settings_link') }}</span></a>
        </li>
        <li class="aione-tab survey-stats-tab aione-tooltip {{(Request::route()->action['as'] == 'stats.survey')?'nav-item-current':''}}" title="Statistics">
            <a href="{{route('stats.survey',$id)}}"><span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-arrow-graph-up-right ionic-icon">
                </i></span><span class="nav-item-text">{{ __('survey.survey_tab_statistics_link') }}</span></a>
        </li>
        <li class="aione-tab survey-structure-tab aione-tooltip {{(Request::route()->action['as'] == 'structure.survey')?'nav-item-current':''}}" title="Structure">
            <a href="{{route('structure.survey',$id)}}"><span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-grid ionic-icon">
                </i></span><span class="nav-item-text">{{ __('survey.survey_tab_structure_link') }}</span></a>
        </li>
        <li class="aione-tab survey-data-tab aione-tooltip {{(Request::route()->action['as'] == 'results.survey')?'nav-item-current':''}}" title="Raw Data">
            <a href="{{route('results.survey',$id)}}"><span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-ios-analytics ionic-icon">
                </i></span><span class="nav-item-text">{{ __('survey.survey_tab_raw_data_link') }}</span></a>
        </li>
        <li class="aione-tab survey-report-tab aione-tooltip {{(Request::route()->action['as'] == 'survey.reports')?'nav-item-current':''}}" title="Report">
            <a href="{{route('survey.reports',$id)}}"><span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-document-text ionic-icon">
                </i></span><span class="nav-item-text">{{ __('survey.survey_tab_report_link') }}</span></a>
        </li>
        @if(get_organization_id() =='295' && in_array($id , [1,2,5]) )
        <li class="aione-tab survey-report-tab aione-tooltip {{(Request::route()->action['as'] == 'survey.stats.report')?'nav-item-current':''}}" title="Custom Report">
            <a href="{{route('custom.survey.report',$id)}}"><span class="nav-item-text">{{ __('survey.survey_tab_custom_report_link') }}</span></a>
        </li>
        @endif
        @if(App\Model\Organization\Collaborator::checkAccess($id,'survey') == null)
        <li class="aione-tab survey-share-tab aione-tooltip {{(Request::route()->action['as'] == 'share.survey')?'nav-item-current':''}}" title="Collaborate">
            <a href="{{route('share.survey',$id)}}"><span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-share ionic-icon">
                </i></span><span class="nav-item-text">{{ __('survey.survey_tab_collaborate_link') }}</span></a>
        </li>
        @endif
        <li class="aione-tab survey-customize-tab  aione-tooltip {{(Request::route()->action['as'] == 'custom.survey')?'nav-item-current':''}}" title="Customize">
            <a href="{{route('custom.survey',$id)}}"><span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-wand ionic-icon">
                </i></span><span class="nav-item-text">{{ __('survey.survey_tab_customize_link') }}</span></a>
        </li>
        <div class="clear">
        </div>
    </ul>
</nav>
<style type="text/css">
  .aione-content{
    overflow-x: hidden;
  }
  nav i.ionic-icon{
        font-size: 18px;
            line-height: 28px;
  }
  nav i.ionic-icon:before{
        vertical-align: middle;
  }
</style>