<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class ProjectMeta extends Model
{
	public static $breadCrumbColumn = 'id';
   public function __construct()
   {	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_project_metas';
	   	}
   }
   protected $fillable = [ 'key', 'value', 'type', 'project_id','teams'];
}
