<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class PageMeta extends Model
{
	public static $breadCrumbColumn = 'id';
	protected $fillable = ['page_id', 'key', 'value'];

    public function __construct()
    {
    	if(!empty(get_organization_id()))
    	{
    		$this->table = get_organization_id().'_page_metas';
    	}
    }
    public function MenuList(){
        return $this->belongsTo('App\Model\Organization\Cms\Menu\Menu','page_id','id');
    }
}
