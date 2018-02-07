<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
use Carbon\Carbon;
class Tasks extends Model
{
  public static $breadCrumbColumn = 'id';
    public function __construct(){	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_project_tasks';
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

}
