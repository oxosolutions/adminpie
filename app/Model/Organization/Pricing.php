<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Pricing extends Model
{
   protected $fillable = ['item_id', 'price', 'use_for'];
   public static $breadCrumbColumn = 'id';
    public function __construct()
   	{	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_pricings';
	   	}
   	}
}
