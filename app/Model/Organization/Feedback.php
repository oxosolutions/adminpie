<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Feedback extends Model
{
    protected $fillable = ['title','priority','description','order','status'];
    public function __construct()
    {
    	parent::__construct();
    	if(!empty(Session::get('organization_id')))
    	{
            $this->table = Session::get('organization_id').'_feedback'; 
    	}
    }
}
