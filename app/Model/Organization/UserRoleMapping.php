<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class UserRoleMapping extends Model
{
    protected $fillable = ['user_id', 'role_id', 'status'];
    public function __construct(){
	    if(!empty(Session::get('organization_id'))){
	    	$this->table = Session::get('organization_id').'_user_role_mappings';
	    }
	}
}
