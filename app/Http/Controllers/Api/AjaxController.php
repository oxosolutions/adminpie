<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    public function handle(Request $request){
        if($request->has('method')){
            call_user_func_array($request->method, $request->params_array);
        }else{
            return response()->json(['error'=>'Required parameters are missing!'],500);
        }
    }
}
