<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Client extends Model
{
	public static $breadCrumbColumn = 'id';
	public function __construct()
	{
		if(!empty(get_organization_id()))
		{
			$this->table = get_organization_id().'_clients';
		}
	}
   protected $fillable =['user_id','name', 'company_name', 'address', 'country', 'state', 'city', 'email', 'phone', 'additional_info'];

   //one to one relation between client and user
   public function getUserDataByUser_id()
   {
   	return $this->belongsTo('App\Model\Organization\User','user_id','id');
   }
}
