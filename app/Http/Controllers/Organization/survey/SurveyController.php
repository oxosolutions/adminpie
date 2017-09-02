<?php

namespace App\Http\Controllers\Organization\survey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\forms as forms;
use App\Model\Organization\Survey;
use App\Model\Organization\FormsMeta;
use Illuminate\Support\Facades\Schema;
use Auth;
use DB;
class SurveyController extends Controller
{

   public function listSurvey(Request $request)
    {
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
                $model = forms::where('form_title','like','%'.$request->search.'%')->where('type','survey')->orderBy($sortedBy,$request->order)->with(['section'])->paginate($perPage);
            }else{
                $model = forms::where('form_title','like','%'.$request->search.'%')->where('type','survey')->with(['section'])->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = forms::where('type','survey')->orderBy($sortedBy,$request->order)->with(['section'])->paginate($perPage);
            }else{
                 $model = forms::where('type','survey')->paginate($perPage);
            }
        }
        
        $deleteRoute = 'org.delete.form';
        $sectionRoute = 'org.list.sections';
        $settingsRoute = 'org.form.settings';
        $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['form_title'=>'Survey Title','form_slug'=>'Survey Slug','created_at'=>'Created At','section[1].id'=>'Section Count'],
                        'actions' => ['edit'=>['title'=>'Edit','route'=>$sectionRoute],'preview'=>['title'=>'View','route'=>'survey.perview'],'delete'=>['title'=>'Delete','route'=>$deleteRoute],'form_settings'=>['title' => 'Form Setting' , 'route' => $settingsRoute]],
                        'title' => 'Survey'
                    ];
                    /*
                        don't delete this (by Rahul)
                     'delete'=>['title'=>'Delete','route'=>$deleteRoute],'section'=>['title'=>'Sections','route'=>['route'=>$sectionRoute]],'settings'=>['title'=>'Settings','route'=>$settingsRoute],'survey_settings'=>['title'=>'Survey Settings','route'=>'survey.settings']*/

        return view('admin.formbuilder.list',$datalist);
    }
    public function createSurvey()
    {
    	 return view('organization.survey.survey_add',['type'=>'survey']);
    }
    public function surveySettings($survey_id){
        $model = FormsMeta::where(['form_id'=>$survey_id,'type'=>'survey'])->get();
        $modelData = [];
        foreach($model as $key => $value){
            $modelData[$value->key] = $value->value;
        }
        return view('organization.survey.survey_settings',['model'=>$modelData]);
    }
    public function display_survey()
    {
        return view('organization.survey.display_survey');
    }

    public function save_survey(Request $request){
        $table_name = 'ocrm_'.get_organization_id().'_'.$request['form_slug'];
        $survey_id = $request['form_id'];
        if(!FormsMeta::where(['form_id'=>$request['form_id'],'key'=>'survey_data_table', 'value'=>$table_name])->exists())
        {
            $formMeta = new FormsMeta();
            $formMeta->form_id = $request['form_id'];
            $formMeta->key = 'survey_data_table';
            $formMeta->value = $table_name;
            $formMeta->save();
        }
            unset($request['_token'],$request['form_id'],$request['form_slug'],$request['form_title'] );
        foreach ($request->all() as $key => $value) {
                 $colums[] =   "`$key` text COLLATE utf8_unicode_ci DEFAULT NULL";
                 if(is_array($value))
                 {
                    $value = json_encode($value);
                 }
                 $values[$key] = $value;
                 $keys[] = $key;
            }
            $newTableName = str_replace('ocrm_', '', $table_name);
            if(Schema::hasTable($newTableName))
             {
                $table_column = Schema::getColumnListing($newTableName);
                $columnsdata  = collect($keys);
                $new_columns   = $columnsdata->diff($table_column)->toArray();
                if(!empty($new_columns)){
                    foreach ($new_columns as $key => $value) {
                        DB::select("ALTER TABLE `{$table_name}` ADD $value text COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'alter field'");
                    }
                }
              }else{ 
                DB::select("CREATE TABLE `{$table_name}` ( " . implode(', ', $colums) . " ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                DB::select("ALTER TABLE `{$table_name}` ADD `id` INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Row ID' FIRST");
                }
                DB::table($newTableName)->insert($values);
              return redirect()->route('stats.survey',['id'=>$survey_id]);
    }

    public function survey_api()
    {
        return forms::with('section')->get();

    }

    public function saveSurveySettings(Request $request, $survey_id){
        $requestedData = $request->except(['form_id','form_id','form_title']);
        foreach($requestedData as $key => $value){
            $meta = FormsMeta::firstOrNew(['form_id'=>$survey_id, 'key'=>$key, 'type'=>'survey']);
            $meta->form_id = $survey_id;
            $meta->key = $key;
            if (is_array($value)) {
                $value = json_encode($value);
            }
            $meta->value = $value;
            $meta->type = 'survey';
            $meta->save();
        }
        return back();
    }
    public function surveyPerview($form_id)
    {
        $slug = forms::select('form_slug')->find($form_id);
        if($slug != null){
            $slug = $slug->form_slug;
        }
        return view('organization.survey.survey_view',compact('slug'));
    }
    public function resultSurvey()
    {
        return view('organization.survey.survey_result');
    }
    public function shareSurvey()
    {
        return view('organization.survey.share');
    }
}
