<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
use Carbon\Carbon;
class Tasks extends Model
{
  public static $breadCrumbColumn = 'id';
    public function __construct(){	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_project_tasks';
	   	}
   }
   protected $fillable = [ 'project_id', 'title','description','assign_to','priority','end_date','status'];

    public function users(){

      return $this->belongsTo('App\Model\Organization\User','assign_to','id');
    }



    public static function generateUsersList($task){
        $usernames = [];
        $userArray = $task->assign_to;
        if($userArray != ''){
            $users = json_decode($userArray,true);
            if(@$users['user'] != null){
                foreach($users['user'] as $key => $userId){
                    if($userId != ''){
                        $usernames[] = user_id_to_name($userId);
                    }
                }
            }
        }
        return implode(',', $usernames);
    }

    public static function generateDaysLeft($task){
        $today = Carbon::now();
        $end_date = Carbon::parse($task->end_date);
        $days = $end_date->diffInDays(Carbon::now())+1;
        if($days < 2){
            $string = 'day';
        }else{
            $string = 'days';
        }
        return $days.' '.$string ;
    }

    public static function getStatus($status){
        if($status == 0){
            return 'Panding';
        }
        if($status == 1){
            return 'In Progress';
        }
        if($status == 2){
            return 'Completed';
        }
    }

    public static function HavingCurrentUser(){
        $current_user = get_user()->id;
        $tasks = self::get();
        $taskModel = [];
        if(!$tasks->isEmpty()){
            foreach ($tasks as $key => $task) {
                $assign_to = json_decode($task->assign_to,true);
                if(array_key_exists('user', $assign_to)){
                    if(in_array($current_user,$assign_to['user'])){
                        $taskModel[] = $task;
                    }
                }
            }
        }
        return collect($taskModel);
    }

}
