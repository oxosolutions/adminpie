<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class ProjectAttachment extends Model
{
    public function __construct()
	{	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_project_attachments';
	   	}
	}
   protected $fillable = [ 'name','project_id' ,'description' ,'file', 'status']; 
}