@extends('admin.layouts.main')
@section('content')
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Modules',
  'add_new' => '+ Add Module'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
<div id="search" class="projects list-view">
  <div class="row" id="find-project">
    <div class="col s12 m12 l9 " >
     {{--  <div class="row no-margin-bottom">
        <div class="col s12 m12 l6  pr-7 tab-mt-10" >
          
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
      </div> --}}

      
      
    </div>

    <div class="col s12 m3 l3 pl-7" >
      <a id="add_new" href="{{route('create.module')}}" class="btn add-new display-form-button" >
        Add Module
      </a>
     
      
    </div>
  </div>

  <div class="row" id="sortable">
    @php
      $index = 0;
    @endphp
    @foreach($listModule as $key => $val)
      <div id="item-{{$index}}">
        <div class="list" id="list">
       
          <div class="card-panel shadow white z-depth-1 hoverable project"  >

            <div class="row valign-wrapper no-margin-bottom">
              <div class="col l5 s5 center-align project-image-wrapper">
                
                {{-- <img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" alt="" class="project-image circle responsive-img">  --}}

                <div class="defualt-logo"  data-toggle="popover" title="Click to view details" >
                 {{ucwords(substr($val->name, 0, 1))}} 
                </div>
                  <a href="{{route('edit.module',['id'=>$val->id])}}"> Edit</a>

              </div>
              <div class="col l11 s10 editable " >
                <div class="row m-0 valign-wrapper">
                  <div class="col s8 m8 l8">
                    <input type="hidden" value="{{$val->id}}" class="module_id" >
                    <input type="hidden" name="_token" value="{{csrf_token()}}" class="shift_token" >
                    
                    <a href="#" data-toggle="popover" title="Click here to edit the Module name" data-content="TEST" >
                      <h5 class="project-title black-text flow-text truncate line-height-35">
                        <span class="project-name shift_name font-size-14 name" contenteditable="true" > {{$val->name}}</span>
                      </h5>
                    </a>
                  </div>
                  <div class="col l4 right-align">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" class="module_token" >
                    <div class="switch">
                        <label>
                          @if($val->status == '0')
                            <input type="checkbox">
                          @else
                            <input type="checkbox" checked="checked">
                          @endif
                          <span class="lever"></span>
                        </label>
                      </div>
                  </div>
                  
                  <div class="col s4 m4 l4 right-align">
                    <div class="switch">
                      <a onclick="return confirm('Are you sure want to delete?')" href="{{route('delete.module',['id'=>$val->id])}}" data-toggle="popover" title="Click here to delete this Module">  <i class="fa fa-trash red-text" aria-hidden="true"></i></a>
                      <a href="{{route('get.submodule',$val->id)}}" title="Click here to style this Module">  <i class="fa fa-edit blue-text" aria-hidden="true"></i></a>
                     </div>
                  </div>

                </div>
              </div>
              
            </div>
          </div>          
        </div>
        @php
          $index++;
        @endphp  
      </div>
    @endforeach
  </div>
</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')

<script type="text/javascript">
 $(document).ready(function(){
    $('.modal').modal();
  });

  $(document).on('change', '.switch > label > input',function(e){
      e.preventDefault();
      var postedData = {};
      postedData['id']        = $(this).parents('.shadow').find('.module_id').val();
      postedData['status']      = $(this).prop('checked');
      postedData['_token']      = $('.shadow').find('.module_token').val();

      $.ajax({
        url:route()+'/module/status/update',
        type:'POST',
        data:postedData,
        success: function(res){
          console.log('data sent successfull');
        }
      });
      $('.editable h5 ,.editable p').removeClass('edit-fields');
    });
  $( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  });
 $(document).ready(function () {
    $('#sortable').sortable({
        axis: 'y',
        update: function (event, ui) {
          var module_id = [];
          var sort_id = [];
          var data = $(this).sortable('serialize');

          $('.module_id').each(function($v){
            module_id.push($(this).val());
          });
          $('.ui-sortable-handle').each(function($v){
            sort_id.push($(this).attr('id'));
          });

          $.ajax({
            url: route()+'/sort/module',
            type: 'POST',
            data: {module_id : module_id , sort_id : sort_id  , _token : $('.module_token').val()},
            success:function(){
              console.log()
            }
        });
      }
    });
});
</script>


@endsection
