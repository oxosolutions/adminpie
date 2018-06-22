<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class DocumentLayout extends Model
{
    public static $breadCrumbColumn = 'name';
    public function __construct()
	{
	    if(!empty(get_organization_id()))
	    {
	    	$this->table = get_organization_id().'_document_layout';
	    }
	}
    protected $fillable = [ 'name','header','footer','slug','order'];

    public function listLayout()
    {
    	return $this->pluck('name','id');
    }
}
