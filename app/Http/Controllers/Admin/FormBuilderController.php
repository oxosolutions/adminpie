<?php

namespace App\Http\Controllers\Admin;

use Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\FormBuilder;
use App\Model\Admin\forms as forms;
use App\Model\Admin\FormsMeta;
use App\Model\Admin\section as sec;
use App\Model\Admin\SectionMeta as SM;
use App\Model\Admin\FieldMeta as FM;
use Session;
use Auth;

class FormBuilderController extends Controller
{
    protected $valid_fields = [
                            'form_title' => 'required',
                            'form_slug' => 'required|regex:/^[a-z0-9-_]+$/|min:4|max:300'
                        ];
    protected $valid_sections = [
                            'section_name' => 'required',
                            'section_slug' => 'required|unique:global_form_sections|regex:/^[a-z0-9-_]+$/|min:4|max:300'
                        ];
    // protected $valid_form_fields = [
    //                         'field_title' => 'required|min:4|max:300',
    //                         'field_type' => 'required',
    //                         'field_description' => 'required',
    //                         'order' => 'required',
    //                         'field_slug' => 'bail|required|unique:global_form_fields|regex:/^[a-z0-9]+$/|min:4|max:300'
    //                     ];

    public function index(){

        $plugins = ['js' => ['custom'=>['builder']]];
    	return view('admin.formbuilder.create',['plugins' => $plugins,'type'=>'form' ]);
    }

    public function createForm(Request $request)
    {
        $modelName = $this->assignModel('forms');
        $this->validate($request, $this->valid_fields);
        $model = new $modelName;
        $model->fill($request->all());
        $model->save();
        return back();
        /*if(Auth::guard('admin')->check()){
            return redirect()->route('list.forms');
        }else{
            return redirect()->route('org.list.forms');
        }*/
    }

    public function listForm(Request $request)
    {
        //pre filled settings
        /*$settingsArray = [
                'settingsec1f6' => 'Login',
                'show_reset_button' => 'no',
                'show_title' => 'yes',
                'show_description' => 'no',
                'field_variable' => 'slug',
                'show_tooltip' => 'no',
                'show_placeholder' => 'yes',
                'label_position' => 'top',
                'form_theme' => 'light'
        ];
        foreach(forms::get() as $key => $value){
            foreach($settingsArray as $k => $v){
                $formMeta = FormsMeta::firstOrNew(['form_id'=>$value->id,'key'=>$k]);
                $formMeta->form_id = $value->id;
                $formMeta->key = $k;
                $formMeta->value = $v;
                $formMeta->save();
            }
        }*/
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
            $settingsRoute = 'form.settings';
            $cloneRoute = 'form.clone';
        }else{
            $deleteRoute = 'org.delete.form';
            $sectionRoute = 'org.list.sections';
            $settingsRoute = 'org.form.settings';
            $cloneRoute = 'org.form.clone';
        }
        $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['form_title'=>'Form Title','form_slug'=>'Form Slug','created_at'=>'Created At','section[1].id'=>'Section Count'],
                        'actions' => [
                                'delete'=>['title'=>'Delete','route'=>$deleteRoute],
                                'section'=>['title'=>'Sections','route'=>['route'=>$sectionRoute]],
                                'settings'=>['title'=>'Settings','route'=>$settingsRoute],
                                'clone'=>['title'=>'clone','route'=>$cloneRoute],
                                ]
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

    protected function validateAddModule($request){
        $rules = [
            'name' => 'required'
        ];

        $this->validate($request,$rules);
    }

    //start section
    public function createSection(Request $request , $id){
        $this->validateAddModule($request);
        
        $modelName = $this->assignModel('section');
        $lastOrder = $modelName::where(['form_id' => $id])->orderBy('order','DESC')->first();
        if($lastOrder == null){
            $newOrder = 1;
        }else{
            $newOrder = $lastOrder->order+1 ;
        }
        $model = new $modelName;
        $model->form_id = $id;
        $model->section_name = $request->name;
        $model->order = $newOrder;
        $model->save();
        return back();

    	/*$newData = $request->except('section_type');
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
        }*/
    } 

