<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class OrderDetail extends Model
{
   protected $fillable = ['invoice_id', 'item_id', 'units', 'unit_price', 'total'];
   public function __construct()
   	{	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_order_details';
	   	}
   	}
}
