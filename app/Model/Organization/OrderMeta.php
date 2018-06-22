<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

class OrderMeta extends Model
{
	public static $breadCrumbColumn = 'id';
  public function __construct()
   {	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_order_metas';
	   	}
   }
   protected $fillable = ['order_id', 'key', 'value'];
}
