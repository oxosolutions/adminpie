<?php
namespace App\Http\Controllers\Organization\hrm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Leave as LV; 
use App\Model\Organization\Category as CAT; 
use App\Model\Organization\Employee as EMP;
use App\Repositories\User\UserRepositoryContract;
use Carbon\Carbon;
use App\Model\Organization\UsersMeta;
use App\Model\Organization\Attendance;
use Auth;
use Session;
use App\Model\Group\GroupUsers;
use App\Model\Organization\User;
// use App\Http\Controllers\Organization\hrm\EmployeeLeaveController;// as EMP_CTRL;
class LeavesController extends Controller
{
    protected $user;
    public function __construct(UserRepositoryContract $user) {
        $this->user = $user;
    }
    public function index(Request $request , $id = null){

        $search = $this->saveSearch($request);
        if($search != false && is_array($search)){
            $request->request->add(['items'=>@$search['items'],'orderby'=>@$search['orderby'],'order'=>@$search['order']]);
        }    
        //$datalist= [];
        $data= [];
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
                $model = LV::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                $model = LV::where('name','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = LV::orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                $model = LV::paginate($perPage);
            }
        }
        foreach($model as $key => $employee){
            $model[$key]['name'] = user_id_to_name(get_user_id_from_employee_id($employee->employee_id));
        }
        $datalist =  [
            'datalist'=>  $model,
            'showColumns' => ['name'=>'Name','employee_id'=>'Employee ID','from'=>'From','to'=>'To','created_at'=>'Created', 'status'=>'Status'],
            'actions' => [
                'edit' => ['title'=>'Edit','route'=>'edit.leave','class' => 'edit'],
                'delete'=>['title'=>'Delete','route'=>'delete.leave'],
                'check_status_approve'=>['title'=>'Approve','class'=>'aione_approved_status','route'=>'approve.leave'],
                'check_status_reject'=>['title'=>'Reject','class'=>'aione_reject_status','route'=>'reject.leave']
            ],
            'js'  =>  ['custom'=>['list-designation']],
            'css'=> ['custom'=>['list-designation']]
        ];
        
