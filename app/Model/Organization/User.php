<?php

namespace App\Model\Organization;
use Session;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable 
{
   public static $breadCrumbColumn = 'name';
   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_users';
	   	}
   }

   public function applicant_rel(){
    return $this->hasOne('App\Model\Organization\Applicant','user_id','id');
   }
   
   protected $fillable = ['name', 'email', 'password', 'api_token', 'remember_token'];

   public function metas()
   {
   	return $this->hasMany('App\Model\Organization\UsersMeta','user_id','id');
   }
   public static function userList()
   {
      return self::pluck('name','id');
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
    public function employeeMeta(){

        return $this->hasMany('App\Model\Organization\EmployeeMeta','employee_id','user_id');
    }
    public function client_rel(){
      return $this->hasOne('App\Model\Organization\Client','user_id','id');
    }
}
