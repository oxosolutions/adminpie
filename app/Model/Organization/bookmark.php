<?php

namespace App\Model\Organization;

use Session;
use Illuminate\Database\Eloquent\Model;

class bookmark extends Model
{
	public function __construct()
	{	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_bookmarks';
	   	}
	}
    protected $fillable = ['title','link','target','user_id','categories','tags','order','status'];
}
