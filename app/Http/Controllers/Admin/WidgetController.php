<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalWidget as GW;
use App\Model\Admin\GlobalModule as Module;


class WidgetController extends Controller
{
   protected $module_data;
    public function __construct()
    {
        $this->module_data = Module::pluck('name','id');

    }
    public function index($id = null)
    {

        $model  = Module::orderBy('orderBy','asc')->with('widgets')->get();
        $listWidgets  = GW::orderBy('order','asc')->get();
        $widgetData = [];
        if(@$id != null){
            $widgetData = GW::where('id',$id)->first();
        }
        return view('admin.widget.index',['data'=>$model,'widgetData'=>$widgetData,'module_data'=>$this->module_data,'listWidgets' => $listWidgets]);




        // $data = GW::orderBy('order','ASC')->get();
        // $widget = [];
        // $show_all='yes';
        // if(@$id != null){
        //     $show_all='no';
        //     $widget = GW::where('id',$id)->first();  
        // }
        // return view('admin.widget.index',['data'=>$data,'show_all'=>$show_all,'widget'=>$widget,'module_data'=>$this->module_data]);
    }
    public function create(Request $request)
    {

        if($request->isMethod('post'))
        {   
            $LastOrderBy = GW::select('order')->orderBy('order','DESC')->first()->toArray();
            $request['order'] = $LastOrderBy['order']+1 ;
            $widget = new GW();
            $widget->fill($request->all());
            $widget->save();
            return redirect()->route('index.widget');
        }
        return view('admin.widget.widget',['module_data'=>$this->module_data]);
    }
    public function edit(Request $request, $id=null)
    {
        if($request->isMethod('post'))
        {
            GW::where('id',$request->id)->update($request->except(['_token']));
            return redirect()->route('index.widget');
        }
        $data = GW::where('id',$request->id)->first();
        return view('admin.widget.widget',['id'=>$request->id,'data'=>$data, 'module_data'=>$this->module_data]);

    }
    public function delete($id)
    {   
        $widget = GW::find($id);    
        $widget->delete();
        return back();//redirect()->route('index.widget');
    }
    public function update_widget_status(Request $request)
    {
      if($request['status']=='true')
        {
            $status['status'] = 1;
        }
        else{
           $status['status'] =  0;
        }
      GW::where('id',$request['id'])->update($status);
      
    }
    public function sort(Request $request)
    {
            // $id = [];
            // $count = GW::get()->count();
            // $ids = GW::select('id')->get();
            // foreach ($ids as $key => $value) {
            //     $id[] = $value->id;
            // }
            // foreach ($id as $key => $value) {
            //     $model = GW::where('id' , $value)->update(['orderBy' => $key+1]);
            // }
            // $getId  = GW::select('id')->get();
            // $id = [];
            // foreach ($getId as $key => $value) {
            //     $id[] = $value->id; 
            // }
        $id = $request->id;
        $new_array = [];
        $index = 1;
        foreach($id as $key => $value){
            $new_array[$value] = $index;
            $index++;
        }
        foreach($new_array as $id => $order_id){
            GW::where('id',$id)->update(['order'=>$order_id]);
        }



        
    }
    public function sortWidgetDown($id )
    {
        $model = GW::find($id);
        $shiftFrom = $model->order;

        $shifted = GW::where('order',$shiftFrom+1)->first();
        if($shifted != null){
            $shiftTo = $shifted->order;
            GW::where('id',$id)->update(['order'=> $shiftTo]);
            GW::where('id',$shifted->id)->update(['order'=> $shiftFrom]);
        }
 
        return back();

    }
    public function sortWidgetUp($id )
    {
        // $id = [];
        //     $count = GW::get()->count();
        //     $ids = GW::select('id')->get();
        //     foreach ($ids as $key => $value) {
        //         $id[] = $value->id;
        //     }
        //     foreach ($id as $key => $value) {
        //         $model = GW::where('id' , $value)->update(['order' => $key+1]);
        //     }
        //     $getId  = GW::select('id')->get();
        //     $id = [];
        //     foreach ($getId as $key => $value) {
        //         $id[] = $value->id; 
        //     }
        $model = GW::find($id);
        $shiftFrom = $model->order;

        $shifted = GW::where('order',$shiftFrom-1)->first();
        if($shifted != null){
            $shiftTo = $shifted->order;
            GW::where('id',$id)->update(['order'=> $shiftTo]);
            GW::where('id',$shifted->id)->update(['order'=> $shiftFrom]);
        }
 
        return back();
    }
}
