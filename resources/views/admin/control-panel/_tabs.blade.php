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
            <a href="{{route('view.dataset',$id)}}"><span class="nav-item-text">testing</span></a>
        </li>
        <li class="aione-tab {{(Request::route()->action['as'] == 'edit.dataset')?'nav-item-current':''}}">
            <a href="{{route('edit.dataset',$id)}}"><span class="nav-item-text">Consistency</span></a>
        </li> 
        <div class="clear"></div>
    </ul>
</nav>



