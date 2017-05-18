<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Client extends Model
{
	public function __construct()
	{
		if(!empty(Session::get('organization_id')))
		{
			$this->table = Session::get('organization_id').'_clients';
		}
	}
   protected $fillable =['user_id','name', 'company_name', 'address', 'country', 'state', 'city', 'email', 'phone', 'additional_info'];

}
