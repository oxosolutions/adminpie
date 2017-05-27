<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\FormBuilder;
class FormBuilderController extends Controller
{
    public function index(){
        $plugins = ['js' => ['custom'=>['builder']]];
    	return view('admin.formbuilder.create',['plugins' => $plugins ]);
    }

    public function addRow(){

    	return view('admin.formbuilder._row')->render();
    }

    public function store(Request $request){
    	$model = new FormBuilder;
    	$model->key = $request->form_slug;
        $model->form_name = $request->form_name;
    	$model->value = json_encode($request->except(['form_name','form_slug','_token']));
    	$model->save();
    }

    public function formFields(){

    	return view('admin.formbuilder._fields')->render();
    }
    public function formsList(){
        $model = FormBuilder::get();
        return view('admin.formbuilder.list',['model'=>$model]);
    }

    public function editForm($id){
        $model = FormBuilder::find($id);
        $plugins = [
                        'js' => ['custom'=>['builder']],
                        'model' => $model
                   ];
        return view('admin.formbuilder.formbuilder',['plugins' => $plugins ]);
    }

    public function updateForm(Request $request, $id){

        $model = FormBuilder::find($id);
        $model->key = $request->form_slug;
        $model->form_name = $request->form_name;
        $model->value = json_encode($request->except(['form_name','form_slug','_token']));
        $model->save();
    }

    public function sections($slug){

        return view('admin.formbuilder.sections');
    }
}
