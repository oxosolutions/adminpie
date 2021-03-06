<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class EmailLayout extends Model
{
    public static $breadCrumbColumn = 'name';
    public function __construct()
	{
	    if(!empty(get_organization_id()))
	    {
	    	$this->table = get_organization_id().'_email_layout';
	    }
	}
    protected $fillable = [ 'name','header','footer','slug','order'];

    public function ListLayout()
    {
    	return self::pluck('name','id');
    }
}
