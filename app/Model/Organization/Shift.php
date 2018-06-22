<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Shift extends Model
{
	public static $breadCrumbColumn = 'id';
	public function __construct()
	{	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_shifts';
	   	}
	}
   	protected $fillable = ['name', 'from', 'to', 'working_days','status'];

	public static function listshifts(){
		return Self::pluck('name','id');		
	}
}
