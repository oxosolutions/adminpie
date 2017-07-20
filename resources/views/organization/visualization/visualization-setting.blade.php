@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Visualization Settings',
  'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('organization.visualization._tabs')
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
    	 <div class="card-v2">
                    <div class="card-v2-header">
                        Visualization Settings
                    </div>
                    <div class="card-v2-content">
                        <div class="row" style="margin-bottom: 0px">
                            <div class="col l6" style="border-right:2px solid #f2f2f2">
                                 <ul>
                                    <li>
                                        <div class="row" style="margin-bottom: 0px;padding: 14px">
                                            <div class="col l6" style="line-height: 48px;">
                                                Select theme
                                            </div>
                                            <div class="col l6 right-align aione-field-wrapper">
                                               
                                               {!! Form::select('chart_type',['minimal','second opt'],null,["class"=>"no-margin-bottom aione-field select_2 browser-default  " , 'placeholder'=>'Chart Type','id'=>'chart_type'])!!}
                                               
                                            </div>
                                        </div>    
                                    </li>
                                    <div class="divider"></div>
                                    <li>
                                        <div class="row" style="margin-bottom: 0px;padding: 14px">
                                            <div class="col l6">
                                                Enable header
                                            </div>
                                            <div class="col l6 right-align">
                                                 <div class="switch">
                                                    <label>
                                                      <input type="checkbox" checked>
                                                      <span class="lever"></span>
                                                    </label>
                                                  </div>
                                            </div>
                                        </div>
                                    </li>
                                     <div class="divider"></div>
                                    <li>
                                        <div class="row" style="margin-bottom: 0px;padding: 14px">
                                            <div class="col l6">
                                                Enable copyright
                                            </div>
                                            <div class="col l6 right-align">
                                                 <div class="switch">
                                                    <label>
                                                      <input type="checkbox">
                                                      <span class="lever"></span>
                                                    </label>
                                                  </div>
                                            </div>
                                        </div>
                                    </li>
                                     <div class="divider"></div>
                                    <li>
                                        <div class="row" style="margin-bottom: 0px;padding: 14px">
                                            <div class="col l6">
                                                Enable chart title
                                            </div>
                                            <div class="col l6 right-align">
                                                 <div class="switch">
                                                    <label>
                                                      <input type="checkbox">
                                                      <span class="lever"></span>
                                                    </label>
                                                  </div>
                                            </div>
                                        </div>
                                    </li>
                                     <div class="divider"></div>
                                    <li>
                                        <div class="row" style="margin-bottom: 0px;padding: 14px">
                                            <div class="col l6">
                                                Enable filters
                                            </div>
                                            <div class="col l6 right-align">
                                                 <div class="switch">
                                                    <label>
                                                      <input type="checkbox">
                                                      <span class="lever"></span>
                                                    </label>
                                                  </div>
                                            </div>
                                        </div>
                                    </li>
                                     <div class="divider"></div>
                                    <li>
                                        <div class="row" style="margin-bottom: 0px;padding: 14px">
                                            <div class="col l6">
                                                Filter position
                                            </div>
                                            <div class="col l6 right-align">
                                                <span style="color: #a8a8a8">Top</span>
                                            </div>
                                        </div>
                                    </li>
                                     <div class="divider"></div>
                                    <li>
                                        <div class="row" style="margin-bottom: 0px;padding: 14px">
                                            <div class="col l6">
                                                Sortable chart widgets
                                            </div>
                                            <div class="col l6 right-align">
                                                 <div class="switch">
                                                    <label>
                                                      <input type="checkbox">
                                                      <span class="lever"></span>
                                                    </label>
                                                  </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    
                                </ul>
                            </div>
                            <div class="col l6">
                                <ul>
                          
                                    <li>
                                        <div class="row" style="margin-bottom: 0px;padding: 14px">
                                            <div class="col l6">
                                                Collapsible chart widgets
                                            </div>
                                            <div class="col l6 right-align">
                                                 <div class="switch">
                                                    <label>
                                                      <input type="checkbox">
                                                      <span class="lever"></span>
                                                    </label>
                                                  </div>
                                            </div>
                                        </div>
                                    </li>
                                     <div class="divider"></div>
                                    <li>
                                        <div class="row" style="margin-bottom: 0px;padding: 14px">
                                            <div class="col l6">
                                                Footer content
                                            </div>
                                            <div class="col l6 right-align">
                                                <i class="fa fa-pencil" style="margin-right: 20px"></i>
                                            </div>
                                        </div>
                                    </li>
                                      <div class="divider"></div>
                                    <li>
                                        <div class="row" style="margin-bottom: 0px;padding: 14px">
                                            <div class="col l6">
                                                Show topbar
                                            </div>
                                           <div class="col l6 right-align">
                                                 <div class="switch">
                                                    <label>
                                                      <input type="checkbox">
                                                      <span class="lever"></span>
                                                    </label>
                                                  </div>
                                            </div>
                                        </div>
                                    </li>
                                      <div class="divider"></div>
                                    <li>
                                        <div class="row checkbox waves-effect " style="margin-bottom: 0px;padding: 14px;width: 100%">
                                            <div class="col l6">
                                                Show loading animation
                                            </div>
                                            <div class="col l6 right-align">
                                                 <div class="switch">
                                                    <label>
                                                      <input type="checkbox" >
                                                      <span class="lever"></span>
                                                    </label>
                                                  </div>
                                            </div>
                                        </div>
                                    </li>
                                      <div class="divider"></div>
                                    <li>
                                        <div class="row waves-effect" data-target="modal1" style="margin-bottom: 0px;padding: 14px;width: 100%">
                                            <div class="col l6">
                                                Custom css code
                                            </div>
                                            <div class="col l6 right-align">
                                                <i class="fa fa-pencil" style="margin-right: 20px"></i>
                                            </div>
                                        </div>
                                        <div id="modal1" class="modal modal-fixed-footer">
                                          <div class="modal-content">
                                            <h4>Modal Header</h4>
                                            <p>A bunch of text</p>
                                          </div>
                                          <div class="modal-footer">
                                            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
                                          </div>
                                        </div>
                                    </li>
                                      <div class="divider"></div>
                                    <li>
                                        <div class="row" style="margin-bottom: 0px;padding: 14px">
                                            <div class="col l6">
                                                Custom javascript code
                                            </div>
                                            <div class="col l6 right-align">
                                                <i class="fa fa-pencil" style="margin-right: 20px"></i>
                                            </div>
                                        </div>
                                    </li>
                                     <div class="divider"></div>
                                    
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
      @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
<style type="text/css">
    .card-v2{
        border: 2px solid #f2f2f2;
        box-shadow: 0px 0px 1px rgba(128, 128, 128, .2);
        margin-bottom: 14px;
    }
    .card-v2 > .card-v2-header{
        background-color: #f2f2f2;
        padding: 10px;
    }
    .lever{
        margin-top: -4px !important
    }
</style>
<script type="text/javascript">
  $('.checkbox').click(function(){
    $(this).find('input[type=checkbox]').prop('checked', function(){

          return !this.checked;
      });
  });
   $(document).ready(function(){
    $('.modal').modal();
  });

</script>
@endsection