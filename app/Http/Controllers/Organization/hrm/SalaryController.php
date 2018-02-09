<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\User;
use App\Model\Group\GroupUsers;
use App\Model\Organization\UsersMeta;
use App\Model\Organization\Payscale;
use App\Model\Organization\Salary;
use Session;
// use App\Model\Organization\EmployeeLeave as Leave;
use App\Model\Organization\Attendance;
use App\Model\Organization\Holiday;
use App\Model\Organization\Leave;
use Carbon\carbon;
use PDF;
class SalaryController extends Controller
{
/**
 * { edit Salary  }
 *
 * @param      <int>   $id     Salaray Id
 *
 * @return     <type>  ( to view  )
 * @author Paljinder Singh
 */
  public function edit($id){
    $salary_data = Salary::where([ 'id'=>$id ]);
    if($salary_data->exists()){
      $data = $salary_data->first();
    }else{
      Session::flash('error',"Salary not exist's.");
      return back();
    }
    return view('organization.salary.edit',compact('data'));
  }
  public function update(Request $request){
    Salary::where('id',$request['id'])->update($request->except('_token'));
    return redirect()->route('salary.slip.view',['id'=>$request['id']]);
  }
  public function drop_downs()
  {
    return view('organization.salary.drop_down');
  }
	public function index(Request $request )
	{
      $datalist= [];
      $data= [];
      if($request->has('items')){
            $perPage = $request->items;
            if($perPage == 'all'){
              $perPage = 999999999999999;
            }
          }else{
            $perPage = get_items_per_page();;
          }
      $sortedBy = @$request->orderby;
      if($request->has('search')){
          if($sortedBy != ''){
              $model = UsersMeta::with(['user','payscale'])->where('key','pay_scale')->where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
          }else{
              $model = UsersMeta::with(['user','payscale'])->where('key','pay_scale')->where('name','like','%'.$request->search.'%')->paginate($perPage);
          }
      }else{
          if($sortedBy != ''){
              $model = UsersMeta::with(['user','payscale'])->where('key','pay_scale')->orderBy($sortedBy,$request->order)->paginate($perPage);
          }else{
               $model = UsersMeta::with(['user','payscale'])->where('key','pay_scale')->paginate($perPage);
          }
      }
     
      $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['user_id'=>'Id', 'user.name'=>'Name','payscale.title'=>'Pay Scale' ,'created_at'=>'Created'],
                      'actions' => [
                                      'edit' => ['title'=>'Edit','route'=>'designations' , 'class' => 'edit'],
                                      'delete'=>['title'=>'Delete','route'=>'delete.designation']
                                   ],
                      'js'  =>  ['custom'=>['list-designation']],
                      'css'=> ['custom'=>['list-designation']]
                  ];
    // if(!empty($id) || $id != null || $id != ''){
    //   $data['data'] = DES::where('id',$id)->first();
    // }
      return view('organization.designation.list_designation',$datalist)->with(['data' => $data]);

