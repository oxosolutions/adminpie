<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
use App\Model\Organization\User;
class Employee extends Model
{
    public static $breadCrumbColumn = 'employee_id';
    public function __construct()
    {
    	if(!empty(Session::get('organization_id')))
    	{
            $this->table = Session::get('organization_id').'_employees'; 
    		//$this->table = '_employees'; 

    	}
    }

    protected $fillable = ['user_id', 'employee_id', 'designation', 'department', 'marital_status', 'experience', 'blood_group', 'joining_date', 'disability_percentage', 'status'];

    public function employ_info()
    {
    	return $this->belongsTo('App\Model\Organization\User','user_id');
    }

    public function attendance()
    {
        return $this->hasMany('App\Model\Organization\Attendance','employee_id','employee_id');
    }
    public function designations(){
        return $this->belongsTo('App\Model\Organization\Designation','designation','id');
    }

    public function department(){ // wrong function name by paljinder (function name should not same as column name)
        return $this->belongsTo('App\Model\Organization\Department','department','id');
    }

    public function department_rel(){ //due to wrong function name i just created new function to use in employee profile
        return $this->belongsTo('App\Model\Organization\Department','department','id');
    }

    public function designation_rel(){
        return $this->belongsTo('App\Model\Organization\Designation','designation','id');
    }

    public static function employees()
    {
        return User::where('user_type','[2]')->pluck('name','id');
    }

    public function employeeMeta(){

        return $this->hasMany('App\Model\Organization\EmployeeMeta','employee_id','user_id');
    }


}
