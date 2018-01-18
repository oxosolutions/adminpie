<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\JobOpening;
use App\Model\Organization\JobOpeningMeta;
use App\Model\Organization\Application;
use Session;


class JobOpeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function public_view_jobs(){
      $jobs = JobOpening::with('opening_meta')->get()->toArray();
      return view('organization.jobopening.public_jobs',compact('jobs'));
    }
    public function index(Request $request)
    {
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
              $model = JobOpening::where('title','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
          }else{
              $model = JobOpening::where('title','like','%'.$request->search.'%')->paginate($perPage);
          }
      }else{
          if($sortedBy != ''){
              $model = JobOpening::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
          }else{
               $model = JobOpening::paginate($perPage);
          }
      }

      $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['title'=>'Title','created_at'=>'Created'],
                      'actions' => [
                                      'edit' => ['title'=>'Edit','route'=>'opening.update' , 'class' => 'edit'],
                                      'delete'=>['title'=>'Delete','route'=>'delete.opening'],
                                      'apply'=>['title'=>'Apply','route'=>'application']
                                      // 'application'=>['title'=>'Application','route'=>'applied.application']
                                  ],
                      'js'  =>  ['custom'=>['list-designation']],
                      'css'=> ['custom'=>['list-designation']]
                  ];
        return view('organization.jobopening.list',$datalist);

    }
    /**
     * [FunctionName description]
     * @param string $value [description]
     */
    public function application($id)
    {
      $user = user_info();
      $checkExists = Application::where(['applicant_id'=>$user['id'] , 'opening_id'=>$id]);
      if($checkExists->exists()){
        Session::flash('error','You already applied this job');
        return redirect()->route('list.opening');
      }
      $application = new Application();
      $application->opening_id = $id;
      $application->applicant_id = $user['id'];
      $application->save();
      return redirect()->route('list.opening');

    }
    public function applied_application($id){
      $opening = JobOpening::with('applications.applicant.applicant_meta')->where('id',$id)->get();

    }

    protected function validateJobCreatePost($request){
        $rules = [
            'title' => 'required',
            'department' => 'required',
            'designation' => 'required',
            'skills' => 'required',
            'job_type' => 'required',
            'location' => 'required',
            'number_of_post' => 'required',
            'eligibility' => 'required'
        ];

        $this->validate($request,$rules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {	
        if($request->isMethod('post')){
            $this->validateJobCreatePost($request);
    		$job = new JobOpening();
    		$job->fill($request->all());
    		$job->save();
            $request['opening_id'] = $job->id;
            unset($request['_token'],  $request['title'] ,$request['department'], $request['designation'],$request['skills'] ,$request['job_type'] ,$request['location'], $request['number_of_post']);
            if($request->hasFile('job_image')){
                $uploadedImage = $this->uploadJobImage($request);
                $request->request->add(['image'=>$uploadedImage]);
            }
            foreach ($request->all() as $key => $value) {
                if(!in_array($key,['job_image'])){
                    $jobMeta = new JobOpeningMeta();
                    $jobMeta->opening_id =  $job->id;
                    $jobMeta->key =  $key;
                    if(is_array($value)){
                        $value = json_encode($value);   
                    }
                    $jobMeta->value =  $value;
                    $jobMeta->save();
                }
            }
            return redirect()->route('list.opening');
        }
        return view('organization.jobopening.create');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=null){

        $model =  JobOpening::find($id);
        if($request->isMethod('post')){

            $model->fill($request->all());
            $model->save();
            unset($request['_token'], $request['title'] ,$request['department'], $request['designation'],$request['skills'] ,$request['job_type'], $request['location'], $request['number_of_post']);
            if($request->hasFile('job_image')){
                $uploadedImage = $this->uploadJobImage($request);
                $request->request->add(['image'=>$uploadedImage]);
            }
            foreach ($request->all() as $key => $value) {
                if(!in_array($key,['job_image'])){
                    $checkExist = JobOpeningMeta::where(['opening_id'=>$id,'key'=>$key]);
                    if($checkExist->exists()){
                        $checkExist->update(['value'=>$value]);
                    }else{
                        $jobMeta = new JobOpeningMeta();
                        $jobMeta->opening_id =  $id;
                        $jobMeta->key =  $key;
                        $jobMeta->value =  $value;
                        $jobMeta->save();
                    }
                }
            }
            return redirect()->route('list.opening');
        }
        $opening = JobOpeningMeta::where('opening_id',$id)->get()->keyBy('key')->toArray();
        $datas = collect($opening);
        $data = $datas->mapWithKeys(function($items){
            return [$items['key'] => $items['value']];
        });
        $col  = collect([$model->toArray(), $data->toArray()]);
        $model = $col->collapse();
        return view('organization.jobopening.edit', compact('model'));
    }

    /**
     * Upload posted job image to directory
     * @param  [type] $request having all posted data by user 
     * @return [type]          will return boolean 
     * @author Rahul
     */
    protected function uploadJobImage($request){
        $path = upload_path('job_opening_images');
        $fileName = $request->file('job_image')->getClientOriginalName();
        $request->file('job_image')->move($path, $fileName);
        return $path.'/'.$fileName;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       JobOpening::where('id',$id)->delete();
       JobOpeningMeta::where('opening_id',$id)->delete();
        return redirect()->route('list.opening');

    }
}
