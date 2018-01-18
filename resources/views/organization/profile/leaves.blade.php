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

   $range = range(2017, 2022);
   $years = array_combine($range, $range);
if(!empty($error)){
unset($page_title_data['add_new']);
}	
@endphp
@include('common.pageheader',$page_title_data)
@if (Session::has('sucessful'))
<div class="alert alert-info" style="color:green;">
   <h1> {{Session::get('sucessful')}} </h1>
</div>
@endif
@if (Session::has('error'))
@foreach(Session::get('error') as $key => $value)
<div class="alert alert-info" style="color:red;">
   <h3>
      {{e($value)}} 
   </h3>
</div>
@endforeach
@endif
{{-- @if($errors->any())
<script type="text/javascript">
   window.onload = function(){
     $('#add_new_model').modal('open');
   }
</script>
@endif --}}
<div class="row">
   @include('organization.profile._tabs')
   @if(!empty($error))
   <h1>{{$error}}</h1>
   @else
   <div class="row">
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
                           <span class="teal white-text" style="padding: 2px 5px">{{$val->total_days}} Days</span>
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
                        <div class="col l6">{{$val['name']}}</div>
                     </div>
                     <div class="divider"></div>
                     <div class="row mb-0" >
                        <div class="col l4" style="border-right:1px solid #e8e8e8">
                           <div class="center-align" style="font-weight: 500;padding: 6px">
                              Assigned
                           </div>
                           <div class="center-align" style="padding: 6px">
                              @if($val['valid_for']=='monthly')
                              {{12*$val['assigned_leave']}}
                              @else
                                 {{$val['assigned_leave']}}
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
                                    {{12*$val['assigned_leave'] - $val['used_leave']}}
                                 @else
                                    {{$val['assigned_leave'] - $val['used_leave']}}
                                 @endif
                              </span>
                           </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row mb-0 p-10" >
                           <div class="col l6">valid for</div>
                           <div class="col l6">{{$val['valid_for']}}</div>
                        </div>
                        {{-- @if(!empty($val['apply_before']))
                           <div class="divider"></div>
                           <div class="row mb-0 p-10" style="">
                              <div class="col l6">Apply Before</div>
                              <div class="col l6">{{@$val['apply_before']}}</div>
                           </div>
                        @endif --}}
                        <div class="divider"></div>
                        <div class="row mb-0 p-10" style="">
                           <div class="col l6">Carry Forward</div>
                           @if(@$val['carry_forward']==true)
                           <div class="col l6">Yes</div>
                           @else
                           <div class="col l6">No</div>
                           @endif
                        </div>
                        <div class="divider"></div>
                        <div class="row mb-0 p-10" style="">
                           @if($val['valid_for']=='monthly')
                           <div class="col l6">Year Month</div>
                           @else
                           <div class="col l6">Year</div>
                           @endif
                           <div class="col l6">{{$val['leave_used_in']}}</div>
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
               @endif
               {{-- 
               <div class="card">
                  <div class="row mb-0" >
                     <div class="row mb-0 p-10">
                        <div class="col l6">Title</div>
                        <div class="col l6">t val</div>
                     </div>
                     <div class="divider"></div>
                     <div class="row mb-0" >
                        <div class="col l4" style="border-right:1px solid #e8e8e8">
                           <div class="center-align" style="font-weight: 500;padding: 6px">
                              Total
                           </div>
                           <div class="center-align" style="padding: 6px">
                              Total value
                           </div>
                        </div>
                        <div class="col l4" style="border-right:1px solid #e8e8e8">
                           <div class="center-align" style="font-weight: 500;padding: 6px">
                              Used
                           </div>
                           <div class="center-align" style="padding: 6px">
                              <span class="green white-text" style="padding: 2px 5px;border-radius: 4px">used_leave</span>
                           </div>
                        </div>
                        <div class="col l4">
                           <div class="center-align" style="font-weight: 500;padding: 6px">
                              left
                           </div>
                           <div class="center-align" style="padding: 6px">
                              <span class="orange white-text" style="padding: 2px 5px;border-radius: 4px">value</span>
                           </div>
                        </div>
                     </div>
                     <div class="divider"></div>
                     <div class="row mb-0 p-10" >
                        <div class="col l6">Apply Before</div>
                        <div class="col l6">metaVal['value Days</div>
                     </div>
                     <div class="divider"></div>
                     <div class="row mb-0 p-10" style="">
                        <div class="col l6">Yearly/Monthly</div>
                        <div class="col l6">metaVal['value</div>
                     </div>
                  </div>
               </div>
               --}}
               {{-- @foreach($leave_rule as $ruleKey => $ruleVal)
               <div class="card">
                  <div class="row mb-0" >
                     <div class="row mb-0 p-10">
                        <div class="col l6">Title</div>
                        <div class="col l6">{{$ruleVal['name']}}</div>
                     </div>
                     <div class="divider"></div>
                     @foreach($ruleVal['meta'] as $metakey =>$metaVal)
                     @php	$used_leave =0;
                     if(!empty($leave_count_by_cat[$ruleVal->id])){
                     $used_leave = $leave_count_by_cat[$ruleVal->id]->sum('total_days');
                     }
                     @endphp
                     <div class="row mb-0" >
                        @if($metaVal['key'] =="number_of_day")
                        <div class="col l4" style="border-right:1px solid #e8e8e8">
                           <div class="center-align" style="font-weight: 500;padding: 6px">
                              Total
                           </div>
                           <div class="center-align" style="padding: 6px">
                              {{$metaVal['value']}}
                           </div>
                        </div>
                        <div class="col l4" style="border-right:1px solid #e8e8e8">
                           <div class="center-align" style="font-weight: 500;padding: 6px">
                              Used
                           </div>
                           <div class="center-align" style="padding: 6px">
                              <span class="green white-text" style="padding: 2px 5px;border-radius: 4px">{{$used_leave}}</span>
                           </div>
                        </div>
                        <div class="col l4">
                           <div class="center-align" style="font-weight: 500;padding: 6px">
                              left
                           </div>
                           <div class="center-align" style="padding: 6px">
                              <span class="orange white-text" style="padding: 2px 5px;border-radius: 4px">{{@$metaVal['value'] - $used_leave }}</span>
                           </div>
                        </div>
                        @endif
                     </div>
                     @if($metaVal['key'] =="apply_before" )
                     <div class="divider"></div>
                     <div class="row mb-0 p-10" >
                        <div class="col l6">Apply Before</div>
                        <div class="col l6">{{$metaVal['value']}} Days</div>
                     </div>
                     @endif
                     @if($metaVal['key'] =="valid_for" )
                     <div class="divider"></div>
                     <div class="row mb-0 p-10" style="">
                        <div class="col l6">Yearly/Monthly</div>
                        <div class="col l6">{{ucfirst($metaVal['value'])}}</div>
                     </div>
                     @endif
                     @endforeach
                  </div>
               </div>
               @endforeach --}}
            </div>
         </div>
      </div>
   </div>
   @endif
</div>
<script type="text/javascript">
   $(".datepicker").pickadate({
   	selectMonths:true,
   	selectYear:15,
   	min: new Date(new Date().getFullYear(),new Date().getMonth(),new Date().getDate())
   });
   
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