		$data = UsersMeta::with(['user','payscale'])->where('key','pay_scale')->get();
		return view('organization.profile.salary', compact('data'));
	}
	public function delete_salary_slip($id){
		  Salary::where('id',$id)->delete();
		    return back();
	}
  /**
  view_salary_slip
  @description  for view indiviual employee with all detail
  @parm id
  @author PaljinderSingh 
  */
	public function view_salary_slip($id ){
			$salary = Salary::with(['user_detail:id,name,email','user_detail.metas'])->where([ 'id'=>$id ]);
      if($salary->exists()){
        $salary = $salary->first();
      }else{
        Session::flash('error','Not Valid ID.');
      }
			return view('organization.salary.generate_salary_slip',compact('salary'));
	}
	public function salary_download_pdf($id){
		$salary = Salary::with(['user_detail:id,name,email'])->where([ 'id'=>$id ]);
      if($salary->exists()){
        $salary = $salary->first();
        $file_name =  'pay-slip-'.$salary->employee_id.'-'.$salary->year.'-'.$salary->month;
      }else{
        Session::flash('error','Not Valid ID.');
      }
      // return view('organization.salary.pdf',compact('salary'));
      $pdf = PDF::loadView('organization.salary.pdf',compact('salary'));
      return $pdf->download($file_name.'.pdf');
		}
	public function generate_salary_slip_view(Request $request) {

			$date = Carbon::now();
			$date->subMonth();
			$data['month'] = 	$month 	= $date->month;
			$data['current_year'] = $data['year']  =  $year 	= $date->year;
			if($request->isMethod('post')){
         $this->validate($request,['year'=>'required', 'month'=>'required']);
				if($year == $request['year'] && $month <  $request['month']){
					Session::flash('error', "you can't view & generate salary slip of Current & future month's.");
					return back();
				}
				$data['year'] 	=  	$year 	 = $request['year'];
				$data['month'] = 	$month 	=  $request['month'];
        if(strlen($month)==1){
          $data['month'] = $month = '0'.$month;
        }
        if($request->has('generate_salary')){
          if(!empty($request['user_select'])){
            $this->generate_salary_slip($year , $month, $request['user_select']);
          }else{
            Session::flash('error','Employee must be select to generate salary slip.');
          }
        }
 			}
       if(strlen($month)==1){
          $data['month'] = $month = '0'.$month;
        }
      $data['users']  = GroupUsers::with( ['organization_employee_user', 'salary'=>function($q)use($year, $month){
                      $q->where(['year'=>$year, 'month'=>$month]);  
                    }, 'metas'=>function($query)use($year, $month){
                          $query->whereIn('key', [ 'date_of_joining', 'date_of_leaving' ,  'user_shift',   'department',  'designation', 'employee_id' , 'pay_scale']);
                         }] )->whereHas('organization_employee_user')->orWhereHas('metas', function ($query)use($year, $month) {
                                $query->where('key','date_of_joining')->whereYear('value', '=', $year)->whereMonth('value','<=', $month);
                         })->get();
	   	return view('organization.salary.generate_salary_slip_view', compact('data'));
	}

  public function generate_salary_slip($year , $month, $user_select){
        $user = GroupUsers::with(['metas'=>function($query){
            $query->whereIn('key', [ 'date_of_joining' ,  'user_shift',   'department',  'designation', 'employee_id' , 'pay_scale']);
          }])->whereIn('id',$user_select)->get();
        foreach ($user as $userKey => $userValue) {
          $meta = $userValue['metas']->mapWithKeys(function($item){
            return [$item['key'] => $item['value']];
          });
          if(isset($meta['employee_id'])){
            $have_not_employee_id[] = 
            continue;
          }
            if(strlen($month) ==1){
              $month = '0'.$month;
            }
            if(empty($meta['pay_scale'])){
            	$payScale_error[] = $meta['employee_id'];
              continue;
            }else{
	             $payScale =  Payscale::where('id',$meta['pay_scale'])->whereNotNull('total_salary')->first();
	             if(empty($payScale)){
	               $payScale_error[] = $meta['employee_id'];
                  continue;
	             }
         	}
        if(!Salary::where(['employee_id'=>$meta['employee_id'], 'year'=>$year, 'month' =>$month])->exists()){
            $attendance_data = Attendance::where(['employee_id'=>$meta['employee_id'], 'year'=>$year, 'month' =>$month])->get();

              if($attendance_data->count()>0){
                if(empty($payScale)){
                    $payScale_error[] = $meta['employee_id'];
                }else{
                 $lock_status =  $this->attendance_lock_check($attendance_data);
                 if($lock_status == false){
                  $unlock_error[] = $meta['employee_id'];
                  continue;
                 }
                  $data = $this->set_parm_for_insert_salary($attendance_data , $userKey , $meta, $userValue['id'] , $payScale, $year, $month);
                 if(empty($data)){
                   $error[] = $meta['employee_id'];
                   continue;
                 }

                }
              }else{
                  $error[] = $meta['employee_id'];
              }
          }else{
                 $already_generate[] = $meta['employee_id'];
                }
        
        if(isset($data[$userKey])){
            $salarys = new Salary();
            $salarys->fill($data[$userKey]);
            $salarys->save();
          $success[] = $meta['employee_id'];
          }

        }

        if(!empty($success)){
         Session::flash('salary_successfully_generate',$success);
        }
        if(!empty($payScale_error)){
          $payScale_error = array_unique($payScale_error);
          Session::flash('error_payscale', $payScale_error);
        }
        if(!empty($unlock_error)){
          $unlock_error = array_unique($unlock_error);
          Session::flash('unlock_error', $unlock_error);
        }
        if(!empty($already_generate)){
          $already_generate = array_unique($already_generate);
          Session::flash('already_generate', $already_generate);
        }

        if(!empty($error)){
          Session::flash('error_attendance', $error);
        }
      return back();
  }
  protected function attendance_lock_check($attendance_data){
     $status = $attendance_data->every(function ($item, $key) {
          return $item->lock_status =0;
    });
   return $status;
  }
