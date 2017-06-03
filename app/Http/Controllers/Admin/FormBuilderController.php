<?php

namespace App\Http\Controllers\Admin;

use Artisan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\FormBuilder;
use App\Model\Admin\forms as forms;
use App\Model\Admin\section as sec;
use App\Model\Admin\FieldMeta as FM;
class FormBuilderController extends Controller
{

    public function index(){
        $plugins = ['js' => ['custom'=>['builder']]];
    	return view('admin.formbuilder.create',['plugins' => $plugins ]);
    }

    public function createForm(Request $request)
    {
        $model = new forms;
        $model->fill($request->all());
        $model->save();
        return redirect()->route('list.forms');
    }

    public function listForm()
    {
        $model = forms::with(['section'])->get();
        return view('admin.formbuilder.list')->with('model',$model);
    }

    public function deleteForm($id)
    {
        $model = forms::where('id',$id)->delete();
        return redirect()->route('list.forms');
    }

    // end form 

    //start section
    public function createSection(Request $request){
        $model = new sec;
        $model->fill($request->except('slug'));
        $model->save();

        return redirect()->route('list.sections',['slug'=>$request->slug]);
    } 
    public function sectionsList($slug)
    {
         $plugins = [
                        'js' => ['custom'=>['builder']],
                   ];
        $id_slug = forms::select('id','form_slug')->where('form_slug',$slug)->get();
        $id = $id_slug[0]->id;
        $model = sec::where('form_id',$id)->with(['fields'])->get();
        // dd($model);
        return view('admin.formbuilder.sections')->with(['id_slug'=>$id_slug , 'section' => $model,'plugins'=> $plugins]);
    }
    public function deleteSection($id)
    {
        $model = sec::where('id',$id)->delete();
        return back();
    }

//fields
    public function addRow(){

        return view('admin.formbuilder._row')->render();
    }
    
    public function listFields(Request $request)
    {
        $id = $request->id;
        $model = FormBuilder::where('section_id',$id)->with('fieldMeta')->get();
        return view('admin.formbuilder._row')->with(['model'=> $model])->render();
    }
    public function fieldMeta(Request $request)
    {
        $meta = FM::select('key','value')->where('field_id',$request->id)->get();
        return view('admin.formbuilder._row')->with(['model'=> $meta]);
    }
    public function fieldList(Request $request , $id)
    {
        $plugins = [
                        'js' => ['custom'=>['builder']],
                   ];
        $sections = sec::where('id',$id)->first();
        return view('admin.formbuilder.fields')->with(['plugins'=> $plugins,'section' => $sections]);
    }




//previous code

    public function store(Request $request){
        $model = new FormBuilder;   
        $model->fill($request->all());
        $model->save(); 
        $field_id = formbuilder::where(['field_slug' => $request->field_slug])->first();
            unset($request['field_slug'], $request['form_id'], $request['section_id'], $request['field_title'],$request['type'],$request['field_description'],$request['_token']); 
            if($model){
                    foreach ($request->all() as $key => $value) {

                        $meta = new FM;
                        $meta->field_id = $field_id->id;
                        $meta->key = $key;
                        if($value == ""){
                           $meta->value = ""; 
                        }elseif($value){
                            $meta->value = $value;
                        }
                        $meta->save();
                    }
            }
            return "successfully entered for single error message and single validation";
    }

    public function formFields(){

    	return view('admin.formbuilder._fields')->render();
    }
    public function formsList(){
        $model = FormBuilder::get();
        dd($model);
        return view('admin.formbuilder.list',['model'=>$model]);
    }

    // public function editForm($id){
    //     $model = FormBuilder::find($id);
    //     $plugins = [
    //                     'js' => ['custom'=>['builder']],
    //                     'model' => $model
    //                ];
    //     return view('admin.formbuilder.formbuilder',['plugins' => $plugins ]);
    // }

    // public function updateForm(Request $request, $id){

    //     $model = FormBuilder::find($id);
    //     $model->key = $request->form_slug;
    //     $model->form_name = $request->form_name;
    //     $model->value = json_encode($request->except(['form_name','form_slug','_token']));
    //     $model->save();
    // }

    // public function sections($slug){

    //     return view('admin.formbuilder.sections');
    // }
}
