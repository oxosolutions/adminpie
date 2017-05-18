<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Designation As DES;

class DesignationsController extends Controller
{
	 public function index(){
      $data = DES::all();
      $plugins = [
            'js'  =>  ['custom'=>['list-designation']],
            'css'=> ['custom'=>['list-designation']]
      ];
   	  return view('organization.designation.list_designation',['data'=>$data,'plugins'=>$plugins]);
   }
  
   public function save(Request $request)
   {
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
   public function delete($id)
   {
      
   } 
}
