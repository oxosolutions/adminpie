<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class CategoryMeta extends Model
{
	public static $breadCrumbColumn = 'id';
	protected $fillable = [ 'category_id', 'key', 'value'];

     public function __construct()
	{
	    if(!empty(get_organization_id()))
	    {
	    	 $this->table = get_organization_id().'_category_meta';
	    }

	}
}
