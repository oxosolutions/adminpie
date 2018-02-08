<?php

namespace App\Http\Controllers\Organization\project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Tasks;
use Session;
use Auth;
use Carbon\Carbon;
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
        if($model->assign_to != ''){
            $model['assign_to'] = json_decode($model->assign_to,true)['user'];
        }
        $model['due_date'] = Carbon::parse($model->end_date)->format('Y-m-d');
        $model['attachment'] = ($model->attachment != '')?json_decode($model->attachment,true):[];
        $model['project'] = $model->project_id;
       
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
            $model->attachment = json_encode([$filename]);
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
        $assignTo = $this->createAssignToAndTeamsArray($request);
        $data = [
                'project_id'    => $request->project,
                'description'   => $request->description,
                'title'         => $request->title,
                'assign_to'     => json_encode($assignTo),
                'priority'      => $request->priority
            ];
        $model = Tasks::find($request->id);
        if($request->hasFile('file')){
            $uploadPath = upload_path('tasks_attachment');
            $filename = $request->file('file')->getClientOriginalName();
            $request->file('file')->move($uploadPath, $filename);
            if($model->attachment == '' || $model->attachment == null){
                $model->attachment = json_encode([$filename]);
            }else{
                $oldAttachments = json_decode($model->attachment,true);
                $oldAttachments[] = $filename;
                $model->attachment = json_encode($oldAttachments);
            }
        }
        $model->description = $request->description;
        $model->title = $request->title;
        $model->assign_to = json_encode($assignTo);
        $model->priority = $request->priority;
        $model->end_date = $request->due_date;
        $model->project_id = $request->project;
        $model->created_by = get_user_id();
        $model->save();
        Session::flash('success','Task details update successfullly!');
        return back();
    }


    public function removeAttachment($task_id,$attachment_index){
        if($task_id != '' && $attachment_index != ''){
            $model = Tasks::find($task_id);
            $attachments = json_decode($model->attachment,true);
            unset($attachments[$attachment_index]);
            $model->attachment = json_encode(array_values($attachments));
            Session::flash('success','Attachment removed successfullly!');
            $model->save();
            return back();
        }else{
            Session::flash('error','Something went wrong, please try again!');
            return back();
        }
    }

    public function uploadAttachment(Request $request){
        if($request->has('attachments') && !empty($request->attachments)){
            $model = Tasks::find($request->id);
            if($model->attachment != null && $model->attachment != ''){
                $attachmentsArray = json_decode($model->attachment,true);
            }else{
                $attachmentsArray = [];
            }
            foreach($request->attachments as $key => $attachment){
                $tempArray = [];
                if($attachment['file'] == null){
                    continue;
                }else{
                    $uploadPath = upload_path('tasks_attachment');
                    $filename = $attachment['file']->getClientOriginalName();
                    $attachment['file']->move($uploadPath, $filename);
                    $attachmentsArray[] = $filename;
                }
            }
            $model->attachment = json_encode($attachmentsArray);
            $model->save();
            Session::flash('success','Attachmet\'s uploaded successfullly!');
            return back();
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