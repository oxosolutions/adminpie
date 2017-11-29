<?php

namespace App\Http\Controllers\Organization\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Tasks;
use Session;
use Auth;
class TasksController extends Controller
{
    public function index(){
        $model = Tasks::all();
        $data = [];
            foreach ($model as $key => $value) {
                $data[] = [
                            'data' => json_decode($value->assign_to)->user,
                            'id' => $value->id
                            ];
            }   
        if($data != null || $data != "" || !empty($data)){
            foreach($data as $k => $val){
                if(in_array(Auth::guard('org')->user()->id,$val['data'])){
                    $id[] = $val['id'];
                }
            }
            if(@$id){
                $model = Tasks::with('users')->find($id);
            }
        }else{
            $model = "";
        }
        $plugins = [
                'js' => ['custom'=>['tasks']]
            ];
            return view('organization.profile.tasks',['plugins'=>$plugins,'model'=>$model]);
    }

    public function create(Request $request){
        $validate = [
                        'title' =>'required',
                        'description' => 'required',
                        'priority'=>'required',
                        'due_date'=>'required',
                        'team' => 'required'

                    ];
        $this->validate($request, $validate);
        $assignTo = [];
        if(@$request->team != null || @$request->team != "" || !empty(@$$request->team)){
            foreach ($request->team as $key => $value) {
                $assignTo['team'][] = $value;
            }
        }else{
            $assignTo['team'][] = "";
        }
        if(@$request->assign_to != null || @$request->assign_to != "" || !empty(@$$request->assign_to)){
            foreach ($request->assign_to as $key => $value) {
                if (is_numeric($value)) {
                     $assignTo['user'][] = $value;
                }
            }
        }else{
            $assignTo['user'][] = "";
        }   
        $model = new Tasks;
        if($request->hasFile('browse_attachment')){
            $filename = $request->file('browse_attachment')->getClientOriginalName();
            $request->file('browse_attachment')->move('tasks_attachment', $filename);
            $model->attachment = $filename;
        }
    	
        if($request->has('project_id')){
            $model->project_id = $request->project_id;
        }else{
            $model->project_id = $request->projects_list;
        }
    	$model->description = $request->description;
    	$model->title = $request->title;
        $model->assign_to = json_encode($assignTo);
        $model->priority = $request->priority;
        $model->end_date = $request->due_date;
    	$model->save();
    	return back();
    }

    // chamge the task of the user from account user
    //working wityh ajax (tasks.js)
    public function changeStatus(Request $request)
    {
        if($request->status == 'pending'){
            $status = '0';
        }elseif($request->status == 'complete'){
            $status = '1';
        }elseif($request->status == 'in-progress'){
            $status = '2';
        }
        $model = Tasks::where('id',$request->id)->update(['status'=>$status]);
    }
    public function deleteTasks(Request $request)
    {
        Tasks::where('id',$request->id)->delete();
        return back();
    }

    // edit by ajax ( extra)
    public function updateTask(Request $request)
    {   
        

        $assignTo = [];
        if(@$request->team != null || @$request->team != "" || !empty(@$$request->team)){
            foreach (@$request->team as $key => $value) {
                $assignTo['team'][] = $value;
            }
        }else{
            $assignTo['team'][] = "";
        }
        if(@$request->assign_to != null || @$request->assign_to != "" || !empty(@$request->assign_to)){
            if(!is_array($request->assign_to)){
                $assign_to = array($request->assign_to);
                foreach (@$assign_to as $key => $value) {
                    if (is_numeric($value)) {
                         $assignTo['user'][] = $value;
                    }
                }
            }else{
                foreach (@$request->assign_to as $key => $value) {
                    if (is_numeric($value)) {
                         $assignTo['user'][] = $value;
                    }
                }
            }
            
        }else{
            $assignTo['user'][] = "";
        }
        $data = [
                'project_id'    => $request->project_id,
                'description'   => $request->description,
                'title'         => $request->title,
                'assign_to'     => json_encode($assignTo),
                'priority'      => $request->priority
            ];
        $model = Tasks::where('id',$request->id)->update($data);
        if($model){
            return 'true';
        }
    }
    
    //edit by php (Working)
    public function editTask($id)
    {
        $model = Tasks::where('id',$id)->get();
        $plugins = [
                'js' => ['custom'=>['tasks']]
            ];
        return view('organization.profile.editTask')->with(['plugins' => $plugins , 'model' => $model]);
    }
    public function filterPriority(Request $request)
    {        
        $data = [];
        if($request->has('priorityStatus')){

            if($request->project_id != null){
                $model = Tasks::where(['priority' => $request->priorityStatus,'project_id' => $request->id])->get();
            }else{
                // $id = $this->getIdOfUsers($request);
                // $model = Tasks::where('priority',$request->priorityStatus)->whereIn('id',$id)->get();
                $model = Tasks::where('priority',$request->priorityStatus)->get();
            }
        }elseif($request->has('Employee_filter')){
            if($request->project_id != null){
                $id = $this->getIdOfUsers($request);
                $model = Tasks::where(['project_id' => $request->id ])->whereIn('id',$id)->get();
            }else{
                $id = $this->getIdOfUsers($request);
                $model = Tasks::find($id);
            }
        }elseif($request->has('project_filter')){
            if($request->project_id != null){
                $model = Tasks::where('project_id',$request->project_filter)->get();
            }else{
                // $id = $this->getIdOfUsers($request);
                // $model = Tasks::where(['project_id' => $request->project_filter])->whereIn('id' , $id)->get();
                $model = Tasks::where(['project_id' => $request->project_filter])->get();
            }
        }
        return view('common.tasks',['model'=>$model])->render();
    }
    public function getIdOfUsers($request)
    {
        $id = [];
        $model = Tasks::all();
            foreach ($model as $key => $value) {
                $data[] = [
                            'data' => json_decode($value->assign_to)->user,
                            'id' => $value->id
                            ];
            }   
            foreach($data as $k => $val){
                // dump($val['data']);
                if(in_array(Auth::guard('org')->user()->id,$val['data'])){
                    $id[] = $val['id'];
                }
            }
        return $id;
    }
}