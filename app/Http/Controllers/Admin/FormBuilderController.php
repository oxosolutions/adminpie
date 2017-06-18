<?php

namespace App\Http\Controllers\Admin;

use Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\FormBuilder;
use App\Model\Admin\forms as forms;
use App\Model\Admin\section as sec;
use App\Model\Admin\FieldMeta as FM;
use Session;

class FormBuilderController extends Controller
{
    protected $valid_fields = [
                            'form_title' => 'required',
                            'form_slug' => 'required|unique:global_forms|regex:/^[a-z0-9]+$/|min:4|max:300'
                        ];
    protected $valid_sections = [
                            'section_name' => 'required',
                            'section_slug' => 'required|unique:global_form_sections|regex:/^[a-z0-9]+$/|min:4|max:300'
                        ];
    // protected $valid_form_fields = [
    //                         'field_title' => 'required|min:4|max:300',
    //                         'field_type' => 'required',
    //                         'field_description' => 'required',
    //                         'field_order' => 'required',
    //                         'field_slug' => 'bail|required|unique:global_form_fields|regex:/^[a-z0-9]+$/|min:4|max:300'
    //                     ];

    public function index(){
        $plugins = ['js' => ['custom'=>['builder']]];
    	return view('admin.formbuilder.create',['plugins' => $plugins ]);
    }

    public function createForm(Request $request)
    {
        $this->validate($request, $this->valid_fields);
        $model = new forms;
        $model->fill($request->all());
        $model->save();
        return redirect()->route('list.forms');
    }

    public function listForm(Request $request)
    {
        $sortedBy = @$request->sort_by;
        if($request->has('search')){
            if($sortedBy != ''){
                $model = forms::where('form_title','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->with(['section'])->paginate(3);
            }else{
                $model = forms::where('form_title','like','%'.$request->search.'%')->with(['section'])->paginate(3);
            }
        }else{
            if($sortedBy != ''){
                $model = forms::orderBy($sortedBy,$request->desc_asc)->with(['section'])->paginate(3);
            }else{
                 $model = forms::paginate(3);
            }
        }
        $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['form_title'=>'Form Title','form_slug'=>'Form Slug','created_at'=>'Created At','section[1].id'=>'Section Count'],
                        'actions' => ['delete'=>['title'=>'Delete','route'=>'delete.form'],'section'=>['title'=>'Sections','route'=>'list.sections']]
                    ];

        // $model = forms::with(['section'])->get();
        return view('admin.formbuilder.list',$datalist);
    }

    public function deleteForm($id)
    {
        $model = forms::where('id',$id)->delete();
        return redirect()->route('list.forms');
    }

    // end form 

    //start section
    public function createSection(Request $request , $id){
        $this->validate($request, $this->valid_sections);
        $model = new sec;
        $model->fill($request->except('slug'));
        $model->form_id = $id;
        $model->save();
 
        return redirect()->route('list.sections',['form_id' => $id]);
    } 

    /*
    *   To show all sections list  on the behalf 
    *   of form slug
    *
    *   @Last Update: Rahul Sharma 08 June 2017
    */
    public function sectionsList($form_id){
         $plugins = [
                        'js' => ['custom'=>['builder']],
                   ];
        $model = sec::where('form_id',$form_id)->with(['fields'])->get();
        return view('admin.formbuilder.sections')->with([ 'section' => $model,'plugins'=> $plugins]);
    }

    public function deleteSection($id)
    {
        $model = sec::where('id',$id)->delete();
        return back();
    }


    public function addRow(Request $request){
        $rowCount = $request->rowCount;
        return view('admin.formbuilder._rowAppend' , ['rowCount'=>$rowCount])->render();
    }


    public function listFields(Request $request , $form_id, $section_id)
    {  
    	$model = FormBuilder::where(['section_id' => $section_id,'form_id'=>$form_id])->with([
                'fieldMeta'=>function($query) use ($form_id, $section_id){
                    $query->where(['form_id'=>$form_id,'section_id'=>$section_id]);
                }])->get();
    	$plugins = [
                        'js' => ['custom'=>['builder']] 
                   ];
        return view('admin.formbuilder.formbuilder', $plugins)->with(['model'=>$model,'plugins'=>$plugins]);
    }



