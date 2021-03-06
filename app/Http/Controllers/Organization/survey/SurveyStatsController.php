<?php

namespace App\Http\Controllers\Organization\survey;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\forms;
use App\Model\Organization\FormsMeta;
use App\Model\Organization\FormBuilder;
use DB;
use Illuminate\Support\Facades\Schema;
use Excel;
use App\Model\Admin\FormBuilder as GFB;
use Session;
use Carbon\carbon;
use Auth;
use App\Model\Organization\section;
use Illuminate\Pagination\Paginator;
use File;

/**
 * @author [Paljinder Singh ] SurveyStatsController all work done by Paljnder Singh
 */
class SurveyStatsController extends Controller
{
    public function stats($id)
    {
        $data['status'] = $data['count']['completed'] = $data['count']['sections'] = $data['count']['fields'] = $data['count']['incomplete'] = 0;
        $field = [];
        $data['status'] = null;
        $survey_data = forms::with(['section.fields.fieldMeta', 'formsMeta'])->where('id', $id);
        if ($survey_data->exists()) {
            $survey_data = $survey_data->first();
            if (count($survey_data['section']) > 0) {
                foreach ($survey_data['section'] as $key => $value) {
                    if (!empty($value['fields'])) {
                        $field[] = count($value['fields']);
                    }
                }
                if (!empty($field)) {
                    $data['count']['fields'] = array_sum($field);
                } else {
                    $data['status'] = 'error';
                    $data['errors'][] = __('survey.survey_question_miss');
                }
                $data['count']['sections'] = count($survey_data['section']);
            } else {
                $data['status'] = 'error';
                $data['errors'][] = __('survey.survey_section_miss');
            }
            $response_table = $this->get_survey_table_name($id);
            if (empty($response_table)) {
                $data['errors'][] = __('survey.survey_results_table_missing');
            } else {

                $table_name = $response_table['table']; 
                $data['date_by'] = DB::select("select date(created_at) as date , count(id) as total, sum(case when survey_status = 'completed' then 1 else 0 end) as completed, sum(case when survey_status = 'incompleted' then 1 else 0 end) as uncompleted, count(*) as totals from " . $table_name . " group by date(created_at)");
                
                $data['user_by'] = DB::select("select survey_submitted_by as user_id, count(id) as total, sum(case when survey_status ='completed' then 1 else 0 end) as completed , sum(case when survey_status ='incompleted' then 1 else 0 end ) as uncompleted  FROM `" . $table_name . "` group by survey_submitted_by ");
                $data['user_submit_from'] = DB::select("select survey_submitted_by as user_id , count(id) as total, sum( case when survey_submitted_from = 'app' then 1 else 0 end) as application , sum(case when survey_submitted_from='web' then 1 else 0 end) as web FROM `" . $table_name . "` group by survey_submitted_by");

                $data['date_submit_from'] = DB::select("select date(created_at) as date , count(id) as total, sum( case when survey_submitted_from = 'app' then 1 else 0 end) as application , sum(case when survey_submitted_from='web' then 1 else 0 end) as web FROM `" . $table_name . "` group by date(created_at)");
                $table_name = $response_table['replace_ocrm'];
                
                $data['count']['completed'] = DB::table($table_name)->where('survey_status', 'completed')->count();
                $data['count']['incomplete'] = DB::table($table_name)->where('survey_status', 'incompleted')->count();
            }
        } else {
            $data['status'] = 'error';
            $data['errors'][] = __('survey.survey_not_exit');
        }
        if ($data['status'] != 'error') {
            $data['status'] = 'success';
        }
        return view('organization.survey.survey_stats', compact('data'));

    }

    protected function get_survey_table_name($form_id)
    {
        $table = $replace_ocrm = null;
        $metaTable = FormsMeta::where(['form_id' => $form_id, 'key' => 'survey_data_table']);
        if ($metaTable->exists()) {
            $table = $metaTable->first()->value;
            $replace_ocrm = str_replace('ocrm_', '', $table);
            if (Schema::hasTable($replace_ocrm)) {
                return ['table' => $table, 'replace_ocrm' => $replace_ocrm];
            }
        }
        return null;
    }

