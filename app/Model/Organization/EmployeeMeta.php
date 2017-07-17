<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class EmployeeMeta extends Model
{
	public static $breadCrumbColumn = 'id';
    public function __construct()
    {
    	if(!empty(Session::get('organization_id')))
    	{
            $this->table = Session::get('organization_id').'_employee_meta'; 
    	}
    }

    protected $fillable = ['employee_id', 'key', 'value'];
}
