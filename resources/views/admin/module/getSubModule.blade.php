@extends('admin.layouts.main')
@section('content')
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Modules',
  'add_new' => '+ Apply leave'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
<div id="search" class="projects list-view">
  <div class="row" id="find-project">
    <div class="col s12 m12 l9 " >
      <div class="row no-margin-bottom">
        <div class="col s12 m12 l6  pr-7 tab-mt-10" >
          <!-- <input class="search aione-field" placeholder="Search" /> -->
          <nav>
              <div class="nav-wrapper">
                  <form>
                    <div class="input-field">
                        <input id="search" class="search" type="search" required style="background-color: #ffffff">
                        <label class="label-icon" for="search" style=""><i class="material-icons icon-search" >search</i></label>
                        <i class="material-icons icon-close">close</i>
                    </div>
                  </form>
              </div>
          </nav>
        </div>
        <div class="col s6 m6 l3  aione-field-wrapper pl-7 tab-mt-10">
          <div class="row aione-sort" style="">
            <select class="col  browser-default aione-field" >
              <option value="" disabled selected>Sort By</option>
              <option value="1">Name</option>
              <option value="2">Date</option>
            </select>
            <div class="col alpha-sort" style="width: 25%;padding-left:7px;">
              <a href="javascript:;" class="sort" ><i class="fa fa-sort-alpha-asc arrow_sort white" ></i></a>
            </div>
          </div>
        </div>

        <div class="col s6 m6 l3 pl-7 right-float tab-mt-10 tab-pl-10">
          <div class="row aione-switch-view">
            <ul class="right  views m-0" >
              <li class="inline-block" sty><a href="#list-view" class=" view" data-view="list-view"><i class="material-icons" >view_list</i></a></li>
              <li class="inline-block" ><a href="#detail-view" class=" view" data-view="detail-view"><i class="material-icons" >view_stream</i></a></li>
              <li class="inline-block" ><a href="#grid-view" class=" view" data-view="grid-view"><i class="material-icons" >view_module</i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="col s12 m3 l3 pl-7" >
      <a id="add_new" href="{{route('create.module')}}" class="btn add-new display-form-button" >
        Add Module
      </a>
    </div>
  </div> 

  <div class="row" id="sortable">
    @foreach($model as $key => $val)
    <div class="main-submodule">
       <div class="submodule-left">
          {{$val->name}}
        </div>
        <div class="submodule-right">
          <span><a href="{{route('style.module',$val->id)}}"><i class="fa fa-edit"></i></a></span>
        </div>
    </div>
     
    @endforeach
  </div>
</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection
<style type="text/css">
.main-submodule{
  overflow: hidden;
  padding: 15px;
  border: 1px solid #f2f2f2;
  margin-bottom: 5px;
}
.main-submodule:hover{
    box-shadow: 0px 0px 4px 2px #F2F1F1;
}
  .submodule-left{
     float: left;
}
.submodule-right{
  float: right;
}

</style>