    public function survey_structure($id)
    {

        $id = intval($id);
        $survey_data = forms::with(['formsMeta', 'section' => function ($query) {
            $query->orderBy('order', 'asc');
        },
            'section.fields' => function ($query_field) {
                $query_field->orderBy('order', 'asc');
            },
            'section.fields.fieldMeta'])->where('id', $id);

        if ($survey_data->exists()) {
            $survey_data = $survey_data->first()->toArray();
            
            $data = $this->count_section_question($survey_data);
            $count_form_slug = forms::where('form_slug', $survey_data['form_slug'])->count();
            $setting_questions = GFB::orderBy('order', 'asc')->whereIn('form_id', [93, 76])->get()->keyBy('field_slug')->toArray(); //pluck('field_title', 'field_slug');
            return view('organization.survey.survey_structure', compact('id', 'data', 'survey_data', 'setting_questions', 'count_form_slug'));
        } else {
            $not_valid_id = "This survey id ($id) is not valid.";
            return view('organization.survey.survey_structure', compact('not_valid_id'));
        }
    }

    protected function count_section_question($survey_data)
    {
        if (count($survey_data['section']) > 0) {
            foreach ($survey_data['section'] as $key => $value) {
                if (!empty($value['fields'])) {
                    $field[] = count($value['fields']);
                }
            }
            if (!empty($field)) {
                $data['count']['fields'] = array_sum($field);
            } else {
                $data['status'] = 'error';
                $data['errors'][] = __('survey.survey_question_miss');
            }
            $data['count']['sections'] = count($survey_data['section']);
        } else {
            $data['status'] = 'error';
            $data['errors'][] = __('survey.survey_section_miss');
        }
        return $data;

    }

    public function survey_result( Request $request, $id ) {

        $condition_data = $table = $filter_field = $formQuestion = $columns = $data = null;

        $metaTable          = FormsMeta::where(['form_id' => $id, 'key' => 'survey_data_table']);
        $prefix             = DB::getTablePrefix();
        $organization_id    = get_organization_id();

        if ( Schema::hasTable($organization_id . '_survey_results_' . $id ) ) {

            $table          = $prefix . $organization_id . '_survey_results_' . $id;
            $table_name     = str_replace( 'ocrm_', '', $table );
            $table_column   = Schema::getColumnListing( $table_name );
            $columns        = array_combine( $table_column, $table_column );


            if ( $request->isMethod('post') ) {

                if ( $request->has('page') ) {
                    Paginator::currentPageResolver(function () use ($request) {
                        return $request->page;
                    });
                } else {
                    Paginator::currentPageResolver(function () {
                        return 1;
                    });
                }

                if ( isset($request['condition_field']) && !empty(array_filter($request['condition_field'])) && !empty(array_filter($request['condition_field_value']))) {
                    $filter_field['condition_field'] = $request['condition_field'];
                    $filter_field['condition_field_value'] = $request['condition_field_value'];
                    $filter_field['operator'] = $request['operator'];
                }

                $this->validations($request);
                $data = $this->filter_on_suvey_result($request, $table_name, $columns);
                if (!empty($request['export'])) {
                    $condition = json_decode($data['filter_data']->get(), true);
                }
                if (!empty($condition['condition_data'])) {
                    $condition_data = $condition['condition_data'];
                    unset($condition['condition_data']);
                }
                if (!empty($request['export'])) {
                    $survey_slug = forms::select('form_slug')->where('id', $id)->first()->form_slug;
                    $file_name = $survey_slug . '_' . generate_filename();
                    Excel::create($file_name, function ($excel) use ($condition) {
                        $excel->sheet('mySheet', function ($sheet) use ($condition) {
                            $sheet->fromArray($condition);
                        });
                    })->export('csv');
                }
                $data = $data['filter_data']->paginate(100);
            } else {
                $data = DB::table($table_name)->paginate(100);
            }
            $formQuestion = FormBuilder::select('field_slug', 'field_title')->where('form_id', $id)->get()->mapWithKeys(function ($items) {
                return [$items['field_slug'] => $items['field_title']];
            })->toArray();
        }

        return view( 'organization.survey.survey_result', compact('id', 'columns', 'data', 'formQuestion', 'condition_data', 'table', 'filter_field') ) ; 

    }

