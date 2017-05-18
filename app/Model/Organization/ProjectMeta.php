<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class ProjectMeta extends Model
{
   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_project_metas';
	   	}
   }
   protected $fillable = [ 'key', 'value', 'type', 'project_id'];
}
