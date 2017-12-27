<?php

namespace App\Model\Group;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Session;
use App\Model\Organization\User;
class GroupUsers extends Authenticatable
{
    protected $fillable = ['name','email','api_token','role_id','password','remember_token','app_password','status'];

    protected $attributes = [
        'status' => 1
    ];

    public function __construct(){
    	if(Auth::guard('group')->check()){
    		$this->table = 'group_'.Auth::guard('group')->user()->group_id.'_users';
    	}else{
    		$this->table = 'group_'.Session::get('group_id').'_users';
    	}
    }

    public function salary(){
    return $this->hasOne('App\Model\Organization\Salary','user_id','id');
  }
    public function organization_user(){
      
      return $this->hasOne('App\Model\Organization\User','user_id','id');
    }
    public function user_role_rel(){
      return $this->hasMany('App\Model\Organization\UserRoleMapping','user_id','id');
   	}

   	public function applicant_rel(){
    	return $this->hasOne('App\Model\Organization\Applicant','user_id','id');
   	}
   

   	public function metas(){
    	return $this->hasMany('App\Model\Organization\UsersMeta','user_id','id');
   	}

   	public function metas_for_attendance()
   	{
   		return $this->hasMany('App\Model\Organization\UsersMeta','user_id','id')->whereIn('key',['user_shift','employee_id','date_of_joining','designation','department']);
   	}
   	public static function userList()
   	{
      	return self::pluck('name','id');
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
    /*public function userRole() // Should remove
    {
      return $this->hasOne('App\Model\Organization\UsersRole','id','role_id');
    }*/
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

    public static function userListForAssignToOrganization(){
    	return Self::doesntHave('organization_user')->pluck('name','id');
    }
}
