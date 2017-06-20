<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Designation As DES;
use Session;

class DesignationsController extends Controller
{
	 public function index(Request $request , $id=null){
    
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
              $model = DES::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
          }else{
              $model = DES::where('name','like','%'.$request->search.'%')->paginate($perPage);
          }
      }else{
          if($sortedBy != ''){
              $model = DES::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
          }else{
               $model = DES::paginate($perPage);
          }
      }
      $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['name'=>'Name','created_at'=>'Created At'],
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
                  // dd($datalist);
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
      if($getData->name == $request->name){
        $model = DES::where('id',$request->id)->update(['name' => $request->name]);
      }else{
        $tbl = Session::get('organization_id');
        $valid_fields = [
                                'name' => 'required|unique:'.$tbl.'_designations'
                            ];
        $this->validate($request , $valid_fields);
        $model = DES::where('id',$request->id)->update(['name' => $request->name]);
      }
     

      return redirect()->route('designations');
    }
    public function deleteUserDesignation(Request $request , $id){
     $model = DES::where('id',$id)->delete();
      if($model){
        return back();
      }
    }
}
