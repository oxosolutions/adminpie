<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalOrganization;
use App\Model\Admin\GlobalSetting;
use Ixudra\Curl\Facades\Curl;
use GuzzleHttp\Client;
use File;
use Session;
use Schema;
use DB;
class ControlPanelController extends Controller
{
	/**
	 * @auther ashish 
	 */
	public function testing(){
        
		return view('admin.control-panel.testing');
	}
	public function consistency(Request $request){
        $listArray = [];
        $listTables = [];
        if($request->isMethod('post')){
            if($request->has('conistancy')){
                $listArray = $this->fileConsistancy($request);
            }
            if($request->has('conistancy_database')){
                Session::put('remove_token',str_random());
                $listTables = $this->consistantOrganizationTables();
            }
        }
		return view('admin.control-panel.consistency',['dir_list'=>$listArray,'list_tables'=>$listTables]);
	}

    /**
     * Function to run the route test
     * @param  Request $request posted routes list
     * @return [json]  return json data
     */
    public function runRouteTest(Request $request){
        $response = Curl::to('http://master.scolm.com/'.$request->route.'?curl_token=tAGcsNcdEaLGXcUcvmIbYkPySI8ojOLg')->returnResponseObject()->setCookieFile('COOKIE_FILE')->setCookieJar('COOKIE_FILE')->get();
        // dd($response);
        return response()->json($response);
    }
    
    /**
     * Function for get all those files which organization does not exists
     * @param  Request $request having all posted date in for of request object
     * @return [type]           will return directory name or id
     * @author Rahul 
     */
    protected function fileConsistancy($request){
        $model = GlobalOrganization::select('id')->get()->keyBy('id')->keys()->toArray();
        try{
            $directories = File::directories('files');
            $listToRemove = [];
            foreach($directories as $key => $dir){
                $explodeDirName = explode('_',$dir);
                try{
                    if(!in_array((int)$explodeDirName[1],$model)){
                        $listToRemove[] = $dir;
                    }
                }catch(\Exception $e){
                    continue;
                }
            }
        }catch(\Exception $e){
            $listToRemove = [];
        }
        
        return $listToRemove;
    }


    /**
     * To remove single or selected directory by user
     * @param  Request $request having posted data
     * @return [type]           return back to same route
     * @author Rahul
     */
    public function removeSpecificDirectory(Request $request){
        File::deleteDirectory($request->dir,true);
        File::deleteDirectory($request->dir);
        Session::flash('success','Directory Removed Successfully!');
        $dirs = $this->fileConsistancy($request);
        return redirect()->back()->with(['dir_list'=>$dirs]);
    }


    /**
     * To remove multiple selected directories by user
     * @param  Request $request having all posted data
     * @return [type]           back to same route
     * @author Rahul
     */
    public function bulkDeleteDirs(Request $request){
        if(!empty($request->select_dir)){
            foreach($request->select_dir as $key => $dir){
                File::deleteDirectory($dir,true);
                File::deleteDirectory($dir);
            }
            Session::flash('success','Directories Removed Successfully!');
        }else{
            Session::flash('error','Select at least one directory!');
        }
        $dirs = $this->fileConsistancy($request);
        return redirect()->back()->with(['dir_list'=>$dirs]);
    }


    /**
     * To get all tables which organization does not exists
     * @return [array] [return array of filtered tables]
     * @author Rahul
     */
    protected function consistantOrganizationTables(){        
        $model = GlobalOrganization::select('id')->get()->keyBy('id')->keys()->toArray();
        $prefix = DB::getTablePrefix();
        $unusedTables = [];
        $db = env('DB_DATABASE');
        $TablesList = DB::select(" SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='".$db."' and TABLE_NAME like '%".$prefix."%' ");
        foreach($TablesList as $k => $table){
            $str = preg_replace('/(\v|\s)+/', '', $table->TABLE_NAME);
            $explodedString = explode('_',$str);
            if((int)$explodedString[1] != 0){
                if(!in_array((int)$explodedString[1],$model)){
                    $unusedTables[] = $str;
                }
            }
        }
        return $unusedTables;
    }


    public function bulkDeleteTables(Request $request){
        foreach($request->tables as $key => $table){
            Schema::drop(str_replace('ocrm_','',$table));
        }
        Session::flash('success','Tables deleted successfully!');
        $tablesList = $this->consistantOrganizationTables();
        return redirect()->back()->with(['list_tables'=>$tablesList]);
    }


    /**
     * Remove specific table which one selected by user
     * @param  Request $request having posted data
     * @return [type]           return back to same route with session data
     * @author Rahul
     */
    public function removeSpecificTable(Request $request){
        $remove_token = Session::get('remove_token');
        if($request->token == $remove_token){
            DB::select("DROP TABLE ".$request->table);
            Session::flash('success','Table removed successfully');
        }else{
            Session::flash('error','Token mismatch!');
        }
        $tablesList = $this->consistantOrganizationTables();
        return redirect()->back()->with(['list_tables'=>$tablesList]);
    }

    public function methodsTesting(){
        return view('admin.control-panel.method_testing');
    }

