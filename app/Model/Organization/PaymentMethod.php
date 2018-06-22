<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class PaymentMethod extends Model
{
	protected $fillable = ['name', 'status'];
	public static $breadCrumbColumn = 'id';
    public function __construct()
	   {	
		   	if(!empty(get_organization_id()))
		   	{
		       $this->table = get_organization_id().'_payment_methods';
		   	}
	   }
}
