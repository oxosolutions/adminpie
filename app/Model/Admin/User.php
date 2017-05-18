<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable 
{
	 public $timestamps = true;

	 protected $fillable = [
        'name', 'email', 'password','role_id', 'api_token','remember_token'
    ];

	protected $table = 'global_users'; 
	
	protected $hidden = [
        'password','remember_token',
    ];
}
