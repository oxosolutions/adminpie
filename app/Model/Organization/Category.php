<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Category extends Model
{
	public static $breadCrumbColumn = 'name';
     public function __construct()
	{
	    if(!empty(Session::get('organization_id')))
	    {
	    	$this->table = Session::get('organization_id').'_categories';
	    }
	}
	protected $fillable = ['name', 'description', 'type', 'status'];

	public function meta()
    {
    	return $this->hasMany('App\Model\Organization\CategoryMeta','category_id','id');
    }
}
