<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class Product extends Model
{
    protected $fillable =['type', 'name', 'description', 'created_by', 'status'];
    public static $breadCrumbColumn = 'id';
    public function __construct()
   	{	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_products';
	   	}
   	}
}