    protected function validations($req)
    {
        $customMessages = [
            'fields.required' => 'Select atleast one field to view data.',
        ];
        return $this->validate($req, ['fields' => 'required'], $customMessages);
    }

    protected function filter_on_suvey_result($request, $table_name)
    {
        $condition = null;
        $filled_codition = [];
        if (isset($request['condition_field']) && !empty(array_filter($request['condition_field'])) && !empty(array_filter($request['condition_field_value']))) {
            $where = [];
            foreach ($request['condition_field'] as $key => $value) {
                if (isset($request['operator'][$key]) && isset($request['condition_field_value'][$key])) {
                    $condition_field_value = $request['condition_field_value'][$key];
                    $operator = $request['operator'][$key];
                    if ($operator == 'like') {
                        $final = [$value, $operator, $condition_field_value . '%'];
                    } else {
                        $final = [$value, $operator, $condition_field_value];
                    }
                    array_push($filled_codition, ['condition_field' => $value, 'operator' => $operator, 'condition_field_value' => $condition_field_value]);
                    array_push($where, $final);
                }
            }
        }

        if (!empty($where)) {
            $data = DB::table($table_name)->select($request['fields']);
            if (count($where) > 1) {
                foreach ($where as $key => $singleWhere) {
                    $data->orWhere($singleWhere[0], $singleWhere[1], $singleWhere[2]);
                }
            } else {
                $data->where($where);//->get();
            }
        } else {
            if (!empty($request['fields'])) {
                $select_field = array_filter($request['fields']);
                $data = DB::table($table_name)->select($select_field);//->get();
            } else {
                $data = DB::table($table_name);//->get();
            }
        }
        return ['filter_data' => $data, 'filter_fields' => $filled_codition];
    }


    /**
     * @param $surveyDetails
     * @return array
     */
    protected function getRepeaterSectionsSlug($surveyDetails){
        $repeaterSectionSlugs = [];
        if(!$surveyDetails->section->isEmpty()){
            foreach($surveyDetails->section as $key => $value){
                if(!$value->sectionMeta->isEmpty()){
                    $model = $value->sectionMeta->where('key','section_type')->first();
                    if($model != null && $model->value == 'repeater'){
                        $repeaterSectionSlugs[] =  $value->section_slug;
                    }
                }
            }
        }
        return $repeaterSectionSlugs;
    }

    protected function reArrangeModelOrder($model, $surveyModel, $checkBoxSlugs){
        $fields = [];
        $fields[0] = 'id';
        $repeaterSlugs = [];
        foreach($surveyModel->section as $key => $section){
            $isRepeater = $section->sectionMeta->where('key','section_type')->where('value','repeater')->first();
            if($isRepeater == null){
                // Amrit
                $custom_array = $section->fields->groupBy('field_slug')->keys()->toArray();
                $custom_fields = [];
                foreach($custom_array as $custom_arraykey => $custom_arrayvalue){ 
                    $temdata = substr($custom_arrayvalue,0,62);
                    $temdata =str_replace("-","_",$temdata);
                    $custom_fields[] = $temdata;
                }
                
                $fields = array_merge($fields,$custom_fields);
                // *** //
                //$fields = array_merge($fields,$section->fields->groupBy('field_slug')->keys()->toArray());
            }else{
                $repeaterSlugs[] = $section->section_slug;
                $fields[] = $section->section_slug;
            }
        }
        $extraColumns = ['ip_address','survey_started_on','survey_completed_on','survey_submitted_by','survey_submitted_from',' mac_address','imei','unique_id','device_detail',' created_by','created_at','last_field_id','last_group_id','completed_groups','survey_status','incomplete_name survey_sync_status'];
        //$extraColumns = [];
        $fields = array_merge($fields,$extraColumns);
        $collectRepeatermaximums = [];
        $modelData = [];        
        foreach($model as $key => $value){
            $value = (array)$value;
            foreach($fields as $k => $val){
                try{
                    $modelData[$key][$val] = $value[$val];
                    if(in_array($val,$repeaterSlugs)){
                        $collectRepeatermaximums[] = json_decode($value[$val],true);
                    }
                }catch(\Exception $e){
                    continue;
                }
            }
            $modelData[$key] = array_map(function($v){
                return (is_null($v)) ? 994 : $v;
            },$modelData[$key]);
            $model[$key] = (object)$modelData[$key];
        }


        return ['model'=>$model,'maximum_repeaters'=>$collectRepeatermaximums];
    }

