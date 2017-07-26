<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
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

    public static function getDatasetTableData($datasetId){
    	$datasetDataTable = self::find($datasetId)->dataset_table;
    	$tableRecords = DB::table(str_replace('ocrm_','',$datasetDataTable))->where('id','!=',1)->paginate(5);
    	$tabaleHeader = DB::table(str_replace('ocrm_','',$datasetDataTable))->where('id',1)->get();
    	$headers = [];
    	foreach($tabaleHeader[0] as $key => $row){
    		if($key == 'id'){
    			$headers[] = ucwords(str_replace('_',' ',$key));
    		}else{
    			$headers[] = ucwords(str_replace('_',' ',$row));
    		}
    	}
    	$records = [];
    	foreach($tableRecords as $key => $row){
    		//unset($row->id);
    		$records[] = array_values((array)$row);
    	}
		return ['records'=>$records,'headers'=>$headers,'tableRecords'=>$tableRecords];
    }
}
