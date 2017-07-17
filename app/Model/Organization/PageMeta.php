<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class PageMeta extends Model
{
	public static $breadCrumbColumn = 'id';
    public function __construct()
    {
    	if(!empty(Session::get('organization_id')))
    	{
    		$this->table = Session::get('organization_id').'_page_metas';
    	}
    }

    protected $fillable = ['page_id', 'key', 'value'];
}
