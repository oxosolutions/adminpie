<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class Widget extends Model
{
    protected $fillable = ['title','code','role_id','slug'];
    
    public function __construct(){

	   	if(!empty(Session::get('organization_id'))){

	      return $this->table = Session::get('organization_id').'_widgets';
	   	}
   	}
}
