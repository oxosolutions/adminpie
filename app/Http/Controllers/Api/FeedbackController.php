<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\appFeedback;
use Session;

class FeedbackController extends Controller
{
    public function complaintAppResponce(Request $request)
    {
    	$rules = [
    			'org_id' => 'required',
    			'name' => 'required',
    			'mobile' => 'required',
    			'department' => 'required',
    			'message' => 'required'
    		];
    	$this->validate($request , $rules);
        if( $request->token == '0)9(8*7&6^5%'){
        	Session::put('organization_id',$request->org_id);
        	$model = new appFeedback;
        	$model->fill($request->all());
        	$model->save(); 
        	if($model){
                return response()->json(["success"=>['status'=>'success', "title"=> "Success", 'message'=>"Your Message has Posted Successfully."]],200);
        	}else{
                return response()->json(["errors"=>['status'=>'error', "title"=> "Something Went Wrong", 'message'=>"Something Went Wrong."]],500);
        	}
        }
    }
}
