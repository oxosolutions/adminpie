<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Holiday;
use Carbon\Carbon;
use Session;
use App\Model\Organization\UsersMeta;
use App\Model\Organization\Attendance;
use Auth;

class HolidayController extends Controller
{
    public function save(Request $request)
    {
        $carbon = Carbon::parse($request['date_of_holiday']);
        $request['date_of_holiday'] = $carbon->format('Y-m-d');
        $request['status'] = 1;
    	$tbl = Session::get('organization_id');
        $valid_fields = [
                            'title'             => 'required|unique:'.$tbl.'_holidays',
                            'date_of_holiday'   => 'required|unique:'.$tbl.'_holidays',
                            'description'       => 'required'
                        ];
        $this->validate($request , $valid_fields) ;
        $holiday = new Holiday();
        $holiday->fill($request->all());
    	$holiday->save();
    	return redirect()->route('list.holidays');
    }
    public function holidayList()
    {
        $model = Holiday::all();
        return view('organization.holiday.list_only')->with(['model'=>$model]);
    }
    public function listHoliday(Request $request , $id = null)
    {
        $search = $this->saveSearch($request);
        if($search != false && is_array($search)){
            $request->request->add(['items'=>@$search['items'],'orderby'=>@$search['orderby'],'order'=>@$search['order']]);
        }
        if(@$id){
            $data = $this->getDataById($id);
        }else{
            $data = '';
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
                $model = Holiday::where('title','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                $model = Holiday::where('title','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $exploded = @explode(':',$sortedBy);
                if(isset($exploded[1])){
                    $sortedBy = $exploded[0];
                }
                $model = Holiday::orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                 $model = Holiday::paginate($perPage);
            }
        }
        $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['title'=>'Title','description'=>'Description','date_of_holiday:human_readable'=>'Date of Holiday','created_at'=>'Created At'],
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
        
                         
    	if($request['status'] == 'true'){
            $request['status'] = '1';
        }else{
            $request['status'] = '0';
        }
    	$request['date_of_holiday'] =  Carbon::parse($request['date_of_holiday'])->format('Y-m-d');
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
        $tbl = Session::get('organization_id');
        $data = Holiday::where('id',$request->id)->first();
        if($data->id == $request->id){
            if($data->date_of_holiday == $request->date_of_holiday){
                    $valid_fields = [
                                  'date_of_holiday' => 'required'
                                ];
                    $this->validate($request , $valid_fields) ;
            }else{
                $valid_fields = [
                                  'date_of_holiday' => 'required|unique:'.$tbl.'_holidays'
                                ];
                $this->validate($request , $valid_fields) ;
            }
        }
        $model = Holiday::where('id',$request->id)->get();
        $valid_fields = [
                            'title'             => 'required',
                            'description'       => 'required'
                        ];
        $this->validate($request , $valid_fields) ;

        $newdata = $request->except('_token','date_of_holiday','action');
        $newdata['date_of_holiday'] = $this->date_format($request['date_of_holiday']);
        $model = Holiday::where('id',$request->id)->update($newdata);
        return redirect()->route('list.holidays');
    }
    public function deleteHoliday($id)
    {
        $model = Holiday::where('id',$id)->delete();
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