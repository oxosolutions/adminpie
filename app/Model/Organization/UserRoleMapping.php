<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class UserRoleMapping extends Model
{
    protected $fillable = ['user_id', 'role_id', 'status'];
    public function __construct(){
	    if(!empty(get_organization_id())){
	    	$this->table = get_organization_id().'_user_role_mappings';
	    }
	}

	public function roles(){

		return $this->belongsTo('App\Model\Organization\UsersRole','role_id','id');
	}

    public function group_user(){
        return $this->belongsTo('App\Model\Group\GroupUsers','user_id','id');
    }
}