    public function methodServe(Request $request){
        $errors = [];
        if($request->has('method') && $request->has('params')){
            $params = json_decode($request->params);
            $params = $this->permutations($params);
            Session::put('organization_id',$request->organization);
            foreach($params as $key => $param){
                try{
                    if(!is_array($param)){
                        $param = (array)$param;
                    }
                    $result = call_user_func_array($request->method,$param);
                    $errors[] = ['status'=>'success','message'=>'Success with that params!','params'=>json_encode($param),'output'=>$result];
                }catch(\Exception $e){
                    $filePath = explode('/',$e->getFile());
                    $count = count($filePath);
                    $file = $filePath[$count-3].'/'.$filePath[$count-2].'/'.$filePath[$count-1];
                    $errors[] = [
                                    'status'=>'error',
                                    'message'=>'Error on passing params!',
                                    'error'=>$e->getMessage(),
                                    'file' => $file,
                                    'line' => $e->getLine(),
                                    'params'=>json_encode($param)
                                ];
                }
            }
        }
        Session::put('organization_id',null);
        return response()->json(['status'=>true,'result'=>$errors,'length'=>count($errors)],200);
    }

    protected function permutations(array $array, $inb=false){
        switch (count($array)) {
            case 1:
                // Return the array as-it-is; returning the first item
                // of the array was confusing and unnecessary
                return $array[0];
                break;
            case 0:
                throw new InvalidArgumentException('Requires at least one array');
                break;
        }
     
        // We 'll need these, as array_shift destroys them
        $keys = array_keys($array);
         
        $a = array_shift($array);
        $k = array_shift($keys); // Get the key that $a had
        $b = $this->permutations($array, 'recursing');
        $return = array();
        foreach ($a as $v) {
            if($v)
            {
                foreach ($b as $v2) {
                    if($inb == 'recursing')
                        $return[] = array_merge(array($v), (array) $v2);
                    else
                        $return[] = array($k => $v) + array_combine($keys, (array)$v2);
                }
            }
        }
     
        return $return;
    }


    public function versionControlling(){
        $model = GlobalSetting::where(['key'=>'db_version'])->first();
        if($model != null){
            $model = $model->toArray();
        }else{
            $model = [];
        }
        return view('admin.control-panel.version-control',['model'=>$model]);
    }

    public function updateVersion(Request $request){
        $model = GlobalSetting::firstOrNew(['key'=>'db_version']);
        if($model->exists()){
            $current_version = $model->value;
            if($current_version == $request->db_version){
                Session::flash('error','Unable to update same version!');
                return back();
            }
            if($request->db_version < $current_version){
                Session::flash('error','Unable to update in reverse version!');
                return back();   
            }
        }
        $checkForPrimaryOrganization = GlobalSetting::where(['key'=>'primary_organization'])->first();
        if($checkForPrimaryOrganization != null){
            if($checkForPrimaryOrganization->value != '' && $checkForPrimaryOrganization->value != null){
                $prefix = DB::getTablePrefix();
                $tablesList = DB::select("select t.TABLE_NAME FROM information_schema.tables t
                      WHERE t.table_schema = '" . env('DB_DATABASE', 'forge') . "'
                      AND t.table_name LIKE '".$prefix.$checkForPrimaryOrganization->value . "%' 
                      ORDER BY t.table_name");
                $stableStructures = [];
                foreach($tablesList as $key => $table){
                    $table = str_replace('ocrm_', '', $table->TABLE_NAME);
                    $columns = DB::getSchemaBuilder()->getColumnListing($table);
                    $table = str_replace($checkForPrimaryOrganization->value.'_','',$table);
                    preg_match('/(data_table_)\w+/',$table,$matches);
                    if(empty($matches)){
                        preg_match('/(survey_results_)\w+/',$table,$matches);
                        if(empty($matches)){
                            preg_match('/(form_data_)\w+/',$table,$matches);
                            if(empty($matches)){
                                $stableStructures[$table] = $columns;
                            }
                        }
                    }
                }
                $columnsJson = json_encode($stableStructures);
                $fileName = date('Y-m-d H-i-s') . '_db_version_' . $request->db_version. '.json';
                File::makeDirectory(public_path('/version/db/'.$request->db_version.'/'),0777, true, true);
                File::put(public_path('/version/db/'.$request->db_version.'/' . $fileName), $columnsJson);
                $model->key = 'db_version';
                $model->value = $request->db_version;
                $model->save();
                Session::flash('success','Database version updated successfully!');
                return back();
            }else{
                Session::flash('error','Unable to update database version! (Primary Organization is not seleted)');
                return back();
            }
        }
    }

    public function getFileReleaseLatestVersion(Request $request){
        $client = new Client;
        $result = $client->get('https://api.github.com/repos/oxosolutions/adminpie/releases/latest');
        $model = GlobalSetting::where(['key'=>'ui_ux_version'])->first();
        $release = json_decode($result->getBody()->getContents(),true);
        if($model == null){
            dd('New Version Found!',$release['tag_name']);
        }else{
            $current_version = $model->value;
            if($release['tag_name'] > $current_version){
                dd('New Version Found!');
            }else{
                dd('No new updates found!');
            }
        }
    }
}
