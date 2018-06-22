<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class OrderDetail extends Model
{
   protected $fillable = ['invoice_id', 'item_id', 'units', 'unit_price', 'total'];
   public function __construct()
   	{	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_order_details';
	   	}
   	}
}
