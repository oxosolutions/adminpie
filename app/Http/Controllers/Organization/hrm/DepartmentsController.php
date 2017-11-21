<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Department as DEP; 
use App\Model\Organization\UsersMeta;
use Session;
use Auth;
class DepartmentsController extends Controller
{
   public function index(Request $request , $id = null){
    $search = $this->saveSearch($request);
    if($search != false && is_array($search)){
        $request->request->add(['items'=>@$search['items'],'orderby'=>@$search['orderby'],'order'=>@$search['order']]);
    }
    $datalist = [];
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
              $model = DEP::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
          }else{
              $model = DEP::where('name','like','%'.$request->search.'%')->paginate($perPage);
          }
      }else{
          if($sortedBy != ''){
              $model = DEP::orderBy($sortedBy,$request->order)->paginate($perPage);
          }else{
               $model = DEP::paginate($perPage);
          }
      }
      $datalist =  [
                      'datalist'=>$model,
                      'showColumns' => ['name'=>'Name','created_at'=>'Created'],
                      'actions' => [
                                      'edit'    => ['title'=>'Edit','route'=>'departments','class'=>'edit'],
                                      'delete'  => ['title'=>'Delete','route'=>'delete.department']
                                   ]
                  ];
          if(!empty($id) || $id != null || $id != ''){
            $dataDep = $this->getDepartmentById($id);
          }else{
            $dataDep = "";
          }
      return view('organization.department.list_department',$datalist)->with(['data' => $dataDep]);
   }
  
   public function save(Request $request)
   {
      $tbl = Session::get('organization_id');

      $valid_fields = [
                            'name' => 'required|unique:'.$tbl.'_departments'
                        ];
     $this->validate($request , $valid_fields);
      $sh = new DEP();
      $sh->fill($request->all());
      $sh->save();
     return redirect()->route('departments');
   }
   function getDepartmentById($id){
      $data = DEP::where('id',$id)->get();
      return $data;
   }
   public function update(Request $request)
   {   
     
       $sh =  DEP::find($request->id);
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
    public function editDepartment(Request $request)
    {
      $data = DEP::where('id',$request->id)->get();
      if($data[0]->name == $request->name){

        DEP::find($request->id)->update(['name' => $request->name]);
        return redirect()->route('departments');
      }else{
        $tbl = Session::get('organization_id');
        $valid_fields = [
                              'name' => 'required|unique:'.$tbl.'_departments'
                          ];
        $this->validate($request , $valid_fields);
        DEP::find($request->id)->update(['name' => $request->name]);
      }
      
      return redirect()->route('departments');
    }
    public function delete($id)
    {
        $model = DEP::where('id',$id)->delete();
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
