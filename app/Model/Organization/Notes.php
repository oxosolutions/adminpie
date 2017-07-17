<?php

namespace App\Model\Organization;

use Session;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
	public static $breadCrumbColumn = 'id';
	protected $fillable = ['project_id','title','description'];

	function __construct()
	{
		if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_project_notes';
	   	}
	}    
}
