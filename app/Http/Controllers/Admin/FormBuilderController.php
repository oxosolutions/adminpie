<?php

namespace App\Http\Controllers\Admin;

use Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\FormBuilder;
use App\Model\Admin\forms as forms;
use App\Model\Admin\section as sec;
use App\Model\Admin\SectionMeta as SM;
use App\Model\Admin\FieldMeta as FM;
use Session;
use Auth;

class FormBuilderController extends Controller
{
    protected $valid_fields = [
                            'form_title' => 'required',
                            'form_slug' => 'required|unique:global_forms|regex:/^[a-z0-9-_]+$/|min:4|max:300'
                        ];
    protected $valid_sections = [
                            'section_name' => 'required',
                            'section_slug' => 'required|unique:global_form_sections|regex:/^[a-z0-9-_]+$/|min:4|max:300'
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
        $modelName = $this->assignModel('forms');
        $this->validate($request, $this->valid_fields);
        $model = new $modelName;
        $model->fill($request->all());
        $model->save();
        if(Auth::guard('admin')->check()){
            return redirect()->route('list.forms');
        }else{
            return redirect()->route('org.list.forms');
        }
    }

    public function listForm(Request $request)
    {
        $modelName = $this->assignModel('forms');
        $sortedBy = @$request->orderby;
        if($request->has('items')){
          $perPage = $request->items;
          if($perPage == 'all'){
            $perPage = 999999999999999;
          }
        }else{
          $perPage = 5;
        }
        if($request->has('search')){
            if($sortedBy != ''){
                $model = $modelName::where('form_title','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->with(['section'])->paginate($perPage);
            }else{
                $model = $modelName::where('form_title','like','%'.$request->search.'%')->with(['section'])->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = $modelName::orderBy($sortedBy,$request->order)->with(['section'])->paginate($perPage);
            }else{
                 $model = $modelName::paginate($perPage);
            }
        }
        if(Auth::guard('admin')->check()){
            $deleteRoute = 'delete.form';
            $sectionRoute = 'list.sections';
        }else{
            $deleteRoute = 'org.delete.form';
            $sectionRoute = 'org.list.sections';
        }
        $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['form_title'=>'Form Title','form_slug'=>'Form Slug','created_at'=>'Created At','section[1].id'=>'Section Count'],
                        'actions' => ['delete'=>['title'=>'Delete','route'=>$deleteRoute],'section'=>['title'=>'Sections','route'=>$sectionRoute]]
                    ];

        // $model = forms::with(['section'])->get();
        return view('admin.formbuilder.list',$datalist);
    }
    
    public function deleteForm($id)
    {
        $modelName = $this->assignModel('forms');
        $model = $modelName::where('id',$id)->delete();
        if(Auth::guard('admin')->check()){
            return redirect()->route('list.forms');
        }else{
            return redirect()->route('org.list.forms');
        }
    }

    // end form 

    //start section
    public function createSection(Request $request , $id){
    	$newData = $request->except('section_type');
        $this->validate($request, $this->valid_sections);
        $modelName = $this->assignModel('section');
        $model = new $modelName;
        $model->fill($newData);
        $model->form_id = $id;
        $model->save();
        if($model){
        	$section_id = $modelName::select('id')->orderBy('id','DESC')->limit('1')->get();
        	$section_id = $section_id[0]->id;
        	$newMeta = $request->except('section_name','section_slug','section_description','_token');
	  		foreach($newMeta as $key => $value){
                $modelName = $this->assignModel('SectionMeta');
	  			$sectionMeta = new $modelName;
	  			$sectionMeta->section_id = $section_id;
	  			$sectionMeta->key = $key;
	  			$sectionMeta->value = $value;
	  			$sectionMeta->save();
	  		}
        }
        if(Auth::guard('admin')->check()){
            return redirect()->route('list.sections',['form_id' => $id]);
        }else{
            return redirect()->route('org.list.sections',['form_id' => $id]);
        }
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
        $modelName = $this->assignModel('section');
        $model = $modelName::where('form_id',$form_id)->with(['fields'])->get();
        return view('admin.formbuilder.sections')->with([ 'section' => $model,'plugins'=> $plugins]);
    }

    public function deleteSection($id)
    {
        $modelName = $this->assignModel('section');
        $model = $modelName::where('id',$id)->delete();
        return back();
    }


    public function addRow(Request $request){
        $rowCount = $request->rowCount;
        return view('admin.formbuilder._rowAppend' , ['rowCount'=>$rowCount])->render();
    }


