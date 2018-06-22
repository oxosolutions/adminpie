<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Project extends Model
{
   public static $breadCrumbColumn = 'name';
   public function __construct()
   {	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_projects';
	   	}
   }
   protected $fillable = [ 'name', 'description','category','tags','teams'];

   public function projectMeta(){
   		return $this->hasMany('App\Model\Organization\ProjectMeta','project_id','id');
   }

   public static function projectList(){
      return self::orderBy('id','asc')->pluck('name','id');
   }
}