protected function set_parm_for_insert_salary($attendance_data, $userKey, $meta, $user_id, $payScale,$year, $month){
    $attendant_days_in_month = $attendance_data->whereNotIn('shift_hours',[null])->whereNotIn('punch_in_out',[null])->count();
    if($attendant_days_in_month<1){
      return;
    }
    $no_mark_deduction = $no_mark_attendance = $loss_of_pay_days = $due_min = $min = $extra_hours = $due_hours = 0;
    $total_salary = $payScale['total_salary']; 
    $per_day =  number_format($total_salary/30, 2,'.', '');
    $per_min_salary = $per_day/8/60;
    $current_date = Carbon::parse("$year-$month-1");
    $daysInMonth = $current_date->daysInMonth;
    $holiday = Holiday::WhereYear('date_of_holiday', $year)->whereMonth('date_of_holiday',$month)->count();
    $working_days_in_month = $attendance_data->whereNotIn('shift_hours',[null])->count();
    $loss_of_pay_days = $attendance_data->whereIn('attendance_status',['lop','absent'])->whereNotIn('shift_hours',[null])->count();
    $leaves_in_month = $attendance_data->whereIn('attendance_status',['leave'])->whereNotIn('shift_hours',[null])->count();
    $due_time = $attendance_data->where('over_time' ,'<', 0)->sum('over_time');
    $extra_time = $attendance_data->where('over_time' ,'>', 0)->sum('over_time');

    $total_attendant_days = $attendant_days_in_month  +  $leaves_in_month + $holiday + $loss_of_pay_days;
    if($working_days_in_month > $total_attendant_days)
    {
      $no_mark_attendance = $working_days_in_month - $total_attendant_days;
      $no_mark_deduction = $no_mark_attendance * $per_day;
    }
// dump('no_mark_attendance',  $no_mark_attendance);
    if($due_time){
        $replace_minus = str_replace('-', '',$due_time );
        $due_min =  $replace_minus/60;
        $due_hours = $this->convertToHoursMins($due_min);
      } 
    if($extra_time){
      $min =  $extra_time/60;
      $extra_hours = $this->convertToHoursMins($min);
    }
    
    $data[$userKey]['employee_id'] = $meta['employee_id'];
    $data[$userKey]['user_id'] = $user_id;
    $data[$userKey]['department'] = $meta['department'];
    $data[$userKey]['designation'] = $meta['designation'];
    $data[$userKey]['shift'] = $meta['user_shift'];
    $data[$userKey]['id'] = $user_id;
    $data[$userKey]['total_salary'] = $total_salary;
    $data[$userKey]['per_day_amount'] = $per_day;
   
    $data[$userKey]['over_time']    = $min * $per_min_salary;
    $data[$userKey]['short_hours']  = $due_min * $per_min_salary;
    $data[$userKey]['payscale'] = json_encode( $payScale );
    $data[$userKey]['year'] = $year;
    $data[$userKey]['month'] = $month;
    $data[$userKey]['absent'] = $loss_of_pay_days;
    $data[$userKey]['number_of_attendance'] = $attendant_days_in_month;
    $data[$userKey]['sundays'] = $sunday = $attendance_data->where('day','Sunday')->count();
    $data[$userKey]['holiday'] = $holiday;
    $data[$userKey]['working_days'] =  $working_days_in_month;
    if($loss_of_pay_days>0){
      $data[$userKey]['dedicated_amount'] = $loss_of_pay_days *  $per_day; 
    }else{
      $data[$userKey]['dedicated_amount'] =0;
    }
    $data[$userKey]['total_days'] = $working_days_in_month;
    if($data[$userKey]['number_of_attendance'] ==0){
       $data[$userKey]['salary'] = 0;   
    }else{
        $data[$userKey]['salary'] = $data[$userKey]['total_salary'] + $data[$userKey]['over_time'] - $data[$userKey]['short_hours'] -$data[$userKey]['dedicated_amount'] - $no_mark_deduction;
    }
    return $data;
}

