@php
  
        @$id = @request()->route()->parameters()['id'];
    
@endphp
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
    <ul id="sortable_tabs" class="aione-tabs">
        {{-- <li class="aione-tab {{(Request::route()->action['as'] == 'view.dataset')?'nav-item-current':''}}"> --}}
        <li class="aione-tab {{(Request::route()->action['as'] == 'slider.edit')?'nav-item-current':''}}">
            <a href="{{ route('slider.edit',$id) }}"><span class="nav-item-text">Edit</span></a>
        </li>
        <li class="aione-tab {{(Request::route()->action['as'] == 'options.slider')?'nav-item-current':''}}">
            <a href="{{ route('options.slider',$id) }}"><span class="nav-item-text">Options</span></a>
        </li>
    

        <div class="clear"></div>
    </ul>
</nav>



