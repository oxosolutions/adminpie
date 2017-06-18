<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
use App\Model\Organization\Category as CAT; 
class Leave extends Model
{
    
	public function __construct()
	{
		if(!empty(Session::get('organization_id')))
		{
			$this->table = Session::get('organization_id').'_leaves';
		}

					//$this->table = '32_holidays';
	}
	//use SoftDeletes;
    protected $fillable = [ 'name', 'employee_id', 'reason_of_leave', 'leave_category_id', 'from', 'to', 'description', 'total_days', 'apply_by', 'approved_by', 'status'];

    public function employees(){
        $user_list = User::where('user_type','[2]')->pluck('name','id');
        return $user_list;
    }

    public function categories(){
    	return CAT::where('type','leave')->pluck('name','id');
    }
   
}
