<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\User;
use App\Model\Organization\UsersMeta;
use App\Model\Organization\Payscale;
use App\Model\Organization\Salary;
use Session;

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
            $perPage = 5;
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
      dump($model);
      $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['user_id'=>'Id', 'user.name'=>'Name','payscale.title'=>'Pay Scale' ,'created_at'=>'Created At'],
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
                  // dd($datalist);
      return view('organization.designation.list_designation',$datalist)->with(['data' => $data]);

		$data = UsersMeta::with(['user','payscale'])->where('key','pay_scale')->get();
		return view('organization.profile.salary', compact('data'));
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
            $perPage = 5;
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
			 // dd($request->all();
		}

     $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['employee_id'=>'Id', 'amount'=>'Name' ,'payscale_id'=>'Payscale title','created_at'=>'Created At'],
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
