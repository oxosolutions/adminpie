<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class JobOpening extends Model
{
   public static $breadCrumbColumn = 'id';
   public function __construct()
   {	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_openings';
	   	}
   }
   protected $fillable = [ 'title', 'department', 'designation', 'skills', 'job_type', 'location', 'number_of_post', 'eligiblity'];
   public function applications(){
   	return $this->hasMany('App\Model\Organization\Application','opening_id','id');
   }
   public function opening_meta(){
      return $this->hasMany('App\Model\Organization\JobOpeningMeta','opening_id','id');
   }
}
