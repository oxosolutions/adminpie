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
use Carbon\Carbon;
/**
 * Paljinder singh only work  on following Method
 *     survey_filled_data_save
 *     embededSurvey
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
    public function createSurvey()
    {
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

public function set_survey($id , $slug, $type){
    $all = Session::get($type);
    if($type=='section'){
        $prepend = array_prepend($all, $slug, $id);
        Session::put('section',$prepend);
    }elseif($type=='field'){
        $prepend = array_prepend($all, $slug, $id);
        Session::put('field',$prepend);
    }
    return back();
}
    public function survey_filled_data_save(Request $request){

        $form_id    =   $request['form_id'];
        if(isset($request['section_id'])){
            $section_id  =   $request['section_id'];
        }
        if(isset($request['field_id'])){
            $field_id  =   $request['section_id'];
        }
        unset($request['_token'],$request['form_id'],$request['form_slug'],$request['form_title'],  $request['section_id'], $request['section_slug']);
        $this->apisurvey->create_alter_insert_survey_table(get_organization_id(), $form_id,$request->all());
        Session::flash('sucess','Submitted Sucessfully');
        
        if(Session::has('section')){
                $all_sec = Session::get('section');
                Session::forget('section');
                Session::put('previous_section_'.$form_id, $section_id);
                unset($all_sec[$section_id]);
                if(empty($all_sec)){
                    $this->forget_session_survey('section');
                    Session::flash('sucess', 'Successfull filled survey.');
                }else{
                    Session::put('section', $all_sec);
                }
        }
         if(Session::has('field')){
            $fields = Session::get('field');
            Session::forget('field');
            unset($fields[$request->field_id]);
            if(empty($fields)){
                $this->forget_session_survey('question');
                Session::flash('sucess', 'Successfull filled survey.');
            }else{
                Session::put('field',$fields);
            }
        }
        return back();
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
        }else{
            $error = __('survey.survey_not_exit');
            return view('organization.survey.survey_view', compact('error'));
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

    protected function forget_session_survey($parm){
        if($parm=='section'){
            Session::forget(['form_id']);
            Session::forget(['inserted_id']);
            Session::forget('section');
        }elseif($parm='question'){
                Session::forget('form_fiel_id');
                Session::forget('field');
                Session::forget(['inserted_id']);
        }
        return true;
    }

    protected function put_session_survey($option ,$form_id,  $data){
        if($option =='section'){
            Session::put(['form_id'=> $form_id, 'section'=>$data ]);
        }elseif($option =='question'){
            Session::put(['form_fiel_id'=> $form_id, 'field'=>$data ]);
        }
    }

    /**
     * To preview survey for fill records
     * 
     * @param  [string] $token [Survey token to get survey details]
     * @return [view]        [will return view of HTML]
     * @author Paljinder,Rahul
     */
    public function embededSurvey($token, $from_status = false){
        $current_data = [];
        $form = forms::select(['form_slug', 'id'])->with(['formsMeta','section.fields'])->where('embed_token',$token);
        if($form != null){
            $survey = $form = $form->first();
            $survey_slug = $form->form_slug;
            $form_id = $form['id'];
            $survey_setting = $form['formsMeta']->pluck('value','key')->toArray();
            if(!empty($survey_setting['save_survey']) && ($survey_setting['save_survey']=='section') ){
                if(Session::has('form_fiel_id')){
                    $this->forget_session_survey('question');
                }
                $sections['section'] = $form->section->mapWithKeys(function($item){
                    return [$item['id']=>$item['section_slug']];
                })->toArray();
                if(Session::has('form_id')){
                    if(Session::get('form_id')!=$form_id){
                        $this->forget_session_survey('section');
                        Session::put('form_id', $form_id);
                        Session::put($sections);
                    }
                }else{
                    $this->put_session_survey('section',$form_id, $sections['section']);
                }
            }elseif(!empty($survey_setting['save_survey']) && ($survey_setting['save_survey']=='question')){
                if(Session::has('form_id')){
                    $this->forget_session_survey('section');
                }
                if(Session::has('form_fiel_id')){
                    if(Session::get('form_fiel_id')!=$form_id){
                        $this->forget_session_survey('question');
                    }
                }else{
                    foreach ($form->section as $key => $value) {
                       // $field[] = $value['fields'];
                        foreach ($value['fields'] as $field_key => $field_value) {
                           $field[$field_value['id']] = $field_value['field_slug'];
                        }
                        // $f_slug = $value->fields->pluck('field_slug','id');
                    }
                        
                    // $collapse  =  collect($field)->collapse();
                    // $all_field = json_decode( json_encode($collapse), true);
                    Session::put('form_fiel_id', $form_id);
                    Session::put('field',$field);
                }
            }else{
                    $this->forget_session_survey('question');
                    $this->forget_session_survey('section');
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
       
        if(Session::has('inserted_id')){
            $table_name = $survey_setting['survey_data_table'];
            $tab = str_replace('ocrm_', '', $table_name);
             Schema::hasTable(str_replace('ocrm_', '', $table_name));
            if(Schema::hasTable(str_replace('ocrm_', '', $table_name))){
                $data = DB::table($tab)->where('id',Session::get('inserted_id'))->first();
                $current_data = json_decode(json_encode($data),true);
            }
        }
        // dd($token);
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
    public function changeShareStatus(Request $request)
    {
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

    public function survey_report(Request $request){

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
}
