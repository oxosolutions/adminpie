<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class ProjectCategory extends Model
{
   public static $breadCrumbColumn = 'id';
   public function __construct()
   {	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_project_categories';
	   	}
   }
   protected $fillable = [ 'name', 'description', 'status'];

   public function categoryList(){

   		return self::orderBy('id','asc')->pluck('name','id');
   }
}
