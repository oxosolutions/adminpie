<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GlobalOrganization extends Model
{
  protected $fillable =['name', 'description', 'email', 'modules', 'slug', 'primary_domain', 'secondary_domains'];
}
