<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Employee extends Model
{
    public function __construct()
    {
    	if(!empty(Session::get('organization_id')))
    	{
    		$this->table = Session::get('organization_id').'_employees'; 

    	}
    }

    protected $fillable = ['user_id', 'employee_id', 'designation', 'department', 'marital_status', 'experience', 'blood_group', 'joining_date', 'disability_percentage', 'status'];

    public function employ_info()
    {
    	return $this->belongsTo('App\Model\Organization\User','user_id');
    }

    public function designations(){
        return $this->belongsTo('App\Model\Organization\Designation','designation','id');
    }
}
