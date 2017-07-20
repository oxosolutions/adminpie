<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Applicant extends Model
{
   public static $breadCrumbColumn = 'id';
   public function __construct(){	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_applicants';
	   	}
   }
    // public function applicant_info()
    // {
    // 	return $this->belongsTo('App\Model\Organization\User','user_id');
    // }
   public function user_relation(){
   		return $this->belongsTo('App\Model\Organization\User','user_id');
   }
   protected $fillable = [ 'user_id', 'status'];
}
