<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Shift;
use App\Model\Organization\UsersMeta;
use Session;
use Auth;

class ShiftsController extends Controller
{
   public function index(Request $request,$id=null){
    $search = $this->saveSearch($request);
    if($search != false && is_array($search)){
        $request->request->add(['items'=>@$search['items'],'orderby'=>@$search['orderby'],'order'=>@$search['order']]);
    }
      if(@$id){
        $data = $this->getDataById($id);
      }else{
        $data = "";
      }

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
            $model = Shift::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
        }else{
            $model = Shift::where('name','like','%'.$request->search.'%')->paginate($perPage);
        }
    }else{
        if($sortedBy != ''){
            $model = Shift::orderBy($sortedBy,$request->order)->paginate($perPage);
        }else{
             $model = Shift::paginate($perPage);
        }
    }
    $datalist =  [
                    'datalist'=>$model,
                    'showColumns' => ['name'=>'Name','from'=>'From','to'=>'To','working_days'=>['title' => 'Working Days','type' => 'json'],'created_at'=>'Created'],
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
      $model = Shift::where('name',$request->name)->first();
        if(@$model->id == $request->id){
          if(@$model->name == $request->name){
          $valid_fields = [
                        'name' => 'required',
                        'from' => 'required',
                        'to'   => 'required',
                        'working_days' => 'required'
                      ];  
          }
        }else{
            $valid_fields = [
                          'name' => 'required|unique:'.$tbl.'_shifts',
                          'from' => 'required',
                          'to'   => 'required',
                          'working_days' => 'required'
                        ];
        }
      
      $this->validate($request , $valid_fields);

       $tbl = Session::get('organization_id');

        

      $data = $request->except('_token','id','action','working_days');
      $data['working_days'] = json_encode($request->working_days);
      $model = Shift::where('id',$request->id)->update($data);
      return redirect()->route('shifts');
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
