<?php

namespace App\Http\Controllers\Organization\survey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\forms as forms;
use App\Model\Organization\Survey;
use App\Model\Organization\FormsMeta;
use Illuminate\Support\Facades\Schema;
use App\Model\Organization\Collaborator;
use App\Model\Organization\section;
use Auth;
use DB;
use App\Http\Controllers\Api\SurveyController as apisurvey;
use Session;
class SurveyController extends Controller
{   
    protected $apisurvey;
    public function __construct(apisurvey $apisurvey)
    {
        $this->apisurvey = $apisurvey;
    }
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
                $model = forms::where('form_title','like','%'.$request->search.'%')->where(['type'=>'survey','created_by'=>get_user_id()])->orderBy($sortedBy,$request->order)->with(['section'])->paginate($perPage);
            }else{
                $model = forms::where('form_title','like','%'.$request->search.'%')->where(['type'=>'survey','created_by'=>get_user_id()])->with(['section'])->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = forms::where('type','survey')->orderBy($sortedBy,$request->order)->where('created_by',get_user_id())->with(['section'])->paginate($perPage);
            }else{
                 $model = forms::where('type','survey')->where('created_by',get_user_id())->paginate($perPage);
            }
        }
        $collab = Collaborator::select('relation_id')->where(['type'=>'survey','email'=>Auth::guard('org')->user()->email])->get()->groupBy('relation_id')->toArray();
        if(!empty($collab)){
            $appendSurveys = forms::whereIn('id',array_keys($collab))->get();
            foreach($appendSurveys as $keyItem => $item){
                $model->push($item);
            }
        }
        
        $deleteRoute = 'org.delete.form';
        $sectionRoute = 'org.list.sections';
        $settingsRoute = 'org.form.settings';
        $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['form_title'=>'Survey Title','form_slug'=>'Survey Slug','created_at'=>'Created At','section[1].id'=>'Section Count'],
                        'actions' => ['edit'=>['title'=>'Edit','route'=>'survey.sections.list'],'preview'=>['title'=>'View','route'=>'survey.perview'], 'delete'=>['title'=>'Delete','route'=>$deleteRoute]],
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
        $permission = $this->collaboratorAccesses($survey_id,'settings');
        $model = FormsMeta::where(['form_id'=>$survey_id])->get();
        $modelData = [];
        foreach($model as $key => $value){
            $modelData[$value->key] = $value->value;
        }
        return view('organization.survey.survey_settings',['model'=>$modelData,'permission'=>$permission]);
    }
    public function display_survey()
    {
        return view('organization.survey.display_survey');
    }

    public function sectionsList($form_id){
    
        $permission = $this->collaboratorAccesses($form_id,'edit');
        $plugins = [
                        'js' => ['custom'=>['builder']],
                   ];
        $form = forms::find($form_id);
        $model = section::orderBy('order','ASC')->where('form_id',$form_id)->with(['fields'=>function($query){
            $query->with('fieldMeta')->orderBy('order','ASC');
        },'sectionMeta','form'])->get();
        return view('admin.formbuilder.sections')->with([ 'sections' => $model,'plugins'=> $plugins,'form'=>$form,'permission'=>$permission]);
    }

    public function save_survey(Request $request){
        $form_id = $request['form_id'];
         unset($request['_token'],$request['form_id'],$request['form_slug'],$request['form_title'] );
        $res = $this->apisurvey->create_alter_insert_survey_table(get_organization_id(), $form_id,$request->all());

        Session::flash('sucess','Successfuly Save Survey');
        return back();
    }

    public function delete_survey_table($table_name){
        $newTableName = str_replace('ocrm_', '', $table_name);
         if(Schema::hasTable($newTableName)){
                FormsMeta::where('value',$table_name)->delete();
                $renames = $table_name.''.date('Y_m_d_h_i_s');
                DB::select("Rename table $table_name to $renames");
            }
        return back();
    }
    public function survey_api() {
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
        $permission = $this->collaboratorAccesses($form_id,'preview');

        $slug = forms::select('form_slug')->find($form_id);
      
        if($slug != null){
            $slug = $slug->form_slug;
        }

        return view('organization.survey.survey_view',compact('slug','form_id'))->with(['permission'=>$permission]);
    }
    public function resultSurvey()
    {
        return view('organization.survey.survey_result');
    }
    public function shareSurvey($id)
    {   
        $permission = true;
        $collab = Collaborator::where(['type'=>'survey','relation_id'=>$id,'email'=>Auth::guard('org')->user()->email])->first();
        if($collab != null){
            $permission = false;
        }
        $survey = forms::find($id);
        if($survey->embed_token == '' || $survey->embed_token == null){
            $survey->embed_token = str_random();
            $survey->save();
        }
        $collab = Collaborator::where(['type'=>'survey','relation_id'=>$id])->get();
        return view('organization.survey.share',['token'=>$survey->embed_token,'collab'=>$collab,'permission'=>$permission]);
    }

    public function embededSurvey($token){
        dd($token);
    }

    public function saveShareTo(Request $request, $id){

        $model = Collaborator::firstOrNew(['type'=>'survey','relation_id'=>$id,'email'=>$request->email_user_share]);
        $model->type = 'survey';
        $model->relation_id = $id;
        $model->email = $request->email_user_share;
        $model->access = json_encode($request['user-share-edit-view']);
        $model->status = 1;
        $model->save();
        return back();
    }

    public function deleteShareTo($id){
        $model = Collaborator::find($id);
        $model->delete();
        return back();
    }

    protected function collaboratorAccesses($formId,$singleAccess){
        $permission = true;
        $collab = Collaborator::select('access')->where(['type'=>'survey','email'=>Auth::guard('org')->user()->email,'relation_id'=>$formId])->first();
        if($collab != null){
            $access = json_decode($collab->access,true);
            if(!in_array($singleAccess,$access)){
                $permission = false;
            }
        }
        return $permission;
    }
}
