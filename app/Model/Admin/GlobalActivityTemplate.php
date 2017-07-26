<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class GlobalActivityTemplate extends Model
{
   protected $fillable = ['type', 'gender', 'template', 'slug','language', 'use_for'];
}
