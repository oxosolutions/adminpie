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
use App\Model\Organization\Page;
use App\Model\Organization\EmailTemplate;
use App\Model\Organization\UsersRole;
use App\Model\Organization\User;
use App\Model\Group\GroupUsers;
use App\Model\Organization\UserRoleMapping;
use Shortcode;
use Auth;
use DB;
use Mail;
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
        if ($request->has('items')) {
            $perPage = $request->items;
            if ($perPage == 'all') {
                $perPage = 999999999999999;
            }
        } else {
            $perPage = get_items_per_page();
        }
        /*
        $model = forms::where(['type' => 'survey', 'created_by' => Auth::guard('org')->user()->id])->with(['section'])->orWherehas('formsMeta', function ($query) {
            $query->where('key', 'share_type')->where('value', '=', 'public')->where('value', '!=', 'only_me')->orWhereHas('collabrate', function ($query) {
                $query->whereHas('survey', function ($query) {
                    $query->whereHas('formsMeta', function ($query) {
                        $query->where('key', 'share_type')->where('value', '!=', 'only_me');
                    });
                });
            });
        })->orderBy('id', 'DESC')->paginate($perPage);
        */

        $model = forms::where([
            'type' => 'survey'])->orderBy('id', 'DESC')->paginate($perPage);


        $deleteRoute = 'org.delete.form';
        $sectionRoute = 'org.list.sections';
        $settingsRoute = 'org.form.settings';
        $cloneRoute = 'org.form.clone';
        $datalist = [
            'datalist' => $model,
            'showColumns' => ['form_title' => 'Survey Title', 'form_slug' => 'Survey ID', 'created_at' => 'Created'],
            'actions' => [
                'edit' => ['title' => 'Edit', 'route' => 'survey.sections.list'],
                'preview' => ['title' => 'View', 'route' => 'survey.perview'],
                'settings' => ['title' => 'Settings', 'route' => 'survey.settings'],
                'stats' => ['title' => 'Stats', 'route' => 'stats.survey'],
                'structure' => ['title' => 'Structure', 'route' => 'structure.survey'],
                'data' => ['title' => 'Raw Data', 'route' => 'results.survey'],
                'report' => ['title' => 'Report', 'route' => 'survey.reports'],
                'share' => ['title' => 'Collaborate', 'route' => 'share.survey'],
                'customize' => ['title' => 'Customize', 'route' => 'custom.survey'],
                'clone' => ['title' => 'Clone', 'route' => $cloneRoute],
                'delete' => ['title' => 'Delete', 'route' => $deleteRoute, 'class' => 'red']
            ],
            'title' => 'Survey',
        ];
        /*
        don't delete this (by Rahul)
        'delete'=>['title'=>'Delete','route'=>$deleteRoute],'section'=>['title'=>'Sections','route'=>['route'=>$sectionRoute]],'settings'=>['title'=>'Settings','route'=>$settingsRoute],'survey_settings'=>['title'=>'Survey Settings','route'=>'survey.settings']*/
        return view('admin.formbuilder.list', $datalist);
    }


    public function createSurvey()
    {
        return view('organization.survey.create', ['type' => 'survey']);
    }


    public function storeSurvey(Request $request)
    {
        $created_by = get_user_id();
        $request['created_by'] = $created_by;
        $this->validate($request, $this->valid_fields);
        $model = new forms;
        $model->fill($request->all());
        $model->save();
        // return redirect()->route('list.forms');
        Session::flash('success', 'Form created successfully');
        Session::flash('success', 'Survey created successfully');
        return redirect()->route('list.survey');
    }


    public function surveySettings($survey_id)
    {

        $permission = $this->collaboratorAccesses($survey_id, 'settings');
        $model = FormsMeta::where(['form_id' => $survey_id]);
        $modelData = [];
        foreach ($model->get() as $key => $value) {
            if (in_array($value->key, ['individual_list', 'role_list'])) {
                $modelData[$value->key] = json_decode($value->value, true);
            } else {
                $modelData[$value->key] = $value->value;
            }
        }
        $form = forms::find($survey_id);

        return view('organization.survey.survey_settings', ['model' => $modelData, 'permission' => $permission, 'form' => $form]);
    }

    public function surveyNotifications($survey_id){
        $permission = $this->collaboratorAccesses($survey_id, 'notifications');
        $model = FormsMeta::where('form_id', $survey_id)->where('type','survey')->where('key','survey_notification_details')->first();
        $modelArray = [];
        if($model != null){
            $modelArray[$model->key] = json_decode($model->value,true);
        }
        
        return view('organization.survey.survey_notifications',['permission' => $permission,'model'=>$modelArray]);
    }

    public function saveSurveyNotifications(Request $request, $survey_id){
        foreach($request->except(['_token']) as $key => $value){
             $meta = FormsMeta::firstOrNew(['form_id' => $survey_id, 'key' => $key, 'type' => 'survey']);
             $meta->key = $key;
             $meta->value = json_encode($value);
             $meta->type = 'survey';
             $meta->form_id = $survey_id;
             $meta->save();            
        }
        Session::flash('success','Settings saved successfully!');
        return back();
    }

    // public function reset_setting($survey_id){

    //     return $survey_id;
    // }

    protected function collaboratorAccesses($formId, $singleAccess)
    {
        $permission = true;
        $collab = Collaborator::select('access')->where(['type' => 'survey', 'email' => Auth::guard('org')->user()->email, 'relation_id' => $formId])->first();
        if ($collab != null) {
            $access = json_decode($collab->access, true);
            if (!in_array($singleAccess, $access)) {
                $permission = false;
            }
        }
        return $permission;
    }

    public function display_survey()
    {
        return view('organization.survey.display_survey');
    }

    public function sectionsList($form_id)
    {
        $permission = $this->collaboratorAccesses($form_id, 'edit');
        $plugins = [
            'js' => ['custom' => ['builder']],
        ];
        $form = forms::find($form_id);
        if (empty($form)) {
            $error = __('survey.survey_not_exit');
            return view('admin.formbuilder.sections', compact('error'));
        }
        $model = section::orderBy('order', 'ASC')->where('form_id', $form_id)->with(['fields' => function ($query) {
            $query->with('fieldMeta')->orderBy('order', 'ASC');
        }, 'sectionMeta', 'form'])->get();

        return view('admin.formbuilder.sections')->with(['sections' => $model, 'plugins' => $plugins, 'form' => $form, 'permission' => $permission]);
    }


