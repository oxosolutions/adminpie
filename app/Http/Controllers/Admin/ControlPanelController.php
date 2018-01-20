<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalOrganization;
use Ixudra\Curl\Facades\Curl;
use File;
use Session;
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
}
