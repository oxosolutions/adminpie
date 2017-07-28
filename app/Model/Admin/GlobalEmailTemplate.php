<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class GlobalEmailTemplate extends Model
{
    protected $fillable = ['template', 'slug', 'language', 'status'];
}
