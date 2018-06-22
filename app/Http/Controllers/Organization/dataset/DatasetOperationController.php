<?php

namespace App\Http\Controllers\Organization\dataset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Dataset;
use DB;
use Session;
use Auth;
use Illuminate\Support\Facades\Schema;

class DatasetOperationController extends Controller
{

    public function duplicate( $id){
         $dataset = Dataset::find($id);
        if(empty($dataset)){
            $data['error'] ="This Dataset does'nt exist."; 
        }else{
            $datasetTable = $dataset->dataset_table;
            $without_ocrm_tab_name = str_replace('ocrm_', '', $datasetTable );
            if(empty(Schema::hasTable($without_ocrm_tab_name))){
                $data['error'] = "Dataset table not exist."; 
            }else{
                $column_list =  Schema::getColumnListing(str_replace('ocrm_', '', $datasetTable ));
                unset($column_list[0]);
                $data['duplicate_data'] =  DB::select("select ".implode(', ', $column_list).", count(id) as total_duplicate from ".$datasetTable." group by ".implode(', ', $column_list)." having count(*)>1 ");
            }
        }
        return view('organization.dataset.duplicate_records',compact('data'));
    }
    public function mergeDataset(Request $request)
    {
    	if($request->isMethod('post')){
    		$this->validate($request, ['first_datasets' => 'required', 'second_datasets' => 'required', 'new_dataset_name'=>'required'],['new_dataset_name.required'=>'The New Dataset Name field is required.','first_datasets.required' => 'The First Dataset field is required.', 'second_datasets.required' => 'The Second Dataset field is required.']);
    		// ,['new_dataset_name.required'=>'The New dataset name field is required.','first_datasets.required' => 'The First Dataset field is required.', 'second_datasets.required' => 'The second datasets field is required.']
    		$first_datasets = $request["first_datasets"];
    		$second_datasets = $request["second_datasets"];
    		$org_id = get_organization_id();
    		$first_table = $this->check_table_existence($first_datasets);
    		if(!$first_table){
                Session::flash('error','First table not found!'); 
                return back(); 
            }
            DB::table($first_table)->where('id',1)->update(['status'=>'status', 'parent'=>'parent']);
            $first = json_decode(json_encode( DB::table($first_table)->first()),true);
    		$sec_table = $this->check_table_existence($second_datasets);
    		if(!$sec_table){
                Session::flash('error','Second table not found!');
                return back(); 
            }

            /***** Paljinder Sir Code ****/
            /*DB::table($sec_table)->where('id',1)->update(['status'=>'status', 'parent'=>'parent']);
    		$sec =json_decode(json_encode( DB::table($sec_table)->first()),true);
 			$first_column  = array_filter(array_values($first));
    		unset($first_column[0]);
    		$collection = collect([array_values($first), array_values( $sec)]);
			$collapsed = $collection->collapse();
    		$unique = $collapsed->unique();
    		$unique->shift();
    		$raw_colums = $unique->toArray();
    		$index =1;

            foreach ($raw_colums as $key => $value) {
                if($value=='status' || $value=='parent' ){
                    continue;
                }
                $names = "column_".$index++;
                $colums[]= "`$names` text COLLATE utf8_unicode_ci DEFAULT NULL";
                $insert_val[$names] = $value;
            }*/

            /***** Amrit mam Code ****/
            $sec =json_decode(json_encode( DB::table($sec_table)->first()),true); 
            $exclude = array("status"=>"status", "parent"=>"parent");
            $first_column_with_key  = array_filter($first);
            $second_column_with_key  = array_filter($sec); 

            $first_after_exc = array_diff_key($first_column_with_key, $exclude);
            $sec_after_exc = array_diff_key($second_column_with_key, $exclude);

            $first_column  = array_filter(array_values($first_after_exc)); 
            unset($first_column[0]);
            $second_column  = array_filter(array_values($sec_after_exc));  
            unset($second_column[0]);
            $columns = array_merge($first_column, array_diff($second_column, $first_column)); 
           
            $collection = collect($columns);  
            $raw_colums = $collection->toArray(); 
            $index =1;

            if($raw_colums){
                foreach ($raw_colums as $key => $value) {
                    $names = "column_".$index++;
                    $colums[]= "`$names` text COLLATE utf8_unicode_ci DEFAULT NULL";
                    $insert_val[$names] = $value;
                }
            } else {
                Session::flash('error','No Column exists in tables');
                return view('organization.dataset.merge');
            }
            /***** Amrit mam Code  END****/
    		
    		
            DB::beginTransaction();
    		$table_name = DB::getTablePrefix().$org_id.'_data_table_'.time();
    		$dataset = new Dataset();
    		$dataset->dataset_name = $request["new_dataset_name"];
    		$dataset->dataset_table =  $table_name;
    		$dataset->user_id = Auth::guard('org')->user()->id;
            $dataset->uploaded_by = Auth::guard('org')->user()->name;
            $dataset->save();
            $data_set_id = $dataset->id;
	       	DB::select("CREATE TABLE `{$table_name}` ( " . implode(', ', $colums) . " ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
            DB::select("ALTER TABLE `{$table_name}` ADD `id` INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Row ID' FIRST");
            DB::select("ALTER TABLE `{$table_name}` ADD `status` VARCHAR(100)  NULL  COMMENT 'status' ");
			DB::select("ALTER TABLE `{$table_name}` ADD `parent` VARCHAR(100)  NULL  COMMENT 'parent ID' ");
			$table = str_replace('ocrm_','', $table_name);
            $insert_val['status'] = 'status';
            $insert_val['parent'] = 'parent';
			DB::table($table)->insert($insert_val);
//first dataset insert 
			$status = $this->merge_data_into_table($first_table, $insert_val, $table_name );
            if($status == false){
                DB::rollback();
                Session::flash('error','Columns not matched with current dataset');
                return view('organization.dataset.merge',array('merge_datasets'=>[],'new_dataset_name'=>'', 'data_set_id'=>$data_set_id));
            }
// second dataset insert
			$this->merge_data_into_table($sec_table, $insert_val, $table_name);
			Session::flash('success','Dataset merge successfully  ');
			$merge_datasets =  DB::table(str_replace('ocrm_', '', $table_name))->get();
			$new_dataset_name = $request["new_dataset_name"];
            DB::commit();
			return view('organization.dataset.merge',compact('merge_datasets','new_dataset_name', 'data_set_id'));
    	}
        return view('organization.dataset.merge',compact('dataSets'));
    }

    protected function merge_data_into_table($first_table , $insert_val ,$table_name  ){
		$data_fst = DB::table($first_table)->first();
        DB::table($first_table)->where('id',1)->update(['status'=>'status', 'parent'=>'parent']);
		$tablefst_row =  json_decode(json_encode($data_fst),true);
		$first_intersect = array_intersect($insert_val, $tablefst_row);
		$fst_intersect = array_intersect($tablefst_row, array_values($first_intersect));
        try{ 
            // DB::select("REPLACE INTO ".$table_name." ( ".implode(', ', array_keys($first_intersect)).") SELECT  ".implode(', ', array_keys($fst_intersect))." FROM ocrm_".$first_table." where id !=1");
                DB::select("INSERT INTO ".$table_name." ( ".implode(', ', array_keys($first_intersect)).") SELECT  ".implode(', ', array_keys($fst_intersect))." FROM ocrm_".$first_table." where id !=1");
            return true;
        }catch(\Exception $e){
            return false;
        }
    }
    protected function check_table_existence($first_datasets){
		$first_table = str_replace('ocrm_','', $first_datasets);
		if(!Schema::hasTable($first_table)){
			Session::flash('error','dataset table not exist');
			return false;
		}
		return $first_table;
    }



}