    protected function insert_into_array( $array, $search_key, $insert_key, $insert_value, $insert_after_founded_key =
true, $append_if_not_found = false ) {

        $new_array = array();

        foreach( $array as $key => $value ){

            // INSERT BEFORE THE CURRENT KEY?
            // ONLY IF CURRENT KEY IS THE KEY WE ARE SEARCHING FOR, AND WE WANT TO INSERT BEFORE THAT FOUNDED KEY
            if( $key === $search_key && ! $insert_after_founded_key )
                $new_array[ $insert_key ] = $insert_value;

            // COPY THE CURRENT KEY/VALUE FROM OLD ARRAY TO A NEW ARRAY
            $new_array[ $key ] = $value;

            // INSERT AFTER THE CURRENT KEY?
            // ONLY IF CURRENT KEY IS THE KEY WE ARE SEARCHING FOR, AND WE WANT TO INSERT AFTER THAT FOUNDED KEY
            if( $key === $search_key && $insert_after_founded_key )
                $new_array[ $insert_key ] = $insert_value;

        }

        // APPEND IF KEY ISNT FOUNDED
        if( $append_if_not_found && count( $array ) == count( $new_array ) )
            $new_array[ $insert_key ] = $insert_value;

        return $new_array;

    }

    /**
     * @param $model
     * @param $maximumColumnsKeys
     * @param $columnsModel
     * @param $surveyModel
     * @return mixed
     */
    protected function reArrangeRepeaterColumnsData($model, $maximumColumnsKeys, $columnsModel, $surveyModel, $checkBoxSlugs){
        $model = $this->reArrangeModelOrder($model, $surveyModel, $checkBoxSlugs);
        foreach($model as $key => $value) {
            if(!empty($columnsModel)){
                if(@$columnsModel[$key] != null){
                    foreach ($columnsModel[$key] as $slug => $columns) {
                        unset($model[$key]->{$slug});
                        unset($model[$key]->id);
                        foreach (array_diff($maximumColumnsKeys, array_keys($columns)) as $difKey => $difValue) {
                            $columns[$difValue] = null;
                        }
                        $model[$key] = (array)array_merge($columns, (array)$model[$key]);
                    }                    
                }else{
                    try{
                        $maxColumnKeys = array_map(create_function('$n', 'return null;'), array_flip($maximumColumnsKeys));
                        $model[$key] = (array)array_merge($maxColumnKeys, (array)$model[$key]);
                    }catch(\Exception $e){
                        
                    }
                }
            }
        }
        return $model;
    }

