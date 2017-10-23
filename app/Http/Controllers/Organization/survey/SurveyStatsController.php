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
/**
 * @author [Paljinder Singh ] SurveyStatsController all work done by Paljnder Singh
 */
class SurveyStatsController extends Controller
{
    protected  function get_survey_table_name($form_id){
        $table = $replace_ocrm = null;
        $metaTable =  FormsMeta::where(['form_id'=>$form_id,'key'=>'survey_data_table']);
           if($metaTable->exists()){
              $table =   $metaTable->first()->value;
              $replace_ocrm = str_replace('ocrm_', '', $table);
              return ['table'=>$table , 'replace_ocrm'=> $replace_ocrm];
            }
        return null;
    }
    public function stats($id){
     $data['status']=  $data['count']['completed'] = $data['count']['sections'] = $data['count']['fields'] = $data['count']['incomplete'] = 0;
      $field = [];
      $data['status'] = null;
      $survey_data = forms::with(['section.fields.fieldMeta','formsMeta'])->where('id',$id);
      if($survey_data->exists()){
        $survey_data = $survey_data->first();
        if(count($survey_data['section'])>0){
          foreach ($survey_data['section'] as $key => $value){
            if(!empty($value['fields'])){
              $field[] = count($value['fields']);
            }
          }
          if(!empty($field)){
             $data['count']['fields']   = array_sum($field);
          }else{
              $data['status'] = 'error';
              $data['errors'][] =  __('survey.survey_question_miss');
          }
          $data['count']['sections'] = count($survey_data['section']);
        }else{
          $data['status'] = 'error';
          $data['errors'][] =  __('survey.survey_section_miss');
        }
        $response_table = $this->get_survey_table_name($id);
        if(empty($response_table)){
            $data['errors'][] = __('survey.survey_results_table_missing');
          }else{
              $table_name = $response_table['replace_ocrm'];
              $data['date_by'] = DB::select("select date(created_at) as date , count(id) as total, sum(case when survey_status = 1 then 1 else 0 end) as completed, sum(case when survey_status = 0 then 1 else 0 end) as uncompleted, count(*) as totals from ocrm_256_survey_results_1 group by date(created_at)");

            $data['user_by'] = DB::select("select survey_submitted_by as user_id, count(id) as total, sum(case when survey_status =1 then 1 else 0 end) as completed , sum(case when survey_status =0 then 1 else 0 end ) as uncompleted  FROM `ocrm_256_survey_results_1` group by survey_submitted_by ");
            $data['user_submit_from'] = DB::select("select survey_submitted_by as user_id , count(id) as total, sum( case when survey_submitted_from = 'app' then 1 else 0 end) as application , sum(case when survey_submitted_from='web' then 1 else 0 end) as web FROM `ocrm_256_survey_results_1` group by survey_submitted_by");

            $data['date_submit_from'] = DB::select("select date(created_at) as date , count(id) as total, sum( case when survey_submitted_from = 'app' then 1 else 0 end) as application , sum(case when survey_submitted_from='web' then 1 else 0 end) as web FROM `ocrm_256_survey_results_1` group by date(created_at)");
              
              $data['count']['completed'] = DB::table($table_name)->where('survey_status',1)->count();
              $data['count']['incomplete'] = DB::table($table_name)->where('survey_status',0)->count();
          }
       }else{
        $data['status'] = 'error';
        $data['errors'][] =  __('survey.survey_not_exit');
      }
      if($data['status']!='error'){
         $data['status'] = 'success';
      }

      // dump($data);
      return view('organization.survey.survey_stats',compact('data'));



     // $setting_questions = $settings = $survey_completed_count = $group_count = $section_question_count = $question_count = $survey_data =null;
    	// $survey_data = forms::with(['section.fields.fieldMeta','formsMeta'])->where('id',$id);
     //  if(!$survey_data->exists()){
     //    $error = "This survey does'nt exist";
     //    return view('organization.survey.survey_stats',compact('error'));
     //  }
     //  $survey_data = $survey_data->get();
     //  if($survey_data[0]['formsMeta']->count()){
     //      $settings = $survey_data[0]['formsMeta']->mapWithKeys(function($items){
     //        return [$items['key']=>$items['value']];
     //       });
     //      $setting_questions =  GFB::orderBy('order','asc')->whereIn('form_id',[93,76])->pluck('field_title', 'field_slug');
     //    }
     //    $table = $this->get_survey_table_name($id);
     //    if(!empty($table)){
     //      if(Schema::hasTable($table['replace_ocrm'])){
     //        $survey_completed_count = DB::table($table['replace_ocrm'])->count();
     //      }else{
     //        $error = "Table not exists";
     //        return view('organization.survey.survey_stats',compact('error'));
     //      }
     //    }
     //    if(!empty($survey_data)){
    	// 	$group_count = count($survey_data[0]['section']);
     //    $ary = [];
     //    $field = [];
     //    	 for($i=0; $i<$group_count; $i++){
     //        $field_collect  = collect($survey_data[0]['section'][$i]['fields']);
     //          $question_fields = $survey_data[0]['section'][$i]['fields']->toArray();
     //          $field_options =  collect($question_fields)->whereIn('field_type',['radio','select','checkbox']);
     //          $error_warning = $this->field_option_check( $question_fields);
     //          $filter_warning_error = $error_warning->filter();
     //         if($filter_warning_error->count() >0 ){
     //            $warning_error[] = $filter_warning_error;
     //         }
     //        $ary[] = explode(',' , $field_collect->implode('field_slug',','));
    	// 			$field[str_slug($survey_data[0]['section'][$i]['section_name'])] = count($survey_data[0]['section'][$i]['fields']);    	 	
     //    	 }
     //        $errors_warnings =  collect(@$warning_error)->collapse()->toArray();
     //        $oneAry =  collect($ary)->collapse()->toArray();
     //        $ques_slug_error = collect(array_count_values($oneAry))->filter(function($value , $key ){
     //            return $value > 1;
     //        });
    	//    $section_question_count = $field;
    	//    $question_count = array_sum($field);
     //    }
	    // return view('organization.survey.survey_stats',compact('group_count','section_question_count','question_count','survey_completed_count','settings','ques_slug_error','setting_questions','errors_warnings'));
    }

