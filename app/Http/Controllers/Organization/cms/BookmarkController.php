<?php

namespace App\Http\Controllers\Organization\cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\bookmark;
use Session;

class BookmarkController extends Controller
{
    public function index(Request $request , $id=null)
    {

        $datalist= [];
        $data= [];
          if($request->has('items')){
            $perPage = $request->items;
                if($perPage == 'all'){
                  $perPage = 999999999999999;
                }
            }else{
                $perPage = get_items_per_page();;
            }
          $sortedBy = @$request->orderby;
          if($request->has('search')){
              if($sortedBy != ''){
                  $model = bookmark::where('title','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
              }else{
                  $model = bookmark::where('title','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = bookmark::orderBy($sortedBy,$request->order)->paginate($perPage);
              }else{
                   $model = bookmark::paginate($perPage);
              }
          }
          $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['title'=>'Title','link'=>'Link','created_at'=>'Created'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'edit.bookmark' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.bookmark']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
        if(!empty($id) || $id != null || $id != ''){
          $data['data'] = bookmark::where('id',$id)->first();
        }
          return view('organization.bookmarks.index',$datalist)->with(['data' => $data]);

       }
    public function saveBookmark(Request $request)
    {
    	$new_array = [];
    	foreach($request->all() as $key =>$value){
    		if(is_array($value)){
    			$new_array[$key ] =  json_encode($value);
    		}else{
    			$new_array[$key ] =  $value;
    		}
    	}
    	$new_array['tags'] = '';
    	$model = new bookmark;
    	$model->fill($new_array);
    	$model->save(); 
    	if($model){
    		Session::flash('saved','saved');
    		return back();
    	}
    }
}