    /**
     * @param $jsonRepeater
     * @param $surveyModel
     * @return array|mixed
     */
    protected function reArrangeRepeaterOrder($jsonRepeater, $surveyModel){
        if($jsonRepeater != null){
            $repeaterData = new \stdClass();
            $index = 1;
            foreach($jsonRepeater as $key => $columns){
                $records = $surveyModel->fields->whereIn('field_slug',array_keys((array)$columns));
                if($records->isEmpty()){
                    $records = $surveyModel->fieldMeta->where('key','question_id')->whereIn('value',
                        array_keys((array)
                    $columns));
                    /*$orderdRecords = $records->groupBy('field.field_slug')->keys()->toArray();
                    dump($orderdRecords);
                    dd((array)$columns);*/
                    $orderdRecords = $records->groupBy('value')->keys()->toArray();
                    // dd($orderdRecords);
                    
                }else{
                    $orderdRecords = $records->groupBy('field_slug')->keys()->toArray();
                }
                $tempArray = [];
                foreach($orderdRecords as $recKey => $recValue){
                    $tempArray[$recValue] = $columns->{$recValue};
                }
                $repeaterData->{$key} = (object)$tempArray;
            }
            return $repeaterData;
        }
        return [];
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function reports(Request $request, $id)
    {
        // ini_set('memory_limit', '-1');
        static $tableColumns;
        $surveyResultTable = get_organization_id().'_survey_results_'.$id;
        if(!Schema::hasTable($surveyResultTable)){
            return view('organization.survey.survey_reports',['error'=>'Survey result table not found!']);
        }
        $surveyModel = forms::with(['section'=>function($query){
                $query->with(['fields'])->orderBy('order','asc');
        },'fields'=>function($query){
            $query->with('fieldMeta')->orderBy('order','asc');
        },'fieldMeta'=>function($query){
            $query->with('field');
        }])->find($id);

        //dd(json_encode($surveyModel->toArray()));

        $repeaterSlugs = $this->getRepeaterSectionsSlug($surveyModel);
        $checkBoxSlugs = $this->getCheckBoxesFieldsSlug($surveyModel); 

        $model = $this->getDataForReport($request, $surveyResultTable);
        $columns = $model['table_columns'];
        $model = $model['result'];
        $columnsModel = [];
        $maximumColumnsKeys = [];

        $result = $this->reArrangeModelOrder($model, $surveyModel, $checkBoxSlugs);

        $model = $result['model'];
        $model = $this->putCheckboxFieldsInmodel($model, $checkBoxSlugs);

        $maximumColumnsKeys = $this->getMaximumCountForRepeaters($surveyResultTable,$repeaterSlugs);
        //Code For Repeater
        foreach($model as $key => $value){
            foreach($repeaterSlugs as $k => $slug){
                $maxCount = $maximumColumnsKeys[$slug]['count'];
                if(array_key_exists($slug,$value)){
                    $repeaterData = $this->convertQuestionIdToSlug(json_decode($value[$slug],true), $surveyModel,$maximumColumnsKeys[$slug]['max_columns'], $slug);
                    if(count($repeaterData) < $maxCount){
                        for($i = count($repeaterData); $i < $maxCount; $i++){
                            $slugs = array_flip(preg_replace('/([0-9])/', $i+1, array_keys($repeaterData[0])));
                            $slugsToRepeat = array_fill_keys(array_keys($slugs), null);
                            $repeaterData[] = $slugsToRepeat;
                        }
                    }
                    

                    $repeaterData = preg_replace('/([? undefined:undefined ?]\w+)/','',call_user_func_array('array_merge',$repeaterData));
                    $repeaterData = preg_replace('/[-?]\s+[-?]/','',$repeaterData);
                    $data = $model[$key];
                    $indexToReplace = array_search($slug,array_keys($data));
                    $tempKeys = array_keys($data);
                    $data = array_values($data);
                    array_splice($data, $indexToReplace, 0, $repeaterData);
                    $keysToAdd = array_keys($repeaterData);
                    array_splice($tempKeys, $indexToReplace, 0, $keysToAdd);
                    $data = array_combine($tempKeys,$data);
                    unset($data[$slug]);
                    $model[$key] = $data;
                }
            }
        }
        //Code for export data
        if($request->has('export')){
            $this->outputCsv('survey_report_data'.time().'.csv',$model->toArray());
        }
        return view('organization.survey.survey_reports',['model'=>$model,'columns'=>$columns,
                'condition_fields'=>$columns]);
    }

    public function outputCsv($fileName, $assocDataArray){
        // ob_clean();
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private', false);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=' . $fileName);    
        if(isset($assocDataArray['0'])){
            $fp = fopen('php://output', 'w');
            fputcsv($fp, array_keys($assocDataArray['0']));
            foreach($assocDataArray AS $values){
                fputcsv($fp, $values);
            }
            fclose($fp);
        }
        // ob_flush();
        exit;
    }

