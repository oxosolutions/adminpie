<?php

namespace App\Http\Controllers\Organization\cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Category;
use Session;

class categoriesController extends Controller
{
    public function listdata(Request $request , $id = null)
    {
        $datalist= [];
        $data= [];
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
                  $model = Category::where(['type' => 'page'])->paginate($perPage);
              }else{
                  $model = Category::where(['type' => 'page'])->paginate($perPage);
              }
          }else{
              $orgId = Session::get('organization_id');
              if($sortedBy != ''){
                  $model = Category::where(['type' => 'page'])->paginate($perPage);
              }else{
                   $model = Category::where(['type' => 'page'])->paginate($perPage);
              }
          }
          $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['name'=>'Name','description'=>'description'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'category.edit' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'category.delete']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
        
        return view('organization.cms.categories.list',$datalist);
    	// return view('organization.cms.categories.list');
    }
    public function save(Request $request)
    {
    	$request['type'] = 'page';
    	$model = new Category;
    	$model->fill($request->except('action'));
    	$model->save();
        return back();
    }
    public function delete($id)
    {
        $model = Category::find($id)->delete();
        return back();
    }
    public function getDataById($id)
    {
        $modelData = Category::where('id',$id)->first();
        return view('organization.cms.categories.edit',compact('modelData'));
    }
    public function updateCategory(Request $request, $id)
    {
        $model = Category::where('id',$request->id)->update($request->except('_token','id'));
        return back();
    }
}