    protected function validateUpdateSection($request){
        $rules = [
            'section_id' => 'required',
            'section_name' => 'required',
            'section_slug' => 'required',
            'section_description' => 'required',
            'section_type' => 'required'
        ];

        $this->validate($request, $rules);
    }

    public function updateSection(Request $request, $form_id){

        $this->validateUpdateSection($request);
        $sectionId = $request->section_id;
        $modelName = $this->assignModel('section');
        $model = $modelName::firstOrNew(['form_id'=>$form_id,'id'=>$sectionId]);
        $model->form_id = $form_id;
        $model->section_name = $request->section_name;
        $model->section_slug = $request->section_slug;
        $model->section_description = $request->section_description;
        $model->save();
        $modelName = $this->assignModel('SectionMeta');
        $model = $modelName::firstOrNew(['section_id'=>$sectionId,'key'=>'section_type']);
        $model->section_id = $sectionId;
        $model->key = 'section_type';
        $model->value = $request->section_type;
        $model->save();
        return back();
    }


    protected function validateCreateField($request){
        $rules = [
            'field_title' => 'required'       
        ];

        $this->validate($request,$rules);
    }

    public function createField(Request $request,$form_id, $section_id){
        $this->validateCreateField($request);
        $modelName = $this->assignModel('FormBuilder');
        $lastOrder = $modelName::where(['form_id' => $form_id , 'section_id' => $section_id])->orderBy('order','DESC')->first();
        if($lastOrder == NULL){
            $newOrder = 1;
        }else{
            $newOrder = $lastOrder->order+1;
        }
        $model = new $modelName;
        $model->form_id = $form_id;
        $model->section_id = $section_id;
        $model->field_title = $request->field_title;
        $model->order = $newOrder;
        $model->save();
        return back();
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
        $formModel = $this->assignModel('forms');
        $form = $formModel::find($form_id);
        $model = $modelName::orderBy('order','ASC')->where('form_id',$form_id)->with(['fields'=>function($query){
            $query->with('fieldMeta')->orderBy('order','ASC');
        },'sectionMeta','form'])->get();
        return view('admin.formbuilder.sections')->with([ 'sections' => $model,'plugins'=> $plugins,'form'=>$form]);
    }