        return view('organization.hrm.leave.list_leave',$datalist)->with(['data'=>$data]);
    }


    public function save(Request $request)
    {
        if($request['from'] > $request['to']){
            Session::flash('error','From Date must be smaller than to date');
            return back();
        }
        $user_id = $request['employee_id'];
        unset($request['employee_id']);
        $request['employee_id'] = $employee_id = get_user_meta($user_id, 'employee_id', $array = false);
        $valid_fields = [
            'reason_of_leave'  => 'required',
            'from'             => 'required',
            'to'               => 'required'
        ];
        $this->validate($request , $valid_fields);
        $data = LV::where(function($query)use($request){
            $query->whereBetween('from', [$request['from'], $request['to'] ])->orWhereBetween('to',[$request['from'], $request['to']]);
        })->where('employee_id',$employee_id);
        if($data->exists()){
            Session::flash('error','Already taken leave between dates');
        }else{
            $sh = new LV();
            $request['from']= $this->date_format($request['from']);
            $request['to']= $this->date_format($request['to']);
            $sh->fill($request->all());
            $sh->status = 0; 
            $sh->apply_by ='hr';
            $sh->save();
        }
        return redirect()->route('leaves');
    }
    protected function date_format($parm)
    {
        return date('Y-m-d',strtotime($parm));
    }
    public function update(Request $request)
    {
        $sh =  LV::find($request->id);
        if($request['status'] == 'true')
        {
            $request['status'] =1;
        }
        else if($request['status'] == 'false')
        {
            $request['status'] =0;
        }
        $request['from']    = $this->date_format($request['from']);
        $request['to']      = $this->date_format($request['to']);
        $sh->fill($request->all());
        $sh->save();
    }
    
    public function delete($id)
    {
        $model = LV::find($id);
        if($model != null){
            if($model->status == 0){
                $model->delete();        
            }else{
                Session::flash('error','Cannot delete the approved leave!');
                return back();
            }
        }
    } 
    public function getById($id)
    {
        $model = LV::where('id',$id)->get();
        $parsedate = Carbon::parse($model[0]->from);
        $model[0]->form = $parsedate->format('d M,Y');
        return $model;
    }
    public function updateLeave(Request $request)
    {
        $valid_fields = [
            'reason_of_leave'  => 'required',
            'from'             => 'required',
            'to'               => 'required'
        ];
        $this->validate($request , $valid_fields);
        $employee_id = $request['employee_id'];
        unset($request['employee_id']);
        $data = GroupUsers::with(['organization_user'=>function($query){
            $query->with('metas');
        }])->find($employee_id);
        $user = $data->organization_user->metas->where('key','employee_id')->toArray();
        $updateArray = $request->except('id','_token','from','to','action','employee_id');
        $updateArray['from']= $this->date_format($request['from']);
        $updateArray['to']= $this->date_format($request['to']);
        $updateArray['employee_id'] = $user[0]['value'];
        $model = LV::where('id',$request->id)->update($updateArray);
        Session::flash('success','Successfully updated!');
        return redirect()->route('leaves');
    }

    public function editLeave($id)
    {
        $model = LV::where('id',$id)->first();
        $userMeta = UsersMeta::where(['key'=>'employee_id','value'=>$model->employee_id])->first();
        $model['employee_id'] = $userMeta->user_id;
        return view('organization.hrm.leave.edit',['model'=>$model]);
    }

    protected function leave_insertion($start_to_date , $up_to_date , $year_month , $emp_id, $status){
        $start_to_date = str_replace('0', '', $start_to_date);
        for($i  = $start_to_date; $i <=$up_to_date; $i++ ){
            $carbon = Carbon::parse($year_month.'-'.$i);
            if(strlen($carbon->month)==1){
                $month = '0'.$carbon->month;
            }
            $attendance_check = Attendance::where(['date'=>$i, 'month'=>$month, 'year'=>$carbon->year]);
            if($attendance_check->exists()){
                if($status=='approve'){
                    $attendance_check->update(['date'=>$i, 'month'=>$month, 'year'=>$carbon->year, 'month_week_no'=>$carbon->weekOfMonth, 'day' =>$carbon->format('l'), 'attendance_status'=>'leave', 'employee_id'=>$emp_id ]); 
                }elseif($status=='reject'){
                    $attendance_check->delete();
                }
            }elseif($status=='approve'){
                $attendance = new Attendance();
                $attendance->fill(['date'=>$i, 'month'=>$month, 'year'=>$carbon->year, 'month_week_no'=>$carbon->weekOfMonth, 'day' =>$carbon->format('l'), 'attendance_status'=>'leave', 'employee_id'=>$emp_id]);
                $attendance->save();
            }
        }
    }

    protected function remove_leave_from_attendance($start_date, $end_date , $detail , $employee_id){
       
        $detail['employee_id'] = $employee_id;
        unset($detail['date'], $detail['day'], $detail['month_week_no'], $detail['day_in_month']);
        for ($i=$start_date; $i <= $end_date; $i++) {
                $detail['date'] = $i;
                Attendance::where($detail)->delete();
             }  
    }

    public function reject_leave($id){
        $model = LV::find($id);
        if($model['status']==1){
            if(in_array($model['type'], ['one_day', 'first_half', 'second_half']) ) {
                  $where =  $this->set_dates($model['from']);
                  $where = array_add($where, 'employee_id', $model['employee_id']);
                  unset($where['date'], $where['day'], $where['month_week_no'], $where['day_in_month']);
                Attendance::where($where)->delete();
            }elseif($model['type']=='multi'){
                 $from  =  $this->set_dates($model['from']);
                 $to    =  $this->set_dates($model['to']);
                 if($from['month'] == $to['month']){
                    $this->remove_leave_from_attendance($from['date'], $to['date'], $from, $model['employee_id']);
                 }elseif($from['month'] != $to['month']){
                    $this->remove_leave_from_attendance($from['date'], $from['day_in_month'], $from, $model['employee_id']);
                    $this->remove_leave_from_attendance(1, $to['day_in_month'], $to, $model['employee_id']);
                 }
            }
        }
        if(!empty($model)){
            LV::where('id',$id)->update(['status'=> 3]);
            Session::flash('success','Successfully reject');
        }else{
            Session::flash('error','There is no data');
        }
        return back();
    }
    //     $from = strtotime($model->from);
    //     $to = strtotime($model->to);
    //     $from_year_mo = date('Y-m', $from);
    //     $to_year_mo = date('Y-m', $to);
    //     $from_year   = date('Y',$from);
    //     $from_month  = date('m',$from);
    //     $from_date  =  date('d', $from);
    //     $to_date    = date('d', $to);
    //     $to_year = date('Y',$to);
    //     $to_month = date('m',$to);
    //        if(!empty($model->from) && !empty($model->to) && !empty($model->employee_id)){
    //             if($from_year_mo == $to_year_mo){
    //               if(strlen($from_month)==1){
    //                 $from_month = '0'.$from_month;
    //               }
    //               $this->leave_insertion($from_date, $to_date, $from_year_mo, $model->employee_id,'reject');
    //             }elseif($from_year_mo != $to_year_mo){
    //                 if($from_year == $to_year){
    //                       if($from_month != $to_month){
    //                         $carbon_from = Carbon::parse($model->from);
    //                         $carbon_from->daysInMonth;
    //                         $this->leave_insertion($from_date, $carbon_from->daysInMonth, $from_year_mo, $model->employee_id, 'reject');
    //                         $this->leave_insertion(1, $to_date, $to_year_mo, $model->employee_id,'reject');
    //                     }
    //                   }             
    //            }
    //         }
    //     return back();
    // }

    protected function leave_insert($month_week_no, $day , $date , $month , $year , $emp_id, $status, $attendance_status, $submited_by){
        $start_to_date = str_replace_first('0', '', $date);
        if(strlen($month)==1){
            $month = '0'.$month;
        }
        $attendance_check = Attendance::where(['date'=>$date, 'month'=>$month, 'year'=>$year, 'employee_id'=>$emp_id]);
        if($attendance_check->exists()){
            if($status=='approve'){
                $attendance_check->update(['date'=>$date, 'month'=>$month, 'year'=>$year, 'month_week_no'=>$month, 'day' =>$day, 'attendance_status'=>$attendance_status, 'employee_id'=>$emp_id, 'submited_by'=>$submited_by]); 
            }elseif($status=='reject'){
                $attendance_check->delete();
            }
        }elseif($status=='approve'){
            $attendance = new Attendance();
            $attendance->fill(['date'=>$date, 'month'=>$month, 'year'=>$year, 'month_week_no'=>$month_week_no, 'day' =>$day, 'attendance_status'=>$attendance_status, 'employee_id'=>$emp_id, 'submited_by'=>$submited_by]);
            $attendance->save();
        }
    }

    protected function set_dates($dates){
        $set =  Carbon::parse($dates);
        return ['year'=>$set->year, 'month'=>$set->month, 'date'=>$set->day, 'day'=>$set->format('l'), 'month_week_no'=>$set->weekOfMonth, 'day_in_month'=>$set->daysInMonth];
    }

    public function approve_leave($id)
    {               
        $attendance_status = 'leave';
        $submited_by = 'hr';
        $model = LV::find($id);
        $cat_data = CAT::with('meta')->where('id',$model->leave_category_id)->first();
        if(!empty( $leave_category_type =$cat_data->meta->where('key','leave_category_type')->first())) {
            if($leave_category_type->value == 'lop'){
                $attendance_status = 'lop';
            }
        }
        if(!empty($model)){
            $status = 'approve';
            $emp_id = $model->employee_id;
            $from =  $this->set_dates($model->from);
            if($model->to != "0000-00-00"){
                $to = $this->set_dates($model->to);
            }
           
            if(!empty($model['type']) && $model['type'] == "first_half"){
                extract($from);
                $attendance_status = 'first_half';
                $this->leave_insert($month_week_no, $day , $date , $month , $year , $emp_id, $status, $attendance_status, $submited_by);
            }elseif(!empty($model['type']) && $model['type'] == "second_half"){
                 extract($from);
                $attendance_status = 'second_half';
                $this->leave_insert($month_week_no, $day , $date , $month , $year , $emp_id, $status, $attendance_status, $submited_by);
            }elseif(!empty($model['type']) && $model['type'] =="one_day"){
                extract($from);
                $this->leave_insert($month_week_no, $day , $date , $month , $year , $emp_id, $status, $attendance_status, $submited_by);
            }elseif($from['year'] == $to['year'] && $from['month'] == $to['month'] && $from['date'] != $to['date']){
                extract($from);
                for ($i=$from['date']; $i <= $to['date']; $i++) { 
                    $date_details =  $this->set_dates("$year-$month-".$i);
                    $this->leave_insert($date_details['month_week_no'], $date_details['day'] , $date_details['date'] , $date_details['month'] , $date_details['year'] , $emp_id, $status, $attendance_status, $submited_by);
                }
            }elseif ($from['year'] == $to['year'] && $from['month'] != $to['month']) {
                extract($from);
                for ($i=$from['date']; $i <= $from['day_in_month']; $i++) {
                    $date_details =  $this->set_dates("$year-$month-".$i);
                    $this->leave_insert($date_details['month_week_no'], $date_details['day'] , $date_details['date'] , $date_details['month'] , $date_details['year'] , $emp_id, $status, $attendance_status, $submited_by);
                }
                for ($i=1; $i <= $to['date']; $i++) { 
                    $date_details =  $this->set_dates($to['year'].'-'.$to['month'].'-'.$i);
                    $this->leave_insert($date_details['month_week_no'], $date_details['day'] , $date_details['date'] , $date_details['month'] , $date_details['year'] , $emp_id, $status, $attendance_status, $submited_by);
                }
            }elseif ($from['year'] != $to['year']) {
                extract($from);
                for ($i=$from['date']; $i <= $from['day_in_month']; $i++) {
                    $date_details =  $this->set_dates("$year-$month-".$i);
                    $this->leave_insert($date_details['month_week_no'], $date_details['day'] , $date_details['date'] , $date_details['month'] , $date_details['year'] , $emp_id, $status, $attendance_status, $submited_by);
                }
                for ($i=1; $i <= $to['date']; $i++) { 
                    $date_details =  $this->set_dates($to['year'].'-'.$to['month'].'-'.$i);
                    $this->leave_insert($date_details['month_week_no'], $date_details['day'] , $date_details['date'] , $date_details['month'] , $date_details['year'] , $emp_id, $status, $attendance_status, $submited_by);
                }
            }
            LV::where('id',$id)->update(['status'=> 1]);
            Session::flash('success','Successfully approved');
            return back();
        }else{
            Session::flash('error','There is no data.');
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
    public function addLeaves()
    {
       $user = new User();
       $employee_list =  $user->employeeLeaveUsers();
        return view('organization.hrm.leave.add-leave',compact('employee_list'));
    }
}