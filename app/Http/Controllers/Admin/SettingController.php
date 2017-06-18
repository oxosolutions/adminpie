<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
	public function list_setting()
	{
		return view('admin.settings.settings');
	}

}
