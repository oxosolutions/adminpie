<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Designation As DES;
use App\Model\Organization\UsersMeta;
use Session;
use Auth;

class DesignationsController extends Controller
{
	 public function index(Request $request , $id=null){
    $search = $this->saveSearch($request);
    if($search != false && is_array($search)){
        $request->request->add(['items'=>@$search['items'],'orderby'=>@$search['orderby'],'order'=>@$search['order']]);
    }
    $datalist= [];
    $data= [];
      if($request->has('items')){
            $perPage = $request->items;
            if($perPage == 'all'){
              $perPage = 999999999999999;
            }
          }else{
            $perPage = get_items_per_page();;
          }
      $sortedBy = @$request->orderby;
      if($request->has('search')){
          if($sortedBy != ''){
              $model = DES::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
          }else{
              $model = DES::where('name','like','%'.$request->search.'%')->paginate($perPage);
          }
      }else{
          if($sortedBy != ''){
              $model = DES::orderBy($sortedBy,$request->order)->paginate($perPage);
          }else{
               $model = DES::paginate($perPage);
          }
      }
      $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['name'=>'Name','created_at'=>'Created'],
                      'actions' => [
                                      'edit' => ['title'=>'Edit','route'=>'designations' , 'class' => 'edit'],
                                      'delete'=>['title'=>'Delete','route'=>'delete.designation']
                                   ],
                      'js'  =>  ['custom'=>['list-designation']],
                      'css'=> ['custom'=>['list-designation']]
                  ];
    if(!empty($id) || $id != null || $id != ''){
      $data['data'] = DES::where('id',$id)->first();
    }
      return view('organization.designation.list_designation',$datalist)->with(['data' => $data]);

   }
  
   public function save(Request $request)
   {
      $tbl = Session::get('organization_id');
        $valid_fields = [
                          'name' => 'required|unique:'.$tbl.'_designations'
                        ];
        $this->validate($request , $valid_fields);
      $sh = new DES();
      $sh->fill($request->all());
      $sh->save();
     return redirect()->route('designations');
   }
   public function update(Request $request)
   {
      $sh =  DES::find($request->id);
       if($request['status'] == 'true')
         {
            $request['status'] =1;
         }
      else if($request['status'] == 'false')
      {
                $request['status'] =0;
      }
      $sh->fill($request->all());
      $sh->save();

   }
   // public function delete($id)
   // {
      
   // } 
     protected function getDesignationById($id){
        $getData = DES::where('id',$id)->first();
        return view('organization.designation.list_designation',$getData);
     }
    public function editUserDesignation(Request $request){
      $getData = DES::where('id',$request->id)->first();
      if(@$getData->name == $request->name){
        $model = DES::where('id',$request->id)->update(['name' => $request->name]);
      }else{
        $tbl = Session::get('organization_id');
        $valid_fields = [
                                'name' => 'required|unique:'.$tbl.'_designations'
                            ];
        $this->validate($request , $valid_fields);
        $model = DES::where('id',$request->id)->update(['name' => $request->name]);
      }
     
        Session::flash('success-update','update success');
      return redirect()->route('designations');
    }
    public function deleteUserDesignation($id){
      
     $model = DES::where('id',$id)->delete();
      if($model){
        return back();
      }
    }

    protected function saveSearch($request){
        $search = $request->except(['page']);
        $model = UsersMeta::where(['key'=>$request->route()->uri,'user_id'=>Auth::guard('org')->user()->id])->first();
        if($model != null){
            if(!empty($request->except(['page']))){
              $model->value = json_encode($request->except(['page']));
              $model->save();
            }
            $savedSearch = json_decode($model->value, true);
            return $savedSearch;
        }else{
            $model = new UsersMeta;
            $model->user_id = Auth::guard('org')->user()->id;
            $model->key = $request->route()->uri;
            $model->value = json_encode(@$request->except(['page']));
            $model->save();
            return false;
        }
    }
}
