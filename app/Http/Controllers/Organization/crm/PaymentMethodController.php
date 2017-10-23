<?php

namespace App\Http\Controllers\Organization\crm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\PaymentMethod;

class PaymentMethodController extends Controller
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
                $perPage = get_items_per_page();;
              }
          $sortedBy = @$request->sort_by;
          if($request->has('search')){
              if($sortedBy != ''){
                  $model = PaymentMethod::where('id','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = PaymentMethod::where('id','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = PaymentMethod::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = PaymentMethod::paginate($perPage);
              }
          }
                  $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['id'=>'id', 'name'=>'Name','created_at'=>'Created At'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'edit.applicant' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.payment.method']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
        return view('organization.crm.payment-method.list',$datalist);
    }
    public function create(Request $request)
    {
      $product =  new PaymentMethod();
      $product->fill($request->all());
      $product->save();
      return back();
    }
    public function edit(Request $request, $id)
    {
    }

    public function delete($id){

    	PaymentMethod::where('id',$id)->delete();
    	return back();
    }

    
}