// set_survey this is used for set priority to display Question/section 

    public function survey_filled_by_view(Request $request)
    {
        if (Session::has('inserted_id')) {
            Session::forget('inserted_id');
        }
        $form_id = $request['form_id'];
        unset($request['_token'], $request['form_id'], $request['form_slug'], $request['form_title'], $request['section_id'], $request['section_slug']);
        $this->apisurvey->create_alter_insert_survey_table(get_organization_id(), $form_id, $request->all());
        Session::flash('success', 'Survey filled successfully.');
        return back();
    }

    public function survey_filled_data_save(Request $request)
    {
        $form_id = $request['form_id'];
        if (isset($request['section_id'])) {
            $section_id = $request['section_id'];
        }
        unset($request['_token'], $request['form_id'], $request['form_slug'], $request['form_title'], $request['section_id'], $request['section_slug']);
        $this->apisurvey->create_alter_insert_survey_table(get_organization_id(), $form_id, $request->all());
        Session::flash('sucess', 'Submitted Sucessfully');
        if (Session::has('section' . $form_id)) {
            $all_sec = Session::get('section' . $form_id);
            Session::forget('section' . $form_id);
            unset($all_sec[$section_id]);
            if (empty($all_sec)) {
                $this->forget_session_survey('section', $form_id);
                Session::flash('sucess', 'Successfull Complete survey.');
            } else {
                Session::put('section' . $form_id, $all_sec);
            }
        }
        if (Session::has('field' . $form_id)) {
            $field_check = $fields = Session::get('field' . $form_id);
            Session::forget('field' . $form_id);
            unset($fields[$request->field_id]);
            if (empty($fields) && !Session::has('wild_field' . $form_id)) {
                $this->forget_session_survey('question', $form_id);
                Session::flash('sucess', 'Successfull Complete survey.');
            } else {
                $this->set_filled_question($request->field_id, $form_id);
                $next_field = $this->array_first_row($fields); //current(array_keys($fields));
                $preserve = Session::get('preserve_field' . $form_id);
                $slugg = $preserve[$request['field_id']];

                $keys = array_keys($preserve);
                $key = array_search($request['field_id'], $keys);
                if (isset($keys[$key + 1])) {
                    $next_fields = $keys[$key + 1];
                }
// check field type for radio & checkbox                
                $field_type = $this->check_field_type($request['field_id']);
                if ($field_type) {
                    $check_fields = $this->go_to_next($request['field_id'], $request[$slugg], $preserve, $fields);
                    if ($check_fields != 1) {
                        $fields = $check_fields;
                        if (empty($fields)) {
                            Session::flash('sucess', 'Successfull filled survey.');
                            $this->forget_session_survey('question', $form_id);
                            back();
                        }
                    }
//check condition and get there value 
                    $questions = $this->question_condition($next_fields); /// $next_field['key']
                    if (!empty($questions)) {
                        if ($request['field_id'] == $questions[0]['condition_column']) {
                            if ($field_type == "checkbox") {
                                if (in_array($questions[0]['condition_value'], $request[$slugg])) {
                                    $this->set_survey($form_id, $next_fields, $preserve[$next_fields], 'field');
                                }
                            } elseif ($questions[0]['condition_operator'] == "==") {

                                if ($request[$slugg] == $questions[0]['condition_value']) {
                                    $this->set_survey($form_id, $next_fields, $preserve[$next_fields], 'field');
                                } else {
                                    unset($fields[$next_field['key']]);
                                }
                            }
                        }
                    }
                }
                Session::put('field' . $form_id, $fields);
            }
        }
        return back();
    }

    protected function forget_session_survey($parm, $form_id)
    {
        if ($parm == 'section') {
            Session::forget(['form_id' . $form_id]);
            Session::forget(['inserted_id' . $form_id]);
            Session::forget('section' . $form_id);
        } elseif ($parm = 'question') {
            Session::forget('preserve_field' . $form_id);
            Session::forget('form_fiel_id' . $form_id);
            Session::forget('field' . $form_id);
            Session::forget('inserted_id' . $form_id);
            Session::forget('all' . $form_id);
        }
        return true;
    }

    protected function set_filled_question($field_id, $form_id)
    {
        $section_field = Session::get('all' . $form_id);
        $keys = array_keys($section_field);
        foreach ($keys as $key => $value) {
            if (array_has($section_field, $value . '.' . $field_id)) {
                data_set($section_field, $value . '.' . $field_id, 'filled');
            }
        }
        Session::put('all' . $form_id, $section_field);
    }

    protected function array_first_row($array)
    {
        return ['key' => current(array_keys($array)), 'value' => current(array_values($array))];
    }

    protected function check_field_type($field_id)
    {
        $field = FormBuilder::where('id', $field_id)->whereIn('field_type', ['radio', 'checkbox', 'select']);
        if ($field->exists()) {
            return $field->first()->field_type;
        }
        return;
    }

    protected function go_to_next($field_id, $option_val, $preserve, $fields)
    {
        $field_options = FieldMeta::where(['field_id' => $field_id, 'key' => 'field_options']);
        if ($field_options->exists()) {
            $field_meta = $field_options->first();
            $option_array = json_decode($field_meta->value, true);
            $option = array_filter(array_pluck($option_array, 'go_to_question', 'key'));
            if (empty($option) || empty($option[$option_val])) {
                return 1;
            }
            $select_ans_que_id = str_after($option[$option_val], 'QID');
            $this->set_survey($field_meta->form_id, $select_ans_que_id, $preserve[$select_ans_que_id], 'field');
            $max_ques_id = $this->max_val_in_array($option);
            for ($i = intval($field_id); $i <= intval($max_ques_id); $i++) {
                if ($i < $select_ans_que_id) {
                    unset($fields[$i]);
                } else {
                    if (empty($fields[$i])) {
                        array_prepend($fields, $preserve[$i], $i);
                    }
                }
            }
        }
        return $fields;
    }

    public function set_survey($form_id, $id, $slug, $type)
    {
        if ($type == 'section') {
            Session::flash('wild_section' . $form_id, ['section_id' . $form_id => $id, 'section_slug' . $form_id => $slug]);
        } elseif ($type == 'field') {
            Session::flash('wild_field' . $form_id, ['field_id' . $form_id => $id, 'field_slug' . $form_id => $slug]);
        }
        return back();
    }

    protected function max_val_in_array($array)
    {
        $max = 0;
        foreach ($array as $key => $value) {
            $new_val = str_after($value, 'QID');
            if ($new_val > $max) {
                $max = $new_val;
            }
        }
        return $max;
    }

    protected function question_condition($field_id)
    {
        $condition_value = $this->check_field_conditions($field_id);
        //dump($field_id, $condition_value);
        if (empty($condition_value)) {
            return;
        } else {
            return $condition_value;
        }
        return;
    }

    public static function check_field_conditions($field_id)
    {
        $meta = FieldMeta::where(['field_id' => $field_id, 'key' => 'field_conditions'])->first();
        if (empty($meta->value)) {
            return;
        }
        return json_decode($meta->value, true);
    }

    public function delete_survey_table($table_name)
    {
        $newTableName = str_replace('ocrm_', '', $table_name);
        if (Schema::hasTable($newTableName)) {
            FormsMeta::where('value', $table_name)->delete();
            $renames = $table_name . '_' . date('Y_m_d_h_i_s');
            DB::select("Rename table $table_name to $renames");
        }
        return back();
    }

    public function survey_api()
    {
        return forms::with('section')->get();
    }

    public function saveSurveySettings(Request $request, $survey_id)
    {

        $requestedData = $request->except(['form_id', 'form_id', 'form_title']);
        $reset = false;
        if (isset($requestedData['reset'])) {
            $reset = true;
        }
        foreach ($requestedData as $key => $value) {

            $meta = FormsMeta::firstOrNew(['form_id' => $survey_id, 'key' => $key, 'type' => 'survey']);
            $meta->form_id = $survey_id;
            $meta->key = $key;
            if ($reset) {
                $value = null;
            } else {
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

    public function surveyPerview($form_id)
    {

        $permission = $this->collaboratorAccesses($form_id, 'preview');
        $slug = forms::select('form_slug')->find($form_id);
        if ($slug != null) {
            $slug = $slug->form_slug;
        } else {
            $error = __('survey.survey_not_exit');
            return view('organization.survey.survey_view', compact('error'));
        }
        return view('organization.survey.survey_view', compact('slug', 'form_id'))->with(['permission' => $permission]);
    }

    public function resultSurvey()
    {
        return view('organization.survey.survey_result');
    }

    public function shareSurvey($id)
    {
        $permission = true;
        $collab = Collaborator::where(['type' => 'survey', 'relation_id' => $id, 'email' => Auth::guard('org')->user()->email])->first();
        if ($collab != null) {
            $permission = false;
        }
        $survey = forms::with(['formsMeta'])->find($id);
        if (empty($survey)) {
            return view('organization.survey.share', ['error' => "Data not exist"]);
        } else if ($survey->embed_token == '' || $survey->embed_token == null) {
            $survey->embed_token = str_random();
            $survey->save();
        }
        $sharedSurvey = Collaborator::where(['type' => 'survey', 'relation_id' => $id, 'userid' => Auth::guard('org')->user()->id])->get();
        return view('organization.survey.share', ['token' => $survey->embed_token, 'collab' => $sharedSurvey, 'permission' => $permission, 'survey' => $survey]);
    }

    /**
     * To preview survey for fill records
     *
     * @param  [string] $token [Survey token to get survey details]
     * @return [view]        [will return view of HTML]
     * @author Paljinder,Rahul ---> From 21 March 2018
     */
    public function embededSurvey(Request $request, $token, $from_status = false)
    {
        $surveyRecord = forms::select(['form_slug', 'id'])->with(['formsMeta', 'section.fields', 'section.sectionMeta'])->where('embed_token', $token)->first();

        if ($request->isMethod('post')) {
            $result = $this->saveSurveyRecord($request);
            if ($result['status'] == false) {
                return back()->withInput($request->all())->withErrors($result['errors']);
            } else {
                if (
                    array_key_exists('next_section', $result) &&
                    array_key_exists('next_question', $result) &&
                    $result['next_question'] !== false &&
                    $result['next_section'] !== false
                ) {
                    return redirect()->route('embed.survey', ['token' => $token, 'section' => $result['next_section'], 'question' => $result['next_question']]);
                } elseif (array_key_exists('next_section', $result) && $result['next_section'] != false) {
                    if ($result['next_section'] == 'finish') {
                        $redirectAfterCopmpleted = $this->checkSurveyCompletedSettingss($token);
                        if ($redirectAfterCopmpleted['action'] == 'print_message') {
                            Session::flash('success', $redirectAfterCopmpleted['message']);
                            Session::put('record_id');
                            return redirect()->route('embed.survey', ['token' => $token]);
                        }
                        if ($redirectAfterCopmpleted['action'] == 'go_to_page') {
                            Session::put('record_id');
                            $page_slug = Page::get_page_slug($redirectAfterCopmpleted['page']);
                            return redirect()->route('view.pages', ['slug' => $page_slug]);
                        }
                        $this->surveyCompletedNotification($surveyRecord->id, $result['record_id']);
                        Session::put('record_id');
                        return redirect()->route('survey.completed', ['token' => $token]);
                    } else {
                        return redirect()->route('embed.survey', ['token' => $token, 'section' => $result['next_section']]);
                    }
                } else {
                    $redirectAfterCopmpleted = $this->checkSurveyCompletedSettingss($token);
                    if ($redirectAfterCopmpleted['action'] == 'print_message') {
                        Session::flash('success', $redirectAfterCopmpleted['message']);
                        $this->surveyCompletedNotification($surveyRecord->id, $result['record_id']);
                        Session::put('record_id');
                        return redirect()->route('embed.survey', ['token' => $token]);
                    }
                    if ($redirectAfterCopmpleted['action'] == 'go_to_page') {
                        Session::put('record_id');
                        $page_slug = Page::get_page_slug($redirectAfterCopmpleted['page']);
                        return redirect()->route('view.pages', ['slug' => $page_slug]);
                    }
                    $this->surveyCompletedNotification($surveyRecord->id, $result['record_id']);
                    Session::put('record_id');
                    return redirect()->route('survey.completed', ['token' => $token]);
                }
            }
        }

        if ($surveyRecord != null) {
            $metaValues = get_meta_array($surveyRecord->formsMeta);
            $errorStatus = $this->validateSurveyConditions($metaValues);
            $surveyDisplayBy = (@$metaValues['save_survey'] == null) ? 'survey' : $metaValues['save_survey']; // Currently section
            switch ($surveyDisplayBy) {
                case'section':
                    $questionsData = $this->reArrangeQuestionsBySection($surveyRecord, $request);
                    $questionsData['displayBy'] = $surveyDisplayBy;
                    break;

                case'survey':
                    $questionsData = $this->reArrangeQuestionsBySurvey($surveyRecord, $request);
                    $questionsData['displayBy'] = $surveyDisplayBy;
                    break;

                case'question':
                    $questionsData = $this->reArrangeQuestionsByQuestion($surveyRecord, $request);
                    $questionsData['displayBy'] = $surveyDisplayBy;
                    break;
            }
        }
        $questionsData['form_id'] = $surveyRecord['id'];
        $timerSerrtings = $this->getSurveyTimerSettings($token);
        $prefilled = $this->preFillSurveyAnswer($surveyRecord);
        if ($from_status) {
            $prefilled = array_merge($request->all(), $prefilled);
            return view('organization.survey.public.shared_survey_without_layout', [
                                    'error' => $errorStatus, 
                                    'data' => $questionsData, 
                                    'prefill' => $prefilled,
                                    'time'=>$timerSerrtings,
                                    'meta' => $metaValues
                                ]
                        )->render();
        } else {
            $prefilled = array_merge($request->all(), $prefilled);
            return view('organization.survey.public.survey_draw', [
                            'error' => $errorStatus, 
                            'data' => $questionsData, 
                            'prefill' => $prefilled,
                            'timer'=>$timerSerrtings,
                            'meta' => $metaValues
                            ]
                        );
        }

    }

    protected function surveyCompletedNotification($survey_id, $record_id){
        $metaData = FormsMeta::where('form_id',$survey_id)->where('type','survey')->where('key','survey_notification_details')->first();
        if($metaData == null){
            return false;
        }
        foreach(json_decode($metaData->value,true) as $key => $notification){
            $sendTo = $notification['send_notification_to'];
            if($sendTo != null && $sendTo != ''){
                if($sendTo == 'email'){
                    $sendToEmail = $notification['send_notification_to_text'];
                    if($sendToEmail != null && $sendToEmail != ''){
                        $notificationTemplate = $notification['notification_email_template'];
                        if($notificationTemplate != null && $notificationTemplate != ''){
                            $emailData = EmailTemplate::find($notificationTemplate);
                            $this->registerSurveyShortcodes($survey_id, $record_id);
                            $rawHTML = view('organization.survey.notification_email.notification_template',['content'=>$emailData->content])->compileShortcodes()->render();
                            Mail::send([], [], function ($message) use ($rawHTML, $emailData, $sendToEmail) {
                                $message->subject($emailData->subject);
                                $message->from(env('MAIL_EMAIL'), env('MAIL_FROM'));
                                $message->setBody($rawHTML, 'text/html');
                                $message->to($sendToEmail);
                            });
                        }
                    }
                }else{
                    if($notification['send_to_role'] != '' && $notification['send_to_role'] != null){
                        $userModel = UsersRole::where('slug',$notification['send_to_role'])->first();
                        if($userModel != null){
                            $notificationTemplate = $notification['notification_email_template'];
                            if($notificationTemplate != null && $notificationTemplate != ''){
                                $emailData = EmailTemplate::find($notificationTemplate);
                                $this->registerSurveyShortcodes($survey_id, $record_id);
                                $userEmails = UserRoleMapping::where('role_id',$userModel->id)->with(['group_user'])->wherehas('group_user')->get();
                                $rawHTML = view('organization.survey.notification_email.notification_template',['content'=>$emailData->content])->compileShortcodes()->render();
                                foreach($userEmails as $key => $user){
                                    $sendEmailTo = $user->group_user->email;
                                    Mail::send([], [], function ($message) use ($rawHTML, $emailData, $sendEmailTo) {
                                        $message->subject($emailData->subject);
                                        $message->from(env('MAIL_EMAIL'), env('MAIL_FROM'));
                                        $message->setBody($rawHTML, 'text/html');
                                        $message->to($sendEmailTo);
                                    });
                                }
                            }
                        }
                    }
                }
            }
        }
        return true;
    }

    protected function registerSurveyShortcodes($survey_id, $record_id){
        $table = get_organization_id().'_survey_results_'.$survey_id;
        Shortcode::add('all_fields', function ($atts, $content, $name) use ($table, $record_id) {
            $model = DB::table($table)->find($record_id);
            $htmlData = view('organization.survey.notification_email.render_all_fields',['model'=>$model])->render();
            return $htmlData;
        });

        Shortcode::add('survey_field', function ($atts, $content, $name) use ($table, $record_id) {
            $model = DB::table($table)->find($record_id);
            return $model->{$atts['field']};
        });
    }

    protected function saveSurveyRecord($request){

        $surveyDetails = forms::with(['formsMeta', 'section.fields.fieldMeta', 'section.sectionMeta'])->where('embed_token', $request->token)->first();
        $metaValues = get_meta_array($surveyDetails->formsMeta);
        $surveyType = (@$metaValues['save_survey'] == null) ? 'survey' : $metaValues['save_survey'];
       
        $fieldsSlugs = $this->getAllFieldsSlugs($surveyDetails);
       // $fieldsSlugs = $this->getAllFieldsID($surveyDetails);
        $prefix = DB::getTablePrefix();
        $organizationID = get_organization_id();
        $resultTable = $organizationID . '_survey_results_' . $surveyDetails->id;
        if (!Schema::hasTable($resultTable)) {
            $this->createSurveyResultsTable($fieldsSlugs, $prefix . $resultTable, $surveyDetails);
        } else {
            $this->checkForAlterTable($fieldsSlugs, $resultTable, $prefix);
        }
        switch ($surveyType) {
            case'section':
                $result = $this->saveSurveyAccordingTo_SectionView($request, $resultTable, $prefix, $surveyDetails);
                break;

            case'survey':
                $result = $this->saveSurveyAccordingTo_SurveyView($request, $resultTable, $prefix, $surveyDetails);
                break;

            case'question':
                $result = $this->saveSurveyAccordingTo_QuestionView($request, $resultTable, $prefix, $surveyDetails);
                break;
        }
        return $result;
    }

    protected function getAllFieldsSlugs($surveyDetails)
    {
        $fieldsSlugForColumns = [];
        foreach ($surveyDetails->section as $key => $section) {
            $sectionType = $section->sectionMeta->where('key', 'section_type')->first();
            if ($sectionType != null && $sectionType->value == 'repeater') {
                $fieldsSlugForColumns[] = $section->section_slug;
            } else {
                foreach ($section->fields as $field_key => $field) {
                    $fieldsSlugForColumns[] = $field->field_slug;
                }
            }
        }
        return $fieldsSlugForColumns;
    } 

    protected function getAllFieldsID($surveyDetails)
    {
        

        $surveyModel = forms::with(['section'=>function($query){
                $query->with(['fields'])->orderBy('order','asc');
        },'fields'=>function($query){
            $query->with('fieldMeta')->orderBy('order','asc');
        },'fieldMeta'=>function($query){
            $query->with('field');
        }])->find($surveyDetails->id);
        
        
        $fieldsIDForColumns = [];
        foreach ($surveyDetails->section as $key => $section) {
            $sectionType = $section->sectionMeta->where('key', 'section_type')->first();
            if ($sectionType != null && $sectionType->value == 'repeater') {
                $fieldsSlugForColumns[] = $section->section_slug;
            } else {
                foreach ($section->fields as $field_key => $field) {
                    $metaValue = $surveyModel->fieldMeta->where('form_id',$surveyDetails->id)->where('section_id',$section->id)->where('field_id',$field->id)->where('key','question_id')->first();
                    $fieldsSlugForColumns[] = $metaValue->value;
                    //$fieldsSlugForColumns[] = $field->field_slug;
                }
            }
        }
        return $fieldsSlugForColumns;
    }

    /**
     * To create table for survey results
     * @param  [array] $fieldSlugs [having all fields slugs list in form of array]
     * @param  [string] $tableName  having survey result table name
     * @return bolean will return true or false
     * @author Rahul
     */
    protected function createSurveyResultsTable($fieldSlugs, $tableName, $surveyDetails)
    {
        $prepearedColumnsForQuery = [];
        /*$extraFields = ['ip_address', 'survey_started_on', 'survey_completed_on', 'survey_status', 'survey_submitted_by', 'survey_submitted_from', 'mac_address', 'imei', 'device_detail', 'created_by', 'created_at', 'deleted_at'];*/
        $extraFields = ['record_type', 'survey_sync_status', 'incomplete_name', 'survey_status', 'completed_groups', 'last_group_id', 'last_field_id', 'created_at', 'created_by', 'device_detail', 'unique_id', 'imei', 'mac_address', 'survey_submitted_from', 'survey_submitted_by', 'survey_completed_on', 'survey_started_on', 'ip_address'];
        $tableColumns = array_merge($fieldSlugs, $extraFields);
        foreach ($tableColumns as $key => $column) {
            $prepearedColumnsForQuery[] = '`' . $column . '` text COLLATE utf8_unicode_ci NULL DEFAULT  NULL';
        }
        $QueryForCreateTable = 'CREATE TABLE `' . $tableName . '` ( ' . implode(', ', $prepearedColumnsForQuery) . ' ) ENGINE=InnoDB DEFAULT CHARSET=utf8;';
        DB::statement($QueryForCreateTable);
        DB::statement("ALTER TABLE `{$tableName}` ADD `id` INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Row ID' FIRST");
        $model = FormsMeta::firstOrNew(['key' => 'survey_data_table', 'form_id' => $surveyDetails->id]);
        $model->value = $tableName;
        $model->key = 'survey_data_table';
        $model->form_id = $surveyDetails->id;
        $model->save();
        return true;
    }

    protected function checkForAlterTable($fieldSlugs, $tableName, $prefix)
    {
        /*$arrayForInterSect = ['id', 'ip_address', 'survey_started_on', 'survey_completed_on', 'survey_status', 'survey_submitted_by', 'survey_submitted_from', 'mac_address', 'imei', 'device_detail', 'created_by', 'created_at', 'deleted_at'];*/
        $arrayForInterSect = ['id','record_type', 'survey_sync_status', 'incomplete_name', 'survey_status', 'completed_groups', 'last_group_id', 'last_field_id', 'created_at', 'created_by', 'device_detail', 'unique_id', 'imei', 'mac_address', 'survey_submitted_from', 'survey_submitted_by', 'survey_completed_on', 'survey_started_on', 'ip_address'];
        $existingTableColumns = Schema::getColumnListing($tableName);
        $existingColumnsArray = array_values(array_diff($existingTableColumns, $arrayForInterSect));

        $lookingForExtraField = array_values(array_diff($arrayForInterSect, $existingTableColumns));
        if ($existingColumnsArray == $fieldSlugs) {
            if (!empty($lookingForExtraField)) {
                $this->lookingForExtraField($lookingForExtraField, $tableName, $prefix);
            }
            return true;
        } else {
            $difference = array_diff($fieldSlugs, $existingColumnsArray);
            foreach ($difference as $key => $column) {
                if($key != 0){
                    $createAfter = $fieldSlugs[$key-1];
                     DB::statement("ALTER TABLE `" . $prefix . $tableName . "` ADD `{$column}` text COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'alter field' AFTER `" . $createAfter . "`");
                }elseif($key == 0){
                    $createAfter = $fieldSlugs[0];
                     DB::statement("ALTER TABLE `" . $prefix . $tableName . "` ADD `{$column}` text COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'alter field' FIRST");
                }
               
            }
            if (!empty($lookingForExtraField)) {
                $this->lookingForExtraField($lookingForExtraField, $tableName, $prefix);
            }
            return true;
        }
    }

    protected function lookingForExtraField($extraFields, $table, $prefix)
    {
        foreach ($extraFields as $key => $column) {
            $Query = "ALTER TABLE `" . $prefix . $table . "` ADD `{$column}` text COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'alter field'";
            DB::SELECT($Query);
        }
        return true;
    }

    protected function validateFilledSurveyDetails($request, $validations)
    {

        $validationsErrors = [];
        foreach ($request->except(['_token']) as $key => $field) {
            if (array_key_exists($key, $validations)) {
                $validation = $validations[$key];
                foreach ($validation as $valKey => $singleValidation) {
                    switch (@$singleValidation['field_validation']) {
                        case'required':
                            if (is_array($field)) {
                                if (empty($field)) {
                                    if (!array_key_exists($key, $validationsErrors)) {
                                        $validationsErrors[$key][] = $singleValidation['field_validation_message'];
                                    }
                                }
                            } elseif (trim($field) == '' || trim($field) == null) {
                                if (!array_key_exists($key, $validationsErrors)) {
                                    $validationsErrors[$key][] = $singleValidation['field_validation_message'];
                                }
                            }
                            break;

                        case'number':
                            if (!is_numeric($field)) {
                                if (!array_key_exists($key, $validationsErrors)) {
                                    $validationsErrors[$key][] = $singleValidation['field_validation_message'];
                                }
                            }
                            break;

                        case'email':
                            if (!filter_var($field, FILTER_VALIDATE_EMAIL)) {
                                if (!array_key_exists($key, $validationsErrors)) {
                                    $validationsErrors[$key][] = $singleValidation['field_validation_message'];
                                }
                            }
                            break;

                        case'url':
                            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $field)) {
                                if (!array_key_exists($key, $validationsErrors)) {
                                    $validationsErrors[$key][] = $singleValidation['field_validation_message'];
                                }
                            }
                            break;

                        case'date':
                            if (Carbon::createFromFormat('Y-m-d', $field) == false) {
                                if (!array_key_exists($key, $validationsErrors)) {
                                    $validationsErrors[$key][] = $singleValidation['field_validation_message'];
                                }
                            }
                            break;
                    }
                }
            }
        }
        if (!empty($validationsErrors)) {
            return ['status' => false, 'errors' => $validationsErrors];
        } else {
            return ['status' => true, 'errors' => $validationsErrors];
        }
    }

    protected function saveSurveyAccordingTo_SurveyView($request, $tableNameWithoutPrefix, $prefix, $surveyDetails)
    {
        $fieldsArray = [];
        foreach ($surveyDetails->section as $key => $section) {
            foreach ($section->fields as $key => $field) {
                $validation = $field->fieldMeta->where('key', 'field_validations')->first();
                if ($validation != null) {
                    $fieldsArray[$field->field_slug] = json_decode($validation->value, true);
                }
            }
        }
        $result = $this->validateFilledSurveyDetails($request, $fieldsArray);
        if ($result['status'] == false) {
            return ['status' => false, 'errors' => $result['errors']];
        }
        $Query = DB::table($tableNameWithoutPrefix);
        $dataToInsert = [];
        $putExtraFields = [
            'ip_address' => request()->ip(),
            'survey_started_on' => Session::get('started_on'),
            'survey_completed_on' => Carbon::now()->format('Y-m-d'),
            'survey_status' => 'Completed',
            'survey_submitted_by' => (Auth::guard('org')->user() == null) ? 'Guest' : Auth::guard('org')->user()->id,
            'survey_submitted_from' => 'web',
            'device_detail' => $request->header('User-Agent')
        ];
        foreach ($request->except(['_token']) as $key => $value) {
            if (is_array($value)) {
                $dataToInsert[$key] = json_encode($value);
            } else {
                $dataToInsert[$key] = $value;
            }
        }
        $dataToInsert = array_merge($dataToInsert, $putExtraFields);
        $Query->insertGetId($dataToInsert);
        $record_id = $Query->get()->last()->id;
        return ['status' => true, 'errors' => [],'record_id'=>$record_id];
    }


    protected function saveSurveyAccordingTo_SectionView($request, $tableNameWithoutPrefix, $prefix, $surveyDetails)
    { 
        $sectionIndex = 0;
        if ($request->has('section') && $request->section != null) {
            $sectionIndex = (int)$request->section;
        }
        $fieldsArray = [];
        $fieldsArrayForPartialCheck = [];
        foreach ($surveyDetails->section[$sectionIndex]->fields as $key => $field) {
            $validation = $field->fieldMeta->where('key', 'field_validations')->first();
            if ($validation != null) {
                $fieldsArray[$field->field_slug] = json_decode($validation->value, true);
            }
            if($field->field_type != 'message'){
                $fieldsArrayForPartialCheck[$field->field_slug] = '';
            }
        }
        $result = $this->validateFilledSurveyDetails($request, $fieldsArray);
        if ($result['status'] == false) {
            return ['status' => false, 'errors' => $result['errors']];
        }
        $Query = DB::table($tableNameWithoutPrefix);
        $dataToInsert = [];
        $record_id = Session::get('record_id');
        if($record_id == null){
            $survey_started_on = Carbon::now()->format('Y-m-d H:i:s');
        }
        $putExtraFields = [
            'ip_address' => request()->ip(),
            'survey_started_on' => $survey_started_on,
            'survey_submitted_by' => (Auth::guard('org')->user() == null) ? 'Guest' : Auth::guard('org')->user()->id,
            'survey_submitted_from' => 'web',
            'survey_status' => 'In-complete',
            'device_detail' => $request->header('User-Agent'),
            'unique_id' => generate_filename(30),
        ];
        foreach ($request->except(['_token', 'section', 'number_of_fields', 'prefilled_count', 'prefilled_names']) as $key => $value) {

            if (is_array($value)) {
                $dataToInsert[$key] = json_encode($value);
            } else {
                $dataToInsert[$key] = $value;
            }
        }
        $dataToInsert = array_merge($dataToInsert, $putExtraFields);
        dd($dataToInsert);
        $statusPartially = false;
        if ($record_id != null || $record_id != 0) {
            $valuesForPartialCheck = array_intersect(array_keys($fieldsArrayForPartialCheck),array_keys(array_filter($request->all())));            
            if($valuesForPartialCheck !== array_keys($fieldsArrayForPartialCheck)){
                $statusPartially = true;
            }
            unset($dataToInsert['unique_id']);
            unset($dataToInsert['survey_started_on']);
            $Query->where('id', $record_id)->update($dataToInsert);
        } else {
            $valuesForPartialCheck = array_intersect(array_keys($fieldsArrayForPartialCheck),array_keys(array_filter($request->all())));
            if($valuesForPartialCheck !== array_keys($fieldsArrayForPartialCheck)){
                $statusPartially = true;
            }
            $insertedId = $Query->insertGetId($dataToInsert);
            Session::put('record_id', $insertedId);
        }
        $nextSection = false;
        if($statusPartially){
            $sessionKey = 'partial_sections';
        }else{
            $partialSession = @array_unique(Session::get('partial_sections'));
            if($partialSession != null){
                if (($key = array_search($sectionIndex, $partialSession)) !== false) {
                    unset($partialSession[$key]);
                }
                Session::put('partial_sections',array_values($partialSession));
            }
            $sessionKey = 'completed_sections';
        }
        if ($sectionIndex < $surveyDetails->section->count() - 1) {
            $nextSection = $sectionIndex + 1;
            $completedSections = Session::get($sessionKey);
            if ($completedSections == null) {
                $completedSections = [];
                $completedSections[] = $sectionIndex;
                Session::put($sessionKey, $completedSections);
            } else {
                $completedSections[] = $sectionIndex;
                Session::put($sessionKey, $completedSections);
            }
        } else {
            $completedSections = Session::get($sessionKey);
            if ($completedSections == null) {
                $completedSections = [];
                $completedSections[] = $sectionIndex;
                Session::put($sessionKey, $completedSections);
            } else {
                $completedSections[] = $sectionIndex;
                Session::put($sessionKey, $completedSections);
            }
            $completedUpdate = [
                'survey_completed_on' => Carbon::now()->format('Y-m-d'),
                'survey_status' => 'Completed',
            ];
            $recordid = Session::get('record_id');
            $Query = DB::table($tableNameWithoutPrefix)->where('id',$recordid)->update($completedUpdate);
            $nextSection = 'finish';
        }
        return ['status' => true, 'errors' => [], 'next_section' => $nextSection];
    }


    protected function saveSurveyAccordingTo_QuestionView($request, $tableNameWithoutPrefix, $prefix, $surveyDetails)
    {
        $currentSectionIndex = $request->section;
        $currentQuestionIndex = $request->question;
        if ($request->has('prev_next_section') && $request->prev_next_section != null) {
            $next_prev_sectionIndex = $request->prev_next_section;
        }
        if ($request->has('prev_next_question') && $request->prev_next_question != null) {
            $next_prev_questionIndex = $request->prev_next_question;
        }
        $fieldsArray = [];
        $currentField = $surveyDetails->section[$currentSectionIndex]->fields[$currentQuestionIndex];
        $validation = $currentField->fieldMeta->where('key', 'field_validations')->first();
        if ($validation != null) {
            $fieldsArray[$currentField->field_slug] = json_decode($validation->value, true);
        }
        $result = $this->validateFilledSurveyDetails($request, $fieldsArray);
        if ($result['status'] == false) {
            return ['status' => false, 'errors' => $result['errors']];
        }

        $Query = DB::table($tableNameWithoutPrefix);
        $dataToInsert = [];
        $putExtraFields = [
            'ip_address' => request()->ip(),
            'survey_started_on' => Session::get('started_on'),
            'survey_completed_on' => Carbon::now()->format('Y-m-d'),
            'survey_status' => 'Completed',
            'survey_submitted_by' => (Auth::guard('org')->user() == null) ? 'Guest' : Auth::guard('org')->user()->id,
            'survey_submitted_from' => 'web',
            'device_detail' => $request->header('User-Agent')
        ];
        foreach ($request->except(['_token', 'section', 'question', 'prev_next_section', 'prev_next_question']) as $key => $value) {
            if (is_array($value)) {
                $dataToInsert[$key] = json_encode($value);
            } else {
                $dataToInsert[$key] = $value;
            }
        }
        $dataToInsert = array_merge($dataToInsert, $putExtraFields);
        $record_id = Session::get('record_id');
        if ($record_id != null) {
            $Query->where('id', $record_id)->update($dataToInsert);
        } else {
            $insertedId = $Query->insertGetId($dataToInsert);
            Session::put('record_id', $insertedId);
        }
        $nextSection = false;
        $nextQuestion = false;
        if ($next_prev_sectionIndex <= $surveyDetails->section->count() - 1) {
            $nextSection = $next_prev_sectionIndex;
            $nextQuestion = $next_prev_questionIndex;
        }
        if($next_prev_sectionIndex != $currentSectionIndex){
            $completedSections = Session::get('completed_sections');
            if ($completedSections == null) {
                $completedSections = [];
                $completedSections[] = $currentSectionIndex;
                Session::put('completed_sections', $completedSections);
            } else {
                $completedSections[] = $currentSectionIndex;
                Session::put('completed_sections', $completedSections);
            }
        }

        return ['status' => true, 'errors' => [], 'next_section' => $nextSection, 'next_question' => $nextQuestion];

    }

    /**
     * [checkSurveyCompletedSettingss description]
     * @param  [type] $token [description]
     * @return [type]        [description]
     */
    protected function checkSurveyCompletedSettingss($token)
    {
        $surveyRecord = forms::select(['form_slug', 'id'])->with(['formsMeta', 'section.fields'])->where('embed_token', $token)->first();
        $meta = get_form_meta($surveyRecord->id, null, true, false);
        if (@$meta['on_survey_completion'] == 'print_message') {
            return ['action' => $meta['on_survey_completion'], 'message' => $meta['message']];
        }
        if (@$meta['on_survey_completion'] == 'go_to_page') {
            return ['action' => $meta['on_survey_completion'], 'page' => $meta['select_page']];
        }

        return ['action' => 'print_message', 'message' => 'Survey completed successfully!'];
    }

    protected function getSurveyTimerSettings($token){
        $surveyRecord = forms::select(['form_slug', 'id'])->with(['formsMeta', 'section.fields'])->where('embed_token', $token)->first();
        $meta = get_form_meta($surveyRecord->id, null, true, false);
        if($meta != false){
            if(array_key_exists('timer_type', $meta)){
                switch($meta['timer_type']){
                    case'survey_duration':
                        if(array_key_exists('survey_duration', $meta)){
                            $duration = $meta['survey_duration'];
                            return ['type'=>'duration','time'=>$duration];
                        }
                    break;

                    case'survey_expire_time':
                    break;
                }
            }
        }
    }

    protected function validateSurveyConditions($metaArray)
    {
        $errorsArray = [];
        $surveyStatus = ['status' => true,'type'=>null];
        //Check Survey Enabled
        if (!@$metaArray['enable_survey'] == 1) {
            $surveyStatus = ['status' => false, 'message' => 'Survey not enabled!','type'=>'enable_disable'];
            return $surveyStatus;
        }

        //Check if Authentication Required
        if (@$metaArray['authentication_required'] == 1) {
            if (!Auth::guard('org')->check()) {
                $surveyStatus = ['status' => false, 'message' => 'You are not loggedin!','type'=>'auth'];
                return $surveyStatus;
            } else {
                if (@$metaArray['authentication_type'] != null) {
                    if ($metaArray['authentication_type'] == 'user') {
                        $usersList = @$metaArray['individual_list'];
                        if ($usersList != '' && $usersList != null) {
                            $usersList = json_decode($metaArray['individual_list'], true);
                            if (!in_array(Auth::guard('org')->user()->id, $usersList)) {
                                return ['status' => false, 'message' => 'Admin did not allow you to fill this survey!','type'=>'not_allowed_to_user'];
                            }
                        }
                    } elseif ($metaArray['authentication_type'] == 'role') {
                        $userRoles = get_user_roles();
                        if (@$metaArray['role_list'] != null && @$metaArray['role_list'] != '') {
                            $metaArray['role_list'] = json_decode($metaArray['role_list'], true);
                            $roleStatus = false;
                            foreach ($metaArray['role_list'] as $key => $role) {
                                if (in_array($role, $userRoles)) {
                                    $roleStatus = true;
                                }
                            }
                            if ($roleStatus == false) {
                                return ['status' => false, 'message' => 'Survey not allowed to your role!','type'=>'not_allowed_to_role'];
                            }
                        }
                    }
                }
            }
        }

        //Check Schedule Enable
        if (@$metaArray['survey_scheduling'] == 1) {
            $startDate = @$metaArray['start_date'];
            $expireDate = @$metaArray['expire_date'];
            $startTime = @$metaArray['survey_start_time'];
            $expireTime = @$metaArray['survey_expire_time'];
            $surveyStatus = $this->findScheduleCases($startDate, $expireDate, $startTime, $expireTime);
        }

        //Check Survey Timer Enabled or Not
        if(array_key_exists('survey_timer', $metaArray)){
            if($metaArray['survey_timer'] == 1){
                $timer_type = $metaArray['timer_type'];
                switch($timer_type){
                    case'survey_duration':
                        $survey_started_time = Session::get('survey_started_time');
                        if($survey_started_time != null){
                            $parsed_time = Carbon::parse($survey_started_time);
                            $current_time = Carbon::now();
                            $difference = $parsed_time->diffInMinutes($current_time);                            
                            if(array_key_exists('survey_duration', $metaArray) && $metaArray['survey_duration'] != null && $metaArray['survey_duration'] != ''){
                                if($difference >= $metaArray['survey_duration']){
                                    return ['status'=>false, 'message'=>'Survey Timer has been expired. You can start new survey!','type'=>'timer_expired'];
                                }
                            }
                        }
                    break;

                    case'survey_expire_time':
                        $survey_expiry_date = @$metaArray['expire_date'];
                        $survey_expiry_time = @$metaArray['survey_expire_time'];
                        if($survey_expiry_date != null && $survey_expiry_time != null){
                            $currentDateTime = Carbon::now();
                            $expirayTimestamp = Carbon::parse($survey_expiry_date.' '.$survey_expiry_time);
                            $totalSeconds = $expirayTimestamp->diffInSeconds($currentDateTime);
                            $days = $expirayTimestamp->diff($currentDateTime)->format('%D');
                            $hours = $expirayTimestamp->diff($currentDateTime)->format('%H');
                            $minutes = $expirayTimestamp->diff($currentDateTime)->format('%I');
                            $seconds = $expirayTimestamp->diff($currentDateTime)->format('%S');
                            if($days <= 0 && $hours <= 0 && $minutes <= 0 && $seconds <= 0){
                                return ['status'=>false, 'message'=>'Survey Timer has been expired. You can start new survey!','type'=>'timer_expired'];
                            }

                        }
                        if($survey_expiry_date != null && $survey_expiry_time == null){

                        }
                        if($survey_expiry_date == null && $survey_expiry_time != null){

                        }
                        if($survey_expiry_date == null && $survey_expiry_time == null){
                            return ['status'=>true];
                        }
                    break;
                }
            }
        }
        return $surveyStatus;
    }

    public function getTimeDifference(Request $request){
        $metaArray = json_decode($request->data,true);
        $timer_type = $metaArray['timer_type'];
        switch($timer_type){
            case'survey_duration':
                $survey_started_time = Carbon::parse($request->start_time);
                $surveyDuration = @$metaArray['survey_duration'];
                if($surveyDuration != null){
                    $currentDateTime = Carbon::now();
                    $expiryTime = $survey_started_time->addMinutes($surveyDuration);
                    $totalSeconds = $expiryTime->diffInSeconds($currentDateTime);
                    $d = $expiryTime->diff($currentDateTime)->format('%D');
                    $h = $expiryTime->diff($currentDateTime)->format('%H');
                    $m = $expiryTime->diff($currentDateTime)->format('%I');
                    $s = $expiryTime->diff($currentDateTime)->format('%S');
                    if($currentDateTime > $expiryTime){
                        return response()->json(['days'=>00,'hours'=>00,'minutes'=>00,'seconds'=>00]);
                    }else{
                        return response()->json(['days'=>$d,'hours'=>$h,'minutes'=>$m,'seconds'=>$s]);
                    }
                }
            break;

            case'survey_expire_time':
                $survey_expiry_date = @$metaArray['expire_date'];
                $survey_expiry_time = @$metaArray['survey_expire_time'];
                if($survey_expiry_date != null && $survey_expiry_time != null){
                    $currentDateTime = Carbon::now();
                    $expirayTimestamp = Carbon::parse($survey_expiry_date.' '.$survey_expiry_time);
                    $totalSeconds = $expirayTimestamp->diffInSeconds($currentDateTime);                    
                    $days = $expirayTimestamp->diff($currentDateTime)->format('%D');
                    $hours = $expirayTimestamp->diff($currentDateTime)->format('%H');
                    $minutes = $expirayTimestamp->diff($currentDateTime)->format('%I');
                    $seconds = $expirayTimestamp->diff($currentDateTime)->format('%S');
                    if($currentDateTime > $expirayTimestamp){
                        return response()->json(['days'=>00,'hours'=>00,'minutes'=>00,'seconds'=>00]);
                    }else{
                        return response()->json(['days'=>$days,'hours'=>$hours,'minutes'=>$minutes,'seconds'=>$seconds]);
                    }

                }
                if($survey_expiry_date != null && $survey_expiry_time == null){
                    $currentDateTime = Carbon::now();
                    $expirayTimestamp = Carbon::parse($survey_expiry_date);
                    $totalSeconds = $expirayTimestamp->diffInSeconds($currentDateTime);
                    $days = $expirayTimestamp->diff($currentDateTime)->format('%D');
                    $hours = $expirayTimestamp->diff($currentDateTime)->format('%H');
                    $minutes = $expirayTimestamp->diff($currentDateTime)->format('%I');
                    $seconds = $expirayTimestamp->diff($currentDateTime)->format('%S');
                    if($currentDateTime > $expirayTimestamp){
                        return response()->json(['days'=>00,'hours'=>00,'minutes'=>00,'seconds'=>00]);
                    }else{
                        return response()->json(['days'=>$days,'hours'=>$hours,'minutes'=>$minutes,'seconds'=>$seconds]);
                    }
                }
                if($survey_expiry_date == null && $survey_expiry_time != null){
                    $currentDateTime = Carbon::now();
                    $expirayTimestamp = Carbon::parse($survey_expiry_time);
                    $totalSeconds = $expirayTimestamp->diffInSeconds($currentDateTime);
                    $days = $expirayTimestamp->diff($currentDateTime)->format('%D');
                    $hours = $expirayTimestamp->diff($currentDateTime)->format('%H');
                    $minutes = $expirayTimestamp->diff($currentDateTime)->format('%I');
                    $seconds = $expirayTimestamp->diff($currentDateTime)->format('%S');
                    if($currentDateTime > $expirayTimestamp){
                        return response()->json(['days'=>00,'hours'=>00,'minutes'=>00,'seconds'=>00]);
                    }else{
                        return response()->json(['days'=>$days,'hours'=>$hours,'minutes'=>$minutes,'seconds'=>$seconds]);
                    }
                }
            break;
        }
    }
 
    protected function findScheduleCases($startDate, $expireDate, $startTime, $expireTime)
    {

        $scheduleCase = '';
        if ($startDate == "" && $expireDate != "" && $startTime == "" && $expireTime == "") {
            $scheduleCase = "A"; // only have expiredate;
        }
        if ($startDate != "" && $expireDate != "" && $startTime == "" && $expireTime == "") {
            $scheduleCase = "B"; //have startdate and expiredate
        }
        if ($startDate != "" && $expireDate == "" && $startTime == "" && $expireTime == "") {
            $scheduleCase = "C"; //have startdate
        }
        if ($startDate == "" && $expireDate == "" && $startTime != "" && $expireTime != "") {
            $scheduleCase = "D"; //have starttime,expiretime
        }
        if ($startDate == "" && $expireDate == "" && $startTime != "" && $expireTime == "") {
            $scheduleCase = "E"; //have starttime;
        }
        if ($startDate == "" && $expireDate == "" && $startTime == "" && $expireTime != "") {
            $scheduleCase = "F"; // have expire time
        }
        if ($startDate != "" && $expireDate != "" && $startTime != "" && $expireTime != "") {

            $scheduleCase = "G"; //have startdate, expiredate, starttime, endtime
        }
        if ($startDate != "" && $expireDate != "" && $startTime != "" && $expireTime == "") {
            $scheduleCase = "H";  //have startdate,expiredate,starttime
        }
        if ($startDate != "" && $expireDate != "" && $startTime == "" && $expireTime != "") {
            $scheduleCase = "I"; //startdate,expiredate,expiretime
        }
        if ($startDate != "" && $expireDate == "" && $startTime != "" && $expireTime != "") {
            $scheduleCase = "J"; //startdate,startime,expiretime
        }
        if ($startDate == "" && $expireDate != "" && $startTime == "" && $expireTime != "") {
            $scheduleCase = "K"; //expiredate,expiretime
        }
        if ($startDate == "" && $expireDate != "" && $startTime != "" && $expireTime == "") {
            $scheduleCase = "L"; //have expiredate,starttime
        }
        if ($startDate == "" && $expireDate == "" && $startTime == "" && $expireTime == "") {
            $scheduleCase = "M";  //expiredate ,expiretime startdate starttime
        }
        if ($startDate == "" && $expireDate != "" && $startTime != "" && $expireTime != "") {
            $scheduleCase = "N";  //expiredate ,starttime expiretime
        }
        if ($startDate != "" && $expireDate == "" && $startTime != "" && $expireTime == "") {
            $scheduleCase = "O";  //expiredate ,starttime expiretime
        }
        return $this->validateSurveyDateTime($scheduleCase, $startDate, $expireDate, $startTime, $expireTime);
    }

    protected function validateSurveyDateTime($case, $startDate, $expireDate, $startTime, $expireTime)
    {
        switch ($case) {

            case'A':
                $today = Carbon::today();
                if ($today <= Carbon::parse($expireDate)) {
                    //Not yet expired
                    return ['status' => true];
                } else {
                    return ['status' => false, 'message' => 'Survey Expired before ' . Carbon::parse($expireDate)->diffInDays($today) . ' day\'s'];
                }
                break;

            case'B':
                $today = Carbon::today();
                if ($today >= Carbon::parse($startDate)) {
                    //Survey Started
                } else {
                    return ['status' => false, 'message' => 'Days Pending ' . $today->diffInDays(Carbon::parse($startDate))];
                }

                if ($today <= Carbon::parse($expireDate)) {
                    //Not yet expired
                } else {
                    return ['status' => false, 'message' => 'Survey Expired before ' . Carbon::parse($expireDate)->diffInDays($today) . ' day\'s'];
                }
                return ['status' => true];
                break;

            case'C':
                $today = Carbon::today();
                if ($today >= Carbon::parse($startDate)) {
                    //Survey Started
                    return ['status' => true];
                } else {
                    return ['status' => false, 'message' => 'Days Pending ' . $today->diffInDays(Carbon::parse($startDate))];
                }
                break;

            case'D':
                $now = Carbon::now()->format('H:i:s');
                if ($now >= Carbon::parse($startTime)->format('H:i:s')) {
                    //Start time ok
                } else {
                    return ['status' => false, 'message' => 'Survey Time Not Started Yet'];
                }
                if ($now <= Carbon::parse($expireTime)->format('H:i:s')) {
                    //Start time ok
                } else {
                    return ['status' => false, 'message' => 'Survey Time Expired'];
                }
                return ['status' => true];
                break;

            case'E':
                $now = Carbon::now()->format('H:i:s');
                if ($now >= Carbon::parse($startTime)->format('H:i:s')) {
                    //Start time ok
                } else {
                    return ['status' => false, 'message' => 'Survey Time Not Started Yet'];
                }
                return ['status' => true];
                break;

            case'F':
                $now = Carbon::now()->format('H:i:s');
                if ($now <= Carbon::parse($expireTime)->format('H:i:s')) {
                    //Start time ok
                } else {
                    return ['status' => false, 'message' => 'Survey Time Expired'];
                }
                return ['status' => true];
                break;

            case'G':
                $today = Carbon::today();
                if ($today >= Carbon::parse($startDate)) {
                    //Survey Started
                } else {
                    return ['status' => false, 'message' => 'Days Pending ' . $today->diffInDays(Carbon::parse($startDate))];
                }

                if ($today <= Carbon::parse($expireDate)) {
                    //Not yet expired
                } else {
                    return ['status' => false, 'message' => 'Survey Expired before ' . Carbon::parse($expireDate)->diffInDays($today) . ' day\'s'];
                }
                $now = Carbon::now()->format('H:i:s');
                if ($now >= Carbon::parse($startTime)->format('H:i:s')) {
                    //Start time ok
                } else {
                    return ['status' => false, 'message' => 'Survey Time Not Started Yet'];
                }
                if ($now <= Carbon::parse($expireTime)->format('H:i:s')) {
                    //Start time ok
                } else {
                    return ['status' => false, 'message' => 'Survey Time Expired'];
                }
                return ['status' => true];
                break;

            case'H':
                $today = Carbon::today();
                if ($today >= Carbon::parse($startDate)) {
                    //Survey Started
                } else {
                    return ['status' => false, 'message' => 'Days Pending ' . $today->diffInDays(Carbon::parse($startDate))];
                }

                if ($today <= Carbon::parse($expireDate)) {
                    //Not yet expired
                } else {
                    return ['status' => false, 'message' => 'Survey Expired before ' . Carbon::parse($expireDate)->diffInDays($today) . ' day\'s'];
                }
                $now = Carbon::now()->format('H:i:s');
                if ($now >= Carbon::parse($startTime)->format('H:i:s')) {
                    //Start time ok
                } else {
                    return ['status' => false, 'message' => 'Survey Time Not Started Yet'];
                }
                return ['status' => true];
                break;

            case'I':
                $today = Carbon::today();
                if ($today >= Carbon::parse($startDate)) {
                    //Survey Started
                } else {
                    return ['status' => false, 'message' => 'Days Pending ' . $today->diffInDays(Carbon::parse($startDate))];
                }

                if ($today <= Carbon::parse($expireDate)) {
                    //Not yet expired
                } else {
                    return ['status' => false, 'message' => 'Survey Expired before ' . Carbon::parse($expireDate)->diffInDays($today) . ' day\'s'];
                }
                $now = Carbon::now()->format('H:i:s');
                if ($now <= Carbon::parse($expireTime)->format('H:i:s')) {
                    //Start time ok
                } else {
                    return ['status' => false, 'message' => 'Survey Time Expired'];
                }
                return ['status' => true];
                break;

            case'J':
                $today = Carbon::today();
                if ($today >= Carbon::parse($startDate)) {
                    //Survey Started
                } else {
                    return ['status' => false, 'message' => 'Days Pending ' . $today->diffInDays(Carbon::parse($startDate))];
                }
                $now = Carbon::now()->format('H:i:s');
                if ($now >= Carbon::parse($startTime)->format('H:i:s')) {
                    //Start time ok
                } else {
                    return ['status' => false, 'message' => 'Survey Time Not Started Yet'];
                }
                if ($now <= Carbon::parse($expireTime)->format('H:i:s')) {
                    //Start time ok
                } else {
                    return ['status' => false, 'message' => 'Survey Time Expired'];
                }
                return ['status' => true];
                break;

            case'K':
                $today = Carbon::today();
                if ($today <= Carbon::parse($expireDate)) {
                    //Not yet expired
                } else {
                    return ['status' => false, 'message' => 'Survey Expired before ' . Carbon::parse($expireDate)->diffInDays($today) . ' day\'s'];
                }
                if ($today == Carbon::parse($expireDate)) {
                    $now = Carbon::now()->format('H:i:s');
                    if ($now <= Carbon::parse($expireTime)->format('H:i:s')) {
                        //Start time ok
                    } else {
                        return ['status' => false, 'message' => 'Survey Time Expired','type'=>'expire'];
                    }
                }
                
                return ['status' => true];
                break;

            case'L':
                $today = Carbon::today();
                if ($today <= Carbon::parse($expireDate)) {
                    //Not yet expired
                } else {
                    return ['status' => false, 'message' => 'Survey Expired before ' . Carbon::parse($expireDate)->diffInDays($today) . ' day\'s'];
                }
                $now = Carbon::now()->format('H:i:s');
                if ($now >= Carbon::parse($startTime)->format('H:i:s')) {
                    //Start time ok
                } else {
                    return ['status' => false, 'message' => 'Survey Time Not Started Yet'];
                }
                return ['status' => true];
                break;

            case'M':
                //Nothing set
                return ['status' => true];
                break;

            case'N':
                $today = Carbon::today();
                if ($today <= Carbon::parse($expireDate)) {
                    //Not yet expired
                } else {
                    return ['status' => false, 'message' => 'Survey Expired before ' . Carbon::parse($expireDate)->diffInDays($today) . ' day\'s'];
                }
                $now = Carbon::now()->format('H:i:s');
                if ($now >= Carbon::parse($startTime)->format('H:i:s')) {
                    //Start time ok
                } else {
                    return ['status' => false, 'message' => 'Survey Time Not Started Yet'];
                }
                if ($now <= Carbon::parse($expireTime)->format('H:i:s')) {
                    //Start time ok
                } else {
                    return ['status' => false, 'message' => 'Survey Time Expired'];
                }
                return ['status' => true];
                break;

            case'O':
                $today = Carbon::today();
                if ($today >= Carbon::parse($startDate)) {
                    //Survey Started
                } else {
                    return ['status' => false, 'message' => 'Days Pending ' . $today->diffInDays(Carbon::parse($startDate))];
                }
                $now = Carbon::now()->format('H:i:s');
                if ($now >= Carbon::parse($startTime)->format('H:i:s')) {
                    //Start time ok
                } else {
                    return ['status' => false, 'message' => 'Survey Time Not Started Yet'];
                }
                return ['status' => true];
                break;
        }
    }

    protected function reArrangeQuestionsBySection($surveyRecord, $request)
    {
        $sectionIndex = 0;
        if ($request->has('section')) {
            $sectionIndex = $request->section;
        }
        $sectionsList = [];
        foreach ($surveyRecord['section'] as $key => $section) {
            $sectionsList[$key] = ['title' => $section->section_name, 'description' => $section->section_description];
            if (!$section->sectionmeta->where('key', 'section_type')->isEmpty()) {
                $sectionsList[$key]['section_type'] = @$section->sectionmeta->where('key', 'section_type')[0]->value;
            }
        }
        $fieldsList = [];
        if (isset($surveyRecord['section'][$sectionIndex])) {
            foreach ($surveyRecord['section'][$sectionIndex]['fields'] as $key => $field) {
                $fieldsList[$key] = $field->field_slug;
            }
        }
        return ['sections' => $sectionsList, 'fields' => $fieldsList];
    }

    protected function reArrangeQuestionsBySurvey($surveyRecord, $request)
    {
        $sectionsList = [];
        foreach ($surveyRecord->section as $key => $section) {
            $tempArray = [
                'section_title' => $section->section_name,
                'section_description' => $section->section_description,
            ];
            if (!$section->sectionmeta->where('key', 'section_type')->isEmpty()) {
                $tempArray['section_type'] = @$section->sectionmeta->where('key', 'section_type')[0]->value;
            }
            $fieldsList = [];
            foreach ($section->fields->toArray() as $field_key => $field) {
                $fieldsList[] = $field['field_slug'];
            }
            $tempArray['fields'] = $fieldsList;
            $sectionsList[] = $tempArray;
        }
        return ['sections' => $sectionsList];
    }

    protected function reArrangeQuestionsByQuestion($surveyRecord, $request)
    {
        $sectionIndex = 0;
        $field = '';
        if ($request->has('section')) {
            $sectionIndex = $request->section;
        }
        $questionIndex = 0;
        if ($request->has('question')) {
            $questionIndex = $request->question;
        }
        $sectionsList = [];
        foreach ($surveyRecord['section'] as $key => $section) {
            $tempArray = ['title' => $section->section_name, 'description' => $section->section_description];
            $fieldsList = [];
            foreach ($section->fields->toArray() as $field_key => $field) {
                $fieldsList[] = $field['field_slug'];
            }
            $tempArray['fields'] = $fieldsList;
            $sectionMeta = $section->sectionMeta->where('key','section_type')->first();
            if($sectionMeta != null){
                $section_type = $sectionMeta->value;
                $tempArray['section_type'] = $section_type;
            }
            $sectionsList[$key] = $tempArray;
        }
        if (isset($surveyRecord['section'][$sectionIndex])) {
            $fieldsList = [];
            $fields = $surveyRecord['section'][$sectionIndex]['fields']->toArray();
            foreach ($fields as $field_key => $field) {
                $fieldsList[] = $field['field_slug'];
            }
            if (isset($surveyRecord['section'][$sectionIndex]['fields'][$questionIndex])) {
                $currentField = $surveyRecord['section'][$sectionIndex]['fields'][$questionIndex]->toArray();
                $field = ['field' => $currentField['field_slug'], 'index' => $questionIndex];
            }
        }
        return ['sections' => $sectionsList, 'fields' => $fieldsList, 'field_record' => $field];
    }

    protected function preFillSurveyAnswer($surveyDetails)
    {
        $recordDetails = [];
        $record_id = Session::get('record_id');
        $prefix = DB::getTablePrefix();
        if ($record_id != null) {
            $survey_result_table = get_organization_id() . '_survey_results_' . $surveyDetails->id;
            try {
                $Query = DB::table($survey_result_table)->where('id', $record_id)->first();
                if ($Query != null) {
                    $recordDetails = (array)$Query;
                }
            } catch (\Exception $e) {
                $recordDetails = [];
            }
        }
        $dataArray = [];
        foreach($recordDetails as $key => $value){
            if(is_array(json_decode($value))){
                $dataArray[$key] = json_decode($value);
            }else{
                $dataArray[$key] = $value;
            }
        }
        return $dataArray;
    }

    public function changeShareStatus(Request $request)
    {
        $meta = FormsMeta::firstOrNew(['type' => 'survey', 'form_id' => $request['survey_id'], 'key' => 'share_type']);
        $meta->form_id = $request['survey_id'];
        $meta->key = 'share_type';
        $meta->value = $request['share_status'];
        $meta->type = 'survey';
        $meta->save();
        if ($meta) {
            return "Success";
        } else {
            return "error";
        }
    }

    public function saveShareTo(Request $request, $id)
    {
        $this->validateShareTo($request);
        $model = Collaborator::firstOrNew(['type' => 'survey', 'relation_id' => $id, 'email' => $request->email_user_share]);
        $model->type = 'survey';
        $model->relation_id = $id;
        $model->email = $request->email_user_share;
        $model->access = json_encode($request['user-share-edit-view']);
        $model->userid = Auth::guard('org')->user()->id;
        $model->status = 1;
        $model->save();
        return back();
    }

    protected function validateShareTo($request)
    {
        $rules = [
            'email_user_share' => 'required|email',
            'user-share-edit-view' => 'required'
        ];
        $this->validate($request, $rules);
    }

    public function deleteShareTo($id)
    {
        $model = Collaborator::find($id);
        $model->delete();
        return back();
    }

    public function custom($id)
    {
        $form = forms::select('id')->where('id', $id);
        if (!$form->exists()) {
            $error = __('survey.survey_not_exit');
            return view('organization.survey.customize', compact('error'));
        } else {
            $form = $form->with(['formsMeta' => function ($query) {
                $query->whereIn('key', ['css_code', 'js_code']);
            }])->first()->toArray();
        }
        return view('organization.survey.customize', compact('form'));
    }

    public function save_custom(Request $request)
    {
        foreach ($request->only('css_code', 'js_code') as $key => $value) {
            $form_meta = FormsMeta::where(['form_id' => $request->form_id, 'key' => $key]);
            if ($form_meta->exists()) {
                $form_meta->update(['value' => $value]);
            } else {
                $meta = new formsMeta();
                $meta->form_id = $request->form_id;
                $meta->key = $key;
                $meta->value = $value;
                $meta->save();
            }
        }
        return back();
    }

    public function convertToDataset($id)
    {
        return view('organization.survey.convert-dataset');
    }

    /**
     * Get selected survey columns
     * @param  Request $request having posted data by user
     * @return [type]         will return options(columns) for selcted survey
     * @author Rahul
     */
    public function getSurveyColumns(Request $request)
    {
        try {
            $model = (array)DB::table(get_organization_id() . '_survey_results_' . $request->survey_id)->first();
            $columnsArray = array_keys($model);
            unset($columnsArray['id']);
            $options = '<option>Select Column</option>';
            foreach ($columnsArray as $key => $column) {
                $options .= '<option value="' . $column . '">' . $column . '</option>';
            }
            return $options;
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * Export Survey Data in the form of json
     * @param  [type] $id having survey id
     * @return [type]     will return to download .json file
     * @author Rahul
     */
    public function exportSurvey($id)
    {
        $model = forms::where(['id' => $id])->whereIn('type',['survey','form'])->with(['section' => function ($query) {
            $query->with(['fields' => function ($query) {
                $query->with(['fieldMeta']);
            }, 'sectionMeta']);
        }, 'formsMeta'])->first();
        if ($model != null) {
            $model = $model->toArray();
        } else {
            $model = [];
        }
        $fileName = time() . '_form(survey)_' . $id . '.json';
        File::put(public_path('/tmp/json/' . $fileName), json_encode($model));
        return Response::download(public_path('/tmp/json/' . $fileName));
    }

    public function importSurvey(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->importJsonSurvey($request);
        }
        return view('admin.formbuilder.import');
    }

    protected function importJsonSurvey($request)
    {
        $fileType = $request->file('import_file')->getClientOriginalExtension();
        if ($fileType == 'json') {
            $destination = public_path('/tmp/json/');
            $fileName = $request->file('import_file')->getClientOriginalName();
            $request->file('import_file')->move($destination, $fileName);
            $jsonData = File::get(public_path('/tmp/json/' . $fileName));
            $this->insertImportedJsonSurvey(json_decode($jsonData, true));
        }
    }

    protected function insertImportedJsonSurvey(Array $arrayData)
    {
        $model = new forms;
        $model->form_title = $arrayData['form_title'];
        $model->form_slug = $arrayData['form_slug'];
        $model->form_description = $arrayData['form_description'];
        $model->type = $arrayData['type'];
        $model->embed_token = $arrayData['embed_token'];
        $model->form_order = $arrayData['form_order'];
        $model->form_status = $arrayData['form_status'];
        $model->created_by = (Auth::guard('org')->check()) ? Auth::guard('org')->user()->id : Auth::guard('admin')->user()->id;
        $model->save();
        if (!empty($arrayData['section'])) {
            foreach ($arrayData['section'] as $key => $section) {
                $sectionModel = $this->putSections($model, $section);
                if (!empty($section['fields'])) {
                    foreach ($section['fields'] as $key => $field) {
                        $fieldsModel = $this->putFields($model, $sectionModel, $field);
                        if (!empty($field['field_meta'])) {
                            foreach ($field['field_meta'] as $key => $fieldMeta) {
                                $fieldMetaModel = $this->putFieldMeta($model, $sectionModel, $fieldsModel, $fieldMeta);
                            }
                        }
                    }
                }
                if (!empty($section['section_meta'])) {
                    foreach ($section['section_meta'] as $key => $sectionMeta) {
                        $sectionMetaModel = $this->putSectionMeta($sectionModel, $sectionMeta);
                    }
                }
            }
        }
        if (!empty($arrayData['forms_meta'])) {
            foreach ($arrayData['forms_meta'] as $key => $formMeta) {
                $formMetaModel = $this->putFormMeta($model, $formMeta);
            }
        }
        Session::flash('success', 'Form/Survey Imported Successfully!');
        return back();
    }

    protected function putSections($model, $section)
    {
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

    protected function putFields($model, $sectionModel, $field)
    {
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

    protected function putFieldMeta($model, $sectionModel, $fieldsModel, $fieldMeta)
    {
        $fieldMetaModel = new FieldMeta;
        $fieldMetaModel->form_id = $model->id;
        $fieldMetaModel->section_id = $sectionModel->id;
        $fieldMetaModel->field_id = $fieldsModel->id;
        $fieldMetaModel->key = $fieldMeta['key'];
        $fieldMetaModel->value = $fieldMeta['value'];
        $fieldMetaModel->save();
        return $fieldMetaModel;
    }

    protected function putSectionMeta($sectionModel, $sectionMeta)
    {
        $sectionMetaModel = new SectionMeta;
        $sectionMetaModel->section_id = $sectionModel->id;
        $sectionMetaModel->key = $sectionMeta['key'];
        $sectionMetaModel->value = $sectionMeta['value'];
        $sectionMetaModel->save();
        return $sectionMetaModel;
    }

    protected function putFormMeta($model, $formMeta)
    {
        $formMetaModel = new FormsMeta;
        $formMetaModel->form_id = $model->id;
        $formMetaModel->key = $formMeta['key'];
        $formMetaModel->value = $formMeta['value'];
        $formMetaModel->type = $formMeta['type'];
        $formMetaModel->save();
        return $formMetaModel;
    }

    public function SurveyCompleted()
    {
        Session::put('record_id');
        return view('organization.survey.public.survey_completed');
    }

    protected function put_session_survey($option, $form_id, $data)
    {
        if ($option == 'section') {
            Session::put(['form_id' . $form_id => $form_id, 'section' . $form_id => $data]);
        } elseif ($option == 'question') {
            Session::put(['form_fiel_id' . $form_id => $form_id, 'field' . $form_id => $data]);
        }
    }

    protected function survey_error($setting, $survey_id)
    {
        // dump(12, empty($setting['enable_survey']), $setting['enable_survey']);
        //dd($setting);
        if (isset($setting['enable_survey']) && $setting['enable_survey'] == 0) {
            return ["survey_is_disabled" => "Survey is disabled."];
        }
        if (isset($setting['authentication_required']) && ($setting['authentication_required'] == true)) {
            if (isset($setting['authentication_type']) && ($setting['authentication_type'] == 'user')) {
                if (!Auth::guard('org')->check()) {
                    return ["survey_authorization_required" => "You have to login to access the survey."];
                } else {
                    $user_id = Auth::guard('org')->user()->id;
                    $user_list = json_decode($setting['individual_list'], true);
                    if (empty($user_list) || !in_array($user_id, $user_list)) {
                        return ["survey_un-authorization_user" => "You do not have permissions to access the survey."];
                    }
                }
            } elseif (isset($setting['authentication_type']) && ($setting['authentication_type'] == 'role')) {
                if (!Auth::guard('org')->check()) {
                    return ["survey_authorization_required" => "Sign-in to fill surrvey"];
                }
                $role_list = array_map('intval', json_decode($setting['role_list'], true));
                if (count(array_intersect(role_id(), $role_list)) == 0) {
                    return ["survey_unauthorization_role" => "Your user role do not have permissions access the survey."];
                }
            }
        }
        if (isset($setting['survey_scheduling']) && ($setting['survey_scheduling'] == true)) {
            if (!empty($setting['start_date'])) {
                $current = date('Y-m-d');
                $start_date = date('Y-m-d', strtotime($setting['start_date']));
                if ($current < $start_date) {
                    return ["survey_not_started" => "Survey not started yet."];
                }
                if ($current == $start_date) {
                    $current_time = date('h:i');
                    if (!empty($setting['survey_start_time'])) {
                        if ($current_time < $setting['survey_start_time'])
                            return ["time_left_to_start" => "Time left to start survry"];
                    }
                }
            }
            if (!empty($setting['expire_date'])) {
                $expire_date = date('Y-m-d', strtotime($setting['expire_date']));
                if ($current > $expire_date) {
                    return ["survey_expired" => "Survey is expired."];
                }
                if ($current == $expire_date) {
                    $current_time = date('h:i a');
                    if (!empty($setting['survey_expire_time'])) {
                        if ($current_time > $setting['survey_expire_time']) {
                            return ["survey_expired_time" => "survey time expired now"];
                        }
                    }
                }
            }
        }
        // survey_response_limit  response_limit response_limit_type
        if (isset($setting['survey_response_limit']) && ($setting['survey_response_limit'] == true)) {
            if (isset($setting['response_limit_type']) && ($setting['response_limit_type'] == "per_ip")) {
                $organization_id = get_organization_id();
                $table = $organization_id . '_survey_results_' . $survey_id;
                $ip = \Request::ip();
                if (Schema::hasTable($table)) {
                    $filled_count = DB::table($table)->where('ip_address', $ip)->count();
                    if (!empty($setting['response_limit'] <= $filled_count)) {
                        return ["survey_responce_limit" => "Across survey limit for this ip"];
                    }
                }
            }
            if (!empty($setting['authentication_required']) && ($setting['authentication_required'] == true)) {
                $user_id = Auth::guard('org')->user()->id;
                if (!empty($setting['response_limit_type'] == "per_user")) {
                    $organization_id = get_organization_id();
                    $table = $organization_id . '_survey_results_' . $survey_id;
                    $ip = \Request::ip();
                    if (Schema::hasTable($table)) {
                        $filled_count = DB::table($table)->where('survey_submitted_by', $user_id)->count();
                        if (!empty($setting['response_limit']) && ($setting['response_limit'] <= $filled_count)) {
                            return ["survey_responce_limit" => "Across survey limit for this user"];
                        }
                    }
                }
            }
        }
        return true;
    }

}
