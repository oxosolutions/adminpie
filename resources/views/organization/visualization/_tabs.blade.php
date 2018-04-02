@php
    @$id = @request()->route()->parameters()['id'];
@endphp
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal"  >
  	<ul id="sortable_tabs" class="aione-tabs">
        
      	<li class="aione-tab aione-tooltip {{(Request::route()->action['as'] == 'edit.visualization')?'nav-item-current':''}}" title="Edit">
        	<a href="{{route('edit.visualization',$id)}}">
        <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-edit"></i></span>

            <span class="nav-item-text">Edit</span></a>
      	</li>
        <li class="aione-tab aione-tooltip {{(Request::route()->action['as'] == 'visualization.view')?'nav-item-current':''}}" title="View">
          <a href="{{route('visualization.view',$id)}}">
        <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-tv"></i></span>

            <span class="nav-item-text">View</span></a>
        </li>
      	<li class="aione-tab aione-tooltip {{(Request::route()->action['as'] == 'setting.visualization')?'nav-item-current':''}}" title="Settings ">
        	<a href="{{route('setting.visualization',$id)}}">
        <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-cog"></i></span>

            <span class="nav-item-text">Settings </span></a>
      	</li>
      	<li class="aione-tab aione-tooltip {{(Request::route()->action['as'] == 'collaborate.visualization')?'nav-item-current':''}}" title="Collaborate">
        	<a href="{{route('collaborate.visualization',$id)}}">
        <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-share-square"></i></span>

            <span class="nav-item-text">Collaborate</span></a>
      	</li>
      	<li class="aione-tab aione-tooltip {{(Request::route()->action['as'] == 'customize.visualization')?'nav-item-current':''}}" title="Customize">
        	<a href="{{route('customize.visualization',$id)}}">
        <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-wrench"></i></span>

            <span class="nav-item-text">Customize</span></a>
      	</li>
      	<div class="clear"></div>
  	</ul>
</nav>