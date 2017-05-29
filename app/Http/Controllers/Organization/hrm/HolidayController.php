<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Holiday;

class HolidayController extends Controller
{
    public function save(Request $request)
    {
    	
    	$holiday = new Holiday();
    	$holiday->fill($request->all());
    	$holiday->save();
    	return redirect()->route('list.holidays');


    }
    public function listHoliday()
    {
    	$data = Holiday::orderBy('id','desc')->get();

    	return view('organization.holiday.list_holidays' , ['data'=>$data]);	
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
}
