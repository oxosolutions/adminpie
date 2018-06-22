<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class Maps extends Model
{
    public static $breadCrumbColumn = 'title';
    public function __construct()
	{
	    if(!empty(get_organization_id()))
	    {
	    	$this->table = get_organization_id().'_maps';
	    }
	}
	protected $fillable = ['table_code','code','code_albha_2','code_albha_3','code_numeric','parent','title','description','map_data','map_keys','status'];
}
