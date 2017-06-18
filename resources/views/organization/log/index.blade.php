@extends('layouts.main')

@section('content')
<style type="text/css">
.content{
    background-color: #ffffff;
    height: 100%;
    
}
.border{
  border: 1px solid #e6e6e6;
}
.box-header{
  padding: 0px;
}
  ul li{
    list-style: none
  }
  h4{
    margin: 10px;
}
  .border-b4{
   /*border: 1px solid #c9c9c9;*/
    margin-top: 20px;
    padding: 10px;
  }
  .breadcrumb:last-child{
    color: #333;
  }
  ul.breadcrumb li{
    float: left;
    padding-left: 5px;
  }
  .breadcrumb i{
    font-size: 20px;
    color: #2196f3;
  }
  .breadcrumb li a{
    color: #494949;
    padding-left: 11px;
  }
  .select-wrapper span.caret{
    color: initial;
    position: absolute;
    right: 0;
    top: 0px; 
    bottom: 0px;
    padding-top: 17px;
    height: 48px;
    width: 27px;
    text-align: center;
    margin: auto 0;
    font-size: 12px;
    line-height: 10px;
   
  }
  .select-dropdown li.disabled>span{
    color: #757474;
    border: 1px solid #f2f2f2;
  }
  .select-wrapper input.select-dropdown{
    border-bottom: 1px solid #cdcbcb;
  }
  input[type=text]{
    border-bottom: 1px solid #cdcbcb;
  }
 
  .pagination li{
        border: 1px solid #f3f3f3;
        border-radius: 0px;
  }
  .main-pagination .pagination li.disabled{
    padding: 3px 17px 7px 16px;
  }
  .pagination{
    float: right;
  }
  .pagination li a{
    font-size: 1rem;
    padding: 0 15px;
  }

 .pagination li.active{
  /*padding: 4px 13px 0px 15px;
  background-color: #2196f3;
  color: #fff;*/
    padding-left: 14px !important;
    padding-right: 14px !important;
    padding-top: 3px !important;
    background-color: #2196f3;
    color: #ffffff;
}
}
.timeline-left{
  float: left;
  width: 100%;
}
.bg-red{
  color: #2196f3;
}

