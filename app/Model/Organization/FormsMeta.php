<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
class FormsMeta extends Model
{
    // protected $table	= 'global_form_meta';
    protected $fillable = ['form_id', 'key', 'value', 'type'];

    public function __construct(){
    	// try{
    	// 	if(Auth::guard('org')->check()){
		    	if(!empty(Session::get('organization_id'))){

		    		$this->table = Session::get('organization_id').'_form_meta';
                   
		    	}
            
		   //  }
    	// }catch(\Exception $e){
    	// }
    }

    public function forms(){
        return $this->belongsTo('App\Model\Organization\forms','form_id','id');
    }

    public function collabrate(){
        return $this->hasMany('App\Model\Organization\Collaborator','relation_id','form_id')->where('type','survey');
    }
}
