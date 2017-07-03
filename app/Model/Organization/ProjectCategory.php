<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class ProjectCategory extends Model
{
   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_project_categories';
	   	}
   }
   protected $fillable = [ 'name', 'description', 'status'];

   public function categoryList(){

   		return self::orderBy('id','asc')->pluck('name','id');
   }
}
