<?php

namespace App\Model\Organization;
use Session;

use Illuminate\Database\Eloquent\Model;

class EmailTemplateMeta extends Model
{
    public static $breadCrumbColumn = 'id';
	protected $fillable = [ 'template_id', 'key', 'value'];

     public function __construct()
	{
	    if(!empty(Session::get('organization_id')))
	    {
	    	$this->table = Session::get('organization_id').'_email_template_meta';
	    }

	}
}
