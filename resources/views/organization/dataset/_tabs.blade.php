@php
  if(@request()->route()->parameters()['id'] != ''){
    @$id = @request()->route()->parameters()['id'];
  }else{
    @$id = @request()->route()->parameters()['form_id'];
  }
 
@endphp
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  <ul id="sortable_tabs" class="aione-tabs">
       <li class="aione-tab aione-tooltip {{(Request::route()->action['as'] == 'view.dataset')?'nav-item-current':''}}" title="View">
        <a href="{{route('view.dataset',$id)}}"> <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-tv">
                    </i></span><span class="nav-item-text">View</span></a>
      </li>
       <li class="aione-tab aione-tooltip {{(Request::route()->action['as'] == 'edit.dataset')?'nav-item-current':''}}" title="Edit">
        <a href="{{route('edit.dataset',$id)}}"> <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-edit">
                    </i></span><span class="nav-item-text">Edit</span></a>
      </li>
       <li class="aione-tab aione-tooltip {{(Request::route()->action['as'] == 'structure.dataset')?'nav-item-current':''}}" title="Edit">
        <a href="{{route('structure.dataset',$id)}}"> <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-table">
                    </i></span><span class="nav-item-text">Structure</span></a>
      </li>
     
     
        <li class="aione-tab aione-tooltip {{(Request::route()->action['as'] == 'filter.dataset')?'nav-item-current':''}}" title="Data Filter">
        <a href="{{route('filter.dataset',$id)}}"> <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-filter">
                    </i></span><span class="nav-item-text">Data Filter</span></a>
      </li>
      <li class="aione-tab aione-tooltip {{(Request::route()->action['as'] == 'api.dataset')?'nav-item-current':''}}" title="API">
        <a href="{{route('api.dataset', $id)}}"> <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-cloud">
                    </i></span><span class="nav-item-text">API</span></a>
      </li>
        <li class="aione-tab aione-tooltip {{(Request::route()->action['as'] == 'validate.dataset')?'nav-item-current':''}}" title="Validate">
        <a href="{{route('validate.dataset',$id)}}"> <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-check-circle">
                    </i></span><span class="nav-item-text">Validate</span></a>
      </li>
    
      <li class="aione-tab aione-tooltip {{(Request::route()->action['as'] == 'options.dataset')?'nav-item-current':''}}" title="Operations">
        <a href="{{route('options.dataset',$id)}}"> <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-asterisk">
                    </i></span><span class="nav-item-text">Operations</span></a>
      </li>
      @php
            $dataset_user_id = '';
            $auth_user_id = '';
            $datasetModel = App\Model\Organization\Dataset::find(request()->id);
            if($datasetModel != null){
                $dataset_user_id = $datasetModel->user_id;
                $auth_user_id = Auth::guard('org')->user()->id;
            }
      @endphp

      @if($dataset_user_id == $auth_user_id)
          <li class="aione-tab aione-tooltip {{(Request::route()->action['as'] == 'collaborate.dataset')?'nav-item-current':''}}" title="Collaborate">
            <a href="{{route('collaborate.dataset',$id)}}"> <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-share-square">
                    </i></span><span class="nav-item-text">Collaborate</span></a>
          </li>
      @endif
      <li class="aione-tab aione-tooltip {{(Request::route()->action['as'] == 'customize.dataset')?'nav-item-current':''}}" title="Customize">
        <a href="{{route('customize.dataset',$id)}}"> <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-wrench">
                    </i></span><span class="nav-item-text">Customize</span></a>
      </li>

      
      <div class="clear"></div>
  </ul>
</nav>
<style type="text/css">
  .aione-content{
    overflow-x: hidden;
  }
</style>




