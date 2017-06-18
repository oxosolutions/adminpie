<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class UsersType extends Model
{
   public function __construct(){

	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_users_types';
	   	}
   }
   
   protected $fillable = ['type', 'status'];

   public static function userTypes(){
   		return self::orderBy('id')->pluck('type','id');
   }

}
