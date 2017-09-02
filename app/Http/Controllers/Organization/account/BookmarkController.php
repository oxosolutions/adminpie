<?php

namespace App\Http\Controllers\Organization\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\bookmark;
use Session;
use App\Model\Organization\Category;

class BookmarkController extends Controller
{
    public function addBookmarkCategories(Request $request)
    {
      $model = Category::where(['type' => 'bookmark' , 'name' => $request->title])->first(); 
      if($model != null){
        Session::flash('category_exists' , 'Category Already Exists');
        return back();
      }else{
          $request->request->add(['description' => '']) ;
          $request->request->add(['type' => 'bookmark']);

          $model = new Category;
          $model->fill($request->except('_token'));
          $model->save();
          return 'true';
      }
     
    }
    public function delCategory($id)
    {
      $model = Category::find($id)->delete();
      return 'true';
    }

    public function index(Request $request , $id=null)
    {
      $categories = Category::where('type' ,'bookmark')->get();
      $model = bookmark::all();
      return view('organization.bookmarks.index')->with(['category' => $categories , 'model' => $model]);

    }
    public function updateCategory($id)
    {
      $model = Category::where('id',$id)->update($request->all());
      return;
    }
    public function saveBookmark(Request $request)
    {
      $category = explode('_',$request['categories']);
      $request['categories'] = end($category);
      $request['user_id'] =  get_user_id();
      $order = bookmark::select('order')->orderBy('order','DESC')->first();
      if($order == null){
        $order = 1;
      }else{
        $order = $order->order+1;
      }

    	$new_array = [];
    	foreach($request->all() as $key =>$value){
    		if(is_array($value)){
    			$new_array[$key ] =  json_encode($value);
    		}else{
    			$new_array[$key ] =  $value;
    		}
    	}
      $new_array['order'] = $order;
     	$new_array['tags'] = '';
    	$model = new bookmark;
    	$model->fill($new_array);
    	$model->save(); 
    	if($model){
    		Session::flash('saved','saved');
    		return back();
    	}
    }
    public function editBookmark($id)
    {
      $model = bookmark::find($id);
      return view('organization.bookmarks.create',compact('model'));
    }
    public function deleteBookmark(Request $request)
    {
      foreach ($request['id'] as $key => $value) {
        $model = bookmark::find($value);
        $model->delete();
      }
      
      return 'true';
    }
    public function updateBookmark(Request $request, $id)
    {
      $new_array = [];
      foreach($request->except('_token','submit') as $key =>$value){
        if(is_array($value)){
          $new_array[$key ] =  json_encode($value);
        }else{
          $new_array[$key ] =  $value;
        }
      }
      $new_array['tags'] = '';
      $model = bookmark::where('id',$id)->update($new_array);
      if($model){
        Session::flash('saved','saved');
        return back();
      }
    }
}
