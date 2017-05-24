<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Category as CAT;
use App\Model\Organization\Designation As DES;
use App\Model\Organization\LeaveRule As LR;


class CategoryController extends Controller
{
    public function index(){
      $data = CAT::all();
      
      $designation = DES::where('status',1)->pluck('name','id');
      $designation_day =  LR::where('status',1)->get();
    	return view('organization.category.list_category',['data'=>$data , 'designation'=> $designation]);
   }
  
   public function save(Request $request)
   {
      $cat = new CAT();
      $cat->fill($request->all());
      $cat->type = "leave";
      $cat->save();

     return redirect()->route('leave.categories');
   }
   public function update(Request $request)
   {
       $cat =  CAT::find($request->id);
       if($request['status'] == 'true')
         {
            $request['status'] =1;
         }
      else if($request['status'] == 'false')
      {
                $request['status'] =0;
      }
      $cat->fill($request->all());
      $cat->save();

   }
   public function leave_rule(Request $request)
   {
      foreach ($request->designation_id as $key => $value) {
        $insert = ['designation_id'=>$value , 'leave_category_id'=>$request['leave_category_id'] , 'days'=>$request['days'][$key],'status'=>1];
        $condition = LR::where(['designation_id'=>$value , 'leave_category_id'=>$request['leave_category_id']]);
        if($condition->count() > 0)
        {
          $lr =  LR::find($condition->first()->id);
        }else{
          $lr = new LR();
        }
        $lr->fill($insert);
        $lr->save();
      }
        return redirect()->route('leave.categories');

   }
   public function delete($id)
   {
      
   } 
}