    protected function field_option_check($question_fields){
        $collection = collect($question_fields);
        $collections = $collection->whereIn('field_type',['radio','select','checkbox']);
        $fieldOption  = $collections->mapWithKeys(function($item){
          $message =[];
          $option = collect($item['field_meta'])->where('key','field_options')->first();
            // dump($item['field_slug'] , $option);
          if(!empty($option['value'])){
            $opt_val =  json_decode($option['value'],true);
            //dump($opt_val);
            foreach ($opt_val as $key => $value) {
                if(empty($value['key']) || empty($value['value'])){
                    $message['waring'] = 'May option key or val empty';
                }
                 if(empty($value['go_to_question'])){
                    $message['error'] = "Go to next question value does't exist";
                 }elseif(!isset($value['go_to_question'])){
                    $message['error'] = "Go to next question Not added";
                 }
            }
           }else{
            $message ='not exist Options Values';
           }
          if(!empty($message)){
            return [ $item['field_slug']=> ['field_type'=>$item['field_type'],'question'=>$item['field_title'], 'error'=>$message]];
           }
          return [$item['field_slug']=>null];
        });
      return $fieldOption;
    }

    protected function count_section_question($survey_data){
      if(count($survey_data['section'])>0){
      foreach ($survey_data['section'] as $key => $value){
            if(!empty($value['fields'])){
              $field[] = count($value['fields']);
            }
          }
          if(!empty($field)){
             $data['count']['fields']   = array_sum($field);
          }else{
              $data['status'] = 'error';
              $data['errors'][] =  __('survey.survey_question_miss');
          }
          $data['count']['sections'] = count($survey_data['section']);
        }else{
          $data['status'] = 'error';
          $data['errors'][] =  __('survey.survey_section_miss');
        }
        return $data;

    }
    public function survey_structure($id){
        $id =intval($id);
        $survey_data = forms::with(['formsMeta','section'=>function($query){
                                $query->orderBy('order','asc');
                              } ,
                              'section.fields'=>function($query_field){
                                   $query_field->orderBy('order','asc');
                              },
                               'section.fields.fieldMeta'])->where('id',$id)->first()->toArray();
        $data = $this-> count_section_question($survey_data);
        $count_form_slug = forms::where('form_slug',$survey_data['form_slug'])->count();
        $setting_questions = GFB::orderBy('order','asc')->whereIn('form_id',[93,76])->pluck('field_title', 'field_slug');
        return view('organization.survey.survey_structure',compact('data','survey_data','setting_questions','count_form_slug') );
    }
    public function survey_result(Request $request, $id)
    {  $condition_data =null;
       $metaTable =  FormsMeta::where(['form_id'=>$id,'key'=>'survey_data_table']);
        // $question =  FormBuilder::with(['fieldMeta'=>function($query){
        //   $query->where('key','question_id');
        // }])->where('form_id',$id)->get()->toArray();
        // $questionId_slug = collect($question)->mapWithKeys(function($items){
        //   return [$items['field_meta'][0]['value']=>$items['field_slug']];
        // });
       if($metaTable->exists()){
          $table =   $metaTable->first()->value;
          $table_name = str_replace('ocrm_', '', $table);
          if(!Schema::hasTable($table_name)){
            return view('organization.survey.survey_result');
          }
          if($request->isMethod('post')){
            $this->validations($request);
            
              $data = $this->filter_on_suvey_result($request, $table_name);
              $condition = json_decode($data->get(), true);
              if(!empty($condition['condition_data'])){
               
                 $condition_data = $condition['condition_data'];
                 unset($condition['condition_data']);
              }
             if(!empty($request['export'])){
                  $file_name ='ocrm'.$table_name.'-'.date('Y-m-d-h-i-s');
                     Excel::create($file_name, function($excel) use($condition_data){
                      $excel->sheet('mySheet', function($sheet) use($condition_data){
                        $sheet->fromArray($condition_data);
                      });
                    })->export('csv');
                }
                $data = $data->paginate(5);
          }else{
              // $data = DB::table($table_name)->get();
              $data =  DB::table($table_name)->paginate(5);
              // $data = json_decode($data,true);
          }
          $table_column = Schema::getColumnListing($table_name);
          $columns = array_combine($table_column,$table_column);
          $formQuestion = FormBuilder::select('field_slug','field_title')->where('form_id',$id)->get()->mapWithKeys(function($items){
            return [$items['field_slug'] =>$items['field_title']];
          })->toArray(); 
        }else{
             $formQuestion = $columns = $data = null;
        }
     return view('organization.survey.survey_result',compact('id','columns', 'data','formQuestion','condition_data','table'));
    }
    protected function validations($req){

      $customMessages = [
    'fields.required' => 'Select atleast one field to view data.',
    ];
      return $this->validate($req,['fields'=>'required'], $customMessages );
    }
    protected function filter_on_suvey_result($request , $table_name){
          $condition =null;
          if(!empty($request['condition_field']) && !empty($request['condition_field_value']) ){
             $where = [];
                foreach ($request['condition_field'] as $key => $value) {

                  $condition_field_value = $request['condition_field_value'][$key];
                  $operator = $request['operator'][$key];
                  if($operator=='like'){
                    $final = [$value , $operator,  $condition_field_value.'%'];

                  }else{
                       $final = [$value , $operator,  $condition_field_value];
                  }
                  array_push($where, $final);
                }
          }
         if(!empty($where)){
            $data = DB::table($table_name)->select($request['fields'])->where($where);//->get();
            $data['condition_data'] = $where;
         }else{
            $data = DB::table($table_name)->select($request['fields']);//->get();
         }
            // $data = json_decode($data,true);
            return $data;
    }

