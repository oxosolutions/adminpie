<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Model\Organization\Applicant;
// use App\Model\Organization\ApplicantMeta; 
use App\Repositories\User\UserRepositoryContract;
use App\Model\Organization\Application;
// use App\Model\Organization\ApplicationMeta;
use App\Model\Organization\User;
use App\Model\Organization\UsersMeta;
use Session;

class ApplicantController extends Controller
{

     protected $user;
    public function __construct(UserRepositoryContract $user)
    {
        $this->user = $user;

    }
    /**
     * [apply description]
     * @param  [int] $id [job opening id]
     * @return [type]     [description]
     */
    public function apply(Request $request, $id=null)
    {
      if($request->isMethod('post')){
        $tbl = Session::get('organization_id');
        $valid_fields = [   'name'          => 'required',
                            'email'         => 'required|email|unique:'.$tbl.'_users',
                            'password'      => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/|min:8'
                        ];
        $this->validate($request , $valid_fields);
        $request['role_id'] = setting_val_by_key('applicant_role');
        $user_id = $this->user->create($request->all(), 6,'applicant');

        $application = new Application();
        $application->opening_id = $request['opening_id'];
        $application->applicant_id = $user_id;
        $application->save();
        // unset($request['_token'], $request["opening_id"],$request["name"], $request["email"], $request["password"], $request['role_id']);
        $data = $request->except('_token','opening_id','name','email','password','role_id','qualification','percentage','board/university','date_of_passing');
        foreach ($data as $key => $value) {
          $applicationMeta = new ApplicationMeta();
          $applicationMeta->application_id = $application->id;
          $applicationMeta->key = $key;
          if(is_array($value)){
            $value = json_encode($value);
          }
          $applicationMeta->value = $value;
          $applicationMeta->save();
        }
            Session::flash('sucess','successfully applied Job');
        return redirect()->route('openingss');
      }
         return view('organization.applicant.apply',compact('id'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                $perPage = 5;
              }
          $sortedBy = @$request->sort_by;
          if($request->has('search')){
              if($sortedBy != ''){
                  $model = User::where('user_type','applicant')->where('id','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = User::where('user_type','applicant')->where('id','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = User::where('user_type','applicant')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = User::where('user_type','applicant')->paginate($perPage);
              }
          }
                  $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['id'=>'id', 'name'=>'Name','created_at'=>'Created At'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'edit.applicant' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.applicant']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
            return view('organization.applicant.list',$datalist);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      if($request->isMethod('post')){
        $request['name'] = $request['name'];
        $request['email'] = $request['email'];
        $tbl = Session::get('organization_id');
        $valid_fields = [   'name'          => 'required',
                            'email'         => 'required|email|unique:'.$tbl.'_users',
                            'password'      => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/|min:8'
                        ];
        $this->validate($request , $valid_fields);
        $request['role_id'] = setting_val_by_key('applicant_role');
        $user_id = $this->user->create($request->all(),6,'applicant');
      }
      return redirect()->route('list.applicant');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $appCheckFirst = User::where(['id'=>$id]);
        if($appCheckFirst->exists()){

          dd( $appCheckFirst);
           $data =  $appCheckFirst->get()->keyBy('key');
           $collection = collect($data->toArray());
            $keyed = $collection->mapWithKeys(function ($item) {
                return [$item['key'] => $item['value']];
            });
              $keyed['id'] = $id;
          $model =  $keyed->all();
          
        }else{
          $model= ['id'=>$id];
        }

        if($request->isMethod('post')){
            unset($request['_token']);
            foreach ($request->all() as $key => $value) {
                if(is_array($value)){
                    $value = json_encode($value);
                }
               $applicantCheck =  ApplicationMeta::where(['applicant_id'=>$id, 'key'=>$key]);
               if($applicantCheck->exists()){
                    $applicantCheck->update(['value'=>$value]);
                }else{
                  $appMeta =  new ApplicationMeta();
                  $appMeta->applicant_id = $id;
                  $appMeta->key = $key;
                  $appMeta->value = $value;
                  $appMeta->save();
              }
            }
                  return redirect()->route('list.applicant');
            }
    
         return view('organization.applicant.edit', compact('model'));
    }

   /**
    * [destroy description]
    * @param  [type] $id [description]
    * @return [type]     [description]
    */
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        UsersMeta::where('user_id', $id)->delete();
        return back();
    }
}
