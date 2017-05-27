<?php

namespace App\Http\Controllers\Organization\project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Organization\Todo as TD;

class TodoController extends Controller
{
	public function create(Request $request)
	{
		$model = new TD;
        $model->fill($request->except('_token'));
        $model->description = "manually entered from controller";
        $model->save();

        $model = TD::all();
        return view('organization.project._todo_list',['model'=>$model])->render();
	}
	public function list()
	{
		$model = TD::all();

        return view('organization.project._todo_list',['model'=>$model])->render();
	}
	private function edit_status($id){
		$model = TD::where('id',$id)->first();
		if($model->status == (int)'1'){
			TD::where('id',$id)->update(['status'=> (int)'0']);
		}else{
			TD::where('id',$id)->update(['status'=> (int)'1']);
		}
	}
	public function edit(Request $request)
	{
		$id = $request->id;
		if (count($request->all()) == 2) {
			$this->edit_status($id);
			return 'true';
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
		// dd($request->id);
		$id = $request->id;
		TD::where('id',$id)->delete();
	}
	// public function filterData(Request $request)
	// {
	// 	dd($request->all());
	// 	$data[] = '';

	// 	if($request->value == "all"){
	// 		$model = TD::all();
	// 	}elseif($request->value == "completed"){
	// 		$model = TD::where('status',(int)'0')->get();
	// 	}elseif($request->value == "in-completed"){
	// 		$model = TD::where('status',(int)'1')->get();
	// 	}elseif($request->value == $request->value){
	// 		$model = TD::where('priority',$request->value)->get();
	// 	}

	// 		return view('organization.project._todo_list',['model'=>$model])->render();
	// }
	public function filterData(Request $request)
	{
		$data[] = '';
		if(array_key_exists('categories', $request->value)){
			if(array_key_exists('priority', $request->value)){
				if($request->value['categories'] == "all"){
					$this->list();
				}if($request->value['categories'] == "completed"){
					$cat = (int)'0';
				}elseif($request->value['categories'] == "in-completed"){
					$cat = (int)'1';
				}

				$model = TD::where(['status'=> $cat, 'priority' => $request->value['priority']])->get();
			}else{
				if($request->value['categories'] == "all"){
					$model = TD::all();
				}elseif($request->value['categories'] == "completed"){
					$model = TD::where('status',(int)'0')->get();
				}elseif($request->value['categories'] == "in-completed"){
					$model = TD::where('status',(int)'1')->get();
				}
			}			
		}
		if(!array_key_exists('categories', $request->value)){
			if(array_key_exists('priority', $request->value)){
				$model = TD::where('priority',$request->value['priority'])->get();
			}
		}
		return view('organization.project._todo_list',['model'=>$model])->render();
	}
}