    public function reports(Request $request, $id){
       
        $table = Session::get('organization_id')."_survey_results_".$id;
        if(!Schema::hasTable($table)){
           $error = "survey_results_table_missing";
          return view('organization.survey.survey_reports',compact('error'));
        }
        $table_column = Schema::getColumnListing($table);
        $columns = array_combine($table_column,$table_column);
        $options_val = $data=[];
         $field = FormBuilder::with(['fieldMeta'=>function($query){
          $query->where('key','question_id');
         }])->where('form_id',$id)->get()->toArray();
         $slug_question_id = collect($field)->mapWithKeys(function($item){
          return [$item['field_slug']=>[$item['field_type'] , $item['field_meta'][0]['value'], $item['id']]];
         });
        $columns  = collect($columns)->map(function($items, $key)use($slug_question_id) {
            if(!empty($slug_question_id[$key])){
                $items = $items.' ('.$slug_question_id[$key][1].')';
            }
            return $items;
         });

         if($request->isMethod('post')){
              $req = $request->toArray();
           if(!empty($request['concat_fields'][0])){        
              $concat_name =   $req['concat_name'][0];
              $concat_field = collect($request['concat_fields'])->implode( ",' ',");
              //         // echo  $fields = collect($request['fields'])->implode( ", ");
              array_push($req['fields'] , DB::raw("CONCAT( $concat_field ) as $concat_name"));
            }
            foreach($req['fields'] as $key => $val){
                if(!empty($slug_question_id[$val]))
                {
                  if($slug_question_id[$val][0]=='checkbox' || $slug_question_id[$val][0] =='multi_select'){

                    // dump(field_options($val, $slug_question_id[$val][2]));
                    $options_val[$val] =  field_options($val, $slug_question_id[$val][2]);
                  }
                }
              }
            
            $data = DB::table($table)->select($req['fields'])->get();
            $data = json_decode($data,true);
         }
      return view('organization.survey.survey_reports',compact('data','id','columns','table','options_val'));

    }
    public function survey_static_result(Request $request ,$id){

// dd($id);
          $table_name = "235_survey_results_$id";
         if(!Schema::hasTable($table_name)){
            $error['table_not_exist'] = "No Data Available";
            return view('organization.survey.survey_static_result', compact('error') );
        }else{
              $fatal = $grevious = $minor=null;
              $dt = carbon::now();
              $to = $dt->toDateString();
              $from = $dt->subWeek(2)->toDateString();
              if($request->isMethod('post') && !empty($request['from']) &&  !empty($request['to'])){
                if($request['from'] >  $request['to']){
                     $error['from_greater_to'] = 'from-date must be greater than to-date';
                    return view('organization.survey.survey_static_result', compact('error','id') );
                }
              }


              if($id==1){
                try {
                   if($request->isMethod('post')){
                          $where = [];
                        if(!empty($request['from'])){
                         array_push($where,['accident_date', '>=', date('Y-m-d', strtotime($request['from']))]);
                        }
                        if(!empty($request['to'])){
                         array_push($where,['accident_date', '<=', date('Y-m-d', strtotime($request['to']))]);
                        }
                      }
                  $data = DB::table($table_name)->select([ DB::raw("CONCAT(accident_site_state,' ',accident_site_district, ' ',accident_site_taluk, ' ',accident_site_village ) as address"), 'accident_date', 'accident_time', 'no_of_fatalities' ,'no_of_persons_grievously_injured','no_of_persons_with_minor_injuries','type_of_collision' ,'type_of_vehicle_involved','road_features','type_of_vehicle_involved']);
                    if(!empty($where)){
                       $data = $data->where($where)->get();
                    }else{
                      $data = $data->get();
                    }

                 } catch (\Exception $e) {
                     $error['table_column_not_exist'] = "column not match";
                     return view('organization.survey.survey_static_result', compact('error','id') );
                     // return $e->getMessage();
                  
                }
              }elseif($id==2){
                 try {
                        $u_id = Auth::guard('org')->user()->id;
                        if($request->isMethod('post')){
                          $where = [];
                        if(!empty($request['from'])){
                         array_push($where,['accident_date', '>=', date('Y-m-d', strtotime($request['from']))]);
                        }
                        if(!empty($request['to'])){
                         array_push($where,['accident_date', '<=', date('Y-m-d', strtotime($request['to']))]);
                        }

                      }
                        if(is_admin($u_id)){
                              $data = DB::table($table_name)->select([  DB::raw("CONCAT(accident_site_state,' ',accident_site_district, ' ',accident_site_taluk, ' ',accident_site_village ) as address") , 'accident_date', 'accident_time', 'accident_type', 'sub_type_of_road', 'vehicle_related_details', 'type_of_injury']);
                          if(!empty($where)){
                             $data = $data->where($where)->get();
                          }else{
                            $data = $data->get();
                          }
                        }elseif($area_code = get_user_meta($u_id, 'areacode')){
                            $data = DB::table($table_name)->select([  DB::raw("CONCAT(accident_site_state,' ',accident_site_district, ' ',accident_site_taluk, ' ',accident_site_village ) as address") , 'accident_date', 'accident_time', 'accident_type', 'sub_type_of_road', 'vehicle_related_details', 'type_of_injury'])->where('center_code',$area_code);
                            if(!empty($where)){
                               $data = $data->where($where)->get();
                            }else{
                              $data = $data->get();
                            }
                        }

                    } catch (\Exception $e) {
                     $error['table_column_not_exist'] = "column not match";
                     return view('organization.survey.survey_static_result', compact('error','id') );
                }
            }elseif($id==5){
               try { 
                      $u_id = Auth::guard('org')->user()->id;
                      if($request->isMethod('post')){
                          $where = [];
                        if(!empty($request['from'])){
                         array_push($where,['accident_date', '>=', date('Y-m-d', strtotime($request['from']))]);
                        }
                        if(!empty($request['to'])){
                         array_push($where,['accident_date', '<=', date('Y-m-d', strtotime($request['to']))]);
                        }

                      }
                  
                  if(is_admin($u_id)){
                       
                        $data = DB::table($table_name)->select([DB::raw("CONCAT(accident_site_state,' ', accident_site_district,' ', accident_site_taluk,' ', accident_site_village ) as address"), 'accident_date', 'accident_time', 'accident_type', 'feature_of_road' , 'type_of_injury' ,'vehicle_related_details']);
                        if(!empty($where)){
                          $data = $data->where($where)->get();
                        }else{
                          $data = $data->get();
                        }
                    }elseif($area_code = get_user_meta($u_id, 'areacode')){
                      $data = DB::table($table_name)->select([DB::raw("CONCAT(accident_site_state,' ', accident_site_district,' ', accident_site_taluk,' ', accident_site_village ) as address"), 'accident_date', 'accident_time', 'accident_type', 'feature_of_road' , 'type_of_injury' ,'vehicle_related_details'])->where('center_code',$area_code);

                      if(!empty($where)){
                          
                          $data = $data->where($where)->get();
                         
                        }else{
                          
                          $data = $data->get();
                        }
                    }
                 } catch (\Exception $e) {
                     $error['table_column_not_exist'] = "column not match";
                     return view('organization.survey.survey_static_result', compact('error','id') );
                }
            }
            $last_two_week = DB::table($table_name)->where('accident_date', '<=', $to) ->where('accident_date', '>=', $from)->count();
            $data = json_decode(json_encode($data->all()),true);
              if($request->isMethod('post') && $request['export'] ){
               $file_name ="ocrm_235_survey_results_".$id."_".date('Y-m-d-h-i-s');
                         Excel::create($file_name, function($excel) use($data){
                          $excel->sheet('mySheet', function($sheet) use($data){
                            $sheet->fromArray($data);
                          });
                        })->export('csv');
              }
        $sub_type_of_road = FormBuilder::with(['fieldMeta'=>function($query){
          $query->where('key','field_options');
        }])->where('field_slug','sub_type_of_road')->first()->toArray();
        $option_data = collect(json_decode($sub_type_of_road['field_meta'][0]['value'],true))->pluck('value','key')->toArray();
        return view('organization.survey.survey_static_result',compact('data','option_data' ,'last_two_week','id','fatal','grevious','minor'));
      }
    }

