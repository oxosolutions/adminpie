<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\CustomMaps;
use Auth;
use App\Model\Organization\Maps;
use Session;
class CustomMapsController extends Controller
{
    public function index(Request $request, $type = 'g'){
      if(!in_array($type,['g','u'])){
          $type = 'g';
      }
    	$datalist = [];
	    if($request->has('items')){
	        $perPage = $request->items;
	        if($perPage == 'all'){
	          $perPage = 999999999999999;
	        }
	      }else{
	        $perPage = 5;
	      }
        if($type == 'g'){
            $sortedBy = @$request->orderby;
            if($request->has('search')){
                if($sortedBy != ''){
                  $model = CustomMaps::where('title','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
                }else{
                  $model = CustomMaps::where('title','like','%'.$request->search.'%')->paginate($perPage);
                }
            }else{
                if($sortedBy != ''){
                  $model = CustomMaps::orderBy($sortedBy,$request->order)->paginate($perPage);
                }else{
                   $model = CustomMaps::paginate($perPage);
                }
            }
        }elseif($type == 'u'){
          $sortedBy = @$request->orderby;
            if($request->has('search')){
                if($sortedBy != ''){
                  $model = Maps::where('title','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
                }else{
                  $model = Maps::where('title','like','%'.$request->search.'%')->paginate($perPage);
                }
            }else{
                if($sortedBy != ''){
                  $model = Maps::orderBy($sortedBy,$request->order)->paginate($perPage);
                }else{
                   $model = Maps::paginate($perPage);
                }
            }
        }
        if(!Auth::guard('admin')->check()){
            $deleteRoute = 'org.delete.custom.map';
            $viewRoute = 'org.view.map';
            $editRoute = 'org.getData.custom.map';
        }else{
            $deleteRoute = 'delete.custom.map';
            $viewRoute =  'view.map';
            $editRoute =  'getData.custom.map';
        }
      	$datalist = [
                      	'datalist'=>$model,
                      	'showColumns' => ['title'=>'Title','table_code'=>'Map ID','code'=>'ISO Code','created_at'=>'Created At'],
                  	];
        if(!Auth::guard('admin')->check()){
            if($type != 'u'){
                $datalist['actions'] = [
                                          'view'    => ['title'=>'View','route'=>$viewRoute],
                                       ];
            }else{
                $datalist['actions'] = [
                                          'edit'    => ['title'=>'Edit','route'=>$editRoute,'class'=>'edit'],
                                          'view'    => ['title'=>'View','route'=>$viewRoute],
                                          'delete'  => ['title'=>'Delete','route'=>$deleteRoute]
                                       ];
            }
        }else{
            $datalist['actions'] = [
                                          'edit'    => ['title'=>'Edit','route'=>$editRoute,'class'=>'edit'],
                                          'view'    => ['title'=>'View','route'=>$viewRoute],
                                          'delete'  => ['title'=>'Delete','route'=>$deleteRoute]
                                       ];
        }
    	return view('admin.custom-maps.custom-maps',$datalist);
    }

    public function saveMap(Request $request){
      if($request->type == 'u'){
          $model = new Maps;
      }else{
          $model = new CustomMaps;
      }
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

    public function getDataById($id){
         if(!Auth::guard('admin')->check()){
            $model = Maps::find($id);;
        }else{
            $model = CustomMaps::find($id);
        }
        return view('admin.custom-maps.edit_custom',['model'=>$model]);
    }

    public function updateMap(Request $request, $id){
      if(!Auth::guard('admin')->check()){
        $model = Maps::find($id);
      }else{
        $model = CustomMaps::find($id);
      }
      $model->fill($request->all());
      $model->save();
      return back();
    }
    public function viewmap($id){
        if(!Auth::guard('admin')->check()){
          $model = Maps::find($id);
        }else{
          $model = CustomMaps::find($id);
        }
        return view('admin.custom-maps.map-view',['model'=>$model]);
    }

    public function DeleteGlobalMap($id){
        CustomMaps::find($id)->delete();
        Session::flash('success','Successfully deleted!');
        return back();
    }

    public function DeleteUserMap($id){
        Maps::find($id)->delete();
        Session::flash('success','Successfully deleted!');
        return back();
    }
    
}
