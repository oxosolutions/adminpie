<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class Todo extends Model
{
	public static $breadCrumbColumn = 'id';
	protected $fillable = ['project_id','title','description','start','end','priority'];

	function __construct()
	{
		if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_project_todos';
	   	}
	}
}
