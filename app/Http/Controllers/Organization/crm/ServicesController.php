<?php

namespace App\Http\Controllers\Organization\crm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Service;
use App\Model\Organization\Pricing;



class ServicesController extends Controller
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
                  $model = Service::where('id','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = Service::where('id','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = Service::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = Service::paginate($perPage);
              }
          }
                  $datalist =  [

                          'datalist'=>  $model,
                          'showColumns' => ['id'=>'id', 'name'=>'Name','created_at'=>'Created At'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'edit.applicant' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.service'],
                                          'price'=>['title'=>'Set price','route'=>'price.service']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
        return view('organization.crm.service.list',$datalist);
    }
    public function create(Request $request)
    {
      $product =  new service();
      $product->fill($request->all());
      $product->save();
      return back();
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
                  $model = Pricing::where(['item_id'=>$id , 'use_for'=>'product'])->where('id','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = Pricing::where(['item_id'=>$id , 'use_for'=>'product'])->where('id','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = Pricing::where(['item_id'=>$id , 'use_for'=>'service'])->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = Pricing::where(['item_id'=>$id , 'use_for'=>'service'])->paginate($perPage);
              }
          }
          
                  $datalist =  [
                    'user_for'=>"Service",
                  'id'=>$id,
                          'datalist'=>  $model,
                          'showColumns' => ['id'=>'id','price'=>'Price', 'created_at'=>'Created At'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'edit.applicant' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.price.products']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
      if($request->isMethod('post')){
              $pricing = new Pricing();
              $pricing->fill($request->all());
              $pricing->item_id = $request['id'];
              $pricing->save();
       return back();
      }
      return view('organization.crm.pricing.list', $datalist);
    }
     public function delete($id)
    {
      Service::whereId($id)->delete();
      return back();
    }
    public function delete_pricing($id)
    {
      Pricing::whereId($id)->delete();
      return back(); 
    }
    public function edit(Request $request, $id)
    {

    }
}
