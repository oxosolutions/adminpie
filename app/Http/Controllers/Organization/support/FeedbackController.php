<?php

namespace App\Http\Controllers\Organization\support;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Feedback;

class FeedbackController extends Controller
{
    public function index(Request $request,$id = null)
    {
	    $datalist = [];
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
	              	$model = Feedback::where('title','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
	          	}else{
	              	$model = Feedback::where('title','like','%'.$request->search.'%')->paginate($perPage);
	          	}
	      	}else{
	          	if($sortedBy != ''){
	              	$model = Feedback::orderBy($sortedBy,$request->order)->paginate($perPage);
	          	}else{
	               $model = Feedback::paginate($perPage);
	          	}
	      	}
	      	$datalist =  [
	                      'datalist' => $model,
	                      'showColumns' => ['title'=>'Name','priority'=>'Priority','description'=>'Description'],
	                      'actions' => [
	                                      'edit'    => ['title'=>'Edit','route'=>'edit.feedback','class'=>'edit'],
	                                      'delete'  => ['title'=>'Delete','route'=>'delete.feedback']
	                                   ]
	                  ];
			if(!empty($id) || $id != null || $id != ''){
				$datafeed = Feedback::where('id',$id)->first();
			}else{
				$datafeed = "";
			}
	      return view('organization.support.index',$datalist)->with(['data' => $datafeed]);
    }
    public function create(Request $request)
    {
    	$order = Feedback::select('order')->orderBy('order','DESC')->first();
      	if($order == null){
        	$order = 1;
      	}else{
        	$order = $order->order+1;
      	}
      	$request['order'] = $order;
    	$model = new Feedback;
    	$model->fill($request->except('_token','action'));
    	$model->save();
    	return back();
    }
    public function delete($id)
    {
    	$model = Feedback::find($id)->delete();
    	return back();
    }
    public function update(Request $request)
    {
    	$model = Feedback::find($request['id'])->update($request->except('_token','action'));
    	return redirect()->route('list.feedback');
    }
}
