<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Applicant extends Model
{
   protected $fillable = [ 'user_id', 'status'];
   public static $breadCrumbColumn = 'id';
   public function __construct(){ 
      if(!empty(Session::get('organization_id')))
      {
         $this->table = Session::get('organization_id').'_applicants';
      }
   }
    // public function applicant_info()
    // {
    //  return $this->belongsTo('App\Model\Organization\User','user_id');
    // }
   public function user_relation(){
      return $this->belongsTo('App\Model\Organization\User','user_id');
   }
  
  public function application_rel(){
    return $this->hasMany('App\Model\Organization\Application','applicant_id','id');
   }
}
