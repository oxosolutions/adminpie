<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
use Auth;
class Collaborator extends Model
{
    public function __construct(){
    	if(!empty(Session::get('organization_id'))){
    		$this->table = Session::get('organization_id').'_collaborators';
    	}
    }

    public static function checkAccess($relation_id,$type){
    	return self::where(['type'=>$type,'relation_id'=>$relation_id,'email'=>Auth::guard('org')->user()->email])->first();
    }
}
