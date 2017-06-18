<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class GlobalModuleRoute extends Model
{
    protected $fillable = [ 'module_id', 'route', 'route_for', 'route_name', 'status'];

}
