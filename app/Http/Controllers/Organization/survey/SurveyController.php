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
        $model = forms::where(['type'=>'survey'])->with(['section'])->orderBy('id','DESC')->paginate($perPage);
        // if($request->has('search')){
        //     if($sortedBy != ''){
        //         $model = forms::where('form_title','like','%'.$request->search.'%')->where(['type'=>'survey','created_by'=>get_user_id()])->orderBy($sortedBy,$request->order)->with(['section'])->get();
        //         // ->paginate($perPage)
        //     }else{
        //         $model = forms::where('form_title','like','%'.$request->search.'%')->where(['type'=>'survey','created_by'=>get_user_id()])->with(['section'])->get();
        //     }
        // }else{
        //     if($sortedBy != ''){
        //         $model = forms::where('type','survey')->orderBy($sortedBy,$request->order)->where('created_by',get_user_id())->with(['section' ,'formsMeta' => function($query){
        //             $query->where('key' , 'share_type')->get();
        //          }])->get();
        //     }else{
        //          $model = forms::where('type','survey')->where('created_by',get_user_id())->with(['section','formsMeta' => function($query){
        //             $query->where(['key' => 'share_type' , 'value' => 'public'])->get();
        //          }])->get();
        //     }
        // }
        //add relation in query of formMeta to get the share_type   --sandeep 28/sept
        // $collab = Collaborator::select('relation_id')->where(['type'=>'survey','email'=>Auth::guard('org')->user()->email])->get()->groupBy('relation_id')->toArray();
        // if(!empty($collab)){
        //     $append` = forms::whereIn('id',array_keys($collab))->get();
        //     foreach($appendSurveys as $keyItem => $item){
        //         $model->push($item);
        //     }
        // }
        // $user_id = get_user_id();
        // dd($model);  
        // $newData = $model;
        // dd($model);

        $deleteRoute = 'org.delete.form';
        $sectionRoute = 'org.list.sections';
        $settingsRoute = 'org.form.settings';
        $cloneRoute = 'org.form.clone';
        $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['form_title'=>'Survey Title','form_slug'=>'Survey ID','created_at'=>'Created'],
                        'actions' => [
                                //'edit'=>['title'=>'Edit','route'=>'survey.sections.list'],
                                'preview'=>['title'=>'View','route'=>'survey.perview'],
                                'data'=>['title'=>'Raw Data','route'=>'results.survey'],
                                'report'=>['title'=>'Report','route'=>'survey.stats.report'],
                                //'delete'=>['title'=>'Delete','route'=>$deleteRoute],
                                //'clone'=>['title'=>'clone','route'=>$cloneRoute]
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
        // if(Session::has('section')){
        // 	$section = Session::get('section');
        // 	unset($section[$request['section_id']]);
        // }

         unset($request['_token'],$request['form_id'],$request['form_slug'],$request['form_title'],  $request['section_id'], $request['section_slug']);
        $inserted_id = $this->apisurvey->create_alter_insert_survey_table(get_organization_id(), $form_id,$request->all());
       // if(!Session::has('inserted_id')){
       //  	Session::put('inserted_id', $inserted_id);
       // }
        Session::flash('sucess','Submitted Sucessfully');
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
        $survey = forms::with(['formsMeta'])->find($id);
        if($survey->embed_token == '' || $survey->embed_token == null){
            $survey->embed_token = str_random();
            $survey->save();
        }
        $collab = Collaborator::where(['type'=>'survey','relation_id'=>$id])->get();
        return view('organization.survey.share',['token'=>$survey->embed_token,'collab'=>$collab,'permission'=>$permission,'survey' => $survey]);
    }

    public function embededSurvey($token){
 $form = forms::select(['form_slug', 'id'])->with(['formsMeta','section.fields'])->where('embed_token',$token);
        if($form != null){
            $form = $form->first();
            $slug = $form->form_slug;
             $form_id = $form['id'];
            //  Session::has('form_id');
            //  $sections['section'] = $form->section->mapWithKeys(function($item){
            //         return [$item['id']=>$item['section_slug']];
            //      })->toArray();
            // if(Session::has('form_id')){
            //         dump('in');
            //     //   Session::has('form_id');
            //      // Session::forget(['form_id']);
            //  // $section =Session::forget('section');
            //   //   unset($section[110]);
            //     //  Session::forget("sec");
            //     // Session::forget('section');
            //      dump(Session::all());
                
            // }else{
            //     dump('out'); 
            //     // dump($sections);
            //     Session::put('form_id', $form_id);
            //     Session::put($sections);

            //      dump(Session::all()); 
            // }
            $survey_setting = $form['formsMeta']->pluck('value','key')->toArray();
            $maintain_error =  $error = $this->survey_error($survey_setting, $form_id );
            if(!empty($error) && $error !=1){  
                if(!empty($survey_setting['custom_error_messages'] ==true) && is_array($error)){
                    $error = array_intersect_key($survey_setting, $error);   
                    if(empty($error)){
                            $error = $maintain_error; 
                    }
                }
               // $section_key = array_keys($sections);
                // return view('organization.survey.shared_survey',compact('error','section_key'));
            }
        }else{
            $error['survey_id_not_exist'] = "Survey id not exist!";
            return view('organization.survey.shared_survey',compact('error'));
        }
        if(!empty($survey_setting['survey_timer']) && ($survey_setting['survey_timer']==true)){
            if(!empty($survey_setting['timer_type'])&& ($survey_setting['timer_type']=="survey_expiry_time")){
                $expire_date_time = $survey_setting['expire_date'].' '.$survey_setting['survey_expire_time'];
                $expire_date = Carbon::parse($expire_date_time);
                $dt = Carbon::now();
                $survey_setting['survey_time_lefts'] = $expire_date->diffForHumans($dt);
            }
        }
        
        return view('organization.survey.shared_survey',compact('slug' ,'form_id','survey_setting'));
    }

  
    protected function survey_error($setting , $survey_id) {
         if(!empty($setting['enable_survey']) && ($setting['enable_survey']==0)){
                return ["survey_is_disabled"=>"not enable surrvey"];
            }
            if(!empty($setting['authentication_required']) && ($setting['authentication_required']==true)){
                if(!empty($setting['authentication_type']) && ($setting['authentication_type']=='user')){
                    if(!Auth::guard('org')->check()){
                         return ["survey_authorization_required"=>"Sign-in to fill surrvey"];
                    }else{
    	               $user_id = Auth::guard('org')->user()->id;
                       $user_list = json_decode($setting['individual_list'],true);
                       if(!in_array($user_id, $user_list)){
                            return ["survey_un-authorization_user"=>"user have not permission"];
                       }
                    }
                }elseif(!empty( $setting['authentication_type']) && ($setting['authentication_type']=='role')){
                    if(!Auth::guard('org')->check()){
                         return ["survey_authorization_required"=>"Sign-in to fill surrvey"];
                    }
                     $role_list = array_map('intval', json_decode($setting['role_list'],true));
                    if(count(array_intersect(role_id(), $role_list))==0){
                         return ["survey_unauthorization_role"=>"role not have permission"];
                     }
                }
            }

            
        if(!empty($setting['survey_scheduling']) && ($setting['survey_scheduling']==true)){
            if(!empty($setting['start_date'])){
                $current = date('Y-m-d');
                $start_date =date('Y-m-d', strtotime($setting['start_date']));
               if($current < $start_date){
                return ["survey_not_started"=>"Surrey not start yet!"];
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
                return ["survey_expired"=>"Surrey date expired!"];
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
            if(!empty($setting['survey_response_limit']) && ($setting['survey_response_limit']==true)){
            	if(!empty( $setting['response_limit_type']) && ($setting['response_limit_type'] =="per_ip")){
            		$organization_id = Session::get('organization_id');
            		$table = $organization_id.'_survey_results_'.$survey_id;	
            		 $ip = \Request::ip();
            		$filled_count = DB::table($table)->where('ip_address',$ip)->count();
            		 if(!empty($setting['response_limit'] <= $filled_count)){
            			return ["survey_responce_limit"=>"Across survey limit for this ip"];            	
            		 }
            	}

                 if(!empty($setting['authentication_required']) && ($setting['authentication_required'] ==true)){
                       $user_id = Auth::guard('org')->user()->id;
                	if(!empty( $setting['response_limit_type'] =="per_user")){
                		$organization_id = Session::get('organization_id');
                		$table = $organization_id.'_survey_results_'.$survey_id;	
                		 $ip = \Request::ip();
                		$filled_count = DB::table($table)->where('survey_submitted_by',$user_id)->count();
                		 if(!empty($setting['response_limit']) && ($setting['response_limit'] <=$filled_count)){
                			return ["survey_responce_limit" =>"Across survey limit for this user"];            	
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

    public function survey_report(Request $request){

    }
    public function custom(){
        return view('organization.survey.customize');
    }
}
