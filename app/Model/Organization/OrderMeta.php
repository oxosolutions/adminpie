<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

class OrderMeta extends Model
{
	public static $breadCrumbColumn = 'id';
  public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_order_metas';
	   	}
   }
   protected $fillable = ['order_id', 'key', 'value'];
}
