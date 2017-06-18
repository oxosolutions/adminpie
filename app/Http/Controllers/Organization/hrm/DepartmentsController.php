<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Department as DEP; 
use Session;
class DepartmentsController extends Controller
{
   public function index(Request $request , $id = null){
    $datalist = [];
    /*$data = DEP::all();
   	return view('organization.department.list_department',['data'=>$data]);*/
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
              $model = DEP::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
          }else{
              $model = DEP::where('name','like','%'.$request->search.'%')->paginate($perPage);
          }
      }else{
          if($sortedBy != ''){
              $model = DEP::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
          }else{
               $model = DEP::paginate($perPage);
          }
      }
      $datalist =  [
                      'datalist'=>$model,
                      'showColumns' => ['name'=>'Name','created_at'=>'Created At'],
                      'actions' => [
                                      'edit' => ['title'=>'Edit','route'=>'departments','class'=>'edit'],
                                      'delete'=>['title'=>'Delete','route'=>'delete.department']
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
      $tbl = Session::get('organization_id');
      $valid_fields = [
                            'name' => 'required|unique:'.$tbl.'_departments'
                        ];
      $this->validate($request , $valid_fields);
      DEP::find($request->id)->update(['name' => $request->name]);
      return redirect()->route('departments');
    }
    public function delete($id)
    {
        $model = DEP::where('id',$id)->delete();
        if($model){
          return back();
        }
   } 
}