    public function fieldMeta(Request $request)
    {
        $meta = FM::select('key','value')->where('field_id',$request->id)->get();
        return view('admin.formbuilder._row')->with(['model'=> $meta]);
    }
    public function fieldList(Request $request , $id)
    {
    	dd("hello");

       	$plugins = [
                        'js' => ['custom'=>['builder']],
                   ];
        $sections = sec::where('id',$id)->first();
        return view('admin.formbuilder.formbuilder')->with(['plugins'=> $plugins,'section' => $sections]);
    }

//previous code

    public function store(Request $request){
        $model = new FormBuilder;   
        $model->fill($request->all());
        $model->save(); 
        $field_id = formbuilder::where(['field_slug' => $request->field_slug])->first();
            unset($request['field_slug'],$request['field_title'],$request['field_type'],$request['field_description'],$request['_token']); 
            if($model){
                    foreach ($request->all() as $key => $value) {

                        $meta = new FM;
                        $meta->form_id = $request->form_id;
                        $meta->section_id = $request->section_id;
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
            return back();
    }

    public function formFields(){

    	return view('admin.formbuilder._fields')->render();
    }
    public function formsList(){
        $model = FormBuilder::get();
        dd($model);
        return view('admin.formbuilder.list',['model'=>$model]);
    }
    public function deleteField(Request $request){
        $id = $request->id;
        FormBuilder::where('id',$id)->delete();
        return back();  
    }
    public function updateField(Request $request, $form_id, $section_id){
        //save and update fields
        foreach($request->field_id as $k => $value){
            $status = 'true';
            $dataArray = [];
            $dataArray['field_slug'] = $request->field_slug[$k];
            $dataArray['field_title'] = $request->field_title[$k];
            $dataArray['field_type'] = $request->field_type[$k];
            $dataArray['field_description'] = $request->field_description[$k];
            $dataArray['field_order'] = $request->field_order[$k];
            $ifExist = FormBuilder::where(['form_id'=>$form_id,'section_id' =>$section_id, 'id'=>$request->field_id[$k]])->first();
            if($ifExist != null){
                $status = 'false';
                $model = FormBuilder::where(['form_id'=>$form_id,'section_id' =>$section_id, 'id'=>$request->field_id[$k]])->update($dataArray);
            }else{
                $status = 'true';
                $dataArray['section_id'] = $section_id;
                $dataArray['form_id'] = $form_id;
                $model = FormBuilder::insertGetId($dataArray);
            }
            if($status == 'false'){
                $model = $request->field_id[$k];
            }
            $del_meta = FM::where(['form_id'=>$form_id,'section_id' => $section_id ,'field_id' => $model])->delete();
            $newRequest = $request->except('field_slug','_token','field_title','field_type','field_description','field_id');
            foreach ($newRequest as $key => $value) {
                $meta = new FM;
                $meta->form_id = $form_id;
                $meta->section_id = $section_id;
                $meta->field_id = $model;
                $meta->key = $key;
                if($value[$k] == ""){
                   $meta->value = ""; 
                }elseif($value[$k]){
                    if(is_array($value[$k])){
                        $meta->value = json_encode($value[$k]);
                        // dd($meta->value);
                    }else{
                        $meta->value = $value[$k];

                    }
                }
                $meta->save();
            }
        }

        //check if the existing field data has same slug
        $slug_data=[];
        $existSlug = '';
        $checkExstingSlug = FormBuilder::select('field_slug')->where(['form_id'=> $form_id])->get();
            foreach($checkExstingSlug  as $key => $array){
                $slug_data[] = $array->field_slug;
            }
            
            $result_slug = count($slug_data) === count(array_flip($slug_data));
        if($result_slug == false){
            $existSlug = "dublicate slug recognized , please verify and rename the slug";
        }else{
            $existSlug = "";
        }
        Session::put('sameSlugmessage', $existSlug);
        return redirect()->route('list.field',['form_id' => $form_id,'section_id' => $section_id]);        
    }

    // public function deletefield($id){
    //     FormBuilder::where(['id',$id])->delete();
    //     return back();
    // }
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
