<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class Salary extends Model
{
	protected $fillable = ['employee_id', 'payscale_id', 'designation', 'department', 'payscale', 'shift', 'year', 'month', 'week', 'salary', 'no_of_leave', 'monthly_weekly', 'number_of_attendance', 'hours', 'over_time', 'short_hours', 'per_day_amount', 'lock', 'status'];
    public function __construct(){
    	if(!empty(Session::get('organization_id'))){
    		$this->table = Session::get('organization_id').'_salaries';
    	}
    }
}
