<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class GlobalUsersRole extends Model
{
    protected $fillable = ['role_name', 'role_description', 'created_by','status'];

    public function rolesList()
    {
    	return self::orderBy('id','asc')->pluck('role_name','id');
    }
}

