<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class DocumentTemplate extends Model
{
    public static $breadCrumbColumn = 'name';
    public function __construct()
	{
	    if(!empty(Session::get('organization_id')))
	    {
	    	$this->table = Session::get('organization_id').'_document_template';
	    }
	}
    protected $fillable = [ 'name','content','subject','slug','order'];
    
    public function listTemplate()
    {
    	return $this->pluck('name','id');
    }
}
