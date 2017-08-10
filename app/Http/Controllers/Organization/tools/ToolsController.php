<?php

namespace App\Http\Controllers\Organization\tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ToolsController extends Controller
{
    public function tools(){
    	return view('organization.tools.tools');
    }

    public function websiteRank(Request $request){
    	return get_website_alexa_rank($request->url);
    }
}
