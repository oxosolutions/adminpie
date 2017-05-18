<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Shift;

class ShiftsController extends Controller
{
   public function index(){
      $data = Shift::all();
   	return view('organization.shifts.list_shifts',['data'=>$data]);
   }
  
   public function save(Request $request)
   {
      $sh = new Shift();
      $sh->fill($request->all());
      $sh->save();
     return redirect()->route('shifts');
   }
   public function update(Request $request)
   {
       $sh =  Shift::find($request->id);
       if($request['status'] == 'true')
         {
          echo  $request['status'] =1;
         }
      else if($request['status'] == 'false')
      {
             echo   $request['status'] =0;
      }
      $sh->fill($request->all());
      $sh->save();

   }
   public function delete($id)
   {
      
   }

}
