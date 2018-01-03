<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
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
}
