<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function index()
    {
        return view('group.index');
    }

    public function create()
    {
        return view('group.create');
    }
    public function store(Request $request)
    {
    	$model = new Model;
    	$model->fill($request->all('_token','modules'));
        $model->modules = json_decode($request['modules']);
    	$model->save();
    	return back();
    }
}
