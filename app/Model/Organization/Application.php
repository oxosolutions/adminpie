<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Application extends Model
{
    public static $breadCrumbColumn = 'id';
   protected $fillable = [ 'applicant_id', 'opening_id', 'status'];
   public function __construct(){	
	   	if(!empty(get_organization_id())){
	       $this->table = get_organization_id().'_applications';
	   	}
   }
	public function jobs(){
   	
   	return $this->belongsTo('App\Model\Organization\JobOpening','opening_id','id');
   }
   public function applicant(){
	
	return $this->belongsTo('App\Model\Organization\Applicant','opening_id','id');
   }
   public function application_meta(){
     return $this->hasMany('App\Model\Organization\ApplicationMeta', 'application_id', 'id');
   }
}
