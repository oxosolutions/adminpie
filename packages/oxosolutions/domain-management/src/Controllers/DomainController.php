<?php

namespace OxoSolutions\DomainManagement\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Logicboxes;
use App\Model\Admin\Order;
use Session;
class DomainController extends Controller
{
    public function search(Request $request){
        $result = [];
        if($request->isMethod('post')){
            $result = Logicboxes::domain($request->domain_name)->check($request->extention,true);
        }
        return view('organization.domains.search',['result'=>$result]);
    }

    public function placeOrder(Request $request){
        $model = new Order;
        $model->organization_id = get_organization_id();
        $model->order_domain = $request->domain;
        $model->save();
        Session::flash('success','Order Placed Successfully!');
        return back();
    }

    public function myOrders(Request $request){
        $organization_id = get_organization_id();
        $data = "";
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
                  $model = Order::where('order_domain','like','%'.$request->search.'%')->where(['organization_id'=>$organization_id])->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = Order::where('order_domain','like','%'.$request->search.'%')->where(['organization_id'=>$organization_id])->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = Order::orderBy($sortedBy,$request->desc_asc)->where(['organization_id'=>$organization_id])->paginate($perPage);
              }else{
                   $model = Order::paginate($perPage);
              }
          }
          $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['order_domain'=>'Domain','created_at'=>'Created'],
                          'actions' => [
                                          'delete'=>['title'=>'Delete','route'=>'domain.delete.order'],
                                       ]
                      ];
        return view('organization.domains.orders',$datalist);
    }

    public function deleteOrder($id){
        $organization_id = get_organization_id();
        $model = Order::where(['id'=>$id,'organization_id'=>$organization_id])->first();
        if($model != null){
            $model->delete();
        }
        Session::flash('success','Successfully deleted!');
        return back();
    }
}