    protected function getMaximumCountForRepeaters($table,$repeaterSlugs){
        if(!empty($repeaterSlugs)){
            $model = DB::table($table)->select($repeaterSlugs)->get();
            $maximumCountRepeater = [];
            foreach($model as $key => $value){
                foreach($repeaterSlugs as $k => $slug){
                    if($value->{$slug} != null && $value->{$slug} != ''){
                        $jsonDecodedData = json_decode($value->{$slug}, true);
                        if(@$maximumCountRepeater[$slug] == null){
                            $maximumCountRepeater[$slug]['count'] = count($jsonDecodedData);
                            $maximumCountRepeater[$slug]['max_columns'] = collect($jsonDecodedData)->max();
                        }else{
                            if(count($jsonDecodedData) > $maximumCountRepeater[$slug]['count']){
                                $maximumCountRepeater[$slug]['count'] = count($jsonDecodedData);
                            }
                            if(count(collect($jsonDecodedData)->max()) >= count($maximumCountRepeater[$slug]['max_columns'])){
                                $maximumCountRepeater[$slug]['max_columns'] = collect($jsonDecodedData)->max();
                            }

                        }
                    }
                }
            }
            return $maximumCountRepeater;
        }
    }

    protected function convertQuestionIdToSlug($jsonDecodedData, $surveyModel, $maximumRepeaterCollection, $sectionName){
        $objectArray = [];
        $index = 0;
        // $maximumRepeaterCollection = array_map(create_function('$n', 'return null;'), $maximumRepeaterCollection);
        $maximumRepeaterCollection = array_fill_keys(array_keys($maximumRepeaterCollection), null);
        if($jsonDecodedData == null || $jsonDecodedData == 994){
            $jsonDecodedData = [array_fill_keys(array_keys($maximumRepeaterCollection), null)];
        }        
        foreach($jsonDecodedData as $k => $value){
            $value = array_merge($maximumRepeaterCollection,$value);
            $tempArray = [];
            foreach($value as $key => $val){
                preg_match('/(SID)\w+/', $key,$matches);
                if(!empty($matches)){
                    $metaValue = $surveyModel->fieldMeta->where('key','question_id')->where('value',$key)->first();
                    $slug = @$surveyModel->fields->find($metaValue->field_id)->field_slug;
                    if($slug != null){
                        $tempArray[$sectionName.'_'.$slug.'_'.($index+1)] = $val;
                    }
                }else{
                    $tempArray[$sectionName.'_'.$key.'_'.($index+1)] = $val;
                }
            }
            $objectArray[$index] = $tempArray;
            $index++;
        }
        return $objectArray;
    }

    protected function putCheckboxFieldsInmodel($model, $checkBoxSlugs){
        foreach($model as $key => $value){
            $dataValue = [];
            foreach($value as $modelKey => $modelValue){
                if(array_key_exists($modelKey, $checkBoxSlugs)){
                    $checkForAllNo = [];
                    foreach($checkBoxSlugs[$modelKey] as $k => $slug){
                        $filledValue = json_decode($modelValue,true);     
                        if(is_array($filledValue)){
                            if(@$filledValue[$k] == true){
                                $dataValue[$modelKey.'_'.$k] = 'Yes';
                            }else{
                                $dataValue[$modelKey.'_'.$k] = 'No';
                                $checkForAllNo[] = 'No';
                            }
                        }elseif($filledValue == null){
                            $dataValue[$modelKey.'_'.$k] = 994;
                        }else{        
                            
                            if($modelValue == $k){
                                $dataValue[$modelKey.'_'.$k] = 'Yes';
                            }elseif($modelValue == 994){
                                $dataValue[$modelKey.'_'.$k] = 994;
                            }else{
                                $dataValue[$modelKey.'_'.$k] = 'No';
                            }
                        }
                    }
                    if(count($checkForAllNo) == count($checkBoxSlugs[$modelKey])){
                        foreach($checkBoxSlugs[$modelKey] as $k => $v){
                            $dataValue[$modelKey.'_'.$k] = 994;
                        }
                    }

                }else{
                    $dataValue[$modelKey] = $modelValue;
                }
            }            
            $model[$key] = $dataValue;
        }
        return $model;
    }

