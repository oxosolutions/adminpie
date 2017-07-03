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
      $array = [];
      foreach ($data as $key => $id) {
         $array = self::where('id',$id)->get();
      }
      return $array;
   }
}
