@extends('admin.layouts.main')

@section('content')
{{-- page header is not working here  --}}
{{-- @php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Edit Organization',
    'add_new' => '+ Add Designation'
); 
@endphp
@include('common.pageheader',$page_title_data)  --}}
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
<div class="fade-background">

</div>
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
      <a id="add_new" href="" class="btn add-new display-form-button" >
        Add User
      </a>
      <div id="add_new_wrapper" class="add-new-wrapper add-form ">
        {{-- {!! Form::open(['route'=> , 'class'=> 'form-horizontal','method' => 'post'])!!} --}}

          <div class="row no-margin-bottom">
           
            <div class="input-field col l12">
              <input placeholder="Enter user name" id="user_name" type="text" class="validate">
              <label for="user_name">Name</label>
            </div>

            <div class="input-field col l12">
              <input placeholder="Enter email" id="emailId" type="email" class="validate">
              <label for="emailId">Email</label>
            </div>

            <div class="input-field col l12">
             
              <label for="roleId">Role ID</label>
              <select>
                <option> Choose Role</option>
                @foreach($plugins['roles'] as $key => $val)
                <option value="{{$key}}">{{$val}} </option>
                @endforeach
              </select>
            </div>

            <div class="input-field col l12">
              <input placeholder="********" id="Password" type="password" class="validate">
              <label for="Password">Password</label>
            </div>

            <div class="col s12 m12 l12 aione-field-wrapper center-align">
              <a href="javascript:;" class="save_user btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save
                <i class="material-icons right">save</i>
              </a>
            </div>
          </div>
        {{-- {!!Form::close()!!} --}}

      </div>
     
    </div>
  </div>
  <div class="row">
    <div class="col l12">
      <div class="list" id="list">   
        
      
        
      </div> 
    </div>
     
  </div>
</div>
@include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')

    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
<script type="text/javascript">
  $('.add-new').off().click(function(e){
      e.preventDefault();
      $('.add-new-wrapper').toggleClass('active');
      $('.fade-background').fadeToggle(300);
    });
    
    $('.fade-background').click(function(){
      $('.fade-background').fadeToggle(300);
      $('.add-new-wrapper').toggleClass('active');
    });  
</script>
<style type="text/css">
  .input-field.col label{
        left: 0;
  }
</style>
@endsection