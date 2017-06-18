<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Employee extends Model
{
	use SoftDeletes;
	protected $softDeletes = true;
	protected $dates = ['deleted_at'];
	protected $fillable = [ 'employee_id', 'name', 'department'];

	public function attendance()
	{
		return $this->hasMany('App\Model\Organization\Attendance', 'employee_id' , 'employee_id'  );
	}
}
