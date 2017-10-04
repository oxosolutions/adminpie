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
       <li class="aione-tab {{(Request::route()->action['as'] == 'view.dataset')?'nav-item-current':''}}">
        <a href="{{route('view.dataset',$id)}}"><span class="nav-item-text">View</span></a>
      </li>
       <li class="aione-tab {{(Request::route()->action['as'] == 'edit.dataset')?'nav-item-current':''}}">
        <a href="{{route('edit.dataset',$id)}}"><span class="nav-item-text">Edit </span></a>
      </li>
       <li class="aione-tab {{(Request::route()->action['as'] == 'define.dataset')?'nav-item-current':''}}">
        <a href="{{route('define.dataset',$id)}}"><span class="nav-item-text">Define</span></a>
      </li>
        <li class="aione-tab {{(Request::route()->action['as'] == 'filter.dataset')?'nav-item-current':''}}">
        <a href="{{route('filter.dataset',$id)}}"><span class="nav-item-text">Data Filter</span></a>
      </li>
        <li class="aione-tab {{(Request::route()->action['as'] == 'validate.dataset')?'nav-item-current':''}}">
        <a href="{{route('validate.dataset',$id)}}"><span class="nav-item-text">Validate</span></a>
      </li>
        <li class="aione-tab {{(Request::route()->action['as'] == 'visualize.dataset')?'nav-item-current':''}}">
        <a href="{{route('visualize.dataset',$id)}}"><span class="nav-item-text">Visualizations</span></a>
      </li>
      <li class="aione-tab {{(Request::route()->action['as'] == 'collaborate.dataset')?'nav-item-current':''}}">
        <a href="{{route('collaborate.dataset',$id)}}"><span class="nav-item-text">Collaborate</span></a>
      </li>
      <li class="aione-tab {{(Request::route()->action['as'] == 'customize.dataset')?'nav-item-current':''}}">
        <a href="{{route('customize.dataset',$id)}}"><span class="nav-item-text">Customize</span></a>
      </li>

      
      <div class="clear"></div>
  </ul>
</nav>



