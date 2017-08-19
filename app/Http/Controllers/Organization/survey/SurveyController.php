<?php

namespace App\Http\Controllers\Organization\survey;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\forms as forms;
use Auth;
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
                        'actions' => ['delete'=>['title'=>'Delete','route'=>$deleteRoute],'section'=>['title'=>'Sections','route'=>['route'=>$sectionRoute]],'settings'=>['title'=>'Settings','route'=>$settingsRoute]],
                        'title' => 'Survey'
                    ];

        // $model = forms::with(['section'])->get();
        return view('admin.formbuilder.list',$datalist);
    }
    public function createSurvey()
    {
    	 return view('admin.formbuilder.create',['type','survey']);
    }
}
