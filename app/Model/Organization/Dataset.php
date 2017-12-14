<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
class Dataset extends Model
{
   

	public static $breadCrumbColumn = 'id';
    public function __construct(){
    	if(!empty(get_organization_id())){
	    	$this->table = get_organization_id().'_datasets';
	    }
    }

    public static function datasetList(){
        return self::orderBy('id')->pluck('dataset_name','id');
    }

    public static function datasetTableList(){

    	return self::orderBy('id')->pluck('dataset_name','dataset_table');
    }

    public static function getDatasetTableData($datasetId){        
        $datasetDetails = self::find($datasetId);
        $datasetDataTable = $datasetDetails->dataset_table;
    	$datasetName = $datasetDetails->dataset_name;
        try{
            $tabaleHeader = DB::table(str_replace('ocrm_','',$datasetDataTable))->first();
        }catch(\Exception $e){
            return false;
        }
        $firstRecordId = 1;
        if($tabaleHeader != null){
            $firstRecordId = $tabaleHeader->id;
        }
    	$tableRecords = DB::table(str_replace('ocrm_','',$datasetDataTable))->where('id','!=',$firstRecordId)->where('status','!=',0)->paginate(30);
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

		return ['records'=>$records,'headers'=>$headers,'tableRecords'=>$tableRecords,'firstRecord'=>$firstRecordId,'dataset_name'=>$datasetName,'columns'=>$tabaleHeader];
    }

    public static function getDatasetHeaders(){
        $ArrayData = self::getDatasetTableData(request()->route()->parameters()['id']);
        $records = $ArrayData['records'];
        $headers = $ArrayData['headers'];
        $headers = array_combine(array_keys((array)$ArrayData['columns']),$headers);
        if(empty($headers)){
            $headers['id'] = 'Id';
        }
        unset($headers['status']);
        unset($headers['parent']);
        $headers['id'] = 'At First';
        return $headers;
    }

    public static function getDatasetColumns(){
        $ArrayData = self::getDatasetTableData(request()->route()->parameters()['id']);
        return collect($ArrayData['columns'])->except(['id','status','parent']);
    }

    public function dataset_meta(){

        return $this->hasMany('App\Model\Organization\DatasetMeta','dataset_id','id');
    }

    public function collaborate(){
        return $this->hasMany('App\Model\Organization\Collaborator','relation_id','id')->where('type','dataset');
    }
}
