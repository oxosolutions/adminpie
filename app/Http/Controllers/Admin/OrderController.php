<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Order;
use Session;
class OrderController extends Controller
{
    public function index(Request $request){
        $datalist = [];
        if($request->has('select_organization')){
            $data = "";
            $datalist= [];
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
                      $model = Order::where('order_domain','like','%'.$request->search.'%')->where(['organization_id'=>$request->select_organization])->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
                  }else{
                      $model = Order::where('order_domain','like','%'.$request->search.'%')->where(['organization_id'=>$request->select_organization])->paginate($perPage);
                  }
              }else{
                  if($sortedBy != ''){
                      $model = Order::orderBy($sortedBy,$request->desc_asc)->where(['organization_id'=>$request->select_organization])->paginate($perPage);
                  }else{
                       $model = Order::where(['organization_id'=>$request->select_organization])->paginate($perPage);
                  }
              }
              $datalist =  [
                              'datalist'=>  $model,
                              'showColumns' => ['order_domain'=>'Domain','created_at'=>'Created'],
                              'actions' => [
                                              'delete'=>['title'=>'Delete','route'=>'delete.admin.order'],
                                              'process'=>['title'=>'Process Order','route'=>'delete.admin.product']
                                           ]
                          ];
        }
        return view('admin.order.index',$datalist);
    }


    public function delete($id){
        $model = Order::find($id);
        if($model != null){
            $model->delete();
            Session::flash('success','Successfully deleted!');
        }
        return back();
    }
}
