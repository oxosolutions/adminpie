<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\User;
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
      // dump($model);
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
		Salary::find($id)->delete();
		return back();
	}
	public function view_salary_slip($id ){
			$salary = Salary::with(['user_detail.belong_group:id,name,email', 'user_detail:id,user_id'])->where([ 'id'=>$id ]);
      if($salary->exists()){
        $salary = $salary->first();
      }else{
        Session::flash('error','Not Valid ID.');
      }
			return view('organization.salary.generate_salary_slip',compact('salary'));
	}
	public function salary_download_pdf($id){
		$salary = Salary::with(['user_detail.belong_group:id,name,email', 'user_detail:id,user_id'])->where([ 'id'=>$id ]);
      if($salary->exists()){
        $salary = $salary->first();
        $file_name =  'pay-slip-'.$salary->employee_id.'-'.$salary->year.'-'.$salary->month;
      }else{
        Session::flash('error','Not Valid ID.');
      }
      $pdf = PDF::loadView('organization.salary.pdf',compact('salary'));
            return $pdf->download($file_name.'.pdf');
			  // return view('organization.salary.pdf',compact('salary'));

	}
	public function generate_salary_slip_view(Request $request){
			$date = Carbon::now();
			$date->subMonth();
			$data['month'] = 	$month 	= $date->month;
			$data['year'] 	=  	$year 	= $date->year;
			if($request->isMethod('post')){
         $this->validate($request,['year'=>'required', 'month'=>'required']);
				if($year == $request['year'] && $month <  $request['month']){
					Session::flash('error', "you can't generate salary slip of future month's.");
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
 			}else{
				$date = Carbon::now();
				$date->subMonth();
				$data['month'] = 	$month 	= $date->month;
				$data['year'] 	=  	$year 	= $date->year;
			}
     
      $data['users']  = User::with(['belong_group',
        'salary'=>function($q)use($year, $month){
                      $q->where(['year'=>$year, 'month'=>$month]);  
                    }, 
                  'metas'=>function($query)use($year, $month){
                    $query->whereIn('key', [ 'date_of_joining' ,  'user_shift',   'department',  'designation', 'employee_id' , 'pay_scale']);
                        }])->orWhereHas(
                            'metas', function ($query)use($year, $month) {
                        $query->where('key','date_of_joining')->whereYear('value', '=', $year)->whereMonth('value','<=', $month);
                        }
                  )->where(['user_type'=>'employee'])->get();

              // $data['users']  = User::with(['belong_group',
              //         'salary'=>function($q)use($year, $month){
              //                       $q->where(['year'=>$year, 'month'=>$month]);  
              //                     }, 
              //                   'metas'=>function($query)use($year, $month){
              //                     $query->whereIn('key', [ 'date_of_joining' ,  'user_shift',   'department',  'designation', 'employee_id' , 'pay_scale']);
              //                         }])->orWhereHas(
              //                             'metas', function ($query)use($year, $month) {
              //                         $query->where('key','date_of_joining')->whereYear('value', '=', $year)->whereMonth('value','<=', $month);
              //                         }
              //                   )->where(['user_type'=>'employee'])->get();

	   	return view('organization.salary.generate_salary_slip_view', compact('data'));
	}

  	public function generate_salary_slip($year , $month, $user_select){
  			
        $user = User::with(['belong_group', 'metas'=>function($query){
            $query->whereIn('key', [ 'date_of_joining' ,  'user_shift',   'department',  'designation', 'employee_id' , 'pay_scale']);
          }])->whereIn('id',$user_select)->where(['user_type'=>'employee'])->get();
        $current_date = Carbon::parse("$year-$month-1");
        // $current_date->subMonth(); 
        $daysInMonth = $current_date->daysInMonth;
        $holiday = Holiday::WhereYear('date_of_holiday', $year)->whereMonth('date_of_holiday',$month)->count();
        foreach ($user as $userKey => $userValue) {
          $meta = $userValue['metas']->mapWithKeys(function($item){
            return [$item['key'] => $item['value']];
          });
          if(isset($meta['employee_id'])){
            if(strlen($month) ==1){
              $month = '0'.$month;
            }
            if(empty($meta['pay_scale'])){
            	$payScale_error[] = $meta['employee_id'];
            }else{
	             $payScale =  Payscale::where('id',$meta['pay_scale'])->whereNotNull('total_salary')->first();
	             if(empty($payScale)){
	               $payScale_error[] = $meta['employee_id'];
	             }
         	}

            $attendance_data = Attendance::where(['employee_id'=>$meta['employee_id'], 'year'=>$year, 'month' =>$month])->get();

              if($attendance_data->count()>0){
                if(empty($payScale)){
                     $payScale_error[] = $meta['employee_id'];
                }else{
                    $loss_of_pay_days = $attendance_data->where('attendance_status','LP')->count();
                    $data[$userKey]['employee_id'] = $meta['employee_id'];
                    $data[$userKey]['user_id'] = $userValue['id'];
                    $data[$userKey]['department'] = $meta['department'];
                    $data[$userKey]['designation'] = $meta['designation'];
                    $data[$userKey]['shift'] = $meta['user_shift'];
                    $data[$userKey]['id'] = $userValue['id'];
                    // $payScale =  Payscale::where('id',$meta['pay_scale'])->first();
                    $data[$userKey]['total_salary'] = $total_salary = $payScale['total_salary']; 
                    $data[$userKey]['per_day_amount'] = $per_day =  number_format($total_salary/30, 2,'.', '');
                    // $attendance_data->where('attendance_status','present')->count();
                    $data[$userKey]['payscale'] = json_encode( $payScale );
                    $data[$userKey]['year'] = $year;
                    $data[$userKey]['month'] = $month;
                    $data[$userKey]['absent'] = $attendance_data->where('attendance_status','absent')->count();
                    $data[$userKey]['number_of_attendance'] = $attendance_data->where('attendance_status','present')->count();
                    $data[$userKey]['sundays'] = $sunday = $attendance_data->where('day','Sunday')->count();
                    $data[$userKey]['holiday'] = $holiday;
                    $data[$userKey]['working_days'] =  $working_days = $daysInMonth - $sunday - $holiday;
                    $data[$userKey]['dedicated_amount'] = $loss_of_pay_days *  $per_day; //($working_days - $data[$userKey]['number_of_attendance']) * $per_day;
                    $data[$userKey]['total_days'] = $daysInMonth;
                    if($data[$userKey]['number_of_attendance'] ==0){
                       $data[$userKey]['salary'] = 0;   
                    }else{
                      $data[$userKey]['salary'] = $data[$userKey]['total_salary'] - $data[$userKey]['dedicated_amount'];
                    }
                }
              }else{
                  $error[] = $meta['employee_id'];
              }
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
          // $payScale_error =  implode(', ', $payScale_error );
          Session::flash('error_payscale', $payScale_error);
        }

        if(!empty($error)){
          // $employee =  implode(', ', $error );
          Session::flash('error_attendance', $error);
        }

return back();
        
     //  $date = carbon::parse('2017-1-1');
     //  $data['month'] =  $date->month;
     //  $data['days_in_month'] =  $date->daysInMonth;
     //  $data['holiday'] = $holiday = Holiday::whereMonth('date_of_holiday',$date->month)->count();
     //  $leave_data =  Leave::where(['employee_id'=>$meta['employee_id']])->get();
     // dump($leave_data , $date->month ,  $holiday);
     // $data['working_days'] = $date->daysInMonth - $sunday - $holiday;
     // $data['dedicated_amount'] =  ($data['working_days'] - $data['present']) * $data['per_day'];
     // $data['salary'] = $data['total_salary'] - $data['dedicated_amount'];
     //  return view('organization.salary.generate_salary_slip',['data'=>$data]);
       
     
      //   $user = User::with(['belong_group', 'metas'=>function($query){
      //       $query->whereIn('key', [ 'date_of_joining' ,  'user_shift',   'department',  'designation', 'employee_id' , 'pay_scale']);
      //     }])->where(['id'=>24, 'user_type'=>'employee'])->first();
        
      //   $meta = $user['metas']->mapWithKeys(function($item){
      //     return [$item['key'] => $item['value']];
      //   });

      //   $payScale =  Payscale::where('id',$meta['pay_scale'])->first();
      //   $data['total_salary'] = $total_salary = $payScale['total_salary']; 
      //   $data['per_day'] = $per_day =  number_format($total_salary/30, 2,'.', '');

      // if(isset($meta['employee_id'])){
      //   $attendance_data = Attendance::where(['employee_id'=>$meta['employee_id'], 'year'=>2017, 'month' =>01])->get();
      //   $data['absent'] = $attendance_data->where('attendance_status','absent')->count();
      //   $data['present'] = $attendance_data->where('attendance_status','present')->count();
      //   $data['sundays'] = $sunday = $attendance_data->where('day','Sunday')->count();
      // }
      // $date = carbon::parse('2017-1-1');
      // $data['month'] =  $date->month;
      // $data['days_in_month'] =  $date->daysInMonth;
      // $data['holiday'] = $holiday = Holiday::whereMonth('date_of_holiday',$date->month)->count();
      // $leave_data =  Leave::where(['employee_id'=>$meta['employee_id']])->get();
      //  dump($leave_data , $date->month ,  $holiday);
      //  $data['working_days'] = $date->daysInMonth - $sunday - $holiday;
      //  $data['dedicated_amount'] =  ($data['working_days'] - $data['present']) * $data['per_day'];
      //  $data['salary'] = $data['total_salary'] - $data['dedicated_amount'];
      //   return view('organization.salary.generate_salary_slip',['data'=>$data]);


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
		// dump($meta_collection = collect($user_data[0]['get_user_meta']));
    //   $meta_key_value =  $meta_collection->mapWithKeys(function($item){
    //     return  [$item['key'] => $item['value']];
    //   });

    // dump($meta_key_value);


		$salary_data =[];
		if($request->isMethod('post')){
        // dump($request->all());
        $month_year_request  = '0'.$request['month'].'-'.$request['year'];
        // dump($month ,  '0'.$request['month'] , $year , $request['year']);

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
            // dump($metas);

            if(empty($metas['employee_id'])){
              continue;
            }
            if($request['year'] == date('Y',strtotime($metas['date_of_joining'])) && $request['month'] == date('m',strtotime($metas['date_of_joining'])) ){
                $length_of_month = cal_days_in_month(CAL_GREGORIAN, $request['month'], $request['year']);
                $date_of_joining = strtotime($metas['date_of_joining']);
                $end_date_of_month = strtotime($request['year'].'-'.$request['month'].'-'.$length_of_month);
                $datediff = $end_date_of_month - $date_of_joining;
                $total_days = floor($datediff / (60 * 60 * 24));
                // dump($value['payscale']['total_salary']);
                $value['payscale']['total_salary'] = ceil(($value['payscale']['total_salary']/30*$total_days));
               
            }
            if(!empty($metas['date_of_leaving']) && $request['year'] == date('Y',strtotime($metas['date_of_leaving'])) && $request['month'] == date('m',strtotime($metas['date_of_leaving'])) ){
                 $date_of_leaving = strtotime($metas['date_of_leaving']);
                $start_date_of_month = strtotime($request['year'].'-'.$request['month'].'-1');
                $datediff = $date_of_leaving - $start_date_of_month;
                $total_days = floor($datediff / (60 * 60 * 24));
                // dump($total_days , $value['payscale']['total_salary']);
                $value['payscale']['total_salary'] = ceil(($value['payscale']['total_salary']/30*$total_days));
                // dump($value['payscale']['total_salary']);

                
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
