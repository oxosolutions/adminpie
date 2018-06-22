<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class ContactMeta extends Model
{
	public static $breadCrumbColumn = 'id';
public function __construct()
   {	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_contact_metas';
	   	}
   }
   protected $fillable = [ 'contact_id', 'key', 'value'];
}
