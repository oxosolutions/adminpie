<?php

namespace App\Http\Controllers\\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cms\Media;

class MediaController extends Controller
{
    public function uploadMedia(Request $request)
    {
    	dd($request->all());
    }
}
