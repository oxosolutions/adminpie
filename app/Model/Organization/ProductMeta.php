<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class ProductMeta extends Model
{
    protected $fillable =['product_id', 'key', 'value', 'status'];
    public static $breadCrumbColumn = 'id';
    public function __construct()
   	{	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_product_meta';
	   	}
   	}
}
