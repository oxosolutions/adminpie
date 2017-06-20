<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Holiday;
use Carbon\Carbon;
use Session;

class HolidayController extends Controller
{
    public function save(Request $request)
    {
    	$tbl = Session::get('organization_id');
        $valid_fields = [
                            'title'         => 'required|unique:'.$tbl.'_holidays',
                            'from'          => 'required',
                            'description'   => 'required'
                        ];
        $this->validate($request , $valid_fields);

    	$holiday = new Holiday();
    	$holiday->fill($request->all());
    	$holiday->save();
    	return redirect()->route('list.holidays');


    }
    public function listHoliday(Request $request , $id = null)
    {

        if(@$id){
            $data = $this->getDataById($id);
        }else{
            $data = '';
        }

    	//$data = Holiday::orderBy('id','desc')->get();
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
                $model = Holiday::where('title','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
            }else{
                $model = Holiday::where('title','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = Holiday::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
            }else{
                 $model = Holiday::paginate($perPage);
            }
        }
        $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['title'=>'Title','description'=>'Description','date_of_holiday'=>'Date of Holiday','created_at'=>'Created At'],
                        'actions' => [
                                        'edit' => ['title'=>'Edit','route'=>'list.holidays'],
                                        'delete'=>['title'=>'Delete','route'=>'delete.holiday']
                                     ]
                    ];

    	return view('organization.holiday.list_holidays' , $datalist)->with(['data' => $data]);	
    }
    public function edit()
    {
        return view('organization.holiday.edit_holiday');   
    }
    public function update(Request $request)
    {
    	dump($request->all());
    	if($request['status'] == 'true'){
            $request['status'] = '1';
        }else{
            $request['status'] = '0';
        }
    	$request['date_of_holiday'] =  date('Y-m-d', strtotime($request['date_of_holiday']));
		Holiday::where('id',$request->id)->update($request->except(['_token','id']));
		//return redirect()->route('list.holiday');

    }
    public function getDataById($id)
    {
        $model = Holiday::where('id',$id)->get();
        $parsedate = Carbon::parse($model[0]->from);
        $model[0]->form = $parsedate->format('d M,Y');
        return $model;
    }
    protected function date_format($parm)
    {
        return date('Y-m-d',strtotime($parm));
    }
    public function editHoliday(Request $request)
    {
        $model = Holiday::where('id',$request->id)->get();
        if($model[0]->title == $request->title){
            $tbl = Session::get('organization_id');
            $valid_fields = [
                                'from'          => 'required',
                                'description'   => 'required'
                            ];
            $this->validate($request , $valid_fields);

            $newdata = $request->except('_token','from','action');
            $newdata['date_of_holiday']= $this->date_format($request['from']);
            $model = Holiday::where('id',$request->id)->update($newdata);
            return redirect()->route('list.holidays');
        }else{
            $tbl = Session::get('organization_id');
            $valid_fields = [
                                'title'         => 'required|unique:'.$tbl.'_holidays',
                                'from'          => 'required',
                                'description'   => 'required'
                            ];
            $this->validate($request , $valid_fields);
            $newdata = $request->except('_token','from','action');
            $newdata['date_of_holiday']= $this->date_format($request['from']);
            $model = Holiday::where('id',$request->id)->update($newdata);
            return redirect()->route('list.holidays');
        }
    }
    public function deleteHoliday($id)
    {
        $model = Holiday::where('id',$id)->delete();
        if($model){
            return back();
        }
    }
}