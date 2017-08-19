<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\User;
use App\Model\Organization\UsersMeta;
use App\Model\Organization\Payscale;
use App\Model\Organization\Salary;

class SalaryController extends Controller
{
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
		$user_data = UsersMeta::with(['user','payscale'])->where('key','pay_scale')->get()->toArray();

		dump($user_data);
		if($request->isMethod('post')){
			foreach ($user_data as $key => $value) {
				$uid = $value['user_id'];
				if(!empty($empid = get_user_meta($uid, $key = 'employee_id', $array = false))){

					 $request['employee_id'] = $empid;
					 $request['$request'] = 'monthly';
					 $request['payscale'] = json_encode($value['payscale']);
					 $request['amount'] = $value['payscale']['total_salary'];
					 if(!Salary::where(['employee_id'=>$empid, 'month'=>$request['month']])->exists()){
						 $salary = new Salary();
						 $salary->fill($request->all());
						 $salary->save();
					 }
				}
			}
			dd($request->all());
		}
      return view('organization.salary.listing');
	}

}
