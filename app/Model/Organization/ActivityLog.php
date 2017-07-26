<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class ActivityLog extends Model
{
    public function __construct()
	{
		if(!empty(Session::get('organization_id')))
		{
			$this->table = Session::get('organization_id').'_activity_logs';
		}
	}
   protected $fillable =['user_id', 'name', 'slug'];
}
