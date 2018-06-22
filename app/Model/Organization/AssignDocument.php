<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class AssignDocument extends Model
{
	public static $breadCrumbColumn = 'id';
	protected $fillable = ['user_id','document_id'];
    public function __construct(){
    	if(!empty(get_organization_id())){
	    	$this->table = get_organization_id().'_assign_documents';
	    }
    }
    
}
