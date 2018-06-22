<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class Campaign extends Model
{
    public static $breadCrumbColumn = 'campaign_name';
	public function __construct()
	{
		if(!empty(get_organization_id())){
			$this->table = get_organization_id().'_campaigns';
		}
	}
}
