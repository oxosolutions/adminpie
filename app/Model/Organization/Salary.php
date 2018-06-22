<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class Salary extends Model
{
	protected $fillable = ['employee_id', 'user_id', 'payscale_id', 'designation', 'department', 'payscale', 'shift', 'year', 'month', 'week', 'salary', 'no_of_leave','loss_of_pay_day','	dedicated_amount', 'monthly_weekly', 'number_of_attendance', 'hours', 'over_time', 'short_hours', 'per_day_amount','total_days', 'lock', 'status'];
    public function __construct(){
    	if(!empty(get_organization_id())){
    		$this->table = get_organization_id().'_salaries';
    	}
    }

    public function user_detail(){
    	return $this->belongsTo('App\Model\Group\GroupUsers','user_id','id');
    }
}
