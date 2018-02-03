<?php

namespace App\Model\Organization;
use Session;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Group\GroupUsers;
use App\Model\Organization\UsersRole;
class User extends Authenticatable 
{
   use SoftDeletes;
   public static $breadCrumbColumn = 'name';
   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	      return $this->table = Session::get('organization_id').'_users';
	   	}
   }
   protected $softDelete = true;
   protected $dates = ['deleted_at'];


  public function salary(){
    return $this->hasOne('App\Model\Organization\Salary','user_id','id');
  }
   public function belong_group(){

    return $this->belongsTo('App\Model\Group\GroupUsers','user_id', 'id');
   }

   public static function user_list(){
        $user =  self::where('user_type', 'employee')->with('belong_group')->get();
        foreach($user as $key => $value){
          $list[$value['id']] = $value['belong_group']['name'];
         // $list[$key]['name'] = $value['belong_group']['id'];
        }
      return $list;
      
   }
   public function user_role_rel(){
      return $this->hasMany('App\Model\Organization\UserRoleMapping','user_id','id');
   }

   public function user_role_map(){
        return $this->hasMany('App\Model\Organization\UserRoleMapping','user_id','user_id');
   }

   public function applicant_rel(){
    return $this->hasOne('App\Model\Organization\Applicant','user_id','id');
   }
   
   protected $fillable = ['name', 'email', 'password', 'api_token','deleted_at', 'remember_token'];

   public function metas()
   {
    return $this->hasMany('App\Model\Organization\UsersMeta','user_id','user_id');
   }
   public function metas_for_attendance()
   {
   	return $this->hasMany('App\Model\Organization\UsersMeta','user_id','id');//->whereIn('key',['user_shift','employee_id','date_of_joining','designation','department']);
   }
   public static function userList()
   {
      return self::pluck('name','id');
   }
   public function listUsers()
   {
    $id = [];
      $user_id = self::select('user_id')->get();
      foreach ($user_id->toArray() as $key => $value) {
          foreach ($value as $k => $v) {
            $id[] = $v;
          }
      } 
      $employee_id = GroupUsers::whereIn('id',$id)->pluck('name','id');
      return $employee_id;

   }
    public static function userDropDowns($type=null)
   {
      return self::where(['status'=>1, 'user_type'=> $type])->pluck('name','id');
   }
   public static function getEmployee()
    {
      return self::where('user_type','employee')->pluck('name','id');
    }
   public function employee_rel()
   {
      return $this->hasOne('App\Model\Organization\Employee','user_id','id');
   }
    public static function getTeamById($data = null){
         $array = self::where('id',$data)->get();
      return $array;
    }
    public static function getAdmin($data = null){
      return User::where('user_type','[1]')->pluck('name','id');
    }
    public function department_rel(){ //due to wrong function name i just created new function to use in employee profile
        return $this->belongsTo('App\Model\Organization\Department','department','id');
    }

    public function designation_rel(){
        return $this->belongsTo('App\Model\Organization\Designation','designation','id');
    }
    public function client_rel(){
        return $this->hasOne('App\Model\Organization\Client','user_id','id');
    }
    public function userType()
    {
        return $this->hasMany('App\Model\Organization\UsersType','id','user_type');
    }

    public function employees()
    {
        return self::where('user_type','employee')->pluck('name','id');
    }

    public static function getEmployeesId(){
        $data = self::with(['metas'])->whereHas('metas',function($query){
            $query->where('key','employee_id')->whereNotNull('value');
        })->where('user_type','employee')->get();
        $optionsArray = [];
        foreach ($data as $key => $value) {
            if($value->metas->pluck('value')[0] != '' && $value->metas->pluck('value')[0] != null){
                $optionsArray[$value->metas->pluck('value')[0]]=$value->name.' ('.$value->metas->pluck('value')[0].' )';
            }
        }
        return $optionsArray;
    }

    public function groupUser(){
    	return $this->belongsTo('App\Model\Group\GroupUsers','user_id','id');
    }

    public function listEmployee()
    {
      $employee_id = [];
      $user_id = self::where('user_type' ,'employee')->get();
      foreach ($user_id as $key => $value) {
        $employee_id[] = GroupUsers::where('id',$value->id)->pluck('name','id');
      }
      $processEmployee= [];
      foreach ($employee_id as $key => $value) {
        foreach ($value->toArray() as $k => $v) {
          $processEmployee[$k] = $v;
        }
      }
      return $processEmployee;

    }
    //some change from listEmployee() this is not a permanent --sandeep  
    public function employeeLeaveUsers()
    {
      $employee_id = [];
      $user_id = self::where('user_type' ,'employee')->get();

      foreach ($user_id as $key => $value) {
        $employee_id[] = GroupUsers::where('id',$value->user_id)->pluck('name','id');
      }
      $processEmployee= [];
      foreach ($employee_id as $key => $value) {
        foreach ($value->toArray() as $k => $v) {
          $processEmployee[$k] = $v;
        }
      }
      return $processEmployee;

    }
    public static function getEmployeeList()
    {
      $employee_id = [];
      $user_id = self::where('user_type' ,'employee')->get();
      foreach ($user_id as $key => $value) {
        $employee_id[] = GroupUsers::where('id',$value->id)->pluck('name','id');
      }
      $processEmployee= [];
      foreach ($employee_id as $key => $value) {
        foreach ($value->toArray() as $k => $v) {
          $processEmployee[$k] = $v;
        }
      }
      return $processEmployee;
    }


    public static function getEmployesList(){ //used in form id: 281
        $users = self::with(['belong_group'])->where('user_type','employee')->get();
        foreach($users as $key => $user){
            $employeesList[$user->belong_group->id] = $user->belong_group->name;
        }
        return $employeesList;
    }

    public static function roleWiseUsers(){
        $usersArray = [];
        $model = UsersRole::with(['role_map_rel'=>function($query){
            $query->with(['group_user']);
        }])->get();

        foreach($model as $key => $role){
            $users = [];
            foreach($role->role_map_rel as $k => $roles){
                if($roles->group_user != null){
                     $users[$roles->group_user->id] = $roles->group_user->name;
                }
            }
            $usersArray[$role->name] = $users;
        }

        return $usersArray;
        
    }

}
