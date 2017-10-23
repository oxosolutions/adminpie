<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Applicant;
use App\Model\Organization\ApplicantMeta; 
use App\Repositories\User\UserRepositoryContract;
use App\Model\Organization\Application;
use App\Model\Organization\ApplicationMeta;
use Session;
class ApplicationController extends Controller
{
	public function index(Request $request){

	$datalist= [];
        $data= [];
          if($request->has('per_page')){
                $perPage = $request->per_page;
                if($perPage == 'all'){
                  $perPage = 999999999999999;
                }
              }else{
                $perPage = get_items_per_page();;
              }
          $sortedBy = @$request->sort_by;
          if($request->has('search')){
              if($sortedBy != ''){
                  $model = Application::where('id','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = Application::where('id','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = Application::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = Application::paginate($perPage);
              }
          }
                  $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['id'=>'id', 'created_at'=>'Created At'],
                          'actions' => [
                                          'view' => ['title'=>'View Details','route'=>'view.applicantion' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.applicantion']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
    	
            return view('organization.application.application',$datalist);
    } 

    public function application_view($id){
    		$application =  get_meta('Organization\ApplicationMeta', $id, null, 'application_id', true);
    		Application::with('application_meta')->where('id',$id)->get();
			return view('organization.application.application_view',compact('application'));
	}
	public function delete($id){
		Application::where('id',$id)->delete();
		ApplicationMeta::where('application_id',$id)->delete();
		return redirect()->route('list.applicantions');
	}

}