.bg-yellow{
  float: left;font-size: 20px;
}
.time{
  float: right;
}
h3{
  font-size: 14px;
  line-height: 110%;
  margin: 0px;
}
.timeline-header a{
  padding-left: 10px;
}
.fa-clock-o{
  color: #2196f3;
}
li.disabled:hover{
  background: #ececec;
}
.pagination li:last-child:hover{
   background: #ececec;
}
.pagination li:first-child:hover{
   background: #ececec;
}
.main-pagination .pagination li{
  padding: 0px;
  border: 1px solid #e6e6e6;
  margin-bottom: 2px;
}
.timeline-header a{
   padding-left: 30px;
}
.timeline li{
  padding: 20px;border: 1px solid #e6e6e6;margin-bottom: 2px;
}
.one-line-width{
    float: left;width: 25%;padding-left: 21px;
}
.fa-calendar{
  color: #2196f3;
}
.btn{
  background-color: #2196f3;
}
.picker__month-display{
  float: left;font-size: 20px;padding-left: 50px;
}
.picker__day-display{
      float: left;font-size: 20px;padding-left: 45px;
}
.picker__year-display{
  font-size: 20px;color: #ffffff;
}
.select-wrapper input.select-dropdown{
  height: 2rem;
  border: 1px solid #e6e6e6;
  margin-top: 16px;
  padding: 2px;

}
.btn{
    margin-top: -2px;    
    height: 35px;
    width: 91%;
}
input[type=text]{
  margin-top: 15px;    
  height: 2rem;    
  padding: 2px;    
  border: 1px solid #e6e6e6;
}
</style>

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h4>
        
      </h4>
      <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home  / </a></li>
        <li class="active"> Log System</li>
      </ul>
    </section>
{{--     <input type="hidden" value="{{Auth::user()->api_token}}" name="token_user" />
 --}}    <section class="content">

      <div class="col-xs-12 border">
        <div class="box-header">
          <div class="row" style="padding-top: 4px;">
             {!! Form::open(['route' => 'search.log', 'files'=>true,  'method' => 'post']) !!}
                    <div class="col-xs-2 one-line-width" style="">
                      <div class=" form-group {{ $errors->has('user_name') ? ' has-error' : '' }} floating-select-div">
                    
                        {!!Form::select('user_name',App\Model\organization\User::userList(),@$req->user_name, ['class'=>'form-control','placeholder'=>'User Name']) !!}
                        @if($errors->has('user_name'))
                          <span class="help-block">
                                {{ $errors->first('user_name') }}
                          </span>
                        @endif
                      </div>
                  </div>
                    <div class="col-xs-2 one-line-width" style="padding-left: 25px;">
                      <div class="form-group">              
                        <div class="input-group date">
                          <div class="input-group-addon">
                           <!-- <i class="fa fa-calendar"></i> -->
                          </div> 
                       <div>
                       <input name="from" type="text" value="{{@$req->from}}" class="form-control pull-right datepicker" id="datepickerFrom"  placeholder="From Date"></div>
                       </div>
                      </div>                             
                    </div>
                    <div class="col-xs-2 one-line-width">
                      <div class="form-group">
                       <div class="input-group date">
                          <div class="input-group-addon">
                            <!-- <i class="fa fa-calendar"></i> -->
                          </div>
                          <input name="to" value="{{@$req->to}}" type="text" class="form-control pull-right datepicker" id="datepickerTo" placeholder="To Date">
                        </div>
                      </div>
                    </div>
                  <div class="col-xs-2 one-line-width" style="padding-top: 17px;">
                      {!! Form::submit('Search Log', ['class' => 'btn btn-primary']) !!}
                   </div>
                {!! Form::close() !!}
           </div>
        </div>
      </div>

    <section class="content">

      <!-- row -->
      <div class="row border-b4">
     
        <div class="col-md-12 timeline-left">
             

          <!-- The time line -->
          <ul class="timeline" style="margin-top: 0px;">
            <!-- timeline time label -->
    
            <div class="col l9 main-pagination">
              {{ $log->links() }}
            </div><br>        
             <?php $index=1; $date ='';  ?>
             @if(count($log)>0)
                 @foreach($log as $value)
                   @if(Carbon\Carbon::parse($value->created_at)->format('d M Y')!=$date)
                      <?php $date = Carbon\Carbon::parse($value->created_at)->format('d M Y'); ?>
                      <li class="time-label" style="border: none;padding: 0px;margin:0px;">
                        <div class="row" style="margin-bottom: 10px!important ;">
                          <div class="col l3" style=" border: 1px solid #e6e6e6;padding: 4px;">
                            <span class="bg-red">{{Carbon\Carbon::parse($value->created_at)->format('d M, Y') }}</span>
                          </div>
                         
                        </div>
                        

                      </li>
                    @endif
                    <li>
                      <?php $text = json_decode($value->text, true); ?>
                       @if(array_has($text,'query'))
                          <i class="fa fa-space-shuttle bg-aqua"></i>
                          @else
                           <i class="fa  fa-television bg-yellow"></i>
                        @endif
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 
                            <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($value->created_at))->diffForHumans() ?>
                          </span>

                      <h3 class="timeline-header no-border"><a class="tooltipped" data-position="top" data-delay="150" data-tooltip="({{@$text['email']}})" href="#">{{@$text['name']}} <span style="color:#999;" > <!-- ({{@$text['email']}}) --></span></a>
                       @if(array_has($text,'query'))

                           
                              @if(starts_with($text['query'], 'select'))
                              <span class="text-green"> Query Run SELECT
                                 <?php $arra = explode(' ',$text['query']);
                                       // print_r($arra);
                                        $key = array_search('from',$arra )+1;
                                        echo strtoupper(str_replace(['`',"_"]," ",$arra[$key]));
                                 ?>  
                                 </span>                                
                              @elseif(starts_with($text['query'], 'update'))
                               <div class="text-orange">Query Run  UPDATE 
                              <?php $arra = explode(' ',$text['query']);
                                       // print_r($arra);
                                        
                                        echo strtoupper(str_replace(['`',"_"]," ",$arra[1]));
                                 ?>
                                 @if(count($text['value']) >0)
                                   With value {{  implode(", ",$text['value']) }}
                                 @endif      
                               </div>
                              @endif
                                                  
                          @else 
                          <span class="text-light-blue">                       
                              @if($text['route']=="/")
                                  View  Dashboard
                              @else
                                has Access this route {{url($text['route'])}} 
                              @endif
                          </span>  
                        @endif
                    </h3>
                        </div>
                    </li>
                 

                   <?php $index++;?>
                @endforeach
              @else
              <li>
              <i class="fa fa-comments bg-yellow"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">No Result Found Try Again.</a> </h3>
              </div>
            </li>
             
              @endif
           
          </ul>
        </div>
        <!-- /.col -->
      </div>


      <!-- /.row -->

     
      <!-- /.row -->

    </section>
      </div>
         
    </section>

  </div>
  <script type="text/javascript">
    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year
     format: 'yyyy-mm-dd' 
  });
</script>
@endsection
