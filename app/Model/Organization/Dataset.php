<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
class Dataset extends Model
{
	public static $breadCrumbColumn = 'id';
    public function __construct(){
    	if(!empty(Session::get('organization_id'))){

	    	$this->table = Session::get('organization_id').'_datasets';
	    }
    }

    public static function datasetList(){

    	return self::orderBy('id')->pluck('dataset_name','id');
    }
}
