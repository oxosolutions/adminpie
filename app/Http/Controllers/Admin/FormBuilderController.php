<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\FormBuilder;
class FormBuilderController extends Controller
{
    public function index(){
        $plugins = ['js' => ['custom'=>['builder']]];
    	return view('admin.formbuilder.formbuilder',['plugins' => $plugins ]);
    }

    public function addRow(){

    	return view('admin.formbuilder._row')->render();
    }

    public function store(Request $request){

    	dd($request->all());

    }

    public function formFields(){

    	return view('admin.formbuilder._fields')->render();
    }
}
