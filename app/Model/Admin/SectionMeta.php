<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class SectionMeta extends Model
{
	// public function __construct(){
 //    	try{
 //    		if(Auth::guard('org')->check()){
	// 	    	if(!empty(Session::get('organization_id'))){
	// 	    		$this->table = Session::get('organization_id').'_forms';
	// 	    	}
	// 	    }
 //    	}catch(\Exception $e){
    		
 //    	}
 //    }
    
    protected $table = 'global_form_section_meta';
}
