<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalOrganization;
use Ixudra\Curl\Facades\Curl;
use File;
use Session;
class ControlPanelController extends Controller
{
	/**
	 * @auther ashish 
	 */
	public function testing()
	{
		return view('admin.control-panel.testing');
	}
	public function consistency(Request $request)
	{
        $listArray = [];
        if($request->isMethod('post')){
            if($request->has('conistancy')){
                $listArray = $this->fileConsistancy($request);
            }
        }
		return view('admin.control-panel.consistency',['dir_list'=>$listArray]);
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

    public function removeSpecificDirectory(Request $request){
        // File::deleteDirectory($request->dir,true);
        // File::deleteDirectory($request->dir);
        Session::flash('success','Directory Removed Successfully!');
        $dirs = $this->fileConsistancy($request);
        return redirect()->back()->with(['dir_list'=>$dirs]);
    }
}
