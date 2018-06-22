<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
use App\Model\Organization\User;
use App\Model\Organization\UserRoleMapping;
use Illuminate\Database\Eloquent\SoftDeletes;
class Employee extends Model
{
	use SoftDeletes;
    public static $breadCrumbColumn = 'employee_id';
    protected $table = '';
    public function __construct()
    {
    	parent::__construct();
    	if(!empty(get_organization_id()))
    	{
            $this->table = get_organization_id().'_employees'; 
    	}
    }
    // protected $table = '175_employees';
    /*protected $fillable = ['user_id', 'employee_id', 'designation', 'department', 'marital_status', 'experience', 'blood_group', 'joining_date', 'leaving_date', 'disability_percentage', 'status'];
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
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
        $employee = self::with('employ_info')->get();
        $data =    $employee->mapWithKeys(function($item){
            return [$item['employee_id']=> $item['employ_info']['name']];
         });
        return $data;

         //->keyBy('employee_id');
        // $model = User::with(['user_role_rel'])->whereHas('user_role_rel', function($query){
        //     $query->where('role_id',2);
        // })->pluck('name','id');
        // return $model;
    }

    public function metas()
   {
    return $this->hasMany('App\Model\Organization\UsersMeta','user_id','id');
   }*/

}
