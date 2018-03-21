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
use App\Model\Organization\FieldMeta;
use App\Model\Organization\FormBuilder;
use App\Model\Organization\SectionMeta;
use Auth;
use DB;
use App\Http\Controllers\Api\SurveyController as apisurvey;
use Session;
use Carbon\Carbon;
use File;
use Response;
/**
* Paljinder singh only work  on following Method
*     survey_filled_data_save
*     embededSurvey
*     set_survey
*     check_field_type
*     go_to_next
*     question_condition
*     check_field_conditions
*/
/*
    |--------------------------------------------------------------------------
    | Survey draw & for Navigation question , Questions conditions by Used method and their brief description
    |--------------------------------------------------------------------------
    |   @Method list   
    |    @ embededSurvey
    |    @ forget_session_survey
    |    @ put_session_survey
    |    @ survey_filled_data_save 
    |  Following Method used inside survey_filled_data_save Method
    |    @ create_alter_insert_survey_table  Dependency Method 
    |    @ set_survey
    |    @ check_field_type
    |    @ go_to_next
    |    @ question_condition
    |    @ check_field_conditions
    |    @ set_filled_question
    |    @ max_val_in_array
    |    @ array_first_row
    */

class SurveyController extends Controller
{   
    protected $apisurvey;
    protected $valid_fields = [
        'form_title' => 'required',
        'form_slug' => 'required|regex:/^[a-z0-9-_]+$/|min:4|max:300'
    ];
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
            $perPage = get_items_per_page();
        }
        $model = forms::where(['type'=>'survey', 'created_by'=>Auth::guard('org')->user()->id])->with(['section'])->orWherehas('formsMeta', function($query){
            $query->where('key','share_type')->where('value','=','public')->where('value','!=','only_me')->orWhereHas('collabrate',function($query){
                $query->whereHas('survey', function($query){
                    $query->whereHas('formsMeta',function($query){
                        $query->where('key','share_type')->where('value','!=','only_me');
                    });
                });
            });
        })->orderBy('id','DESC')->paginate($perPage);
        $deleteRoute = 'org.delete.form';
        $sectionRoute = 'org.list.sections';
        $settingsRoute = 'org.form.settings';
        $cloneRoute = 'org.form.clone';
        $datalist =  [
            'datalist'=>$model,
            'showColumns' => ['form_title'=>'Survey Title','form_slug'=>'Survey ID','created_at'=>'Created'],
            'actions' => [
                'edit'=>['title'=>'Edit','route'=>'survey.sections.list'],
                'preview'=>['title'=>'View','route'=>'survey.perview'],
                'settings' => ['title'=>'Settings','route'=>'survey.settings'],
                'stats' => ['title'=>'Stats','route'=>'stats.survey'],
                'structure' => ['title'=>'Structure','route'=>'structure.survey'],
                'data'=>['title'=>'Raw Data','route'=>'results.survey'],
                'report'=>['title'=>'Report','route'=>'survey.reports'],
                'share'=>['title'=>'Collaborate','route'=>'share.survey'],
                'customize'=>['title'=>'Customize','route'=>'custom.survey'],
                'clone'=>['title'=>'Clone','route'=>$cloneRoute],
                'delete'=>['title'=>'Delete','route'=>$deleteRoute,'class'=>'red']
            ],
            'title' => 'Survey',
        ];
        /*
        don't delete this (by Rahul)
        'delete'=>['title'=>'Delete','route'=>$deleteRoute],'section'=>['title'=>'Sections','route'=>['route'=>$sectionRoute]],'settings'=>['title'=>'Settings','route'=>$settingsRoute],'survey_settings'=>['title'=>'Survey Settings','route'=>'survey.settings']*/
        return view('admin.formbuilder.list',$datalist);
    }



    public function createSurvey(){

        return view('organization.survey.create',['type'=>'survey']);
    }



    public function storeSurvey(Request $request){
        $created_by = get_user_id();
        $request['created_by'] = $created_by;
        $this->validate($request, $this->valid_fields);
        $model = new forms;
        $model->fill($request->all());
        $model->save();
        // return redirect()->route('list.forms');
        Session::flash('success','Form created successfully');
        Session::flash('success','Survey created successfully');
        return redirect()->route('list.survey');
    }



    public function surveySettings($survey_id){

        $permission = $this->collaboratorAccesses($survey_id,'settings');
        $model = FormsMeta::where(['form_id'=>$survey_id]);
        $modelData = [];
        foreach($model->get() as $key => $value){
            $modelData[$value->key] = $value->value;
        }
        $form = forms::find($survey_id);

        return view('organization.survey.survey_settings',['model'=>$modelData,'permission'=>$permission,'form' => $form]);
    }

    // public function reset_setting($survey_id){

    //     return $survey_id;
    // }



    public function display_survey(){
        return view('organization.survey.display_survey');
    }



    public function sectionsList($form_id){
        $permission = $this->collaboratorAccesses($form_id,'edit');
        $plugins = [
            'js' => ['custom'=>['builder']],
        ];
        $form = forms::find($form_id);
        if(empty($form)){
            $error =  __('survey.survey_not_exit');
            return view('admin.formbuilder.sections',compact('error'));
        }
        $model = section::orderBy('order','ASC')->where('form_id',$form_id)->with(['fields'=>function($query){
            $query->with('fieldMeta')->orderBy('order','ASC');
        },'sectionMeta','form'])->get();
        return view('admin.formbuilder.sections')->with([ 'sections' => $model,'plugins'=> $plugins,'form'=>$form,'permission'=>$permission]);
    }



    public function survey_filled_by_view(Request $request){
        if(Session::has('inserted_id')){
            Session::forget('inserted_id');
        }
        $form_id    =   $request['form_id'];
        unset($request['_token'],$request['form_id'],$request['form_slug'],$request['form_title'],  $request['section_id'], $request['section_slug']);
        $this->apisurvey->create_alter_insert_survey_table(get_organization_id(), $form_id,$request->all());
        Session::flash('success','Survey filled successfully.');
        return back();
    }


