<?php

namespace App\Http\Controllers\Organization\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Tasks;
use Session;
class TasksController extends Controller
{
    public function index(){
        $model = Tasks::with('users')->get();
        $plugins = [
            'js' => ['custom'=>['tasks']]
        ];
    	return view('organization.profile.tasks',['plugins'=>$plugins,'model'=>$model]);
    }

    public function create(Request $request){
        // dd($request->all());
        $assignTo = [];
        foreach ($request->team as $key => $value) {
            $assignTo['team'][] = $value;
        }
        foreach ($request->assign_to as $key => $value) {
            if (is_numeric($value)) {
                 $assignTo['user'][] = $value;
            }
        }
        $model = new Tasks;
        if($request->hasFile('browse_attachment')){
            $filename = $request->file('browse_attachment')->getClientOriginalName();
            $request->file('browse_attachment')->move('tasks_attachment', $filename);
            $model->attachment = $filename;
        }
    	$model->project_id = $request->projects_list;
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
    }
    public function updateTask(Request $request)
    {
        $data  = $request->except('_token');
        $model = Tasks::where('id',$request->id)->update($data);
        if($model){
            $this->index();
        }
    }
    public function filterPriority(Request $request)
    {
        $model = Tasks::where('priority',$request->priorityStatus)->get();
        
        return view('common.tasks',['model'=>$model])->render();
    }
}
