@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
'show_page_title' => 'yes',
'show_add_new_button' => 'yes',
'show_navigation' => 'yes',
'page_title' => 'Leaves',
'add_new' => '+ Apply leave'
); 

$till_year = date('Y') +2;
$today = date('Y-m-d');

$leaving_date = get_current_user_meta('date_of_leaving');
if($leaving_date!=false){
   if(date('Y-m-d',strtotime($leaving_date)) < $today){
      unset($page_title_data['add_new']);
   }
   $till_year = date('Y',strtotime($leaving_date));
}

//dd($data, $current_used_leave);

$range = range(1970, $till_year);
$value = array_map( function($a){
   $next_year = $a + 1;
   return 'April '.$a.' to March '.$next_year; 
}, $range);
$years = array_combine($range, $value);
if(!empty($error)){
   unset($page_title_data['add_new']);
}  
@endphp
@include('common.pageheader',$page_title_data)
@if (Session::has('sucessful'))
<div class="aione-message success" >
   {{Session::get('sucessful')}} 
</div>
@endif
@if (Session::has('errorss'))
   @php

      $errorss = Session::get('errorss');
   @endphp
   @if(empty($errorss['from']) &&  empty($errorss['to']))
      @foreach($errorss as $key => $value)
            <div class="aione-message error" >  {{e($value)}} 
            </div>
      @endforeach
     {{--  {{dd($error)}} --}}
   @endif
   @if(!empty($errorss['from']))
      @foreach($errorss['from'] as $key => $value)
            <div class="aione-message error" >   {{e($value)}}
            </div>
      @endforeach
   @endif
   @if(!empty($errorss['to']))
      @foreach($errorss['to'] as $key => $value)
            <div class="aione-message error" >   {{e($value)}}
            </div>
      @endforeach
   @endif
@endif

