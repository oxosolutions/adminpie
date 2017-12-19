<?php

namespace App\Http\Controllers\Organization\project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Organization\Todo as TD;
use Auth;

class TodoController extends Controller
{
	public function create(Request $request)
	{

		$model = new TD;
		$model->fill($request->except('_token','user_id'));
    	$model->description = "please enter some description";
    	$model->user_id = $request->user_id;
			if($request->project_id != null || $request->project_id != "" || !empty($request->project_id) ){
				$model->project_id = $request->project_id;
				$model->save();
				$data = TD::where('project_id',$request->project_id)->get();
			}else{
		        $model->project_id = "0";
		        $model->save();
		        $data = TD::where('user_id',Auth::guard('org')->user()->id)->get();
			}
        return view('organization.project._todo_list',['model'=>$data])->render();
	}
	public function listTodo(Request $request ,$id = null)
	{
		$plugins = ['js' => ['custom'=>['todo']]];
		if($request->id != null || $request->id != "" || !empty($request->id) ){
			$model = TD::where('project_id',$request->id)->get();
		}else{
			$model = TD::where('user_id',Auth::guard('org')->user()->id)->get();
		}

        return view('organization.project._todo_list',['model'=>$model])->render();
	}
	private function edit_status($id){
		$model = TD::where('id',$id)->first();
		if($model->status == (int)'1'){
			TD::where('id',$id)->update(['status'=> (int)'0']);
		}else{
			TD::where('id',$id)->update(['status'=> (int)'1']);
		}
		return 'true';
	}
	public function edit(Request $request)
	{
		$id = $request->id;
		if (count($request->all()) == 2) {
			$this->edit_status($id);
			
		}else{

			$data =[
						'title' => $request->title,
						'description' => $request->description,
						'priority' => $request->priority
					];
				TD::where('id',$id)->update($data);
				return 'true';
		}
	}
	
	public function delete(Request $request){
		$id = $request->id;
		TD::where('id',$id)->delete();
	}
	public function filterData(Request $request)
	{
		$data[] = '';
		if(array_key_exists('categories', $request->value)){
			if(array_key_exists('categories', $request->value)){
				if($request->value['project_id'] == null){
					if($request->value['categories'] == "all"){
						$model = TD::where('user_id' , $request->value['user_id'])->get();
					}elseif($request->value['categories'] == "completed"){
						$model = TD::where(['status'=>(int)'0' , 'user_id' => $request->value['user_id']])->get();
					}elseif($request->value['categories'] == "in-completed"){
						$model = TD::where(['status'=>(int)'1' , 'user_id' => $request->value['user_id']])->get();
					}
				}else{
					if($request->value['categories'] == "all"){
						$model = TD::where(['user_id'=>$request->value['user_id'],'project_id' => $request->value['project_id']])->get();
					}elseif($request->value['categories'] == "completed"){
						$model = TD::where(['status'=>(int)'0' , 'user_id' => $request->value['user_id'] , 'project_id' => $request->value['project_id']])->get();
					}elseif($request->value['categories'] == "in-completed"){
						$model = TD::where(['status'=>(int)'1' , 'user_id' => $request->value['user_id'], 'project_id' => $request->value['project_id']])->get();
					}
				}
				
			}
		}
			if(array_key_exists('priority', $request->value)){
				if($request->value['project_id'] == null){
					$model = TD::where(['priority'=>$request->value['priority'] , 'user_id' => $request->value['user_id']])->get();
				}else{
					$model = TD::where(['priority'=>$request->value['priority'] , 'user_id' => $request->value['user_id'] , 'project_id' => $request->value['project_id']])->get();
				}
				
			}
		return view('organization.project._todo_list',['model'=>$model])->render();
	}
}