    protected function getCheckBoxesFieldsSlug($surveyModel){
        $fields = $surveyModel->fields->where('field_type','checkbox');
        $fieldSlugs = [];
        foreach($fields as $key => $value){
            $fieldOptions = $value->fieldMeta->where('key','field_options')->first();
            if($fieldOptions != null){
                $options = json_decode($fieldOptions->value, true);
                $keys = collect($options)->groupBy('key')->keys()->toArray();
                $optionValues = collect($options)->groupBy('value')->keys()->toArray();
                $fieldSlugs[$value->field_slug] = array_combine($keys, $optionValues);
            }
        }
        return $fieldSlugs;
    }

    protected function getDataForReport($request, $surveyResultTable){ 
        $Query = DB::table($surveyResultTable);
        if($request->isMethod('post')){



            if( !empty( $request->fields ) ){
                $Query->select($request->fields);

            }
            /*
            if($request->has('fields')){
                $Query->select($request->fields);
            } 
            */



            /*
            if($request->condition_field[0] != null){
                foreach($request->condition_field as $key => $column){
                    $Query->Where($column,$request->operator[$key],$request->condition_field_value[$key]);
                }
            }
            */

        }

        if($request->has('export')){
            /*$chunkSize = 500;
            $chunks = floor(8200 / $chunkSize);
            for ($chunk = 0; $chunk <= $chunks; $chunk++) {
                $offset = $chunk * $chunkSize;
                $result = $Query->skip($offset)->take($chunkSize)->get();
            }*/
            // $result = $Query->skip(0)->take(100)->get();
            // $result = $Query->whereNull('deleted_at')->skip(100)->take(100)->get();
            //$result = $Query->where('center_code', '=', 2)->take(500)->get();
            //$result = $Query->where('center_code', '=', 2)->take(500)->get();
            //$result = $Query->where('center_code', '=', 2)->skip(500)->take(500)->get();
            $result = $Query->whereNull('deleted_at')->get();
            
        }else{
            $result = $Query->whereNull('deleted_at')->paginate(50);
        }
        $getTableColumns = DB::table($surveyResultTable)->first();
        unset($getTableColumns->id);
        $keys = array_keys((array)$getTableColumns);

        return ['result'=>$result, 'table_columns'=>array_combine($keys,$keys)];
    }

    

    protected function set_repeater_options_data($data, $repeater_data = Null, $options_val = Null)
    {


        foreach ($data as $key => $value) {
            foreach ($value as $nextKey => $nextValue) {
                if (isset($repeater_data[$nextKey])) {
                    $rep = json_decode($value[$nextKey], true);
                    if (!is_array($rep)) {
                        $rep = [];
                    }
                    foreach ($repeater_data as $rkey => $rvalue) {
                        foreach ($rvalue['field_slug'] as $kkey => $vvalue) {
                            unset($data[$key][$nextKey]);
                            $data[$key][$nextKey . '_' . $vvalue] = implode(',', array_column($rep, $vvalue));
                        }
                    }
                } elseif (isset($options_val[$nextKey])) {
                    unset($data[$key][$nextKey]);
                    $option_data = json_decode($nextValue, true);
                    if (!is_array($option_data)) {
                        $option_data = [];
                    }
                    foreach ($options_val[$nextKey] as $optionKey => $optionVal) {
                        if (in_array($optionKey, $option_data)) {
                            $data[$key][$nextKey . '_' . $optionKey] = 'yes';
                        } else {
                            $data[$key][$nextKey . '_' . $optionKey] = 'no';
                        }
                    }
                } else {
                    $field_val = $data[$key][$nextKey];
                    unset($data[$key][$nextKey]);
                    $data[$key][$nextKey] = $field_val;
                }
            }
        }
        return $data;
    }

