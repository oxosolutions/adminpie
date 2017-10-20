<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Shortcode;
use App\Model\Organization\forms as Form;
use FormGenerator;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
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

        Shortcode::add('form', function($atts, $content, $name){
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
        });

        Shortcode::add('survey', function($atts, $content, $name){
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
        });
    }
}
