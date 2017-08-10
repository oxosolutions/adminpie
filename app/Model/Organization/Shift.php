<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Shift extends Model
{
	public static $breadCrumbColumn = 'id';
	public function __construct()
	{	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_shifts';
	   	}
	}
   	protected $fillable = ['name', 'from', 'to', 'status'];

	public static function listshifts(){
		return Self::pluck('name','id');		
	}
}
