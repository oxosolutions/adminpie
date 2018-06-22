<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class ProjectCredentials extends Model
{
    public function __construct()
	{	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_project_credentials';
	   	}
	}
   protected $fillable = [ 'website_title','login_url','redirect_url' ,'email' ,'password', 'title','project_id']; 
}
