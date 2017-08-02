<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class Invoice extends Model
{
   protected $fillable = ['invoice_no', 'customer_id', 'payment_method_id', 'total', 'status'];
    public function __construct()
   	{	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_invoices';
	   	}
   	}
}
