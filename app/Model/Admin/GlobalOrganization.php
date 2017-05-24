<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GlobalOrganization extends Model
{
   //use SoftDeletes;
   //protected $softDelete = true;
  // protected $dates =['deleted_at'];
   protected $fillable =[ 'name', 'description', 'email'];

}