// set_survey this is used for set priority to display Question/section 
    public function set_survey($form_id, $id , $slug, $type){
        if($type=='section'){
            Session::flash('wild_section'.$form_id, ['section_id'.$form_id=>$id, 'section_slug'.$form_id=> $slug]);
        }elseif($type=='field'){
            Session::flash('wild_field'.$form_id, ['field_id'.$form_id=>$id , 'field_slug'.$form_id=> $slug]);
        }
        return back();
    }



    public function survey_filled_data_save(Request $request) {
        $form_id    =   $request['form_id'];
        if(isset($request['section_id'])){
            $section_id  =   $request['section_id'];
        }
        unset($request['_token'],$request['form_id'],$request['form_slug'],$request['form_title'],  $request['section_id'], $request['section_slug']);
        $this->apisurvey->create_alter_insert_survey_table(get_organization_id(), $form_id,$request->all());
        Session::flash('sucess','Submitted Sucessfully');
        if(Session::has('section'.$form_id)){
            $all_sec = Session::get('section'.$form_id);
            Session::forget('section'.$form_id);
            unset($all_sec[$section_id]);
            if(empty($all_sec)){
                $this->forget_session_survey('section', $form_id);
                Session::flash('sucess', 'Successfull Complete survey.');
            }else{
                Session::put('section'.$form_id, $all_sec);
            }
        }
        if(Session::has('field'.$form_id)){
            $field_check = $fields = Session::get('field'.$form_id);
            Session::forget('field'.$form_id);
            unset($fields[$request->field_id]);
            if(empty($fields) && !Session::has('wild_field'.$form_id)){
                $this->forget_session_survey('question', $form_id);
                Session::flash('sucess', 'Successfull Complete survey.');
            }else{
                $this->set_filled_question($request->field_id, $form_id);
                $next_field =  $this->array_first_row($fields); //current(array_keys($fields));
                $preserve = Session::get('preserve_field'.$form_id);
                $slugg = $preserve[$request['field_id']];

                $keys = array_keys($preserve);
                $key = array_search($request['field_id'], $keys);
                if(isset($keys[$key+1])){
                    $next_fields = $keys[$key+1];
                }
// check field type for radio & checkbox                
                $field_type = $this->check_field_type($request['field_id']);
               if($field_type){
                    $check_fields =  $this->go_to_next($request['field_id'], $request[$slugg], $preserve , $fields);
                    if($check_fields!=1){
                        $fields = $check_fields;
                        if(empty($fields)){
                            Session::flash('sucess', 'Successfull filled survey.');
                             $this->forget_session_survey('question', $form_id);
                             back();
                        }    
                    }
//check condition and get there value 
                $questions = $this->question_condition($next_fields); /// $next_field['key']
                if(!empty($questions)){
                   if($request['field_id'] == $questions[0]['condition_column']  )
                   {
                    if($field_type=="checkbox"){
                        if(in_array($questions[0]['condition_value'], $request[$slugg])){
                             $this->set_survey($form_id, $next_fields , $preserve[$next_fields], 'field');
                        }
                    }elseif($questions[0]['condition_operator'] == "=="){
                        
                        if($request[$slugg]  ==  $questions[0]['condition_value']){
                            $this->set_survey($form_id, $next_fields , $preserve[$next_fields], 'field');
                        }else{
                             unset($fields[$next_field['key']]);
                        }
                    }
                   }
                }
                }
                Session::put('field'.$form_id, $fields);
            }
        }
        return back();
    }



    protected function set_filled_question($field_id, $form_id){
        $section_field = Session::get('all'.$form_id);
        $keys  =  array_keys($section_field);
        foreach ($keys as $key => $value) {
            if(array_has($section_field , $value.'.'.$field_id)){
                data_set($section_field, $value.'.'.$field_id,'filled');                
            } 
        }
        Session::put('all'.$form_id, $section_field);
    }



    protected function check_field_type($field_id) {
        $field =  FormBuilder::where('id', $field_id)->whereIn('field_type',['radio','checkbox','select']);
        if($field->exists()){
            return $field->first()->field_type;
        }
        return;
    }



    protected function max_val_in_array($array){
        $max = 0;
        foreach ($array as $key => $value) {
            $new_val = str_after($value, 'QID');
            if($new_val > $max){
                $max = $new_val;
            }
        }
        return $max;
    }



    protected function go_to_next($field_id , $option_val , $preserve, $fields) {
      $field_options = FieldMeta::where(['field_id'=>$field_id , 'key'=>'field_options']);
      if($field_options->exists()){
            $field_meta = $field_options->first();
            $option_array = json_decode($field_meta->value, true);
            $option = array_filter(array_pluck($option_array ,'go_to_question' ,'key'));
            if(empty($option) || empty($option[$option_val])) {
                return 1;
            }
            $select_ans_que_id = str_after($option[$option_val], 'QID');
            $this->set_survey($field_meta->form_id, $select_ans_que_id , $preserve[$select_ans_que_id], 'field');
            $max_ques_id = $this->max_val_in_array($option);
            for ($i=intval($field_id); $i <= intval($max_ques_id) ; $i++) { 
                if($i < $select_ans_que_id){
                    unset($fields[$i]);
                }else{
                    if(empty($fields[$i]) ) {
                        array_prepend($fields, $preserve[$i], $i );
                    }
                }
            }
        }
        return $fields;
    }



    protected function array_first_row($array){
        return ['key'=>current(array_keys($array)), 'value'=>current(array_values($array))]; 
    }



    protected function question_condition($field_id){
         $condition_value = $this->check_field_conditions($field_id);
         //dump($field_id, $condition_value);
           if(empty($condition_value)){
                return;
           }else{
              return $condition_value;
           }
        return;
    }



    public static function check_field_conditions($field_id){
        $meta = FieldMeta::where(['field_id'=>$field_id , 'key'=>'field_conditions'])->first();
        if(empty($meta->value)){
            return;
        }
        return json_decode($meta->value, true);
    }



    public function delete_survey_table($table_name){
        $newTableName = str_replace('ocrm_', '', $table_name);
        if(Schema::hasTable($newTableName)){
            FormsMeta::where('value',$table_name)->delete();
            $renames = $table_name.'_'.date('Y_m_d_h_i_s');
            DB::select("Rename table $table_name to $renames");
        }
        return back();
    }



    public function survey_api() {
        return forms::with('section')->get();
    }


    public function saveSurveySettings(Request $request, $survey_id){
        
        $requestedData = $request->except(['form_id','form_id','form_title']);
        $reset = false;
        if(isset($requestedData['reset'])){
            $reset = true;
        }
        foreach($requestedData as $key => $value){

            $meta = FormsMeta::firstOrNew(['form_id'=>$survey_id, 'key'=>$key, 'type'=>'survey']);
            $meta->form_id = $survey_id;
            $meta->key = $key;
            if($reset){
                $value = null;
            }else{
            if (is_array($value)) {
                $value = json_encode($value);
            }
                
            }
            $meta->value = $value;
            $meta->type = 'survey';
            $meta->save();
        }
        return back();
    }



    public function surveyPerview($form_id){

        $permission = $this->collaboratorAccesses($form_id,'preview');
        $slug = forms::select('form_slug')->find($form_id);
        if($slug != null){
            $slug = $slug->form_slug;
        }else{
            $error = __('survey.survey_not_exit');
            return view('organization.survey.survey_view', compact('error'));
        }
        return view('organization.survey.survey_view',compact('slug','form_id'))->with(['permission'=>$permission]);
    }



    public function resultSurvey(){
        return view('organization.survey.survey_result');
    }



    public function shareSurvey($id){   
        $permission = true;
        $collab = Collaborator::where(['type'=>'survey','relation_id'=>$id,'email'=>Auth::guard('org')->user()->email])->first();
        if($collab != null){
            $permission = false;
        }
        $survey = forms::with(['formsMeta'])->find($id);
        if(empty($survey)){
            return view('organization.survey.share',['error'=>"Data not exist"]);
        }else if($survey->embed_token == '' || $survey->embed_token == null){
            $survey->embed_token = str_random();
            $survey->save();
        }
        $sharedSurvey = Collaborator::where(['type'=>'survey','relation_id'=>$id,'userid'=>Auth::guard('org')->user()->id])->get();
        return view('organization.survey.share',['token'=>$survey->embed_token,'collab'=>$sharedSurvey,'permission'=>$permission,'survey' => $survey]);
    }



    protected function forget_session_survey($parm , $form_id){
        if($parm=='section'){
            Session::forget(['form_id'.$form_id]);
            Session::forget(['inserted_id'.$form_id]);
            Session::forget('section'.$form_id);
        }elseif($parm='question'){
            Session::forget('preserve_field'.$form_id);
            Session::forget('form_fiel_id'.$form_id);
            Session::forget('field'.$form_id);
            Session::forget('inserted_id'.$form_id);
            Session::forget('all'.$form_id);
        }
        return true;
    }



    protected function put_session_survey($option , $form_id,  $data){
        if($option =='section'){
            Session::put(['form_id'.$form_id=> $form_id, 'section'.$form_id=>$data ]);
        }elseif($option =='question'){
            Session::put(['form_fiel_id'.$form_id=> $form_id, 'field'.$form_id=>$data ]);
        }
    }


    protected function validateSurveyConditions($metaArray){
        $errorsArray = [];
        //Check Survey Enabled
        if(!@$metaArray['enable_survey'] == 1){
            $errorsArray['enable_survey'] = 'Survey not enabled!';
        }

        //Check Schedule Enable
        if(@$metaArray['survey_scheduling'] == 1){
            $startDate = @$metaArray['start_date'];
            $expireDate = @$metaArray['expire_date'];
            $startTime = @$metaArray['survey_start_time'];
            $expireTime = @$metaArray['survey_expire_time'];
            $surveyStatus = $this->findScheduleCases($startDate, $expireDate, $startTime, $expireTime);
        }
        dd($metaArray);
    }

    protected function findScheduleCases($startDate, $expireDate, $startTime, $expireTime){

        $scheduleCase = '';
        if($startDate == "" && $expireDate != "" && $startTime == "" && $expireTime =="" ){
            $scheduleCase = "A"; // only have expiredate;
        }
        if($startDate != "" && $expireDate != "" && $startTime == "" && $expireTime =="" ){
            $scheduleCase = "B"; //have startdate and expiredate
        }
        if($startDate != "" && $expireDate == "" && $startTime == "" && $expireTime =="" ){
            $scheduleCase = "C"; //have startdate
        }   
        if($startDate == "" && $expireDate == "" && $startTime != "" && $expireTime  != "" ){
            $scheduleCase = "D"; //have starttime,expiretime
        }
        if($startDate == "" && $expireDate == "" && $startTime != "" && $expireTime  == "" ){
            $scheduleCase = "E"; //have starttime;
        }
        if($startDate == "" && $expireDate == "" && $startTime == "" && $expireTime  !="" ){
            $scheduleCase = "F"; // have expire time
        }
        if($startDate != "" && $expireDate != "" && $startTime != "" && $expireTime  != "" ){
            
            $scheduleCase = "G"; //have startdate, expiredate, starttime, endtime
        }
        if($startDate != "" && $expireDate != "" && $startTime != "" && $expireTime  == "" ){
            $scheduleCase = "H";  //have startdate,expiredate,starttime
        }
        if($startDate != "" && $expireDate != "" && $startTime == "" && $expireTime  != "" ){
            $scheduleCase = "I"; //startdate,expiredate,expiretime
        }
        if($startDate != "" && $expireDate == "" && $startTime != "" && $expireTime  != "" ){
            $scheduleCase = "J"; //startdate,startime,expiretime
        }
        if($startDate == "" && $expireDate != "" && $startTime == "" && $expireTime  != "" ){
            $scheduleCase = "K"; //expiredate,expiretime
        }
        if($startDate == "" && $expireDate != "" && $startTime != "" && $expireTime  == "" ){
            $scheduleCase = "L"; //have expiredate,starttime 
        }
        if($startDate == "" && $expireDate == "" && $startTime == "" && $expireTime  == "" ){
            $scheduleCase = "M";  //expiredate ,expiretime startdate starttime
        }
        if($startDate == "" && $expireDate != "" && $startTime != "" && $expireTime != "" ){
            $scheduleCase = "N";  //expiredate ,starttime expiretime
        }

        return $this->validateSurveyDateTime($scheduleCase, $startDate, $expireDate, $startTime, $expireTime);
    }

    protected function validateSurveyDateTime($case, $startDate, $expireDate, $startTime, $expireTime){
        switch($case){

            case'A':

            break;

            case'B':

            break;

            case'C':

            break;

            case'D':
            break;

            case'E':
            break;

            case'F':
            break;

            case'G':
                $today =  Carbon::today();
                dd($startDate);
                if(Carbon::parse($startDate) < $today){
                    dd('Days Pending', Carbon::parse($startDate)->diffInDays($today));
                }
                if(Carbon::parse($expireDate) > $today){
                    dd('Survey Expired bdefore days',$today->diffInDays(Carbon::parse($expireTime)));
                }
            break;

            case'H':
            break;

            case'I':
            break;

            case'J':
            break;

            case'K':
            break;

            case'L':
            break;

            case'M':
            break;

            case'N':
            break;
        }
    }

    /**
    * To preview survey for fill records
    * 
    * @param  [string] $token [Survey token to get survey details]
    * @return [view]        [will return view of HTML]
    * @author Paljinder,Rahul ---> From 21 March 2018
    */
    public function embededSurvey($token, $from_status = false){
        
        $surveyRecord = forms::select(['form_slug','id'])->with(['formsMeta','section.fields'])->where('embed_token',$token)->first();
        if($surveyRecord != null){
            $metaValues = get_meta_array($surveyRecord->formsMeta);
            $errorStatus = $this->validateSurveyConditions($metaValues);
        }




        $current_data = [];
        $form = forms::select(['form_slug', 'id'])->with(['formsMeta','section.fields'])->where('embed_token',$token);
        if($form != null){
            $survey = $form = $form->first();
            $survey_slug = $form->form_slug;
            $form_id = $form['id'];

            $survey_setting = $form['formsMeta']->pluck('value','key')->toArray();
            if(!empty($survey_setting['save_survey']) && ($survey_setting['save_survey']=='section') ){
                if(Session::has('form_fiel_id'.$form_id)){
                    $this->forget_session_survey('question', $form_id);
                }
                $sections['section'] = $form->section->mapWithKeys(function($item){
                    return [$item['id']=>$item['section_slug']];
                })->toArray();
                
                 if(!Session::has('section'.$form_id)){
                    $this->put_session_survey('section', $form_id, $sections['section']);
                 }
            }elseif(!empty($survey_setting['save_survey']) && ($survey_setting['save_survey']=='question')){
              // $this->forget_session_survey('question', $form_id);
                if(!Session::has('field'.$form_id)){
                    $this->forget_session_survey('question', $form_id);
                }
                if(Session::has('form_id'.$form_id)){
                    $this->forget_session_survey('section', $form_id);
                }
                if(!Session::has('form_fiel_id'.$form_id))
                    {
                    foreach ($form->section as $key => $value) {
                        foreach ($value['fields'] as $field_key => $field_value) {
                            $total[$value['id']][$field_value['id']] = null;
                            $field[$field_value['id']] = $field_value['field_slug'];
                        }
                    }
                    Session::put('all'.$form_id, $total);
                    Session::put('form_fiel_id'.$form_id, $form_id);
                    Session::put('field'.$form_id, $field);
                    Session::put('preserve_field'.$form_id, $field);
                }
            }else{
                $this->forget_session_survey('question', $form_id);
                $this->forget_session_survey('section', $form_id);
            }
            $maintain_error =  $error = $this->survey_error($survey_setting, $form_id );
            if(!empty($error) && $error !=1){  
                if(!empty($survey_setting['custom_error_messages'] ==true) && is_array($error)){
                    $error = array_intersect_key($survey_setting, $error);   
                    if(empty($error)){
                        $error = $maintain_error; 
                    }
                }
            }else{
                $error = NULL;
            }
            //unique_id $data->survey_id.''.date('YmdHis').''.substr((string)microtime(), 2, 6).''.rand(1000,9999); 
        }else{
            $error['survey_id_not_exist'] = "Invalid survey ID.";
            return view('organization.survey.shared_survey',compact('error'));
        }
        if(isset($survey_setting['survey_timer']) && ($survey_setting['survey_timer']==true)){
            if(isset($survey_setting['timer_type']) && ($survey_setting['timer_type']=="survey_expiry_time")){
                $expire_date_time = $survey_setting['expire_date'].' '.$survey_setting['survey_expire_time'];
                $expire_date = Carbon::parse($expire_date_time);
                $dt = Carbon::now();
                $survey_setting['survey_time_lefts'] = $expire_date->diffForHumans($dt);
            }
        }
        if(Session::has('inserted_id'.$form_id)){
            $table_name = $survey_setting['survey_data_table'];
            $tab = str_replace('ocrm_', '', $table_name);
            Schema::hasTable(str_replace('ocrm_', '', $table_name));
            if(Schema::hasTable(str_replace('ocrm_', '', $table_name))){
                $data = DB::table($tab)->where('id',Session::get('inserted_id'.$form_id))->first();
                $current_data = json_decode(json_encode($data),true);
            }

        }
       //dump( Session::all());
        if($from_status){
            return view('organization.survey.shared_survey_without_layout',compact('survey_slug' , 'form_id', 'survey_setting', 'survey', 'current_data','error'))->render();
        }else{
            // return view('organization.survey.shared_survey',compact('survey_slug' , 'form_id', 'survey_setting', 'survey', 'current_data','error'));
            return view('organization.survey.survey_draw',compact('survey_slug' , 'form_id', 'survey_setting', 'survey', 'current_data','error'));
        }
    }
    


    protected function survey_error($setting , $survey_id) {
        // dump(12, empty($setting['enable_survey']), $setting['enable_survey']);
        //dd($setting);
        if(isset($setting['enable_survey']) && $setting['enable_survey']==0  ){
            return ["survey_is_disabled"=>"Survey is disabled."];
        }
        if(isset($setting['authentication_required']) && ($setting['authentication_required']==true)){
            if(isset($setting['authentication_type']) && ($setting['authentication_type']=='user')){
                if(!Auth::guard('org')->check()){
                    return ["survey_authorization_required"=>"You have to login to access the survey."];
                }else{
                    $user_id = Auth::guard('org')->user()->id;
                    $user_list = json_decode($setting['individual_list'],true);
                    if(empty($user_list) || !in_array($user_id, $user_list)){
                        return ["survey_un-authorization_user"=>"You do not have permissions to access the survey."];
                    }
                }
            }elseif(isset( $setting['authentication_type']) && ($setting['authentication_type']=='role')){
                if(!Auth::guard('org')->check()){
                    return ["survey_authorization_required"=>"Sign-in to fill surrvey"];
                }
                $role_list = array_map('intval', json_decode($setting['role_list'],true));
                if(count(array_intersect(role_id(), $role_list))==0){
                    return ["survey_unauthorization_role"=>"Your user role do not have permissions access the survey."];
                }
            }
        }
        if(isset($setting['survey_scheduling']) && ($setting['survey_scheduling']==true)){
            if(!empty($setting['start_date'])){
                $current = date('Y-m-d');
                $start_date =date('Y-m-d', strtotime($setting['start_date']));
                if($current < $start_date){
                    return ["survey_not_started"=>"Survey not started yet."];
                }               
                if($current == $start_date){
                    $current_time = date('h:i');
                    if(!empty($setting['survey_start_time'])){
                        if($current_time < $setting['survey_start_time'])
                            return ["time_left_to_start"=>"Time left to start survry"];
                    }
                }
            } 
            if(!empty($setting['expire_date'])){
                $expire_date =date('Y-m-d', strtotime($setting['expire_date']));
                if($current > $expire_date){
                    return ["survey_expired"=>"Survey is expired."];
                }
                if($current == $expire_date){
                    $current_time = date('h:i a');
                    if(!empty($setting['survey_expire_time'])){
                        if($current_time > $setting['survey_expire_time']){
                            return ["survey_expired_time"=>"survey time expired now"];
                        }
                    }
                }
            }
        } 
        // survey_response_limit  response_limit response_limit_type 
        if(isset($setting['survey_response_limit']) && ($setting['survey_response_limit']==true)){
            if(isset( $setting['response_limit_type']) && ($setting['response_limit_type'] =="per_ip")){
                $organization_id = Session::get('organization_id');
                $table = $organization_id.'_survey_results_'.$survey_id;    
                $ip = \Request::ip();
                if(Schema::hasTable($table)){
                    $filled_count = DB::table($table)->where('ip_address',$ip)->count();
                    if(!empty($setting['response_limit'] <= $filled_count)){
                        return ["survey_responce_limit"=>"Across survey limit for this ip"];                
                    }
                }
            }
            if(!empty($setting['authentication_required']) && ($setting['authentication_required'] ==true)){
                $user_id = Auth::guard('org')->user()->id;
                if(!empty( $setting['response_limit_type'] =="per_user")){
                    $organization_id = Session::get('organization_id');
                    $table = $organization_id.'_survey_results_'.$survey_id;    
                    $ip = \Request::ip();
                    if(Schema::hasTable($table)){
                        $filled_count = DB::table($table)->where('survey_submitted_by',$user_id)->count();
                        if(!empty($setting['response_limit']) && ($setting['response_limit'] <=$filled_count)){
                            return ["survey_responce_limit" =>"Across survey limit for this user"];             
                        }
                    }
                }
            }
        }            
        return true;
    }



    public function changeShareStatus(Request $request){
        $meta = FormsMeta::firstOrNew(['type' => 'survey' ,'form_id' => $request['survey_id'],  'key' => 'share_type']);
        $meta->form_id = $request['survey_id'];
        $meta->key = 'share_type';
        $meta->value = $request['share_status'];
        $meta->type = 'survey';
        $meta->save();
        if($meta){
            return "Success";
        }else{
            return "error";
        }
    }



    protected function validateShareTo($request){
        $rules = [
            'email_user_share' => 'required|email',
            'user-share-edit-view' => 'required'
        ];
        $this->validate($request,$rules);
    }



    public function saveShareTo(Request $request, $id){
        $this->validateShareTo($request);
        $model = Collaborator::firstOrNew(['type'=>'survey','relation_id'=>$id,'email'=>$request->email_user_share]);
        $model->type = 'survey';
        $model->relation_id = $id;
        $model->email = $request->email_user_share;
        $model->access = json_encode($request['user-share-edit-view']);
        $model->userid = Auth::guard('org')->user()->id;
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



    public function custom($id){
        $form = forms::select('id')->where('id',$id);
        if(!$form->exists()) {
            $error = __('survey.survey_not_exit');
            return view('organization.survey.customize', compact('error'));
        }else{
            $form =  $form->with(['formsMeta'=>function($query){
                $query->whereIn('key',['css_code', 'js_code']);
            }])->first()->toArray();
        }
        return view('organization.survey.customize', compact('form'));
    }



    public function save_custom(Request $request){
        foreach($request->only('css_code', 'js_code') as $key => $value){
            $form_meta = FormsMeta::where(['form_id'=>$request->form_id, 'key'=>$key]);
            if($form_meta->exists()){
                $form_meta->update(['value'=>$value]);
            }else{
                $meta =   new formsMeta();
                $meta->form_id = $request->form_id;
                $meta->key = $key;
                $meta->value = $value;
                $meta->save();
            }
        }
        return back();
    }


    public function convertToDataset($id){
        return view('organization.survey.convert-dataset');
    }


    /**
    * Get selected survey columns
    * @param  Request $request having posted data by user
    * @return [type]         will return options(columns) for selcted survey
    * @author Rahul
    */
    public function getSurveyColumns(Request $request){
        try{
            $model = (array)DB::table(get_organization_id().'_survey_results_'.$request->survey_id)->first();
            $columnsArray = array_keys($model);
            unset($columnsArray['id']);
            $options = '<option>Select Column</option>';
            foreach($columnsArray as $key => $column){
                $options .= '<option value="'.$column.'">'.$column.'</option>';
            }
            return $options;
        }catch(\Exception $e){
            return '';
        }
    }

    /**
     * Export Survey Data in the form of json
     * @param  [type] $id having survey id
     * @return [type]     will return to download .json file
     * @author Rahul
     */
    public function exportSurvey($id){
        $model = forms::where(['type'=>'survey','id'=>$id])->with(['section'=>function($query){
            $query->with(['fields'=>function($query){
                $query->with(['fieldMeta']);
            },'sectionMeta']);
        },'formsMeta'])->first()->toArray();
        $fileName = time() . '_form(survey)_'.$id.'.json';
        File::put(public_path('/tmp/json/'.$fileName),json_encode($model));
        return Response::download(public_path('/tmp/json/'.$fileName));
    }


    public function importSurvey(Request $request){
        if($request->isMethod('post')){
            $this->importJsonSurvey($request);
        }
        return view('admin.formbuilder.import');
    }

    protected function importJsonSurvey($request){
        $fileType = $request->file('import_file')->getClientOriginalExtension();
        if($fileType == 'json'){
            $destination = public_path('/tmp/json/');
            $fileName = $request->file('import_file')->getClientOriginalName();
            $request->file('import_file')->move($destination,$fileName);
            $jsonData = File::get(public_path('/tmp/json/'.$fileName));
            $this->insertImportedJsonSurvey(json_decode($jsonData,true));
        }
    }

    protected function insertImportedJsonSurvey(Array $arrayData){
        $model = new forms;
        $model->form_title = $arrayData['form_title'];
        $model->form_slug = $arrayData['form_slug'];
        $model->form_description = $arrayData['form_description'];
        $model->type = $arrayData['type'];
        $model->embed_token = $arrayData['embed_token'];
        $model->form_order = $arrayData['form_order'];
        $model->form_status = $arrayData['form_status'];
        $model->created_by = (Auth::guard('org')->check())?Auth::guard('org')->user()->id:Auth::guard('admin')->user()->id;
        $model->save();
        if(!empty($arrayData['section'])){
            foreach($arrayData['section'] as $key => $section){
                $sectionModel = $this->putSections($model,$section);
                if(!empty($section['fields'])){
                    foreach($section['fields'] as $key => $field){
                        $fieldsModel = $this->putFields($model,$sectionModel,$field);
                        if(!empty($field['field_meta'])){
                            foreach($field['field_meta'] as $key => $fieldMeta){
                                $fieldMetaModel = $this->putFieldMeta($model,$sectionModel,$fieldsModel,$fieldMeta);
                            }
                        }
                    }
                }
                if(!empty($section['section_meta'])){
                    foreach($section['section_meta'] as $key => $sectionMeta){
                        $sectionMetaModel = $this->putSectionMeta($sectionModel,$sectionMeta);
                    }
                }
            }
        }
        if(!empty($arrayData['forms_meta'])){
            foreach($arrayData['forms_meta'] as $key => $formMeta){
                $formMetaModel = $this->putFormMeta($model,$formMeta);
            }
        }
        Session::flash('success', 'Form/Survey Imported Successfully!');
        return back();
    }

    protected function putSections($model, $section){
        $sectionModel = new section;
        $sectionModel->form_id = $model->id;
        $sectionModel->section_name = $section['section_name'];
        $sectionModel->section_slug = $section['section_slug'];
        $sectionModel->section_description = $section['section_description'];
        $sectionModel->order = $section['order'];
        $sectionModel->status = $section['status'];
        $sectionModel->save();
        return $sectionModel;
    }

    protected function putFields($model, $sectionModel, $field){
        $fieldsModel = new FormBuilder;
        $fieldsModel->field_slug = $field['field_slug'];
        $fieldsModel->form_id = $model->id;
        $fieldsModel->section_id = $sectionModel->id;
        $fieldsModel->field_title = $field['field_title'];
        $fieldsModel->field_type = $field['field_type'];
        $fieldsModel->field_description = $field['field_description'];
        $fieldsModel->order = $field['order'];
        $fieldsModel->status = $field['status'];
        $fieldsModel->save();
        return $fieldsModel;
    }

    protected function putFieldMeta($model, $sectionModel, $fieldsModel, $fieldMeta){
        $fieldMetaModel = new FieldMeta;
        $fieldMetaModel->form_id = $model->id;
        $fieldMetaModel->section_id = $sectionModel->id;
        $fieldMetaModel->field_id = $fieldsModel->id;
        $fieldMetaModel->key = $fieldMeta['key'];
        $fieldMetaModel->value = $fieldMeta['value'];
        $fieldMetaModel->save();
        return $fieldMetaModel;
    }

    protected function putSectionMeta($sectionModel, $sectionMeta){
        $sectionMetaModel = new SectionMeta;
        $sectionMetaModel->section_id = $sectionModel->id;
        $sectionMetaModel->key = $sectionMeta['key'];
        $sectionMetaModel->value = $sectionMeta['value'];
        $sectionMetaModel->save();
        return $sectionMetaModel;
    }

    protected function putFormMeta($model,$formMeta){
        $formMetaModel = new FormsMeta;
        $formMetaModel->form_id = $model->id;
        $formMetaModel->key = $formMeta['key'];
        $formMetaModel->value = $formMeta['value'];
        $formMetaModel->type = $formMeta['type'];
        $formMetaModel->save();
        return $formMetaModel;
    }

}
