<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Shortcode;
use App\Model\Organization\forms as Form;
use FormGenerator;
use Auth;
use Session;
use App\Model\Group\GroupUsers;
use Laravel\Dusk\DuskServiceProvider;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(DuskServiceProvider::class);
        Shortcode::add('example', function($atts, $content, $name){
          $a = Shortcode::atts(array(
            'foo' => 'something',
            'bar' => 'something else',
            ),
            $atts
          );
            return "foo = {$a['foo']}";
        });

        Shortcode::add('date', function($atts, $content, $name){
            return date('Y-m-d');
        });

        Shortcode::add('b', function($atts, $content, $name){
            $content = Shortcode::compile($content);
            return "<strong>".$content."</strong>";
        });

        /*Shortcode::add('form', function($atts, $content, $name){
            if(array_has($atts,'id')){
                $model = Form::find($atts['id']);
                if($model != null){
                    $form_slug = $model->form_slug;
                    $from = (Auth::guard('admin')->check())?'admin':'org';
                    return FormGenerator::GenerateForm($form_slug,[],null,$from);
                }else{
                    //error
                    return '<strong>No Form Found</strong>';
                }
            }elseif(array_has($atts,'slug')){
                $slug = $atts['slug'];
                $from = (Auth::guard('admin')->check())?'admin':'org';
                return FormGenerator::GenerateForm($slug,[],null,$from);
            }else{
                //error
                return '<strong>attributes missing!</strong>';
            }
        });*/

        Shortcode::add('form', function($atts,$content,$name){
            if(array_has($atts,'id')){
                $model = Form::find($atts['id']);
                if($model != null){
                    $form_slug = $model->form_slug;
                    $from = (Auth::guard('admin')->check())?'admin':'org';
                    return form($form_slug,$from);
                    //return FormGenerator::GenerateForm($form_slug,[],null,$from);
                }else{
                    //error
                    return '<strong>No Form Found</strong>';
                }
            }elseif(array_has($atts,'slug')){
                $slug = $atts['slug'];
                $from = (Auth::guard('admin')->check())?'admin':'org';
                // return FormGenerator::GenerateForm($slug,[],null,$from);
                return form($slug,$from);
            }else{
                //error
                return '<strong>attributes missing!</strong>';
            }
        });

        Shortcode::add('survey', function($atts, $content, $name){
            if(array_has($atts,'id')){
                $model = Form::find($atts['id']);
                if($model != null){
                    $token = $model->embed_token;
                    return survey($token);
                    // return FormGenerator::GenerateForm($form_slug,[],null,$from);
                }else{
                    //error
                    return '<strong>No Form Found</strong>';
                }
            }elseif(array_has($atts,'slug')){
                $model = Form::where(['form_slug'=>$atts['slug']])->first();
                $token = $model->embed_token;
                return survey($token);
                //return FormGenerator::GenerateForm($slug,[],null,$from);
            }else{
                //error
                return '<strong>attributes missing!</strong>';
            }
        });

        
        Shortcode::add('userData', function($id = null){
            $userEmail = [];
            if($id != null){
                $userEmail = GroupUsers::where('email',$id)->first()->email;
                return $userEmail;
            }else{
                return $userEmail;
            }
        });

        Shortcode::add('survey-data', function($optionsArray = null){
            try{
                $formModel = form::with(['section'=>function($query){
                    $query->with(['fields'=>function($query){
                        $query->with(['fieldmeta'])->orderBy('order','asc');
                    }])->orderBy('order','asc');
                }])->find($optionsArray['id']);
                $surveyDataArray = [];
                foreach($formModel->section as $key => $section){
                    $surveyDataArray[$key] = ['section_id'=>$section->id,'section_name'=>$section->section_name,'section_description'=>$section->section_description];
                    foreach($section->fields as $k => $field){
                        $tempArray = [];
                        $tempArray['field_title'] = $field->field_title;
                        $tempArray['field_type'] = $field->field_type;
                        $tempArray['field_slug'] = $field->field_slug;
                        if(in_array($field->field_type,['radio','checkbox','select','multi_select'])){
                            $options = $field->fieldmeta->where('key','field_options')->first();
                            if($options != null){
                                $tempArray['options'] = json_decode($options->value,true);
                            }
                        }else{
                            $tempArray['options'] = [];
                        }
                        $surveyDataArray[$key]['fields'][] = $tempArray;
                    }
                }
                $tableName = get_organization_id().'_survey_results_'.$optionsArray['id'];
                $data = DB::table($tableName)->where('survey_submitted_by',Auth::guard('org')->user()->id)->get()->toArray();
                return json_encode(['answers'=>$data,'survey_details'=>$surveyDataArray]);
            }catch(\Exception $e){
                return json_encode([]);
            }
        });

        Shortcode::add('login-link', function($optionsArray = null){
            if(Auth::guard('org')->check()){
                return '';
            }else{
                return '<a href="'.route('org.login').'">Login</a>|<a href="'.route('register').'">Register</a>';
            }
        });        


    }
}
