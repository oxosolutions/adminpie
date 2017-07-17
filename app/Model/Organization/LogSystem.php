<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class LogSystem extends Model
{
	public static $breadCrumbColumn = 'id';
    protected $fillable = [ 'user_id', 'type', 'route_name', 'text', 'ip_address'];
    public function __construct()
    {
    	if(!empty(Session::get('organization_id')))
	    {
	    	$this->table = Session::get('organization_id').'_log_systems';
	    }
    }
}
