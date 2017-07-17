<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Shift;
use Session;

class ShiftsController extends Controller
{
   public function index(Request $request,$id=null){
    // $data = Shift::all();
      if(@$id){
        $data = $this->getDataById($id);
      }else{
        $data = "";
      }

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
            $model = Shift::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
        }else{
            $model = Shift::where('name','like','%'.$request->search.'%')->paginate($perPage);
        }
    }else{
        if($sortedBy != ''){
            $model = Shift::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
        }else{
             $model = Shift::paginate($perPage);
        }
    }
    $datalist =  [
                    'datalist'=>$model,
                    'showColumns' => ['name'=>'Name','from'=>'From','to'=>'To','created_at'=>'Created At'],
                    'actions' => [
                                    'edit' => ['title'=>'Edit','route'=>'shifts'],
                                    'delete'=>['title'=>'Delete','route'=>'delete.shifts']
                                 ]
                ];
   	return view('organization.shifts.list_shifts',$datalist)->with(['data' => $data]);
   }
  
   public function save(Request $request)
   {
    $tbl = Session::get('organization_id');

    $valid_fields = [
                            'name' => 'required|unique:'.$tbl.'_shifts',
                            'from' => 'required',
                            'to'   => 'required',
                            'working_days' => 'required'
                        ];
      $this->validate($request , $valid_fields);

      $sh = new Shift();
      $sh->fill($request->all());
      $sh->working_days = json_encode($request->working_days);
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
      $model = Shift::where('id',$id)->delete();
      if($model){
        return back();
      }
   }
    protected function getDataById($id){
       
      $model = Shift::where('id',$id)->get();
      return $model;
    }
    public function editShifts(Request $request , $id = null)
    {
       $tbl = Session::get('organization_id');

        $valid_fields = [
                            'name' => 'required',
                            'from' => 'required',
                            'to'   => 'required',
                            'working_days' => 'required'
                        ];
      $this->validate($request , $valid_fields);

      $data = $request->except('_token','id','action','working_days');
      $data['working_days'] = json_encode($request->working_days);
      $model = Shift::where('id',$request->id)->update($data);
      return redirect()->route('shifts');
    }

}
