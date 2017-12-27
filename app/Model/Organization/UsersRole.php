<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class UsersRole extends Model
{	
   public static $breadCrumbColumn = 'id';
   protected $fillable = [ 'name', 'description','order','slug', 'status'];

   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_users_roles';
	   	}
   }
   public function permisson()
   {
   		return $this->hasMany('App\Model\Organization\RolePermisson','role_id','id');
   }
   public function role_widget()
   {
      return $this->hasMany('App\Model\Organization\WidegetPermisson','role_id','id');
   }

   public static function roles(){

      return self::orderBy('id','asc')->pluck('name','id');
   }
   public function rolesList(){

      return self::orderBy('id','asc')->pluck('name','id');
   }
   //function used where role  delete and assign to another role.
   public static function getRoles()
   {
      return self::whereNotIn('name',['Super Admin','Employee','Client'])->get();
   }

   public function role_map_rel(){
        return $this->hasMany('App\Model\Organization\UserRoleMapping','role_id','id');
   }
}
