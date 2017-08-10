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
        $datasetDetails = self::find($datasetId);
        $datasetDataTable = $datasetDetails->dataset_table;
    	$datasetName = $datasetDetails->dataset_name;
        $tabaleHeader = DB::table(str_replace('ocrm_','',$datasetDataTable))->first();
        $firstRecordId = 1;
        if($tabaleHeader != null){
            $firstRecordId = $tabaleHeader->id;
        }
    	$tableRecords = DB::table(str_replace('ocrm_','',$datasetDataTable))->where('id','!=',$firstRecordId)->paginate(30);
    	$headers = [];
        if($tabaleHeader != null){
            foreach($tabaleHeader as $key => $row){
                if($key == 'id'){
                    $headers[] = ucwords(str_replace('_',' ',$key));
                }else{
                    $headers[] = ucwords(str_replace('_',' ',$row));
                }
            }
        }
    	$records = [];
    	foreach($tableRecords as $key => $row){
    		//unset($row->id);
    		$records[] = array_values((array)$row);
    	}
		return ['records'=>$records,'headers'=>$headers,'tableRecords'=>$tableRecords,'firstRecord'=>$firstRecordId,'dataset_name'=>$datasetName];
    }
}
