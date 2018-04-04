@php
  if(@request()->route()->parameters()['id'] != ''){
    @$id = @request()->route()->parameters()['id'];
  }

@endphp
<nav id="aione_profile_tabs" class="aione-account-tabs aione-nav-tabs aione-nav aione-nav-horizontal"  >
  <ul class="aione-tabs">
      <li class="aione-tab profile-view-tab {{(Request::route()->action['as'] == 'profile.view')?'nav-item-current':''}}">
        <a href="{{ route('profile.view') }}">
          <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-ios-monitor-outline ionic-icon"></i></span>
          <span class="nav-item-text">{{__('organization/profile.tab_view_profile')}}</span></a>
      </li>
      <li class="aione-tab profile-edit-tab {{(Request::route()->action['as'] == 'profile.edit')?'nav-item-current':''}}">
        <a href="{{route('profile.edit')}}">
        <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-compose ionic-icon"></i></span><span class="nav-item-text">{{__('organization/profile.tab_edit_profile')}}</span></a>
      </li>
      <li class="aione-tab profile-changepassword-tab {{(Request::route()->action['as'] == 'profile.changepassword')?'nav-item-current':''}}">
        <a href="{{route('profile.changepassword')}}">
        <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-ios-unlocked ionic-icon"></i></span><span class="nav-item-text">{{__('organization/profile.tab_change_password')}}</span></a>
      </li>
      <li class="aione-tab profile-picture-tab {{(Request::route()->action['as'] == 'profile-picture.details')?'nav-item-current':''}}">
        <a href="{{route('profile-picture.details')}}"><span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="ion-person ionic-icon"></i></span><span class="nav-item-text">{{__('organization/profile.tab_profile_picture')}}</span></a>
      </li>
      <div class="clear"></div>
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

