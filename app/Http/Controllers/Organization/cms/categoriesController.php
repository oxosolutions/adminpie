<?php

namespace App\Http\Controllers\Organization\cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Category;
use Session;
use Auth;

class categoriesController extends Controller
{
   protected function assignModel($model){
        if(Auth::guard('admin')->check()){
            return 'App\\Model\\Admin\\'.$model;
        }else{
            return 'App\\Model\\Organization\\'.$model;
        }
    }

    public function listdata(Request $request , $id = null)
    {
      $Associate = $this->assignModel('Category');
        $datalist= [];
        $data= [];
          if($request->has('per_page')){
                $perPage = $request->per_page;
                if($perPage == 'all'){
                  $perPage = 999999999999999;
                }
              }else{
                $perPage = get_items_per_page();;
              }
          $sortedBy = @$request->sort_by;
           $orders = $request->order;
          if($request->orderby == null || $request->orderby == ''){
            $sortedBy = 'created_at';
            $orders = 'desc';
          }
          if($request->has('search')){
              if($sortedBy != ''){
                  $model = $Associate::where(['type' => 'page'])->orderBy($sortedBy,$orders)->paginate($perPage);
              }else{
                  $model = $Associate::where(['type' => 'page'])->paginate($perPage);
              }
          }else{
              $orgId = Session::get('organization_id');
              if($sortedBy != ''){
                  $model = $Associate::where(['type' => 'page'])->orderBy($sortedBy,$orders)->paginate($perPage);
              }else{
                   $model = $Associate::where(['type' => 'page'])->paginate($perPage);
              }
          }
          if(Auth::guard('admin')->check() == true){
            $edit = 'admin.category.edit';
            $delete = 'admin.category.delete';
          }else{
            $edit = 'category.edit';
            $delete = 'category.delete';
          }
          
          $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['name'=>'Name','description'=>'description'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>$edit , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','class'=>'red','route'=>$delete]
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
        
        return view('organization.cms.categories.list',$datalist);
    	// return view('organization.cms.categories.list');
    }
    public function save(Request $request)
    {
      $Associate = $this->assignModel('Category');
    	$request['type'] = 'page';
    	$model = new $Associate;
    	$model->fill($request->except('action'));
    	$model->save();
        return back();
    }
    public function delete($id)
    {
      $Associate = $this->assignModel('Category');
        $model = $Associate::find($id)->delete();
        return back();
    }
    public function getDataById($id)
    {
      $Associate = $this->assignModel('Category');
        $modelData = $Associate::where('id',$id)->first();
        return view('organization.cms.categories.edit',compact('modelData'));
    }
    public function updateCategory(Request $request, $id)
    {
      $Associate = $this->assignModel('Category');
        $model = $Associate::where('id',$request->id)->update($request->except('_token','id'));
        return back();
    }
}
