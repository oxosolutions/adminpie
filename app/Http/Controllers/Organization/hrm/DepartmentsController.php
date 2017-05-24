<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Department as DEP; 

class DepartmentsController extends Controller
{
   public function index(){
      $data = DEP::all();
   	return view('organization.department.list_department',['data'=>$data]);
   }
  
   public function save(Request $request)
   {
      $sh = new DEP();
      $sh->fill($request->all());
      $sh->save();
     return redirect()->route('departments');
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
   public function delete($id)
   {
      
   } 
}