protected function calculation_salary(){
    // $data[$userKey]['over_time']    = $min * $per_min_salary;
    // $data[$userKey]['short_hours']  = $due_min * $per_min_salary;
}

  protected function convertToHoursMins($time, $format = '%02d:%02d') {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}
	public function generate_salary(Request $request){

    $current_dates = date('Y-m-d');
    $year = date('Y');
    $month = date('m');
    $model =  Salary::where([ 'year'=>$year, 'month'=>$month])->get();

    $datalist= [];
    $data= [];
      if($request->has('items')){
            $perPage = $request->items;
            if($perPage == 'all'){
              $perPage = 999999999999999;
            }
          }else{
            $perPage = get_items_per_page();;
          }
      $sortedBy = @$request->orderby;
      if($request->has('search')){
          if($sortedBy != ''){
              $model = Salary::where([ 'year'=>$year, 'month'=>$month])->where('month','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
          }else{
              $model = Salary::where([ 'year'=>$year, 'month'=>$month])->where('month','like','%'.$request->search.'%')->paginate($perPage);
          }
      }else{
          if($sortedBy != ''){
              $model = Salary::where([ 'year'=>$year, 'month'=>$month])->orderBy($sortedBy,$request->order)->paginate($perPage);
          }else{
               $model = Salary::where([ 'year'=>$year, 'month'=>$month])->paginate($perPage);
          }
      }
		$user_data = UsersMeta::with(['user','payscale'])->where('key','pay_scale')->get()->toArray();
		
    //   $meta_key_value =  $meta_collection->mapWithKeys(function($item){
    //     return  [$item['key'] => $item['value']];
    //   });

    


		$salary_data =[];
		if($request->isMethod('post')){
        
        $month_year_request  = '0'.$request['month'].'-'.$request['year'];
        

      if(strlen($request['month'])==1)
      {
        $request['month'] = '0'.$request['month'];
      }
      
      if(!empty($request['generate']))
      {
         if($request['year'] > $year){
                $error = 'year greater';
                 Session::flash('error','Only past year & month salary generated');
         }elseif($request['year'] == $year && ( $request['month'] >= $month)){
                $error = 'month & equal greater';
               Session::flash('error','Only past year & month salary generated');
         }

       if(empty($error)){
  				foreach ($user_data as $key => $value) {
  					$uid = $value['user_id'];
            $metas =  get_user_meta($uid, null, $array = false);
            // echo "metas";
            

            if(empty($metas['employee_id'])){
              continue;
            }
            if($request['year'] == date('Y',strtotime($metas['date_of_joining'])) && $request['month'] == date('m',strtotime($metas['date_of_joining'])) ){
                $length_of_month = cal_days_in_month(CAL_GREGORIAN, $request['month'], $request['year']);
                $date_of_joining = strtotime($metas['date_of_joining']);
                $end_date_of_month = strtotime($request['year'].'-'.$request['month'].'-'.$length_of_month);
                $datediff = $end_date_of_month - $date_of_joining;
                $total_days = floor($datediff / (60 * 60 * 24));
                
                $value['payscale']['total_salary'] = ceil(($value['payscale']['total_salary']/30*$total_days));
               
            }
            if(!empty($metas['date_of_leaving']) && $request['year'] == date('Y',strtotime($metas['date_of_leaving'])) && $request['month'] == date('m',strtotime($metas['date_of_leaving'])) ){
                 $date_of_leaving = strtotime($metas['date_of_leaving']);
                $start_date_of_month = strtotime($request['year'].'-'.$request['month'].'-1');
                $datediff = $date_of_leaving - $start_date_of_month;
                $total_days = floor($datediff / (60 * 60 * 24));
                $value['payscale']['total_salary'] = ceil(($value['payscale']['total_salary']/30*$total_days));

                
              }
  						 $request['employee_id'] = $metas['employee_id'];
               $request['monthly_weekly'] = 'monthly';
  						 $request['payscale_id'] = $value['payscale']['id'];
  						 $request['payscale'] = json_encode($value['payscale']);
  						 $request['amount'] = $value['payscale']['total_salary'];
  						 if(!Salary::where(['employee_id'=>$metas['employee_id'], 'year'=>$request['year'], 'month'=>$request['month']])->exists()){
  							 $salary = new Salary();
  							 $salary->fill($request->all());
  							 $salary->save();
  						 }
  					
  				}
			}
    }
		$salary_data =	$model =	Salary::where([ 'year'=>$request['year'], 'month'=>$request['month']])->paginate($perPage);
		}

     $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['employee_id'=>'Id', 'amount'=>'Name' ,'payscale_id'=>'Payscale title','created_at'=>'Created'],
                      'actions' => [
                                      'edit' => ['title'=>'Edit','route'=>'designations' , 'class' => 'edit'],
                                      'delete'=>['title'=>'Delete','route'=>'delete.designation']
                                   ],
                      'js'  =>  ['custom'=>['list-designation']],
                      'css'=> ['custom'=>['list-designation']]
                  ];
    // return view('organization.salary.listing',$datalist)->with(['data' => $data]);

      return view('organization.salary.listing',compact('salary_data'));
	}

}
