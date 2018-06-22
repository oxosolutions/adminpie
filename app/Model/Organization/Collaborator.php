<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
use Auth;
class Collaborator extends Model
{
    public function __construct(){
    	if(!empty(get_organization_id())){
    		$this->table = get_organization_id().'_collaborators';
    	}
    }

    public static function checkAccess($relation_id,$type){
    	return self::where(['type'=>$type,'relation_id'=>$relation_id,'email'=>Auth::guard('org')->user()->email])->first();
    }

    public function survey(){
    	return $this->hasMany('App\Model\Organization\forms','id','relation_id');
    }

    public function dataset(){
        return $this->hasMany('App\Model\Organization\Dataset','relation_id','id');
    }

    public function dataset_meta(){

        return $this->hasMany('App\Model\Organization\DatasetMeta','dataset_id','relation_id')->where('type','dataset');
    }
}
