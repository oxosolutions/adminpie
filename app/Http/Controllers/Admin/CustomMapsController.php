<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\CustomMaps;
class CustomMapsController extends Controller
{
    public function index(Request $request){
    	$datalist = [];
	    if($request->has('per_page')){
	        $perPage = $request->per_page;
	        if($perPage == 'all'){
	          $perPage = 999999999999999;
	        }
	      }else{
	        $perPage = 5;
	      }
	    $sortedBy = @$request->sort_by;
      	if($request->has('search')){
          	if($sortedBy != ''){
              $model = CustomMaps::where('title','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
          	}else{
              $model = CustomMaps::where('title','like','%'.$request->search.'%')->paginate($perPage);
          	}
      	}else{
          	if($sortedBy != ''){
              $model = CustomMaps::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
          	}else{
               $model = CustomMaps::paginate($perPage);
          	}
      	}
      	$datalist = [
                      	'datalist'=>$model,
                      	'showColumns' => ['title'=>'Title','table_code'=>'Map ID','code'=>'ISO Code','created_at'=>'Created At'],
                      	'actions'=>	[
                                      	'edit'    => ['title'=>'Edit','route'=>'departments','class'=>'edit'],
                                      	'delete'  => ['title'=>'Delete','route'=>'delete.department']
                                   	]
                  	];
    	return view('admin.custom-maps.custom-maps',$datalist);
    }

    public function saveMap(Request $request){
    	$model = new CustomMaps;
    	$model->table_code = 'GM-'.rand(11111111111,999999999999);
    	$model->code = $request->code;
    	$model->code_albha_2 = $request->code_albha_2;
    	$model->code_albha_3 = $request->code_albha_3;
    	$model->code_numeric = $request->code_numeric;
    	$model->parent = $request->parent;
    	$model->title = $request->title;
    	$model->description = $request->description;
    	$model->map_data = $request->map_data;
    	$model->status = '1';
    	$model->save();
    	return back();
    }


    public function publicMaps($map_id, $theme = 'default', $data = null){
    	$mapData = CustomMaps::where('table_code',$map_id)->first();
    	if($mapData == null){
    		$mapData = 'No Data available';
    	}
    	return view('admin.public.custom-map',['mapdata'=>$mapData,'theme'=>$theme,'data'=>$data]);
    }
}
