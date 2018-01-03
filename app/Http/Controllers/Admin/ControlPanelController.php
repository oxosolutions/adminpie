<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalOrganization;
use Ixudra\Curl\Facades\Curl;
use File;
class ControlPanelController extends Controller
{
	/**
	 * @auther ashish 
	 */
	public function testing()
	{
		return view('admin.control-panel.testing');
	}
	public function consistency()
	{
		return view('admin.control-panel.consistency');
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
    public function fileConsistancy(Request $request){
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
}