    public function listFields(Request $request , $form_id, $section_id)
    {  
        $modelName = $this->assignModel('FormBuilder');
    	$model = $modelName::where(['section_id' => $section_id,'form_id'=>$form_id])->with([
                'fieldMeta'=>function($query) use ($form_id, $section_id){
                    $query->where(['form_id'=>$form_id,'section_id'=>$section_id]);
                }])->get();
    	$plugins = [
                        'js' => ['custom'=>['builder']] 
                   ];
            //check if the existing field data has same slug

        $slug_data=[];
        $existSlug = '';
        Session::put('sameSlugmessage', "");
        $checkExstingSlug = $modelName::select('field_slug')->where(['form_id'=> $form_id,'section_id' => $section_id])->get();
            foreach($checkExstingSlug  as $key => $array){
                $slug_data[] = $array->field_slug;
            }
        $result_slug = count($slug_data) === count(array_flip($slug_data));
        // dd($slug_data);
        if($result_slug == false){
            $existSlug = "dublicate slug recognized , please verify and rename the slug";
        }else{
            $existSlug = "";
        }
        Session::put('sameSlugmessage', $existSlug);        
        return view('admin.formbuilder.formbuilder', $plugins)->with(['model'=>$model,'plugins'=>$plugins]);
    }



    public function fieldMeta(Request $request)
    {
        $modelName = $this->assignModel('FieldMeta');
        $meta = $modelName::select('key','value')->where('field_id',$request->id)->get();
        return view('admin.formbuilder._row')->with(['model'=> $meta]);
    }
    public function fieldList(Request $request , $id)
    {

       	$plugins = [
                        'js' => ['custom'=>['builder']],
                   ];
        $modelName = $this->assignModel('section');
        $sections = $modelName::where('id',$id)->first();
        return view('admin.formbuilder.formbuilder')->with(['plugins'=> $plugins,'section' => $sections]);
    }

//previous code

    public function store(Request $request){
        $modelName = $this->assignModel('FormBuilder');
        $model = new $modelName;   
        $model->fill($request->all());
        $model->save(); 
        $modelName = $this->assignModel('formbuilder');
        $field_id = $modelName::where(['field_slug' => $request->field_slug])->first();
            unset($request['field_slug'],$request['field_title'],$request['field_type'],$request['field_description'],$request['_token']); 
            if($model){
                foreach ($request->all() as $key => $value) {
                    $modelName = $this->assignModel('FieldMeta');
                    $meta = new $modelName;
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
        $modelName = $this->assignModel('FormBuilder');
        $model = $modelName::get();
        dd($model);
        return view('admin.formbuilder.list',['model'=>$model]);
    }
    public function deleteField(Request $request){
        $id = $request->id;
        $modelName = $this->assignModel('FormBuilder');
        $modelName::where('id',$id)->delete();
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
            $modelName = $this->assignModel('FormBuilder');
            $ifExist = $modelName::where(['form_id'=>$form_id,'section_id' =>$section_id, 'id'=>$request->field_id[$k]])->first();
            if($ifExist != null){
                $status = 'false';
                $model = $modelName::where(['form_id'=>$form_id,'section_id' =>$section_id, 'id'=>$request->field_id[$k]])->update($dataArray);
            }else{
                $status = 'true';
                $dataArray['section_id'] = $section_id;
                $dataArray['form_id'] = $form_id;
                $model = $modelName::insertGetId($dataArray);
            }
            if($status == 'false'){
                $model = $request->field_id[$k];
            }
            $modelName = $this->assignModel('FieldMeta');
            $del_meta = $modelName::where(['form_id'=>$form_id,'section_id' => $section_id ,'field_id' => $model])->delete();
            $newRequest = $request->except('field_slug','_token','field_title','field_type','field_description','field_id');
            foreach ($newRequest as $key => $value) {
                $meta = new $modelName;
                $meta->form_id = $form_id;
                $meta->section_id = $section_id;
                $meta->field_id = $model;
                $meta->key = $key;
                if(@$value[$k] == ""){
                   $meta->value = ""; 
                }elseif(@$value[$k]){
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
        $modelName = $this->assignModel('FormBuilder');
        $checkExstingSlug = $modelName::select('field_slug')->where(['form_id'=> $form_id])->get();
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
        if(Auth::guard('admin')->check()){
            return redirect()->route('list.field',['form_id' => $form_id,'section_id' => $section_id]);
        }else{
            return redirect()->route('org.list.field',['form_id' => $form_id,'section_id' => $section_id]);
        }  
    }

    protected function assignModel($model){
        if(Auth::guard('admin')->check()){
            return 'App\\Model\\Admin\\'.$model;
        }else{
            return 'App\\Model\\Organization\\'.$model;
        }
    }
}
