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
        <li class="aione-tab {{(Request::route()->action['as'] == 'testing.control')?'nav-item-current':''}}">
            <a href="{{route('testing.control')}}"><span class="nav-item-text">Testing</span></a>
        </li>
        <li class="aione-tab {{(Request::route()->action['as'] == 'consistency.control')?'nav-item-current':''}}">
            <a href="{{route('consistency.control')}}"><span class="nav-item-text">Consistency</span></a>
        </li> 
        <div class="clear"></div>
    </ul>
</nav>



