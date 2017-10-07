@php
    if(@request()->route()->parameters()['id'] != ''){
        @$id = @request()->route()->parameters()['id'];
    }else{
        @$id = @request()->route()->parameters()['form_id'];
    }
@endphp
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
    <ul id="sortable_tabs" class="aione-tabs">
        {{-- <li class="aione-tab {{(Request::route()->action['as'] == 'view.dataset')?'nav-item-current':''}}"> --}}
        <li class="aione-tab nav-item-current">
            <a href="{{ route('create.slider') }}"><span class="nav-item-text">Slides</span></a>
        </li>
        <li class="aione-tab ">
            <a href="{{ route('setting.slider') }}"><span class="nav-item-text">Settings</span></a>
        </li>

        <div class="clear"></div>
    </ul>
</nav>



