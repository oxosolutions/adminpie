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
    	if(!empty(get_organization_id()))
    	{
            $this->table = get_organization_id().'_feedback'; 
    	}
    }
}
