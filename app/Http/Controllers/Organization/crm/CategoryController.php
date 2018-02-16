<?php

namespace App\Http\Controllers\Organization\crm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Category;

class CategoryController extends Controller
{


protected function datalist($request, $type){
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
          if($request->has('search')){

              if($sortedBy != ''){
                  $model = Category::whereType($type)->where('id','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = Category::whereType($type)->where('id','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = Category::whereType($type)->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = Category::whereType($type)->paginate($perPage);
              }
          }
            return $model;
}


	public function product_category_listing(Request $request){
			
			$model = $this->datalist($request , 'product');

             $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['id'=>'id', 'name'=>'Name','created_at'=>'Created'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'edit.applicant' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.crm.category']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
        return view('organization.crm.category.product_category_list',$datalist);
   
	}

public function service_category_listing(Request $request){
			
			$model = $this->datalist($request ,'service');
			$datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['id'=>'id', 'name'=>'Name','created_at'=>'Created'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'edit.applicant' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.crm.category']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
        return view('organization.crm.category.service_category_list',$datalist);
   	}


	public function save_category(Request $request)
	{
		$category = new Category();
		$category->fill($request->all());
		$category->save();
		return back();
	}
    
    public function delete($id)
    {
 		   Category::whereId($id)->delete();
       return back();
    }    
     public function edit(Request $request , $id)
    {
 		   
    }  //

    public function service_category_add()
    {
      return view('organization.crm.category.add-service-category');
    }
    public function product_category_add()
    {
      return view('organization.crm.category.add-product-category');
    }
}
