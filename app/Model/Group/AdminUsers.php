<?php

namespace App\Model\Group;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUsers extends Authenticatable
{
    protected $fillable = ['name','email','api_token','role_id','password','remember_token','group_id'];
    protected $table = 'group_admins';

    public function organization_relation()
    {
    	return $this->hasMany('App\Model\Admin\GlobalOrganization', 'group_id', 'id');
    }
}
