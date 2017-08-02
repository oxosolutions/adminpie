<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class EmailTemplate extends Model
{
    public static $breadCrumbColumn = 'name';
    public function __construct()
	{
	    if(!empty(Session::get('organization_id')))
	    {
	    	$this->table = Session::get('organization_id').'_email_template';
	    }
	}
    protected $fillable = [ 'name','content','subject','slug','order'];
}
