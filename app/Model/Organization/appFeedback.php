<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class appFeedback extends Model
{
    protected $fillable = ['org_id','name','mobile','department','message','status'];

    public function __construct()
    {
    	parent::__construct();
    	if(!empty(Session::get('organization_id')))
    	{
            $this->table = Session::get('organization_id').'_app_feedback'; 
    	}
    }
}