    public function survey_static_community_based(Request $request){

          $table_name = "235_survey_results_1";
//           accident_date
// accident_time 
// no_of_fatalities 
// no_of_persons_grievously_injured 
// no_of_persons_with_minor_injuries
// type_of_collision 
// type_of_vehicle_involved 
// road_features 


          $data = DB::table($table_name)->select([ DB::raw("CONCAT(accident_site_state,' ',accident_site_district, ' ',accident_site_taluk, ' ',accident_site_village ) as address"),   'accident_date', 'accident_time', 'no_of_fatalities' ,'no_of_persons_grievously_injured','no_of_persons_with_minor_injuries','type_of_collision' ,'type_of_vehicle_involved','road_features'])->get();
          // dd($data);
          $data = json_decode(json_encode($data->all()),true);
         
          if($request->isMethod('post') && $request['export'] ){
           $file_name ='ocrm_235_survey_results_2_'.date('Y-m-d-h-i-s');
                     Excel::create($file_name, function($excel) use($data){
                      $excel->sheet('mySheet', function($sheet) use($data){
                        $sheet->fromArray($data);
                      });
                    })->export('csv');
          }
    
    $option_data=[];
        return view('organization.survey.survey_static_result',compact('data','option_data'));
    }
 public function survey_static_surveillance(Request $request){

        echo   $table_name = "235_survey_results_5";

//           accident_date
// accident_time 
// no_of_fatalities 
// no_of_persons_grievously_injured 
// no_of_persons_with_minor_injuries
// type_of_collision 
// type_of_vehicle_involved 
// road_features 
          


          $data = DB::table($table_name)->select([DB::raw("CONCAT(accident_site_state,' ', accident_site_district,' ', accident_site_taluk,' ', accident_site_village ) as address"), 'accident_date', 'accident_time', 'accident_type', 'feature_of_road', 'vehicle_type', 'type_of_injury' ])->get();
          // dd($data);
          $data = json_decode(json_encode($data->all()),true);
         
          if($request->isMethod('post') && $request['export'] ){
          return $file_name ='ocrm_235_survey_results_5_'.date('Y-m-d-h-i-s');
                     Excel::create($file_name, function($excel) use($data){
                      $excel->sheet('mySheet', function($sheet) use($data){
                        $sheet->fromArray($data);
                      });
                    })->download('pdf');
          }
    
    $option_data=[];
        return view('organization.survey.survey_static_result',compact('data','option_data'));
    }




    
}
