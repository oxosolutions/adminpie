<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class Campaign extends Model
{
    public static $breadCrumbColumn = 'campaign_name';
	public function __construct()
	{
		if(!empty(Session::get('organization_id'))){
			$this->table = Session::get('organization_id').'_campaigns';
		}
	}
}
