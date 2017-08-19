<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class Salary extends Model
{
	protected $fillable = ['employee_id', 'payscale_id', 'year', 'month', 'week', 'amount', 'no_of_leave', 'payscale', 'lock', 'monthly_weekly', 'status'];
    public function __construct(){
    	if(!empty(Session::get('organization_id'))){
    		$this->table = Session::get('organization_id').'_salaries';
    	}
    }
}
