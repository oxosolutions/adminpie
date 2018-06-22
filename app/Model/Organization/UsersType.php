<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class UsersType extends Model
{
   public static $breadCrumbColumn = 'id';
   public function __construct(){

	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_users_types';
	   	}
   }
   
   protected $fillable = ['type', 'status'];

   public static function userTypes(){
   		return self::orderBy('id')->pluck('type','id');
   }

}