    public function deleteSection($id)
    {
        $modelName = $this->assignModel('section');
        $model = $modelName::with(['fields'])->where('id',$id)->delete();
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

    public function getFieldDataById($form_id,$section_id,$field_id)
    {
        dump($form_id);
        dump($section_id);
        dump($field_id);
        $modelName = $this->assignModel('FormBuilder');
        $model = $modelName::where(['section_id' => $section_id,'form_id'=>$form_id])->with([
                'fieldMeta'=>function($query) use ($form_id, $section_id){
                    $query->where(['form_id'=>$form_id,'section_id'=>$section_id]);
                }])->get();
        $plugins = [
                        'js' => ['custom'=>['builder']] 
                   ];
        return view('admin.formbuilder._row',$model)->render();
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
        dd($request->all());
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
        $modelName = $this->assignModel('FieldMeta');
        $modelName::where('field_id',$id)->delete();
        return back();  
    }

    protected function validateUpdateFields($request){
        $rules = [
            'field_title' => 'required',
            'field_type' => 'required',
            'field_slug' => 'required',
        ];
        $this->validate($request, $rules);
    }

    public function updateField(Request $request, $form_id, $section_id, $field_id){
        $this->validateUpdateFields($request);
        $modelName = $this->assignModel('FormBuilder');
        $model = $modelName::firstOrNew(['form_id'=>$form_id,'section_id'=>$section_id,'id'=>$field_id]);
        $model->field_slug = $request->field_slug;
        $model->field_title = $request->field_title;
        $model->field_type = $request->field_type;
        $model->field_description = $request->field_description;
        $model->order = $request->field_order;
        $model->save();
        $modelName = $this->assignModel('FieldMeta');
        $exceptedKeys = $request->except(['_token','field_slug','field_title','field_type','field_description','field_order']);
        foreach($exceptedKeys as $k => $value){
            $model = $modelName::firstOrNew(['form_id'=>$form_id,'section_id'=>$section_id,'field_id'=>$field_id,'key'=>$k]);
            $model->form_id = $form_id;
            $model->section_id = $section_id;
            $model->field_id = $field_id;
            $model->key = $k;
            if(is_array($value)){
                $value = json_encode($value);
            }
            $model->value = ($value == null)?'':$value;
            $model->save();
        }

        return back();
    }

    protected function assignModel($model){
        if(Auth::guard('admin')->check()){
            return 'App\\Model\\Admin\\'.$model;
        }else{
            return 'App\\Model\\Organization\\'.$model;
        }
    }

    public function formSettings($id){
        $modelName = $this->assignModel('FormsMeta');
        $model = $modelName::with(['forms'])->where('form_id',$id)->get();
        $modelData = [];
        foreach ($model as $key => $value) {
            $modelData[$value->key] = $value->value;
        }
        $modelData['id'] = $id;
        return view('admin.formbuilder.form-settings',['model'=>$modelData]);
    }

    public function storeSettings(Request $request, $id){
        // dd($request->all());
        $modelName = $this->assignModel('FormsMeta');
        // dd($modelName);
        foreach($request->except(['_token']) as $key => $value){
            $model = $modelName::firstOrNew(['key'=>$key,'form_id'=>$id]);
            $model->key = $key;
            $model->value = ($value == null)?'':$value;
            $model->form_id = $id;
            $model->save();
        }
        return back();
    }

    public function uploadMedia(Request $request){

    }
    public function sectionSort(Request $request)
    {
        $Associate = $this->assignModel('section');
        $sort = [];
        $index = 1;
        foreach ($request->id as $key => $value) {
            $sort[$value] = $index;
            $index++;
        }
        foreach ($sort as $key => $value) {
            $model = $Associate::where('id',$key)->update(['order' => $value]);
        }
    }
    public function fieldSortDown( $id)
    {
        $field_id = $id;
        $Associate = $this->assignModel('FormBuilder');
        $section_id = $Associate::select('section_id')->where('id',$field_id)->first()->section_id;
        $form_id = $Associate::select('form_id')->where('id',$field_id)->first()->form_id;
        $order = $Associate::select('order')->where('id',$field_id)->first()->order;
        
        $getFieldsList = $Associate::where(['section_id' => $section_id , 'form_id' => $form_id])->get();
        foreach ($getFieldsList as $key => $value) {
            if($value->order != null){
                if($order < $value->order){

                    $next_order = $Associate::select('order')->where(['order'=>$order+1 ,'section_id' => $section_id , 'form_id' => $form_id])->first()->order;
                    $nextFieldId = $Associate::select('id')->where(['order'=> $order+1 ,'section_id' => $section_id , 'form_id' => $form_id])->first()->id;
                    $updateOrderPre = $Associate::where(['id' => $nextFieldId , 'section_id' => $section_id , 'form_id' => $form_id])->update(['order' => $order]);

                    $updateOrderNext = $Associate::where(['id' => $field_id ,'section_id' => $section_id , 'form_id' => $form_id])->update(['order' => $next_order]);
                }else{
                    Session::flash('null_order' , "NULL order in list field");
                }
            }
        }
        return back();
    }
    public function fieldSortUp( $id)
    {   
        $Associate = $this->assignModel('FormBuilder');
        $field_id = $id;
        $section_id = $Associate::select('section_id')->where('id',$field_id)->first()->section_id;
        $form_id = $Associate::select('form_id')->where('id',$field_id)->first()->form_id;
        $order = $Associate::select('order')->where('id',$field_id)->first()->order;
        
        $getFieldsList = $Associate::where(['section_id' => $section_id , 'form_id' => $form_id])->get();
        foreach ($getFieldsList as $key => $value) {
            if($value->order != null){
                // if($order < $value->order){
                
                    $next_order = $Associate::select('order')->where(['order'=>$order-1 ,'section_id' => $section_id , 'form_id' => $form_id])->first()->order;
                    $prevField = $Associate::select('id')->where(['order'=> $order-1 ,'section_id' => $section_id , 'form_id' => $form_id])->first()->id;
                    $updateOrderPre = $Associate::where(['id' => $prevField , 'section_id' => $section_id , 'form_id' => $form_id])->update(['order' => $order]);

                    $updateOrderNext = $Associate::where(['id' => $field_id ,'section_id' => $section_id , 'form_id' => $form_id])->update(['order' => $next_order]);
                // }else{
                //     Session::flash('null_order' , "NULL order in list field");
                // }
            }
        }
        return back();
    }
    public function getMetaById($model , $id)
    {
        $Associate = $this->assignModel($model);
        $meta = $Associate::where('id',$key)->get();
        return $meta;
    }

    public function getfieldMeta($form_id , $section_id , $field_id)
    {
        $data = [];
        $Associate = $this->assignModel('FieldMeta');
        $meta = $Associate::where(['form_id'=>$form_id,'section_id' => $section_id , 'field_id'=>$field_id])->get()->toArray();
        foreach ($meta as $key => $value) {
            foreach ($value as $k => $v) {
                if($k == 'section_id'){
                    unset($k);
                    $data[$key]['section_id'] = $new_section_id;
                }else{
                    $data[$key][$k] = $v;
                }
            }
        }
        return $data;
    }
    public function fieldClone($id)
    {
        $data = [];
        $Associate = $this->assignModel('FormBuilder');
        $model = $Associate::where('id',$id)->first()->toArray();
        $field_id = $id;
        $form_id = $model['form_id'];
        $section_id = $model['section_id'];

        if($model != null){
            $create = new $Associate;
            $create->fill($model);
            $create->save();
            $new_field_id = $create->id;

            $Associate = $this->assignModel('FieldMeta');
            $meta = $Associate::where(['form_id'=>$form_id,'section_id' => $section_id , 'field_id'=>$field_id])->get()->toArray();
            foreach ($meta as $key => $value) {
                foreach ($value as $k => $v) {
                    if($k == 'field_id'){
                        unset($k);
                        $data[$key]['field_id'] = $new_field_id;
                    }else{
                        $data[$key][$k] = $v;
                    }
                }
            }
            
            foreach($data as $key => $value){
                $meta = new $Associate;
                $meta->fill($data);
                $meta->save();
            }
        }
        return back();
    }
    public function sectionClone($id)
    {
        $Associate = $this->assignModel('section');
        $model = $Associate::where('id',$id)->first()->toArray();

        $form_id = $model['form_id'];
        $section_id = $model['id'];
        $field_id = '';

        if($model != null){

            $create = new $Associate;
            $create->fill($model);
            $create->save();
            $new_section_id = $create->id;
                $data = [];
            $Associate = $this->assignModel('FormBuilder');
            $model = $Associate::where(['form_id'=>$form_id,'section_id' => $section_id])->get()->toArray();
            foreach($model as $key => $value){

                foreach ($value as $k => $v) {
                    if($k == 'section_id' || $k == 'id'){
                        unset($k);
                        $data[$key]['section_id'] = $new_section_id;
                    }else{

                        $data[$key][$k] = $v;
                    }
                }
            }
            foreach ($data as $key => $value) {
                $create = new $Associate;
                $create->fill($value);
                $create->save();
            }
        }
        return back();
    }
    public function formClone($id)
    {
        $modelName = $this->assignModel('forms');
        $formData = $modelName::find($id);

        if(@$formData != null){
            $modelName = $this->assignModel('section');
            $sectionData = $modelName::where('form_id',$id)->get()->toArray();
        }

        if(@$sectionData != null){
            $modelName = $this->assignModel('FormBuilder');
            $fieldData = $modelName::where(['form_id' => $id , 'section_id' => $sectionData[0]['id']])->get()->toArray();
                
                //SectionMeta if exists
                if(@$fieldData != null){
                    foreach ($fieldData as $key => $value) {
                        $meta = $this->assignModel('FieldMeta');
                        $metaData = $meta::where('id' , $value['id'])->get();
                        dump($metaData);
                    }
                }

        }

        dd($fieldData);
    }
}
