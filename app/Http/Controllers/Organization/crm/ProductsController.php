<?php

namespace App\Http\Controllers\Organization\crm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Product;
use App\Model\Organization\Pricing;

class ProductsController extends Controller
{
    public function index(Request $request)
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
                  $model = Product::where('id','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = Product::where('id','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = Product::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = Product::paginate($perPage);
              }
          }
                  $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['id'=>'id', 'name'=>'Name','created_at'=>'Created At'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'edit.applicant' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.products'],
                                          'price'=>['title'=>'Set Price','route'=>'price.products']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
        return view('organization.crm.product.list',$datalist);
    }
    public function create(Request $request)
    {
      $product =  new Product();
      $product->fill($request->all());
      $product->save();
      return back();
    }
    public function edit(Request $request, $id)
    {
    }
    public function prices(Request $request, $id=null){
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
                  $model = Pricing::where('id','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = Pricing::where('id','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = Pricing::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = Pricing::whereItem_id($id)->paginate($perPage);
              }
          }
          
                  $datalist =  [
                  'id'=>$id,
                          'datalist'=>  $model,
                          'showColumns' => ['id'=>'id','price'=>'Price', 'created_at'=>'Created At'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'edit.applicant' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.products'],
                                          'price'=>['title'=>'Set Price','route'=>'price.products']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
      if($request->isMethod('post')){
              $pricing = new Pricing();
              $pricing->fill($request->all());
              $pricing->item_id = $request['id'];
              $pricing->save();
        dd($request->all());
      }
      return view('organization.crm.pricing.list', $datalist);
    }

    public function delete($id)
    {
      Product::whereId($id)->delete();
      return back();
    }
}