    public function survey_static_community_based(Request $request)
    {

        $table_name = "235_survey_results_1";
//           accident_date
// accident_time
// no_of_fatalities
// no_of_persons_grievously_injured
// no_of_persons_with_minor_injuries
// type_of_collision
// type_of_vehicle_involved
// road_features


        $data = DB::table($table_name)->select([DB::raw("CONCAT(accident_site_state,' ',accident_site_district, ' ',accident_site_taluk, ' ',accident_site_village ) as address"), 'accident_date', 'accident_time', 'no_of_fatalities', 'no_of_persons_grievously_injured', 'no_of_persons_with_minor_injuries', 'type_of_collision', 'type_of_vehicle_involved', 'road_features'])->get();
        $data = json_decode(json_encode($data->all()), true);

        if ($request->isMethod('post') && $request['export']) {
            $file_name = 'ocrm_235_survey_results_2_' . date('Y-m-d-h-i-s');
            Excel::create($file_name, function ($excel) use ($data) {
                $excel->sheet('mySheet', function ($sheet) use ($data) {
                    $sheet->fromArray($data);
                });
            })->export('csv');
        }

        $option_data = [];
        return view('organization.survey.survey_static_result', compact('data', 'option_data'));
    }

    public function survey_static_surveillance(Request $request)
    {

        echo $table_name = "235_survey_results_5";

//           accident_date
// accident_time
// no_of_fatalities
// no_of_persons_grievously_injured
// no_of_persons_with_minor_injuries
// type_of_collision
// type_of_vehicle_involved
// road_features


        $data = DB::table($table_name)->select([DB::raw("CONCAT(accident_site_state,' ', accident_site_district,' ', accident_site_taluk,' ', accident_site_village ) as address"), 'accident_date', 'accident_time', 'accident_type', 'feature_of_road', 'vehicle_type', 'type_of_injury'])->get();
        $data = json_decode(json_encode($data->all()), true);

        if ($request->isMethod('post') && $request['export']) {
            return $file_name = 'ocrm_235_survey_results_5_' . date('Y-m-d-h-i-s');
            Excel::create($file_name, function ($excel) use ($data) {
                $excel->sheet('mySheet', function ($sheet) use ($data) {
                    $sheet->fromArray($data);
                });
            })->download('pdf');
        }

        $option_data = [];
        return view('organization.survey.survey_static_result', compact('data', 'option_data'));
    }

    protected function field_option_check($question_fields)
    {
        $collection = collect($question_fields);
        $collections = $collection->whereIn('field_type', ['radio', 'select', 'checkbox']);
        $fieldOption = $collections->mapWithKeys(function ($item) {
            $message = [];
            $option = collect($item['field_meta'])->where('key', 'field_options')->first();

            if (!empty($option['value'])) {
                $opt_val = json_decode($option['value'], true);

                foreach ($opt_val as $key => $value) {
                    if (empty($value['key']) || empty($value['value'])) {
                        $message['waring'] = 'May option key or val empty';
                    }
                    if (empty($value['go_to_question'])) {
                        $message['error'] = "Go to next question value does't exist";
                    } elseif (!isset($value['go_to_question'])) {
                        $message['error'] = "Go to next question Not added";
                    }
                }
            } else {
                $message = 'not exist Options Values';
            }
            if (!empty($message)) {
                return [$item['field_slug'] => ['field_type' => $item['field_type'], 'question' => $item['field_title'], 'error' => $message]];
            }
            return [$item['field_slug'] => null];
        });
        return $fieldOption;
    }


}
