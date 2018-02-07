<?php

namespace App\Http\Controllers\Organization\project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Tasks;
use Session;
use Auth;
class TasksController extends Controller{

    /**
     * List of all tasks
     * @return [type] return tasks view
     * @author Rahul
     */
    public function index(){
        $model = Tasks::get();
        return view('organization.project.tasks',['tasks'=>$model]);
    }

    /**
     * view task
     * @return [type] return single task view
     * @author Ashish
     */
    public function viewTask($id)
    {
        $model = Tasks::where('id',$id)->first();
        return view('organization.project.view-task',['task'=>$model]);
    }


    protected function validateCreateTask($request){
        $rules = [
            'title' =>'required',
            'project' => 'required',
            'description' => 'required',
            'priority'=>'required',
            'due_date'=>'required'
        ];

        $this->validate($request,$rules);
    }


    /**
     * Will create and array of assign team and users
     * @param  [type] $request having all posted data
     * @return [type]          will return array
     * @author Rahul
     */
    protected function createAssignToAndTeamsArray($request){
        $assignTo = [];
        if(@$request->assign_to != null && @$request->assign_to != "" && $request->has('assign_to')){
            foreach ($request->assign_to as $key => $value) {
                if (is_numeric($value)) {
                     $assignTo['user'][] = $value;
                }
            }
        }else{
            $assignTo['user'][] = "";
        }  
        return $assignTo;
    }

    /**
     * Create new task
     * @param  Request $request having all posted data
     * @return [type]           will return to edit task route
     * @author Rahul
     */
    public function create(Request $request){
        $this->validateCreateTask($request);
        $assignTo = $this->createAssignToAndTeamsArray($request);
        $model = new Tasks;
        if($request->hasFile('file')){
            $uploadPath = upload_path('tasks_attachment');
            $filename = $request->file('file')->getClientOriginalName();
            $request->file('file')->move($uploadPath, $filename);
            $model->attachment = $filename;
        }
        $model->description = $request->description;
        $model->title = $request->title;
        $model->assign_to = json_encode($assignTo);
        $model->priority = $request->priority;
        $model->end_date = $request->due_date;
        $model->project_id = $request->project;
        $model->created_by = get_user_id();
        $model->save();
        Session::flash('success','Task created successfully!');
        return redirect()->route('edit.tasks',$model->id);
    }

    /**
     * Update task status (pending,in_progress,completed) by ajax
     * @param  Request $request having all posted data
     * @return [type]        will return nothing
     * @author Rahul
     */
    public function changeStatus(Request $request){

        $status = $request->status;
        
        Tasks::where('id',$request->task_id)->update(['status'=>$status]);
    }


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





    /*****************************************************************************************************************************/


    

    // chamge the task of the user from account user
    //working wityh ajax (tasks.js)
    
    public function deleteTasks(Request $request)
    {
        Tasks::where('id',$request->id)->delete();
        return back();
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
          
                if(in_array(Auth::guard('org')->user()->id,$val['data'])){
                    $id[] = $val['id'];
                }
            }
        return $id;
    }
}