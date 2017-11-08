<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
class DatasetMeta extends Model
{
    public function __construct(){
    	if(!empty(get_organization_id())){
	    	$this->table = get_organization_id().'_dataset_meta';
	    }
    }

    public function colleborate(){
    	return $this->hasMany('App\Model\Organization\Colleborate','relation_id','dataset_id')->where('type','dataset');
    }
}
