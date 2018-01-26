<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use DB;
class PasswordReset extends Model
{
    protected $fillable = ['email','token'];

    protected $table = 'password_resets';
}