@include('common.pagecontentstart')
@include('common.page_content_primary_start')

   @include('organization.profile._tabs')
   @if(!empty($error))
   <div class="aione-message warning">
      {{$error}}   
   </div>
   
   @else
   {!! Form::open(['route'=>'store.employeeleave' , 'class'=> 'form-horizontal','method' => 'post'])!!}
               <input type="hidden" name="apply_by" value="employee">
               @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Apply Leave','button_title'=>'Save leave','form'=>'account-leave-form']])
               {!!Form::close()!!}
   <div class="ar">
      <div class="ac l75">
         <div class="aione-border mb-25">
            <div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
               Leaves List   
            </div>
            <div class="p-10">
               <div class="aione-table">
                  <table>
                     <thead>
                        <tr>
                           <th>Leave Reason</th>
                           <th>No. of days</th>
                           <th>Period</th>
                           <th>Status</th>
                           
                        </tr>
                     </thead>
                     <tbody>
                        @if(!empty($data->toArray()))
                           @foreach($data as $key => $val)
                              <tr>
                                 <td>{{$val->reason_of_leave}}</td>
                                 <td>
                                    @if($total = collect([$val->from_leave_count,$val->to_leave_count])->sum())
                                    {{$total}} Days
                                    @else
                                    {{$val->total_days}} Days
                                    @endif
                                 </td>
                                 <td>{{$val->from}} to {{$val->to}} </td>
                                 <td>
                                    @if($val->status ==1)
                                       <span class="green">Approved</span>
                                    @elseif($val->status ==3)
                                       <span class="red">Denied</span>
                                    @elseif($val->status ==0)
                                       <span class="orange">Pending</span>
                                    @endif  
                                 </td>
                              </tr>
                           @endforeach
                        @endif
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <div class="ac l25">
         <div class="aione-border mb-25">
            <div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
               Session   
            </div>
            <div class="p-10">
              {!! Form::open(['route'=>'account.leaves']) !!}
                  {!! Form::select('year',$years,$filter_year,['class'=>'browser-default mb-10'])!!}
                  {!! Form::submit('Search',['style'=>'width:100%']) !!}
                  {!! Form::close()!!}
            </div>
         </div>
         <div class="aione-border mb-25">
            <div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
               Leave rule for you   
            </div>
            <div class="p-10">
              @if(!empty($current_used_leave))
               {{-- {{dd($current_used_leave)}} --}}
               @foreach($current_used_leave as $key => $val)
                  <div class="aione-table">
                     <table>
                        <thead>
                           <tr>
                              <th colspan="2" class="aione-align-center">Title:-{{@$val['name']}}</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Assigend</td>
                              <td> @if(!empty($val['valid_for']) && $val['valid_for']=='monthly')
                              {{12*$val['number_of_day']}}
                              @else
                              {{@$val['number_of_day']}}
                              @endif</td>
                           </tr>
                           <tr>
                              <td>Used</td>
                              <td>{{$val['used_leave']}}</td>
                           </tr>
                           <tr>
                              <td>Left</td>
                              <td>@if(!empty($val['valid_for']) && $val['valid_for']=='monthly')
                              {{12*$val['number_of_day'] - $val['used_leave']}}
                              @else
                              {{$val['number_of_day'] - $val['used_leave']}}
                              @endif</td>
                           </tr>
                           <tr>
                              <td>Valid for</td>
                              <td>{{@$val['valid_for']}}</td>
                           </tr>
                           <tr>
                              <td>Apply Before</td>
                              <td>{{@$val['apply_before']}} days</td>
                           </tr>
                           <tr>
                              <td>Minimum saction leave</td>
                              <td>{{@$val['minimum_saction_leave']}}</td>
                           </tr>
                           <tr>
                              <td>Maximum saction leave</td>
                              <td>{{@$val['maximum_saction_leave']}}</td>
                           </tr>
                           <tr>
                              <td>Carry Forward</td>
                              <td> @if(@$val['carry_forward']==true)
                           Yes
                           @else
                           No
                           @endif</td>
                           </tr>
                        </tbody>
                           
                     </table>
                  </div>
                 
                   
                  
                    
                
              
               @endforeach
               @endif
            </div>
         </div>
      </div>
   </div>


   {{-- <div class="row">
      <div class="fade-background">
      </div>
      <div id="projects" class="projects list-view">
         <div class="row">
            <div class="col s12 m9 l9 pr-7" >
               <div class="row no-margin-bottom">
                  <div class="col s12 m12 l6  pr-7 tab-mt-10" >
                     <nav>
                        <div class="nav-wrapper">
                           <form>
                              <div class="input-field">
                                 <input id="search" type="search" required style="background-color: #ffffff">
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
               @if(!empty($data->toArray()))
               @foreach($data as $key => $val)
               <div class="list" id="list">
                  <div class="card-panel shadow white z-depth-1 hoverable project"  >
                     <div class="row valign-wrapper">
                        <div class="col s4">
                           <div class="row valign-wrapper">
                              <div class="col">
                                 <div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
                                    A 
                                 </div>
                              </div>
                              <input type="hidden" value="" class="id" >
                              <input type="hidden" name="_token" value="{{csrf_token()}}" class="shift_token" >
                              <div class="col" style="padding-left: 10px">
                                 <div style="font-weight: 500;" class="">{{$val->reason_of_leave}}</div>
                                 <div class="project-description"></div>
                                 <div class="aione-list-options">
                                    <a href="" style="padding-right:10px">{{$val->reason_of_leave}} View</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col s3 right-align">
                           <span class="teal white-text" style="padding: 2px 5px">{{$val['categories_rel']['name']}} </span>
                        </div>
                        <div class="col s3 right-align">
                           @if($total = collect([$val->from_leave_count,$val->to_leave_count])->sum())
                           <span class="teal white-text" style="padding: 2px 5px">{{$total}} Days</span>
                           @else
                           <span class="teal white-text" style="padding: 2px 5px">{{$val->total_days}} Days</span>
                           @endif
                        </div>
                        <div class="col s3 right-align">
                           <span class="teal white-text" style="padding: 2px 5px">{{$val->from}} to {{$val->to}} </span>
                        </div>
                        @if($val->status ==1)
                        <div class="col s3 right-align">
                           <span class="teal white-text" style="padding: 2px 5px">Approved</span>
                        </div>
                        @elseif($val->status ==3)
                        <div class="col s3 right-align">
                           <span class="teal white-text" style="padding: 2px 5px">Un-Approved</span>
                        </div>
                        @elseif($val->status ==0)
                        <div class="col s3 right-align">
                           <span class="teal white-text" style="padding: 2px 5px">Pending</span>
                        </div>
                        @endif  
                     </div>
                  </div>
               </div>
               @endforeach
            @endif
            </div>
            <div class="col s12 m3 l3 pl-7" >
               {!! Form::open(['route'=>'store.employeeleave' , 'class'=> 'form-horizontal','method' => 'post'])!!}
               <input type="hidden" name="apply_by" value="employee">
               @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Apply Leave','button_title'=>'Save leave','section'=>'accleasec1']])
               {!!Form::close()!!}
               <div>
                  {!! Form::open(['route'=>'account.leaves']) !!}
                  {!! Form::select('year',$years,$filter_year,['class'=>'browser-default'])!!}
                  {!! Form::submit('search') !!}
                  {!! Form::close()!!}
               </div>
               <div class="card title-card" >
                  Leave rules for you
               </div>
               @if(!empty($current_used_leave))
             
               @foreach($current_used_leave as $key => $val)
               <div class="card">
                  <div class="row mb-0" >
                     <div class="row mb-0 p-10">
                        <div class="col l6">Title</div>
                        <div class="col l6">{{@$val['name']}}</div>
                     </div>
                     <div class="divider"></div>
                     <div class="row mb-0" >
                        <div class="col l4" style="border-right:1px solid #e8e8e8">
                           <div class="center-align" style="font-weight: 500;padding: 6px">
                              Assigned
                           </div>
                           <div class="center-align" style="padding: 6px">
                              @if($val['valid_for']=='monthly')
                              {{12*$val['number_of_day']}}
                              @else
                              {{@$val['number_of_day']}}
                              @endif
                           </div>
                        </div>
                        <div class="col l4" style="border-right:1px solid #e8e8e8">
                           <div class="center-align" style="font-weight: 500;padding: 6px">
                              Used
                           </div>
                           <div class="center-align" style="padding: 6px">
                              <span class="green white-text" style="padding: 2px 5px;border-radius: 4px">
                              {{$val['used_leave']}}
                              </span>
                           </div>
                        </div>
                        <div class="col l4" style="border-right:1px solid #e8e8e8">
                           <div class="center-align" style="font-weight: 500;padding: 6px">
                              Left
                           </div>
                           <div class="center-align" style="padding: 6px">
                              <span class="green white-text" style="padding: 2px 5px;border-radius: 4px">
                              @if($val['valid_for']=='monthly')
                              {{12*$val['number_of_day'] - $val['used_leave']}}
                              @else
                              {{$val['number_of_day'] - $val['used_leave']}}
                              @endif
                              </span>
                           </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row mb-0 p-10" >
                           <div class="col l6">valid for</div>
                           <div class="col l6">{{$val['valid_for']}}</div>
                        </div>
                        <div class="divider"></div>
                        <div class="row mb-0 p-10" >
                           <div class="col l6">Apply Before</div>
                           <div class="col l6">{{@$val['apply_before']}} days</div>
                        </div>
                        <div class="divider"></div>
                        @if(!empty($val['minimum_saction_leave']))
                           <div class="row mb-0 p-10" style="">
                              <div class="col l6">Minimum saction leave</div>
                              <div class="col l6">{{@$val['minimum_saction_leave']}}</div>
                           </div>   
                            <div class="divider"></div>
                        @endif
                        @if(!empty($val['maximum_saction_leave']))
                           <div class="row mb-0 p-10" style=""> 
                              <div class="col l6">Maximum saction leave</div>
                              <div class="col l6">{{@$val['maximum_saction_leave']}}</div>
                           </div>   
                            <div class="divider"></div>
                        @endif
                         
                         <div class="row mb-0 p-10" style="">
                           <div class="col l6">Carry Forward</div>
                           @if(@$val['carry_forward']==true)
                           <div class="col l6">Yes</div>
                           @else
                           <div class="col l6">No</div>
                           @endif
                        </div>
                         <div class="divider"></div>
                      
                     </div>
                  </div>
               </div>
               @endforeach
               @endif
            </div>
         </div>
      </div>
   </div> --}}
   @endif
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
   {{-- <button class="aione-tooltip" title="abcd">abc</button> --}}
   {{-- {!! FormGenerator::GenerateForm('account-leave-form') !!} --}}
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<script type="text/javascript">
   $(".datepicker").pickadate({
      selectMonths:true,
      selectYear:15,
      min: new Date(new Date().getFullYear(),new Date().getMonth(),new Date().getDate())
   });
   $(document).ready(function(){
      $('#field_3241').hide(); //from
      $('#field_189').hide(); // to
      $('#field_3238').hide();//half type
      $('#field_3240').hide();// single date

   })
   $(document).on('change','#field_3232 select',function(){
      console.log($(this).val());
      if($(this).val() == 'half'){
         $('#field_3241').show(); //from
         $('#field_189').hide(); //189
         $('#field_3238').show(); //half type
         $('#field_3240').hide(); // single date
      }
      if($(this).val() == 'one_day_leave'){
          $('#field_3241').show();
         $('#field_189').hide();
         $('#field_3238').hide();
         // $('#field_3240').show();
      }
      if($(this).val() == 'multi'){
         $('#field_3241').show();
         $('#field_189').show();
         $('#field_3238').hide();
         // $('#field_3240').hide();
      }
   })
   
</script>
<style type="text/css">
   .title-card{
   padding:10px;
   }
   .card{
   margin: 0px;margin-bottom: 10px
   }
   .mb-0{
   margin-bottom: 0px;
   }
   .p-10{
   padding: 10px
   }
</style>
@endsection